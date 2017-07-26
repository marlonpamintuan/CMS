-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2017 at 06:33 PM
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
-- Table structure for table `hydro`
--

CREATE TABLE `hydro` (
  `HYDRO_ID` int(11) NOT NULL,
  `CYLINDER_ID` text NOT NULL,
  `CYLINDER_TYPE` varchar(255) NOT NULL,
  `CYLINDER_DETAILS` varchar(2555) NOT NULL,
  `HYDRO_STATUS` varchar(255) NOT NULL,
  `HYDRO_DATEONLY` text NOT NULL,
  `HYDRO_DATECREATED` text NOT NULL,
  `HYDRO_DATEMODIFIED` text NOT NULL,
  `HYDRO_DATEDELETED` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hydro`
--
ALTER TABLE `hydro`
  ADD PRIMARY KEY (`HYDRO_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hydro`
--
ALTER TABLE `hydro`
  MODIFY `HYDRO_ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
