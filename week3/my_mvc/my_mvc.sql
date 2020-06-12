-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 13 2020 г., 02:21
-- Версия сервера: 5.7.29
-- Версия PHP: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `my_mvc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `message`, `datetime`) VALUES
(1, 50, 'Пока', '2020-06-12 17:08:44'),
(2, 50, 'Тест', '2020-06-12 17:08:44'),
(3, 50, 'Привет', '2020-06-12 17:08:46'),
(4, 50, 'Еще один пост', '2020-06-12 17:08:46'),
(5, 5, 'я нет меня', '2020-06-12 17:18:55'),
(6, 5, 'я нет меня тоже нет ваще 5555', '2020-06-12 17:19:00'),
(7, 50, 'Привет, как дела?', '2020-06-13 00:44:33'),
(8, 50, 'Привет, как дела?', '2020-06-13 00:47:24'),
(9, 50, 'Привет, как дела?', '2020-06-13 00:47:43'),
(10, 50, 'Привет, как дела?', '2020-06-13 00:48:44'),
(11, 50, 'Привет, как дела?352325', '2020-06-13 00:50:07'),
(12, 50, 'Привет, как дела?', '2020-06-13 00:50:36'),
(13, 50, '', '2020-06-13 00:51:39'),
(14, 50, '&lt;b&gt;gdfgdgdg&lt;/b&gt;', '2020-06-13 01:12:49');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `is_admin`) VALUES
(50, 'art@example.com', 'Artem', 'd40d8ae8dad378e14f50c1ad8520c1dc6cb2692b', 1),
(51, 'art1@example.com', 'Artem', 'd40d8ae8dad378e14f50c1ad8520c1dc6cb2692b', 0),
(52, 'art2@example.com', 'Artem', 'd40d8ae8dad378e14f50c1ad8520c1dc6cb2692b', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
