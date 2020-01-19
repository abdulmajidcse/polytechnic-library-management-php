-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2019 at 06:01 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lm`
--

-- --------------------------------------------------------

--
-- Table structure for table `lm_book`
--

CREATE TABLE `lm_book` (
  `id` int(11) NOT NULL,
  `bookname` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `bookcopies` varchar(255) NOT NULL,
  `catname` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lm_borrow`
--

CREATE TABLE `lm_borrow` (
  `id` int(11) NOT NULL,
  `person` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `catname` varchar(255) NOT NULL,
  `bookname` varchar(255) NOT NULL,
  `borrowdate` date NOT NULL,
  `returndate` date NOT NULL,
  `returneddate` date NOT NULL,
  `overduefine` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lm_cat`
--

CREATE TABLE `lm_cat` (
  `id` int(11) NOT NULL,
  `cat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lm_fine`
--

CREATE TABLE `lm_fine` (
  `id` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `finedate` date NOT NULL,
  `fine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lm_finesubmit`
--

CREATE TABLE `lm_finesubmit` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `submitteddate` date NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lm_fine_verification`
--

CREATE TABLE `lm_fine_verification` (
  `id` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lm_log`
--

CREATE TABLE `lm_log` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lm_log`
--

INSERT INTO `lm_log` (`id`, `fname`, `sname`, `image`, `uname`, `email`, `password`) VALUES
(1, 'Abdul', 'Majid', 'images/70b7b1a4c5.jpg', 'admin', 'library_management@gmail.com', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad');

-- --------------------------------------------------------

--
-- Table structure for table `lm_user`
--

CREATE TABLE `lm_user` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `roll` varchar(255) NOT NULL,
  `lcardno` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `person` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lm_book`
--
ALTER TABLE `lm_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lm_borrow`
--
ALTER TABLE `lm_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lm_cat`
--
ALTER TABLE `lm_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lm_fine`
--
ALTER TABLE `lm_fine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lm_finesubmit`
--
ALTER TABLE `lm_finesubmit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lm_fine_verification`
--
ALTER TABLE `lm_fine_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lm_log`
--
ALTER TABLE `lm_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lm_user`
--
ALTER TABLE `lm_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lm_book`
--
ALTER TABLE `lm_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `lm_borrow`
--
ALTER TABLE `lm_borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `lm_cat`
--
ALTER TABLE `lm_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `lm_fine`
--
ALTER TABLE `lm_fine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `lm_finesubmit`
--
ALTER TABLE `lm_finesubmit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lm_fine_verification`
--
ALTER TABLE `lm_fine_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lm_log`
--
ALTER TABLE `lm_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lm_user`
--
ALTER TABLE `lm_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
