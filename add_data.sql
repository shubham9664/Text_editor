-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2022 at 09:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `add_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_add`
--

CREATE TABLE `data_add` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `file` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_add`
--

INSERT INTO `data_add` (`id`, `fname`, `content`, `file`) VALUES
(1, 'shubham sahu', '<p>shubham</p>', '2.png'),
(2, 'deepak', '<p>deepak</p>', 'download.jpg'),
(3, 'aman', '<p>aman</p>', 'download.jpg'),
(4, 'rohit kumar', '<p>rohit</p>', 'lord krishna.png'),
(5, 'gupta', '<p>gupta</p>', 'ban.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_add`
--
ALTER TABLE `data_add`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_add`
--
ALTER TABLE `data_add`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
