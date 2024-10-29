<?php

namespace App\Services;

use App\Models\RegisterModel;
use App\Services\Validation\EmailValidator;

class RegisterService
{

    public function validateRegistrationData($name, $email, $password, $confirm_password): array
    {
        if(empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
            return ['isValid' => false, 'message' => 'Todos os campos são obrigatórios.'];
        }

        if($password != $confirm_password) {
            return ['isValid' => false, 'message' => 'As senhas não coincidem.'];
        }

        $emailValidator = new EmailValidator();
        $emailValidation = $emailValidator->validateEmail($email);
        if(!$emailValidation['isValid']) {
            return ['isValid' => false, 'message' => $emailValidation['message']];
        }

        return ['isValid' => true];
    }

    public function registerUser($name, $email, $hashed_password)
    {
        $registerModel = new RegisterModel();
        return $registerModel->registerUser($name, $email, $hashed_password);
    }
}