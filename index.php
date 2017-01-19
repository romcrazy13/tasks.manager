<?php
    // Front Controller

    // Общие настройки
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Подключение файлов системы
    define('ROOT', dirname(__FILE__));

    session_start();
    require_once ROOT . '/config/settings.php';
    require_once ROOT . '/components/DB.php';
    require_once ROOT . '/components/Router.php';

    // Проверка соединения с БД
    if ($error = checkDB()){
        die($error);
    }


    // Вызов Router
    $router = new Router();
    $router->run();


?>