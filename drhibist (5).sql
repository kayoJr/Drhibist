-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2023 at 07:39 AM
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
-- Database: `drhibist`
--

-- --------------------------------------------------------

--
-- Table structure for table `abdominal`
--

CREATE TABLE `abdominal` (
  `id` int(255) NOT NULL,
  `liver` varchar(500) DEFAULT NULL,
  `gb` varchar(500) DEFAULT NULL,
  `bowel` varchar(500) DEFAULT NULL,
  `kidney` varchar(500) DEFAULT NULL,
  `pelvic` varchar(500) DEFAULT NULL,
  `impression` varchar(500) DEFAULT NULL,
  `conclusion` varchar(5000) NOT NULL,
  `drname` varchar(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `abdominal`
--

INSERT INTO `abdominal` (`id`, `liver`, `gb`, `bowel`, `kidney`, `pelvic`, `impression`, `conclusion`, `drname`, `patient_id`, `date`) VALUES
(1, 'Liver is normal\r\n																																																																																																			', 'GB is normal\r\n																																																																																											', 'GB is normal\r\n																																																																																											', 'Kidneys:  Both kidneys have normal size, shape and position.\r\n\r\n																																																																																																			', 'Urinary bladder: well distended with echo free and normal wall thickness.\r\n																																																																																											', 'this is my impression																																																																																				', 'this is my conclusion																																																																																								', 'Kaleb', 9, '2022-12-25'),
(2, 'Liver is normal in size and has homogeneous echo pattern. It has smooth contour and no focal lesion seen. The portal and hepatic veins are also normal. \r\nSpleen:  is normal in size and echopattern.\r\n											', 'GB is normal in size and wall thickness. No intraluminal mass lesion or stone seen. Both the intra and extra-hepatic biliary ducts are normal in caliber size.\r\n											', 'Bowels appear normal in caliber size and wall thickness. No mass lesion seen. \r\nNo free fluid collection in the peritoneal cavity.\r\n											', 'Kidneys:  Both kidneys have normal size, shape and position. They have normal parenchymal echopattern. No mass lesion seen. No renal stone or dilatation of the pelvicalyceal system seen.\r\nPancreas is normal in size, it has homogeneous echo. No focal lesion, calcifications or dilatation of the duct seen. \r\nThe abdominal aorta and IVC are also normal in caliber. No para-aortic lymphadenopathy seen.\r\n\r\n											', 'Urinary bladder: well distended with echo free and normal wall thickness.\r\n											', '', '', 'Ultrasound', 1, '2023-01-13'),
(3, 'Liver is normal in size and has homogeneous echo pattern. It has smooth contour and no focal lesion seen. The portal and hepatic veins are also normal. \r\nSpleen:  is normal in size and echopattern.\r\n											', 'GB is normal in size and wall thickness. No intraluminal mass lesion or stone seen. Both the intra and extra-hepatic biliary ducts are normal in caliber size.\r\n											', 'Bowels appear normal in caliber size and wall thickness. No mass lesion seen. \r\nNo free fluid collection in the peritoneal cavity.\r\n											', 'Kidneys:  Both kidneys have normal size, shape and position. They have normal parenchymal echopattern. No mass lesion seen. No renal stone or dilatation of the pelvicalyceal system seen.\r\nPancreas is normal in size, it has homogeneous echo. No focal lesion, calcifications or dilatation of the duct seen. \r\nThe abdominal aorta and IVC are also normal in caliber. No para-aortic lymphadenopathy seen.\r\n\r\n											', 'Urinary bladder: well distended with echo free and normal wall thickness.\r\n											', '', 'not sick', 'Ultrasound', 12, '2023-01-26'),
(4, 'Liver is normal in size and has homogeneous echo pattern. It has smooth contour and no focal lesion seen. The portal and hepatic veins are also normal. \r\nSpleen:  is normal in size and echopattern.\r\n											', 'GB is normal in size and wall thickness. No intraluminal mass lesion or stone seen. Both the intra and extra-hepatic biliary ducts are normal in caliber size.\r\n											', 'Bowels appear normal in caliber size and wall thickness. No mass lesion seen. \r\nNo free fluid collection in the peritoneal cavity.\r\n											', 'Kidneys:  Both kidneys have normal size, shape and position. They have normal parenchymal echopattern. No mass lesion seen. No renal stone or dilatation of the pelvicalyceal system seen.\r\nPancreas is normal in size, it has homogeneous echo. No focal lesion, calcifications or dilatation of the duct seen. \r\nThe abdominal aorta and IVC are also normal in caliber. No para-aortic lymphadenopathy seen.\r\n\r\n											', 'Urinary bladder: well distended with echo free and normal wall thickness.\r\n											', '', 'SICK', 'Ultrasound', 12, '2023-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `id` int(50) NOT NULL,
  `pat_id` int(50) NOT NULL,
  `pat_phone` int(50) NOT NULL,
  `doc_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`id`, `pat_id`, `pat_phone`, `doc_id`, `date`) VALUES
(6, 9, 905611207, 1234567, '2022-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `admission_det`
--

CREATE TABLE `admission_det` (
  `id` int(50) NOT NULL,
  `detail` varchar(5000) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_det`
--

INSERT INTO `admission_det` (`id`, `detail`, `patient_id`, `date`) VALUES
(1, 'check the patients status', 1, '2022-12-09 23:41:01');

-- --------------------------------------------------------

--
-- Table structure for table `admission_med`
--

CREATE TABLE `admission_med` (
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `price` double NOT NULL,
  `amount` int(50) NOT NULL,
  `tot_amount` double NOT NULL,
  `patient_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_med`
--

INSERT INTO `admission_med` (`id`, `name`, `type`, `price`, `amount`, `tot_amount`, `patient_id`, `date`) VALUES
(4, 'cefexime (bactofix)100/5ml', ' syp', 400, 2, 800, 9, '2022-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `admission_pay`
--

CREATE TABLE `admission_pay` (
  `id` int(50) NOT NULL,
  `price` int(50) NOT NULL,
  `reason` varchar(250) NOT NULL,
  `pat_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_pay`
--

INSERT INTO `admission_pay` (`id`, `price`, `reason`, `pat_id`, `date`) VALUES
(1, 100, 'laboratory', 2, '2022-12-09'),
(2, 100, 'ultrasound', 2, '2022-12-09'),
(3, 800, 'ultrasound', 1, '2022-12-12'),
(4, 800, 'ultrasound', 9, '2022-12-25'),
(5, 300, 'laboratory', 9, '2022-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `afb_sputum`
--

CREATE TABLE `afb_sputum` (
  `id` int(111) NOT NULL,
  `patient_id` int(111) NOT NULL,
  `SPOT` varchar(111) DEFAULT NULL,
  `MORNING` varchar(111) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `afb_sputum`
--

INSERT INTO `afb_sputum` (`id`, `patient_id`, `SPOT`, `MORNING`, `date`) VALUES
(18, 1, '1', '11', '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `bf`
--

CREATE TABLE `bf` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `bf` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bf`
--

INSERT INTO `bf` (`id`, `patient_id`, `bf`, `date`) VALUES
(1, 3, 4, '0000-00-00'),
(2, 3, 21, '0000-00-00'),
(3, 3, 4, '0000-00-00'),
(4, 3, 3, '2022-12-02'),
(5, 3, 2, '2022-12-03'),
(6, 1, 32, '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `bg`
--

CREATE TABLE `bg` (
  `id` int(111) NOT NULL,
  `patient_id` int(111) NOT NULL,
  `bg` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bg`
--

INSERT INTO `bg` (`id`, `patient_id`, `bg`, `date`) VALUES
(1, 3, 'A+', '2022-11-27'),
(2, 2, 'A', '2022-11-29'),
(3, 3, 'A', '2022-12-02'),
(4, 3, 'A', '2022-12-02'),
(5, 3, 'A', '2022-12-02'),
(6, 3, 'A', '2022-12-02'),
(7, 3, 'A', '2022-12-03'),
(8, 1, 'B+', '2022-12-06'),
(9, 1, 'A', '2023-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `breast`
--

CREATE TABLE `breast` (
  `id` int(11) NOT NULL,
  `result` varchar(500) DEFAULT NULL,
  `impression` varchar(500) DEFAULT NULL,
  `conclusion` varchar(5000) NOT NULL,
  `drname` varchar(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `breast`
--

INSERT INTO `breast` (`id`, `result`, `impression`, `conclusion`, `drname`, `patient_id`, `date`) VALUES
(1, 'Normal chest wall\r\n\r\n\r\n																																												', 'good condition											', '																																	', 'Kaleb', 9, '2022-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `rn` int(50) NOT NULL,
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quant` int(50) NOT NULL,
  `sub_price` decimal(10,0) NOT NULL,
  `pat_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_adm`
--

CREATE TABLE `cart_adm` (
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `price` int(250) NOT NULL,
  `quant` int(50) NOT NULL,
  `sub_price` int(250) NOT NULL,
  `pat_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_payment_pharm`
--

CREATE TABLE `cash_payment_pharm` (
  `rn` int(50) NOT NULL,
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `quan` int(50) NOT NULL,
  `sub_price` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cmc_ps`
--

CREATE TABLE `cmc_ps` (
  `id` int(111) NOT NULL,
  `patient_id` int(111) NOT NULL,
  `filename` varchar(111) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cmc_ps`
--

INSERT INTO `cmc_ps` (`id`, `patient_id`, `filename`, `date`) VALUES
(17, 1, 'Screenshot (24).png', '2022-12-06'),
(18, 1, 'Screenshot (25).png', '2023-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `coagulation`
--

CREATE TABLE `coagulation` (
  `id` int(111) NOT NULL,
  `patient_id` int(111) NOT NULL,
  `PT` varchar(111) NOT NULL,
  `PTT` varchar(111) NOT NULL,
  `INR` varchar(111) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `coagulation`
--

INSERT INTO `coagulation` (`id`, `patient_id`, `PT`, `PTT`, `INR`, `date`) VALUES
(7, 1, '12', '21', '21', '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

CREATE TABLE `credit` (
  `id` int(250) NOT NULL,
  `price` int(250) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `status` int(50) NOT NULL DEFAULT 0,
  `pat_id` int(255) NOT NULL,
  `org` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credit`
--

INSERT INTO `credit` (`id`, `price`, `reason`, `status`, `pat_id`, `org`, `date`) VALUES
(4, 100, 'laboratory', 1, 1, 'stc', '2022-12-29'),
(5, 100, 'reception', 1, 1, 'stc', '2022-12-29'),
(6, 100, 'reception', 1, 1, 'cigna', '2022-12-29'),
(7, 300, 'laboratory', 0, 1, 'cigna', '2022-12-29'),
(8, 100, 'reception', 1, 1, 'stc', '2022-12-16'),
(9, 800, 'ultrasound', 1, 1, 'cigna', '2022-12-16'),
(10, 1500, 'withdrawal', 1, 1, 'stc', '2022-12-16'),
(18, 550, 'pharmacy', 1, 1, 'stc', '2022-12-16'),
(19, 400, 'ultrasound', 0, 1, 'cigna', '2023-01-09'),
(20, 300, 'laboratory', 0, 1, 'cigna', '2023-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `credit_pharm`
--

CREATE TABLE `credit_pharm` (
  `rn` int(50) NOT NULL,
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `quan` int(50) NOT NULL,
  `sub_price` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `org` varchar(500) NOT NULL,
  `status` int(50) NOT NULL DEFAULT 0,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credit_pharm`
--

INSERT INTO `credit_pharm` (`rn`, `id`, `name`, `type`, `price`, `quan`, `sub_price`, `patient_id`, `org`, `status`, `date`) VALUES
(1, 1, 'cefexime (bactofix)100/5ml', ' syp', 400, 2, 800, 1, 'cigna', 0, '2023-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `crp`
--

CREATE TABLE `crp` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `crp` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crp`
--

INSERT INTO `crp` (`id`, `patient_id`, `crp`, `date`) VALUES
(1, 1, 12, '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `csf`
--

CREATE TABLE `csf` (
  `id` int(250) NOT NULL,
  `patient_id` int(250) NOT NULL,
  `appearance` varchar(500) NOT NULL,
  `gravity` varchar(500) NOT NULL,
  `ldh` varchar(500) NOT NULL,
  `glucose` varchar(500) NOT NULL,
  `protein` varchar(500) NOT NULL,
  `cells` varchar(500) NOT NULL,
  `ep_cells` varchar(500) NOT NULL,
  `wbc` varchar(500) NOT NULL,
  `koh` varchar(500) NOT NULL,
  `wet` varchar(500) NOT NULL,
  `gram_stain` varchar(500) NOT NULL,
  `afb` varchar(500) NOT NULL,
  `indian` varchar(500) NOT NULL,
  `vdrl` varchar(500) NOT NULL,
  `rbc` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `esr`
--

CREATE TABLE `esr` (
  `id` int(111) NOT NULL,
  `patient_id` varchar(111) NOT NULL,
  `ESR` int(111) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `esr`
--

INSERT INTO `esr` (`id`, `patient_id`, `ESR`, `date`) VALUES
(1, '1', 12, '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `fbs`
--

CREATE TABLE `fbs` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `fbs` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fbs`
--

INSERT INTO `fbs` (`id`, `patient_id`, `fbs`, `date`) VALUES
(1, 1, 12, '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `gram_stain`
--

CREATE TABLE `gram_stain` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `gram_stain` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gram_stain`
--

INSERT INTO `gram_stain` (`id`, `patient_id`, `gram_stain`, `date`) VALUES
(1, 1, 12, '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `hpylori`
--

CREATE TABLE `hpylori` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `hpylori_ag` varchar(250) NOT NULL,
  `hpylori_ab` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hpylori`
--

INSERT INTO `hpylori` (`id`, `patient_id`, `hpylori_ag`, `hpylori_ab`, `date`) VALUES
(8, 12, '', 'ab', '2023-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `hylori_ag`
--

CREATE TABLE `hylori_ag` (
  `id` int(250) NOT NULL,
  `patient_id` int(250) NOT NULL,
  `hpylori_ag` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hylori_ag`
--

INSERT INTO `hylori_ag` (`id`, `patient_id`, `hpylori_ag`, `date`) VALUES
(1, 12, 'ag', '2023-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(111) NOT NULL,
  `price` int(50) NOT NULL,
  `reason` varchar(250) NOT NULL,
  `pat_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `price`, `reason`, `pat_id`, `date`) VALUES
(2, 100, 'reception', 0, '2023-01-15'),
(3, 200, 'laboratory', 0, '2022-12-04'),
(4, 100, 'reception', 0, '2023-01-15'),
(5, 1000, 'laboratory', 0, '2023-01-15'),
(6, 200, 'laboratory', 0, '2022-12-05'),
(7, 100, 'reception', 0, '2023-01-15'),
(8, 100, 'reception', 0, '2023-01-15'),
(9, 100, 'reception', 0, '2023-01-15'),
(10, 100, 'reception', 0, '2023-01-15'),
(11, 1100, 'laboratory', 0, '2022-12-06'),
(12, 100, 'laboratory', 0, '2023-01-15'),
(13, 1100, 'laboratory', 0, '2022-12-06'),
(14, 1100, 'laboratory', 0, '2022-12-06'),
(15, 100, 'laboratory', 0, '2023-01-15'),
(16, 5350, 'laboratory', 0, '2022-12-06'),
(17, 200, 'laboratory', 0, '2022-12-06'),
(18, 200, 'laboratory', 0, '2022-12-06'),
(19, 400, 'laboratory', 0, '2022-12-07'),
(20, 600, 'ultrasound', 0, '2022-12-08'),
(21, 800, 'ultrasound', 0, '2022-12-09'),
(22, 1600, 'ultrasound', 0, '2022-12-09'),
(23, 1900, 'credit', 0, '2022-12-09'),
(24, 1900, 'credit', 0, '2022-12-09'),
(25, 1900, 'credit', 0, '2022-12-09'),
(26, 1900, 'credit', 0, '2022-12-09'),
(27, 1900, 'credit', 0, '2022-12-09'),
(28, 1900, 'credit', 0, '2022-12-09'),
(29, 350, 'credit', 0, '2022-12-09'),
(30, 350, 'credit', 0, '2022-12-09'),
(31, 350, 'credit', 0, '2022-12-09'),
(32, 100, 'reception', 0, '2023-01-15'),
(33, 100, 'reception', 0, '2023-01-15'),
(35, 16200, 'withdrawal', 9, '2022-12-25'),
(36, 100, 'reception', 0, '2023-01-15'),
(37, 100, 'reception', 0, '2023-01-15'),
(38, 0, 'laboratory', 0, '2022-12-12'),
(39, 800, 'laboratory', 0, '2022-12-13'),
(40, 400, 'reception', 9, '2022-12-26'),
(41, 200, 'laboratory', 9, '2022-12-26'),
(42, 400, 'credit', 0, '2022-12-17'),
(43, 3150, 'credit', 0, '2022-12-17'),
(44, 3150, 'credit', 0, '2022-12-17'),
(45, 3150, 'credit', 0, '2022-12-17'),
(46, 400, 'credit', 0, '2022-12-17'),
(47, 400, 'credit', 0, '2022-12-17'),
(48, 400, 'credit', 0, '2022-12-17'),
(49, 400, 'credit', 0, '2022-12-17'),
(50, 400, 'credit', 0, '2022-12-17'),
(51, 400, 'credit', 0, '2022-12-17'),
(52, 400, 'credit', 0, '2022-12-17'),
(53, 3150, 'credit', 0, '2022-12-17'),
(54, 3150, 'credit', 0, '2022-12-17'),
(55, 3150, 'credit', 0, '2022-12-17'),
(56, 3150, 'credit', 0, '2022-12-17'),
(57, 3150, 'credit', 0, '2022-12-17'),
(58, 3150, 'credit', 0, '2022-12-17'),
(59, 3150, 'credit', 0, '2022-12-17'),
(60, 3150, 'credit', 0, '2022-12-17'),
(61, 3150, 'credit', 0, '2022-12-17'),
(62, 3150, 'credit', 0, '2022-12-17'),
(63, 3150, 'credit', 0, '2022-12-17'),
(64, 3150, 'credit', 0, '2022-12-17'),
(65, 3150, 'credit', 0, '2022-12-17'),
(66, 3150, 'credit', 0, '2022-12-17'),
(67, 3150, 'credit', 0, '2022-12-17'),
(68, 3150, 'credit', 0, '2022-12-17'),
(69, 3150, 'credit', 0, '2022-12-17'),
(70, 3150, 'credit', 0, '2022-12-17'),
(71, 3150, 'credit', 0, '2022-12-17'),
(72, 3150, 'credit', 0, '2022-12-17'),
(73, 3150, 'credit', 0, '2022-12-17'),
(74, 3150, 'credit', 0, '2022-12-17'),
(75, 3150, 'credit', 0, '2022-12-17'),
(76, 3150, 'credit', 0, '2022-12-17'),
(77, 3150, 'credit', 0, '2022-12-17'),
(78, 3150, 'credit', 0, '2022-12-17'),
(79, 3150, 'credit', 0, '2022-12-17'),
(80, 3150, 'credit', 0, '2022-12-17'),
(81, 3150, 'credit', 0, '2022-12-17'),
(82, 3150, 'credit', 0, '2022-12-17'),
(83, 3150, 'credit', 0, '2022-12-17'),
(84, 3150, 'credit', 0, '2022-12-17'),
(85, 3150, 'credit', 0, '2022-12-17'),
(86, 3150, 'credit', 0, '2022-12-17'),
(87, 3150, 'credit', 0, '2022-12-17'),
(88, 3150, 'credit', 0, '2022-12-17'),
(89, 3150, 'credit', 0, '2022-12-17'),
(90, 3150, 'credit', 0, '2022-12-17'),
(91, 3150, 'credit', 0, '2022-12-17'),
(92, 3150, 'credit', 0, '2022-12-17'),
(93, 3150, 'credit', 0, '2022-12-17'),
(94, 3150, 'credit', 0, '2022-12-17'),
(95, 3150, 'credit', 0, '2022-12-17'),
(96, 3150, 'credit', 0, '2022-12-17'),
(97, 3150, 'credit', 0, '2022-12-17'),
(98, 3150, 'credit', 0, '2022-12-17'),
(99, 3150, 'credit', 0, '2022-12-17'),
(100, 3150, 'credit', 0, '2022-12-17'),
(101, 3150, 'credit', 0, '2022-12-17'),
(102, 3150, 'credit', 0, '2022-12-17'),
(103, 3150, 'credit', 0, '2022-12-17'),
(104, 3150, 'credit', 0, '2022-12-17'),
(105, 3150, 'credit', 0, '2022-12-17'),
(106, 3150, 'credit', 0, '2022-12-17'),
(107, 3150, 'credit', 0, '2022-12-17'),
(108, 3150, 'credit', 0, '2022-12-17'),
(109, 3150, 'credit', 0, '2022-12-17'),
(110, 3150, 'credit', 0, '2022-12-17'),
(111, 3150, 'credit', 0, '2022-12-17'),
(112, 3150, 'credit', 0, '2022-12-17'),
(113, 3150, 'credit', 0, '2022-12-17'),
(114, 3150, 'credit', 0, '2022-12-17'),
(115, 3150, 'credit', 0, '2022-12-17'),
(116, 3150, 'credit', 0, '2022-12-17'),
(117, 3150, 'credit', 0, '2022-12-17'),
(118, 3150, 'credit', 0, '2022-12-17'),
(119, 3150, 'credit', 0, '2022-12-17'),
(120, 3150, 'credit', 0, '2022-12-17'),
(121, 3150, 'credit', 0, '2022-12-17'),
(122, 3150, 'credit', 0, '2022-12-17'),
(123, 3150, 'credit', 0, '2022-12-17'),
(124, 3150, 'credit', 0, '2022-12-17'),
(125, 3150, 'credit', 0, '2022-12-17'),
(126, 3150, 'credit', 0, '2022-12-17'),
(127, 3150, 'credit', 0, '2022-12-17'),
(128, 3150, 'credit', 0, '2022-12-17'),
(129, 3150, 'credit', 0, '2022-12-17'),
(130, 3150, 'credit', 0, '2022-12-17'),
(131, 3150, 'credit', 0, '2022-12-17'),
(132, 3150, 'credit', 0, '2022-12-17'),
(133, 3150, 'credit', 0, '2022-12-17'),
(134, 3150, 'credit', 0, '2022-12-17'),
(135, 3150, 'credit', 0, '2022-12-17'),
(136, 3150, 'credit', 0, '2022-12-17'),
(137, 3150, 'credit', 0, '2022-12-17'),
(138, 3150, 'credit', 0, '2022-12-17'),
(139, 3150, 'credit', 0, '2022-12-17'),
(140, 3150, 'credit', 0, '2022-12-17'),
(141, 3150, 'credit', 0, '2022-12-17'),
(142, 3150, 'credit', 0, '2022-12-17'),
(143, 3150, 'credit', 0, '2022-12-17'),
(144, 3150, 'credit', 0, '2022-12-17'),
(145, 3150, 'credit', 0, '2022-12-17'),
(146, 3150, 'credit', 0, '2022-12-17'),
(147, 3150, 'credit', 0, '2022-12-17'),
(148, 3150, 'credit', 0, '2022-12-17'),
(149, 3150, 'credit', 0, '2022-12-17'),
(150, 3150, 'credit', 0, '2022-12-17'),
(151, 3150, 'credit', 0, '2022-12-17'),
(152, 3150, 'credit', 0, '2022-12-17'),
(153, 3150, 'credit', 0, '2022-12-17'),
(154, 3150, 'credit', 0, '2022-12-17'),
(155, 3150, 'credit', 0, '2022-12-17'),
(156, 3150, 'credit', 0, '2022-12-17'),
(157, 3150, 'credit', 0, '2022-12-17'),
(158, 3150, 'credit', 0, '2022-12-17'),
(159, 3150, 'credit', 0, '2022-12-17'),
(160, 3150, 'credit', 0, '2022-12-17'),
(161, 3150, 'credit', 0, '2022-12-17'),
(162, 3150, 'credit', 0, '2022-12-17'),
(163, 3150, 'credit', 0, '2022-12-17'),
(164, 3150, 'credit', 0, '2022-12-17'),
(165, 3150, 'credit', 0, '2022-12-17'),
(166, 3150, 'credit', 0, '2022-12-17'),
(167, 3150, 'credit', 0, '2022-12-17'),
(168, 3150, 'credit', 0, '2022-12-17'),
(169, 3150, 'credit', 0, '2022-12-17'),
(170, 3150, 'credit', 0, '2022-12-17'),
(171, 3150, 'credit', 0, '2022-12-17'),
(172, 3150, 'credit', 0, '2022-12-17'),
(173, 3150, 'credit', 0, '2022-12-17'),
(174, 3150, 'credit', 0, '2022-12-17'),
(175, 3150, 'credit', 0, '2022-12-17'),
(176, 3150, 'credit', 0, '2022-12-17'),
(177, 3150, 'credit', 0, '2022-12-17'),
(178, 3150, 'credit', 0, '2022-12-17'),
(179, 3150, 'credit', 0, '2022-12-17'),
(180, 3150, 'credit', 0, '2022-12-17'),
(181, 3150, 'credit', 0, '2022-12-17'),
(182, 3150, 'credit', 0, '2022-12-17'),
(183, 3150, 'credit', 0, '2022-12-17'),
(184, 3150, 'credit', 0, '2022-12-17'),
(185, 3150, 'credit', 0, '2022-12-17'),
(186, 3150, 'credit', 0, '2022-12-17'),
(187, 3150, 'credit', 0, '2022-12-17'),
(188, 3150, 'credit', 0, '2022-12-17'),
(189, 3150, 'credit', 0, '2022-12-17'),
(190, 3150, 'credit', 0, '2022-12-17'),
(191, 3150, 'credit', 0, '2022-12-17'),
(192, 3150, 'credit', 0, '2022-12-17'),
(193, 3150, 'credit', 0, '2022-12-17'),
(194, 3150, 'credit', 0, '2022-12-17'),
(195, 3150, 'credit', 0, '2022-12-17'),
(196, 3150, 'credit', 0, '2022-12-17'),
(197, 3150, 'credit', 0, '2022-12-17'),
(198, 400, 'credit', 0, '2022-12-17'),
(199, 400, 'credit', 0, '2022-12-17'),
(200, 400, 'credit', 0, '2022-12-17'),
(201, 3150, 'credit', 0, '2022-12-17'),
(202, 1200, 'ultrasound', 0, '2022-12-22'),
(203, 2000, 'ultrasound', 0, '2022-12-24'),
(204, 1900, 'ultrasound', 9, '2022-12-26'),
(205, 14760, 'withdrawal', 1, '2022-12-25'),
(206, 400, 'laboratory', 9, '0000-00-00'),
(207, 500, 'ultrasound', 9, '0000-00-00'),
(211, 3150, 'stc', 0, '2022-12-29'),
(213, 400, 'cigna', 0, '2022-12-29'),
(214, 130, 'stc', 0, '2022-12-29'),
(215, 865, 'cigna', 0, '2022-12-29'),
(216, 800, 'ultrasound', 0, '2022-12-29'),
(217, 600, 'laboratory', 0, '2023-01-08'),
(218, 500, 'procedure', 0, '2023-01-11'),
(219, 350, 'laboratory', 1, '2023-01-11'),
(220, 350, 'laboratory', 1, '2023-01-11'),
(221, 300, 'laboratory', 12, '2023-01-10'),
(222, 100, 'laboratory', 12, '2023-01-15'),
(223, 400, 'ultrasound', 12, '2023-01-26'),
(224, 400, 'ultrasound', 12, '2023-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

CREATE TABLE `laboratory` (
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` int(50) NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`id`, `name`, `price`) VALUES
(1, 'CBC', 200),
(2, 'Blood_Group', 100),
(3, 'ESR', 200),
(4, 'STOOL', 100),
(5, 'Urinalysis', 100),
(6, 'FBS_RBS', 100),
(7, 'Uric_Acid', 100),
(8, 'LET', 300),
(9, 'LFT', 300),
(10, 'RFT', 200),
(11, 'Serum', 500),
(12, 'CRP', 500),
(13, 'TFT', 600),
(14, 'Coagulation_Profile', 500),
(15, 'Gram_Stain', 200),
(16, 'AFB_Sputum', 100),
(17, 'PICT', 100),
(18, 'VDRL', 100),
(19, 'RPR', 100),
(20, 'Widal_H', 100),
(21, 'Widal_O', 100),
(22, 'Weil_Felix', 100),
(23, 'liver_viral', 200),
(24, 'h_pylori_ab', 175),
(25, 'blood_f', 100),
(26, 'csf_analysis', 600),
(27, 'h_pylori_ag', 175);

-- --------------------------------------------------------

--
-- Table structure for table `lab_cart`
--

CREATE TABLE `lab_cart` (
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` int(50) NOT NULL DEFAULT 100,
  `patient_id` int(50) NOT NULL,
  `doctor_id` int(50) NOT NULL,
  `payment` int(50) NOT NULL DEFAULT 0,
  `status` int(50) NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_cart`
--

INSERT INTO `lab_cart` (`id`, `name`, `price`, `patient_id`, `doctor_id`, `payment`, `status`, `date`) VALUES
(22, 'Urinanalysis', 100, 1, 7, 1, 0, '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `lab_cart2`
--

CREATE TABLE `lab_cart2` (
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `doctor_id` int(50) NOT NULL,
  `payment` int(50) NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_cart2`
--

INSERT INTO `lab_cart2` (`id`, `name`, `price`, `patient_id`, `doctor_id`, `payment`, `date`) VALUES
(31, 'CBC', 200, 2, 0, 0, '2023-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `lab_message`
--

CREATE TABLE `lab_message` (
  `id` int(50) NOT NULL,
  `detail` varchar(5000) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `status` int(50) NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_message`
--

INSERT INTO `lab_message` (`id`, `detail`, `patient_id`, `status`, `date`) VALUES
(2, 'serious attention needed', 9, 0, '2022-12-26');

-- --------------------------------------------------------

--
-- Table structure for table `lab_req`
--

CREATE TABLE `lab_req` (
  `id` int(11) NOT NULL,
  `hematology` varchar(500) NOT NULL,
  `chemistry` varchar(500) NOT NULL,
  `stool` varchar(500) NOT NULL,
  `special` varchar(500) NOT NULL,
  `serum` varchar(500) NOT NULL,
  `urinalysis` varchar(500) NOT NULL,
  `bacteriology` varchar(500) NOT NULL,
  `sputum` varchar(500) NOT NULL,
  `microscopy` varchar(500) NOT NULL,
  `serology` varchar(500) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `payment` int(50) NOT NULL DEFAULT 0,
  `doctor_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_req`
--

INSERT INTO `lab_req` (`id`, `hematology`, `chemistry`, `stool`, `special`, `serum`, `urinalysis`, `bacteriology`, `sputum`, `microscopy`, `serology`, `patient_id`, `payment`, `doctor_id`, `date`) VALUES
(1, 'a:5:{i:0;s:3:\"wbc\";i:1;s:3:\"rbc\";i:2;s:3:\"mcv\";i:3;s:3:\"rdw\";i:4;s:5:\"blood\";}', 'a:2:{i:0;s:4:\"sgot\";i:1;s:3:\"alk\";}', 'a:1:{i:0;s:10:\"appearance\";}', 'a:2:{i:0;s:3:\"CRP\";i:1;s:2:\"T8\";}', 'a:1:{i:0;s:9:\"potassium\";}', 'a:3:{i:0;s:7:\"gravity\";i:1;s:7:\"protein\";i:2;s:7:\"glucose\";}', 'a:1:{i:0;s:10:\"Gram Stain\";}', 'a:1:{i:0;s:4:\"Spot\";}', 'a:2:{i:0;s:7:\"wbc/hpf\";i:1;s:8:\"bacteria\";}', 'a:2:{i:0;s:4:\"VDRL\";i:1;s:3:\"RPR\";}', 1, 0, 7, '2022-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `lab_res`
--

CREATE TABLE `lab_res` (
  `id` int(11) NOT NULL,
  `WBC` double DEFAULT NULL,
  `Lymph#` double NOT NULL,
  `Mid#` double NOT NULL,
  `Gran#` double NOT NULL,
  `Lymph%` double NOT NULL,
  `Mid%` double NOT NULL,
  `Gran%` double NOT NULL,
  `HGB` double NOT NULL,
  `RBC` double NOT NULL,
  `XXX` double NOT NULL,
  `MCV` double NOT NULL,
  `MCH` double NOT NULL,
  `MCHC` double NOT NULL,
  `RDW-CV` double NOT NULL,
  `RDW-SD` double NOT NULL,
  `PLT` double NOT NULL,
  `MPV` double NOT NULL,
  `PDW` double NOT NULL,
  `PCT` double NOT NULL,
  `pat_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `let`
--

CREATE TABLE `let` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `sgot` varchar(250) NOT NULL,
  `sgpt` varchar(250) NOT NULL,
  `alk_phos` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `let`
--

INSERT INTO `let` (`id`, `patient_id`, `sgot`, `sgpt`, `alk_phos`, `date`) VALUES
(1, 1, '12', '2', '2', '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `lft`
--

CREATE TABLE `lft` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `bt` varchar(250) NOT NULL,
  `bd` varchar(250) NOT NULL,
  `albumin` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lft`
--

INSERT INTO `lft` (`id`, `patient_id`, `bt`, `bd`, `albumin`, `date`) VALUES
(1, 1, '12', '2', '1', '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `liver_viral`
--

CREATE TABLE `liver_viral` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `hbs` varchar(250) NOT NULL,
  `hcv` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `liver_viral`
--

INSERT INTO `liver_viral` (`id`, `patient_id`, `hbs`, `hcv`, `date`) VALUES
(1, 1, '12', '1', '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `meds`
--

CREATE TABLE `meds` (
  `id` int(3) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `type` varchar(11) DEFAULT NULL,
  `amount` int(50) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `date` date DEFAULT current_timestamp(),
  `exdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `meds`
--

INSERT INTO `meds` (`id`, `name`, `type`, `amount`, `cost`, `price`, `date`, `exdate`) VALUES
(1, 'cefexime (bactofix)100/5ml', ' syp', 271, 400, 0, '2022-12-05', '2022-12-26'),
(2, 'cephalaxine (salexin- 250)', 'syp', 77, 250, 0, '0000-00-00', '2022-05-24'),
(3, 'medovent elixer', 'syp', 65, 380, 0, '0000-00-00', '2022-03-27'),
(4, 'paracetamol (denk) 125', 'supp', 486, 30, 0, '0000-00-00', '2022-03-25'),
(5, 'augmentin (klamox) 457', 'syp', 105, 420, 0, '0000-00-00', '2022-03-25'),
(6, 'augmentin (rivaclave) 457', 'syp', 89, 450, 0, '0000-00-00', '2022-05-24'),
(7, 'glycerin', 'supp', 313, 60, 0, '0000-00-00', '2022-10-24'),
(8, 'loratidine(loradine)', 'syp', 66, 200, 0, '0000-00-00', '2022-09-24'),
(9, 'amoxacillin (moxvid)250', 'tab', 103, 60, 0, '0000-00-00', '2022-12-24'),
(10, 'miconazole(mina)', 'oral jel', 25, 180, 0, '0000-00-00', '2022-04-25'),
(11, 'acyclovir (lovrak)', 'syp', 34, 350, 0, '0000-00-00', '2022-11-24'),
(12, 'salbutamol (butalin)', 'syp', 50, 150, 0, '0000-00-00', '2022-07-25'),
(13, 'cipro/dexa(zoxan)', 'eye drop', 11, 180, 0, '0000-00-00', '2022-02-24'),
(14, ' cefexim(zimaks)', 'syp', 17, 400, 0, '0000-00-00', '2022-12-25'),
(15, ' augmentin(mylan) 156', 'syp', 98, 400, 0, '0000-00-00', '2022-06-23'),
(16, 'multivitamin', 'drop', 163, 100, 0, '0000-00-00', '2022-04-24'),
(17, ' cotrimoxazole (trimol)', 'syp', 107, 150, 0, '0000-00-00', '2022-04-25'),
(18, 'zinc', 'tab', 302, 20, 0, '0000-00-00', '2022-06-23'),
(19, 'candacort', 'cream', 37, 220, 0, '0000-00-00', '2022-02-24'),
(20, 'clotrimazole (clozole)', 'cream', 15, 100, 0, '0000-00-00', '2022-10-23'),
(21, 'mebo', 'cream', 44, 450, 0, '0000-00-00', '2022-12-24'),
(22, ' zinc oxide', 'cream', 71, 90, 0, '0000-00-00', '2022-01-25'),
(23, ' medofed compound', 'syp', 104, 430, 0, '0000-00-00', '2022-11-26'),
(24, ' ors (lemlem)', '', 287, 30, 0, '0000-00-00', '2022-12-23'),
(25, ' metoclopramide(metofarm)', 'drop', 53, 100, 0, '0000-00-00', '2022-05-23'),
(26, ' momethasone(tabunex)', 'nasal spray', 8, 450, 0, '0000-00-00', '2022-05-25'),
(27, 'momethasone(nazoster)', 'nasal spray', 50, 500, 0, '0000-00-00', '2022-05-25'),
(28, 'ceftraxone im(forsef)', 'inj', 125, 220, 0, '0000-00-00', '2022-04-24'),
(29, 'ampicillin 500mg', ' tab', 153, 40, 0, '0000-00-00', '2022-12-25'),
(30, 'vancomycin(vansafe)', 'inj', 6, 350, 0, '0000-00-00', '2022-11-23'),
(31, 'hydrocortisone(galacort)', 'inj', 20, 150, 0, '0000-00-00', '2022-01-24'),
(32, 'diazepam', 'inj', 146, 200, 0, '0000-00-00', '2022-10-23'),
(33, 'adrenaline(adr)', 'inj', 95, 50, 0, '0000-00-00', '2022-08-23'),
(34, 'adrenaline', 'inj', 12, 50, 0, '0000-00-00', '2022-03-25'),
(35, 'sulbutamol(azmasol)', ' puff', 34, 330, 0, '0000-00-00', '2022-07-23'),
(36, 'cefepime(julpime)', 'inj', 50, 350, 0, '0000-00-00', '2022-12-23'),
(37, 'cefadroxil 250', 'syp', 17, 300, 0, '0000-00-00', '2022-04-23'),
(38, ' pcm(rectol) 125', 'supp', 699, 15, 0, '0000-00-00', '2022-02-24'),
(39, 'diclofenac', 'inj', 80, 20, 0, '0000-00-00', '2022-03-24'),
(40, 'albendazole(zentrise)', 'sussp', 89, 50, 0, '0000-00-00', '2022-10-24'),
(41, 'ampicillin ', 'inj', 134, 50, 0, '0000-00-00', '2022-04-23'),
(42, 'mebendazole(mebencure)', 'sussp', 60, 50, 0, '0000-00-00', '2022-03-24'),
(43, 'dextrose 40%', '', 324, 40, 0, '0000-00-00', '2022-04-23'),
(44, 'metronazole(floxagyl) 250', 'tab', 100, 30, 0, '0000-00-00', '2022-12-24'),
(45, 'eleron', 'syp', 63, 100, 0, '0000-00-00', '2022-11-23'),
(46, 'aferin', 'syp', 52, 200, 0, '0000-00-00', '2022-12-25'),
(47, 'benzyl benzonate lotion', 'lotion', 10, 100, 0, '0000-00-00', '2022-12-23'),
(48, 'multivitamin', 'tab', 35, 20, 0, '0000-00-00', '2022-03-24'),
(49, 'multivitamin', 'syp', 88, 100, 0, '0000-00-00', '2022-05-23'),
(50, 'peptica jel', 'syp', 12, 140, 0, '0000-00-00', '2022-02-24'),
(51, 'nystatin (mycosat)', 'drop', 40, 90, 0, '0000-00-00', '2022-08-23'),
(52, 'fish oil', 'syp', 26, 350, 0, '0000-00-00', '2022-05-23'),
(53, ' lactulose', 'syp', 39, 350, 0, '0000-00-00', '2022-04-23'),
(54, ' castor oil ', 'syp', 16, 120, 0, '0000-00-00', '2022-11-23'),
(55, ' gripe water', 'syp', 27, 220, 0, '0000-00-00', '2022-03-24'),
(56, 'gentamycin(gentacine)', 'inj', 142, 50, 0, '0000-00-00', '2022-11-24'),
(57, 'omeprazole(eslan)', 'inj', 21, 360, 0, '0000-00-00', '2022-10-24'),
(58, ' hyosine(hakali)', 'inj', 87, 80, 0, '0000-00-00', '2022-06-24'),
(59, ' metoclopramide(metimid)', 'inj', 40, 30, 0, '0000-00-00', '2022-11-24'),
(60, ' dexamethasone(jiel)', 'inj', 103, 40, 0, '0000-00-00', '2022-10-24'),
(61, 'diclofenac (diclodenk)', 'inj', 180, 100, 0, '0000-00-00', '2022-04-24'),
(62, ' acyclovir(vivorax)200mg', ' tab', 37, 75, 0, '0000-00-00', '2022-11-24'),
(63, 'terbinafin(terbonile)250mg', 'tab', 5, 420, 0, '0000-00-00', '2022-11-24'),
(64, 'clorphenaramin', 'syp', 5, 100, 0, '0000-00-00', '2022-02-23'),
(65, 'dyphenhydramin', 'syp', 40, 100, 0, '0000-00-00', '2022-04-24'),
(66, 'snip', 'tab', 17, 120, 0, '0000-00-00', '2022-07-26'),
(67, 'delmar', 'nasal spray', 23, 300, 0, '0000-00-00', '2022-11-24'),
(68, 'azythromycin(azito)', 'syp', 62, 300, 0, '0000-00-00', '2022-07-25'),
(69, 'prednisolone(prednicort)', 'tab', 153, 30, 0, '0000-00-00', '2022-03-23'),
(70, 'choice', 'tab', 35, 20, 0, '0000-00-00', '2022-07-23'),
(71, 'amoxacillin(rivamox)125', 'syp', 20, 150, 0, '0000-00-00', '2022-09-24'),
(72, 'amixacillin(rivamox)250', 'syp', 95, 160, 0, '0000-00-00', '2022-03-25'),
(73, 'terbinafin (finasil)', 'cream', 66, 110, 0, '0000-00-00', '2022-10-23'),
(74, 'hydrocortisone(netracort)', 'cream', 26, 70, 0, '0000-00-00', '2022-04-24'),
(75, ' enderm', 'cream', 3, 120, 0, '0000-00-00', '2022-12-22'),
(76, ' bethamethasone(dermosone)', 'cream', 40, 120, 0, '0000-00-00', '2022-04-24'),
(77, ' tetracyclin', 'cream', 64, 20, 0, '0000-00-00', '2022-11-23'),
(78, ' ketakonazole(derm keta)', 'cream', 6, 75, 0, '0000-00-00', '2022-07-23'),
(79, 'permetrin(tretlice)', 'cream', 26, 150, 0, '0000-00-00', '2022-02-24'),
(80, 'momethasone(melomet)', 'cream', 60, 150, 0, '0000-00-00', '2022-12-23'),
(81, ' glysolid small', 'cream', 33, 220, 0, '0000-00-00', '2022-06-24'),
(82, 'glysolid big ', 'cream', 23, 340, 0, '0000-00-00', '2022-04-25'),
(83, ' ear cotton', '', 34, 50, 0, '0000-00-00', '0000-00-00'),
(84, 'parafin', 'oil', 71, 150, 0, '0000-00-00', '2022-09-25'),
(85, ' brush kids', '', 85, 60, 0, '0000-00-00', '0000-00-00'),
(86, 'brush adults', '', 1, 40, 0, '0000-00-00', '0000-00-00'),
(87, 'collgate big', '', 1, 140, 0, '0000-00-00', '2022-04-24'),
(88, 'collgate medium', '', 12, 90, 0, '0000-00-00', '2022-09-23'),
(89, ' collgate small', '', 22, 70, 0, '0000-00-00', '2022-11-23'),
(90, ' dabur big ', '', 24, 170, 0, '0000-00-00', '2022-04-25'),
(91, 'dabur small', '', 16, 60, 0, '0000-00-00', '2022-04-25'),
(92, 'collgate kids', '', 9, 120, 0, '0000-00-00', '2022-11-24'),
(93, 'dove', 'soap', 51, 150, 0, '0000-00-00', '2022-12-24'),
(94, 'nisa', 'soap', 18, 75, 0, '0000-00-00', '2022-01-24'),
(95, 'facewash', '', 6, 150, 0, '0000-00-00', '2022-02-22'),
(96, 'blueseal small', '', 21, 120, 0, '0000-00-00', '2022-10-24'),
(97, 'blueseal big', '', 5, 190, 0, '0000-00-00', '2022-10-24'),
(98, ' olive oil(arjan)', '', 3, 190, 0, '0000-00-00', '2022-01-23'),
(99, 'baby shampoo', '', 24, 140, 0, '0000-00-00', '2022-06-24'),
(100, 'metrondazole(negazole)', 'syp', 41, 150, 0, '0000-00-00', '2022-07-25'),
(101, 'paracetamol(adol)', 'syp', 19, 100, 0, '0000-00-00', '2022-10-23'),
(102, 'ibuprofen(ibukant)', 'syp', 18, 150, 0, '0000-00-00', '2022-07-25'),
(103, 'panadol', 'tab', 73, 50, 0, '0000-00-00', '2022-01-24'),
(104, 'ibuprofen(milprofen)', 'tab', 97, 30, 0, '0000-00-00', '2022-02-25'),
(105, 'paracetamol(cadimol)', 'tab', 254, 30, 0, '0000-00-00', '2022-04-26'),
(106, 'albendzole(aldaz)', 'tab', 160, 20, 0, '0000-00-00', '2022-08-24'),
(107, 'mebendazole(quemex)', 'tab', 60, 50, 0, '0000-00-00', '2022-09-24'),
(108, 'zinc acytate(corzinc)', 'syp', 38, 90, 0, '0000-00-00', '2022-08-24'),
(109, 'azythromycin(swazi)', 'tab', 36, 60, 0, '0000-00-00', '2022-09-23'),
(110, 'augmentin(moxiclave) 625', 'tab', 2, 250, 0, '0000-00-00', '2022-02-23'),
(111, 'augmentin(coamoxiclave) 375', 'tab', 5, 150, 0, '0000-00-00', '2022-04-23'),
(112, 'amoxacillin (moxvid)500', 'tab', 38, 40, 0, '0000-00-00', '2022-05-24'),
(113, 'ciprofloxacillin(floxine)500mg', 'tab', 7, 100, 0, '0000-00-00', '2022-11-23'),
(114, 'ciprofloxacillin(ciprocant)500mg', 'tab', 100, 100, 0, '0000-00-00', '2022-07-25'),
(115, 'lozenge', 'tab', 96, 20, 0, '0000-00-00', '2022-11-23'),
(116, 'cotrimoxazole(cotri SSP480)', 'tab', 192, 50, 0, '0000-00-00', '2022-02-24'),
(117, ' hyosine (oraspas)10mg', 'tab', 26, 100, 0, '0000-00-00', '2022-11-25'),
(118, 'cloxacillin (m-clox ds)125', 'syp', 43, 130, 0, '0000-00-00', '2022-02-24'),
(119, 'augmentin(clendamox) 312', 'syp', 64, 430, 0, '0000-00-00', '2022-07-24'),
(120, 'erythromycin(eroysin)', 'syp', 38, 220, 0, '0000-00-00', '2022-05-24'),
(121, 'cephalaxine(kelexin)125', 'syp', 27, 200, 0, '0000-00-00', '2022-05-24'),
(122, 'ketaconazole shampoo(vavo)', '', 34, 450, 0, '0000-00-00', '2022-05-25'),
(123, 'daiper no 2', '', 0, 15, 0, '0000-00-00', '2022-06-24'),
(124, 'daiper no3', '', 0, 15, 0, '0000-00-00', '2022-04-26'),
(125, 'daiper no 4', '', 0, 15, 0, '0000-00-00', '2022-03-24'),
(126, 'ciprofloxacillin(zoxan)', 'eye drop', 10, 60, 0, '0000-00-00', '2022-09-23'),
(127, 'plaster', '', 0, 5, 0, '0000-00-00', '2022-12-24'),
(128, 'gauze', '', 53, 50, 0, '0000-00-00', '2022-02-27'),
(129, 'hcg', '', 73, 20, 0, '0000-00-00', '2022-06-23'),
(130, 'dexamethasone(ronic)', 'eye drop', 34, 200, 0, '0000-00-00', '2022-11-24'),
(131, 'eve', 'modes', 17, 70, 0, '0000-00-00', '2022-04-25'),
(132, 'comfort', 'nodes', 15, 90, 0, '0000-00-00', '2022-10-24'),
(133, 'mela one', 'tab', 6, 50, 0, '0000-00-00', '2022-03-23'),
(134, 'ceftaxone (cefax)', 'inj', 66, 250, 0, '0000-00-00', '2022-09-24'),
(135, 'enema', '', 48, 300, 0, '0000-00-00', '2022-06-24'),
(136, 'metrondazole', 'inj', 188, 100, 0, '0000-00-00', '2022-01-27'),
(137, 'rol bandage', '', 72, 15, 0, '0000-00-00', '2022-05-25'),
(138, 'rol gauze', '', 8, 0, 0, '0000-00-00', '2022-01-27'),
(139, 'avent feeding bottle', '', 1, 250, 0, '0000-00-00', '0000-00-00'),
(140, 'mumsee feeding bottle', '', 1, 120, 0, '0000-00-00', '0000-00-00'),
(141, 'avent nipple', '', 18, 80, 0, '0000-00-00', '0000-00-00'),
(142, 'normal saline', '', 195, 350, 0, '0000-00-00', '2022-09-25'),
(143, 'glucose 5%', '', 96, 350, 0, '0000-00-00', '2022-01-23'),
(144, 'ringer lactate', '', 32, 350, 0, '0000-00-00', '0000-00-00'),
(145, 'pacifier', '', 25, 70, 0, '0000-00-00', '0000-00-00'),
(146, 'facemask adult', '', 14, 10, 0, '0000-00-00', '0000-00-00'),
(147, 'facemask kids', '', 255, 10, 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `microscopy`
--

CREATE TABLE `microscopy` (
  `id` int(111) NOT NULL,
  `patient_id` int(111) NOT NULL,
  `e_c` int(111) NOT NULL,
  `wbc/hpf` int(111) NOT NULL,
  `rbc/hpf` int(111) NOT NULL,
  `casts` int(111) NOT NULL,
  `bacteria` int(111) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `neck`
--

CREATE TABLE `neck` (
  `id` int(50) NOT NULL,
  `result` varchar(500) DEFAULT NULL,
  `impression` varchar(500) DEFAULT NULL,
  `conclusion` varchar(5000) NOT NULL,
  `drname` varchar(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `neck`
--

INSERT INTO `neck` (`id`, `result`, `impression`, `conclusion`, `drname`, `patient_id`, `date`) VALUES
(1, 'Thyroid glands appear normal in size shape and echopattern, no focal mass.																																							', '												\r\n																							\r\n																							\r\n											', '												\r\n																							\r\n																							\r\n											', 'Kayo', 9, '2022-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `normal_brain`
--

CREATE TABLE `normal_brain` (
  `id` int(250) NOT NULL,
  `result` varchar(5000) NOT NULL,
  `impression` varchar(5000) NOT NULL,
  `conclusion` varchar(5000) NOT NULL,
  `drname` varchar(250) NOT NULL,
  `patient_id` int(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `normal_brain`
--

INSERT INTO `normal_brain` (`id`, `result`, `impression`, `conclusion`, `drname`, `patient_id`, `date`) VALUES
(1, 'Normal cerebral echogenicity.\r\n\r\n																						', '												\r\n											', '												\r\n											', 'Ultrasound', 9, '2022-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `nurse_exam`
--

CREATE TABLE `nurse_exam` (
  `id` int(50) NOT NULL,
  `BP` varchar(250) NOT NULL,
  `PR` double NOT NULL,
  `saturation` double NOT NULL,
  `respiratory` double NOT NULL,
  `temprature` double NOT NULL,
  `height` double NOT NULL,
  `weight` double NOT NULL,
  `head_circum` double NOT NULL,
  `MUAC` double NOT NULL,
  `patient_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurse_exam`
--

INSERT INTO `nurse_exam` (`id`, `BP`, `PR`, `saturation`, `respiratory`, `temprature`, `height`, `weight`, `head_circum`, `MUAC`, `patient_id`, `date`) VALUES
(2, '12', 12, 12, 12, 12, 12, 12, 12, 12, 1, '2022-12-29'),
(3, '120/80', 45, 45, 45, 44, 4, 45, 44, 44, 12, '2023-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `nurse_message`
--

CREATE TABLE `nurse_message` (
  `id` int(50) NOT NULL,
  `detail` varchar(5000) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `status` int(50) NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurse_message`
--

INSERT INTO `nurse_message` (`id`, `detail`, `patient_id`, `status`, `date`) VALUES
(1, 'Check his BP', 1, 1, '2022-12-12'),
(2, 'hello kaleb\r\n', 2, 1, '2022-12-12'),
(3, 'hello patient', 2, 1, '2022-12-12'),
(4, 'hello admission', 1, 1, '2022-12-12'),
(5, 'Hello', 9, 1, '2022-12-24'),
(6, 'give him cannola', 9, 1, '2022-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(50) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_quantity` varchar(50) NOT NULL,
  `item_unit` varchar(50) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `item_name`, `item_quantity`, `item_unit`, `price`) VALUES
(6, 'dolorem', '5', 'injection', 0),
(7, 'natus', '5', 'injection', 0),
(8, 'dolorem', '7', 'Syrup', 0),
(9, 'a', '7', 'injection', 0);

-- --------------------------------------------------------

--
-- Table structure for table `other`
--

CREATE TABLE `other` (
  `id` int(50) NOT NULL,
  `result` varchar(500) DEFAULT NULL,
  `impression` varchar(500) DEFAULT NULL,
  `conclusion` varchar(5000) DEFAULT NULL,
  `drname` varchar(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `other`
--

INSERT INTO `other` (`id`, `result`, `impression`, `conclusion`, `drname`, `patient_id`, `date`) VALUES
(1, 'adfadsf									', '												\r\n											', '												\r\n											', 'Ultrasound', 9, '2022-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` varchar(250) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `org` varchar(500) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `payment` int(50) NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `age`, `sex`, `phone`, `org`, `date`, `payment`) VALUES
(1, 'Kaleb', '3 year', 'male', '0905611207', NULL, '2022-12-16', 100),
(2, 'Kaleb Melaku', '1.5 year', 'male', '923187741', NULL, '2022-12-01', 100),
(11, 'fikir', '6 year', 'male', '905611207', 'stc', '2022-12-17', 100),
(12, 'Abenezer Melaku', '4 day', 'male', '923187741', '', '2023-01-09', 100);

-- --------------------------------------------------------

--
-- Table structure for table `pat_detail`
--

CREATE TABLE `pat_detail` (
  `id` int(11) NOT NULL,
  `pat_id` int(50) NOT NULL,
  `cc` varchar(500) DEFAULT NULL,
  `dt` varchar(500) DEFAULT NULL,
  `sy` varchar(500) DEFAULT NULL,
  `imp` varchar(500) DEFAULT NULL,
  `md` varchar(500) DEFAULT NULL,
  `cn` varchar(500) DEFAULT NULL,
  `pc` varchar(500) DEFAULT NULL,
  `vh` varchar(500) DEFAULT NULL,
  `aka` varchar(500) DEFAULT NULL,
  `lab` varchar(500) DEFAULT NULL,
  `dx` varchar(500) DEFAULT NULL,
  `rx` varchar(500) DEFAULT NULL,
  `plan` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(255) NOT NULL,
  `reception` int(255) NOT NULL,
  `lab` int(255) NOT NULL,
  `bed` int(255) NOT NULL,
  `pharmacy` int(255) NOT NULL,
  `ultrasound` int(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharma_daily_sell`
--

CREATE TABLE `pharma_daily_sell` (
  `rn` int(50) NOT NULL,
  `id` int(111) NOT NULL,
  `name` varchar(111) NOT NULL,
  `type` varchar(111) NOT NULL,
  `price` int(111) NOT NULL,
  `quan` int(111) NOT NULL,
  `sub_price` int(111) NOT NULL,
  `patient_id` int(50) DEFAULT NULL,
  `payment` varchar(500) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pharma_daily_sell`
--

INSERT INTO `pharma_daily_sell` (`rn`, `id`, `name`, `type`, `price`, `quan`, `sub_price`, `patient_id`, `payment`, `date`) VALUES
(12, 1, 'cefexime (bactofix)100/5ml', ' syp', 400, 4, 1600, 1, 'system', '2022-12-29'),
(13, 6, 'augmentin (rivaclave) 457', 'syp', 450, 1, 450, 1, 'system', '2022-12-29'),
(16, 56, 'gentamycin(gentacine)', 'inj', 50, 1, 50, 1, 'cash', '2022-12-29'),
(17, 57, 'omeprazole(eslan)', 'inj', 360, 3, 1080, 1, 'cash', '2022-12-29'),
(18, 82, 'glysolid big ', 'cream', 340, 1, 340, 1, 'cash', '2022-12-29'),
(19, 1, 'cefexime (bactofix)100/5ml', ' syp', 400, 6, 2400, 2, 'cash', '2022-12-29'),
(21, 129, 'hcg', '', 20, 1, 20, 2, 'cash', '2022-12-29'),
(23, 69, 'prednisolone(prednicort)', 'tab', 30, 3, 90, 2, 'credit', '2022-12-29'),
(24, 118, 'cloxacillin (m-clox ds)125', 'syp', 130, 1, 130, 1, 'credit', '2022-12-29'),
(25, 38, ' pcm(rectol) 125', 'supp', 15, 2, 30, 1, 'credit', '2022-12-29'),
(26, 63, 'terbinafin(terbonile)250mg', 'tab', 420, 1, 420, 1, 'credit', '2022-12-29'),
(27, 1, 'cefexime (bactofix)100/5ml', ' syp', 400, 9, 3600, 1, 'credit', '2022-12-29'),
(28, 4, 'paracetamol (denk) 125', 'supp', 30, 1, 30, 1, 'system', '2022-12-29'),
(29, 16, 'multivitamin', 'drop', 100, 3, 300, 2, 'system', '2022-12-29'),
(30, 3, 'medovent elixer', 'syp', 380, 2, 760, 1, 'credit', '2022-12-29'),
(31, 12, 'salbutamol (butalin)', 'syp', 150, 2, 300, 1, 'credit', '2022-12-29'),
(32, 14, ' cefexim(zimaks)', 'syp', 400, 2, 800, 1, 'credit', '2022-12-29'),
(33, 16, 'multivitamin', 'drop', 100, 1, 100, 2, 'credit', '2022-12-29'),
(34, 22, ' zinc oxide', 'cream', 90, 1, 90, 2, 'credit', '2022-12-29'),
(35, 20, 'clotrimazole (clozole)', 'cream', 100, 1, 100, 2, 'credit', '2022-12-29'),
(37, 1, 'cefexime (bactofix)100/5ml', ' syp', 400, 2, 800, 1, 'credit', '2023-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `pict`
--

CREATE TABLE `pict` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `pict` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pict`
--

INSERT INTO `pict` (`id`, `patient_id`, `pict`, `date`) VALUES
(1, 1, '12', '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `procedure`
--

CREATE TABLE `procedure` (
  `id` int(250) NOT NULL,
  `patient_id` int(250) NOT NULL,
  `price` int(250) NOT NULL,
  `payment` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rft`
--

CREATE TABLE `rft` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `bun` varchar(250) NOT NULL,
  `creatinine` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rft`
--

INSERT INTO `rft` (`id`, `patient_id`, `bun`, `creatinine`, `date`) VALUES
(1, 1, '2', '1', '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `rpr`
--

CREATE TABLE `rpr` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `rpr` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rpr`
--

INSERT INTO `rpr` (`id`, `patient_id`, `rpr`, `date`) VALUES
(1, 1, '21', '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `s/e`
--

CREATE TABLE `s/e` (
  `id` int(111) NOT NULL,
  `patient_id` int(111) NOT NULL,
  `Sodium` varchar(111) NOT NULL,
  `Potassium` varchar(111) NOT NULL,
  `Calsium` varchar(111) NOT NULL,
  `Others` varchar(111) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `s/e`
--

INSERT INTO `s/e` (`id`, `patient_id`, `Sodium`, `Potassium`, `Calsium`, `Others`, `date`) VALUES
(6, 1, '12', '2', '1', '2', '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `stool`
--

CREATE TABLE `stool` (
  `id` int(111) NOT NULL,
  `Appearance` varchar(111) NOT NULL,
  `Consistency` varchar(111) NOT NULL,
  `o/p` varchar(111) NOT NULL,
  `pus` varchar(111) NOT NULL,
  `mucus` varchar(111) NOT NULL,
  `petn_id` int(111) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stool`
--

INSERT INTO `stool` (`id`, `Appearance`, `Consistency`, `o/p`, `pus`, `mucus`, `petn_id`, `date`) VALUES
(13, 'normal', 'yes ', '66', 'no', 'no', 1, '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `system_payment`
--

CREATE TABLE `system_payment` (
  `id` int(50) NOT NULL,
  `med_id` int(50) NOT NULL,
  `price` double NOT NULL,
  `reason` varchar(255) NOT NULL DEFAULT 'pharmacy',
  `pat_id` int(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_payment`
--

INSERT INTO `system_payment` (`id`, `med_id`, `price`, `reason`, `pat_id`, `date`) VALUES
(1, 0, 4620, 'pharmacy', 0, '2022-11-15'),
(2, 0, 1835, 'pharmacy', 0, '2022-11-16'),
(8, 0, 180, 'pharmacy', 0, '2022-11-16'),
(9, 0, 500, 'pharmacy', 9, '2022-12-26'),
(10, 0, 440, 'pharmacy', 0, '2022-11-16'),
(11, 0, 440, 'pharmacy', 0, '2022-11-16'),
(12, 0, 440, 'pharmacy', 0, '2022-11-16'),
(13, 0, 110, 'pharmacy', 0, '2022-11-16'),
(17, 0, 480, 'pharmacy', 0, '2022-11-16'),
(20, 0, 750, 'pharmacy', 0, '2022-11-17'),
(21, 0, 4530, 'pharmacy', 0, '2022-11-17'),
(22, 0, 740, 'pharmacy', 0, '2022-11-17'),
(23, 0, 130, 'pharmacy', 0, '2022-11-17'),
(24, 0, 170, 'pharmacy', 0, '2022-11-17'),
(25, 0, 1030, 'pharmacy', 0, '2022-11-17'),
(26, 0, 510, 'pharmacy', 0, '2022-11-17'),
(27, 0, 480, 'pharmacy', 0, '2022-11-17'),
(28, 0, 960, 'pharmacy', 0, '2022-11-17'),
(29, 0, 740, 'pharmacy', 0, '2022-11-17'),
(30, 0, 240, 'pharmacy', 0, '2022-11-17'),
(31, 0, 700, 'pharmacy', 0, '2022-11-17'),
(32, 0, 400, 'pharmacy', 0, '2022-11-17'),
(33, 0, 1000, 'pharmacy', 0, '2022-11-18'),
(34, 0, 810, 'pharmacy', 0, '2022-11-18'),
(35, 0, 750, 'pharmacy', 0, '2022-11-18'),
(36, 0, 450, 'pharmacy', 0, '2022-11-18'),
(37, 0, 100, 'pharmacy', 0, '2022-11-18'),
(38, 0, 990, 'pharmacy', 0, '2022-11-18'),
(39, 0, 1950, 'pharmacy', 0, '2022-11-18'),
(40, 0, 1555, 'pharmacy', 0, '2022-11-18'),
(41, 0, 680, 'pharmacy', 0, '2022-11-18'),
(42, 0, 100, 'pharmacy', 0, '2022-11-18'),
(43, 0, 1760, 'pharmacy', 0, '2022-11-18'),
(44, 0, 1020, 'pharmacy', 0, '2022-11-18'),
(45, 0, 1140, 'pharmacy', 0, '2022-11-18'),
(46, 0, 1140, 'pharmacy', 0, '2022-11-18'),
(47, 0, 570, 'pharmacy', 0, '2022-11-18'),
(48, 0, 380, 'pharmacy', 0, '2022-11-19'),
(49, 0, 1260, 'pharmacy', 0, '2022-11-19'),
(50, 0, 750, 'pharmacy', 0, '2022-11-19'),
(51, 0, 930, 'pharmacy', 0, '2022-11-19'),
(52, 0, 1890, 'pharmacy', 0, '2022-11-19'),
(53, 0, 860, 'pharmacy', 0, '2022-11-19'),
(54, 0, 890, 'pharmacy', 0, '2022-11-20'),
(55, 0, 890, 'pharmacy', 0, '2022-11-20'),
(56, 0, 300, 'pharmacy', 0, '2022-11-21'),
(57, 0, 890, 'pharmacy', 0, '2022-11-21'),
(58, 0, 800, 'pharmacy', 0, '2022-11-21'),
(59, 0, 4470, 'pharmacy', 0, '2022-11-21'),
(60, 0, 1680, 'pharmacy', 0, '2022-11-21'),
(61, 0, 430, 'pharmacy', 0, '2022-11-21'),
(62, 0, 260, 'pharmacy', 0, '2022-11-21'),
(63, 0, 260, 'pharmacy', 0, '2022-11-21'),
(64, 0, 450, 'pharmacy', 0, '2022-11-21'),
(65, 0, 300, 'pharmacy', 0, '2022-11-21'),
(66, 0, 2165, 'pharmacy', 0, '2022-11-21'),
(67, 0, 500, 'pharmacy', 0, '2022-11-22'),
(68, 0, 450, 'pharmacy', 0, '2022-11-22'),
(69, 0, 1100, 'pharmacy', 0, '2022-11-22'),
(70, 0, 1000, 'pharmacy', 0, '2022-11-22'),
(71, 0, 380, 'pharmacy', 0, '2022-11-23'),
(72, 0, 800, 'pharmacy', 0, '2022-11-23'),
(73, 0, 380, 'pharmacy', 0, '2022-11-23'),
(74, 0, 300, 'pharmacy', 0, '2022-11-23'),
(75, 0, 1030, 'pharmacy', 0, '2022-11-23'),
(76, 0, 930, 'pharmacy', 0, '2022-11-23'),
(77, 0, 1160, 'pharmacy', 0, '2022-11-23'),
(78, 0, 1160, 'pharmacy', 0, '2022-11-23'),
(79, 0, 1420, 'pharmacy', 0, '2022-11-23'),
(80, 0, 6360, 'pharmacy', 0, '2022-11-24'),
(81, 0, 630, 'pharmacy', 0, '2022-11-24'),
(82, 0, 30, 'pharmacy', 0, '2022-11-24'),
(83, 0, 330, 'pharmacy', 0, '2022-11-24'),
(84, 0, 810, 'pharmacy', 0, '2022-11-24'),
(85, 0, 690, 'pharmacy', 0, '2022-11-24'),
(86, 0, 50, 'pharmacy', 0, '2022-11-24'),
(87, 0, 380, 'pharmacy', 0, '2022-11-24'),
(88, 0, 100, 'pharmacy', 0, '2022-11-24'),
(89, 0, 850, 'pharmacy', 0, '2022-11-24'),
(90, 0, 1600, 'pharmacy', 0, '2022-11-25'),
(91, 0, 910, 'pharmacy', 0, '2022-11-25'),
(92, 0, 780, 'pharmacy', 0, '2022-11-25'),
(93, 0, 500, 'pharmacy', 0, '2022-11-25'),
(94, 0, 890, 'pharmacy', 0, '2022-11-26'),
(95, 0, 600, 'pharmacy', 0, '2022-11-27'),
(96, 0, 480, 'pharmacy', 0, '2022-11-27'),
(97, 0, 1030, 'pharmacy', 0, '2022-11-28'),
(98, 0, 4840, 'pharmacy', 0, '2022-11-28'),
(99, 0, 1360, 'pharmacy', 0, '2022-11-28'),
(100, 0, 500, 'pharmacy', 0, '2022-11-28'),
(101, 0, 500, 'pharmacy', 0, '2022-11-28'),
(102, 0, 1180, 'pharmacy', 0, '2022-11-28'),
(103, 0, 100, 'pharmacy', 0, '2022-11-28'),
(104, 0, 500, 'pharmacy', 0, '2022-11-28'),
(105, 0, 1000, 'pharmacy', 0, '2022-11-29'),
(106, 0, 430, 'pharmacy', 0, '2022-11-29'),
(107, 0, 330, 'pharmacy', 0, '2022-11-29'),
(108, 0, 380, 'pharmacy', 0, '2022-11-29'),
(109, 0, 210, 'pharmacy', 0, '2022-11-30'),
(110, 0, 1230, 'pharmacy', 0, '2022-11-30'),
(111, 0, 740, 'pharmacy', 0, '2022-11-30'),
(112, 0, 380, 'pharmacy', 0, '2022-11-30'),
(113, 0, 1630, 'pharmacy', 0, '2022-11-30'),
(114, 0, 60, 'pharmacy', 0, '2022-11-30'),
(115, 0, 1425, 'pharmacy', 0, '2022-11-30'),
(116, 0, 650, 'pharmacy', 0, '2022-11-30'),
(117, 0, 750, 'pharmacy', 0, '2022-11-30'),
(118, 0, 930, 'pharmacy', 0, '2022-11-30'),
(119, 0, 450, 'pharmacy', 0, '2022-12-01'),
(120, 0, 770, 'pharmacy', 0, '2022-12-01'),
(121, 0, 330, 'pharmacy', 0, '2022-12-01'),
(122, 0, 1290, 'pharmacy', 0, '2022-12-01'),
(123, 0, 250, 'pharmacy', 0, '2022-12-01'),
(124, 0, 120, 'pharmacy', 0, '2022-12-01'),
(125, 0, 430, 'pharmacy', 0, '2022-12-01'),
(126, 0, 930, 'pharmacy', 0, '2022-12-01'),
(127, 0, 960, 'pharmacy', 0, '2022-12-01'),
(128, 0, 960, 'pharmacy', 0, '2022-12-02'),
(129, 0, 50, 'pharmacy', 0, '2022-12-02'),
(130, 0, 1000, 'pharmacy', 0, '2022-12-02'),
(131, 0, 4880, 'pharmacy', 0, '2022-12-02'),
(132, 0, 1050, 'pharmacy', 0, '2022-12-03'),
(133, 0, 380, 'pharmacy', 0, '2022-12-03'),
(134, 0, 350, 'pharmacy', 0, '2022-12-03'),
(135, 0, 150, 'pharmacy', 0, '2022-12-03'),
(136, 0, 450, 'pharmacy', 0, '2022-12-03'),
(137, 0, 730, 'pharmacy', 0, '2022-12-03'),
(138, 0, 350, 'pharmacy', 0, '2022-12-03'),
(139, 0, 6430, 'pharmacy', 0, '2022-12-03'),
(140, 0, 400, 'pharmacy', 0, '2022-12-04'),
(141, 0, 570, 'pharmacy', 0, '2022-12-04'),
(142, 0, 380, 'pharmacy', 0, '2022-12-04'),
(143, 0, 380, 'pharmacy', 0, '2022-12-04'),
(144, 0, 1500, 'pharmacy', 0, '2022-12-04'),
(145, 0, 600, 'pharmacy', 0, '2022-12-04'),
(146, 0, 1670, 'pharmacy', 0, '2022-12-04'),
(147, 0, 100, 'reception', 0, '2022-12-04'),
(148, 0, 410, 'pharmacy', 0, '2022-12-05'),
(149, 0, 290, 'pharmacy', 0, '2022-12-05'),
(150, 0, 1270, 'pharmacy', 0, '2022-12-05'),
(151, 0, 50, 'pharmacy', 0, '2022-12-05'),
(152, 0, 450, 'pharmacy', 0, '2022-12-05'),
(153, 0, 330, 'pharmacy', 0, '2022-12-05'),
(154, 0, 1100, 'pharmacy', 0, '2022-12-05'),
(155, 0, 400, 'pharmacy', 0, '2022-12-05'),
(156, 0, 850, 'pharmacy', 0, '2022-12-05'),
(157, 0, 1430, 'pharmacy', 0, '2022-12-05'),
(158, 0, 310, 'pharmacy', 0, '2022-12-05'),
(159, 0, 360, 'pharmacy', 0, '2022-12-05'),
(160, 0, 200, 'laboratory', 0, '2022-12-05'),
(161, 0, 450, 'pharmacy', 0, '2022-12-06'),
(162, 0, 580, 'pharmacy', 0, '2022-12-06'),
(163, 0, 1500, 'laboratory', 0, '2022-12-06'),
(164, 0, 730, 'pharmacy', 0, '2022-12-06'),
(165, 0, 5350, 'laboratory', 0, '2022-12-06'),
(166, 0, 400, 'pharmacy', 0, '2022-12-06'),
(167, 0, 1000, 'pharmacy', 0, '2022-12-06'),
(168, 0, 450, 'pharmacy', 0, '2022-12-06'),
(169, 0, 310, 'pharmacy', 0, '2022-12-06'),
(170, 0, 600, 'pharmacy', 0, '2022-12-07'),
(171, 0, 600, 'pharmacy', 0, '2022-12-07'),
(172, 0, 1000, 'pharmacy', 0, '2022-12-07'),
(173, 0, 1660, 'pharmacy', 0, '2022-12-07'),
(174, 0, 910, 'pharmacy', 0, '2022-12-07'),
(175, 0, 930, 'pharmacy', 0, '2022-12-07'),
(176, 0, 925, 'pharmacy', 0, '2022-12-07'),
(177, 0, 450, 'pharmacy', 0, '2022-12-07'),
(178, 0, 1790, 'pharmacy', 0, '2022-12-07'),
(179, 0, 1460, 'pharmacy', 0, '2022-12-07'),
(180, 0, 660, 'pharmacy', 0, '2022-12-07'),
(181, 0, 910, 'pharmacy', 0, '2022-12-07'),
(182, 0, 2470, 'pharmacy', 0, '2022-12-07'),
(183, 0, 450, 'pharmacy', 0, '2022-12-08'),
(184, 0, 1700, 'pharmacy', 0, '2022-12-08'),
(185, 0, 350, 'pharmacy', 0, '2022-12-08'),
(186, 0, 380, 'pharmacy', 0, '2022-12-08'),
(187, 0, 350, 'pharmacy', 0, '2022-12-08'),
(188, 0, 1080, 'pharmacy', 0, '2022-12-08'),
(189, 0, 930, 'pharmacy', 0, '2022-12-08'),
(190, 0, 1230, 'pharmacy', 0, '2022-12-08'),
(191, 0, 250, 'pharmacy', 0, '2022-12-08'),
(192, 0, 300, 'pharmacy', 0, '2022-12-08'),
(193, 0, 1020, 'pharmacy', 0, '2022-12-08'),
(194, 0, 1790, 'pharmacy', 0, '2022-12-08'),
(195, 0, 310, 'pharmacy', 0, '2022-12-08'),
(196, 0, 450, 'pharmacy', 0, '2022-12-08'),
(197, 0, 330, 'pharmacy', 0, '2022-12-08'),
(198, 0, 1010, 'pharmacy', 0, '2022-12-08'),
(199, 0, 1100, 'pharmacy', 0, '2022-12-08'),
(200, 0, 350, 'pharmacy', 0, '2022-12-09'),
(201, 0, 100, 'pharmacy', 0, '2022-12-09'),
(202, 0, 1200, 'ultrasound', 0, '2022-12-09'),
(204, 0, 380, 'pharmacy', 0, '2022-12-09'),
(205, 0, 350, 'pharmacy', 0, '2022-12-09'),
(206, 0, 960, 'pharmacy', 0, '2022-12-09'),
(212, 0, 1060, 'pharmacy', 0, '2022-12-10'),
(216, 0, 600, 'withdrawal', 0, '2022-12-10'),
(219, 0, 410, 'pharmacy', 0, '2022-12-10'),
(223, 0, 1420, 'pharmacy', 0, '2022-12-10'),
(227, 0, 400, 'reception', 9, '2022-12-26'),
(228, 0, 1050, 'laboratory', 0, '2022-12-10'),
(229, 0, 100, 'reception', 0, '2022-12-11'),
(230, 0, 100, 'pharmacy', 0, '2022-12-11'),
(231, 0, 500, 'laboratory', 9, '2022-12-26'),
(232, 0, 350, 'pharmacy', 0, '2022-12-12'),
(233, 0, 200, 'pharmacy', 0, '2022-12-12'),
(234, 0, 500, 'pharmacy', 0, '2022-12-12'),
(235, 0, 800, 'pharmacy', 0, '2022-12-12'),
(236, 0, 800, 'pharmacy', 0, '2022-12-12'),
(237, 0, 500, 'pharmacy', 0, '2022-12-12'),
(238, 0, 900, 'pharmacy', 0, '2022-12-12'),
(259, 28, 1320, 'pharmacy', 0, '2022-12-16'),
(260, 60, 80, 'pharmacy', 0, '2022-12-16'),
(261, 0, 100, 'reception', 0, '2023-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `system_payment_pharm`
--

CREATE TABLE `system_payment_pharm` (
  `rn` int(50) NOT NULL,
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `quan` int(50) NOT NULL,
  `sub_price` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tft`
--

CREATE TABLE `tft` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `t3` varchar(250) NOT NULL,
  `t4` varchar(250) NOT NULL,
  `tsh` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tft`
--

INSERT INTO `tft` (`id`, `patient_id`, `t3`, `t4`, `tsh`, `date`) VALUES
(1, 1, '12', '21', '21', '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `ultra_cart`
--

CREATE TABLE `ultra_cart` (
  `id` int(50) NOT NULL,
  `requests` varchar(5000) NOT NULL,
  `detail` varchar(5000) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `payment` int(50) NOT NULL DEFAULT 0,
  `price` int(50) NOT NULL DEFAULT 400,
  `status` int(50) NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ultra_cart`
--

INSERT INTO `ultra_cart` (`id`, `requests`, `detail`, `patient_id`, `payment`, `price`, `status`, `date`) VALUES
(40, 'Abdominal', '', 9, 1, 400, 0, '2022-12-25'),
(41, 'Chest', '', 9, 1, 400, 0, '2022-12-25'),
(44, 'Neck', '', 1, 1, 400, 0, '2023-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `uric_acid`
--

CREATE TABLE `uric_acid` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `uric` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uric_acid`
--

INSERT INTO `uric_acid` (`id`, `patient_id`, `uric`, `date`) VALUES
(1, 1, '12', '2022-12-06'),
(2, 1, '14', '2022-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `urine`
--

CREATE TABLE `urine` (
  `id` int(111) NOT NULL,
  `patient_id` int(111) NOT NULL,
  `color` varchar(111) NOT NULL,
  `apprearance` varchar(111) NOT NULL,
  `ph` varchar(111) NOT NULL,
  `s_g` varchar(111) NOT NULL,
  `protein` varchar(111) NOT NULL,
  `glucose` varchar(111) NOT NULL,
  `ketone` varchar(111) NOT NULL,
  `bilirubin` varchar(111) NOT NULL,
  `urobilinogen` varchar(111) NOT NULL,
  `blood` varchar(111) NOT NULL,
  `l_e` varchar(111) NOT NULL,
  `nitrite` varchar(111) NOT NULL,
  `epithe` varchar(250) NOT NULL,
  `wbc` varchar(250) NOT NULL,
  `rbc` varchar(250) NOT NULL,
  `casts` varchar(250) NOT NULL,
  `bacteria` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `password`, `role`) VALUES
(1, 'Admin', '0953565269', '123456', 1),
(3, 'Recep', '0923187741', '123456', 2),
(6, 'Nurse', '123456', '123456', 3),
(7, 'Doctor', '1234567', '123456', 4),
(8, 'Laboratory', '1234', '123456', 5),
(9, 'Pharmacy', '12345', '123456', 7),
(10, 'Ultrasound', '123', '123456', 6),
(11, 'Pharmacy_New', '12345678', '123456', 7);

-- --------------------------------------------------------

--
-- Table structure for table `vdrl`
--

CREATE TABLE `vdrl` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `vdrl` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vdrl`
--

INSERT INTO `vdrl` (`id`, `patient_id`, `vdrl`, `date`) VALUES
(1, 1, '1', '2022-12-06'),
(2, 1, '1', '2022-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `weil`
--

CREATE TABLE `weil` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `weil` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weil`
--

INSERT INTO `weil` (`id`, `patient_id`, `weil`, `date`) VALUES
(1, 1, '21', '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `widalh`
--

CREATE TABLE `widalh` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `widalh` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `widalh`
--

INSERT INTO `widalh` (`id`, `patient_id`, `widalh`, `date`) VALUES
(1, 1, '21', '2022-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `widalo`
--

CREATE TABLE `widalo` (
  `id` int(50) NOT NULL,
  `patient_id` int(50) NOT NULL,
  `widalo` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abdominal`
--
ALTER TABLE `abdominal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_det`
--
ALTER TABLE `admission_det`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_med`
--
ALTER TABLE `admission_med`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_pay`
--
ALTER TABLE `admission_pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `afb_sputum`
--
ALTER TABLE `afb_sputum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bf`
--
ALTER TABLE `bf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bg`
--
ALTER TABLE `bg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breast`
--
ALTER TABLE `breast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`rn`);

--
-- Indexes for table `cart_adm`
--
ALTER TABLE `cart_adm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_payment_pharm`
--
ALTER TABLE `cash_payment_pharm`
  ADD PRIMARY KEY (`rn`);

--
-- Indexes for table `cmc_ps`
--
ALTER TABLE `cmc_ps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coagulation`
--
ALTER TABLE `coagulation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_pharm`
--
ALTER TABLE `credit_pharm`
  ADD PRIMARY KEY (`rn`);

--
-- Indexes for table `crp`
--
ALTER TABLE `crp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csf`
--
ALTER TABLE `csf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `esr`
--
ALTER TABLE `esr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fbs`
--
ALTER TABLE `fbs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gram_stain`
--
ALTER TABLE `gram_stain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hpylori`
--
ALTER TABLE `hpylori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hylori_ag`
--
ALTER TABLE `hylori_ag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_cart`
--
ALTER TABLE `lab_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_cart2`
--
ALTER TABLE `lab_cart2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_message`
--
ALTER TABLE `lab_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_req`
--
ALTER TABLE `lab_req`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_res`
--
ALTER TABLE `lab_res`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `let`
--
ALTER TABLE `let`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lft`
--
ALTER TABLE `lft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liver_viral`
--
ALTER TABLE `liver_viral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meds`
--
ALTER TABLE `meds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `microscopy`
--
ALTER TABLE `microscopy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neck`
--
ALTER TABLE `neck`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `normal_brain`
--
ALTER TABLE `normal_brain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurse_exam`
--
ALTER TABLE `nurse_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurse_message`
--
ALTER TABLE `nurse_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other`
--
ALTER TABLE `other`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pat_detail`
--
ALTER TABLE `pat_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharma_daily_sell`
--
ALTER TABLE `pharma_daily_sell`
  ADD PRIMARY KEY (`rn`);

--
-- Indexes for table `pict`
--
ALTER TABLE `pict`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procedure`
--
ALTER TABLE `procedure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rft`
--
ALTER TABLE `rft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rpr`
--
ALTER TABLE `rpr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s/e`
--
ALTER TABLE `s/e`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stool`
--
ALTER TABLE `stool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_payment`
--
ALTER TABLE `system_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_payment_pharm`
--
ALTER TABLE `system_payment_pharm`
  ADD PRIMARY KEY (`rn`);

--
-- Indexes for table `tft`
--
ALTER TABLE `tft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ultra_cart`
--
ALTER TABLE `ultra_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uric_acid`
--
ALTER TABLE `uric_acid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urine`
--
ALTER TABLE `urine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `vdrl`
--
ALTER TABLE `vdrl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weil`
--
ALTER TABLE `weil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widalh`
--
ALTER TABLE `widalh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widalo`
--
ALTER TABLE `widalo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abdominal`
--
ALTER TABLE `abdominal`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admission`
--
ALTER TABLE `admission`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admission_det`
--
ALTER TABLE `admission_det`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admission_med`
--
ALTER TABLE `admission_med`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admission_pay`
--
ALTER TABLE `admission_pay`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `afb_sputum`
--
ALTER TABLE `afb_sputum`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bf`
--
ALTER TABLE `bf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bg`
--
ALTER TABLE `bg`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `breast`
--
ALTER TABLE `breast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `rn` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `cart_adm`
--
ALTER TABLE `cart_adm`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cash_payment_pharm`
--
ALTER TABLE `cash_payment_pharm`
  MODIFY `rn` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cmc_ps`
--
ALTER TABLE `cmc_ps`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `coagulation`
--
ALTER TABLE `coagulation`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `credit`
--
ALTER TABLE `credit`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `credit_pharm`
--
ALTER TABLE `credit_pharm`
  MODIFY `rn` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `crp`
--
ALTER TABLE `crp`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `csf`
--
ALTER TABLE `csf`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `esr`
--
ALTER TABLE `esr`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fbs`
--
ALTER TABLE `fbs`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gram_stain`
--
ALTER TABLE `gram_stain`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hpylori`
--
ALTER TABLE `hpylori`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hylori_ag`
--
ALTER TABLE `hylori_ag`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `laboratory`
--
ALTER TABLE `laboratory`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `lab_cart`
--
ALTER TABLE `lab_cart`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `lab_cart2`
--
ALTER TABLE `lab_cart2`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `lab_message`
--
ALTER TABLE `lab_message`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lab_req`
--
ALTER TABLE `lab_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lab_res`
--
ALTER TABLE `lab_res`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `let`
--
ALTER TABLE `let`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lft`
--
ALTER TABLE `lft`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `liver_viral`
--
ALTER TABLE `liver_viral`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meds`
--
ALTER TABLE `meds`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `microscopy`
--
ALTER TABLE `microscopy`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `neck`
--
ALTER TABLE `neck`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `normal_brain`
--
ALTER TABLE `normal_brain`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nurse_exam`
--
ALTER TABLE `nurse_exam`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nurse_message`
--
ALTER TABLE `nurse_message`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `other`
--
ALTER TABLE `other`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pat_detail`
--
ALTER TABLE `pat_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharma_daily_sell`
--
ALTER TABLE `pharma_daily_sell`
  MODIFY `rn` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pict`
--
ALTER TABLE `pict`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `procedure`
--
ALTER TABLE `procedure`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rft`
--
ALTER TABLE `rft`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rpr`
--
ALTER TABLE `rpr`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `s/e`
--
ALTER TABLE `s/e`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stool`
--
ALTER TABLE `stool`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `system_payment`
--
ALTER TABLE `system_payment`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `system_payment_pharm`
--
ALTER TABLE `system_payment_pharm`
  MODIFY `rn` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tft`
--
ALTER TABLE `tft`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ultra_cart`
--
ALTER TABLE `ultra_cart`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `uric_acid`
--
ALTER TABLE `uric_acid`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `urine`
--
ALTER TABLE `urine`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vdrl`
--
ALTER TABLE `vdrl`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `weil`
--
ALTER TABLE `weil`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `widalh`
--
ALTER TABLE `widalh`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `widalo`
--
ALTER TABLE `widalo`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
