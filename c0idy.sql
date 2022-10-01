-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 07 Juillet 2021 à 08:53
-- Version du serveur :  10.1.48-MariaDB-0+deb9u2
-- Version de PHP :  7.0.33-47+0~20210228.54+debian9~1.gbp7f60a9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `c0idy`
--

-- --------------------------------------------------------

--
-- Structure de la table `ami`
--

CREATE TABLE `ami` (
  `idUtilisateur1` bigint(20) NOT NULL,
  `idUtilisateur2` bigint(20) NOT NULL,
  `statut` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `ami`
--

INSERT INTO `ami` (`idUtilisateur1`, `idUtilisateur2`, `statut`) VALUES
(8, 10, 0),
(8, 19, 0),
(8, 20, 0),
(8, 22, 0),
(8, 31, 0),
(8, 39, 0),
(8, 40, 0),
(8, 42, 0),
(8, 83, 0),
(8, 112, 0),
(10, 8, 0),
(10, 20, 0),
(10, 40, 0),
(19, 8, 0),
(19, 10, 0),
(19, 20, 0),
(19, 22, 0),
(19, 32, 0),
(19, 36, 0),
(20, 8, 0),
(20, 10, 0),
(20, 19, 0),
(20, 39, 0),
(20, 40, 0),
(20, 80, 0),
(22, 8, 0),
(22, 19, 0),
(22, 20, 0),
(22, 31, 0),
(22, 37, 0),
(35, 8, 0),
(37, 83, 0),
(40, 8, 0),
(40, 10, 0),
(40, 19, 0),
(40, 20, 0),
(80, 20, 0),
(111, 20, 0),
(112, 8, 0),
(113, 8, 0),
(114, 8, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Choix`
--

CREATE TABLE `Choix` (
  `Sondage` bigint(20) DEFAULT NULL,
  `idChoix` bigint(20) NOT NULL,
  `Choix` varchar(140) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Choix`
--

INSERT INTO `Choix` (`Sondage`, `idChoix`, `Choix`) VALUES
(10993, 11139, 'Canada'),
(10993, 11140, 'Etats unis'),
(10994, 11141, 'Iphone'),
(10994, 11142, 'Xiaomi'),
(10995, 11143, 'photos'),
(10995, 11144, 'audios'),
(10996, 11145, 'indus'),
(10996, 11146, 'informatique'),
(10997, 11147, 'Celui la'),
(10997, 11148, 'Plut&ocirc;t celui ci'),
(11002, 11159, 'Ici c\'est Paris'),
(11002, 11160, 'RCL'),
(11007, 11177, 'huski'),
(11007, 11178, 'cocker'),
(11007, 11179, 'Berger Australien'),
(11007, 11180, 'Golden'),
(11009, 11183, 'Aucun'),
(11009, 11184, '1'),
(11009, 11185, '2'),
(11009, 11186, '3 ou plus'),
(11010, 11187, 'oui'),
(11010, 11188, 'non'),
(11011, 11189, 'oui avec la deuxi&egrave;me injection'),
(11011, 11190, 'Seulement la premi&egrave;re injection'),
(11011, 11191, 'Non'),
(11012, 11192, 'Bitcoin'),
(11012, 11193, 'Ethereum'),
(11012, 11194, 'Dogecoin'),
(11012, 11195, 'XRP'),
(11013, 11196, 'NON'),
(11013, 11197, 'OUI &agrave; moins de 1500 &eacute;lo'),
(11013, 11198, 'A plus de 1500 &eacute;lo'),
(11026, 11228, 'oui'),
(11026, 11229, 'non'),
(11027, 11230, 'Oui'),
(11027, 11231, 'Oui'),
(11028, 11232, 'DinoTrain'),
(11028, 11233, 'DinoWar'),
(11029, 11234, 'idy'),
(11029, 11235, 'idy'),
(11029, 11236, 'idy'),
(11029, 11237, 'pokerstonks (trop nul)'),
(11030, 11238, 'Restau'),
(11030, 11239, 'Cin&eacute;'),
(11031, 11240, 'Un blaireau'),
(11031, 11241, 'Julien'),
(11032, 11242, 'la RKV'),
(11032, 11243, 'la RKF'),
(11033, 11244, 'ts1'),
(11033, 11245, '2ts'),
(11035, 11248, 'mer'),
(11035, 11249, 'montagne'),
(11035, 11250, 'campagne');

-- --------------------------------------------------------

--
-- Structure de la table `Commentairelike`
--

CREATE TABLE `Commentairelike` (
  `idlike` int(11) NOT NULL,
  `idCommentaire` bigint(20) NOT NULL,
  `idUtilisateur` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Commentairelike`
--

INSERT INTO `Commentairelike` (`idlike`, `idCommentaire`, `idUtilisateur`) VALUES
(50, 64, 20),
(51, 64, 8),
(52, 59, 8),
(53, 64, 10),
(54, 65, 10),
(55, 66, 20),
(60, 66, 8),
(61, 71, 8),
(67, 76, 20),
(84, 92, 22),
(88, 95, 22),
(89, 96, 111),
(90, 95, 8),
(91, 97, 19),
(93, 98, 8),
(94, 99, 8);

-- --------------------------------------------------------

--
-- Structure de la table `Commentaires`
--

CREATE TABLE `Commentaires` (
  `idcommentaire` bigint(20) NOT NULL,
  `idSondage` bigint(20) NOT NULL,
  `idUtilisateur` bigint(20) NOT NULL,
  `message` varchar(255) NOT NULL,
  `nbreponse` int(11) NOT NULL,
  `nblike` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Commentaires`
--

INSERT INTO `Commentaires` (`idcommentaire`, `idSondage`, `idUtilisateur`, `message`, `nbreponse`, `nblike`) VALUES
(59, 10997, 40, 'Celui de droite car il est beaucoup plus confortable je l\'ai d&eacute;j&agrave; achet&eacute; !', 0, 1),
(62, 11007, 20, 'Trop beau les husky !', 0, 0),
(64, 11009, 20, 'j\'esp&egrave;re en avoir aucun au 2eme semestre !', 0, 4),
(65, 11007, 10, 'Oui louis', 0, 1),
(66, 11012, 20, 'Dogecoin to the moon', 0, 2),
(71, 10995, 8, 'tres  beau', 2, 1),
(76, 11026, 98, 'merci', 0, 2),
(81, 11026, 20, 'ptdr', 0, 0),
(83, 11026, 10, 'j\'\'ai deja vu sa quelque part', 1, 1),
(84, 11026, 40, 'Ce logo me dit vaguement quelque chosee......', 1, 1),
(91, 11029, 20, 'vous avez cliqu&eacute; sur la mauvaise r&eacute;ponse', 0, 0),
(92, 11010, 22, 'grosse teub', 1, 1),
(94, 11030, 8, 'On s\'en fait se vendredi :)', 0, 0),
(95, 11031, 20, 'mdr je suis mort', 0, 2),
(96, 11013, 111, 'je ne joue pas', 0, 1),
(97, 11032, 8, 'Je vais acheter une des deux', 2, 1),
(98, 11032, 19, '@Julien vraiment ?', 1, 1),
(99, 11033, 8, 'fgj', 0, 1),
(100, 11031, 114, 'pourquoi il y a 2 fois le m&ecirc;me choix de r&eacute;ponse ?', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL COMMENT 'Clé primaire',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'indique si la conversation est active',
  `theme` varchar(40) NOT NULL COMMENT 'Thème de la conversation',
  `idUtilisateur` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `conversations`
--

INSERT INTO `conversations` (`id`, `active`, `theme`, `idUtilisateur`) VALUES
(150, 1, 'Team Idy', 20),
(152, 1, 'test', 8),
(157, 1, 'teub', 22),
(158, 1, 'conv', 80),
(159, 1, 'Tennis', 112),
(160, 1, 'Pl', 19),
(161, 1, 'Jeu', 113);

-- --------------------------------------------------------

--
-- Structure de la table `MembreConversation`
--

CREATE TABLE `MembreConversation` (
  `idConv` int(11) DEFAULT NULL,
  `idMembre` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `MembreConversation`
--

INSERT INTO `MembreConversation` (`idConv`, `idMembre`) VALUES
(150, 20),
(150, 8),
(150, 10),
(150, 40),
(152, 8),
(152, 83),
(157, 22),
(157, 8),
(158, 80),
(158, 20),
(159, 112),
(159, 8),
(160, 19),
(160, 8),
(161, 113);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL COMMENT 'Identifiant du message',
  `idConversation` int(11) NOT NULL COMMENT 'Clé étrangère vers la table des conversations',
  `contenu` varchar(150) NOT NULL COMMENT 'Contenu du message',
  `idAuteur` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `idConversation`, `contenu`, `idAuteur`) VALUES
(142, 150, 'Salut ca va ?', 20),
(143, 150, 'Donnez moi votre avis sur mon sondage', 20),
(144, 150, '<a href=\"https://web-idy.com/index.php?view=sondage&amp;idSondage=10999\">Cliquer pour voir le Sondage</a>', 20),
(145, 150, 'Super ! moi aussi regardez mon sondage !', 8),
(146, 150, '<a href=\"https://web-idy.com/index.php?view=sondage&amp;idSondage=10996\">Cliquer pour voir le Sondage</a>', 8),
(147, 150, '<a href=\"https://web-idy.com/index.php?view=sondage&amp;idSondage=11009\">Cliquer pour voir le Sondage</a>', 8),
(148, 150, 'Allez r&eacute;pondre !', 8),
(149, 150, 'oui j\'y vais tout de suite', 20),
(152, 152, 'hvo', 8),
(153, 152, '<a href=\"https://web-idy.com/index.php?view=sondage&amp;idSondage=11009\">Cliquer pour voir le Sondage</a>', 8),
(159, 157, 'ca va le sang ?', 22),
(160, 157, 'nickel et toi ?', 37),
(161, 158, 'salut ca va ?', 80),
(162, 159, 'Vrhfh', 112),
(163, 160, 'Coucouuuu', 19),
(164, 160, 'Coucouuuu', 8),
(165, 160, 'Ma PL :)', 8),
(166, 160, '<a href=\"https://web-idy.com/index.php?view=sondage&amp;idSondage=11032\">Cliquer pour voir le Sondage</a>', 8);

-- --------------------------------------------------------

--
-- Structure de la table `Reponses`
--

CREATE TABLE `Reponses` (
  `idReponse` bigint(20) NOT NULL,
  `sondage` bigint(20) NOT NULL,
  `idChoix` bigint(20) NOT NULL,
  `utilisateur` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Reponses`
--

INSERT INTO `Reponses` (`idReponse`, `sondage`, `idChoix`, `utilisateur`) VALUES
(29479, 10993, 11140, 8),
(29482, 10993, 11139, 40),
(29483, 10994, 11142, 40),
(29484, 10995, 11143, 40),
(29485, 10996, 11146, 40),
(29486, 10997, 11148, 40),
(29491, 10993, 11140, 10),
(29492, 10994, 11141, 10),
(29493, 10995, 11143, 10),
(29494, 10996, 11145, 10),
(29495, 10997, 11147, 10),
(29497, 11002, 11160, 10),
(29501, 11007, 11179, 10),
(29503, 10993, 11140, 20),
(29504, 10994, 11141, 20),
(29505, 10995, 11143, 20),
(29506, 10996, 11146, 20),
(29507, 10997, 11147, 20),
(29510, 11002, 11160, 20),
(29511, 11007, 11177, 20),
(29524, 11009, 11183, 20),
(29526, 11009, 11184, 10),
(29528, 10993, 11140, 22),
(29529, 10994, 11142, 22),
(29530, 10995, 11143, 22),
(29531, 10996, 11146, 22),
(29532, 10997, 11147, 22),
(29535, 11002, 11160, 22),
(29536, 11007, 11179, 22),
(29537, 11009, 11184, 22),
(29539, 10993, 11139, 37),
(29540, 10994, 11141, 37),
(29541, 10995, 11144, 37),
(29542, 10996, 11145, 37),
(29543, 10997, 11148, 37),
(29546, 11002, 11159, 37),
(29547, 11007, 11177, 37),
(29548, 11009, 11183, 37),
(29550, 11010, 11188, 20),
(29551, 11011, 11190, 20),
(29552, 11012, 11195, 20),
(29553, 11010, 11188, 10),
(29554, 11011, 11190, 10),
(29555, 11012, 11194, 10),
(29556, 11013, 11197, 10),
(29561, 10995, 11143, 8),
(29590, 11007, 11178, 8),
(29597, 10996, 11146, 8),
(29598, 10993, 11139, 86),
(29599, 10996, 11145, 86),
(29600, 11026, 11228, 79),
(29601, 11026, 11228, 86),
(29603, 11027, 11230, 98),
(29605, 11013, 11196, 79),
(29607, 11011, 11191, 79),
(29608, 11010, 11188, 79),
(29609, 10996, 11146, 79),
(29610, 10993, 11140, 79),
(29612, 11026, 11228, 40),
(29614, 10993, 11139, 35),
(29615, 10994, 11141, 35),
(29616, 10995, 11143, 35),
(29617, 10996, 11146, 35),
(29618, 10997, 11148, 35),
(29619, 11026, 11228, 20),
(29621, 11002, 11160, 35),
(29622, 11007, 11177, 35),
(29623, 11009, 11186, 35),
(29624, 11010, 11187, 35),
(29625, 11011, 11190, 35),
(29627, 11012, 11192, 35),
(29629, 11026, 11229, 10),
(29632, 11027, 11231, 10),
(29634, 11026, 11228, 35),
(29638, 11027, 11231, 35),
(29645, 11027, 11230, 40),
(29649, 11028, 11232, 98),
(29651, 11028, 11232, 10),
(29653, 11011, 11190, 8),
(29654, 11012, 11195, 8),
(29655, 11013, 11197, 8),
(29661, 11026, 11228, 8),
(29662, 11027, 11231, 8),
(29663, 11028, 11233, 8),
(29667, 11028, 11233, 20),
(29668, 11028, 11232, 35),
(29669, 11013, 11196, 35),
(29671, 11029, 11235, 20),
(29673, 11029, 11237, 98),
(29675, 11029, 11237, 10),
(29676, 11013, 11196, 20),
(29677, 11029, 11237, 8),
(29678, 10993, 11139, 19),
(29679, 10994, 11141, 19),
(29680, 10995, 11143, 19),
(29681, 10996, 11146, 19),
(29682, 10997, 11148, 19),
(29684, 11002, 11160, 19),
(29685, 11007, 11179, 19),
(29686, 11009, 11184, 19),
(29687, 11010, 11188, 19),
(29688, 11011, 11191, 19),
(29689, 11012, 11195, 19),
(29690, 11013, 11197, 19),
(29694, 11026, 11228, 19),
(29695, 11027, 11231, 19),
(29696, 11028, 11232, 19),
(29697, 11029, 11234, 19),
(29698, 11027, 11231, 20),
(29699, 11011, 11190, 22),
(29700, 11012, 11194, 22),
(29701, 11026, 11228, 22),
(29704, 11010, 11188, 8),
(29705, 11009, 11184, 8),
(29706, 11002, 11160, 8),
(29708, 10997, 11147, 8),
(29709, 10994, 11142, 8),
(29710, 11029, 11234, 40),
(29728, 10993, 11139, 80),
(29729, 11027, 11230, 22),
(29730, 11030, 11238, 10),
(29731, 11030, 11239, 8),
(29732, 11031, 11241, 20),
(29733, 11030, 11238, 19),
(29734, 11031, 11241, 19),
(29735, 11030, 11238, 20),
(29736, 10993, 11139, 111),
(29737, 11031, 11241, 8),
(29738, 10993, 11139, 112),
(29739, 11007, 11179, 112),
(29740, 11031, 11241, 10),
(29741, 10993, 11139, 83),
(29742, 10994, 11142, 83),
(29743, 10995, 11143, 83),
(29744, 11002, 11159, 83),
(29745, 11007, 11179, 83),
(29746, 11009, 11183, 83),
(29747, 11010, 11188, 83),
(29748, 11011, 11189, 83),
(29749, 11012, 11195, 83),
(29750, 11013, 11196, 83),
(29751, 11027, 11230, 83),
(29752, 11029, 11234, 83),
(29753, 11030, 11238, 83),
(29754, 11031, 11241, 83),
(29755, 11032, 11242, 19),
(29756, 11032, 11242, 24),
(29757, 11032, 11242, 8),
(29758, 10993, 11140, 113),
(29759, 11030, 11238, 40),
(29760, 11031, 11240, 40),
(29761, 11032, 11242, 40),
(29762, 11032, 11242, 10),
(29763, 11033, 11245, 8),
(29764, 11033, 11244, 19),
(29765, 10993, 11139, 114),
(29766, 10994, 11141, 114),
(29768, 10996, 11145, 114),
(29769, 10997, 11147, 114),
(29770, 11007, 11178, 114),
(29771, 11009, 11186, 114),
(29772, 11010, 11188, 114),
(29773, 11033, 11244, 10),
(29774, 11012, 11192, 114),
(29775, 11013, 11197, 114),
(29776, 11026, 11228, 114),
(29777, 11027, 11230, 114),
(29778, 11033, 11244, 40),
(29779, 11035, 11248, 40);

-- --------------------------------------------------------

--
-- Structure de la table `sondageImage`
--

CREATE TABLE `sondageImage` (
  `idChoix` bigint(20) NOT NULL,
  `idLien` bigint(20) NOT NULL,
  `lien` varchar(100) NOT NULL,
  `idSondage` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `sondageImage`
--

INSERT INTO `sondageImage` (`idChoix`, `idLien`, `lien`, `idSondage`) VALUES
(11147, 63, './ressources/imageSondage/4777Klim_gordel.jpg', 10997),
(11148, 64, './ressources/imageSondage/2875391v2UYpzv9L._AC_SX425_.jpg', 10997),
(11159, 71, './ressources/imageSondage/8650556746260-42188211.jpg', 11002),
(11160, 72, './ressources/imageSondage/57447t&eacute;l&eacute;chargement.jpg', 11002),
(11177, 77, './ressources/imageSondage/11556huski.jpg', 11007),
(11178, 78, './ressources/imageSondage/32510cocker.jpg', 11007),
(11179, 79, './ressources/imageSondage/97069berger-australien.jpg', 11007),
(11180, 80, './ressources/imageSondage/28043golden.jpg', 11007),
(11228, 102, './ressources/imageSondage/47402stonks.png', 11026),
(11229, 103, './ressources/imageSondage/82254stonks.png', 11026),
(11242, 104, './ressources/imageSondage/19434rkv-noir.jpg', 11032),
(11243, 105, './ressources/imageSondage/97532rkf-noir.jpg', 11032);

-- --------------------------------------------------------

--
-- Structure de la table `Sondagelike`
--

CREATE TABLE `Sondagelike` (
  `idlike` bigint(20) NOT NULL,
  `idSondage` bigint(20) NOT NULL,
  `idUtilisateur` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Sondagelike`
--

INSERT INTO `Sondagelike` (`idlike`, `idSondage`, `idUtilisateur`) VALUES
(114, 10993, 40),
(115, 10997, 40),
(122, 11002, 20),
(123, 11007, 20),
(128, 11009, 20),
(129, 11009, 8),
(130, 10995, 8),
(131, 11009, 10),
(132, 11002, 8),
(133, 11011, 20),
(134, 11012, 20),
(135, 11012, 10),
(136, 11012, 8),
(137, 11013, 10),
(147, 11007, 8),
(150, 11026, 98),
(151, 11026, 79),
(152, 11026, 40),
(156, 11026, 20),
(160, 11026, 10),
(164, 11028, 10),
(166, 11028, 98),
(169, 11027, 8),
(172, 11028, 20),
(173, 10993, 10),
(174, 11028, 8),
(175, 11029, 20),
(177, 11013, 20),
(178, 10993, 20),
(179, 11010, 22),
(180, 11011, 22),
(181, 11026, 22),
(182, 11026, 8),
(183, 10993, 8),
(184, 10993, 80),
(185, 11030, 8),
(186, 11031, 20),
(187, 11031, 19),
(188, 10993, 112),
(189, 10993, 83),
(190, 11011, 83),
(191, 11032, 8),
(192, 11032, 24),
(193, 10993, 113),
(194, 11033, 8),
(195, 11013, 114);

-- --------------------------------------------------------

--
-- Structure de la table `Sondages`
--

CREATE TABLE `Sondages` (
  `idSondage` bigint(20) NOT NULL,
  `Utilisateur` bigint(20) NOT NULL COMMENT 'Utilisateur a l''origine du sondage',
  `Question` text NOT NULL COMMENT 'Question posée',
  `NbReponses` int(11) NOT NULL COMMENT 'Nombre de réponses possibles',
  `nbChoix` int(11) NOT NULL DEFAULT '0',
  `nblike` int(11) DEFAULT NULL,
  `typeSondage` varchar(40) NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Sondages`
--

INSERT INTO `Sondages` (`idSondage`, `Utilisateur`, `Question`, `NbReponses`, `nbChoix`, `nblike`, `typeSondage`) VALUES
(10993, 8, 'Quel pays pr&eacute;f&eacute;rez vous ?', 26, 2, 11, 'normal'),
(10994, 8, 'Quelle marque tu pr&eacute;f&egrave;res ?', 16, 2, 0, 'normal'),
(10995, 8, 'Tu pr&eacute;f&egrave;res les sondages photos ou sondages audios ?', 14, 2, 1, 'normal'),
(10996, 8, 'Tu veux aller en indus ou en informatique ?', 18, 2, 1, 'normal'),
(10997, 8, 'Quel baudrier tu pr&eacute;f&egrave;res ?', 13, 2, 1, 'image'),
(11002, 8, 'Quelle &eacute;quipe tu pr&eacute;f&egrave;res ?', 11, 2, 2, 'image'),
(11007, 10, 'Votre race de chien de coeur ?', 14, 4, 2, 'image'),
(11009, 8, 'Combien de rattrapage ?', 12, 4, 3, 'normal'),
(11010, 8, 'Est ce que vous avez d&eacute;j&agrave; eu le covid ?', 11, 2, 1, 'normal'),
(11011, 8, 'Est ce que vous &ecirc;tes vaccin&eacute;s', 12, 3, 4, 'normal'),
(11012, 20, 'Quelle cryptomonnaie est la plus int&eacute;ressante ?', 11, 4, 3, 'normal'),
(11013, 8, 'Est ce que vous jouez aux &eacute;checs ? Si oui &agrave; quel &eacute;lo ?', 10, 3, 4, 'normal'),
(11026, 98, 'Aimez vous notre logo ?', 21, 2, 11, 'image'),
(11027, 99, 'Vous aimez bien idy ?', 13, 2, 2, 'normal'),
(11028, 98, 'que pr&eacute;f&eacute;rez vos ?', 9, 2, 7, 'normal'),
(11029, 20, 'vous preferez ?', 10, 4, 2, 'normal'),
(11030, 19, 'C\'est mieux ', 6, 2, 1, 'normal'),
(11031, 8, 'Qui sait qui fait des trucs incompr&eacute;hensibles en info &agrave; son stage ouvrier de premi&egrave;re ann&eacute;e ?', 6, 2, 2, 'normal'),
(11032, 8, 'Quelle moto tu pr&eacute;f&egrave;res ?', 5, 2, 2, 'image'),
(11033, 8, 'test', 4, 2, 1, 'normal'),
(11035, 114, 'meilleur lieu de vacances ?', 1, 3, 0, 'normal');

-- --------------------------------------------------------

--
-- Structure de la table `SondageSuivant`
--

CREATE TABLE `SondageSuivant` (
  `idSondageSuivant` bigint(20) NOT NULL,
  `idSondage` bigint(20) NOT NULL,
  `idUtilisateur` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `SondageSuivant`
--

INSERT INTO `SondageSuivant` (`idSondageSuivant`, `idSondage`, `idUtilisateur`) VALUES
(504, 10993, 10),
(505, 10994, 10),
(506, 10995, 10),
(508, 10996, 10),
(509, 10997, 10),
(601, 10993, 22),
(602, 10994, 22),
(603, 10995, 22),
(604, 10996, 22),
(605, 10997, 22),
(608, 11002, 22),
(609, 11007, 22),
(610, 11009, 22),
(621, 10993, 37),
(622, 10994, 37),
(623, 10995, 37),
(624, 10996, 37),
(625, 10997, 37),
(628, 11002, 37),
(631, 11007, 37),
(663, 11002, 10),
(664, 11007, 10),
(781, 10993, 98),
(782, 10994, 98),
(783, 10995, 98),
(784, 10996, 98),
(785, 10997, 98),
(788, 11002, 98),
(789, 11007, 98),
(790, 11009, 98),
(791, 11010, 98),
(792, 11011, 98),
(793, 11012, 98),
(794, 11013, 98),
(825, 10993, 86),
(827, 10994, 86),
(828, 10995, 86),
(837, 10996, 86),
(842, 10997, 86),
(849, 11002, 86),
(851, 11007, 86),
(855, 11009, 86),
(859, 11010, 86),
(861, 11011, 86),
(863, 11012, 86),
(865, 11013, 86),
(879, 11026, 86),
(935, 10993, 40),
(936, 10994, 40),
(938, 10995, 40),
(941, 10996, 40),
(943, 10997, 40),
(950, 11002, 40),
(954, 11007, 40),
(956, 11009, 40),
(959, 11010, 40),
(961, 11011, 40),
(963, 11012, 40),
(966, 11013, 40),
(1006, 10993, 79),
(1007, 11009, 10),
(1008, 10994, 79),
(1010, 10995, 79),
(1011, 10996, 79),
(1012, 10997, 79),
(1014, 11010, 10),
(1016, 11011, 10),
(1017, 11012, 10),
(1019, 11013, 10),
(1020, 11002, 79),
(1021, 11007, 79),
(1022, 11009, 79),
(1027, 11010, 79),
(1029, 11011, 79),
(1030, 11012, 79),
(1031, 11013, 79),
(1094, 11026, 98),
(1097, 11027, 98),
(1102, 11026, 10),
(1104, 11027, 10),
(1192, 11028, 98),
(1194, 11029, 98),
(1260, 10993, 19),
(1261, 10994, 19),
(1262, 10995, 19),
(1263, 10996, 19),
(1265, 10997, 19),
(1268, 11002, 19),
(1269, 11007, 19),
(1270, 11009, 19),
(1271, 11010, 19),
(1272, 11011, 19),
(1273, 11012, 19),
(1274, 11013, 19),
(1278, 11026, 19),
(1279, 11027, 19),
(1280, 11028, 19),
(1281, 11029, 19),
(1298, 11010, 22),
(1299, 11012, 22),
(1300, 11011, 22),
(1301, 11013, 22),
(1305, 11026, 22),
(1353, 11026, 40),
(1354, 11027, 40),
(1355, 11028, 40),
(1358, 11009, 37),
(1359, 11010, 37),
(1360, 11011, 37),
(1361, 11012, 37),
(1391, 10993, 80),
(1392, 10994, 80),
(1400, 11028, 10),
(1434, 11027, 22),
(1435, 11028, 22),
(1436, 11029, 22),
(1437, 11030, 22),
(1445, 11030, 19),
(1446, 11031, 19),
(1448, 10993, 20),
(1450, 10994, 20),
(1451, 10995, 20),
(1452, 10996, 20),
(1453, 10997, 20),
(1454, 11002, 20),
(1455, 11007, 20),
(1456, 11009, 20),
(1457, 11010, 20),
(1458, 11011, 20),
(1459, 11012, 20),
(1460, 11013, 20),
(1461, 11026, 20),
(1462, 11027, 20),
(1463, 11028, 20),
(1464, 11029, 20),
(1465, 11030, 20),
(1467, 10993, 111),
(1468, 10994, 111),
(1469, 10995, 111),
(1470, 10996, 111),
(1471, 10997, 111),
(1472, 11002, 111),
(1473, 11007, 111),
(1474, 11009, 111),
(1475, 11010, 111),
(1476, 11011, 111),
(1477, 11012, 111),
(1478, 10993, 112),
(1479, 10994, 112),
(1480, 10995, 112),
(1481, 10996, 112),
(1482, 10997, 112),
(1483, 11002, 112),
(1490, 10993, 83),
(1491, 10994, 83),
(1492, 10995, 83),
(1493, 10996, 83),
(1494, 10997, 83),
(1495, 11002, 83),
(1496, 11007, 83),
(1497, 11009, 83),
(1498, 11010, 83),
(1501, 11011, 83),
(1502, 11012, 83),
(1503, 11013, 83),
(1504, 11026, 83),
(1505, 11027, 83),
(1506, 11028, 83),
(1507, 11029, 83),
(1508, 11030, 83),
(1509, 11031, 83),
(1550, 11031, 20),
(1552, 11032, 19),
(1559, 11029, 40),
(1560, 11030, 40),
(1561, 11031, 40),
(1562, 11032, 40),
(1564, 11029, 10),
(1565, 11030, 10),
(1566, 11031, 10),
(1567, 11032, 10),
(1571, 10993, 114),
(1572, 10994, 114),
(1573, 11033, 19),
(1575, 10995, 114),
(1576, 10996, 114),
(1577, 10997, 114),
(1578, 11002, 114),
(1579, 11007, 114),
(1580, 11009, 114),
(1581, 11010, 114),
(1582, 11032, 20),
(1584, 10993, 8),
(1585, 10994, 8),
(1586, 10995, 8),
(1587, 10996, 8),
(1588, 10997, 8),
(1589, 11002, 8),
(1590, 11007, 8),
(1591, 11009, 8),
(1592, 11010, 8),
(1593, 11011, 8),
(1594, 11012, 8),
(1595, 11013, 8),
(1596, 11026, 8),
(1597, 11027, 8),
(1598, 11028, 8),
(1599, 11029, 8),
(1600, 11030, 8),
(1601, 11031, 8),
(1602, 11033, 10),
(1603, 11011, 114),
(1604, 11012, 114),
(1605, 11013, 114),
(1606, 11026, 114),
(1607, 11027, 114),
(1608, 11028, 114),
(1609, 11029, 114),
(1610, 11033, 40),
(1611, 11035, 40);

-- --------------------------------------------------------

--
-- Structure de la table `SousCommentaires`
--

CREATE TABLE `SousCommentaires` (
  `idsouscommentaire` bigint(20) NOT NULL,
  `idUtilisateur` bigint(20) NOT NULL,
  `idcommentaire` bigint(20) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `SousCommentaires`
--

INSERT INTO `SousCommentaires` (`idsouscommentaire`, `idUtilisateur`, `idcommentaire`, `message`) VALUES
(21, 8, 71, 'grsgr'),
(25, 8, 71, 'rgdhr'),
(30, 98, 84, 'un site nous a grandement inspir&amp;eacute; !'),
(31, 98, 83, 'nous sommes connu &amp;agrave; l\'&amp;eacute;tranger c\'est normal ! surtout dans les paradis fiscaux'),
(34, 22, 92, 'grosse chatte'),
(35, 19, 97, 'Vraiment vraiment ?'),
(36, 8, 98, 'oui pourquoi ?'),
(37, 8, 97, 'oui ouiiii');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `idUtilisateur` bigint(20) NOT NULL,
  `pseudo` varchar(18) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `nbSondagesCréés` int(11) NOT NULL,
  `rang` int(11) NOT NULL COMMENT 'Niveau de l''utilisateur',
  `nbCoins` int(11) NOT NULL COMMENT 'Nombre d''IdYCoins de l''utilsteur (la moulaga)',
  `Pourcentage_rang` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(100) NOT NULL DEFAULT './ressources/avatar/utilisateur.png',
  `banniere` varchar(100) NOT NULL DEFAULT './ressources/bannieres/bannierepardefaut.jpeg',
  `admin` int(5) NOT NULL DEFAULT '0',
  `blacklist` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`idUtilisateur`, `pseudo`, `mail`, `mdp`, `dateOfBirth`, `nbSondagesCréés`, `rang`, `nbCoins`, `Pourcentage_rang`, `avatar`, `banniere`, `admin`, `blacklist`) VALUES
(8, 'Julien', 'julien.zammit@live.fr', '$2y$10$2Cmc/gqamacwpuWzZECnFOgp/FkeCy2lsiML3IvTo3oTX4Wwyiyee', '0000-00-00', 23, 8, 159, 55, './ressources/avatar/Julien.jpg', './ressources/bannieres/Julien.png', 1, 0),
(10, 'Mathis', 'mathis.bossaert@gmail.com', '$2y$10$GHSeOhBMMVB4K35ie8OWE.Y.GiiL4mYVxtgIAjStDvsS8JYJCgy/S', '0000-00-00', 4, 7, 151, 30, './ressources/avatar/Mathis.jpg', './ressources/bannieres/Mathis.png', 1, 0),
(19, 'Elena', 'scandella.nana@gmail.com', '$2y$10$mZq/WYtd3WDVgcuA52/H1OvGoywjcRJRCVF61YfT9.orA52aFxBti', '0000-00-00', 1, 6, 159, 25, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(20, 'Louis', 'louisgoudal1@gmail.com', '$2y$10$Wv4cHf.Yt2b1dJU4UyCuDejGkwCBhvg1tFm4cuVZau4raMoWLWmPC', '0000-00-00', 5, 5, 160, 55, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 1, 0),
(22, 'test', 'test', '$2y$10$QSVwWaU/eRJZ3t9g9.Sg7.415yEdx/9sC3JwSkgpugeEfEG67vkLu', '0000-00-00', 0, 4, 107, 15, './ressources/avatar/avatar.jpg', './ressources/bannieres/test.png', 0, 0),
(24, 'Estelle', 'es.zammit@laposte.net', '$2y$10$dEREaBDOf8ve5IM2.DFdbOSj/4TF6hmZhKsTY1hsAhC5VpC9YgtfW', '0000-00-00', 0, 1, 44, 100, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(28, 'Maxoo', 'kangourex@gmail.com', '$2y$10$xjTskrhBe35kg5RjbQop3Ou0I4AE2pI6jQF8d52pgD7iXk9yUlcCe', '0000-00-00', 0, 0, 2, 10, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(31, 'lolo81', 'zammit.l@hotmail.com', '$2y$10$AqBdIVGMsPPZXRwraKC4yOUKI3jc4i/0Xd/hKMCKuu1cM3AcWIvkK', '0000-00-00', 0, 1, 27, 5, './ressources/avatar/lolo81.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(32, 'Lucie', 'lucie.lucie@lucie.lucie', '$2y$10$KB6HECE5NKzYsb2GemhiJOM3DsKgbnCJ9iCnAPBrv4GKhiR20oW4.', '0000-00-00', 0, 2, 33, 75, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(33, 'carlosmagni', 'non', '$2y$10$aAOJtkf3kDIZzbpJ0.1gCupLVY66cByuOjb1mJahynIm2UnuzVXaG', '0000-00-00', 0, 0, 8, 40, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(34, 'Axelp', 'axel.paulin81@gmail.com', '$2y$10$MYnUD/qofjHVdp3/eu8XMekpDGOj4xO9RZoWfV5iwNvTRNtPL.U62', '0000-00-00', 0, 0, 2, 10, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(35, 'Bob', 'Bob', '$2y$10$x23smyrxoGezPvUoclVaROziXQyhFCPeEsJpzCV2yPNJY4JxHhStG', '0000-00-00', 0, 0, 35, 175, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(36, 'Lisa', 'cornet.lisa01@gmail.com', '$2y$10$vNzc7ZnmNPbwfAPt93P0w.nNHxHzgvkRI5Iau3gROV6YBiN10U8Va', '0000-00-00', 0, 1, 33, 65, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(37, 'random', 'random', '$2y$10$68VBPnYoNO5.lLyWYgu3vOjEBr4FT7IuMowcc8LBv5ddR.gXoDb4K', '0000-00-00', 0, 0, 19, 95, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(38, 'Alexandre', 'mop', '$2y$10$NR2bVgHfKrO1HxDuzAbXSeBQ093wgAKRD1qgDIALeRNUBM/i2WvyW', '0000-00-00', 0, 3, 80, 0, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(39, 'Léo', 'Leo', '$2y$10$WNNTn/ajNgrUYVx0GunSYelTUNwFv7oa5mqJI/SW5LjH.QJWjWolC', '2006-06-06', 0, 2, 62, 15, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(40, 'flo', 'klach1703@gmail.com', '$2y$10$4uIWPYfCNUqBuFYex3Yy9e2bbYtVcwzC4dxf2t0BB5oUn6STp5etu', '0000-00-00', 0, 5, 126, 90, './ressources/avatar/flo.jpg', './ressources/bannieres/idy.jpg', 1, 0),
(41, 'a2lx', 'mail@deville-alexis.fr', '$2y$10$A7l2X40wf6uWXQueFkPOG.wuYiNbuLk44XixPjH5WEsAAzGn3okkG', '0000-00-00', 0, 0, 13, 65, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(42, 'julien', 'yo@yahoo.fr', '$2y$10$Qa4cW12wZbCTcn2lbPbVGeHNk8/8dWGrN.E88lQfKC3l3gFMqNef.', '0000-00-00', 0, 1, 26, 0, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(43, 'patacoing', 'patacoing@gmail.com', '$2y$10$ExIRZCX7FMxCTPaxvyQTkuPQfk9L7736g5NISKW96VszFwahB6C42', '0000-00-00', 0, 1, 26, 30, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(48, 'Mathias', 'pironax300@gmail.com', '$2y$10$3EcAbybB2w14iEIUIsI9c.ARjfFvusMBNk4fSiig644v3j6CIFrz.', '2006-01-02', 0, 0, 0, 0, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(50, 'Newball', 'newball875@gmail.com', '$2y$10$zptR5dZekdP7tRSX3g3vKOQJz2peGI6Pie36cunXIfRWjWt9oLYCq', '0000-00-00', 0, 3, 22, 5, './ressources/avatar/Newball.png', './ressources/bannieres/idy.jpg', 0, 0),
(71, 'louisflez', 'louisflez@gmail.com', '$2y$10$I.6CUuL1WVJFWBfpW1mCveLtsH66xJMufE7t.1oZvVZu3HoNZ2LWa', '0000-00-00', 0, 1, 35, 0, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(72, 'Tom', 'arbitretomvast@gmail.com', '$2y$10$cNmCuFUxYsq/AbLOMWoa3.Z4RbpWQE1ORe4f2V7Nehh0uEpCB0bna', '0000-00-00', 0, 0, 8, 40, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(73, 'clem', 'goudal.clement1@gmail.com', '$2y$10$iy0T5UKOmHe5BsHqF9py2eqP26BmALjWNurqGbmyeNBqzCVKwhk/.', '0000-00-00', 0, 0, 4, 20, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(74, 'leo', 'leo@gmail.com', '$2y$10$2UjonRMbgd4Jrsrz2jAvv.cNrj7LUepW8fXClNCjvpsd7/ODlj9da', '2006-06-06', 0, 0, 0, 0, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(78, 'lolag', 'lolaguilbert@orange.fr', '$2y$10$52ocBfMOPHziD4PEDOyP1eAu/HKI8St5n85cF/fDUTHxsy0KpxmDC', '0000-00-00', 0, 0, 4, 20, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(79, 'MaBo', 'bmathias930@gmail.com', '$2y$10$es8OA1cFKayWxFMjQnf33e4hI7HJRFtRhiK5n5qqwrB.V6JH1sYdm', '0000-00-00', 0, 0, 10, 50, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(80, 'cat', 'catherinefrancois1@free.fr', '$2y$10$KvWmf5SDHjjwDkv1REqY3eCq7o2CMXhLTiBj6akWvLNwjjNsHp32m', '2006-06-06', 0, 0, 5, 25, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(81, 'JeanTrouvePeu', 'mathis.bossaert2@gmail.com', '$2y$10$FbNNqMkXMjIxVT55P6i0zerApaEl/NNMfD7QvCdSM1vPpgDgoT6Fe', '0000-00-00', 0, 0, 17, 85, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(83, 'Deb', 'deborah.zammit@sfr.fr', '$2y$10$6EYGrTS20CxRoXJdJf7zD.e/3wUHE4/dJcmp8NSFq93ibNGioOSYu', '0000-00-00', 0, 1, 42, 80, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(84, 'Paul', 'gjfdgjfd@gmail.com', '$2y$10$jL1/LMSkm7uJdTCpnWy83uX1pfvxEbGBdw3NcaASEOlYZVYVnFH6y', '0000-00-00', 0, 0, 7, 35, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(85, 'Lissa', 'scandella.alice@gmail.com', '$2y$10$PgZ8Ng0cwhisIyIhxvWP7uxT6lOeB/QOfVUaRtgvbV9vCkCVp3/S.', '0000-00-00', 0, 0, 9, 45, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(86, 'urban', '1234@123.com', '$2y$10$/3lq3KtQNfZPBD17KQQI.ePO5L8sT0z7elHr8lY.vvcF0N6lu8tsO', '2006-06-06', 0, 0, 4, 20, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(88, 'lfhyudvhzof', 'jean.bbb@gmail.com', '$2y$10$hexZTuMsFihvFpi2RcuccOxsq776PN/NYnQhXYh6giWg2nLcNs7LC', '0000-00-00', 0, 0, 0, 0, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(98, 'pokerstonks', 'pokerstonks@gmail.com', '$2y$10$G/zTvMpYP1IGHI969UvHn.0fyhCd2CfOj.OuSSxFN.2vb.ncD1zBS', '2021-06-04', 4, 0, 4, 20, './ressources/avatar/pokerstonks.png', './ressources/bannieres/pokerstonks.png', 0, 0),
(99, 'bob', 'bob@bob.fr', '$2y$10$iqdK4S6d1uSkLkrE5DfNk.yUPM.TgnsWJoSieda3efo0O5.yniHbe', '1901-01-01', 1, 0, 3, 15, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(111, 'lolita', 'lolita@gmail.com', '$2y$10$jprLcajVr6A06A6t3IH3/eTN1DMpsYtpnuZKjFTT5.lS4czsSBI3e', '2021-06-24', 0, 0, 1, 5, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(112, 'Barbecue81', 'vincenhoules@gmail.com', '$2y$10$Kkofii6M.qMoKGwTYx15JuZKSgnf/g7itp0lEF2AWPJdyDbqk8Z1a', '1999-03-22', 0, 0, 2, 10, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(113, 'Valentin', 'valentin.guinedor@gmail.com', '$2y$10$C./S8CbW5XfOs7NhTixm8e7xlh7JV2imnNgA4GS2QrzQu3BwngQPW', '2004-01-24', 0, 0, 1, 5, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0),
(114, 'PaulE', 'espelpaul@gmail.com', '$2y$10$AZmveSYybe0iY4b8SFabrezLZZvwvl4.i3kGMdDzdTgXZZp8TJ9g2', '2002-10-04', 2, 0, 11, 55, './ressources/avatar/avatar.jpg', './ressources/bannieres/idy.jpg', 0, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ami`
--
ALTER TABLE `ami`
  ADD PRIMARY KEY (`idUtilisateur1`,`idUtilisateur2`),
  ADD KEY `idUtilisateur2` (`idUtilisateur2`);

--
-- Index pour la table `Choix`
--
ALTER TABLE `Choix`
  ADD PRIMARY KEY (`idChoix`),
  ADD KEY `fk_choix_Sondages` (`Sondage`);

--
-- Index pour la table `Commentairelike`
--
ALTER TABLE `Commentairelike`
  ADD PRIMARY KEY (`idlike`),
  ADD KEY `fk_Commentairelike_idCommentaire` (`idCommentaire`),
  ADD KEY `fk_Commentairelike_idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `Commentaires`
--
ALTER TABLE `Commentaires`
  ADD PRIMARY KEY (`idcommentaire`),
  ADD KEY `fk_Commentaires_idSondage` (`idSondage`),
  ADD KEY `fk_Commentaires_idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `MembreConversation`
--
ALTER TABLE `MembreConversation`
  ADD KEY `idConv` (`idConv`),
  ADD KEY `idMembre` (`idMembre`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMessage` (`idConversation`),
  ADD KEY `idAuteur` (`idAuteur`);

--
-- Index pour la table `Reponses`
--
ALTER TABLE `Reponses`
  ADD PRIMARY KEY (`idReponse`),
  ADD KEY `fk_Reponses_Sondages` (`sondage`),
  ADD KEY `fk_Reponses_Utilisateurs` (`utilisateur`),
  ADD KEY `fk_Reponses_idChoix` (`idChoix`);

--
-- Index pour la table `sondageImage`
--
ALTER TABLE `sondageImage`
  ADD PRIMARY KEY (`idLien`),
  ADD KEY `fk_image` (`idChoix`);

--
-- Index pour la table `Sondagelike`
--
ALTER TABLE `Sondagelike`
  ADD PRIMARY KEY (`idlike`),
  ADD KEY `fk_Sondagelike_idUtilisateur` (`idUtilisateur`),
  ADD KEY `fk_Sondagelike_idSondage` (`idSondage`);

--
-- Index pour la table `Sondages`
--
ALTER TABLE `Sondages`
  ADD PRIMARY KEY (`idSondage`),
  ADD KEY `fk_Sondages_Utilisateurs` (`Utilisateur`);

--
-- Index pour la table `SondageSuivant`
--
ALTER TABLE `SondageSuivant`
  ADD PRIMARY KEY (`idSondageSuivant`),
  ADD KEY `fk_SondageSuivant_Utilisateurs` (`idUtilisateur`),
  ADD KEY `fk_SondageSuivant_IdSondage` (`idSondage`);

--
-- Index pour la table `SousCommentaires`
--
ALTER TABLE `SousCommentaires`
  ADD PRIMARY KEY (`idsouscommentaire`),
  ADD KEY `fk_SousCommentaires_	idUtilisateur` (`idUtilisateur`),
  ADD KEY `fk_SousCommentaires_idcommentaire` (`idcommentaire`);

--
-- Index pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Choix`
--
ALTER TABLE `Choix`
  MODIFY `idChoix` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11251;
--
-- AUTO_INCREMENT pour la table `Commentairelike`
--
ALTER TABLE `Commentairelike`
  MODIFY `idlike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT pour la table `Commentaires`
--
ALTER TABLE `Commentaires`
  MODIFY `idcommentaire` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire', AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du message', AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT pour la table `Reponses`
--
ALTER TABLE `Reponses`
  MODIFY `idReponse` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29780;
--
-- AUTO_INCREMENT pour la table `sondageImage`
--
ALTER TABLE `sondageImage`
  MODIFY `idLien` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT pour la table `Sondagelike`
--
ALTER TABLE `Sondagelike`
  MODIFY `idlike` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;
--
-- AUTO_INCREMENT pour la table `Sondages`
--
ALTER TABLE `Sondages`
  MODIFY `idSondage` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11036;
--
-- AUTO_INCREMENT pour la table `SondageSuivant`
--
ALTER TABLE `SondageSuivant`
  MODIFY `idSondageSuivant` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1612;
--
-- AUTO_INCREMENT pour la table `SousCommentaires`
--
ALTER TABLE `SousCommentaires`
  MODIFY `idsouscommentaire` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `idUtilisateur` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ami`
--
ALTER TABLE `ami`
  ADD CONSTRAINT `ami_ibfk_1` FOREIGN KEY (`idUtilisateur1`) REFERENCES `Utilisateurs` (`idUtilisateur`),
  ADD CONSTRAINT `ami_ibfk_2` FOREIGN KEY (`idUtilisateur2`) REFERENCES `Utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `Choix`
--
ALTER TABLE `Choix`
  ADD CONSTRAINT `idsondage` FOREIGN KEY (`Sondage`) REFERENCES `Sondages` (`idSondage`);

--
-- Contraintes pour la table `Commentairelike`
--
ALTER TABLE `Commentairelike`
  ADD CONSTRAINT `idcommlike` FOREIGN KEY (`idCommentaire`) REFERENCES `Commentaires` (`idcommentaire`) ON DELETE CASCADE,
  ADD CONSTRAINT `idusercomlike` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateurs` (`idUtilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Commentaires`
--
ALTER TABLE `Commentaires`
  ADD CONSTRAINT `idsondagecommentaire` FOREIGN KEY (`idSondage`) REFERENCES `Sondages` (`idSondage`),
  ADD CONSTRAINT `idusercommentaire` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `MembreConversation`
--
ALTER TABLE `MembreConversation`
  ADD CONSTRAINT `idConv` FOREIGN KEY (`idConv`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idMembre` FOREIGN KEY (`idMembre`) REFERENCES `Utilisateurs` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `idAuteur` FOREIGN KEY (`idAuteur`) REFERENCES `Utilisateurs` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idMessage` FOREIGN KEY (`idConversation`) REFERENCES `conversations` (`id`);

--
-- Contraintes pour la table `Reponses`
--
ALTER TABLE `Reponses`
  ADD CONSTRAINT `fk_Reponses_Choix` FOREIGN KEY (`idChoix`) REFERENCES `Choix` (`idChoix`),
  ADD CONSTRAINT `fk_Reponses_Sondages` FOREIGN KEY (`sondage`) REFERENCES `Sondages` (`idSondage`),
  ADD CONSTRAINT `fk_Reponses_Utilisateurs` FOREIGN KEY (`utilisateur`) REFERENCES `Utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `sondageImage`
--
ALTER TABLE `sondageImage`
  ADD CONSTRAINT `fk_image` FOREIGN KEY (`idChoix`) REFERENCES `Choix` (`idChoix`);

--
-- Contraintes pour la table `Sondagelike`
--
ALTER TABLE `Sondagelike`
  ADD CONSTRAINT `idsondagelike` FOREIGN KEY (`idSondage`) REFERENCES `Sondages` (`idSondage`),
  ADD CONSTRAINT `idutilisateurlike` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `Sondages`
--
ALTER TABLE `Sondages`
  ADD CONSTRAINT `fk_Sondages_Utilisateurs` FOREIGN KEY (`Utilisateur`) REFERENCES `Utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `SondageSuivant`
--
ALTER TABLE `SondageSuivant`
  ADD CONSTRAINT `sondagesuivant-iduser` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateurs` (`idUtilisateur`),
  ADD CONSTRAINT `sondagesuivantidsonsage` FOREIGN KEY (`idSondage`) REFERENCES `Sondages` (`idSondage`);

--
-- Contraintes pour la table `SousCommentaires`
--
ALTER TABLE `SousCommentaires`
  ADD CONSTRAINT `souscommentaireidcommentaire` FOREIGN KEY (`idcommentaire`) REFERENCES `Commentaires` (`idcommentaire`) ON DELETE CASCADE,
  ADD CONSTRAINT `souscommentaireiduser` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateurs` (`idUtilisateur`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
