<?php

function alert($message) {
    echo "<script> alert(\"$message\"); </script>";
}

function checkDB(){
    if (!($error = tryLinkDB())){
        if (!($error = checkTableUsers())){
            $error = checkTableTasks();
        }
    }
    return $error;
}

// Подключение к DB
function getPDO(){
    try {
        $dsn = "mysql:host=" . HOST . ";dbname=" . DB . ";charset=utf8";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $pdo = new PDO($dsn, USER, PASSWORD, $opt);
    } catch (PDOException $e) {
        $_SESSION['error'] = "Ошибка подключения к базе данных<br>" . $e->getMessage();
    }
    return $pdo;
}

// Проверка подключения к DB
function tryLinkDB(){
    // Подключение к хосту
    try {
        $dbh = new PDO("mysql:host=" . HOST, USER, PASSWORD);
    } catch (PDOException $e) {
        $_SESSION['error'] = "Ошибка подключения к хосту<br>" . $e->getMessage();
    }
    if (!isExistsDB()){
        // При отсутствии DB создается новая
        try {
            $dbh->exec("CREATE DATABASE IF NOT EXISTS `" . DB . "` DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");
        } catch (PDOException $e) {
            $_SESSION['error'] = "Ошибка при создании базы данных<br>" . $e->getMessage();
        }
    }
}

// Проверка наявности DB
function isExistsDB(){
    try {
        $dbh = new PDO("mysql:host=" . HOST, USER, PASSWORD);
        $dbs = $dbh->query('SHOW DATABASES');
    } catch (PDOException $e) {
        $_SESSION['error'] = "Ошибка запроса списка таблиц<br>" . $e->getMessage();
    }
    while (($x = $dbs->fetchColumn(0)) !== false) {
        if ($x == DB) {
            return true;
            break;
        }
    }
    return false;
}

// Проверка наявности таблицы в DB
function isExistsTable($table){
    $dbs = getPDO()->query('SHOW TABLES');
    while (($x = $dbs->fetchColumn(0)) !== false) {
        if ($x == $table) {
            return true;
            break;
        }
    }
    return false;
}

// Проверка наявности таблицы "users"
function checkTableUsers(){
    if (!isExistsTable('users')){
        $columns = "(id         INT( 11 )       AUTO_INCREMENT PRIMARY KEY,
                    login       VARCHAR( 50 )   NOT NULL UNIQUE,
                    password    VARCHAR( 50 )   NOT NULL,
                    email       VARCHAR( 50 )   NOT NULL UNIQUE,
                    dateCreate  DATETIME        NOT NULL,
                    dateVisited DATETIME        NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        try {
            getPDO()->exec("CREATE TABLE IF NOT EXISTS `users` $columns");
        } catch (PDOException $e) {
            $_SESSION['error'] = "Ошибка при создании таблицы 'users'<br>" . $e->getMessage();
        }
        $sql = "INSERT INTO users (`login`, `password`, `email`, `dateCreate`, `dateVisited`)
                    VALUES ('" . ADMIN_LOGIN . "',
                            '" . ADMIN_PASSWORD . "',
                            '" . ADMIN_EMAIL . "',
                            NOW(),
                            NOW())";
        try {
            $stm = getPDO()->prepare($sql);
            $stm->execute();
        } catch (PDOException $e) {
            $_SESSION['error'] = "Ошибка добавления записи в таблицу 'users'<br>" . $e->getMessage();
        }
    }
}

// Проверка наявности таблицы "tasks"
function checkTableTasks(){
    if (!isExistsTable('tasks')){
        $columns = "(id         INT( 11 )       AUTO_INCREMENT PRIMARY KEY,
                    login       varchar( 50 )   NOT NULL,
                    email       varchar( 50 )   NOT NULL,
                    title       varchar( 50 )   NOT NULL UNIQUE,
                    task        text            NOT NULL,
                    image       text            NOT NULL,
                    complete    datetime                 DEFAULT NULL,
                    dateCreate  datetime        NOT NULL DEFAULT NOW()
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        try {
            getPDO()->exec("CREATE TABLE IF NOT EXISTS `tasks` $columns");
        } catch (PDOException $e) {
            $_SESSION['error'] = "Ошибка при создании таблицы 'tasks'<br>" . $e->getMessage();
        }
    }
}



