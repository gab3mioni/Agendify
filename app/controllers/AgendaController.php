<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\AgendaModel;

class AgendaController extends Controller
{
    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
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

    public function addAppointment()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userId = $this->getUserId();
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
            $reminderEmail = "false";
            $reminderWhatsapp = "true";

            if(!empty($title) && !empty($description) && !empty($date)) {
                $appointmentModel = new AgendaModel();
                $appointment = $appointmentModel->createAppointment($userId, $title, $description, $date, $reminderEmail, $reminderWhatsapp);

                if($appointment) {
                    $_SESSION['successMessage'] = "Compromisso criado com sucesso!";
                } else {
                    $_SESSION['errorMessage'] = "Erro ao criar o compromisso!";
                }
            } else {
                $_SESSION['errorMessage'] = "Os campos não podem ser vazios!";
            }
            header('Location: /Agendify/public/agenda');
            exit;
        }
        $this->view('agenda');
    }
}