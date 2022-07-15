<?php

namespace Config;

use PDO;

// connection pdo 
class Connection
{
  use Config;
  private $connection;
  private $stmt;

  public function __construct()
  {
    if (empty($this->db)) echo 'Masukkan databasenya.!';
    try {
      $dns = "{$this->driver}:host={$this->host};dbname={$this->db}";
      $this->connection = new PDO($dns, $this->user, $this->password);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return;
    } catch (\PDOException  $th) {
      echo $th->getMessage();
    }
  }

  public function getData($table, $id = null, $join = null, $columns = null, $count = null)
  {
    if (!is_null($join)) {
      $columnId = "`$table`.id as PrimaryId";
      if (!is_null($count)) $columnId .= ",`$count`.`$count`";
      if (is_array($join)) {
        $params = array_values($join);
        $keys   = array_keys($join);
        $data = "SELECT *,$columnId FROM `$table` LEFT JOIN  `$params[0]`as a ON a.`id` = `$table`.`" . $params[0] . '_id' . "` ";
      } else {
        $data = "SELECT *,$columnId FROM `$table` LEFT JOIN `$join` as a ON a.id = `$table`.`" . $join . '_id' . "`";
      }
      if (!is_null($count)) $data .= " LEFT JOIN (SELECT *, COUNT(id) as `$count` FROM `$params[1]` GROUP BY `" . $params[0] . '_id' . "`) `$count`  ON `$count`.`" . $params[0] . '_id' . "` = a.`id` ";
    } else $data = "SELECT * FROM `$table`";

    if (!is_null($id)) {
      if (is_array($id)) {
        $params = array_values($id);
        $keys   = array_keys($id);
        $data .= " WHERE `$keys[0]` = '" . $params[0] . "' AND `$keys[1]`= '" . $params[1] . "' ";
      }
      if (is_string($id))
        $data .= " WHERE `$table`.`id` = '" . $id . "' ";
    }
    if (!is_null($columns)) $data .= " OR  `$columns[1]` = '" . $id . "'";
    if (!is_null($join))
      $data .= " ORDER BY `$table`.id ASC";
    try {
      $stmt  = $this->connection->prepare($data);
      $stmt->execute();
      if ($stmt->rowCount() > 1)
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
      else $data = $stmt->fetch(PDO::FETCH_OBJ);
      return $data;
    } catch (\PDOException $th) {
      // echo $th->getMessage();
      return false;
    }
  }

  public function getNotData($table, $id, $columns)
  {
    $columns = implode("`,`", $columns);
    $data = "SELECT `" . $columns . "` FROM `$table` WHERE `id` NOT IN (" . $id . ") ";
    try {
      $stmt  = $this->connection->prepare($data);
      $stmt->execute();
      if ($stmt->rowCount() > 1)
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
      else $data = $stmt->fetch(PDO::FETCH_OBJ);
      return $data;
    } catch (\Exception $th) {
      echo $th->getMessage();
    }
  }

  public function params($arr = [])
  {
    $data = [];
    foreach ($arr as $key => $value) {
      $data[] = $value;
    }
    return $data;
  }

  public function insert($table, $arr): bool
  {
    $keys   = implode("`,`", array_keys($arr));
    $data = $this->params($arr);
    $val  = [];
    foreach ($data as $value) {
      $val[] = "?";
    }
    $values = implode(",", array_values($val));
    try {
      $table = "INSERT INTO `$table` (`" . $keys . "`) VALUES ($values)";
      $stmt  = $this->connection->prepare($table);
      // if (!$insert) echo 'Data duplicate';
      $stmt->execute(array_values($data));
      return true;
      // echo 'success';
    } catch (\PDOException  $th) {
      return false;
      // echo $th->getMessage();
    }
  }

  public function trash($table, $id): bool
  {
    if (empty($id)) echo 'Data wajid dipilih';
    $checkData = $this->getData($table, $id);
    if ($checkData) {
      try {
        $table = "DELETE FROM `$table` WHERE id = :id";
        $stmt  = $this->connection->prepare($table);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (\PDOException  $th) {
        return false;
      }
    }
    return false;
    // } else echo 'Data tidak ditemukan.!';
  }

  public function updated($table, $id, $arr)
  {
    $keys   = implode("`=?,`", array_keys($arr));
    $checkData = $this->getData($table, $id, null, array_keys($arr));
    if ($checkData) {
      try {
        $table  = "UPDATE  `$table` SET  `" . $keys . "` =? WHERE id= ?";
        $stmt   = $this->connection->prepare($table);
        $data = array_merge($arr, ['id' => (int)$id]);
        $stmt->execute(array_values($data));
        return true;
      } catch (\PDOException  $th) {
        // echo $th->getMessage();
        return false;
      }
    } else
      return false;
  }

  static function closeConnection(&$connection)
  {
    return $connection = null;
  }
}
