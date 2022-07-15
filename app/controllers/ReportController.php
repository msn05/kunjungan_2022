<?php

use App\Controllers\Controller;
use Helper\ValidateUri;

class ReportController extends Controller
{
  public function index()
  {
    if (@$_SESSION['account']['isLogin'] || empty(@$_SESSION['account'])) {
      $data['header'] = 'Report Kunjungan';
      $table = $this->model('Schedule')->data(null, ['visit', 'facility'], 'all');
      if (is_object($table[0])) $tables[] = [$table[0], $table[1]];
      else {
        foreach ($table[0] as $key => $value) {
          $tables[] = [$value, $table[1][$key]];
        }
      }
      $data['table'] = $tables;
      $this->view('hasil_kunjungan', $data);
    }
  }
}
