<?php include_once ROOT . '/views/header.php'; ?>

<body>
    <form action="add" method="post" class="container" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title" class="col-xs-3 control-label">Заголовок:</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Введите заголовок">
        </div>
        <div class="form-group">
            <label for="task" class="col-xs-3 control-label">Задание:</label>
            <textarea rows="5" class="form-control" name="task" id="task"></textarea>
        </div>
        <div class="form-group">
            <label for="image" class="col-xs-1 control-label">Картинка:</label>
            <div class="">
                <input type="file" name="image" id="image"></input>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
        <a type="button" class="btn btn-default navbar-btn" href="/">Отмена</a>
    </form>
</body>

<?php include_once ROOT . '/views/footer.php'; ?>

