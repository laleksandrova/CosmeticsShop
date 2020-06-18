-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18 юни 2020 в 16:34
-- Версия на сървъра: 10.4.11-MariaDB
-- PHP Version: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cosmeticsshop`
--

-- --------------------------------------------------------

--
-- Структура на таблица `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL COMMENT 'ПК',
  `product_type_id` int(10) UNSIGNED NOT NULL COMMENT 'ВК към категория',
  `name` varchar(64) NOT NULL COMMENT 'Име на продукта',
  `type` varchar(32) DEFAULT NULL COMMENT 'Вид',
  `price` int(4) DEFAULT NULL COMMENT 'Цена - само в цели числа',
  `info` text DEFAULT NULL COMMENT 'Описание на продукта',
  `picture` varchar(32) DEFAULT NULL COMMENT 'относителен адрес до снимка',
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Дата на регистрация'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Продукти';

--
-- Схема на данните от таблица `products`
--

INSERT INTO `products` (`product_id`, `product_type_id`, `name`, `type`, `price`, `info`, `picture`, `registration_date`) VALUES
(1, 1, 'Тоалетна вода с боровинка', 'Ароматни серии', 15, 'Придава свеж плодов мирис, освежаващ и ободряващ.', 'as1.jpg', '2020-06-14 15:41:43'),
(2, 2, 'Арганово масло', 'Продукти за коса', 18, 'Подхранва и възстановява изтощената коса.', 'pk1.jpg', '2020-06-14 15:41:44'),
(3, 3, 'Вечерен крем', 'Продукти за лице', 40, 'Хидратиращ крем за употреба през нощта.', 'pl1.jpg', '2020-06-14 15:41:43'),
(4, 4, 'Дезинфектант', 'Продукти за ръце', 7, 'Дезинфекцира ръцете и е в удобна за носене форма.', 'pr1.jpg', '2020-06-14 15:41:44'),
(5, 5, 'Сет душ-гелове', 'Продукти за тяло', 26, 'Душ-гелове с екстракт от алое в различни разфасовки.', 'pt1.jpg', '2020-06-14 15:41:43'),
(6, 1, 'Парфюм от момина сълза', 'Ароматни серии', 25, 'Придава мирис на свежи пролетни цветя.', 'as2.jpg', '2020-06-14 15:41:44'),
(7, 2, 'Кокосово масло', 'Продукти за коса', 4, 'Укрепва косъма и е натурална топлинна защита.', 'pk2.jpg', '2020-06-14 15:41:43'),
(8, 3, 'Ежедневен крем', 'Продукти за лице', 7, 'Хидратиращ крем за употреба през деня.', 'pl2.jpg', '2020-06-14 15:41:43'),
(9, 4, 'Крем от плодове', 'Продукти за ръце', 4, 'Кремът за ръце е лек, попива бързо и има плодов мирис.', 'pr2.jpg', '2020-06-14 15:41:43'),
(10, 5, 'Сет за баня', 'Продукти за тяло', 28, 'Сетът съдържа душ-гелове, сапуни и ароматни масла.', 'pt2.jpg', '2020-06-14 15:41:43'),
(11, 1, 'Тоалетна вода с малина', 'Ароматни серии', 15, 'Освежаващ мирис, пробуждащ сетивата.', 'as3.jpg', '2020-06-14 15:41:43'),
(12, 2, 'Шампоан', 'Продукти за коса', 12, 'Възстановяващ био шампоан.', 'pk3.jpg', '2020-06-14 15:41:43'),
(13, 3, '24-часов крем', 'Продукти за лице', 8, 'Крем с екстракт от краставичка', 'pl3.jpg', '2020-06-14 15:41:43'),
(14, 4, 'Био крем', 'Продукти за ръце', 7, 'Крем за ръце от изцяло натурални продукти.', 'pr3.jpg', '2020-06-14 15:41:43'),
(15, 5, 'Сет пудри', 'Продукти за тяло', 10, 'Сетът може да се състои от 3, 4 или 5 пудри по ваш избор.', 'pt3.jpg', '2020-06-14 15:41:43');

-- --------------------------------------------------------

--
-- Структура на таблица `product_types`
--

CREATE TABLE `product_types` (
  `product_type_id` int(10) UNSIGNED NOT NULL COMMENT 'ПК',
  `category` varchar(32) NOT NULL COMMENT 'категория'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Видове продукти';

--
-- Схема на данните от таблица `product_types`
--

INSERT INTO `product_types` (`product_type_id`, `category`) VALUES
(1, 'Ароматни серии'),
(2, 'Продукти за коса'),
(3, 'Продукти за лице'),
(4, 'Продукти за ръце'),
(5, 'Продукти за тяло');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `users_id` int(10) UNSIGNED NOT NULL COMMENT 'ПК',
  `username` varchar(16) NOT NULL COMMENT 'Потребителско име',
  `users_type` tinyint(1) NOT NULL COMMENT 'Тип потребител',
  `pass` varchar(16) NOT NULL COMMENT 'Парола',
  `name` varchar(128) NOT NULL COMMENT 'Име'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`users_id`, `username`, `users_type`, `pass`, `name`) VALUES
(1, 'admin', 1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_type_id` (`product_type_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ПК', AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `product_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ПК', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ПК', AUTO_INCREMENT=2;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`product_type_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
