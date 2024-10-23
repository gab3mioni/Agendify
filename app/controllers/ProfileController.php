<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Services\EmailValidator;
use App\Services\PhoneValidator;
use Core\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function index()
    {
        $this->profile();
    }

    public function profile()
    {

        if(!isset($_SESSION['email'])) {
            header('location: home');
            exit;
        }

        $profileModel = new ProfileModel();
        $profile = $profileModel->getUserByEmail($_SESSION['email']);

        $errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : null;
        $successMessage = isset($_SESSION['successMessage']) ? $_SESSION['successMessage'] : null;

        unset($_SESSION['errorMessage']);
        unset($_SESSION['successMessage']);

        if($profile) {
            include '../app/views/profile.php';
        } else {
            $errorMessage = "Usuário não encontrado!";
            include '../app/views/profile.php';
        }
    }

    public function updateEmail()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_email'])) {
            $newEmail = $_POST['new_email'];
            $profileModel = new ProfileModel();
            $validator = new EmailValidator();

            if ($validator->validateEmail($newEmail)) {
                if ($profileModel->editEmail($_SESSION['email'], $newEmail)) {
                    $_SESSION['email'] = $newEmail;
                    $_SESSION['successMessage'] = "E-mail atualizado com sucesso!";
                } else {
                    $_SESSION['errorMessage'] = "Erro ao atualizar o e-mail!";
                }
            } else {
                $_SESSION['errorMessage'] = "E-mail inválido.";
            }
            header('Location: /Agendify/public/profile');
            exit;
        }
        $this->profile();
    }

    public function updatePhone()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_phone'])) {
            $newPhone = $_POST['new_phone'];
            $profileModel = new ProfileModel();
            $validator = new PhoneValidator();

            if ($validator->validatePhone($newPhone)) {
                if ($profileModel->editPhone($_SESSION['phone_number'], $newPhone)) {
                    $_SESSION['phone_number'] = $newPhone;
                    $_SESSION['successMessage'] = "Telefone atualizado com sucesso!";
                } else {
                    $_SESSION['errorMessage'] = "Erro ao atualizar o telefone!";
                }
            } else {
                $_SESSION['errorMessage'] = "Telefone inválido.";
            }
            header('Location: /Agendify/public/profile');
            exit;
        }
        $this->profile();
    }
}