<?php include_once ROOT . '/views/header.php'; ?>

    <div class="container">
        <h2>Задания</h2>
        <table class="table table-striped table-condensed table-hover">
            <thead>
            <tr>
                <th><div id="login">Логин пользователя</div></th>
                <th><div id="email">Электронная почта</div></th>
                <th><div id="complete">Статус</div></th>
                <th>Дата создания</th>
                <th>Возможные действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach (Tasks::getTasksList() as $task): ?>
                <tr class="<?php if (isset($task['complete'])) echo "success"; ?>">
                    <td><?php echo $task['login'] ?></td>
                    <td><?php echo $task['email'] ?></td>
                    <td><?php echo $task['complete'] ?></td>
                    <td><?php echo $task['dateCreate'] ?></td>
                    <td>
                        <input type="button" value="Обзор" onclick="location.href='/task/view/<?php echo $task['id'] ?>';">
                        <?php if ($_SESSION['user'] == 'admin'){ ?>
                            <input type="button" value="Изменить" onclick="location.href='/task/edit/<?php echo $task['id'] ?>';">
                            <input type="button" value="Удалить" onclick="if(confirm('Вы действительно желаете удалить задание?'))location.href='/task/remove/<?php echo $task['id'] ?>';">
                        <?php } ?>
                    </td>
                </tr>
                <tr class="<?php if (isset($task['complete'])) echo "success"; ?>">
                    <td colspan="4"><?php echo $task['title'] ?></td>
                    <td rowspan="2"><img src="<?php echo UP_LOAD_DIR . $task['image'] ?>" width="320" height="240"></td>
                </tr>
                <tr>
                    <td colspan="5"><textarea rows="10" cols="80" readonly><?php echo $task['task'] ?></textarea></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php include_once ROOT . '/views/footer.php'; ?>