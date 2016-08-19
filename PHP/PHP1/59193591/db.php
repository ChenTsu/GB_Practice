<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 02.06.2016
 * Time: 20:20
 */

$link = mysqli_connect("localhost", "root", "", "lesson7");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}