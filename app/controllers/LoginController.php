<?php

use App\Controllers\Controller;
use Helper\ValidateUri;

class LoginController extends Controller
{
  public function index()
  {
    if (@$_SESSION['account']['isLogin'] == true) header('Location:' . Controller . 'home');
    else {
      $data['header'] = 'Login System';
      $this->view('login', $data);
    }
  }

  public function errorLogin()
  {
    $this->flash(['danger', ['Data tidak valid.!', 'Value tidak sesuai.!']]);
    header('Location: ' . Controller . '/');
  }

  public function login()
  {
    $errors = [['danger', ['Data tidak valid.!', 'Value tidak sesuai.!']]];
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
      $email    = ValidateUri::validEmail($_POST['email']);
      $password = $_POST['password'];
      $checkAccount = $this->model('User')->data($_POST['email']);
      if ($checkAccount) {
        $matchPassword = password_verify($password, $checkAccount->password);
        if ($matchPassword) {
          session_start();
          $_SESSION['account'] = [
            'users_id'  => $checkAccount->id,
            'name'      => $checkAccount->full_name ?? $checkAccount->emaii,
            'isLogin'   => true,
            'Case'      => $checkAccount->access
          ];
          $this->flash(['success', 'Berhasil login sistem.!!'], 'home');
          header('Location:' . Controller . 'home');
        } else $this->errorLogin();
      } else $this->errorLogin();
    } else {
      $this->errorLogin();
    }
    // header('Location: ' . Controller . '/');
  }

  public function logout()
  {
    unset($_SESSION['account']);
    $this->flash(['success', 'Berhasil Keluar']);
    header('Location: ' . Controller);
  }
}
