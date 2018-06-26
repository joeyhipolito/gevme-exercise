<?php

class ContributionsController {

  private $model;

  public function __construct($model) {
    $this->model = $model;
  }

  public function index() {
    $userId = filter_input(INPUT_GET, 'userId', FILTER_SANITIZE_STRING);
    echo json_encode($this->model->findPostsByUserId($userId));
  }
}