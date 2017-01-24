<?php

include_once ROOT . '/models/Users.php';

class UsersController
{
    public function actionIndex(){
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
            if (trim($_POST['password']) == trim($_POST['confirm-password'])) {
                Users::addUser(trim($_POST['login']), trim($_POST['email']), trim($_POST['password']));
            }else {
                $_SESSION['error'] = "Пароли должны быть одинаковы!";
            }
            unset($_POST['login']);
            header("Location: /");
        }
    }

    public function actionLogin(){
        if (!isset($_POST['login'])) {
            require_once(ROOT . '/views/users/login.php');
        }else{
            if (Users::loginUser($_POST['login'], $_POST['password'])){
                Users::updateVisitedDate($_SESSION['userid']);
            }
            unset($_POST['login']);
            header("Location: /");
        }
    }

    public function actionCansel(){
        unset($_SESSION['user']);
        unset($_SESSION['userid']);
        header("Location: / ");
    }

    public function actionEdit(){
        require_once(ROOT . '/views/users/edit.php');
    }

    public function actionRemove($id){
        if ($_SESSION['user'] == 'admin') {
            Users::removeUser($id);
            $this->actionIndex();
        }
    }

}


