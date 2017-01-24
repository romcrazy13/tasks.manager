<?php include_once ROOT . '/views/header.php'; ?>

<body>
<?php foreach ( as $task): ?>
<form action="add" method="post" class="container" enctype="multipart/form-data">
    <div class="form-group">
        <label for="login" class="col-xs-3 control-label">Логин:</label>
        <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" value="<?php $task['login'] ?>">
    </div>
    <div class="form-group">
        <label for="email" class="col-xs-3 control-label">Электронный адрес:</label>
        <input type="text" class="form-control" name="email" id="email" placeholder="Введите электронный адрес" value="<?php $task['email'] ?>">
    </div>
    <div class="form-group">
        <label for="title" class="col-xs-3 control-label">Заголовок:</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Введите заголовок" value="<?php $task['title'] ?>">
    </div>
    <div class="form-group">
        <label for="task" class="col-xs-3 control-label">Задание:</label>
        <textarea rows="5" class="form-control" name="task" id="task"><?php $task['task'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="image" class="col-xs-1 control-label">Картинка:</label>
        <div class="">
            <img src="<?php $task['image'] ?>" width="320" height="240">
        </div>
    </div>
    <button type="submit" class="btn btn-success">Сохранить</button>
    <a type="button" class="btn btn-default navbar-btn" href="/">Отмена</a>
</form>
<?php endforeach; ?>
</body>

<?php include_once ROOT . '/views/footer.php'; ?>

