<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\AppointmentService;
use Core\Controller;

class AgendaController extends Controller
{
    private $appointmentService;
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->appointmentService = new AppointmentService();
    }

    public function index(): void
    {
        $userId = $this->authService->getUserId();
        $appointments = $this->appointmentService->getAppointments($userId);
        $this->view('agenda', ['appointments' => $appointments]);
    }

    public function logout(): void
    {
        $this->authService->logout();
    }

    public function addAppointment(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $this->authService->getUserId();

            if (!$userId) {
                $this->logout();
                return;
            }

            $data = [
                'userId' => $userId,
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'date' => $_POST['date'],
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time'],
            ];

            if (!$this->appointmentService->createAppointment($data)) {
                $this->flashMessageService->setFlashMessage('errorMessage', "Erro ao criar o compromisso.");
            } else {
                $this->flashMessageService->setFlashMessage('successMessage', "Compromisso criado com sucesso!");
            }
        } else {
            $this->flashMessageService->setFlashMessage('errorMessage', "Erro ao criar o compromisso.");
        }
    }

    public function editAppointment(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $this->authService->getUserId();

            if (!$user_id) {
                $this->logout();
                return;
            }

            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'date' => $_POST['date'],
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time'],
            ];

            $appointment_id = $this->appointmentService->getAppointmentId(
                $user_id,
                $data['date'],
                $data['start_time'],
                $data['end_time']
            );

            if (!$this->appointmentService->editAppointment($appointment_id, $data)) {
                $this->flashMessageService->setFlashMessage('errorMessage', "Erro ao editar o compromisso.");
            } else {
                $this->flashMessageService->setFlashMessage('successMessage', "Compromisso editado com sucesso!");
            }
        } else {
            $this->flahsMessageService->setFlashMessage('errorMessage', "Erro ao editar o compromisso.");
        }
    }
}
