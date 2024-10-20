<?php

namespace App\Models;
use PDO;

class LoginModel
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function login($email, $password)
    {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $query->bindParam(":email", $email);
        $query->bindParam(":password", $password);
        $query->execute();
        return $query->fetch();
    }

    public function findByEmail($email)
    {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        return $query->fetch();
    }
}
