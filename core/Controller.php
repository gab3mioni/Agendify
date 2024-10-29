<?php

namespace Core;

class Controller
{
    protected function view($view): void
    {
        require_once "../app/views/$view.php";
    }
}
