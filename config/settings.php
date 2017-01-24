<?php

    // Подключение к DB
    const HOST = 'localhost';
    const DB = 'tasks.manager';
    const USER = 'root';
    const PASSWORD = 'crazy13';

    // admin
    const ADMIN_LOGIN = 'admin';
    const ADMIN_PASSWORD = '123';
    const ADMIN_EMAIL = 'admin@local.host';

    // Расположение загруженных images
    const UP_LOAD_DIR = "/images/";
    const UP_LOAD_DIR_TMP = "/tmp/";

    // Параметры images
    const IMAGE_TYPES = array('image/jpeg', 'image/gif', 'image/png');
    const IMAGE_MAX_SIZE = 1024000;
    const IMAGE_MAX_SIZE_W = 320;
    const IMAGE_MAX_SIZE_H = 240;
    const IMAGE_QUALITY = 75;

?>