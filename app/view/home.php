<?php

// require_once __DIR__ . '/../controller/controller.php';
require_once __DIR__ . './../../vendor/autoload.php';

use App\Controller\Controller;

$a = new Controller;

$arr = [
  'users_id'  => 12,
  'name_employee' => 'yuda',
  'date_visit'  => date('Y-m-d H:i:s'),
  'destination'    => 'Kamboja',
  'totals_follow_employee'  => 12,
  'necessity' => 'Ujian TA'
];
$a->insert('visit', ...$arr);
// print_r($a->data('users'));
// echo json_encode($a->data('users'), JSON_PRETTY_PRINT);
// echo json_encode($a->data('users'), JSON_PRETTY_PRINT);
