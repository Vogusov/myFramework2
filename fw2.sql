-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 31 2021 г., 16:20
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fw2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `session_id` varchar(45) NOT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id_category` int NOT NULL,
  `status` int NOT NULL,
  `name` varchar(222) NOT NULL,
  `parent_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_category`, `status`, `name`, `parent_id`) VALUES
(1, 1, 'Category 1', 0),
(2, 1, 'Category 2', 1),
(3, 1, 'Category 3', 1),
(4, 1, 'Category 4', 0),
(5, 1, 'Category 5', 2),
(6, 1, 'Category 6', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int NOT NULL,
  `name` varchar(111) NOT NULL,
  `price` int NOT NULL,
  `category` int NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` int NOT NULL,
  `img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `price`, `category`, `description`, `status`, `img`) VALUES
(1, 'Good 1', 100, 1, 'Описание товара 1', 1, 'product_1001.jpg'),
(2, 'Good 2', 120, 2, 'Описание товара 2', 1, 'product_1002.jpg'),
(3, 'Good 3', 48, 2, 'Описание товара 3', 1, 'product_1003.jpg'),
(4, 'Good 4', 100500, 2, 'Описание товара 4', 1, 'product_1004.jpg'),
(5, 'Good 5', 2001, 3, 'Описание товара 5', 4, 'product_1005.jpg'),
(6, 'Good 6', 1020, 4, 'Описание товара 6', 1, 'product_1006.jpg'),
(7, 'Good 7', 1, 4, 'Описание товара 7', 1, 'product_1007.jpg'),
(8, 'Good 8', 800, 5, 'Описание товара 8', 1, 'product_1008.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`) VALUES
(1, 'Главная'),
(2, 'О Магазине'),
(3, 'Каталог');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `login` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` int NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `login`, `password`, `role`, `datetime`) VALUES
(27, 'aaNmae', 'aa@aa.a', '13124235346', 'aa', '$2y$10$IkhPG6S41xVyiAEP4ObZCemj81jVhgkF4hhVcQ1.mdMGvsE3.WLZ2', 0, '2021-03-24 13:58:01'),
(28, 'aaNmae', 'aa@aa.aa', '131242353461', 'aaa', '$2y$10$k51v2oW4BBfJ64Jf47DgO.TyQ7CSZJuqopakda/cIYe2tcXSxEqRy', 0, '2021-03-24 13:59:10'),
(29, 'ssname', 'ss@ss.s', '79869675745', 'ss', '$2y$10$GK6P5HtzcN1FqbF4ny.QVuOB0TwmXoXBf.CRCyFxOeBkM7dafj3m6', 0, '2021-03-24 14:02:15'),
(30, 'vvname', 'vv@v.v', '34567890', 'vv', '$2y$10$FpngshoqEJdBtnHAqkNkw.HzQ8F3./FvfR9lasrkbWCO91GUc6fIC', 0, '2021-03-24 14:06:39'),
(31, 'vvname', 'vv@v.vv', '345678905', 'vvv', '$2y$10$RqTwzfNGP9oTdrUVQ4lRc.e84Ddwbcw6wwJTK41Iub89NzJRJtS.6', 0, '2021-03-24 14:12:04'),
(32, 'xxn', 'xx@x.x', '123143124', 'xx', '$2y$10$Oar.QDmhtQfd2hHTgHQCeO8o5NVtW4qHuoVkwXTN9U4/CBjZbbbOS', 0, '2021-03-24 14:20:18'),
(33, 'xxn', 'xx@x.xx', '123143124435', 'xxx', '$2y$10$vgbBSuHc9eSZXEXHKIvk..RD0y3IPjhEXWYIdrICr7RHCpqc9IiSK', 0, '2021-03-24 14:36:46'),
(34, 'ppName', 'pp@pp.p', '254678098', 'ppp', '$2y$10$oNRfNbaaNXeXbZG4n37RWuHIGrRCZAWOy1JtRWm2CpdGMBfDlTGaS', 0, '2021-03-24 14:38:59'),
(35, 'qq', 'qq@qq.q', '32526534', 'qq', '$2y$10$vYHQt.vTGhEzi9AWmsm/Qe03rKcBPudJCGS6wiKAmj5lXtsmVCwnu', 0, '2021-03-25 14:53:36');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_goods_id_fk` (`product_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
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
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_goods_id_fk` FOREIGN KEY (`product_id`) REFERENCES `goods` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
