-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 20 fév. 2019 à 00:33
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion_reunions`
--

-- --------------------------------------------------------

--
-- Structure de la table `connexions`
--

DROP TABLE IF EXISTS `connexions`;
CREATE TABLE IF NOT EXISTS `connexions` (
  `courriel` varchar(64) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `cle` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`courriel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `connexions`
--

INSERT INTO `connexions` (`courriel`, `date`, `cle`) VALUES
('axel@gmail.com', '2019-02-19 19:24:22', ''),
('hugues@hotmail.com', '2019-02-19 19:18:18', ''),
('bob@gmail.com', '2019-02-19 18:46:15', ''),
('jean@gmail.com', '2019-02-19 19:24:45', '');

-- --------------------------------------------------------

--
-- Structure de la table `dossiers`
--

DROP TABLE IF EXISTS `dossiers`;
CREATE TABLE IF NOT EXISTS `dossiers` (
  `dossierid` int(8) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`dossierid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `dossiers`
--

INSERT INTO `dossiers` (`dossierid`, `nom`, `description`) VALUES
(1, 'Lorem ipsum', '<div>Etiam interdum laoreet odio. Mauris elementum id nisl non elementum. Nullam eu risus in ex lacinia auctor ut eget erat. Vestibulum mollis fringilla sapien vestibulum volutpat. Nam eget odio libero. Nullam id nisi quis urna aliquam sodales. Nam sed metus risus.</div>'),
(2, 'In dictum', '<div>Duis rutrum ex malesuada lacus commodo vestibulum. Etiam consequat ante vel augue fringilla, vel blandit ex hendrerit. Donec molestie interdum maximus. Proin imperdiet, risus at rhoncus pharetra, nulla magna elementum sem, pretium accumsan libero est quis tellus. Aenean venenatis risus quis sem fringilla placerat. Nullam rhoncus orci eu interdum tincidunt.</div>');

-- --------------------------------------------------------

--
-- Structure de la table `invitation`
--

DROP TABLE IF EXISTS `invitation`;
CREATE TABLE IF NOT EXISTS `invitation` (
  `courriel` varchar(64) COLLATE utf8_bin NOT NULL,
  `cle` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`courriel`),
  UNIQUE KEY `cle` (`cle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `invitation`
--

INSERT INTO `invitation` (`courriel`, `cle`) VALUES
('paul@gmail.com', '37a4306c9799dcb854de9b7b211403f295c154110331b764d41cf23efaf8a306'),
('test@test.com', 'cd23a299977ce4be061b06aaa5199668e55b4dd23f9886b105dbbec26ae6e58f');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `auteur` varchar(64) COLLATE utf8_bin NOT NULL,
  `destinataire` varchar(64) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `vue` tinyint(1) NOT NULL,
  PRIMARY KEY (`auteur`,`destinataire`,`date`),
  KEY `FK_messages__destinataire` (`destinataire`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `participations`
--

DROP TABLE IF EXISTS `participations`;
CREATE TABLE IF NOT EXISTS `participations` (
  `reunionid` int(8) NOT NULL,
  `courriel` varchar(64) COLLATE utf8_bin NOT NULL,
  `statutid` varchar(8) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`reunionid`,`courriel`),
  KEY `FK_participations__courriel` (`courriel`),
  KEY `FK_participations__statutid` (`statutid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `participations`
--

INSERT INTO `participations` (`reunionid`, `courriel`, `statutid`) VALUES
(10, 'tnathan@yahoo.com', 'Ann'),
(10, 'btommy@outlook.com', 'Ann'),
(10, 'axel@gmail.com', 'Org'),
(9, 'vjustine@gmail.com', 'Pres'),
(9, 'brose@hotmail.com', 'Pres'),
(14, 'hugues@hotmail.com', 'Abs'),
(9, 'gmichaël@live.com', 'Pres'),
(14, 'ramélie@live.com', 'Abs'),
(9, 'médouard@yahoo.com', 'EnAt'),
(9, 'lflorence@live.com', 'EnAt'),
(9, 'axel@gmail.com', 'Org'),
(10, 'rmia@live.com', 'Ann'),
(10, 'llogan@outlook.com', 'Ann'),
(10, 'dcatherine@yahoo.com', 'Ann'),
(11, 'axel@gmail.com', 'Org'),
(11, 'lflorence@live.com', 'Pres'),
(11, 'dcharlotte@yahoo.com', 'Pres'),
(11, 'tantoine@gmail.com', 'Pres'),
(11, 'brose@hotmail.com', 'Pres'),
(11, 'dtristan@yahoo.com', 'Pres'),
(11, 'hmichaël@yahoo.com', 'Abs'),
(11, 'llogan@outlook.com', 'Abs'),
(12, 'axel@gmail.com', 'Org'),
(13, 'axel@gmail.com', 'Org'),
(14, 'axel@gmail.com', 'Org'),
(15, 'axel@gmail.com', 'Org'),
(14, 'gmichaël@live.com', 'Abs'),
(14, 'ttristan@live.com', 'Abs'),
(14, 'cnathan@gmail.com', 'Abs'),
(16, 'axel@gmail.com', 'Org'),
(16, 'hugues@hotmail.com', 'Ann'),
(16, 'rthomas@live.com', 'Ann'),
(16, 'cétienne@yahoo.com', 'Ann'),
(16, 'médouard@yahoo.com', 'Ann'),
(16, 'gmichaël@live.com', 'Ann'),
(16, 'tantoine@gmail.com', 'Ann'),
(17, 'jean@gmail.com', 'Org');

-- --------------------------------------------------------

--
-- Structure de la table `participationstatut`
--

DROP TABLE IF EXISTS `participationstatut`;
CREATE TABLE IF NOT EXISTS `participationstatut` (
  `statutid` varchar(8) COLLATE utf8_bin NOT NULL,
  `nom` varchar(64) COLLATE utf8_bin NOT NULL,
  `description` varchar(512) COLLATE utf8_bin NOT NULL,
  `ordre` int(11) NOT NULL,
  PRIMARY KEY (`statutid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `participationstatut`
--

INSERT INTO `participationstatut` (`statutid`, `nom`, `description`, `ordre`) VALUES
('Abs', 'Absent', 'La personne invitee va etre absente.', 4),
('Ann', 'Annulée', 'La réunion ou l\'invitation a ete annulée.', 8),
('EnAt', 'En Attente', 'En attente d\'une reponse de la personne invitee.', 6),
('Hes', 'Hesitant', 'La personne invitee ne sait pas si elle va etre presente.', 3),
('Pres', 'Present', 'La personne invitee va etre presente.', 2),
('Term', 'Terminée', 'La réunion est terminee.', 7),
('Org', 'Organisateur', 'Organisateur de la réunion.', 1),
('Ave', 'À venire', 'Réunion à venir', 0),
('Ret', 'Retard', 'La reunion a pris du retard', 5);

-- --------------------------------------------------------

--
-- Structure de la table `pointdordres`
--

DROP TABLE IF EXISTS `pointdordres`;
CREATE TABLE IF NOT EXISTS `pointdordres` (
  `pointdordreid` int(8) NOT NULL AUTO_INCREMENT,
  `reunionid` int(8) NOT NULL,
  `titre` varchar(64) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `dossierid` int(8) DEFAULT NULL,
  `compterendu` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`pointdordreid`),
  KEY `FK_pointdordres__reunionid` (`reunionid`),
  KEY `FK_pointdordres__dossierid` (`dossierid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `pointdordres`
--

INSERT INTO `pointdordres` (`pointdordreid`, `reunionid`, `titre`, `description`, `dossierid`, `compterendu`) VALUES
(5, 10, 'Aenean iaculis', '<div>Etiam interdum laoreet odio. Mauris elementum id nisl non elementum. Nullam eu risus in ex lacinia auctor ut eget erat. Vestibulum mollis fringilla sapien vestibulum volutpat. Nam eget odio libero. Nullam id nisi quis urna aliquam sodales. Nam sed metus risus.</div>', 1, '<div>Aenean iaculis, diam ac ullamcorper facilisis, risus orci dignissim nibh, ac suscipit risus enim non nibh. Quisque lectus augue, tempor id fermentum eu</div>'),
(6, 10, 'Vestibulum in odio', '<div>Suspendisse at porttitor diam. Quisque semper dui a arcu aliquet, a luctus odio tempus. Nam vehicula nec nulla nec consequat.<strong> Morbi quis lectus sed nunc rhoncus</strong> congue sed sit amet quam. Vivamus pellentesque massa odio. Donec cursus commodo ligula, vitae feugiat risus tincidunt at. Donec cursus vitae dolor eleifend molestie. Aenean scelerisque elementum tortor, aliquet pretium massa hendrerit vitae. Aenean mattis convallis felis, at ullamcorper quam gravida eget. Sed vehicula nibh vitae justo convallis ultricies.</div>', 1, ''),
(4, 9, 'Praesent vel enim eget', '<div>Vestibulum in odio eget nisi dignissim blandit id vel neque. Nulla vulputate varius sem sit amet ornare. Quisque nec massa sed nibh elementum finibus. Nullam id hendrerit dolor, in pretium arcu. Ut erat nisi, consectetur eu elementum id, ultrices ut ex. Integer auctor faucibus nisl id mattis. Suspendisse at porttitor diam. Quisque semper dui a arcu aliquet, a luctus odio tempus. Nam vehicula nec nulla nec consequat. Morbi quis lectus sed nunc rhoncus congue sed sit amet quam. Vivamus pellentesque massa odio. Donec cursus commodo ligula, vitae feugiat risus tincidunt at.</div>', 1, ''),
(3, 9, 'Lorem ipsum dolor sit amet', '<div>Pellentesque eget ipsum interdum, consectetur risus quis, pulvinar diam. Praesent bibendum sodales metus, suscipit tincidunt tortor rhoncus at. Integer in nunc sem.<br><br><strong>Proin velit elit:</strong></div><ul><li>Morbi a lacus vel sapien fermentum sollicitudin.</li><li>Nullam posuere leo vitae quam efficitur vehicula.</li><li>Sed scelerisque lacus non felis sollicitudin bibendum.</li></ul><div><br><br>Etiam sed libero ipsum. Etiam maximus dui sit amet neque imperdiet, sed dapibus arcu congue. Donec quis ex ex. Aliquam semper sit amet urna vestibulum accumsan. Pellentesque tempus non quam id facilisis. Pellentesque porta placerat euismod. Nulla a orci diam. Phasellus vel lobortis enim, auctor ornare leo.</div>', NULL, '<div>Aenean scelerisque elementum tortor, aliquet pretium massa hendrerit vitae. Aenean mattis convallis felis, at ullamcorper quam gravida eget. Sed vehicula nibh vitae justo convallis ultricies.</div>'),
(7, 11, 'Curabitur sit amet', '<div>Sed ac erat ultricies, aliquam turpis et, tempor sapien. In eget libero nunc. Curabitur efficitur ut dui et venenatis. In in euismod massa. <strong>Quisque </strong>aliquet sem felis, sed aliquam est blandit nec. Nam pretium velit et ante ultrices tristique. Etiam id vehicula enim.<br><br></div><div><strong>Donec posuere risus</strong></div><ul><li>Phasellus sit amet est eu ante consectetur imperdiet a non massa.</li><li>Aliquam ac metus eget mauris cursus accumsan ac a lorem.</li><li>Praesent tristique dolor et nunc accumsan laoreet.</li></ul>', 1, '<div>Sed vitae nulla efficitur, sodales tortor in, vestibulum ante. Nullam non eros tincidunt purus aliquet sagittis vel quis nibh. In ultrices, nunc id accumsan pulvinar, sapien ante dapibus libero, nec viverra risus orci ut leo. Vestibulum accumsan metus eget pulvinar ultricies. Duis cursus lectus et tortor imperdiet, nec aliquet orci vestibulum.&nbsp;</div>'),
(8, 11, 'Nam consequat', '<div>Integer vel elit eleifend, rutrum quam eget, pharetra nulla. Quisque at nisi non sapien fermentum luctus sed nec arcu. Etiam eu facilisis nisl. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti. Phasellus porta lectus neque, sed vulputate nisi pharetra varius.</div>', NULL, '<div>Nunc at nulla mollis, placerat massa vel, congue metus. Nunc a tellus in ipsum faucibus posuere ac id libero. Nam elementum tincidunt mauris sed tincidunt.&nbsp;</div>'),
(9, 14, 'Nunc at nulla', '<ul><li>Cras dictum dolor non sapien elementum, in porttitor nisi mattis.</li><li>Sed sit amet nunc volutpat ante varius congue.</li><li>Duis sed nisl luctus, commodo nulla sit amet, hendrerit diam.</li><li>Vivamus sed ipsum scelerisque, varius eros eget, euismod est.</li><li>Nulla et orci malesuada, vehicula dolor ut, elementum lacus.</li><li>Quisque vestibulum purus ac cursus posuere.</li></ul><div><br></div>', 2, '<div>blbalbaà<br><br></div>'),
(10, 15, 'Vestibulum accumsan', '<div>Nulla nulla diam, faucibus vitae aliquet eu, tristique sed ipsum. Donec aliquam dolor quam, non interdum mauris fringilla nec. Aenean faucibus luctus molestie. Suspendisse sapien massa, sodales nec lobortis quis, blandit eu elit. Quisque ac ligula neque. Quisque sollicitudin gravida nibh vel egestas.</div>', NULL, '<div>Nulla nulla diam, faucibus vitae aliquet eu, tristique sed ipsum. Donec aliquam dolor quam, non interdum mauris fringilla nec. Aenean faucibus luctus molestie. Suspendisse sapien massa, sodales nec lobortis quis, blandit eu elit. Quisque ac ligula neque. Quisque sollicitudin gravida nibh vel egestas</div>'),
(11, 12, 'Presentation', '<h1>test</h1><div><strong>test</strong></div>', 2, '<div>blablabla</div>'),
(12, 16, 'tes 1', '<div>test</div>', NULL, '');

-- --------------------------------------------------------

--
-- Structure de la table `reunions`
--

DROP TABLE IF EXISTS `reunions`;
CREATE TABLE IF NOT EXISTS `reunions` (
  `reunionid` int(8) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `createur` varchar(64) COLLATE utf8_bin NOT NULL,
  `statut` varchar(8) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`reunionid`),
  KEY `FK_reunions__createur` (`createur`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `reunions`
--

INSERT INTO `reunions` (`reunionid`, `date`, `createur`, `statut`) VALUES
(15, '2019-02-18 10:00:00', 'axel@gmail.com', 'Term'),
(14, '2019-02-20 10:00:00', 'axel@gmail.com', 'Term'),
(13, '2019-02-18 12:00:00', 'axel@gmail.com', 'Ret'),
(12, '2019-02-19 20:00:00', 'axel@gmail.com', 'Term'),
(11, '2019-02-19 19:40:00', 'axel@gmail.com', 'Term'),
(10, '2019-02-20 16:50:00', 'axel@gmail.com', 'Ann'),
(9, '2019-02-19 18:00:00', 'axel@gmail.com', 'Ret'),
(16, '2019-02-22 00:00:00', 'axel@gmail.com', 'Ann'),
(17, '2019-02-21 10:10:00', 'jean@gmail.com', 'Ave');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `courriel` varchar(64) COLLATE utf8_bin NOT NULL,
  `nom` varchar(64) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(64) COLLATE utf8_bin NOT NULL,
  `motdepasse` varchar(256) COLLATE utf8_bin NOT NULL,
  `administrateur` tinyint(2) NOT NULL,
  PRIMARY KEY (`courriel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`courriel`, `nom`, `prenom`, `motdepasse`, `administrateur`) VALUES
('axel@gmail.com', 'Michaud', 'Axel', '$2y$10$ipYPGB9HWSlAIfwbNECdK.ghspVOK2QhQuXcQCtj6.izgx3TdVZRG', 2),
('hugues@hotmail.com', 'Roman', 'Hugues', '$2y$10$h410AxpOfVete5Eov3m31.HyArLQVKhgxrt1Rd1mxwhFLF5KxMvTW', 2),
('lflorence@live.com', 'Larouche', 'Florence', 'lflorence', 1),
('laudrey@yahoo.com', 'Landry', 'Audrey', 'laudrey', 0),
('jcamille@live.com', 'Jean', 'Camille', 'jcamille', 0),
('pmaika@yahoo.com', 'Proulx', 'Maika', 'pmaika', 0),
('banaïs@live.com', 'Bédard', 'Anaïs', 'banaïs', 0),
('rthomas@live.com', 'Rousseau', 'Thomas', 'rthomas', 0),
('ramélie@live.com', 'Richard', 'Amélie', 'ramélie', 0),
('bjuliette@hotmail.com', 'Bélanger', 'Juliette', 'bjuliette', 0),
('dcharlotte@yahoo.com', 'Deschênes', 'Charlotte', 'dcharlotte', 0),
('ganthony@outlook.com', 'Gagnon', 'Anthony', 'ganthony', 0),
('pphilippe@gmail.com', 'Paquette', 'Philippe', 'pphilippe', 0),
('btommy@outlook.com', 'Blais', 'Tommy', 'btommy', 0),
('cétienne@yahoo.com', 'Charbonneau', 'Étienne', 'cétienne', 0),
('médouard@yahoo.com', 'Martel', 'Édouard', 'médouard', 0),
('gmichaël@live.com', 'Girard', 'Michaël', 'gmichaël', 0),
('tantoine@gmail.com', 'Thériault', 'Antoine', 'tantoine', 0),
('ttristan@live.com', 'Thibault', 'Tristan', 'ttristan', 0),
('mcoralie@gmail.com', 'Michaud', 'Coralie', 'mcoralie', 0),
('nnicolas@yahoo.com', 'Nadeau', 'Nicolas', 'nnicolas', 0),
('flogan@outlook.com', 'Fortin', 'Logan', 'flogan', 0),
('tnathan@yahoo.com', 'Thériault', 'Nathan', 'tnathan', 0),
('bève@hotmail.com', 'Bélanger', 'Ève', 'bève', 0),
('brose@hotmail.com', 'Beaulieu', 'Rose', 'brose', 0),
('délodie@outlook.com', 'Desjardins', 'Élodie', 'délodie', 0),
('lcharlotte@live.com', 'Larouche', 'Charlotte', 'lcharlotte', 0),
('pdaphnée@gmail.com', 'Poulin', 'Daphnée', 'pdaphnée', 0),
('bmégan@hotmail.com', 'Blanchette', 'Mégan', 'bmégan', 0),
('vjustine@gmail.com', 'Villeneuve', 'Justine', 'vjustine', 0),
('ganthony@yahoo.com', 'Gosselin', 'Anthony', 'ganthony', 0),
('bnoémie@outlook.com', 'Bouchard', 'Noémie', 'bnoémie', 0),
('aalexia@gmail.com', 'Audet', 'Alexia', 'aalexia', 0),
('bchristopher@outlook.com', 'Boucher', 'Christopher', 'bchristopher', 0),
('rmia@live.com', 'Raymond', 'Mia', 'rmia', 0),
('carianne@outlook.com', 'Couture', 'Arianne', 'carianne', 0),
('témile@outlook.com', 'Thériault', 'Émile', 'témile', 0),
('ralicia@hotmail.com', 'Raymond', 'Alicia', 'ralicia', 0),
('cdelphine@outlook.com', 'Champagne', 'Delphine', 'cdelphine', 0),
('lmégan@hotmail.com', 'Lachance', 'Mégan', 'lmégan', 0),
('nalexia@yahoo.com', 'Nadeau', 'Alexia', 'nalexia', 0),
('dtristan@yahoo.com', 'Dupuis', 'Tristan', 'dtristan', 0),
('hmichaël@yahoo.com', 'Houle', 'Michaël', 'hmichaël', 0),
('llogan@outlook.com', 'Leblanc', 'Logan', 'llogan', 0),
('cnathan@gmail.com', 'Caron', 'Nathan', 'cnathan', 0),
('bmaélie@live.com', 'Boisvert', 'Maélie', 'bmaélie', 0),
('dlogan@live.com', 'Dubois', 'Logan', 'dlogan', 0),
('bchristopher@live.com', 'Bouchard', 'Christopher', 'bchristopher', 0),
('rsarah@outlook.com', 'Robert', 'Sarah', 'rsarah', 0),
('ldylan@hotmail.com', 'Leclerc', 'Dylan', 'ldylan', 0),
('rguillaume@outlook.com', 'Rousseau', 'Guillaume', 'rguillaume', 0),
('hcoralie@gmail.com', 'Houle', 'Coralie', 'hcoralie', 0),
('llaurence@yahoo.com', 'Larouche', 'Laurence', 'llaurence', 0),
('lchristopher@yahoo.com', 'Lévesque', 'Christopher', 'lchristopher', 0),
('panthony@outlook.com', 'Paquette', 'Anthony', 'panthony', 0),
('dcatherine@yahoo.com', 'Dubois', 'Catherine', 'dcatherine', 0),
('telizabeth@yahoo.com', 'Turcotte', 'Elizabeth', 'telizabeth', 0),
('lmalik@yahoo.com', 'Landry', 'Malik', 'lmalik', 0),
('amaude@live.com', 'Arsenault', 'Maude', 'amaude', 0),
('lcatherine@live.com', 'Lemieux', 'Catherine', 'lcatherine', 0),
('pvictor@gmail.com', 'Proulx', 'Victor', 'pvictor', 0),
('lève@outlook.com', 'Lessard', 'Ève', 'lève', 0),
('frosalie@hotmail.com', 'Fournier', 'Rosalie', 'frosalie', 0),
('démilie@outlook.com', 'Demers', 'Émilie', 'démilie', 0),
('golivier@gmail.com', 'Gagné', 'Olivier', 'golivier', 0),
('pantoine@live.com', 'Paquette', 'Antoine', 'pantoine', 0),
('rléanne@yahoo.com', 'Rousseau', 'Léanne', 'rléanne', 0),
('gmaya@hotmail.com', 'Gosselin', 'Maya', 'gmaya', 0),
('balexia@live.com', 'Bédard', 'Alexia', 'balexia', 0),
('hdelphine@live.com', 'Hébert', 'Delphine', 'hdelphine', 0),
('ccoralie@live.com', 'Cloutier', 'Coralie', 'ccoralie', 0),
('lvictor@live.com', 'Lachance', 'Victor', 'lvictor', 0),
('pgabriel@outlook.com', 'Pelletier', 'Gabriel', 'pgabriel', 0),
('lolivia@gmail.com', 'Lemieux', 'Olivia', 'lolivia', 0),
('gnoémie@hotmail.com', 'Gauthier', 'Noémie', 'gnoémie', 0),
('cmaya@outlook.com', 'Caron', 'Maya', 'cmaya', 0),
('aalexandre@gmail.com', 'Arsenault', 'Alexandre', 'aalexandre', 0),
('bemma@hotmail.com', 'Bergeron', 'Emma', 'bemma', 0),
('rcharles@live.com', 'Robert', 'Charles', 'rcharles', 0),
('pléanne@hotmail.com', 'Perron', 'Léanne', 'pléanne', 0),
('gjade@live.com', 'Gagnon', 'Jade', 'gjade', 0),
('cdaphnée@gmail.com', 'Caron', 'Daphnée', 'cdaphnée', 0),
('gfélix@gmail.com', 'Giroux', 'Félix', 'gfélix', 0),
('aléo@hotmail.com', 'Arsenault', 'Léo', 'aléo', 0),
('holivier@hotmail.com', 'Hébert', 'Olivier', 'holivier', 0),
('cadam@outlook.com', 'Cloutier', 'Adam', 'cadam', 0),
('lfélix@live.com', 'Lavoie', 'Félix', 'lfélix', 0),
('gflorence@live.com', 'Grenier', 'Florence', 'gflorence', 0),
('calicia@gmail.com', 'Cloutier', 'Alicia', 'calicia', 0),
('bléa@outlook.com', 'Boisvert', 'Léa', 'bléa', 0),
('lmaéva@outlook.com', 'Lemay', 'Maéva', 'lmaéva', 0),
('dalexia@live.com', 'Dion', 'Alexia', 'dalexia', 0),
('nnoah@outlook.com', 'Nadeau', 'Noah', 'nnoah', 0),
('cphilippe@hotmail.com', 'Côté', 'Philippe', 'cphilippe', 0),
('bphilippe@live.com', 'Bergeron', 'Philippe', 'bphilippe', 0),
('balice@live.com', 'Boivin', 'Alice', 'balice', 0),
('dalex@gmail.com', 'Desjardins', 'Alex', 'dalex', 0),
('dnoémie@live.com', 'Dion', 'Noémie', 'dnoémie', 0),
('cjonathan@live.com', 'Caron', 'Jonathan', 'cjonathan', 0),
('bjustin@hotmail.com', 'Beaudoin', 'Justin', 'bjustin', 0),
('gemy@gmail.com', 'Gosselin', 'Emy', 'gemy', 0),
('lnathan@outlook.com', 'Leclerc', 'Nathan', 'lnathan', 0),
('bob@gmail.com', 'Bob', 'Machin', '$2y$10$iFMV03pt3Ge9bo5bYQIpguyf7ECxec1jZpubVg5i90BRVeQkTHnaO', 0),
('jean@gmail.com', 'Jean', 'Truc', '$2y$10$7c4V9a5mAeg1.PZBZcJQzu9v2vpXGzJavjv0SIsWPB9xZdckaQr8a', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
