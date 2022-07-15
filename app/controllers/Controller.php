<?php

namespace App\Controllers;

use Helper\View;
use Core\Message;

class Controller
{
  use View;

  public function flash($response, $header = null)
  {
    new Message($response);
    header('Location:' . Controller . $header);
  }
}

  // public function insert($table, $arr)
  // {
  //   return parent::insert($table, $arr);
  // }

  // public function data($table, $id = null, $join = null)
  // {
  //   return parent::getData($table, $id, $join);
  // }

  // public function delete($table, $id)
  // {
  //   return parent::trash($table, $id);
