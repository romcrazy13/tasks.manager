<?php

return array(

    '#root'                         => 'tasks/index',

// Регистрация, вход и выход пользователя
    'user/add'                      => 'users/add',
    'user/login'                    => 'users/login',
    'user/cansel'                   => 'users/cansel',

    'users'                         => 'users/index',
    'user/view/([0-9]+)'            => 'users/view/$1',
    'user/edit'                     => 'users/edit',
    'user/remove/([0-9]+)'          => 'users/remove/$1',

    'tasks'                         => 'tasks/index',
    'task/add'                      => 'tasks/add',
    'task/view/([0-9]+)'            => 'tasks/view/$1',
    'task/edit/([0-9]+)'            => 'tasks/edit/$1',
    'task/remove/([0-9]+)'          => 'tasks/remove/$1',

);


