<?php
require_once APP_ROOT . '/app/models/User.php';
require_once APP_ROOT . '/app/models/Post.php';

class ProfileController {

    private $userModel;
    private $postModel;

    public function __construct() {
        $this->userModel = new User();
        $this->postModel = new Post();
    }

    // Main profile page - shows tabbed view
    public function index() {
        requireAuth();

        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $posts = $this->postModel->getPostsByUserId($_SESSION['user_id']);

        $data = [
            'user'  => $user,
            'posts' => $posts,
            'active_tab' => $_GET['tab'] ?? 'posts'
        ];

        require_once APP_ROOT . '/app/views/profile/index.php';
    }

    // Handle change password
    public function change_password() {
        requireAuth();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $current  = trim($_POST['current_password']);
            $new      = trim($_POST['new_password']);
            $confirm  = trim($_POST['confirm_password']);

            $user = $this->userModel->getUserById($_SESSION['user_id']);

            if (!password_verify($current, $user->password)) {
                flash('profile_message', 'Current password is incorrect.', 'error');
            } elseif ($new !== $confirm) {
                flash('profile_message', 'New passwords do not match.', 'error');
            } elseif (strlen($new) < 6) {
                flash('profile_message', 'Password must be at least 6 characters.', 'error');
            } else {
                $hashed = password_hash($new, PASSWORD_DEFAULT);
                if ($this->userModel->changePassword($_SESSION['user_id'], $hashed)) {
                    flash('profile_message', 'Password changed successfully!', 'success');
                } else {
                    flash('profile_message', 'Something went wrong. Please try again.', 'error');
                }
            }

            header('location: ' . BASE_URL . '/profile?tab=password');
        } else {
            header('location: ' . BASE_URL . '/profile');
        }
    }

    // Edit a post owned by the user
    public function edit_post($id) {
        requireAuth();

        $post = $this->postModel->getPostById($id);

        // Ownership check
        if (!$post || $post->user_id != $_SESSION['user_id']) {
            header('location: ' . BASE_URL . '/profile');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id'          => $id,
                'type'        => trim($_POST['type']),
                'title'       => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'category'    => trim($_POST['category']),
                'location'    => trim($_POST['location']),
                'image_path'  => '',
                // validation errors
                'title_err'       => '',
                'description_err' => '',
                'location_err'    => '',
            ];

            // Validate
            if (empty($data['title']))       { $data['title_err'] = 'Please enter a title'; }
            if (empty($data['description'])) { $data['description_err'] = 'Please add a description'; }
            if (empty($data['location']))    { $data['location_err'] = 'Please enter the location'; }

            // Handle optional image replace
            if (!empty($_FILES['image']['name'])) {
                $folder_name = $_SESSION['student_id'] ?? $_SESSION['user_id'];
                $target_dir  = APP_ROOT . "/public/uploads/" . $data['type'] . "/" . $folder_name . "/";
                if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }

                $ext      = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $filename = uniqid() . '.' . $ext;

                if (in_array($ext, ['jpg','jpeg','png','webp'])) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename)) {
                        // Delete old image if it exists
                        if ($post->image_path && file_exists(APP_ROOT . $post->image_path)) {
                            unlink(APP_ROOT . $post->image_path);
                        }
                        $data['image_path'] = "/public/uploads/" . $data['type'] . "/" . $folder_name . "/" . $filename;
                    }
                } else {
                    $data['title_err'] = 'Invalid image format. Only JPG, PNG, WEBP allowed.';
                }
            }

            if (empty($data['title_err']) && empty($data['description_err']) && empty($data['location_err'])) {
                if ($this->postModel->updatePost($data)) {
                    flash('profile_message', 'Post updated successfully!', 'success');
                    header('location: ' . BASE_URL . '/profile?tab=posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Merge post data with form data for re-render
                $data = array_merge((array) $post, $data);
                require_once APP_ROOT . '/app/views/profile/edit_post.php';
            }

        } else {
            $data = [
                'id'          => $post->id,
                'type'        => $post->type,
                'title'       => $post->title,
                'description' => $post->description,
                'category'    => $post->category,
                'location'    => $post->location,
                'image_path'  => $post->image_path,
                'title_err'       => '',
                'description_err' => '',
                'location_err'    => '',
            ];

            require_once APP_ROOT . '/app/views/profile/edit_post.php';
        }
    }

    // Delete a post owned by the user
    public function delete_post($id) {
        requireAuth();

        $post = $this->postModel->getPostById($id);

        // Ownership check
        if (!$post || $post->user_id != $_SESSION['user_id']) {
            header('location: ' . BASE_URL . '/profile');
            exit();
        }

        // Delete image file from disk
        if ($post->image_path && file_exists(APP_ROOT . $post->image_path)) {
            unlink(APP_ROOT . $post->image_path);
        }

        if ($this->postModel->deletePost($id)) {
            flash('profile_message', 'Post deleted successfully.', 'success');
        } else {
            flash('profile_message', 'Could not delete the post.', 'error');
        }

        header('location: ' . BASE_URL . '/profile?tab=posts');
    }
}
