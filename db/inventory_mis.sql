-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 11:05 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `acc_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `acc_name` varchar(255) NOT NULL,
  `acc_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `id`, `acc_name`, `acc_number`) VALUES
(1, 3, 'Mobile Money', ' 07804943456                                                                                                                                '),
(2, 3, 'Airtel Money', ' 07399365265                                                                                                                     '),
(4, 3, 'Bank of Kigali', '2850848477431                                                                                                               '),
(5, 3, 'BPR', '00285084842111                                                                                                                             '),
(6, 3, 'Equity Bank', '066673322'),
(7, 2, 'Mobile Money', '                                                                                0785734885                                                                            ');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `pro_category` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `telphone` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `cell` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `joined_date` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `firstname`, `lastname`, `email`, `password`, `telphone`, `gender`, `dob`, `province`, `district`, `sector`, `cell`, `village`, `joined_date`, `status`) VALUES
(1, 'Mutuyimana', 'NDAYISHIMIYE', 'fullstackdeveloppers@gmail.com', '6512bd43d9caa6e02c990b0a82652dca', 780494000, 'on', '2022-03-21', 'Kigali', 'Kicukiro', 'Kagarama', 'Muyange', 'Mugeyo', '0000-00-00', 1),
(2, 'Manzi', 'Yves', 'manzi@gmail.com', 'f899139df5e1059396431415e770c6dd', 780494192, 'on', '2022-03-21', 'Kigali', 'Kicukiro', 'Kagarama', 'Muyange', 'Mugeyo', '0000-00-00', 1),
(3, 'nikuze', 'grace', 'nikuzegrace63@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 780494616, 'on', '2000-01-01', 'East', 'Kayonza', 'Mukarange', 'Kayonza', 'Cyeru', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `pr_id` varchar(255) NOT NULL,
  `pro_category` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `id`, `customer_id`, `pr_id`, `pro_category`, `qty`, `unit_price`, `order_date`, `status`) VALUES
(1, 2, 1, '4', 'Cassava', 100, 300, '2022-03-21', 'Received'),
(3, 2, 2, '4', 'Cassava', 700, 300, '2022-03-21', 'Received'),
(6, 2, 3, '3', 'Patotoes', 300, 200, '2022-03-21', 'Received'),
(7, 22, 3, '5', ' Rice', 1, 380, '2022-03-21', 'Received');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pr_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `pro_category` varchar(255) NOT NULL,
  `season` varchar(255) NOT NULL,
  `unit_price` int(255) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) DEFAULT 0,
  `add_date` date NOT NULL,
  `id` int(11) NOT NULL,
  `imag1` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pr_id`, `product_name`, `description`, `pro_category`, `season`, `unit_price`, `qty`, `discount`, `add_date`, `id`, `imag1`) VALUES
(3, 'kinigi', 'sfdfghgdfffffqwweeew', 'Patotoes', 'A', 200, 90, 0, '2022-03-20', 2, '1647781283IMG-20220209-WA0015.jpg'),
(4, 'flesh', 'heloo', 'Cassava', 'B', 300, 6000, 0, '2022-03-20', 2, '1647794688IMG-20220209-WA0015.jpg'),
(5, ' buryohe', 'jhsvhdsbhf jssdhshf', ' Rice', 'C', 380, 904, 350, '2022-03-20', 22, '1647804478IMG-20220209-WA0015.jpg'),
(9, 'kigoli', 'sdfghjk', 'Cassava', 'B', 870, 900, 0, '2022-03-20', 22, '1647805528IMG-20220209-WA0009.jpg'),
(10, 'Rumarinki', 'sgdhfjtyju', 'Beans', 'B', 1000, 900, 0, '2022-03-20', 22, '1647806452IMG-20220209-WA0009.jpg'),
(11, ' kuruza', 'wgehrijty', ' Patotoes', 'B', 1000, 90, 950, '2022-03-20', 22, '1647807059IMG-20220209-WA0009.jpg'),
(12, 'shyushya', 'dfghjgfdghjk', 'Beans', 'A', 880, 9885, 0, '2022-03-21', 2, '1647870626IMG-20220209-WA0015.jpg'),
(13, 'cooperative', 'rtyuij', 'Beans', 'B', 900, 900, 0, '2022-03-25', 2, '1647871569IMG-20220209-WA0015.jpg'),
(14, 'carrot', 'sfdghjj', 'Vegetables', 'C', 34567, 6666, 0, '2022-03-21', 2, '1647873275IMG-20220209-WA0015.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sms` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `submitted_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `hist_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `pro_category` varchar(255) NOT NULL,
  `season` varchar(255) DEFAULT NULL,
  `unit_price` int(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `action_date` date NOT NULL,
  `action_happened` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_history`
--

INSERT INTO `tbl_history` (`hist_id`, `id`, `pr_id`, `product_name`, `pro_category`, `season`, `unit_price`, `qty`, `discount`, `action_date`, `action_happened`) VALUES
(1, 22, 1, 'buryohe', 'Rice', 'B', 170, 500, 0, '2022-03-20', 'Added'),
(2, 2, 2, 'amajoni', 'Beans', 'A', 300, 900, 0, '2022-03-20', 'Added'),
(3, 2, 3, 'kinigi', 'Patotoes', 'A', 200, 330, 0, '2022-03-20', 'Added'),
(4, 2, 4, 'flesh', 'Cassava', 'B', 300, 5000, 0, '2022-03-20', 'Added'),
(5, 22, 1, ' buryohe', ' Rice', 'B', 170, 500, 150, '2022-03-20', 'Updated'),
(6, 2, 2, ' amajoni', ' Beans', 'A', 300, 100, 0, '2022-03-20', 'Updated'),
(7, 2, 2, '  amajoni', '  Beans', 'A', 300, 1000, 270, '2022-03-20', 'Updated'),
(8, 2, 2, '   amajoni', '   Beans', 'A', 300, 0, 270, '2022-03-20', 'Updated'),
(9, 22, 1, ' buryohe', ' Rice', 'B', 170, 1000, 150, '2022-03-20', 'Deleted'),
(10, 2, 2, '   amajoni', '   Beans', 'A', 300, 2000, 270, '2022-03-20', 'Deleted'),
(11, 22, 5, 'buryohe', 'Rice', 'C', 380, 905, 0, '2022-03-20', 'Added'),
(12, 22, 6, 'others', 'Patotoes', 'A', 280, 700, 0, '2022-03-20', 'Added'),
(13, 22, 7, 'others', 'Vegetables', 'B', 100, 6400, 0, '2022-03-20', 'Added'),
(14, 22, 8, 'others', 'Rice', 'B', 544, 900, 0, '2022-03-20', 'Added'),
(15, 22, 8, 'others', 'Rice', 'B', 544, 877, 0, '2022-03-20', 'Updated'),
(16, 22, 9, 'others', 'Cassava', 'B', 870, 900, 0, '2022-03-20', 'Added'),
(17, 22, 8, 'others', 'Rice', 'B', 544, 6400, 0, '2022-03-20', 'Updated'),
(18, 22, 8, 'others', 'Rice', 'B', 544, 8177, 0, '2022-03-20', 'Deleted'),
(19, 22, 6, 'others', 'Patotoes', 'A', 280, 700, 0, '2022-03-20', 'Deleted'),
(20, 22, 7, 'others', 'Vegetables', 'B', 100, 6400, 0, '2022-03-20', 'Deleted'),
(21, 22, 0, 'others', 'Rice', 'A', 200, 990, 0, '2022-03-20', 'Added'),
(22, 22, 10, 'others', 'Beans', 'B', 1000, 900, 0, '2022-03-20', 'Added'),
(23, 22, 11, 'others', 'Patotoes', 'B', 1000, 90, 0, '2022-03-20', 'Added'),
(24, 22, 11, ' kuruza', ' Patotoes', 'B', 1000, 0, 950, '2022-03-20', 'Updated'),
(25, 22, 5, ' buryohe', ' Rice', 'C', 380, 0, 350, '2022-03-20', 'Updated'),
(26, 2, 4, '', 'Cassava', '', 300, 100, 0, '2022-03-21', 'Ordered'),
(27, 2, 4, '', 'Cassava', '', 300, 900, 0, '2022-03-21', 'Ordered'),
(28, 2, 4, '', 'Cassava', '', 300, 700, 0, '2022-03-21', 'Ordered'),
(29, 2, 3, '', 'Patotoes', '', 200, 30, 0, '2022-03-21', 'Ordered'),
(30, 2, 3, '', 'Patotoes', '', 200, 90, 0, '2022-03-21', 'Ordered'),
(31, 2, 3, '', 'Patotoes', '', 200, 300, 0, '2022-03-21', 'Ordered'),
(32, 2, 12, 'shyushya', 'Beans', 'A', 880, 98, 0, '2022-03-21', 'Added'),
(33, 2, 13, 'cooperative', 'Beans', 'B', 900, 900, 0, '2022-03-21', 'Added'),
(34, 2, 12, 'shyushya', 'Beans', 'A', 880, 899, 0, '2022-03-21', 'Updated'),
(35, 2, 12, 'shyushya', 'Beans', 'A', 880, 8888, 0, '2022-03-21', 'Updated'),
(36, 2, 14, 'carrot', 'Vegetables', 'C', 34567, 6666, 0, '2022-03-21', 'Added'),
(37, 22, 5, '', ' Rice', '', 380, 1, 0, '2022-03-21', 'Ordered');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipping`
--

CREATE TABLE `tbl_shipping` (
  `shipping_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(20) NOT NULL,
  `telphone` int(11) NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `cell` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `order_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `telphone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `tin_number` int(11) DEFAULT 0,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `cell` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `joined_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `status_code` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `telphone`, `gender`, `tin_number`, `province`, `district`, `sector`, `cell`, `village`, `role`, `joined_date`, `profile_pic`, `status`, `status_code`) VALUES
(2, 'Fidel', 'NDAYISHIMIYE', 'test@gmail.com', '202cb962ac59075b964b07152d234b70', '0780494005', 'male', 111655378, 'East', 'Kayonza', 'Nyamirama', 'Musumba', 'Nyarunazi', 'depositer', '2022-02-08', 'avatar5.png', 1, 'Activated'),
(11, 'Admin User', 'Fidel', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0780494006', 'male', 1118743, 'Kigali', 'Kicukiro', 'Kigarama', 'Rwampara', 'Ubumwe', 'administrator', '2022-03-11', '1647280959user8-128x128.jpg', 1, ''),
(22, 'Fabrice', 'NTIBITURA', '', 'e10adc3949ba59abbe56e057f20f883e', '0788335572', 'Female', 111, 'Kigali', 'Kicukiro', 'Nyarugunga', 'Nonko', 'Mahoro', 'depositer', '2022-03-20', 'avatar4.png', 1, 'Activated'),
(23, 'fidele', 'NDAYISHIMIYE', 'test11@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '0780494000', 'male', 11111, 'Kigali', 'Kicukiro', 'Masaka', 'Cyimo', 'Kiyovu', 'depositer', '2022-03-20', 'avatar4.png', 1, 'Disactivated');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `pr_id` (`pr_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cart_id` (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `pr_id` (`pr_id`);

--
-- Indexes for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`hist_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  ADD PRIMARY KEY (`shipping_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `hist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
