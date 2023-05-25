-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 03:25 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team110`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartments`
--

CREATE TABLE `apartments` (
  `apartment_id` int(11) NOT NULL,
  `apartment_address` varchar(100) NOT NULL,
  `apartment_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`apartment_id`, `apartment_address`, `apartment_type`) VALUES
(1000, '161-8044 Imperdiet St.', '1B1B'),
(1001, '4253 Varius Rd.', '2B1B'),
(1002, 'P.O. Box 711, 2067 Consectetuer Road', 'Studio'),
(1003, '7655 Feugiat Rd.', '1B1B'),
(1004, '334-1986 Eu Avenue', '2B1B'),
(1013, '4 wortley Ave,', '2 bed'),
(1014, 'tge test apartemt', '1 bedroom');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `email_id` int(11) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `email_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_created` timestamp NULL DEFAULT current_timestamp(),
  `email_sent` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`email_id`, `email_address`, `email_name`, `email_body`, `email_created`, `email_sent`) VALUES
(37, 'root@example.com', '111', '11111', '2023-05-09 21:18:00', 1),
(39, 'root1@example.com', 'test subject', 'This the email', '2023-05-09 21:48:44', 1),
(40, 'root@example.com', 'bad', 'bad', '2023-05-09 23:24:31', 1),
(43, 'root1@example.com', 'Test Test', 'I have an issue with this inspection', '2023-05-10 16:00:24', 1),
(44, 'root@example.com', 'Missing bedroom 78', 'No bedroom 78 here, floor is gone, where did the house go?', '2023-05-10 16:06:45', 1),
(45, 'root1@example.com', 'test dan', 'test dan', '2023-05-10 18:00:22', 1),
(47, 'root1@example.com', 'query test', 'query test adn', '2023-05-10 18:02:33', 1),
(48, 'dphe0001@student.monash.edu', 'Test Query Dan', 'Dan test this is a test', '2023-05-10 18:09:25', 1),
(50, 'root@example.com', 'what is it?', 'bnnbb', '2023-05-11 20:12:37', 1),
(51, 'root@example.com', 'send admin email', 'HI', '2023-05-11 20:18:10', 1),
(52, 'root@example.com', 'Quary test', 'Hi ', '2023-05-11 20:18:50', 1),
(54, 'root@example.com', 'aadmin', 'HHI', '2023-05-11 20:19:32', 1),
(55, 'root@example.com', 'ask about property', 'Hi ', '2023-05-14 08:43:24', 1),
(57, 'root1@example.com', 'Keys and deadline', 'Hello There,\r\n\r\nWhere to get the keys and when is the latest we can do?\r\n\r\nThanks', '2023-05-17 18:58:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `image_photo` varchar(255) NOT NULL,
  `image_description` text NOT NULL,
  `finishallinspection` tinyint(1) DEFAULT 0,
  `inspection_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inspections`
--

CREATE TABLE `inspections` (
  `inspection_id` int(11) NOT NULL,
  `inspection_datetime` date NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `apartment_id` int(11) NOT NULL,
  `inspection_status` varchar(20) DEFAULT 'Pending',
  `inspection_description` text DEFAULT NULL,
  `inspection_content` text DEFAULT NULL,
  `inspection_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inspections`
--

INSERT INTO `inspections` (`inspection_id`, `inspection_datetime`, `user_id`, `apartment_id`, `inspection_status`, `inspection_description`, `inspection_content`, `inspection_type`) VALUES
(10034, '2023-04-20', 29, 1000, 'Rejected', '', NULL, 'Other'),
(10037, '2023-04-24', 30, 1002, 'Rejected', '', NULL, NULL),
(10038, '2023-04-25', 30, 1004, 'Inspected', '', NULL, NULL),
(10039, '2023-05-03', 30, 1000, 'Rejected', 'aaa', '<figure class=\"image\" data-ckbox-resource-id=\"c37YChNXtltu\"><picture><source srcset=\"https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/c37YChNXtltu/images/147.webp 147w,https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/c37YChNXtltu/images/227.webp 227w,https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/c37YChNXtltu/images/307.webp 307w,https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/c37YChNXtltu/images/387.webp 387w,https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/c37YChNXtltu/images/467.webp 467w,https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/c37YChNXtltu/images/547.webp 547w\" type=\"image/webp\" sizes=\"(max-width: 547px) 100vw, 547px\"><img src=\"https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/c37YChNXtltu/images/547.webp\" alt=\"\"></picture></figure><p>Road with cars</p><figure class=\"image\" data-ckbox-resource-id=\"VbYNKv1twX9I\"><picture><source srcset=\"https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/VbYNKv1twX9I/images/115.webp 115w,https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/VbYNKv1twX9I/images/195.webp 195w,https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/VbYNKv1twX9I/images/275.webp 275w\" type=\"image/webp\" sizes=\"(max-width: 275px) 100vw, 275px\"><img class=\"rg_i Q4LuWd\" style=\"-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;caret-color:rgb(0, 0, 0);color:rgb(0, 0, 0);font-style:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;orphans:auto;text-align:start;text-decoration:none;text-indent:0px;text-transform:none;white-space:normal;widows:auto;word-spacing:0px;\" src=\"https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/VbYNKv1twX9I/images/275.jpeg\" alt=\"How to Design a Room, in 12 Easy Steps\" data-deferred=\"1\" jsname=\"Q4LuWd\" width=\"272\" height=\"182\" data-atf=\"true\" data-iml=\"2184\" uploadprocessed=\"true\"></picture></figure><p>Room 1 - bedsheets&nbsp;</p><figure class=\"image\" data-ckbox-resource-id=\"ekAnD2x3fih0\"><picture><source srcset=\"https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/ekAnD2x3fih0/images/115.webp 115w,https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/ekAnD2x3fih0/images/195.webp 195w,https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/ekAnD2x3fih0/images/275.webp 275w\" type=\"image/webp\" sizes=\"(max-width: 275px) 100vw, 275px\"><img class=\"rg_i Q4LuWd\" style=\"-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;caret-color:rgb(0, 0, 0);color:rgb(0, 0, 0);font-style:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;orphans:auto;text-align:start;text-decoration:none;text-indent:0px;text-transform:none;white-space:normal;widows:auto;word-spacing:0px;\" src=\"https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/ekAnD2x3fih0/images/275.jpeg\" alt=\"18 Tips to Make Your Guest Room Feel Like Home\" data-deferred=\"1\" jsname=\"Q4LuWd\" width=\"272\" height=\"182\" data-atf=\"true\" data-iml=\"2184\" uploadprocessed=\"true\"></picture></figure><p>Room 2 - Two pillows missing&nbsp;</p><figure class=\"image\" data-ckbox-resource-id=\"A0Yp0xXiuikC\"><picture><source srcset=\"https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/A0Yp0xXiuikC/images/115.webp 115w,https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/A0Yp0xXiuikC/images/195.webp 195w,https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/A0Yp0xXiuikC/images/275.webp 275w\" type=\"image/webp\" sizes=\"(max-width: 275px) 100vw, 275px\"><img class=\"rg_i Q4LuWd\" style=\"-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;caret-color:rgb(0, 0, 0);color:rgb(0, 0, 0);font-style:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;orphans:auto;text-align:start;text-decoration:none;text-indent:0px;text-transform:none;white-space:normal;widows:auto;word-spacing:0px;\" src=\"https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/A0Yp0xXiuikC/images/275.jpeg\" alt=\"Love Your Hotel Room? Take a Piece of It Home - The New York Times\" data-deferred=\"1\" jsname=\"Q4LuWd\" width=\"275\" height=\"184\" data-atf=\"true\" data-iml=\"2185\" uploadprocessed=\"true\"></picture></figure><p>&nbsp;</p><p>Room3 - Bedside lamp is not working&nbsp;</p><figure class=\"image\" data-ckbox-resource-id=\"GZI_oEBkrWmP\"><picture><source srcset=\"https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/GZI_oEBkrWmP/images/99.webp 99w,https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/GZI_oEBkrWmP/images/179.webp 179w,https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/GZI_oEBkrWmP/images/259.webp 259w\" type=\"image/webp\" sizes=\"(max-width: 259px) 100vw, 259px\"><img class=\"rg_i Q4LuWd\" style=\"-webkit-text-size-adjust:auto;-webkit-text-stroke-width:0px;caret-color:rgb(0, 0, 0);color:rgb(0, 0, 0);font-style:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;orphans:auto;text-align:start;text-decoration:none;text-indent:0px;text-transform:none;white-space:normal;widows:auto;word-spacing:0px;\" src=\"https://ckbox.cloud/yGpj5sdvGI5QDjLYauFI/assets/GZI_oEBkrWmP/images/259.jpeg\" alt=\"Most Popular Hotel Room Types: How to Maximize Their Potential\" data-deferred=\"1\" jsname=\"Q4LuWd\" width=\"258\" height=\"194\" data-atf=\"true\" data-iml=\"2185\" uploadprocessed=\"true\"></picture></figure><p>Room 4 - bed is broken</p>', 'Routine Inspection'),
(10040, '2023-05-26', 30, 1000, 'Rejected', NULL, NULL, 'Other'),
(10041, '2023-05-21', 30, 1000, 'Inspected', '', NULL, 'Other'),
(10042, '2023-05-28', 29, 1003, 'Pending', '', NULL, 'Private Inspection'),
(10043, '2023-05-25', 33, 1000, 'Rejected', '', NULL, 'Routine Inspection'),
(10044, '2023-05-27', 30, 1000, 'Accepted', '', NULL, 'Private Inspection'),
(10045, '1998-12-12', 30, 1013, 'Inspected', NULL, NULL, 'Routine Inspection'),
(10046, '1999-12-12', 30, 1000, 'Pending', NULL, NULL, 'Open Inspection'),
(10048, '2023-05-13', 32, 1003, 'Accepted', NULL, NULL, 'Open Inspection'),
(10049, '2023-05-21', 32, 1014, 'Accepted', '<p>dan test query</p>', NULL, 'Routine Inspection'),
(10050, '2023-05-20', 30, 1002, 'Accepted', '<p>Hello There,<br><br>Please get the key from the office by 5pm and return in once done.<br><br>Thanks!</p>', NULL, 'Open Inspection'),
(10051, '2023-05-19', 30, 1003, 'Accepted', '<p>Hello,<br><br>Please make sure the property are clean and tidy before taking photos. Otherwise, please report us as soon as you found any dagames/unlcean condition.<br><br>Thank you!</p>', NULL, 'Property Audit');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_prefername` varchar(50) DEFAULT NULL,
  `user_phone` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(20) DEFAULT 'contractor',
  `user_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fname`, `user_lname`, `user_prefername`, `user_phone`, `email`, `password`, `user_type`, `user_image`, `user_address`, `token`) VALUES
(29, 'Contractor2', 'Contractor2', '', '0429334797', '//sduu0007@student.monash.edu', '$2y$10$EzS3Bxmb2NBUZObfWKxJmOlGUSTYsQFKYVNCghhwtzurgo/DgHTDq', 'contractor', NULL, 'qq', 'c26f5e27571117ad22550c17fd581058c6204c45'),
(30, 'Contractor1', 'Contractor1', '', '0401553687', 'root1@example.com', '$2y$10$FMqUT6mmbdj4tKiATn1QLOkGL04R0JVkMz.LQrx254yCEQs/NVynG', 'contractor', '1453279089-user.png', 'qq', NULL),
(32, 'Daniel', 'Phelan', '', '', 'dphe0001@student.monash.edu', '$2y$10$K0GkVMEI4fkSgKyoEE2Q/OGnpaMkQrbW0tfg7stuSn4v6zgSuk23O', 'contractor', NULL, '2 Power Ave', NULL),
(33, 'Contractor3', 'Contractor3', '', '12345678', 'rqin0002@student.monash.edu', '$2y$10$TlTeZjWY0srU5i8ixXfwqu.J1QTVMDlfwjqB6xiQDoMBwX/F3lAZ.', 'contractor', NULL, 'qwer', NULL),
(35, 'admin', 'admin', '', '1234567', 'root@example.com', '$2y$10$ZELWNizAkYnvp45RNetRC.F7ElcH3bHc6.JnJ7e1aQdfAAPPoG3A6', 'admin', NULL, '123', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`apartment_id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `image_inspection_fk` (`inspection_id`);

--
-- Indexes for table `inspections`
--
ALTER TABLE `inspections`
  ADD PRIMARY KEY (`inspection_id`),
  ADD KEY `inspection_apartment_fk` (`apartment_id`),
  ADD KEY `inspection_contractor_fk` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `apartment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1015;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inspections`
--
ALTER TABLE `inspections`
  MODIFY `inspection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10052;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `image_inspection_fk` FOREIGN KEY (`inspection_id`) REFERENCES `inspections` (`inspection_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inspections`
--
ALTER TABLE `inspections`
  ADD CONSTRAINT `inspection_apartment_fk` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`apartment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inspection_contractor_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
