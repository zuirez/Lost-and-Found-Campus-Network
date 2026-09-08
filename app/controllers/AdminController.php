<?php
require_once APP_ROOT . '/app/models/User.php';
require_once APP_ROOT . '/app/models/Post.php';

class AdminController {

    private $userModel;
    private $postModel;

    public function __construct() {
        $this->userModel = new User();
        $this->postModel = new Post();
    }

    // ── Guard: admin/security only ──────────────────────────────
    private function requireAdmin() {
        requireAuth();
        $allowed = ['admin', 'security'];
        if (!in_array($_SESSION['user_role'] ?? '', $allowed)) {
            flash('admin_message', 'Access denied. Admins only.', 'error');
            header('location: ' . BASE_URL . '/');
            exit();
        }
    }

    // ── Dashboard ───────────────────────────────────────────────
    public function index() {
        $this->requireAdmin();

        $data = [
            'stats' => [
                'total_posts' => $this->postModel->countPosts(),
                'lost_posts'  => $this->postModel->countPostsByType('Lost'),
                'found_posts' => $this->postModel->countPostsByType('Found'),
                'total_users' => $this->userModel->countUsers(),
            ],
            'recent_posts' => $this->postModel->getRecentPosts(5),
            'recent_users' => $this->userModel->getRecentUsers(5),
        ];

        require_once APP_ROOT . '/app/views/admin/dashboard.php';
    }

    // ── Users List ──────────────────────────────────────────────
    public function users() {
        $this->requireAdmin();

        $data = [
            'users' => $this->userModel->getAllUsers(),
        ];

        require_once APP_ROOT . '/app/views/admin/users.php';
    }

    // ── Delete User ─────────────────────────────────────────────
    public function delete_user($id) {
        $this->requireAdmin();

        // Prevent self-deletion
        if ($id == $_SESSION['user_id']) {
            flash('admin_message', 'You cannot delete your own account.', 'error');
            header('location: ' . BASE_URL . '/admin/users');
            exit();
        }

        if ($this->userModel->deleteUser($id)) {
            flash('admin_message', 'User deleted successfully.', 'success');
        } else {
            flash('admin_message', 'Could not delete user.', 'error');
        }

        header('location: ' . BASE_URL . '/admin/users');
    }

    // ── Update User Role ────────────────────────────────────────
    public function update_role($id) {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role = trim($_POST['role'] ?? '');
            $allowed = ['student', 'admin', 'security'];

            if (!in_array($role, $allowed)) {
                flash('admin_message', 'Invalid role selected.', 'error');
            } elseif ($id == $_SESSION['user_id']) {
                flash('admin_message', 'You cannot change your own role here.', 'warning');
            } else {
                if ($this->userModel->updateUserRole($id, $role)) {
                    flash('admin_message', 'User role updated.', 'success');
                } else {
                    flash('admin_message', 'Could not update role.', 'error');
                }
            }
        }

        header('location: ' . BASE_URL . '/admin/users');
    }

    // ── Posts List ──────────────────────────────────────────────
    public function posts() {
        $this->requireAdmin();

        $data = [
            'posts' => $this->postModel->getPosts(),
        ];

        require_once APP_ROOT . '/app/views/admin/posts.php';
    }

    // ── Delete Post (admin) ─────────────────────────────────────
    public function delete_post($id) {
        $this->requireAdmin();

        $post = $this->postModel->getPostById($id);
        if ($post && $post->image_path && file_exists(APP_ROOT . $post->image_path)) {
            unlink(APP_ROOT . $post->image_path);
        }

        if ($this->postModel->deletePost($id)) {
            flash('admin_message', 'Post deleted.', 'success');
        } else {
            flash('admin_message', 'Could not delete post.', 'error');
        }

        header('location: ' . BASE_URL . '/admin/posts');
    }

    // ── Update Post Status ──────────────────────────────────────
    public function update_status($id) {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status  = trim($_POST['status'] ?? '');
            $allowed = ['active', 'resolved', 'closed'];

            if (in_array($status, $allowed)) {
                $this->postModel->updatePostStatus($id, $status);
                flash('admin_message', 'Post status updated.', 'success');
            } else {
                flash('admin_message', 'Invalid status.', 'error');
            }
        }

        header('location: ' . BASE_URL . '/admin/posts');
    }

    // ── Settings (placeholder) ──────────────────────────────────
    public function settings() {
        $this->requireAdmin();
        require_once APP_ROOT . '/app/views/admin/settings.php';
    }
}
