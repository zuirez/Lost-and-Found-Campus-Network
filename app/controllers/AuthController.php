<?php

class AuthController {
    private $userModel;

    public function __construct() {
        require_once APP_ROOT . '/app/models/User.php';
        $this->userModel = new User();
    }

    public function register() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'student_id' => trim($_POST['student_id']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'role' => 'student',
                'profile_picture' => null,
                'name_err' => '',
                'student_id_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                // Check email exists
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }

            // Validate Student ID
            if (empty($data['student_id'])) {
                $data['student_id_err'] = 'Please enter student ID';
            } else {
                // Check student id exists
                if ($this->userModel->findUserByStudentId($data['student_id'])) {
                    $data['student_id_err'] = 'Student ID is already registered';
                }
            }

            // Validate Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['student_id_err'])) {
                // Validated
                
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Handle optional profile picture upload
                if (!empty($_FILES['profile_picture']['name'])) {
                    $student_folder = $data['student_id'];
                    $upload_dir = APP_ROOT . '/public/uploads/profile/' . $student_folder . '/';
                    if (!file_exists($upload_dir)) { mkdir($upload_dir, 0777, true); }
                    $ext = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));
                    $filename = uniqid('avatar_') . '.' . $ext;
                    if (in_array($ext, ['jpg','jpeg','png','webp','gif'])) {
                        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_dir . $filename)) {
                            $data['profile_picture'] = '/public/uploads/profile/' . $student_folder . '/' . $filename;
                        }
                    }
                }

                // Register User
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered and can log in');
                    header('location: ' . BASE_URL . '/login');
                } else {
                    die('Something went wrong');
                }

            } else {
                // Load view with errors
                require_once APP_ROOT . '/app/views/auth/register.php';
            }

        } else {
            // Init data for GET request
            $data = [
                'name' => '',
                'student_id' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'student_id_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load view
            require_once APP_ROOT . '/app/views/auth/register.php';
        }
    }

    public function login() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'identifier' => trim($_POST['identifier'] ?? ''),
                'password' => trim($_POST['password'] ?? ''),
                'identifier_err' => '',
                'password_err' => '',
            ];

            // Validate Identifier
            if (empty($data['identifier'])) {
                $data['identifier_err'] = 'Please enter email or student ID';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check for user
            if (empty($data['identifier_err']) && !$this->userModel->findUserByEmailOrId($data['identifier'])) {
                $data['identifier_err'] = 'No user found with that email or ID';
            }

            // Make sure errors are empty
            if (empty($data['identifier_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['identifier'], $data['password']);

                if ($loggedInUser) {
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';
                    require_once APP_ROOT . '/app/views/auth/login.php';
                }
            } else {
                // Load view with errors
                require_once APP_ROOT . '/app/views/auth/login.php';
            }

        } else {
            // Init data for GET request
            $data = [
                'identifier' => '',
                'password' => '',
                'identifier_err' => '',
                'password_err' => '',
            ];

            // Load view
            require_once APP_ROOT . '/app/views/auth/login.php';
        }
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_role'] = $user->role;
        $_SESSION['student_id'] = $user->student_id;
        $_SESSION['profile_picture'] = $user->profile_picture ?? null;
        header('location: ' . BASE_URL . '/');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        unset($_SESSION['student_id']);
        unset($_SESSION['profile_picture']);
        session_destroy();
        header('location: ' . BASE_URL . '/login');
    }
}
