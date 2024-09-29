<?php
class Database {
    private $host = "localhost";
    private $db_name = "api_database"; // ganti sesuai nama database kamu
    private $username = "root"; // default MySQL user di XAMPP adalah root
    private $password = ""; // default MySQL password di XAMPP kosong
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
