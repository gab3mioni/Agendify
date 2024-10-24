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

    public function createAppointment($userId, $title, $description, $date, $reminderEmail, $reminderWhatsapp)
    {
        $query = "INSERT INTO appointments (user_id, title, description, appointment_date, reminder_email, reminder_whatsapp) 
                  VALUES (:user_id, :title, :description, :appointment_date, :reminder_email, :reminder_whatsapp)";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':appointment_date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':reminder_email', $reminderEmail, PDO::PARAM_BOOL);
        $stmt->bindParam(':reminder_whatsapp', $reminderWhatsapp, PDO::PARAM_BOOL);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}