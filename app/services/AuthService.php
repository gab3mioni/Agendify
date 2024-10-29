<?php

namespace App\Services;

class AuthService
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login($email, $userId): void
    {
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $userId;
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /Agendify/public/login');
        exit;
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function getUserEmail(): ?string
    {
        return $_SESSION['email'] ?? null;
    }

    public function getUserId(): ?int
    {
        return $_SESSION['user_id'] ?? null;
    }
}
