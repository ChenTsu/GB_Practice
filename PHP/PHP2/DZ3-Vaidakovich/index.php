<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 22.06.2016
 * Time: 13:44
 *
 * Домашнее задание:
 * Привести контроллеры к виду, описанному нами на занятии - в виде пары файлов с функциями. Реализовать выбор функции на основании $_GET параметра.
 * Реализовать вывод шаблона с помощью функции render.
 * Если будут вопросы относительно того, как именно и почему данные попадают-таки во вьюшку - спрашивайте.
 * Пока залил все в том виде, в котором мы закончили вебинар, позже обновлю архив - приведу все к нужному виду.
 * В эти выходные можно провести доп. занятие, на котором я хотел бы рассмотреть отношение в БД много-ко-многим (добавим теги) и
 * работу моделей с другими типами данных (добавить картинку, импорт данных, может быть, успеем что-то еще). Что думаете? Пишите в комментариях и скайпе.
 */

error_reporting(E_ALL);
require_once "models/db.php";
require_once "models/realty_type-model.php";
require_once "models/realty-model.php";
require_once("functions.php");

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
    $controller_action = 'list';
}

if (file_exists("controllers/{$controller}-controller.php"))
{
    require_once "controllers/{$controller}-controller.php";
}
else
{
    die("404 Нет конторлера {$controller}");
}

$controller_function_name = $controller."_".$controller_action;

if (function_exists($controller_function_name))
{
    $result = $controller_function_name();
    if ($result) echo $result;
}
else
{
    die ("501 Нет функции {$controller_function_name}");
}
