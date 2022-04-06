-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2022 at 08:04 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tour`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `agency_name` varchar(255) NOT NULL,
  `mobile_no` int(15) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_status` tinyint(4) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `register_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `agency_name`, `mobile_no`, `email_id`, `password`, `verification_status`, `role`, `status`, `register_on`) VALUES
(1, 'TMS Admin', 1234567890, 'pruthvirajrajput575@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, 1, '2022-04-04 17:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `agancy_profile`
--

CREATE TABLE `agancy_profile` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agancy_profile`
--

INSERT INTO `agancy_profile` (`id`, `admin_id`, `address`) VALUES
(1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `carrentals`
--

CREATE TABLE `carrentals` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `vehical_type` varchar(255) NOT NULL,
  `vehical_rental_price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `location` varchar(500) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carrentals`
--

INSERT INTO `carrentals` (`id`, `admin_id`, `vehicle_name`, `vehical_type`, `vehical_rental_price`, `image`, `company_name`, `details`, `status`, `location`, `added_on`) VALUES
(1, 1, 'Suzuki Swift LDI', 'Car (Suzuki Swift LDI)', 2200, '197878468_big_thumb_2009-maruti-swift-lxi-500x500.png', 'TMS Admin', '<h4><strong>Mileage:&nbsp;</strong></h4>\r\n\r\n<p><strong><span style=\"color:#ecf0f1\"><span style=\"background-color:#16a085\">250 KM</span></span></strong></p>\r\n\r\n<h4><strong>Additional information :</strong></h4>\r\n\r\n<ol>\r\n	<li><strong>&nbsp;Class:</strong>&nbsp;Micro</li>\r\n	<li>&nbsp;<strong>Gearbox:</strong>&nbsp;Manual</li>\r\n	<li>&nbsp;<strong>Max passengers:</strong>&nbsp;5</li>\r\n	<li>&nbsp;<strong>Fuel:</strong>&nbsp;Diesel</li>\r\n	<li>&nbsp;<strong>Fuel usage:</strong>&nbsp;22 KMPL</li>\r\n	<li>&nbsp;<strong>Engine capacity:</strong>&nbsp;1248 CC</li>\r\n	<li>&nbsp;<strong>Doors:</strong>&nbsp;4</li>\r\n	<li>&nbsp;<strong>Mileage:</strong>&nbsp;250 KM</li>\r\n	<li>&nbsp;<strong>Minimal driver age:</strong>&nbsp;18</li>\r\n</ol>\r\n\r\n<h4><strong>Additional information :</strong></h4>\r\n\r\n<ol>\r\n	<li><strong>Audio System With Bluetooth Connectivity</strong></li>\r\n	<li><strong>Central locking</strong></li>\r\n	<li><strong>Dual Front Airbags</strong></li>\r\n	<li><strong>Extra Kilometers at ? 5/KM</strong></li>\r\n	<li><strong>Front Power Windows</strong></li>\r\n</ol>\r\n', 1, 'Jalgaon (SSBT CAMPUS)', '2022-04-04 17:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `car_book`
--

CREATE TABLE `car_book` (
  `id` int(11) NOT NULL,
  `car_rental_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `mobile_no` int(15) NOT NULL,
  `address` varchar(500) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_proof_no` int(12) NOT NULL,
  `id_proof` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `book_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments_tour`
--

CREATE TABLE `comments_tour` (
  `id` int(11) NOT NULL,
  `tour_package_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `comment_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments_tour`
--

INSERT INTO `comments_tour` (`id`, `tour_package_id`, `name`, `email_id`, `comment`, `comment_on`) VALUES
(1, 1, 'Pruthviraj Rajput', 'pruthviraj.rajput011@gmail.com', 'Nice  Tour Package For Family Tour in Less Price', '2022-04-05 03:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `comment_rental`
--

CREATE TABLE `comment_rental` (
  `id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `comment_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `replay` text NOT NULL,
  `contactdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_tour`
--

CREATE TABLE `enquiry_tour` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `replay` text NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rental_enquiry`
--

CREATE TABLE `rental_enquiry` (
  `id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `replay` text NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tourpackages`
--

CREATE TABLE `tourpackages` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `PackageName` varchar(255) NOT NULL,
  `PackageType` varchar(255) NOT NULL,
  `PackageLocation` varchar(500) NOT NULL,
  `PackagePrice` int(11) NOT NULL,
  `PackageImage` varchar(255) NOT NULL,
  `PackageFetures` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `agency_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tourpackages`
--

INSERT INTO `tourpackages` (`id`, `admin_id`, `PackageName`, `PackageType`, `PackageLocation`, `PackagePrice`, `PackageImage`, `PackageFetures`, `start_date`, `end_date`, `agency_name`, `status`, `added_on`) VALUES
(1, 1, 'Rajasthan Tour Package', 'Family Holiday Package', 'Rajasthan', 15000, '374562310_amber-fort.jpg', '<h4><strong>Destinations :</strong>&nbsp;</h4>\r\n\r\n<ol>\r\n	<li><strong>Udaipur Sightseeing</strong></li>\r\n	<li><strong>Ranakpur</strong></li>\r\n	<li><strong>Jodhpur Sightseeing</strong></li>\r\n	<li><strong>Jaisalmer Sightseeing</strong></li>\r\n	<li><strong>Pushkar Sightseeing</strong></li>\r\n	<li><strong>Jaipur Sightseeing</strong></li>\r\n</ol>\r\n\r\n<h4><strong>Duration:</strong>&nbsp;</h4>\r\n\r\n<p><strong><span style=\"color:#ecf0f1\"><span style=\"background-color:#16a085\">08 Nights / 09 Days</span></span></strong></p>\r\n\r\n<h4><strong>Day 1 : Arrival - Udaipur Sightseeing</strong></h4>\r\n\r\n<p>Pickup from Udaipur Airport / Railway Station / Bus Stand &amp; Transfer to the Hotel. After relax Sightseeing of Udaipur visit : City Palace, Crystal Gallery, Jagdish Temple, Pichola Lake, Karni Mata Ropeway, Vintage Car Collection, Gulab Bagh, Fateh Sagar lake, Moti Magri, Sahelion Ki Bari &amp; Bhartiya Lok Kala Mandal for Folk Dance. Overnight at Udaipur Hotel.</p>\r\n\r\n<h4><strong>Day 2 : Eklingji - Nathdwara Shrinathji - Haldighati</strong></h4>\r\n\r\n<p>After breakfast Excursion of Udaipur visit : Eklingji Mahadev Temple, Nathdwara Shrinathji Temple &amp; Haldighati Maharana Pratap Museum. Overnight at Udaipur Hotel.</p>\r\n\r\n<h4><strong>Day 3 : Udaipur - Ranakpur - Jodhpur ( 275 KM / 6 HRS.)</strong></h4>\r\n\r\n<p>After breakfast check out from Hotel &amp; Proceed to Jodhpur Enroute visit&nbsp;<strong>Ranakpur Jain Temple</strong>. On Arrival at Jodhpur Check into the Hotel. Rest of the Day free for Independent Activities. Overnight at Jodhpur Hotel.</p>\r\n\r\n<h4><strong>Day 4 : Jodhpur Sightseeing</strong></h4>\r\n\r\n<p>After breakfast Sightseeing of Jodhpur visit : Mehrangarh Fort, Jaswant Thada, Umaid Bhawan Palace &amp; Jodhpur Local Market. Overnight at Jodhpur Hotel.</p>\r\n\r\n<h4><strong>Day 5 : Jodhpur - Jaisalmer ( 300 KM / 6 HRS.)</strong></h4>\r\n\r\n<p>After breakfast check out from Hotel &amp; Proceed to Jaisalmer. On Arrival check into the Desert Safari Camp. Rest of the Day enjoy at Sam Sand Dunes. Overnight at Desert Camp.</p>\r\n\r\n<h4><strong>Day 6 : Jaisalmer Sightseeing</strong></h4>\r\n\r\n<p>After breakfast Sightseeing of Jaisalmer visit : Jaisalmer Fort, Bada Bagh, Gadisagar Lake, Salim Singh Ki Haveli, Patwaon Ki Haveli, Vyas Chhatri. Overnight at Jaisalmer Hotel.</p>\r\n\r\n<h4><strong>Day 7 : Jaisalmer - Pushkar (475 KM / 9 HRS.)</strong></h4>\r\n\r\n<p>After breakfast check out from Hotel &amp; visit Local Market. After visit drive to Pushkar. On Arrival check into the Hotel. After Relax visit : Pushkar Lake &amp; World only Brahma Temple. Overnight at Pushkar Hotel.</p>\r\n\r\n<h4><strong>Day 8 : Pushkar - Jaipur (150 KM / 3 HRS.)</strong></h4>\r\n\r\n<p>After breakfast check out from Hotel &amp; Visit Ajmer Dargah. After visit Drive to Jaipur. On Arrival Check into the Hotel. After relax Sightseeing of Jaipur visit : City Palace, Hawa Mahal, Jantar Mantar, Birla Temple, Albert Hall Museum, Jal Mahal. In the Evening Dinner at Chokhi Dhani. Overnight at Jaipur Hotel.</p>\r\n\r\n<h4><strong>Day 9 : Leave Jaipur - Departure&nbsp;</strong></h4>\r\n\r\n<p>After breakfast Sightseeing of Jaipur visit : Amber Fort, Jaigarh Fort, Nahargarh Fort. After visit Transfer to Jaipur Airport / Railway Station / Bus Stand to board your Flight / Train / Bus for back Home.</p>\r\n\r\n<p style=\"text-align:center\"><strong><a href=\"https://www.empiretourstravels.com/index.php\" target=\"_self\">https://www.empiretourstravels.com/index.php</a></strong></p>\r\n', '2022-04-05', '2022-04-05', 'TMS Admin', 1, '2022-04-04 17:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `tour_book`
--

CREATE TABLE `tour_book` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `mobile_no` int(15) NOT NULL,
  `address` varchar(500) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_proof_no` int(12) NOT NULL,
  `id_proof` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `book_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tour_book`
--

INSERT INTO `tour_book` (`id`, `tour_id`, `admin_id`, `user_id`, `email_id`, `mobile_no`, `address`, `name`, `id_proof_no`, `id_proof`, `payment_status`, `payment_id`, `status`, `book_at`) VALUES
(1, 1, 1, 1, 'pruthvirajrajput305@gmail.com', 1234567890, 'SSBT CAMPUS Jalgaon', 'Manas Jadhav', 2147483647, '335147096_amber-fort.jpg', 'Completed', 'pay_JFWtWdEppYa3pV', 0, '2022-04-05 03:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `mobile_no` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_status` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `register_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email_id`, `mobile_no`, `name`, `password`, `verification_status`, `status`, `register_on`) VALUES
(1, 'pruthvirajrajput575@gmail.com', 1234567890, 'Pruthviraj Rajput', '202cb962ac59075b964b07152d234b70', 1, 1, '2022-04-05 03:35:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `address`) VALUES
(1, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agancy_profile`
--
ALTER TABLE `agancy_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carrentals`
--
ALTER TABLE `carrentals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_book`
--
ALTER TABLE `car_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments_tour`
--
ALTER TABLE `comments_tour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_rental`
--
ALTER TABLE `comment_rental`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_tour`
--
ALTER TABLE `enquiry_tour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rental_enquiry`
--
ALTER TABLE `rental_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourpackages`
--
ALTER TABLE `tourpackages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_book`
--
ALTER TABLE `tour_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agancy_profile`
--
ALTER TABLE `agancy_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carrentals`
--
ALTER TABLE `carrentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `car_book`
--
ALTER TABLE `car_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments_tour`
--
ALTER TABLE `comments_tour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment_rental`
--
ALTER TABLE `comment_rental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiry_tour`
--
ALTER TABLE `enquiry_tour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rental_enquiry`
--
ALTER TABLE `rental_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tourpackages`
--
ALTER TABLE `tourpackages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tour_book`
--
ALTER TABLE `tour_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
