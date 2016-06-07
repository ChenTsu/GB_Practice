<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 31.05.2016
 * Time: 12:47
 */


error_reporting(E_ALL);

session_start();

define('TIME_WEEK', 60 * 60 * 24 * 7);

define('FORM_LOGIN', <<<HTML
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
        <input type="text" name="username" value="" required />
        <input type="checkbox" value="1" name="remember"/> Запомнить меня
        <input type="submit" value="Войти"/>
    </form>
    </body>
    </html>
HTML
);
define('FORM_LOGOUT', <<<HTML
<!doctype html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Страница авторизации</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <form method="post">
        <input type="hidden" name="action" value="logout"/>
        <input type="submit" value="Выйти"/><br>
        <a href="index.php">Назад</a>
    </form>
    </body>
    </html>
HTML
);  // если у нас heredoc внутри скобок, то закрывающие скобки и символ завершения команды пишем на новой строке, а закрывающая метка heredoc должна быть без ';'


if (isset($_SESSION['username'])) //есть имя значит мы залогинены, рисуем форму выхода
{
    if (isset($_POST['action']) || isset($_GET['action'])) {
        if ($_POST['action'] == 'logout' || $_GET['action'] == 'logout') {
            if (!isset($_COOKIE['username'])) {
                setcookie("username", $_SESSION['username'], time()-600); // установив срока действия кук в прошлое - браузер удаляет куки сразу, если поставить время жизни куки в 0, то удалятся будет при закрытии браузера
            }
            unset($_SESSION['username']);
            session_destroy();
            header("Location:  auth.php");
            die();
        }
    }
    echo FORM_LOGOUT;
} else    // иначе логинимся
{
    if (isset($_POST['username'])) {
        $_SESSION['username'] = $_POST['username'];

        if (isset($_POST['remember'])) {
            setcookie("username", $_POST['username'], time() + TIME_WEEK);
        }
        if ( !is_dir("images/{$_SESSION['username']}/preview") )
        {
            mkdir( "images/{$_SESSION['username']}/preview", 0777, true);
//            chmod( "images/{$_SESSION['username']}", 0752 );
        }

        header("Location: " . "index.php");
        die();
    }
    echo FORM_LOGIN;
}





