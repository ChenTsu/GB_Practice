<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 13.06.2016
 * Time: 10:24
 */

require_once "db.php";

function add_new_user ( $username, $userpassword, $user_first_name='NULL', $user_last_name='NULL', $user_middle_name='NULL' )
{
    global $db_link;
    $query = "INSERT INTO `users` (`id`, `user`, `user_pass`, `first_name`, `last_name`, `middle_name`) VALUES ('', '{$username}', '{$userpassword}', '{$user_first_name}', '{$user_last_name}', '{$user_middle_name}')";
    $result = mysqli_query($db_link,$query);

    return false;
}

function get_user_by_name( $username )
{
    return false;
}

function get_user_password ( $username, $userpassword)
{
    return false;
}