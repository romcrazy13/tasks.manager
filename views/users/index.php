<?php include_once ROOT . '/views/header.php'; ?>

<div class="container">
    <h2>Пользователи</h2>
    <p>Зарегистрированные пользователи, посетившие сайт:</p>
    <table class="table table-striped table-condensed table-hover">
        <thead>
        <tr>
            <th>Логин пользователя</th>
            <th>Электронная почта</th>
            <th>Зарегестрирован</th>
            <th>Последнее посещение</th>
            <th>Возможные действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (Users::getUsersList() as $user): ?>
            <tr>
                <td><?php echo $user['login'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['dateCreate'] ?></td>
                <td><?php echo $user['dateVisited'] ?></td>
                <td><p class="links"><a class="btn btn-default" href="#" role="button" href="/users/view/<?php echo $user['id'] ?>">Удалить</a></p></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once ROOT . '/views/footer.php'; ?>