-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2017 at 07:07 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `point` smallint(6) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `imgURL` varchar(60) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `name`, `point`, `role`, `imgURL`) VALUES
('duyn', '456', 'Nguyen Duy', 2000, 1, 'img_source/duyn.jpg'),
('duynull', '789', 'Duy Nguyen', 3000, 1, ''),
('hieudt', '123', 'Hieu Do', 0, 0, 'img_source/hieudt.jpg'),
('msthy', '345', 'Thy Thy', 1000, 0, ''),
('son', '567', 'Son Le Hung', 1150, 0, 'img_source/son.jpg'),
('sonlh', '456', 'Le Hung Son', 1000, 0, ''),
('tourist', '999', 'Gennady', 2259, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `achievement`
--

CREATE TABLE `achievement` (
  `username` varchar(60) COLLATE utf8_vietnamese_ci NOT NULL,
  `namePrize` varchar(60) COLLATE utf8_vietnamese_ci NOT NULL,
  `cnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `achievement`
--

INSERT INTO `achievement` (`username`, `namePrize`, `cnt`) VALUES
('duyn', 'bronze', 10),
('sonlh', 'gold', 5);

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `ID` int(11) NOT NULL,
  `conID` int(11) NOT NULL,
  `username` varchar(60) COLLATE utf8_vietnamese_ci NOT NULL,
  `ans` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`ID`, `conID`, `username`, `ans`, `done`) VALUES
(1, 2, 'sonlh', '001002', 1),
(2, 2, 'duyn', '001001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `ID` int(11) NOT NULL,
  `conID` int(11) NOT NULL,
  `ans` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`ID`, `conID`, `ans`) VALUES
(1, 1, '001001'),
(2, 2, '001001');

-- --------------------------------------------------------

--
-- Table structure for table `belongcon`
--

CREATE TABLE `belongcon` (
  `ID` int(11) NOT NULL,
  `conID` int(11) NOT NULL,
  `quizID` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `belongcon`
--

INSERT INTO `belongcon` (`ID`, `conID`, `quizID`, `active`) VALUES
(3, 1, 1, 1),
(4, 1, 2, 1),
(5, 2, 3, 1),
(6, 2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `ID` int(11) NOT NULL,
  `conID` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `parID` int(11) NOT NULL,
  `content` varchar(500) COLLATE utf8_vietnamese_ci NOT NULL,
  `username` varchar(60) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`ID`, `conID`, `parID`, `content`, `username`) VALUES
(1, '0', -1, ' Duy ne may ban', 'duyn'),
(2, '0', 1, ' aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'duyn'),
(3, '5', -1, ' Hey buddy', 'duyn'),
(4, '5', 3, ' I love u', 'duyn');

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE `contest` (
  `conID` int(11) NOT NULL,
  `conName` varchar(300) COLLATE utf8_vietnamese_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `author` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `beginTime` timestamp NULL DEFAULT NULL,
  `islock` tinyint(1) NOT NULL,
  `level` int(11) NOT NULL,
  `isJudged` tinyint(1) NOT NULL,
  `blog` varchar(2000) COLLATE utf8_vietnamese_ci NOT NULL,
  `createDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `contest`
--

INSERT INTO `contest` (`conID`, `conName`, `duration`, `author`, `beginTime`, `islock`, `level`, `isJudged`, `blog`, `createDate`) VALUES
(0, '120', 100, '', '0000-00-00 00:00:00', 0, 0, 0, '<p>Hello</p>', NULL),
(1, 'abc', 120, '', '2017-03-16 22:00:00', 0, 0, 0, '', NULL),
(2, 'abc', 300, 'sonlh', '2017-03-10 10:38:47', 1, 2, 0, '', NULL),
(3, 'Petr the best', 120, 'sonlh', '2017-03-17 22:05:00', 0, 0, 0, '<p>This is tourist</p><p>This is rng_58</p>', NULL),
(4, 'abc', 100, 'sonlh', '2017-03-22 07:59:49', 0, 0, 0, '', NULL),
(0, '', 100, '', '2017-03-22 06:54:48', 0, 0, 0, '<p>Hello</p>', NULL),
(5, 'baby #01', 200, 'duyn', '2017-04-14 22:05:00', 0, 0, 0, '<p>yyyy</p>\r\n', NULL),
(6, 'baby #02', 210, 'duyn', '2017-10-27 19:01:00', 0, 0, 0, '', NULL),
(7, 'baby #03', 210, 'duyn', '2018-09-08 18:00:00', 0, 0, 0, '<p><em><strong>Duy dep trai, hihi</strong></em></p>\r\n\r\n<p><strong><em>I&#39;m the best YOLOoooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo</em></strong></p>\r\n', '0000-00-00 00:00:00'),
(8, 'baby #04', 300, 'duyn', '2017-12-31 18:00:00', 0, 0, 0, '<p>abcdefffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff</p>\r\n', '0000-00-00 00:00:00'),
(9, 'Duyne', 10, 'duyn', '2016-12-31 18:00:00', 0, 0, 0, '<p>fafsafasf</p>\r\n', '0000-00-00 00:00:00'),
(10, 'abcdefsss', 10, 'duyn', '2020-02-02 07:02:00', 0, 0, 0, '<p>gegwegwegwegwg</p>\r\n', '2017-03-23 21:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `msg` varchar(2000) COLLATE utf8_vietnamese_ci NOT NULL,
  `username` varchar(60) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mall`
--

CREATE TABLE `mall` (
  `ID` int(11) NOT NULL,
  `cont` varchar(300) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `mall`
--

INSERT INTO `mall` (`ID`, `cont`) VALUES
(1, 'asgagasgasg'),
(2, 'A'),
(3, 'B'),
(4, 'Hello'),
(5, 'C'),
(6, 'D'),
(7, 'Quay len'),
(8, 'A'),
(9, 'B'),
(10, 'Thua luon'),
(11, 'C'),
(12, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `mapqa`
--

CREATE TABLE `mapqa` (
  `ID` int(11) NOT NULL,
  `ansID` int(11) NOT NULL,
  `quizID` int(11) NOT NULL,
  `isAnswer` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `mapqa`
--

INSERT INTO `mapqa` (`ID`, `ansID`, `quizID`, `isAnswer`, `active`) VALUES
(7, 2, 1, 1, 1),
(8, 3, 1, 0, 1),
(9, 1, 1, 0, 1),
(10, 5, 2, 1, 1),
(11, 6, 2, 0, 1),
(12, 4, 2, 0, 1),
(13, 8, 3, 1, 1),
(14, 9, 3, 0, 1),
(15, 7, 3, 0, 1),
(16, 11, 4, 1, 1),
(17, 12, 4, 0, 1),
(18, 10, 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prize`
--

CREATE TABLE `prize` (
  `name` varchar(60) COLLATE utf8_vietnamese_ci NOT NULL,
  `imgURL` varchar(60) COLLATE utf8_vietnamese_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `description` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `prize`
--

INSERT INTO `prize` (`name`, `imgURL`, `priority`, `description`) VALUES
('bronze', 'img/prize/bronze.png', 3, '2nd Runner-Up Cup'),
('gold', 'img/prize/gold.png', 1, 'Champion Cup'),
('silver', 'img/prize/silver.png', 2, '1st Runner-Up Cup'),
('top10', 'img/prize/top10.png', 4, 'Top 10 Badget');

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `ID` int(11) NOT NULL,
  `cntquiz` int(11) NOT NULL,
  `cntmall` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`ID`, `cntquiz`, `cntmall`) VALUES
(1, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quizID` int(11) NOT NULL,
  `questID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quizID`, `questID`) VALUES
(1, 1),
(2, 4),
(3, 7),
(4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `repoto`
--

CREATE TABLE `repoto` (
  `ID` int(11) NOT NULL,
  `conID` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `point` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `repoto`
--

INSERT INTO `repoto` (`ID`, `conID`, `username`, `point`) VALUES
(1, 1, 'son', 28.559999465942383),
(2, 1, 'duynull', 71.54000091552734),
(3, 1, 'msthy', 100),
(4, 1, 'tourist', 57.130001068115234),
(5, 2, 'sonlh', 50),
(6, 2, 'duyn', 100);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `username` varchar(60) COLLATE utf8_vietnamese_ci NOT NULL,
  `commentID` int(11) NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `achievement`
--
ALTER TABLE `achievement`
  ADD PRIMARY KEY (`username`,`namePrize`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `belongcon`
--
ALTER TABLE `belongcon`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mall`
--
ALTER TABLE `mall`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mapqa`
--
ALTER TABLE `mapqa`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `prize`
--
ALTER TABLE `prize`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quizID`);

--
-- Indexes for table `repoto`
--
ALTER TABLE `repoto`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `belongcon`
--
ALTER TABLE `belongcon`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mapqa`
--
ALTER TABLE `mapqa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `repoto`
--
ALTER TABLE `repoto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
