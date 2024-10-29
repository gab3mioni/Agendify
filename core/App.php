<?php

namespace Core;

class App
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run(): void
    {
        $url = $_GET['url'] ?? '';
        $this->router->dispatch($url);
    }
}
