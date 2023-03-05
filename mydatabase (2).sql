-- phpMyAdmin SQL Dump
-- version 5.1.1deb3+bionic1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-05-26 22:23:10
-- 服务器版本： 8.0.28
-- PHP 版本： 7.2.24-0ubuntu0.18.04.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `mydatabase`
--

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE `cart` (
  `order` int NOT NULL,
  `product_id` int NOT NULL,
  `purchased_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `payment` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `cart`
--

INSERT INTO `cart` (`order`, `product_id`, `purchased_at`, `user_id`, `payment`) VALUES
(20, 5, '2022-05-25 10:46:57', 21, 'no');

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` varchar(255) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `product_id`, `user_id`, `comment`, `user_name`, `user_email`, `created_at`) VALUES
(4, 5, 21, '                        jiode  o i like it it was amazing', '123456', 'xiaoyu.ren@uq.net.au', '2022-05-24 08:18:03'),
(5, 5, 21, 'so amazing !! fantastic greeting', '123456', 'xiaoyu.ren@uq.net.au', '2022-05-24 08:35:03'),
(6, 5, 21, '   I love this class！！！！！！！！！！！！！！！！！！   ', '123456', 'xiaoyu.ren@uq.net.au', '2022-05-24 09:28:39'),
(7, 5, 21, '                        ddds', '123456', 'xiaoyu.ren@uq.net.au', '2022-05-24 13:47:39'),
(8, 5, 21, '                        ddd', '123456', 'xiaoyu.ren@uq.net.au', '2022-05-24 14:10:38');

-- --------------------------------------------------------

--
-- 表的结构 `hate`
--

CREATE TABLE `hate` (
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `productid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 表的结构 `liked`
--

CREATE TABLE `liked` (
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `productid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `liked`
--

INSERT INTO `liked` (`id`, `userid`, `productid`) VALUES
(54, 21, 6);

-- --------------------------------------------------------

--
-- 表的结构 `payment`
--

CREATE TABLE `payment` (
  `payment_id` int NOT NULL,
  `payment_status` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `payer_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `txn_id` int NOT NULL,
  `payment_gross` float NOT NULL,
  `currency_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `productName` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `UserName` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `imagePath` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `productPath` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `favourite` int NOT NULL DEFAULT '0',
  `dislike` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`id`, `productName`, `UserName`, `description`, `imagePath`, `productPath`, `favourite`, `dislike`, `created_at`, `price`) VALUES
(5, 'INFS7203 data mining', '123456', '                     fefefwefewd dfewwf f fewf feed dfewgh hthw fef fef grg fe  f fefwe\r\nfef ef fefewde  fefwfef                    ', '/var/www/htdocs/project/uploads/scene.jpg', '/var/www/htdocs/project/uploads/test42.mp4', 5, 2, '2022-05-24 01:24:03', '22'),
(6, 'Deco1234  web design', '123456', '                 ddthsid jdis  djeoj of jfe fjeoj fof  oefjofj o efoj opfepf  eff fe                 ', '/var/www/htdocs/project/uploads/cell(1).png', '/var/www/htdocs/project/uploads/test45.mp4', 1, 0, '2022-05-25 02:57:02', '123'),
(7, 'Web security 1234 how to become a hacker', '1234567', 'This jicji  jei can helo you jije  ', '/var/www/htdocs/project/uploads/cloud3.png', '/var/www/htdocs/project/uploads/playball7.mp4', 0, 0, '2022-05-25 12:11:51', '234');

-- --------------------------------------------------------

--
-- 表的结构 `tutorials`
--

CREATE TABLE `tutorials` (
  `UserName` varchar(250) NOT NULL,
  `TutorialPath` varchar(250) NOT NULL,
  `TutorialName` varchar(250) NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `tutorials`
--

INSERT INTO `tutorials` (`UserName`, `TutorialPath`, `TutorialName`, `id`) VALUES
('123456', '/var/www/htdocs/project/uploads/test3.mp4', '', 11),
('123456', '/var/www/htdocs/project/uploads/test4.mp4', '', 12),
('123456', '/var/www/htdocs/project/uploads/test31.mp4', '', 13),
('123456', '/var/www/htdocs/project/uploads/test41.mp4', '', 14);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `verification_key` varchar(250) NOT NULL,
  `is_email_verified` enum('no','yes') NOT NULL,
  `avatar_path` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `avatar_name` text,
  `hash_key` varchar(200) DEFAULT NULL,
  `hash_expiry` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `verification_key`, `is_email_verified`, `avatar_path`, `avatar_name`, `hash_key`, `hash_expiry`) VALUES
(21, '123456', 'xiaoyu.ren@uq.net.au', '$2y$10$JQEPFUAfYQ4CriZeDQLAzuV5/Qyf8o4tEiYcQQqqeQ3nEAi4QGhsW', '3a4c45b2b9fdd2f35caaf9ab131108ea', 'yes', '/var/www/htdocs/project/uploads/test3.jpg', 'test3.jpg', 'b923c6b3350b5df1a0691c7878b40bf2d9f90113f5253ab8517dd0ef3c0c4316', '2022-05-22 04:08'),
(24, '1234567', '806337853@qq.com', '$2y$10$z8tuF4CihXDDzT2I5Iaj6OzawMVTSZZExAGAm2oeHEmQyQJCnf1gu', '811a8a6e3359d892c1a795f34230ea54', 'yes', '/var/www/htdocs/project/uploads/cloud2.png', 'cloud2.png', NULL, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`order`) USING BTREE,
  ADD KEY `cart_item_fk` (`product_id`),
  ADD KEY `cart_buyer_fk` (`user_id`);

--
-- 表的索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_product_fk` (`product_id`);

--
-- 表的索引 `hate`
--
ALTER TABLE `hate`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `liked`
--
ALTER TABLE `liked`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk` (`UserName`);

--
-- 表的索引 `tutorials`
--
ALTER TABLE `tutorials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_upload` (`UserName`) USING BTREE;

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_upload` (`name`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `hate`
--
ALTER TABLE `hate`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- 使用表AUTO_INCREMENT `liked`
--
ALTER TABLE `liked`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- 使用表AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `tutorials`
--
ALTER TABLE `tutorials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- 限制导出的表
--

--
-- 限制表 `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_buyer_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_item_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_product_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`UserName`) REFERENCES `users` (`name`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- 限制表 `tutorials`
--
ALTER TABLE `tutorials`
  ADD CONSTRAINT `FK_user_upload` FOREIGN KEY (`UserName`) REFERENCES `users` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
