<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 12.06.2016
 * Time: 14:38
 */

error_reporting(E_ALL);

session_start();
define('MAX_FILE_SIZE', 20*1024*1024); //20 MiB //ALSO in php.ini upload_max_filesize=30M-параметр определяет максимальный размер, превышение которого просто не пропускает файл на сервер через форму, передаются только $_FILES['name'] и $_FILE['error'] === 1  ;  and post_max_size=31M -задаёт максимальный размер данных передаваемых метдом POST, при превышении выводится warning о максимально допустимом значении
require_once "models/db.php";
require_once "models/db_users.php";

$gallery_content = '';

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