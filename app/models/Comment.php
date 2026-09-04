<?php

class Comment {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Get comments for a specific post
    public function getCommentsByPostId($post_id) {
        $sql = "SELECT comments.*, users.name, users.role 
                FROM comments 
                INNER JOIN users ON comments.user_id = users.id 
                WHERE comments.post_id = :post_id 
                ORDER BY comments.created_at ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Add a comment
    public function addComment($data) {
        $sql = "INSERT INTO comments (post_id, user_id, body) VALUES (:post_id, :user_id, :body)";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindParam(':post_id', $data['post_id']);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':body', $data['body']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
