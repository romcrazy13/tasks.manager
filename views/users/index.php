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
            <?php if ($_SESSION['user'] == 'admin'){ ?>
                <th>Возможные действия</th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach (Users::getUsersList() as $user): ?>
            <tr>
                <td><?php echo $user['login'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['dateCreate'] ?></td>
                <td><?php echo $user['dateVisited'] ?></td>
                <?php if ($_SESSION['user'] == 'admin'){ ?>
                    <td><input type="button" value="Удалить" onclick="if(confirm('Вы действительно желаете удалить пользователя?'))location.href='/user/remove/<?php echo $user['id'] ?>';"></td>
                <?php } ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once ROOT . '/views/footer.php'; ?>