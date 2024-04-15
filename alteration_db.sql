-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 10:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alteration_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_registration`
--

CREATE TABLE `admin_registration` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_registration`
--

INSERT INTO `admin_registration` (`id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Siti Ayu', 'admin123@gmail.com', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `alteration_services`
--

CREATE TABLE `alteration_services` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alteration_services`
--

INSERT INTO `alteration_services` (`id`, `category`, `subcategory`, `name`, `price`, `image_path`) VALUES
(4, 'Basic Alteration', 'Pants Alteration', 'Jeans Hems', 15.00, '../uploaded_files/jeansHem.png'),
(5, 'Basic Alteration', 'Pants Alteration', 'Normal Pants Hem', 6.00, '../uploaded_files/normalHem.png'),
(9, 'Basic Alteration', 'Pants Alteration', 'Tapering The Pants', 13.00, '../uploaded_files/taperingpants.png'),
(10, 'Basic Alteration', 'Pants Alteration', 'Adjust Waist', 15.00, '../uploaded_files/adjustwaist.png'),
(11, 'Basic Alteration', 'T-Shirt Alteration', 'Sleeve Shortening', 12.00, '../uploaded_files/sleevesshortening.png'),
(12, 'Basic Alteration', 'T-Shirt Alteration', 'Side Taking In/Out (Easy)', 6.00, '../uploaded_files/takinginoutt.png'),
(13, 'Basic Alteration', 'T-Shirt Alteration', 'Side Taking In/Out (Hard)', 20.00, '../uploaded_files/takinginoutt.png'),
(15, 'Basic Alteration', 'T-Shirt Alteration', 'Darts Adding', 14.00, '../uploaded_files/adding_darts.png'),
(16, 'Premium Alteration', 'Zip Alteration', 'Repair Jeans Zip', 15.00, '../uploaded_files/jeans-Zip.png'),
(17, 'Premium Alteration', 'Zip Alteration', 'Repair Slack Zip', 15.00, '../uploaded_files/slack-Zip.png'),
(18, 'Premium Alteration', 'Zip Alteration', 'Repair Jacket Zip', 20.00, '../uploaded_files/jacket_zip.jpg'),
(19, 'Premium Alteration', 'Dress Alteration', 'Hem Shortening', 12.00, '../uploaded_files/dress-Shortening.png'),
(20, 'Premium Alteration', 'Dress Alteration', 'Side Taking In/Out (Easy)', 15.00, '../uploaded_files/takinginout-Dress-.png'),
(21, 'Premium Alteration', 'Dress Alteration', 'Side Taking In/Out (Hard)', 25.00, '../uploaded_files/takinginout-Dress-.png'),
(22, 'Premium Alteration', 'Dress Alteration', 'Sleeve Shortening', 17.00, '../uploaded_files/dress-Sleeve.png'),
(23, 'Premium Alteration', 'Dress Alteration', 'Darts Adding', 13.00, '../uploaded_files/darts-Bajukurung.png'),
(24, 'Premium Alteration', 'Zip Alteration', 'Adding/Repair Zip For Dress', 15.00, '../uploaded_files/dress-RepairZip.png'),
(25, 'Premium Alteration', 'School Alteration', 'Hem Shortening Of Skirt/Pinafore', 6.00, '../uploaded_files/hem-shortening-school.png'),
(26, 'Premium Alteration', 'School Alteration', 'Hem Shortening Of Trousers', 6.00, '../uploaded_files/hem-school-trousers.png'),
(27, 'Premium Alteration', 'School Alteration', 'Adjust Waist', 15.00, '../uploaded_files/adjust-waist-school.png'),
(28, 'Premium Alteration', 'School Alteration', 'Sleeve Shortening', 10.00, '../uploaded_files/sleeve-short-school.png'),
(29, 'Premium Alteration', 'School Alteration', 'Adjust The Shirts Size', 13.00, '../uploaded_files/adjust-school.png'),
(30, 'Premium Alteration', 'Zip Alteration', 'Repair Zip (School)', 15.00, '../uploaded_files/zip-school-.png'),
(31, 'Premium Alteration', 'School Alteration', 'Replacing Button', 5.00, '../uploaded_files/replacing-btn-school.png'),
(32, 'Premium Alteration', 'School Alteration', 'Repair Tears Or Rips', 10.00, '../uploaded_files/tears-reaps-school.png'),
(33, 'Premium Alteration', 'School Alteration', 'Adding School Badge', 4.00, '../uploaded_files/school-lencana.png'),
(34, 'Premium Alteration', 'School Alteration', 'Tapering The Trousers', 13.00, '../uploaded_files/school-tapering.png'),
(35, 'Others', 'Curtain Alteration', 'Length Adjustment', 10.00, '../uploaded_files/curtainLength.png'),
(36, 'Others', 'Curtain Alteration', 'Width Adjustment', 10.00, '../uploaded_files/curtainWidth.png'),
(37, 'Others', 'Curtain Alteration', 'Repairing Damages', 10.00, '../uploaded_files/curtainDamage.png'),
(38, 'Others', 'General Alteration', 'Adding Shoulder Pads', 8.00, '../uploaded_files/shoulderPads.png'),
(39, 'Others', 'General Alteration', 'Repair Reap/Tears', 8.00, '../uploaded_files/rippedJacket.png'),
(40, 'Others', 'General Alteration', 'Add Button', 3.00, '../uploaded_files/addButton.jpg'),
(42, 'Others', 'General Alteration', 'Change Waistband Elastic', 12.00, '../uploaded_files/waistbandElastic.png');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Pants Alteration'),
(2, 'T-Shirt & Shirt Alteration'),
(3, 'Zip Alteration'),
(4, 'Dress or Cloak Alteration'),
(5, 'School Alteration'),
(6, 'Curtain Alteration'),
(7, 'General Clothing Repair Alteration');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone_number`, `message`, `submitted_at`, `is_read`, `user_id`) VALUES
(1, 'Qaira Aleesya', 'qaleesya@gmail.com', '0186734521', 'Hello, I will pick up my item by the deadline you gave, thank you.', '2024-03-31 01:39:04', 1, 3),
(2, 'Mark Lee', 'mark@gmail.com', '0173245643', 'Thank you for your service!', '2024-03-31 01:45:55', 1, 2),
(4, 'Nurul Nabillah', 'nabillah26@gmail.com', '0173989241', 'The item is in good condition, thank you so much!', '2024-03-31 01:57:39', 1, 1),
(16, 'Qaira Aleesya', 'qaleesya@gmail.com', '0186734521', 'Thank you!', '2024-04-14 08:28:25', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `due_date`, `payment_method`, `status`) VALUES
(1, 1, '2024-03-29', '2024-03-30', 'QR', 'Completed'),
(3, 2, '2024-03-29', '2024-03-31', 'QR', 'Completed'),
(4, 3, '2024-03-31', '2024-04-03', 'Cash', 'Ready to Pickup'),
(5, 4, '2024-04-01', '2024-04-03', 'Cash', 'In Progress'),
(7, 5, '2024-04-02', '2024-04-04', 'Cash', 'Ready to Pickup'),
(8, 7, '2024-04-02', '2024-04-02', 'QR', 'Ready to Pickup'),
(9, 8, '2024-04-11', '2024-04-15', 'QR', 'In Progress'),
(10, 9, '2024-04-15', '2024-04-17', 'QR', 'In Progress');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `service_id`, `quantity`) VALUES
(1, 1, 26, 1),
(4, 3, 1, 1),
(5, 3, 3, 1),
(6, 4, 16, 1),
(7, 4, 13, 1),
(8, 4, 5, 1),
(9, 5, 20, 2),
(11, 7, 16, 1),
(12, 7, 31, 2),
(13, 8, 26, 1),
(14, 9, 27, 1),
(15, 9, 30, 2),
(16, 9, 3, 1),
(17, 10, 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_tracking`
--

CREATE TABLE `order_tracking` (
  `tracking_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_tracking`
--

INSERT INTO `order_tracking` (`tracking_id`, `order_id`, `status`, `update_time`) VALUES
(5, 1, 'Not in Progress', '2024-03-30 06:48:09'),
(6, 3, 'Not in Progress', '2024-03-30 07:25:05'),
(7, 1, 'In Progress', '2024-03-30 07:25:56'),
(8, 1, 'Ready to Pickup', '2024-03-30 07:27:08'),
(9, 3, 'Not in Progress', '2024-03-30 07:49:38'),
(10, 1, 'Not in Progress', '2024-03-30 08:14:23'),
(11, 3, 'Not in Progress', '2024-03-30 08:19:14'),
(12, 3, 'Not in Progress', '2024-03-30 08:19:48'),
(13, 3, 'Not in Progress', '2024-03-30 08:20:17'),
(14, 3, 'In Progress', '2024-03-30 08:20:54'),
(15, 3, 'In Progress', '2024-03-30 08:25:31'),
(16, 1, 'In Progress', '2024-03-30 08:27:46'),
(17, 1, 'In Progress', '2024-03-30 08:28:26'),
(18, 1, 'In Progress', '2024-03-30 08:28:33'),
(19, 1, 'Picked Up', '2024-03-30 08:29:26'),
(20, 1, 'Ready to Pickup', '2024-03-30 08:30:25'),
(21, 1, 'Ready to Pickup', '2024-03-30 08:30:43'),
(22, 1, 'Not in Progress', '2024-03-30 08:35:25'),
(23, 1, 'In Progress', '2024-03-30 08:35:40'),
(24, 1, 'In Progress', '2024-03-30 08:36:35'),
(25, 1, 'Ready to Pickup', '2024-03-30 08:36:57'),
(26, 1, 'In Progress', '2024-03-30 08:55:20'),
(27, 1, 'Ready to Pickup', '2024-03-30 08:57:08'),
(28, 1, 'Ready to Pickup', '2024-03-30 08:57:20'),
(29, 1, 'Picked Up', '2024-03-30 08:57:25'),
(30, 1, 'Picked Up', '2024-03-30 08:58:51'),
(31, 1, 'Picked Up', '2024-03-30 09:00:02'),
(32, 1, 'In Progress', '2024-03-30 09:00:06'),
(33, 1, 'In Progress', '2024-03-30 09:05:32'),
(34, 1, 'In Progress', '2024-03-30 09:05:40'),
(35, 1, 'In Progress', '2024-03-30 09:05:47'),
(36, 1, 'Not in Progress', '2024-03-30 09:05:48'),
(37, 1, 'Not in Progress', '2024-03-30 09:05:48'),
(38, 1, 'Not in Progress', '2024-03-30 09:05:49'),
(39, 1, 'Not in Progress', '2024-03-30 09:05:49'),
(40, 1, 'Not in Progress', '2024-03-30 09:05:49'),
(41, 1, 'Not in Progress', '2024-03-30 09:06:25'),
(42, 1, 'In Progress', '2024-03-30 09:06:29'),
(43, 1, 'In Progress', '2024-03-30 09:48:31'),
(44, 1, 'Ready to Pickup', '2024-03-30 09:48:41'),
(45, 1, 'Ready to Pickup', '2024-03-30 09:53:26'),
(46, 1, 'Ready to Pickup', '2024-03-30 09:54:00'),
(47, 1, 'In Progress', '2024-03-30 10:00:21'),
(48, 1, 'Ready to Pickup', '2024-03-30 10:00:30'),
(49, 1, 'Ready to Pickup', '2024-03-30 10:00:35'),
(50, 3, 'Ready to Pickup', '2024-03-30 14:14:58'),
(51, 3, 'Ready to Pickup', '2024-03-30 14:15:05'),
(52, 3, 'Picked Up', '2024-03-30 14:43:56'),
(53, 4, 'In Progress', '2024-03-30 15:48:15'),
(54, 4, 'In Progress', '2024-03-30 15:48:23'),
(55, 4, 'Not in Progress', '2024-03-30 15:48:41'),
(56, 4, 'Not in Progress', '2024-03-30 15:48:50'),
(57, 4, 'In Progress', '2024-03-30 15:49:13'),
(58, 4, 'Not in Progress', '2024-03-30 15:49:14'),
(59, 4, 'Not in Progress', '2024-03-30 15:49:43'),
(60, 4, 'In Progress', '2024-03-30 15:49:46'),
(61, 4, 'In Progress', '2024-03-30 15:49:51'),
(62, 4, 'In Progress', '2024-03-30 15:49:55'),
(63, 4, 'Not in Progress', '2024-03-30 15:52:36'),
(64, 4, 'Not in Progress', '2024-03-30 15:52:47'),
(65, 4, 'In Progress', '2024-03-30 15:53:01'),
(66, 4, 'In Progress', '2024-03-30 15:53:15'),
(67, 4, 'In Progress', '2024-03-30 15:54:29'),
(68, 4, 'Not in Progress', '2024-03-30 15:54:36'),
(69, 4, 'In Progress', '2024-03-30 15:54:58'),
(70, 4, 'Not in Progress', '2024-03-30 15:55:01'),
(71, 4, 'Not in Progress', '2024-03-30 15:55:39'),
(72, 4, 'In Progress', '2024-03-30 15:55:42'),
(73, 4, 'In Progress', '2024-03-30 15:55:47'),
(74, 4, 'Not in Progress', '2024-03-30 15:55:59'),
(76, 4, 'In Progress', '2024-03-30 16:02:37'),
(77, 3, 'Completed', '2024-03-31 08:04:29'),
(78, 1, 'Picked Up', '2024-03-31 08:05:29'),
(79, 5, 'In Progress', '2024-04-01 04:42:37'),
(80, 1, 'Completed', '2024-04-01 07:19:48'),
(81, 4, 'Ready to Pickup', '2024-04-01 14:12:42'),
(82, 4, 'Picked Up', '2024-04-01 14:12:59'),
(83, 4, 'Ready to Pickup', '2024-04-01 14:13:20'),
(84, 7, 'In Progress', '2024-04-02 00:52:11'),
(85, 7, 'Ready to Pickup', '2024-04-02 01:23:04'),
(86, 8, 'In Progress', '2024-04-02 04:06:44'),
(87, 8, 'Ready to Pickup', '2024-04-02 04:07:21'),
(88, 9, 'In Progress', '2024-04-15 00:16:33'),
(89, 10, 'In Progress', '2024-04-15 00:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `category_id`, `name`, `price`) VALUES
(1, 1, 'Jeans Hem', 15.00),
(2, 1, 'Normal Pants Hem', 6.00),
(3, 1, 'Slack Hem', 15.00),
(4, 1, 'Tapering the Pants', 13.00),
(5, 1, 'Adjust Waist', 15.00),
(6, 2, 'Sleeve Shortening', 12.00),
(7, 2, 'Side Taking In/Out (Easy)', 6.00),
(8, 2, 'Hem Shortening', 10.00),
(9, 2, 'Darts Adding', 14.00),
(10, 3, 'Repair Jeans zip', 15.00),
(11, 3, 'Repair Slack Zip', 15.00),
(12, 3, 'Repair Jacket Zip', 20.00),
(13, 4, 'Hem Shortening', 12.00),
(14, 4, 'Side Taking In/Out (Easy)', 15.00),
(15, 4, 'Sleeve Shortening', 17.00),
(16, 4, 'Darts Adding', 13.00),
(17, 3, 'Adding/Repair zip', 15.00),
(18, 5, 'Hem Shortening of Skirt/Pinafore', 6.00),
(19, 5, 'Adjust Waist', 15.00),
(20, 5, 'Sleeve Shortening', 10.00),
(21, 3, 'Repair zip (School)', 15.00),
(22, 5, 'Replacing button', 5.00),
(23, 5, 'Repair tears or rips', 10.00),
(24, 5, 'Adding school badge', 4.00),
(25, 5, 'Tapering the Trousers', 13.00),
(26, 6, 'Length Adjustment', 10.00),
(27, 6, 'Width Adjustment', 10.00),
(28, 6, 'Repairing Damages', 10.00),
(29, 7, 'Adding Shoulder Pads', 8.00),
(30, 7, 'Repair Reap/Tears', 8.00),
(31, 7, 'Add Button', 3.00),
(32, 7, 'Change Waistband Elastic', 12.00),
(33, 2, 'Side Taking In/Out (Hard)', 20.00),
(34, 4, 'Side Taking In/Out (Hard)', 25.00),
(35, 5, 'Hem Shortening Of Trousers', 6.00),
(36, 5, 'Adjust The Shirts Size', 13.00);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `full_name`, `phone_number`, `email`, `gender`, `created_at`, `updated_at`) VALUES
(2, 'Noraini Yubita', '0183569035', 'yubita1096@gmail.com', 'Female', '2024-03-14 20:24:57', '2024-04-15 00:52:00'),
(8, 'Adam Mikhael', '0177071621', 'mikhael28@gmail.com', 'Male', '2024-03-14 20:37:29', '2024-04-14 04:02:39'),
(17, 'Abdul Mahir', '0179632444', 'mahir123@gmail.com', 'Male', '2024-04-01 03:41:33', '2024-04-01 03:41:33'),
(19, 'Najiha', '0128967453', 'najiha@gmail.com', 'Female', '2024-04-15 00:52:43', '2024-04-15 00:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `id` int(11) NOT NULL,
  `user_name` varchar(125) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`id`, `user_name`, `user_email`, `user_phone`, `user_password`) VALUES
(1, 'Nurul Nabillah', 'nabillah2606@gmail.com', '0173989241', '$2y$10$VuAX8.7LDHDhIAZmb8.yLO9q3jrlnMIOYVI.kO3tjpD6kpDJGfUBa'),
(2, 'Mark Lee', 'mark@gmail.com', '0173245643', '$2y$10$3apFyKoyROMO6SP39G5o5.C4zQY79kY6YvGXYhHGQOv3PgoQvnPm6'),
(3, 'Qaira Aleesya', 'qaleesya@gmail.com', '0186734521', '$2y$10$m9QoNG1xq8Fz5iquQSzal.XJr/KT9iPtHj.iDSAEQuIRi3qR8SIry'),
(4, 'Al-Qoyyum', 'oyum123@gmail.com', '0123487654', '$2y$10$qwmDacZdfMCk3uhUpysvpePM5q6wKKpsmnIRK7BYfLSZKbvuL7u1q'),
(5, 'Aliya', 'aliya@gmail.com', '0125434564', '$2y$10$4wYrfnqBWtZDX37D/nyUQ.ZhJ/G3G2TO5KsXgd5cdhXNZpiBFgeRG'),
(6, 'Azwa', 'azwa@gmail.com', '0172345678', '$2y$10$xcbAxzq.KtTzFOTBs67Tk.cpW9O908Igqg4MophqWDyBOjr189PwO'),
(7, 'Nabillah', 'nabillah@gmail.com', '0173987543', '$2y$10$yu9Jt/wigQrKWb2B6SVSCup0H.oyCW6RA3HAGYdjQLZH4u6h8uWY.'),
(8, 'Hariza', 'hariza@gmail.com', '0173345627', '$2y$10$XnjYfpWyK5mOdp08QTkYk.bN98aq3A6XfNTStHDtrT.IqR19GOCZW'),
(9, 'Sarah', 'sarah2@gmail.com', '0182736453', '$2y$10$TFVt/cRHTcnN9DcQTVuZl.r5PsBLs5NwpQMEP1kKUV6Td9GLltlli');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_registration`
--
ALTER TABLE `admin_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alteration_services`
--
ALTER TABLE `alteration_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD PRIMARY KEY (`tracking_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_registration`
--
ALTER TABLE `admin_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `alteration_services`
--
ALTER TABLE `alteration_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_tracking`
--
ALTER TABLE `order_tracking`
  MODIFY `tracking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD CONSTRAINT `contact_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_registration` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `user_registration` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD CONSTRAINT `order_tracking_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
