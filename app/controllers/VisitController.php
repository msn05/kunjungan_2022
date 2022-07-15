<?php

use App\Controllers\Controller;
use Helper\ValidateUri;

class VisitController extends Controller
{
  public function index()
  {
    $data['header'] = 'Data Kunjungan';
    $table = $this->model('Visit')->data(null, 'users');
    if (is_object($table)) {
      $data['table'] = [$table];
    } else {
      $data['table']  = $table;
    }
    $this->view('data_kunjungan', $data);
  }

  public function update($id)
  {
    $params = [
      'name_employee'           => $_POST['name_employee'],
      'date_visit'              => $_POST['date_visit'],
      'destination'             => $_POST['destination'],
      'totals_follow_employee'  => $_POST['totals_follow_employee'],
      'necessity'               => $_POST['necessity']
    ];
    $validate         = ValidateUri::checkParams(...$params);
    if (!$validate)   $this->flash(['warning', 'Data tidak sesuai dengan format.!'], 'visit');
    else {
      $update =   $this->model('Visit')->update($id, $params);
      if ($update) $this->flash(['success', 'Data berhasil diupdate.!'], 'visit');
      else $this->flash(['danger', 'Data gagal diupdate.!'], 'visit');
    }
  }

  public function add()
  {
    $params = [
      'name_employee'           => $_POST['name_employee'],
      'date_visit'              => $_POST['date_visit'],
      'destination'             => $_POST['destination'],
      'totals_follow_employee'  => $_POST['totals_follow_employee'],
      'necessity'               => $_POST['necessity']
    ];
    $validate         = ValidateUri::checkParams(...$params);
    if (!$validate)   $this->flash(['warning', 'Data tidak sesuai dengan format.!'], 'visit');
    else {
      $insert = $this->model('Visit')->insert($params);
      if ($insert)
        $this->flash(['success', 'Berhasil menambahkan data.!'], 'visit');
      else
        $this->flash(['danger', 'Data sudah ada.!'], 'visit');
    }
  }

  public function delete($id)
  {
    $model = $this->model('Visit');
    if (!empty($id)) {
      $delete = $model->delete($id);
      if ($delete)
        $this->flash(['success', 'Berhasil menghapus data.!'], 'visit');
      else
        $this->flash(['danger', 'Gagal menghapus data.!!'], 'visit');
    }
  }
}
