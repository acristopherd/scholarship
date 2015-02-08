-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2015 at 02:44 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `osa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladviser`
--

CREATE TABLE IF NOT EXISTS `tbladviser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scholarship_id` int(11) NOT NULL,
  `adviser` varchar(50) NOT NULL,
  `dean` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `scholarship_id` (`scholarship_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbladviser`
--

INSERT INTO `tbladviser` (`id`, `scholarship_id`, `adviser`, `dean`) VALUES
(1, 40, 'Rosanne Agup', 'Julie Beth Balite');

-- --------------------------------------------------------

--
-- Table structure for table `tblannouncement`
--

CREATE TABLE IF NOT EXISTS `tblannouncement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `message` text NOT NULL,
  `venue` varchar(50) NOT NULL,
  `date_of_event` date NOT NULL,
  `time_of_event` time NOT NULL,
  `from` varchar(80) NOT NULL,
  `date_posted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tblannouncement`
--

INSERT INTO `tblannouncement` (`id`, `title`, `message`, `venue`, `date_of_event`, `time_of_event`, `from`, `date_posted`) VALUES
(1, 'hello', '<b>Happy&nbsp;</b><div><b>New&nbsp;</b></div><div><b>Year</b></div>', 'everywhere', '2015-01-01', '01:00:00', 'Me', '0000-00-00 00:00:00'),
(2, 'Again', 'asdfsa<div>asd</div><div>fas</div><div>df</div><div>sadf</div><div><br></div>', 'sd', '2014-01-01', '01:00:00', 'dfs', '0000-00-00 00:00:00'),
(5, 'lkk', 'asfdasfd<div>af</div><div>d</div><div>saf</div><div>sd</div><div>af</div><div><br></div>', 'ccit', '2014-02-02', '02:00:00', 'allan', '0000-00-00 00:00:00'),
(6, 'lkj', 'asff', 'sadf', '2015-01-01', '01:00:00', 'asd', '0000-00-00 00:00:00'),
(7, 'asdf', 'hello again', 'ccit', '2014-02-01', '01:00:00', 'allan', '2014-12-28 00:00:00'),
(8, 'kjklj', 'asfd', 'ccit', '2014-01-01', '01:00:00', 'allan', '2014-12-28 05:21:36'),
(9, 'Another announcement', 'asdf<div>asfd</div><div>asf</div><div>sad</div><div>f</div>', 'everywhere', '2014-01-01', '01:00:00', 'allan', '2014-12-29 12:06:37'),
(11, 'announcement today', 'asf', 'sdfasd', '2015-01-01', '01:00:00', 'asd', '2015-01-11 11:25:10'),
(12, 'asdf', 'asdff', 'sd', '2015-02-01', '01:00:00', 'Again', '2015-01-11 11:28:25'),
(13, 'Meeting', 'Meeting.', 'Gym', '2015-02-01', '07:30:00', 'VPSEA', '2015-01-14 04:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblannouncement_type`
--

CREATE TABLE IF NOT EXISTS `tblannouncement_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblannouncement_type`
--

INSERT INTO `tblannouncement_type` (`id`, `announcement_id`, `type_id`) VALUES
(1, 12, 1),
(2, 12, 2),
(3, 13, 1),
(4, 13, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblcaptcha`
--

CREATE TABLE IF NOT EXISTS `tblcaptcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3007 ;

--
-- Dumping data for table `tblcaptcha`
--

INSERT INTO `tblcaptcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(2843, 1417504682, '::1', 'Umuna 4830'),
(2844, 1417505059, '::1', 'Agpukis 5221'),
(2845, 1417505082, '::1', 'Agbekkel 5086'),
(2846, 1417505099, '::1', 'Sabado 4317'),
(2847, 1417505252, '::1', 'Problema 3555'),
(2848, 1417505267, '::1', 'Kaniana 6067'),
(2849, 1417505422, '::1', 'Kulba 5574'),
(2850, 1417505427, '::1', 'Agmulumog 5166'),
(2851, 1417508282, '::1', 'Malipatan 2172'),
(2852, 1417508527, '::1', 'Toktok 7972'),
(2853, 1417508602, '::1', 'Agrakrak 9596'),
(2854, 1417508750, '::1', 'Nalisto 6231'),
(2855, 1417509892, '::1', 'Agwagsak 8371'),
(2856, 1417509955, '::1', 'Marunaw 8728'),
(2857, 1417510043, '::1', 'Pinesat 8035'),
(2858, 1417510089, '::1', 'Napudaw 5750'),
(2859, 1417510132, '::1', 'Riari 7851'),
(2860, 1417510174, '::1', 'Agani 1070'),
(2861, 1417510220, '::1', 'Nailubo 1961'),
(2862, 1417510239, '::1', 'Mapunno 8305'),
(2863, 1417510371, '::1', 'Tabla 4005'),
(2864, 1417510386, '::1', 'Aklo 6935'),
(2865, 1417510402, '::1', 'Lumned 3444'),
(2866, 1417510425, '::1', 'Agkamet 8989'),
(2867, 1417510699, '::1', 'Nalungtot 7666'),
(2868, 1417510730, '::1', 'Kutsara 8743'),
(2869, 1417510926, '::1', 'Nasadiwa 9610'),
(2870, 1417511427, '::1', 'Aglambong 6013'),
(2871, 1417575517, '::1', 'Supilyo 2536'),
(2872, 1417742092, '::1', 'Agtaktak 2444'),
(2873, 1418701812, '::1', 'Lana 5679'),
(2874, 1419143904, '::1', 'Pabilo 1924'),
(2875, 1419143986, '::1', 'Rumabrabii 6117'),
(2876, 1419248177, '::1', ' 1893'),
(2877, 1419257311, '::1', 'Ulo 9447'),
(2878, 1419257368, '::1', 'Agpasyar 4243'),
(2879, 1419288063, '::1', 'Sinabado 4650'),
(2880, 1420117671, '::1', 'Lakasa 7967'),
(2881, 1420117809, '::1', 'Agkablaa 6473'),
(2882, 1420117860, '::1', 'Siding 1355'),
(2883, 1420117870, '::1', 'Longon 5974'),
(2884, 1420271380, '::1', 'Nga 6020'),
(2885, 1420272098, '::1', 'Agwayway 1734'),
(2886, 1420277211, '::1', 'Agukis 7122'),
(2887, 1420608409, '::1', 'Kayo 3146'),
(2888, 1420608590, '::1', 'Agayos 4777'),
(2889, 1420608664, '::1', 'Pirak 6412'),
(2890, 1420639217, '::1', ' 3400'),
(2891, 1420639234, '::1', 'Agkatawa 1139'),
(2892, 1420691071, '::1', 'Agbalkut 3032'),
(2893, 1420691106, '::1', 'Aglastog 1994'),
(2894, 1420691145, '::1', 'Tonsan 5877'),
(2895, 1420693989, '::1', 'Agberber 9958'),
(2896, 1420694018, '::1', 'Nasamek 2139'),
(2897, 1420694039, '::1', 'Paswit 9616'),
(2898, 1420694965, '::1', 'Agkammel 2183'),
(2899, 1420695025, '::1', 'Papaya 6702'),
(2900, 1420697220, '::1', 'Siempre 6242'),
(2901, 1420698258, '::1', 'Sumaruno 8262'),
(2902, 1420699405, '::1', 'Malammin 4245'),
(2903, 1420699417, '::1', 'Tumagbat 7001'),
(2904, 1420699428, '::1', 'Sadino 1168'),
(2905, 1420699454, '::1', 'Agimun 7911'),
(2906, 1420699475, '::1', 'Sangaribu 7489'),
(2907, 1420699497, '::1', 'Pareha 7378'),
(2908, 1420699532, '::1', 'Agimun 6401'),
(2909, 1420699682, '::1', 'Malasin 8847'),
(2910, 1420699751, '::1', 'Puriket 3541'),
(2911, 1420699796, '::1', 'Malmes 5202'),
(2912, 1420700413, '::1', ' 5456'),
(2913, 1420700488, '::1', 'Mauyos 3952'),
(2914, 1420700520, '::1', 'Agmama 9761'),
(2915, 1420700634, '::1', 'Agpusta 6361'),
(2916, 1420701744, '::1', 'Kutsilio 1863'),
(2917, 1420701764, '::1', 'Agarab 8766'),
(2918, 1420701809, '::1', 'Agbalkut 5794'),
(2919, 1420701811, '::1', 'Agpunas 4245'),
(2920, 1420701813, '::1', 'Pumugsit 3280'),
(2921, 1420701831, '::1', 'Pasuk 1118'),
(2922, 1420701832, '::1', 'Siam 7184'),
(2923, 1420702015, '::1', 'Pagarunan 9275'),
(2924, 1420702071, '::1', 'Nalaad 2064'),
(2925, 1420702348, '::1', 'Sarming 6415'),
(2926, 1420702384, '::1', 'Pugon 6944'),
(2927, 1420702425, '::1', 'Tabla 9891'),
(2928, 1420702443, '::1', 'Agidda 1272'),
(2929, 1420702507, '::1', 'Taraudi 1589'),
(2930, 1420702674, '::1', 'Amianan 9779'),
(2931, 1420702697, '::1', 'Sumalput 6079'),
(2932, 1420702749, '::1', 'Sinulid 8513'),
(2933, 1420702756, '::1', 'Agkalap 2333'),
(2934, 1420702788, '::1', 'Tumaray 1228'),
(2935, 1420702801, '::1', 'Maituluy 3990'),
(2936, 1420702829, '::1', 'Tengnged 3348'),
(2937, 1420702854, '::1', ' 3650'),
(2938, 1420702880, '::1', 'Sinabado 8660'),
(2939, 1420708170, '::1', 'Umel 8070'),
(2940, 1420708306, '::1', 'Agbarsak 9742'),
(2941, 1420708336, '::1', 'Uleg 1545'),
(2942, 1420708590, '::1', 'Nagsabatan 4101'),
(2943, 1420708692, '::1', 'Agsabet 3897'),
(2944, 1420761782, '::1', 'Nabara 5185'),
(2945, 1420761825, '::1', 'Maililiwak 5237'),
(2946, 1420761856, '::1', 'Maassar 4210'),
(2947, 1420761885, '::1', 'Nananam 3462'),
(2948, 1420761960, '::1', 'Singat 8763'),
(2949, 1420762015, '::1', 'Agtugaw 1154'),
(2950, 1420762353, '::1', 'Marurud 7143'),
(2951, 1420762445, '::1', 'Palatang 6583'),
(2952, 1420762635, '::1', 'Salamagi 9068'),
(2953, 1420792114, '::1', 'Agkotak 7921'),
(2954, 1421051992, '::1', 'Lubong 7184'),
(2955, 1421052220, '::1', 'Piglat 8205'),
(2956, 1421123330, '::1', 'Sinulit 4262'),
(2957, 1421205336, '::1', 'Lansa 4651'),
(2958, 1422005739, '::1', 'Aglualo 9864'),
(2959, 1422023762, '::1', 'Sumublat 3840'),
(2960, 1422023799, '::1', 'Nadalus 6013'),
(2961, 1422023836, '::1', 'Masukat 6887'),
(2962, 1422024047, '::1', 'Medias 9807'),
(2963, 1422024140, '::1', 'Tanggal 5888'),
(2964, 1422024355, '::1', 'Maassar 1571'),
(2965, 1422024445, '::1', 'Naalas 2782'),
(2966, 1422024532, '::1', 'Nanang 2826'),
(2967, 1422024621, '::1', 'Agong 2262'),
(2968, 1422024659, '::1', 'Naparayag 7821'),
(2969, 1422024669, '::1', ' 2608'),
(2970, 1422024673, '::1', 'Paskua 4050'),
(2971, 1422024772, '::1', 'Alumbuyod 5208'),
(2972, 1422024892, '::1', ' 9336'),
(2973, 1422024948, '::1', 'Ratik 5017'),
(2974, 1422025016, '::1', 'Tabako 2362'),
(2975, 1422025795, '::1', 'Ukis 2815'),
(2976, 1422025818, '::1', 'Nalabaga 7575'),
(2977, 1422025906, '::1', 'Mano 8417'),
(2978, 1422025932, '::1', 'Agbusina 3279'),
(2979, 1422025982, '::1', 'Rarasa 1646'),
(2980, 1422026024, '::1', 'Nasugpet 2546'),
(2981, 1422026079, '::1', 'Nakaradkad 7533'),
(2982, 1422026181, '::1', 'Ugsa 8515'),
(2983, 1422026513, '::1', ' 5935'),
(2984, 1422026537, '::1', 'Agtanaw 5780'),
(2985, 1422026538, '::1', 'Suplian 4836'),
(2986, 1422026546, '::1', 'Agkulog 9283'),
(2987, 1422026616, '::1', 'Kukuami. 7850'),
(2988, 1422026688, '::1', 'Nablo 4332'),
(2989, 1422026738, '::1', 'Tao 2943'),
(2990, 1422026785, '::1', 'Pato 8013'),
(2991, 1422026939, '::1', 'Nabanglo 9173'),
(2992, 1422027121, '::1', 'Agbugsut 9005'),
(2993, 1422027282, '::1', 'Ukis 6073'),
(2994, 1422027434, '::1', 'Laya 3620'),
(2995, 1422027437, '::1', ' 6447'),
(2996, 1422027450, '::1', 'Sumungbat 2469'),
(2997, 1422027596, '::1', 'Sobok 9790'),
(2998, 1422027673, '::1', 'Manang 6299'),
(2999, 1422027729, '::1', 'Nariri 9588'),
(3000, 1422027786, '::1', 'Agparut 3752'),
(3001, 1422028443, '::1', 'Nagango 3808'),
(3002, 1422051456, '::1', 'Ibati 5520'),
(3003, 1422051991, '::1', 'Kareton 3334'),
(3004, 1422052043, '::1', 'Tumalna 2769'),
(3005, 1422052046, '::1', 'Agsakit 8252'),
(3006, 1422052047, '::1', ' 3528');

-- --------------------------------------------------------

--
-- Table structure for table `tblcollege`
--

CREATE TABLE IF NOT EXISTS `tblcollege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `college` varchar(20) NOT NULL,
  `desc` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `college` (`college`),
  UNIQUE KEY `desc` (`desc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tblcollege`
--

INSERT INTO `tblcollege` (`id`, `college`, `desc`) VALUES
(1, 'CAS', 'College of Arts and Sciences'),
(2, 'CCIT', 'College of Communication and Information Technology'),
(3, 'CBAA', 'College of Business Administration and Accountancy'),
(4, 'CArch', 'College of Architecture'),
(5, 'CFA', 'College of Fine Arts'),
(6, 'CE', 'Engineering'),
(7, 'CPA', 'College of Public Administration'),
(8, 'CCJESW', 'College of Criminal Justice Education and Social Works');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE IF NOT EXISTS `tblcourse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(20) NOT NULL,
  `desc` varchar(100) NOT NULL,
  `coll_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`id`, `course`, `desc`, `coll_id`) VALUES
(1, 'BSCS', 'Bachelor of Science in Computer Science', 2),
(3, 'BS InfoTech', 'Bachelor of Science in Information Technology', 2),
(4, 'BS HRA', 'Bachelor of Science in Hotel and Restaurant Administration', 3),
(5, 'BS Tour', 'Bachelor of Science in Tourism', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblgrade`
--

CREATE TABLE IF NOT EXISTS `tblgrade` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `sub_code` varchar(10) NOT NULL,
  `sub_desc` varchar(50) NOT NULL,
  `unit` int(11) NOT NULL,
  `mg` double NOT NULL,
  `fg` double NOT NULL,
  `school_year` varchar(11) NOT NULL,
  `sem` varchar(3) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `tblgrade`
--

INSERT INTO `tblgrade` (`gid`, `sid`, `sub_code`, `sub_desc`, `unit`, `mg`, `fg`, `school_year`, `sem`) VALUES
(1, 10, 'Eng 101', 'English 101', 3, 2, 1.75, '2014-2015', '1'),
(2, 10, 'Fil 101', 'Filipino 101', 3, 2.25, 2, '2014-2015', '1'),
(3, 10, 'Eng 101', 'English 1', 3, 1.5, 1.25, '2013-2014', '1'),
(4, 10, 'fil 101', 'Filipino', 3, 2, 2, '2013-2014', '1'),
(5, 10, 'Math 101', 'Algebra', 3, 1.5, 1.75, '2013-2014', '1'),
(6, 10, 'CompSci 10', 'Fundamentals', 3, 2, 2.25, '2013-2014', '1'),
(7, 10, 'CompSci 11', 'Programming 1', 3, 1.5, 1.5, '2013-2014', '1'),
(8, 10, 'PE 101', 'Foundation', 2, 2.25, 2, '2013-2014', '1'),
(9, 10, 'Socio 101', 'Society', 3, 2.5, 2.25, '', ''),
(10, 11, 'eng 101', 'English 1', 3, 2.5, 2, '2013-2014', '1'),
(11, 11, 'Fil 101', 'Filipino', 3, 1.25, 1.5, '2013-2014', '1'),
(12, 11, 'eng 101', 'English 1', 3, 2.5, 2, '2013-2014', '1'),
(13, 11, 'Fil 101', 'Filipino', 3, 1.25, 1.5, '2013-2014', '1'),
(14, 11, 'eng 101', 'English 1', 3, 2.5, 2, '2013-2014', '1'),
(15, 11, 'Fil 101', 'Filipino', 3, 1.25, 1.5, '2013-2014', '1'),
(16, 11, 'eng 101', 'English 1', 3, 2.5, 2, '2013-2014', '1'),
(17, 11, 'Fil 101', 'Filipino', 3, 1.25, 1.5, '2013-2014', '1'),
(18, 12, 'Eng 101', 'Study and thinking skills in english', 3, 2, 2, '2013-2014', '1'),
(19, 12, 'Fil 101', 'pagbasa''t pagsulat', 3, 1.5, 1.25, '2013-2014', '1'),
(20, 12, 'Eng 101', 'Study and thinking skills in english', 3, 2, 2, '2013-2014', '1'),
(21, 12, 'Fil 101', 'pagbasa''t pagsulat', 3, 1.5, 1.25, '2013-2014', '1'),
(22, 36, 'IT 110', 'Intro to IT', 3, 1.25, 1.25, '2014-2015', '1'),
(23, 36, 'Eng 101', 'Study and thinking skills in english', 3, 1.5, 1.5, '2014-2015', '1'),
(24, 42, 'Eng 101', 'English 1', 3, 1.5, 1.25, '2014-2015', '1'),
(25, 42, 'Fil 101', 'Filipino 1', 3, 2.5, 2.25, '2014-2015', '1'),
(26, 42, 'Math 101', 'Mathematics 1', 3, 1.75, 1.25, '2014-2015', '1'),
(27, 40, 'iT 110', 'Fundamentals of IT', 3, 2, 1.75, '2014-2015', '1'),
(32, 40, 'IT 111', 'Programming 1', 3, 2, 2, '2014-2015', '1'),
(33, 40, 'Socio 101', 'Society', 3, 1.5, 1.5, '2014-2015', '1'),
(34, 40, 'Hum 101', 'Humanities', 3, 2, 2, '2014-2015', '1'),
(37, 40, 'PE 101', 'Foundation of PF', 3, 2, 2, '2014-2015', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblmember`
--

CREATE TABLE IF NOT EXISTS `tblmember` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(70) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `access_level` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblmember`
--

INSERT INTO `tblmember` (`id`, `username`, `password`, `fname`, `mname`, `lname`, `access_level`) VALUES
(4, 'juandelacruz', 'd431e57fe8ba0419bd4500b702a42a5edd6c5f84d645fa6d4bf88a09abc6e0cb4dm1n', 'Juan', 'Pinoy', 'dela cruz', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmessage`
--

CREATE TABLE IF NOT EXISTS `tblmessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(80) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_posted` datetime NOT NULL,
  `read` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblmessage`
--

INSERT INTO `tblmessage` (`id`, `subject`, `message`, `user_id`, `date_posted`, `read`) VALUES
(2, 'another test', 'Test message', 4, '2015-01-18 05:22:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmessage_attach`
--

CREATE TABLE IF NOT EXISTS `tblmessage_attach` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) NOT NULL,
  `loc` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblmessage_attach`
--

INSERT INTO `tblmessage_attach` (`id`, `message_id`, `loc`) VALUES
(2, 2, 'd41d8cd98f00b204e9800998ecf8427e1421554920_0.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tblnews`
--

CREATE TABLE IF NOT EXISTS `tblnews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `news` text NOT NULL,
  `news_date` date NOT NULL,
  `author` varchar(100) NOT NULL,
  `date_posted` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tblnews`
--

INSERT INTO `tblnews` (`id`, `title`, `news`, `news_date`, `author`, `date_posted`) VALUES
(4, 'new iPhone', 'The new <b>iPhone 6</b> was released.', '2015-01-01', 'Kelly', '2015-01-09 06:49:09'),
(5, 'new', 'News', '2015-01-01', 'Kelly', '2015-01-09 08:23:35'),
(15, 'lklwer', 'asfwer<div>asdf</div><div>asf</div>', '2014-12-29', 'wer23', '2015-01-09 09:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblnews_pic`
--

CREATE TABLE IF NOT EXISTS `tblnews_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `loc` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tblnews_pic`
--

INSERT INTO `tblnews_pic` (`id`, `news_id`, `loc`) VALUES
(17, 15, 'd41d8cd98f00b204e9800998ecf8427e1420793640_0.jpg'),
(18, 15, 'd41d8cd98f00b204e9800998ecf8427e1420793640_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblorganization`
--

CREATE TABLE IF NOT EXISTS `tblorganization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accronym` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sem` varchar(10) NOT NULL,
  `sy` varchar(10) NOT NULL,
  `date_applied` datetime NOT NULL,
  `accredited` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tblorganization`
--

INSERT INTO `tblorganization` (`id`, `accronym`, `name`, `sem`, `sy`, `date_applied`, `accredited`) VALUES
(1, '0', 'society of information technology students', '1', '2014-2015', '2015-01-20 04:08:58', 0),
(2, '0', 'society of information technology students', '1', '2014-2015', '2015-01-20 04:09:54', 0),
(3, 'css', 'Computer science society', '1', '2014-2015', '2015-01-20 06:36:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblorgnization_member`
--

CREATE TABLE IF NOT EXISTS `tblorgnization_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `cour_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblorg_requirement`
--

CREATE TABLE IF NOT EXISTS `tblorg_requirement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblorg_requirement`
--

INSERT INTO `tblorg_requirement` (`id`, `organization_id`, `file_name`) VALUES
(1, 3, 'e4da3b7fbbce2345d7772b0674a318d51421732215_0.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tblorg_type`
--

CREATE TABLE IF NOT EXISTS `tblorg_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblposition`
--

CREATE TABLE IF NOT EXISTS `tblposition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accronym` varchar(20) NOT NULL,
  `position` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblposition`
--

INSERT INTO `tblposition` (`id`, `accronym`, `position`) VALUES
(1, 'President', 'President'),
(2, 'VP', 'Vice President');

-- --------------------------------------------------------

--
-- Table structure for table `tblrequirement`
--

CREATE TABLE IF NOT EXISTS `tblrequirement` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `scholarship_id` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `remarks` varchar(80) NOT NULL,
  `upload_date` date NOT NULL,
  `scholar_type` int(11) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `tblrequirement`
--

INSERT INTO `tblrequirement` (`rid`, `scholarship_id`, `file_name`, `remarks`, `upload_date`, `scholar_type`) VALUES
(67, 40, 'Donato_deff91f5b368489fe63e38d097bec2b21420524776_1.jpg', '', '2015-01-06', 7),
(68, 40, 'Donato_cfb4fc6f29b71b2cc055408cc4ee8ed31420524776_2.jpg', '', '2015-01-06', 8),
(69, 40, 'Donato_3aa5981839260921322e471292ffcbec1420524776_3.jpg', '', '2015-01-06', 9),
(70, 41, 'Donato_deff91f5b368489fe63e38d097bec2b21420524860_1.jpg', '', '2015-01-06', 4),
(71, 41, 'Donato_cfb4fc6f29b71b2cc055408cc4ee8ed31420524860_2.jpg', '', '2015-01-06', 5),
(72, 42, 'Agup_67222b352ae9f743ad6b0f0ecbb6a4a31420525830_1.jpg', '', '2015-01-06', 10),
(73, 42, 'Agup_e84a5af27409e63484ed6242744edc871420525830_2.jpg', '', '2015-01-06', 11),
(74, 43, 'Agup_67222b352ae9f743ad6b0f0ecbb6a4a31420795227_1.jpg', '', '2015-01-09', 7),
(75, 43, 'Agup_e84a5af27409e63484ed6242744edc871420795227_2.jpg', '', '2015-01-09', 8),
(76, 43, 'Agup_10cc9bfbf089f31366858c487b1d96521420795227_3.jpg', '', '2015-01-09', 9),
(77, 44, 'Agup_67222b352ae9f743ad6b0f0ecbb6a4a31420801150_1.jpg', '', '2015-01-09', 10),
(78, 44, 'Agup_e84a5af27409e63484ed6242744edc871420801150_2.jpg', '', '2015-01-09', 11),
(79, 45, 'Agup_67222b352ae9f743ad6b0f0ecbb6a4a31420801231_1.jpg', '', '2015-01-09', 10),
(80, 45, 'Agup_e84a5af27409e63484ed6242744edc871420801231_2.jpg', '', '2015-01-09', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tblscholar`
--

CREATE TABLE IF NOT EXISTS `tblscholar` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `stud_No` varchar(10) NOT NULL,
  `fname` varchar(80) NOT NULL,
  `mname` varchar(80) NOT NULL,
  `lname` varchar(80) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `civil_status` varchar(15) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `brgy` varchar(30) NOT NULL,
  `town` varchar(30) NOT NULL,
  `prov` varchar(30) NOT NULL,
  `fa_name` varchar(80) NOT NULL,
  `fa_occup` varchar(20) NOT NULL,
  `fa_educ` varchar(20) NOT NULL,
  `mo_name` varchar(80) NOT NULL,
  `mo_occup` varchar(20) NOT NULL,
  `mo_educ` varchar(20) NOT NULL,
  `com_mon_inc` double NOT NULL,
  `no_of_chil` tinyint(4) NOT NULL,
  `school_grad` varchar(40) NOT NULL,
  `addr_school` varchar(60) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fname` (`fname`,`mname`,`lname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tblscholar`
--

INSERT INTO `tblscholar` (`id`, `stud_No`, `fname`, `mname`, `lname`, `birthdate`, `gender`, `civil_status`, `contact_no`, `brgy`, `town`, `prov`, `fa_name`, `fa_occup`, `fa_educ`, `mo_name`, `mo_occup`, `mo_educ`, `com_mon_inc`, `no_of_chil`, `school_grad`, `addr_school`, `email`, `pass`, `confirmed`) VALUES
(1, '', 'Allan Cristopher', 'Navarro', 'Donato', '1988-12-09', 'Male', 'Single', '879654123', 'Nambaran', 'Sto. Domingo', 'Ilocos Sur', 'Vicente Donato', 'Farmer', 'Elementary Graduate', 'Regina Donato', 'Housewife', 'Elementary Graduate', 6000, 1, 'Lussoc NHS', 'Lussoc Sto. Domingo, Ilocos Sur', 'acristopherd@yahoo.com', 'dfc730795f1ddfe614dd6336bcb5d0d0d2e3f19a42047c8ae67739a2f289e6d6', 1),
(10, '', 'Richard', 'Corpuz', 'Arruejo', '1988-08-14', 'Male', 'Single', '09809887987', 'Pagpandayan', 'Vican City', 'Ilocos Sur', 'Benito Arruejo', 'Laborer', 'Hs Grad', 'Estrella Arruejo', 'Hk', 'Hs Grad', 10000, 2, 'ISNHS', 'Vigan City', 'rcarruejo@unp.edu.ph', 'd8b8ba4f3bf9d8cc7f3d148211f88cec117860abd0e476ddf5c6ea0cb65702ac', 0),
(11, '', 'Rosanne', 'Sandangsal', 'Agup', '1985-01-01', 'Female', 'Maried', '654654', 'Aa', 'Aa', 'Aa', 'A', 'A', 'College', 'A', 'A', 'A', 10000, 3, 'Afasfwer', 'A', 'rsagup@unp.edu.ph', 'bc6210ee910545a73f4d97c27aef4b572101d21cec4a321aaa7460c9055eff99', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblscholarship`
--

CREATE TABLE IF NOT EXISTS `tblscholarship` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `average` double NOT NULL,
  `scholar_type` varchar(80) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `sy` varchar(9) NOT NULL,
  `no_of_units` tinyint(4) NOT NULL,
  `no_of_subjects` tinyint(4) NOT NULL,
  `yr_level` tinyint(1) NOT NULL,
  `coll_id` int(11) NOT NULL,
  `cour_id` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  PRIMARY KEY (`aid`),
  UNIQUE KEY `sid` (`sid`,`semester`,`sy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `tblscholarship`
--

INSERT INTO `tblscholarship` (`aid`, `sid`, `rid`, `average`, `scholar_type`, `semester`, `sy`, `no_of_units`, `no_of_subjects`, `yr_level`, `coll_id`, `cour_id`, `approved`) VALUES
(40, 1, 0, 2, '1', '1', '2014-2015', 3, 1, 2, 2, 1, 0),
(41, 1, 0, 0, '5', '2', '2014-2015', 3, 1, 3, 1, 5, 1),
(42, 11, 0, 1.5833333333333, '2', '1', '2014-2015', 21, 8, 1, 2, 1, 0),
(43, 11, 0, 0, '1', '2', '2014-2015', 7, 3, 2, 2, 3, 0),
(44, 11, 0, 0, '2', '3', '2014-2015', 5, 2, 2, 2, 1, 0),
(45, 11, 0, 0, '2', '1', '2015-2016', 3, 1, 2, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblscholar_type`
--

CREATE TABLE IF NOT EXISTS `tblscholar_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tblscholar_type`
--

INSERT INTO `tblscholar_type` (`id`, `type`) VALUES
(1, 'Dean''s List'),
(2, 'College'),
(5, 'Provincial Scholar'),
(6, 'Santa Municipal Scholarship'),
(7, 'City Scholar');

-- --------------------------------------------------------

--
-- Table structure for table `tblsessions`
--

CREATE TABLE IF NOT EXISTS `tblsessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  `user_name` varchar(100) NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsessions`
--

INSERT INTO `tblsessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`, `user_name`) VALUES
('a2dd974f47256fcd2ccd1eb2d2132d1d', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.91 Safari/537.36', 1422200254, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbltype_requirement`
--

CREATE TABLE IF NOT EXISTS `tbltype_requirement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `requ_name` varchar(100) NOT NULL,
  `ok` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbltype_requirement`
--

INSERT INTO `tbltype_requirement` (`id`, `type_id`, `requ_name`, `ok`) VALUES
(4, 5, 'cert of good moral', 0),
(5, 5, 'cert from provincial office', 0),
(6, 6, 'Certficate of Good Moral', 0),
(7, 1, 'cert of good moral character', 0),
(8, 1, 'certification from the dean', 0),
(9, 1, 'Certificate of grades', 0),
(10, 2, 'cert of good moral', 0),
(11, 2, 'certificate of grades', 0),
(12, 7, 'Cert of good moral', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(70) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `access_level` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `username`, `password`, `fname`, `mname`, `lname`, `access_level`) VALUES
(4, 'juandelacruz', 'd431e57fe8ba0419bd4500b702a42a5edd6c5f84d645fa6d4bf88a09abc6e0cb4dm1n', 'Juan', 'Pinoy', 'dela cruz', 1),
(5, 'rosanne', 'e3272298de7d48fdbe2f57b60d433af1697d93a02030ee52efd2821286fec7be4dm1n', 'rosanne', 'sandangsal', 'agup', 5),
(6, 'allan', 'd7b336a4e51386df07a52409158ca7d69361600d9a51e004c1f53398f0d498f44dm1n', 'allan', 'navarro', 'donato', 4),
(7, 'richard', 'ee1128fe1e4343ea41f063559f1f4fa02f2133f1e1c098d582cb16fffcf2e39b4dm1n', 'Richard', 'corpuz', 'arruejo', 3),
(8, 'honeygirl', '6fd467f227e3e0c6823d429a40868e90f4c1d324010518e27fa0bf11a09cc1c64dm1n', 'Honey Girl', 'Aninag', 'Avo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser_college`
--

CREATE TABLE IF NOT EXISTS `tbluser_college` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbluser_college`
--

INSERT INTO `tbluser_college` (`id`, `user_id`, `college_id`) VALUES
(1, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser_grantee`
--

CREATE TABLE IF NOT EXISTS `tbluser_grantee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbluser_grantee`
--

INSERT INTO `tbluser_grantee` (`id`, `user_id`, `type_id`) VALUES
(2, 4, 1),
(3, 8, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_scholar_grade`
--
CREATE TABLE IF NOT EXISTS `view_scholar_grade` (
`scholar_id` tinyint(4)
,`scholarship_id` int(11)
,`stud_No` varchar(10)
,`fname` varchar(80)
,`mname` varchar(80)
,`lname` varchar(80)
,`birthdate` date
,`gender` varchar(10)
,`civil_status` varchar(15)
,`contact_no` varchar(15)
,`brgy` varchar(30)
,`town` varchar(30)
,`prov` varchar(30)
,`fa_name` varchar(80)
,`fa_occup` varchar(20)
,`fa_educ` varchar(20)
,`mo_name` varchar(80)
,`mo_occup` varchar(20)
,`mo_educ` varchar(20)
,`com_mon_inc` double
,`no_of_chil` tinyint(4)
,`school_grad` varchar(40)
,`addr_school` varchar(60)
,`email` varchar(150)
,`pass` varchar(128)
,`aid` int(11)
,`average` double
,`scholar_type` varchar(80)
,`semester` varchar(20)
,`sy` varchar(9)
,`no_of_units` tinyint(4)
,`no_of_subjects` tinyint(4)
,`yr_level` tinyint(1)
,`college_id` int(11)
,`cour_id` int(11)
,`course` varchar(20)
,`desc` varchar(100)
,`gid` int(11)
,`sub_code` varchar(10)
,`sub_desc` varchar(50)
,`unit` int(11)
,`mg` double
,`fg` double
,`school_year` varchar(11)
,`sem` varchar(3)
);
-- --------------------------------------------------------

--
-- Structure for view `view_scholar_grade`
--
DROP TABLE IF EXISTS `view_scholar_grade`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_scholar_grade` AS select `tblscholar`.`id` AS `scholar_id`,`tblscholarship`.`aid` AS `scholarship_id`,`tblscholar`.`stud_No` AS `stud_No`,`tblscholar`.`fname` AS `fname`,`tblscholar`.`mname` AS `mname`,`tblscholar`.`lname` AS `lname`,`tblscholar`.`birthdate` AS `birthdate`,`tblscholar`.`gender` AS `gender`,`tblscholar`.`civil_status` AS `civil_status`,`tblscholar`.`contact_no` AS `contact_no`,`tblscholar`.`brgy` AS `brgy`,`tblscholar`.`town` AS `town`,`tblscholar`.`prov` AS `prov`,`tblscholar`.`fa_name` AS `fa_name`,`tblscholar`.`fa_occup` AS `fa_occup`,`tblscholar`.`fa_educ` AS `fa_educ`,`tblscholar`.`mo_name` AS `mo_name`,`tblscholar`.`mo_occup` AS `mo_occup`,`tblscholar`.`mo_educ` AS `mo_educ`,`tblscholar`.`com_mon_inc` AS `com_mon_inc`,`tblscholar`.`no_of_chil` AS `no_of_chil`,`tblscholar`.`school_grad` AS `school_grad`,`tblscholar`.`addr_school` AS `addr_school`,`tblscholar`.`email` AS `email`,`tblscholar`.`pass` AS `pass`,`tblscholarship`.`aid` AS `aid`,`tblscholarship`.`average` AS `average`,`tblscholarship`.`scholar_type` AS `scholar_type`,`tblscholarship`.`semester` AS `semester`,`tblscholarship`.`sy` AS `sy`,`tblscholarship`.`no_of_units` AS `no_of_units`,`tblscholarship`.`no_of_subjects` AS `no_of_subjects`,`tblscholarship`.`yr_level` AS `yr_level`,`tblcollege`.`id` AS `college_id`,`tblscholarship`.`cour_id` AS `cour_id`,`tblcourse`.`course` AS `course`,`tblcourse`.`desc` AS `desc`,`tblgrade`.`gid` AS `gid`,`tblgrade`.`sub_code` AS `sub_code`,`tblgrade`.`sub_desc` AS `sub_desc`,`tblgrade`.`unit` AS `unit`,`tblgrade`.`mg` AS `mg`,`tblgrade`.`fg` AS `fg`,`tblgrade`.`school_year` AS `school_year`,`tblgrade`.`sem` AS `sem` from (`tblgrade` join ((`tblscholarship` join `tblscholar` on((`tblscholarship`.`sid` = `tblscholar`.`id`))) join (`tblcourse` join `tblcollege` on((`tblcollege`.`id` = `tblcourse`.`coll_id`))) on((`tblscholarship`.`cour_id` = `tblcourse`.`id`))) on((`tblgrade`.`sid` = `tblscholarship`.`aid`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
