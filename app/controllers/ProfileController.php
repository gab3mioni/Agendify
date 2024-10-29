<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Services\AuthService;
use App\Services\Validation\EmailValidator;
use App\Services\Validation\PhoneValidator;
use Core\Controller;

class ProfileController extends Controller
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();

        if (!$this->authService->isAuthenticated()) {
            $_SESSION['errorMessage'] = "Usuário não encontrado!";
            header('Location: /Agendify/public/login');
            exit;
        }
    }

    public function index(): void
    {
        $this->profile();
    }

    public function profile(): void
    {
        $email = $this->authService->getUserEmail();

        $profileModel = new ProfileModel();
        $profile = $profileModel->getUserByEmail($email);

        $errorMessage = $_SESSION['errorMessage'] ?? null;
        $successMessage = $_SESSION['successMessage'] ?? null;

        unset($_SESSION['errorMessage'], $_SESSION['successMessage']);

        if ($profile) {
            $_SESSION['email'] = $profile['email'];
            $_SESSION['phone_number'] = $profile['phone_number'];
            include '../app/views/profile.php';
        } else {
            $_SESSION['errorMessage'] = "Usuário não encontrado!";
            header('Location: /Agendify/public/login');
        }
    }

    public function updateEmail(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_email'])) {
            $newEmail = $_POST['new_email'];
            $profileModel = new ProfileModel();
            $validator = new EmailValidator();

            if ($validator->validateEmail($newEmail)) {
                if ($profileModel->editEmail($this->authService->getUserEmail(), $newEmail)) {
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

    public function updatePhone(): void
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
