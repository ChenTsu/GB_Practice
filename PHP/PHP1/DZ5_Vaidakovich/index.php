<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 26.05.2016
 * Time: 11:24
 */

error_reporting(E_ALL);

session_start();


var_dump( $_SESSION );


if ( isset($_SESSION['username']) )
{
    if ( isset($_SESSION['lastPage']) )
    {
        header( "Location: ". $_SESSION['lastPage'] );
    }
    elseif ( isset($_COOKIE['lastPage']))
    {
        $_SESSION['lastPage'] = $_COOKIE['lastPage'];
        header( "Location:". $_SESSION['lastPage'] );
    }
    else
    {
        header("Location: a.php");
//        echo "<a href='a.php'>File A</a>";
    }

    die();
}
else
{
    if ( isset( $_COOKIE['username']))
    {
        $_SESSION['username'] = $_COOKIE['username'];

        if ( !isset($_SESSION['styles']) && isset($_COOKIE['styles']) )
            $_SESSION['styles']=$_COOKIE['styles'];
        else
            $_SESSION['styles']="css/1.css";

        if ( isset($_SESSION['lastPage']) )
        {
            header( "Location:". $_SESSION['lastPage'] );
        }
        elseif ( isset($_COOKIE['lastPage']))
        {
            $_SESSION['lastPage'] = $_COOKIE['lastPage'];
            header( "Location:". $_SESSION['lastPage'] );
        }
        else
        {
            header("Location: a.php");
//            echo "<a href='a.php'>File A</a>";
        }

        die();
    }
    else
    {
//        $username = USER_IS_GUEST;
        header( "Location: login.php");
//        echo "<a href='login.php'>Log In Please</a>";
        die();
    }
}