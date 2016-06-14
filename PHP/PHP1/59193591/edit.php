<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 02.06.2016
 * Time: 20:25
 */
error_reporting(E_ALL);

include_once "settings.php";
include_once "db.php";
include_once "models/departments.php";
include_once "models/staff.php";




if (isset($_POST['action']))
{
    if ($_POST['action'] === 'edit_staff')
    {
        $id = $_POST['id']; // в идеале - проверяем на существование такого пользователя.
        $id_dept = $_POST['id_dept']; // тут можно проверить наличие департамента с таким id в БД
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $middlename = $_POST['middlename'];
        $salary = $_POST['salary'];


        if (edit_staff($id,$id_dept,$name,$surname,$middlename,$salary))
        {
            // все ок
        }
        else
        {

        }
        header("Location: edit.php?id={$id}");
    }
}



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

$departments = get_departments();

include_once "views/edit.php";