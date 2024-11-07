<?php

namespace App\Helpers;

use DateTime;

class TimeHelper
{
    public static function formatTimeInAppointments(array $appointments): array
    {
        foreach ($appointments as &$appointment) {
            if (isset($appointment['start_time'])) {
                $start_time = $appointment['start_time'];
                $appointment['start_time'] = date('g:ia', strtotime($start_time));
            }
        }

        return $appointments;
    }
}
