-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 11, 2021 at 04:38 AM
-- Server version: 5.7.32
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homeodocs`
--

-- --------------------------------------------------------

--
-- Table structure for table `homeo_action_logs`
--

CREATE TABLE `homeo_action_logs` (
  `id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_advertisements`
--

CREATE TABLE `homeo_advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_banner` tinyint(4) NOT NULL DEFAULT '0',
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_advertisements`
--

INSERT INTO `homeo_advertisements` (`id`, `title`, `description`, `heading`, `image_name`, `image_url`, `is_banner`, `admin_id`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'COVID', 'Coronavirus disease (COVID-19) is an infectious disease caused by a newly discovered coronavirus.\n\nMost people infected with the COVID-19 virus will experience mild to moderate respiratory illness and recover without requiring special treatment.  Older people, and those with underlying medical problems like cardiovascular disease, diabetes, chronic respiratory disease, and cancer are more likely to develop serious illness.\n\nThe best way to prevent and slow down transmission is to be well informed about the COVID-19 virus, the disease it causes and how it spreads. Protect yourself and others from infection by washing your hands or using an alcohol based rub frequently and not touching your face. \n\nThe COVID-19 virus spreads primarily through droplets of saliva or discharge from the nose when an infected person coughs or sneezes, so it’s important that you also practice respiratory etiquette (for example, by coughing into a flexed elbow).', 'COVID-19', 'COVID_1609822083.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/advertisement/COVID_1609822083.png', 0, 2, 1, 0, '2021-01-05 04:48:04', '2021-01-05 04:52:07'),
(2, 'Homeopathy Cure', 'Homeopathy is a medical system based on the belief that the body can cure itself. Those who practice it use tiny amounts of natural substances, like plants and minerals. They believe these stimulate the healing process.\n\nIt was developed in the late 1700s in Germany. It’s common in many European countries, but it’s not quite as popular in the United States.\n\nHow Does It Work?\n\nA basic belief behind homeopathy is “like cures like.” In other words, something that brings on symptoms in a healthy person can -- in a very small dose -- treat an illness with similar symptoms. This is meant to trigger the body’s natural defenses.', 'Homeopathy Cure', 'Homeopathy Cure_1609822480.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/advertisement/Homeopathy%20Cure_1609822480.png', 0, 2, 1, 0, '2021-01-05 04:54:40', '2021-01-05 04:54:40'),
(3, 'Consultation', 'Consultation', 'Consultation', 'Consultation_1609824633.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/advertisement/Consultation_1609824633.png', 1, 2, 1, 0, '2021-01-05 04:56:11', '2021-01-05 05:30:33'),
(4, 'Top doctor 24x7', 'Top doctor 24x7', 'Top doctor 24x7', 'Top doctor 24x7_1609823902.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/advertisement/Top%20doctor%2024x7_1609823902.png', 1, 2, 1, 0, '2021-01-05 04:56:36', '2021-01-05 05:18:22'),
(5, 'Unlimited Consultation', 'Unlimited Consultation', 'Unlimited Consultation', 'Unlimited Consultation_1609822648.png', 'https://homeodocsimages.s3.ap-south-1.amazonaws.com/advertisement/Unlimited%20Consultation_1609822648.png', 1, 2, 1, 0, '2021-01-05 04:57:28', '2021-01-05 04:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_categories`
--

CREATE TABLE `homeo_categories` (
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
-- Table structure for table `homeo_consults`
--

CREATE TABLE `homeo_consults` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `disease_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disease_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symptoms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bathing_habit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sleep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dreams` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menstrual_history` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obstetric_history` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexual_history` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family_history` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_pressure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pulse_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temprature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appetite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thirst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addiction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thermalReaction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perspiration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stool` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_consults`
--

INSERT INTO `homeo_consults` (`id`, `patient_id`, `disease_name`, `disease_type`, `symptoms`, `bathing_habit`, `sleep`, `dreams`, `menstrual_history`, `obstetric_history`, `sexual_history`, `family_history`, `blood_pressure`, `pulse_rate`, `temprature`, `appetite`, `thirst`, `addiction`, `thermalReaction`, `perspiration`, `urine`, `stool`, `desire`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Eye', 'eye', 'red', 'daily', 'sound', 'wet', 'none', 'none', 'none', 'none', '120/90', '72', '98', 'good', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 1, 0, '2021-03-15 16:23:56', '2021-03-15 16:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_consult_images`
--

CREATE TABLE `homeo_consult_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consult_id` bigint(20) UNSIGNED NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_contact_us`
--

CREATE TABLE `homeo_contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_doctors`
--

CREATE TABLE `homeo_doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other',
  `dob` date NOT NULL DEFAULT '1000-01-01',
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_husband_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_doctors`
--

INSERT INTO `homeo_doctors` (`id`, `user_id`, `gender`, `dob`, `image_name`, `image_url`, `father_husband_name`, `spouse_name`, `spouse_mobile`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 'male', '1000-01-01', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '2021-03-09 16:49:13');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_general_settings`
--

CREATE TABLE `homeo_general_settings` (
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
-- Table structure for table `homeo_media_images`
--

CREATE TABLE `homeo_media_images` (
  `id` int(11) NOT NULL,
  `group_type` varchar(20) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_medical_records`
--

CREATE TABLE `homeo_medical_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` int(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medical_status` enum('past','ongoing') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_from` date NOT NULL,
  `time_to` date DEFAULT NULL,
  `result` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_medical_records`
--

INSERT INTO `homeo_medical_records` (`id`, `patient_id`, `title`, `medical_status`, `type`, `time_from`, `time_to`, `result`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'TEST', 'past', 'TEST', '2021-03-15', '2021-03-15', 'TEST', 1, 0, '2021-03-15 14:17:11', '2021-03-15 14:17:11'),
(2, 1, 'TEST1', 'ongoing', 'TEST1', '2021-03-15', '2021-03-15', 'TEST1', 1, 0, '2021-03-15 14:17:02', '2021-03-15 14:17:02'),
(3, 2, 'TEST2', 'past', 'TEST2', '2021-03-15', '2021-03-15', 'TEST1', 1, 0, '2021-03-15 14:17:02', '2021-03-15 14:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_medical_record_images`
--

CREATE TABLE `homeo_medical_record_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medical_record_id` bigint(20) UNSIGNED NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_menus`
--

CREATE TABLE `homeo_menus` (
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
-- Dumping data for table `homeo_menus`
--

INSERT INTO `homeo_menus` (`id`, `group_id`, `parent_id`, `name`, `slug`, `page_id`, `menu_order`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Home', 'home', 1, 1, 1, 0, '2019-10-14 11:21:49', '2021-03-11 12:34:41'),
(2, 1, 0, 'About Us', 'about-us', 2, 2, 1, 0, '2019-10-14 11:22:01', '2019-10-15 05:46:18'),
(6, 1, 0, 'Contact Us', 'contact-us', 6, 6, 1, 0, '2019-10-14 11:23:16', '2019-10-15 05:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_modules`
--

CREATE TABLE `homeo_modules` (
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
-- Dumping data for table `homeo_modules`
--

INSERT INTO `homeo_modules` (`id`, `parent_id`, `name`, `fa_icon`, `controller`, `action`, `has_sub_menu`, `is_visible`, `is_action`, `allowed_user_roles`, `status`, `is_deleted`, `order_by`, `created_at`, `updated_at`) VALUES
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
(127, 3, 'Delete', 'fa fa-circle-o', 'menu', 'delete', 0, 0, 1, '0', 1, 0, 0, '2019-10-14 00:00:00', '2019-10-14 00:00:00'),
(139, 0, 'Patient', 'fa fa-heart', 'patient', NULL, 1, 1, 0, '0', 1, 0, 10, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(140, 139, 'View All', 'fa fa-circle-o', 'patient', NULL, 0, 1, 0, '0', 1, 0, 0, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(141, 139, 'View', 'fa fa-circle-o', 'patient', 'view', 0, 0, 1, '0', 1, 0, 0, '2019-10-14 00:00:00', '2019-10-14 00:00:00'),
(142, 0, 'Profile', 'fa fa-id-badge', 'profile', NULL, 0, 1, 1, '0', 1, 0, 11, '2019-06-26 00:00:00', '2019-06-26 00:00:00'),
(143, 0, 'Consult', 'fa fa-id-badge', 'consult', NULL, 1, 0, 1, '0', 1, 0, 0, '2021-04-05 17:25:54', '2021-04-05 17:25:54'),
(144, 143, 'View', 'fa fa-id-badge', 'consult', 'view', 0, 0, 1, '0', 1, 0, 0, '2021-04-05 17:25:54', '2021-04-05 17:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_news`
--

CREATE TABLE `homeo_news` (
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
-- Table structure for table `homeo_news_gallery`
--

CREATE TABLE `homeo_news_gallery` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_pages`
--

CREATE TABLE `homeo_pages` (
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
-- Dumping data for table `homeo_pages`
--

INSERT INTO `homeo_pages` (`id`, `title`, `slug`, `content`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'home', NULL, NULL, NULL, NULL, 1, 0, '2019-10-15 05:43:21', '2019-10-15 05:43:21'),
(2, 'About Us', 'about-us', NULL, NULL, NULL, NULL, 1, 0, '2019-10-15 05:43:29', '2019-10-15 05:43:29'),
(6, 'Contact Us', 'contact-us', NULL, NULL, NULL, NULL, 1, 0, '2019-10-15 05:44:07', '2019-10-15 05:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_patient`
--

CREATE TABLE `homeo_patient` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other',
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1000-01-01',
  `blood_group` enum('A+','B+','O+','AB+','A-','B-','O-','AB-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` decimal(6,2) DEFAULT NULL,
  `weight` decimal(6,2) DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smoking` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alcohol` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daily_routine_work` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diet` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_patient`
--

INSERT INTO `homeo_patient` (`id`, `user_id`, `gender`, `dob`, `blood_group`, `marital_status`, `height`, `weight`, `image_name`, `image_url`, `smoking`, `alcohol`, `daily_routine_work`, `diet`, `occupation`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '3', 'male', '1000-01-01', 'B+', 'single', '173.00', '74.00', NULL, NULL, 'NON', 'NON', 'busy', 'VEG', 'IT', 1, 0, '2021-03-13 12:19:50', '2021-03-13 12:19:50'),
(2, '4', 'female', '1000-01-01', 'B+', 'Married', '180.00', '80.00', NULL, NULL, 'NON', 'NON', 'busy', 'VEG', 'IT', 1, 0, '2021-03-13 12:19:50', '2021-03-13 12:19:50'),
(3, '5', 'male', '1998-10-04', 'AB+', 'single', '173.00', '70.00', NULL, NULL, 'none', 'none', 'busy', 'veg', 'IT', 1, 0, '2021-03-28 02:15:52', '2021-03-28 02:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_permissions`
--

CREATE TABLE `homeo_permissions` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0=>In-active, 1=> Active	',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 =>False, 1 => True	',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homeo_permissions`
--

INSERT INTO `homeo_permissions` (`id`, `module_id`, `role_id`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(305, 80, 1, 1, 0, '2020-11-18 04:24:25', '2020-11-18 04:24:25'),
(306, 1, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(307, 128, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(308, 129, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(309, 131, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(310, 133, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(311, 78, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(312, 2, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(313, 3, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(314, 124, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(315, 125, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(316, 126, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(317, 127, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(318, 16, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(319, 17, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(320, 18, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(321, 19, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(322, 20, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(323, 4, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(324, 5, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(325, 6, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(326, 7, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(327, 8, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(328, 9, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(329, 117, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(330, 118, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(331, 119, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(332, 120, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(333, 121, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(334, 122, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(335, 69, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(336, 82, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(337, 83, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(338, 84, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(339, 85, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(340, 71, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(341, 79, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(342, 81, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(343, 70, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(344, 134, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(345, 135, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(346, 136, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(347, 137, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(348, 138, 1, 1, 0, '2020-11-18 04:24:26', '2020-11-18 04:24:26'),
(361, 143, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58'),
(362, 144, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58'),
(363, 1, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58'),
(364, 139, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58'),
(365, 140, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58'),
(366, 141, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58'),
(367, 142, 4, 1, 0, '2021-04-08 03:09:58', '2021-04-08 03:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_posts`
--

CREATE TABLE `homeo_posts` (
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
-- Table structure for table `homeo_sliders`
--

CREATE TABLE `homeo_sliders` (
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
-- Table structure for table `homeo_slider_images`
--

CREATE TABLE `homeo_slider_images` (
  `id` int(11) NOT NULL,
  `slider_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeo_static_texts`
--

CREATE TABLE `homeo_static_texts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `used_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeo_static_texts`
--

INSERT INTO `homeo_static_texts` (`id`, `used_for`, `content`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'dashboard-slider', 'Homeopathy is a system of alternative medicine of treatment through natural way without side effect. Free online consultant by specialist homeopathic doctors for 3 month 24×7 days.', 1, 0, '2021-02-27 22:33:55', '2021-02-27 22:33:55');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_users`
--

CREATE TABLE `homeo_users` (
  `id` int(11) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `remember_token` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `ip` varchar(30) DEFAULT NULL,
  `fb_token` varchar(255) DEFAULT NULL,
  `g_token` varchar(255) DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `marketing` tinyint(4) NOT NULL DEFAULT '0',
  `otp` int(10) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homeo_users`
--

INSERT INTO `homeo_users` (`id`, `role_id`, `name`, `email`, `password`, `mobile`, `remember_token`, `address`, `status`, `ip`, `fb_token`, `g_token`, `api_token`, `marketing`, `otp`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'rajat@gmail.com', '$2y$10$jKPgNtYWaIgefBF.lOhJneaGSAMHE8bYBS.ty3B/wlh6rQcXYDh.C', NULL, 'aoiOkPMPvLybM1k0RZ1PRILgerbssjHxistKXaj4XTvufg1oDpSL1CXWo6UD', NULL, 1, NULL, NULL, NULL, NULL, 0, NULL, 0, '2019-10-14 00:00:00', '2021-01-26 04:58:30'),
(2, 4, 'Rajat Singh', 'rajat@doctor.com', '$2y$10$OxE/vEs98wpjPnXt8c27v.W3WETcqHBzni1ZOUa91i9BX2VGa3D3O', NULL, 'CO199OxpUGDSOe1M9lDm3XzxsJEGLzpQlDUzf5AJDehvpmqh7J7YnqX7NPh1', NULL, 1, NULL, NULL, NULL, NULL, 0, NULL, 0, '2021-03-11 12:37:30', '2021-03-11 12:37:30'),
(3, 3, 'Rajat Patient1', 'rajat@patient.com', '$2y$10$ODNJFK.hwgysdHfHUVXHte6obCPusCQbabT8EI7fqz7XDHMZwL4ce', '8696383340', '', NULL, 1, '127.0.0.1', NULL, NULL, 'd5b78d670a28f379541d0e9f4232b6a8dc0ea6c641b543de7c04dd6ff25d2f18', 1, 763013, 0, '2021-03-13 11:26:38', '2021-03-28 08:28:42'),
(4, 3, 'Patient 2', 'patient2@gmail.com', '$2y$10$jC0/y77ivLBZm3QkICWK7OwYcfo8CRPPLbZQSM54q30Lq/qj5DXwK', NULL, '', NULL, 1, NULL, NULL, NULL, NULL, 0, NULL, 0, '2021-03-13 11:26:58', '2021-03-13 11:26:58'),
(5, 3, 'Patient 3', 'patient3@gmail.com', '$2y$10$jC0/y77ivLBZm3QkICWK7OwYcfo8CRPPLbZQSM54q30Lq/qj5DXwK', '8696383341', '', NULL, 1, '127.0.0.1', NULL, NULL, NULL, 0, 601101, 0, '2021-03-28 07:45:52', '2021-03-28 07:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_user_roles`
--

CREATE TABLE `homeo_user_roles` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `home_page` varchar(100) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0 => In-active, 1 => Active',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 => False, 1 => True',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homeo_user_roles`
--

INSERT INTO `homeo_user_roles` (`id`, `role`, `home_page`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'System Admin', 'dashboard', 1, 0, '2019-10-14 00:00:00', '2021-03-11 12:29:30'),
(2, 'Admin', NULL, 1, 0, '2021-03-11 12:29:38', '2021-03-11 12:29:38'),
(3, 'Patient', NULL, 1, 0, '2021-03-11 12:29:44', '2021-03-11 12:29:44'),
(4, 'Doctor', NULL, 1, 0, '2021-03-11 12:29:46', '2021-03-11 12:29:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `homeo_action_logs`
--
ALTER TABLE `homeo_action_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_advertisements`
--
ALTER TABLE `homeo_advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_categories`
--
ALTER TABLE `homeo_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_consults`
--
ALTER TABLE `homeo_consults`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_consult_images`
--
ALTER TABLE `homeo_consult_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_contact_us`
--
ALTER TABLE `homeo_contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_doctors`
--
ALTER TABLE `homeo_doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_general_settings`
--
ALTER TABLE `homeo_general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_media_images`
--
ALTER TABLE `homeo_media_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_medical_records`
--
ALTER TABLE `homeo_medical_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_medical_record_images`
--
ALTER TABLE `homeo_medical_record_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_menus`
--
ALTER TABLE `homeo_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_modules`
--
ALTER TABLE `homeo_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_news`
--
ALTER TABLE `homeo_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_news_gallery`
--
ALTER TABLE `homeo_news_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_pages`
--
ALTER TABLE `homeo_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_patient`
--
ALTER TABLE `homeo_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_permissions`
--
ALTER TABLE `homeo_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_posts`
--
ALTER TABLE `homeo_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_sliders`
--
ALTER TABLE `homeo_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_slider_images`
--
ALTER TABLE `homeo_slider_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_static_texts`
--
ALTER TABLE `homeo_static_texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_users`
--
ALTER TABLE `homeo_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeo_user_roles`
--
ALTER TABLE `homeo_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `homeo_action_logs`
--
ALTER TABLE `homeo_action_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_advertisements`
--
ALTER TABLE `homeo_advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `homeo_categories`
--
ALTER TABLE `homeo_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_consults`
--
ALTER TABLE `homeo_consults`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homeo_consult_images`
--
ALTER TABLE `homeo_consult_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_contact_us`
--
ALTER TABLE `homeo_contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_doctors`
--
ALTER TABLE `homeo_doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homeo_general_settings`
--
ALTER TABLE `homeo_general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_media_images`
--
ALTER TABLE `homeo_media_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_medical_records`
--
ALTER TABLE `homeo_medical_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `homeo_medical_record_images`
--
ALTER TABLE `homeo_medical_record_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_menus`
--
ALTER TABLE `homeo_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `homeo_modules`
--
ALTER TABLE `homeo_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `homeo_news`
--
ALTER TABLE `homeo_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_news_gallery`
--
ALTER TABLE `homeo_news_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_pages`
--
ALTER TABLE `homeo_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `homeo_patient`
--
ALTER TABLE `homeo_patient`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `homeo_permissions`
--
ALTER TABLE `homeo_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;

--
-- AUTO_INCREMENT for table `homeo_posts`
--
ALTER TABLE `homeo_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_sliders`
--
ALTER TABLE `homeo_sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_slider_images`
--
ALTER TABLE `homeo_slider_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeo_static_texts`
--
ALTER TABLE `homeo_static_texts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homeo_users`
--
ALTER TABLE `homeo_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `homeo_user_roles`
--
ALTER TABLE `homeo_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
