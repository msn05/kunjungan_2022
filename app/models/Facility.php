<?php

use Config\Connection;

class Facility
{
  protected $table    = 'facility';
  protected $columns  = ['id as idJ', 'visit_id', 'name'];
  protected $class;
  public function __construct()
  {
    $this->class = new Connection;
  }

  public function data()
  {
    $visit =  $this->class->getData('visit', null);
    if (is_object($visit)) $visit = [$visit];
    $data = [];
    foreach ($visit as $key => $value) {
      $facility = $this->class->getData($this->table, $value->id, null, $this->columns);
      if (is_object($facility)) $facility = [$facility];
      $data[] = ['id' => $value->id, 'destinantion' => $value->destination, 'date_visited' => $value->date_visit, 'necessity' => $value->necessity, 'facility' => $facility];
    }
    return $data;
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
    $oldData = $this->class->getData($this->table, $checked, null, null);
    if (!$oldData) return false;
    else
      return $this->class->updated($this->table, $oldData->id, $params);
  }
}
