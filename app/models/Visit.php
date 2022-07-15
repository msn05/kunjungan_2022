<?php

use Config\Connection;

class Visit
{
  protected $table = 'visit';
  protected $columns = ['id as idJ', 'name_employee', 'date_visit', 'destination', 'totals_follow_employee', 'necessity'];
  protected $class;

  public function __construct()
  {
    $this->class = new Connection;
  }

  public function data($id = null, $join = null)
  {
    return $this->class->getData($this->table, $id, $join ?? null, $this->columns);
  }

  public function insert($params)
  {
    $checkData = $this->class->getData($this->table, $params['name_employee'], null, $this->columns);
    // var_dump((bool)$checkData);
    if (!(bool) $checkData) {
      $users_id = ['users_id' => $_SESSION['account']['users_id']];
      $params = array_merge($params, $users_id);
      return $this->class->insert($this->table, $params);
    } else {
      return false;
    }
  }

  public function update($id, $params)
  {
    return $this->class->updated($this->table, $id, $params);
  }

  public function delete($id)
  {
    return $this->class->trash($this->table, $id);
  }
}
