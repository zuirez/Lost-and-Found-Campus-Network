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

    // Get all posts by a specific user
    public function getPostsByUserId($user_id) {
        $sql = "SELECT posts.*, users.name, users.student_id
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                WHERE posts.user_id = :user_id
                ORDER BY posts.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Update a post
    public function updatePost($data) {
        $sql = "UPDATE posts SET type = :type, title = :title, description = :description, 
                category = :category, location = :location";
        if (!empty($data['image_path'])) {
            $sql .= ", image_path = :image_path";
        }
        $sql .= " WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':category', $data['category']);
        $stmt->bindParam(':location', $data['location']);
        if (!empty($data['image_path'])) {
            $stmt->bindParam(':image_path', $data['image_path']);
        }
        return $stmt->execute();
    }

    // Delete a post
    public function deletePost($id) {
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // ── Admin methods ──────────────────────────────────────────

    // Count all posts
    public function countPosts() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM posts");
        return (int) $stmt->fetchColumn();
    }

    // Count posts by type (Lost / Found)
    public function countPostsByType($type) {
        $sql = "SELECT COUNT(*) FROM posts WHERE type = :type";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    // Count posts by status (active / resolved / closed)
    public function countPostsByStatus($status) {
        $sql = "SELECT COUNT(*) FROM posts WHERE status = :status";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    // Get most recent posts (with user name)
    public function getRecentPosts($limit = 5) {
        $sql = "SELECT posts.*, users.name, users.student_id
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                ORDER BY posts.created_at DESC
                LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Update post status (active / resolved / closed)
    public function updatePostStatus($id, $status) {
        $sql = "UPDATE posts SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
