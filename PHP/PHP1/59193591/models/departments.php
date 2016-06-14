<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 02.06.2016
 * Time: 22:24
 */

function get_departments()
{
    global $db_link;

    $query = "SELECT * FROM `department` WHERE 1";
    $result = mysqli_query($db_link,$query);
    $departments = array();
    while($row = mysqli_fetch_assoc($result))
    {
        //var_dump($row);
        $departments[$row['id']] = $row['title'];
    }

    return $departments;
}

function get_department_by_id($id)
{
    global $db_link;

    $id = (int) $id;

    $query = "SELECT * FROM `department` WHERE `id` = '{$id}'";
    $result = mysqli_query($db_link,$query);

    if($row = mysqli_fetch_assoc($result))
    {
        return $row;
    }
    else
    {
        return false;
    }

}