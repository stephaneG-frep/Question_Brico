-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 29 sep. 2025 à 10:52
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `questionbrico`
--

-- --------------------------------------------------------

--
-- Structure de la table `astuce`
--

CREATE TABLE `astuce` (
  `id_astuce` int(11) NOT NULL,
  `astuce` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `image_1` varchar(255) NOT NULL,
  `image_2` varchar(255) NOT NULL,
  `image_3` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `astuce`
--

INSERT INTO `astuce` (`id_astuce`, `astuce`, `date`, `image_1`, `image_2`, `image_3`, `id_user`) VALUES
(6, 'astuce avec l&#039;heure dedans', '', '0pFJ4c82q2A0KNNjCdRYrnHUA_eclogos.jpg', '0pFJ4c82q2A0KNNjCdRYrnHUA_han_solo.jpg', '0pFJ4c82q2A0KNNjCdRYrnHUA_homer.jpg', 14),
(7, 'une astuce avec la date dedans mais pas en date time', '12/09/2025', 'KsJHgitKzuge4ODwDyx2Zb6QD_A4.jpg', 'KsJHgitKzuge4ODwDyx2Zb6QD_cats.jpg', 'KsJHgitKzuge4ODwDyx2Zb6QD_ecolocar.jpg', 14);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_commentaire` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `commentaire` text NOT NULL,
  `etoile` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_commentaire`, `date`, `commentaire`, `etoile`, `id_user`) VALUES
(3, '', 'bon bien mais', 4, 8),
(4, '', 'uhsuxiazhxiuazjxiax', 2, 7),
(6, '', 'zxbzubzux iznxinixsn iznxisjxin izsnxizsnxzsnxzs jsxnzsns zsixnin\r\n', 5, 7),
(9, '', ' Now I have a machine gun. Ho-Ho-Ho »... Un tournant dans l\'histoire du cinéma d\'action. Piège de cristal confirme la virtuosité de John McTiernan, et son sens inné de la mise en scène, d\'une limpidité et d\'une évidence qui rappellent la maestria d\'un Hawks. Huis clos, suspense, violence, comédie, le film est un cocktail imparable, qui impose définitivement Bruce Willis au sommet du box-office, et révèle Alan Rickman, figure du théâtre anglais, génial en criminel allemand dans son premier rôle au cinéma.', 2, 14),
(10, '11/09/2025', 'peti commentaire maintenant ont peut metter une date ', 4, 14),
(11, '14 septembre 2025', 'ba lalalal zuzuz nenen trtrtr bdbdb xsb sjijcx zuchz ', 2, 14);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `theme` varchar(120) NOT NULL,
  `question` text NOT NULL,
  `image_1` varchar(255) NOT NULL,
  `image_2` varchar(255) NOT NULL,
  `image_3` varchar(255) NOT NULL,
  `image_4` varchar(255) NOT NULL,
  `image_5` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id_question`, `date`, `theme`, `question`, `image_1`, `image_2`, `image_3`, `image_4`, `image_5`, `id_user`) VALUES
(51, '', 'Peinture', 'udnbvubv zedznznczdn zebczdbczdbzdnc aduizanudazndza auzduzanduzinuzidn zijzidjziud', 'WmR5Y4nFYUXekLQpk6Q72w5yo_A2.jpg', 'WmR5Y4nFYUXekLQpk6Q72w5yo_amstrong.jpg', 'WmR5Y4nFYUXekLQpk6Q72w5yo_eclogos.jpg', 'WmR5Y4nFYUXekLQpk6Q72w5yo_ecolocar.jpg', 'WmR5Y4nFYUXekLQpk6Q72w5yo_homer.jpg', 8),
(52, '', 'Mecanique', ' Now I have a machine gun. Ho-Ho-Ho »... Un tournant dans l&#039;histoire du cinéma d&#039;action. Piège de cristal confirme la virtuosité de John McTiernan, et son sens inné de la mise en scène, d&#039;une limpidité et d&#039;une évidence qui rappellent la maestria d&#039;un Hawks. Huis clos, suspense, violence, comédie, le film est un cocktail imparable, qui impose définitivement Bruce Willis au sommet du box-office, et révèle Alan Rickman, figure du théâtre anglais, génial en criminel allemand dans son premier rôle au cinéma.', '9kG1hKLdH3ALrDrcbo1dgMYly_peter.jpg', '9kG1hKLdH3ALrDrcbo1dgMYly_han_solo.jpg', '9kG1hKLdH3ALrDrcbo1dgMYly_mcclane.jpg', '9kG1hKLdH3ALrDrcbo1dgMYly_luc.jpg', '9kG1hKLdH3ALrDrcbo1dgMYly_cats.jpg', 14),
(53, '', 'Pneumatique', ' Le chef du gouvernement se soumet lundi à un vote de confiance des députés, dont l&#039;issue risque de lui être fatale. Franceinfo revient sur ses 269 jours dans &quot;l&#039;enfer&quot; de Matignon, à travers quatre moments clés, entre motions de censure et affaire Bétharram.\r\n\r\nMême s&#039;il se trouve quelque ressemblance avec Richard Gere, c&#039;est plutôt Tom Cruise qu&#039;il faut convoquer avant d&#039;entamer le récit des 269 jours de François Bayrou comme Premier ministre. La mission impossible que le septuagénaire a acceptée est la suivante : trouver une stabilité politique, la plus durable possible, malgré l&#039;équation complexe issue des élections législatives anticipées de l&#039;été 2024, qui n&#039;ont permis', 'myL4dGJ9mxhyyzGtBMTCwmuzM_cats.jpg', 'myL4dGJ9mxhyyzGtBMTCwmuzM_ecolocar.jpg', 'myL4dGJ9mxhyyzGtBMTCwmuzM_mcclane.jpg', 'myL4dGJ9mxhyyzGtBMTCwmuzM_peter.jpg', 'myL4dGJ9mxhyyzGtBMTCwmuzM_chewe.jpg', 15);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id_reponse` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `reponse` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id_reponse`, `date`, `reponse`, `id_user`, `id_question`) VALUES
(30, '', 'uxhiusjxioajxzoaioajaokoaksoaksan ainiana aoisaisja aasan,as,aoaq niansiansaniasa  ainasnzasnasa kuinina', 5, 51),
(31, '', 'Chewbacca est un personnage de Star Wars. Légendaire guerrier Wookiee et copilote du Faucon Millenium aux côtés du légendaire contrebandier Han Solo, Chewbacca fait partie du noyau de rebelles qui ont restauré la liberté dans la galaxie. Connu pour se mettre très facilement en colère et pour sa précision à l\'arbalète, Chewbacca a aussi un grand cœur et fait preuve d\'une loyauté indéfectible envers ses amis. Chewbacca est joué par Peter Mayhew dans les épisodes IV (1977), V (1980), VI (1983), et III (2005). Joonas Suotamo partage le rôle avec Peter pour l\'épisode VII (2015) puis le reprend totalement pour l\'épisode VIII (2017), le spin-off Solo: A Star Wars Story (2018) et l\'épisode IX (2019) [5]. ', 16, 52),
(32, '', 'cxndic jbducxbneduxcne zuuxnucxned zxuizhciuzejncied iuxczunchuhcnencncieanceacd cejc caeduiucjeaijnc cxjeuncun zuzhcz zuhuhz z\r\nuzhxuhuzhxuszhczs uxuzsnu zbzz_xhsz_ zcbnz_jz_ jçjçjé xizjxzjxz zuxnczn', 14, 51),
(34, '', 'xhu uxuxzun xuxbuzn zunuznz zuszunuz zxuzuzn uznsunzunznz zsz zunzunzjxnjz', 7, 53),
(36, '12/09/2025', 'bla udzhuzhdx zunxuzhdxz xizxuiçzjxz iznizjxizanxuznauxnx zjnzuixn', 14, 53),
(37, '12/09/2025', 'udhxuzehxzux zuxbubuzxuz uuue uuhuhhsx zxbzzuxh zucxhbzb zuuzbcdbcd', 14, 53),
(38, '13/09/2025', 'zéhx_z zxuzuxhzuxhjz ziuxnzuxjzuxj xuzxuzjxz zxnzuxznuxnzx ixznx  xjz zuxnunxs', 14, 51);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo_profil` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'NOT NULL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom`, `prenom`, `email`, `password`, `photo_profil`, `role`) VALUES
(5, 'Simpson', 'Homer', 'simpson@homer.com', '$2y$10$91WxOaHkbsR0CMkQYlKzDuGwO.yuczavOxiyQpfPopxf4sFDiQF3C', 'P3WAGASC7lmIhGzlzivfltGK3_homer.jpg', 'moderateur'),
(7, 'Parker', 'Peter', 'peter@parker.com', '$2y$10$Lo8U3B5WtwIaNC1NKYOViO/4Ib9r3oqPqWFd9X0cAY3ODW24/am.6', 'oZDNb1p0WNejAi3zw5pVnUoEA_peter.jpg', 'user'),
(8, 'Solo', 'Han', 'solo@han.com', '$2y$10$/8gTU9s28bg8RsVb6ndVyuvoi7wFKFNsc2tJalDJaR.VeoHQkqFxu', 'T4m75gfrbLw0yk0j7JM8HUkHD_han_solo.jpg', 'user'),
(14, 'McCLane', 'John', 'mcclane@john.com', '$2y$10$b.FH.3e3OK.KNr0JliGkreaQGwDAtRv8GBLGyw6peXM6avSAzFL9y', '3Q5ndnSKh6smRlMwLl1cTsy0T_mcclane.jpg', 'admin'),
(15, 'cucu', 'lapraline', 'exemple@test.com', '$2y$10$txlMmaejoWR7UgBULWpxRerPCBbP2pD9.MemuFUvCgwe6IKdV94y.', 'avatar_default.jpg', 'user'),
(16, 'Chubba', 'Kha', 'chubba@kha.com', '$2y$10$S.yvu7iTvu9.GC1jBDCxmemw8aN6WsscNgOq/oCosKe7Lj5E72MaO', 'xHEfLXP2iwcir9xnpjT5HFkrY_chewe.jpg', 'moderateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `astuce`
--
ALTER TABLE `astuce`
  ADD PRIMARY KEY (`id_astuce`),
  ADD KEY `Etrangere` (`id_user`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `Etrangere` (`id_user`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `Etrangère` (`id_user`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id_reponse`),
  ADD KEY `Eyrangère` (`id_user`),
  ADD KEY `reponseQuestion` (`id_question`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `astuce`
--
ALTER TABLE `astuce`
  MODIFY `id_astuce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id_reponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `astuce`
--
ALTER TABLE `astuce`
  ADD CONSTRAINT `AstuceUser` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `CommentaireUser` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `userQuestion` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponseQuestion` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reponseUser` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
