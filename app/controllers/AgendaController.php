<?php

namespace App\Controllers;

use App\Helpers\UrlHelper;
use App\Services\AuthService;
use App\Services\AgendaService;
use App\Services\FlashMessageService;
use Core\Controller;

class AgendaController extends Controller
{
    private $agendaService;
    private $authService;
    private $flashMessageService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->agendaService = new AgendaService();
        $this->flashMessageService = new FlashMessageService();
    }

    public function index(): void
    {
        $userId = $this->authService->getUserId();
        $appointments = $this->agendaService->getAppointments($userId);
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

            if (!$this->agendaService->createAppointment($data)) {
                $this->flashMessageService->setFlashMessage('errorMessage', "Erro ao criar o compromisso.");
            } else {
                $this->flashMessageService->setFlashMessage('successMessage', "Compromisso criado com sucesso!");
                header('Location: ' . UrlHelper::baseUrl('agenda'));
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
                'appointment_id' => $_POST['appointment_id'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'date' => $_POST['date'],
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time'],
            ];


            if (!$this->agendaService->editAppointment($data)) {
                $this->flashMessageService->setFlashMessage('errorMessage', "Erro ao editar o compromisso.");
            } else {
                $this->flashMessageService->setFlashMessage('successMessage', "Compromisso editado com sucesso!");
                header('Location: ' . UrlHelper::baseUrl('agenda'));
            }
        } else {
            $this->flashMessageService->setFlashMessage('errorMessage', "Erro ao editar o compromisso.");
        }
    }

    public function deleteAppointment(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $this->authService->getUserId();

            if (!$user_id) {
                $this->logout();
                return;
            }

            $appointment_id = $_POST['appointment_id'];

            if (!$this->agendaService->deleteAppointment($appointment_id)) {
                $this->flashMessageService->setFlashMessage('errorMessage', "Erro ao deletar o compromisso.");
            } else {
                $this->flashMessageService->setFlashMessage('successMessage', "Compromisso deletado com sucesso!");
                header('Location: ' . UrlHelper::baseUrl('agenda'));
            }
        } else {
            $this->flashMessageService->setFlashMessage('sucessMessage', "Erro ao deletar o compromisso.");
        }
    }
}
