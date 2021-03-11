-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2019 at 02:02 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tennis_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `suz_action_logs`
--

CREATE TABLE `suz_action_logs` (
  `id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suz_action_logs`
--

INSERT INTO `suz_action_logs` (`id`, `record_id`, `user_id`, `controller`, `action`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'media', 'added', '2019-10-15 13:13:34', '2019-10-15 13:13:34'),
(2, 1, 1, 'media', 'deleted', '2019-10-15 13:28:38', '2019-10-15 13:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `suz_categories`
--

CREATE TABLE `suz_categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `description` tinytext,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suz_contact_us`
--

CREATE TABLE `suz_contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suz_contact_us`
--

INSERT INTO `suz_contact_us` (`id`, `name`, `email`, `phone_number`, `message`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Rahul Naik', 'rahulnaik@yopmail.com', '9865321245', 'tes fgdfgdgfgdg', 1, '2019-10-15 12:08:55', '2019-10-15 12:08:55'),
(2, 'Shailesh', 'shailesh@yopmail.com', '9865321245', 'sfdf df sdf sd sfdfdsf', 0, '2019-10-15 12:09:45', '2019-10-15 12:09:45'),
(3, 'Shailesh', 'shailesh@yopmail.com', '9595273980', 'Commenting on the growth trajectory, Mr. Devashish Handa, Vice President, Suzuki Motorcycle India Pvt. Ltd., said, “SMIPL continues the growth momentum, despite the significant short-term impact of floods in the strong Suzuki markets such as Kerala and Maharashtra, and the ongoing continuous industry decline for the 10th month in succession. Weak consumer sentiments have been one of the key reasons for the downward trend in the auto industry.  Even under these challenging times, SMIPL has been able to prove its mettle.“', 0, '2019-10-15 12:41:48', '2019-10-15 12:41:48'),
(4, 'Shailesh', 'shailesh@yopmail.com', '9595273980', 'Commenting on the growth trajectory, Mr. Devashish Handa, Vice President, Suzuki Motorcycle India Pvt. Ltd., said, “SMIPL continues the growth momentum, despite the significant short-term impact of floods in the strong Suzuki markets such as Kerala and Maharashtra, and the ongoing continuous industry decline for the 10th month in succession. Weak consumer sentiments have been one of the key reasons for the downward trend in the auto industry.  Even under these challenging times, SMIPL has been able to prove its mettle.“', 0, '2019-10-15 12:42:02', '2019-10-15 12:42:02'),
(5, 'Rahul Naik', 'rahulnaik@yopmail.com', '9865321245', 'Commenting on the growth trajectory, Mr. Devashish Handa, Vice President, Suzuki Motorcycle India Pvt. Ltd., said, “SMIPL continues the growth momentum, despite the significant short-term impact of floods in the strong Suzuki markets such as Kerala and Maharashtra, and the ongoing continuous industry decline for the 10th month in succession. Weak consumer sentiments have been one of the key reasons for the downward trend in the auto industry.', 0, '2019-10-15 12:45:02', '2019-10-15 12:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `suz_general_settings`
--

CREATE TABLE `suz_general_settings` (
  `id` int(11) NOT NULL,
  `group` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0=>In-active, 1=> Active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suz_media_images`
--

CREATE TABLE `suz_media_images` (
  `id` int(11) NOT NULL,
  `group_type` varchar(20) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suz_menus`
--

CREATE TABLE `suz_menus` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(155) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `page_id` int(11) NOT NULL,
  `menu_order` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suz_menus`
--

INSERT INTO `suz_menus` (`id`, `group_id`, `parent_id`, `name`, `slug`, `page_id`, `menu_order`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Home', 'home', 1, 1, 0, 0, '2019-10-14 11:21:49', '2019-11-12 05:44:35'),
(2, 1, 0, 'About Us', 'about-us', 2, 2, 1, 0, '2019-10-14 11:22:01', '2019-10-15 05:46:18'),
(3, 1, 0, 'Centers', 'centers', 3, 3, 1, 0, '2019-10-14 11:22:08', '2019-10-15 05:46:06'),
(4, 1, 0, 'Membership', 'membership', 4, 4, 1, 0, '2019-10-14 11:22:22', '2019-10-15 05:44:33'),
(5, 1, 0, 'Training Program', 'training-program', 5, 5, 1, 0, '2019-10-14 11:23:06', '2019-10-15 05:44:41'),
(6, 1, 0, 'Contact Us', 'contact-us', 6, 6, 1, 0, '2019-10-14 11:23:16', '2019-10-15 05:44:47'),
(7, 1, 3, 'Club 5', 'club-5', 7, 0, 1, 0, '2019-10-15 06:13:59', '2019-10-15 07:57:54'),
(8, 1, 3, 'Club Vita', 'club-vita', 8, 0, 1, 0, '2019-10-15 06:14:13', '2019-10-15 07:58:04'),
(9, 1, 3, 'Crest Club', 'crest-club', 9, 0, 1, 0, '2019-10-15 06:14:28', '2019-10-15 10:19:25'),
(10, 1, 4, 'Kids', 'kids', 10, 0, 1, 0, '2019-10-15 07:50:51', '2019-10-15 07:58:56'),
(11, 1, 4, 'Adults', 'adults', 11, 0, 1, 0, '2019-10-15 07:51:07', '2019-10-15 07:59:03'),
(12, 1, 4, 'Professional', 'professional', 12, 0, 1, 0, '2019-10-15 07:51:19', '2019-10-15 07:59:37'),
(13, 1, 5, 'Progressive', 'progressive', 13, 0, 1, 0, '2019-10-15 07:51:47', '2019-10-15 07:59:50'),
(14, 1, 5, 'Beginner', 'beginner', 14, 0, 1, 0, '2019-10-15 07:51:56', '2019-10-15 07:59:57'),
(15, 1, 5, 'Intermediate', 'intermediate', 15, 0, 1, 0, '2019-10-15 07:52:06', '2019-10-15 08:00:08'),
(16, 1, 5, 'Advance', 'advance', 16, 0, 1, 0, '2019-10-15 07:52:15', '2019-10-15 10:59:46'),
(17, 1, 5, 'Personalized Coaching', 'personalized-coaching', 17, 0, 1, 0, '2019-10-15 07:52:26', '2019-10-15 08:12:46'),
(18, 4, 0, 'About Us', 'about-us-1', 2, 0, 1, 0, '2019-11-12 10:33:38', '2019-11-12 10:33:38'),
(19, 4, 0, 'Contact Us', 'contact-us-1', 6, 0, 1, 0, '2019-11-12 10:35:42', '2019-11-12 10:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `suz_modules`
--

CREATE TABLE `suz_modules` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `fa_icon` varchar(50) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `has_sub_menu` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `is_visible` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 => False, 1 => True',
  `is_action` tinyint(2) NOT NULL DEFAULT '0',
  `allowed_user_roles` varchar(30) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0=>In-active, 1=> Active	',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `order_by` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suz_modules`
--

INSERT INTO `suz_modules` (`id`, `parent_id`, `name`, `fa_icon`, `controller`, `action`, `has_sub_menu`, `is_visible`, `is_action`, `allowed_user_roles`, `status`, `is_deleted`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 0, 'Dashboard', 'fa fa-dashboard', 'dashboard', NULL, 0, 1, 0, '0', 1, 0, 1, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(2, 0, 'Media', 'fa fa-file-image-o', 'media', NULL, 0, 1, 0, '0', 1, 0, 2, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(3, 0, 'Menus', 'fa fa-bars', 'menu', NULL, 1, 1, 0, '0', 1, 0, 3, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(4, 0, 'Posts', 'fa fa-thumb-tack', 'post', NULL, 1, 1, 0, '0', 1, 0, 4, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(5, 4, 'All Posts', 'fa fa-circle-o', 'post', NULL, 0, 1, 0, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(6, 4, 'Add New', 'fa fa-circle-o', 'post', 'add', 0, 1, 1, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(7, 4, 'Edit', 'fa fa-circle-o', 'post', 'edit', 0, 0, 1, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(8, 4, 'Delete', 'fa fa-circle-o', 'post', 'delete', 0, 0, 1, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(9, 4, 'Categories', 'fa fa-circle-o', 'post', 'category', 0, 1, 0, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(16, 0, 'Pages', 'fa fa-file-text-o', 'page', NULL, 1, 1, 0, '0', 1, 0, 9, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(17, 16, 'All Pages', 'fa fa-circle-o', 'page', NULL, 0, 1, 0, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(18, 16, 'Add New', 'fa fa-circle-o', 'page', 'add', 0, 1, 0, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(19, 16, 'Edit', 'fa fa-circle-o', 'page', 'edit', 0, 0, 0, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(20, 16, 'Delete', 'fa fa-circle-o', 'page', 'delte', 0, 0, 0, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(69, 0, 'User Management', 'fa fa-thumb-tack', 'user-management', NULL, 1, 1, 0, '0', 1, 0, 13, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(70, 0, 'User Role', 'fa fa-id-badge', 'user-role', NULL, 0, 1, 0, '0', 1, 0, 15, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(71, 0, 'User Permission', 'fa fa-snowflake-o', 'user-permission', NULL, 1, 1, 0, '0', 1, 0, 14, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(78, 0, 'General Settings', 'fa fa-cog', 'general-settings', NULL, 0, 0, 0, '0', 1, 0, 16, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(79, 71, 'Edit', 'fa fa-thumb-tack', 'user-permission', 'edit', 0, 0, 0, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(80, 0, 'Action Log', 'fa fa-thumb-tack', 'action-logs', 'history', 0, 0, 0, '0', 1, 0, 18, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(81, 71, 'View All', 'fa fa-thumb-tack', 'user-permission', NULL, 0, 1, 0, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(82, 69, 'View All', 'fa fa-circle-o', 'user-management', NULL, 0, 1, 0, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(83, 69, 'Add New', 'fa fa-circle-o', 'user-management', 'add', 0, 1, 1, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(84, 69, 'Edit', 'fa fa-circle-o', 'user-management', 'edit', 0, 0, 1, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(85, 69, 'Delete', 'fa fa-circle-o', 'user-management', 'delete', 0, 0, 1, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(117, 0, 'Sliders', 'fa fa-sliders', 'slider', NULL, 1, 0, 0, '0', 1, 0, 10, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(118, 117, 'All Sliders', 'fa fa-circle-o', 'slider', NULL, 0, 1, 0, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(119, 117, 'Add New', 'fa fa-circle-o', 'slider', 'add', 0, 1, 1, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(120, 117, 'Edit', 'fa fa-circle-o', 'slider', 'edit', 0, 0, 1, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(121, 117, 'Delete', 'fa fa-circle-o', 'slider', 'delete', 0, 0, 1, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(122, 117, 'Slider Images', 'fa fa-circle-o', 'slider-images', NULL, 0, 0, 0, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(124, 3, 'All Menus', 'fa fa-circle-o', 'menu', NULL, 0, 1, 0, '0', 1, 0, 0, '2019-10-14 00:00:00', '2019-10-14 00:00:00'),
(125, 3, 'Add New', 'fa fa-circle-o', 'menu', 'add', 0, 1, 1, '0', 1, 0, 0, '2019-10-14 00:00:00', '2019-10-14 00:00:00'),
(126, 3, 'Edit', 'fa fa-circle-o', 'menu', 'edit', 0, 0, 1, '0', 1, 0, 0, '2019-10-14 00:00:00', '2019-10-14 00:00:00'),
(127, 3, 'Delete', 'fa fa-circle-o', 'menu', 'delete', 0, 0, 1, '0', 1, 0, 0, '2019-10-14 00:00:00', '2019-10-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `suz_news`
--

CREATE TABLE `suz_news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `short_description` text,
  `content` longtext,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0',
  `publish_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suz_news_gallery`
--

CREATE TABLE `suz_news_gallery` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suz_pages`
--

CREATE TABLE `suz_pages` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `content` longtext,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `meta_keywords` text,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suz_pages`
--

INSERT INTO `suz_pages` (`id`, `title`, `slug`, `content`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'home', NULL, NULL, NULL, NULL, 1, 0, '2019-10-15 05:43:21', '2019-10-15 05:43:21'),
(2, 'About Us', 'about-us', NULL, NULL, NULL, NULL, 1, 0, '2019-10-15 05:43:29', '2019-10-15 05:43:29'),
(3, 'Centers', 'centers', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 05:43:36', '2019-11-12 12:22:19'),
(4, 'Membership', 'membership', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 05:43:45', '2019-11-12 12:22:13'),
(5, 'Training Program', 'training-program', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 05:43:57', '2019-11-12 12:22:07'),
(6, 'Contact Us', 'contact-us', NULL, NULL, NULL, NULL, 1, 0, '2019-10-15 05:44:07', '2019-10-15 05:44:07'),
(7, 'Club 5', 'club-5', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 07:55:29', '2019-11-12 11:47:08'),
(8, 'Club Vita', 'club-vita', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 07:55:40', '2019-11-12 12:21:53'),
(9, 'Crest Club', 'crest-club', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 07:55:50', '2019-11-12 12:21:47'),
(10, 'Kids', 'kids', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 07:55:54', '2019-11-12 12:21:41'),
(11, 'Adults', 'adults', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 07:56:02', '2019-11-12 12:21:00'),
(12, 'Professional', 'professional', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 07:56:15', '2019-11-12 12:21:30'),
(13, 'Progressive', 'progressive', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 07:56:40', '2019-11-12 12:20:53'),
(14, 'Beginner', 'beginner', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 07:56:45', '2019-11-12 12:20:44'),
(15, 'Intermediate', 'intermediate', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 07:56:50', '2019-11-12 12:23:07'),
(16, 'Advance', 'advance', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 07:56:56', '2019-11-12 12:20:36'),
(17, 'Personalized Coaching', 'personalized-coaching', '<div class=\"js-generator-output page-generator__output\" id=\"output\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra maecenas accumsan lacus vel facilisis volutpat est velit. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. At risus viverra adipiscing at in tellus integer. Purus ut faucibus pulvinar elementum integer enim neque volutpat. A diam sollicitudin tempor id eu nisl. Amet commodo nulla facilisi nullam vehicula ipsum a arcu. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Quis ipsum suspendisse ultrices gravida dictum. Tincidunt dui ut ornare lectus sit. Mi bibendum neque egestas congue quisque. Integer feugiat scelerisque varius morbi enim nunc. Gravida quis blandit turpis cursus. Ultrices eros in cursus turpis massa tincidunt.</p>\r\n\r\n<p>Feugiat in fermentum posuere urna nec tincidunt praesent semper. Et molestie ac feugiat sed lectus. Aliquam malesuada bibendum arcu vitae elementum curabitur. Est velit egestas dui id ornare. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Quis imperdiet massa tincidunt nunc pulvinar. In nisl nisi scelerisque eu ultrices vitae auctor eu. Mattis nunc sed blandit libero volutpat. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. In aliquam sem fringilla ut morbi. Turpis egestas maecenas pharetra convallis. Dolor sit amet consectetur adipiscing elit ut aliquam purus sit. Amet nulla facilisi morbi tempus iaculis urna id. Vel pharetra vel turpis nunc eget. Aenean et tortor at risus viverra adipiscing at in tellus. Enim nunc faucibus a pellentesque sit amet porttitor eget. Eu tincidunt tortor aliquam nulla facilisi cras fermentum. Eget dolor morbi non arcu risus quis varius quam.</p>\r\n\r\n<p>Non diam phasellus vestibulum lorem. Sed tempus urna et pharetra. Magna etiam tempor orci eu lobortis elementum nibh. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. Ornare massa eget egestas purus viverra. Aliquam nulla facilisi cras fermentum odio. Tortor condimentum lacinia quis vel eros. In tellus integer feugiat scelerisque varius morbi. Augue neque gravida in fermentum et. Odio euismod lacinia at quis. Tincidunt eget nullam non nisi est sit amet. Urna molestie at elementum eu facilisis. Nulla facilisi cras fermentum odio eu feugiat pretium. Euismod lacinia at quis risus sed. Pharetra magna ac placerat vestibulum lectus mauris ultrices. Justo donec enim diam vulputate ut pharetra sit. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat sed lectus vestibulum mattis ullamcorper. Diam phasellus vestibulum lorem sed.</p>\r\n</div>', NULL, NULL, NULL, 1, 0, '2019-10-15 07:57:05', '2019-11-12 12:20:31');

-- --------------------------------------------------------

--
-- Table structure for table `suz_permissions`
--

CREATE TABLE `suz_permissions` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0=>In-active, 1=> Active	',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 =>False, 1 => True	',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suz_permissions`
--

INSERT INTO `suz_permissions` (`id`, `module_id`, `role_id`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(37, 80, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(38, 1, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(39, 78, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(40, 2, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(41, 3, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(42, 124, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(43, 125, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(44, 126, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(45, 127, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(46, 16, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(47, 17, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(48, 18, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(49, 19, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(50, 20, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(51, 4, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(52, 5, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(53, 6, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(54, 7, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(55, 8, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(56, 9, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(57, 117, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(58, 118, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(59, 119, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(60, 120, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(61, 121, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(62, 122, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(63, 69, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(64, 82, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(65, 83, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(66, 84, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(67, 85, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(68, 71, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(69, 79, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(70, 81, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37'),
(71, 70, 1, 1, 0, '2019-10-14 11:09:37', '2019-10-14 11:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `suz_posts`
--

CREATE TABLE `suz_posts` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `featured_image` varchar(255) DEFAULT NULL,
  `short_content` varchar(255) DEFAULT NULL,
  `content` longtext,
  `share_url` varchar(255) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0',
  `publish_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suz_sliders`
--

CREATE TABLE `suz_sliders` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suz_slider_images`
--

CREATE TABLE `suz_slider_images` (
  `id` int(11) NOT NULL,
  `slider_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suz_users`
--

CREATE TABLE `suz_users` (
  `id` int(11) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suz_users`
--

INSERT INTO `suz_users` (`id`, `role_id`, `name`, `email`, `password`, `remember_token`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'admin@tennisclub.in', '$2y$10$X6hlyPae1oqZ0JQ5vzh1cexwy6ITvBhfx3C9XgDEV3BK3UZABnFZe', 'omY9esogq6d2BGZKkBALRDiFFpWUwyWkDXeFzJ3N0SdNHBmaySIIhEIzc83B', 1, 0, '2019-10-14 00:00:00', '2019-10-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `suz_user_roles`
--

CREATE TABLE `suz_user_roles` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `home_page` varchar(100) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suz_user_roles`
--

INSERT INTO `suz_user_roles` (`id`, `role`, `home_page`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'dashboard', 1, 0, '2019-10-14 00:00:00', '2019-10-14 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `suz_action_logs`
--
ALTER TABLE `suz_action_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_categories`
--
ALTER TABLE `suz_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_contact_us`
--
ALTER TABLE `suz_contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_general_settings`
--
ALTER TABLE `suz_general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_media_images`
--
ALTER TABLE `suz_media_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_menus`
--
ALTER TABLE `suz_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_modules`
--
ALTER TABLE `suz_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_news`
--
ALTER TABLE `suz_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_news_gallery`
--
ALTER TABLE `suz_news_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_pages`
--
ALTER TABLE `suz_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_permissions`
--
ALTER TABLE `suz_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_posts`
--
ALTER TABLE `suz_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_sliders`
--
ALTER TABLE `suz_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_slider_images`
--
ALTER TABLE `suz_slider_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_users`
--
ALTER TABLE `suz_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suz_user_roles`
--
ALTER TABLE `suz_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `suz_action_logs`
--
ALTER TABLE `suz_action_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suz_categories`
--
ALTER TABLE `suz_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suz_contact_us`
--
ALTER TABLE `suz_contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suz_general_settings`
--
ALTER TABLE `suz_general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suz_media_images`
--
ALTER TABLE `suz_media_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suz_menus`
--
ALTER TABLE `suz_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `suz_modules`
--
ALTER TABLE `suz_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `suz_news`
--
ALTER TABLE `suz_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suz_news_gallery`
--
ALTER TABLE `suz_news_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suz_pages`
--
ALTER TABLE `suz_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `suz_permissions`
--
ALTER TABLE `suz_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `suz_posts`
--
ALTER TABLE `suz_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suz_sliders`
--
ALTER TABLE `suz_sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suz_slider_images`
--
ALTER TABLE `suz_slider_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suz_users`
--
ALTER TABLE `suz_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suz_user_roles`
--
ALTER TABLE `suz_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
