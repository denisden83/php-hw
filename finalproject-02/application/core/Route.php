<?php

namespace FP2;

use Exception;

class Route
{
    public static function start()
    {
        $controllerName = 'Main';
        $actionName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);
        if (!empty($routes[1])) {
            $controllerName = ucfirst(strtolower($routes[1]));
        }
        if (!empty($routes[2])) {
            $actionName = strtolower($routes[2]);
        }

        $controllerFile =  __DIR__ . "/../controllers/$controllerName.php";
        try {
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
            } else {
                throw new Exception('File is not found');
            }
            $className = '\FP2\\Controllers\\' . $controllerName;
            if (class_exists($className)) {
                $controller = new $className();
            } else {
                throw new Exception('File is found but class '
                . $className . ' is not found');
            }
            if (method_exists($controller, $actionName)) {
                $controller->$actionName(... array_slice($routes, 3));
            } else {
                throw new Exception('Method is not found');
            }
        } catch (Exception $e) {
            require_once __DIR__ . '/../../errors/404.php';
        }
    }
}
