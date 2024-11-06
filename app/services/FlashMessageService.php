<?php

namespace App\Services;

class FlashMessageService
{
    public function setFlashMessage(string $userId, string $message): void
    {
        $_SESSION[$userId] = $message;
    }

    public function getFlashMessage(string $userId): ?string
    {
        if(isset($_SESSION[$userId])) {
            $message = $_SESSION[$userId];
            unset($_SESSION[$userId]);
            return $message;
        }
        return null;
    }
}
