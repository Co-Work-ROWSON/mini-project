-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2025 at 04:06 PM
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
-- Database: `dbfastlane`
--

-- --------------------------------------------------------

--
-- Table structure for table `bannerlists`
--

CREATE TABLE `bannerlists` (
  `bannerlist_id` varchar(10) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `bannerlist_infoL1` varchar(255) NOT NULL,
  `bannerlist_infoL2` varchar(255) DEFAULT NULL,
  `bn_image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `text_layout` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bannerlists`
--

INSERT INTO `bannerlists` (`bannerlist_id`, `product_id`, `bannerlist_infoL1`, `bannerlist_infoL2`, `bn_image`, `created_at`, `text_layout`) VALUES
('BNR0001', 'EACRLL0001', 'ROUGH AND READY', 'Hot Wheels Elite 64 Series Land Rover Defender 90 Pickup', 'bannerpd_HWC_ASpot_Home_D_HGW12_LandRoverDefender_1440x@2x.webp', '2023-10-25 00:02:36', 'R'),
('BNR0002', 'JDMHDA0002', 'A LEGEND LIVES ON', 'The RLC Exclusive Honda S2000', 'banner_RLC_Exclusive_Honda_S2000.webp', '2023-10-25 20:53:53', 'L');

--
-- Triggers `bannerlists`
--
DELIMITER $$
CREATE TRIGGER `bannerlists_layout_insert` BEFORE INSERT ON `bannerlists` FOR EACH ROW BEGIN
    SET NEW.text_layout = UPPER(NEW.text_layout);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bannerlists_layout_insert_update` BEFORE UPDATE ON `bannerlists` FOR EACH ROW BEGIN
    SET NEW.text_layout = UPPER(NEW.text_layout);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_bannerlist_id_prefix` BEFORE INSERT ON `bannerlists` FOR EACH ROW BEGIN
    DECLARE next_id INT;

    -- Find the maximum numeric ID for the given prefix "MBS"
    SET next_id = (
        SELECT IFNULL(MAX(CAST(SUBSTRING(bannerlist_id, 4) AS SIGNED)), 0) + 1
        FROM bannerlists
        WHERE bannerlist_id LIKE 'BNR%'
    );

    -- Pad the numeric ID with zeros and set the new user_id
    SET NEW.bannerlist_id = CONCAT('BNR', LPAD(next_id, 4, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `carbrands`
--

CREATE TABLE `carbrands` (
  `carbrand_id` varchar(6) NOT NULL,
  `carbrand_name` varchar(50) NOT NULL,
  `cb_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carbrands`
--

INSERT INTO `carbrands` (`carbrand_id`, `carbrand_name`, `cb_description`) VALUES
('EU01', 'Lamborghini', NULL),
('EU02', 'Ferrari', NULL),
('EU03', 'Porsche', NULL),
('EU04', 'Mercedes-Benz', NULL),
('EU05', 'Land Rover', NULL),
('JP01', 'Honda', 'All Hot wheels From Honda'),
('JP02', 'Toyota', NULL),
('JP03', 'Nissan', NULL),
('JP04', 'Mazda', NULL),
('JP05', 'Mitsubishi', NULL),
('NA01', 'Ford', NULL),
('NA02', 'Dodge', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` varchar(7) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `product_id`, `quantity`, `total`, `status`, `created_at`, `updated_at`) VALUES
(16, 'MBS0003', 'JDMHDA0001', 2, 2189.40, 'active', '2023-11-01 05:18:24', '2023-11-01 05:18:49'),
(20, 'MBS0001', 'EACRLL0001', 1, 1265.60, 'active', '2024-03-18 07:38:17', '2024-03-18 07:38:17'),
(21, 'MBS0001', 'JDMNIS0002', 1, 1751.04, 'active', '2024-03-18 07:38:22', '2024-03-18 07:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` varchar(6) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `ct_description` text DEFAULT NULL,
  `c_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `ct_description`, `c_image`) VALUES
('CTG001', 'Fast & Furious Premium Series', NULL, 'collection-1t.jpg'),
('CTG002', 'Hot Wheels Monster Trucks', NULL, 'collection-2t.jpg'),
('CTG003', 'Hot Wheels Collectors', NULL, 'collection-3t.jpg'),
('CTG004', 'Premium Collector Set', NULL, NULL);

--
-- Triggers `categories`
--
DELIMITER $$
CREATE TRIGGER `set_category_id_prefix` BEFORE INSERT ON `categories` FOR EACH ROW BEGIN
    DECLARE next_id INT;

    -- Find the maximum numeric ID for the given prefix "MBS"
    SET next_id = (
        SELECT IFNULL(MAX(CAST(SUBSTRING(category_id, 4) AS SIGNED)), 0) + 1
        FROM categories
        WHERE category_id LIKE 'CTG%'
    );

    -- Pad the numeric ID with zeros and set the new user_id
    SET NEW.category_id = CONCAT('CTG', LPAD(next_id, 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(10) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `p_description` text DEFAULT NULL,
  `p_image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `Release_Date` date DEFAULT NULL,
  `category_id` varchar(6) DEFAULT NULL,
  `carbrand_id` varchar(6) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `p_description`, `p_image`, `price`, `Release_Date`, `category_id`, `carbrand_id`, `created_at`) VALUES
('EACLBG0001', 'Elite 64 Series LBWK Lamborghini Aventador LP 700-4', 'Legal Name: Hot Wheels® Elite 64™ LBWK Lamborghini Aventador LP 700-4\r\nFeatures: Removable rear bumper, rear wing, and rear engine cover \r\nBody Color: Pearl blue \r\nGraphics: Matte black painted rear wing; Authentic Liberty Walk and Lamborghini logos \r\nBody Type: ZAMAC \r\nWheels: Real Riders fixed-axle wheels* with matte black painted hubs \r\nBase: Full-metal, matte black painted chassis \r\nEngine (ABS): Black 4-piece twin turbocharged V12 engine with painted details  \r\nWindow Color: Light smoke-tinted \r\nInterior Color: Black with painted details \r\nScale: 1:64', 'pd_Elite64Series_LBWK_Lambor_Aventador_LP_700-4.webp', 1276.80, '2023-10-30', 'CTG003', 'EU01', '2023-10-22 16:25:45'),
('EACRLL0001', 'Elite 64 Series Land Rover Defender 90 Pickup', 'Hot Wheels® Elite 64™ Land Rover Defender 90 Pickup\r\nBody Color: Green-cyan \r\nBody Type: ZAMAC \r\nWheels: Real Riders off-road wheels \r\nBase: Matte black \r\nWindow Color: Light smoke-tinted \r\nInterior Color: Black \r\nScale: 1:64 ', 'pd_HGW12_LandRover_1500x.webp', 1265.60, '2023-11-03', 'CTG003', 'EU05', '2023-10-24 23:55:26'),
('JDMHDA0001', 'Honda S2000', 'Color: Pink\r\nWindow Color: Tinted (Black)\r\nInterior Color: Grey\r\nWheel Type: PR5\r\n\r\nWhite design graphics on sides, detailed headlights', 'pd_hondas2000.webp', 1094.70, '2024-03-06', 'CTG001', 'JP01', '2023-10-21 22:32:11'),
('JDMHDA0002', 'RLC Exclusive Honda S2000', 'Body Color: Spectraflame yellow\r\nDeco: Authentic logos\r\nBody Type: ZAMAC\r\nWheels: Real Riders 10-spoke wheels\r\nBase: Full-metal chassis\r\nInterior Color: Black', 'pd_RLC_Exclusive_Honda_S2000.webp', 1989.63, '2024-03-29', 'CTG003', 'JP01', '2023-10-25 20:46:35'),
('JDMHDA0003', 'test', NULL, 'none', 456.00, '2024-03-18', 'CTG004', 'EU01', '2024-03-18 13:15:42'),
('JDMNIS0001', 'RLC Exclusive Nissan Skyline GT-R', 'Features: Opening hood\r\nBody Color: Spectraflame black over dark chrome\r\nDeco: Authentic logos, “Nismo” livery\r\nBody Type: ZAMAC\r\nWheels: Real Riders 5-spoke wheels\r\nBase: Full-metal, matte black-painted chassis\r\nWindow Color: Light smoke-tinted\r\nInterior Color: Black Scale: 1:64', 'pd_RLC_Exclusive_Nissan_Skyline_GT-R.webp', 2189.40, '2023-10-21', 'CTG003', 'JP03', '2023-10-21 23:25:41'),
('JDMNIS0002', 'RLC Exclusive Pink Editions Nissan Skyline GT-R', 'Legal Name: RLC Exclusive Pink Editions Nissan Skyline GT-R (BNR34)\r\nFeatures: Opening hood\r\nBody Color: Spectraflame pink\r\nGraphics: Matte white hood and stripes on sides; authentic manufacturer logos\r\nBody Type: ZAMAC\r\nWheels: Real Riders 10-spoke wheels with matte white painted hubs\r\nBase: Full-metal, matte black painted chassis; engine with painted details\r\nWindow Color: Light smoke-tinted\r\nInterior Color: White\r\nScale: 1:64', 'pd_RLC_Exclu_Pink_Editions_Nissan_SKL_GT-R.webp', 1751.04, '2023-10-16', 'CTG003', 'JP03', '2023-10-22 16:11:37'),
('JDMSET0001', 'Hot Wheels Premium Collector Set', 'Hot Wheels Premium features a unique variety of themed vehicles tailored to car enthusiasts with premium execution fans love.\r\nIncluded in each set are 3 1:64 scale die-cast cars and 1 1:64 scale Team Transport vehicle that appeals to car enthusiasts and collectors.\r\nThese highly detailed models have exceptional graphic deco, full die-cast construction and Real Riders tires.\r\nThe display-worthy sets have unique themes. Fans can choose a favorite or collect them all.\r\nThe window package shows off each set that\'s worthy of display.', 'pd_HotWheels_PremiumCollectorSet.webp', 2351.38, '2023-10-25', 'CTG004', NULL, '2023-10-25 23:09:35'),
('SNADDG0001', 'Dodge Charger Hellcat', 'Hot Wheels™ Fast & Furious™ Dodge Charger Hellcat \r\n1:64 scale die-cast car from our Hot Wheels Premium Fast & Furious line  \r\nEach car was inspired by or featured in one of the movies from the blockbuster franchise with authentic detail and sweet decos \r\nWith Real Riders™ tires and Metal/Metal™ body and chassis, these elite vehicles were made with premium execution for fans and collectors alike \r\nColors and decorations may vary.  ', 'pd_Dodge_Charger_Hellcat.webp', 364.80, '2023-10-02', 'CTG001', 'NA02', '2023-10-22 17:31:46'),
('SNAFOD0001', 'HWC Elite 64 Series Modified ’69 Ford Mustang', 'Hot Wheels® Elite 64™ Series Modified ’69 Ford Mustang \r\nFeatures: Removable hood/front \r\nBody Color: Metallic Acapulco blue with black rear wing \r\nGraphics: Authentic Mustang logos \r\nBody Type: ZAMAC \r\nWheels: Real Riders fixed-axle wheels with metallic gray painted rims \r\nBase: Full-metal, matte black painted chassis \r\nEngine (ABS): Black (upper) and cool metallic gray (lower) \r\nWindow Color: Light smoke-tinted \r\nInterior Color: Cool metallic gray with black seat, steering wheel, and dashboard; blue roll bar', 'pd_HWC _Elite64Series_Modified’69_FordMustang.webp', 1094.40, '2023-10-04', 'CTG003', 'NA01', '2023-10-22 17:31:46');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `generate_product_id` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE next_val INT;

    -- Extract the text and number parts of the product_id
    SET @text_part = SUBSTRING(NEW.product_id, 1, 6);
    SET @number_part = SUBSTRING(NEW.product_id, 7);

    -- Check if there is text in the @text_part
    IF LENGTH(@text_part) = 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid product_id format. It should contain at least one alphabetical character.';
    ELSE
        -- Find the maximum sequence number for the same text prefix
        SET max_id = (SELECT MAX(SUBSTRING(product_id, -4) + 0) FROM products WHERE product_id LIKE CONCAT(@text_part, '%'));

        IF max_id IS NULL THEN
            SET next_val = 1;
        ELSE
            SET next_val = max_id + 1;
        END IF;

        SET NEW.product_id = CONCAT(@text_part, LPAD(next_val, 4, '0'));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(7) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `first_name`, `last_name`, `date_of_birth`, `address`, `user_image`, `created_at`) VALUES
('MBS0001', 'testuser', 'kaurakoch.s@gmail.com', '$2y$10$R1IguhJMwDX8X7k0a.bMrO2fts.CqHIkm/27uLp4KJnywgIexuCIe', 'Jason', 'Sriunprasert', '2023-10-04', 'BF402 BEAVERCREEK RD', '209209416420240318_073528.jpg', '2023-10-25 14:38:37'),
('MBS0002', 'adsf', 'free@gmail.com', '$2y$10$xRu/A6Ak1ut6/kPEkbez/ehwc1haG1OwYAVcSmmE0By1WR34Z6VDy', 'j', 'ge', '2023-10-23', 'BF402 BEAVERCREEK RD', NULL, '2023-10-25 14:46:50'),
('MBS0003', 'ggez66666', 'gg@mail.com', '$2y$10$CuMU2vDLWKYSW4ajYoGDmuPTKxtNrE2na4XnY7BmVPT5ClfSlkEPK', 'gg55555', 'ez', '2023-10-29', '111', '14319608020231101_052403.jpg', '2023-11-01 04:17:08');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `set_user_id_prefix` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    DECLARE next_id INT;

    -- Find the maximum numeric ID for the given prefix "MBS"
    SET next_id = (
        SELECT IFNULL(MAX(CAST(SUBSTRING(user_id, 4) AS SIGNED)), 0) + 1
        FROM users
        WHERE user_id LIKE 'MBS%'
    );

    -- Pad the numeric ID with zeros and set the new user_id
    SET NEW.user_id = CONCAT('MBS', LPAD(next_id, 4, '0'));
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bannerlists`
--
ALTER TABLE `bannerlists`
  ADD PRIMARY KEY (`bannerlist_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `carbrands`
--
ALTER TABLE `carbrands`
  ADD PRIMARY KEY (`carbrand_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `carbrand_id` (`carbrand_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bannerlists`
--
ALTER TABLE `bannerlists`
  ADD CONSTRAINT `bannerlists_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`carbrand_id`) REFERENCES `carbrands` (`carbrand_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
