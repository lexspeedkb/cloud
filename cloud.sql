-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Янв 23 2020 г., 17:40
-- Версия сервера: 10.3.21-MariaDB-1:10.3.21+maria~xenial-log
-- Версия PHP: 7.4.1

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
-- Структура таблицы `dirs`
--

CREATE TABLE `dirs` (
  `id` int(255) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `free` tinyint(1) NOT NULL DEFAULT 0,
  `owners` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` int(255) NOT NULL,
  `parent_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dirs`
--

INSERT INTO `dirs` (`id`, `name`, `free`, `owners`, `owner_id`, `parent_id`) VALUES
(0, 'root', 0, '', 1, NULL),
(12, 'lexspeedkb', 0, '', 2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `name` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `src` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basket` tinyint(1) DEFAULT 0,
  `owners` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `free` tinyint(1) NOT NULL DEFAULT 0,
  `dir` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(255) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'root', 'DPHCE08FIPOdCNNGOyOHgUmBY5AlLAvtTRrnOzSnf1g7N5PThJ5ZT4MRa5WmXRbMkwsK0TQr12UWKF3FHRDwMUkX9F0kqsOJeVUo', 'Алексей Пилипенко', 0, 'lexus2001'),
(2, 'lexspeedkb', 'JPiQHBu7lTkGNAQfGRGk50gESxpxB2dIPrm9LMRMXEFB40CGrBx1qOduLLxfU7oiFw8XwODzymCTnqdaBQnMVHAPNz8quDGOAZCj', 'Алексей Пилипенко', 0, 'lexus2001');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dirs`
--
ALTER TABLE `dirs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
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
-- AUTO_INCREMENT для таблицы `dirs`
--
ALTER TABLE `dirs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `dirs`
--
ALTER TABLE `dirs`
  ADD CONSTRAINT `dirs_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dirs_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `dirs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
