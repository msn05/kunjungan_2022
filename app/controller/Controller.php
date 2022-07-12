<?php

namespace App\Controller;

use Config\Connection;

require_once __DIR__ . './../../vendor/autoload.php';

class Controller extends Connection
{
  public function insert($table, ...$arr)
  {
    return parent::insert($table, ...$arr);
  }

  public function data($table, $id = null)
  {
    return parent::getData($table, $id);
  }
}
