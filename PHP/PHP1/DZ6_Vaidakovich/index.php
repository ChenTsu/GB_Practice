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

require 'functions.php';

session_start();

define ('MAX_WIDTH', 3000);//max image width
define ('MAX_HEIGHT', 3000);//max image height
define ('MAX_FILE_SIZE', 3,145728e+7); // changed to 30 MiB

$gallery_content ='';


if ( !isset($_SESSION['username']) )
{
    if ( isset( $_COOKIE['username']))
    {
        $_SESSION['username'] = $_COOKIE['username'];
    }
    else
    {
        header( "Location: auth.php");
        die();
    }
}


var_dump( $_FILES );
if ( isset($_FILES['image_file']) )
{
//    foreach ( $_FILES as $uploaded_files )
//    {
//        // пропускаем файлы размер которых нам не понравился
//        if ( $uploaded_files['size'] > MAX_FILE_SIZE )
//            continue;
//
//        // если похоже на картинку то обрабатываем
//        if (    $uploaded_files['type'] == 'image/jpeg' OR $uploaded_files['type'] == 'image/pjpeg' OR
//                $uploaded_files['type'] == 'image/bmp' OR $uploaded_files['type'] == 'image/x-windows-bmp' OR
//                $uploaded_files['type'] == 'image/gif' OR $uploaded_files['type'] == 'image/png'         )
//        {
//            var_dump( $uploaded_files);
//            $img_title = $uploaded_files['name'];
//            $uploaded_file_moved = "images/{$_SESSION['username']}/{$uploaded_files['name']}";
//
//            if ( move_uploaded_file( $uploaded_files['tmp_name'], $uploaded_file_moved ) )
//            {   //  вызывать создание превью
//                smart_resize_image ( $uploaded_file_moved, 150, 150, true, "images/{$_SESSION['username']}/preview/".basename($uploaded_file_moved));
//                $img_preview = "images/{$_SESSION['username']}/preview/".basename($uploaded_file_moved);
//                $gallery_content .= "<div class=\"image_preview\" > <a href=\"$uploaded_file_moved\" target=\"_blank\" title=\"$img_title\"> <img src=\"$img_preview\"> $img_title</a> </div>";
//            }
//        }
//        else    // не картинка - убиваем чтоб не раздувал /tmp сервака
//        {
//            unlink( $uploaded_files['tmp_name'] );
//        }
//    }
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
        <div class="auth"><a href="auth.php&action=logout">Выход</a> </div>
        <div class="gallery">

            <?php echo $gallery_content; ?>
            <div class="clear" ></div>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" multiple name="image_file[]">
            <button type="submit" name="add_file">Добавить</button>
        </form>

    </div>
    <div class="footer"></div>
</body>
</html>
