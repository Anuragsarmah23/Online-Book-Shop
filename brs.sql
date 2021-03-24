-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2019 at 07:48 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(191) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `contact`, `password`) VALUES
('admin123', 'admin', 'admin@gmail.com', 9000111122, 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` varchar(110) NOT NULL,
  `name` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` smallint(4) NOT NULL,
  `status` varchar(15) NOT NULL,
  `quantity` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `author`, `description`, `price`, `status`, `quantity`) VALUES
('book1.png', 'Dummy', 'SAurav', 'dummy217272', 100, 'available', 7),
('book3.png', 'Dummy3', 'XXX', 'xxxxxXXX', 100, 'available', 7),
('book4.jpg', 'Dummy7', 'XXX', 'xx', 120, 'available', 7),
('book4.png', 'Dummy4', 'XXX', 'xx', 120, 'available', 5),
('book5.jpg', 'Dummy5', 'XXX', 'xx', 120, 'available', 7),
('book6.jpg', 'Dummy6', 'XXX', 'xx', 120, 'available', 7),
('book8.jpg', 'Dummy8', 'XXX', 'xx', 120, 'not available', 5),
('dh7825.jpg', 'dh', 'hds', 'hbsdh', 87, 'available', 7),
('Dummy128006.png', 'Dummy12', 'XXX', 'This book is awesome', 400, 'available', 1),
('harry potter8914.jpg', 'harry potter', 'j k rowling', 'm', 2500, 'not available', 0),
('nb3403.jpg', 'nb', 'nb', 'n nb n', 22, 'not available', 7),
('NEW BOOK2687.png', 'NEW BOOK', 'AUTHORX', 'NOT Wnd', 567, 'available', 4),
('NEWBOOk7950.png', 'NEWBOOk', 'AUTHORX', 'NOT WRITTEN YET', 567, 'available', 7),
('nmn2911.png', 'nmn', 'nn', 'knn', 990, 'available', 7),
('nmn82451.png', 'nmn8', 'nn', 'knn', 990, 'available', 7),
('nmn8933272.png', 'nmn893', 'nn', 'knn', 990, 'available', 7),
('nmn895013.png', 'nmn89', 'nn', 'knn', 990, 'available', 7),
('sauh4233.png', 'sauh', 'jnds', 'hbhsbd', 780, 'available', 7),
('Test1545.jpg', 'Test', 'Test', 'Awesome', 400, 'available', 2),
('wakanda1275.png', 'wakanda', 'marvel', 'wakanda forever', 32767, 'not available', 7);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `bookID` varchar(110) NOT NULL,
  `UID` varchar(110) NOT NULL,
  `cartQty` tinyint(4) NOT NULL,
  `BaseAmount` smallint(6) NOT NULL,
  `TotalAmount` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `tid` int(11) NOT NULL,
  `id` varchar(191) NOT NULL,
  `uid` varchar(110) NOT NULL,
  `bid` varchar(110) NOT NULL,
  `type` varchar(10) NOT NULL,
  `Amount` smallint(6) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`tid`, `id`, `uid`, `bid`, `type`, `Amount`, `status`) VALUES
(1, 'saurav640821.03.19', 'saurav6408', 'harry potter8914.jpg', 'buy', 1500, 'completed'),
(2, 'saurav6408333', 'saurav6408', 'NEW BOOK2687.png', 'sell', 340, 'pending'),
(3, 'saurav6408351', 'saurav6408', 'Dummy128006.png', 'sell', 240, 'completed'),
(4, 'saurav6408413', 'saurav6408', 'NEWBOOk7950.png', 'sell', 340, 'pending'),
(5, 'saurav6408424', 'saurav6408', 'harry potter8914.jpg', 'buy', 0, 'pending'),
(6, 'saurav6408462', 'saurav6408', 'nmn895013.png', 'buy', 396, 'pending'),
(7, 'saurav6408482', 'saurav6408', 'nmn895013.png', 'sell', 396, 'pending'),
(8, 'saurav6408560', 'saurav6408', 'nmn895013.png', 'buy', 594, 'pending'),
(9, 'saurav6408612', 'saurav6408', 'harry potter8914.jpg', 'buy', 1500, 'pending'),
(10, 'saurav6408620', 'saurav6408', 'nmn8933272.png', 'sell', 396, 'pending'),
(11, 'saurav6408725', 'saurav6408', 'harry potter8914.jpg', 'buy', 3000, 'pending'),
(12, 'saurav6408748', 'saurav6408', 'harry potter8914.jpg', 'sell', 1000, 'pending'),
(13, 'saurav6408917', 'saurav6408', 'harry potter8914.jpg', 'buy', 1500, 'pending'),
(14, 'saurav6408918', 'saurav6408', 'NEW BOOK2687.png', 'sell', 340, 'pending'),
(15, 'saurav6408996', 'saurav6408', 'book1.png', 'sell', 40, 'pending'),
(16, 'saurav6408278', 'saurav6408', 'harry potter8914.jpg', 'buy', 3000, 'pending'),
(17, 'saurav6408278', 'saurav6408', 'NEW BOOK2687.png', 'buy', 680, 'pending'),
(18, 'saurav6408869', 'saurav6408', 'NEW BOOK2687.png', 'buy', 1021, 'pending'),
(19, 'saurav6408869', 'saurav6408', 'book8.jpg', 'buy', 240, 'pending'),
(20, 'saurav6408869', 'saurav6408', 'book4.png', 'buy', 240, 'pending'),
(21, 'saurav5477305', 'saurav5477', 'Test1545.jpg', 'sell', 240, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(110) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(191) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `contact`, `address`, `password`) VALUES
('ajay3859', 'ajay', 'hathi', 'ajay8@gmail.com', 9085140414, 'paltan bazar', 'ajay7896'),
('ajay4337', 'ajay', 'hathi', 'ajay2@gmail.com', 9085140414, 'paltan vazar', 'AJAY7890'),
('ajay4775', 'ajay', 'hathi', 'ajay3@gmail.com', 9085140414, 'paltan vazar', 'AJAY7890'),
('ajay5339', 'ajay', 'hathi', 'ajay@gmail.com', 9085140414, 'paltan vazar', 'ajay1234'),
('saurav5477', 'saurav', 'chy', 'saurav1@gmail.com', 9085324602, 'paltan bazar', 'saurav123'),
('saurav6408', 'saurav', 'chy', 'saurav441@gmail.com', 9085324602, 'paltan bazar', 'saurav123'),
('sjhd8271', 'sjhd', 'jhs', 'jb@hb.ds', 9878787878, 'bnhbs', 'hathi890');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookID` (`bookID`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`UID`) REFERENCES `user` (`id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `book` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
