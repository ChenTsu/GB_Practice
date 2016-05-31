<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 26.05.2016
 * Time: 12:11
 */

error_reporting(E_ALL);

    session_start();

define("TIME_YEAR", 60*60*24*365);
define("DEFAULT_STYLES", "css/1.css" );
define("DEFAULT_PAGE", "a.php");
$_SESSION['need_name'] ='';


if (isset($_SESSION['username'])) //есть имя значит мы залогинены, рисуем форму выхода
{

    ?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Страница авторизации</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="<?php echo $_SESSION['styles'] ?>">
    </head>
    <body>
    <form method="post">
        <input type="hidden" name="action" value="logout"/>
        <input type="submit" value="Выйти"/><br>
        <a href="index.php">Назад</a>
    </form>
    </body>
    </html>
<?php

    if ( isset($_POST['action']) || isset($_GET['action']))
    {
        if ( $_POST['action'] == 'logout' || $_GET['action']=='logout' )
        {
            if ( !isset($_COOKIE['username']))
            {
                if ( isset($_SESSION['lastPage']))
                    setcookie( "lastPage", $_SESSION['lastPage'], time() + TIME_YEAR);
                if ( isset( $_SESSION['styles']) )
                    setcookie( "styles", $_SESSION['styles'], time() + TIME_YEAR);

//                setcookie("username",$_SESSION['username'],time()-100);
            }

            unset( $_SESSION['styles']);
            unset( $_SESSION['lastPage']);
            unset( $_SESSION['username']);
            session_destroy();
            header("Location: " . "login.php");
        }
    }
    die();
}
else // логинимся
{

    if ( isset($_POST['username']))
    {
        if ($_POST['username']!== '')
        {
            $_SESSION['username'] = $_POST['username'];
            if (isset($_POST['remember']))
            {
                setcookie("username",$_POST['username'],time() + TIME_YEAR);
            }

            if ( isset($_COOKIE['styles']) )
                $_SESSION['styles'] = $_COOKIE['styles'];
            else
                $_SESSION['styles']=DEFAULT_STYLES;

            if ( isset($_COOKIE['lastPage']))
            {
                $_SESSION['lastPage'] = $_COOKIE['lastPage'];
                header("Location: " .$_SESSION['lastPage']);
            }
            else
                header("Location: " . DEFAULT_PAGE );
        }
        else
        {
            $_SESSION['need_name'] = "Пожалуйста, введите имя.";
            header("Location: login.php");
        }


//        die();
    }
    ?>

    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Страница авторизации</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <form method="post">
        <input type="hidden" name="action" value="login"/>
        <input type="text" name="username" value="<?php echo $_SESSION['need_name']; ?>"/>
        <input type="checkbox" value="1" name="remember"/> Запомнить меня
        <input type="submit" value="Войти"/>
    </form>
    </body>
    </html>
    <?php
}
