-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2020 at 02:53 AM
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
  `name` varchar(140) DEFAULT NULL,
  `num_enc` int(5) NOT NULL,
  `cover` varchar(350) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `last_modified` datetime NOT NULL DEFAULT current_timestamp(),
  `likes` int(255) UNSIGNED NOT NULL DEFAULT 0,
  `creator_id` int(20) UNSIGNED DEFAULT NULL,
  `enc_1` varchar(450) DEFAULT NULL,
  `enc_2` varchar(450) DEFAULT NULL,
  `enc_3` varchar(450) DEFAULT NULL,
  `enc_4` varchar(450) DEFAULT NULL,
  `enc_5` varchar(450) DEFAULT NULL,
  `enc_6` varchar(450) DEFAULT NULL,
  `enc_7` varchar(450) DEFAULT NULL,
  `enc_8` varchar(450) DEFAULT NULL,
  `enc_9` varchar(450) DEFAULT NULL,
  `enc_10` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `encounter_types`
--

INSERT INTO `encounter_types` (`id`, `name`, `num_enc`, `cover`, `date_created`, `last_modified`, `likes`, `creator_id`, `enc_1`, `enc_2`, `enc_3`, `enc_4`, `enc_5`, `enc_6`, `enc_7`, `enc_8`, `enc_9`, `enc_10`) VALUES
(3, 'Desert', 7, 'https://picsum.photos/seed/picsum/200/300.jpg', '2020-04-30 00:00:00', '2020-04-30 00:00:00', 3, 2, 'A carved stone pillar is poking out of the sand dunes. The markings on the pillar are not in the local language.', 'A sandstorm forces the party to take shelter, they hear voices screaming in the wind.', 'The party comes across a group of nomads. They are bandits but offer the party their hospitality for three days, at which point they will decide how best to rob the party.', 'Sand clouds begin to resolve to a wind rigged skiff, then to a group of elves in pursuit.', 'The party finds a construction made of junk: a small citadel, home to friendly scavengers, who offer to aid the players, and provide some hospitality. Should they accept it, a sandstorm occurs, and the citadel is attacked by crazy raiders on horses. A lovely day.', 'The party is greeted by camel merchants. The animals are docile and follow simple orders, costing 50 gold each.', 'A hungry lioness can be seen peeking over the top of the next sand dune. The rest of her pride is lying further down, in wait, ready to sprint around to encircle the party and cut off points of escape.', '', '', ''),
(8, 'Town', 10, 'https://picsum.photos/seed/picsum/200/300.jpg', '2020-04-30 00:00:00', '2020-04-30 06:26:15', 1, 2, 'The bakery is on fire!!', 'The town crier has been murdered!', 'Rats have taken over the town hall. But they\'re, like, sentient rat politicians...', 'Help! Planar rift!', 'A quiet day in [townname].', 'You find 2 gold in the gutter.', 'There\'s a sale on tunics!', 'A festival to the pagan god of looms.', 'Issekai hero appears.', 'Terrasque.'),
(21, 'City', 6, 'https://picsum.photos/seed/picsum/750/200.jpg', '2020-05-08 00:00:00', '2020-05-08 19:59:26', 0, 14, 'A charlatan offers to give a party member some fancy jewelry to advertise their business. Little did they know this jewelry has a scrying enchantment and will be used to see where the party is staying and how well defended, they are and rob them that night.', 'You see an older man yelling at his apprentice for making some mistake. The apprentice seems near tears because he’s trying to explain himself but can’t get a word in edgewise.', 'A group of miners are protesting outside of a noble’s estate over poor working conditions', 'You come across 4 old men sitting and playing cards. If you want to join, they let you, but because this is what they do with their lives, they are very good.', 'A street performer is making music, hoping that people will pay him. If he’s very good, there’s a large crowd. If he’s bad, people walk by, averting their eyes. If the party is musical, he’s happy to perform together and split the take. He may not be honest about the split, though.', 'A voice calls out from a darkened alleyway, it sounds in distress, but is quickly muffled.', NULL, NULL, NULL, NULL),
(22, 'Inventions Where Safety Was An Afterthought', 10, 'https://picsum.photos/seed/picsum/750/200.jpg', '2020-05-08 00:00:00', '2020-05-08 20:05:20', 0, 14, 'Anti-thief Backpack Of \'splosion: Anyone taking anything out of the backpack must make a DC15 sleight of hand check. If failed the backpack and all its contents explode in a 20\' radius 10d6 fireball. The backpack confers no fire protection to the wearer.', 'Gimble’s Fabulous Spring. A high-tension spring device contained in a compacted platform. Can be activated to provide lift, boost a jump, or even to separate heavy objects, however, should the housing be damaged, the energy released by the uncoiling spring can prove spectacularly lethal. Some less scrupulous gnomes have been known to intentionally compromise Gimble’s Springs to create traps.', 'Pimm’s Cup: A drinking vessel of average appearance. Through a series of mechanical switches can be used to mix in liquid and powdered additives contained in the outer shell in careful proportion. Originally intended as a layman-friendly potion mixing device, the cup has also seen use in cocktail crafting and poisoning enemies.', 'Det Cord: Gunpowder infused string. Nothing could possibly go wrong!', 'Emergency Quiver: Opening the quiver launches all the arrows forth at once. Make sure you don’t get it confused with your real quiver.', 'Slightly Larger Torch: This torch provides bright light in a 30ft radius, and dim light for an additional 30ft. However, this added brightness comes from the fact the entire torch is on fire, including the handle. Take 1 fire damage per turn while holding this object.', 'Explosive Bow and Arrow: These arrows detonate on medium-high velocity impact. Beware butterfingers who drop the quiver.', 'The Magical Alarm Clock: Casts a random spell that you, or someone close, knows to wake you up at the designated time. There’s nothing like waking up to a fireball in your travel jammies.', 'Restraining Foam: Everything in a large radius suffers the effect of an entangle and web spell, each with a spell save DC of 16 as the area becomes heavily obscured by a froth that hardens almost instantly into magical foam. Must be manually triggered (no throwing).', 'A pocket watch with a multitude of faces and dials, each tracking the precise time in a different plane. Unfortunately, it is powered by an incredibly tiny rift between our plane and the abyss. If you hold it to your ear you can hear faint whispers of the chaos. If it is ever dropped or left unattended for more than 1 hour, it spawns 1d4 Imps who torment you and play keep away with the watch.'),
(23, 'Gargantuan Creatures', 3, 'https://picsum.photos/seed/picsum/750/200.jpg', '2020-05-09 00:00:00', '2020-05-09 00:01:23', 0, 18, 'Y’uum, The Evergrowing – This massive creature is a mile-long collection of spores and mold that travels slowly across the landscape. Food and plantlife instantly wilt and go bad when Y’uum is near. ', 'Nimir, Demon Lord of the Ruinous Oblivion – A massive, nearly invisible figure draped in long, disgusting cloth. Nimir oversees the creation of wraiths.', 'Shuggdus – The gargantuan, monstrous-looking, water-based creature. They have powerful hearing, especially underwater. ', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(6, 'merlin', '$2y$10$uEBbNSbdUrg6zfDs6fUlIOWxmGqDBq8rolGV5fGb86cfl3u5jmmfW', 'admin@knights.com', 'admin'),
(8, 'percival', '$2y$10$udxmct16Jc/iqeJNVvbZG.SE0W1fk2x2uklMMC8yUK4/hlTXZ.MXm', 'beastmode@knights.com', 'user'),
(9, 'sir_robin', '$2y$10$ZPXMqswdDGq.YBpYBEwqzeYjh0.uEYrLLYmv6lmlQgeijKJFqod1W', 'the_brave@knights.com', 'user'),
(12, 'bedivere', '$2y$10$4os095EP6SAGS9tXtHFN6uMxapSfUYIlPMacKxtiK.FWvsIiBJD2u', 'science@knights.com', 'user'),
(14, 'lakelady', '$2y$10$N7.MmV7ve5TZWEcWtXzU0OUtUHTZ5NuSG8lZZkloYL.6Ftyu8pl9y', 'waterytart@lake.com', 'admin'),
(15, 'gawayn', '$2y$10$gGHZYVgJo8CcA.6lqNG8n.M4xyUFa79YOUKrmU0TEzf2YlMMnTQ.y', 'sheildboy@knights.com', 'user'),
(18, 'lancelot', '$2y$10$KwjWSBBfcArveGVutvJFFeluff5TTjAizl3T10tJELeAZCVuDy8xC', 'lance@knights.com', 'user');

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
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
