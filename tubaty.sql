-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2019 at 11:19 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubaty`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(150) NOT NULL,
  `link` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `link`) VALUES
(18, 'للايجار', 'for-rent'),
(19, 'للبيع', 'for-sale');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `username`, `email`, `message`, `date`) VALUES
(1, 'احمد خليل', 'ahmad@gmail.com', 'شكرا لكم على فتح قناة للتواصل معكم', '2017-04-23 02:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `land_size` int(11) NOT NULL,
  `video` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `image` varchar(150) NOT NULL,
  `category` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `title`, `location`, `price`, `land_size`, `video`, `desc`, `image`, `category`, `link`, `view`) VALUES
(15, 5, 'فلا 5 غرف', 'المنصور -بي المنتيبي', 0, 3333, 'https://www.youtube.com/watch?v=lEDHRh8gfm8', 'sdddddddd', 'post5c4c53697a0d2.jpg', 19, '3t0a12nv63s4', 12),
(16, 5, 'للبيع فيلا حي دراغ جنوب طريق المولللبيع فيلا حي دراغ', 'المنصور -بي المنتيبي', 3333, 233, 'https://www.youtube.com/watch?v=Nfdo2uLLPqI', 'eewq wwwwwwwwwwwwwwww qqqqqqqqqqqq', 'post5c4c562fd3e02.jpeg', 19, '6lmys9ba9x4w', 20),
(17, 5, 'للبيع فيلا حي دراغ جنوب', 'المنصور -بي المنتيبي', 333355, 555555, 'https://www.youtube.com/watch?v=2H_a-otgEAs', 'sssssssssssssssss', 'post5c4c589d81f22.jpeg', 19, '41uo6nzke3cw', 33),
(18, 5, 'للبيع فيلا حي دراغ جنوب', 'اتتتتتتتتتتتت', 1111123123, 12333, 'https://www.youtube.com/watch?v=ePREI8Qqi0Y', 'vvvvvvvvvvvvvvvvdddddddddddd', 'post5c4c58e052a8a.jpg', 19, '2kvjip5ocsu8', 75),
(19, 4, 'للبيع فيلا حي دراغ بغداد 4 غرف', 'المنصور -بي المنتيبي', 12000, 400, 'https://www.youtube.com/watch?v=ADcTqqFix3s', 'البيت يحتوي على 4 غرف وصالة', 'post5c6f224113ed9.jpg', 18, 'mvel7d1s5z4', 0),
(20, 4, 'جنوب طريق الحلة', 'الحلة', 3355, 100, 'https://www.youtube.com/watch?v=2H_a-otgEAs', 'موقع ممتاز ', 'post5c6f227a80c79.jpg', 18, '40jmvohg8f40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `postTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `user_id`, `post_id`, `comment`, `postTime`) VALUES
(1, 4, 18, 'thanks', '2019-02-20 23:57:44'),
(3, 4, 17, 'غغغغغغغ', '2019-02-21 00:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `farstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `farstname`, `lastname`, `email`, `password`, `isAdmin`) VALUES
(1, 'أكاديمية', 'مالك', 'ali@gmail.com', '123123', 1),
(2, 'asdasdad', 'asdasdasdd', 'ahmed@gmail.com', '4297f44b13955235245b2497399d7a93', 0),
(3, 'asdasdad', 'asdasdasdd', 'sha1@gmail.com', '040bd08a4290267535cd247b8ba2eca129d9fe9f', 0),
(4, 'احمد', 'نجك', 'ahmedn@gmai.com', 'b3360cc45c2819fc1ea9b0f16c15fdee', 1),
(5, 'احمد', 'admin', 'admin1@gmail.com', 'd93a5def7511da3d0f2d171d9c344e91', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
