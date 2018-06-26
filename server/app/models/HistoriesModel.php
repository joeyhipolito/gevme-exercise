<?php

class HistoriesModel {

  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function findOne($id) {
    $query = "SELECT * FROM history WHERE id = :id";
    $bind = array(':id' => $id);
    return $this->db->fetch($query, $bind);
  }

  public function findAll() {
    $query = "SELECT * FROM history";
    return $this->db->fetchAll($query);
  }

  public function findPostsByUserId($userId) {
    $query = 'SELECT * FROM history WHERE user_id = :user_id';
    $bind = array(':user_id' => $userId);
    return $this->db->fetchAll($query, $bind);
  }

  public function findPostsByPostId($userId) {
    $query = 'SELECT * FROM history WHERE post_id = :post_id';
    $bind = array(':post_id' => $userId);
    return $this->db->fetchAll($query, $bind);
  }

}