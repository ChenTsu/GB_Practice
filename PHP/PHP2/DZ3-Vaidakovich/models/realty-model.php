<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 22.06.2016
 * Time: 13:54
 */

require_once "db.php";

function new_realty($type_id, $address, $square, $price, $additional_description, $realtor, $main_description, $category )
{
    global $db_link;

    $query = "INSERT INTO `realty` (`id`, `realty_type`, `address`, `square`, `price`, `additional`, `agent`, `description`, `category`)
              VALUES (NULL, '{$type_id}', '{$address}', '{$square}', '{$price}', '{$additional_description}', '{$realtor}', '{$main_description}', '{$category}');";

    if ( $result = mysqli_query($db_link, $query))
    {
        return mysqli_insert_id($db_link);
    }
    else
        return false;
}

function get_realty_by_id ($realty_id)
{
    global $db_link;

    $query = "SELECT `id`, (SELECT `title` FROM `realty_types` WHERE `realty_types`.`id`=`realty`.`id`) AS `type`, `address`, `square`, `price`, `additional`, `agent`, `description`, `category` FROM `realty` WHERE `id`={$realty_id};";
    if ( $result = mysqli_query($db_link, $query))
    {
        if ( $row = mysqli_fetch_assoc($result))
            return $row;
        else
            return false;
    }
    else
        return false;
}

function get_all_realty ()
{
    global $db_link;

    $all_realty = array();
    $query = "SELECT `id`, (SELECT `title` FROM `realty_types` WHERE `realty_types`.`id`=`realty`.`realty_type`) AS `type`, `address`, `square`, `price`, `additional`, `agent`, `description`, `category` FROM `realty`;";
    if ( $result = mysqli_query($db_link, $query))
    {
        while ( $row = mysqli_fetch_assoc( $result ) )
        {
            $all_realty[] = $row;
        }
        return $all_realty;
    }
    else
        return false;
}

function edit_realty( $realty_id, $type_id, $address, $square, $price, $additional_description, $realtor, $main_description, $category )
{
    global $db_link;

    $query = "UPDATE `realty` SET
              `realty_type` = '{$type_id}', `address` = '{$address}', `square` = '{$square}', `price` = '{$price}', `additional` = '{$additional_description}',
              `agent` = '{$realtor}', `description` = '{$main_description}', `category` = '{$category}' WHERE `realty`.`id` = {$realty_id};";

    if ( $result = mysqli_query($db_link, $query))
    {
        return true;
    }
    else
        return false;
}

function delete_realty (  $realty_id)
{
    global $db_link;

    $query = "DELETE FROM `realty` WHERE `realty`.`id` = {$realty_id} LIMIT 1;";
    if ( $result = mysqli_query($db_link,$query) )
    {
        return true;
    }
    else
        return false;
}