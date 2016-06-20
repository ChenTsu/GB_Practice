<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 13.06.2016
 * Time: 10:26
 */

$db_link = mysqli_connect("localhost", "root", "2k4p", "immovable");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}