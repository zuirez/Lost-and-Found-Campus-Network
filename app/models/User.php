<?php

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Register user
    public function register($data) {
        $sql = "INSERT INTO users (name, student_id, email, password, role) VALUES (:name, :student_id, :email, :password, :role)";
        $stmt = $this->db->prepare($sql);
        
        // Bind values
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':student_id', $data['student_id']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':role', $data['role']);

        // Execute
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Login user (email or student_id)
    public function login($identifier, $password) {
        $sql = "SELECT * FROM users WHERE email = :email OR student_id = :student_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $identifier);
        $stmt->bindParam(':student_id', $identifier);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        if ($row) {
            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password)) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Find user by email
    public function findUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Find user by student id
    public function findUserByStudentId($student_id) {
        $sql = "SELECT * FROM users WHERE student_id = :student_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Find user by email or student id
    public function findUserByEmailOrId($identifier) {
        $sql = "SELECT * FROM users WHERE email = :email OR student_id = :student_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $identifier);
        $stmt->bindParam(':student_id', $identifier);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Get a user by their ID
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Change user password
    public function changePassword($id, $hashed_password) {
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
