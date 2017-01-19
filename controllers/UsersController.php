<?php

include_once ROOT . '/models/Users.php';

class UsersController
{
    public function actionIndex(){
//        echo '<br>Class UsersController, method actionIndex';

        $users = Users::getUsersList();
        require_once(ROOT . '/views/users/index.php');
    }

    public function actionView($id = 0){
        echo '<br>Class UsersController, method actionView';

        $user = Users::getUserById($id);

        if ($user){
            echo '<pre>';
            print_r($user);
            echo '</pre>';
        }else{
            echo "Пользователь не найден!";
        }

        require_once ROOT . '/views/users/view.php';
        return true;
    }

    public function actionAdd(){
        if (!isset($_POST['login'])) {
            require_once(ROOT . '/views/users/add.php');
        }else{
            echo 'actionAdd<br>';
            if ($_POST['password'] == $_POST['confirm-password']) {
                Users::addUser($_POST['login'], $_POST['email'], $_POST['password']);
            }else {
                echo "<p>Пароли должны быть одинаковы!</p>";
                return "<p>Пароли должны быть одинаковы!</p>";
            }
            unset($_POST['login']);
        }
    }

    public function actionEdit(){
        require_once(ROOT . '/views/users/edit.php');
    }

    public function actionDelete(){
        require_once(ROOT . '/views/users/delete.php');
    }

}


