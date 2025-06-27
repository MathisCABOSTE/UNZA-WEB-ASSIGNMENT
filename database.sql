-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 26 juin 2025 à 17:26
-- Version du serveur : 8.0.42-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Providence`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`user_id`) VALUES
('admin');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `article_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `likes` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`article_id`, `title`, `content`, `author`, `datetime`, `likes`) VALUES
(1, 'test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur imperdiet mauris orci, vel elementum nunc mattis tempor. Maecenas quis nulla quis orci rutrum vehicula sit amet sed est. Praesent libero tellus, faucibus ac tellus sit amet, interdum pulvinar risus. Aliquam erat volutpat. Nullam ullamcorper pretium eros vel feugiat. Pellentesque id diam eleifend, iaculis odio at, aliquet quam. Fusce euismod nunc id risus congue, ac iaculis risus tempor. Proin purus lacus, gravida a nisl quis, faucibus placerat velit. Morbi luctus viverra viverra. Morbi et leo viverra, sodales lacus vitae, mollis libero. Donec eget neque tellus. Nulla interdum elit et blandit tempus. Nunc nec nulla ornare diam gravida lacinia. Nunc pharetra tellus nisi, congue sollicitudin neque pretium at.\r\n\r\nNullam pellentesque luctus velit sit amet semper. Integer convallis vestibulum feugiat. Curabitur sit amet imperdiet nulla, vitae finibus mi. Nulla tempus eu lacus quis gravida. Nam a lacinia mauris. Sed eu tellus augue. Integer nec urna turpis. Praesent vel elementum turpis. Nullam at velit vel nisi ornare vestibulum porta placerat lectus. Donec et est et massa volutpat bibendum. Sed pellentesque convallis ante non vestibulum. Aliquam erat volutpat. Aliquam erat volutpat. Vivamus eget molestie augue. Aenean vel nulla eleifend, feugiat dui non, sollicitudin lacus.\r\n\r\nPraesent a metus laoreet, ultrices turpis sed, tempor orci. In hac habitasse platea dictumst. Sed maximus eget est sed tincidunt. Etiam quis porta tellus. Fusce vulputate vel enim quis aliquet. Vestibulum quis ligula at metus interdum pretium. Duis sit amet hendrerit metus. Mauris justo erat, tincidunt at eros sagittis, sagittis laoreet magna. Duis non leo eu augue tincidunt dignissim id a justo. Aenean tempus viverra massa, ac consectetur massa feugiat in. Aenean et sapien diam. Morbi efficitur sem sit amet sagittis euismod. Mauris posuere volutpat ipsum, nec blandit tellus varius ut. Aenean lobortis sem non dolor euismod, non lacinia tortor sagittis.\r\n\r\nQuisque porta tellus in tempor tempor. Donec a nibh consequat, maximus velit ut, eleifend elit. Ut pharetra massa eu diam aliquam, quis tincidunt diam feugiat. Donec accumsan semper mauris et ullamcorper. Cras ac mollis metus. Nunc ut venenatis elit, sed tristique urna. Nunc cursus, nisi sed aliquam sollicitudin, arcu eros sodales nibh, eu semper dolor dolor a nisi.\r\n\r\nSuspendisse gravida enim vel posuere convallis. Aenean sodales lorem sit amet blandit finibus. Donec viverra venenatis urna vitae porttitor. Aliquam leo metus, ultrices vel commodo sit amet, vehicula quis lorem. Quisque rutrum pellentesque ipsum. Sed pharetra enim in augue lobortis hendrerit. Vivamus non volutpat sapien. Nulla vel leo sit amet orci consequat ultricies. Nunc mattis metus ut tortor finibus bibendum in quis lacus.', 'a', '2025-06-21 19:02:27', 1),
(2, 'test 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur imperdiet mauris orci, vel elementum nunc mattis tempor. Maecenas quis nulla quis orci rutrum vehicula sit amet sed est. Praesent libero tellus, faucibus ac tellus sit amet, interdum pulvinar risus. Aliquam erat volutpat. Nullam ullamcorper pretium eros vel feugiat. Pellentesque id diam eleifend, iaculis odio at, aliquet quam. Fusce euismod nunc id risus congue, ac iaculis risus tempor. Proin purus lacus, gravida a nisl quis, faucibus placerat velit. Morbi luctus viverra viverra. Morbi et leo viverra, sodales lacus vitae, mollis libero. Donec eget neque tellus. Nulla interdum elit et blandit tempus. Nunc nec nulla ornare diam gravida lacinia. Nunc pharetra tellus nisi, congue sollicitudin neque pretium at.\r\n\r\nNullam pellentesque luctus velit sit amet semper. Integer convallis vestibulum feugiat. Curabitur sit amet imperdiet nulla, vitae finibus mi. Nulla tempus eu lacus quis gravida. Nam a lacinia mauris. Sed eu tellus augue. Integer nec urna turpis. Praesent vel elementum turpis. Nullam at velit vel nisi ornare vestibulum porta placerat lectus. Donec et est et massa volutpat bibendum. Sed pellentesque convallis ante non vestibulum. Aliquam erat volutpat. Aliquam erat volutpat. Vivamus eget molestie augue. Aenean vel nulla eleifend, feugiat dui non, sollicitudin lacus.\r\n\r\nPraesent a metus laoreet, ultrices turpis sed, tempor orci. In hac habitasse platea dictumst. Sed maximus eget est sed tincidunt. Etiam quis porta tellus. Fusce vulputate vel enim quis aliquet. Vestibulum quis ligula at metus interdum pretium. Duis sit amet hendrerit metus. Mauris justo erat, tincidunt at eros sagittis, sagittis laoreet magna. Duis non leo eu augue tincidunt dignissim id a justo. Aenean tempus viverra massa, ac consectetur massa feugiat in. Aenean et sapien diam. Morbi efficitur sem sit amet sagittis euismod. Mauris posuere volutpat ipsum, nec blandit tellus varius ut. Aenean lobortis sem non dolor euismod, non lacinia tortor sagittis.\r\n\r\nQuisque porta tellus in tempor tempor. Donec a nibh consequat, maximus velit ut, eleifend elit. Ut pharetra massa eu diam aliquam, quis tincidunt diam feugiat. Donec accumsan semper mauris et ullamcorper. Cras ac mollis metus. Nunc ut venenatis elit, sed tristique urna. Nunc cursus, nisi sed aliquam sollicitudin, arcu eros sodales nibh, eu semper dolor dolor a nisi.\r\n\r\nSuspendisse gravida enim vel posuere convallis. Aenean sodales lorem sit amet blandit finibus. Donec viverra venenatis urna vitae porttitor. Aliquam leo metus, ultrices vel commodo sit amet, vehicula quis lorem. Quisque rutrum pellentesque ipsum. Sed pharetra enim in augue lobortis hendrerit. Vivamus non volutpat sapien. Nulla vel leo sit amet orci consequat ultricies. Nunc mattis metus ut tortor finibus bibendum in quis lacus.', 'a', '2025-06-21 19:03:01', 0),
(3, 'Article for testing', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur imperdiet mauris orci, vel elementum nunc mattis tempor. Maecenas quis nulla quis orci rutrum vehicula sit amet sed est. Praesent libero tellus, faucibus ac tellus sit amet, interdum pulvinar risus. Aliquam erat volutpat. Nullam ullamcorper pretium eros vel feugiat. Pellentesque id diam eleifend, iaculis odio at, aliquet quam. Fusce euismod nunc id risus congue, ac iaculis risus tempor. Proin purus lacus, gravida a nisl quis, faucibus placerat velit. Morbi luctus viverra viverra. Morbi et leo viverra, sodales lacus vitae, mollis libero. Donec eget neque tellus. Nulla interdum elit et blandit tempus. Nunc nec nulla ornare diam gravida lacinia. Nunc pharetra tellus nisi, congue sollicitudin neque pretium at.\r\n\r\nNullam pellentesque luctus velit sit amet semper. Integer convallis vestibulum feugiat. Curabitur sit amet imperdiet nulla, vitae finibus mi. Nulla tempus eu lacus quis gravida. Nam a lacinia mauris. Sed eu tellus augue. Integer nec urna turpis. Praesent vel elementum turpis. Nullam at velit vel nisi ornare vestibulum porta placerat lectus. Donec et est et massa volutpat bibendum. Sed pellentesque convallis ante non vestibulum. Aliquam erat volutpat. Aliquam erat volutpat. Vivamus eget molestie augue. Aenean vel nulla eleifend, feugiat dui non, sollicitudin lacus.', 'test', '2025-06-21 20:11:54', 0),
(4, 'Nuclear Power Plant Installations in the European Union', 'Introduction :\r\n\r\nAccording to Article 194(2) of the Treaty on the Functioning of the European Union, each Member State independently decides on its own energy mix and use of nuclear energy. However, there are common rules and standards on nuclear energy, the basis for which is the Treaty on the European Atomic Energy Community (Euratom Treaty) signed in 1957. All current EU Member States are party to it and it has remained largely unchanged throughout the years. Common EU rules also stem from the Nuclear Safety Directive and Directive for the Management of Radioactive Waste and Spent Fuel.\r\n\r\nCurrently, 12 out of 27 EU Member States (Belgium, Bulgaria, Czechia, Finland, France, Hungary, Netherlands, Romania, Slovakia, Slovenia, Spain and Sweden) host nuclear power plants on their territory. Austria, Croatia, Cyprus, Denmark, Estonia, Ireland, Greece, Italy, Latvia, Lithuania, Luxembourg, Malta, Poland and Portugal do not produce nuclear power. Just recently, Germany\r\ndecided to completely phase out nuclear energy production. In 2021, nuclear energy made up 13 % of Europe\'s energy mix and accounted for 25 % of all electricity produced.\r\n\r\nThe debate on nuclear energy in the EU focuses on both opportunities and challenges. Small modular reactors (SMRs) are often seen as offering potential solutions to energy supply issues and are likely to become a commercially viable nuclear product by the early 2030s. SMRs could be used for district heating, desalination, heat processing for energy-intensive industries and hydrogen production. One of the main challenges is dependency on Russian nuclear technology, uranium and fuel supplies. Although many countries are trying to diversify their fuel supply, recent research estimates that, in some cases, the dependency is unlikely to decrease. Another important challenge is high-level nuclear waste and spent fuel management. The solution appears to be deep geological disposals that should open in the EU between 2024 and 2035.\r\n\r\nDifferent groups of countries – branded as either the \'nuclear alliance\' or the \'friends of renewables\'– regularly argue about the role of low carbon energy sources (produced from nuclear) in the green transition and, consequently, in various pieces of energy and climate legislation. Those discussions are likely to continue as new legislative proposals emerge. \r\n\r\n\r\n\r\nNuclear Energy :\r\n\r\nNuclear policy has been present from the very beginning of the European Union. The six founding nations signed the Treaty on the European Atomic Energy Community (Euratom Treaty) in 1957,\r\nwhich is one of the three founding treaties establishing the EU. Over the years, the Euratom Treaty has remained largely unchanged and all current EU Member States are party to it. Despite existing common rules and standards on the use of nuclear energy, according to Article 194(2) of the Treaty on the Functioning of the EU each Member State independently decides whether to include nuclear energy in its own energy mix.\r\n\r\nEuratom has the same members as the EU and is governed by the Commission and the Council, but remains an independent body. Its main role is to ensure access to nuclear material and technology, support investment and research, and create conditions for the disposal of nuclear waste and safety of operations. Euratom makes possible strictly regulated movement of nuclear goods, establishes standards for the secure handling of nuclear materials and regulates the supply of the isotopes used in medicines. The main entities implementing the tasks described in the Euratom Treaty are the Euratom Supply Agency (responsible for oversight of the supply of nuclear materials in Member States) and the European Commission (in charge of development of research programmes, inspections of nuclear power plants and non-proliferation of nuclear materials). The EU also assists the Member States in decommissioning old nuclear power plants using cohesion policy funding (two decommissioning programmes approved for 2021-2027 amount to €1 018 million; one is worth €466 million, the other\r\n€552 million). The EU (through Euratom) founded the International Thermonuclear Experimental Reactor (ITER) and contributes the largest share to its financing; ITER is an international energy project that operates the world\'s largest nuclear fusion reactor in Cadarache, France. EPRS recently issued a publication on nuclear fusion.\r\n\r\n...', 'test', '2025-06-21 20:21:55', 4),
(5, 'HTML Color Codes', 'What is a HTML color code?\r\n\r\nA HTML color code is an identifier used to represent a color on the web and within other digital assets. Common color codes are in the forms of: a keyword name, a hexadecimal value, a RGB (red, green, blue) triplet, or a HSL (hue, saturation, lightness) triplet. Different values allow for 16,777,216 potential colors to be chosen.\r\n\r\nFor example, the color red can be identifier using the following formats:\r\n- red (keyword name)\r\n- #ff0000 (hex)\r\n- (255,0,0) (RGB)\r\n- (0, 100%, 50%) (HSL)\r\n\r\nBecause there are so many colors to choose from, tools have been created to make the task of selection much simpler. A color picker allows a user to select a color by clicking on visual range of color to pin-point an exact code. A color chart provides a listing of common colors for quick selection.\r\n\r\n\r\nWhat are HTML color codes used for?\r\n\r\nHTML color codes are used within HTML and CSS to create web design color schemes. They are primarily used by web designers, graphic designers, computer programmers, and digital illustrators. Choosing the correct web colors can be exhausting, but it is a great skill to have, especially for marketing purposes.', 'test', '2025-06-21 20:25:34', 0),
(6, 'Camelot & the Knights of the Round Table', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur imperdiet mauris orci, vel elementum nunc mattis tempor. Maecenas quis nulla quis orci rutrum vehicula sit amet sed est. Praesent libero tellus, faucibus ac tellus sit amet, interdum pulvinar risus. Aliquam erat volutpat. Nullam ullamcorper pretium eros vel feugiat. Pellentesque id diam eleifend, iaculis odio at, aliquet quam. Fusce euismod nunc id risus congue, ac iaculis risus tempor. Proin purus lacus, gravida a nisl quis, faucibus placerat velit. Morbi luctus viverra viverra. Morbi et leo viverra, sodales lacus vitae, mollis libero. Donec eget neque tellus. Nulla interdum elit et blandit tempus. Nunc nec nulla ornare diam gravida lacinia. Nunc pharetra tellus nisi, congue sollicitudin neque pretium at.\r\n\r\nNullam pellentesque luctus velit sit amet semper. Integer convallis vestibulum feugiat. Curabitur sit amet imperdiet nulla, vitae finibus mi. Nulla tempus eu lacus quis gravida. Nam a lacinia mauris. Sed eu tellus augue. Integer nec urna turpis. Praesent vel elementum turpis. Nullam at velit vel nisi ornare vestibulum porta placerat lectus. Donec et est et massa volutpat bibendum. Sed pellentesque convallis ante non vestibulum. Aliquam erat volutpat. Aliquam erat volutpat. Vivamus eget molestie augue. Aenean vel nulla eleifend, feugiat dui non, sollicitudin lacus.\r\n\r\nPraesent a metus laoreet, ultrices turpis sed, tempor orci. In hac habitasse platea dictumst. Sed maximus eget est sed tincidunt. Etiam quis porta tellus. Fusce vulputate vel enim quis aliquet. Vestibulum quis ligula at metus interdum pretium. Duis sit amet hendrerit metus. Mauris justo erat, tincidunt at eros sagittis, sagittis laoreet magna. Duis non leo eu augue tincidunt dignissim id a justo. Aenean tempus viverra massa, ac consectetur massa feugiat in. Aenean et sapien diam. Morbi efficitur sem sit amet sagittis euismod. Mauris posuere volutpat ipsum, nec blandit tellus varius ut. Aenean lobortis sem non dolor euismod, non lacinia tortor sagittis.\r\n\r\nQuisque porta tellus in tempor tempor. Donec a nibh consequat, maximus velit ut, eleifend elit. Ut pharetra massa eu diam aliquam, quis tincidunt diam feugiat. Donec accumsan semper mauris et ullamcorper. Cras ac mollis metus. Nunc ut venenatis elit, sed tristique urna. Nunc cursus, nisi sed aliquam sollicitudin, arcu eros sodales nibh, eu semper dolor dolor a nisi.\r\n\r\nSuspendisse gravida enim vel posuere convallis. Aenean sodales lorem sit amet blandit finibus. Donec viverra venenatis urna vitae porttitor. Aliquam leo metus, ultrices vel commodo sit amet, vehicula quis lorem. Quisque rutrum pellentesque ipsum. Sed pharetra enim in augue lobortis hendrerit. Vivamus non volutpat sapien. Nulla vel leo sit amet orci consequat ultricies. Nunc mattis metus ut tortor finibus bibendum in quis lacus.', 'King_Arthur', '2025-06-22 00:30:53', 0);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `user_id` varchar(50) NOT NULL,
  `article_id` int NOT NULL,
  `like_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`user_id`, `article_id`, `like_date`) VALUES
('a', 1, '2025-06-21 19:04:21'),
('a', 4, '2025-06-21 20:26:33'),
('admin', 4, '2025-06-26 14:19:44'),
('King_Arthur', 4, '2025-06-22 00:33:15'),
('test', 4, '2025-06-21 20:22:09');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `password`, `creation_date`) VALUES
('a', '$2y$10$eLBwcYau50bLk.RyYpWTGu3DWSuH21afmCVIPVve34CpSsPjuWYcO', '2025-06-21 12:18:20'),
('admin', '$2y$10$mULGmtydAGsOn23WrYE4Zujyh3Qy5TVbjZH2mHr4/eG562fgQyoBa', '2025-06-26 13:55:02'),
('King_Arthur', '$2y$10$MpBFjVeL.6nTvYLlSR0o8eruvhfg/ss/BZgANqJ/dGMnvQSsy6LhO', '2025-06-22 00:27:34'),
('test', '$2y$10$e17D1fdySO7Q1M5zw/1HLOn6bIVEHal219UnhChBposoWAq7exWhy', '2025-06-21 20:10:36');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `author` (`author`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`user_id`,`article_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;