<?php

namespace App\Services;

use App\Models\RegisterModel;
use App\Services\Validation\EmailValidator;
use App\Services\Validation\PhoneValidator;

class RegisterService
{

    public function validateRegistrationData($name, $email, $phone, $password, $confirm_password): array
    {
        if(empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
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

        $phoneValidator = new PhoneValidator();
        $phoneValidation = $phoneValidator->validatePhone($phone);

        if(!$phoneValidation['isValid']) {
            return ['isValid' => false, 'message' => $phoneValidation['message']];
        }

        return ['isValid' => true];
    }

    public function registerUser($name, $email, $phone, $hashed_password): bool
    {
        $registerModel = new RegisterModel();
        return $registerModel->registerUser($name, $email, $phone, $hashed_password);
    }
}
