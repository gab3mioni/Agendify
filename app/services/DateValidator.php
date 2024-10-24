<?php

namespace App\Services;

class DateValidator
{
    public function validateDate(string $date) : bool
    {
        return preg_match("/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/", $date);
    }
}