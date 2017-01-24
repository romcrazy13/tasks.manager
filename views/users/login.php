<?php include_once ROOT . '/views/header.php'; ?>

<form action="login" method="post" class="container">
    <div class="form-group">
        <label for="login" class="col-xs-3 control-label">Логин:</label>
        <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин или адресс электронной почты">
    </div>
    <div class="form-group">
        <label for="password" class="col-xs-3 control-label">Пароль:</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Пароль">
    </div>
    <button type="submit" class="btn btn-success">Войти</button>
    <a type="button" class="btn btn-default navbar-btn" href="/">Отмена</a>
</form>

<?php include_once ROOT . '/views/footer.php'; ?>
