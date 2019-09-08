-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2019 at 06:49 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `cloud`
--

CREATE TABLE `cloud` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(255) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL,
  `size` double DEFAULT NULL,
  `modified_at` datetime NOT NULL,
  `public_share` tinyint(1) NOT NULL DEFAULT '0',
  `unique_id` varchar(255) NOT NULL,
  `ext` varchar(50) DEFAULT NULL,
  `path` text NOT NULL,
  `trashed` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cloud`
--

INSERT INTO `cloud` (`id`, `file_name`, `user_id`, `parent_id`, `type`, `size`, `modified_at`, `public_share`, `unique_id`, `ext`, `path`, `trashed`) VALUES
(1, 'folder', 1, 0, 'folder', NULL, '2019-04-07 08:23:22', 0, '', '', '', 0),
(2, 'something', 1, 1, 'image/jpeg', 140106, '2019-04-07 08:23:40', 1, 'dcloud.com.1.5ca95f2cc08897.22895154.jpg', 'jpg', 'http://dCloud.com/storage/dcloud.com.1.5ca95f2cc08897.22895154.jpg', 0),
(4, 'c numb', 1, 1, 'video/mp4', 11551982, '2019-04-07 08:24:17', 0, 'dcloud.com.1.5ca95f510f0f00.86609419.mp4', 'mp4', 'http://dCloud.com/storage/dcloud.com.1.5ca95f510f0f00.86609419.mp4', 0),
(5, 'something', 1, 1, 'image/jpeg', 140106, '2019-04-07 08:28:54', 0, 'dcloud.com.1.5ca95f2cc08897.22895154.jpg', 'jpg', 'http://dCloud.com/storage/dcloud.com.1.5ca95f2cc08897.22895154.jpg', 0),
(6, 'vidtest', 1, 0, 'video/mp4', 3965912, '2019-04-07 08:37:44', 0, 'dcloud.com.1.5ca962780d2b73.25881748.mp4', 'mp4', 'http://dCloud.com/storage/dcloud.com.1.5ca962780d2b73.25881748.mp4', 0),
(7, 'c numb', 1, 1, 'video/mp4', 11551982, '2019-04-07 10:48:39', 0, 'dcloud.com.1.5ca98127b09d71.69207418.mp4', 'mp4', 'http://dCloud.com/storage/dcloud.com.1.5ca98127b09d71.69207418.mp4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `private_share`
--

CREATE TABLE `private_share` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `shared_with` text NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `storage_policy`
--

CREATE TABLE `storage_policy` (
  `id` int(11) NOT NULL,
  `package` varchar(255) NOT NULL,
  `storage` double NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storage_policy`
--

INSERT INTO `storage_policy` (`id`, `package`, `storage`, `price`) VALUES
(1, 'Free', 100000000, '0'),
(2, 'Economy', 500000000, '10'),
(4, 'Business', 1000000000, '20'),
(5, 'Student', 100000000, '5');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` tinyint(1) NOT NULL,
  `salt` text NOT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  `storage` double DEFAULT '100000000',
  `used_storage` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`, `salt`, `is_verified`, `storage`, `used_storage`) VALUES
(1, 'dipsgalaxy', 'dipsgalaxy01@gmail.com', '2302e0ddfc031d3ad365a050d66baf4cbc66fa21', 0, '0f3d158de99f305de596b50627040058', 1, 300000000, 15798106);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cloud`
--
ALTER TABLE `cloud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `private_share`
--
ALTER TABLE `private_share`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage_policy`
--
ALTER TABLE `storage_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cloud`
--
ALTER TABLE `cloud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `private_share`
--
ALTER TABLE `private_share`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `storage_policy`
--
ALTER TABLE `storage_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
