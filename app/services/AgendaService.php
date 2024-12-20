<?php

namespace App\Services;

use App\Helpers\UrlHelper;
use App\Models\AgendaModel;
use App\Helpers\TimeHelper;
use App\Services\FlashMessageService;
use App\Services\Validation\DateValidator;
use App\Services\Validation\TimeValidator;

class AgendaService
{
    private $agendaModel;
    private $dateValidator;
    private $timeValidator;
    private $flashMessageService;

    public function __construct()
    {
        $this->agendaModel = new AgendaModel();
        $this->dateValidator = new DateValidator();
        $this->timeValidator = new TimeValidator();
        $this->flashMessageService = new FlashMessageService();
    }

    public function sanitizeAgendaData(array $data): array
    {
        return [
            'userId' => filter_var($data['userId'], FILTER_SANITIZE_NUMBER_INT),
            'title' => filter_var($data['title'], FILTER_SANITIZE_SPECIAL_CHARS),
            'description' => filter_var($data['description'], FILTER_SANITIZE_SPECIAL_CHARS),
            'date' => filter_var($data['date'], FILTER_SANITIZE_SPECIAL_CHARS),
            'start_time' => filter_var($data['start_time'], FILTER_SANITIZE_SPECIAL_CHARS),
            'end_time' => filter_var($data['end_time'], FILTER_SANITIZE_SPECIAL_CHARS),
        ];
    }

    public function createAppointment(array $data): bool
    {
        $data = $this->sanitizeAgendaData($data);

        if (
            empty($data['userId']) ||
            empty($data['title']) ||
            empty($data['description']) ||
            empty($data['date']) ||
            empty($data['start_time']) ||
            empty($data['end_time'])
        ) {
            header('Location: ' . UrlHelper::baseUrl('agenda'));
            return false;
        }

        if (!$this->dateValidator->validateDate($data['date'])) {
            return false;
        }

        if (!$this->timeValidator->validate($data['start_time'], $data['end_time'])) {
            return false;
        }

        return $this->agendaModel->createAppointment(
            $data['userId'],
            $data['title'],
            $data['description'],
            $data['date'],
            $data['start_time'],
            $data['end_time'],
            $data['reminderEmail'] ?? 'false',
            $data['reminderWhatsapp'] ?? 'false'
        );
    }

    public function editAppointment(array $data): bool
    {
        if (
            empty($data['appointment_id']) ||
            empty($data['title']) ||
            empty($data['description']) ||
            empty($data['date']) ||
            empty($data['start_time']) ||
            empty($data['end_time'])
        ) {
            header('Location: ' . UrlHelper::baseUrl('agenda'));
            return false;
        }

        if (!$this->dateValidator->validateDate($data['date'])) {
            header('Location: ' . UrlHelper::baseUrl('agenda'));
            return false;
        }

        if (!$this->timeValidator->validate($data['start_time'], $data['end_time'])) {
            header('Location: ' . UrlHelper::baseUrl('agenda'));
            return false;
        }

        return $this->agendaModel->editAppointment(
            $data['appointment_id'],
            $data['title'],
            $data['description'],
            $data['date'],
            $data['start_time'],
            $data['end_time']
        );
    }

    public function deleteAppointment(int $appointment_id): bool
    {
        if (empty($appointment_id)) {
            header('Location: ' . UrlHelper::baseUrl('agenda'));
            return false;
        }

        return $this->agendaModel->deleteAppointment($appointment_id);
    }

    public function getAppointments(int $userId): array
    {
        $appointments = $this->agendaModel->getAppointments($userId);
        return TimeHelper::formatTimeInAppointments($appointments);
    }
}
