<?php

namespace Core;

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        include_once "../app/views/$view.php";
    }
}
