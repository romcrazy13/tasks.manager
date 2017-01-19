<?php include_once ROOT . '/views/header.php'; ?>

    <div class="container">
        <h2>Задания</h2>
        <table class="table table-striped table-condensed table-hover">
            <thead>
            <tr>
                <th>Логин пользователя</th>
                <th>Электронная почта</th>
                <th>Заголовок</th>
                <th>Задание</th>
                <th>Схема</th>
                <th>Статус</th>
                <th>Дата создания</th>
                <th>Возможные действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach (Tasks::getTasksList() as $task): ?>
                <tr>
                    <td><?php echo $task['login'] ?></td>
                    <td><?php echo $task['email'] ?></td>
                    <td><?php echo $task['title'] ?></td>
                    <td><?php echo $task['task'] ?></td>
                    <td><?php echo $task['image'] ?></td>
                    <td><?php echo $task['complete'] ?></td>
                    <td><?php echo $task['dateCreate'] ?></td>
                    <td><p class="links"><a class="btn btn-default" href="#" role="button" href="/tests/view/<?php echo $task['id'] ?>">Удалить</a></p></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php include_once ROOT . '/views/footer.php'; ?>