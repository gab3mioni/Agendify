<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use Core\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $this->profile();
    }

    public function isValidEmail($email)
    {
        $allowedDomains = ['gmail.com', 'hotmail.com', 'yahoo.com'];
        $emailDomain = substr(strrchr($email, "@"), 1);
        return in_array($emailDomain, $allowedDomains);
    }

    public function profile()
    {
        session_start();

        if(!isset($_SESSION['email'])) {
            header('location: home');
            exit;
        }

        $profileModel = new ProfileModel();
        $profile = $profileModel->getUserByEmail($_SESSION['email']);

        if($profile) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_email'])) {
                $newEmail = $_POST['new_email'];

                if ($this->isValidEmail($newEmail)) {
                    if($profileModel->editEmail($_SESSION['email'], $newEmail)) {
                        $_SESSION['email'] = $newEmail;
                        $successMessage = "E-mail atualizado com sucesso!";
                    } else {
                        $errorMessage = "Erro ao atualizar o e-mail!";
                    }
                } else {
                    $errorMessage = "O e-mail é inválido.";
                }
            }
            include '../app/views/profile.php';
            return;
        } else {
            $errorMessage = "Usuário não encontrado!";
            include '../app/views/profile.php';
        }


    }
}