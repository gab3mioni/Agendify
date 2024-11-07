<?php

namespace App\Services;

use App\Models\AgendaModel;
use App\Helpers\TimeHelper;
use App\Services\Validation\DateValidator;
use App\Services\Validation\TimeValidator;

class AppointmentService
{
    private $agendaModel;
    private $dateValidator;
    private $timeValidator;

    public function __construct()
    {
        $this->agendaModel = new AgendaModel();
        $this->dateValidator = new DateValidator();
        $this->timeValidator = new TimeValidator();
    }

    public function createAppointment(array $data): bool
    {


        if (!$this->dateValidator->validateDate($data['date'])) {
            return false;
        }

        if (!$this->timeValidator->validate($data['startTime'], $data['endTime'])) {
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
        $appointments = $this->agendaModel->getAppointments($userId);
        return TimeHelper::formatTimeInAppointments($appointments);
    }
}
