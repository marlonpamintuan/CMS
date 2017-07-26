-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2017 at 06:29 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cts`
--

-- --------------------------------------------------------

--
-- Table structure for table `boxout`
--

CREATE TABLE `boxout` (
  `BOXOUT_ID` int(11) NOT NULL,
  `BOXOUT_DUTYOPERATOR` text NOT NULL,
  `BOXOUT_GUARD` text NOT NULL,
  `CUSTOMER_ID` text NOT NULL,
  `BOXOUT_BOXCODE` text NOT NULL,
  `BOXOUT_DICEWEIGHT` text NOT NULL,
  `BOXOUT_BOXWEIGHT` text NOT NULL,
  `BOXOUT_TOTAL` text NOT NULL,
  `BOXOUT_BOXSTATUS` text NOT NULL,
  `BOXOUT_TIMEOUT` text NOT NULL,
  `BOXOUT_GATEPASS` text NOT NULL,
  `BOXOUT_DATE` text NOT NULL,
  `BOXOUT_DATECREATED` text NOT NULL,
  `BOXOUT_DATEMODIFIED` text NOT NULL,
  `BOXOUT_DATEDELETED` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boxout`
--
ALTER TABLE `boxout`
  ADD PRIMARY KEY (`BOXOUT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boxout`
--
ALTER TABLE `boxout`
  MODIFY `BOXOUT_ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
