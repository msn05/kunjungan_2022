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

  public function getData($table, $id = null, $join = null)
  {
    if ($table) $table = "SELECT * FROM `$table`";
    // else
    //   $table = "SELECT * FROM `$table` WHERE `id` = '" . $id . "'";
    if (!is_null($join))
      $table .= "LEFT JOIN `$join` as a ON a.id = `$table`.`$join-$id`";
    if (!is_null($id)) $table .= "WHERE `id` = '" . $id . "'";
    $table .= "ORDER BY `id` ASC";
    try {
      $stmt  = $this->connection->prepare($table);
      $stmt->execute();
      if (is_null($id)) $data = $stmt->fetchAll(PDO::FETCH_OBJ);
      else $data = $stmt->fetch(PDO::FETCH_OBJ);
      return $data;
    } catch (\Exception $th) {
      echo $th->getMessage();
    }
  }

  public function insert($table, ...$arr)
  {
    $keys   = implode("`,`", array_keys($arr));
    $values = implode("', '", array_values($arr));
    try {
      $table = "INSERT INTO `$table` (`" . $keys . "`) VALUES ('" . $values . "')";
      $stmt  = $this->connection->prepare($table);
      $stmt->execute();
      echo 'success';
    } catch (\Exception $th) {
      echo $th->getMessage();
    }
  }

  static function closeConnection(&$connection)
  {
    return $connection = null;
  }
}
