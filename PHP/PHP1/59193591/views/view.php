<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 02.06.2016
 * Time: 22:52
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<a href="/">К списку</a>
Привет!
<h1><?= $employee['name'].' '.$employee['surname'].' '.$employee['middlename'] ?></h1>
<h2><?= $employee['department'] ?></h2>
<p>Зарплата: <?= $employee['salary'] ?></p>
<hr/>
<p><a href="edit.php?id=<?= $employee['id'] ?>">Редактировать</a></p>


</body>
</html>

