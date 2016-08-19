<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 12.06.2016
 * Time: 19:38
 */
error_reporting(E_ALL);

session_start();
require_once "models/db_users.php";

if ( isset($_SESSION['username'])) // если мы уже залогинены то не зачем регистрироваться ещё раз
{
    header("Location: index.php");
    die ();
}


if (isset($_POST['action'])) {
    if ($_POST['action'] == 'register') {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            // тут реализовать проверку длины имени и пароля

            if (get_user_by_name($_POST['username']) === false) // такого пользователя ещё нет
            {
                if ( add_new_user($_POST['username'], $_POST['password']) ) //заводим нового
                {
                    if (!is_dir("images/{$_POST['username']}/preview"))
                    {
                        mkdir("images/{$_POST['username']}/preview", 0777, true); // создаём каталоги для картинок пользователя
//            chmod( "images/{$_SESSION['username']}", 0752 );
                    }
                }
                else // не удалось создать пользователя
                {
                    die("Ошибка добавления пользователя. Сообщите администрации сайта.");
                    // а вообще надо подумать и подсмотреть как лучше
                }
            }
            else // пользователь уже есть, выдаём предупреждение
            {
                $_SESSION['user_already_exist'] = true;
            }
        }
    }
}

if ( isset($_SESSION['user_already_exist'])) {
    $form_registration_warning = '<div class="auth-warning">Пользователь с таким именем уже существует!!<br>Укажите другое имя.</div>';
    unset( $_SESSION['user_already_exist']);
}
else
    $form_registration_warning = '';

include "views/form_register.php";
