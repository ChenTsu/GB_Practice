<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 22.06.2016
 * Time: 13:57
 */

require_once "db.php";

define('ERROR_SQL_INSERT', 'ERROR_SQL_INSERT');
define('ERROR_SQL_UPDATE', 'ERROR_SQL_UPDATE');
define('ERROR_SQL_DELETE', 'ERROR_SQL_DELETE');
define('ERROR_SQL_DELETE_CONSTRAINT', 'ERROR_SQL_DELETE_CONSTRAINT');


function new_realty_type ( $type_title)
{
    global $db_link;

    $query = "INSERT INTO `realty_types` (`id`, `title`) VALUES (NULL, '{$type_title}');";
    if ( $result = mysqli_query($db_link,$query) )
    {
        return mysqli_insert_id($db_link);
    }
    else
        return ERROR_SQL_INSERT;
}

function edit_realty_type ( $type_id, $type_title)
{
    global $db_link;

    $query = "UPDATE `realty_types` SET `title` = '{$type_title}' WHERE `realty_types`.`id` = {$type_id};";
    if ( $result = mysqli_query($db_link,$query) )
    {
        return true;
    }
    else
        return ERROR_SQL_UPDATE;
}

function delete_realty_type ( $type_id)
{
    global $db_link;

    $query = "DELETE FROM `realty_types` WHERE `realty_types`.`id` = {$type_id} LIMIT 1;";
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

function get_realty_type_by_id (  $type_id )
{
    global $db_link;

    $query = "SELECT * FROM `realty_types` WHERE `id`={$type_id};";
    if ( $result = mysqli_query($db_link, $query))
    {
        if ( $row = mysqli_fetch_assoc($result))
            return $row;
    }
    else
        return false;
}

function get_all_realty_types ()
{
    global $db_link;

    $all_types = array();

    $query = "SELECT `realty_types`.*, `realty`.`id` AS `realty_id` FROM `realty_types` LEFT JOIN `realty` ON `realty`.`realty_type` = `realty_types`.`id` ;";
    if ( $result = mysqli_query($db_link, $query))
    {
        while ( $row = mysqli_fetch_assoc( $result ) )
        {
            $all_types[] = $row;
        }
        return $all_types;
    }
    else
        return false;
}