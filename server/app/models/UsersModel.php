<?php

class UsersModel {

  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function findOne($id) {
    $conn = $this->db->getConnection();
    $conn->beginTransaction();
    $query = "SELECT * FROM users WHERE id = :id";
    $bind = array(':id' => $id);
    $post = $this->db->fetch($query, $bind);
    $query = "SELECT id FROM posts WHERE user_id = :user_id";
    $bind = array(':user_id' => $id);
    $postIds = $this->db->fetchAll($query, $bind, PDO::FETCH_COLUMN);
    $conn->commit();
    $post['posts'] = array_map('intval', $postIds);
    return $post;
  }

  public function findAll() {
    $query = "SELECT * FROM users";
    return $this->db->fetchAll($query);
  }

  public function create($params) {
    $query = 'INSERT INTO users(username) VALUE(:username)';
    $bind  = array(
      ':username' => $params['username']
    );
    return $this->db->query($query, $bind) ? true : false;
  }

  public function update($id, $params) {
    $query = 'UPDATE users SET username = :username WHERE id = :id';
    $bind  = array(
      ':id'       => $id,
      ':username' => $params['username']
    );
    return $this->db->query($query, $bind) ? true : false;
  }

  public function delete($id) {
    $query = 'DELETE FROM users WHERE id = :id';
    $bind  = array(':id' => $id);
    return $this->db->query($query, $bind) ? true : false;
  }

}