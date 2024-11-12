<?php

namespace App\Models;

use PDO;

class AgendaModel extends BaseModel
{
    public function createAppointment(
        $userId,
        $title,
        $description,
        $date,
        $startTime,
        $endTime,
        $reminderEmail,
        $reminderWhatsapp): bool
    {
        $query = "INSERT INTO appointments (user_id, title, description, appointment_date, start_time, 
                  end_time, reminder_email, reminder_whatsapp) 
                  VALUES (:user_id, :title, :description, :appointment_date, :start_time, 
                  :end_time, :reminder_email, :reminder_whatsapp)";
        return $this->executeQuery($query, [
            "user_id" => $userId,
            "title" => $title,
            "description" => $description,
            "appointment_date" => $date,
            "start_time" => $startTime,
            "end_time" => $endTime,
            "reminder_email" => $reminderEmail,
            "reminder_whatsapp" => $reminderWhatsapp
        ]);
    }

    public function getAppointments(int $userId): array
    {
        $query = "SELECT * FROM appointments WHERE user_id = :user_id";
        return $this->fetchAllValues($query, ["user_id" => $userId]);
    }
}
