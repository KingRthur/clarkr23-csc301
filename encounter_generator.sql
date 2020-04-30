-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2020 at 06:07 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `encounter_generator`
--

-- --------------------------------------------------------

--
-- Table structure for table `encounter_types`
--

CREATE TABLE `encounter_types` (
  `id` int(20) UNSIGNED NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `num_enc` int(5) NOT NULL,
  `cover` varchar(140) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `last_modified` datetime NOT NULL DEFAULT current_timestamp(),
  `likes` int(255) UNSIGNED NOT NULL DEFAULT 0,
  `creator_id` int(20) UNSIGNED DEFAULT NULL,
  `enc_1` varchar(200) DEFAULT NULL,
  `enc_2` varchar(200) DEFAULT NULL,
  `enc_3` varchar(200) DEFAULT NULL,
  `enc_4` varchar(200) DEFAULT NULL,
  `enc_5` varchar(200) DEFAULT NULL,
  `enc_6` varchar(200) DEFAULT NULL,
  `enc_7` varchar(200) DEFAULT NULL,
  `enc_8` varchar(200) DEFAULT NULL,
  `enc_9` varchar(200) DEFAULT NULL,
  `enc_10` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `encounter_types`
--

INSERT INTO `encounter_types` (`id`, `name`, `num_enc`, `cover`, `date_created`, `last_modified`, `likes`, `creator_id`, `enc_1`, `enc_2`, `enc_3`, `enc_4`, `enc_5`, `enc_6`, `enc_7`, `enc_8`, `enc_9`, `enc_10`) VALUES
(1, 'Arctic', 10, '', '2020-04-14 00:00:00', '2020-04-30 00:00:00', 8, 1, 'Encounter one', 'Encounter two', 'Encounter three', 'Encounter four', 'Encounter five', 'Encounter six', 'Encounter seven', 'Encounter eight', 'Encounter nine', 'Encounter ten'),
(3, 'Desert', 10, 'https://picsum.photos/seed/picsum/200/300', '2020-04-30 00:00:00', '2020-04-30 00:00:00', 0, 2, 'encownter one', 'encownter two', 'encownter three', 'encownter four', 'encownter five', '', 'encownter seven', '', '', 'encouwnter 10'),
(4, 'Mountain', 5, 'https://picsum.photos/seed/picsum/200/300', '2020-04-30 00:00:00', '2020-04-30 00:00:00', 0, 2, 'encccc1', 'enccc2', 'enccc5', 'enccccc8', 'enccc 10', NULL, NULL, NULL, NULL, NULL),
(6, 'Nautical', 3, 'https://picsum.photos/seed/picsum/200/300', '2020-04-10 00:00:00', '2020-04-30 05:10:57', 0, 2, 'encone', 'encfour', 'encithinkso', '', '', '', '', '', '', ''),
(8, 'Town', 10, 'https://picsum.photos/seed/picsum/200/300', '2020-04-30 00:00:00', '2020-04-30 06:26:15', 1, 2, 'The bakery is on fire!!', 'The town crier has been murdered!', 'Rats have taken over the town hall. But they\'re, like, sentient rat politicians...', 'Help! Planar rift!', 'A quiet day in [townname].', 'You find 2 gold in the gutter.', 'There\'s a sale on tunics!', 'A festival to the pagan god of looms.', 'Issekai hero appears.', 'Terrasque.'),
(15, 'Science Lab', 1, 'https://picsum.photos/seed/picsum/200/300', '2020-04-30 00:00:00', '2020-04-30 08:01:54', 1, 12, 'Welcome to the Science Team', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Evil Lair', 1, 'https://picsum.photos/seed/picsum/200/300', '2020-04-30 00:00:00', '2020-04-30 08:04:22', 0, 13, 'EVILEVILEVIEL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Sewer', 1, 'https://picsum.photos/seed/picsum/200/300', '2020-04-30 00:00:00', '2020-04-30 09:20:55', 0, 12, 'grosooooosososs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Castle', 3, 'https://picsum.photos/seed/picsum/200/300', '2020-04-30 00:00:00', '2020-04-30 11:23:12', 0, 1, 'Banners!', 'Statues!', 'Balls!', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'kingrthur', '$2y$10$P8LwF4U452lZsuyG1Xeo0uyrIKsaXU.l.F8eYnl85W92V8exj5DcW', 'mail@example.com', 'manager'),
(2, 'gallahad', '0', 'one@knights.com', 'user'),
(3, 'lancelot', '1234', 'therealone@knights.com', 'user'),
(4, 'bors', '12345', 'who@knights.com', 'user'),
(5, 'mordred', '148336528', 'edgeloard6969@knights.com', 'user'),
(6, 'merlin', '0', 'admin@knights.com', 'user'),
(7, 'tristan', '$2y$10$ZIqRhbDFBIUBYt4.CyqIWusp/OJXO1Ke5iPXZqqFR7vlH3d9hBEw2', 'musicboi@knights.com', 'user'),
(8, 'percival', '$2y$10$udxmct16Jc/iqeJNVvbZG.SE0W1fk2x2uklMMC8yUK4/hlTXZ.MXm', 'beastmode@knights.com', 'user'),
(9, 'sir_robin', '$2y$10$ZPXMqswdDGq.YBpYBEwqzeYjh0.uEYrLLYmv6lmlQgeijKJFqod1W', 'the_brave@knights.com', 'user'),
(10, 'gwennnn', '$2y$10$ckJ9TMf8TFzRJF/WafgOpuC9InIY1RUaV964jLSU2TCDpZMQYbpJ6', 'thequeen@knights.com', 'user'),
(12, 'bedivere', '$2y$10$4os095EP6SAGS9tXtHFN6uMxapSfUYIlPMacKxtiK.FWvsIiBJD2u', 'science@knights.com', 'user'),
(13, 'morgana', '$2y$10$FNJ/Yg7JyPmBsGDLqqpH8eJDZBHVIMpl3eZfoFry.BC9ThrJKGnYS', 'evil@knights.com', 'user'),
(14, 'lakelady', '$2y$10$3PVNBf1Xn24da1HX6OWRE.DmRAODJd1i81x9vcAaKCFhPX9TY3DxG', 'waterytart@lake.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `encounter_types`
--
ALTER TABLE `encounter_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `encounter_types`
--
ALTER TABLE `encounter_types`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `encounter_types`
--
ALTER TABLE `encounter_types`
  ADD CONSTRAINT `encounter_types_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
