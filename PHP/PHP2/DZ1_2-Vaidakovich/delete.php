<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 19.06.2016
 * Time: 18:24
 */

error_reporting(E_ALL);
require_once "models/db.php";
require_once "models/objects.model.php";
require_once "models/realty.model.php";
session_start();
define("ERROR_DELETE_REALTY",'ERROR_DELETE_REALTY');

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
        $realty = delete_realty($db_link, $_POST['realty_id']);
        if ( $realty )
        {
            header("Location: index.php");
            die();
        }
        else
            $realty = ERROR_DELETE_REALTY;
    }
}
else
    $realty = get_realty_by_id($db_link, $id);

include "views/realty-delete.view.php";