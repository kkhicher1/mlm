-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2018 at 04:58 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `userid`, `password`) VALUES
(1, 'admin@mlm.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `daily_bal` int(11) NOT NULL,
  `current_bal` int(11) NOT NULL,
  `total_bal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `userid`, `daily_bal`, `current_bal`, `total_bal`) VALUES
(1, 'user@mlm.com', 300, 0, 300),
(23, 'user1@mlm.com', 100, 0, 100),
(24, 'user2@mlm.com', 100, 0, 100),
(25, 'user3@mlm.com', 0, 0, 0),
(26, 'user4@mlm.com', 0, 0, 0),
(27, 'user5@mlm.com', 0, 0, 0),
(28, 'user6@mlm.com', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `income_received`
--

CREATE TABLE `income_received` (
  `id` int(11) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income_received`
--

INSERT INTO `income_received` (`id`, `userid`, `amount`, `date`) VALUES
(1, 'user@mlm.com', 300, '2018-08-15'),
(2, 'user1@mlm.com', 100, '2018-08-15'),
(3, 'user2@mlm.com', 100, '2018-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `pin_list`
--

CREATE TABLE `pin_list` (
  `id` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `pin` int(11) NOT NULL,
  `status` enum('open','close') NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pin_list`
--

INSERT INTO `pin_list` (`id`, `userid`, `pin`, `status`) VALUES
(2, 'user@mlm.com', 41158, 'close'),
(3, 'user@mlm.com', 46335, 'close'),
(4, 'user@mlm.com', 42353, 'open'),
(5, 'user@mlm.com', 44165, 'open'),
(6, 'user@mlm.com', 90437, 'open'),
(7, 'user@mlm.com', 16599, 'open'),
(8, 'user@mlm.com', 87352, 'open'),
(9, 'user@mlm.com', 53028, 'open');

-- --------------------------------------------------------

--
-- Table structure for table `pin_request`
--

CREATE TABLE `pin_request` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('open','close') NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pin_request`
--

INSERT INTO `pin_request` (`id`, `email`, `amount`, `date`, `status`) VALUES
(1, 'user@mlm.com', 500, '2018-08-06', 'close'),
(2, 'user@mlm.com', 2000, '2018-08-06', 'close'),
(3, 'user@mlm.com', 101, '2018-08-06', 'close'),
(4, 'user@mlm.com', 501, '2018-08-06', 'close'),
(5, 'user@mlm.com', 1000, '2018-08-12', 'close'),
(7, 'user@mlm.com', 424, '2018-08-12', 'close'),
(8, 'user@mlm.com', 4524, '2018-08-12', 'open'),
(9, 'user@mlm.com', 252, '2018-08-12', 'close'),
(10, 'user@mlm.com', 300, '2018-08-12', 'close'),
(11, 'user@mlm.com', 100, '2018-08-13', 'close'),
(12, 'user@mlm.com', 500, '2018-08-13', 'close'),
(13, 'user@mlm.com', 600, '2018-08-13', 'close'),
(14, 'user@mlm.com', 400, '2018-08-13', 'close'),
(15, 'user@mlm.com', 1000, '2018-08-28', 'close');

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE `tree` (
  `id` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `left` varchar(50) NOT NULL,
  `right` varchar(50) NOT NULL,
  `leftcount` int(11) NOT NULL,
  `rightcount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tree`
--

INSERT INTO `tree` (`id`, `userid`, `left`, `right`, `leftcount`, `rightcount`) VALUES
(1, 'user@mlm.com', 'user1@mlm.com', 'user2@mlm.com', 3, 3),
(23, 'user1@mlm.com', 'user3@mlm.com', 'user4@mlm.com', 1, 1),
(24, 'user2@mlm.com', 'user5@mlm.com', 'user6@mlm.com', 1, 1),
(25, 'user3@mlm.com', '', '', 0, 0),
(26, 'user4@mlm.com', '', '', 0, 0),
(27, 'user5@mlm.com', '', '', 0, 0),
(28, 'user6@mlm.com', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `account` varchar(20) NOT NULL,
  `under_userid` varchar(50) NOT NULL,
  `side` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `mobile`, `address`, `account`, `under_userid`, `side`) VALUES
(1, 'user@mlm.com', '123456', '9812447202', 'Hisar India', '799', '', ''),
(23, 'user1@mlm.com', '123456', '123456789', 'H.No 799 VPO Kaimri', '98745613215', 'user@mlm.com', 'left'),
(24, 'user2@mlm.com', '123456', '123456789', 'Hisar, Haryana', '98745613215', 'user@mlm.com', 'right'),
(25, 'user3@mlm.com', '123456', '123456789', 'Hisar, Haryana', '98745613215', 'user1@mlm.com', 'left'),
(26, 'user4@mlm.com', '123456', '45252452452', 'Hisar, Haryana', '98745613215', 'user1@mlm.com', 'right'),
(27, 'user5@mlm.com', '123456', '45252452452', 'H.No 799 VPO Kaimri', '98745613215', 'user2@mlm.com', 'left'),
(28, 'user6@mlm.com', '123456', '45252452452', 'Hisar, Haryana', '98745613215', 'user2@mlm.com', 'right');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_received`
--
ALTER TABLE `income_received`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pin_list`
--
ALTER TABLE `pin_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pin_request`
--
ALTER TABLE `pin_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tree`
--
ALTER TABLE `tree`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `income_received`
--
ALTER TABLE `income_received`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pin_list`
--
ALTER TABLE `pin_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pin_request`
--
ALTER TABLE `pin_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tree`
--
ALTER TABLE `tree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
