<?php
require 'config.php';
class Database {
    private $host;
    private $dbname;
    private $user;
    private $pass;
    private $pdo;

    public function __construct() {
        $this->host = DB_HOST;
        $this->dbname = DB_NAME;
        $this->user = DB_USER;
        $this->pass = "";

        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function createConnection() {
        return $this->pdo;
    }
}
?>
