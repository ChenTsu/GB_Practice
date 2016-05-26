<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 26.05.2016
 * Time: 16:57
 */

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Настройки</title>
    <style>
        label:nth-child(n):hover {
            color: #00aa00;
        }
    </style>
</head>
<body>
    <h3>Выберите цветовую схему</h3>

    <form action="" method="post">
        <label for="" ><input type="radio" name="color_theme"> Фон 1</label> <br>
        <label for="" ><input type="radio" name="color_theme"> Фон 2</label> <br>
        <label for="" ><input type="radio" name="color_theme"> Фон 3</label> <br>
        <input type="submit">
    </form>

    <a href="index.php">Назад</a>
</body>
</html>
