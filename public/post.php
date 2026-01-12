<?php
    require_once __DIR__. '/../app/db/database.php';
class Post {
        private $db;
        public function __construct() {
            $database = Database::getInstance();
            $this->db = $database->getConnection();


        }
        function create($userid, $content){
            try {
                $sql = "INSERT INTO posts (user_id, content) VALUES (?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$userid, $content]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        function getAllPosts(){
            try {
                $sql = "SELECT 
                    posts.id, 
                    posts.content, 
                    posts.created_at,
                    users.first_name,
                    users.last_name
                FROM posts
                JOIN users ON posts.user_id = users.id
                ORDER BY posts.created_at DESC";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $posts;
            } catch (PDOException $e) {
                return [];
            }
        }
    }
?>
