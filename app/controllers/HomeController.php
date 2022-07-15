<?php

use App\Controllers\Controller;

class HomeController extends Controller
{
  public function index()
  {
    if (@$_SESSION['account'] || empty($_SESSION['account'])) {
      $data['header'] = 'Dashboard';
      $this->view('home', $data);
      // } else {
      // header('Location:' . Controller . '/login');
    }
  }
}
