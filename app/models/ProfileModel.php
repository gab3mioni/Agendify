<?php

namespace App\Models;
use PDO;

class ProfileModel
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT name, email FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editEmail($email, $newEmail)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET email = :newEmail WHERE email = :email");
        $stmt->bindParam(':newEmail', $newEmail);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
}