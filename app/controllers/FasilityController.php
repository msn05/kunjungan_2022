<?php

use App\Controllers\Controller;
use Helper\ValidateUri;

class FasilityController extends Controller
{
  public function index()
  {
    $data['header'] = 'Fasilitas';
    $table = $this->model('Facility')->data(null);

    if (!empty($table)) {
      if (is_object($table)) {
        $data['table'] = [$table];
      } else {
        $data['table']  = $table;
      }
    }
    $this->view('data_fasility', $data);
  }

  public function add()
  {
    $params = [
      'visit_id'  => $_POST['id'],
      'name'  => $_POST['name']
    ];
    $validate = ValidateUri::checkParams(...$params);
    if (!$validate)   $this->flash(['warning', 'Data tidak sesuai dengan format.!'], 'fasility');
    else {
      $insert = $this->model('Facility')->insert($params);
      if ($insert)
        $this->flash(['success', 'Berhasil menambahkan data.!'], 'fasility');
      else
        $this->flash(['danger', 'Data sudah ada.!'], 'fasility');
    }
  }

  public function update()
  {
    $params = [
      'visit_id'  => $_POST['id'],
      'name'  => $_POST['name']
    ];
    $validate = ValidateUri::checkParams(...$params);
    if (!$validate)   $this->flash(['warning', 'Data tidak sesuai dengan format.!'], 'fasility');
    else {
      $update = $this->model('Facility')->update(['visit_id' => $_POST['id'], 'name' => $_POST['old_name']], $params);
      if ($update) {
        // $update =   $this->model('Facility')->update($checkOldData->id, $params);
        $this->flash(['success', 'Berhasil mengubah data.!'], 'fasility');
      } else
        // if ($update)
        // else
        $this->flash(['danger', 'Data tidak valid.!'], 'fasility');
    }
  }
}
