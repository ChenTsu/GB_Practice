<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 26.05.2016
 * Time: 14:22
 */

error_reporting(E_ALL);

if ( isset($_SESSION['styles']))
    $styles = $_SESSION['styles'];
else
    $styles="css/1.css";

$_SESSION['lastPage']='a.php';

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ДЗ5 Сираница А</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="<?php echo $styles; ?> ">
</head>
<body>
    <h1>Курс PHP1 ДЗ №5 Страница "А" </h1>
    <a href="b.php">Страница Б</a><br>
    <a href="login.php?action=logout">Выход</a>
</body>
</html>