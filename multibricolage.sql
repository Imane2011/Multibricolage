-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 16 juin 2025 à 23:42
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
-- Base de données : `multibricolage`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

CREATE TABLE `administrateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `id_adresse_admin` int(11) DEFAULT NULL,
  `date_creation` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `nom`, `prenom`, `email`, `motDePasse`, `telephone`, `id_adresse_admin`, `date_creation`) VALUES
(0, 'AMRI', 'Imane', 'amri@gmail.com', '$2y$10$PQ3YA8/D.019R5JqRaBBmePHTDkZYNo931pHTcYZm6y60niAImsoW', '0668264141', 5, '2025-06-12'),
(1, 'AMRI', 'Imane', 'amri.imane018@gmail.com', '$2y$10$eOG1J9msYU3eTSJjfzSNG.IJmFIE.I3gbm9Qgb5SHKYW/XFlFSkRi', '0668264141', 4, '2025-06-12');

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `id_adresse_admin` int(11) DEFAULT NULL,
  `date_creation` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `nom`, `prenom`, `email`, `motDePasse`, `telephone`, `id_adresse_admin`, `date_creation`) VALUES
(1, 'AMRI', 'imane', 'amri@gmail.com', '$2y$10$VwBQEBrQzRCpf6HgC7vvwOc2sH6pyJLRMx/mZXQC9z3JuYXjp76Xm', '0668264141', 6, '2025-06-12'),
(2, 'BOUMJAHED', 'Imy', 'amri.imane018@gmail.com', '$2y$10$QTwNo.Q4L8ULdrbGLWeuSe5/Dkra2C5iutxqAT7.Y9qRMrL9Atp.6', '0600000000', 7, '2025-06-12'),
(3, 'AMRI', 'imad', 'email@email.com', '$2y$10$qIL4uf20X1YTsIe33Dh3iujhYHdgFoZ0tW/EhjxcIJSpdpYrJIWXe', '0600000000', 8, '2025-06-12'),
(4, 'AMRI', 'imane', 'admin@multibricolage18.fr', '$2y$10$O/t7cPQp9pO1YWuTjbxoGOdeKwZLyqc3H2CZFEw90r0JPq0XGHwiK', '0668264141', 9, '2025-06-16');

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `id_adresse` int(11) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `code_postal` varchar(15) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adresses`
--

INSERT INTO `adresses` (`id_adresse`, `rue`, `code_postal`, `ville`, `pays`) VALUES
(1, '11 rue des dahlias', '18390', 'Saint-Germain-du-Puy', 'France'),
(2, '11 rue des dahlias', '18390', 'Saint-Germain-du-Puy', 'France'),
(3, '11 rue des dahlias', '18390', 'Saint-Germain-du-Puy', 'France'),
(4, '11 rue des dahlias', '18390', 'Saint-Germain-du-Puy', 'France'),
(5, 'somewhere', '18390', 'st germain', 'France'),
(6, '11 rue des dahlias', '18390', 'Saint-Germain-du-Puy', 'France'),
(7, 'somewhere', '18000', 'bourges', 'France'),
(8, 'adresse', '18000', 'Saint-Germain-du-Puy', 'France'),
(9, '11 rue des dahlias', '18390', 'Saint-Germain-du-Puy', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `id_adresse_client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id_client`, `nom`, `prenom`, `email`, `telephone`, `id_adresse_client`) VALUES
(1, 'AMRI', 'Imane', 'amri.imane018@gmail.com', '0668264141', 1),
(2, 'AMRI', 'Imane', 'amri.imane018@gmail.com', '0668264141', 2),
(3, 'BOUMJAHED AMRI', 'Imaneee', 'amri.imane018@gmail.com', '0600000000', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id_message` int(11) NOT NULL,
  `sujet` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `date_envoi` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id_message`, `sujet`, `message`, `client_id`, `date_envoi`) VALUES
(1, 'test contact', 'hello !!!', 3, '2025-06-12');

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

CREATE TABLE `devis` (
  `id_devis` int(11) NOT NULL,
  `services` enum('Plomberie','Électricité','Revêtement de sol','Montage de meubles','Tapisserie','Rénovation logement & Isolation','Clôture & aménagement exterieur') NOT NULL,
  `info_complementaire` text NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `date_envoi` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `devis`
--

INSERT INTO `devis` (`id_devis`, `services`, `info_complementaire`, `client_id`, `date_envoi`) VALUES
(1, '', 'Bonjour !!!', 1, '2025-06-12'),
(2, 'Montage de meubles', 'Bonjour  2 !!!', 2, '2025-06-12');

-- --------------------------------------------------------

--
-- Structure de la table `page_realisations`
--

CREATE TABLE `page_realisations` (
  `id_realisation` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `page_realisations`
--

INSERT INTO `page_realisations` (`id_realisation`, `image`, `admin_id`) VALUES
(4, 'assets/img/1 (1).webp', 1),
(5, 'assets/img/1 (9).webp', 1),
(6, 'assets/img/1 (2).webp', 1),
(7, 'assets/img/1 (8).webp', 1),
(8, 'assets/img/1 (3).webp', 1),
(9, 'assets/img/1 (10).webp', 1),
(10, 'assets/img/1 (6).webp', 1),
(11, 'assets/img/1 (4).webp', 1),
(12, 'assets/img/1 (5).webp', 1),
(13, 'assets/img/1 (7).webp', 1);

-- --------------------------------------------------------

--
-- Structure de la table `page_services`
--

CREATE TABLE `page_services` (
  `id_service` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `page_services`
--

INSERT INTO `page_services` (`id_service`, `titre`, `description`, `image`, `admin_id`) VALUES
(1, 'Électricité ', 'Nous réalisons tous vos travaux électriques, du simple dépannage à l’installation complète d’un réseau. Mise aux normes de tableaux électriques, remplacement d’appareillages, ajout de prises ou de points lumineux : chaque intervention est effectuée avec rigueur, en conformité avec les normes en vigueur. Nous assurons également le diagnostic de vos installations pour garantir votre sécurité et votre confort au quotidien.', 'assets/img/elect.webp', 2),
(2, ' Revêtement de sol ', 'Nous posons tous types de revêtements : carrelage, parquet, stratifié, vinyle ou lino. Que vous souhaitiez rénover une pièce ou repenser entièrement vos sols, nous vous conseillons dans le choix des matériaux adaptés à votre usage et à votre style. Le résultat : un sol esthétique, durable, et posé dans les règles de l’art.', 'assets/img/sol.webp', 1),
(3, 'Tapisserie & peinture', 'Offrez une nouvelle vie à vos murs avec nos services de peinture et de pose de tapisserie. Nous préparons les surfaces (ponçage, enduit, lissage) pour un rendu impeccable. Que vous préfériez une peinture mate, satinée ou une tapisserie à motifs, nous travaillons avec soin pour un intérieur harmonieux et personnalisé, du sol au plafond.', 'assets/img/tapisserie.webp', 3),
(4, 'Montage de meubles', 'Fini les notices compliquées ! Nous prenons en charge le montage de vos meubles, qu’ils soient en kit ou sur mesure. Armoires, bibliothèques, lits, cuisines ou mobilier professionnel : nous assurons un assemblage stable et sécurisé, directement chez vous, avec un souci du détail et une finition soignée.', 'assets/img/montage meuble.webp', 3),
(5, 'Rénovation de logement & isolation ', 'Nous vous accompagnons dans vos projets de rénovation intérieure, partielle ou complète. Travaux d’aménagement, redistribution des espaces, création de cloisons, isolation thermique ou phonique : chaque chantier est pensé pour améliorer votre confort, valoriser votre bien et optimiser vos consommations d’énergie.', 'assets/img/renovation.webp', 3),
(6, 'Clôture & aménagement extérieur', 'Sécurisez et valorisez vos espaces extérieurs avec la pose de clôtures adaptées à vos besoins : grillage souple ou rigide, panneaux occultants, clôtures en bois ou PVC. Nous proposons des solutions durables, esthétiques et installées avec précision pour préserver votre intimité tout en apportant du cachet à votre jardin ou votre terrain.', 'assets/img/cloture.webp', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_adresse_admin` (`id_adresse_admin`);

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_adresse_admin` (`id_adresse_admin`);

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id_adresse`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_client`),
  ADD KEY `id_adresse_client` (`id_adresse_client`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `devis`
--
ALTER TABLE `devis`
  ADD PRIMARY KEY (`id_devis`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `page_realisations`
--
ALTER TABLE `page_realisations`
  ADD PRIMARY KEY (`id_realisation`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Index pour la table `page_services`
--
ALTER TABLE `page_services`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id_adresse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `devis`
--
ALTER TABLE `devis`
  MODIFY `id_devis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `page_realisations`
--
ALTER TABLE `page_realisations`
  MODIFY `id_realisation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `page_services`
--
ALTER TABLE `page_services`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD CONSTRAINT `administrateurs_ibfk_1` FOREIGN KEY (`id_adresse_admin`) REFERENCES `adresses` (`id_adresse`);

--
-- Contraintes pour la table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`id_adresse_admin`) REFERENCES `adresses` (`id_adresse`);

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`id_adresse_client`) REFERENCES `adresses` (`id_adresse`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id_client`);

--
-- Contraintes pour la table `devis`
--
ALTER TABLE `devis`
  ADD CONSTRAINT `devis_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id_client`);

--
-- Contraintes pour la table `page_realisations`
--
ALTER TABLE `page_realisations`
  ADD CONSTRAINT `page_realisations_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);

--
-- Contraintes pour la table `page_services`
--
ALTER TABLE `page_services`
  ADD CONSTRAINT `page_services_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
