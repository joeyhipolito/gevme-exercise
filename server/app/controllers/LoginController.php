<?php

class LoginController {

  private $model;

  public function __construct($model) {
    $this->model = $model;
  }

  public function post() {

    $json = file_get_contents('php://input');
    $obj = json_decode($json);
    $username = $obj->username;
    echo json_encode($this->_createUserIfNotExist($username));
  }

  private function _createUserIfNotExist($username) {
    $this->model->createIfNotExist($username);
    $user = $this->model->findByUsername($username);
    return $user;
  }

}