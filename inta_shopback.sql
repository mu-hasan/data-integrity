-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2017 at 04:14 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inta_shopback`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `Barang_ID` int(11) NOT NULL,
  `Barang_nama` varchar(50) NOT NULL,
  `Barang_harga` int(11) NOT NULL,
  `Barang_gambar` varchar(2083) NOT NULL,
  `Barang_stok` int(11) NOT NULL,
  `Barang_rating` int(11) NOT NULL,
  `Barang_ulasan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sumber`
--

CREATE TABLE `sumber` (
  `Sumber_ID` int(11) NOT NULL,
  `Sumber_nama` varchar(50) NOT NULL,
  `Sumber_logo` varchar(2083) NOT NULL,
  `Last_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sumber_barang`
--

CREATE TABLE `sumber_barang` (
  `Sumber_ID` int(11) NOT NULL,
  `Barang_ID` int(11) NOT NULL,
  `Url` varchar(2083) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`Barang_ID`);

--
-- Indexes for table `sumber`
--
ALTER TABLE `sumber`
  ADD PRIMARY KEY (`Sumber_ID`);

--
-- Indexes for table `sumber_barang`
--
ALTER TABLE `sumber_barang`
  ADD PRIMARY KEY (`Sumber_ID`,`Barang_ID`),
  ADD KEY `Sumber_ID` (`Sumber_ID`),
  ADD KEY `Barang_ID` (`Barang_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sumber_barang`
--
ALTER TABLE `sumber_barang`
  ADD CONSTRAINT `sumber_barang_ibfk_1` FOREIGN KEY (`Barang_ID`) REFERENCES `barang` (`Barang_ID`),
  ADD CONSTRAINT `sumber_barang_ibfk_2` FOREIGN KEY (`Sumber_ID`) REFERENCES `sumber` (`Sumber_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
