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
        $reminderWhatsapp
    ): bool {
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

    public function editAppointment(
        $appointment_id,
        $title,
        $description,
        $date,
        $startTime,
        $endTime
    ): bool {
        $query = "UPDATE appointments SET title = :title, 
                                          description = :description, 
                                          appointment_date = :appointment_date,
                                          start_time = :start_time,
                                          end_time = :end_time
                                          WHERE id = :id,
                                          ";
        return $this->executeQuery($query, [
            "id" => $appointment_id,
            "title" => $title,
            "description" => $description,
            "appointment_date" => $date,
            "start_time" => $startTime,
            "end_time" => $endTime
        ]);
    }

    public function getAppointmentId(int $user_id, string $title, string $start_time, string $end_time): int
    {
        $data = [
            "user_id" => $user_id,
            "title" => $title,
            "start_time" => $start_time,
            "end_time" => $end_time
        ];
        $query = "SELECT id FROM appointments WHERE user_id = :user_id AND 
                                  title = :title AND 
                                  start_time = :start_time AND 
                                  end_time = :end_time";
        return $this->executeQuery($query, $data);
    }

    public function getAppointments(int $userId): array
    {
        $query = "SELECT * FROM appointments WHERE user_id = :user_id";
        return $this->fetchAllValues($query, ["user_id" => $userId]);
    }
}
