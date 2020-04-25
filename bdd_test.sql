-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 25 Avril 2020 à 20:56
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_creation` date NOT NULL,
  `auteur` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`ID`, `title`, `content`, `date_creation`, `auteur`) VALUES
(1, 'Tadaaam!', 'Ceci est mon premier article ! ! !', '2020-04-21', 'MICHEL'),
(5, 'Mon deuxiÃƒÂ¨me article!', 'Yes! La page de crÃƒÂ©ation est bientÃƒÂ´t prÃƒÂªte!', '2020-04-21', 'MONMEMBRE'),
(7, 'Voici un autre article', 'Mon article...\r\n', '2020-04-21', ''),
(23, 'Test article', 'Mon article...\r\nCeci est un article valide\r\nCeci est un article valide\r\nCeci est un article valide\r\nCeci est un article valide\r\nCeci est un article valide\r\nCeci est un article valide\r\nCeci est un article valide', '2020-04-21', ''),
(25, 'Un sixieme article', 'Un autre article test, il me permet de vÃƒÂ©rifier si l''affichage sur la page d''accueil se fait correctement.\r\n\r\nDe plus, je peux vÃƒÂ©rifier si la page de crÃƒÂ©ation est bien 100% opÃƒÂ©rationnelle.', '2020-04-21', 'ZAVELL'),
(26, 'SeptiÃƒÂ¨me article', 'Ceci est un article.\r\nCeci est un article.\r\nCeci est un article.\r\nCeci est un article.\r\nCeci est un article.\r\nCeci est un article.', '2020-04-21', 'MICHEL'),
(29, 'Parlons', 'Cet article est un autre article &quot;test&quot;, me permettant de vÃ©rifier encore et toujours si tout fonctionne.', '2020-04-25', 'MICHEL');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_article` int(11) NOT NULL,
  `Auteur` varchar(255) NOT NULL,
  `Content` text NOT NULL,
  `date_commentaire` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`ID`, `ID_article`, `Auteur`, `Content`, `date_commentaire`) VALUES
(1, 23, 'Voldre', 'Superbe article!\r\n', '2020-04-22 01:40:45'),
(2, 23, 'Voldre', 'Superbe article!\r\n', '2020-04-22 01:40:50'),
(3, 23, 'Cedric', 'Superbe! Les commentaires fonctionnent!\r\n', '2020-04-22 01:53:24'),
(4, 23, 'Cedric', 'Superbe! Les commentaires fonctionnent!\r\n', '2020-04-22 01:54:25'),
(5, 23, 'Cedric', 'Superbe! Les commentaires fonctionnent!\r\n', '2020-04-22 01:56:20'),
(6, 23, 'Cedric', 'Superbe! Les commentaires fonctionnent!\r\n', '2020-04-22 01:56:43'),
(7, 23, 'Cedric', 'Superbe! Les commentaires fonctionnent!\r\n', '2020-04-22 01:56:58'),
(8, 23, 'Cedric', 'Superbe! Les commentaires fonctionnent!\r\n', '2020-04-22 01:58:47'),
(9, 23, 'Cedric', 'Superbe! Les commentaires fonctionnent!\r\n', '2020-04-22 01:59:51'),
(10, 23, 'Cedric', 'Superbe! Les commentaires fonctionnent!\r\n', '2020-04-22 02:00:33'),
(11, 23, 'Quentin', 'Beau travail!\r\n', '2020-04-22 02:03:58'),
(12, 7, 'Testeur', 'Voyons si ce commentaire sera visible ailleurs!\r\n', '2020-04-22 02:06:47'),
(13, 7, '&lt;strong&gt;grostesteur&lt;/strong&gt;', 'Moi je test &lt;em&gt;tout!&lt;/em&gt;\r\n', '2020-04-22 02:07:05'),
(14, 23, 'Voldre', 'Ceci est le commentaire de trop.\r\n', '2020-04-22 02:07:43'),
(15, 25, 'AgentX', 'First.\r\n\r\nJe suis le premier Ãƒ  commenter.', '2020-04-22 02:33:36'),
(16, 25, 'AgentX', 'First.\r\n\r\nJe suis le premier Ãƒ  commenter.', '2020-04-22 02:34:55'),
(17, 29, 'MICHEL', 'Commentaire', '2020-04-25 19:00:38'),
(18, 7, 'MICHEL', 'Mais qui a bien pu Ã©crire cet article?', '2020-04-25 19:46:39'),
(19, 1, 'ZAVELL', 'J''aime beaucoup ton article.\r\n    ', '2020-04-25 19:52:53'),
(20, 29, 'ZAVELL', 'Peut mieux faire.', '2020-04-25 19:53:12'),
(21, 7, 'ZAVELL', 'C''est un peu court pour un article, non?', '2020-04-25 19:55:10'),
(22, 29, 'LUCIE', 'Bonjour, je trouve le sujet trÃ¨s intÃ©ressant.\r\nCordialement, lucie.', '2020-04-25 20:52:18'),
(23, 7, 'LUCIE', 'L''article manque de pertinence.', '2020-04-25 20:52:47'),
(24, 7, 'LUCIE', 'Peut-Ãªtre devriez-vous approfondir vos recherches.', '2020-04-25 20:53:05'),
(25, 23, 'LUCIE', 'Cet article date d''il y a si longtemps.', '2020-04-25 20:54:04');

-- --------------------------------------------------------

--
-- Structure de la table `jeux_video`
--

CREATE TABLE IF NOT EXISTS `jeux_video` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `possesseur` varchar(255) NOT NULL,
  `console` varchar(255) NOT NULL,
  `prix` double NOT NULL DEFAULT '0',
  `nbre_joueurs_max` int(11) NOT NULL DEFAULT '0',
  `commentaires` text NOT NULL,
  `date_ajout` datetime NOT NULL,
  KEY `ID` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Contenu de la table `jeux_video`
--

INSERT INTO `jeux_video` (`ID`, `nom`, `possesseur`, `console`, `prix`, `nbre_joueurs_max`, `commentaires`, `date_ajout`) VALUES
(1, 'Super Mario Bros', 'Florent', 'NES', 4, 1, 'Un jeu d''anthologie !', '0000-00-00 00:00:00'),
(2, 'Sonic', 'Patrick', 'Megadrive', 2, 1, 'Pour moi, le meilleur jeu du monde !', '0000-00-00 00:00:00'),
(3, 'Zelda : ocarina of time', 'Florent', 'Nintendo 64', 15, 1, 'Un jeu grand, beau et complet comme on en voit rarement de nos jours', '0000-00-00 00:00:00'),
(4, 'Mario Kart 64', 'Florent', 'Nintendo 64', 25, 4, 'Un excellent jeu de kart !', '0000-00-00 00:00:00'),
(5, 'Super Smash Bros Melee', 'Michel', 'GameCube', 55, 4, 'Un jeu de baston dÃ©lirant !', '0000-00-00 00:00:00'),
(6, 'Dead or Alive', 'Patrick', 'Xbox', 60, 4, 'Le plus beau jeu de baston jamais crÃ©Ã©', '0000-00-00 00:00:00'),
(7, 'Dead or Alive Xtreme Beach Volley Ball', 'Patrick', 'Xbox', 60, 4, 'Un jeu de beach volley de toute beautÃ© o_O', '0000-00-00 00:00:00'),
(8, 'Enter the Matrix', 'Michel', 'PC', 45, 1, 'PlutÃ´t bof comme jeu, mais Ã§a complÃ¨te bien le film', '0000-00-00 00:00:00'),
(9, 'Max Payne 2', 'Michel', 'PC', 50, 1, 'TrÃ¨s rÃ©aliste, une sorte de film noir sur fond d''histoire d''amour. A essayer !', '0000-00-00 00:00:00'),
(10, 'Yoshi''s Island', 'steven', 'SuperNES', 6, 1, 'Le paradis des Yoshis :o)', '2020-04-22 02:49:04'),
(11, 'Commandos 3', 'Florent', 'PC', 44, 12, 'Un bon jeu d''action oÃ¹ on dirige un commando pendant la 2Ã¨me guerre mondiale !', '0000-00-00 00:00:00'),
(12, 'Final Fantasy X', 'Patrick', 'PS2', 40, 1, 'Encore un Final Fantasy mais celui la est encore plus beau !', '0000-00-00 00:00:00'),
(13, 'Pokemon Rubis', 'Florent', 'GBA', 44, 4, 'Pika-Pika-chu !!!', '0000-00-00 00:00:00'),
(14, 'Starcraft', 'Michel', 'PC', 19, 8, 'Le meilleur jeux pc de tout les temps !', '0000-00-00 00:00:00'),
(15, 'Grand Theft Auto 3', 'Michel', 'PS2', 30, 1, 'Comme dans les autres Gta on ecrase tout le monde :) .', '0000-00-00 00:00:00'),
(16, 'Homeworld 2', 'Michel', 'PC', 45, 6, 'Superbe ! o_O', '0000-00-00 00:00:00'),
(17, 'Aladin', 'Patrick', 'SuperNES', 10, 1, 'Comme le dessin AnimÃ© !', '0000-00-00 00:00:00'),
(18, 'Super Mario Bros 3', 'Michel', 'SuperNES', 10, 2, 'Le meilleur Mario selon moi.', '0000-00-00 00:00:00'),
(19, 'SSX 3', 'Florent', 'Xbox', 56, 2, 'Un trÃ¨s bon jeu de snow !', '0000-00-00 00:00:00'),
(20, 'Star Wars : Jedi outcast', 'Patrick', 'Xbox', 33, 1, 'Encore un jeu sur star-wars oÃ¹ on se prend pour Luke Skywalker !', '0000-00-00 00:00:00'),
(21, 'Actua Soccer 3', 'Patrick', 'PS', 30, 2, 'Un jeu de foot assez bof ...', '0000-00-00 00:00:00'),
(22, 'Time Crisis 3', 'Florent', 'PS2', 40, 1, 'Un troisiÃ¨me volet efficace mais pas vraiment surprenant', '0000-00-00 00:00:00'),
(23, 'X-FILES', 'Patrick', 'PS', 25, 1, 'Un jeu censÃ© ressembler a la sÃ©rie mais assez ratÃ© ...', '0000-00-00 00:00:00'),
(24, 'Soul Calibur 2', 'Patrick', 'Xbox', 54, 1, 'Un jeu bien axÃ© sur le combat', '0000-00-00 00:00:00'),
(25, 'Diablo', 'Florent', 'PS', 20, 1, 'Comme sur PC mais la c''est sur un ecran de tÃ©lÃ© :) !', '0000-00-00 00:00:00'),
(26, 'Street Fighter 2', 'Patrick', 'Megadrive', 10, 2, 'Le cÃ©lÃ¨bre jeu de combat !', '0000-00-00 00:00:00'),
(27, 'Gundam Battle Assault 2', 'Florent', 'PS', 29, 1, 'Jeu japonais dont le gameplay est un peu limitÃ©. Peu de robots malheureusement', '0000-00-00 00:00:00'),
(28, 'Spider-Man', 'Florent', 'Megadrive', 15, 1, 'Vivez l''aventure de l''homme araignÃ©e', '0000-00-00 00:00:00'),
(29, 'Midtown Madness 3', 'Michel', 'Xbox', 59, 6, 'Dans la suite des autres versions de Midtown Madness', '0000-00-00 00:00:00'),
(30, 'Tetris', 'Florent', 'Gameboy', 5, 1, 'Qui ne connait pas ? ', '0000-00-00 00:00:00'),
(31, 'The Rocketeer', 'Michel', 'NES', 2, 1, 'Un super un film et un jeu de m*rde ...', '0000-00-00 00:00:00'),
(32, 'Pro Evolution Soccer 3', 'Patrick', 'PS2', 59, 2, 'Un petit jeu de foot sur PS2', '0000-00-00 00:00:00'),
(33, 'Ice Hockey', 'Michel', 'NES', 7, 2, 'Jamais jouÃ© mais a mon avis ca parle de hockey sur glace ... =)', '0000-00-00 00:00:00'),
(34, 'Sydney 2000', 'Florent', 'Dreamcast', 15, 2, 'Les JO de Sydney dans votre salon !', '0000-00-00 00:00:00'),
(35, 'NBA 2k', 'Patrick', 'Dreamcast', 12, 2, 'A votre avis :p ?', '0000-00-00 00:00:00'),
(36, 'Aliens Versus Predator : Extinction', 'Michel', 'PS2', 20, 2, 'Un shoot''em up pour pc', '0000-00-00 00:00:00'),
(37, 'Crazy Taxi', 'Florent', 'Dreamcast', 11, 1, 'Conduite de taxi en folie !', '0000-00-00 00:00:00'),
(38, 'Le Maillon Faible', 'Mathieu', 'PS2', 10, 1, 'Le jeu de l''Ã©mission', '0000-00-00 00:00:00'),
(39, 'FIFA 64', 'Michel', 'Nintendo 64', 25, 2, 'Le premier jeu de foot sur la N64 =) !', '0000-00-00 00:00:00'),
(40, 'Qui Veut Gagner Des Millions', 'Florent', 'PS2', 10, 1, 'Le jeu de l''Ã©mission', '0000-00-00 00:00:00'),
(41, 'Monopoly', 'Sebastien', 'Nintendo 64', 21, 4, 'Bheuuu le monopoly sur N64 !', '0000-00-00 00:00:00'),
(42, 'Taxi 3', 'Corentin', 'PS2', 19, 4, 'Un jeu de voiture sur le film', '0000-00-00 00:00:00'),
(43, 'Indiana Jones Et Le Tombeau De L''Empereur', 'Florent', 'PS2', 25, 1, 'Notre aventurier prÃ©fÃ©rÃ© est de retour !!!', '0000-00-00 00:00:00'),
(44, 'F-ZERO', 'Mathieu', 'GBA', 25, 4, 'Un super jeu de course futuriste !', '0000-00-00 00:00:00'),
(45, 'Harry Potter Et La Chambre Des Secrets', 'Mathieu', 'Xbox', 30, 1, 'Abracadabra !! Le cÃ©lebre magicien est de retour !', '0000-00-00 00:00:00'),
(46, 'Half-Life', 'Corentin', 'PC', 15, 32, 'L''autre meilleur jeu de tout les temps (surtout ses mods).', '0000-00-00 00:00:00'),
(47, 'Myst III Exile', 'SÃ©bastien', 'Xbox', 49, 1, 'Un jeu de rÃ©flexion', '0000-00-00 00:00:00'),
(48, 'Wario World', 'Sebastien', 'Gamecube', 40, 4, 'Wario vs Mario ! Qui gagnera ! ?', '0000-00-00 00:00:00'),
(49, 'Rollercoaster Tycoon', 'Florent', 'Xbox', 29, 1, 'Jeu de gestion d''un parc d''attraction', '0000-00-00 00:00:00'),
(50, 'Splinter Cell', 'Patrick', 'Xbox', 53, 1, 'Jeu magnifique !', '0000-00-00 00:00:00'),
(54, 'Les Trente Elus 3', 'Voldre', '', 55, 0, '', '0000-00-00 00:00:00'),
(55, 'Les Trente Elus 3', 'Voldre2', '', 55, 0, '', '0000-00-00 00:00:00'),
(56, 'Les Trente Elus 2', 'Voldre', '', 30, 0, '', '0000-00-00 00:00:00'),
(57, 'Les Trente Elus 2', 'Voldre2', '', 30, 0, '', '2020-04-21 18:29:13'),
(58, 'monjeu', 'moimeme', '', 50, 0, '', '0000-00-00 00:00:00'),
(59, 'Un jeu datÃƒÂ©', 'Dateur', '', 100, 0, '', '2020-04-21 18:28:15'),
(60, 'Agarest', 'Valentin', '', 25, 0, '', '2020-04-22 03:04:13');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`ID`, `pseudo`, `mdp`, `email`, `date_inscription`, `description`) VALUES
(1, 'charle', 'ambitieux', '0', '2020-04-24 14:51:30', ''),
(2, 'andive', 'carotte', '0', '2020-04-24 15:21:22', ''),
(3, 'Cedric', '$2y$10$orusHKpAvbqrAq1Yk.KGfuN/tLE9dZ5pNAL7OQ9qhIW8hg1HPF1cy', '0', '2020-04-24 16:52:39', ''),
(4, 'cedric', '$2y$10$Kd8.6foRlujYHWlhLg9wvu0FnjNZin43X5RG.OUnwdUcd/HqWswc.', '0', '2020-04-24 17:22:58', ''),
(5, 'Marc22', '$2y$10$io.A76Nj6IvrCuO9n3P6DuCxL5iTnGOA5DCzcRdYYVGPOuS7SkGtO', '0', '2020-04-24 17:27:08', ''),
(6, 'Copain', '$2y$10$Ib24yKtTo/ayAR8x9GoWjO2PvD7Ap60AuR4cisjJfz7b74b0KzvG6', 'mon.copain@mail.com', '2020-04-24 17:34:12', ''),
(7, 'MONMEMBRE', '$2y$10$.zMbkD6gByS1XtGSmjxfROjDkkqILTZ.2B8YyWYuXINs07A1PVQJK', 'son@mail.com', '2020-04-24 17:54:48', 'Je suis le membre de plus &lt;strong&gt;fidÃƒÂ¨le&lt;/strong&gt; qui existe.'),
(8, 'ZAVELL', '$2y$10$6XZBwh8cvX.xc33khsSzFOVQmzH8LfEfMbEUxGnFYcYrroDPsFzgq', 'zavell.bg@mail.com', '2020-04-24 19:16:52', 'Je suis le plus douÃ© et le plus beau. Je suis... le Grand Zavell !'),
(9, 'MICHEL', '$2y$10$CKAhu6OfNq27UcuRxHwIS.IYVFzJCr.C0EJMxs749f3LNJ8DP.74W', 'mich.thouvi@univ-rouen.fr', '2020-04-24 21:21:11', 'Voici la description de Jean-Michel THOUVIGNON!\r\n\r\nThouvivi...!'),
(14, 'LUCIE', '$2y$10$PBYGU9huzONabtxrNI5Zrely5EkKfarjQfT.QQaluUQ4HyAb6qeMm', 'lucie.dumas@mail.com', '2020-04-25 20:45:04', 'Lucie Dumas, professeur Ã  l''UniversitÃ© de ...\r\n        ');

-- --------------------------------------------------------

--
-- Structure de la table `mon_chat`
--

CREATE TABLE IF NOT EXISTS `mon_chat` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mon_message` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `mon_chat`
--

INSERT INTO `mon_chat` (`ID`, `pseudo`, `mon_message`) VALUES
(16, 'Sebastien', 'Bonjour!'),
(17, 'CÃƒÂ©dric', 'Comment ÃƒÂ§a va?\r\n'),
(18, 'Marie', 'Bien et vous?'),
(19, 'Marie', 'Bien et vous?'),
(20, 'Marie', 'Bien et vous?'),
(21, 'Claire', 'Alex a encore fait des bÃƒÂªtises!'),
(22, 'Valentin', 'Cela ne m''ÃƒÂ©tonne pas!'),
(23, 'sdqq', '...\r\n'),
(24, 'ezze', '...\r\naaa'),
(25, 'Christophe', 'Salut les gens.'),
(26, 'Killian', 'Quelqu''un a reÃƒÂ§u ce message?'),
(27, 'Marie', 'Oui Killian nous avons bien reÃƒÂ§u ton message.'),
(28, 'Killian', '&lt;strong&gt;Super!&lt;/strong&gt;'),
(29, 'ClÃƒÂ©ment', 'En vrai, je trouve que c''est cool'),
(30, 'SÃƒÂ©bastien', 'Vous pouvez afficher plus de messages si vous le souhaitez, regardez la case au dessus!'),
(31, 'tttt', '...\r\n'),
(32, 'tttt', '...\r\n'),
(33, 'SÃƒÂ©bastien', 'Vous pouvez afficher plus de messages si vous le souhaitez, regardez la case au dessus!'),
(34, 'dfqsd', '...\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `visiteurs`
--

CREATE TABLE IF NOT EXISTS `visiteurs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(200) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `visiteurs`
--

INSERT INTO `visiteurs` (`ID`, `pseudo`, `age`, `email`) VALUES
(1, 'Voldre', 20, 'v.dre@laposte.net'),
(2, 'testeur1', 55, 'test.mail@laposte.net'),
(3, 'testeur2', 66, 'test.mail@gmail.com');
