<?php

class Database
{
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $db_user = DB_USER;
    private $db_pass = DB_PASSWORD;
    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name};", $this->db_user, $this->db_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection error" . $e->getMessage();
        }
        return $this->conn;
    }
}
