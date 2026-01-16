<?php
    require_once __DIR__ . '/../db/database.php';
    class Like {
        private $db;

        public function __construct() {
            $database = Database::getInstance();
            $this->db = $database->getConnection();


        }

        public function addLike($userId, $postId) {
            try {
                $sql = "INSERT INTO likes (user_id, post_id) VALUES (?, ?)";
                $stmt = $this->db->prepare($sql);
                $result = $stmt->execute([$userId, $postId]);
                return $result;
            } catch (PDOException $e) {
                return false;
            }

        }

        public function removeLike($userId, $postId) {
            try {
                $sql = "DELETE FROM likes WHERE user_id = ? AND post_id = ?";
                $stmt = $this->db->prepare($sql);
                $result = $stmt->execute([$userId, $postId]);
                return $result;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function hasLiked($userId, $postId) {
            $sql = "SELECT COUNT(*) FROM likes WHERE user_id = ? AND post_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$userId, $postId]);
            $count = $stmt->fetchColumn();

            if($count > 0){
                return true;
            } else {
                return false;
            }

        }

        public function getLikesCount($postId) {
            $sql = "SELECT COUNT(*) FROM likes WHERE post_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$postId]);
            $count = $stmt->fetchColumn();
            return $count;
        }
    }