<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 18.06.2016
 * Time: 13:05
 */

error_reporting(E_ALL);
require_once "models/db.php";
require_once "models/objects.model.php";
require_once "models/realty.model.php";

session_start();

//$page_title = '';

$realty = get_all_realty($db_link);


include "views/realty-index.list.view.php";
mysqli_close( $db_link);