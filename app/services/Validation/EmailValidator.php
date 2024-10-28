<?php

namespace App\Services\Validation;

class EmailValidator
{
    public function validateEmail($email)
    {
        $allowedDomains = ['gmail.com', 'hotmail.com', 'yahoo.com'];
        $emailDomain = substr(strrchr($email, "@"), 1);
        return in_array($emailDomain, $allowedDomains);
    }
}