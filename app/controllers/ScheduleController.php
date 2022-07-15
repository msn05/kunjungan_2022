<?php

use App\Controllers\Controller;
use Helper\ValidateUri;

class ScheduleController extends Controller
{
  public function index()
  {
    $model = $this->model('Schedule');
    $data['header'] = 'Jadwal Kunjungan';
    $table = $model->data(null, ['visit', 'facility']);
    if (!empty($table)) {
      $data['table'] = json_decode(json_encode($table));
      $data['visited']  = json_decode(json_encode($model->getVisited(null)));
    }
    $this->view('data_schedule', $data);
  }

  public function add()
  {
    if (@$_POST['results'])
      $params = [
        'visit_id'           => $_POST['visit_id'],
        'statuses_visit'  => $_POST['statuses_visit'],
        'date_expired'    => $_POST['date_expired'],
        'results'         => $_POST['results']
      ];
    else
      $params = [
        'visit_id'           => $_POST['visit_id'],
        'statuses_visit'  => $_POST['statuses_visit'],
        'date_expired'    => $_POST['date_expired']
      ];

    $validate         = ValidateUri::checkParams(...$params);
    if (!$validate)   $this->flash(['warning', 'Data tidak sesuai dengan format.!'], 'schedule');
    else {
      $insert =   $this->model('Schedule')->insert($params);
      if ($insert) $this->flash(['success', 'Berhasil menambahkan data.!'], 'schedule');
      else $this->flash(['danger', 'Gagal menambahkan data baru.!'], 'schedule');
    }
  }

  public function show($id)
  {
    $data['header'] = 'Informasi Jadwal Kunjungan';
    $data['table'] = $this->model('Schedule')->data($id, ['visit', 'facility'], 'all');
    $this->view('data_schedule.info', $data);
  }

  public function update($id)
  {
    if (@$_POST['results'])
      $params = [
        'statuses_visit'  => $_POST['statuses_visit'],
        'date_expired'    => $_POST['date_expired'],
        'results'         => $_POST['results']
      ];
    else
      $params = [
        'statuses_visit'  => $_POST['statuses_visit'],
        'date_expired'    => $_POST['date_expired']
      ];
    $validate = ValidateUri::checkParams(...$params);
    if (!$validate)   $this->flash(['warning', 'Data tidak sesuai dengan format.!'], 'schedule');
    else {
      $update = $this->model('Schedule')->update($id, $params);
      if ($update) {
        $this->flash(['success', 'Berhasil mengubah data.!'], 'schedule');
      } else
        $this->flash(['danger', 'Data tidak valid.!'], 'schedule');
    }
  }
}
