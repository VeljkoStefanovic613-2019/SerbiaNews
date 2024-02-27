-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Feb 14, 2024 at 03:18 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `admin_email` varchar(35) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `category_id`) VALUES
(1, 'admin@admin.com', '$2y$10$b3GAX6.Pd6054RRQ8C9se.zfOhTljRkduBfAKWFrmtdKwj02aSTuq', NULL),
(4, 'dejan@dejan.com', '$2y$10$Fk2//5Pe.RF7LVK/THA9X.k9fNBJFwcC8EIeq2Ta7Z70KQ.q5gaE.', 2),
(6, 'goran@goran.com', '$2y$10$7UrXvlW/s4QPJfkFCqFfEezqRojvyDB52WeVnE5oB3SsGK5EA5aWu', 3),
(8, 'nenad@nenad.com', '$2y$10$AekxNURCNteNMlSAusr22Om9f7MDH6dIxZVhoxdGIMXNgYyG3EhJ6', 4),
(9, 'bogdan@bogdan.com', '$2y$10$fMNxLgr5HvTG0U3ymBmjn.DKbJd9pV2nkEqx0wDrF7DWuOhZexwb2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int NOT NULL,
  `category_id` int NOT NULL,
  `author_id` int NOT NULL,
  `article_title` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `article_image` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `article_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `article_date` date NOT NULL,
  `article_trend` tinyint NOT NULL,
  `article_active` tinyint NOT NULL,
  `likes` int DEFAULT '0',
  `article_hashtags` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `dislikes` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `category_id`, `author_id`, `article_title`, `article_image`, `article_description`, `article_date`, `article_trend`, `article_active`, `likes`, `article_hashtags`, `dislikes`) VALUES
(1, 1, 1, 'Kosarka', 'article-1-1707503238.jpg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2024-02-09', 0, 0, 0, '', 0),
(2, 1, 1, 'Tenis', 'article-1-1707503270.jpg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2024-02-09', 1, 1, 1, '', 0),
(3, 2, 3, 'Izbori', 'article-2-1707503426.jpg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2024-02-09', 1, 1, 0, '', 0),
(4, 2, 3, 'Protesti', 'article-2-1707503470.jpg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2024-02-09', 1, 1, 0, '', 0),
(5, 3, 5, 'Opera', 'article-3-1707503612.jpg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2024-02-09', 0, 1, 0, '', 0),
(6, 4, 7, 'Koncert', 'article-4-1707503900.jpg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2024-02-09', 0, 1, 0, '', 0),
(7, 4, 7, 'Festival', 'article-4-1707503949.jpg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2024-02-09', 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `article_hashtag`
--

CREATE TABLE `article_hashtag` (
  `id` int NOT NULL,
  `article_id` int NOT NULL,
  `hashtag_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article_hashtag`
--

INSERT INTO `article_hashtag` (`id`, `article_id`, `hashtag_name`) VALUES
(1, 1, 'sport'),
(2, 1, 'kosarka'),
(3, 1, '2024'),
(4, 2, 'sport'),
(5, 2, 'tenis'),
(6, 2, '2024'),
(7, 3, 'politika'),
(8, 3, 'izbori'),
(9, 3, '2024'),
(10, 4, 'politika'),
(11, 4, 'protesti'),
(12, 4, '2024'),
(13, 5, 'kultura'),
(14, 5, 'opera'),
(15, 5, '2024'),
(16, 6, 'zabava'),
(17, 6, 'koncert'),
(18, 6, '2024'),
(19, 7, 'zabava'),
(20, 7, 'festival'),
(21, 7, '2024');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int NOT NULL,
  `author_name` varchar(35) COLLATE utf8mb4_general_ci NOT NULL,
  `author_password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `author_email` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_name`, `author_password`, `author_email`, `category_id`) VALUES
(3, 'Aleksandra', '$2y$10$ZLCAJZHkpZuDkCf9Y5EaL.yKw76bibZVbDJ/esB3YP60McD9pZg5W', 'aleksandra@aleksandra.com', 2),
(4, 'Dejan', '$2y$10$Fk2//5Pe.RF7LVK/THA9X.k9fNBJFwcC8EIeq2Ta7Z70KQ.q5gaE.', 'dejan@dejan.com', 2),
(5, 'Milan', '$2y$10$vb3GC0ztqILXvGdlSMNA/eYoC7p7UepNqEvaXpx00RNJZ9zYFpRee', 'milan@milan.com', 3),
(6, 'Goran', '$2y$10$7UrXvlW/s4QPJfkFCqFfEezqRojvyDB52WeVnE5oB3SsGK5EA5aWu', 'goran@goran.com', 3),
(7, 'Petar', '$2y$10$oRAth1pHAPmaW6OFaM1nau1NRd7tYPCYbgxloRPeVmXbNZ0fXAIO.', 'petar@petar.com', 4),
(8, 'Nenad', '$2y$10$AekxNURCNteNMlSAusr22Om9f7MDH6dIxZVhoxdGIMXNgYyG3EhJ6', 'nenad@nenad.com', 4),
(9, 'Bogdan', '$2y$10$fMNxLgr5HvTG0U3ymBmjn.DKbJd9pV2nkEqx0wDrF7DWuOhZexwb2', 'bogdan@bogdan.com', 1),
(10, 'Aleksa', '$2y$10$p39QnNKlva.HpypaYdD2.uj1MLMhmA/lVLXdsYXz/fVqMImtoUrOm', 'aleksa@aleksa.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `bookmark_id` int NOT NULL,
  `user_id` int NOT NULL,
  `article_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`bookmark_id`, `user_id`, `article_id`) VALUES
(1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `category_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `category_color` varchar(35) COLLATE utf8mb4_general_ci NOT NULL,
  `category_image` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `category_description` varchar(350) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_color`, `category_image`, `category_description`) VALUES
(1, 'Sport', 'tag-blue', 'Sport1707499469.jpg', 'Kategorija \"Sport\" obuhvata vesti, informacije i analize iz sveta sporta. Ova kategorija pruža širok spektar informacija o sportskim događajima, takmičenjima, rezultatima, kao i aktuelnim sportskim trendovima i temama. U njoj možete pronaći pokrivenost različitih sportskih disciplina, uključujući fudbal, košarku, tenis, atletiku, plivanje, borilačk'),
(2, 'Politika', 'tag-yellow', 'Politika1707499766.jpg', 'Kategorija \"Politika\" pruža sveobuhvatan pregled političkih dešavanja i događaja kako u domaćoj tako i u međunarodnoj politici. Ova kategorija nudi informacije o političkim procesima, aktuelnim političkim temama, dešavanjima u vladama i parlamentima, kao i analize političkih trendova i političkih stranaka.'),
(3, 'Kultura', 'tag-purple', 'Kultura1707500044.jpg', 'Kategorija \"Kultura\" pruža inspirativan pogled na širok spektar kulturnih dešavanja, umetnosti, običaja i tradicija širom sveta. Ova kategorija istražuje raznolikost kultura i njihov uticaj na društvo, identitet i način života ljudi.'),
(4, 'Zabava', 'tag-orange', 'Zabava1707500100.jpg', 'Kategorija \"Zabava\" pruža raznolik spektar informacija o svetu zabave, uključujući filmove, televiziju, muziku, igre, događaje i ostale oblike zabave. Ova kategorija je posvećena pružanju uzbudljivih vesti, recenzija, intervjua i analiza iz sveta zabavnih industrija.');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `article_id` int DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comment_text` text COLLATE utf8mb4_general_ci,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `likes` int DEFAULT '0',
  `dislikes` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `article_id`, `user_name`, `comment_text`, `comment_date`, `likes`, `dislikes`) VALUES
(1, 2, 'Zoran', 'Sjajne vesti !', '2024-02-10 13:30:40', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `user_name` varchar(35) COLLATE utf8mb4_general_ci NOT NULL,
  `user_email` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `user_password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(3, 'Aleksandra', 'aleksandra@aleksandra.com', '$2y$10$ZLCAJZHkpZuDkCf9Y5EaL.yKw76bibZVbDJ/esB3YP60McD9pZg5W'),
(4, 'Dejan', 'dejan@dejan.com', '$2y$10$Fk2//5Pe.RF7LVK/THA9X.k9fNBJFwcC8EIeq2Ta7Z70KQ.q5gaE.'),
(5, 'Milan', 'milan@milan.com', '$2y$10$vb3GC0ztqILXvGdlSMNA/eYoC7p7UepNqEvaXpx00RNJZ9zYFpRee'),
(6, 'Goran', 'goran@goran.com', '$2y$10$7UrXvlW/s4QPJfkFCqFfEezqRojvyDB52WeVnE5oB3SsGK5EA5aWu'),
(7, 'Petar', 'petar@petar.com', '$2y$10$oRAth1pHAPmaW6OFaM1nau1NRd7tYPCYbgxloRPeVmXbNZ0fXAIO.'),
(8, 'Nenad', 'nenad@nenad.com', '$2y$10$AekxNURCNteNMlSAusr22Om9f7MDH6dIxZVhoxdGIMXNgYyG3EhJ6'),
(9, 'Bogdan', 'bogdan@bogdan.com', '$2y$10$fMNxLgr5HvTG0U3ymBmjn.DKbJd9pV2nkEqx0wDrF7DWuOhZexwb2'),
(10, 'Aleksa', 'aleksa@aleksa.com', '$2y$10$p39QnNKlva.HpypaYdD2.uj1MLMhmA/lVLXdsYXz/fVqMImtoUrOm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `article_hashtag`
--
ALTER TABLE `article_hashtag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`bookmark_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `article_hashtag`
--
ALTER TABLE `article_hashtag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `bookmark_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `article_hashtag`
--
ALTER TABLE `article_hashtag`
  ADD CONSTRAINT `article_hashtag_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`) ON DELETE CASCADE;

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
