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



                $imagePath = null;
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
                    $maxSize = 5 * 1024 * 1024;

                    $fileType = $_FILES['image']['type'];
                    $fileSize = $_FILES['image']['size'];




                    if(!in_array($fileType, $allowedTypes)) {
                        $errors = 'Le format du fichier n\'est pas valide';
                    } elseif ($fileSize > $maxSize) {
                        $errors = 'La taille de l\'image est tres grande';
                    } else {
                        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                        $filename = uniqid('post', true) . '.' . $extension;
                        $imagePath = $uploadPath = __DIR__ . '/../../public/uploads/' . $filename;

                        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                            $imagePath = '/uploads/' . $filename;
                        } else {
                            $errors = 'Erreur lors de l\'upload de l\'image';
                        }
                    }
                }

                if(empty($errors)) {
                    $result = $this->postModel->create($userId, $content, $imagePath);
                    if ($result) {
                        $success = true;

                        header('Location: feed.php');
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
