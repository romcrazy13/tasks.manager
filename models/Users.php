<?php

include_once ROOT . "/components/DB.php";

class Users
{
    public static function getUserById($id){

        $result = getPDO()->query("SELECT * FROM users WHERE id = '" . $id . "'");
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
                    $stmt = getPDO()->prepare("INSERT INTO users (`login`, `password`, `email`, `dateVisited`, `dateCreate`)
                                                          VALUES (:login, :password, :email, NOW(), NOW())");
                    $stmt->bindParam(':login', $login);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();
                    return getPDO()->lastInsertId();
                } catch (PDOException $e) {
                    echo "<p class=\"text-danger h4\">Ошибка добавления записи в таблицу 'users'</p>" . $e->getMessage();
                }
            }else{
                echo "Такой email уже используется";
            }
        }else{
            echo "Такой login уже используется";
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
            echo "<p class=\"text-danger h4\">Ошибка обновления записи в таблице 'users'</p>" . $e->getMessage();
        }
    }

    public function deleteUser($id, $login, $password, $email){

    }

    private static function getCountUserByLogin($login){
        $query = getPDO()->query("SELECT COUNT(*) FROM `users` WHERE `login` = '$login'");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $row = $query->fetch();
        return $row['COUNT(*)'];
    }

    private static function getCountUserByEmail($email){
        $query = getPDO()->query("SELECT COUNT(*) FROM `users` WHERE `email` = '$email'");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $row = $query->fetch();
        return $row['COUNT(*)'];
    }

}