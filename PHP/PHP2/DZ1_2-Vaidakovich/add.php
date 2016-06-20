<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 20.06.2016
 * Time: 9:47
 */

error_reporting(E_ALL);
require_once "models/db.php";
require_once "models/objects.model.php";
require_once "models/realty.model.php";
session_start();
define('ERROR_ADD_REALTY','ERROR_ADD_REALTY');

if ( isset($_POST['action']) )
{
    if ( $_POST['action'] === 'add' )
    {
        $realty = new_realty( $db_link, $_POST['object_id'], $_POST['address'], $_POST['square'], $_POST['price'], $_POST['additional'], $_POST['agent'], $_POST['description'], $_POST['category']);
        if ( $realty )
        {
            header("Location: show.php?id={$realty}");
            die();
        }
        else
            $realty = ERROR_ADD_REALTY;
    }
}

$realty = true;

$objects = get_all_objects($db_link);

include "views/realty-add.view.php";
