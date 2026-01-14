<?php
    require_once __DIR__ . '/../model/post.php';

    class PostController {
        private $postModel;

        public function __construct() {
            $post = new Post();
            $this->postModel = $post;
        }

        function createPost($userId) {
            $errors = '';
            $success = false;

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $content = trim($_POST["content"] ?? '');
                $content = htmlspecialchars($content);
                if(empty(trim($content))) {
                    $errors = 'Le contenu du post est vide';
                }

                elseif (strlen($content) > 5000) {
                    $errors = 'Le contenu du post est trop long';
                }

                if(empty($errors)) {
                    $result = $this->postModel->create($userId, $content);
                    if ($result) {
                        $success = true;
                    }
                    else {
                        $errors = 'Une erreur est survenue';
                    }

                }
            }
            return ['errors' => $errors, 'success' => $success];
        }

        public function getPosts() {
            return $this->postModel->getAllPosts();
        }
    }


?>
