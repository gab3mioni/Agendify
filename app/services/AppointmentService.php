<?php

namespace App\Services;

use AllowDynamicProperties;
use App\Models\AgendaModel;
use App\Services\Validation\DateValidator;
use App\Services\Validation\TimeValidator;

class AppointmentService
{
    private AgendaModel $agendaModel;

    public function __construct()
    {
        $this->agendaModel = new AgendaModel();
    }

    public function createAppointment(array $data): bool
    {
        $dateValidator = new DateValidator();
        $timeValidator = new TimeValidator();

        if (!$dateValidator->validateDate($data['date'])) {
            return false;
        }

        if (!$timeValidator->validate($data['startTime'], $data['endTime'])) {
            return false;
        }

        return $this->agendaModel->createAppointment(
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

    public function getAppointments(int $userId): array
    {
        return $this->agendaModel->getAppointments($userId);
    }
}
