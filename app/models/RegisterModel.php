<?php

namespace App\Models;
use PDO;

class RegisterModel
{

    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function registerUser($name, $email, $phone, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, phone_number, password) VALUES (:name, :email, :phone_number, :password)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }

}
