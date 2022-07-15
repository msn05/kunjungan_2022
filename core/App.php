<?php

namespace Core;

use Core\Core;

class App
{

  function __construct()
  {
    Core::parseUrl();
  }
}
