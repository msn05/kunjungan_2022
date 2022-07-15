<?php

namespace App\Controller;

use App\Controller\Controller;

class User extends Controller
{

  function index()
  {
    $data = [
      "header"  => 'User',
      "page"    => 'user'
    ];
    // $data['users']  = self::model('User_model')->getColumns();
    // $data['user'] = self::model('User_model')->getColumns(["id", 1]);
    self::view('user', $data);
  }
}
