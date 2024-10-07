<?php

class Database
{
    private $pdo;

    public function __construct()
    {
        $config = require_once __DIR__ . '/../config/config.php';

        try {
            $this->pdo = new PDO(
                'pgsql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME,
                DB_USER,
                DB_PASS
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Conexão falhou: ' . $e->getMessage());
        }
    }

    public function query($sql)
    {
        return $this->pdo->query($sql);
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
}
