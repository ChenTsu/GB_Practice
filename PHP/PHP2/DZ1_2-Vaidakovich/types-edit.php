<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 19.06.2016
 * Time: 20:02
 */

error_reporting(E_ALL);
require_once "models/db.php";
require_once "models/objects.model.php";
require_once "models/realty.model.php";
session_start();
define('ERROR_EDIT_OBJECT','ERROR_EDIT_OBJECT');

if ( isset($_GET['id']))
{
    $id = (int) $_GET['id'];
}
else
{
    die('Не передан параметр id');
}

if ( isset($_POST['action']) )
{
    if ( $_POST['action'] === 'edit' )
    {
        $objects = edit_object( $db_link, $_POST['object_id'], $_POST['object_title'] );
        if ( $objects )
        {
            header("Location: types.php");
            die();
        }
        else
            $objects= ERROR_EDIT_OBJECT;
    }
}
else
    $objects = get_object_by_id($db_link, $id);

include "views/object-edit.view.php";
