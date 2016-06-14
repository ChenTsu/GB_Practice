<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 30.05.2016
 * Time: 22:10
 *
 */
error_reporting(E_ALL);

include_once "settings.php";
include_once "db.php";
include_once "models/departments.php";
include_once "models/staff.php";

if (isset($_POST['action']))
{
    if ($_POST['action'] === 'new_staff')
    {
        $id_dept = $_POST['id_dept']; // тут можно проверить наличие департамента с таким id в БД
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $middlename = $_POST['middlename'];
        $salary = $_POST['salary'];


        $id = new_staff($id_dept,$name,$surname,$middlename,$salary);
        if ($id)
        {
            // все ок
        }
        else
        {
            // ошибка (пишем в сессию)
        }
        header("Location: index.php");

    }
    if ($_POST['action'] === 'delete_staff')
    {
        $id = $_POST['id'];


        if (delete_staff($id))
        {
            // все ок
        }
        else
        {
            // ошибка (пишем в сессию)
        }
        header("Location: index.php");
    }
}


$staff = get_staff();

$departments = get_departments();



mysqli_close($db_link);


include_once "views/list.php";