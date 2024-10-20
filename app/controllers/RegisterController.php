<?php
namespace App\Controllers;

use App\Models\RegisterModel;
use Core\Controller;

class RegisterController extends Controller
{
    public function index()
    {

        $this->view('register');
    }

    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if(empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
                $errorMessage = "Todos os campos são obrigatórios";
                require_once __DIR__ . "/../views/register.php";
                return;
            }

            if($password != $confirm_password) {
                $errorMessage = "As senhas não coincidem.";
                require_once __DIR__ . "/../views/register.php";
                return;
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMessage = "O e-mail é inválido!";
                require_once __DIR__ . "/../views/register.php";
                return;
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $registerModel = new RegisterModel();
            $result = $registerModel->registerUser($name, $email, $hashed_password);

            if($result) {
                $successMessage = "Cadastro realizado com sucesso!";
                require_once __DIR__ . "/../views/register.php";
            } else {
                $errorMessage = "Ocorreu um erro ao cadastrar!";
                require_once __DIR__ . "/../views/register.php";
            }

        } else {
            require_once __DIR__ . "/../views/register.php";
        }
    }
}
