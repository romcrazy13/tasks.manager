<?php

return array(

    'users'                         => 'users/index',       // action Index in UsersController
    'users/view/([0-9]+)'           => 'users/view/$1',     // action View in UsersController
    'users/add'                     => 'users/add',
    'users/edit'                    => 'users/edit',        // action View in UsersController
    'users/delete'                  => 'users/delete',      // action View in UsersController


    'tasks'                         => 'tasks/index',       // action Index in TasksController
    'tasks/view/([0-9]+)'           => 'tasks/view/$1',     // action View in TasksController

);


