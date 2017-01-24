<?php include_once ROOT . '/views/header.php'; ?>

<form role="form" action="add" method="post" class="container">
    <div class="form-group">
        <label for="login" class="col-xs-3 control-label">Логин:</label>
        <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин">
    </div>
    <div class="form-group">
        <label for="email" class="col-xs-3 control-label">Адресс электронной почты:</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Введите адресс электронной почты">
    </div>
    <div class="form-group">
        <label for="password" class="col-xs-3 control-label">Пароль:</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Пароль">
    </div>
    <div class="form-group">
        <label for="confirm-password" class="col-xs-3 control-label">Повторный пароль:</label>
        <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Наберите пароль снова">
    </div>
    <button type="submit" class="btn btn-success">Сохранить</button>
    <a type="button" class="btn btn-default navbar-btn" href="/">Отмена</a>
</form>

<?php include_once ROOT . '/views/footer.php'; ?>

