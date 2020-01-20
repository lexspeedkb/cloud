-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 20 2020 г., 18:21
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cloud`
--

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `src` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `user_id`, `name`, `src`) VALUES
(27, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_25_59.jpg'),
(28, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_26_51.jpg'),
(29, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_27_04.jpg'),
(30, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_27_31.jpg'),
(31, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_28_16.jpg'),
(32, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_28_48.jpg'),
(33, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_28_56.jpg'),
(34, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_29_48.jpg'),
(35, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_29_57.jpg'),
(36, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_30_37.jpg'),
(37, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_30_51.jpg'),
(38, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_32_01.jpg'),
(39, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_32_28.jpg'),
(40, 0, 'Наименование объекта', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_33_17.jpg'),
(41, 0, 'Наименование объекта', 'c01cb154ffaf7082a666376abf657c70_2020_01_19__10_34_34.jpg'),
(42, 0, 'Наименование объекта', '5a1685a518bb51bde7073e09ff752a13_2020_01_19__10_35_51.jpg'),
(43, 1, 'фыв', '5770a2fd8ed93d2a59c96c386fa159ac_2020_01_19__10_57_29.jpg'),
(44, 1, 'qwe', 'c01cb154ffaf7082a666376abf657c70_2020_01_19__10_57_54.jpg'),
(45, 1, 'asd', '0c820771ff495ed6414d02ad79cbb0e3_2020_01_19__11_12_49.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `login` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` int(255) DEFAULT 0,
  `password` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `token`, `name`, `balance`, `password`) VALUES
(1, 'lexspeedkb', 'GNyHWkkPbqCFvNe5TjN2Oh0P4tlJcq5UlXs3yIQOBrNRNKcKBxhg0uX3TF91YOBwSgbSJBk7QyNX7SbTZCXLH4OEB9Z6LHTn5bWf', 'Алексей Пилипенко', 0, 'lexus2001'),
(3, 'lexspeedkb1', 'gaLL8QiA0RlSMtJCpdhAcBUFM7gCgDSsdThpzrwPhuQV3Rs9G1USbWubJoFiXEjyq1MbyMkMGd3Yehx6gePHmNflzCHBoXsuYsi0', 'Алексей Пилипенко', 0, 'qwe');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
