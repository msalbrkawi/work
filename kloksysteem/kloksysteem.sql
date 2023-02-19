-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 19 feb 2023 om 17:38
-- Serverversie: 10.4.27-MariaDB
-- PHP-versie: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kloksysteem`
--
CREATE DATABASE IF NOT EXISTS `kloksysteem` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kloksysteem`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Amir', 'amirhaskani@gmail.com', '$2y$10$EJrCgsc1h9fTyvBKtPSUCO5p964TDthYmX7VsgCdbf3W7qlIc9oq.', 'admin'),
(2, 'ghaith', 'someone@example.com', '$2y$10$A85D4d7csl4fFVbAOcmypuDdcy8Gqh0M/s7F.4xad5y9tnQMsOaMy', 'admin');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_first_name` varchar(255) NOT NULL,
  `employee_last_name` varchar(255) NOT NULL,
  `hire_date` date NOT NULL,
  `employee_email` varchar(255) DEFAULT NULL,
  `employee_telefoon` int(11) NOT NULL,
  `uurloon` float NOT NULL,
  `code` varchar(255) NOT NULL,
  `manger_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_first_name`, `employee_last_name`, `hire_date`, `employee_email`, `employee_telefoon`, `uurloon`, `code`, `manger_id`) VALUES
(1, 'Mohammad Sulaiman', 'Albrkawi', '2023-02-10', 'msuleiamn.b03@gmail.com', 628737726, 7.5, '6505', 1),
(2, 'Ghaith', 'Albrkawi', '2023-02-26', 'msuleiamn.b03@gmail.com', 628737726, 1.3, '3200', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(11) NOT NULL,
  `day_date` date NOT NULL,
  `start_date` time NOT NULL,
  `end_date` time DEFAULT NULL,
  `total_hours` float DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `manger_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `manger_id` (`manger_id`);

--
-- Indexen voor tabel `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `manger_id` (`manger_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`manger_id`) REFERENCES `admin` (`id`);

--
-- Beperkingen voor tabel `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `salary_ibfk_2` FOREIGN KEY (`manger_id`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
