-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2018 at 12:16 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `orn_worldcup2018`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questions`
--

CREATE TABLE `tbl_questions` (
  `id` int(11) NOT NULL,
  `contest_type` enum('1','2','3') NOT NULL DEFAULT '3',
  `datetime` datetime NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_questions`
--

INSERT INTO `tbl_questions` (`contest_type`, `datetime`, `question`, `answer`) VALUES
('2', '0000-00-00 00:00:00', 'Which country will win the World Cup 2018 ?', ''),
('2', '0000-00-00 00:00:00', 'Which two team will reach the World Cup 2018 final ?', ''),
('2', '0000-00-00 00:00:00', 'What will be the final scorer of World Cup 2018 final ?', ''),
('2', '0000-00-00 00:00:00', 'Who will be the best player of the tournament ?', ''),
('2', '0000-00-00 00:00:00', 'Who will be the highest scorer of the tournament ?', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;
