-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2025 at 04:06 AM
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
-- Database: `quanlyquan`
--

-- --------------------------------------------------------

--
-- Table structure for table `cauhinh`
--

CREATE TABLE `cauhinh` (
  `id` int(11) NOT NULL,
  `zone_name` varchar(255) NOT NULL,
  `cpu` varchar(255) DEFAULT NULL,
  `gpu` varchar(255) DEFAULT NULL,
  `ram` varchar(255) DEFAULT NULL,
  `monitor` varchar(255) DEFAULT NULL,
  `mouse` varchar(255) DEFAULT NULL,
  `kb` varchar(255) DEFAULT NULL,
  `headset` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cauhinh`
--

INSERT INTO `cauhinh` (`id`, `zone_name`, `cpu`, `gpu`, `ram`, `monitor`, `mouse`, `kb`, `headset`, `price`) VALUES
(2, 'STANDARD ZONE', 'Intel i3-12100F', 'RTX 3050', '16GB (2x8GB)', '24\" 240Hz', 'Logitech G102', 'DARE-U EK810x', 'HyperX Cloud II', 17000.00),
(4, 'MASTER ZONE', 'AMD 9700x', 'RTX 4060', '32GB', '24\" 360Hz + Arm', 'Endgame Gear XM1R', 'DARE-U EK1280x', 'Somic G936N', 16000.00),
(5, 'COMPETITIVE ZONE', 'Ryzen 7 7800x3D', 'RTX 5070Ti', '32CB', '24\" 360Hz + Arm', 'Endgame Gear XM1R', 'DARE-U EK1280x', 'Somic G936N', 18000.00),
(6, 'STREAM ZONE', 'Ryzen 9 9950X3D', 'RTX 5070Ti', '32GB', '24\" 360Hz + Màn phụ + Arm', 'Endgame Gear XM1R', 'DARE-U EK1280x', 'Somic G936N', 30000.00);

-- --------------------------------------------------------

--
-- Table structure for table `diachi`
--

CREATE TABLE `diachi` (
  `id` int(11) NOT NULL,
  `tencoso` varchar(255) NOT NULL,
  `vitri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diachi`
--

INSERT INTO `diachi` (`id`, `tencoso`, `vitri`) VALUES
(1, 'Genus Dương Quảng Hàm', '138, Dương Quảng Hàm,phường 6, Gò Vấp, tp HCM');

-- --------------------------------------------------------

--
-- Table structure for table `dichvu`
--

CREATE TABLE `dichvu` (
  `id` int(11) NOT NULL,
  `food` varchar(255) DEFAULT NULL,
  `drink` varchar(255) DEFAULT NULL,
  `khac` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dichvu`
--

INSERT INTO `dichvu` (`id`, `food`, `drink`, `khac`, `price`, `img`) VALUES
(1, 'Cơm gà', NULL, NULL, 30000.00, 'https://file.hstatic.net/200000700229/article/com-ga-chien-mam-toi-1_598c51ff37f84acd99f186d64e0acba0.jpg'),
(2, 'gà cay', NULL, NULL, 30000.00, 'assets/1763973598_gacay.jpg'),
(3, NULL, 'Coca Cola', NULL, 16000.00, 'assets/1764007104_coca-300ml-chai-nhua.jpg'),
(4, NULL, 'Redbull', NULL, 20000.00, 'assets/1764007170_nuoc-tang-luc-redbull-lon-250ml-15112018162747.jpg'),
(5, NULL, NULL, 'Áo mưa giấy', 10000.00, 'assets/1764007234_786a9d1cfb57fc21bfeb68188555db96.jpg'),
(6, NULL, NULL, 'Bim bim', 8000.00, 'assets/1764007287_f5bb9958d77e46f59f5b552a49b28658.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `id` int(11) NOT NULL,
  `tenkhuyenmai` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khuyenmai`
--

INSERT INTO `khuyenmai` (`id`, `tenkhuyenmai`, `img`) VALUES
(2, 'Khuyến mãi HSSV', 'assets/1763973443_UuDaiHSSV.png');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `tintuc` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `tintuc`, `img`) VALUES
(1, 'Tuyển dụng Content Creator', 'assets/1764007742_{2386F190-5140-4AF6-B89C-F76B352D284F}.png');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `mxh` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `mxh`, `url`, `img`) VALUES
(11, 'Facebook', 'https://www.facebook.com/Ducwtaiif', '1763973865_2021_Facebook_icon.svg-removebg-preview.png'),
(12, 'Instagram', 'https://www.instagram.com/yaemiko138/', '1763977619_Instagram_icon.png-removebg-preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123'),
(3, 'moi', 'moimoi');

-- --------------------------------------------------------

--
-- Table structure for table `trangchu`
--

CREATE TABLE `trangchu` (
  `id` int(11) NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trangchu`
--

INSERT INTO `trangchu` (`id`, `banner`, `img`) VALUES
(9, 'Chơi hết mình', '1763983352_1763975097_brbaner.png'),
(10, 'Chiến hết nấc', '1763983372_banergaminh.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cauhinh`
--
ALTER TABLE `cauhinh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diachi`
--
ALTER TABLE `diachi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dichvu`
--
ALTER TABLE `dichvu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trangchu`
--
ALTER TABLE `trangchu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cauhinh`
--
ALTER TABLE `cauhinh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diachi`
--
ALTER TABLE `diachi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dichvu`
--
ALTER TABLE `dichvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trangchu`
--
ALTER TABLE `trangchu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
