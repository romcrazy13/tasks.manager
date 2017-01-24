<?php

include_once ROOT . "/components/DB.php";

class Users
{
    public static function getUserById($id){
        $result = getPDO()->query("SELECT * FROM `users` WHERE id = '" . $id . "'");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }

    public static function getUsersList($order = 'login'){
        $userList = array();
        $result = getPDO()->query("SELECT * FROM `users` ORDER BY $order");
        $i = 0;
        while ($row = $result->fetch()){
            $userList[$i]['id'] = $row['id'];
            $userList[$i]['login'] = $row['login'];
            $userList[$i]['password'] = $row['password'];
            $userList[$i]['email'] = $row['email'];
            $userList[$i]['dateCreate'] = $row['dateCreate'];
            $userList[$i]['dateVisited'] = $row['dateVisited'];
            $i++;
        }
        return $userList;
    }

    public static function addUser($login, $email, $password){
        if (self::getCountUserByLogin($login) == 0){
            if (self::getCountUserByEmail($email) == 0){
                try{
                    $query = getPDO()->prepare("INSERT INTO users (`login`, `password`, `email`, `dateVisited`, `dateCreate`)
                                                           VALUES (:login, :password, :email, NOW(), NOW())");
                    $query->bindParam(':login', $login);
                    $query->bindParam(':password', $password);
                    $query->bindParam(':email', $email);
                    $query->execute();
                    $_SESSION['userId'] = getPDO()->lastInsertId();
                    $_SESSION['user'] = $login;
                    $_SESSION['email'] = $email;
                    unset($_POST['login']);
                } catch (PDOException $e) {
                    $_SESSION['error'] = "Ошибка добавления записи в таблицу 'users'<br>" . $e->getMessage();
                }
            }else{
                $_SESSION['error'] = "Такой email уже используется";
            }
        }else{
            $_SESSION['error'] = "Такой login уже используется";
        }
    }

    public function loginUser($login, $password){
        $query = getPDO()->prepare("SELECT COUNT(*) FROM `users`
                                    WHERE ((`login`   = :login) ||
                                          (`email`    = :login)) &&
                                          (`password` = :password)");
        $query->bindParam(':login', $login);
        $query->bindParam(':password', $password);
        $query->execute();
        $row = $query->fetch();
        if ($row['COUNT(*)'] == 1){
            $query = getPDO()->prepare("SELECT * FROM `users`
                                        WHERE ((`login`   = :login) ||
                                              (`email`    = :login)) &&
                                              (`password` = :password)");
            $query->bindParam(':login', $login);
            $query->bindParam(':password', $password);
            $query->execute();
            $i = 0;
            while ($row = $query->fetch()){
                $_SESSION['userid'] = $row['id'];
                $_SESSION['user'] = $row['login'];
                $_SESSION['email'] = $row['email'];
                $i++;
            }
            unset($_POST['login']);
            return true;
        }else{
            $_SESSION['error'] = "Логин или пароль введены неправильно!";
            return false;
        }
    }

    public function editUser($id, $login, $password, $email){
        try{
            $stmt = getPDO()->prepare("UPDATE users SET `login`       = :login,
                                                        `password`    = :password,
                                                        `email`       = :email,
                                                        `dateVisited` = NOW(),
                                                  WHERE `id`          = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
             $_SESSION['error'] = "Ошибка обновления записи в таблице 'users'<br>" . $e->getMessage();
        }
    }

    public static function removeUser($id){
        $query = getPDO()->prepare("DELETE FROM `users` WHERE `id` = :id");
        $query->bindParam(':id', $id);
        $query->execute();
    }

    private static function getCountUserByLogin($login){
        $query = getPDO()->prepare("SELECT COUNT(*) FROM `users` WHERE `login` = :login");
        $query->bindParam(':login', $login);
        $query->execute();
        $row = $query->fetch();
        return $row['COUNT(*)'];
    }

    private static function getCountUserByEmail($email){
        $query = getPDO()->prepare("SELECT COUNT(*) FROM `users` WHERE `email` = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        $row = $query->fetch();
        return $row['COUNT(*)'];
    }

    public function updateVisitedDate($id){
        $query = getPDO()->prepare("UPDATE `users` SET `dateVisited` = NOW() WHERE `id` = :id");
        $query->bindParam(':id', $id);
        $query->execute();
    }

}