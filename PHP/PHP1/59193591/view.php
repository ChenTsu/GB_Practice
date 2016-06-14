<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 02.06.2016
 * Time: 20:25
 */
error_reporting(E_ALL);

include_once "db.php";
include_once "models/departments.php";
include_once "models/staff.php";


if (isset($_GET['id']))
{
    $id = $_GET['id'];


    if($employee = get_staff_by_id($id))
    {
        //var_dump($row);
    }
    else
    {
        //error 404 = header(),

        die("Ошибка - сотрудник с таким ID не найден");

    }

}
else
{
    //error 404 = header(),

    die("Ошибка - не передан параметр");
}

//$departments = get_departments();

include_once "views/view.php";

