-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2020 at 08:06 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azzury`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_admins`
--

CREATE TABLE `menu_admins` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_admins`
--

INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(1, NULL, 'Dashboard', 'Dashboard', 'index', 'kt-menu__link-icon flaticon-line-graph', 9, 10);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(2, 5, 'Access Control', '', '', 'kt-menu__link-bullet kt-menu__link-bullet--line', 74, 80);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(3, 2, 'Users', 'Users', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 75, 79);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(4, 2, 'Groups', 'Groups', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 77, 78);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(5, NULL, 'Configurations', '', '', 'kt-menu__link-icon flaticon-settings', 73, 93);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(14, 5, 'Menu Admin', 'MenuAdmins', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 81, 82);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(25, 5, 'Products Config', '', '', 'kt-menu__link-bullet kt-menu__link-bullet--line', 83, 90);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(26, 25, 'Werehouse', 'Suppliers', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 84, 85);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(27, 25, 'Products', 'Products', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 86, 87);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(28, 25, 'Product Unit', 'ProductUnits', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 88, 89);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(30, NULL, 'Customers', '', '', 'kt-menu__link-icon  flaticon-list-2', 35, 42);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(31, 30, 'Request Activations', 'Activations', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 36, 37);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(33, NULL, 'Income & Mutations', '', '', 'kt-menu__link-icon   flaticon-suitcase', 53, 58);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(34, 30, 'List Customers', 'Customers', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 38, 39);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(35, 33, 'List Bonuses', 'TransactionMutations', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 54, 55);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(36, 33, 'List Withdrawals', 'Withdrawals', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 56, 57);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(44, 30, 'List Testimonial', 'Testimonials', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 40, 41);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(45, 5, 'Zone Config', 'Provinces', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 91, 92);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(46, NULL, 'Products', '', '', 'kt-menu__link-icon flaticon-cart', 43, 52);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(47, 46, 'Order Products', 'Orders', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 44, 45);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(48, 46, 'Product Stocks', 'ProductStocks', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 46, 47);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(49, 46, 'Product Stock Mutations', 'ProductStockMutations', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 48, 49);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(50, NULL, 'Event Training', '', '', 'kt-menu__link-icon flaticon-calendar', 59, 64);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(51, 50, 'List Event Training', 'Events', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 60, 61);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(52, 50, 'Event Participants', 'Events', 'attendance', 'kt-menu__link-bullet kt-menu__link-bullet--line', 62, 63);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(53, NULL, 'Reports', '', '', 'kt-menu__link-icon flaticon-graph', 65, 72);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(54, 53, 'Total Sales', 'Reports', 'sales', 'kt-menu__link-bullet kt-menu__link-bullet--line', 66, 67);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(55, 53, 'Sales Users', 'Reports', 'salesby', 'kt-menu__link-bullet kt-menu__link-bullet--line', 68, 69);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(56, 53, 'Income Reports', 'Reports', 'bonus', 'kt-menu__link-bullet kt-menu__link-bullet--line', 70, 71);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(57, 46, 'Product Serials', 'Cards', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 50, 51);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(58, NULL, 'CMS', '', '', 'kt-menu__link-icon flaticon-file-2', 11, 34);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(59, 58, 'Pages', 'Pages', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 12, 13);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(60, 58, 'Blog', 'Blogs', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 14, 21);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(61, 60, 'Topic', 'Topics', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 15, 16);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(62, 60, 'Tag', 'Tags', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 17, 18);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(63, 60, 'Blog', 'Blogs', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 19, 20);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(64, 58, 'Frequently Asked Questions', 'Faqs', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 22, 27);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(65, 64, 'FAQ Categories', 'FaqCategories', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 23, 24);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(66, 64, 'Frequently Asked Questions', 'Faqs', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 25, 26);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(67, 58, 'Galleries', 'Galleries', 'Index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 28, 33);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(68, 67, 'Albums', 'Galleries', 'album', 'kt-menu__link-bullet kt-menu__link-bullet--line', 29, 30);
INSERT INTO `menu_admins` (`id`, `parent_id`, `name`, `controller`, `action`, `icon`, `lft`, `rght`) VALUES(69, 67, 'Galleries', 'Galleries', 'index', 'kt-menu__link-bullet kt-menu__link-bullet--line', 31, 32);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_admins`
--
ALTER TABLE `menu_admins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_admins`
--
ALTER TABLE `menu_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
