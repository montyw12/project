-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql104.infinityfree.com
-- Generation Time: Jun 20, 2023 at 02:49 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_33813249_00_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` varchar(16) NOT NULL DEFAULT 'item_id_null',
  `f_producer_id` varchar(16) NOT NULL DEFAULT 'f_id_null',
  `type` varchar(255) NOT NULL DEFAULT 'type_null',
  `name` varchar(255) NOT NULL DEFAULT 'name_null',
  `mrp` decimal(9,2) NOT NULL DEFAULT 0.00,
  `quantity` int(9) NOT NULL DEFAULT 0,
  `manufacture_date` date NOT NULL DEFAULT '2001-01-01',
  `expire_date` date NOT NULL DEFAULT '2001-01-01',
  `image` varchar(255) NOT NULL DEFAULT 'image_null'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `f_producer_id`, `type`, `name`, `mrp`, `quantity`, `manufacture_date`, `expire_date`, `image`) VALUES
('0I14v4yr1x4', '0Pctz4hyc1k', 'oil', 'Hair Oil', '99.00', 100, '2023-01-01', '2026-05-05', '00_img/IMG_230504_014703.png'),
('0I1hmih485h', '0Pfo29pg28x', 'Food', 'Oreo', '30.00', 10, '2023-05-09', '2023-05-26', '00_img/IMG_230509_030703.jpeg'),
('0I1hmiru0vw', '0P2wo3fd6u5', 'Body Food', 'CereGrow', '490.00', 2399, '2023-01-29', '2024-11-02', '00_img/IMG_230508_012503.jpeg'),
('0I2wo36forg', '0Pctz4hyc1k', 'Body Soaps', 'Pears', '89.99', 9999, '2023-02-08', '2023-05-27', '00_img/IMG_230522_011334.jpeg'),
('0I39fhhdnvk', '0P5qr8wdukc', 'Balaji Wafers', 'Shing Bhujiya', '115.00', 9875, '2022-10-31', '2023-08-31', '00_img/IMG_230508_021609.jpeg'),
('0I39fhmqkbg', '0Pfcc0d02k', 'Medicine', 'PepDox', '300.00', 1500, '2023-01-01', '2024-02-02', '00_img/IMG_230504_022509.jpeg'),
('0I3m6vemo5c', '0P1udx9brq4', 'Namkin', 'Bhujiya', '360.00', 3500, '2023-02-03', '2024-01-31', '00_img/IMG_230504_030110.jpeg'),
('0I3yy9yi56k', '0P2wo3fd6u5', 'Body Food', 'Cerelec', '550.00', 3000, '2023-03-31', '2023-12-31', '00_img/IMG_230508_012411.jpeg'),
('0I3yya9tdo8', '0Pctz4hyc1k', 'oil', 'Onion Black Seed Hair Oil', '200.00', 999, '2023-01-01', '2024-11-11', '00_img/IMG_230504_014311.png'),
('0I4bpo4onul', '0Phfv8ato39', 'dfgh', 'dfghj', '345.00', 9876, '2023-01-31', '2024-12-01', '00_img/IMG_230521_062412.jpeg'),
('0I4bpoet0qk', '0P5qr8wdukc', 'Balaji Wafers', 'Peri Peri', '20.00', 300, '2023-03-02', '2023-10-29', '00_img/IMG_230508_014112.jpeg'),
('0I518g9wgtc', '0P5qr8wdukc', 'Balaji Wafers', 'Wheels', '10.00', 3454, '2023-03-03', '2023-12-31', '00_img/IMG_230508_021213.jpeg'),
('0I518gtjrp4', '0Pctz4hyc1k', 'oil', 'Coffee Scalp For Hair', '175.00', 698, '2023-02-02', '2025-01-01', '00_img/IMG_230504_014514.png'),
('0I5dzujnkps', '0P5qr8wdukc', 'Balaji Wafers', 'Funne', '45.00', 7890, '2023-04-01', '2023-12-03', '00_img/IMG_230508_021814.jpeg'),
('0I5qr96i7uk', '0P5qr8wdukc', 'Balaji Wafers', 'Cream & Onion', '10.00', 6999, '2023-03-01', '2023-10-01', '00_img/IMG_230508_014616.jpeg'),
('0I63in9pk64', '0Pfcc0d02k', 'Liquid Medicine', 'Pepto', '200.00', 2000, '2023-12-12', '2024-12-12', '00_img/IMG_230504_024117.jpeg'),
('0I63ingurfg', '0P1udx9brq4', 'Biscuits', 'Bour Bon', '50.00', 2299, '2023-04-04', '2023-09-09', '00_img/IMG_230504_025317.jpeg'),
('0I6ga19xqe4', '0Pfcc0d02k', 'Liquid Medicine', 'Himpyrin', '230.00', 2000, '2023-02-02', '2024-12-12', '00_img/IMG_230504_023118.jpeg'),
('0I6ga1famu4', '0Pfcc0d02k', 'Liquid Medicine', 'Stomafit', '240.00', 2398, '2023-02-03', '2024-02-03', '00_img/IMG_230504_024018.jpeg'),
('0I6t1fd52n0', '0Pfcc0d02k', 'Medicine', 'Metosine', '100.00', 1199, '2023-02-12', '2024-12-12', '00_img/IMG_230504_022619.jpeg'),
('0I6t1fwsdiw', '0Pctz4hyc1k', 'Body Soaps', 'Dettol', '45.00', 4999, '2023-01-01', '2024-01-01', '00_img/IMG_230504_015919.jpeg'),
('0I9ad64xct8', '0Pctz4hyc1k', 'Body Soaps', 'Pears', '60.00', 3999, '2023-05-05', '2024-04-04', '00_img/IMG_230504_020026.jpeg'),
('0I9ad6l0258', '0Pfcc0d02k', 'Medicine', 'Pill-heal', '200.00', 2000, '2022-12-02', '2024-02-02', '00_img/IMG_230504_022726.jpeg'),
('0I9n4kmf3kw', '0P5qr8wdukc', 'Balaji Wafers', 'Banana Chips', '30.00', 4565, '2023-01-01', '2023-12-31', '00_img/IMG_230508_021927.jpeg'),
('0I9zvyhadfk', '0P1udx9brq4', 'Namkin', 'Shev Chivda', '110.00', 1128, '2023-03-01', '2024-12-01', '00_img/IMG_230504_030028.jpeg'),
('0Iacnco2b8c', '0Pctz4hyc1k', 'Body Soaps', 'Santoor', '40.00', 1998, '2023-07-07', '2024-02-02', '00_img/IMG_230504_020129.jpeg'),
('0Iaperolxcs', '0P1udx9brq4', 'Biscuits', 'Dream Cream', '20.00', 2498, '2023-04-04', '2024-08-09', '00_img/IMG_230504_025230.jpeg'),
('0Ib265yd198', '0P1udx9brq4', 'Namkin', 'Madhur', '400.00', 2300, '2023-04-12', '2024-11-01', '00_img/IMG_230504_025831.jpeg'),
('0Ibroxc6wps', '0P5qr8wdukc', 'Balaji Wafers', 'Flamin\' Hot', '10.00', 10000, '2023-03-31', '2023-12-01', '00_img/IMG_230508_020033.jpeg'),
('0Ibroy46a2k', '0P5qr8wdukc', 'Balaji Wafers', 'Crunchex', '45.00', 9998, '2023-01-31', '2023-10-31', '00_img/IMG_230508_014733.jpeg'),
('0Ibroya4m70', '0P1udx9brq4', 'Namkin', 'Navrattan', '500.00', 1200, '2023-02-02', '2024-02-02', '00_img/IMG_230504_025733.jpeg'),
('0Ic4gbt37sq', '0P2wo3fd6u5', 'Pants', 'MotherCare', '200.00', 1200, '2023-01-31', '2024-12-01', '00_img/IMG_230506_011834.jpeg'),
('0Ich7qdk4l8', '0P5qr8wdukc', 'Balaji Wafers', 'Stack Up', '80.00', 4500, '2023-01-01', '2023-12-31', '00_img/IMG_230508_014235.jpeg'),
('0Ictz3yb15o', '0Pctz4hyc1k', 'Body Soaps', 'Medimix', '60.00', 3000, '2023-05-05', '2024-09-29', '00_img/IMG_230504_020636.jpeg'),
('0Ictz42h2e8', '0P5qr8wdukc', 'Balaji Wafers', 'Chana Jor Garam', '15.00', 3455, '2022-12-31', '2023-12-31', '00_img/IMG_230508_021336.jpeg'),
('0Id6qj01if0', '0P5qr8wdukc', 'Balaji Wafers', 'Caat Chaska', '25.00', 2344, '2023-03-31', '2024-01-31', '00_img/IMG_230508_015937.jpeg'),
('0Idjhwrc6n1', '0P2wo3fd6u5', 'Daiper', 'Huggies', '400.00', 1999, '2023-01-01', '2023-12-31', '00_img/IMG_230505_023438.jpeg'),
('0Idw9b71ml8', '0P1udx9brq4', 'Biscuits', 'Maria Gold', '40.00', 1999, '2022-12-12', '2023-12-02', '00_img/IMG_230504_025039.jpeg'),
('0Idw9bcej18', '0P1udx9brq4', 'Namkin', 'All in one', '230.00', 1191, '2023-01-31', '2024-12-01', '00_img/IMG_230504_025939.jpeg'),
('0Ie90pgsqf0', '0P5qr8wdukc', 'Balaji Wafers', 'Rumbles', '10.00', 3400, '2023-03-01', '2024-01-31', '00_img/IMG_230508_015640.jpeg'),
('0Iels35poul', '0P4bpns6jzo', 'Fruit', 'Apple ðŸŽ', '65.00', 1500, '2023-05-01', '2023-05-31', '00_img/IMG_230521_102741.jpeg'),
('0Ieyjh45jmo', '0P5qr8wdukc', 'Balaji Wafers', 'Pops Ring', '20.00', 1233, '2023-01-31', '2023-12-01', '00_img/IMG_230508_021441.jpeg'),
('0Ifbav4dpuk', '0Pctz4hyc1k', 'Body Soaps', 'LifeBuoy', '55.00', 3500, '2023-01-01', '2024-10-10', '00_img/IMG_230504_020443.jpeg'),
('0Ifccfu9st', '0P2wo3fd6u5', 'Daiper', 'MamyPokoPants', '399.00', 2300, '2023-05-26', '2024-12-01', '00_img/IMG_230505_023601.jpeg'),
('0Ifcci8058', '0P5qr8wdukc', 'Balaji Wafers', 'Masala Masti', '10.00', 4000, '2023-01-31', '2023-12-01', '00_img/IMG_230508_014001.jpeg'),
('0Igdl1opjei', '0P2wo3fd6u5', 'Baby Products', 'Baby Products', '150.00', 2000, '2023-01-01', '2024-01-31', '00_img/IMG_230506_010746.jpeg'),
('0Igdl2a556i', '0P2wo3fd6u5', 'Baby Products', 'Chetapil', '500.00', 3000, '2023-01-01', '2024-03-31', '00_img/IMG_230506_014346.jpeg'),
('0Igdl2ewm3g', '0P1udx9brq4', 'Biscuits', '20-20', '10.00', 1300, '2023-01-01', '2023-06-06', '00_img/IMG_230504_025146.jpeg'),
('0Ih33ugjtr0', '0Pfcc0d02k', 'Liquid Medicine', 'Duro-tuss', '300.00', 997, '2022-12-01', '2024-12-12', '00_img/IMG_230504_023348.jpeg'),
('0Ihfv8v2eho', '0P1udx9brq4', 'Biscuits', 'Bounce', '10.00', 1100, '2023-01-01', '2023-08-08', '00_img/IMG_230504_024749.jpeg'),
('0Ihsmmsbeot', '0P2wo3fd6u5', 'Baby Sampoo', 'Gentle Baby Sampoo', '350.00', 3998, '2023-02-02', '2024-01-31', '00_img/IMG_230505_023250.jpeg'),
('0Ii5e180un0', '0P1udx9brq4', 'Biscuits', 'Good Day', '15.00', 1500, '2023-02-02', '2023-10-10', '00_img/IMG_230504_024851.jpeg'),
('0Iiuwti04os', '0P5qr8wdukc', 'Balaji Wafers', 'Simply Salted', '40.00', 4999, '2023-03-31', '2023-12-31', '00_img/IMG_230508_014453.jpeg'),
('0Ij7o7mec54', '0Pctz4hyc1k', 'oil', 'Onion Hair Oil', '250.00', 500, '2023-05-04', '2025-05-04', '00_img/IMG_230504_014154.png'),
('0Ijkflh9lzw', '0Pfcc0d02k', 'Medicine', 'Benzo', '240.00', 3000, '2023-02-02', '2024-02-23', '00_img/IMG_230504_022255.jpeg'),
('0Ijkfloet98', '0Pfcc0d02k', 'Liquid Medicine', 'NyQuil', '229.99', 1300, '2022-12-12', '2024-12-12', '00_img/IMG_230504_023455.jpeg'),
('0Ijx6zo1jvg', '0Pfcc0d02k', 'Medicine', 'Siderol', '200.00', 2000, '2023-01-02', '2024-02-03', '00_img/IMG_230504_022356.jpeg'),
('0Ijx6ztegbg', '0Pfcc0d02k', 'Liquid Medicine', 'Tylenol', '235.00', 9000, '2022-12-02', '2023-02-02', '00_img/IMG_230504_023256.jpeg'),
('0Ik9ydq20ww', '0P5qr8wdukc', 'Balaji Wafers', 'Aloo Sev', '160.00', 7653, '2023-01-31', '2024-01-31', '00_img/IMG_230508_021657.jpeg'),
('0Ik9ye9pbvg', '0P1udx9brq4', 'Biscuits', 'Nutri Choice', '69.99', 1200, '2022-12-12', '2023-06-06', '00_img/IMG_230504_024957.jpeg'),
('0Ikmpseoyuy', '0P2wo3fd6u5', 'Baby Moisturizer', 'Baby Moisturizing ', '450.00', 2349, '2023-01-01', '2024-01-01', '00_img/IMG_230506_014758.jpeg'),
('0Ikzh6g40ak', '0P5qr8wdukc', 'Balaji Wafers', 'Masala Masti', '10.00', 4000, '2023-01-31', '2023-12-01', '00_img/IMG_230508_013959.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(16) NOT NULL DEFAULT 'order_id_null',
  `f_provider_client_id` int(9) NOT NULL DEFAULT 0,
  `item_no` int(9) NOT NULL DEFAULT 0,
  `order_date` date NOT NULL DEFAULT '2001-01-01',
  `dispatch_date` date NOT NULL DEFAULT '2001-01-01',
  `delivery_date` date NOT NULL DEFAULT '2001-01-01',
  `status` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `f_provider_client_id`, `item_no`, `order_date`, `dispatch_date`, `delivery_date`, `status`) VALUES
('0O1hmieqiih', 22, 1, '2023-05-21', '2001-01-01', '2001-01-01', 0),
('0O275au2om9', 16, 1, '2023-05-21', '2023-05-21', '2023-05-23', 3),
('0O2jwp1g2k9', 22, 1, '2023-05-21', '2023-05-21', '2023-06-05', 3),
('0O5dzuew4qh', 22, 1, '2023-05-21', '2023-06-01', '2023-06-06', 3),
('0O6ga1h2xt6', 53, 1, '2023-05-10', '2023-05-10', '2023-05-09', 3),
('0O8kue81tq3', 115, 1, '2023-06-19', '2023-06-19', '2023-06-18', 3),
('0O9zvyn8q9l', 22, 1, '2023-05-21', '2023-06-01', '2023-06-15', 3),
('0O9zvyyjyrd', 77, 1, '2023-05-21', '2023-06-06', '2023-06-16', 3),
('0Ob265ajpx6', 15, 1, '2023-05-22', '2001-01-01', '2001-01-01', 0),
('0Och7qlarul', 16, 1, '2023-05-21', '2023-05-21', '2023-06-15', 3),
('0Ofo29fbptl', 77, 1, '2023-05-21', '2023-05-21', '2023-06-05', 3),
('0Oh33ue63yl', 96, 1, '2023-05-21', '2001-01-01', '2001-01-01', 0),
('0Oi5e13uthi', 23, 3, '2023-05-10', '2023-05-10', '2023-05-09', 3),
('0Oii5euk2i1', 16, 1, '2023-05-21', '2023-05-21', '2023-05-21', 3),
('0Oiuwtqc80l', 22, 3, '2023-05-21', '2001-01-01', '2001-01-01', 0),
('0Okmps857oh', 16, 1, '2023-05-21', '2023-05-21', '2023-06-15', 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `r_id` int(9) NOT NULL,
  `f_order_id` varchar(16) NOT NULL DEFAULT 'f_id_null',
  `f_item_id` varchar(16) NOT NULL DEFAULT 'f_id_null',
  `quantity` int(9) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`r_id`, `f_order_id`, `f_item_id`, `quantity`) VALUES
(11, '0Oi5e13uthi', '0I2wo36forg', 7),
(12, '0Oi5e13uthi', '0I6t1fwsdiw', 3),
(13, '0Oi5e13uthi', '0Ifbav4dpuk', 9),
(14, '0O6ga1h2xt6', '0I2wo36forg', 1),
(15, '0Och7qlarul', '0I6t1fwsdiw', 1),
(16, '0O275au2om9', '0Ifbav4dpuk', 1),
(17, '0Okmps857oh', '0I2wo36forg', 1),
(18, '0Oii5euk2i1', '0Ifbav4dpuk', 1),
(19, '0Oh33ue63yl', '0Iels35poul', 50),
(20, '0Oiuwtqc80l', '0Ik9ydq20ww', 1),
(21, '0Oiuwtqc80l', '0I9n4kmf3kw', 1),
(22, '0Oiuwtqc80l', '0Id6qj01if0', 1),
(23, '0O1hmieqiih', '0I39fhhdnvk', 1),
(24, '0O2jwp1g2k9', '0I5qr96i7uk', 1),
(25, '0O5dzuew4qh', '0Id6qj01if0', 1),
(26, '0O9zvyn8q9l', '0Ictz42h2e8', 1),
(27, '0Ofo29fbptl', '0I6t1fwsdiw', 1),
(28, '0O9zvyyjyrd', '0Ifbav4dpuk', 2),
(29, '0Ob265ajpx6', '0I5dzujnkps', 1),
(30, '0O8kue81tq3', '0I6ga19xqe4', 10);

-- --------------------------------------------------------

--
-- Table structure for table `provider_client`
--

CREATE TABLE `provider_client` (
  `r_id` int(9) NOT NULL,
  `f_provider_id` varchar(16) NOT NULL DEFAULT 'f_id_null',
  `f_client_id` varchar(16) NOT NULL DEFAULT 'f_id_null',
  `status` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `provider_client`
--

INSERT INTO `provider_client` (`r_id`, `f_provider_id`, `f_client_id`, `status`) VALUES
(1, '0Pctz4hyc1k', '0D2wo31o028', 0),
(2, '0Pfcc0d02k', '0D2wo31o028', 0),
(3, '0P1udx9brq4', '0D2wo31o028', 0),
(4, '0P2wo3fd6u5', '0D2wo31o028', 0),
(5, '0P5qr8wdukc', '0D2wo31o028', 0),
(6, '0P1udx9brq4', '0Daper65hls', 0),
(7, '0P2wo3fd6u5', '0Daper65hls', 0),
(8, '0P5qr8wdukc', '0Daper65hls', 0),
(9, '0Pctz4hyc1k', '0Daper65hls', 0),
(10, '0Pdw9akexqo', '0Daper65hls', 0),
(11, '0Pfcc0d02k', '0Daper65hls', 0),
(12, '0Daper65hls', '0Seyjgzduxc', 0),
(13, '0P1udx9brq4', '0D63imvf5kt', 0),
(14, '0P2wo3fd6u5', '0D63imvf5kt', 0),
(15, '0P5qr8wdukc', '0D63imvf5kt', 3),
(16, '0Pctz4hyc1k', '0D63imvf5kt', 3),
(17, '0Pdw9akexqo', '0D63imvf5kt', 0),
(18, '0Pfcc0d02k', '0D63imvf5kt', 0),
(19, '0D63imvf5kt', '0Seyjgzduxc', 0),
(20, '0P1udx9brq4', '0Dj7o78pd8d', 0),
(21, '0P2wo3fd6u5', '0Dj7o78pd8d', 0),
(22, '0P5qr8wdukc', '0Dj7o78pd8d', 3),
(23, '0Pctz4hyc1k', '0Dj7o78pd8d', 3),
(24, '0Pdw9akexqo', '0Dj7o78pd8d', 0),
(25, '0Pfcc0d02k', '0Dj7o78pd8d', 0),
(26, '0Dj7o78pd8d', '0Seyjgzduxc', 0),
(27, '0P1udx9brq4', '0D39fhkcttp', 0),
(28, '0P2wo3fd6u5', '0D39fhkcttp', 0),
(29, '0P5qr8wdukc', '0D39fhkcttp', 0),
(30, '0Pctz4hyc1k', '0D39fhkcttp', 0),
(31, '0Pdw9akexqo', '0D39fhkcttp', 0),
(32, '0Pfcc0d02k', '0D39fhkcttp', 0),
(33, '0D39fhkcttp', '0Seyjgzduxc', 0),
(34, '0P1udx9brq4', '0Dels32qi4d', 0),
(35, '0P2wo3fd6u5', '0Dels32qi4d', 0),
(36, '0P5qr8wdukc', '0Dels32qi4d', 0),
(37, '0Pctz4hyc1k', '0Dels32qi4d', 0),
(38, '0Pdw9akexqo', '0Dels32qi4d', 0),
(39, '0Pfcc0d02k', '0Dels32qi4d', 2),
(40, '0Dels32qi4d', '0Seyjgzduxc', 0),
(41, '0P1udx9brq4', '0Dacndh8jst', 0),
(42, '0P2wo3fd6u5', '0Dacndh8jst', 0),
(43, '0P5qr8wdukc', '0Dacndh8jst', 0),
(44, '0Pctz4hyc1k', '0Dacndh8jst', 0),
(45, '0Pdw9akexqo', '0Dacndh8jst', 0),
(46, '0Pfcc0d02k', '0Dacndh8jst', 0),
(47, '0Dacndh8jst', '0Seyjgzduxc', 0),
(48, '0D2wo31o028', '0S6t1ft7rwd', 0),
(49, '0D39fhkcttp', '0S6t1ft7rwd', 0),
(50, '0D63imvf5kt', '0S6t1ft7rwd', 3),
(51, '0Dacndh8jst', '0S6t1ft7rwd', 0),
(52, '0Dels32qi4d', '0S6t1ft7rwd', 0),
(53, '0Dj7o78pd8d', '0S6t1ft7rwd', 3),
(54, '0D2wo31o028', '0S8kueopqv1', 0),
(55, '0D39fhkcttp', '0S8kueopqv1', 0),
(56, '0D63imvf5kt', '0S8kueopqv1', 0),
(57, '0Dacndh8jst', '0S8kueopqv1', 0),
(58, '0Dels32qi4d', '0S8kueopqv1', 0),
(59, '0Dj7o78pd8d', '0S8kueopqv1', 0),
(60, '0D2wo31o028', '0Sctz4rh9q5', 0),
(61, '0D39fhkcttp', '0Sctz4rh9q5', 0),
(62, '0D63imvf5kt', '0Sctz4rh9q5', 0),
(63, '0Dacndh8jst', '0Sctz4rh9q5', 0),
(64, '0Dels32qi4d', '0Sctz4rh9q5', 0),
(65, '0Dj7o78pd8d', '0Sctz4rh9q5', 0),
(66, '0D2wo31o028', '0Sh33uuu871', 0),
(67, '0D39fhkcttp', '0Sh33uuu871', 0),
(68, '0D63imvf5kt', '0Sh33uuu871', 0),
(69, '0Dacndh8jst', '0Sh33uuu871', 0),
(70, '0Dels32qi4d', '0Sh33uuu871', 0),
(71, '0Dj7o78pd8d', '0Sh33uuu871', 0),
(72, '0D2wo31o028', '0S2kyncqd9', 0),
(73, '0D39fhkcttp', '0S2kyncqd9', 0),
(74, '0D63imvf5kt', '0S2kyncqd9', 0),
(75, '0Dacndh8jst', '0S2kyncqd9', 0),
(76, '0Dels32qi4d', '0S2kyncqd9', 0),
(77, '0Dj7o78pd8d', '0S2kyncqd9', 3),
(78, '0Pfo29pg28x', '0D2wo31o028', 0),
(79, '0Pfo29pg28x', '0D39fhkcttp', 0),
(80, '0Pfo29pg28x', '0D63imvf5kt', 0),
(81, '0Pfo29pg28x', '0Dacndh8jst', 0),
(82, '0Pfo29pg28x', '0Dels32qi4d', 0),
(83, '0Pfo29pg28x', '0Dj7o78pd8d', 3),
(84, '0D2wo31o028', '0Se90p4w2e9', 0),
(85, '0D39fhkcttp', '0Se90p4w2e9', 0),
(86, '0D63imvf5kt', '0Se90p4w2e9', 0),
(87, '0Dacndh8jst', '0Se90p4w2e9', 0),
(88, '0Dels32qi4d', '0Se90p4w2e9', 0),
(89, '0Dj7o78pd8d', '0Se90p4w2e9', 0),
(90, '0Pacndj0v5v', '0D2wo31o028', 0),
(91, '0Pacndj0v5v', '0D39fhkcttp', 0),
(92, '0Pacndj0v5v', '0D63imvf5kt', 0),
(93, '0Pacndj0v5v', '0Dacndh8jst', 0),
(94, '0Pacndj0v5v', '0Dels32qi4d', 0),
(95, '0Pacndj0v5v', '0Dj7o78pd8d', 0),
(96, '0P4bpns6jzo', '0D2wo31o028', 0),
(97, '0P4bpns6jzo', '0D39fhkcttp', 0),
(98, '0P4bpns6jzo', '0D63imvf5kt', 0),
(99, '0P4bpns6jzo', '0Dacndh8jst', 0),
(100, '0P4bpns6jzo', '0Dels32qi4d', 0),
(101, '0P4bpns6jzo', '0Dj7o78pd8d', 0),
(102, '0Phfv8ato39', '0D2wo31o028', 0),
(103, '0Phfv8ato39', '0D39fhkcttp', 0),
(104, '0Phfv8ato39', '0D63imvf5kt', 0),
(105, '0Phfv8ato39', '0Dacndh8jst', 0),
(106, '0Phfv8ato39', '0Dels32qi4d', 0),
(107, '0Phfv8ato39', '0Dj7o78pd8d', 0),
(108, '0P1udx9brq4', '0D2wo3qooiu', 0),
(109, '0P2wo3fd6u5', '0D2wo3qooiu', 0),
(110, '0P4bpns6jzo', '0D2wo3qooiu', 0),
(111, '0P5qr8wdukc', '0D2wo3qooiu', 0),
(112, '0Pacndj0v5v', '0D2wo3qooiu', 0),
(113, '0Pctz4hyc1k', '0D2wo3qooiu', 0),
(114, '0Pdw9akexqo', '0D2wo3qooiu', 0),
(115, '0Pfcc0d02k', '0D2wo3qooiu', 3),
(116, '0Pfo29pg28x', '0D2wo3qooiu', 0),
(117, '0Phfv8ato39', '0D2wo3qooiu', 0),
(118, '0D2wo3qooiu', '0S2kyncqd9', 0),
(119, '0D2wo3qooiu', '0S6t1ft7rwd', 0),
(120, '0D2wo3qooiu', '0S8kueopqv1', 0),
(121, '0D2wo3qooiu', '0Sctz4rh9q5', 0),
(122, '0D2wo3qooiu', '0Se90p4w2e9', 0),
(123, '0D2wo3qooiu', '0Seyjgzduxc', 0),
(124, '0D2wo3qooiu', '0Sh33uuu871', 0),
(125, '0D2wo31o028', '0Saperj9a3q', 0),
(126, '0D2wo3qooiu', '0Saperj9a3q', 0),
(127, '0D39fhkcttp', '0Saperj9a3q', 0),
(128, '0D63imvf5kt', '0Saperj9a3q', 0),
(129, '0Dacndh8jst', '0Saperj9a3q', 0),
(130, '0Dels32qi4d', '0Saperj9a3q', 0),
(131, '0Dj7o78pd8d', '0Saperj9a3q', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(16) NOT NULL DEFAULT 'user_id_null',
  `type` enum('producer','distributor','seller') NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'name_null',
  `address` text NOT NULL DEFAULT 'address_null',
  `email` varchar(255) NOT NULL DEFAULT 'email_null',
  `password` varchar(255) NOT NULL DEFAULT 'password_null'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `type`, `name`, `address`, `email`, `password`) VALUES
('0D2wo31o028', 'distributor', 'Dist', 'Bhatar, Surat', 'dist@email.com', 'c6423c80b7062c051ea44c4f7d5662d1'),
('0D2wo3qooiu', 'distributor', 'Kunj Patel (D)', 'Althan, Surat', 'kunjd26@hotmail.com', '5027240d7b029ffc77bd637351f2a452'),
('0D39fhkcttp', 'distributor', 'Distributor3', '34, puna talav near diplop hospital, surat', 'dist3@gmail.com', '22dd936a669e8d2bedc76e46ae9fef84'),
('0D63imvf5kt', 'distributor', 'Distributor1', '357 Sahjanad complex, near kapodra Surat', 'dist1@gmail.com', '9171ba1eda1e4f56d9d678e769d0b024'),
('0Dacndh8jst', 'distributor', 'Distributor5', '29, shree soc. Juna nagar surat', 'dist5@gmail.com', '34eb88bb323e0be93aa00f8c2a3d275d'),
('0Dels32qi4d', 'distributor', 'Distributor4', '64/Vr mall Vesu, Surat', 'dist4@gmail.com', 'ff447ed9b4c1584c48ea1a03fe95a22f'),
('0Dj7o78pd8d', 'distributor', 'Distributor2', 'A-3 4th floor, Drd badroad , surat', 'dist2@gmail.com', '937149fbae4b00aaf1cd8ca7d2d06ab3'),
('0P1udx9brq4', 'producer', 'Producer3', '32, Taj complex, near Shyam Mandir', 'prod3@gmail.com', '19431b59abb785f69bca9a0a9ff42fef'),
('0P2wo3fd6u5', 'producer', 'Producer4', '57, Reliance mall, Udhna Surat', 'prod4@gmail.com', '6cb25f274f4fdc940a79b2784414f601'),
('0P4bpns6jzo', 'producer', 'Kunj Patel (P)', 'Althan, Surat', 'kunjd25@hotmail.com', '5027240d7b029ffc77bd637351f2a452'),
('0P5qr8wdukc', 'producer', 'Producer5', '45, Shiv Sakti Complex,  VIP road.', 'prod5@gmail.com', '231588c6a568ed7cef1b4fc55ef4e2a3'),
('0Pacndj0v5v', 'producer', 'producer1006', 'kawas,surat', 'hinalbpatel1006@gmail.com', 'a59d67005239a865f2622cfc50e9140a'),
('0Pctz4hyc1k', 'producer', 'Producer1', '295, shreenathji soc. Punagam surat', 'prod1@gmail.com', '3a712cc033f1dfe243c0453733d6a841'),
('0Pdw9akexqo', 'producer', 'Prod', 'Udhana, Surat', 'prod@email.com', 'a2a04736c9b00a27f3ccc09899e6a6aa'),
('0Pfcc0d02k', 'producer', 'Producer2', '357 DR world,  PUNA PATIYA RING ROAD.', 'prod2@gmail.com', '416fb2d799473a61a2d48199576c3722'),
('0Pfo29pg28x', 'producer', 'producer2', 'kawas,Surat', 'producer2@email.com', '2d647c677b5745377b8581a00d74067e'),
('0Phfv8ato39', 'producer', 'Vishal Sharat Jena', '295, shreenathji soc. Punagam surat', 'vishal1713vsl@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759'),
('0S2kyncqd9', 'seller', 'Seller5', '98, nathji soc. Punanagar ,surat', 'sell5@gmail.com', 'b7e1edc0d0df8ea7ecfd84ff6b88ffb9'),
('0S6t1ft7rwd', 'seller', 'Seller1', '1, Mahalaxmi store, rachna road, surat', 'sell1@gmail.com', '57646be110cb9d4c4079ac2f7433df13'),
('0S8kueopqv1', 'seller', 'Seller2', '43, RadheShyam Dukaan, near Ambaji ', 'sell2@gmail.com', '4cce78da45e526de70a3d9a1d0807568'),
('0Saperj9a3q', 'seller', 'Kunj Patel (S)', 'Althan, Surat', 'kunjd27@hotmail.com', '5027240d7b029ffc77bd637351f2a452'),
('0Sctz4rh9q5', 'seller', 'Seller3', '432, Parth Store, Vallbh nagar, near canal', 'sell3@gmail.com', 'b23fc00f2f5044399a727dd8e8beff1b'),
('0Se90p4w2e9', 'seller', 'Seller2', 'Kawas,surat', 'seller2@email.com', 'b2e1d81507e80fe0de69f906ee98edcb'),
('0Seyjgzduxc', 'seller', 'Sell', 'Adajan, Surat', 'sell@email.com', '3b511c8a9ac65017497796300c2c4ac1'),
('0Sh33uuu871', 'seller', 'Seller4', 'A-45 , SwamiNarayan Store, 1st floor near Athva bridge, surat', 'sell4@gmail.com', 'e6b066881475d5454963e22b37f958d7');

-- --------------------------------------------------------

--
-- Table structure for table `user_amount`
--

CREATE TABLE `user_amount` (
  `r_id` int(9) NOT NULL,
  `f_user_id` varchar(16) NOT NULL DEFAULT 'f_id_null',
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `user_amount`
--

INSERT INTO `user_amount` (`r_id`, `f_user_id`, `amount`) VALUES
(24, '0Pdw9akexqo', '5000.00'),
(25, '0D2wo31o028', '5000.00'),
(26, '0Seyjgzduxc', '5000.00'),
(27, '0Pctz4hyc1k', '6014.99'),
(28, '0Pfcc0d02k', '7300.00'),
(29, '0P1udx9brq4', '5000.00'),
(30, '0P2wo3fd6u5', '5000.00'),
(31, '0P5qr8wdukc', '5050.00'),
(32, '0Daper65hls', '5000.00'),
(33, '0D63imvf5kt', '4755.01'),
(34, '0Dj7o78pd8d', '4355.00'),
(35, '0D39fhkcttp', '5000.00'),
(36, '0Dels32qi4d', '5000.00'),
(37, '0Dacndh8jst', '5000.00'),
(38, '0S6t1ft7rwd', '4980.00'),
(39, '0S8kueopqv1', '5000.00'),
(40, '0Sctz4rh9q5', '5000.00'),
(41, '0Sh33uuu871', '5000.00'),
(42, '0S2kyncqd9', '4845.00'),
(43, '0Pfo29pg28x', '5000.00'),
(44, '0Se90p4w2e9', '5000.00'),
(45, '0Pacndj0v5v', '5000.00'),
(46, '0P4bpns6jzo', '5000.00'),
(47, '0Phfv8ato39', '5000.00'),
(48, '0D2wo3qooiu', '2700.00'),
(49, '0Saperj9a3q', '5000.00');

-- --------------------------------------------------------

--
-- Table structure for table `user_item`
--

CREATE TABLE `user_item` (
  `r_id` int(9) NOT NULL,
  `f_user_id` varchar(16) NOT NULL DEFAULT 'f_user_id_null',
  `f_item_id` varchar(16) NOT NULL DEFAULT 'f_item_id_null',
  `quantity` int(9) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `user_item`
--

INSERT INTO `user_item` (`r_id`, `f_user_id`, `f_item_id`, `quantity`) VALUES
(9, '0Pctz4hyc1k', '0Ij7o7mec54', 500),
(10, '0Pctz4hyc1k', '0I3yya9tdo8', 999),
(11, '0Pctz4hyc1k', '0I518gtjrp4', 698),
(12, '0Pctz4hyc1k', '0I14v4yr1x4', 100),
(13, '0Pctz4hyc1k', '0I6t1fwsdiw', 4995),
(14, '0Pctz4hyc1k', '0I9ad64xct8', 3999),
(15, '0Pctz4hyc1k', '0Iacnco2b8c', 1998),
(16, '0Pctz4hyc1k', '0Ifbav4dpuk', 3489),
(17, '0Pctz4hyc1k', '0Ictz3yb15o', 3000),
(18, '0Pctz4hyc1k', '0I2wo36forg', 9991),
(19, '0Pfcc0d02k', '0Ijkflh9lzw', 3000),
(20, '0Pfcc0d02k', '0Ijx6zo1jvg', 2000),
(21, '0Pfcc0d02k', '0I39fhmqkbg', 1500),
(22, '0Pfcc0d02k', '0I6t1fd52n0', 1199),
(23, '0Pfcc0d02k', '0I9ad6l0258', 2000),
(24, '0Pfcc0d02k', '0I6ga19xqe4', 1990),
(25, '0Pfcc0d02k', '0Ijx6ztegbg', 9000),
(26, '0Pfcc0d02k', '0Ih33ugjtr0', 997),
(27, '0Pfcc0d02k', '0Ijkfloet98', 1300),
(28, '0Pfcc0d02k', '0I6ga1famu4', 2398),
(29, '0Pfcc0d02k', '0I63in9pk64', 2000),
(30, '0P1udx9brq4', '0Ihfv8v2eho', 1100),
(31, '0P1udx9brq4', '0Ii5e180un0', 1500),
(32, '0P1udx9brq4', '0Ik9ye9pbvg', 1200),
(33, '0P1udx9brq4', '0Idw9b71ml8', 1999),
(34, '0P1udx9brq4', '0Igdl2ewm3g', 1300),
(35, '0P1udx9brq4', '0Iaperolxcs', 2498),
(36, '0P1udx9brq4', '0I63ingurfg', 2299),
(37, '0P1udx9brq4', '0Ibroya4m70', 1200),
(38, '0P1udx9brq4', '0Ib265yd198', 2300),
(39, '0P1udx9brq4', '0Idw9bcej18', 1191),
(40, '0P1udx9brq4', '0I9zvyhadfk', 1128),
(41, '0P1udx9brq4', '0I3m6vemo5c', 3500),
(42, '0P2wo3fd6u5', '0Ihsmmsbeot', 3998),
(43, '0P2wo3fd6u5', '0Idjhwrc6n1', 1999),
(44, '0P2wo3fd6u5', '0Ifccfu9st', 2300),
(45, '0P2wo3fd6u5', '0Igdl1opjei', 2000),
(46, '0P2wo3fd6u5', '0Igqcfxv7p6', 2259),
(47, '0P2wo3fd6u5', '0Igqcfxv7p6', 2259),
(48, '0P2wo3fd6u5', '0Ic4gbt37sq', 1200),
(49, '0P2wo3fd6u5', '0Ich7pz9q2i', 1200),
(50, '0P2wo3fd6u5', '0Igdl2a556i', 3000),
(51, '0P2wo3fd6u5', '0Ikmpseoyuy', 2349),
(52, '0P2wo3fd6u5', '0I8xlssiipm', 3500),
(53, '0P2wo3fd6u5', '0I8xlssiipm', 3500),
(54, '0P2wo3fd6u5', '0I3yy9yi56k', 3000),
(55, '0P2wo3fd6u5', '0I4bpo4ongc', 3000),
(56, '0P2wo3fd6u5', '0I1hmiru0vw', 2399),
(57, '0P5qr8wdukc', '0Ikzh6g40ak', 4000),
(58, '0P5qr8wdukc', '0Ifcci8058', 4000),
(59, '0P5qr8wdukc', '0I4bpoet0qk', 300),
(60, '0P5qr8wdukc', '0Ich7qdk4l8', 4500),
(61, '0P5qr8wdukc', '0Iiuwti04os', 4999),
(62, '0P5qr8wdukc', '0I5qr96i7uk', 6998),
(63, '0P5qr8wdukc', '0Ibroy46a2k', 9998),
(64, '0P5qr8wdukc', '0Ie90pgsqf0', 3400),
(65, '0P5qr8wdukc', '0Id6qj01if0', 2343),
(66, '0P5qr8wdukc', '0Ibroxc6wps', 10000),
(67, '0P5qr8wdukc', '0I518g9wgtc', 3454),
(68, '0P5qr8wdukc', '0Ictz42h2e8', 3454),
(69, '0P5qr8wdukc', '0Ieyjh45jmo', 1233),
(70, '0P5qr8wdukc', '0I39fhhdnvk', 9875),
(71, '0P5qr8wdukc', '0Ik9ydq20ww', 7653),
(72, '0P5qr8wdukc', '0I5dzujnkps', 7890),
(73, '0P5qr8wdukc', '0I9n4kmf3kw', 4565),
(74, '0Pfo29pg28x', '0I1hmih485h', 10),
(75, '0Dj7o78pd8d', '0I2wo36forg', 6),
(76, '0Dj7o78pd8d', '0I6t1fwsdiw', 2),
(77, '0Dj7o78pd8d', '0Ifbav4dpuk', 7),
(78, '0S6t1ft7rwd', '0I2wo36forg', 1),
(79, '0Phfv8ato39', '0I4bpo4onul', 9876),
(80, '0D63imvf5kt', '0Ifbav4dpuk', 2),
(81, '0P4bpns6jzo', '0Iels35poul', 1500),
(82, '0D63imvf5kt', '0I2wo36forg', 1),
(83, '0D63imvf5kt', '0I6t1fwsdiw', 1),
(84, '0Dj7o78pd8d', '0I5qr96i7uk', 1),
(85, '0Dj7o78pd8d', '0Ictz42h2e8', 1),
(86, '0Dj7o78pd8d', '0Id6qj01if0', 1),
(87, '0S2kyncqd9', '0Ifbav4dpuk', 2),
(88, '0S2kyncqd9', '0I6t1fwsdiw', 1),
(89, '0D2wo3qooiu', '0I6ga19xqe4', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `producer_id_foreign_key` (`f_producer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `provider_client_id_foreign_key` (`f_provider_client_id`) USING BTREE;

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `order_id_foreign_key` (`f_order_id`),
  ADD KEY `item_id_foreign_key` (`f_item_id`) USING BTREE;

--
-- Indexes for table `provider_client`
--
ALTER TABLE `provider_client`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `provider_id_foreign_key` (`f_provider_id`),
  ADD KEY `client_id_foreign_key` (`f_client_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_amount`
--
ALTER TABLE `user_amount`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `user_id_foreign_key_1` (`f_user_id`);

--
-- Indexes for table `user_item`
--
ALTER TABLE `user_item`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `user_id_foreign_key` (`f_user_id`),
  ADD KEY `item_id_foreign_key` (`f_item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `r_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `provider_client`
--
ALTER TABLE `provider_client`
  MODIFY `r_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `user_amount`
--
ALTER TABLE `user_amount`
  MODIFY `r_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user_item`
--
ALTER TABLE `user_item`
  MODIFY `r_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `producer_id_foreign_key` FOREIGN KEY (`f_producer_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `provider_client_foreign_key` FOREIGN KEY (`f_provider_client_id`) REFERENCES `provider_client` (`r_id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_id_foreign_key` FOREIGN KEY (`f_order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `temp` FOREIGN KEY (`f_item_id`) REFERENCES `items` (`item_id`);

--
-- Constraints for table `provider_client`
--
ALTER TABLE `provider_client`
  ADD CONSTRAINT `client_id_foreign_key` FOREIGN KEY (`f_client_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `provider_id_foreign_key` FOREIGN KEY (`f_provider_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_amount`
--
ALTER TABLE `user_amount`
  ADD CONSTRAINT `user_id_foreign_key_1` FOREIGN KEY (`f_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_item`
--
ALTER TABLE `user_item`
  ADD CONSTRAINT `item_id_foreign_key` FOREIGN KEY (`f_item_id`) REFERENCES `items` (`item_id`),
  ADD CONSTRAINT `user_id_foreign_key` FOREIGN KEY (`f_user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
