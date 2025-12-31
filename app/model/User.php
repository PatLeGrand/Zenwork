<?php
    require_once "./app/db/database.php";
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
    }

?>
