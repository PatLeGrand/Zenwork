<?php
    require_once __DIR__ . "/../db/database.php";
    class User{
        private $db;

        public function __construct(){
            $database = Database::getInstance();
            $this->db = $database->getConnection();
        }

        public function  emailExists($email){
            $sql = "SELECT email FROM users WHERE email = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$email]);
            $result = $stmt->fetch();
            if($result){
                return true;
            } else {
                return false;
            }

        }

        public function create($email, $firstname, $lastname, $password){
            if($this->emailExists($email)){
                return false;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (email, password, first_name, last_name) VALUES (?, ?, ?, ?)";

            try {
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$email, $hashedPassword, $firstname, $lastname]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function login($email, $password){
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            if(!$user){
                return false;
            }

            if(password_verify($password, $user['password'])){
                return $user;
            } else {
                return false;
            }


        }
        public function searchUsers($query, $excludeId = null) {
            $query = trim($query);
            if(empty($query)){
                return [];
            }
            $searchTerm = '%' .$query. '%';

            $sql = "SELECT id, first_name, last_name
                    FROM users 
                    WHERE (first_name ILIKE ? 
                       OR last_name ILIKE ? )
                    ";

            if($excludeId){
                $sql .= " AND id != ?";
            }

            $sql .= " Limit 10";

            try {
                $stmt = $this->db->prepare($sql);
                if($excludeId){
                    $stmt->execute([$searchTerm, $searchTerm, $excludeId]);
                } else {
                    $stmt->execute([$searchTerm, $searchTerm]);
                }

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return [];
            }

        }
    }

?>
