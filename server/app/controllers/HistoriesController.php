<?php

class HistoriesController {

  private $model;

  public function __construct($model) {
    $this->model = $model;
  }

  public function index() {
    $postId = filter_input(INPUT_GET, 'postId', FILTER_SANITIZE_STRING);
    if (isset($postId)) {
      echo json_encode($this->model->findPostsByPostId($postId));
    } else {
      echo json_encode($this->model->findAll());
    }
  }

  public function get($id) {
    echo json_encode($this->model->findOne($id));
  }
}