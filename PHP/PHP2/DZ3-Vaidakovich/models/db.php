<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 13.06.2016
 * Time: 10:26
 */

$db_link = mysqli_connect("localhost", "eajakzes_realty", "C6I0r2zT", "eajakzes_immovable");
//$db_link = mysqli_connect("localhost", "root", "2k4p", "eajakzes_immovable");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
if (!mysqli_set_charset($db_link, "utf8"))
{
    printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($db_link));
    exit();
}