<?php

namespace App\Helpers;

class UrlHelper
{
    public static function baseUrl(string $path): string
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . '/Agendify/public/' . ltrim($path, '/');
    }
}
