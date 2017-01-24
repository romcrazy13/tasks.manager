<?php

include_once ROOT . '/models/Tasks.php';

class TasksController
{

    public function actionIndex(){
        $tasks = Tasks::getTasksList();
        require_once(ROOT . '/views/tasks/index.php');
    }

    public function actionAdd(){
        if (!isset($_POST['title'])) {
            require_once(ROOT . '/views/tasks/add.php');
        }else{
            if (!in_array($_FILES['image']['type'], IMAGE_TYPES))
                $_SESSION['error'] = "Тип файла не поддерживается";

            // Проверяем размер файла
            if (($_FILES['image']['size'] > IMAGE_MAX_SIZE) && !isset($_SESSION['error']))
                $_SESSION['error'] = "Слишком большой размер файла";

            // Меняем размер картинки
            $name = $this->resize($_FILES['image']);

            // Загрузка файла и вывод сообщения
            if (!@copy(ROOT . UP_LOAD_DIR_TMP . $name, ROOT . UP_LOAD_DIR . date("YmdHis_") . $name))
                $_SESSION['error'] .= "Что-то пошло не так";

            // Удаляем временный файл
            unlink(ROOT . UP_LOAD_DIR_TMP . $name);

            $image = date("YmdHis_") . $_FILES['image']['name'];

            if (!isset($_SESSION['error'])) {
                Tasks::addTask($_SESSION['user'], $_SESSION['email'], trim($_POST['title']), $_POST['task'], $image);
                unset($_POST['title']);
            }
            header("Location: /");
        }
    }

    public function actionView($id = NULL){
        echo '<br>Class TasksController, method actionView,<br>';
        return true;
    }

    public static function actionEdit($id){
//        $tasks = Tasks::getTaskById($id);
//        require_once(ROOT . '/views/tasks/edit.php');
    }

    public function actionRemove($id){
        if ($_SESSION['user'] == 'admin') {
            $image = Tasks::getImageById($id);
            unlink(ROOT . UP_LOAD_DIR . $image);
            Tasks::removeTask($id);
            header("Location: /");
        }
    }

    // Функция изменения размера
    // Изменяет размер изображения в зависимости от type:
    //	quality - качество изображения (по умолчанию 75%)
    private function resize($file){
        // Cоздаём исходное изображение на основе исходного файла
        if ($file['type'] == 'image/jpeg')
            $src = imagecreatefromjpeg($file['tmp_name']);
        elseif ($file['type'] == 'image/png')
            $src = imagecreatefrompng($file['tmp_name']);
        elseif ($file['type'] == 'image/gif')
            $src = imagecreatefromgif($file['tmp_name']);
        else
            return false;

        $w = IMAGE_MAX_SIZE_W;
        $h = IMAGE_MAX_SIZE_H;

        // Определяем ширину и высоту изображения
        $w_src = imagesx($src);
        $h_src = imagesy($src);

        // Если ширина или высота больше заданной
        if (($w_src > $w) || ($h_src > $h)){

            // Вычисление пропорций
            if ($w_src/$w > $h_src/$h){
                $ratio = $w_src/$w;
            }else{
                $ratio = $h_src/$h;
            }

            $w_dest = round($w_src/$ratio);
            $h_dest = round($h_src/$ratio);

            // Создаём пустую картинку
            $dest = imagecreatetruecolor($w_dest, $h_dest);

            // Копируем старое изображение в новое с изменением параметров
            imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

            // Вывод картинки и очистка памяти
            imagejpeg($dest, ROOT . UP_LOAD_DIR_TMP . $file['name'], IMAGE_QUALITY);
            imagedestroy($dest);
        }else{
            // Вывод картинки и очистка памяти
            imagejpeg($src, ROOT . UP_LOAD_DIR_TMP . $file['name'], IMAGE_QUALITY);
        }
        imagedestroy($src);
        return $file['name'];
    }



}