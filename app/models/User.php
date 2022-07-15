<?php

use Config\Connection;

class User
{
  protected $table = 'users';
  protected $columns = ['id', 'username', 'full_name', 'password', 'access', 'statuses'];
  protected $class;

  public function __construct()
  {
    $this->class = new Connection;
  }

  public function data($id = null)
  {
    return $this->class->getData($this->table, $id, null, $this->columns);
  }
}
