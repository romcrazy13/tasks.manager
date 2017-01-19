<?php

include_once ROOT . '/models/Tasks.php';

class TasksController
{

    public function actionIndex(){
//        echo '<br>Class TasksController, method actionIndex';
        $tasks = Tasks::getTasksList();
        require_once(ROOT . '/views/tasks/index.php');
    }

    public function actionView($id = NULL){
        echo '<br>Class TasksController, method actionView,<br>';

        return true;
    }

}