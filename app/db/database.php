<?php
    class Database {
        private static $instance = null;
        private $conn;
        private function __construct() {
            $host = getenv("DB_HOST");
            $port = getenv("DB_PORT");
            $dbname = getenv("DB_NAME");
            $user = getenv("DB_USER");
            $password = getenv("DB_PASSWORD");

            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

            try{
                $this->conn = new PDO($dsn, $user, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        public static function getInstance(){
            if(self::$instance == null){
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function getConnection(){
            return $this->conn;
        }
    }
?>