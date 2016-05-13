<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 05.05.2016
 * Time: 22:38
 */

define( 'BR', "<br>");
$x="Hello there";
//BR;
$X='Hello here';


echo $X;
echo '<br>';
echo $x;
echo BR.BR;

$a = "2 Тугрика ";
$b = '3 Тугрика ';
$c = 'пять Тугриков ';


echo $a.$b.$c;
echo '<br>', BR;
echo "a+b = ", $a+$b;
echo BR;
echo "a+b+c =", $a+$b+$c;