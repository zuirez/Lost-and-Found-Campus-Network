<?php

class PostsController {
    private $postModel;
    private $commentModel;

    public function __construct() {
        require_once APP_ROOT . '/app/models/Post.php';
        require_once APP_ROOT . '/app/models/Comment.php';
        $this->postModel = new Post();
        $this->commentModel = new Comment();
    }

    public function index() {
        $posts = $this->postModel->getPosts();
        $data = ['posts' => $posts, 'title' => 'Recent Reports', 'is_home' => true];
        require_once APP_ROOT . '/app/views/posts/index.php';
    }

    public function lost() {
        $posts = $this->postModel->getPostsByType('Lost');
        $data = ['posts' => $posts, 'title' => 'Lost Items'];
        require_once APP_ROOT . '/app/views/posts/index.php';
    }

    public function found() {
        $posts = $this->postModel->getPostsByType('Found');
        $data = ['posts' => $posts, 'title' => 'Found Items'];
        require_once APP_ROOT . '/app/views/posts/index.php';
    }

    public function create() {
        requireAuth(); // Guard

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'type' => trim($_POST['type']), // Lost or Found
                'category' => trim($_POST['category']),
                'location' => trim($_POST['location']),
                'description' => trim($_POST['description']),
                'image_path' => null,
                'status' => 'active',
                'title_err' => '',
                'description_err' => '',
                'location_err' => ''
            ];

            // Validation
            if (empty($data['title'])) $data['title_err'] = 'Please enter a title';
            if (empty($data['description'])) $data['description_err'] = 'Please enter a description';
            if (empty($data['location'])) $data['location_err'] = 'Please enter a location';

            // Handle File Upload (Optional)
            if (!empty($_FILES['image']['name'])) {
                $folder_name = $_SESSION['student_id'] ?? $_SESSION['user_id'];
                $target_dir = APP_ROOT . "/public/uploads/" . $data['type'] . "/" . $folder_name . "/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $new_filename = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $new_filename;

                $allowed_types = ['jpg', 'jpeg', 'png', 'webp'];
                if (in_array($file_extension, $allowed_types)) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                        // Store relative path in DB
                        $data['image_path'] = "/public/uploads/" . $data['type'] . "/" . $folder_name . "/" . $new_filename;
                    }
                } else {
                    $data['title_err'] = "Invalid image format. Only JPG, PNG, WEBP allowed.";
                }
            }

            // Make sure no errors
            if (empty($data['title_err']) && empty($data['description_err']) && empty($data['location_err'])) {
                if ($this->postModel->addPost($data)) {
                    flash('post_message', 'Item posted successfully');
                    header('location: ' . BASE_URL . '/posts/' . strtolower($data['type']));
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                require_once APP_ROOT . '/app/views/posts/create.php';
            }

        } else {
            $data = [
                'title' => '',
                'type' => 'Lost',
                'category' => 'Electronics',
                'location' => '',
                'description' => ''
            ];
            require_once APP_ROOT . '/app/views/posts/create.php';
        }
    }

    public function show($id) {
        $post = $this->postModel->getPostById($id);
        if (!$post) {
            header('location: ' . BASE_URL . '/');
            exit();
        }

        $comments = $this->commentModel->getCommentsByPostId($id);
        
        $data = [
            'post' => $post,
            'comments' => $comments
        ];

        require_once APP_ROOT . '/app/views/posts/show.php';
    }

    public function comment($post_id) {
        requireAuth();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'post_id' => $post_id,
                'user_id' => $_SESSION['user_id'],
                'body' => trim($_POST['body'])
            ];

            if (!empty($data['body'])) {
                if ($this->commentModel->addComment($data)) {
                    flash('post_message', 'Comment added');
                }
            }
            
            header('location: ' . BASE_URL . '/posts/show/' . $post_id);
        }
    }

    public function edit_comment($id) {
        requireAuth();

        $comment = $this->commentModel->getCommentById($id);

        if (!$comment || $comment->user_id != $_SESSION['user_id']) {
            header('location: ' . BASE_URL . '/posts');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'post_id' => $comment->post_id,
                'body' => trim($_POST['body']),
                'body_err' => ''
            ];

            if (empty($data['body'])) {
                $data['body_err'] = 'Comment cannot be empty';
            }

            if (empty($data['body_err'])) {
                if ($this->commentModel->updateComment($data)) {
                    flash('post_message', 'Comment updated');
                    header('location: ' . BASE_URL . '/posts/show/' . $comment->post_id);
                } else {
                    die('Something went wrong');
                }
            } else {
                require_once APP_ROOT . '/app/views/posts/edit_comment.php';
            }
        } else {
            $data = [
                'id' => $id,
                'post_id' => $comment->post_id,
                'body' => $comment->body,
                'body_err' => ''
            ];

            require_once APP_ROOT . '/app/views/posts/edit_comment.php';
        }
    }

    public function delete_comment($id) {
        requireAuth();

        $comment = $this->commentModel->getCommentById($id);

        if (!$comment || $comment->user_id != $_SESSION['user_id']) {
            header('location: ' . BASE_URL . '/posts');
            exit();
        }

        $post_id = $comment->post_id;

        if ($this->commentModel->deleteComment($id)) {
            flash('post_message', 'Comment deleted');
        } else {
            die('Something went wrong');
        }

        header('location: ' . BASE_URL . '/posts/show/' . $post_id);
    }
}
