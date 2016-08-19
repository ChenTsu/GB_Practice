<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 31.05.2016
 * Time: 12:47
 */


error_reporting(E_ALL);

session_start();
require_once "models/db_users.php";

define('TIME_WEEK', 60 * 60 * 24 * 7);
$form_login_warning='';

if (isset($_SESSION['username'])) //есть имя значит мы залогинены, рисуем форму выхода
{
    if (isset($_POST['action']) ) {
        if ($_POST['action'] == 'logout' ) {
            if (isset($_COOKIE['username'])) {
                setcookie("username", $_SESSION['username'], time()-600); // установив срока действия кук в прошлое - браузер должен удаляет куки сразу, если поставить время жизни куки в 0, то удалятся будет при закрытии браузера
            }
            foreach ($_SESSION as $key=>$value)
                unset($_SESSION["{$key}"]);
            session_destroy();
            header("Location:  auth.php");
            die();
        }
    }
    include "views/form_logout.html";
}
else    // иначе рисуем форму логина и кнопку регистрации
{
    if (isset($_COOKIE['username'])) //
    {
        $_SESSION['username'] = $_COOKIE['username'];
        setcookie("username", $_SESSION['username'], time() + TIME_WEEK);
        header("Location: " . "index.php");
        die();
    }
    elseif (isset($_POST['username'])) {
        if ( (get_user_by_name($_POST['username']) !== false) ) // если есть такой пользователь
        {
            if ( (get_user_password($_POST['username'], $_POST['userpassword']))!== false) //  и с таким паролем
                {
                $_SESSION['username'] = $_POST['username'];
                if (isset($_POST['remember'])) {
                    setcookie("username", $_POST['username'], time() + TIME_WEEK);
                }
                header("Location: " . "index.php");
                die();
            }
        }
        else
        {
            $form_login_warning = '<div class="auth-warning">Неверное имя пользователя или пароль.</div>';
        }
    }
    include "views/form_login.php";
}





