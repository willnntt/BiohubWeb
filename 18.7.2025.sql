-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2025 at 09:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biohub_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `community_events`
--

CREATE TABLE `community_events` (
  `eventid` int(11) NOT NULL,
  `eventname` varchar(50) NOT NULL,
  `eventdesc` text NOT NULL,
  `eventvenue` varchar(255) NOT NULL,
  `eventdate` date NOT NULL,
  `eventcategory` varchar(50) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `eventimage` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_events`
--

INSERT INTO `community_events` (`eventid`, `eventname`, `eventdesc`, `eventvenue`, `eventdate`, `eventcategory`, `starttime`, `endtime`, `eventimage`, `userid`, `username`) VALUES
(1, 'Charity Bazaar in Kuala Lumpur', 'Come on done to the Charity Bazaar in KL, no need to bring anything just yourself!', 'Kuala Lumpur', '2025-04-10', 'Bazaar', '09:00:00', '20:00:00', 'CG_pics/1743046739_67e4c8538cc26.jpg', 1, 'willard'),
(2, 'Park Cleanup in Taman Negara', 'We provide cleaning materials on spot. Bring some extra plastic bags just in case!', 'Taman Negara', '2025-05-20', 'Cleanup', '12:00:00', '17:00:00', 'CG_pics/1743140914_67e638320f34d.jpg', 2, 'willard'),
(3, 'Beach Cleaning in Pulau Redang', 'We provide cleaning materials. Make sure to bring extra close because going to be very hot outside.', 'Pulau Redang', '2025-04-25', 'Cleanup', '10:00:00', '16:20:00', 'CG_pics/1743140996_67e6388420e0f.jpg', 1, 'admin'),
(4, 'Gardening Wholesale', 'Come on down to Taman Bunga! We are selling potted plants for cheap price from 10am to 6pm', 'Taman Bunga', '2025-07-08', 'Gardening', '10:00:00', '18:00:00', 'CG_pics/1743141087_67e638dfd014d.jpg', 1, 'admin'),
(5, 'Test Event1', 'Event Desc', 'Kuala Lumpur', '2025-05-14', 'Gardening', '11:00:00', '12:00:00', 'CG_pics/1743347736_67e960184647e.png', 7, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `community_newsletter`
--

CREATE TABLE `community_newsletter` (
  `userid` int(11) NOT NULL,
  `joinnewsletter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_newsletter`
--

INSERT INTO `community_newsletter` (`userid`, `joinnewsletter`) VALUES
(2, 1),
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `community_tips`
--

CREATE TABLE `community_tips` (
  `tipID` int(11) NOT NULL,
  `tipdesc` text NOT NULL,
  `date` date NOT NULL,
  `tiplikes` int(11) NOT NULL,
  `tipdislikes` int(11) NOT NULL,
  `user_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_tips`
--

INSERT INTO `community_tips` (`tipID`, `tipdesc`, `date`, `tiplikes`, `tipdislikes`, `user_rating`) VALUES
(1, 'Water your plants thoroughly in the morning when the soil gets dry on the surface!', '2025-03-24', 1, 0, 1),
(2, 'Make sure your plants get at least 6 to 8 hours of direct sunlight a day!', '2025-03-25', 1, 0, 1),
(3, 'Use wooden stakes to keep your vine plants supported when they grow longer!', '2025-03-26', 0, 1, 0),
(4, 'Water your plants early in the morning to reduce evaporation.', '2025-03-30', 0, 0, 0),
(5, 'Use compost to enrich your soil with nutrients.', '2025-03-31', 0, 0, 0),
(6, 'Plant flowers that attract pollinators like bees and butterflies.', '2025-04-01', 0, 0, 0),
(7, 'Mulch your garden beds to retain moisture and suppress weeds.', '2025-04-02', 0, 0, 0),
(8, 'Rotate crops yearly to prevent soil depletion.', '2025-04-03', 0, 0, 0),
(9, 'Use coffee grounds as a natural fertilizer for acid-loving plants.', '2025-04-04', 0, 0, 0),
(10, 'Prune dead leaves and branches to promote healthy growth.', '2025-04-05', 0, 0, 0),
(11, 'Grow companion plants to naturally repel pests.', '2025-04-06', 0, 0, 0),
(12, 'Keep a gardening journal to track plant progress.', '2025-04-07', 0, 0, 0),
(13, 'Use eggshells to provide calcium for plants and deter slugs.', '2025-04-08', 0, 0, 0),
(14, 'Plant herbs like basil and mint to repel insects.', '2025-04-09', 0, 0, 0),
(15, 'Harvest vegetables in the morning for better flavor.', '2025-04-10', 0, 0, 0),
(16, 'Use banana peels to add potassium to the soil.', '2025-04-11', 0, 0, 0),
(17, 'Water deeply and less frequently to encourage deep root growth.', '2025-04-12', 0, 0, 0),
(18, 'Grow native plants for easier maintenance and better survival.', '2025-04-13', 0, 0, 0),
(19, 'Use vinegar to kill weeds naturally.', '2025-04-14', 0, 0, 0),
(20, 'Start seeds indoors before transplanting outside.', '2025-04-15', 0, 0, 0),
(21, 'Use rainwater for watering plants to save resources.', '2025-04-16', 0, 0, 0),
(22, 'Plant marigolds to keep pests away from vegetables.', '2025-04-17', 0, 0, 0),
(23, 'Aerate your soil to improve drainage and root growth.', '2025-04-18', 0, 0, 0),
(24, 'Use straw or grass clippings for natural mulch.', '2025-04-19', 0, 0, 0),
(25, 'Give plants enough space to allow proper air circulation.', '2025-04-20', 0, 0, 0),
(26, 'Deadhead flowers to encourage more blooms.', '2025-04-21', 0, 0, 0),
(27, 'Avoid watering leaves to prevent fungal diseases.', '2025-04-22', 0, 0, 0),
(28, 'Use raised beds for better soil control and drainage.', '2025-04-23', 0, 0, 0),
(29, 'Introduce ladybugs to naturally control aphids.', '2025-04-24', 0, 0, 0),
(30, 'Mix different plants to prevent disease spread.', '2025-04-25', 0, 0, 0),
(31, 'Sharpen your gardening tools regularly for clean cuts.', '2025-04-26', 0, 0, 0),
(32, 'Test your soil pH before planting.', '2025-04-27', 0, 0, 0),
(33, 'Plant trees and shrubs in the fall for stronger root development.', '2025-04-28', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ect`
--

CREATE TABLE `ect` (
  `NO` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ect`
--

INSERT INTO `ect` (`NO`, `title`, `description`, `link`) VALUES
(1, 'Bleed Your Radiators to Save Over £300 Annually', 'Regularly bleeding radiators prevents trapped air, ensuring efficient heating and reducing energy bills.', 'https://www.thescottishsun.co.uk/fabulous/14385104/radiator-easy-task-save-money-heat-home/'),
(2, 'Use Eco Settings on Appliances to Cut Costs', 'Utilizing eco modes on washing machines and dishwashers lowers energy consumption and preserves clothing.', 'https://www.thesun.co.uk/money/33451035/save-money-washing-machine-laundry/'),
(3, 'Switch to LED Bulbs for Energy Efficiency', 'Replacing incandescent bulbs with LEDs can reduce energy usage by up to 80% and decrease cooling costs.', 'https://sustainablethrive.com/ways-to-conserve-energy/'),
(4, 'Seal Gaps to Prevent Energy Loss', 'Sealing gaps around windows and doors with caulk or weather stripping can save up to 15% on heating and cooling costs.', 'https://www.bhg.com/home-improvement/green-living/energy-efficient/home-energy-savings/'),
(5, 'Use Smart Power Strips to Eliminate Phantom Loads', 'Smart power strips automatically cut off power to devices in standby mode, reducing \'phantom\' energy consumption.', 'https://www.energysage.com/energy-efficiency/ways-to-save-energy/'),
(6, 'Install a Programmable Thermostat', 'Programmable thermostats adjust heating and cooling based on your schedule, enhancing energy efficiency.', 'https://www.energysage.com/energy-efficiency/ways-to-save-energy/'),
(7, 'Upgrade to Energy-Efficient Appliances', 'Energy-efficient appliances consume less power, leading to significant savings over time.', 'https://www.energysage.com/energy-efficiency/ways-to-save-energy/'),
(8, 'Air Dry Clothes When Possible', 'Air drying clothes reduces energy usage associated with tumble drying.', 'https://www.homeadvisor.com/r/home-energy-saving-tips/');

-- --------------------------------------------------------

--
-- Table structure for table `event_register`
--

CREATE TABLE `event_register` (
  `userid` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `joinstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_register`
--

INSERT INTO `event_register` (`userid`, `eventid`, `joinstatus`) VALUES
(2, 2, 1),
(2, 11, 1),
(2, 5, 0),
(1, 18, 0),
(1, 15, 0),
(7, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_registration`
--

CREATE TABLE `event_registration` (
  `register_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact_number` int(15) NOT NULL,
  `address` text NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `event_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_registration`
--

INSERT INTO `event_registration` (`register_id`, `user_id`, `first_name`, `last_name`, `dob`, `email`, `contact_number`, `address`, `gender`, `event_name`) VALUES
(1, 0, 'lalalalala', 'sinyi', '0000-00-00', 'lalalala@gmail.com', 124875690, 'ipoh', 'Female', ''),
(2, 0, 'yi', 'yiii', '0000-00-00', 'yi@gmail.com', 185421569, 'ipoh', 'Female', ''),
(3, 0, 'tan', 'ming cyn', '0000-00-00', 'mingcyn@gmail.com', 601554899, 'Parkhill Residence', 'Female', ''),
(4, 0, 'John ', 'Doe', '0000-00-00', 'john@gmail.com', 2147483647, 'Bukit Bintang ', 'Male', ''),
(5, 0, 'bowie', 'chong ', '0000-00-00', 'bowie@gmail.com', 2147483647, 'Raub', 'Female', ''),
(6, 0, 'David', 'Chan', '0000-00-00', 'david@gmail.com', 2147483647, 'Old Klang Road', 'Male', ''),
(7, 0, 'Sally', 'Wong', '0000-00-00', 'sally@gmail.com', 123658965, 'George Town', 'Female', 'Green School Fair'),
(8, 0, 'Olivia', 'Thong', '0000-00-00', 'olivia@gmail.com', 123564856, 'Kuantan', 'Female', 'EcoWarrior Camp');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(2, 'jaimelai888@gmail.com', '969338f0f328bf6aa93396a1b9c619ca08c4459a90d57a70a51914746044b6ebd3f3046710ffca8dd690c524c1cf53dbdc05', '2025-03-30 10:02:55'),
(3, 'joslyn.cyn05@gmail.com', '7f9b9fcfcbfc5d8969865c8fb86171e27218fb220bd51deace2c4dc9c6655dfcfc612d0a2e4cedb2838e866531ab61828be6', '2025-03-30 10:35:49'),
(5, 'joslyn.cyn05@gmail.com', '3438658d9f78fe81f58b52ec9b801aae163e65e368482a81e2023dc9fa4e1e44a52c8095d456e14282cd7ffcb1b4bf82de01', '2025-03-30 12:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_swap`
--

CREATE TABLE `product_swap` (
  `product_id` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productDescription` text NOT NULL,
  `productCondition` text NOT NULL,
  `productCategory` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_swap`
--

INSERT INTO `product_swap` (`product_id`, `productName`, `productDescription`, `productCondition`, `productCategory`, `image`) VALUES
(8, 'Canvas Shoes', 'Lightweight and breathable canvas shoes, perfect for casual wear. Comfortable fit with a durable sole', '5', 'Fashion', 'shoes.jpg'),
(9, 'Succulent Plant', 'Healthy succulent plant, easy to care for and perfect for home or office decor', '3', 'Plants', 'succulent_plant.jpg'),
(10, 'Tote Bag', 'Stylish and reusable tote bag, perfect for shopping or everyday use.', '4', 'Fashion', 'tote_bag.jpg'),
(11, 'Bicycle', 'Reliable bicycle, great for commuting or leisure rides', '3', 'Bikes & Gear', 'pexels-shantararam-16760353.jpg'),
(12, 'Stuffed Bear', 'Soft and cuddly toys in great condition. Perfect for kids or collectors.', '4', 'Toys & Games', 'nastya-dulhiier-eqyY1dIXcPg-unsplash.jpg'),
(13, 'Microwave', 'Functional microwave in good condition. Heats food quickly and efficiently.', '4', 'Kitchenware', 'lissete-laverde-4JhCV1YrG1o-unsplash.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `recycling_event`
--

CREATE TABLE `recycling_event` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(150) NOT NULL,
  `location` varchar(200) NOT NULL,
  `event_date` date NOT NULL,
  `event_start_time` time NOT NULL,
  `event_end_time` time NOT NULL,
  `event_detail` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recycling_event`
--

INSERT INTO `recycling_event` (`event_id`, `event_name`, `location`, `event_date`, `event_start_time`, `event_end_time`, `event_detail`, `image`) VALUES
(1, 'Green Future Fest', 'Johor Bahru ', '2025-01-07', '10:00:00', '11:45:00', 'A community event promoting recycling with workshops, drop-off stations, and eco-friendly activities.', 'sustainable_exchange_fair.jpg'),
(3, 'EcoSwap Day ', 'Mid Valley Conventional Center', '2025-01-11', '10:30:00', '21:30:00', 'Trade reusable items, recycle electronics, and learn sustainable habits.', 'swap_day.jpg'),
(4, 'Zero Waste Challenge', 'Bukit Jalil Recreational Park', '2025-02-03', '10:25:00', '14:30:00', 'Interactive event with waste audits, composting demos, and plastic-free initiatives.', 'zero_waste.jpg'),
(5, 'Recycle-A-Thon', 'IPC Recycling & Buy-back Centre', '2025-04-15', '10:15:00', '21:30:00', 'Citywide recycling competition rewarding households for proper waste disposal.', 'past_event_1.jpg'),
(6, 'Clean Earth Drive', 'Desaru Coast', '2025-04-23', '16:30:00', '19:30:00', 'Beach and park cleanup with recycling awareness booths.', 'past_event_2.jpg'),
(7, 'Green School Fair', 'Asia Pacific University ', '2025-05-05', '10:00:00', '17:00:00', 'Students showcase recycling projects and eco-friendly solutions.', 'paper_workshop.jpg'),
(8, 'EcoWarrior Camp', 'Langkawi Island', '2025-07-11', '11:00:00', '16:00:00', 'Hands-on training for reducing waste and promoting circular economy practices.', 'pexels-ron-lach-9543732.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reply_rating`
--

CREATE TABLE `reply_rating` (
  `replyid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reply_rating`
--

INSERT INTO `reply_rating` (`replyid`, `userid`, `rating`) VALUES
(2, 2, 1),
(8, 2, 1),
(6, 2, -1),
(56, 2, 1),
(7, 2, -1),
(12, 2, 1),
(11, 2, -1),
(13, 2, -1),
(8, 1, 1),
(7, 1, -1);

-- --------------------------------------------------------

--
-- Table structure for table `tip_rating`
--

CREATE TABLE `tip_rating` (
  `tipID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tip_rating`
--

INSERT INTO `tip_rating` (`tipID`, `userid`, `rating`) VALUES
(1, 2, 1),
(2, 2, 1),
(3, 1, -1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `register_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `dob`, `email`, `password`, `role`, `register_date`) VALUES
(1, 'biohubAdmin', '2025-03-02', 'biohub@gmail.com', '$2y$10$lxK0NF6j1pqAFMW3otST3.rdTMycLx8iU.Sciu8BuWU2CipjvX8h2', 'admin', '2025-03-29 10:27:20'),
(2, 'jackson', '2025-03-19', 'jackson@gmail.com', '$2y$10$hxwJfXG.MggJ/3SUN36FL.NfRE4qJyQIrrIgEBU9SEcmtiiIpkYJG', 'member', '2025-03-30 12:19:31'),
(3, 'David', '2025-03-20', 'david@gmail.com', '$2y$10$zp4BhFVi7/vRZIfcQSSSYeaMRM6a2koTYXZYyCZHAoG/t/QWT.ayi', 'member', '2025-03-30 12:23:00'),
(4, 'sinyi', '2025-03-08', 'jaimelai888@gmail.com', '$2y$10$D7eN9ZZVrgGK7qa1PoPxU.xrQuE/1SBHfXNh.RgIg10fkN4wiLFVq', 'member', '2025-03-30 17:47:11'),
(5, 'Joslyn', '2025-05-25', 'joslyn.cyn05@gmail.com', '$2y$10$3xUEBhxcvEXv5kzktk4rIOPzdniESPwQ7Cqn00ldN2KJDshM9R9Lq', 'member', '2025-03-30 17:49:46'),
(6, 'WillardAcc', '2007-05-14', 'newAcccountWillard@gmail.com', '$2y$10$ubzcHOdTQeFneoCajOyRwOVavrVk3c04kzxq4BTU.LuKJmThSlY7O', 'member', '2025-03-30 22:57:50'),
(7, 'Test', '2003-05-14', 'abc@gmail.com', '$2y$10$J5/EdPLZr40gCs73kPqVve6uxIcI52u8UlYgRyOwyXFRLUcRRIDdi', 'member', '2025-03-30 23:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_comment`
--

CREATE TABLE `user_comment` (
  `commentid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `comment_title` varchar(150) NOT NULL,
  `comment_message` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_comment`
--

INSERT INTO `user_comment` (`commentid`, `userid`, `username`, `comment_title`, `comment_message`, `comment_date`, `comment_rating`) VALUES
(1, 1, 'hweins0', '', 'eget congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a', '2025-01-19 00:00:00', 0),
(2, 2, 'myakunikov1', '', 'ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi', '2024-04-19 00:00:00', 0),
(3, 3, 'bbeden2', '', 'rutrum nulla tellus in sagittis dui vel nisl duis ac nibh fusce lacus purus aliquet at feugiat non', '2024-06-23 00:00:00', 0),
(4, 4, 'lbarnsley3', '', 'phasellus sit amet erat nulla tempus vivamus in felis eu sapien cursus vestibulum proin', '2024-03-24 00:00:00', 0),
(5, 5, 'wtoffano4', '', 'nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id', '2025-01-14 00:00:00', 0),
(6, 6, 'bpatis5', '', 'ut suscipit a feugiat et eros vestibulum ac est lacinia nisi', '2025-02-27 00:00:00', 0),
(7, 7, 'kskain6', '', 'rhoncus sed vestibulum sit amet cursus id turpis integer aliquet massa id lobortis convallis tortor risus', '2024-05-08 00:00:00', 0),
(8, 8, 'mtregonna7', '', 'quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas leo odio condimentum id', '2024-12-26 00:00:00', 0),
(9, 9, 'vwoan8', '', 'nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit', '2024-04-30 00:00:00', 0),
(10, 10, 'ksquelch9', '', 'lectus vestibulum quam sapien varius ut blandit non interdum in ante vestibulum ante ipsum primis in faucibus orci luctus', '2024-03-26 00:00:00', 0),
(11, 11, 'ryeliasheva', '', 'hac habitasse platea dictumst morbi vestibulum velit id pretium iaculis diam erat fermentum justo nec condimentum', '2024-05-25 00:00:00', 0),
(12, 12, 'jkellockb', '', 'sagittis dui vel nisl duis ac nibh fusce lacus purus aliquet', '2024-12-17 00:00:00', 0),
(13, 13, 'pmilvertonc', '', 'ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer', '2025-01-05 00:00:00', 0),
(14, 14, 'sbaylayd', '', 'odio porttitor id consequat in consequat ut nulla sed accumsan felis', '2024-04-14 00:00:00', 0),
(15, 15, 'jbowheye', '', 'duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu', '2024-05-13 00:00:00', 0),
(16, 16, 'gpeachamf', '', 'eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus', '2024-08-09 00:00:00', 0),
(17, 17, 'hskeemorg', '', 'morbi non lectus aliquam sit amet diam in magna bibendum imperdiet', '2024-06-02 00:00:00', 0),
(18, 18, 'ldemelth', '', 'non mi integer ac neque duis bibendum morbi non quam', '2024-03-22 00:00:00', 0),
(19, 19, 'hmoreyi', '', 'libero nam dui proin leo odio porttitor id consequat in consequat ut nulla sed accumsan felis ut at dolor quis', '2025-03-01 00:00:00', -1),
(20, 20, 'dclemmeyj', '', 'vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum', '2024-07-17 00:00:00', 0),
(21, 21, 'kscroggsk', '', 'lectus in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet cursus id turpis integer aliquet massa', '2024-08-23 00:00:00', 0),
(22, 22, 'pmunginl', '', 'ligula vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi', '2024-06-07 00:00:00', 0),
(23, 23, 'ebubeerm', '', 'elementum pellentesque quisque porta volutpat erat quisque erat eros viverra eget congue eget semper rutrum nulla nunc purus', '2024-09-19 00:00:00', 0),
(24, 24, 'ccailen', '', 'massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut erat curabitur gravida', '2024-08-21 00:00:00', 0),
(25, 25, 'mundrello', '', 'accumsan felis ut at dolor quis odio consequat varius integer ac leo', '2024-03-07 00:00:00', 0),
(26, 26, 'grohloffp', '', 'enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula', '2024-09-13 00:00:00', 0),
(27, 27, 'ahouseq', '', 'sapien placerat ante nulla justo aliquam quis turpis eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis', '2024-10-22 00:00:00', 0),
(28, 28, 'bbennionr', '', 'sed tristique in tempus sit amet sem fusce consequat nulla', '2024-06-26 00:00:00', 0),
(29, 29, 'apeyess', '', 'ac nibh fusce lacus purus aliquet at feugiat non pretium quis lectus suspendisse', '2024-11-21 00:00:00', 0),
(30, 30, 'alaphamt', '', 'quam sapien varius ut blandit non interdum in ante vestibulum ante ipsum primis in faucibus orci luctus', '2025-01-17 00:00:00', 0),
(50, 27, 'willardA', '', 'testing comment', '2025-03-09 00:00:00', 1),
(51, 1, 'willardA', '', 'asdasdadsadsdasdadsadads', '2025-03-16 00:00:00', 1),
(52, 1, 'willardA', 'Create a title', 'comment placeholder something something', '2025-03-16 00:00:00', 1),
(56, 2, 'willardA', 'newer comment', 'testing testing testing testing testing testing', '2025-03-23 00:00:00', 2),
(62, 2, 'willard', 'everday a new comment', 'daily comment for testing in the future', '2025-03-25 02:39:11', -1),
(63, 2, 'willard', 'timezones', 'the comment i made just now wasn\'t made at 2am', '2025-03-25 09:44:57', 1),
(65, 1, 'willard', 'long message', 'asdasdhaiudshaidshaihdsahusdahidsuhaudsaiuhdiauhduihadsiha iduasdasd', '2025-03-27 14:55:22', 0),
(66, 7, 'Test', 'new comment for presentation', 'hello, this is a comment.', '2025-04-09 13:40:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_rating`
--

CREATE TABLE `user_rating` (
  `commentid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_rating`
--

INSERT INTO `user_rating` (`commentid`, `userid`, `rating`) VALUES
(19, 2, -1),
(50, 2, 1),
(51, 2, 1),
(53, 2, 1),
(56, 2, 1),
(52, 2, 1),
(63, 1, 1),
(62, 1, -1),
(56, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_reply`
--

CREATE TABLE `user_reply` (
  `replyid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `reply_message` varchar(255) NOT NULL,
  `reply_date` datetime NOT NULL,
  `reply_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_reply`
--

INSERT INTO `user_reply` (`replyid`, `commentid`, `userid`, `username`, `reply_message`, `reply_date`, `reply_rating`) VALUES
(1, 1, 0, 'willardA', 'asdasdadaasdasdad', '2025-03-14 00:00:00', 0),
(2, 50, 1, 'germaine', 'Testing reply message', '2025-03-15 00:00:00', 1),
(4, 1, 2, 'willardA', 'reply comment', '2025-03-23 00:00:00', 0),
(5, 50, 2, 'willard', 'create reply', '2025-03-23 00:00:00', 0),
(7, 56, 2, 'willard', 'testing message for the latest reply', '2025-03-23 00:00:00', -2),
(8, 56, 2, 'willard', 'lets try again', '2025-03-23 00:00:00', 2),
(12, 56, 2, 'willard', 'delete typo', '2025-03-23 00:00:00', 1),
(18, 62, 1, 'willard', 'asdasdasdad', '2025-03-27 12:46:35', 0),
(19, 63, 1, 'willard', 'testtetset', '2025-03-27 12:47:30', 0),
(20, 56, 2, 'willard', 'very very long message just to test the limit of the containers that i made and see if the message fits or not', '2025-03-28 13:39:26', 0),
(21, 65, 7, 'Test', 'replying to a comment', '2025-03-30 23:14:44', 0),
(22, 66, 7, 'Test', 'testing replay', '2025-04-09 13:40:52', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `community_events`
--
ALTER TABLE `community_events`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `community_tips`
--
ALTER TABLE `community_tips`
  ADD PRIMARY KEY (`tipID`);

--
-- Indexes for table `ect`
--
ALTER TABLE `ect`
  ADD PRIMARY KEY (`NO`);

--
-- Indexes for table `event_registration`
--
ALTER TABLE `event_registration`
  ADD PRIMARY KEY (`register_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_swap`
--
ALTER TABLE `product_swap`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `recycling_event`
--
ALTER TABLE `recycling_event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_comment`
--
ALTER TABLE `user_comment`
  ADD PRIMARY KEY (`commentid`);

--
-- Indexes for table `user_reply`
--
ALTER TABLE `user_reply`
  ADD PRIMARY KEY (`replyid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `community_events`
--
ALTER TABLE `community_events`
  MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `community_tips`
--
ALTER TABLE `community_tips`
  MODIFY `tipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ect`
--
ALTER TABLE `ect`
  MODIFY `NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `event_registration`
--
ALTER TABLE `event_registration`
  MODIFY `register_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_swap`
--
ALTER TABLE `product_swap`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `recycling_event`
--
ALTER TABLE `recycling_event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_comment`
--
ALTER TABLE `user_comment`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `user_reply`
--
ALTER TABLE `user_reply`
  MODIFY `replyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
