<?php

include_once ROOT . "/components/DB.php";

class Tasks
{
    /**
     * @return array
     */
    public static function getTasksList(){
        $tasksList = array();
        $result = getPDO()->query("SELECT * FROM `tasks` ORDER BY 'login'");
        $i = 0;
        while ($row = $result->fetch()){
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

    /**
     * @param $id
     * @return mixed
     */
    public static function getTaskById($id){
        $result = makeDBH()->query("SELECT * FROM users WHERE id = '" . $id . "'");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }

    /**
     * @param $login
     * @param $password
     * @param $email
     * @return string
     */
    public function addTask($title, $task, $image){
        try{
            $stmt = getPDO()->prepare("INSERT INTO tasks (`title`, `task`, `image`) VALUES (:login, :password, :email)");
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return getDBH()->lastInsertId();
        } catch (PDOException $e) {
            echo "<p class=\"text-danger h4\">Ошибка добавления записи в таблицу 'users'</p>" . $e->getMessage();
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

    public function deleteUser($id, $login, $password, $email){

    }

}