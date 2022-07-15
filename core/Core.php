<?php

namespace Core;

use Helper\ValidateUri;
use Core\Controller;

class Core
{

  use Controller;
  use ValidateUri;

  public function __construct()
  {
    $url = self::parseUrl();
    Controller::index($url);
    call_user_func_array([Controller::$controller, Controller::$method], Controller::$params);
  }

  public static function parseUrl()
  {
    if (@$_SERVER['PATH_INFO'])
      $uri = parse_url($_SERVER['PATH_INFO']);
    if (@$_GET['url']) {
      $uri = $_GET['url'];
      $uri = rtrim($uri, "/");
      $uri = filter_var($uri, FILTER_SANITIZE_URL);
      $uri = ValidateUri::CheckString($uri);
    } else $uri = 'login';
    // $uri = ["path" => '/' . self::$controller . '/' . self::$method];
    $uri = explode('/', "$uri");
    return $uri;
  }

  protected function model(string $val)
  {
    $path = '/../app/model/';
    if (file_exists('.' . $path . $val . '.php')) {
      require_once __DIR__ . ($path . $val . '.php');
      return new $val;
      // var_dump(class)
    }
  }



  // static function reloads($page)
  // {
  //   return header("Refresh:0; /public/$page");
  // }
}
