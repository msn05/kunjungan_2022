<?php

namespace Core;

use Helper\ValidateUri;

trait Controller
{
  public static $controller = 'HomeController';
  public static string $method     = 'index';
  public static array $params      = [];
  public static function index($uri)
  {

    // if (ValidateUri::CheckString($uri[0])) {
    $class = '../app/controllers/' . ucwords($uri[0]) . 'Controller.php';
    if (file_exists($class)) {
      self::$controller = ucwords($uri[0] . 'Controller');
      unset($uri[0]);
    }
    require_once __DIR__ . '/../app/controllers/' . self::$controller . '.php';
    if (class_exists(self::$controller))
      self::$controller = new self::$controller;
    // }
    if (@$uri[1]) {
      // if (ValidateUri::CheckString($uri[1])) {
      self::$method = $uri[1];
      if (method_exists(self::$controller, self::$method))
        unset($uri[1]);
    }
    // }
    if (!empty($uri))
      self::$params = array_values($uri);
  }
}
