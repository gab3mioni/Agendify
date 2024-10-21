<?php
namespace App\Controllers;

use Core\Controller;

class DashboardController extends Controller
{
    public function index() {

        $this->view('dashboard');
    }
}
