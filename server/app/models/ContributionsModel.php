<?php

class ContributionsModel {

  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function findPostsByUserId($userId) {
    $query = 'SELECT posts.id, posts.body FROM posts' .
    ' JOIN contributions ON posts.id = contributions.post_id' .
    ' WHERE contributions.user_id = :user_id';
    $bind = array(':user_id' => $userId);
    return $this->db->fetch($query, $bind);
  }

}