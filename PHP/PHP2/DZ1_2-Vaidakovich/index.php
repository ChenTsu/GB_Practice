<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 18.06.2016
 * Time: 13:05
 *
 * Домашнее задание: сделать приложение, функционал которого мы полностью разобрали на уроке и привести его к корректному MVC.
 * Суть функционала: Две связанные таблицы - объекты недвижимости и их категории. Возможность редактирования этих сущностей,
 * просмотра списка в таблице, удаления и просмотра одной единицы - и для категорий и для объектов.
 * Все через формы, никакого жесткого прописывания в коде.
 * Свой вариант без MVC выложил под первым видео (dusty.zip), но не торопитесь его брать, если чувствуете силы решить функционал самостоятельно.
 *
 * Дополнительная задача для тех, кто успел c MVC - при удалении непустой категории произойдет ошибка - мы говорили о причинах этого на первом вебинаре.
 * Убедитесь в этом. И придумайте решение этой проблемы - мне интересно, какие изменения вы внесете в интерфейс и во внутреннюю логику вашего приложения.
 *
 * Лист проверки ДЗ: https://docs.google.com/spreadsheets/d/1UaRuNIiLNQ-e4XtkgXwXWKNSubQGsbA9fIfoS2cm6Vo/pubhtml
 *
 */

error_reporting(E_ALL);
require_once "models/db.php";
require_once "models/objects.model.php";
require_once "models/realty.model.php";

session_start();

//$page_title = '';

$realty = get_all_realty($db_link);


include "views/realty-index.list.view.php";
mysqli_close( $db_link);