-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db.3wa.io
-- Généré le : dim. 19 juin 2022 à 14:57
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1-log
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `analuisacarvalhodesa_projet_edition`
--

-- --------------------------------------------------------

--
-- Structure de la table `article_blog`
--

CREATE TABLE `article_blog` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `alt_image` varchar(255) NOT NULL,
  `content` varchar(3000) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article_blog`
--

INSERT INTO `article_blog` (`id`, `title`, `image`, `alt_image`, `content`, `created_at`) VALUES
(38, 'Alias : un nouveau départ', '0c2ec67430f486602e6fd04df2964502.jpg', 'Image megaphone et réseaux sociaux', 'Alias Éditions arrive enfin sur Internet. Pour ceux qui ne nous connaissent pas : après plusieurs années à produire des films et des vidéos, l&#039;association Alias élargit son champ d&#039;action et se lance dans l&#039;édition. Nous éditerons des livres d&#039;images et de cinéma bien sûr, mais nous allons d&#039;abord nous concentrer sur le texte, car ça fait longtemps que ça nous démange, car nos films étaient déjà souvent des films à texte, car ça fait sens pour nous aujourd&#039;hui. Notre ligne est artistique et politique, qu&#039;importe le genre et le style, pourvu que ça nous titille. N&#039;hésitez pas à nous faire parvenir vos manuscrits et de nous suivre sur les réseaux sociaux pour être au courant des nouvelles parutions.', '2022-04-09'),
(39, 'Prévente de notre premier livre', 'intothewildcouv.png', 'feuilles d&#039;arbre', 'Vous êtes passionné de photo et de nature ? Participez à la prévente du premier livre d&#039;Alias Éditions. &quot;Into the wild&quot; est un superbe recueil de photographies de Sophie Anne et Ferdinand T, regroupant leur travail tout le long d&#039;une année passée dans la fôret amazoniéene. Le livre inclut aussi des textes qui témoignent de leurs aventures. Mais pourquoi pré-acheter maintenant plutôt qu&#039;acheter à parution ? Vous serez les premiers à recevoir le livre, dès parution et vous êtes sûrs d&#039;en avoir un exemplaire (le stock sera limité et risque d&#039;être épuisé rapidement). En plus, vous soutiendrai un super projet associatif et nos premiers pas dans l&#039;édition.', '2022-06-17'),
(46, 'Alias au Salon du Livre', 'woman-6318447_1920.jpg', 'Image d&#039;une femme avec un livre', 'Notre maison d&#039;édition sera présente au Salon du Livre cette année. Après deux années de pause, crise sanitaire oblige, le festival revient pour célébrer, du 22 au 24 juillet 2022, le livre et la lecture, sous toutes ses formes, pour tous les publics. Venez faire un tour pour connaître nos dernières pépites, nos prochaines parutions et causer de vos propres projets d&#039;écriture. On vous prépare des séances de dédicace avec nos auteurs, des jeux concours, entre autres surprises.', '2022-06-18'),
(48, 'Votre manuscrit nous intéresse', 'notebook-1840276_1920.jpg', 'image d&#039;un cahier écrit et d&#039;un stylo', 'Vous êtes écrivain et vous voulez vous faire publier chez Alias Éditions ? Envoiez-nous votre manuscrit. Notre service manuscrit examinera votre ouvrage et vous donnera une réponse dans un délai de un mois dans une confidentialité totale. On vous garantit la protection de votre oeuvre. Pour avoir plus d&#039;informations sur la démarche à suivre n&#039;hésitez pas à nous contacter grâce à notre formulaire de contact sur ce site. Bonne écriture et bonnes lectures !', '2022-06-01');

-- --------------------------------------------------------

--
-- Structure de la table `author`
--

CREATE TABLE `author` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `last_name` varchar(65) NOT NULL,
  `bio` varchar(1200) NOT NULL,
  `created_at` date NOT NULL,
  `photo` varchar(255) NOT NULL,
  `alt_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `author`
--

INSERT INTO `author` (`id`, `first_name`, `last_name`, `bio`, `created_at`, `photo`, `alt_image`) VALUES
(1, 'Benoit', 'Durand', 'Passionné d’imaginaire et de fantasy, Benoit Durand est tombé dans les livres depuis tout petit.  Il a jadis voulu acquérir un savoir encyclopédique et il est fan de dictionnaires en tout genre. Il est auteur, réalisateur et beaucoup d\'autres choses. Son écriture s’inspire de tous ces univers et savoirs qu’il explore.', '2022-04-20', 'https://cdn.pixabay.com/photo/2019/03/17/15/16/fantasy-4061185_960_720.jpg', 'photo de Benoit Durand'),
(2, 'Claire', 'Moreau', 'Le premier livre de Claire Moreau a été publié en 2021 chez les éditions Alias. Son parcours professionnel et personnel l’amène à accompagner la différence au quotidien et l’interroge sur le poids des normes sociales. C’est dans cette optique qu’elle se lance dans l’écriture de son roman Sur le temps qui passe. Elle y pose un regard tendre, sincère et profondément respectueux sur chacun des êtres qui partagent sa route. Son premier livre même à peine publié, elle a déjà envie d\'en écrire un deuxième…', '2022-04-20', 'https://cdn.pixabay.com/photo/2019/11/07/21/40/portrait-4610004__340.jpg', 'photo de Claire Moreau'),
(3, 'Lou', 'Dubois', 'Lou Dubois a terminé ses études de Beaux-Arts à Paris en 2015 après un bac littéraire. Depuis son adolescence, elle a une pratique intensive de la danse et explore la photographie de paysages. L’écriture est cependant le centre de sa démarche artistique. Elle s’inspire des mondes des arts visuels autant que vivants, de la littérature, des coïncidences et de ses expérimentations personnelles. Elle aime sillonner le monde et surtout observer et rencontrer les humains. Elle occupe une bonne partie de ses journées à raconter et écouter. En 2022 elle publie son premier livre publié aux éditions Alias et nous offre avec ses photos une expérience de poésie visuelle.', '2022-01-01', 'https://cdn.pixabay.com/photo/2019/06/04/13/46/fantasy-4251469__340.jpg', 'photo de Lou Dubois'),
(4, 'Clément', 'Paboeuf', 'Notre plus jeune écrivain, c\'est encore à l\'adolescence qu\'il écrit son premier recueil de poèmes publié chez Alias en 2019. Un recueil touchant qui porte un regard tout neuf sur la réalité qui nous entoure.', '2021-12-10', 'https://cdn.pixabay.com/photo/2021/09/06/08/32/man-6601144_960_720.jpg', 'photo de Clément Paboeuf');

-- --------------------------------------------------------

--
-- Structure de la table `author_book`
--

CREATE TABLE `author_book` (
  `id` int(6) NOT NULL,
  `fk_book_id` smallint(6) UNSIGNED NOT NULL,
  `fk_author_id` smallint(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `author_book`
--

INSERT INTO `author_book` (`id`, `fk_book_id`, `fk_author_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 2),
(4, 5, 3),
(5, 3, 4),
(6, 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `binding` varchar(20) NOT NULL,
  `description` varchar(1200) NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `stock` smallint(6) NOT NULL,
  `format` varchar(20) NOT NULL,
  `pages` smallint(6) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `alt_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `title`, `created_at`, `binding`, `description`, `price`, `stock`, `format`, `pages`, `isbn`, `image`, `alt_image`) VALUES
(1, 'La danseuse', '2022-04-21', 'broché', '\"Je ne suis pas nostalgique de notre enfance : elle était pleine de violence. C’était la vie, un point c’est tout : et nous grandissions avec l\'obligation de la rendre difficile aux autres avant que les autres ne nous la rendent difficile.\"\r\nElena et Lila vivent dans un quartier pauvre de Naples à la fin des années cinquante. Bien qu’elles soient douées pour les études, ce n’est pas la voie qui leur est promise. Lila abandonne l’école pour travailler dans l’échoppe de cordonnier de son père. Elena, soutenue par son institutrice, ira au collège puis au lycée. Les chemins des deux amies se croisent et s’éloignent, avec pour toile de fond une Naples sombre, en ébullition.\"\r\n', '9.99', 200, '12x19cm', 172, '000-0-00000-000-0 ', 'https://cdn.pixabay.com/photo/2018/04/22/16/35/fantasy-3341539_960_720.jpg', 'image'),
(2, 'Into the Wild', '2022-01-20', 'broché', '\"Into the wild\" est un superbe recueil de photographies de Benoit Durand et\r\nClaire Moreau, regroupant leur travail tout le long d\'une année passée dans la fôret amazoniéene. Le livre inclut aussi des textes qui témoignent de leurs aventures', '20.00', 100, '15x20', 200, '0-00002-225-52', 'https://cdn.pixabay.com/photo/2015/09/26/21/33/suspension-bridge-959853_960_720.jpg', 'image'),
(3, 'La place désenchantée', '2022-06-09', 'broché', 'La princesse Bean du royaume de Dreamland est promise à un mariage arrangé avec le prince Guysbert de Bentwood. Pendant ce temps, dans un royaume appelé Elfwood, des elfes vivent dans la joie et la bonne humeur tout en fabriquant des bonbons, et utilisent des animaux pour les livrer. Seul un elfe nommé Elfo est malheureux de cette vie et condamné à être pendu.', '18.90', 150, '15x25', 68, '1215561', 'https://cdn.pixabay.com/photo/2016/09/16/16/44/fractal-1674486_960_720.jpg', 'alt image'),
(4, 'Sur le temps qui passe', '2020-06-11', 'poche', 'Trois jeunes villageois, Rand, Mat et Perrin, se trouvent un jour arrachés à la vie paisible de leur village, dans la région reculée des Deux-Rivières et oubliée de l\'Andor. Tout commence lorsque Moiraine, une Aes Sedai, arrive au village avec son Champion (ou Lige), al\'Lan Mandragoran (Lan). C\'est un évènement extraordinaire pour la petite communauté. ', '9.00', 500, '12x19cm', 270, '1215561', 'https://cdn.pixabay.com/photo/2016/05/14/18/46/clock-1392326_960_720.jpg', 'alt image'),
(5, 'Brume', '2022-06-10', 'poche', 'Une nuit, un orage très violent cause d\'énormes dégâts dans la propriété de David Drayton, près de la ville de Bridgton, dans le Maine. Le lendemain, il remarque avec son fils, Billy, et sa femme qu\'une étrange brume plane au-dessus du lac au bord duquel ils vivent. Pendant la matinée, aidé de son voisin Brent Norton, il commence à réparer les dégâts ; il dégage notamment la route parsemée d’arbres.', '9.00', 200, '12x19cm', 172, '1215561', 'https://cdn.pixabay.com/photo/2021/08/27/12/18/forest-6578551_960_720.jpg', 'image fôret embrumée');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `name` varchar(65) NOT NULL,
  `email` varchar(100) NOT NULL,
  `question` varchar(55) NOT NULL,
  `message_content` varchar(1200) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `question`, `message_content`, `created_at`) VALUES
(47, 'Catherine', 'catherine.m@protomail.com', 'Question générale', 'Bonjour, j&#039;ai participé au financement du livre Into the Wild et j&#039;aimerais savoir si vous avez une idée de la date de sortie du bouquin. Merci. Catherine', '2022-06-19 13:57:04'),
(48, 'Jennifer Langlois', 'jen.lang@hotmail.fr', 'Message concernant un manuscrit', 'Bonjour, je viens de connaître votre maison d&#039;édition et j&#039;apprécie votre démarche. Étant moi-même écrivaine, j&#039;aimerais savoir s&#039;il était possible de vous faire parvenir un de mes manuscrits pour une éventuelle publication chez vous ? Dans l&#039;attente d&#039;une réponse de votre part, je vous souhaite une bonne semaine. Jeniffer Langlois.', '2022-06-19 13:58:52'),
(49, 'Pierre M', 'pierre.m@gmail.com', 'Question générale', 'Bonsoir, je suis très intéresse par découvrir l&#039;univers de vos livres. Comment je peux me les procurer ? Est-il possible de commander en ligne?\r\nCordialement,\r\nPierre M.', '2022-06-19 14:01:58');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `created_at`, `isAdmin`) VALUES
(6, 'admin@admin.com', '$2y$10$WQZ7wGaFm5nWDjzL5dMBoeGK3M2jAaeA9nJIKmsVOqPSwCQiGXtWO', '2022-05-18', 1),
(21, 'al@gmail.com', '$2y$10$TYLkllQSLJ4fewk28iqvhes31N66eETVtkcTQZlltpC9Hk8A1/1r6', '2022-06-12', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article_blog`
--
ALTER TABLE `article_blog`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `author_book`
--
ALTER TABLE `author_book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_author_id` (`fk_author_id`),
  ADD KEY `fk_book_id` (`fk_book_id`);

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article_blog`
--
ALTER TABLE `article_blog`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `author`
--
ALTER TABLE `author`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `author_book`
--
ALTER TABLE `author_book`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `author_book`
--
ALTER TABLE `author_book`
  ADD CONSTRAINT `author_book_ibfk_2` FOREIGN KEY (`fk_author_id`) REFERENCES `author` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `author_book_ibfk_3` FOREIGN KEY (`fk_book_id`) REFERENCES `book` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
