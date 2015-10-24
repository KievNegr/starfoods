-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 23 2015 г., 13:42
-- Версия сервера: 5.5.44-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `starfoods`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE `brand` (
  `id_brand` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `dt` datetime NOT NULL,
  `ip` varchar(30) NOT NULL,
  `login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`id_brand`, `name`, `text`, `image`, `dt`, `ip`, `login`) VALUES
(14, 'Apple', '<p>Самая дорогая контора в мире</p>', 'Apple-Logo2.png', '2012-10-23 16:24:04', '127.0.0.1', 'Admin'),
(15, 'Samsung', '<p>Galaxy</p>', 'samsung.png', '2012-08-03 14:53:21', '127.0.0.1', 'Admin'),
(16, 'Аtlas', '<p>Производитель видеорегистраторов</p>', 'no_brand.png', '2012-11-02 13:37:03', '127.0.0.1', 'Admin');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `sub_category` int(11) NOT NULL,
  `rewrite` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `sort` int(11) NOT NULL,
  `image` varchar(64) NOT NULL,
  `dt` datetime NOT NULL,
  `ip` varchar(30) NOT NULL,
  `login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id_category`, `sub_category`, `rewrite`, `name`, `title`, `description`, `text`, `sort`, `image`, `dt`, `ip`, `login`) VALUES
(8, 0, 'chessecake', 'Чизкейк', 'Чизкейк', 'Чизкейки', '<p>Тут чизы</p>', 1, '', '2015-10-22 14:10:50', '127.0.0.1', 'Admin'),
(9, 0, 'korzhi', 'Коржи', 'Коржи бля тортов', 'Коржи для тортов', '<p>Коржики</p>', 1, '', '2015-10-21 13:35:35', '127.0.0.1', 'Admin');

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE `city` (
  `id_city` int(11) NOT NULL,
  `name_city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id_city`, `name_city`) VALUES
(1, 'Киев'),
(2, 'Чернигов'),
(3, 'Харьков');

-- --------------------------------------------------------

--
-- Структура таблицы `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `filter`
--

CREATE TABLE `filter` (
  `id` int(11) NOT NULL,
  `id_option` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `value` varchar(50) NOT NULL,
  `hash` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `filter`
--

INSERT INTO `filter` (`id`, `id_option`, `id_category`, `id_product`, `value`, `hash`) VALUES
(1, 4, 2, 86, '500', '1'),
(2, 5, 2, 86, '4', '2'),
(5, 4, 2, 92, '250', '3'),
(6, 5, 2, 92, '4', '2'),
(7, 4, 2, 96, '275', '5'),
(8, 5, 2, 96, '4', '2'),
(9, 4, 2, 101, '300', '7'),
(10, 5, 2, 101, '4', '2'),
(13, 6, 2, 101, '12', '9'),
(14, 6, 2, 96, '12', '9'),
(15, 6, 2, 92, '12', '9'),
(16, 6, 2, 86, '12', '9'),
(17, 1, 8, 107, '1', '17'),
(18, 2, 8, 107, '8', '18'),
(19, 3, 8, 107, '30', '19'),
(20, 1, 8, 106, '1', '17'),
(21, 2, 8, 106, '8', '18'),
(22, 3, 8, 106, '30', '19'),
(23, 1, 8, 105, '', '23'),
(24, 2, 8, 105, '', '24'),
(25, 3, 8, 105, '', '25'),
(26, 1, 8, 108, '1', '17'),
(27, 2, 8, 108, '8', '18'),
(28, 3, 8, 108, '30', '19'),
(29, 1, 8, 109, '1.1', '29'),
(30, 2, 8, 109, '9', '30'),
(31, 3, 8, 109, '32', '31'),
(32, 1, 8, 110, '1', '17'),
(33, 2, 8, 110, '8', '18'),
(34, 3, 8, 110, '30', '19'),
(35, 1, 8, 111, '1', '17'),
(36, 2, 8, 111, '8', '18'),
(37, 3, 8, 111, '35', '37'),
(38, 1, 8, 112, '1', '17'),
(39, 2, 8, 112, '8', '18'),
(40, 3, 8, 112, '40', '40');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id_images` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_page` int(11) NOT NULL,
  `alt` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `img_boss` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id_images`, `id_product`, `id_page`, `alt`, `name`, `img_boss`) VALUES
(6, 105, 0, '', 'cake2.png', 1),
(7, 105, 0, '', 'yagmix.png', 0),
(8, 106, 0, '', 'cake1.png', 1),
(9, 106, 0, '', 'italian.png', 0),
(10, 107, 0, '', 'chernika_part.png', 1),
(11, 107, 0, '', 'chernika.png', 0),
(12, 108, 0, '', 'plato.png', 1),
(13, 108, 0, '', 'plato2.png', 0),
(14, 109, 0, '', 'svishney.png', 1),
(15, 110, 0, '', 'kalambur.png', 1),
(16, 111, 0, '', 'korleone.png', 1),
(17, 112, 0, '', 'klubnichnui.png', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `money`
--

CREATE TABLE `money` (
  `id_money` int(11) NOT NULL,
  `name_money` varchar(100) NOT NULL,
  `key_money` varchar(5) NOT NULL,
  `exchange_money` float NOT NULL,
  `default_money` int(11) NOT NULL,
  `view_money` int(11) NOT NULL,
  `boss` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `money`
--

INSERT INTO `money` (`id_money`, `name_money`, `key_money`, `exchange_money`, `default_money`, `view_money`, `boss`, `data`) VALUES
(1, 'Доллар', 'USD', 1, 1, 0, 0, '2012-11-12 19:58:43'),
(2, 'Гривна', 'грн', 22, 0, 1, 0, '2015-06-11 18:25:24');

-- --------------------------------------------------------

--
-- Структура таблицы `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `measurement` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `options`
--

INSERT INTO `options` (`id`, `value`, `measurement`) VALUES
(1, 'Вес', 'кг'),
(2, 'Количество кусочков', 'шт. '),
(3, 'Диаметр', 'см');

-- --------------------------------------------------------

--
-- Структура таблицы `options_category`
--

CREATE TABLE `options_category` (
  `id` int(11) NOT NULL,
  `id_option` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `options_category`
--

INSERT INTO `options_category` (`id`, `id_option`, `id_category`) VALUES
(1, 1, 9),
(2, 1, 8),
(3, 2, 8),
(4, 3, 9),
(5, 3, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `key_order` varchar(32) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `key_order`, `status`) VALUES
(16, '2fea7ee85a7b5217a90a63ac3b74ca21', 1),
(17, 'e27946ae23e75640aac97298918ff58a', 1),
(18, '8e5af896f5370b218d083c93aa887b91', 1),
(19, '11d9ce45f30f015589d27a2a9deea09b', 1),
(20, 'e5c9e44b28d452506dd416a0015f643b', 3),
(21, '96b5171c07af2a10cc352952f3d22f47', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `order_products`
--

CREATE TABLE `order_products` (
  `id_order_products` int(11) NOT NULL,
  `id_orders` varchar(32) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_products`
--

INSERT INTO `order_products` (`id_order_products`, `id_orders`, `id_product`, `price`, `qty`) VALUES
(36, '', 78, 350, 1),
(37, 'e5c9e44b28d452506dd416a0015f643b', 87, 23, 1),
(38, '2fea7ee85a7b5217a90a63ac3b74ca21', 87, 23, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id_page` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `rewrite` varchar(200) NOT NULL,
  `h1` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `keywords` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `view` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id_page`, `title`, `rewrite`, `h1`, `description`, `keywords`, `text`, `view`, `sort`, `dt`) VALUES
(1, 'Контакты', 'contacts', 'Контакты', 'Контактная информация', 'контакты', '<div id="contacts" class="wow fadeIn">\n<p class="h5 up">Как нас найти?</p>\n<h1 class="bold wow bounceInLeft" style="margin-top: 20px;">Контакты</h1>\n<div class="build">\n<h5 style="margin-bottom: 25px;">Адрес</h5>\n<p>04655, Украина</p>\n<p>г.Киев</p>\n<p>ул. В. Хвойки, 21</p>\n</div>\n<div class="contact">\n<h5>Телефон &amp; Email</h5>\n<p>+38 (044) 224-54-76</p>\n<p><a href="mailto:email@starfoods.com.ua">email@starfoods.com.ua</a></p>\n</div>\n<div style="clear: both;">&nbsp;</div>\n<div class="map">\n<script type="text/javascript" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=vvbrjlgNGJRB3YQKEYig0d1xHIJXccxo&amp;width=100%&amp;height=500px&amp;lang=uk_UA&amp;sourceType=constructor" charset="utf-8"></script>\n</div>\n</div>', 1, 1, '2012-08-14 00:00:00'),
(2, 'Где купить', 'gde-kupit', 'Где купить нашу продукцию', 'Покупка', 'Покупка', '<p>Где купить</p>', 1, 2, '2012-10-17 18:40:20');

-- --------------------------------------------------------

--
-- Структура таблицы `pay`
--

CREATE TABLE `pay` (
  `id_pay` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `name_pay` varchar(100) NOT NULL,
  `markup` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pay`
--

INSERT INTO `pay` (`id_pay`, `data`, `name_pay`, `markup`) VALUES
(1, '2012-10-19 15:13:17', 'Наличная оплата', 0),
(2, '2012-06-11 20:07:51', 'Web Money', 3),
(3, '2012-06-05 18:05:39', 'Безналичная оплата', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `rewrite` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `full_text` text NOT NULL,
  `price` int(11) DEFAULT NULL,
  `old_price` int(11) NOT NULL,
  `available` int(11) NOT NULL DEFAULT '3',
  `view` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `ip` varchar(30) NOT NULL,
  `login` varchar(50) NOT NULL,
  `temp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id_product`, `id_category`, `id_brand`, `rewrite`, `name`, `title`, `description`, `text`, `full_text`, `price`, `old_price`, `available`, `view`, `dt`, `ip`, `login`, `temp`) VALUES
(105, 8, 0, 'chizkek-yagodnui-miks', 'Ягодный микс', 'Чизкейк Ягодный микс', 'Чизкейк Ягодный микс', '<p>Небольшое описание чизкейка, о его изюминках итд итп. И дальше добавим текста, что заполнить пространсво. И тут тоже заполним пространство с новой строки и вот уже наверное всё.</p>', '<p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.</p>\n<p>В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.</p>', 6, 0, 1, 0, '2015-10-21 13:35:40', '', '', 0),
(106, 8, 0, 'chizkek-italyanski', 'Итальянский', 'Чизкейк итальянский', 'Чизкейк Итальянский', '<p>Небольшое описание чизкейка, о его изюминках итд итп. И дальше добавим текста, что заполнить пространсво. И тут тоже заполним пространство с новой строки и вот уже наверное всё.</p>', '<p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.</p>\n<p>В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.</p>', 6, 0, 1, 0, '2015-10-21 13:57:20', '', '', 0),
(107, 8, 0, 'chizkek-chernichnui', 'Черничный', 'Чизкейк Черничный', 'Чизкейк Черничный', '<p>Небольшое описание чизкейка, о его изюминках итд итп. И дальше добавим текста, что заполнить пространсво. И тут тоже заполним пространство с новой строки и вот уже наверное всё.</p>', '<h4 style="margin: 0px; padding: 0px; border: 0px; font-weight: inherit; font-stretch: inherit; font-size: 2.3em; line-height: inherit; font-family: OpenSansCond; vertical-align: baseline; color: #303030; text-align: right;">Больше ягод</h4>\n<p style="margin: 15px 0px 0px; padding: 0px; border: 0px; font-stretch: inherit; font-size: 0.875em; line-height: 21px; font-family: HelveticaNeueLTW1G-Roman; vertical-align: baseline; color: #303030;">Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.</p>\n<p style="margin: 15px 0px 0px; padding: 0px; border: 0px; font-stretch: inherit; font-size: 0.875em; line-height: 21px; font-family: HelveticaNeueLTW1G-Roman; vertical-align: baseline; color: #303030;">В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.</p>', 6, 0, 1, 0, '2015-10-21 15:09:48', '', '', 0),
(108, 8, 0, 'cheesecake-plato', 'Плато', 'Чизкейк плато', 'Чизкейк плато', '<p>Небольшое описание чизкейка, о его изюминках итд итп. И дальше добавим текста, что заполнить пространсво. И тут тоже заполним пространство с новой строки и вот уже наверное всё.</p>', '<p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.</p>\n<p>В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.</p>', 7, 0, 1, 0, '2015-10-23 10:33:08', '', '', 0),
(109, 8, 0, 'cheesecake-s-vishney', 'С вишней', 'Чизкейк с вишней', 'Чизкейк с вишней', '<p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.</p>', '<p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.</p>\n<p>В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.</p>', 6, 0, 1, 0, '2015-10-23 12:06:03', '', '', 0),
(110, 8, 0, 'cheesecake-kalambur', 'Каламбур', 'Чизкейк каламбур', 'Чизкейк каламбур', '<p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.</p>', '<p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.</p>\n<p>В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.</p>', 6, 0, 1, 0, '2015-10-23 12:16:11', '', '', 0),
(111, 8, 0, 'cheesecake-siciliski', 'Сицилийский', 'Чизкейк сицилийский', 'Чизкейк сицилийский', '<p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.</p>', '<p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.</p>\n<p>В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.</p>', 6, 0, 1, 0, '2015-10-23 12:21:44', '', '', 0),
(112, 8, 0, 'cheesecake-klubnichnui', 'Клубничный', 'Чизкейк клубничный', 'Чизкейк клубничный', '<p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.</p>', '<p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.</p>\n<p>В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.</p>', 6, 0, 1, 0, '2015-10-23 12:29:46', '', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id_setting` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(200) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id_setting`, `name`, `value`, `width`, `height`) VALUES
(1, 'title_shop', 'Интернет-магазин чизкейков', 0, 0),
(2, 'count_item_page', '30', 0, 0),
(3, 'image_list_item', '', 220, 160),
(4, 'image_boss_item', '', 270, 170),
(5, 'image_preview_item', '', 50, 50),
(6, 'image_category', '', 100, 70),
(7, 'image_logo_brand', '', 100, 100),
(8, 'description', 'Чизкейки ггг', 0, 0),
(9, 'keywords', 'купить, торт, чизкейк', 0, 0),
(10, 'themePath', 'starfoods', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shipping`
--

CREATE TABLE `shipping` (
  `id_shipping` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `name_shipping` varchar(100) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shipping`
--

INSERT INTO `shipping` (`id_shipping`, `data`, `name_shipping`, `price`) VALUES
(1, '2012-06-05 17:46:52', 'Самовывоз', 0),
(2, '2012-06-11 20:18:28', 'Доставка курьером', 25),
(3, '2012-10-19 15:38:24', 'Автолюкс ', 45);

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `color` varchar(7) NOT NULL,
  `data` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id_status`, `name`, `color`, `data`, `ip`, `login`) VALUES
(1, 'В ожидании', '#f68e54', '2012-10-22 14:55:45', '127.0.0.1', 'Admin'),
(3, 'Выполнено', '', '2012-10-17 18:37:37', '127.0.0.1', 'Admin');

-- --------------------------------------------------------

--
-- Структура таблицы `taxes`
--

CREATE TABLE `taxes` (
  `id_tax` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `tax_val` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `taxes`
--

INSERT INTO `taxes` (`id_tax`, `name`, `type`, `tax_val`) VALUES
(0, 'НДС', 1, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `users_orders`
--

CREATE TABLE `users_orders` (
  `id_user` int(11) NOT NULL,
  `key_orders` varchar(32) NOT NULL,
  `name_user` varchar(300) NOT NULL,
  `mail_user` varchar(100) NOT NULL,
  `phone_user` varchar(100) NOT NULL,
  `fax_user` varchar(100) NOT NULL,
  `city_user` int(11) NOT NULL,
  `street_user` varchar(100) NOT NULL,
  `build_user` varchar(20) NOT NULL,
  `app_user` varchar(30) NOT NULL,
  `pay_user` int(11) NOT NULL,
  `ships_user` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_orders`
--

INSERT INTO `users_orders` (`id_user`, `key_orders`, `name_user`, `mail_user`, `phone_user`, `fax_user`, `city_user`, `street_user`, `build_user`, `app_user`, `pay_user`, `ships_user`, `data`) VALUES
(21, '2fea7ee85a7b5217a90a63ac3b74ca21', 'Владислав Витальевич Сухих', 'hissone@gmail.comss', '380674991340', '', 2, 'пр. Правды', '34', '4', 2, 2, '2012-09-21 13:13:35'),
(22, 'e27946ae23e75640aac97298918ff58a', 'Владислав Витальевич Сухих', 'hissone@gmail.com', '380632238628', '', 1, 'пр. Правды', '10', '4', 2, 2, '2012-09-21 13:34:52'),
(23, '8e5af896f5370b218d083c93aa887b91', 'Владислав Витальевич Сухих', 'hissone@gmail.com', '380632238628', '', 1, 'пр. Правды', '11', '101', 1, 1, '2012-09-21 13:35:24'),
(24, '11d9ce45f30f015589d27a2a9deea09b', 'Оран Гутанович', '', '380673298767', '', 2, 'победы', '12', '23', 2, 1, '2012-09-21 15:13:43'),
(25, 'e5c9e44b28d452506dd416a0015f643b', 'Тестовый Ебать Лох', 'test@lox.ru', '3901283', '111', 2, 'Тестовая', '23', '43', 1, 1, '2012-09-27 18:44:09'),
(26, '96b5171c07af2a10cc352952f3d22f47', 'Владислав Витальевич Сухих', 'hissone@gmail.com', '380632238628', '', 1, 'пр. Правды, 10, 4', '4', '4', 2, 2, '2012-11-02 15:42:58');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id_city`);

--
-- Индексы таблицы `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Индексы таблицы `filter`
--
ALTER TABLE `filter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_option` (`id_option`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_images`);

--
-- Индексы таблицы `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`id_money`);

--
-- Индексы таблицы `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `options_category`
--
ALTER TABLE `options_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_option` (`id_option`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Индексы таблицы `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id_order_products`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id_page`);

--
-- Индексы таблицы `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`id_pay`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id_setting`);

--
-- Индексы таблицы `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id_shipping`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`),
  ADD KEY `name` (`name`);

--
-- Индексы таблицы `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brand`
--
ALTER TABLE `brand`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `id_city` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `filter`
--
ALTER TABLE `filter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id_images` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `money`
--
ALTER TABLE `money`
  MODIFY `id_money` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `options_category`
--
ALTER TABLE `options_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id_order_products` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id_page` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `pay`
--
ALTER TABLE `pay`
  MODIFY `id_pay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id_shipping` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
