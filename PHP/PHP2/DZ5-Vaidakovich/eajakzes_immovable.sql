-- phpMyAdmin SQL Dump
-- version 4.4.15.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 04 2016 г., 10:43
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
-- Структура таблицы `realty`
--

CREATE TABLE IF NOT EXISTS `realty` (
  `id` int(10) unsigned NOT NULL,
  `realty_type` tinyint(3) unsigned NOT NULL,
  `address` varchar(256) NOT NULL,
  `square` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `additional` varchar(256) NOT NULL,
  `agent` varchar(256) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `realty`
--

INSERT INTO `realty` (`id`, `realty_type`, `address`, `square`, `price`, `additional`, `agent`, `description`, `category`) VALUES
(3, 2, 'Гагарина 85', 54, 1750000, 'этаж 2/9', 'Пётр', '                                                                                                                                                комната в 3-х комнатной коммуналке, панельный дом                                                                                                                                                 ', 'вторичное, эконом'),
(4, 5, 'ПитерБург', 36, 1750000, '2 комнаты, удобства на улице', 'Вася', 'домик на краю города ', 'вторичное'),
(5, 2, 'Гагарина 85', 54, 1750000, 'этаж 2/9', 'Пётр', '                                    кhttp:/PHP2/DZ3-Vaidakovich/index.php?cat=realty_type                                    ', 'вторичное');

-- --------------------------------------------------------

--
-- Структура таблицы `realty_types`
--

CREATE TABLE IF NOT EXISTS `realty_types` (
  `id` tinyint(3) unsigned NOT NULL,
  `title` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `realty_types`
--

INSERT INTO `realty_types` (`id`, `title`) VALUES
(2, 'Комната'),
(3, 'Квартира'),
(5, 'Дом');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `realty`
--
ALTER TABLE `realty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `realty_type_ids` (`realty_type`) USING BTREE;

--
-- Индексы таблицы `realty_types`
--
ALTER TABLE `realty_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `realty`
--
ALTER TABLE `realty`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `realty_types`
--
ALTER TABLE `realty_types`
  MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `realty`
--
ALTER TABLE `realty`
  ADD CONSTRAINT `FK_realty_types` FOREIGN KEY (`realty_type`) REFERENCES `realty_types` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
