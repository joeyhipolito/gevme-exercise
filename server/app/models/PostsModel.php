<?php

class PostsModel {

  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function findOne($id) {
    $conn = $this->db->getConnection();
    $conn->beginTransaction();
    $query = "SELECT * FROM posts WHERE id = :id";
    $bind = array(':id' => $id);
    $post = $this->db->fetch($query, $bind);
    $query = "SELECT id FROM history WHERE post_id = :post_id";
    $bind = array(':post_id' => $id);
    $histories = $this->db->fetchAll($query, $bind, PDO::FETCH_COLUMN);
    $conn->commit();
    $post['histories'] = array_map('intval', $histories);
    return $post;
  }

  public function findAll() {
    $query = "SELECT * FROM posts";
    return $this->db->fetchAll($query);
  }

  public function findPostsByUserId($userId) {
    $query = 'SELECT * FROM posts WHERE user_id = :user_id';
    $bind = array(':user_id' => $userId);
    return $this->db->fetchAll($query, $bind);
  }

  public function create($params) {
    $conn = $this->db->getConnection();
    $conn->beginTransaction();
    $query = 'INSERT INTO posts(body, user_id) VALUE(:body, :user_id)';
    $bind  = array(
      ':user_id' => $params['user_id'],
      ':body'    => $params['body']
    );
    $stmt = $conn->prepare($query);
    $stmt->execute($bind);
    $lastPostId = $conn->lastInsertID();
    $conn->commit();
    return $lastPostId > 0 ? $lastPostId : false;
  }

  public function update($id, $params) {
    $isOP = $this->_isOP($id, $params['user_id']);
    $post = $this->findOne($id);
    $body = $params['body'];
    $userId = $params['user_id'];
    $reason = $params['reason'];

    if ($post['body'] !== $body) {
      $conn = $this->db->getConnection();
      $conn->beginTransaction();
      $query = 'UPDATE posts SET body = :body WHERE id = :id';
      $bind  = array(
        ':id'   => $id,
        ':body' => $body
      );
      $stmt = $conn->prepare($query);
      $stmt->execute($bind);
      $result = $stmt->rowCount() > 0;
      if (!$isOP) {
        $query = 'INSERT INTO contributions(post_id, user_id) VALUE(:post_id, :user_id)';
        $bind  = array(
          ':post_id' => $id,
          ':user_id' => $userId
        );
        $stmt = $conn->prepare($query);
        $stmt->execute($bind);
      }
      $query = 'INSERT INTO history(diff, body, reason, post_id, user_id) VALUE(:diff, :body, :reason, :post_id, :user_id)';
      $bind = array(
        ':diff' => $post['body'],
        ':body' => $body,
        ':reason' => $reason,
        ':post_id' => $id,
        ':user_id' => $userId
      );
      $stmt = $conn->prepare($query);
      $stmt->execute($bind);
      $conn->commit();

      return $result;
    };

  }

  public function delete($id) {
    $query = 'DELETE FROM posts WHERE id = :id';
    $bind  = array(':id' => $id);
    return $this->db->query($query, $bind) ? true : false;
  }

  private function _isOP($postId, $userId) {
    $query = 'SELECT * FROM contributions WHERE user_id = :user_id AND post_id = :post_id';
    $bind = array(
      ':user_id' => $userId,
      ':post_id' => $postId
    );

    return $this->db->num_rows($query, $bind) > 0;
  }

}