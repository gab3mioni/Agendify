<?php

namespace App\Services\Validation\Rules;

use DateTime;
use DateInterval;

class MaxIntervalRule implements TimeValidatorRule
{
    private int $maxIntervalInHours;

    public function __construct(int $maxIntervalInHours = 12)
    {
        $this->maxIntervalInHours = $maxIntervalInHours;
    }

    public function validate(string $startTime, string $endTime): bool
    {
        $start = new DateTime($startTime);
        $end = new DateTime($endTime);

        $interval = $start->diff($end);

        $hours = ($interval->days * 24) + $interval->h;
        return $hours <= $this->maxIntervalInHours;
    }
}
