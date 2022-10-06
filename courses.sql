-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 06 2022 г., 21:23
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
  `duration` int(15) DEFAULT NULL,
  `start` int(50) NOT NULL,
  `end` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id_course`, `teacher_id`, `name`, `description`, `duration`, `start`, `end`) VALUES
(4, 69, 'Web', 'pppp', 45, 1661983200, 1664056800),
(5, 66, 'Telecosº', 'El mejor curso', 13, 1665093600, 1665180000),
(6, 70, 'Cyust', 'ejtrweh', 134, 1666303200, 1666994400);

-- --------------------------------------------------------

--
-- Структура таблицы `enrollment`
--

CREATE TABLE `enrollment` (
  `id_enrollment` int(100) NOT NULL,
  `id_student` int(100) NOT NULL,
  `id_course` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `enrollment`
--

INSERT INTO `enrollment` (`id_enrollment`, `id_student`, `id_course`) VALUES
(28, 2, 5),
(29, 3, 6);

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
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id_student` int(100) NOT NULL,
  `DNI` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `age` int(3) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id_student`, `DNI`, `name`, `surname`, `age`, `password`, `image`, `created_at`) VALUES
(1, '433445D', 'suka', 'blyat', 15, '$2y$10$1CprSc.b5w9NFm557U8lpOfwtHaODWeZHJ05UJg9TnCM3IqzI77V2', '1664971802tamaño-foto-dni.jpg', '2022-10-05 13:10:02'),
(2, '123123', 'nombre', 'apellidos', 12, '$2y$10$4LxLav1Ud2TI7qdxVRXh3Oj3sw7jsBc0vRpNX//ODYj7QmdIqwFVq', '1665062497', '2022-10-06 15:21:37'),
(3, '321321', 'nombre', 'apellidos a', 13, '$2y$10$IMnX9bxLpaiRxb4uqrFIVOckvH3/QoRqEvkR/5zdibk0hYIw4XZkK', '1665082756', '2022-10-06 20:59:16');

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
(66, 'rtert', 'Alex', 'Baik', 'DAW', 'Bó.', '$2y$10$CXMC01EnG8icwvhoMU7ZL.D47l6QtZWUsRZ1kSuluD4TCZdBaOdLi', '2022-09-21 08:59:42', '1663925826AnyDesk.exe'),
(68, 'wergwerg', 'wergwerg', 'wergwreg', 'wergwerg', 'admin', '$2y$10$nsfVfGt4qEW8KZyYgZ8ePeS4SnWS/6ayOaYe3NBSuX7aPxHn5o16W', '2022-09-22 06:51:24', '1663822284'),
(69, '3563464364D', 'Nombre', 'Apellidos', 'Telecos', 'Profe telecos', '$2y$10$VNfydqd8Wpr8q2uvgPP6SeBcYVkUErVyU7NefRQnj6S5GUq/4LxAm', '2022-09-23 08:21:50', '1663925931download.jpg'),
(70, '23425454E', '321321', '321321', '321321', '321321', '$2y$10$Dj5hWi5JiPUbec3a2tAq4uvEMSWz8KHjOAlpUN7lNfXiWnWj/7rLm', '2022-10-06 19:28:02', '1665077282');

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
  ADD PRIMARY KEY (`id_course`) USING BTREE,
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Индексы таблицы `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id_enrollment`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `id_course` (`id_course`);

--
-- Индексы таблицы `passwords`
--
ALTER TABLE `passwords`
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_student`),
  ADD UNIQUE KEY `DNI` (`DNI`);

--
-- Индексы таблицы `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id_enrollment` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id_student` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id_course`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `passwords`
--
ALTER TABLE `passwords`
  ADD CONSTRAINT `passwords_ibfk_1` FOREIGN KEY (`id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
