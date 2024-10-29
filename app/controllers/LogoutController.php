<?php

namespace App\Controllers;

use Core\Controller;

class LogoutController extends Controller
{

    public function index(): void
    {
        $this->logout();
    }

    public function logout(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        header('Location: /Agendify/public/login');
        exit;
    }
}