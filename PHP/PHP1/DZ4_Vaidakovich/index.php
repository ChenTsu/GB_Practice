<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 21.05.2016
 * Time: 12:25
 */

error_reporting(E_ALL);

?>



<html>
    <head>
        <title>Галерея изображений</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Курс PHP1 ДЗ №4</h1>
        <h2>Какое-то описание картинки</h2>
        <?php for ($i = 1; $i <= 4; $i++) echo "<a href = photo.php?id=$i >Картинка №$i</a><br/>"; ?>

    <h2>Калькулятор</h2>
    <a href="sumForm1.php">Калькулятор</a><br>
    <a href="sumForm2.php">Калькулятор с памятью</a>
    </body>
</html>