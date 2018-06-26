<?php

class PostsController {

  private $model;

  public function __construct($model) {
    $this->model = $model;
  }

  public function index() {
    $userId = filter_input(INPUT_GET, 'userId', FILTER_SANITIZE_STRING);
    if (isset($userId)) {
      echo json_encode($this->model->findPostsByUserId($userId));
    } else {
      echo json_encode($this->model->findAll());
    }
  }
  public function get($id) {
    echo json_encode($this->model->findOne($id));
  }
  public function post() {

    $json = file_get_contents('php://input');
    $obj = json_decode($json);

    $userId = $obj->userId;
    $body   = $obj->body;
    $post = array(
      'user_id' => $userId,
      'body'    => $body
    );

    echo $this->model->create($post);
  }
  public function put($id) {


    $json = file_get_contents('php://input');
    $obj = json_decode($json);

    $userId = $obj->userId;
    $body   = $obj->body;
    $reason = isset($obj->reason) ? $obj->reason : '';

    $post  = array(
      'user_id' => $userId,
      'body'    => $body,
      'reason'  => $reason,
      'id'      => $id
    );

    echo $this->model->update($id, $post);
  }
  public function delete($id) {
    echo $this->model->delete($id);
  }
}