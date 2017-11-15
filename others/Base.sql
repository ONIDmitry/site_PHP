-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 28 2014 г., 16:29
-- Версия сервера: 5.6.12-log
-- Версия PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `tutorials`
--
CREATE DATABASE IF NOT EXISTS `tutorials` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `tutorials`;

-- --------------------------------------------------------

--
-- Структура таблицы `chern`
--

CREATE TABLE IF NOT EXISTS `chern` (
  `ident` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  PRIMARY KEY (`ident`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Триггеры `chern`
--
DROP TRIGGER IF EXISTS `delete_client`;
DELIMITER //
CREATE TRIGGER `delete_client` BEFORE INSERT ON `chern`
 FOR EACH ROW DELETE FROM zayavka WHERE zayavka.login = NEW.login
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `cort`
--

CREATE TABLE IF NOT EXISTS `cort` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `ide` varchar(10) NOT NULL,
  `kolvo` varchar(10) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `confirmed` varchar(20) NOT NULL,
  `nzayavki` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Структура таблицы `loginuser`
--

CREATE TABLE IF NOT EXISTS `loginuser` (
  `nom` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `cod` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=335 ;

--
-- Дамп данных таблицы `loginuser`
--

INSERT INTO `loginuser` (`nom`, `login`, `cod`, `username`) VALUES
(333, 'admin', 'e6b6874ced7d2df92f70d55fa032b6ce21232f297a57a5a743894a0e4a801fc3', 'admin'),
(334, 'buh', 'e2db22e174bb510920fe7c81ec7b3a581dccbb9fba844c9a1ef8cd4f14f0caf4', 'Buhgalt');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `iden` varchar(11) NOT NULL,
  `tittle` varchar(255) NOT NULL,
  `krop` text NOT NULL,
  `opis` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `svezh` varchar(3) NOT NULL,
  `date` varchar(10) NOT NULL,
  PRIMARY KEY (`iden`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`iden`, `tittle`, `krop`, `opis`, `image`, `svezh`, `date`) VALUES
('1', 'ПОЗОР МГУ!!!', 'Руководитель исследования из МГУ был занесён в чёрный список', 'Сегодня,1 ноября 2013 года, руководитель исследования из МГУ, Николай Викторович( логин Kolyan 228), не оплатил свой заказ на изготовление и был занесён в чёрный список. ПОЗОР МГУ!!!', '"mgu.jpg"', 'new', '01.11.2013'),
('2', 'НАШ ОТДЕЛ САМЫЙ ЛУЧШИЙ!!!', 'Сегодня, 1 ноября 2013 года, Министерство Образования определило лучший отдел снабжения', 'Сегодня, 1 ноября 2013 года, Министерство Образования определило лучший отдел снабжения. НАШ ОТДЕЛ ОКАЗАЛСЯ САМЫЙ ЛУЧШИЙ !!! Спасибо всем, все свободны', '"piedestal.jpg"', 'new', '01.11.2013'),
('3', 'НОВЫЕ МАТЕРИАЛЫ!!!', 'Сегодня, 31 ноября 2013 года, в наш отдел поступили новые товары....', 'Сегодня, 31 ноября 2013 года, в наш отдел поступили новые товары. спсбальшое!!! Вы можете посмотреть обновленный список там, где и всегда.', '"instrum.jpg"', 'old', '31.10.2013'),
('4', 'Сайт работает хорошо!!!', 'Сегодня, 3 ноября 2013 года, завершилась проверка работы нашего сайта', 'Сегодня, 3 ноября 2013 года, завершилась проверка работы нашего сайта. Никаких проблем не оказалось, и сайт работает отлично !адынадын		', '"site.jpg"', 'new', '03.11.2013'),
('5', 'ANACONDAZ в Москве!', 'Концерт Anacondaz состоится в феврале 2014 года в Москве!', 'Концерт Anacondaz состоится в феврале 2014 года в Москве! Будет круто ! чотконормтащитпагнали!!!!', '"anacondaz.jpg"', 'old', '03.11.2013');

-- --------------------------------------------------------

--
-- Структура таблицы `reting`
--

CREATE TABLE IF NOT EXISTS `reting` (
  `kluch` int(11) NOT NULL AUTO_INCREMENT,
  `ide` int(3) NOT NULL,
  `rating` int(255) NOT NULL,
  PRIMARY KEY (`kluch`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `reting`
--

INSERT INTO `reting` (`kluch`, `ide`, `rating`) VALUES
(12, 1, 1),
(14, 5, 2),
(16, 4, 3),
(18, 2, 5),
(19, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=146 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `login`, `password`) VALUES
(144, 'admin', 'admin', 'ede6b50e7b5826fe48fc1f0fe772c48f'),
(145, 'Buhgalt', 'Buh', 'ede6b50e7b5826fe48fc1f0fe772c48f');

-- --------------------------------------------------------

--
-- Структура таблицы `variant`
--

CREATE TABLE IF NOT EXISTS `variant` (
  `ide` varchar(11) NOT NULL,
  `varname` varchar(20) NOT NULL,
  `kolvo` varchar(5) NOT NULL,
  `tsenaaren` varchar(5) NOT NULL,
  `tsenazak` varchar(5) NOT NULL,
  `block` varchar(5) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(30) NOT NULL,
  PRIMARY KEY (`ide`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `variant`
--

INSERT INTO `variant` (`ide`, `varname`, `kolvo`, `tsenaaren`, `tsenazak`, `block`, `description`, `image`) VALUES
('1', 'Микроскоп', '175', '200', '2000', 'no', 'Микроскоп-важнейшая вещь, увеличивает   всё', '"micro.jpg"'),
('2', 'Адронный Коллайдер', '154', '10000', '90000', 'no', 'Ну это вообще без комментариев...', '"colide.jpg"'),
('3', 'Лазер', '90', '1000', '5000', 'no', 'Не суйте глаза на пути лазера!', '"lazer.jpg"'),
('4', 'Математический маятн', '176', '50', '500', 'no', 'Свободные колебания, вынужденные колебания', '"mm.jpg"'),
('5', 'Призма Френеля', '297', '60', '700', 'no', 'Сохранение угла', '"pf.jpg"');

-- --------------------------------------------------------

--
-- Структура таблицы `zakaz`
--

CREATE TABLE IF NOT EXISTS `zakaz` (
  `iden` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `tovar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kolvo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `tsena` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tovarpodtv` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `kolvopodtv` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `tsenapodtv` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`iden`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `zayavka`
--

CREATE TABLE IF NOT EXISTS `zayavka` (
  `identif` int(11) NOT NULL AUTO_INCREMENT,
  `imya` varchar(50) NOT NULL,
  `familiya` varchar(50) NOT NULL,
  `otchestvo` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `buhcon` varchar(3) NOT NULL,
  PRIMARY KEY (`identif`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
