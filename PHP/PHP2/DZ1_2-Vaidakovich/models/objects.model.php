<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 18.06.2016
 * Time: 13:08
 */

require_once "db.php";

define('ERROR_SQL_INSERT', 'ERROR_SQL_INSERT');
define('ERROR_SQL_UPDATE', 'ERROR_SQL_UPDATE');
define('ERROR_SQL_DELETE', 'ERROR_SQL_DELETE');
define('ERROR_SQL_DELETE_CONSTRAINT', 'ERROR_SQL_DELETE_CONSTRAINT');



function new_object ($db_link, $object_title)
{
    $query = "INSERT INTO `objects` (`id`, `title`) VALUES (NULL, '{$object_title}');";
    if ( $result = mysqli_query($db_link,$query) )
    {
        return mysqli_insert_id($db_link);
    }
    else
        return ERROR_SQL_INSERT;
}

function edit_object ($db_link, $object_id, $object_title)
{
    $query = "UPDATE `objects` SET `title` = '{$object_title}' WHERE `objects`.`id` = {$object_id};";
    if ( $result = mysqli_query($db_link,$query) )
    {
        return true;
    }
    else
        return ERROR_SQL_UPDATE;
}

function delete_object ($db_link, $object_id)
{
    $query = "DELETE FROM `objects` WHERE `objects`.`id` = {$object_id} LIMIT 1;";
    mysqli_query($db_link,$query);
    $result = mysqli_errno( $db_link );
    if ( $result == 1451  )
    {
        return ERROR_SQL_DELETE_CONSTRAINT;
//        return $result;
    }
    elseif ( $result )
        return ERROR_SQL_DELETE;
    else
        return true;
}

function get_object_by_id ( $db_link, $object_id )
{
    $query = "SELECT * FROM `objects` WHERE `id`={$object_id};";
    if ( $result = mysqli_query($db_link, $query))
    {
        if ( $row = mysqli_fetch_assoc($result))
            return $row;
    }
    else
        return false;
}

function get_all_objects ($db_link)
{
    $all_objects = array();

    $query = "SELECT * FROM `objects`;";
    if ( $result = mysqli_query($db_link, $query))
    {
        while ( $row = mysqli_fetch_assoc( $result ) )
        {
            $all_objects[] = $row;
        }
        return $all_objects;
    }
    else
        return false;
}