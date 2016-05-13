<?php
error_reporting(E_ALL);
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 08.05.2016
 * Time: 11:52
 *
************************************************************************************************************************
 *                                      Выводим HTML структуру                                                        */
echo <<<HTML
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Курс PHP1 Урок 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
HTML;

/***********************************************************************************************************************
* 1. Вывести переменные 4 разных типов и константу с помощью операторов echo
* 2. Повторить вывод заключив переменные в двойные кавычки, объяснить результат.
* 3. Повторить вывод заключив переменные в одинарные кавычки, объяснить результат.
* 4. Вывести на экран любое четверостишье, для каждой строки использовать отдельную переменную и оператор echo.
* 5. Вывести то же четверостишие используя один оператор echo
* 6. В выражении использовать разные типы данных, например, сложите число «10» и строку «20 приветов». Объяснить результат
* 7. Вывести таблицу истинности оператора XOR
* 8. Обменять значения двух целочисленных переменных не используя другие переменные
**********************************************************************************************************************/

define( 'BR', '<br>');

echo '<div class="container">';
echo '<h1> ДЗ1 </h1>';

/*****************************************************  EX1  **********************************************************/
echo '<div class="ex1">';
$a = 7;
$b = 3.5;
$c = true;
$d = 'Строка';
define( 'CNST', '3844.2');

echo '<h3>Оператор echo без использования кавычек выводит значения переменных </h3>';
echo '$a = ' . $a;
echo BR;

echo '$b = ' . $b;
echo BR;

echo '$c = ' .$c;
echo BR;

echo '$d = ' . $d;
echo BR;

echo 'CNST = ' . CNST;
echo BR;
echo BR;
echo '</div>'; //закрыли ex1

/*****************************************************  EX2  **********************************************************/
echo '<div class="ex2">';
echo "<h3>Имена Переменных заключённые в двойные кавычки в операторе echo заменяются на их значения</h3>";
echo '$a = ' . "$a";
echo BR;

echo '$b = ' . "$b";
echo BR;

echo '%c = ' . "$c";
echo BR;

echo '$d = ' . "$d";
echo BR;

echo 'CNST = ' . "CNST";
echo BR;
echo BR;
echo '</div>'; // закрыли ex2

/*****************************************************  EX3  **********************************************************/
echo '<div class="ex3">';
echo '<h3>Имена переменных заключённые в одинарные кавычки в операторе echo не заменяются на их значения</h3>';
echo '$a = ' . '$a';
echo BR;

echo '$b = ' . '$b';
echo BR;

echo '$c = ' . '$c';
echo BR;

echo '$d = ' . '$d';
echo BR;

echo 'CNST = ' . 'CNST';
echo BR;
echo BR;
echo '</div>'; // закрыли ex3

/*****************************************************  EX4  **********************************************************/
echo '<div class="ex4">';
$str1 = 'Бывает логика событий нелегка,';
$str2 = 'В ней парадоксы вечные толкутся:';
$str3 = 'Порой, чтоб воспарить за облака';
$str4 = 'От дна необходимо оттолкнуться!';

echo '<h3>Каждая строка четверостишия это отдельная переменная и отдельный оператор echo</h3>';
echo $str1;
echo BR;

echo $str2;
echo BR;

echo $str3;
echo BR;

echo $str4;
echo BR;
echo BR;
echo '</div>'; // закрыли ex4

/*****************************************************  EX5  **********************************************************/
echo '<div class="ex5">';
echo '<h3>Каждая строка четверостишия отдельная переменная, переменные "склеены" в одном операторе echo</h3>';
echo $str1 . BR . $str2 . BR . $str3 . BR . $str4;
echo BR;
echo BR;
echo '</div>'; // закрыли ex5

/*****************************************************  EX6  **********************************************************/
echo '<div class="ex6">';
echo '<h3>Сложение разнотипных переменных</h3>';

echo 'Сложение целого числа со строкой начинаюцейся с целого числа: из строки выделяется число, остальное отбрасывается' . BR;
echo '10 + "20 попугаев" = ' . (10 + "20 попугаев") . BR;
echo 'Сложение переменной с дробным числом и строки начинаюцейся с целого числа: из строки выделяется число, остальное отбрасывается' . BR;
echo "$b" . ' + "35 попугаев" = ' . ($b + "35 попугаев") . BR;
echo 'Сложение дробной переменной со строкой: т.к. начальные символы строки не принадлежат числам, строка считается равной числу 0' . BR;
echo "$b" . ' + "Приложение №1 = "' . ($b + "Приложение №1") . BR;
echo BR;
echo BR;
echo '</div>'; // закрыли ex6

/*****************************************************  EX7  **********************************************************/
echo '<div class="ex7">';
$f1 = $f2 = true;
function IS_BOOL_TRUE ( $b )
{
    return $b ? 'true' : 'false';
}

echo '<h3>Таблица истинности для оператора XOR</h3><table>';
echo '<tr><td>f1</td><td>f2</td><td>f1 XOR f2</td></tr>' . BR;
echo "<tr><td>" . IS_BOOL_TRUE($f1) . "</td><td>" . IS_BOOL_TRUE($f2) . "</td><td>" . IS_BOOL_TRUE($f1 xor $f2) .  "</td></tr>" . BR;

$f1 = false;
echo "<tr><td>". IS_BOOL_TRUE($f1) . "</td><td>" . IS_BOOL_TRUE($f2) . "</td><td>" . IS_BOOL_TRUE($f1 xor $f2)  . "</td></tr>" . BR;

$f1 = true;
$f2 = false;
echo "<tr><td>". IS_BOOL_TRUE($f1) . "</td><td>". IS_BOOL_TRUE($f2) . "</td><td>". IS_BOOL_TRUE($f1 xor $f2) . "</td></tr>" . BR;

$f1 = $f2 = false;
echo "<tr><td>". IS_BOOL_TRUE($f1) . "</td><td>". IS_BOOL_TRUE($f2) . "</td><td>". IS_BOOL_TRUE($f1 xor $f2) . "</td></tr>" . BR;

echo '</table>';
echo BR;
echo BR;
echo '</div>'; // закрыли ex7

/*****************************************************  EX8  **********************************************************/
echo '<div class="ex8">';
echo '<h3>Обмен значений переменных без использования других переменных</h3>';

$x = 15; $y = 73;
echo "x = $x &nbsp y = $y" . BR;
echo "x = x + y (x = $x + $y = ";    $x = $x + $y;    echo "$x)" . BR;
echo "y = x - y (y = $x - $y = ";    $y = $x - $y;    echo "$y)" . BR;
echo "x = x - y (x = $x - $y = ";    $x = $x - $y;    echo "$x)" . BR;

echo '</div>'; // закрыли ex8

/*****************************************************  END  **********************************************************/
echo '</div>'; // закрыли container
echo '</body>' . BR . '</html>';