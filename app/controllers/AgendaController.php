<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\FlashMessageService;
use App\Services\AppointmentService;
use Core\Controller;

class AgendaController extends Controller
{
    public function index(): void
    {
        $this->view('agenda');
    }

    public function addAppointment(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /Agendify/public/agenda');
            return;
        }

        $appointmentService = new AppointmentService();
        $flashMessageService = new FlashMessageService();
        $authService = new AuthService();
        $userId = $authService->getUserId();

        if (!$userId) {
            $logoutController = new LogoutController();
            $logoutController->logout();
            return;
        }

        $data = [
            'userId' => $userId,
            'title' => filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS),
            'description' => filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS),
            'date' => filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS),
            'startTime' => filter_input(INPUT_POST, 'start_time', FILTER_SANITIZE_SPECIAL_CHARS),
            'endTime' => filter_input(INPUT_POST, 'end_time', FILTER_SANITIZE_SPECIAL_CHARS),
            'reminderEmail' => "false",
            'reminderWhatsapp' => "true"
        ];

        if (empty($data['title']) || empty($data['description']) || empty($data['date']) || empty($data['startTime']) || empty($data['endTime'])) {
            $flashMessageService->setFlashMessage('errorMessage', "Todos os campos são obrigatórios!");
            header('Location: /Agendify/public/agenda');
            return;
        }

        if (!$appointmentService->createAppointment($data)) {
            $flashMessageService->setFlashMessage('errorMessage', "Erro ao criar o compromisso!");
        } else {
            $flashMessageService->setFlashMessage('successMessage', "Compromisso criado com sucesso!");
        }

        header('Location: /Agendify/public/agenda');
    }
}
