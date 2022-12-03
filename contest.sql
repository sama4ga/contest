-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2022 at 12:25 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `contactId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phoneNumber` varchar(14) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE `contest` (
  `contestId` int(11) NOT NULL,
  `contestName` varchar(40) DEFAULT NULL,
  `contestYear` year(4) NOT NULL,
  `contestDate` date NOT NULL,
  `contestLocation` text,
  `registrationStartDate` date NOT NULL,
  `registrationEndDate` date NOT NULL,
  `registrationStatus` enum('Open','Closed') NOT NULL DEFAULT 'Open',
  `registrationFee` int(6) DEFAULT '2000',
  `votingFee` int(6) DEFAULT '100',
  `contestStatus` enum('Active','Ended') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contestant`
--

CREATE TABLE `contestant` (
  `cId` int(11) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phoneNumber` varchar(14) NOT NULL,
  `dob` date NOT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `category` varchar(40) NOT NULL,
  `countryId` int(11) NOT NULL,
  `stateId` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `status` varchar(10) DEFAULT 'Incomplete',
  `tnxRef` varchar(40) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `position` int(4) DEFAULT NULL,
  `registrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contestwinner`
--

CREATE TABLE `contestwinner` (
  `winnerId` int(11) NOT NULL,
  `cId` int(11) NOT NULL,
  `position` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `continent`
--

CREATE TABLE `continent` (
  `continentId` int(11) NOT NULL,
  `continent` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `continent`
--

INSERT INTO `continent` (`continentId`, `continent`) VALUES
(1, 'Africa'),
(2, 'Antarctica'),
(3, 'Asia'),
(4, 'Australia'),
(5, 'Europe'),
(6, 'North America'),
(7, 'South America'),
(8, 'Central America');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `countryId` int(11) NOT NULL,
  `country` varchar(40) NOT NULL,
  `countryCapital` varchar(30) NOT NULL,
  `continentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryId`, `country`, `countryCapital`, `continentId`) VALUES
(1, 'Afghanistan', 'Kabul', 3),
(2, 'Albania', 'Tirana', 5),
(3, 'Algeria', 'Algiers', 1),
(4, 'Andorra', 'Andorra la Vella', 5),
(5, 'Angola', 'Luanda', 1),
(6, 'Antigua and Barbuda', 'Saint Jonh\'s', 6),
(7, 'Argentina', 'Buenos Aires', 7),
(8, 'Armenia', 'Yerevan', 5),
(9, 'Australia', 'Canberra', 4),
(10, 'Austria', 'Vienna', 5),
(11, 'Azerbaijan', 'Baku', 5),
(12, 'Bahamas', 'Nassau', 6),
(13, 'Bahrain', 'Manama', 3),
(14, 'Bangladesh', 'Dhaka', 3),
(15, 'Barbados', 'Bridgetown', 6),
(16, 'Belarus', 'Minsk', 5),
(17, 'Belgium', 'Brussel', 5),
(18, 'Belize', 'Belmopan', 8),
(19, 'Benin', 'Porto-Novo', 1),
(20, 'Bhutan', 'Thimphu', 3),
(21, 'Bolivia', 'La Paz', 7),
(22, 'Bosnia and Herzegovina', 'Sarajevo', 5),
(23, 'Botswana', 'Gaborone', 1),
(24, 'Brazil', 'Brasilia', 7),
(25, 'Brunei Darussalam', 'Bander Seri Begawan', 3),
(26, 'Bulgaria', 'Sofia', 5),
(27, 'Burkina Faso', 'Ouagadouguo', 1),
(28, 'Burundi', 'Bujumbura', 1),
(29, 'Cote D\'Ivoire', 'Yamoussoukro', 1),
(30, 'Cape Verde', 'Praia', 1),
(31, 'Cambodia', 'Phnom Penh', 3),
(32, 'Cameroon', 'Yaounde', 1),
(33, 'Canada', 'Ottawa', 8),
(35, 'Chad', 'N\'Djamena', 1),
(36, 'Chile', 'Santiago', 7),
(37, 'China', 'Beijing', 3),
(38, 'Colombia', 'Bogota', 7),
(39, 'Comoros', 'Moroni', 1),
(40, 'Congo (Congo-Brazzaville)', 'Brazzaville', 1),
(41, 'Costa Rica', 'San Jose', 8),
(42, 'Croatia', 'Zagreb', 5),
(43, 'Cuba', 'Havana', 6),
(44, 'Cyprus', 'Nicosia', 5),
(45, 'Czechia (Czech Republic)', 'Prague', 5),
(46, 'Democratic Republic of the Congo', 'Kinshasa', 1),
(47, 'Denmark', 'Copenhagen', 5),
(48, 'Djibouti', 'Djibouti', 1),
(49, 'Dominica', 'Roseau', 6),
(50, 'Dominican Republic', 'Santo Domingo', 6),
(51, 'Ecuador', 'Quito', 7),
(52, 'Egypt', 'Cairo', 1),
(53, 'El Salvador', 'San Salvador', 8),
(54, 'Equatorial Guinea', 'Malabo', 1),
(55, 'Eritrea', 'Asmara', 1),
(56, 'Estonia', 'Tallnin', 5),
(57, 'Eswatini (Swaziland)', 'Mbabane', 1),
(58, 'Ethiopia', 'Addis Ababa', 1),
(59, 'Fiji', 'Suva', 4),
(60, 'Finland', 'Helsinki', 5),
(61, 'France', 'Paris', 5),
(62, 'Gabon', 'Libreville', 1),
(63, 'Gambia', 'Banjul', 1),
(64, 'Georgia', 'Tbilisi', 5),
(65, 'Germany', 'Berlin', 5),
(66, 'Ghana', 'Accra', 1),
(67, 'Greece', 'Athens', 5),
(68, 'Grenada', 'Saint George\'s', 6),
(69, 'Guatemala', 'Guatemala City', 8),
(70, 'Guinea', 'Conakry', 1),
(71, 'Guinea-Bissau', 'Bissau', 1),
(72, 'Guyana', 'George town', 7),
(73, 'Haiti', 'Port-au-Prince', 6),
(75, 'Honduras', 'Tegucigalpa', 8),
(76, 'Hungary', 'Budapest', 5),
(77, 'Iceland', 'Reykjavik', 5),
(78, 'India', 'New Delhi', 3),
(79, 'Indonesia', 'Jakarta', 3),
(80, 'Iran', 'Tehran', 3),
(81, 'Iraq', 'Baghdad', 3),
(82, 'Ireland', 'Dublin', 5),
(83, 'Israel', 'Jerusalem', 3),
(84, 'Italy', 'Rome', 5),
(85, 'Jamaica', 'Kingston', 6),
(86, 'Japan', 'Tokyo', 3),
(87, 'Jordan', 'Amman', 3),
(88, 'Kazakhstan', 'Astana', 3),
(89, 'Kenya', 'Nairobi', 1),
(90, 'Kiribati', 'Tarawa', 4),
(91, 'Kuwait', 'Kuwait City', 3),
(92, 'Kyrgyzstan', 'Bishkek', 3),
(93, 'Laos', 'Vientaine', 3),
(94, 'Latvia', 'Riga', 5),
(95, 'Lebanon', 'Bierut', 3),
(96, 'Lesotho', 'Maseru', 1),
(97, 'Liberia', 'Monrovia', 1),
(98, 'Libya', 'Tripoli', 1),
(99, 'Liechtenstein', 'Vaduz', 5),
(100, 'Lithuania', 'Vilnius', 5),
(101, 'Luxembourg', 'Luxembourg', 5),
(102, 'Madagascar', 'Antananarivo', 1),
(103, 'Malawi', 'Lilongwe', 1),
(104, 'Malaysia', 'Kualar Lumpur', 3),
(105, 'Maldives', 'Male', 3),
(106, 'Mali', 'Bamako', 1),
(107, 'Malta', 'Valleta', 5),
(108, 'Marshal Islands', 'Majuro', 4),
(109, 'Mauritania', 'Nouakchott', 1),
(110, 'Mauritius', 'Port Louis', 1),
(111, 'Mexico', 'Mexico City', 0),
(112, 'Micronesia', 'Palikir', 4),
(113, 'Moldova', 'Chisinau', 5),
(114, 'Monaco', 'Monaco', 5),
(115, 'Mongolia', 'Ulaanbaatar', 3),
(116, 'Montenegro', 'Podgorica', 5),
(117, 'Morocco', 'Rabat', 1),
(118, 'Mozambique', 'Maputo', 1),
(119, 'Myanmar', 'Rangoon', 1),
(120, 'Namibia', 'Windhoek', 1),
(121, 'Nauru', 'Yaren', 4),
(122, 'Nepal', 'Kathmandu', 3),
(123, 'Netherlands', 'Amsterdam', 5),
(124, 'New Zealand', 'Wellington', 4),
(125, 'Nicaragua', 'Managua', 8),
(126, 'Niger', 'Niamey', 1),
(127, 'Nigeria', 'Abuja', 1),
(128, 'North Korea', 'Pyongyang', 3),
(129, 'North Macedonia', 'Skopje', 5),
(130, 'Norway', 'Oslo', 5),
(131, 'Oman', 'Muscat', 3),
(132, 'Pakistan', 'Islamabad', 3),
(133, 'Palau', 'Melekeok', 4),
(134, 'Palestine State', 'Jerusalem', 3),
(135, 'Panama', 'Panama City', 8),
(136, 'Papua New Guinea', 'Port Moresby', 4),
(137, 'Paraguay', 'Asuncion', 7),
(138, 'Peru', 'Lima', 7),
(139, 'Philippines', 'Manila', 3),
(140, 'Poland', 'Warsaw', 5),
(141, 'Portugal', 'Lisbon', 5),
(142, 'Qatar', 'Doha', 3),
(143, 'Romania', 'Bucharest', 5),
(144, 'Russia', 'Moscow', 5),
(145, 'Rwanda', 'Kigali', 1),
(146, 'Saint Kitts and Nevis', 'Basseterre', 6),
(147, 'Saint Lucia', 'Castries', 6),
(148, 'Saint Vincent and the Grenadines', 'Kingstown', 8),
(149, 'Samoa', 'Apia', 4),
(150, 'San Marino', 'San Marino', 5),
(151, 'Sao Tome and Principe', 'Sao Tome', 1),
(152, 'Saudi Arabia', 'Riyadh', 3),
(153, 'Senegal', 'Dakar', 1),
(154, 'Serbia', 'Belgrade', 5),
(155, 'Seychelles', 'Victoria', 1),
(156, 'Sierra Leone', 'Freetown', 1),
(157, 'Singapore', 'Singapore', 3),
(158, 'Slovakia', 'Bratislava', 5),
(159, 'Slovenia', 'Ljubljana', 5),
(160, 'Solomon Islands', 'Honiara', 4),
(161, 'Somalia', 'Mogadishu', 1),
(162, 'South Africa', 'Pretoria', 1),
(163, 'South Korea', 'Seoul', 3),
(164, 'South Sudan', 'Juba', 1),
(165, 'Spain', 'Madrid', 5),
(166, 'Sri Lanka', 'Colombo', 3),
(168, 'Suriname', 'Paramaribo', 7),
(169, 'Sweden', 'Stockholm', 5),
(170, 'Switzerland', 'Bern', 5),
(171, 'Syria', 'Damascus', 3),
(172, 'Tajikistan', 'Dushanbe', 3),
(173, 'Tanzania', 'Dar es Salaam', 1),
(174, 'Thailand', 'Bangkok', 3),
(175, 'Timor-Leste', 'Dili', 3),
(176, 'Togo', 'Lome', 1),
(177, 'Tonga', 'Nuku\'alofa', 4),
(178, 'Trinidad and Tobago', 'Port Spain', 6),
(179, 'Tunisia', 'Tunis', 1),
(180, 'Turkey', 'Ankara', 5),
(181, 'Turkmenistan', 'Ashgabat', 3),
(182, 'Tuvalu', 'Funafuti', 4),
(183, 'Uganda', 'Kampala', 1),
(184, 'Ukraine', 'Kyiv', 5),
(185, 'United Arab Emirates', 'Abu Dhabi', 3),
(186, 'United Kingdom', 'London', 5),
(187, 'United States of America', 'Washington DC', 8),
(188, 'Uruguay', 'Montevideo', 7),
(189, 'Uzbekistan', 'Tashkent', 3),
(190, 'Vanuatu', 'Port-Villa', 4),
(191, 'Venezuela', 'Caracas', 7),
(192, 'Vietnam', 'Hanoi', 3),
(193, 'Yemen', 'Sanaa', 3),
(194, 'Zambia', 'Lusaka', 1),
(195, 'Zimbabwe', 'Harare', 1),
(196, 'Aland Island', 'Mariehamn', 5),
(197, 'American Samoa', 'Pago Pago', 4),
(198, 'Anguilla', 'The Valley', 6),
(199, 'Antarctica', '', 2),
(200, 'Aruba', 'Oranjestad', 6),
(201, 'Bermuda', 'Hamilton', 6),
(202, 'British Indian Ocean Territory', 'Diego Garcia', 1),
(203, 'British Virgin Islands', 'Road Town', 6),
(205, 'Cayman Islands', 'George Town', 6),
(206, 'Christmas Island', 'The Settlement', 4),
(207, 'Cocos Islands', 'West Island', 4),
(208, 'Cook Islands', 'Avarua', 4),
(209, 'Curacao', 'Willemstad', 6),
(210, 'Falkland Islands', 'Stanley', 7),
(211, 'Faroe Islands', 'Torshavn', 5),
(212, 'French Polynesia', 'Papeete', 4),
(213, 'French Southern  and Antarctic Islands', 'Port-aux-Francas', 2),
(214, 'Gibraltar', 'Gibraltar', 5),
(215, 'Greenland', 'Nuuk', 8),
(216, 'Guam', 'Hagatna', 4),
(217, 'Guernsey', 'Saint Peter Port', 5),
(218, 'Heard Island and McDonald Islands', '', 2),
(219, 'Hong Kong', '', 3),
(220, 'Isle of Man', 'Douglas', 5),
(221, 'Jersey', 'Saint Helier', 5),
(222, 'Kosovo', 'Pristina', 5),
(223, 'Macau', '', 3),
(224, 'Montserrat', 'Plymouth', 6),
(225, 'Niue', 'Alofi', 4),
(226, 'Norfolk Island', 'Kingston', 4),
(227, 'Northern Cyprus', 'North Nicosia', 5),
(228, 'Northern Mariana Islands', 'Saipan', 4),
(229, 'Pitcairn Islands', 'Adamstown', 4),
(230, 'Puert Rico', 'San Juan', 6),
(231, 'Saint Barthelemy', 'Gustavia', 6),
(232, 'Saint Helena', 'Jamestown', 1),
(233, 'Saint Martin', 'Marigot', 6),
(234, 'Saint Pierre and Miquelon', 'Saint-Pierre', 8),
(235, 'Sint Maarten', 'Philipsburg', 6),
(237, 'South Georgia and South Sandwich Islands', 'King Edward Point', 2),
(238, 'Svalbard', 'Longyearbyen', 5),
(239, 'Taiwan', 'Taipei', 3),
(240, 'Tokelau', 'Atafu', 4),
(241, 'Turks and Caicos Islands', 'Grand Turk', 6),
(242, 'US Minor Outlying Islands', 'Washington DC', 4),
(243, 'US Virgin Islands', 'Charlotte Amalie', 6),
(244, 'Vatican City', 'Vatican City', 5),
(245, 'Wallis and Futuna', 'Mata-Utu', 4),
(246, 'Western Sahara', 'El-Aaican', 1);

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE `partner` (
  `pId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `industry` varchar(40) NOT NULL,
  `type` enum('Brand','Individual') NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phoneNumber` varchar(14) DEFAULT NULL,
  `method` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `stateId` int(11) NOT NULL,
  `state` varchar(40) NOT NULL,
  `countryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateId`, `state`, `countryId`) VALUES
(1, 'Abia', 127),
(2, 'Adamawa', 127),
(3, 'Akwa Ibom', 127),
(4, 'Anambra', 127),
(5, 'Bauchi', 127),
(6, 'Bayelsa', 127),
(7, 'Benue', 127),
(8, 'Borno', 127),
(9, 'Cross River', 127),
(10, 'Delta', 127),
(11, 'Ebonyi', 127),
(12, 'Edo', 127),
(13, 'Ekiti', 127),
(14, 'Enugu', 127),
(15, 'Gombe', 127),
(16, 'Imo', 127),
(17, 'Abuja (FCT)', 127),
(18, 'Jigawa', 127),
(19, 'Kaduna', 127),
(20, 'Kano', 127),
(21, 'Katsina', 127),
(22, 'Kebbi', 127),
(23, 'Kogi', 127),
(24, 'Kwara', 127),
(25, 'Lagos', 127),
(26, 'Nasarawa', 127),
(27, 'Niger', 127),
(28, 'Ogun', 127),
(29, 'Ondo', 127),
(30, 'Osun', 127),
(31, 'Oyo', 127),
(32, 'Plateau', 127),
(33, 'Rivers', 127),
(34, 'Sokoto', 127),
(35, 'Taraba', 127),
(36, 'Yobe', 127),
(37, 'Zamfara', 127),
(59, 'Adar', 3),
(60, 'Ain Defla', 3),
(61, 'Ain Temouchent', 3),
(62, 'Algiers', 3),
(63, 'Annaba ', 3),
(64, 'Batna', 3),
(65, 'Bechar ', 3),
(66, 'Bejaia', 3),
(67, 'Briska', 3),
(68, 'Blida', 3),
(69, 'Bordj Bou Arreridj ', 3),
(70, 'Bouira', 3),
(71, 'Boumerdes', 3),
(72, 'Chlef', 3),
(73, 'Constantine', 3),
(74, 'Djelfa', 3),
(75, 'El Bayadh ', 3),
(76, 'El Oued', 3),
(77, 'El Tarf ', 3),
(78, 'Ghsardaia', 3),
(79, 'Guelma', 3),
(80, 'Illizi', 3),
(81, 'Jijel ', 3),
(82, 'Khenchela', 3),
(83, 'Laghouat ', 3),
(84, 'Mascara', 3),
(85, 'Medea', 3),
(86, 'Mila', 3),
(87, 'Mostaganem ', 3),
(88, 'Msila', 3),
(89, 'Naama', 3),
(90, 'Oran', 3),
(91, 'Ouargla', 3),
(92, 'Oum el Bouaghi', 3),
(93, 'Relizane', 3),
(94, 'Saida', 3),
(95, 'Setif ', 3),
(96, 'Sidi Bel Abbes', 3),
(97, 'Skikda', 3),
(98, 'Souk Ahras', 3),
(99, 'Tamanghasset ', 3),
(100, 'Tebessa', 3),
(101, 'Tiaret', 3),
(102, 'Tindouf', 3),
(103, 'Tipaza', 3),
(104, 'Tissemsilt', 3),
(105, 'Tizi Ouzou ', 3),
(106, 'Tlemcen', 3),
(107, 'Bengo', 5),
(108, 'Benguela', 5),
(109, 'Bei ', 5),
(110, 'Cabinda', 5),
(111, 'Cuando Cubango', 5),
(112, 'Cuanza Norte', 5),
(113, 'Cuanza Sul', 5),
(114, 'Cunene', 5),
(115, 'Huambo', 5),
(116, 'Huila', 5),
(117, 'Luanda ', 5),
(118, 'Luanda Norte', 5),
(119, 'Luanda Sul', 5),
(120, 'Malanje', 5),
(121, 'Moxico ', 5),
(122, 'Namibe', 5),
(123, 'Uige', 5),
(124, 'Zaire', 5),
(143, 'Alibori', 19),
(144, 'Atakora', 19),
(145, 'Atlantique ', 19),
(146, 'Borgou', 19),
(147, 'Coliines Department', 19),
(148, 'Donga', 19),
(149, 'Kouffo', 19),
(150, 'Littoral Department', 19),
(151, 'Mono Department', 19),
(152, 'Oueme', 19),
(153, 'Plateau ', 19),
(154, 'Zou', 19),
(155, 'Central', 23),
(156, 'Ghanzi', 23),
(157, 'Kgalagadi ', 23),
(158, 'Kgatleng', 23),
(159, 'Kweneng', 23),
(160, 'North West', 23),
(161, 'North East', 23),
(162, 'South East', 23),
(163, 'Southern', 23),
(164, 'British Indian Ocean Territory', 202),
(165, 'Bale', 27),
(166, 'Bam/Lake Bam', 27),
(167, 'Bazega ', 27),
(168, 'Bougouriba', 27),
(169, 'Boulgou Province', 27),
(170, 'Boulkiemde', 27),
(171, 'Comoe/Komoe', 27),
(172, 'Ganzourgou Province', 27),
(173, 'Gourma Province', 27),
(174, 'Houet', 27),
(175, 'Ioba ', 27),
(176, 'Kadiogo', 27),
(177, 'Kenedougou', 27),
(178, 'Komondjari', 27),
(179, 'Kompienga', 27),
(180, 'Kossi Province', 27),
(181, 'Koulpelogo', 27),
(182, 'Kouritenga', 27),
(183, 'Leraba ', 27),
(184, 'Loroum', 27),
(185, 'Mouhoun', 27),
(186, 'Namentenga', 27),
(187, 'Naouri/Nahouri', 27),
(188, 'Nayala', 27),
(189, 'Noumbiel ', 27),
(190, 'Oubritenga', 27),
(191, 'Oudalan', 27),
(192, 'Passore', 27),
(193, 'Poni', 27),
(194, 'Sanguie', 27),
(195, 'Sanmatenga', 27),
(196, 'Seno', 27),
(197, 'Sissili ', 27),
(198, 'Soum', 27),
(199, 'Sourou', 27),
(200, 'Tapoa', 27),
(201, 'Tui/Tuy', 27),
(202, 'Yagha ', 27),
(203, 'Yatenga', 27),
(204, 'Ziro', 27),
(205, 'Zondoma', 27),
(206, 'Zoudweogo', 27),
(207, 'Bubanza', 28),
(208, 'Bujumbura Mairie', 28),
(209, 'Bujumbura Rural', 28),
(210, 'Bururi', 28),
(211, 'Cankuzo', 28),
(212, 'Cibitoke', 28),
(213, 'Gitega', 28),
(214, 'Karuzi', 28),
(215, 'Kayanza', 28),
(216, 'Kirundo', 28),
(217, 'Makamba ', 28),
(218, 'Muramvya', 28),
(219, 'Muyinga', 28),
(220, 'Mwaro', 28),
(221, 'Ngozi', 28),
(222, 'Rutana', 28),
(223, 'Ruyigi', 28),
(224, 'Adamaoua', 32),
(225, 'Centre', 32),
(226, 'Est', 32),
(227, 'Extreme-Nord', 32),
(228, 'Littoral', 32),
(229, 'Nord', 32),
(230, 'Nord-Ouest', 32),
(231, 'Ouest', 32),
(232, 'Sud', 32),
(233, 'Sud-Ouest', 32),
(234, 'Boa Vista', 30),
(235, 'Brava', 30),
(236, 'Calheta de Sao Miguel', 30),
(237, 'Maio', 30),
(238, 'Mosteiros', 30),
(239, 'Paul', 30),
(240, 'Porto Novo', 30),
(241, 'Praia', 30),
(242, 'Ribeira Brava', 30),
(243, 'Ribeira Grande', 30),
(244, 'Sal', 30),
(245, 'Santa Catarina', 30),
(246, 'Santa Cruz', 30),
(247, 'Sao Domingos', 30),
(248, 'Sao Filipe', 30),
(249, 'Sao Nicolau', 30),
(250, 'Sao Vicenete', 30),
(251, 'Tarrafal', 30),
(252, 'Tarrafal de Sao Nicolau', 30),
(253, 'Bahr el Ghazal', 35),
(254, 'Batha', 35),
(255, 'Borkou', 35),
(256, 'Chari-Baguirmi', 35),
(257, 'Ennedi-Est', 35),
(258, 'Ennedi-Ouest', 35),
(259, 'Guera', 35),
(260, 'Hadjer Lamis', 35),
(261, 'Kanem', 35),
(262, 'Lac', 35),
(263, 'Lagone Occidental', 35),
(264, 'Lagone Oriental', 35),
(265, 'Mondoul', 35),
(266, 'Mayo-Kebbi_est', 35),
(267, 'Mayon-Chari', 35),
(268, 'Ouaddai', 35),
(269, 'Salamat', 35),
(270, 'Sila', 35),
(271, 'Tandjile', 35),
(272, 'Tibesti', 35),
(273, 'Ville de Ndjamena', 35),
(274, 'Wadi Fira', 35),
(275, 'Andjazidja', 39),
(276, 'Andjouan', 39),
(277, 'Mouhili', 39),
(278, 'Bouenza', 40),
(279, 'Brazzaville', 40),
(280, 'Cuvette', 40),
(281, 'Cuvette-Ouest', 40),
(282, 'Kouilou', 40),
(283, 'Lekoumou', 40),
(284, 'Likouala', 40),
(285, 'Niara', 40),
(286, 'Plateaux', 40),
(287, 'Pointe-Noire', 40),
(288, 'Pool', 40),
(289, 'Sangha', 40),
(290, 'Agneby', 29),
(291, 'Bafing', 29),
(292, 'Bas-Sassandra', 29),
(293, 'Denguele', 29),
(294, 'Dix-Huit Montagnes', 29),
(295, 'Fromager', 29),
(296, 'Haut-Sassandra', 29),
(297, 'Lacs', 29),
(298, 'Lagunes', 29),
(299, 'Marahoue', 29),
(300, 'Moyen-Cavally', 29),
(301, 'Moyen-Comoe', 29),
(302, 'N\'zi-Comoe', 29),
(303, 'Savanes', 29),
(304, 'Sud-Bandama', 29),
(305, 'Sud-Comoe', 29),
(306, 'Vallee du Bandama', 29),
(307, 'Worodougou', 29),
(308, 'Zanzan', 29),
(309, 'Bandundun', 46),
(310, 'Bas-Congo', 46),
(311, 'Equateur', 46),
(312, 'Kasai-Occidental', 46),
(313, 'Kasai-Oriental', 46),
(314, 'Katanga', 46),
(315, 'Kinshasa', 46),
(316, 'Maniema', 46),
(317, 'Nord-Kivu', 46),
(318, 'Orientale', 46),
(319, 'Sud-Kivu', 46),
(320, 'Ali Sabieh', 48),
(321, 'Arta', 48),
(322, 'Dikhil', 48),
(323, 'Obock', 48),
(324, 'Tadjourah', 48),
(325, 'Alexandria', 52),
(326, 'Aswan', 52),
(327, 'Bani Sueif', 52),
(328, 'Beheira', 52),
(329, 'Cairao', 52),
(330, 'Daqahlia', 52),
(331, 'Dumiat', 52),
(332, 'El Bahr El Ahmar', 52),
(333, 'El Ismailia', 52),
(334, 'El Suez', 52),
(335, 'El Wadi El Gadeed', 52),
(336, 'Fayoum', 52),
(337, 'Gharbia', 52),
(338, 'Giza', 52),
(339, 'Helwan', 52),
(340, 'Kafr El Sheikh', 52),
(341, 'Luxor', 52),
(342, 'Matrouh', 52),
(343, 'Menia', 52),
(344, 'Menofia', 52),
(345, 'North Sanai', 52),
(346, 'Port Said', 52),
(347, 'Qalubia', 52),
(348, 'Qena', 52),
(349, 'Sharqia', 52),
(350, 'Sixth of October', 52),
(351, 'Sohag', 52),
(352, 'South Sanai', 52),
(353, 'Annobon', 54),
(354, 'Bioko Norte', 54),
(355, 'Biokor Sur', 54),
(356, 'Centro Sur', 54),
(357, 'Kie-Ntem', 54),
(358, 'Litoral', 54),
(359, 'Wele-Nzas', 54),
(360, 'Anseba', 55),
(361, 'Debub', 55),
(362, 'Debub-Keih-Bahri', 55),
(363, 'Gash-Barika', 55),
(364, 'Maekel', 55),
(365, 'Semien-Keih-Bahri', 55),
(366, 'Hihohho', 57),
(367, 'Lubombo', 57),
(368, 'Manzini', 57),
(369, 'Shiselweni', 57),
(370, 'Addis Ababa', 58),
(371, 'Afar', 58),
(372, 'Amhara', 58),
(373, 'Benshangul-Gumaz', 58),
(374, 'Dire Dawa', 58),
(375, 'Gambela', 58),
(376, 'Harari', 58),
(377, 'Oromia', 58),
(378, 'Somali', 58),
(379, 'South Nations nationalities and People\'s', 58),
(380, 'Tigray', 58),
(381, 'Estuaire', 62),
(382, 'Haut-Ogooue', 62),
(383, 'Moyen-Ogooue', 62),
(384, 'Ngounie', 62),
(385, 'Nyanga', 62),
(386, 'Ogooue-Ivindo', 62),
(387, 'Ogooue-Lolo', 62),
(388, 'Ogooue-Maritime', 62),
(389, 'Woleu-Ntem', 62),
(390, 'Banjul', 63),
(391, 'Central River', 63),
(392, 'Lower River', 63),
(393, 'North Bank', 63),
(394, 'Upper Bank', 63),
(395, 'Western', 63),
(396, 'Ashanti', 66),
(397, 'Brong-Ahafo', 66),
(398, 'Central', 66),
(399, 'Eastern', 66),
(400, 'Greater Accra', 66),
(401, 'Northern', 66),
(402, 'Upper East', 66),
(403, 'Upper West', 66),
(404, 'Volta', 66),
(405, 'Western', 66),
(406, 'Boke', 70),
(407, 'Conakry', 70),
(408, 'Faranah', 70),
(409, 'Kankan', 70),
(410, 'Kindia', 70),
(411, 'Labe', 70),
(412, 'Mamou', 70),
(413, 'Nzerekore', 70),
(414, 'Bafata', 71),
(415, 'Biombo', 71),
(416, 'Bissau', 71),
(417, 'Bolama-Bijagos', 71),
(418, 'KinCacheudia', 71),
(419, 'Gabu', 71),
(420, 'Oio', 71),
(421, 'Quinara', 71),
(422, 'Tombali', 71),
(423, 'Baringo', 89),
(424, 'Bomet', 89),
(425, 'Bungoma', 89),
(426, 'Busia', 89),
(427, 'Eleyo/Marakwet', 89),
(428, 'Embu', 89),
(429, 'Garissa', 89),
(430, 'Homa Bay', 89),
(431, 'Isiolo', 89),
(432, 'Kajiado', 89),
(433, 'Kakamega', 89),
(434, 'Kericho', 89),
(435, 'Kiambu', 89),
(436, 'Kilifi', 89),
(437, 'Kirinyaga', 89),
(438, 'Kisii', 89),
(439, 'Kisumu', 89),
(440, 'Kitui', 89),
(441, 'Kwale', 89),
(442, 'Laikipia', 89),
(443, 'Lamu', 89),
(444, 'Machakos', 89),
(445, 'Makueni', 89),
(446, 'Mandera', 89),
(447, 'Marsabit', 89),
(448, 'Meru', 89),
(449, 'Migori', 89),
(450, 'Mombasa', 89),
(451, 'Murang\'a', 89),
(452, 'Nairobi City', 89),
(453, 'Nakuru', 89),
(454, 'Nandi', 89),
(455, 'Narok', 89),
(456, 'Nyamira', 89),
(457, 'Nyandarua', 89),
(458, 'Nyeri', 89),
(459, 'Samburu', 89),
(460, 'Siaya', 89),
(461, 'Taita/Taveta', 89),
(462, 'Tana River', 89),
(463, 'Tharaka-Nithi', 89),
(464, 'Trans Nzoia', 89),
(465, 'Turkana', 89),
(466, 'Uasin Gishu', 89),
(467, 'Vihiga', 89),
(468, 'Wajir', 89),
(469, 'West Pokot', 89),
(470, 'Berea', 96),
(471, 'Butha-Buthe', 96),
(472, 'Leribe', 96),
(473, 'Mafeteng', 96),
(474, 'Maseru', 96),
(475, 'Mohales Hoek', 96),
(476, 'Mokhotlong', 96),
(477, 'Qacha\'s Nek', 96),
(478, 'Quthing', 96),
(479, 'Thaba-Tseka', 96),
(480, 'Bomi', 97),
(481, 'Bong', 97),
(482, 'Gbarpolu', 97),
(483, 'Grand Cape Mount', 97),
(484, 'Grand Geden', 97),
(485, 'Grand Kru', 97),
(486, 'Lofa', 97),
(487, 'Margibi', 97),
(488, 'Maryland', 97),
(489, 'Montserrado', 97),
(490, 'Nimba', 97),
(491, 'River Cess', 97),
(492, 'River Geee', 97),
(493, 'Sinoe', 97),
(494, 'Al Butnan', 98),
(495, 'Al Jabal ak Akhdar', 98),
(496, 'Al Jabal al Gharbi', 98),
(497, 'Al Jafarah', 98),
(498, 'Al Jufrah', 98),
(499, 'Al Kufrah', 98),
(500, 'Al Marj', 98),
(501, 'Al Marquab', 98),
(502, 'Al Wahat', 98),
(503, 'An Nuqat al Khams', 98),
(504, 'Az Zawiyah', 98),
(505, 'Banghazi', 98),
(506, 'Darbah', 98),
(507, 'Ghat', 98),
(508, 'Misratah', 98),
(509, 'Murzuq', 98),
(510, 'Nalut', 98),
(511, 'Sabha', 98),
(512, 'Surt', 98),
(513, 'Tarabulus', 98),
(514, 'Yafran', 98),
(515, 'Wadi ash Shati', 98),
(516, 'Antananarivo', 102),
(517, 'Antsiranana', 102),
(518, 'Fianarantsoa', 102),
(519, 'Mahajanga', 102),
(520, 'Toamasina', 102),
(521, 'Toliara', 102),
(522, 'Balaka', 103),
(523, 'Blantyre', 103),
(524, 'Chikwawa', 103),
(525, 'Chiradzulu', 103),
(526, 'Chitipa', 103),
(527, 'Dedza', 103),
(528, 'Dowa', 103),
(529, 'Karonga', 103),
(530, 'Kasungu', 103),
(531, 'Likoma', 103),
(532, 'Lilongwe', 103),
(533, 'Machinga', 103),
(534, 'Mangochi', 103),
(535, 'Mchinji', 103),
(536, 'Mulanje', 103),
(537, 'Mwanza', 103),
(538, 'Mzimba', 103),
(539, 'Nkhata Bay', 103),
(540, 'Nkhotakota', 103),
(541, 'Nsanje', 103),
(542, 'Ntcheu', 103),
(543, 'Ntchisi', 103),
(544, 'Phalombe', 103),
(545, 'Rumphi', 103),
(546, 'Salima', 103),
(547, 'Thyolo', 103),
(548, 'Zomba', 103),
(549, 'Bamako', 106),
(550, 'Gao', 106),
(551, 'Kayes', 106),
(552, 'Kidal', 106),
(553, 'Koulikoro', 106),
(554, 'Mopti', 106),
(555, 'Segou', 106),
(556, 'Sikasso', 106),
(557, 'Tombouctou', 106),
(558, 'Adrar', 109),
(559, 'Assaba', 109),
(560, 'Braknar', 109),
(561, 'Dakhlet Nouadhibou', 109),
(562, 'Gorgol', 109),
(563, 'Guidimaka', 109),
(564, 'Hodh Ech Chargui', 109),
(565, 'Hodh El Gharbi', 109),
(566, 'Inchiri', 109),
(567, 'Nouakchott Nord', 109),
(568, 'Nouakchott Ouest', 109),
(569, 'Nouakchott Sud', 109),
(570, 'Tagant', 109),
(571, 'Tiris Zemmour', 109),
(572, 'Trarza', 109),
(573, 'Agalega Islands', 110),
(574, 'Beau Bassin-Rose Hill', 110),
(575, 'Black River', 110),
(576, 'Cargados Carajos Shoals', 110),
(577, 'Curepipe', 110),
(578, 'Flacq', 110),
(579, 'Grand Port', 110),
(580, 'Moka', 110),
(581, 'Pamplemousses', 110),
(582, 'Pianes Wilhems', 110),
(583, 'Port Louis (City)', 110),
(584, 'Port Louis', 110),
(585, 'Riviere du Rempart', 110),
(586, 'Rodrigues Island', 110),
(587, 'Savanne', 110),
(588, 'Vacoas-Phoenix', 110),
(589, 'Chaouia-Ouardigha', 117),
(590, 'Doukhala-Abda', 117),
(591, 'Fes-Boulemane', 117),
(592, 'Gharb-Chrarda-Ben Hssen', 117),
(593, 'Grand Casablanca', 117),
(594, 'Guelmim-Es Semara', 117),
(595, 'Laayoune-Boujdour-Sakia el Hamra', 117),
(596, 'Marrakech-Tensift-Al Haouz', 117),
(597, 'Meknes-Tafilalet', 117),
(598, 'Oriental', 117),
(599, 'Oued ed Dahab-Lagouira', 117),
(600, 'Souss-Massa-Draa', 117),
(601, 'Tadla-Azilal', 117),
(602, 'Tanger-Tetouan', 117),
(603, 'Taza-Al Hoceima-Taounate Island', 117),
(604, 'Cabo Delgado', 118),
(605, 'Gaza', 118),
(606, 'Inhambane', 118),
(607, 'Manica', 118),
(608, 'Maputo', 118),
(609, 'Maputo (City)', 118),
(610, 'Nampula', 118),
(611, 'Niassa', 118),
(612, 'Sofala', 118),
(613, 'Tete', 118),
(614, 'Zambezia', 118),
(615, 'Ayeyarwady', 119),
(616, 'Bago', 119),
(617, 'Chin', 119),
(618, 'Kachin', 119),
(619, 'kayah', 119),
(620, 'kayin', 119),
(621, 'Magway', 119),
(622, 'Mandalay', 119),
(623, 'Mon', 119),
(624, 'Nay Pyi Taw', 119),
(625, 'Rakhine', 119),
(626, 'Sagaing', 119),
(627, 'Shan', 119),
(628, 'Tanintharyi', 119),
(629, 'Yangon', 119),
(630, 'Erongo', 120),
(631, 'Hardap', 120),
(632, 'Kavango East', 120),
(633, 'Kavango West', 120),
(634, 'Karas', 120),
(635, 'Khomas', 120),
(636, 'Kunene', 120),
(637, 'Ohangwena', 120),
(638, 'Omaheke', 120),
(639, 'Omusati', 120),
(640, 'Oshana', 120),
(641, 'Oshikoto', 120),
(642, 'Otijozondjupa', 120),
(643, 'Zambezi', 120),
(644, 'Agadez', 126),
(645, 'Diffa', 126),
(646, 'Dosso', 126),
(647, 'Maradi', 126),
(648, 'Niamey', 126),
(649, 'Tahoua', 126),
(650, 'Tillaberi', 126),
(651, 'Zinder', 126),
(652, 'Kigali', 145),
(653, 'Eastern', 145),
(654, 'Northern', 145),
(655, 'Western', 145),
(656, 'Southern', 145),
(657, 'Ascension', 232),
(658, 'Saint Helena', 232),
(659, 'Tristan da Cunha', 232),
(660, 'Principe', 151),
(661, 'Sao Tome', 151),
(662, 'Dakar', 153),
(663, 'Diourbel', 153),
(664, 'Fatick', 153),
(665, 'Kaffrine', 153),
(666, 'Kaolack', 153),
(667, 'Kedougou', 153),
(668, 'Kolda', 153),
(669, 'Louga', 153),
(670, 'Matam', 153),
(671, 'Saint-Louis', 153),
(672, 'Sedhiou', 153),
(673, 'Tambacounda', 153),
(674, 'Thies', 153),
(675, 'Ziguinchor', 153),
(676, 'Anse aux Pins', 155),
(677, 'Anse Boileau', 155),
(678, 'Anse Etoile', 155),
(679, 'Anse Royale', 155),
(680, 'Anu Cup', 155),
(681, 'Baie Lazare', 155),
(682, 'Baie Sainte Anne', 155),
(683, 'Beau Vallon', 155),
(684, 'Bel Air', 155),
(685, 'Bel Ombre', 155),
(686, 'Cascade', 155),
(687, 'Glacis', 155),
(688, 'Grand\'Anse Mahe', 155),
(689, 'Grand\'Anse Praslin', 155),
(690, 'La Digue', 155),
(691, 'La Riviere Anglaise', 155),
(692, 'Les Mamelles', 155),
(693, 'Mont Buxton', 155),
(694, 'Mont Fleuri', 155),
(695, 'Plaisance', 155),
(696, 'Pointe La Rue', 155),
(697, 'Port Glaud', 155),
(698, 'Roche Caiman', 155),
(699, 'Saint Louis', 155),
(700, 'Takamaka', 155),
(701, 'Eastern', 156),
(702, 'Northern', 156),
(703, 'Southern', 156),
(704, 'Western', 156),
(705, 'Awdal', 161),
(706, 'Bakool', 161),
(707, 'Banaadir', 161),
(708, 'Bari', 161),
(709, 'Bay', 161),
(710, 'Galguduud', 161),
(711, 'Gedo', 161),
(712, 'Hiiraan', 161),
(713, 'Jubbada Dhexe', 161),
(714, 'Jubbada Hoose', 161),
(715, 'Mudug', 161),
(716, 'Nugaal', 161),
(717, 'Sanaag', 161),
(718, 'Shabeellaha Dhexe', 161),
(719, 'Shabeellaha Hoose', 161),
(720, 'Sool', 161),
(721, 'Togdheer', 161),
(722, 'Woqooyi Galbeed', 161),
(723, 'Eastern Cape', 162),
(724, 'Free State', 162),
(725, 'Gauteng', 162),
(726, 'KwaZulu-Natal', 162),
(727, 'Limpopo', 162),
(728, 'Mpumalanga', 162),
(729, 'Northern Cape', 162),
(730, 'North West', 162),
(731, 'Western Cape', 162),
(732, 'Central Equatoria', 164),
(733, 'Eastern Equatoria', 164),
(734, 'Jonglei', 164),
(735, 'Lakes', 164),
(736, 'Northern Bahr el Ghazal', 164),
(737, 'Unity', 164),
(738, 'Upper Nile', 164),
(739, 'Warrap', 164),
(740, 'Western Bahr el Ghazal', 164),
(741, 'Western Equatoria', 164),
(742, 'Arusha', 173),
(743, 'Coast', 173),
(744, 'Dar es Salaam', 173),
(745, 'Dodoma', 173),
(746, 'Iringa', 173),
(747, 'Kagera', 173),
(748, 'Kigoma', 173),
(749, 'Kilimanjaro', 173),
(750, 'Lindi', 173),
(751, 'Manyara', 173),
(752, 'Mara', 173),
(753, 'Mbeya', 173),
(754, 'Morogoro', 173),
(755, 'Mtwara', 173),
(756, 'Mwanza', 173),
(757, 'Pemba North', 173),
(758, 'Pemba South', 173),
(759, 'Rukwa', 173),
(760, 'Ruvuma', 173),
(761, 'Shinyanga', 173),
(762, 'Singida', 173),
(763, 'Tabora', 173),
(764, 'Tanga', 173),
(765, 'Zanzibar North', 173),
(766, 'Zanzibar Central/South', 173),
(767, 'Zanzibar Urban/West', 173),
(768, 'Centre', 176),
(769, 'Kara', 176),
(770, 'Maritime', 176),
(771, 'Plateaux', 176),
(772, 'Savannes', 176),
(773, 'Ariana', 179),
(774, 'Beja', 179),
(775, 'Ben Arous', 179),
(776, 'Bizerte', 179),
(777, 'Gabes', 179),
(778, 'Gafsa', 179),
(779, 'Jendouba', 179),
(780, 'Kairouan', 179),
(781, 'Kasserine', 179),
(782, 'Kebili', 179),
(783, 'Kef', 179),
(784, 'Mahdia', 179),
(785, 'Medenine', 179),
(786, 'Monastir', 179),
(787, 'Nabeul', 179),
(788, 'Sfax', 179),
(789, 'Sidi Bouzid', 179),
(790, 'Siliana', 179),
(791, 'Sousse', 179),
(792, 'Tataouine', 179),
(793, 'Tozeur', 179),
(794, 'Tunis', 179),
(795, 'Zaghouan', 179),
(796, 'Abim', 183),
(797, 'Adjumani', 183),
(798, 'Amolatar', 183),
(799, 'Amuria', 183),
(800, 'Amuru', 183),
(801, 'Apac', 183),
(802, 'Arua', 183),
(803, 'Budaka', 183),
(804, 'Bududa', 183),
(805, 'Bugiri', 183),
(806, 'Bukedea', 183),
(807, 'Bukwa', 183),
(808, 'Buliisa', 183),
(809, 'Bundibugyo', 183),
(810, 'Bushenyi', 183),
(811, 'Busia', 183),
(812, 'Butaleja', 183),
(813, 'Dokolo', 183),
(814, 'Gulu', 183),
(815, 'Hoima', 183),
(816, 'Ibanda', 183),
(817, 'Iganga', 183),
(818, 'Isingiro', 183),
(819, 'Jinja', 183),
(820, 'Kaabong', 183),
(821, 'Kabale', 183),
(822, 'Kabarole', 183),
(823, 'Kaberamaido', 183),
(824, 'Kalangala', 183),
(825, 'Kaliro', 183),
(826, 'Kampala', 183),
(827, 'Kamuli', 183),
(828, 'Kamwenge', 183),
(829, 'Kanungu', 183),
(830, 'Kapchorwa', 183),
(831, 'Kasese', 183),
(832, 'Katakwi', 183),
(833, 'Kayunga', 183),
(834, 'Kibaale', 183),
(835, 'Kiboga', 183),
(836, 'Kiruhura', 183),
(837, 'Kisoro', 183),
(838, 'Kitgum', 183),
(839, 'Koboko', 183),
(840, 'Kotido', 183),
(841, 'Kumi', 183),
(842, 'Kyenjojo', 183),
(843, 'Lira', 183),
(844, 'Luwero', 183),
(845, 'Lyantonde', 183),
(846, 'Manafwa', 183),
(847, 'Maracha', 183),
(848, 'Masaka', 183),
(849, 'Masindi', 183),
(850, 'Mayuge', 183),
(851, 'Mbale', 183),
(852, 'Mbarara', 183),
(853, 'Mityana', 183),
(854, 'Moroto', 183),
(855, 'Moyo', 183),
(856, 'Mpigi', 183),
(857, 'Mubende', 183),
(858, 'Mukono', 183),
(859, 'Nakapiripirit', 183),
(860, 'Nakaseke', 183),
(861, 'Nakasongola', 183),
(862, 'Namutumba', 183),
(863, 'Nebbi', 183),
(864, 'Ntungamo', 183),
(865, 'Oyam', 183),
(866, 'Pader', 183),
(867, 'Pallisa', 183),
(868, 'Rakai', 183),
(869, 'Rukungiri', 183),
(870, 'Sembabule', 183),
(871, 'Nebbi', 183),
(872, 'Sironko', 183),
(873, 'Soroti', 183),
(874, 'Tororo', 183),
(875, 'Wakiso', 183),
(876, 'Yumbe', 183),
(877, 'Es Smara', 246),
(878, 'Boujdour', 246),
(879, 'Laayoune', 246),
(880, 'Aousserd', 246),
(881, 'Oued ed Dahab', 246),
(882, 'Central', 194),
(883, 'Copperbelt', 194),
(884, 'Eastern', 194),
(885, 'Luapula', 194),
(886, 'Lusaka', 194),
(887, 'Northern', 194),
(888, 'North-Western', 194),
(889, 'Southern', 194),
(890, 'Western', 194),
(891, 'Bulawayo', 195),
(892, 'Harare', 195),
(893, 'Manicaland', 195),
(894, 'Mashonaland Central', 195),
(895, 'Mashonaland West', 195),
(896, 'Masvingo', 195),
(897, 'Matabeleland North', 195),
(898, 'Matabeleland South', 195),
(899, 'Midlands', 195);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `voteId` int(11) NOT NULL,
  `cId` int(11) NOT NULL,
  `vote` int(4) NOT NULL DEFAULT '0',
  `voterEmail` varchar(200) NOT NULL,
  `tnxRef` varchar(200) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`contactId`);

--
-- Indexes for table `contest`
--
ALTER TABLE `contest`
  ADD PRIMARY KEY (`contestId`);

--
-- Indexes for table `contestant`
--
ALTER TABLE `contestant`
  ADD PRIMARY KEY (`cId`),
  ADD KEY `countryId` (`countryId`),
  ADD KEY `stateId` (`stateId`);

--
-- Indexes for table `contestwinner`
--
ALTER TABLE `contestwinner`
  ADD PRIMARY KEY (`winnerId`),
  ADD KEY `fk_winner` (`cId`);

--
-- Indexes for table `continent`
--
ALTER TABLE `continent`
  ADD PRIMARY KEY (`continentId`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`countryId`),
  ADD KEY `continentId` (`continentId`);

--
-- Indexes for table `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`pId`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`stateId`),
  ADD KEY `countryId` (`countryId`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`voteId`),
  ADD KEY `cId` (`cId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `contactId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contest`
--
ALTER TABLE `contest`
  MODIFY `contestId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contestant`
--
ALTER TABLE `contestant`
  MODIFY `cId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contestwinner`
--
ALTER TABLE `contestwinner`
  MODIFY `winnerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `continent`
--
ALTER TABLE `continent`
  MODIFY `continentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `countryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `partner`
--
ALTER TABLE `partner`
  MODIFY `pId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `stateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=900;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `voteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contestant`
--
ALTER TABLE `contestant`
  ADD CONSTRAINT `contestant_ibfk_2` FOREIGN KEY (`countryId`) REFERENCES `country` (`countryId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `contestant_ibfk_3` FOREIGN KEY (`stateId`) REFERENCES `state` (`stateId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contestwinner`
--
ALTER TABLE `contestwinner`
  ADD CONSTRAINT `fk_winner` FOREIGN KEY (`cId`) REFERENCES `contestant` (`cId`);

--
-- Constraints for table `country`
--
ALTER TABLE `country`
  ADD CONSTRAINT `country_ibfk_1` FOREIGN KEY (`continentId`) REFERENCES `continent` (`continentId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `state_ibfk_1` FOREIGN KEY (`countryId`) REFERENCES `country` (`countryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`cId`) REFERENCES `contestant` (`cId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
