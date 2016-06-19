<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 19.06.2016
 * Time: 16:10
 */

error_reporting(E_ALL);
require_once "models/db.php";
require_once "models/objects.model.php";
require_once "models/realty.model.php";
session_start();
define('ERROR_EDIT_REALTY','ERROR_EDIT_REALTY');

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
        $realty = edit_realty( $db_link, $_POST['realty_id'], $_POST['object_id'],$_POST['address'], $_POST['square'], $_POST['price'], $_POST['additional'], $_POST['agent'], $_POST['description'], $_POST['category']);
        if ( $realty )
        {
            header("Location: show.php?id={$_POST['realty_id']}");
            die();
        }
        else
            $realty = ERROR_EDIT_REALTY;
    }
}
else
    $realty = get_realty_by_id($db_link, $id);

$objects = get_all_objects($db_link);

include "views/realty-edit.view.php";
