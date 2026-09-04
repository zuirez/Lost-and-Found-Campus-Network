<?php

class Post {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Get all posts (with user details)
    public function getPosts() {
        $sql = "SELECT posts.*, users.name, users.student_id, users.role 
                FROM posts 
                INNER JOIN users ON posts.user_id = users.id 
                ORDER BY posts.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get posts by type (Lost or Found)
    public function getPostsByType($type) {
        $sql = "SELECT posts.*, users.name, users.student_id, users.role 
                FROM posts 
                INNER JOIN users ON posts.user_id = users.id 
                WHERE posts.type = :type 
                ORDER BY posts.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single post by ID
    public function getPostById($id) {
        $sql = "SELECT posts.*, users.name, users.student_id, users.role 
                FROM posts 
                INNER JOIN users ON posts.user_id = users.id 
                WHERE posts.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Add a new post
    public function addPost($data) {
        $sql = "INSERT INTO posts (user_id, type, title, description, category, location, image_path, status) 
                VALUES (:user_id, :type, :title, :description, :category, :location, :image_path, :status)";
        
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':category', $data['category']);
        $stmt->bindParam(':location', $data['location']);
        $stmt->bindParam(':image_path', $data['image_path']);
        $stmt->bindParam(':status', $data['status']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
