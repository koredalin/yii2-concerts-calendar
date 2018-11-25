-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2018 at 10:18 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `concerts`
--

-- --------------------------------------------------------

--
-- Table structure for table `band`
--

CREATE TABLE `band` (
  `id` int(11) NOT NULL,
  `band_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `band`
--

INSERT INTO `band` (`id`, `band_name`, `created_at`, `updated_at`) VALUES
(1, 'Michael Jackson', '2018-11-18 19:01:23', '2018-11-18 19:01:23'),
(2, 'Bilbo Begins', '2018-11-18 19:01:55', '2018-11-18 19:01:55'),
(3, 'Tudor Maiden', '2018-11-18 19:02:29', '2018-11-18 19:02:29'),
(4, 'Iron Maiden 1', '2018-11-18 19:10:00', '2018-11-24 16:15:09'),
(5, 'Iron Maiden 2', '2018-11-18 19:10:20', '2018-11-18 19:10:20'),
(6, 'Iron Maiden 3', '2018-11-18 19:11:21', '2018-11-21 23:25:44'),
(7, 'Iron Maiden 4', '2018-11-18 19:14:07', '2018-11-18 19:14:07'),
(9, 'BTR', '2018-11-19 19:55:37', '2018-11-19 19:55:37'),
(10, 'БТР', '2018-11-19 19:57:41', '2018-11-19 19:57:41'),
(11, 'Tuturutka', '2018-11-19 23:11:50', '2018-11-19 23:30:06'),
(12, 'Deep Purple', '2018-11-19 23:34:02', '2018-11-25 16:10:01'),
(13, 'Taralej', '2018-11-20 22:17:38', '2018-11-20 22:17:49'),
(14, 'Tambuktu', '2018-11-21 23:29:19', '2018-11-21 23:29:19'),
(15, 'Black Sabbath', '2018-11-25 16:16:22', '2018-11-25 16:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `concert`
--

CREATE TABLE `concert` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `band_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `country_id` smallint(6) NOT NULL,
  `description` text NOT NULL,
  `has_photo` tinyint(4) NOT NULL DEFAULT '0',
  `photo_file_path` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `concert`
--

INSERT INTO `concert` (`id`, `date`, `band_id`, `location`, `country_id`, `description`, `has_photo`, `photo_file_path`, `created_at`, `updated_at`) VALUES
(1, '2018-12-13', 3, 'Gabrovo', 34, 'Trobadur.', 1, 'band_images/bandPhotoConcertId1.jpg', '2018-11-18 19:02:30', '2018-11-18 19:02:30'),
(2, '2018-12-13', 7, 'Gabrovo', 34, 'Trobadur.', 1, 'band_images/bandPhotoConcertId2.jpg', '2018-11-18 19:14:07', '2018-11-18 19:14:07'),
(6, '2019-07-24', 6, 'Transilwaniq', 18, 'Turbo jet', 0, NULL, '2018-11-19 23:10:42', '2018-11-21 23:25:44'),
(8, '2018-12-14', 4, 'Gabrovo', 70, 'taralej', 1, 'band_images/bandPhotoConcertId8.jpg', '2018-11-19 23:23:27', '2018-11-20 20:26:51'),
(9, '2018-12-14', 4, 'Gabrovo', 92, 'taralej', 1, 'band_images/bandPhotoConcertId9.jpg', '2018-11-19 23:26:41', '2018-11-24 16:15:09'),
(10, '2019-02-21', 12, 'Buda Peshta', 19, 'Torta torta 3', 1, 'band_images/bandPhotoConcertId10.jpg', '2018-11-19 23:34:02', '2018-11-25 16:10:01'),
(11, '2018-12-19', 13, 'Timbuktu', 89, 'Готина Банда.', 1, 'band_images/bandPhotoConcertId11.jpg', '2018-11-20 22:17:38', '2018-11-20 22:17:49'),
(12, '2018-12-13', 14, 'Loch Nes', 201, 'Test test test', 1, 'band_images/bandPhotoConcertId12.jpg', '2018-11-21 23:29:20', '2018-11-21 23:29:20'),
(13, '2018-12-21', 15, 'V. Tarnovo', 34, 'Lorem Ipsum 123456789 10.', 0, NULL, '2018-11-25 16:16:22', '2018-11-25 16:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` smallint(6) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `iso_abbr` varchar(2) NOT NULL,
  `un_abbr` varchar(3) NOT NULL,
  `dialing_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `iso_abbr`, `un_abbr`, `dialing_code`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', '93'),
(2, 'Albania', 'AL', 'ALB', '355'),
(3, 'Algeria', 'DZ', 'DZA', '213'),
(4, 'American Samoa', 'AS', 'ASM', '1-684'),
(5, 'Andorra', 'AD', 'AND', '376'),
(6, 'Angola', 'AO', 'AGO', '244'),
(7, 'Anguilla', 'AI', 'AIA', '1-264'),
(8, 'Antarctica', 'AQ', 'ATA', '672'),
(9, 'Antigua and Barbuda', 'AG', 'ATG', '1-268'),
(10, 'Argentina', 'AR', 'ARG', '54'),
(11, 'Armenia', 'AM', 'ARM', '374'),
(12, 'Aruba', 'AW', 'ABW', '297'),
(13, 'Australia', 'AU', 'AUS', '61'),
(14, 'Austria', 'AT', 'AUT', '43'),
(15, 'Azerbaijan', 'AZ', 'AZE', '994'),
(16, 'Bahamas', 'BS', 'BHS', '1-242'),
(17, 'Bahrain', 'BH', 'BHR', '973'),
(18, 'Bangladesh', 'BD', 'BGD', '880'),
(19, 'Barbados', 'BB', 'BRB', '1-246'),
(20, 'Belarus', 'BY', 'BLR', '375'),
(21, 'Belgium', 'BE', 'BEL', '32'),
(22, 'Belize', 'BZ', 'BLZ', '501'),
(23, 'Benin', 'BJ', 'BEN', '229'),
(24, 'Bermuda', 'BM', 'BMU', '1-441'),
(25, 'Bhutan', 'BT', 'BTN', '975'),
(26, 'Bolivia', 'BO', 'BOL', '591'),
(27, 'Bonaire', 'BQ', 'BES', '599'),
(28, 'Bosnia and Herzegovina', 'BA', 'BIH', '387'),
(29, 'Botswana', 'BW', 'BWA', '267'),
(30, 'Bouvet Island', 'BV', 'BVT', '47'),
(31, 'Brazil', 'BR', 'BRA', '55'),
(32, 'British Indian Ocean Territory', 'IO', 'IOT', '246'),
(33, 'Brunei Darussalam', 'BN', 'BRN', '673'),
(34, 'Bulgaria', 'BG', 'BGR', '359'),
(35, 'Burkina Faso', 'BF', 'BFA', '226'),
(36, 'Burundi', 'BI', 'BDI', '257'),
(37, 'Cambodia', 'KH', 'KHM', '855'),
(38, 'Cameroon', 'CM', 'CMR', '237'),
(39, 'Canada', 'CA', 'CAN', '1'),
(40, 'Cape Verde', 'CV', 'CPV', '238'),
(41, 'Cayman Islands', 'KY', 'CYM', '1-345'),
(42, 'Central African Republic', 'CF', 'CAF', '236'),
(43, 'Chad', 'TD', 'TCD', '235'),
(44, 'Chile', 'CL', 'CHL', '56'),
(45, 'China', 'CN', 'CHN', '86'),
(46, 'Christmas Island', 'CX', 'CXR', '61'),
(47, 'Cocos (Keeling) Islands', 'CC', 'CCK', '61'),
(48, 'Colombia', 'CO', 'COL', '57'),
(49, 'Comoros', 'KM', 'COM', '269'),
(50, 'Congo', 'CG', 'COG', '242'),
(51, 'Democratic Republic of the Congo', 'CD', 'COD', '243'),
(52, 'Cook Islands', 'CK', 'COK', '682'),
(53, 'Costa Rica', 'CR', 'CRI', '506'),
(54, 'Croatia', 'HR', 'HRV', '385'),
(55, 'Cuba', 'CU', 'CUB', '53'),
(56, 'Curacao', 'CW', 'CUW', '599'),
(57, 'Cyprus', 'CY', 'CYP', '357'),
(58, 'Czech Republic', 'CZ', 'CZE', '420'),
(59, 'Cote d''Ivoire', 'CI', 'CIV', '225'),
(60, 'Denmark', 'DK', 'DNK', '45'),
(61, 'Djibouti', 'DJ', 'DJI', '253'),
(62, 'Dominica', 'DM', 'DMA', '1-767'),
(63, 'Dominican Republic', 'DO', 'DOM', '1-809,1-829,1-849'),
(64, 'Ecuador', 'EC', 'ECU', '593'),
(65, 'Egypt', 'EG', 'EGY', '20'),
(66, 'El Salvador', 'SV', 'SLV', '503'),
(67, 'Equatorial Guinea', 'GQ', 'GNQ', '240'),
(68, 'Eritrea', 'ER', 'ERI', '291'),
(69, 'Estonia', 'EE', 'EST', '372'),
(70, 'Ethiopia', 'ET', 'ETH', '251'),
(71, 'Falkland Islands (Malvinas)', 'FK', 'FLK', '500'),
(72, 'Faroe Islands', 'FO', 'FRO', '298'),
(73, 'Fiji', 'FJ', 'FJI', '679'),
(74, 'Finland', 'FI', 'FIN', '358'),
(75, 'France', 'FR', 'FRA', '33'),
(76, 'French Guiana', 'GF', 'GUF', '594'),
(77, 'French Polynesia', 'PF', 'PYF', '689'),
(78, 'French Southern Territories', 'TF', 'ATF', '262'),
(79, 'Gabon', 'GA', 'GAB', '241'),
(80, 'Gambia', 'GM', 'GMB', '220'),
(81, 'Georgia', 'GE', 'GEO', '995'),
(82, 'Germany', 'DE', 'DEU', '49'),
(83, 'Ghana', 'GH', 'GHA', '233'),
(84, 'Gibraltar', 'GI', 'GIB', '350'),
(85, 'Greece', 'GR', 'GRC', '30'),
(86, 'Greenland', 'GL', 'GRL', '299'),
(87, 'Grenada', 'GD', 'GRD', '1-473'),
(88, 'Guadeloupe', 'GP', 'GLP', '590'),
(89, 'Guam', 'GU', 'GUM', '1-671'),
(90, 'Guatemala', 'GT', 'GTM', '502'),
(91, 'Guernsey', 'GG', 'GGY', '44'),
(92, 'Guinea', 'GN', 'GIN', '224'),
(93, 'Guinea-Bissau', 'GW', 'GNB', '245'),
(94, 'Guyana', 'GY', 'GUY', '592'),
(95, 'Haiti', 'HT', 'HTI', '509'),
(96, 'Heard Island and McDonald Islands', 'HM', 'HMD', '672'),
(97, 'Holy See (Vatican City State)', 'VA', 'VAT', '379'),
(98, 'Honduras', 'HN', 'HND', '504'),
(99, 'Hong Kong', 'HK', 'HKG', '852'),
(100, 'Hungary', 'HU', 'HUN', '36'),
(101, 'Iceland', 'IS', 'ISL', '354'),
(102, 'India', 'IN', 'IND', '91'),
(103, 'Indonesia', 'ID', 'IDN', '62'),
(104, 'Iran, Islamic Republic of', 'IR', 'IRN', '98'),
(105, 'Iraq', 'IQ', 'IRQ', '964'),
(106, 'Ireland', 'IE', 'IRL', '353'),
(107, 'Isle of Man', 'IM', 'IMN', '44'),
(108, 'Israel', 'IL', 'ISR', '972'),
(109, 'Italy', 'IT', 'ITA', '39'),
(110, 'Jamaica', 'JM', 'JAM', '1-876'),
(111, 'Japan', 'JP', 'JPN', '81'),
(112, 'Jersey', 'JE', 'JEY', '44'),
(113, 'Jordan', 'JO', 'JOR', '962'),
(114, 'Kazakhstan', 'KZ', 'KAZ', '7'),
(115, 'Kenya', 'KE', 'KEN', '254'),
(116, 'Kiribati', 'KI', 'KIR', '686'),
(117, 'Korea, Democratic People''s Republic of', 'KP', 'PRK', '850'),
(118, 'Korea, Republic of', 'KR', 'KOR', '82'),
(119, 'Kuwait', 'KW', 'KWT', '965'),
(120, 'Kyrgyzstan', 'KG', 'KGZ', '996'),
(121, 'Lao People''s Democratic Republic', 'LA', 'LAO', '856'),
(122, 'Latvia', 'LV', 'LVA', '371'),
(123, 'Lebanon', 'LB', 'LBN', '961'),
(124, 'Lesotho', 'LS', 'LSO', '266'),
(125, 'Liberia', 'LR', 'LBR', '231'),
(126, 'Libya', 'LY', 'LBY', '218'),
(127, 'Liechtenstein', 'LI', 'LIE', '423'),
(128, 'Lithuania', 'LT', 'LTU', '370'),
(129, 'Luxembourg', 'LU', 'LUX', '352'),
(130, 'Macao', 'MO', 'MAC', '853'),
(131, 'Macedonia, the Former Yugoslav Republic of', 'MK', 'MKD', '389'),
(132, 'Madagascar', 'MG', 'MDG', '261'),
(133, 'Malawi', 'MW', 'MWI', '265'),
(134, 'Malaysia', 'MY', 'MYS', '60'),
(135, 'Maldives', 'MV', 'MDV', '960'),
(136, 'Mali', 'ML', 'MLI', '223'),
(137, 'Malta', 'MT', 'MLT', '356'),
(138, 'Marshall Islands', 'MH', 'MHL', '692'),
(139, 'Martinique', 'MQ', 'MTQ', '596'),
(140, 'Mauritania', 'MR', 'MRT', '222'),
(141, 'Mauritius', 'MU', 'MUS', '230'),
(142, 'Mayotte', 'YT', 'MYT', '262'),
(143, 'Mexico', 'MX', 'MEX', '52'),
(144, 'Micronesia, Federated States of', 'FM', 'FSM', '691'),
(145, 'Moldova, Republic of', 'MD', 'MDA', '373'),
(146, 'Monaco', 'MC', 'MCO', '377'),
(147, 'Mongolia', 'MN', 'MNG', '976'),
(148, 'Montenegro', 'ME', 'MNE', '382'),
(149, 'Montserrat', 'MS', 'MSR', '1-664'),
(150, 'Morocco', 'MA', 'MAR', '212'),
(151, 'Mozambique', 'MZ', 'MOZ', '258'),
(152, 'Myanmar', 'MM', 'MMR', '95'),
(153, 'Namibia', 'NA', 'NAM', '264'),
(154, 'Nauru', 'NR', 'NRU', '674'),
(155, 'Nepal', 'NP', 'NPL', '977'),
(156, 'Netherlands', 'NL', 'NLD', '31'),
(157, 'New Caledonia', 'NC', 'NCL', '687'),
(158, 'New Zealand', 'NZ', 'NZL', '64'),
(159, 'Nicaragua', 'NI', 'NIC', '505'),
(160, 'Niger', 'NE', 'NER', '227'),
(161, 'Nigeria', 'NG', 'NGA', '234'),
(162, 'Niue', 'NU', 'NIU', '683'),
(163, 'Norfolk Island', 'NF', 'NFK', '672'),
(164, 'Northern Mariana Islands', 'MP', 'MNP', '1-670'),
(165, 'Norway', 'NO', 'NOR', '47'),
(166, 'Oman', 'OM', 'OMN', '968'),
(167, 'Pakistan', 'PK', 'PAK', '92'),
(168, 'Palau', 'PW', 'PLW', '680'),
(169, 'Palestine, State of', 'PS', 'PSE', '970'),
(170, 'Panama', 'PA', 'PAN', '507'),
(171, 'Papua New Guinea', 'PG', 'PNG', '675'),
(172, 'Paraguay', 'PY', 'PRY', '595'),
(173, 'Peru', 'PE', 'PER', '51'),
(174, 'Philippines', 'PH', 'PHL', '63'),
(175, 'Pitcairn', 'PN', 'PCN', '870'),
(176, 'Poland', 'PL', 'POL', '48'),
(177, 'Portugal', 'PT', 'PRT', '351'),
(178, 'Puerto Rico', 'PR', 'PRI', '1'),
(179, 'Qatar', 'QA', 'QAT', '974'),
(180, 'Romania', 'RO', 'ROU', '40'),
(181, 'Russian Federation', 'RU', 'RUS', '7'),
(182, 'Rwanda', 'RW', 'RWA', '250'),
(183, 'Reunion', 'RE', 'REU', '262'),
(184, 'Saint Barthelemy', 'BL', 'BLM', '590'),
(185, 'Saint Helena', 'SH', 'SHN', '290'),
(186, 'Saint Kitts and Nevis', 'KN', 'KNA', '1-869'),
(187, 'Saint Lucia', 'LC', 'LCA', '1-758'),
(188, 'Saint Martin (French part)', 'MF', 'MAF', '590'),
(189, 'Saint Pierre and Miquelon', 'PM', 'SPM', '508'),
(190, 'Saint Vincent and the Grenadines', 'VC', 'VCT', '1-784'),
(191, 'Samoa', 'WS', 'WSM', '685'),
(192, 'San Marino', 'SM', 'SMR', '378'),
(193, 'Sao Tome and Principe', 'ST', 'STP', '239'),
(194, 'Saudi Arabia', 'SA', 'SAU', '966'),
(195, 'Senegal', 'SN', 'SEN', '221'),
(196, 'Serbia', 'RS', 'SRB', '381'),
(197, 'Seychelles', 'SC', 'SYC', '248'),
(198, 'Sierra Leone', 'SL', 'SLE', '232'),
(199, 'Singapore', 'SG', 'SGP', '65'),
(200, 'Sint Maarten (Dutch part)', 'SX', 'SXM', '1-721'),
(201, 'Slovakia', 'SK', 'SVK', '421'),
(202, 'Slovenia', 'SI', 'SVN', '386'),
(203, 'Solomon Islands', 'SB', 'SLB', '677'),
(204, 'Somalia', 'SO', 'SOM', '252'),
(205, 'South Africa', 'ZA', 'ZAF', '27'),
(206, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', '500'),
(207, 'South Sudan', 'SS', 'SSD', '211'),
(208, 'Spain', 'ES', 'ESP', '34'),
(209, 'Sri Lanka', 'LK', 'LKA', '94'),
(210, 'Sudan', 'SD', 'SDN', '249'),
(211, 'Suriname', 'SR', 'SUR', '597'),
(212, 'Svalbard and Jan Mayen', 'SJ', 'SJM', '47'),
(213, 'Swaziland', 'SZ', 'SWZ', '268'),
(214, 'Sweden', 'SE', 'SWE', '46'),
(215, 'Switzerland', 'CH', 'CHE', '41'),
(216, 'Syrian Arab Republic', 'SY', 'SYR', '963'),
(217, 'Taiwan', 'TW', 'TWN', '886'),
(218, 'Tajikistan', 'TJ', 'TJK', '992'),
(219, 'United Republic of Tanzania', 'TZ', 'TZA', '255'),
(220, 'Thailand', 'TH', 'THA', '66'),
(221, 'Timor-Leste', 'TL', 'TLS', '670'),
(222, 'Togo', 'TG', 'TGO', '228'),
(223, 'Tokelau', 'TK', 'TKL', '690'),
(224, 'Tonga', 'TO', 'TON', '676'),
(225, 'Trinidad and Tobago', 'TT', 'TTO', '1-868'),
(226, 'Tunisia', 'TN', 'TUN', '216'),
(227, 'Turkey', 'TR', 'TUR', '90'),
(228, 'Turkmenistan', 'TM', 'TKM', '993'),
(229, 'Turks and Caicos Islands', 'TC', 'TCA', '1-649'),
(230, 'Tuvalu', 'TV', 'TUV', '688'),
(231, 'Uganda', 'UG', 'UGA', '256'),
(232, 'Ukraine', 'UA', 'UKR', '380'),
(233, 'United Arab Emirates', 'AE', 'ARE', '971'),
(234, 'United Kingdom', 'GB', 'GBR', '44'),
(235, 'United States', 'US', 'USA', '1'),
(236, 'United States Minor Outlying Islands', 'UM', 'UMI', '1'),
(237, 'Uruguay', 'UY', 'URY', '598'),
(238, 'Uzbekistan', 'UZ', 'UZB', '998'),
(239, 'Vanuatu', 'VU', 'VUT', '678'),
(240, 'Venezuela', 'VE', 'VEN', '58'),
(241, 'Viet Nam', 'VN', 'VNM', '84'),
(242, 'British Virgin Islands', 'VG', 'VGB', '1-284'),
(243, 'US Virgin Islands', 'VI', 'VIR', '1-340'),
(244, 'Wallis and Futuna', 'WF', 'WLF', '681'),
(245, 'Western Sahara', 'EH', 'ESH', '212'),
(246, 'Yemen', 'YE', 'YEM', '967'),
(247, 'Zambia', 'ZM', 'ZMB', '260'),
(248, 'Zimbabwe', 'ZW', 'ZWE', '263');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1542451986),
('m140209_132017_init', 1542451996),
('m140403_174025_create_account_table', 1542451998),
('m140504_113157_update_tables', 1542452003),
('m140504_130429_create_token_table', 1542452005),
('m140830_171933_fix_ip_field', 1542452007),
('m140830_172703_change_account_table_name', 1542452007),
('m141222_110026_update_ip_field', 1542452009),
('m141222_135246_alter_username_length', 1542452010),
('m150614_103145_update_social_account_table', 1542452013),
('m150623_212711_fix_username_notnull', 1542452013),
('m151218_234654_add_timezone_to_profile', 1542452014),
('m160929_103127_add_last_login_at_to_user_table', 1542452015);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_account`
--

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
(1, 'BeMYyC00FadwnqQ2sg4LnEPv0w5UsfqT', 1542453240, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`) VALUES
(1, 'admin', 'admin@adminexample.com', '$2y$10$qhobDki9xie5H9gPXpmlHeCYC3sPvliN58L1QDYl8spKgE.8XAm8C', 'cjQcxqOj6hLbvqUWX_ruP4YZ3sUyOcDN', NULL, NULL, NULL, '::1', 1542453240, 1542453240, 0, 1543156094);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `band`
--
ALTER TABLE `band`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`band_name`);

--
-- Indexes for table `concert`
--
ALTER TABLE `concert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `band_id` (`band_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_username` (`username`),
  ADD UNIQUE KEY `user_unique_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `band`
--
ALTER TABLE `band`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `concert`
--
ALTER TABLE `concert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;
--
-- AUTO_INCREMENT for table `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `concert`
--
ALTER TABLE `concert`
  ADD CONSTRAINT `band_constr` FOREIGN KEY (`band_id`) REFERENCES `band` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `country_constr` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
