<?php

include_once ROOT . "/components/DB.php";

class Tasks
{

    public static function getTasksList($order = 'login'){
        $tasksList = array();
        $query = getPDO()->prepare("SELECT * FROM `tasks` ORDER BY $order");
        $query->bindParam(':order', $order);
        $query->execute();
        $i = 0;
        while ($row = $query->fetch()){
            $tasksList[$i]['id'] = $row['id'];
            $tasksList[$i]['login'] = $row['login'];
            $tasksList[$i]['email'] = $row['email'];
            $tasksList[$i]['title'] = $row['title'];
            $tasksList[$i]['task'] = $row['task'];
            $tasksList[$i]['image'] = $row['image'];
            $tasksList[$i]['complete'] = $row['complete'];
            $tasksList[$i]['dateCreate'] = $row['dateCreate'];
            $i++;
        }
        return $tasksList;
    }

    public static function getTaskById($id){
        $tasks = array();
        $query = getPDO()->prepare("SELECT * FROM `tasks` WHERE `id` = :id ");
        $query->bindParam(':id', $id);
        $query->execute();
        $i = 0;
        while ($row = $query->fetch()){
            $tasks[$i]['id'] = $row['id'];
            $tasks[$i]['login'] = $row['login'];
            $tasks[$i]['email'] = $row['email'];
            $tasks[$i]['title'] = $row['title'];
            $tasks[$i]['task'] = $row['task'];
            $tasks[$i]['image'] = $row['image'];
            $i++;
        }
        return $tasks;
    }

    public static function addTask($login, $email, $title, $task, $image){
        try{
            $query = getPDO()->prepare("INSERT INTO `tasks` (`login`, `email`, `title`, `task`, `image`, `complete`, `dateCreate`)
                                                     VALUES ('$login',  '$email',  :title,  :task,  :image,  NULL,       NOW())");
            $query->bindParam(':title', $title);
            $query->bindParam(':task', $task);
            $query->bindParam(':image', $image);
            $query->execute();
            unset($_POST['title']);
        } catch (PDOException $e) {
            $_SESSION['error'] = print_r($query) . "<br><br>";
            $_SESSION['error'] .= "Ошибка добавления записи в таблицу 'users'<br>" . $e->getMessage();
        }
    }

    public function editTask($id, $login, $password, $email){
        try{
            $stmt = getPDO()->prepare("UPDATE users SET `login`     = :login,
                                                        `password`  = :password,
                                                        `email`     = :email,
                                                  WHERE `id`        = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "<p class=\"text-danger h4\">Ошибка обновления записи в таблице 'users'</p>" . $e->getMessage();
        }
    }

    public static function removeTask($id){
        $query = getPDO()->prepare("DELETE FROM `tasks` WHERE `id` = :id");
        $query->bindParam(':id', $id);
        $query->execute();
    }

    public static function getImageById($id){
        $query = getPDO()->prepare("SELECT `image` FROM `tasks` WHERE `id` = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        $row = $query->fetch();
        return $row['image'];
    }


}