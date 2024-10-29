<?php

namespace App\Controllers;

use App\Models\AgendaModel;
use App\Services\Validation\DateValidator;
use App\Services\Validation\TimeValidator;
use App\Services\Validation\Rules\StartBeforeEndRule;
use App\Services\Validation\Rules\MaxIntervalRule;
use Core\Controller;

class AgendaController extends Controller
{
    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index(): void
    {
        $this->view('agenda');
    }

    public function getUserId()
    {
        if (isset($_SESSION['user_id'])) {
            return $_SESSION['user_id'];
        } else {
            $logout = new LogoutController();
            $logout->logout();
            exit();
        }
    }

    public function addAppointment(): void
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userId = $this->getUserId();
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
            $startTime = filter_input(INPUT_POST, 'start_time', FILTER_SANITIZE_SPECIAL_CHARS);
            $endTime = filter_input(INPUT_POST, 'end_time', FILTER_SANITIZE_SPECIAL_CHARS);
            $reminderEmail = "false";
            $reminderWhatsapp = "true";

            if(!empty($title) && !empty($description) && !empty($date) && !empty($startTime) && !empty($endTime)) {

                $validateDate = new DateValidator();
                if (!$validateDate->validateDate($date)) {
                    $_SESSION['errorMessage'] = "Data inválida!";
                    header('Location: /Agendify/public/agenda');
                    exit;
                }

                $timeValidator = new TimeValidator([
                    new StartBeforeEndRule(),
                    new MaxIntervalRule(12)
                ]);

                if (!$timeValidator->validate($startTime, $endTime)) {
                    $_SESSION['errorMessage'] = "Horário inválido! O horário de início deve ser menor que o de término e o intervalo não deve exceder 12 horas.";
                    header('Location: /Agendify/public/agenda');
                    exit;
                }

                $appointmentModel = new AgendaModel();
                $appointment = $appointmentModel->createAppointment(
                    $userId,
                    $title,
                    $description,
                    $date,
                    $startTime,
                    $endTime,
                    $reminderEmail,
                    $reminderWhatsapp
                );

                if ($appointment) {
                    $_SESSION['successMessage'] = "Compromisso criado com sucesso!";
                } else {
                    $_SESSION['errorMessage'] = "Erro ao criar o compromisso!";
                }

            } else {
                $_SESSION['errorMessage'] = "Todos os campos são obrigatórios!";
            }

            header('Location: /Agendify/public/agenda');
            exit;
        }
        $this->view('agenda');
    }
}