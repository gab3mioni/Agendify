<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Services\AuthService;
use Core\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('login');
    }

    public function base_url($path = ''): string
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . '/Agendify/public/' . ltrim($path, '/');
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            if (!empty($email) && !empty($password)) {
                $loginModel = new LoginModel();
                $user = $loginModel->findByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    $authService = new AuthService();
                    $authService->login($email, $user['id']);
                    header('Location: ' . $this->base_url('dashboard'));
                    exit;
                } else {
                    $errorMessage = $user ? 'Senha incorreta.' : 'E-mail não encontrado.';
                    require_once __DIR__ . '/../views/login.php';
                }
            } else {
                $errorMessage = 'Por favor, preencha todos os campos.';
                require_once __DIR__ . '/../views/login.php';
            }
        } else {
            require_once __DIR__ . '/../views/login.php';
        }
    }
}
