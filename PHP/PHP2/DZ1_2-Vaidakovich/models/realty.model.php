<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 18.06.2016
 * Time: 13:41
 */

require_once "db.php";

function new_realty($db_link, $object_id, $address, $square, $price, $additional_description, $realtor, $main_description, $category )
{
    $query = "INSERT INTO `eajakzes_immovable`.`realty` (`id`, `object`, `address`, `square`, `price`, `additional`, `agent`, `description`, `category`)
              VALUES (NULL, '{$object_id}', '{$address}', '{$square}', '{$price}', '{$additional_description}', '{$realtor}', '{$main_description}', '{$category}');";

    if ( $result = mysqli_query($db_link, $query))
    {
        return mysqli_insert_id($db_link);
    }
    else
        return false;
}

function get_realty_by_id ($db_link, $realty_id)
{
    $query = "SELECT `id`, (SELECT `title` FROM `objects` WHERE `objects`.`id`=`realty`.`id`) AS `object`, `address`, `square`, `price`, `additional`, `agent`, `description`, `category` FROM `realty` WHERE `id`={$realty_id};";
    if ( $result = mysqli_query($db_link, $query))
    {
        if ( $row = mysqli_fetch_assoc($result))
            return $row;
    }
    else
        return false;
}

function get_all_realty ($db_link)
{
    $all_realty = array();
    $query = "SELECT `id`, (SELECT `title` FROM `objects` WHERE `objects`.`id`=`realty`.`object`) AS `object`, `address`, `square`, `price`, `additional`, `agent`, `description`, `category` FROM `realty`;";
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

function edit_realty( $db_link, $realty_id, $object_id, $address, $square, $price, $additional_description, $realtor, $main_description, $category )
{
    $query = "UPDATE `eajakzes_immovable`.`realty` SET
              `object` = '{$object_id}', `address` = '{$address}', `square` = '{$square}', `price` = '{$price}', `additional` = '{$additional_description}',
              `agent` = '{$realtor}', `description` = '{$main_description}', `category` = '{$category}' WHERE `realty`.`id` = {$realty_id};";

    if ( $result = mysqli_query($db_link, $query))
    {
        return true;
    }
    else
        return false;
}

function delete_realty ( $db_link, $realty_id)
{
    $query = "DELETE FROM `realty` WHERE `realty`.`id` = {$realty_id} LIMIT 1;";
    if ( $result = mysqli_query($db_link,$query) )
    {
        return true;
    }
    else
        return false;
}