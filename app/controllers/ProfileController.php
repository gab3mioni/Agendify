<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use Core\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $this->profile();
    }

    public function profile()
    {
        session_start();

        if(!isset($_SESSION['email'])) {
            header('location: home');
            exit;
        }

        $profileModel = new ProfileModel();
        $profile = $profileModel->getUserByEmail($_SESSION['email']);

        if($profile) {
            include '../app/views/profile.php';
            return;
        } else {
            $errorMessage = "Usuário não encontrado!";
            include '../app/views/profile.php';
        }


    }
}