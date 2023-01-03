-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2023 at 10:00 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slaybeast`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'slaybeast', 'slaybeast@gmail.com', 'f912d984026d0ab2e5b056ae8ea0eaec');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `qty` varchar(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(49, 'shirt');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `names` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `orders` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `coupon` varchar(191) NOT NULL,
  `discount` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon`, `discount`) VALUES
(2, 'year2023', '25');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `email`) VALUES
(1, 'godwinkeyss@gmail.com'),
(2, 'godwinkeyss@gmail.com'),
(3, 'godwinkeyss@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` int(11) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'not paid',
  `user_id` int(11) NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal` int(11) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `tracking_id`, `email`, `country`, `first_name`, `last_name`, `phone`, `address`, `postal`, `state`, `city`, `order_date`) VALUES
(4, 10000, 'not paid', 1, 'beast4865136144950', 'godwinkeyss@gmail.com', 'United Kingdom', 'GODWIN', 'IZEKOR', '08136144950', 'GHGHGHGHG', 2020202, 'Dundee ', 'benin', '2023-01-02 13:47:30'),
(5, 10000, 'not paid', 1, 'beast5564136144950', 'godwinkeyss@gmail.com', 'United Kingdom', 'GODWIN', 'IZEKOR', '08136144950', 'GHGHGHGHG', 2020202, 'Cambridgeshire ', 'benin', '2023-01-02 13:49:59'),
(6, 5400, 'not paid', 1, 'beast4319136144950', 'godwinkeyss@gmail.com', 'United Kingdom', 'GODWIN', 'IZEKOR', '08136144950', 'GHGHGHGHG', 2020202, 'Cheshire ', 'benin', '2023-01-03 18:41:50'),
(7, 5400, 'paid', 1, 'beast5156136144950', 'godwinkeyss@gmail.com', 'United Kingdom', 'GODWIN', 'IZEKOR', '08136144950', 'GHGHGHGHG', 2020202, 'Cheshire ', 'benin', '2023-01-03 18:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image1`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 1, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 1, 1, '2022-12-24 14:40:15'),
(2, 2, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 1, 1, '2022-12-26 19:40:19'),
(3, 3, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 1, 1, '2022-12-26 19:44:28'),
(4, 4, '2', 'light Coat', '../images/4AAPnLHa/top1.jpg', 5000, 2, 1, '2022-12-27 17:53:05'),
(5, 5, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 2, 1, '2023-01-01 06:51:02'),
(6, 6, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 2, 1, '2023-01-01 07:13:50'),
(7, 7, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 2, 1, '2023-01-01 07:25:51'),
(8, 8, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 2, 1, '2023-01-01 07:44:10'),
(9, 9, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 2, 1, '2023-01-01 08:04:32'),
(10, 10, '1', 'black shirt', '../images/EKPcN9iW/plus1.jpg', 5000, 1, 1, '2023-01-01 08:50:51'),
(11, 11, '1', 'black shirt', '../images/EKPcN9iW/plus1.jpg', 5000, 1, 1, '2023-01-01 08:52:56'),
(12, 11, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 1, 1, '2023-01-01 08:52:56'),
(13, 12, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 1, 1, '2023-01-01 11:39:07'),
(14, 13, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 1, 1, '2023-01-01 11:41:12'),
(15, 14, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 1, 1, '2023-01-01 11:42:15'),
(16, 15, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 1, 1, '2023-01-01 11:42:59'),
(17, 1, '1', 'black shirt', '../images/EKPcN9iW/plus1.jpg', 5000, 1, 1, '2023-01-01 19:06:00'),
(18, 1, '2', 'light Coat', '../images/4AAPnLHa/top1.jpg', 5000, 1, 1, '2023-01-01 19:06:00'),
(19, 2, '1', 'black shirt', '../images/EKPcN9iW/plus1.jpg', 5000, 1, 1, '2023-01-01 19:07:45'),
(20, 2, '2', 'light Coat', '../images/4AAPnLHa/top1.jpg', 5000, 1, 1, '2023-01-01 19:07:45'),
(21, 3, '1', 'black shirt', '../images/EKPcN9iW/plus1.jpg', 5000, 1, 1, '2023-01-01 19:18:23'),
(22, 3, '2', 'light Coat', '../images/4AAPnLHa/top1.jpg', 5000, 1, 1, '2023-01-01 19:18:23'),
(23, 4, '2', 'light Coat', '../images/4AAPnLHa/top1.jpg', 5000, 1, 1, '2023-01-02 13:47:30'),
(24, 4, '1', 'black shirt', '../images/EKPcN9iW/plus1.jpg', 5000, 1, 1, '2023-01-02 13:47:30'),
(25, 5, '2', 'light Coat', '../images/4AAPnLHa/top1.jpg', 5000, 1, 1, '2023-01-02 13:49:59'),
(26, 5, '1', 'black shirt', '../images/EKPcN9iW/plus1.jpg', 5000, 1, 1, '2023-01-02 13:49:59'),
(27, 6, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 2, 1, '2023-01-03 18:41:50'),
(28, 6, '1', 'black shirt', '../images/EKPcN9iW/plus1.jpg', 5000, 1, 1, '2023-01-03 18:41:50'),
(29, 7, '3', 'Durags pink', '../images/JX1hM3bc/DURAG1.jpg', 200, 2, 1, '2023-01-03 18:50:04'),
(30, 7, '1', 'black shirt', '../images/EKPcN9iW/plus1.jpg', 5000, 1, 1, '2023-01-03 18:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `user_id`, `transaction_id`, `payment_date`) VALUES
(1, 7, 1, 0, '2023-01-03 18:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `color` varchar(100) NOT NULL,
  `stock` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image1`, `product_image2`, `product_image3`, `product_image4`, `price`, `color`, `stock`, `created_at`) VALUES
(1, 'black shirt', 'skirt', 'sweet', '../images/EKPcN9iW/plus1.jpg', '../images/EjPApCHO/DURAG1.jpg', '../images/9Hq4UACH/pink3.jpg', '../images/7F9CsEbF/pink1.jpg', '5000', 'blue', '2', '2022-12-21 03:55:24'),
(2, 'light Coat', 'pants', 'sweet', '../images/4AAPnLHa/top1.jpg', '../images/qaG8BpkX/DURAG1.jpg', '../images/YHR9cgKC/pink3.jpg', '../images/CtuUW7ev/pink1.jpg', '5000', 'pink', '20', '2022-12-21 03:56:03'),
(3, 'Durags pink', 'shirt', 'sweet', '../images/JX1hM3bc/DURAG1.jpg', '../images/yyOW9aKp/contor2.jpg', '../images/a76UKuWI/top1.jpg', '../images/21ot0KTW/BLACK SKIRT.jpg', '200', 'red', '20', '2022-12-21 03:56:59'),
(4, 'Dark Coat', 'Categories', 'some sweet shirt', '../images/dPJQmWwN/short1.jpg', '../images/QUIS4w6h/short3.jpg', '../images/IIcXCIsO/foto 1.jpg', '../images/3cjjb5hE/DURAGS.jpg', '100', 'black', '2', '2023-01-02 18:20:20'),
(5, 'Dark Coat', 'Categories', 'some sweet shirt', '../images/dXuFJXqt/short1.jpg', '../images/mwsq6brG/short3.jpg', '../images/qccmTxRs/foto 1.jpg', '../images/LgAxVGnk/DURAGS.jpg', '100', 'black', '2', '2023-01-02 18:24:11'),
(6, 'Dark Shirt', 'shirts', 'some sweet shirt', '../images/lMkkyVJ0/DURAG.jpg', '../images/2647tgNS/pink1.jpg', '../images/2YrGkevW/short6.jpg', '../images/FEIoHGL3/top1.jpg', '100', 'black', '2', '2023-01-02 18:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_state` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `country_name`, `country_state`, `price`) VALUES
(27, 'United Kingdom', 'Cambridgeshire ', 20);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_address`
--

CREATE TABLE `shipping_address` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_address`
--

INSERT INTO `shipping_address` (`id`, `email`, `first_name`, `last_name`, `country`, `state`, `city`, `address`, `postal`, `phone`, `user_id`) VALUES
(1, 'godwinkeyss@gmail.com', 'GODWIN', 'IZEKOR', 'United Kingdom', 'Cheshire ', 'benin', 'GHGHGHGHG', '2020202', '08136144950', 1),
(2, 'user3@gmail.com', '', '', 'Bahamas', 'Cardiff ', 'gkgkgkg', 'goootsss', '59595959', '09080807979', 2);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_name`) VALUES
(1, 'Aberdeen '),
(2, 'Bath And North East Somerset '),
(3, 'Belfast '),
(4, 'Bournemouth '),
(5, 'Brighton And Hove '),
(6, 'Bristol '),
(7, 'Cambridgeshire '),
(8, 'Cardiff '),
(9, 'Cheshire '),
(10, 'Cornwall '),
(11, 'Cumbria '),
(12, 'Derry '),
(13, 'Devon '),
(14, 'Dumfries And Galloway '),
(15, 'Dundee '),
(16, 'Dungannon '),
(17, 'Edinburgh '),
(18, 'Glasgow '),
(19, 'Highland '),
(20, 'Inverclyde '),
(21, 'Kent '),
(22, 'Kingston Upon Hull '),
(23, 'Lancashire '),
(24, 'Leicester '),
(25, 'Luton '),
(26, 'Manchester '),
(27, 'Merseyside '),
(28, 'Moray '),
(29, 'Norfolk '),
(30, 'North Yorkshire '),
(31, 'Nottingham '),
(32, 'Omagh '),
(33, 'Oxfordshire '),
(34, 'Perthshire And Kinross '),
(35, 'Peterborough '),
(36, 'Plymouth '),
(37, 'Portsmouth '),
(38, 'South Ayrshire '),
(39, 'South Yorkshire '),
(40, 'Southampton '),
(41, 'Southend On Sea '),
(42, 'Stockton On Tees '),
(43, 'Stoke On Trent '),
(44, 'Suffolk '),
(45, 'Swansea '),
(46, 'Tyne And Wear '),
(47, 'West Midlands'),
(48, 'West Yorkshire '),
(49, 'Westminster '),
(50, 'York ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `phone` int(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `user_state` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_email`, `phone`, `password`, `country`, `user_state`, `created_at`, `update_at`) VALUES
(1, 'GODWIN', 'IZEKOR', 'godwinkeyss@gmail.com', 2147483647, 'e10adc3949ba59abbe56e057f20f883e', 'United Kingdom', '', '2022-12-20 20:43:37', '2022-12-24 14:13:55'),
(2, 'user', 'users', 'user@gmail.com', 2147483647, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, '2023-01-01 13:02:00', '2023-01-01 13:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `wallpapers`
--

CREATE TABLE `wallpapers` (
  `id` int(11) NOT NULL,
  `names` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallpapers`
--

INSERT INTO `wallpapers` (`id`, `names`, `description`, `images`) VALUES
(1, 'Gucci fashion worlds', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem harum fugit vero. Illum tempora, officiis ipsam minus aperiam rerum delectus accusamus cupiditate, ipsa exercitationem porro voluptatum reiciendis eaque, sequi expedita.', '../images/o7GFR5dq/WALLPAPER2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wallpapers`
--
ALTER TABLE `wallpapers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallpapers`
--
ALTER TABLE `wallpapers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
