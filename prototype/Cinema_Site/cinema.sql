-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1:3306
-- Χρόνος δημιουργίας: 30 Μάη 2021 στις 13:34:57
-- Έκδοση διακομιστή: 8.0.21
-- Έκδοση PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `cinema`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cinema_overview`
--

DROP TABLE IF EXISTS `cinema_overview`;
CREATE TABLE IF NOT EXISTS `cinema_overview` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rows` int NOT NULL,
  `cols` int NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Owner_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`Owner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `cinema_overview`
--

INSERT INTO `cinema_overview` (`id`, `rows`, `cols`, `Name`, `Owner_id`) VALUES
(1, 15, 10, 'Evia', 52),
(2, 15, 10, 'Athena', 52),
(3, 15, 10, 'Mykonos', 52),
(4, 15, 10, 'Skyros', 52),
(5, 10, 12, 'Amorgos', 52),
(6, 10, 10, 'Theater 6', 52);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `Movie_id` int NOT NULL AUTO_INCREMENT,
  `Movie_title` varchar(50) NOT NULL,
  `Movie_description` longtext NOT NULL,
  `Movie_release_year` year NOT NULL,
  `Movie_duration` time NOT NULL,
  `Movie_trailer` text NOT NULL,
  `Movie_image` text NOT NULL,
  `Movie_gendre` varchar(40) NOT NULL,
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Movie_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `movies`
--

INSERT INTO `movies` (`Movie_id`, `Movie_title`, `Movie_description`, `Movie_release_year`, `Movie_duration`, `Movie_trailer`, `Movie_image`, `Movie_gendre`, `added_time`) VALUES
(1, 'RED DOT', 'When Nadja becomes pregnant, they make an attempt to rekindle their relationship by traveling to the north of Sweden for a hiking trip but soon their romantic trip turns into a nightmare.', 2020, '01:26:00', 't7FwypV69qc', 'https://m.media-amazon.com/images/M/MV5BYzhhN2U5NWQtNDA2Yi00ZDc5LWFlMDMtYjRkZmU5NGM5MzA4XkEyXkFqcGdeQXVyODc0OTEyNDU@._V1_.jpg', 'DRAMA - HORROR - THRILLER', '2021-04-13 17:23:32'),
(2, 'INDEPENDENCE DAY 2: RESURGENCE', 'Two decades after the first Independence Day invasion, Earth is faced with a new extra-Solar threat. But will mankind\'s new space defenses be enough?', 2016, '01:59:43', 'LbduDRH2m2M ', 'https://upload.wikimedia.org/wikipedia/en/f/f3/Independence_Day_Resurgence_poster.jpg', 'ACTION -  ADVENTURE - SCI-FI', '2021-04-13 17:23:32'),
(3, 'Top Gun: Maverick', 'After more than thirty years of service as one of the Navy\'s top aviators, Pete Mitchell is where he belongs, pushing the envelope as a courageous test pilot and dodging the advancement in rank that would ground him.', 2021, '02:00:00', 'g4U4BQW9OEk', 'https://m.media-amazon.com/images/M/MV5BMjA3NzlmNmItZjU0YS00NjdmLTg0ZGMtNDc5M2JlMzIzODg4XkEyXkFqcGdeQXVyMTAwMTY4OTI3._V1_UX182_CR0,0,182,268_AL_.jpg', 'ACTION -  DRAMA', '2021-04-13 17:23:32'),
(4, 'San Andreas: Επικίνδυνο ρήγμα', 'In the aftermath of a massive earthquake in California, a rescue-chopper pilot makes a dangerous journey with his ex-wife across the state in order to rescue his daughter.', 2015, '01:54:00', 'eQJKxaiKN54', 'https://m.media-amazon.com/images/M/MV5BNzZhYmQ2NGMtZmRmYi00NzgzLTllNmUtNDQwZDAxMmE3NzI0XkEyXkFqcGdeQXVyODE5NzE3OTE@._V1_UX182_CR0,0,182,268_AL_.jpg', 'ACTION - ADVENTURE - THRILLER', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `phone_tickets`
--

DROP TABLE IF EXISTS `phone_tickets`;
CREATE TABLE IF NOT EXISTS `phone_tickets` (
  `cust_id` int NOT NULL AUTO_INCREMENT,
  `First_name` varchar(50) NOT NULL,
  `Last_name` varchar(50) NOT NULL,
  `Phone_number` varchar(50) NOT NULL,
  `ticket_id` int NOT NULL,
  PRIMARY KEY (`cust_id`),
  KEY `ticket_id_fk` (`ticket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `phone_tickets`
--

INSERT INTO `phone_tickets` (`cust_id`, `First_name`, `Last_name`, `Phone_number`, `ticket_id`) VALUES
(26, 'Panos', 'alekoy', '6943401447', 317),
(27, 'Panos', 'alekoy', '6943401447', 318),
(28, 'mpampis', 'Lalakis', '2109027219', 319),
(29, 'mpampis', 'Lalakis', '2109027219', 320),
(30, 'Panos', 'alekoy', '6943401447', 321),
(31, 'Panos', 'alekoy', '6943401447', 322),
(32, 'Panos', 'alekoy', '6943401447', 323),
(33, 'Panos', 'alekoy', '6943401447', 324),
(34, 'Panos', 'alekoy', '6943401447', 325),
(35, 'Panos', 'alekoy', '6943401447', 326),
(36, 'Panos', 'alekoy', '6943401447', 327),
(37, 'Panos', 'alekoy', '6943401447', 328),
(38, 'Panos', 'alekoy', '6943401447', 329);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `projection`
--

DROP TABLE IF EXISTS `projection`;
CREATE TABLE IF NOT EXISTS `projection` (
  `Projection_id` int NOT NULL AUTO_INCREMENT,
  `projection_time_id` int NOT NULL,
  `cinema_id` int NOT NULL,
  `movie_id` int NOT NULL,
  PRIMARY KEY (`Projection_id`),
  KEY `projection_time_id` (`projection_time_id`),
  KEY `movie_id` (`movie_id`),
  KEY `cinema_id` (`cinema_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `projection`
--

INSERT INTO `projection` (`Projection_id`, `projection_time_id`, `cinema_id`, `movie_id`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 3, 2, 2),
(5, 6, 1, 1),
(4, 4, 2, 1),
(6, 7, 3, 3),
(7, 8, 5, 4);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `projection_time`
--

DROP TABLE IF EXISTS `projection_time`;
CREATE TABLE IF NOT EXISTS `projection_time` (
  `Projection_Time_id` int NOT NULL AUTO_INCREMENT,
  `Projection_Date` date NOT NULL,
  `Projection_Time` time NOT NULL,
  PRIMARY KEY (`Projection_Time_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `projection_time`
--

INSERT INTO `projection_time` (`Projection_Time_id`, `Projection_Date`, `Projection_Time`) VALUES
(1, '2021-03-16', '11:00:00'),
(2, '2021-03-25', '14:30:00'),
(3, '2021-05-12', '20:00:00'),
(4, '2021-03-16', '10:00:00'),
(5, '2021-07-21', '19:30:00'),
(6, '2021-05-12', '11:00:00'),
(7, '2021-06-16', '15:30:00'),
(8, '2021-06-16', '12:00:00');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `Ticket_id` int NOT NULL AUTO_INCREMENT,
  `projection_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `Seat_Name` varchar(10) NOT NULL,
  `Check_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Ticket_id`),
  KEY `projection_id` (`projection_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=332 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `ticket`
--

INSERT INTO `ticket` (`Ticket_id`, `projection_id`, `customer_id`, `Seat_Name`, `Check_time`) VALUES
(251, 1, 48, 'E.4', '2021-05-16 19:41:07'),
(264, 1, 47, 'C.5', '2021-05-18 15:41:16'),
(266, 3, 47, 'B.2', '2021-05-18 16:18:30'),
(267, 3, 47, 'B.3', '2021-05-18 16:18:30'),
(268, 4, 47, 'A.6', '2021-05-19 13:34:13'),
(269, 4, 47, 'A.7', '2021-05-19 13:34:13'),
(270, 1, 48, 'N.5', '2021-05-19 14:24:32'),
(271, 1, 48, 'J.5', '2021-05-19 14:44:34'),
(272, 1, 48, 'J.6', '2021-05-19 14:44:34'),
(273, 6, 50, 'I.2', '2021-05-21 14:45:12'),
(274, 6, 50, 'I.3', '2021-05-21 14:45:12'),
(275, 6, 50, 'I.4', '2021-05-21 14:45:12'),
(276, 6, 50, 'K.5', '2021-05-21 14:46:29'),
(277, 6, 50, 'K.6', '2021-05-21 14:46:29'),
(278, 6, 50, 'L.5', '2021-05-21 14:46:29'),
(279, 6, 50, 'L.6', '2021-05-21 14:46:29'),
(280, 1, 51, 'G.5', '2021-05-21 19:34:25'),
(281, 1, 51, 'G.6', '2021-05-21 19:34:25'),
(282, 2, 48, 'B.5', '2021-05-21 19:36:17'),
(283, 2, 48, 'C.6', '2021-05-21 19:36:17'),
(284, 2, 48, 'D.7', '2021-05-21 19:36:17'),
(291, 1, 48, 'D.6', '2021-05-21 22:03:08'),
(292, 1, 48, 'D.7', '2021-05-21 22:03:08'),
(293, 1, 48, 'I.5', '2021-05-21 22:04:35'),
(294, 1, 48, 'I.6', '2021-05-21 22:04:35'),
(295, 1, 48, 'O.8', '2021-05-21 22:09:05'),
(296, 1, 48, 'O.8', '2021-05-21 22:10:13'),
(297, 1, 48, 'O.8', '2021-05-21 22:11:13'),
(298, 5, 51, 'M.6', '2021-05-21 22:26:59'),
(299, 1, 48, 'M.5', '2021-05-22 10:17:55'),
(300, 1, 48, 'M.6', '2021-05-22 10:17:55'),
(301, 7, 51, 'C.5', '2021-05-22 12:08:31'),
(302, 7, 51, 'C.6', '2021-05-22 12:08:31'),
(303, 7, 51, 'C.7', '2021-05-22 12:08:31'),
(304, 5, 50, 'J.5', '2021-05-22 12:44:20'),
(305, 5, 50, 'J.6', '2021-05-22 12:44:20'),
(306, 5, 50, 'J.5', '2021-05-22 12:44:49'),
(307, 5, 50, 'J.6', '2021-05-22 12:44:49'),
(308, 5, 50, 'J.5', '2021-05-22 12:45:45'),
(309, 5, 50, 'J.6', '2021-05-22 12:45:45'),
(310, 5, 50, 'J.5', '2021-05-22 12:46:07'),
(311, 5, 50, 'J.6', '2021-05-22 12:46:07'),
(312, 6, 50, 'M.5', '2021-05-22 12:49:17'),
(313, 1, 51, 'N.7', '2021-05-23 00:25:49'),
(314, 1, 51, 'N.8', '2021-05-23 00:25:49'),
(315, 5, 48, 'H.4', '2021-05-23 01:00:12'),
(316, 5, 48, 'H.5', '2021-05-23 01:00:12'),
(317, 5, 48, 'A.1', '2021-05-23 01:18:45'),
(318, 5, 48, 'A.2', '2021-05-23 01:18:45'),
(319, 5, 48, 'D.4', '2021-05-23 01:22:16'),
(320, 5, 48, 'D.5', '2021-05-23 01:22:16'),
(321, 4, 48, 'C.3', '2021-05-23 01:37:28'),
(322, 4, 48, 'C.4', '2021-05-23 01:37:28'),
(323, 4, 48, 'C.5', '2021-05-23 01:37:28'),
(324, 4, 48, 'C.3', '2021-05-23 01:39:06'),
(325, 4, 48, 'C.4', '2021-05-23 01:39:06'),
(326, 4, 48, 'C.5', '2021-05-23 01:39:06'),
(327, 4, 48, 'C.3', '2021-05-23 01:39:47'),
(328, 4, 48, 'C.4', '2021-05-23 01:39:47'),
(329, 4, 48, 'C.5', '2021-05-23 01:39:47'),
(330, 4, 50, 'C.6', '2021-05-23 12:18:57'),
(331, 4, 50, 'C.7', '2021-05-23 12:18:57');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `First_Name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Last_Name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Role` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'guest',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `timestamp`, `First_Name`, `Last_Name`, `Role`) VALUES
(50, 'geoeast123', 'a3dcb4d229de6fde0db5686dee47145d', 'geoeast@gmail.com', '2021-05-21 14:22:04', 'George', 'Eastwood', 'guest'),
(46, 'makaki123', 'e1f308b35ca9afc', 'makis@gmail.com', '2021-05-15 13:36:32', 'Makis', 'Makou', 'guest'),
(47, 'johnpap', '527bd5b5d689e2c32ae974c6229ff785', 'johnpap@gmail.com', '2021-05-15 13:41:06', 'Giannis', 'Pap', 'guest'),
(48, 'gmitsiempl', '24a41dfc0b09c248bbc23b5e1ffc16d8', 'gmitsi@gmail.com', '2021-05-16 16:44:09', 'George', 'Mitsikwstas', 'employee'),
(49, 'mak123', '24a41dfc0b09c248bbc23b5e1ffc16d8', 'makyo@gmail.com', '2021-05-19 17:34:11', 'Makis', 'Makopoylos', 'admin'),
(51, 'mpamp123', '827ccb0eea8a706c4c34a16891f84e7b', 'mpamp13@gmail.com', '2021-05-21 14:33:43', 'mpampis', 'alekoy', 'guest'),
(52, 'admin', '202cb962ac59075b964b07152d234b70', 'admin@gmail.com', '2021-05-29 19:44:01', 'John', 'Argyrioy', 'admin');

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `phone_tickets`
--
ALTER TABLE `phone_tickets`
  ADD CONSTRAINT `ticket_id_fk` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`Ticket_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
