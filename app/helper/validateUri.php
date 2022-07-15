<?php

namespace Helper;

trait ValidateUri
{
  private static string $string   = '^[a-zA-Z]';
  private static string $post     = '/[^\=\&\>\*\#]$/';
  static function CheckString(string $val)
  {
    $check = preg_match('/' . self::$string . '/', $val, $data);
    if ($check) {
      return $val;
    } else {
      // return alert('Tidak Valid.!');
      // $this->message()
      return 'Tidak valid.!';
    }
  }

  static function validEmail(string $val): bool
  {
    if (!filter_var($val, FILTER_VALIDATE_EMAIL)) return false;
    return true;
  }
  // static function CheckInputString(string $val): string
  // {
  //   $check = preg_match_all('/' . self::$string . '+$/', $val, $data);
  //   if ($check) {
  //     return $val;
  //   }
  // }

  static function checkPostInt($val)
  {
    $check = preg_grep('/^[0-9]/', $val);
    if (count($check) < count($val)) {
      echo 'inputan ada yang salah';
    } else {
      return $val;
    }
  }

  static function checkPost($val)
  {
    $check = preg_grep(self::$post, $val);
    if (count($check) < count($val)) {
      echo 'inputan ada yang salah';
    } else {
      return $val;
    }
  }

  static function checkParams(...$val): bool
  {
    $check = preg_grep(self::$post, array_values($val));
    if (count($check) < count($val)) {
      return false;
    } else {
      return true;
    }
  }
}
