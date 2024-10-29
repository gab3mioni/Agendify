<?php

namespace App\Services\Validation;

class PhoneValidator
{
    public function validatePhone($phone): array
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (preg_match('/^(11|12|13|14|15|16|17|18|19|2[0-9]|3[0-3]|4[0-5]|5[0-6]|6[0-8]|7[0-2]|8[0-5]|9[0-9])\d{9}$/', $phone)) {
            return ['isValid' => true];
        }

        return ['isValid' => false, 'message' => 'Número de telefone inválido.'];
    }
}
