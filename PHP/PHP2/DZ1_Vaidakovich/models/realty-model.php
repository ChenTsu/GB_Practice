<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 17.06.2016
 * Time: 10:40
 */

require_once "db.php";

function get_all_realty ( )
{
    global $link;

    $query = "SELECT * FROM `realty` LEFT JOIN "
}