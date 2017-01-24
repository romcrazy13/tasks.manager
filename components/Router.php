<?php

if (isset($_SESSION['error'])){echo "<p class=\"text-danger h4\">" . $_SESSION['error'] . "<p>";}
unset($_SESSION['error']);

class Router
{
    private $routes;

    public function __construct(){
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    public static function getURI(){
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run(){

        // Получить строку запроса
        $uri = $this -> getURI();
        $segments = preg_split("~/~", $uri);
        $x = $segments[0];
        unset($segments[0]);
        if (isset($segments[1])){
            $x .= "/" . $segments[1];
            unset($segments[1]);
            if (isset($segments[2])){
                $params = array_values($segments);
            }
        }
        unset($segments);

        if ($uri == ''){$uri = "#root";}
        foreach ($this->routes as $uriPattern => $path){
            if (preg_match( "~$x~", $uriPattern)){
                $segmentsPath = preg_split("~/~", $path);
                $controllerName = ucfirst($segmentsPath[0]) . 'Controller';
                $actionName = 'action' . ucfirst($segmentsPath[1]);

                // Подключаем файл класса Controller
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)){
                    include_once($controllerFile);

                    // Создаем объект, вызываем метод (т.е. action)
                    $controllerObject = new $controllerName;

                    if (isset($params)){
                        call_user_func_array(array($controllerObject, $actionName), $params);
                    }else{
                        $controllerObject -> $actionName();
                    }
                }
                break;
            }
        }
   }
}