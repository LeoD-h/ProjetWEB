-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 06, 2024 at 02:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Projet_WEB`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatmessages`
--

CREATE TABLE `chatmessages` (
  `MessageID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `Contenu_du_message` text NOT NULL,
  `Date_et_heure_du_message` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `TenueID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatmessages`
--

INSERT INTO `chatmessages` (`MessageID`, `id`, `Contenu_du_message`, `Date_et_heure_du_message`, `TenueID`) VALUES
(1, 1, 'OMG Incroyable la tenue', '2024-04-30 22:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `Id` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `Theme` varchar(255) DEFAULT NULL,
  `UserID1` int(11) NOT NULL,
  `UserID2` int(11) NOT NULL,
  `idtenue` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`Id`, `active`, `Theme`, `UserID1`, `UserID2`, `idtenue`) VALUES
(1, 1, 'Ventes', 1, 2, 1),
(2, 1, 'Prout', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `criterevetements`
--

CREATE TABLE `criterevetements` (
  `CritereID` int(11) NOT NULL,
  `Choix_moment` int(11) DEFAULT NULL,
  `Choix_Saison` int(11) DEFAULT NULL,
  `Note_chaud` int(11) DEFAULT NULL,
  `Zoner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criterevetements`
--

INSERT INTO `criterevetements` (`CritereID`, `Choix_moment`, `Choix_Saison`, `Note_chaud`, `Zoner`) VALUES
(11, 4, 10, 10, 'tete'),
(12, 4, 10, 10, 'tete'),
(13, 4, 10, 10, 'tete'),
(14, 4, 10, 10, 'tete'),
(15, 4, 10, 10, 'tete'),
(16, 1, 10, 10, 'tete'),
(17, 1, 10, 10, 'tete'),
(18, 1, 10, 10, 'tete'),
(19, 4, 10, 10, 'tete'),
(20, 4, 10, 10, 'tete');

-- --------------------------------------------------------

--
-- Table structure for table `famille_vetement`
--

CREATE TABLE `famille_vetement` (
  `Id_famille` int(11) NOT NULL,
  `Rate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `famille_vetement`
--

INSERT INTO `famille_vetement` (`Id_famille`, `Rate`) VALUES
(29, 10),
(30, 10);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `Id` int(11) NOT NULL,
  `IdConv` int(11) DEFAULT NULL,
  `IdAuteur` int(11) DEFAULT NULL,
  `Contenu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`Id`, `IdConv`, `IdAuteur`, `Contenu`) VALUES
(1, 1, 1, 'VENTE 2'),
(2, 1, 2, 'Test12'),
(3, 1, 2, 'test'),
(4, 1, 2, 'ddz'),
(5, 1, 2, 'azdaz'),
(6, 1, 2, 'test12'),
(7, 1, 2, 'dz'),
(8, 2, 2, 'rte'),
(9, 1, 2, 'dz'),
(10, 1, 2, 'azf'),
(11, 1, 2, 'dz'),
(12, 1, 2, 'dz'),
(13, 1, 2, 'azd');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `TenueID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `user_id`, `created_at`, `TenueID`) VALUES
(1, 'Leo XXX XXX', 'Magnifique PULL', 1, '2018-09-14 22:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tenuesrecommandees`
--

CREATE TABLE `tenuesrecommandees` (
  `TenueID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `VetementID` int(11) NOT NULL,
  `PrevisionID` int(11) NOT NULL,
  `Type_d_activite` varchar(255) NOT NULL,
  `Date_et_heure_de_la_recommandation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenuesrecommandees`
--

INSERT INTO `tenuesrecommandees` (`TenueID`, `id`, `VetementID`, `PrevisionID`, `Type_d_activite`, `Date_et_heure_de_la_recommandation`) VALUES
(1, 1, 1, -5, 'SPORT', '2024-04-30 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `Prépseudo` varchar(255) DEFAULT NULL,
  `passe` varchar(255) DEFAULT NULL,
  `Adresse_email` varchar(255) DEFAULT NULL,
  `Blacklist` tinyint(1) DEFAULT NULL,
  `Connecte` tinyint(1) DEFAULT NULL,
  `Admin` varchar(255) DEFAULT NULL,
  `Autres_informations_utilisateur` text DEFAULT NULL,
  `Langue` varchar(255) DEFAULT NULL,
  `Ville` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `Prépseudo`, `passe`, `Adresse_email`, `Blacklist`, `Connecte`, `Admin`, `Autres_informations_utilisateur`, `Langue`, `Ville`) VALUES
(1, 'Duquenne', 'Léo', 'leo123', 'leo@gmail.com', 0, 0, '1', 'Je suis fan de mode', 'Fr', 'Paris'),
(2, 'Kilian', 'Breviere Kilian', 'Kilian123', 'kilianbreviere@gmail.com', 0, 0, '1', 'Wahoo', 'Fr', 'Lens');

-- --------------------------------------------------------

--
-- Table structure for table `vetements`
--

CREATE TABLE `vetements` (
  `VetementID` int(11) NOT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `Type_de_vetement` varchar(255) DEFAULT NULL,
  `Couleur` varchar(255) DEFAULT NULL,
  `Marque` varchar(255) DEFAULT NULL,
  `Prix` decimal(10,2) DEFAULT NULL,
  `Photo` blob DEFAULT NULL,
  `Id_famille` int(11) DEFAULT NULL,
  `IDCritere` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vetements`
--

INSERT INTO `vetements` (`VetementID`, `pseudo`, `Type_de_vetement`, `Couleur`, `Marque`, `Prix`, `Photo`, `Id_famille`, `IDCritere`, `id`) VALUES
(1, 'Pull Nike', 'Pull', 'Vert', 'Nike', 9.00, NULL, 3, 1, 1),
(11, 'a', 'za', 'a', 'a', 1.00, NULL, 29, 11, 1),
(12, 'b', 'b', 'b', 'b', 2.00, NULL, 29, 12, 1),
(13, 'c', 'c', 'c', 'c', 4.00, NULL, 29, 13, 1),
(14, 't', 't', 't', 't', 8.00, NULL, 29, 14, 1),
(15, 'i', 'i', 'i', 'i', 9.00, NULL, 29, 15, 1),
(16, 'o', 'o', 'o', 'o', 9.00, NULL, 30, 16, 1),
(17, 'k', 'k', 'k', 'k', 8.00, NULL, 30, 17, 1),
(18, 'y', 'y', 'y', 'y', 8.00, NULL, 30, 18, 1),
(19, 'p', 'p', 'p', 'p', 8.00, NULL, 30, 19, 1),
(20, 'i', 'i', 'i', 'i', 8.00, NULL, 30, 20, 1);

--
-- Indexes for dumped tables
--

--
-- Index pour la table `chatmessages`
--
ALTER TABLE `chatmessages`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `id` (`id`),
  ADD KEY `TenueID` (`TenueID`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserID1` (`UserID1`),
  ADD KEY `UserID2` (`UserID2`),
  ADD KEY `idtenue` (`idtenue`);

--
-- Indexes for table `criterevetements`
--
ALTER TABLE `criterevetements`
  ADD PRIMARY KEY (`CritereID`);

--
-- Indexes for table `famille_vetement`
--
ALTER TABLE `famille_vetement`
  ADD PRIMARY KEY (`Id_famille`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdConv` (`IdConv`),
  ADD KEY `IdAuteur` (`IdAuteur`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `TenueID` (`TenueID`);

--
-- Indexes for table `tenuesrecommandees`
--
ALTER TABLE `tenuesrecommandees`
  ADD PRIMARY KEY (`TenueID`),
  ADD KEY `id` (`id`),
  ADD KEY `VetementID` (`VetementID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vetements`
--
ALTER TABLE `vetements`
  ADD PRIMARY KEY (`VetementID`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT pour la table `chatmessages`
--
ALTER TABLE `chatmessages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `criterevetements`
--
ALTER TABLE `criterevetements`
  MODIFY `CritereID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `famille_vetement`
--
ALTER TABLE `famille_vetement`
  MODIFY `Id_famille` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tenuesrecommandees`
--
ALTER TABLE `tenuesrecommandees`
  MODIFY `TenueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vetements`
--
ALTER TABLE `vetements`
  MODIFY `VetementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Contraintes pour la table `chatmessages`
--
ALTER TABLE `chatmessages`
  ADD CONSTRAINT `chatmessages_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chatmessages_ibfk_2` FOREIGN KEY (`TenueID`) REFERENCES `tenuesrecommandees` (`TenueID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`UserID1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversation_ibfk_2` FOREIGN KEY (`UserID2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversation_ibfk_3` FOREIGN KEY (`idtenue`) REFERENCES `tenuesrecommandees` (`TenueID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`IdConv`) REFERENCES `conversation` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`IdAuteur`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`TenueID`) REFERENCES `tenuesrecommandees` (`TenueID`);

--
-- Constraints for table `tenuesrecommandees`
--
ALTER TABLE `tenuesrecommandees`
  ADD CONSTRAINT `tenuesrecommandees_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tenuesrecommandees_ibfk_2` FOREIGN KEY (`VetementID`) REFERENCES `vetements` (`VetementID`);

--
-- Constraints for table `vetements`
--
ALTER TABLE `vetements`
  ADD CONSTRAINT `vetements_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
