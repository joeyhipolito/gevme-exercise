<?php

class UsersController {

  private $model;

  public function __construct($model) {
    $this->model = $model;
  }

  public function index() {
    echo json_encode($this->model->findAll());
  }
  public function get($id) {
    echo json_encode($this->model->findOne($id));
  }
}