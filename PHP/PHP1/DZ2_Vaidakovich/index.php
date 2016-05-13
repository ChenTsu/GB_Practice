<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 13.05.2016
 * Time: 10:04
 */
/**************************************************  ЗАДАНИЯ  *********************************************************
 * 1. Объявите две целочисленные переменные $a и $b с произвольными значениями и реализовать следующие действия:
 *    а) если $a и $b положительные(или нуль) -  вывести их разность
 *    б) если $a и $b отрицательные - вывести их произведение
 *    в) если $a и $b разных знаков - вывести их сумму
 * 2. Присвойте переменной $а значение в промежутке [0..15]. С помощью оператора switch выввести числа от $a до 15
 * 3. Реализуйте основные 4 арифметические операции (+,-,*,%) в виде функций с двумя параметрами. Обязательно используйте оператор return
 * 4. Реализуйте функцию с тремя параметрами: function mathOperation ($arg1, $arg2, $operation)
 *    где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции.
 *    В зависимости от переданного значения операции выполните одну из арифметических операций
 *    (используйте функции из пункта 3 ) и верните полученное значение (используйте switch ).
 * Продвинутый блок
 * 5. С помощью рекурсии организуйте функцию возведения числа в степень.
 *    Формат: function power ($val, $pow)     ,где $val – заданное число, $pow – степень.
 * 6. Напишите функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
 *    22 часа 15 минут; 21 час 43 минуты;  и т.д.
 *    Подсказка: часы и минуты можно узнать с помощью встроенной функции PHP – date
 **********************************************************************************************************************
 * /*                                      Выводим HTML структуру                                                        */
echo <<<HTML
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Курс PHP1 Урок 2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>ПХП1 ДЗ2</h1>
HTML;

define('BR', "<br>\n"); // константа: <br> для переноса на новую строку в хтмл, \n для переноса на новую строку при просмотре исходника хтмл

/******************************************************  УПР1  ********************************************************/
echo '<div class="ex ex1"> ';
echo '<h3>1. Выполнение разных арифметических действий в случае положительных/отрицательных чисел</h3>';
$a = rand ( -100, 100);
$b = rand ( -100, 100);

echo "a = $a, b = $b";
if ($a >= 0 && $b >= 0) {
    echo BR . 'a - b = ' . ($a - $b) . BR;
} elseif ($a < 0 && $b < 0) {
    echo BR . 'a * b = ' . ($a * $b) . BR;
} else {
    echo BR . 'a + b = ' . ($a + $b) . BR;
}

echo '</div>'; // закрыли ex1

/******************************************************  УПР2  ********************************************************/
echo '<div class="ex ex2">';
echo '<h3>2. Вывод чисел от 0 до 15 начиная со случайного в этом диапозоне</h3>';
//возможноя не правильно понял задание. выведется всё от первого совпадения до конца свитча или до первого break;
$a = rand(0, 15);
switch ($a) {
    case 0:
        echo 0 . "\t";
    case 1:
        echo 1 . "\t";
    case 2:
        echo 2 . "\t";
    case 3:
        echo 3 . "\t";
    case 4:
        echo 4 . "\t";
    case 5:
        echo 5 . "\t";
    case 6:
        echo 6 . "\t";
    case 7:
        echo 7 . "\t";
    case 8:
        echo 8 . "\t";
    case 9:
        echo 9 . "\t";
    case 10:
        echo 10 . "\t";
    case 11:
        echo 11 . "\t";
    case 12:
        echo 12 . "\t";
    case 13:
        echo 13 . "\t";
    case 14:
        echo 14 . "\t";
    case 15:
        echo 15 . "\t";
        break;
    default:
        echo BR . "Хммм... Очень странно";
}

echo '</div>'; // закрыли ex2

/******************************************************  УПР3  ********************************************************/
/** function adding two numbers
 * @param $x
 * @param $y
 * @return mixed
 */
function ADD ($x, $y)
{
    return $x+$y;
}
function SUB ( $x, $y)
{
    return $x-$y;
}
function MUL( $x, $y )
{
    return $x*$y;
}
function MOD ( $x, $y )
{
    return $x%$y;
}

/******************************************************  УПР4  *******************************************************
 * @param $arg1 - number
 * @param $arg2 - number
 * @param $operation - valid value ADD, SUB, MUL, MOD
 * @return int|mixed
 */

function mathOperation ( $arg1, $arg2, $operation)
{
    switch ( $operation) // не нужен break потому что return сразу прекращает выполнение функции и возвращает вычесленное
    {                    // выражение (справа от него)  в то место откуда вызвана функция
        case 'ADD':
            return ADD( $arg1, $arg2);
        case 'SUB':
            return SUB( $arg1, $arg2);
        case 'MUL':
            return MUL( $arg1, $arg2);
        case 'MOD':
            return MOD( $arg1, $arg2);
        default:
            return 'Valid values fo $operation : ADD, SUB, MUL, MOD';
    }
}

echo '<div class="ex ex4">';
echo '<h3>4. Примеры использования функций </h3>';

echo 'Функция mathOperation ($arg1, $arg2, $operation) в зависимости от параметра $operation вызывает функции ADD($x,$y) SUB($x, $y) MUL($x, $y) MOD($x, $y)'. BR;
echo "a=$a, b=$b" . BR;
echo 'Сложние a + b = '  . mathOperation( $a, $b, 'ADD') . BR;
echo 'Вычитание a - b = ' . mathOperation( $a, $b, 'SUB') . BR;
echo 'Умножение a * b = ' . mathOperation( $a, $b, 'MUL') . BR;
echo 'Остаток от деления a % b = ' . mathOperation( $a, $b, 'MOD') . BR;
echo 'В случае "неправильного" аргумента $operation функция возвращает строку: ' . mathOperation( $a, $b, 'SUMMA');

echo '</div>'; // закрыли ex4

/******************************************************  УПР5  *********************************************************
 * @param $x - number
 * @param $x
 * @param $pov int - number
 * @return int - number
 */
function kaPow($x=2, $pov=3){
    if ( $pov === 0 )
        return 1;
    if ( $pov === 1 )
        return $x;
    return kaPow($x, $pov-1) * $x;
}

echo '<div class="ex ex5">';
echo '<h3>5. Рекурсивная функция возведения числа в степень</h3>';
echo 'Функция kaPow($x=2, $pov=3) для значений по умолчанию = ' . kaPow() .BR;
$a=rand(-5,5);
$b=rand(0,5);
echo "для x=$a, pov=$b : kaPow($a, $b) = " . kaPow($a, $b) .BR;

echo '</div>'; // закрыли ex5

/******************************************************  УПР6  ********************************************************/
function tDate()
{
    // не забудь проверить/установить правильный часовой пояс в php.ini=>date.timezone=
    $hour = date('H');
//    $minut= (string)rand(0,59);
    $minut = date('i');
    $time = '';


    // вычисляем склонение для часов
    $z = (int)$hour%20;
    if ( ($z == 0) || ($z>4 && $z<20) )
    {
        $time = $hour . " часов ";
    }
    elseif (  $z == 1 )
    {
        $time = $hour . " час ";
    }
    else
    {
        $time = $hour . " часа ";
    }

    // вычисляем склонение для минут
    $z = (int)$minut%10;

    if ( $minut>4 && $minut<21 )
    {
        $time .= $minut . ' минут.';
    }
    elseif ( $z>4 && $z<10 )
    {
        $time .= $minut . ' минут.';
    }
    elseif ( $z== 1)
    {
        $time .= $minut . ' минута';
    }
    else
    {
        $time .= $minut . ' минуты';
    }

    return $time;
}

echo '<div class="ex ex6">';
echo '<h3>6. Функция добовляющая склонения к текущему времени</h3>';

echo BR . "Текущее время: " . tDate();

echo '</div>'; // закрыли ex6

/*****************************************************  END  **********************************************************/
echo '</body>' . BR . '</html>';