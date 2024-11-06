<?php

namespace App\Services\Validation;

use App\Services\Validation\Rules\TimeValidationRule;
use App\Services\Validation\Rules\StartBeforeEndRule;
use App\Services\Validation\Rules\MaxIntervalRule;

class TimeValidator
{
    private array $rules = [];

    public function __construct(array $rules = [])
    {
        $this->rules = $rules;
    }

    public function validate(string $startTime, string $endTime): bool
    {
        foreach ($this->rules as $rule) {
            if (!$rule->validate($startTime, $endTime)) {
                return false;
            }
        }
        return true;
    }

    public function addRule(TimeValidationRule $rule): void
    {
        $this->rules[] = $rule;
    }
}
