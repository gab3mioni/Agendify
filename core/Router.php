<?php

namespace Core;

class Router
{
    public function dispatch($url)
    {
        $baseDir = '/Agendify';

        if (strpos($url, $baseDir) === 0) {
            $url = substr($url, strlen($baseDir));
        }

        $url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));

        $controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
        $methodName = isset($url[1]) ? $url[1] : 'index';
        $params = array_slice($url, 2);

        $controllerClass = "\\App\\Controllers\\$controllerName";
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $methodName)) {
                call_user_func_array([$controller, $methodName], $params);
            } else {
                echo "Método $methodName não foi encontrado.";
            }
        } else {
            echo "Controller $controllerName não foi encontrado.";
        }
    }
}
