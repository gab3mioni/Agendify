<?php

namespace App\Services\Validation\Rules;

use DateTime;

class StartBeforeEndRule implements TimeValidatorRule
{
    public function validate(string $startTime, string $endTime): bool
    {
        $start = new DateTime($startTime);
        $end = new DateTime($endTime);

        return $start < $end;
    }
}
