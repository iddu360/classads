-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2020 at 12:00 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classifiedads_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_article`
--

CREATE TABLE `ad_article` (
  `id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_article`
--

INSERT INTO `ad_article` (`id`, `ad_id`, `name`, `price`, `quantity`, `created_at`) VALUES
(1, 1, 'BMW', 4, 5, '2019-04-07 11:17:22'),
(2, 1, 'Mac', 4, 4, '2019-04-07 11:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `ad_category`
--

CREATE TABLE `ad_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_category`
--

INSERT INTO `ad_category` (`id`, `category_name`, `created_at`) VALUES
(1, 'CAR', '2019-04-07 10:37:35'),
(2, 'ELECTRONIC', '2019-04-07 10:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `ad_details`
--

CREATE TABLE `ad_details` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `register_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `ad_status` enum('Enable','Disable') NOT NULL,
  `ad_type` enum('Free','Paid') NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_details`
--

INSERT INTO `ad_details` (`id`, `category_id`, `member_id`, `description`, `register_date`, `expire_date`, `ad_status`, `ad_type`, `amount`, `created_at`) VALUES
(1, 1, 2, 'BMW', '2019-04-02', '2019-04-02', 'Enable', 'Paid', 20, '2019-04-07 10:47:28'),
(2, 2, 2, 'MAC BOOK PRO', '2019-04-02', '2019-04-02', 'Enable', 'Paid', 10, '2019-04-07 10:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `ad_image`
--

CREATE TABLE `ad_image` (
  `id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_image`
--

INSERT INTO `ad_image` (`id`, `ad_id`, `image`, `created_at`) VALUES
(1, 1, 'images/BMW.jpg', '2019-04-13 23:11:40'),
(2, 2, 'images/MAC.jpeg', '2019-04-14 22:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `ad_members`
--

CREATE TABLE `ad_members` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type_of_user` enum('member','admin') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_members`
--

INSERT INTO `ad_members` (`id`, `name`, `address`, `city`, `state`, `phone`, `email`, `password`, `type_of_user`, `status`, `created_at`) VALUES
(9, 'Zhibo Zhang', '421 Saul St', 'Montreal', 'QC', '5146616603', 'zhibo@mail.com', 'f4fadc94100291ca8d69a35d54bcdd54', 'member', 'Active', '2020-04-25 16:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `ad_payment`
--

CREATE TABLE `ad_payment` (
  `id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `payment` double NOT NULL,
  `total_images` int(11) NOT NULL,
  `total_payment` double NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_article`
--
ALTER TABLE `ad_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_category`
--
ALTER TABLE `ad_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_details`
--
ALTER TABLE `ad_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_image`
--
ALTER TABLE `ad_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_members`
--
ALTER TABLE `ad_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_payment`
--
ALTER TABLE `ad_payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_article`
--
ALTER TABLE `ad_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ad_category`
--
ALTER TABLE `ad_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ad_details`
--
ALTER TABLE `ad_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ad_image`
--
ALTER TABLE `ad_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ad_members`
--
ALTER TABLE `ad_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ad_payment`
--
ALTER TABLE `ad_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
