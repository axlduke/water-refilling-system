-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2022 at 02:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tps_water`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `user_id` int(8) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `access_level` varchar(30) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(30) DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `user_id`, `username`, `password`, `access_level`, `date_added`, `status`) VALUES
(00000001, 100001, '100001', 'admin', 'admin', '2022-07-12 04:59:01', 'active'),
(00000002, 500001, '500001', '500001', 'cashier', '2022-06-26 11:34:58', 'active'),
(00000003, 808, 'sadmin', 'sadmin1234', 'sysadmin', '2022-08-12 09:22:19', 'active'),
(00000004, 100002, '100002', 'pcobilla21', 'admin', '2022-08-12 09:24:52', 'active'),
(00000005, 100003, '100003', '301ree3r', 'admin', '2022-10-03 03:29:50', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

CREATE TABLE `cashier` (
  `cashier_id` int(8) NOT NULL,
  `cashier_name` varchar(30) NOT NULL,
  `b_date` date NOT NULL,
  `address` varchar(30) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashier`
--

INSERT INTO `cashier` (`cashier_id`, `cashier_name`, `b_date`, `address`, `date_added`) VALUES
(500001, 'samp_cash', '2022-06-26', 'Albay', '2022-06-26 11:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(8) NOT NULL,
  `schedule_id` int(8) NOT NULL,
  `sales_id` int(8) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `customer` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintenance_id` int(8) NOT NULL,
  `machine_name` varchar(30) NOT NULL,
  `machine_status` varchar(30) NOT NULL,
  `check_date` date NOT NULL,
  `checker` varchar(30) NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`maintenance_id`, `machine_name`, `machine_status`, `check_date`, `checker`, `remarks`) VALUES
(1, 'filter machine', 'Good Condition: Working', '2022-07-24', 'cobilla', 'next checkup: 07-24-2022'),
(5, 'Filtering Machine 2001-14', 'Good Condition', '2022-07-24', 'Cobilla', 'Next schedule: 8-24-2022 '),
(6, 'Filtering Machine 2001-15', 'Under Maitenance', '2022-07-24', 'Cobilla', 'Next schedule: 8-25-2022 ');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(8) NOT NULL,
  `o_name` varchar(30) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `o_name`, `date_added`) VALUES
(100001, 'samp_owner', '2022-07-12 06:19:18'),
(100002, 'Patrick Cobilla', '2022-08-12 09:23:08'),
(100003, 'Mark Limpo', '2022-10-03 03:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `product_name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `product_description` varchar(100) CHARACTER SET latin1 NOT NULL,
  `product_price` decimal(8,2) NOT NULL,
  `product_type` varchar(30) CHARACTER SET latin1 NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB AVG_ROW_LENGTH=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_price`, `product_type`, `date_added`) VALUES
(00000001, 'Wikins Mineral Water 10L', 'Mineral Water 5liter refill', '10.00', 'Refill', '2022-08-12 09:26:21'),
(00000002, 'sample 2', 'sample 2', '200.00', 'sample', '2022-07-23 13:37:51'),
(00000003, 'sample 3', 'sample product 3', '500.00', 'sample', '2022-07-12 12:24:39'),
(00000004, 'sample 4', 'sample product 4', '750.00', 'sample', '2022-07-24 01:44:31'),
(00000005, 'Mineral Water 1liter', 'Mineral Water 1liter', '50.00', 'With Bottle', '2022-07-23 10:14:27'),
(00000006, 'Mineral Water 500ml', 'Mineral Water 500ml bottled', '25.00', 'With Bottle', '2022-07-23 06:25:08'),
(00000007, 'Mineral Water 1Gl Refill', 'Mineral Water 1Gallon Refill', '25.00', 'Refill', '2022-07-23 10:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `product_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `no_item` decimal(8,2) NOT NULL,
  `sales_total` decimal(10,2) NOT NULL,
  `user_id` int(8) NOT NULL,
  `sales_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `trans_no` int(10) NOT NULL,
  `product_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `product_id`, `no_item`, `sales_total`, `user_id`, `sales_date`, `trans_no`, `product_price`) VALUES
(00000001, 00000001, '2.00', '2.00', 500001, '2022-07-13 14:34:54', 1, '1.00'),
(00000002, 00000002, '5.00', '1000.00', 500001, '2022-07-13 14:34:53', 2, '200.00'),
(00000003, 00000003, '3.00', '600.00', 500001, '2022-07-17 14:41:27', 3, '200.00'),
(00000004, 00000003, '3.00', '600.00', 500001, '2022-07-13 13:35:27', 3, '200.00'),
(00000005, 00000003, '3.00', '1500.00', 500001, '2022-07-13 13:42:52', 4, '500.00'),
(00000006, 00000004, '1.00', '750.00', 500001, '2022-07-13 13:54:40', 4, '750.00'),
(00000007, 00000003, '4.00', '2000.00', 500001, '2022-07-13 14:16:06', 5, '500.00'),
(00000008, 00000004, '3.00', '2250.00', 500001, '2022-07-13 14:17:13', 6, '750.00'),
(00000009, 00000003, '5.00', '2500.00', 500001, '2022-07-13 14:18:49', 7, '500.00'),
(00000010, 00000003, '12.00', '6000.00', 500001, '2022-07-13 14:40:13', 8, '500.00'),
(00000011, 00000002, '2.00', '400.00', 500001, '2022-07-13 14:40:55', 8, '200.00'),
(00000013, 00000002, '2.00', '400.00', 500001, '2022-07-14 14:08:59', 9, '200.00'),
(00000014, 00000003, '6.00', '3000.00', 500001, '2022-07-20 06:37:45', 10, '500.00'),
(00000015, 00000002, '10.00', '2000.00', 500001, '2022-07-20 06:42:04', 11, '200.00'),
(00000016, 00000003, '3.00', '1500.00', 500001, '2022-07-20 06:42:13', 11, '500.00'),
(00000017, 00000002, '2.00', '400.00', 500001, '2022-07-21 02:45:09', 12, '200.00'),
(00000018, 00000005, '10.00', '500.00', 500001, '2022-07-23 06:20:23', 13, '50.00'),
(00000019, 00000007, '10.00', '250.00', 500001, '2022-07-23 10:10:53', 14, '25.00'),
(00000020, 00000005, '10.00', '500.00', 500001, '2022-07-23 10:11:30', 14, '50.00'),
(00000021, 00000007, '4.00', '100.00', 500001, '2022-07-26 03:22:23', 15, '25.00'),
(00000022, 00000005, '12.00', '600.00', 500001, '2022-07-26 03:22:49', 15, '50.00'),
(00000023, 00000001, '10.00', '100.00', 500001, '2022-08-12 09:31:53', 16, '10.00'),
(00000025, 00000007, '12.00', '300.00', 500001, '2022-09-05 23:27:22', 17, '25.00'),
(00000026, 00000005, '11.00', '550.00', 500001, '2022-09-05 23:37:15', 18, '50.00'),
(00000027, 00000007, '10.00', '250.00', 500001, '2022-09-06 06:37:59', 19, '25.00'),
(00000028, 00000007, '11.00', '275.00', 500001, '2022-09-06 06:41:48', 20, '25.00');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(8) NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_time` time NOT NULL,
  `delivery_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stocks_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `s_description` varchar(30) NOT NULL,
  `s_name` varchar(30) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `brand` varchar(45) NOT NULL,
  `s_unit` varchar(30) NOT NULL,
  `s_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stocks_id`, `s_description`, `s_name`, `date_added`, `brand`, `s_unit`, `s_price`) VALUES
(00000001, 'Wilkins mineral water 1 liter', 'wilkin 1l', '2022-07-24 12:54:53', 'Wilkins', 'liter', '15.00');

-- --------------------------------------------------------

--
-- Table structure for table `stocks_delivery`
--

CREATE TABLE `stocks_delivery` (
  `s_delivery_id` int(8) NOT NULL,
  `stocks_id` int(8) NOT NULL,
  `qty` int(8) NOT NULL,
  `sd_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stocks_delivery`
--

INSERT INTO `stocks_delivery` (`s_delivery_id`, `stocks_id`, `qty`, `sd_date`) VALUES
(1, 1, 10, '2022-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `csales_id` int(8) NOT NULL,
  `trans_no` int(8) UNSIGNED ZEROFILL NOT NULL,
  `csales_total` decimal(10,2) NOT NULL,
  `date_sales` date NOT NULL,
  `sales_status` varchar(30) NOT NULL DEFAULT 'cash',
  `cashier_id` int(8) NOT NULL,
  `remarks` varchar(45) NOT NULL,
  `del_status` varchar(45) NOT NULL DEFAULT 'pickup',
  `del_stat` varchar(45) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`csales_id`, `trans_no`, `csales_total`, `date_sales`, `sales_status`, `cashier_id`, `remarks`, `del_status`, `del_stat`) VALUES
(1, 00000001, '1000.00', '2022-05-13', 'Cash', 500001, 'name of Person to Deliver', 'delivery', 'pending'),
(2, 00000002, '1000.00', '2022-05-13', 'Cash', 500001, 'pickup', 'pickup', ''),
(3, 00000003, '1200.00', '2022-05-13', 'Cash', 500001, 'pickup', 'pickup', ''),
(4, 00000004, '2250.00', '2022-06-13', 'Cash', 500001, '-', 'pickup', ''),
(5, 00000005, '2000.00', '2022-06-13', 'Cash', 500001, 'Mr. Cobilla', 'delivery', 'pending'),
(6, 00000006, '2250.00', '2022-07-13', 'Cash', 500001, '-', 'pickup', ''),
(7, 00000007, '2500.00', '2022-07-13', 'Cash', 500001, '-', 'pickup', ''),
(8, 00000008, '9000.00', '2022-07-14', 'Cash', 500001, '-', 'pickup', ''),
(9, 00000009, '400.00', '2022-07-17', 'Cash', 500001, '-', 'pickup', ''),
(10, 00000010, '3000.00', '2022-07-20', 'Cash', 500001, '-', 'pickup', 'pending'),
(11, 00000011, '3500.00', '2022-07-20', 'Cash', 500001, 'Mr. Velasco', 'delivery', 'pending'),
(12, 00000012, '400.00', '2022-07-21', 'Cash', 500001, 'name of Person to Deliver', 'delivery', 'pending'),
(13, 00000013, '500.00', '2022-07-23', 'Cash', 500001, '-', 'pickup', 'pending'),
(14, 00000014, '750.00', '2022-07-23', 'Cash', 500001, 'Cobilla', 'delivery', 'pending'),
(15, 00000015, '700.00', '2022-07-26', 'Cash', 500001, 'customer 123', 'delivery', 'pending'),
(16, 00000016, '100.00', '2022-08-12', 'Cash', 500001, 'malto - 2:00pm', 'delivery', 'Delivered'),
(17, 00000017, '300.00', '2022-09-06', 'Cash', 500001, '-', 'pickup', 'pending'),
(18, 00000018, '550.00', '2022-09-06', 'Cash', 500001, '-', 'delivery', 'Delivered'),
(19, 00000019, '250.00', '2022-09-06', 'Cash', 500001, '-', 'other', 'pending'),
(20, 00000020, '275.00', '2022-09-06', 'Cash', 500001, '-', 'other', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `cashier`
--
ALTER TABLE `cashier`
  ADD PRIMARY KEY (`cashier_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`maintenance_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stocks_id`);

--
-- Indexes for table `stocks_delivery`
--
ALTER TABLE `stocks_delivery`
  ADD PRIMARY KEY (`s_delivery_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`csales_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cashier`
--
ALTER TABLE `cashier`
  MODIFY `cashier_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=500002;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `maintenance_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100004;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stocks_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stocks_delivery`
--
ALTER TABLE `stocks_delivery`
  MODIFY `s_delivery_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `csales_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
