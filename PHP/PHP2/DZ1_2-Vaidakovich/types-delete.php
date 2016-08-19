<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 19.06.2016
 * Time: 20:45
 */

error_reporting(E_ALL);
require_once "models/db.php";
require_once "models/objects.model.php";
require_once "models/realty.model.php";
session_start();
define("ERROR_DELETE_OBJECT",'ERROR_DELETE_OBJECT');
define('ERROR_DELETE_OBJECT_CONSTRAINT', 'ERROR_DELETE_OBJECT_CONSTRAINT');


if ( isset($_GET['id']))
{
    $id = (int) $_GET['id'];
}
else
{
    die('Не передан параметр id');
}

if ( isset ($_POST['action']) ) {
    if ($_POST['action'] === 'delete') {
        $objects = delete_object($db_link, $_POST['object_id']);

        if ( $objects === ERROR_SQL_DELETE_CONSTRAINT )
            $objects = ERROR_DELETE_OBJECT_CONSTRAINT;
        elseif ( $objects === ERROR_SQL_DELETE )
        {
//            $objects = ERROR_DELETE_OBJECT;
        }
        else
        {
            header("Location: types.php");
            die();
        }
    }
}
else
    $objects = get_object_by_id($db_link, $id);

include "views/object-delete.view.php";