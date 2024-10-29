<?php
namespace App\Controllers;

use App\Services\RegisterService;
use Core\Controller;

class RegisterController extends Controller
{
    public function index()
    {

        $this->view('register');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            $confirm_password = $_POST['confirm_password'] ?? null;

            $registerService = new RegisterService();
            $validationResult = $registerService->validateRegistrationData($name, $email, $password, $confirm_password);

            if (!$validationResult['isValid']) {
                $this->view('register', ['errorMessage' => $validationResult['message']]);
                return;
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $result = $registerService->registerUser($name, $email, $hashed_password);

            if ($result) {
                $this->view('register', ['successMessage' => "Cadastro realizado com sucesso!"]);
            } else {
                $this->view('register', ['errorMessage' => "Ocorreu um erro ao cadastrar!"]);
            }
        } else {
            $this->view('register');
        }
    }
}
