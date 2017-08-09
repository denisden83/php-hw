-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 09 2017 г., 17:10
-- Версия сервера: 5.7.16
-- Версия PHP: 7.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `burger`
--

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `client_id` smallint(6) NOT NULL,
  `name` tinytext,
  `email` tinytext NOT NULL,
  `phone` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`client_id`, `name`, `email`, `phone`) VALUES
(14, 'mike', 'mike@mail.ru', '+7 (555) 555 55 55'),
(15, 'john', 'john@mail.ru', '+7 (838) 388 38 38'),
(18, 'foo', 'foo@mail.ru', '+7 (777) 777 77 77'),
(24, 'kurd', 'kurd@mail.ru', '+7 (838) 392 83 92'),
(26, 'burd', 'burd@mail.ru', '+7 (777) 777 77 77'),
(27, 'jane', 'jane@mail.ru', '+7 (222) 222 22 22'),
(28, 'rick', 'rick@mail.ru', '+7 (928) 387 49 24'),
(29, 'bill', 'bill@mail.ru', '+7 (000) 333 33 33'),
(30, 'willi', 'willi@mail.ru', '+7 (987) 658 88 88'),
(31, 'kat', 'kat@mail.ru', '+7 (876) 678 47 55'),
(32, 'fat', 'fat@mail.ru', '+7 (876) 678 47 55'),
(33, 'enrico', 'enrico@mail.ru', '+7 (017) 889 29 10'),
(34, 'len', 'len@mail.ru', '+7 (839) 483 89 39'),
(35, 'ken', 'ken@mail.ru', '+7 (983) 746 73 64'),
(36, 'nike', 'nike@mail.ru', '+7 (993) 939 39 39'),
(37, 'asdf', 'asdf@mail.ru', '+7 (456) 789 98 99'),
(39, 'sindy', 'sindy@mail.ru', '+7 (838) 838 38 38');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` smallint(6) NOT NULL,
  `ordertime` datetime DEFAULT NULL,
  `comment` text,
  `payment` enum('needchange','nochange') DEFAULT NULL,
  `callback` enum('needcallback','nocallback') DEFAULT NULL,
  `street` tinytext,
  `home` int(11) DEFAULT NULL,
  `block` int(11) DEFAULT NULL,
  `apart` int(11) DEFAULT NULL,
  `floor` int(11) DEFAULT NULL,
  `client_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `ordertime`, `comment`, `payment`, `callback`, `street`, `home`, `block`, `apart`, `floor`, `client_id`) VALUES
(7, '2017-08-07 12:11:39', 'kdlsk', 'needchange', 'needcallback', 'ffff', 55, 66, 22, 22, 15),
(20, '2017-08-07 23:36:15', 'jkslka', 'needchange', 'nocallback', 'kdls', 33, 44, 55, 77, 15),
(21, '2017-08-07 23:39:13', 'jkslka', 'needchange', 'nocallback', 'kdls', 33, 44, 55, 77, 15),
(22, '2017-08-07 23:40:19', 'asdfjkaaa', 'needchange', 'nocallback', 'aakd', 99, 0, 777, 444, 14),
(23, '2017-08-07 23:40:55', 'asdfjkaaa', 'needchange', 'nocallback', 'aakd', 99, 0, 777, 444, 14),
(24, '2017-08-07 23:40:58', 'asdfjkaaa', 'needchange', 'nocallback', 'aakd', 99, 0, 777, 444, 14),
(25, '2017-08-07 23:42:18', 'бчюббюч', 'needchange', 'nocallback', 'ureiow', 7747, 398839, 29823, 1223, 18),
(26, '2017-08-07 23:42:32', 'бчюббюч', 'needchange', 'nocallback', 'ureiow', 7747, 398839, 29823, 1223, 18),
(27, '2017-08-07 23:42:36', 'бчюббюч', 'needchange', 'nocallback', 'ureiow', 7747, 398839, 29823, 1223, 18),
(30, '2017-08-07 23:44:55', 'агггфлв', 'nochange', 'needcallback', 'бсчб', 999, 99777, 7655, 445, 24),
(31, '2017-08-07 23:44:58', 'агггфлв', 'nochange', 'needcallback', 'бсчб', 999, 99777, 7655, 445, 24),
(34, '2017-08-08 00:06:15', 'kdlskj', 'nochange', 'nocallback', 'kdkls', 77, 77, 77, 77, 26),
(35, '2017-08-08 00:06:52', 'kdlskj', 'nochange', 'nocallback', 'kdkls', 77, 77, 77, 77, 26),
(36, '2017-08-08 00:09:14', 'kdlskj', 'nochange', 'nocallback', 'kdkls', 77, 77, 77, 77, 26),
(37, '2017-08-08 00:11:11', 'mhtyhjj', 'needchange', 'needcallback', 'oooow', 11, 99, 11, 4321, 27),
(38, '2017-08-08 00:16:20', 'mhtyhjj', 'needchange', 'needcallback', 'oooow', 11, 99, 11, 4321, 27),
(39, '2017-08-08 00:17:30', 'mhtyhjj', 'needchange', 'needcallback', 'oooow', 11, 99, 11, 4321, 27),
(41, '2017-08-08 11:38:48', 'агггфлв', 'nochange', 'needcallback', 'бсчб', 999, 99777, 7655, 445, 24),
(42, '2017-08-08 11:39:13', 'агггфлв', 'nochange', 'needcallback', 'бсчб', 999, 99777, 7655, 445, 24),
(43, '2017-08-08 11:39:20', 'агггфлв', 'nochange', 'needcallback', 'бсчб', 999, 99777, 7655, 445, 24),
(45, '2017-08-08 11:41:42', 'агггфлв', 'nochange', 'needcallback', 'бсчб', 999, 99777, 7655, 445, 24),
(46, '2017-08-08 11:41:58', 'агггфлв', 'nochange', 'needcallback', 'бсчб', 999, 99777, 7655, 445, 24),
(47, '2017-08-08 11:43:17', 'агггфлв', 'nochange', 'needcallback', 'бсчб', 999, 99777, 7655, 445, 24),
(50, '2017-08-08 13:05:16', 'kldsklkal', 'needchange', 'needcallback', 'pyshkina', 77, 55, 44, 22, 29),
(51, '2017-08-08 13:05:23', 'kldsklkal', 'needchange', 'needcallback', 'pyshkina', 77, 55, 44, 22, 29),
(52, '2017-08-08 14:10:39', 'kldsklkal', 'needchange', 'needcallback', 'pyshkina', 77, 55, 44, 22, 28),
(53, '2017-08-08 14:14:18', 'kldsklkal', 'needchange', 'needcallback', 'pyshkina', 77, 55, 44, 22, 28),
(54, '2017-08-08 14:15:26', 'kldsklkal', 'needchange', 'needcallback', 'pyshkina', 77, 55, 44, 22, 28),
(55, '2017-08-08 14:17:34', 'я голодный', 'nochange', 'nocallback', 'садовая', 98, 76, 54, 32, 30),
(56, '2017-08-08 14:18:10', 'я голодный', 'nochange', 'nocallback', 'садовая', 98, 76, 54, 32, 30),
(57, '2017-08-08 14:22:31', 'я голодный', 'nochange', 'nocallback', 'садовая', 98, 76, 54, 32, 30),
(58, '2017-08-08 14:22:57', 'я голодный', 'nochange', 'nocallback', 'садовая', 98, 76, 54, 32, 30),
(59, '2017-08-09 09:45:08', 'я голодный', 'nochange', 'nocallback', 'садовая', 98, 76, 54, 32, 30),
(60, '2017-08-09 09:47:37', 'я голодный', 'nochange', 'nocallback', 'садовая', 98, 76, 54, 32, 30),
(61, '2017-08-09 09:49:38', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 31),
(62, '2017-08-09 10:02:45', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 31),
(63, '2017-08-09 10:05:57', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 31),
(64, '2017-08-09 10:06:21', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 31),
(65, '2017-08-09 10:14:18', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 31),
(66, '2017-08-09 10:46:41', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 31),
(67, '2017-08-09 10:49:23', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 32),
(68, '2017-08-09 10:50:13', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 32),
(69, '2017-08-09 10:50:20', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 32),
(70, '2017-08-09 10:57:06', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 32),
(71, '2017-08-09 10:58:15', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 32),
(72, '2017-08-09 10:58:18', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 32),
(73, '2017-08-09 11:01:32', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 32),
(74, '2017-08-09 11:02:10', 'oiowpqi', 'needchange', 'nocallback', 'kytre', 22, 43, 76, 34, 32),
(75, '2017-08-09 11:03:40', 'i am wating', 'nochange', 'needcallback', 'wall', 54, 32, 45, 43, 33),
(76, '2017-08-09 11:03:52', 'i am wating', 'nochange', 'needcallback', 'wall', 54, 32, 45, 43, 33),
(77, '2017-08-09 11:47:58', 'uiwoeoep', 'needchange', 'needcallback', 'gold', 55, 44, 99, 88, 34),
(78, '2017-08-09 11:49:18', 'uiwoeoep', 'needchange', 'needcallback', 'gold', 55, 44, 99, 88, 34),
(79, '2017-08-09 14:32:41', 'uiwoeoep', 'needchange', 'needcallback', 'gold', 55, 44, 99, 88, 34),
(80, '2017-08-09 14:33:47', 'uiwoeoep', 'needchange', 'needcallback', 'gold', 55, 44, 99, 88, 34),
(81, '2017-08-09 14:33:51', 'uiwoeoep', 'needchange', 'needcallback', 'gold', 55, 44, 99, 88, 34),
(82, '2017-08-09 14:34:32', 'uiwoeoep', 'needchange', 'needcallback', 'gold', 55, 44, 99, 88, 34),
(83, '2017-08-09 14:35:24', 'nnvnnvnvn', 'needchange', 'needcallback', 'parms', 83, 74, 29, 92, 35),
(84, '2017-08-09 14:35:55', 'nnvnnvnvn', 'needchange', 'needcallback', 'parms', 83, 74, 29, 92, 35),
(85, '2017-08-09 14:35:59', 'nnvnnvnvn', 'needchange', 'needcallback', 'parms', 83, 74, 29, 92, 35),
(86, '2017-08-09 14:45:40', 'kkdlsk', 'needchange', 'needcallback', 'gosoi', 74, 92, 74, 92, 36),
(87, '2017-08-09 14:46:16', 'kkdlsk', 'needchange', 'needcallback', 'gosoi', 74, 92, 74, 92, 36),
(88, '2017-08-09 14:47:22', 'kkdlsk', 'needchange', 'needcallback', 'gosoi', 74, 92, 74, 92, 36),
(89, '2017-08-09 14:47:26', 'kkdlsk', 'needchange', 'needcallback', 'gosoi', 74, 92, 74, 92, 36),
(90, '2017-08-09 14:47:47', 'kkdlsk', 'needchange', 'needcallback', 'gosoi', 74, 92, 74, 92, 36),
(91, '2017-08-09 14:49:16', 'kslkadf', 'needchange', 'needcallback', 'kslka', 74, 74, 72, 74, 14),
(92, '2017-08-09 15:30:39', 'kslkadf', 'needchange', 'needcallback', 'kslka', 74, 74, 72, 74, 14),
(93, '2017-08-09 15:30:45', 'kslkadf', 'needchange', 'needcallback', 'kslka', 74, 74, 72, 74, 14),
(94, '2017-08-09 15:31:45', 'kdlslsk', 'needchange', 'needcallback', 'kdkls', 83, 92, 74, 83, 29),
(95, '2017-08-09 15:31:53', 'kdlslsk', 'needchange', 'needcallback', 'kdkls', 83, 92, 74, 83, 29),
(96, '2017-08-09 15:32:47', 'kdlslsk', 'needchange', 'needcallback', 'kdkls', 83, 92, 74, 83, 29),
(97, '2017-08-09 15:33:38', 'kdls', 'needchange', 'needcallback', 'kdlsk', 83, 91, 83, 73, 29),
(98, '2017-08-09 15:33:46', 'kdls', 'needchange', 'needcallback', 'kdlsk', 83, 91, 83, 73, 29),
(99, '2017-08-09 15:34:10', 'kdls', 'needchange', 'needcallback', 'kdlsk', 83, 91, 83, 73, 37),
(100, '2017-08-09 15:35:17', 'kdls', 'needchange', 'needcallback', 'kdlsk', 83, 91, 83, 73, 37),
(101, '2017-08-09 15:35:21', 'kdls', 'needchange', 'needcallback', 'kdlsk', 83, 91, 83, 73, 37),
(102, '2017-08-09 15:36:08', 'kdls', 'needchange', 'needcallback', 'kdlsk', 83, 91, 83, 73, 37),
(104, '2017-08-09 15:47:21', 'klskla', 'needchange', 'needcallback', 'kklsk', 38, 83, 83, 83, 15),
(105, '2017-08-09 15:48:14', 'hhhhhhh', 'nochange', 'nocallback', 'klslklsa', 83, 93, 92, 92, 39),
(106, '2017-08-09 15:49:47', 'hhhhhhh', 'nochange', 'nocallback', 'klslklsa', 83, 93, 92, 92, 39),
(107, '2017-08-09 15:50:14', 'hhhhhhh', 'nochange', 'nocallback', 'klslklsa', 83, 93, 92, 92, 39);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_clients_client_id_fk` (`client_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_clients_client_id_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
