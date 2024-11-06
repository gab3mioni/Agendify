<?php

namespace Core;

class Controller
{
    protected function view($view): void
    {
        include_once "../app/views/$view.php";
    }
}
