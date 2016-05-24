<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 21.05.2016
 * Time: 12:26
 */

$id = $_GET['id']; // Считываем передаваемый параметр ?>


<html>
<head>
    <title>Просмотр картинки № <?php echo $id; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<img src="img/<?php echo $id; ?>.jpg" width="300"/>

<h2>Какое-то описание картинки</h2>
</body>
</html>