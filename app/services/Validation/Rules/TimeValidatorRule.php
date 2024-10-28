<?php

namespace App\Services\Validation\Rules;

interface TimeValidatorRule
{
    public function validate(string $startTime, string $endTime): bool;
}