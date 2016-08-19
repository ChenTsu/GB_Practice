<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 22.06.2016
 * Time: 16:35
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