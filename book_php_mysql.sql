-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Янв 26 2018 г., 06:46
-- Версия сервера: 5.6.35
-- Версия PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `book_php_mysql`
--

-- --------------------------------------------------------

--
-- Структура таблицы `email_list`
--

CREATE TABLE `email_list` (
  `id` int(11) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `email_list`
--

INSERT INTO `email_list` (`id`, `first_name`, `last_name`, `email`) VALUES
(3, 'Vladimir', 'Chernov', 'vl_che@bk.ru'),
(4, 'Джон', 'Фефель', 'fe@fe.ru'),
(7, 'Нюра', 'Выежкина', ' nu@sdf.ru'),
(8, 'Дон', 'Карлеонэ', 'don@don.ru'),
(9, 'Донкихот', 'Ломанческий', 'don@lom.ital'),
(10, 'Владимир', 'Чернов', 'web@masterche.ru'),
(11, 'Константин', 'Фет', 'fet@fet.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `guitarwars`
--

CREATE TABLE `guitarwars` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(32) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `screenshot` varchar(64) DEFAULT NULL,
  `approved` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `guitarwars`
--

INSERT INTO `guitarwars` (`id`, `date`, `name`, `score`, `screenshot`, `approved`) VALUES
(20, '2018-01-17 03:17:27', 'Никсон', 777555333, 'ajax-loader.gif', 1),
(22, '2018-01-18 03:23:18', 'Belotac', 282470, 'belitasscore.gif', 1),
(23, '2018-01-18 03:24:22', 'jacob', 389740, 'jacobsscore.gif', 1),
(24, '2018-01-18 03:25:44', 'jeanpaulj', 2326, 'jeanpaulsscore.gif', 1),
(25, '2018-01-18 03:26:25', 'kennylav', 64930, 'kennysscore.gif', 1),
(26, '2018-01-18 03:26:56', 'nevil', 98430, 'nevilsscore.gif', 1),
(27, '2018-01-18 03:27:28', 'Paco', 127650, 'pacosscore.gif', 1),
(28, '2018-01-18 03:28:05', 'phiz', 186580, 'phizsscore.gif', 1),
(30, '2018-01-19 04:00:26', 'Хакер Епт', 775333555, 'bg_btn.png', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `mismatch_category`
--

CREATE TABLE `mismatch_category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(48) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mismatch_category`
--

INSERT INTO `mismatch_category` (`category_id`, `name`) VALUES
(1, 'Внешность'),
(2, 'Времяпровождение'),
(3, 'Еда'),
(4, 'Люди'),
(5, 'Оргинизация досуга');

-- --------------------------------------------------------

--
-- Структура таблицы `mismatch_response`
--

CREATE TABLE `mismatch_response` (
  `response_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `response` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mismatch_response`
--

INSERT INTO `mismatch_response` (`response_id`, `user_id`, `topic_id`, `response`) VALUES
(1, 15, 1, 2),
(2, 16, 1, 1),
(3, 16, 2, 1),
(4, 16, 3, 1),
(5, 16, 4, 1),
(6, 16, 5, 1),
(7, 16, 6, 1),
(8, 16, 7, 1),
(9, 16, 8, 1),
(10, 16, 9, 2),
(11, 16, 10, 2),
(12, 16, 11, 1),
(13, 16, 12, 1),
(14, 16, 13, 1),
(15, 16, 14, 2),
(16, 16, 15, 1),
(17, 16, 16, 2),
(18, 16, 17, 1),
(19, 16, 18, 2),
(20, 16, 19, 1),
(21, 16, 20, 2),
(22, 16, 21, 1),
(23, 16, 22, 1),
(24, 16, 23, 1),
(25, 16, 24, 1),
(26, 16, 25, 1),
(27, 17, 1, 2),
(28, 17, 2, 2),
(29, 17, 3, 2),
(30, 17, 4, 2),
(31, 17, 5, 2),
(32, 17, 6, 2),
(33, 17, 7, 2),
(34, 17, 8, 2),
(35, 17, 9, 2),
(36, 17, 10, 2),
(37, 17, 11, 2),
(38, 17, 12, 2),
(39, 17, 13, 2),
(40, 17, 14, 2),
(41, 17, 15, 2),
(42, 17, 16, 1),
(43, 17, 17, 1),
(44, 17, 18, 1),
(45, 17, 19, 1),
(46, 17, 20, 1),
(47, 17, 21, 2),
(48, 17, 22, 2),
(49, 17, 23, 1),
(50, 17, 24, 2),
(51, 17, 25, 2),
(52, 18, 1, 1),
(53, 18, 2, 1),
(54, 18, 3, 1),
(55, 18, 4, 1),
(56, 18, 5, 1),
(57, 18, 6, 1),
(58, 18, 7, 1),
(59, 18, 8, 1),
(60, 18, 9, 1),
(61, 18, 10, 1),
(62, 18, 11, 1),
(63, 18, 12, 1),
(64, 18, 13, 1),
(65, 18, 14, 1),
(66, 18, 15, 1),
(67, 18, 16, 2),
(68, 18, 17, 2),
(69, 18, 18, 2),
(70, 18, 19, 2),
(71, 18, 20, 2),
(72, 18, 21, 2),
(73, 18, 22, 1),
(74, 18, 23, 2),
(75, 18, 24, 1),
(76, 18, 25, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `mismatch_topic`
--

CREATE TABLE `mismatch_topic` (
  `topic_id` int(11) NOT NULL,
  `name` varchar(48) DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mismatch_topic`
--

INSERT INTO `mismatch_topic` (`topic_id`, `name`, `category_id`) VALUES
(1, 'Татуировка', 1),
(2, 'Золотые цепочки', 1),
(3, 'Пирсинг', 1),
(4, 'Ковбойские ботинки', 1),
(5, 'Длиные волосы', 1),
(6, 'Реалити-шоу', 2),
(7, 'Профессиональная борьба', 2),
(8, 'Фильмы ужасов', 2),
(9, 'Легкая музыка', 2),
(10, 'Опера', 2),
(11, 'Суши', 3),
(12, 'Спэм', 3),
(13, 'Острые блюда', 3),
(14, 'Сендвичи с орехом', 3),
(15, 'Мартини', 3),
(16, 'Говард Стен', 4),
(17, 'Билл Гейтс', 4),
(18, 'Барбара Стрейзанд', 4),
(19, 'Хью Хэфнер', 4),
(20, 'Марта Стюарт', 4),
(21, 'Йога', 5),
(22, 'Тяжелая атлетика', 5),
(23, 'Кубик рубика', 5),
(24, 'Караоке', 5),
(25, 'Путешествия', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `mismatch_user`
--

CREATE TABLE `mismatch_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `join_date` datetime DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `picture` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mismatch_user`
--

INSERT INTO `mismatch_user` (`user_id`, `username`, `password`, `join_date`, `first_name`, `last_name`, `gender`, `birthdate`, `city`, `state`, `picture`) VALUES
(1, 'sidneyk', '745c52f30f82d4323292dcca9eea0aee87feecc5', '2008-06-03 14:51:46', 'Sidney', 'Kelsow', 'F', '1984-07-19', 'Tempe', 'AZ', 'sidneypic.jpg'),
(2, 'nevilj', '12a20bcb5ed139a5f3fc808704897762cbab74ec', '2008-06-03 14:52:09', 'Nevil', 'Johansson', 'M', '1973-05-13', 'Reno', 'NV', 'nevilpic.jpg'),
(3, 'alexc', '676a6666682bd41bef5fd1c1f629fa233b1307a4', '2008-06-03 14:53:05', 'Alex', 'Cooper', 'M', '1974-09-13', 'Boise', 'ID', 'alexpic.jpg'),
(4, 'sdaniels', '1ff915f2fae864032e44cbe5a6cdd858500c9df7', '2008-06-03 14:58:40', 'Susannah', 'Daniels', 'F', '1977-02-23', 'Pasadena', 'CA', 'susannahpic.jpg'),
(5, 'ethelh', '53a56acb2a52f3815a2518e75029b071c298477a', '2008-06-03 15:00:37', 'Ethel', 'Heckel', 'F', '1943-03-27', 'Wichita', 'KS', 'ethelpic.jpg'),
(6, 'oklugman', 'df00f36c0b795c30a0409778d7f9db27a970f74f', '2008-06-03 15:00:48', 'Oscar', 'Klugman', 'M', '1968-06-04', 'Providence', 'RI', 'oscarpic.jpg'),
(7, 'belitac', '7c19dd287e03ae31ce190c4043b5a7f9795c41dc', '2008-06-03 15:01:08', 'Belita', 'Chevy', 'F', '1975-07-08', 'El Paso', 'TX', 'belitapic.jpg'),
(8, 'jasonf', '3da70cd115b7c3a7cebc2b5282706f07d185de9e', '2008-06-03 15:01:19', 'Jason', 'Filmington', 'M', '1969-09-24', 'Hollywood', 'CA', 'jasonpic.jpg'),
(9, 'dierdre', '08447be571e1c113f2f175472753ca5f5af454f3', '2008-06-03 15:01:51', 'Dierdre', 'Pennington', 'F', '1970-04-26', 'Cambridge', 'MA', 'dierdrepic.jpg'),
(10, 'baldpaul', '230dcb28e2d1dc19ec14990721e85cd5c5234245', '2008-06-03 15:02:02', 'Paul', 'Hillsman', 'M', '1964-12-18', 'Charleston', 'SC', 'paulpic.jpg'),
(11, 'jnettles', 'e511d793f532dbe0e0483538e11977f7b7c33b28', '2008-06-03 15:02:13', 'Johan', 'Nettles', 'M', '1981-11-03', 'Athens', 'GA', 'johanpic.jpg'),
(12, 'rubyr', '062e4a8476b1063e05caa69958e36a905f887619', '2008-06-03 15:02:24', 'Ruby', 'Reasons', 'F', '1972-09-18', 'Conundrum', 'AZ', 'rubypic.jpg'),
(16, 'Кук', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2018-01-23 04:22:18', 'Кук', 'Куков', 'M', '1988-11-11', 'Хабаровск', 'Россия', 'nevilpic.jpg'),
(17, 'Славная', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2018-01-25 06:10:56', 'Славная', 'Деваха', 'F', '1612-11-11', 'Непомнящий', 'Ушедшая', 'sidneypic.jpg'),
(18, 'Новенький', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2018-01-25 06:21:43', 'Джек', 'Воробей', 'M', '1343-12-12', 'Сидне1', 'Австралия', 'jasonpic.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `table_book`
--

CREATE TABLE `table_book` (
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `when_it_happened` varchar(30) DEFAULT NULL,
  `how_long` varchar(30) DEFAULT NULL,
  `how_many` varchar(30) DEFAULT NULL,
  `alien_description` varchar(100) DEFAULT NULL,
  `what_they_did` varchar(100) DEFAULT NULL,
  `fang_spotted` varchar(10) DEFAULT NULL,
  `other` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `table_book`
--

INSERT INTO `table_book` (`first_name`, `last_name`, `when_it_happened`, `how_long`, `how_many`, `alien_description`, `what_they_did`, `fang_spotted`, `other`, `email`) VALUES
('Салли', 'Джонс', '3 дня назад', '1 день', 'четыре', 'зеленые с щупальцами', 'Разговаривали и играли с собакой', 'да', 'возмлжно я видела вашу собаку', 'pr0c@rambler.ru'),
('Владимир', 'Чернов', 'Украли', '25 дней', '15 гуманоидов', 'Зеленые', 'Тусили', 'Да', 'Фэнг тоже тусил', 'vl_che@bk.ru'),
('Кен', 'Никчей', '10 сентября 17', '2 месяца', '111', 'Зеленый', 'Тренировались', 'Да', 'Фэнг ЖИВ', 'nic@sob.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `email_list`
--
ALTER TABLE `email_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `guitarwars`
--
ALTER TABLE `guitarwars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Индексы таблицы `mismatch_category`
--
ALTER TABLE `mismatch_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `mismatch_response`
--
ALTER TABLE `mismatch_response`
  ADD PRIMARY KEY (`response_id`);

--
-- Индексы таблицы `mismatch_topic`
--
ALTER TABLE `mismatch_topic`
  ADD PRIMARY KEY (`topic_id`);

--
-- Индексы таблицы `mismatch_user`
--
ALTER TABLE `mismatch_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `email_list`
--
ALTER TABLE `email_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `guitarwars`
--
ALTER TABLE `guitarwars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT для таблицы `mismatch_category`
--
ALTER TABLE `mismatch_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `mismatch_response`
--
ALTER TABLE `mismatch_response`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT для таблицы `mismatch_topic`
--
ALTER TABLE `mismatch_topic`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT для таблицы `mismatch_user`
--
ALTER TABLE `mismatch_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
