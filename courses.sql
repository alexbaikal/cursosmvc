-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 22 2022 г., 07:53
-- Версия сервера: 10.4.24-MariaDB
-- Версия PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `courses`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `password` varchar(256) NOT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `password`, `username`) VALUES
(0, '$2y$10$OCMn12zdgZ0U.GnqE.FNfeOPBei/ovF5lK5u14pAOWFJSVF9D29pO', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE `courses` (
  `id_course` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start` int(50) NOT NULL,
  `end` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `passwords`
--

CREATE TABLE `passwords` (
  `id` int(148) NOT NULL,
  `password` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `dni` varchar(21) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `dni`, `name`, `surname`, `title`, `description`, `password`, `created_at`, `image`) VALUES
(66, 'rtert', 'Alex', 'Baik', 'DAW', 'Bó.', '$2y$10$CXMC01EnG8icwvhoMU7ZL.D47l6QtZWUsRZ1kSuluD4TCZdBaOdLi', '2022-09-21 08:59:42', '1663822153WhatsApp Image 2022-09-22 at 06.25.43.jpeg'),
(68, 'wergwerg', 'wergwerg', 'wergwreg', 'wergwerg', 'admin', '$2y$10$nsfVfGt4qEW8KZyYgZ8ePeS4SnWS/6ayOaYe3NBSuX7aPxHn5o16W', '2022-09-22 06:51:24', '1663822284');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD UNIQUE KEY `id_course` (`id_course`);

--
-- Индексы таблицы `passwords`
--
ALTER TABLE `passwords`
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `passwords`
--
ALTER TABLE `passwords`
  ADD CONSTRAINT `passwords_ibfk_1` FOREIGN KEY (`id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
