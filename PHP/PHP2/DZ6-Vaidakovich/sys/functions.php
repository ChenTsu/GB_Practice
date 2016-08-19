<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 03.07.2016
 * Time: 12:19
 */

function render($view_name, $data = [], $with_layout = true)
{
    // для каждого ключа в $data[] создаём переменные(локальные для render) с названием как у ключа. и присваиваем туда соответствующие значения из переданного массива
    // например вызов render( 'list', ['unit'=>$alpha] ) создаст локальную переменную $unit со значением $alpha(при чём $alpha это любые типы переменных),
    // а вызов render( 'list', ['unit'=>$alpha, 'item'=>$betta] ) создаст $unit и $item.  таким образом мы можем передавать в функцию любое количество аргументов, не их количество в объявлении функции
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    ob_start(); // перенапрявляем весь вывод в буфер
    require_once("views/$view_name.view.php"); //подгружая сюда, во вьюшке нам доступны переменные созданные из массива $data[], которые передал соответствующий контроллер
    $content = ob_get_contents(); // перемещаем из буфера в переменную, инициализация $content
    ob_end_clean(); // останавливаем вывод в буфер

    if ($with_layout) {
        ob_start();
        require_once("views/layouts/layout.php"); // на момент вызова layout в $content содержится предыдущий вывод, в нашем случае тело страницы взятое из *.view.php в котором тоже есть вывод $content, соотвественно вызов $content в теле layout заполнит тело страницы
        $content = ob_get_contents(); // теперь перезаписываем в контент уже страницу целиком
        ob_end_clean();
    }
    return $content;
}

function name2controller_class_name($name) //переводим название раздела из ГЕТ-параметра в имя класса 
{
    $pie = explode('_',$name);
    $result = '';
    foreach($pie as $v)
    {
        $result .= ucfirst($v);
    }
    $result.="Controller";

    return $result;
}

function class_autoloader($classname) // в функцию интерпретатор автоматом(т.к. эта функция указана в spl_autoload_register()) передаёт название класса к которому совершается обращение но который ещё не объявлен
{
    if ( $classname == 'Model' )
    {
        require_once "model.class.php";
    }
    elseif (mb_substr($classname,-10,NULL,'utf-8') === 'Controller')
    {
        $class_string = mb_substr($classname,0,mb_strlen($classname,'utf-8')-10,'utf-8');
        $name = preg_replace('/([a-z])([A-Z])/', '$1_$2', $class_string);
        $file_name = "controllers/".mb_strtolower($name,'utf-8').'-controller.php';

        if (file_exists($file_name))
        {
            include_once $file_name;
        }
        else
        {
            e404("Нет файла конторлера {$file_name} для класса {$classname}");
        }
    }
    else
    {
        $name = preg_replace('/([a-z])([A-Z])/', '$1_$2', $classname);
        $file_name = "models/".mb_strtolower($name,'utf-8').'-model.php';

        if (file_exists($file_name))
        {
            include_once $file_name;
        }
        else
        {
            e404("Нет файла конторлера {$file_name} для класса {$classname}");
        }
    }
}

function e404($message = '')
{
    header("HTTP/1.1 404 Not Found");
    die('404 '.$message);
}