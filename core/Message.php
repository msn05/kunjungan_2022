<?php

namespace Core;

class Message
{
  public function __construct($response)
  {
    $_SESSION['message'] = [
      'type'  => $response[0],
      'message' => $response[1]
    ];
    self::createMessage();
  }

  public static function createMessage()
  {
    if (@$_SESSION['message']) {
      $value = '';
      if (is_array($_SESSION['message']['message'])) {
        foreach ($_SESSION['message']['message'] as $key => $val) {
          $value .= $val . '<br>';
        }
      }
      if (is_string($_SESSION['message']['message'])) $value .= $_SESSION['message']['message'];
      echo '
          <div class="alert alert-' . $_SESSION['message']['type'] . '" role="alert">
          <span>' . $value . '</span>
          </div>
      ';
      // unset($_SESSION['message']);
    }
  }
}
