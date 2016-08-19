<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 02.07.2016
 * Time: 12:16
 *
 * Домашнее задание:
 *
 * Переводите ваши модели и контроллеры на объектную систему. Будьте очень аккуратны с моделями, начните с простого.
 * Мы дополним, разовьем и при этом устаканим информацию о моделях на 6м вебинаре.
 * С контроллерами, напротив, нечего нянчится, там достаточно несложная переделка.
 */

error_reporting(E_ALL);
session_start();

require_once "sys/db.php";
require_once "sys/settings.php";
require_once("sys/functions.php");

spl_autoload_register('class_autoloader'); // регистрируем(передаём аргументом название) одну из функций автозагрузки файла класса, которая срабатывает если ещё не объявлен класс к которому обращаемся

if (isset($_GET['cat']))
{
    $controller = $_GET['cat'];
}
else
{
    $controller = 'realty';
}

if (isset($_GET['view']))
{
    $controller_action = $_GET['view'];
}
else
{
    $controller_action = 'get_list';
}

$controller_class_name = name2controller_class_name($controller);
//$controller_function_name = $controller.'_'.$controller_action;


$controller_object = new $controller_class_name();

//$result = $controller_object->$controller_function_name();
$result = $controller_object->$controller_action();
if ($result) echo $result;

mysqli_close($db_link);
