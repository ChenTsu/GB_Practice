<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 17.06.2016
 * Time: 10:24
 */

error_reporting(E_ALL);
session_start();

require_once "models/db.php";
require_once "models/realty-model.php";



include "view/index_view.php";