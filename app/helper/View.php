<?php

namespace Helper;


trait View
{

  public function view(string $view, ?array $data = [])
  {
    $path = '/../app/views/';
    $view = explode(".", $view);
    if (count($view) == 1) {
      if ($view[0] == 'login')
        require __DIR__ . ('/../' . $path . '/login.php');
      if ($view[0] == 'home') {
        require __DIR__ . ('/../' . $path . 'template' . '/header.php');
        require __DIR__ . ('/../' . $path . '/home.php');
        require __DIR__ . ('/../' . $path . 'template' . '/footer.php');
      } else if (file_exists('.' . $path . $view[0])) {
        require __DIR__ . ('/../' . $path . 'template' . '/header.php');
        require_once __DIR__ . ('/../' . $path . $view[0] . '/index.php');
        require __DIR__ . ('/../' . $path . 'template' . '/footer.php');
      } else
        http_response_code(401);
    } else {
      if (file_exists('.' . $path . $view[0])) {
        require __DIR__ . ('/../' . $path . 'template' . '/header.php');
        require_once __DIR__ . ('/../' . $path . $view[0] . '/' . $view[1] . '.php');
        require __DIR__ . ('/../' . $path . 'template' . '/footer.php');
      } else
        http_response_code(401);
    }
  }

  public function model(string $class)
  {
    $path = '/../app/models/';
    $typeFile = file_exists('.' . $path . $class . '.php');
    $typeFolder = file_exists('.' . $path . $class . '/' . $class . '.php');
    if (!$typeFile)
      http_response_code(401);
    else require __DIR__ . ('/../' . $path . $class . '.php');
    if (!$typeFolder)
      http_response_code(401);
    else require __DIR__ . ('/../' . $path . $class . $class . '.php');
    return new $class;
  }
}
