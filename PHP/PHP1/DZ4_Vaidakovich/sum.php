<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 21.05.2016
 * Time: 16:03
 */

function mathOperation ( $arg1, $arg2, $operation)
{
    switch ( $operation) // не нужен break потому что return сразу прекращает выполнение функции и возвращает вычесленное
    {                    // выражение (справа от него)  в то место откуда вызвана функция
        case 'ADD':
            return $arg1 + $arg2;
        case 'SUB':
            return $arg1 - $arg2;
        case 'MUL':
            return $arg1 * $arg2;
        case 'DIV':
            if ( $arg2 === '0' )
                return "Деление на ноль не возможно!!";
            else
                return $arg1 / $arg2;
        default:
            return 'Valid values fo $operation : ADD, SUB, MUL, DIV';
    }
}