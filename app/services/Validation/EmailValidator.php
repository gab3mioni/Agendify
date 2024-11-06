<?php

namespace App\Services\Validation;

class EmailValidator
{
    public function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['isValid' => false, 'message' => 'O e-mail é inválido!'];
        }

        $allowedDomains = ['gmail.com', 'hotmail.com', 'yahoo.com'];
        $emailDomain = substr(strrchr($email, "@"), 1);

        if (!in_array($emailDomain, $allowedDomains)) {
            return ['isValid' => false, 'message' => 'O domínio do e-mail não é permitido!'];
        }

        return ['isValid' => true];
    }
}
