<?php

namespace App\Models;

use PDO;

class AgendaModel
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function createAppointment($userId, $title, $description, $date, $startTime, $endTime, $reminderEmail, $reminderWhatsapp)
    {
        $query = "INSERT INTO appointments (user_id, title, description, appointment_date, start_time, end_time, reminder_email, reminder_whatsapp) 
                  VALUES (:user_id, :title, :description, :appointment_date, :start_time, :end_time, :reminder_email, :reminder_whatsapp)";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':appointment_date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':start_time', $startTime, PDO::PARAM_STR);
        $stmt->bindParam(':end_time', $endTime, PDO::PARAM_STR);
        $stmt->bindParam(':reminder_email', $reminderEmail, PDO::PARAM_BOOL);
        $stmt->bindParam(':reminder_whatsapp', $reminderWhatsapp, PDO::PARAM_BOOL);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function getAppointments(int $userId)
    {
        $query = "SELECT * FROM appointments WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
