<?php

namespace Core;

class Route
{
  private $handlers = [];
  private const METHOD = ['GET', 'POST', 'DELETE'];
  // public function _construct()
  // {
  //   var_dump($_GET);
  // }
  // public function get(string $path, $handler): void
  // {
  //   $this->addHandler(self::METHOD[0], $path, $handler);
  // }

  // public function post(string $path, $handler): void
  // {
  //   $this->addHandler(self::METHOD[1], $path, $handler);
  // }

  // public function delete(string $path, $handler): void
  // {
  //   $this->addHandler(self::METHOD[2], $path, $handler);
  // }

  // public function addHandler(string $method, string $path, $handler): void
  // {
  //   $this->handlers[$method . $path] = [
  //     'path'    => $path,
  //     'method'  => $method,
  //     'handler' => $handler
  //   ];
  // }

  // public function run()
  // {
  //   $request = parse_url($_SERVER['REQUEST_URI']);
  //   $path    = $request['path'];
  //   var_dump($path);
  // }
}
