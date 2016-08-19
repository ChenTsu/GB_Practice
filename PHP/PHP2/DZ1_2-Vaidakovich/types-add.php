<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 19.06.2016
 * Time: 21:06
 */

error_reporting(E_ALL);
require_once "models/db.php";
require_once "models/objects.model.php";
require_once "models/realty.model.php";
session_start();
define('ERROR_ADD_OBJECT','ERROR_ADD_OBJECT');

if ( isset($_POST['action']) )
{
    if ( $_POST['action'] === 'add' )
    {
        $objects = new_object($db_link, $_POST['object_title']);
        if ( $objects )
        {
            header("Location: types.php");
            die();
        }
        else
            $objects= ERROR_ADD_OBJECT;
    }
}

include "views/object-add.view.php";
