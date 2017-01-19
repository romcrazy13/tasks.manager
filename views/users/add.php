<?php include_once ROOT . '/views/header.php'; ?>

<form role="form" action="add" method="post">
    <div class="form-group">
        <label for="login">Логин:</label>
        <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин">
    </div>
    <div class="form-group">
        <label for="email">Адресс электронной почты:</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Введите адресс электронной почты">
    </div>
    <div class="form-group">
        <label for="pass">Пароль:</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Пароль">
    </div>
    <div class="form-group">
        <label for="re-pass">Повторный пароль:</label>
        <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Пароль">
    </div>
    <button type="submit" class="btn btn-success">Сохранить</button>
</form>

<?php include_once ROOT . '/views/footer.php'; ?>

