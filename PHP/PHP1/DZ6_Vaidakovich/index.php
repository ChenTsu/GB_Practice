<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 31.05.2016
 * Time: 10:55
 */
session_start();

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


if ( isset($_FILES['image_file']) )
{
    if ( move_uploaded_file( $_FILES['image_file']['tmp_name'], "images/{$_SESSION['username']}/{$_FILES['image_file']['name']}") )
    {
//                вызывать создание превью
    }
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
            <div class="image_preview" > <a href="$img" target="_blank" title="$img_title"> <img src="$img_preview"> $img_title</a> </div>
            <?php echo $gallery_content; ?>
            <div class="clear" ></div>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image_file">
            <button type="submit" name="add_file">Добавить</button>
        </form>

    </div>
    <div class="footer"></div>
</body>
</html>
