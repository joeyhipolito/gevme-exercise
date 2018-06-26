<?php

class LoginModel {

  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function findByUsername($username) {
    $query = "SELECT * FROM users WHERE username = :username";
    $bind = array(':username' => $username);
    return $this->db->fetch($query, $bind);
  }

  public function createIfNotExist($username) {
    $query = 'INSERT INTO users (username) SELECT * FROM (SELECT :username) AS tmp' .
    ' WHERE NOT EXISTS (SELECT username FROM users WHERE username = :username) LIMIT 1';
    $bind = array(':username' => $username);
    return $this->db->query($query, $bind) ? true : false;
  }

}