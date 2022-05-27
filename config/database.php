<?php

//Conexión con la base de datos
    class Database{
        private $host = "localhost";
        private $database_name = "blog";
        private $username = "root";
        private $password = "root";

        public $conn;

        public function getConnection() {
            $this->conn = null;

            try {
                $this->conn = new PDO("mysql:host=".$this->host.
                                        ";dbname=".$this->database_name,
                                        $this->username, $this->password);
                $this->conn->exec("set names utf8");
            } catch (PDOException $ex) {
                echo "Database couldn't be connected: " . $ex->getMessage();
            }

            return $this->conn;
        }
    };

?>