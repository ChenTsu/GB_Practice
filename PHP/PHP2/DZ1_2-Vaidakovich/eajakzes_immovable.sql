-- phpMyAdmin SQL Dump
-- version 4.4.15.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 20 2016 г., 11:43
-- Версия сервера: 5.5.47-MariaDB
-- Версия PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `eajakzes_immovable`
--

-- --------------------------------------------------------

--
-- Структура таблицы `objects`
--

CREATE TABLE IF NOT EXISTS `objects` (
  `id` tinyint(3) unsigned NOT NULL,
  `title` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `objects`
--

INSERT INTO `objects` (`id`, `title`) VALUES
(2, 'Комната'),
(3, 'Квартира'),
(5, 'Дом');

-- --------------------------------------------------------

--
-- Структура таблицы `realty`
--

CREATE TABLE IF NOT EXISTS `realty` (
  `id` int(10) unsigned NOT NULL,
  `object` tinyint(3) unsigned NOT NULL,
  `address` varchar(256) NOT NULL,
  `square` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `additional` varchar(256) NOT NULL,
  `agent` varchar(256) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `realty`
--

INSERT INTO `realty` (`id`, `object`, `address`, `square`, `price`, `additional`, `agent`, `description`, `category`) VALUES
(3, 2, 'Гагарина 82', 54, 1750000, 'этаж 2/5', 'Пётр', 'комната в 3-х комнатной коммуналке, панельный дом ', 'вторичное, эконом'),
(4, 5, 'ПитерБург', 36, 1750000, '2 комнаты, удобства на улице', 'Вася', 'домик на краю города ', 'вторичное');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `objects`
--
ALTER TABLE `objects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `realty`
--
ALTER TABLE `realty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `object_ids` (`object`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `objects`
--
ALTER TABLE `objects`
  MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `realty`
--
ALTER TABLE `realty`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `realty`
--
ALTER TABLE `realty`
  ADD CONSTRAINT `FK_realty_objects` FOREIGN KEY (`object`) REFERENCES `objects` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
