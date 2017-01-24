<!DOCTYPE html>
<html lang="ru">
<head>
    <title>TasksManager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php
        if (!empty($_SERVER['REQUEST_URI'])){
        $uri = trim($_SERVER['REQUEST_URI'], '/');}
    ?>
</head>
<body>
<header>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="navbar-brand">
                    <span class="h3">Tasks.Manager</span>
                </div>
                <?php
                if (isset($_SESSION['user'])){
                    ?>
                    <a type="button" class="btn btn-default navbar-btn" href="/user/cansel">Выход</a>
                    <span class="h4"><?php echo "Логин: <strong>" . $_SESSION['user'] ?></strong></span>
                    <?php if (Router::getURI() == ''){ ?>
                        <a type="button" class="btn btn-default" href="/task/add">Добавить задание</a>
                    <?php } ?>
                <?php }elseif (!($uri == 'add') && !($uri == 'signIn')){ ?>
                    <a type="button" class="btn btn-default navbar-btn" href="/user/add">Регистрация</a>
                    <a type="button" class="btn btn-default navbar-btn" href="/user/login">Вход</a>
                <?php } ?>
            </div>
        </div>
    </nav>

</header>







