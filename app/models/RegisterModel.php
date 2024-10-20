<?php

namespace App\Models;
use PDO;

class RegisterModel
{

    private $pdo;

    public function  __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function registerUser($name, $email, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }

}
