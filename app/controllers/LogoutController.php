<?php

namespace App\Controllers;
use App\Services\AuthService;

class LogoutController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function index()
    {
        $this->authService->logout();
    }
}