<?php
error_reporting(0);

use Config\Connection;

class Schedule
{
  protected $table = 'schedule';
  protected $columns = ['id as idJ', 'visit_id', 'statuses_visit', 'date_expired', 'results'];
  protected $class;

  public function __construct()
  {
    $this->class = new Connection;
  }

  public function data($id = null, $join = null, $table = null)
  {
    if (!is_null($table)) {
      $visited = $this->class->getData($this->table, $id ?? null, $join, null, 'counted');
      // var_dump($visited);
      // die();
      if (!is_object($visited)) {
        foreach ($visited as $key => $value) {
          $facility[] = $this->class->getData('facility', $value->visit_id, null, [0, 'visit_id']);
        }
      } else {
        $facility = $this->class->getData('facility', $visited->visit_id, null, [0, 'visit_id']);
      }
      // echo '<pre>';
      // print_r($facility);
      // die();
      if (is_object($facility)) $facility = [$facility];
      $data = [$visited,  $facility];
    } else
      $data = $this->class->getData($this->table, $id ?? null, $join, null, 'counted');
    if (is_object($data)) $data = [$data];
    else $data;
    // echo '<pre>';
    // print_r($data);
    // die();
    return $data;
  }

  public function getVisited()
  {
    $data = [];
    $schedule = $this->class->getData($this->table, null);
    if (empty($schedule)) {
      $visitId = $this->class->getData('visit', null);
      if (is_object($visitId)) $visitId = [$visitId];
      return $visitId;
    }
    if (is_object($schedule)) $schedule = [$schedule];
    else $schedule = $schedule;
    // $visited = [];
    foreach ($schedule as $key => $value) {
      $visited[] = $value->visit_id;
    }
    $params = implode(",", array_values($visited));
    $visitId = $this->class->getNotData('visit', "$params", ['id', 'destination']);
    if (is_object($visitId)) $visitId = [$visitId];
    else $visitId = $visitId;
    return $visitId;
  }

  public function insert($params)
  {
    $checkData = $this->class->getData($this->table, $params, null);
    if (!(bool) $checkData) {
      return $this->class->insert($this->table, $params);
    } else {
      return false;
    }
  }

  public function update($checked, $params)
  {
    $oldData = $this->class->getData($this->table, $checked);
    if (!$oldData) return false;
    else
      return $this->class->updated($this->table, $oldData->id, $params);
  }
}
