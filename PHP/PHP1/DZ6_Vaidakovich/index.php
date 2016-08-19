<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 31.05.2016
 * Time: 10:55
 *
 * Базовый блок
 * Создайте  галерею  фотографий.  Она  должна  состоять  всего  из  одной  странички,  на которой пользователь
 * видит все картинки в уменьшенном виде и форму для загрузки нового изображения. При клике на фотографию она должна
 * открыться в браузере в новой вкладке. Размер картинок можно ограничивать с помощью свойства width.
 * При загрузке изображения необходимо делать проверку на тип и размер файла.
 *
 * Продвинутый блок
 * При загрузке изображения на сервер должна создаваться его уменьшенная копия.
 * А на странице index.php должны выводиться именно копии. На реальных сайтах это активно
 * используется для экономии трафика. При клике на уменьшенное изображение в браузере в новой вкладке должен
 * открываться оригинал изображения. Функция  изменения  размера  карт инок  дана  в  исходниках.
 * (Но мы вам её пока не дадим, сходите спросите у гугла :) )
 *  Вам  необходимо  суметь встроить её в систему.
 */

error_reporting(E_ALL);

mb_internal_encoding('utf8');
setlocale( LC_ALL, 'utf-8');
session_start();

require 'functions.php';


define('MAX_WIDTH', 3000);//max image width
define('MAX_HEIGHT', 3000);//max image height
define('MAX_FILE_SIZE', 20*1024*1024); //20 MiB //ALSO in php.ini upload_max_filesize=30M-параметр определяет максимальный размер, превышение которого просто не пропускает файл на сервер через форму, передаются только $_FILES['name'] и $_FILE['error'] === 1  ;  and post_max_size=31M -задаёт максимальный размер данных передаваемых метдом POST, при превышении выводится warning о максимально допустимом значении

$gallery_content = '';

// проверка логина
if (!isset($_SESSION['username'])) {
    if (isset($_COOKIE['username'])) {
        $_SESSION['username'] = $_COOKIE['username'];
    } else {
        header("Location: auth.php");
        die();
    }
}

// сообщение если размер файла слишком большой
if ( isset($_SESSION['max_file_size'] ))
{
    $gallery_content = 'Слишком большой файл, максимум можно '.(MAX_FILE_SIZE/1024/1024).'MiB<br>';
    unset($_SESSION['max_file_size']);
}

// строим список файлов в директории, проверяем/создаём превью, формируем контент
$uploaded_file_path="images/{$_SESSION['username']}";
foreach (scandir($uploaded_file_path, SCANDIR_SORT_NONE ) as $dir_files) {
    if ( is_dir("{$uploaded_file_path}/{$dir_files}")  )
        continue;
    else
    {
        //if ( is_file( "$uploaded_file_path/preview/{$dir_files}" ))
            $gallery_content .= <<<HTML
    <div class="image_preview" >
        <a href="$uploaded_file_path/$dir_files" target="_blank" title="$dir_files">
            <img src="$uploaded_file_path/preview/{$dir_files}">
        {$dir_files}</a>
    </div>
HTML;
        /*else
        {
            smart_resize_image("{$uploaded_file_path}/{$dir_files}", 150, 150, true, "$uploaded_file_path/preview/{$dir_files}");
            $gallery_content .= "<div class=\"image_preview\" >
                                    <a href=\"$uploaded_file_path/$dir_files\" target=\"_blank\" title=\"$dir_files\">
                                        <img src=\"$uploaded_file_path/preview/{$dir_files}\">
                                    {$dir_files}</a>
                                 </div>";
        }*/
    }
}
if ( $gallery_content==='')
    $gallery_content = "Вы пока не загрузили файлы";

// обработка формы
//var_dump($_FILES);echo "<br><hr>";
if (isset($_FILES['image_file'])) // если добавили файл
{
    if ( $_FILES['image_file']['error'] === 0 ) // ошибок нет значит файл загрузился на сервер и с ним можно работать
    {
        $uploaded_files = $_FILES['image_file'];
        var_dump($uploaded_files);
        echo "<br><hr>";

        // не обрабатываем файлы размер которых нам не понравился и удаляем их
        if ($uploaded_files['size'] > MAX_FILE_SIZE) {
            unlink($uploaded_files['tmp_name']);
            $_SESSION['max_file_size'] = true;
//        var_dump($_SESSION['max_file_size']);
            unset($_FILES);
            header("location: index.php");
            die();
        }
        // если похоже на картинку то обрабатываем
        if ($uploaded_files['type'] == 'image/jpeg' OR $uploaded_files['type'] == 'image/pjpeg' OR
            $uploaded_files['type'] == 'image/bmp' OR $uploaded_files['type'] == 'image/x-windows-bmp' OR
            $uploaded_files['type'] == 'image/gif' OR $uploaded_files['type'] == 'image/png'
        ) {
            $img_title = $uploaded_files['name'];
            $uploaded_file_path = "images/{$_SESSION['username']}/{$img_title}";

            if (!is_file($uploaded_file_path))// такого файла ещё нет
                {
                //if (move_uploaded_file($uploaded_files['tmp_name'], iconv( "utf-8", "windows-1251", $uploaded_file_path )))// переместили в папку пользователя успешно // используем iconv т.к. походу php в/или виндовс (или я хз что ещё) не поддерживает utf-8
                if (move_uploaded_file($uploaded_files['tmp_name'], $uploaded_file_path ))// переместили в папку пользователя успешно
                {   //  вызывать создание превью
                    smart_resize_image($uploaded_file_path, 150, 150, true, "images/{$_SESSION['username']}/preview/$img_title");
                    //формируем контент
                    $img_preview = "images/{$_SESSION['username']}/preview/$img_title";
                    $gallery_content .= "<div class=\"image_preview\" >
                                    <a href=\"$uploaded_file_path\" target=\"_blank\" title=\"$img_title\">
                                        <img src=\"$img_preview\">
                                    $img_title</a>
                                 </div>";
                }
            }
        }
        else    // не картинка - убиваем чтоб не раздувал /tmp сервака
        {
            unlink($uploaded_files['tmp_name']);
        }
    }
    unset($_FILES);
    header("location: index.php"); // чтобы сбросить форму и избавиться от POST-запроса
    die();
}


?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Галлерея фотографий</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">
    <h1>Курс PHP1 ДЗ №6 работа с файлами</h1>

    <div class="gallery">
        <?php echo $gallery_content; ?>
        <div class="clear"></div>
    </div>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image_file">
        <button type="submit" name="add_file">Добавить</button>
    </form>
    <hr>
    <div class="auth">
        <form action="auth.php" method="post">
            <input type="hidden" name="action" value="logout"/>
            <button type="submit" >Выход</button>
        </form>
<!--        <a href="auth.php?action=logout">Выход</a>-->
    </div>

</div>
<div class="footer"></div>
</body>
</html>
