<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 12.06.2016
 * Time: 14:38
 */

error_reporting(E_ALL);

session_start();
require_once "models/db.php";
require_once "models/db_users.php";


// проверка логина
if (!isset($_SESSION['username'])) {
        header("Location: auth.php");
        die();
}

// сообщение если размер файла слишком большой
if ( isset($_SESSION['max_file_size'] ))
{
    $gallery_content = 'Слишком большой файл, максимум можно '.(MAX_FILE_SIZE/1024/1024).'MiB<br>';
    unset($_SESSION['max_file_size']);
}