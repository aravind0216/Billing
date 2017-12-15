-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2017 at 07:56 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billing`
--

-- --------------------------------------------------------

--
-- Table structure for table `bhis`
--

CREATE TABLE `bhis` (
  `b_id` varchar(90) NOT NULL,
  `date` varchar(90) NOT NULL,
  `pay` double NOT NULL,
  `status` int(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `b_id` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gstin` varchar(90) NOT NULL,
  `stot` double NOT NULL,
  `sgst` double NOT NULL,
  `cgst` double NOT NULL,
  `tot` double NOT NULL,
  `duedate` varchar(100) NOT NULL,
  `mode` varchar(100) NOT NULL,
  `pmode` varchar(100) NOT NULL,
  `advance` double NOT NULL,
  `balance` double NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_item`
--

CREATE TABLE `billing_item` (
  `b_id` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `s_price` double NOT NULL,
  `qty` double NOT NULL,
  `stot` double NOT NULL,
  `sgst` double NOT NULL,
  `sgst_amt` double NOT NULL,
  `cgst` double NOT NULL,
  `cgst_amt` double NOT NULL,
  `total` double NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `gstin` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fos`
--

CREATE TABLE `fos` (
  `id` int(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foswork`
--

CREATE TABLE `foswork` (
  `id` int(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `credit` double NOT NULL,
  `debit` double NOT NULL,
  `balance` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phis`
--

CREATE TABLE `phis` (
  `p_id` varchar(90) NOT NULL,
  `date` varchar(90) NOT NULL,
  `pay` double NOT NULL,
  `status` int(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(100) NOT NULL,
  `pro_id` varchar(90) NOT NULL,
  `date` varchar(100) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_price` int(100) NOT NULL,
  `d_price` double NOT NULL,
  `r_price` double NOT NULL,
  `c_price` double NOT NULL,
  `stock` int(100) NOT NULL,
  `sgst` float NOT NULL,
  `cgst` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `p_id` varchar(100) NOT NULL,
  `pdate` varchar(100) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gstin` varchar(90) NOT NULL,
  `stot` double NOT NULL,
  `sgst` double NOT NULL,
  `cgst` double NOT NULL,
  `tot` double NOT NULL,
  `duedate` varchar(100) NOT NULL,
  `mode` varchar(100) NOT NULL,
  `advance` double NOT NULL,
  `balance` double NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE `purchase_item` (
  `p_id` varchar(100) NOT NULL,
  `pdate` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `p_price` double NOT NULL,
  `qty` double NOT NULL,
  `stot` double NOT NULL,
  `sgst` double NOT NULL,
  `sgst_amt` double NOT NULL,
  `cgst` double NOT NULL,
  `cgst_amt` double NOT NULL,
  `total` double NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `user_img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `name`, `user`, `pass`, `email`, `mobile`, `role`, `user_img`) VALUES
(1, 'Admin', 'admin', 'admin', 'admin@gmail.com', '1234567890', 'Admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `gstin` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fos`
--
ALTER TABLE `fos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foswork`
--
ALTER TABLE `foswork`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `fos`
--
ALTER TABLE `fos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `foswork`
--
ALTER TABLE `foswork`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
