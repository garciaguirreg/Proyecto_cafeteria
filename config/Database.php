<?php

class Database {
    private $host = 'localhost'; 
    private $dbname = 'mooncafe'; 
    private $username = 'root'; 
    private $password = ' '; 
    private $pdo;
    private static $instance;

    private function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Para seguridad
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }

    public static function getConnection() {
        return self::getInstance();
    }
}

?>