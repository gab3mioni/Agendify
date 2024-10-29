<?php

namespace App\Services;

use AllowDynamicProperties;
use App\Models\AgendaModel;
use App\Services\Validation\DateValidator;
use App\Services\Validation\TimeValidator;

class AppointmentService
{
    public function createAppointment(array $data): bool
    {
        $dateValidator = new DateValidator();
        $timeValidator = new TimeValidator();
        $agendaModel = new AgendaModel();

        if (!$dateValidator->validateDate($data['date'])) {
            return false;
        }

        if (!$timeValidator->validate($data['startTime'], $data['endTime'])) {
            return false;
        }

        return $agendaModel->createAppointment(
            $data['userId'],
            $data['title'],
            $data['description'],
            $data['date'],
            $data['startTime'],
            $data['endTime'],
            $data['reminderEmail'] ?? 'false',
            $data['reminderWhatsapp'] ?? 'true'
        );
    }
}