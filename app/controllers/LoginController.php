<?php

namespace App\Controllers;

use App\Models\LoginModel;
use Core\Controller;

class LoginController extends Controller
{
    public function index()
    {
        $this->view('login');
    }

    public function base_url($path = '') {
        return 'http://' . $_SERVER['HTTP_HOST'] . '/Agendify/public/' . ltrim($path, '/');
    }

    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            if(!empty($email) && !empty($password)) {
                $loginModel = new LoginModel();

                $user = $loginModel->findByEmail($email);

                if($user) {
                    if(password_verify($password, $user['password'])) {
                        session_start();
                        $_SESSION['email'] = $email;
                        $_SESSION['user_id'] = $user['id'];

                        header('Location: ' . $this->base_url('dashboard'));
                        exit;
                    } else {
                        $errorMessage = 'Senha incorreta.';
                    }
                } else {
                    $errorMessage = 'E-mail não encontrado.';
                }
            } else {
                $errorMessage = 'Por favor, preencha todos os campos.';
            }
        }

        $data = isset($errorMessage) ? ['errorMessage' => $errorMessage] : [];
        $this->view('login', $data);
    }
}
