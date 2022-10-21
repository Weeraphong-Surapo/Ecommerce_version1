-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 26, 2022 at 07:25 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`id`, `category_name`) VALUES
(1, 'ผลไม้หวาน'),
(2, 'ผัก'),
(3, 'ขนม'),
(4, 'อุปกรณ์ IT'),
(5, 'อาหาร'),
(9, 'โทรศพท์'),
(10, 'เครื่องดนตรี'),
(11, 'โน้ตบุ๊ค'),
(12, 'ของประดับ'),
(13, 'เครื่องใช้ไฟฟ้า'),
(14, 'ของตกแต่ง');

-- --------------------------------------------------------

--
-- Table structure for table `tb_contact`
--

CREATE TABLE `tb_contact` (
  `id` int(11) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_phone` varchar(10) NOT NULL,
  `contact_email` text NOT NULL,
  `contact_description` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_contact`
--

INSERT INTO `tb_contact` (`id`, `contact_name`, `contact_phone`, `contact_email`, `contact_description`, `user_id`) VALUES
(1, 'weeraphong', '0925562767', 'weeraphong610@gmail', 'dasjhdjashdlkjalkdjlajsdlkjalkdjlakjldkajlkdjlakjldkajldja', 1),
(2, 'weeraphong', '0925562767', 'weeraphong610@gmail', 'asdads', 1),
(3, 'วีระพงษ์ สุราโพธิ์', '0925562767', '64301282004@utc.ac.th', 'sdfa', 3),
(4, 'วีระพงษ์ สุราโพธิ์', '0925562767', '64301282004@utc.ac.th', 'sadf', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_money`
--

CREATE TABLE `tb_money` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `money_number` varchar(20) NOT NULL,
  `money_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_money`
--

INSERT INTO `tb_money` (`id`, `name`, `money_number`, `money_img`) VALUES
(8, 'วีระพงษ์ สุราโพธิ์', '6608873980', '../assets/images/money_online/68318-154968392520191019_201135.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_news`
--

CREATE TABLE `tb_news` (
  `id` int(11) NOT NULL,
  `new_head` varchar(150) NOT NULL,
  `new_description` text NOT NULL,
  `new_img` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_news`
--

INSERT INTO `tb_news` (`id`, `new_head`, `new_description`, `new_img`, `created_at`) VALUES
(2, 'แฟ้บซักผ้า', '1 ฟรี 1 ด่วนสินค้ามีจำนวนจำกัด', 'upload_new/22714-โปร1-1.jpeg', '2022-08-19 15:59:01'),
(3, '7 วัน ชื้อของแถมฟรี', 'แถมฟรี ภายในวันที่ 19-26', 'upload_new/62977-โปร.webp', '2022-08-19 15:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `delivery` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id`, `order_id`, `user_id`, `product`, `qty`, `price`, `delivery`) VALUES
(1, 1, 3, 'ผักไม้รวม', 1, 90, 20),
(2, 2, 3, 'กระเทียม', 1, 40, 10),
(3, 2, 3, 'ผักไม้รวม', 1, 90, 20),
(4, 5, 3, 'ผักไม้รวม', 1, 90, 20),
(5, 7, 3, 'Iphone 13 pro', 1, 32000, 100),
(6, 7, 3, 'macbook pro m1', 1, 42000, 100),
(7, 8, 3, 'Vivo v20', 1, 9500, 100),
(8, 9, 3, 'Vivo v20', 1, 9500, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tb_shop`
--

CREATE TABLE `tb_shop` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `delivery` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_shop`
--

INSERT INTO `tb_shop` (`id`, `img`, `name`, `description`, `price`, `delivery`, `count`, `category`) VALUES
(1, 'assets/images/upload/32425-vivo.png', 'Vivo v20', 'สมาร์ทโฟน (โทรศัพท์มือถือพร้อมระบบปฏิบัติการ) จอแสดงผล AMOLED 24-bit (16 ล้านสี) - จอแสดงผล HDR 10 - หน้าจอหยดน้ำ (Waterdrop Display) - กว้าง 6.44 นิ้ว (แนวทะแยง) - ความละเอียด 1080 x 2400 พิกเซล (409 ppi)', 9500, 100, 18, '9'),
(2, 'assets/images/upload/5374-berker1.jpeg', 'เบอร์เกอร์', 'อร่อยมาก', 90, 20, 20, '5'),
(3, 'assets/images/upload/75190-กีต้า.jpeg', 'กีตาร์', 'เสียงดีมาก', 2000, 60, 20, '10'),
(4, 'assets/images/upload/87035-สตอเบอรี่.jpeg', 'สตอเบอร์รี่', 'หวานๆ', 200, 20, 100, '1'),
(5, 'assets/images/upload/96418-องุ่น.jpeg', 'องุ่น', 'หวานๆ', 150, 20, 20, '1'),
(6, 'assets/images/upload/5105-i9.webp', 'Cpu i9 gen12', 'อุปกรณ์คอม cpu แรงๆ', 12000, 100, 20, '4'),
(7, 'assets/images/upload/22062-iphone.jpeg', 'Iphone 13 pro', 'iphone', 32000, 100, 99, '9'),
(8, 'assets/images/upload/2347-macbook.jpg', 'macbook pro m1', 'cpu m1 256/16', 42000, 100, 48, '11'),
(9, 'assets/images/upload/16193-moniter.webp', 'จอคอม', '24นิ้ว', 4200, 20, 150, '4'),
(10, 'assets/images/upload/46259-mouse.jpeg', 'เมาส์เกมมิ่ง', 'คุณภาพดีๆ', 699, 30, 20, '4'),
(11, 'assets/images/upload/11181-notebook.webp', 'notebook', 'ของโครตดี', 12000, 20, 70, '11'),
(12, 'assets/images/upload/49678-oppo.webp', 'Oppo', 'สเป็คแรงๆ กล้องสวย แบตทน', 6999, 80, 100, '9'),
(13, 'assets/images/upload/74014-power.webp', 'power supply', 'power supply rgb', 2500, 80, 100, '4'),
(14, 'assets/images/upload/59837-ram.jpeg', 'Ram rgb 16gb', 'kington', 2400, 100, 100, '4'),
(15, 'assets/images/upload/54234-ram.webp', 'Ram hyper X 16 GB', 'ram hyper x 16gb computer', 2800, 50, 100, '4'),
(16, 'assets/images/upload/54958-ตู้เย็น.jpeg', 'ตู้เย็น', '13000', 250, 50, 100, '13'),
(17, 'assets/images/upload/21172-เตาอบ.webp', 'เตาอบ', 'เตาอบ', 1650, 100, 100, '13'),
(18, 'assets/images/upload/59057-mouse2.png', 'เม้า', 'เม้า rgb', 1600, 20, 200, '4'),
(19, 'assets/images/upload/32148-กระเป๋า.jpeg', 'กระเป๋าใส่ notebook', 'สวยๆราคาไม่แพง', 460, 60, 55, '12'),
(20, 'assets/images/upload/17911-เตารีด.jpeg', 'เตารีด', 'เตารีด', 690, 80, 555, '13'),
(21, 'assets/images/upload/50084-ท่ีนอน.webp', 'ที่นอน USA', 'หนุ่มๆ เมกอิน USA', 3599, 200, 16, '14'),
(22, 'assets/images/upload/6780-แป้นพิม.png', 'แป้นพิม เกมมิ่งRGB', 'ปรับไฟใด้ เหมาะกับเกม blue swith', 1290, 80, 30, '4'),
(23, 'assets/images/upload/25814-นาฬิกา.jpeg', 'นาฬิกา', 'นาฬิกา สวยๆ', 870, 80, 59, '12'),
(24, 'assets/images/upload/9242-สายไฟ.jpeg', 'สายไฟ cat6', 'cat6', 1690, 150, 6, '4'),
(25, 'assets/images/upload/78844-aripord.jpeg', 'aripord pro2', 'aripord2 apple', 4690, 100, 20, '12'),
(26, 'assets/images/upload/42747-หม้อหุงข้าว.jpeg', 'หม้อหุงข้าว เบอร์5', 'ดีๆไม่เปลืองไฟ', 690, 80, 36, '13'),
(27, 'assets/images/upload/69566-nike.webp', 'รองเท้าบาส nike', 'รองเท้าบาส', 3600, 100, 4, '12'),
(28, 'assets/images/upload/80768-แก้วน้ำ.webp', 'แก้วน้ำ', 'แก้วน้ำ', 300, 60, 1000, '14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `address` text,
  `img` text,
  `lavel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `name`, `email`, `password`, `tel`, `address`, `img`, `lavel`) VALUES
(1, 'วีระพงษ์', '64301282004@utc.ac.th', '123456', '', '', '', 'user'),
(2, 'admin', 'admin@admin.com', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', '09255627627', '110/1', 'assets/images/upload/28357-pexels-daniel-reche-1556698.jpg', 'admin'),
(3, 'test', 'user@user.com', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '', '', '', 'user'),
(4, 'sdf', 'sdf@sadjlfk.com', '50fde99373b04363727473d00ae938a4f4debfd0afb1d428337d81905f6863b3cc303bb331ffb3361085c3a6a2ef4589ff9cd2014c90ce90010cd3805fa5fbc6', '456', 'sdf', '../assets/images/img_admin/49507-154968392520191019_201135.png', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_delivery`
--

CREATE TABLE `tb_user_delivery` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `tel` varchar(10) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(200) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `money_img` text,
  `by_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user_delivery`
--

INSERT INTO `tb_user_delivery` (`order_id`, `user_id`, `name`, `address`, `tel`, `country`, `city`, `zip`, `money_img`, `by_date`, `status`) VALUES
(1, 3, 'sdfa', '110/1', '0925562767', 'sdaf', 'dsf', '3663', NULL, '2022-09-25 06:56:39', '1'),
(2, 3, '', 'test', '0925562767', 'sdaf', 'sdaf', '3663', 'money_delivery/23491-', '2022-09-25 06:56:39', '0'),
(4, 3, 'sdfa', '110/1', '0925562767', 'sdaf', 'dsf', '56356', 'assets/images/delivery/73596-', '2022-09-25 06:56:39', '1'),
(5, 3, 'sdfa', '110/1', '0925562767', 'sdaf', 'dsf', '252', 'assets/images/delivery/74380-', '2022-09-25 06:56:39', '3'),
(6, 3, 'sdfa', 'sdaf', '0925562767', 'sdaf', 'มหาชนะชัย', '5252', 'assets/images/money/3973-ภาพถ่ายหน้าจอ-2565-09-22-เวลา-15.49.57.png', '2022-09-25 15:15:27', '0'),
(7, 3, 'Weeraphong', 'ubonratani', '0925562767', 'ubonritari', 'mailkie', '34000', NULL, '2022-09-25 08:08:03', '0'),
(8, 3, 'test', '110', '0925562767', 'tasothon', 'thai', '35130', 'assets/images/money/71853-s__2801668.jpg', '2022-09-25 16:04:50', '3'),
(9, 3, 'ad', 'ad', '324', 'fc', 'ad', '23', 'assets/images/money/49567-logo_shop.png', '2022-09-26 07:03:28', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_contact`
--
ALTER TABLE `tb_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_money`
--
ALTER TABLE `tb_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_news`
--
ALTER TABLE `tb_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_shop`
--
ALTER TABLE `tb_shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_delivery`
--
ALTER TABLE `tb_user_delivery`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_contact`
--
ALTER TABLE `tb_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_money`
--
ALTER TABLE `tb_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_news`
--
ALTER TABLE `tb_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_shop`
--
ALTER TABLE `tb_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_user_delivery`
--
ALTER TABLE `tb_user_delivery`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
