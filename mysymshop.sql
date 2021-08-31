-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 30 2021 г., 18:02
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mysymshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210829131500', '2021-08-29 16:15:58', 114),
('DoctrineMigrations\\Version20210829131840', '2021-08-29 16:18:49', 628),
('DoctrineMigrations\\Version20210829134720', '2021-08-29 16:52:54', 1566),
('DoctrineMigrations\\Version20210830132807', '2021-08-30 16:28:15', 1883),
('DoctrineMigrations\\Version20210830142320', '2021-08-30 17:23:30', 398);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id_id` int(11) NOT NULL,
  `date_order` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders_products`
--

CREATE TABLE `orders_products` (
  `id` int(11) NOT NULL,
  `product_id_id` int(11) NOT NULL,
  `order_id_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `processor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_chipset` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_ram` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `videocard` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `processor`, `country`, `mother_chipset`, `amount_ram`, `videocard`) VALUES
(9, 'SkyTech Gaming', 'Start your journey with SkyTech Gaming latest Shiva gaming desktop computer. With the 11th generation of Intel Core i7-11700F processor, 16GB fast 3200MHz memory , 1TD storage with lightning fast load time, and NVIDIA GeForce RTX 3060 graphics card, you will enjoy immersive, seamless gaming experience with highly realistic visuals. The 240mm AIO liquid cooler lower your PC temperture in a more efficient and quiter way than air.', 40000, 'Intel Core i7-11700F', 'USA', 'mother_chipset 1', '16GB Memory', 'GeForce RTX 3060 12G'),
(10, 'Lenovo - Legion Tower 7i Gaming Desktop', 'Engineered out of a passion for savage power and unmatched speed, the Lenovo™ Legion Tower 7i delivers overclocked performance, available with an Intel® Core™ i7-10700K processor, and NVIDIA® GeForce RTX™ 3060 graphics cards for blazing-fast frame rates at over 4K resolution. Smashing through ceilings in a robust 34 L chassis, accented by over 16 million colors via an ARGB lighting system with transparent side panel.', 60000, 'Intel Core i7-10700K', 'Germany', 'mother_chipset3', '16GB Memory', 'NVIDIA GeForce RTX 3060'),
(11, 'Lenovo - Legion Tower 5i Gaming Desktop', 'Engineered out of a passion for savage power and unmatched speed, the Lenovo™ Legion Tower 5i delivers mind-blowing performance that combines 11th Generation Intel® Core™ processors and top-of-the-line NVIDIA® GeForce® graphics cards for blazing-fast frame rates at up to 4K resolution. Pushing far beyond the upper bounds of smaller rig configurations while keeping things cool and whisper quiet, the Legion Tower 5i is a marvel of build and design, accentuated by its illuminated blue LED logo and lighting, as well a transparent side panel that can properly showcase your internals.', 30000, 'Intel Core i5-11400', 'Canada', 'mother_chipset2', '8GB Memory', 'NVIDIA GeForce GTX 1660 Super');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E52FFDEEB171EB6C` (`customer_id_id`);

--
-- Индексы таблицы `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_749C879CFCDAEAAA` (`order_id_id`),
  ADD KEY `IDX_749C879CDE18E50B` (`product_id_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_E52FFDEEB171EB6C` FOREIGN KEY (`customer_id_id`) REFERENCES `clients` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `FK_749C879CDE18E50B` FOREIGN KEY (`product_id_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FK_749C879CFCDAEAAA` FOREIGN KEY (`order_id_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
