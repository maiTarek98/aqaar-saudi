-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 08:05 PM
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
-- Database: `aqarr`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `batch_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `text_ar` varchar(255) DEFAULT NULL,
  `text_en` varchar(255) DEFAULT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `status` enum('show','hide') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول البرنات فالهوم';

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `admin_id`, `title_ar`, `title_en`, `created_at`, `updated_at`, `text_ar`, `text_en`, `description_ar`, `description_en`, `status`) VALUES
(1, 1, 'اعثر على أفضل الألعاب لأطفالك', 'اعثر على أفضل الألعاب لأطفالك', '2024-02-21 09:25:29', '2024-08-16 22:06:41', 'نص مؤقت يستخدم في التصميم والنشر لإظهار شكل الوثيقة أو الخط دون الاعتماد على محتوى معنوي. قد يستخدم\r\n                لوريم إيبسوم كنص بديل قبل وضع النص النهائي المطلوب للتصميم.', 'نص مؤقت يستخدم في التصميم والنشر لإظهار شكل الوثيقة أو الخط دون الاعتماد على محتوى معنوي. قد يستخدم\r\n                لوريم إيبسوم كنص بديل قبل وضع النص النهائي المطلوب للتصميم.', NULL, NULL, 'show'),
(2, 1, 'اعثر على أفضل الألعاب لأطفالك', 'اعثر على أفضل الألعاب لأطفالك', '2024-02-21 09:25:36', '2024-08-16 22:06:49', 'نص مؤقت يستخدم في التصميم والنشر لإظهار شكل الوثيقة أو الخط دون الاعتماد على محتوى معنوي. قد يستخدم\r\n                لوريم إيبسوم كنص بديل قبل وضع النص النهائي المطلوب للتصميم.', 'نص مؤقت يستخدم في التصميم والنشر لإظهار شكل الوثيقة أو الخط دون الاعتماد على محتوى معنوي. قد يستخدم\r\n                لوريم إيبسوم كنص بديل قبل وضع النص النهائي المطلوب للتصميم.', 'nbvcsjnkm', 'bvdjnvkm', 'show'),
(4, 1, 'خصم كبير', 'Big Offer', '2024-02-21 09:25:36', '2024-02-21 09:25:36', 'خصم يصل حتى 50%', 'خصم يصل حتى 50%', 'استعد لرحلة القراءة مع عروضناالرائعة على مجموعة مختارة من الكتب اباأ مغامرتك الأن مع اسعار مذهلة', 'استعد لرحلة القراءة مع عروضناالرائعة على مجموعة مختارة من الكتب اباأ مغامرتك الأن مع اسعار مذهلة', NULL),
(6, 1, 'vdhbgvhbjnknbh', 'cgvhbjnkdm', '2024-04-24 11:21:23', '2024-04-24 11:21:23', NULL, NULL, NULL, NULL, NULL),
(7, 1, 'vdhbgvhbjnknbh', 'cgvhbjnkdm', '2024-04-24 11:23:34', '2024-07-23 12:45:51', NULL, NULL, NULL, NULL, 'hide'),
(10, 1, 'eihjk', 'hcjkd', '2024-08-03 15:08:09', '2024-08-16 22:05:08', NULL, NULL, NULL, NULL, 'show');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `content_ar` longtext DEFAULT NULL,
  `content_en` longtext DEFAULT NULL,
  `meta_tags_ar` text DEFAULT NULL,
  `meta_tags_en` text DEFAULT NULL,
  `meta_description_ar` text DEFAULT NULL,
  `meta_description_en` text DEFAULT NULL,
  `status` enum('show','hide') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `in_home` enum('yes','no') NOT NULL DEFAULT 'no',
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `added_by`, `name_ar`, `name_en`, `description_ar`, `description_en`, `content_ar`, `content_en`, `meta_tags_ar`, `meta_tags_en`, `meta_description_ar`, `meta_description_en`, `status`, `created_at`, `updated_at`, `in_home`, `views`) VALUES
(10, 1, 'Colette Moore', 'Jayme Snow', 'Deserunt nihil ullam', 'Veniam dolores quia', 'gghh', 'hnmk', 'Est error quos vel', 'Non ea dolor necessi', 'Lorem sint accusamu', 'Laudantium nemo ad', 'show', '2025-01-24 21:23:05', '2025-04-21 15:55:02', 'no', 10),
(11, 1, 'Jescie Mcintyre', 'Zena Ingram', 'Doloribus dolorum re', 'Dolorem deleniti ea', 'dcfvghjkl;', NULL, NULL, NULL, NULL, NULL, 'show', '2025-01-24 21:25:25', '2025-04-29 16:55:59', 'yes', 8),
(12, 1, 'أفضل طريقة لاستخدام تطبيق العناية بالبشرة', 'Zena Iqqngram', 'تعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرة', 'Dolorem deleniti ea', 'تعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرةتعرفي على كيفية تحقيق أقصى استفادة من تطبيق العناية بالبشرة. خطوات بسيطة لتخصيص روتينك اليومي ومتابعة تقدمك نحو بشرة صحية ونضرة', NULL, NULL, NULL, NULL, NULL, 'show', '2025-01-24 21:26:48', '2025-02-09 09:05:00', 'no', 10);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `blog_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('show','hide') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('shop','consultation') DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `in_home` enum('yes','no') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول التصنيفات';

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `added_by`, `title_ar`, `title_en`, `parent_id`, `status`, `created_at`, `updated_at`, `type`, `order`, `in_home`) VALUES
(18, 1, 'العناية بالأيد', 'Hands Care', NULL, 'show', '2024-07-26 16:25:12', '2025-02-20 08:46:51', 'shop', NULL, 'yes'),
(19, 1, 'العناية بالشعر', 'hair care', NULL, 'show', '2024-07-26 16:25:34', '2025-02-20 08:40:59', NULL, NULL, 'yes'),
(20, 1, 'العناية بالقدمين', 'foot care', NULL, 'show', '2024-08-03 14:25:23', '2025-02-20 08:46:21', 'shop', NULL, 'yes'),
(21, 1, 'العناية بالجسم', 'body care', NULL, 'show', '2024-08-03 14:31:22', '2025-02-20 08:44:04', 'shop', NULL, 'yes'),
(28, 1, 'زيوت طبيعية', 'Natural oil', NULL, 'show', '2024-08-03 14:31:22', '2025-02-20 08:46:46', 'shop', NULL, 'yes'),
(78, 1, 'العناية بالبشرة', 'skin care', NULL, 'show', '2025-02-17 12:26:44', '2025-02-20 08:42:27', NULL, NULL, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_viewed` enum('yes','no') NOT NULL DEFAULT 'no',
  `mobile` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`, `is_viewed`, `mobile`) VALUES
(1, 'fooz', 'fooz@gmail.com', 'نص تجريبي للاختبار', '2024-03-05 21:20:48', '2024-03-05 21:20:48', 'no', NULL),
(2, 'سرالام', 'jh@yahoo.com', 'hgcfshdkl', '2024-04-30 14:10:18', '2024-04-30 14:10:18', 'no', NULL),
(3, 'Atque pariatur Sunt', 'limazajuba@mailinator.com', 'Anim cupidatat culpa', '2024-04-30 14:11:12', '2024-04-30 14:11:12', 'no', NULL),
(4, 'Ut quia et dolores r', 'wimamucama@mailinator.com', 'Unde officia perfere', '2024-04-30 14:14:19', '2024-08-03 15:08:47', 'yes', NULL),
(5, 'Incididunt maxime qu', 'rokusohif@mailinator.com', 'Illum doloribus inc', '2024-04-30 14:15:06', '2024-07-24 20:14:54', 'yes', NULL),
(6, 'Branden Joseph', 'jimazugoz@mailinator.com', 'Esse mollitia nobis', '2024-08-07 13:04:58', '2024-08-07 13:04:58', 'no', NULL),
(7, 'Branden Joseph', 'jimazugoz@mailinator.com', 'Esse mollitia nobis', '2024-08-07 13:05:11', '2024-08-07 13:05:11', 'no', NULL),
(8, 'Shaine Cortez', 'heboqowy@mailinator.com', 'Dolorem quia et qui', '2024-08-07 13:05:34', '2024-08-07 13:05:34', 'no', NULL),
(9, 'Cain Bowen', 'basic@mailinator.com', 'Eligendi ullamco vel', '2024-08-07 13:06:01', '2024-08-07 13:06:01', 'no', NULL),
(10, 'Cain Bowen', 'basic@mailinator.com', 'Eligendi ullamco vel', '2024-08-07 13:06:04', '2024-08-07 13:06:04', 'no', NULL),
(11, 'Cain Bowen', 'basic@mailinator.com', 'Eligendi ullamco vel', '2024-08-07 13:06:06', '2024-08-07 13:06:06', 'no', NULL),
(12, 'Cain Bowen', 'basic@mailinator.com', 'Eligendi ullamco vel', '2024-08-07 13:06:54', '2024-08-07 13:06:54', 'no', NULL),
(13, 'Chaim Morrison', 'pywug@mailinator.com', 'Aliquip incidunt nu', '2024-08-07 13:07:54', '2024-08-07 13:09:05', 'yes', NULL),
(14, 'Nomlanga Lawson', 'lefacu@mailinator.com', 'Amet iure id volupt', '2024-08-07 13:11:13', '2024-08-07 13:11:13', 'no', NULL),
(15, 'Gannon Powell', 'wimeh@mailinator.com', 'Porro ut ut aliquid', '2024-08-07 13:11:15', '2024-08-07 13:11:15', 'no', NULL),
(16, 'Lilah Larson', 'cuvage@mailinator.com', 'In magna ut at dolor', '2024-08-07 13:11:57', '2024-08-07 13:11:57', 'no', NULL),
(17, 'Charles Harrison', 'fuxibube@mailinator.com', 'Numquam ipsam odit i', '2024-08-07 13:11:59', '2024-08-07 13:18:32', 'yes', NULL),
(18, 'Axel Serrano', 'dyhyv@mailinator.com', 'Optio error quis de', '2024-08-07 13:21:46', '2024-08-07 13:23:59', 'yes', NULL),
(19, 'Ashely Hardin', 'tamef@mailinator.com', 'Assumenda aut dolor', '2024-08-07 13:24:11', '2025-02-06 08:32:07', '', NULL),
(20, 'Hakeem Robles', 'vyjonuqip@mailinator.com', 'Nulla assumenda dolo', '2024-08-07 13:24:14', '2025-02-06 08:31:01', '', NULL),
(21, 'Hedley Jackson', 'vecasipo@mailinator.com', 'Quis at quos dolore', '2024-08-07 13:24:44', '2024-08-07 13:28:02', 'yes', NULL),
(22, 'Alana Glass', 'hocyzuxyfi@mailinator.com', 'Dolore qui a volupta', '2024-08-07 13:24:56', '2024-08-07 13:27:57', 'yes', NULL),
(23, 'Kiayada Zimmerman', 'kerofani@mailinator.com', 'Qui aut ut magna sit', '2024-08-07 13:29:21', '2025-02-06 08:43:19', 'yes', NULL),
(24, 'Kiayada Zimmerman', 'kerofani@mailinator.com', 'Qui aut ut magna sit', '2024-08-07 13:29:22', '2025-02-06 08:43:18', 'yes', NULL),
(25, 'mai tarek', 'maitarekttt@gmail.com', 'Animi sint occaeca', '2024-08-22 21:34:34', '2024-08-22 21:34:34', 'no', '01097987069'),
(26, 'mai tarek', 'maitarekttt@gmail.com', 'بغتبتؤ', '2024-09-28 16:10:20', '2024-09-28 16:10:43', 'yes', '01097987069'),
(27, 'mai tarek', 'maitarekttt@gmail.com', 'nvn', '2024-09-28 16:11:49', '2025-02-06 08:39:52', 'yes', '01097987069'),
(28, 'xcfvgbhnjk', 'mohrkcom@gmail.com', 'fghjkl', '2025-02-03 12:33:47', '2025-02-06 08:39:51', 'yes', NULL),
(29, 'xcfvgbhnjk', 'mohrkcom@gmail.com', 'fghjkl', '2025-02-03 12:34:11', '2025-02-06 08:37:58', 'yes', NULL),
(30, 'xcfvgbhnjk', 'mohrkcom@gmail.com', 'fghjkl', '2025-02-03 12:34:42', '2025-02-06 08:42:53', 'no', NULL),
(31, 'Abdullah Ashraf', 'elgazzara2912@gmail.com', 'مممممممممممممممم', '2025-02-06 11:25:55', '2025-02-06 11:29:16', 'no', NULL),
(32, 'Abdullah Ashraf', 'elgazzara912@gmail.com', 'الووووو', '2025-02-06 12:40:38', '2025-02-06 12:40:38', 'no', NULL),
(33, 'على', 'elgazzara912@gmail.com', 'ewqqqqqqqqq', '2025-02-06 13:05:59', '2025-02-06 13:11:09', 'no', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_replies`
--

CREATE TABLE `contact_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `body` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_replies`
--

INSERT INTO `contact_replies` (`id`, `body`, `created_at`, `updated_at`, `admin_id`, `contact_id`) VALUES
(2, '<p>ؤرلالاتىنة</p>', '2024-07-17 08:27:01', '2024-07-17 08:27:01', 1, 7),
(3, '<p>chsbzjncmk</p>', '2024-07-17 08:27:33', '2024-07-17 08:27:33', 1, 7),
(4, '<p>dgvbcns</p>', '2024-07-17 08:28:08', '2024-07-17 08:28:08', 1, 7),
(5, '<p>cscgshcbjnk&nbsp;&nbsp;&nbsp;&nbsp;</p>', '2024-07-17 08:28:39', '2024-07-17 08:28:39', 1, 7),
(6, '<p>sdgchbjn&nbsp;&nbsp;&nbsp;&nbsp;</p>', '2024-07-17 08:29:58', '2024-07-17 08:29:58', 1, 7),
(7, '<p>شكرا على تواصلكم معنا</p>', '2024-07-17 08:55:45', '2024-07-17 08:55:45', 1, 8),
(8, '2', '2024-07-17 08:59:47', '2024-07-17 08:59:47', 1, 8),
(9, '<p style=\"text-align: left; \"><br></p><p class=\"p2\" style=\"text-align: left; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(69, 69, 69);\">Dear Nev Connell</p><p class=\"p1\" style=\"text-align: left; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(69, 69, 69); min-height: 14px;\"><br></p><p class=\"p2\" style=\"text-align: left; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(69, 69, 69);\">Thank you for your interest in becoming a member of the Saudi Society of Landscape Architecture.&nbsp; For some technical issues we missed your message and for that we deeply apologies. You can Join SSLA&nbsp; via the website. Please select the professional membership and pay the membership fee of 300 SR and attach the bank transfer receipt to your application</p><p class=\"p1\" style=\"text-align: left; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(69, 69, 69); min-height: 14px;\"><br></p><p class=\"p2\" style=\"text-align: left; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(69, 69, 69);\">Bank information:</p><p class=\"p2\" style=\"text-align: left; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(69, 69, 69);\"><b>The Saudi Society of Landscape Architecture</b></p><p class=\"p2\" style=\"text-align: left; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(69, 69, 69);\"><b>The Saudi National Bank</b></p><p class=\"p2\" style=\"text-align: left; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica; color: rgb(69, 69, 69);\"><b>IBAN:</b> <b>SA1510000081100003547008</b></p>', '2024-12-06 18:07:45', '2024-12-06 18:07:45', 1, 9),
(10, '<p>سشيس</p>', '2025-02-06 11:29:31', '2025-02-06 11:29:31', 1, 31),
(11, '<p>ثصقصثق</p>', '2025-02-06 12:41:00', '2025-02-06 12:41:00', 1, 32),
(12, '<p>dfghjggtgt</p>', '2025-02-06 15:03:20', '2025-02-06 15:03:20', 1, 33),
(13, '<p>hello</p>', '2025-02-09 10:02:12', '2025-02-09 10:02:12', 1, 33),
(14, '<p>ttttt</p>', '2025-02-09 10:02:31', '2025-02-09 10:02:31', 1, 33),
(15, '<p>ثقفغع</p>', '2025-02-09 10:04:13', '2025-02-09 10:04:13', 1, 33),
(16, '<p>sdfghyyyy</p>', '2025-02-09 10:06:49', '2025-02-09 10:06:49', 1, 33),
(17, '<p>ببببب</p>', '2025-02-09 10:56:12', '2025-02-09 10:56:12', 1, 33),
(18, '<p>لللل</p>', '2025-02-09 10:57:51', '2025-02-09 10:57:51', 1, 33);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_notifies`
--

CREATE TABLE `general_notifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول سيارات كبار المستخدمين ';

--
-- Dumping data for table `general_notifies`
--

INSERT INTO `general_notifies` (`id`, `user_id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(1, 4, 'user', 'muahmed', '2023-12-11 13:06:06', '2023-12-11 13:06:06'),
(2, 3, 'user', 'muhamed12', '2023-12-11 13:08:37', '2023-12-11 13:18:02'),
(15, 22, 'Black', '123456', '2023-12-27 06:35:03', '2023-12-27 06:35:03'),
(18, 22, 'Blue', '12020', '2023-12-27 09:16:56', '2023-12-27 09:16:56'),
(19, 16, 'gggggg', '8888', '2023-12-27 09:26:16', '2023-12-27 09:26:16'),
(20, 22, 'yellow', '55', '2023-12-27 10:44:03', '2023-12-27 10:44:03'),
(21, 2, 'dbhevggbh', 'vgghbxjnkm', '2023-12-27 13:00:41', '2023-12-27 13:00:41'),
(22, 2, 'dbhevggbh', 'vgghbxjnkm', '2023-12-27 13:01:24', '2023-12-27 13:01:24'),
(23, 4, 'dbhevggbh', 'vgghbxjnkm', '2023-12-27 13:01:24', '2023-12-27 13:01:24'),
(24, 22, 'و', 'تت', '2024-01-02 11:19:42', '2024-01-02 11:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('governorate','city','district') DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول البرنات فالهوم';

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`, `type`, `parent_id`) VALUES
(1, 'منطقة الرياض', 'منطقة الرياض', '2025-02-25 12:23:31', '2025-02-25 12:44:31', 'governorate', NULL),
(2, 'الرياض	', 'الرياض	', '2025-02-25 12:23:57', '2025-02-25 12:23:57', 'city', 1),
(3, 'الدرعية', 'الدرعية', '2025-02-25 12:24:35', '2025-02-25 12:24:35', 'city', 1),
(4, 'الخرج	', 'الخرج	', '2025-02-25 12:24:49', '2025-02-25 12:24:49', 'city', 1),
(5, 'مركز الحائر', 'مركز الحائر', '2025-02-25 12:25:04', '2025-02-25 12:25:04', 'district', 2),
(6, 'الزلفي	', 'الزلفي	', '2025-02-25 12:25:37', '2025-02-25 12:25:37', 'city', 1),
(7, 'الشقراء', 'الشقراء', '2025-02-25 12:25:44', '2025-02-25 12:25:44', 'city', 1),
(8, 'منطقة مكة المكرمة', 'منطقة مكة المكرمة', '2025-02-25 12:27:16', '2025-02-25 12:27:16', 'governorate', NULL),
(19, 'مكة المكرمة	', 'مكة المكرمة	', '2025-02-25 12:25:44', '2025-02-25 12:25:44', 'city', 8),
(20, 'جدة', 'جدة', '2025-02-25 12:25:44', '2025-02-25 12:25:44', 'city', 8),
(21, 'مركز الشواق', 'مركز الشواق', '2025-02-25 12:25:04', '2025-02-25 12:25:04', 'district', 19),
(22, 'مركز السعدية', 'مركز السعدية', '2025-02-25 12:25:04', '2025-02-25 12:25:04', 'district', 19);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(370, 'App\\Models\\Blog', 8, '225d8752-e163-4a2e-97e4-cc82477c0706', 'base_image', 'base_image-1735036601', 'base_image-1735036601.webp', 'image/webp', 'blogs', 'blogs', 4892, '[]', '[]', '[]', '[]', 1, '2024-12-24 10:36:41', '2024-12-24 10:36:41'),
(372, 'App\\Models\\Store', 5, 'a107a645-87ca-4034-8c27-29569a1da305', 'stores_image', 'stores_image-1737747255', 'stores_image-1737747255.webp', 'image/webp', 'stores', 'stores', 34460, '[]', '[]', '[]', '[]', 3, '2025-01-24 19:34:18', '2025-01-24 19:34:18'),
(373, 'App\\Models\\Store', 6, 'cb67fb01-2254-437f-89b1-318941766c04', 'stores_image', 'stores_image-1737747295', 'stores_image-1737747295.webp', 'image/webp', 'stores', 'stores', 48690, '[]', '[]', '[]', '[]', 4, '2025-01-24 19:34:55', '2025-01-24 19:34:55'),
(374, 'App\\Models\\Store', 7, 'afdd3562-e70d-446b-b40d-2cd77917de57', 'stores_image', 'stores_image-1737747461', 'stores_image-1737747461.webp', 'image/webp', 'stores', 'stores', 34460, '[]', '[]', '[]', '[]', 5, '2025-01-24 19:37:41', '2025-01-24 19:37:41'),
(376, 'App\\Models\\PendingVendor', 10, '79ba9a24-1d47-4984-90b2-5a8f3ed071e2', 'commercial_registration_image', 'commercial_registration_image-1737749819', 'commercial_registration_image-1737749819.webp', 'image/webp', 'pending_vendors', 'pending_vendors', 34460, '[]', '[]', '[]', '[]', 7, '2025-01-24 20:17:00', '2025-01-24 20:17:00'),
(377, 'App\\Models\\PendingVendor', 10, 'f80e21be-3628-4908-8e86-60ac4711a09c', 'tax_image', 'tax_image-1737749820', 'tax_image-1737749820.webp', 'image/webp', 'pending_vendors', 'pending_vendors', 34460, '[]', '[]', '[]', '[]', 8, '2025-01-24 20:17:00', '2025-01-24 20:17:00'),
(383, 'App\\Models\\PendingVendor', 11, 'e16e92a0-b24e-4238-b81c-76c2723ea7ba', 'tax_image', 'tax_image-1738588106', 'tax_image-1738588106.webp', 'image/webp', 'pending_vendors', 'pending_vendors', 15190, '[]', '[]', '[]', '[]', 14, '2025-02-03 13:08:26', '2025-02-03 13:08:26'),
(384, 'App\\Models\\PendingVendor', 11, 'a84d9132-e798-4944-a65a-ba7f22a0b62d', 'tax_image', 'tax_image-1738588106', 'tax_image-1738588106.webp', 'image/webp', 'pending_vendors', 'pending_vendors', 17484, '[]', '[]', '[]', '[]', 15, '2025-02-03 13:08:27', '2025-02-03 13:08:27'),
(385, 'App\\Models\\PendingVendor', 11, 'c19a0bc2-a88d-4ea9-8cd0-2af2510319fa', 'tax_image', 'tax_image-1738588107', 'tax_image-1738588107.webp', 'image/webp', 'pending_vendors', 'pending_vendors', 126742, '[]', '[]', '[]', '[]', 16, '2025-02-03 13:08:27', '2025-02-03 13:08:27'),
(386, 'App\\Models\\Blog', 5, 'c967fe96-411c-4d78-8b40-e787c570bc06', 'blogs_image', 'blogs_image-1738593197', 'blogs_image-1738593197.webp', 'image/webp', 'blogs', 'blogs', 24796, '[]', '[]', '[]', '[]', 17, '2025-02-03 14:33:26', '2025-02-03 14:33:26'),
(387, 'App\\Models\\Blog', 8, '0d494439-0f27-4d69-aaae-fdee8af79bdb', 'blogs_image', 'blogs_image-1738593203', 'blogs_image-1738593203.webp', 'image/webp', 'blogs', 'blogs', 86632, '[]', '[]', '[]', '[]', 18, '2025-02-03 14:33:26', '2025-02-03 14:33:26'),
(388, 'App\\Models\\Blog', 9, '3d3b42c2-a13a-46cb-bda8-4b9c61fc4313', 'blogs_image', 'blogs_image-1738593214', 'blogs_image-1738593214.webp', 'image/webp', 'blogs', 'blogs', 10422, '[]', '[]', '[]', '[]', 19, '2025-02-03 14:33:34', '2025-02-03 14:33:34'),
(390, 'App\\Models\\Brand', 3, '4c21b6f8-e9c5-4c6a-b60e-4bd40559b6b4', 'brands_image', 'brands_image-1738839227', 'brands_image-1738839227.webp', 'image/webp', 'brands', 'brands', 112970, '[]', '[]', '[]', '[]', 21, '2025-02-06 10:53:48', '2025-02-06 10:53:48'),
(391, 'App\\Models\\Brand', 1, '923e8008-f5ba-4180-8de9-3f9cabe5990e', 'brands_image', 'brands_image-1738839241', 'brands_image-1738839241.webp', 'image/webp', 'brands', 'brands', 10218, '[]', '[]', '[]', '[]', 22, '2025-02-06 10:54:02', '2025-02-06 10:54:02'),
(394, 'App\\Models\\Brand', 5, 'e8d338f6-5276-4e00-8a61-0208d83f23cd', 'brands_image', 'brands_image-1738843367', 'brands_image-1738843367.webp', 'image/webp', 'brands', 'brands', 57534, '[]', '[]', '[]', '[]', 24, '2025-02-06 12:02:48', '2025-02-06 12:02:48'),
(396, 'App\\Models\\Blog', 14, '13c728f4-99ee-4714-abd5-4201bd3a6d57', 'blogs_image', 'blogs_image-1738851565', 'blogs_image-1738851565.webp', 'image/webp', 'blogs', 'blogs', 72800, '[]', '[]', '[]', '[]', 25, '2025-02-06 14:19:26', '2025-02-06 14:19:26'),
(399, 'App\\Models\\Brand', 2, 'dd24d61c-f0d8-423d-b708-39a94fc0f8d7', 'brands_image', 'brands_image-1738871316', 'brands_image-1738871316.webp', 'image/webp', 'brands', 'brands', 2838, '[]', '[]', '[]', '[]', 28, '2025-02-06 19:48:36', '2025-02-06 19:48:36'),
(402, 'App\\Models\\Product', 27, '888edf3e-6b43-4ee0-8526-84f2cedc5167', 'document', '555', '555.png', 'image/png', 'products_images', 'products_images', 17931, '[]', '[]', '[]', '[]', 30, '2025-02-18 09:59:03', '2025-02-18 09:59:03'),
(403, 'App\\Models\\Product', 27, 'e4f6a597-5864-45bd-8675-c62a7bfbfe15', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 288036, '[]', '[]', '[]', '[]', 31, '2025-02-18 09:59:04', '2025-02-18 09:59:04'),
(404, 'App\\Models\\Product', 26, '67ef68a4-e6d7-42bd-ae92-14a6408b9930', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 288036, '[]', '[]', '[]', '[]', 32, '2025-02-18 09:59:22', '2025-02-18 09:59:22'),
(406, 'App\\Models\\Brand', 7, 'e92687b9-af41-4ffc-9c7d-9570400351f9', 'brands_image', 'brands_image-1739963996', 'brands_image-1739963996.webp', 'image/webp', 'brands', 'brands', 2550, '[]', '[]', '[]', '[]', 33, '2025-02-19 11:19:58', '2025-02-19 11:19:58'),
(407, 'App\\Models\\Brand', 8, 'd486602a-b592-4662-befa-da6c4161b1f4', 'brands_image', 'brands_image-1739964043', 'brands_image-1739964043.webp', 'image/webp', 'brands', 'brands', 49000, '[]', '[]', '[]', '[]', 34, '2025-02-19 11:20:55', '2025-02-19 11:20:55'),
(409, 'App\\Models\\Store', 14, '629be912-4f9f-4922-af76-9ba2fba960c2', 'stores_image', 'stores_image-1739965133', 'stores_image-1739965133.jpg', 'image/webp', 'stores', 'stores', 11374, '[]', '[]', '[]', '[]', 36, '2025-02-19 11:38:54', '2025-02-19 11:38:54'),
(410, 'App\\Models\\Store', 15, 'c7538135-a65f-4ebb-b3be-061851fc2c7a', 'stores_image', 'stores_image-1739965177', 'stores_image-1739965177.webp', 'image/webp', 'stores', 'stores', 3248, '[]', '[]', '[]', '[]', 37, '2025-02-19 11:39:38', '2025-02-19 11:39:38'),
(411, 'App\\Models\\PendingVendor', 11, '169f48c2-ef4e-4553-bd62-77a8be6d738a', 'commercial_registration_image', 'commercial_registration_image-1739967612', 'commercial_registration_image-1739967612.webp', 'image/webp', 'pending_vendors', 'pending_vendors', 49000, '[]', '[]', '[]', '[]', 38, '2025-02-19 12:20:20', '2025-02-19 12:20:20'),
(412, 'App\\Models\\Store', 8, 'ae748c35-0970-46f5-b385-ccfde4a43331', 'stores_image', 'stores_image-1740039631', 'stores_image-1740039631.jpg', 'image/webp', 'stores', 'stores', 1702, '[]', '[]', '[]', '[]', 39, '2025-02-20 08:20:47', '2025-02-20 08:20:47'),
(413, 'App\\Models\\Store', 10, 'c9298efe-7e4c-47b2-9b22-8352035513ea', 'stores_image', 'stores_image-1740039737', 'stores_image-1740039737.jpg', 'image/webp', 'stores', 'stores', 2812, '[]', '[]', '[]', '[]', 40, '2025-02-20 08:22:17', '2025-02-20 08:22:17'),
(414, 'App\\Models\\Store', 11, 'cbb64506-0e39-4a07-a7df-8b8f28ae094e', 'stores_image', 'stores_image-1740039770', 'stores_image-1740039770.webp', 'image/webp', 'stores', 'stores', 5368, '[]', '[]', '[]', '[]', 41, '2025-02-20 08:22:51', '2025-02-20 08:22:51'),
(415, 'App\\Models\\Brand', 9, '4a10dd3d-b74d-4ba9-9a79-ddba09ee675a', 'brands_image', 'brands_image-1740039800', 'brands_image-1740039800.webp', 'image/webp', 'brands', 'brands', 2190, '[]', '[]', '[]', '[]', 42, '2025-02-20 08:23:20', '2025-02-20 08:23:20'),
(416, 'App\\Models\\Store', 13, '0566236d-20f5-4727-b056-41ad1f7b64e5', 'stores_image', 'stores_image-1740040054', 'stores_image-1740040054.webp', 'image/webp', 'stores', 'stores', 1362, '[]', '[]', '[]', '[]', 43, '2025-02-20 08:27:37', '2025-02-20 08:27:37'),
(417, 'App\\Models\\Store', 1, '0a47af6b-f7cf-4731-8b04-ccfde180b62d', 'stores_image', 'stores_image-1740040096', 'stores_image-1740040096.webp', 'image/webp', 'stores', 'stores', 1458, '[]', '[]', '[]', '[]', 44, '2025-02-20 08:28:16', '2025-02-20 08:28:16'),
(418, 'App\\Models\\Store', 12, '4517cbd4-9862-4214-8cfe-7ea1993325ad', 'stores_image', 'stores_image-1740040121', 'stores_image-1740040121.webp', 'image/webp', 'stores', 'stores', 4162, '[]', '[]', '[]', '[]', 45, '2025-02-20 08:28:41', '2025-02-20 08:28:41'),
(419, 'App\\Models\\Category', 19, '190d4751-060d-4467-96d3-0f63feee70ac', 'categorys_image', 'categorys_image-1740040855', 'categorys_image-1740040855.webp', 'image/webp', 'categorys', 'categorys', 1966, '[]', '[]', '[]', '[]', 46, '2025-02-20 08:40:57', '2025-02-20 08:40:57'),
(420, 'App\\Models\\Category', 18, '3177d880-6d84-432f-a304-e34bd7740a9e', 'categorys_image', 'categorys_image-1740040915', 'categorys_image-1740040915.jpg', 'image/webp', 'categorys', 'categorys', 3372, '[]', '[]', '[]', '[]', 47, '2025-02-20 08:41:55', '2025-02-20 08:41:55'),
(421, 'App\\Models\\Category', 78, '6679870c-634e-4d11-bc01-f9e068e053f3', 'categorys_image', 'categorys_image-1740040946', 'categorys_image-1740040946.webp', 'image/webp', 'categorys', 'categorys', 1712, '[]', '[]', '[]', '[]', 48, '2025-02-20 08:42:26', '2025-02-20 08:42:26'),
(422, 'App\\Models\\Category', 21, '980b87d4-67e5-48c5-a7b9-4b8cedd27582', 'categorys_image', 'categorys_image-1740041044', 'categorys_image-1740041044.jpg', 'image/webp', 'categorys', 'categorys', 4598, '[]', '[]', '[]', '[]', 49, '2025-02-20 08:44:04', '2025-02-20 08:44:04'),
(423, 'App\\Models\\Category', 28, '9f8d4648-e6a3-4319-9b96-7a2637e0c187', 'categorys_image', 'categorys_image-1740041205', 'categorys_image-1740041205.webp', 'image/webp', 'categorys', 'categorys', 1236, '[]', '[]', '[]', '[]', 50, '2025-02-20 08:46:45', '2025-02-20 08:46:45'),
(424, 'App\\Models\\Category', 20, 'de7280d1-5554-4f3b-8ce4-07f6606fb337', 'categorys_image', 'categorys_image-1740041354', 'categorys_image-1740041354.webp', 'image/webp', 'categorys', 'categorys', 10100, '[]', '[]', '[]', '[]', 51, '2025-02-20 08:49:14', '2025-02-20 08:49:14'),
(425, 'App\\Models\\Product', 8, 'ec24b7d5-4abe-4c0d-ad76-333e58deda92', 'products_image', 'products_image-1740041475', 'products_image-1740041475.jpg', 'image/webp', 'products', 'products', 4456, '[]', '[]', '[]', '[]', 52, '2025-02-20 08:51:15', '2025-02-20 08:51:15'),
(426, 'App\\Models\\Product', 11, '8823e6b4-6c3e-4de5-9885-84a367273d9e', 'products_image', 'products_image-1740041856', 'products_image-1740041856.jpg', 'image/webp', 'products', 'products', 10254, '[]', '[]', '[]', '[]', 53, '2025-02-20 08:57:36', '2025-02-20 08:57:36'),
(427, 'App\\Models\\Product', 10, '7d702bcb-4906-4dd9-b28b-0897df86f325', 'products_image', 'products_image-1740041939', 'products_image-1740041939.jpg', 'image/webp', 'products', 'products', 2848, '[]', '[]', '[]', '[]', 54, '2025-02-20 08:58:59', '2025-02-20 08:58:59'),
(430, 'App\\Models\\Product', 7, '8e5be8f6-83fc-45b5-90ee-4dccda94f904', 'products_image', 'products_image-1740042201', 'products_image-1740042201.jpg', 'image/webp', 'products', 'products', 1808, '[]', '[]', '[]', '[]', 57, '2025-02-20 09:03:21', '2025-02-20 09:03:21'),
(431, 'App\\Models\\Product', 9, '22e875f5-8b1d-454f-a2bb-909baf52b60e', 'products_image', 'products_image-1740042204', 'products_image-1740042204.jpg', 'image/webp', 'products', 'products', 52666, '[]', '[]', '[]', '[]', 58, '2025-02-20 09:03:28', '2025-02-20 09:03:28'),
(432, 'App\\Models\\Product', 12, '7512580a-3f2a-4df0-ae1b-2380dbccef71', 'products_image', 'products_image-1740042405', 'products_image-1740042405.jpg', 'image/webp', 'products', 'products', 17176, '[]', '[]', '[]', '[]', 59, '2025-02-20 09:06:48', '2025-02-20 09:06:48'),
(433, 'App\\Models\\Product', 13, 'b942802a-df0e-46c5-b7a4-84730cfdc9fe', 'products_image', 'products_image-1740042460', 'products_image-1740042460.jpg', 'image/webp', 'products', 'products', 1138, '[]', '[]', '[]', '[]', 60, '2025-02-20 09:07:40', '2025-02-20 09:07:40'),
(434, 'App\\Models\\Product', 14, 'b75d9701-7329-4cfd-95ed-78bf352d0c40', 'products_image', 'products_image-1740042517', 'products_image-1740042517.jpg', 'image/webp', 'products', 'products', 57232, '[]', '[]', '[]', '[]', 61, '2025-02-20 09:08:39', '2025-02-20 09:08:39'),
(435, 'App\\Models\\Product', 16, 'e3f74e49-e0f9-4640-9b03-1eb13a7d7834', 'products_image', 'products_image-1740042587', 'products_image-1740042587.webp', 'image/webp', 'products', 'products', 7902, '[]', '[]', '[]', '[]', 62, '2025-02-20 09:09:47', '2025-02-20 09:09:47'),
(436, 'App\\Models\\Product', 19, '72e0aa50-2fde-4cc6-acd2-80cdaa098ad9', 'products_image', 'products_image-1740042624', 'products_image-1740042624.jpg', 'image/webp', 'products', 'products', 3332, '[]', '[]', '[]', '[]', 63, '2025-02-20 09:10:24', '2025-02-20 09:10:24'),
(437, 'App\\Models\\Product', 15, 'afcea09e-646d-4940-8b30-e799c33fec02', 'products_image', 'products_image-1740042674', 'products_image-1740042674.webp', 'image/webp', 'products', 'products', 16694, '[]', '[]', '[]', '[]', 64, '2025-02-20 09:11:14', '2025-02-20 09:11:14'),
(438, 'App\\Models\\Product', 27, '1ef30ced-fedd-4fa8-988e-c2edd90d7f7f', 'products_image', 'products_image-1740042756', 'products_image-1740042756.jpg', 'image/webp', 'products', 'products', 37172, '[]', '[]', '[]', '[]', 65, '2025-02-20 09:12:37', '2025-02-20 09:12:37'),
(439, 'App\\Models\\Brand', 10, 'd85f97da-8f1a-4021-86ca-942c21caf94a', 'brands_image', 'brands_image-1740042862', 'brands_image-1740042862.webp', 'image/webp', 'brands', 'brands', 1462, '[]', '[]', '[]', '[]', 66, '2025-02-20 09:14:22', '2025-02-20 09:14:22'),
(440, 'App\\Models\\Product', 25, 'ee48aea2-6b6b-4be2-94b2-96af3eedcc48', 'products_image', 'products_image-1740043075', 'products_image-1740043075.jpg', 'image/webp', 'products', 'products', 2638, '[]', '[]', '[]', '[]', 67, '2025-02-20 09:17:55', '2025-02-20 09:17:55'),
(441, 'App\\Models\\Product', 26, '75bcea5b-1d29-4a8c-91c4-d39fc83f0031', 'products_image', 'products_image-1740043212', 'products_image-1740043212.webp', 'image/webp', 'products', 'products', 34008, '[]', '[]', '[]', '[]', 68, '2025-02-20 09:20:13', '2025-02-20 09:20:13'),
(442, 'App\\Models\\User', 57, '185d5956-df1c-4c9a-b7b7-04592967cb4c', 'photo_profile', 'moh', 'moh.webp', 'image/webp', 'users', 'users', 16072, '[]', '[]', '[]', '[]', 69, '2025-02-20 10:09:37', '2025-02-20 10:09:37'),
(443, 'App\\Models\\User', 25, '5475dd24-b47a-427b-b450-67410e34c213', 'photo_profile', 'wes', 'wes.jpg', 'image/jpeg', 'users', 'users', 7511, '[]', '[]', '[]', '[]', 70, '2025-02-20 10:09:41', '2025-02-20 10:09:41'),
(445, 'App\\Models\\User', 26, '399d5c18-041e-418d-a169-560f08a32ea4', 'photo_profile', 'mai', 'mai.png', 'image/png', 'users', 'users', 22268, '[]', '[]', '[]', '[]', 71, '2025-02-20 10:54:52', '2025-02-20 10:54:52'),
(446, 'App\\Models\\User', 57, 'f7fdb0e8-19dd-41e7-b000-47fac92a6cc6', 'photo_profile', 'photo_profile-1740050120', 'photo_profile-1740050120.webp', 'image/webp', 'users', 'users', 8852, '[]', '[]', '[]', '[]', 72, '2025-02-20 11:15:21', '2025-02-20 11:15:21'),
(447, 'App\\Models\\User', 26, '9afac199-195a-4c89-9013-126fa6bfc81c', 'photo_profile', 'photo_profile-1740050120', 'photo_profile-1740050120.webp', 'image/webp', 'users', 'users', 9616, '[]', '[]', '[]', '[]', 72, '2025-02-20 11:15:21', '2025-02-20 11:15:21'),
(448, 'App\\Models\\User', 25, '2dd745c7-1fe9-4af6-ad03-c3724d991922', 'photo_profile', 'photo_profile-1740050120', 'photo_profile-1740050120.jpg', 'image/webp', 'users', 'users', 4388, '[]', '[]', '[]', '[]', 72, '2025-02-20 11:15:21', '2025-02-20 11:15:21'),
(449, 'App\\Models\\User', 57, '84d55e20-d15c-4c96-8b7b-18b7f2a02088', 'photo_profile', 'photo_profile-1740050169', 'photo_profile-1740050169.webp', 'image/webp', 'users', 'users', 8852, '[]', '[]', '[]', '[]', 73, '2025-02-20 11:16:09', '2025-02-20 11:16:09'),
(450, 'App\\Models\\User', 32, 'e2e51ca9-a6d6-4399-a47c-e4f30282412e', 'photo_profile', 'photo_profile-1740050466', 'photo_profile-1740050466.webp', 'image/webp', 'users', 'users', 5332, '[]', '[]', '[]', '[]', 74, '2025-02-20 11:21:07', '2025-02-20 11:21:07'),
(451, 'App\\Models\\User', 32, 'e9947361-9117-44e4-837c-4ac3ba7d99d1', 'photo_profile', 'photo_profile-1740050566', 'photo_profile-1740050566.webp', 'image/webp', 'users', 'users', 4288, '[]', '[]', '[]', '[]', 75, '2025-02-20 11:22:46', '2025-02-20 11:22:46'),
(452, 'App\\Models\\Product', 7, '428235a2-3240-4b8a-8165-a1f8e558c88d', 'document', 'sep', 'sep.png', 'image/png', 'products_images', 'products_images', 1690, '[]', '[]', '[]', '[]', 76, '2025-02-20 14:29:31', '2025-02-20 14:29:31'),
(453, 'App\\Models\\Product', 7, 'ecef9882-5016-4834-b595-abe109e96ac2', 'document', 'wes', 'wes.jpg', 'image/jpeg', 'products_images', 'products_images', 7511, '[]', '[]', '[]', '[]', 77, '2025-02-20 14:29:32', '2025-02-20 14:29:32'),
(457, 'App\\Models\\User', 70, '9418b95b-d041-4d14-9f72-8f28f5857f17', 'photo_profile', 'photo_profile-1740568870', 'photo_profile-1740568870.webp', 'image/webp', 'users', 'users', 9616, '[]', '[]', '[]', '[]', 78, '2025-02-26 11:21:10', '2025-02-26 11:21:10'),
(458, 'App\\Models\\User', 1, 'ee381641-1a1c-4dad-9643-b558b28e5aae', 'photo_profile', 'photo_profile-1741511304', 'photo_profile-1741511304.jpg', 'image/webp', 'users', 'users', 4388, '[]', '[]', '[]', '[]', 79, '2025-03-09 09:08:48', '2025-03-09 09:08:48'),
(459, 'App\\Models\\Product', 1, 'ecab98f4-e095-4789-ab50-fc257d8ad2ac', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 80, '2025-04-20 19:22:54', '2025-04-20 19:22:54'),
(460, 'App\\Models\\Product', 1, '51e09257-25f7-4483-8e63-936790d0282e', 'document', 'aboutt', 'aboutt.png', 'image/png', 'products_images', 'products_images', 187275, '[]', '[]', '[]', '[]', 81, '2025-04-20 19:22:54', '2025-04-20 19:22:54'),
(462, 'App\\Models\\Product', 44, '6a6b0ca3-6f15-4101-8fa3-7f70c20782d5', 'products_image', 'products_image-1745542802', 'products_image-1745542802.webp', 'image/webp', 'products', 'products', 44850, '[]', '[]', '[]', '[]', 83, '2025-04-25 01:00:08', '2025-04-25 01:00:08'),
(463, 'App\\Models\\Product', 44, 'c2579617-0a8e-49dc-9f93-3ef23b89b7dd', 'document', 'background', 'background.png', 'image/png', 'products_images', 'products_images', 2418456, '[]', '[]', '[]', '[]', 84, '2025-04-25 01:00:09', '2025-04-25 01:00:09'),
(464, 'App\\Models\\Product', 44, '63dda9bd-35e8-402a-aa7e-e212a8d665ed', 'document', 'build', 'build.png', 'image/png', 'products_images', 'products_images', 333077, '[]', '[]', '[]', '[]', 85, '2025-04-25 01:00:09', '2025-04-25 01:00:09'),
(465, 'App\\Models\\Product', 45, '93584520-cd96-4080-ad36-467cfb150b10', 'products_image', 'products_image-1745542923', 'products_image-1745542923.webp', 'image/webp', 'products', 'products', 44850, '[]', '[]', '[]', '[]', 86, '2025-04-25 01:02:04', '2025-04-25 01:02:04'),
(466, 'App\\Models\\Product', 45, '0b92f1ca-157c-4a24-8d67-adf5f27c1bda', 'document', 'background', 'background.png', 'image/png', 'products_images', 'products_images', 2418456, '[]', '[]', '[]', '[]', 87, '2025-04-25 01:02:04', '2025-04-25 01:02:04'),
(467, 'App\\Models\\Product', 45, '0d949518-0aa7-48aa-8fde-3f8c325beff3', 'document', 'build', 'build.png', 'image/png', 'products_images', 'products_images', 333077, '[]', '[]', '[]', '[]', 88, '2025-04-25 01:02:04', '2025-04-25 01:02:04'),
(468, 'App\\Models\\Product', 46, 'b4a398dd-18bd-4f5c-b7da-cbce21f764d3', 'products_image', 'products_image-1745544419', 'products_image-1745544419.webp', 'image/webp', 'products', 'products', 44850, '[]', '[]', '[]', '[]', 89, '2025-04-25 01:27:00', '2025-04-25 01:27:00'),
(469, 'App\\Models\\Product', 46, '15026249-0bf6-4adc-bab0-40685a9dd900', 'document', 'background', 'background.png', 'image/png', 'products_images', 'products_images', 2418456, '[]', '[]', '[]', '[]', 90, '2025-04-25 01:27:00', '2025-04-25 01:27:00'),
(470, 'App\\Models\\Product', 46, 'c6e7b629-6c06-467f-bc13-7c4111c1cee4', 'document', 'build', 'build.png', 'image/png', 'products_images', 'products_images', 333077, '[]', '[]', '[]', '[]', 91, '2025-04-25 01:27:00', '2025-04-25 01:27:00'),
(471, 'App\\Models\\Product', 47, 'd0f118d7-7fbe-40d4-b0a8-4eac4831861b', 'products_image', 'products_image-1745592176', 'products_image-1745592176.webp', 'image/webp', 'products', 'products', 44850, '[]', '[]', '[]', '[]', 92, '2025-04-25 14:42:56', '2025-04-25 14:42:56'),
(472, 'App\\Models\\Product', 47, '0af576e4-f1ed-4ead-9ba9-7347e5dab462', 'document', 'build', 'build.png', 'image/png', 'products_images', 'products_images', 333077, '[]', '[]', '[]', '[]', 93, '2025-04-25 14:42:56', '2025-04-25 14:42:56'),
(473, 'App\\Models\\Product', 47, '6262fab4-6d01-42c9-8250-dd3fce3616df', 'document', 'Dubai-Marina-1', 'Dubai-Marina-1.png', 'image/png', 'products_images', 'products_images', 359774, '[]', '[]', '[]', '[]', 94, '2025-04-25 14:42:56', '2025-04-25 14:42:56'),
(474, 'App\\Models\\Product', 48, '2106dc59-f191-4458-8416-46c13f2b54d2', 'products_image', 'products_image-1745592738', 'products_image-1745592738.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 95, '2025-04-25 14:52:19', '2025-04-25 14:52:19'),
(475, 'App\\Models\\Product', 48, 'e1677daf-87f2-436c-89a3-02c6ba9a6ae3', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 96, '2025-04-25 14:52:19', '2025-04-25 14:52:19'),
(476, 'App\\Models\\Product', 49, 'dfebe5ac-6bb2-43bc-bb5f-7ac51e76471c', 'products_image', 'products_image-1745592786', 'products_image-1745592786.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 97, '2025-04-25 14:53:06', '2025-04-25 14:53:06'),
(477, 'App\\Models\\Product', 49, '5ae31cac-0b7d-4e51-8661-05601963158a', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 98, '2025-04-25 14:53:06', '2025-04-25 14:53:06'),
(478, 'App\\Models\\Product', 50, '23b8d9b1-0c0e-4575-9cdc-fbd99ca6cacf', 'products_image', 'products_image-1745592832', 'products_image-1745592832.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 99, '2025-04-25 14:53:52', '2025-04-25 14:53:52'),
(479, 'App\\Models\\Product', 50, '4f336a99-2ed0-401c-b49a-787a712937e2', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 100, '2025-04-25 14:53:52', '2025-04-25 14:53:52'),
(480, 'App\\Models\\Product', 51, '54ad3568-0275-4f7c-9a9c-56a973e5ad44', 'products_image', 'products_image-1745592852', 'products_image-1745592852.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 101, '2025-04-25 14:54:12', '2025-04-25 14:54:12'),
(481, 'App\\Models\\Product', 51, 'bce480b0-1f4b-4385-b760-ba9064ad731c', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 102, '2025-04-25 14:54:13', '2025-04-25 14:54:13'),
(482, 'App\\Models\\Product', 52, '28143db6-ae3c-4650-aee7-5e5265d3960e', 'products_image', 'products_image-1745592867', 'products_image-1745592867.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 103, '2025-04-25 14:54:27', '2025-04-25 14:54:27'),
(483, 'App\\Models\\Product', 52, '6e006c4a-7f2a-4142-b2c3-1ac6c96f5132', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 104, '2025-04-25 14:54:28', '2025-04-25 14:54:28'),
(484, 'App\\Models\\Product', 53, 'c30f42db-e2d5-4c37-ab70-3860c40eddc4', 'products_image', 'products_image-1745592878', 'products_image-1745592878.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 105, '2025-04-25 14:54:38', '2025-04-25 14:54:38'),
(485, 'App\\Models\\Product', 53, '1eb45e74-9b55-481a-9e29-de226ea49e6d', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 106, '2025-04-25 14:54:38', '2025-04-25 14:54:38'),
(486, 'App\\Models\\Product', 54, '33b798c2-893c-4b68-9b38-e70ba646c4db', 'products_image', 'products_image-1745592888', 'products_image-1745592888.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 107, '2025-04-25 14:54:48', '2025-04-25 14:54:48'),
(487, 'App\\Models\\Product', 54, '48f33a1c-a401-419c-a7b5-73ccac91fca0', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 108, '2025-04-25 14:54:48', '2025-04-25 14:54:48'),
(488, 'App\\Models\\Product', 55, '46f8dd3a-1919-49cd-84a6-d909d33b7b43', 'products_image', 'products_image-1745592914', 'products_image-1745592914.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 109, '2025-04-25 14:55:14', '2025-04-25 14:55:14'),
(489, 'App\\Models\\Product', 55, 'a816093a-82e7-46f9-adcd-4fa70e07fb56', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 110, '2025-04-25 14:55:14', '2025-04-25 14:55:14'),
(490, 'App\\Models\\Product', 56, 'f55727e8-57e9-443b-b027-368c7cb4cbc3', 'products_image', 'products_image-1745592958', 'products_image-1745592958.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 111, '2025-04-25 14:55:58', '2025-04-25 14:55:58'),
(491, 'App\\Models\\Product', 56, '80aa7f01-7ae4-4df1-82f9-7557df24fc15', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 112, '2025-04-25 14:55:58', '2025-04-25 14:55:58'),
(492, 'App\\Models\\Product', 57, 'ff7e50df-9fe8-4cec-ba9a-ba275d7213d0', 'products_image', 'products_image-1745592983', 'products_image-1745592983.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 113, '2025-04-25 14:56:23', '2025-04-25 14:56:23'),
(493, 'App\\Models\\Product', 57, 'a75de141-c548-4bc4-b95a-2ccffe929d6d', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 114, '2025-04-25 14:56:23', '2025-04-25 14:56:23'),
(494, 'App\\Models\\Product', 58, '66bed763-4536-4199-85c8-6fad6896b8c7', 'products_image', 'products_image-1745592992', 'products_image-1745592992.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 115, '2025-04-25 14:56:32', '2025-04-25 14:56:32'),
(495, 'App\\Models\\Product', 58, '5ed7ec39-3e3a-432c-9309-d8b4ca90a205', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 116, '2025-04-25 14:56:32', '2025-04-25 14:56:32'),
(496, 'App\\Models\\Product', 59, 'c600da69-999a-4da6-a779-13ff34cc2071', 'products_image', 'products_image-1745593078', 'products_image-1745593078.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 117, '2025-04-25 14:57:58', '2025-04-25 14:57:58'),
(497, 'App\\Models\\Product', 59, 'a38504b9-41de-4448-aa5a-9dce7476d7d5', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 118, '2025-04-25 14:57:58', '2025-04-25 14:57:58'),
(498, 'App\\Models\\Product', 60, 'dff599bd-d323-46bb-9679-1d904792c537', 'products_image', 'products_image-1745593092', 'products_image-1745593092.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 119, '2025-04-25 14:58:13', '2025-04-25 14:58:13'),
(499, 'App\\Models\\Product', 60, '0167e9fb-92a0-4834-9c95-a13c88b4c9fb', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 120, '2025-04-25 14:58:13', '2025-04-25 14:58:13'),
(500, 'App\\Models\\Product', 61, '0242bed5-cfcd-4b5b-a3cc-05e56ff2b74f', 'products_image', 'products_image-1745593104', 'products_image-1745593104.webp', 'image/webp', 'products', 'products', 21342, '[]', '[]', '[]', '[]', 121, '2025-04-25 14:58:24', '2025-04-25 14:58:24'),
(501, 'App\\Models\\Product', 61, '81f1351c-7ace-43e0-a4cc-51cbc1d89c79', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 122, '2025-04-25 14:58:24', '2025-04-25 14:58:24'),
(502, 'App\\Models\\Product', 62, '5ece4fa3-566b-47dc-a496-680e702080ea', 'products_image', 'products_image-1745622677', 'products_image-1745622677.webp', 'image/webp', 'products', 'products', 44850, '[]', '[]', '[]', '[]', 123, '2025-04-25 23:11:19', '2025-04-25 23:11:19'),
(503, 'App\\Models\\Product', 62, '87db770a-d221-4c15-aef4-07974fbe807b', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 124, '2025-04-25 23:11:20', '2025-04-25 23:11:20'),
(504, 'App\\Models\\Product', 63, 'fab8a922-b19a-4b9b-a61a-964f24d93602', 'products_image', 'products_image-1745622757', 'products_image-1745622757.webp', 'image/webp', 'products', 'products', 44850, '[]', '[]', '[]', '[]', 125, '2025-04-25 23:12:37', '2025-04-25 23:12:37'),
(505, 'App\\Models\\Product', 63, '8159c7f2-7bd4-4d84-82dd-d58ecd7ddad7', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 126, '2025-04-25 23:12:37', '2025-04-25 23:12:37'),
(506, 'App\\Models\\Product', 64, 'a1fe3ab1-8026-47d1-a119-a1db54579e88', 'products_image', 'products_image-1745622868', 'products_image-1745622868.webp', 'image/webp', 'products', 'products', 44850, '[]', '[]', '[]', '[]', 127, '2025-04-25 23:14:28', '2025-04-25 23:14:28'),
(507, 'App\\Models\\Product', 64, '4e991203-0e41-4274-b562-ab971dfa0fa2', 'document', 'about', 'about.png', 'image/png', 'products_images', 'products_images', 261578, '[]', '[]', '[]', '[]', 128, '2025-04-25 23:14:29', '2025-04-25 23:14:29'),
(510, 'App\\Models\\Product', 1, '892e55d8-e0a6-49a7-a405-d6891cece0bc', 'products_image', 'products_image-1745693964', 'products_image-1745693964.webp', 'image/webp', 'products', 'products', 44850, '[]', '[]', '[]', '[]', 129, '2025-04-26 18:59:24', '2025-04-26 18:59:24'),
(511, 'App\\Models\\Product', 65, '7cbdd744-644d-49fa-a42d-a3518663806c', 'products_image', 'products_image-1745926526', 'products_image-1745926526.webp', 'image/webp', 'products', 'products', 44850, '[]', '[]', '[]', '[]', 130, '2025-04-29 11:35:28', '2025-04-29 11:35:28'),
(512, 'App\\Models\\Product', 65, '6f4fc65b-44ca-4193-a216-21c0d4de44d9', 'document', 'background', 'background.png', 'image/png', 'products_images', 'products_images', 2418456, '[]', '[]', '[]', '[]', 131, '2025-04-29 11:35:29', '2025-04-29 11:35:29'),
(513, 'App\\Models\\Blog', 12, 'a794d513-c2c8-4cc7-b146-8f93f692bbba', 'blogs_image', 'blogs_image-1745945744', 'blogs_image-1745945744.webp', 'image/webp', 'blogs', 'blogs', 44850, '[]', '[]', '[]', '[]', 132, '2025-04-29 16:55:45', '2025-04-29 16:55:45'),
(514, 'App\\Models\\Blog', 10, 'b2015d0e-a0a1-4998-9501-9da3c864e2d0', 'blogs_image', 'blogs_image-1745945748', 'blogs_image-1745945748.webp', 'image/webp', 'blogs', 'blogs', 44850, '[]', '[]', '[]', '[]', 133, '2025-04-29 16:55:48', '2025-04-29 16:55:48'),
(515, 'App\\Models\\Blog', 11, '84b3bde2-b473-4f90-932c-c601569c2ee5', 'blogs_image', 'blogs_image-1745945754', 'blogs_image-1745945754.webp', 'image/webp', 'blogs', 'blogs', 98340, '[]', '[]', '[]', '[]', 134, '2025-04-29 16:55:54', '2025-04-29 16:55:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_08_03_074332_create_admins_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2021_11_11_923722_create_blogs_table', 1),
(6, '2022_08_03_121842_create_media_table', 1),
(7, '2022_08_05_174522_create_permission_tables', 1),
(8, '2022_08_09_145144_create_settings_table', 1),
(9, '2022_08_09_145300_create_general_settings', 1),
(10, '2022_08_17_095029_create_notifications_table', 1),
(11, '2023_02_06_124821_create_abouts_table', 1),
(12, '2023_02_06_124838_create_contacts_table', 1),
(13, '2023_11_14_115856_create_gates_table', 2),
(14, '2023_11_14_120122_create_slots_table', 2),
(15, '2023_11_14_120157_create_tickets_table', 2),
(16, '2023_11_14_120338_create_complaints_table', 2),
(17, '2023_11_14_120426_create_packages_table', 2),
(18, '2023_12_10_211133_create_services_table', 3),
(19, '2023_12_10_211323_create_categories_table', 3),
(20, '2023_12_10_215249_create_category_services_table', 4),
(21, '2019_12_14_000001_create_personal_access_tokens_table', 5),
(22, '2024_12_03_162636_create_activity_log_table', 6),
(23, '2024_12_03_162637_add_event_column_to_activity_log_table', 6),
(24, '2024_12_03_162638_add_batch_uuid_column_to_activity_log_table', 6),
(26, '2024_11_09_145144_create_settings_table', 8),
(27, '2024_12_08_112226_create_general_settings', 8),
(28, '2024_12_08_112851_create_seo_settings', 9),
(29, '2024_12_08_113859_create_social_settings', 9),
(30, '2024_12_08_113839_create_social_settings', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\Admin', 6),
(1, 'App\\Models\\User', 12),
(1, 'App\\Models\\User', 14),
(1, 'App\\Models\\User', 15),
(1, 'App\\Models\\User', 17),
(1, 'App\\Models\\User', 18),
(1, 'App\\Models\\User', 21),
(1, 'App\\Models\\User', 27),
(1, 'App\\Models\\User', 33),
(1, 'App\\Models\\User', 47),
(1, 'App\\Models\\User', 56),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 23),
(2, 'App\\Models\\User', 60),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 33),
(3, 'App\\Models\\User', 59),
(4, 'App\\Models\\User', 32),
(4, 'App\\Models\\User', 34),
(4, 'App\\Models\\User', 35),
(4, 'App\\Models\\User', 36),
(4, 'App\\Models\\User', 37),
(4, 'App\\Models\\User', 38),
(4, 'App\\Models\\User', 39),
(4, 'App\\Models\\User', 40),
(4, 'App\\Models\\User', 41),
(4, 'App\\Models\\User', 42),
(4, 'App\\Models\\User', 43),
(4, 'App\\Models\\User', 44),
(4, 'App\\Models\\User', 45),
(4, 'App\\Models\\User', 46),
(4, 'App\\Models\\User', 48),
(4, 'App\\Models\\User', 49),
(4, 'App\\Models\\User', 50),
(4, 'App\\Models\\User', 51),
(4, 'App\\Models\\User', 56),
(4, 'App\\Models\\User', 58),
(4, 'App\\Models\\User', 60),
(4, 'App\\Models\\User', 76),
(6, 'App\\Models\\User', 22);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('02a6542a-faae-47e8-861a-b432e32d8c5b', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/58\",\"data\":{\"notification_type\":3,\"product_id\":58,\"listing_number\":\"AUC11202558\"},\"created_at\":\"2025-04-25T14:56:32.000000Z\"}', '2025-04-25 15:04:05', '2025-04-25 14:56:33', '2025-04-25 15:04:05'),
('13eb3121-4969-429c-ae80-bc22dded4f08', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/59\",\"data\":{\"notification_type\":3,\"product_id\":59,\"listing_number\":\"AUC11202559\"},\"created_at\":\"2025-04-25T14:57:58.000000Z\"}', NULL, '2025-04-25 14:57:59', '2025-04-25 14:57:59'),
('176dc086-8211-48dc-8aab-129b1853c83a', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/49\",\"data\":{\"notification_type\":3,\"product_id\":49,\"listing_number\":\"AUC11202548\"},\"created_at\":\"2025-04-25T14:53:06.000000Z\"}', '2025-04-25 15:04:05', '2025-04-25 14:53:09', '2025-04-25 15:04:05'),
('197a4ce6-a1da-4283-9030-fc8d261ed202', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Culpa rerum recusan \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/71\",\"data\":{\"notification_type\":3,\"product_id\":71,\"listing_number\":\"AUC11202571\"},\"created_at\":\"2025-04-29T14:13:45.000000Z\"}', NULL, '2025-04-29 14:13:46', '2025-04-29 14:13:46'),
('19c36b8c-8abe-41fc-b18c-50e2e2f13b00', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Consequatur est par \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/68\",\"data\":{\"notification_type\":3,\"product_id\":68,\"listing_number\":\"SHA13202568\"},\"created_at\":\"2025-04-29T12:24:52.000000Z\"}', NULL, '2025-04-29 12:24:53', '2025-04-29 12:24:53'),
('1a649797-eaa8-48f1-a654-acc3bb9d05fc', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Gisela Shaw\",\"redirect\":\"pending_vendors\\/10\",\"data\":[],\"created_at\":\"2025-01-24T20:16:59.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 20:17:00', '2025-01-24 20:22:28'),
('1e6a0f06-9811-45ae-8dcd-615c752d8af1', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Dolores nihil sed ni \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/69\",\"data\":{\"notification_type\":3,\"product_id\":69,\"listing_number\":\"SHA13202569\"},\"created_at\":\"2025-04-29T12:45:26.000000Z\"}', NULL, '2025-04-29 12:45:30', '2025-04-29 12:45:30'),
('1e8ea9c8-9d02-48f2-861d-81ffb8810cb2', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Consequatur est par \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/68\",\"data\":{\"notification_type\":3,\"product_id\":68,\"listing_number\":\"SHA13202568\"},\"created_at\":\"2025-04-29T12:24:52.000000Z\"}', NULL, '2025-04-29 12:24:53', '2025-04-29 12:24:53'),
('2059f7f7-99f1-487b-8180-135ff0f219a4', 'App\\Notifications\\InvestmentCompletedNotification', 'App\\Models\\User', 77, '{\"title\":\"\\u0627\\u0643\\u062a\\u0645\\u0644 \\u0627\\u0644\\u0627\\u0633\\u062a\\u062b\\u0645\\u0627\\u0631\",\"body\":\"\\u062a\\u0645 \\u0627\\u0643\\u062a\\u0645\\u0627\\u0644 \\u0627\\u0644\\u0627\\u0633\\u062a\\u062b\\u0645\\u0627\\u0631 \\u0641\\u064a \\u0627\\u0644\\u0639\\u0642\\u0627\\u0631 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0634\\u0627\\u0631\\u0643 \\u0628\\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629. \\u0634\\u0643\\u0631\\u064b\\u0627 \\u0644\\u0645\\u0634\\u0627\\u0631\\u0643\\u062a\\u0643!\"}', NULL, '2025-04-26 21:04:14', '2025-04-26 21:04:14'),
('26d9cebb-7a50-4529-a7ab-21ef10fc34ac', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Dolor cillum consequ \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/64\",\"data\":{\"notification_type\":3,\"product_id\":64,\"listing_number\":\"SHA13202564\"},\"created_at\":\"2025-04-25T23:14:28.000000Z\"}', NULL, '2025-04-25 23:14:33', '2025-04-25 23:14:33'),
('26f298b7-fe80-4cba-acf0-eea2382d5b6d', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Julian Davis\",\"redirect\":\"pending_vendors\\/6\",\"data\":[],\"created_at\":\"2025-01-24T20:03:59.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 20:03:59', '2025-01-24 20:22:28'),
('2a245e8d-8bc7-4431-a5e1-ab2200a62bfa', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   xcfvgbhnjk\",\"redirect\":\"contacts\\/#td-30\",\"data\":{\"id\":30,\"name\":\"xcfvgbhnjk\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-03T12:34:42.000000Z\"}', NULL, '2025-02-03 12:34:43', '2025-02-03 12:34:43'),
('307839eb-0393-471c-afc2-ff6cd11c6c8b', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Consequatur unde qu \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/65\",\"data\":{\"notification_type\":3,\"product_id\":65,\"listing_number\":\"SHA13202565\"},\"created_at\":\"2025-04-29T11:35:26.000000Z\"}', NULL, '2025-04-29 11:35:39', '2025-04-29 11:35:39'),
('3245c40f-313a-423d-a1e1-f5c22362f600', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/60\",\"data\":{\"notification_type\":3,\"product_id\":60,\"listing_number\":\"AUC11202560\"},\"created_at\":\"2025-04-25T14:58:12.000000Z\"}', NULL, '2025-04-25 14:58:14', '2025-04-25 14:58:14'),
('34f263ec-a5f1-4341-a6cf-6e527508dadc', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Numquam numquam quia \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/70\",\"data\":{\"notification_type\":3,\"product_id\":70,\"listing_number\":\"AUC11202570\"},\"created_at\":\"2025-04-29T13:53:05.000000Z\"}', NULL, '2025-04-29 13:53:07', '2025-04-29 13:53:07'),
('35ecd4a0-f9a7-40d7-aa72-16f660323202', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Culpa rerum recusan \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/71\",\"data\":{\"notification_type\":3,\"product_id\":71,\"listing_number\":\"AUC11202571\"},\"created_at\":\"2025-04-29T14:13:45.000000Z\"}', NULL, '2025-04-29 14:13:46', '2025-04-29 14:13:46'),
('3b76439a-0eee-4961-b633-ad7a698e4370', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/58\",\"data\":{\"notification_type\":3,\"product_id\":58,\"listing_number\":\"AUC11202558\"},\"created_at\":\"2025-04-25T14:56:32.000000Z\"}', NULL, '2025-04-25 14:56:33', '2025-04-25 14:56:33'),
('3cc58efb-559a-45e5-9fe6-02c8292e35ba', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Non sunt aperiam lab \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/66\",\"data\":{\"notification_type\":3,\"product_id\":66,\"listing_number\":\"SHA13202566\"},\"created_at\":\"2025-04-29T12:19:48.000000Z\"}', NULL, '2025-04-29 12:19:50', '2025-04-29 12:19:50'),
('3e271eb1-9794-4db8-a5cc-15f812f387d7', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/49\",\"data\":{\"notification_type\":3,\"product_id\":49,\"listing_number\":\"AUC11202548\"},\"created_at\":\"2025-04-25T14:53:06.000000Z\"}', NULL, '2025-04-25 14:53:09', '2025-04-25 14:53:09'),
('4321a140-62d7-4f59-8865-eaceb6d30de8', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Atque ad rerum in pa \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/72\",\"data\":{\"notification_type\":3,\"product_id\":72,\"listing_number\":\"AUC11202572\"},\"created_at\":\"2025-04-29T16:04:55.000000Z\"}', NULL, '2025-04-29 16:04:56', '2025-04-29 16:04:56'),
('45e0dfa7-1bba-4bbb-a52c-ffcfc4a03daf', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Imani Hubbard\",\"redirect\":\"pending_vendors\\/2\",\"data\":[],\"created_at\":\"2025-01-23T22:47:13.000000Z\"}', '2025-01-23 22:47:45', '2025-01-23 22:47:13', '2025-01-23 22:47:45'),
('4727d0b6-1e75-4117-b21b-68b60be6bd7d', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Culpa rerum recusan \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/71\",\"data\":{\"notification_type\":3,\"product_id\":71,\"listing_number\":\"AUC11202571\"},\"created_at\":\"2025-04-29T14:13:45.000000Z\"}', NULL, '2025-04-29 14:13:46', '2025-04-29 14:13:46'),
('4a894f68-da1b-4f8f-b56d-aa50aff96d5a', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/52\",\"data\":{\"notification_type\":3,\"product_id\":52,\"listing_number\":\"AUC11202552\"},\"created_at\":\"2025-04-25T14:54:27.000000Z\"}', '2025-04-25 15:04:05', '2025-04-25 14:54:28', '2025-04-25 15:04:05'),
('4bb7b2d5-369b-4bb3-a36d-62611f9fe7ab', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/57\",\"data\":{\"notification_type\":3,\"product_id\":57,\"listing_number\":\"AUC11202557\"},\"created_at\":\"2025-04-25T14:56:23.000000Z\"}', NULL, '2025-04-25 14:56:24', '2025-04-25 14:56:24'),
('4e38e8b8-0c7c-49fa-b0e7-e4601fe5ca8b', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/52\",\"data\":{\"notification_type\":3,\"product_id\":52,\"listing_number\":\"AUC11202552\"},\"created_at\":\"2025-04-25T14:54:27.000000Z\"}', NULL, '2025-04-25 14:54:28', '2025-04-25 14:54:28'),
('510b9e3a-75f0-4f68-b0b2-6f5a0ffa9d52', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Abdullah\",\"redirect\":\"pending_vendors\\/13\",\"data\":[],\"created_at\":\"2025-02-06T12:36:18.000000Z\"}', '2025-02-06 12:36:41', '2025-02-06 12:36:18', '2025-02-06 12:36:41'),
('5280e480-aa73-4537-bd8f-cc6d88277e33', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/49\",\"data\":{\"notification_type\":3,\"product_id\":49,\"listing_number\":\"AUC11202548\"},\"created_at\":\"2025-04-25T14:53:06.000000Z\"}', NULL, '2025-04-25 14:53:09', '2025-04-25 14:53:09'),
('53c5c2f6-1f42-4f97-a752-e564a96bee98', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/55\",\"data\":{\"notification_type\":3,\"product_id\":55,\"listing_number\":\"AUC11202555\"},\"created_at\":\"2025-04-25T14:55:14.000000Z\"}', NULL, '2025-04-25 14:55:15', '2025-04-25 14:55:15'),
('547c49a3-4afa-4db0-b357-36178d25b770', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/51\",\"data\":{\"notification_type\":3,\"product_id\":51,\"listing_number\":\"AUC11202551\"},\"created_at\":\"2025-04-25T14:54:12.000000Z\"}', NULL, '2025-04-25 14:54:13', '2025-04-25 14:54:13'),
('5918c690-34b6-43dc-a393-0491b1f11068', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   Abdullah Ashraf\",\"redirect\":\"contacts\\/#td-31\",\"data\":{\"id\":31,\"name\":\"Abdullah Ashraf\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-06T11:25:55.000000Z\"}', '2025-02-06 11:29:08', '2025-02-06 11:25:55', '2025-02-06 11:29:08'),
('595bda78-0858-4ed5-a222-fb3679e09afe', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/50\",\"data\":{\"notification_type\":3,\"product_id\":50,\"listing_number\":\"AUC11202550\"},\"created_at\":\"2025-04-25T14:53:52.000000Z\"}', NULL, '2025-04-25 14:53:53', '2025-04-25 14:53:53'),
('5a97e480-64d6-4357-8e90-f9586e4595c0', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  mai tarek\",\"redirect\":\"pending_vendors\\/8\",\"data\":[],\"created_at\":\"2025-01-24T20:08:10.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 20:08:11', '2025-01-24 20:22:28'),
('5c5b609d-27f9-48df-b95a-de058cdc6498', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Dolor cillum consequ \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/64\",\"data\":{\"notification_type\":3,\"product_id\":64,\"listing_number\":\"SHA13202564\"},\"created_at\":\"2025-04-25T23:14:28.000000Z\"}', NULL, '2025-04-25 23:14:33', '2025-04-25 23:14:33'),
('5d547688-e4bb-4fe1-bd8a-66780d93fc67', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/51\",\"data\":{\"notification_type\":3,\"product_id\":51,\"listing_number\":\"AUC11202551\"},\"created_at\":\"2025-04-25T14:54:12.000000Z\"}', NULL, '2025-04-25 14:54:13', '2025-04-25 14:54:13'),
('5e2da0b7-fc98-4341-8af3-62ce3480db65', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/61\",\"data\":{\"notification_type\":3,\"product_id\":61,\"listing_number\":\"AUC11202561\"},\"created_at\":\"2025-04-25T14:58:24.000000Z\"}', NULL, '2025-04-25 14:58:25', '2025-04-25 14:58:25'),
('61368f2e-5349-49c3-abbb-e258a6dc7fef', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Dolores nihil sed ni \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/69\",\"data\":{\"notification_type\":3,\"product_id\":69,\"listing_number\":\"SHA13202569\"},\"created_at\":\"2025-04-29T12:45:26.000000Z\"}', NULL, '2025-04-29 12:45:30', '2025-04-29 12:45:30'),
('62585155-bbd5-462f-b47d-3d05604f0bc1', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/54\",\"data\":{\"notification_type\":3,\"product_id\":54,\"listing_number\":\"AUC11202554\"},\"created_at\":\"2025-04-25T14:54:48.000000Z\"}', '2025-04-25 15:04:05', '2025-04-25 14:54:49', '2025-04-25 15:04:05'),
('6732b9c0-371c-40b8-84bf-3ddc1d5a3ed6', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/61\",\"data\":{\"notification_type\":3,\"product_id\":61,\"listing_number\":\"AUC11202561\"},\"created_at\":\"2025-04-25T14:58:24.000000Z\"}', NULL, '2025-04-25 14:58:25', '2025-04-25 14:58:25'),
('70048689-0325-4c0d-a6c2-b226be0edd28', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/56\",\"data\":{\"notification_type\":3,\"product_id\":56,\"listing_number\":\"AUC11202556\"},\"created_at\":\"2025-04-25T14:55:58.000000Z\"}', NULL, '2025-04-25 14:55:59', '2025-04-25 14:55:59'),
('71a79135-0d29-4511-b715-02d50b46e892', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/60\",\"data\":{\"notification_type\":3,\"product_id\":60,\"listing_number\":\"AUC11202560\"},\"created_at\":\"2025-04-25T14:58:12.000000Z\"}', '2025-04-25 15:04:05', '2025-04-25 14:58:14', '2025-04-25 15:04:05'),
('748b206a-298a-4ea5-aa35-8f068b4a5a8c', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/50\",\"data\":{\"notification_type\":3,\"product_id\":50,\"listing_number\":\"AUC11202550\"},\"created_at\":\"2025-04-25T14:53:52.000000Z\"}', NULL, '2025-04-25 14:53:53', '2025-04-25 14:53:53'),
('756f1daf-45d5-481c-8f7a-81ce44d83627', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Consequatur est par \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/68\",\"data\":{\"notification_type\":3,\"product_id\":68,\"listing_number\":\"SHA13202568\"},\"created_at\":\"2025-04-29T12:24:52.000000Z\"}', NULL, '2025-04-29 12:24:53', '2025-04-29 12:24:53'),
('77682938-72fa-4056-983a-c0803a66ae09', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Non sunt aperiam lab \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/66\",\"data\":{\"notification_type\":3,\"product_id\":66,\"listing_number\":\"SHA13202566\"},\"created_at\":\"2025-04-29T12:19:48.000000Z\"}', NULL, '2025-04-29 12:19:50', '2025-04-29 12:19:50'),
('77c1b568-a987-460e-845c-b07934702b82', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Consequatur unde qu \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/65\",\"data\":{\"notification_type\":3,\"product_id\":65,\"listing_number\":\"SHA13202565\"},\"created_at\":\"2025-04-29T11:35:26.000000Z\"}', NULL, '2025-04-29 11:35:39', '2025-04-29 11:35:39'),
('780e2954-8f59-4d57-91ba-f454f017da14', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/57\",\"data\":{\"notification_type\":3,\"product_id\":57,\"listing_number\":\"AUC11202557\"},\"created_at\":\"2025-04-25T14:56:23.000000Z\"}', '2025-04-25 15:04:05', '2025-04-25 14:56:24', '2025-04-25 15:04:05'),
('78dfb28c-0326-4b4a-84ff-64b646b76ff2', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/53\",\"data\":{\"notification_type\":3,\"product_id\":53,\"listing_number\":\"AUC11202553\"},\"created_at\":\"2025-04-25T14:54:38.000000Z\"}', '2025-04-25 15:04:05', '2025-04-25 14:54:39', '2025-04-25 15:04:05'),
('79ac571d-2dac-4a9a-bed6-d4c9d1f1f827', 'App\\Notifications\\NotifyVendorStatusCoupon', 'App\\Models\\User', 70, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0643\\u0648\\u0628\\u0648\\u0646\\u0627\\u062a\",\"text\":\"\\u062a\\u0645 \\u062a\\u063a\\u064a\\u064a\\u0631 \\u062d\\u0627\\u0644\\u0629 \\u0627\\u0644\\u0643\\u0648\\u0628\\u0648\\u0646    xcvfbhn \\u0625\\u0644\\u064a main.coupons.approve\",\"redirect\":\"coupons\\/45\",\"data\":[],\"created_at\":\"2025-01-25T20:22:18.000000Z\"}', '2025-02-02 12:49:05', '2025-02-02 12:48:54', '2025-02-02 12:49:05'),
('7c09bfc8-83d0-4d1a-b879-69114aa90538', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/58\",\"data\":{\"notification_type\":3,\"product_id\":58,\"listing_number\":\"AUC11202558\"},\"created_at\":\"2025-04-25T14:56:32.000000Z\"}', NULL, '2025-04-25 14:56:33', '2025-04-25 14:56:33'),
('7caa422d-1da9-4f07-8bd6-aac0e93b4981', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/53\",\"data\":{\"notification_type\":3,\"product_id\":53,\"listing_number\":\"AUC11202553\"},\"created_at\":\"2025-04-25T14:54:38.000000Z\"}', NULL, '2025-04-25 14:54:39', '2025-04-25 14:54:39'),
('7d6c4717-68fc-4263-94d4-660acbc2df9d', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   xcfvgbhnjk\",\"redirect\":\"contacts\\/#td-30\",\"data\":{\"id\":30,\"name\":\"xcfvgbhnjk\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-03T12:34:42.000000Z\"}', '2025-02-06 11:29:08', '2025-02-03 12:34:43', '2025-02-06 11:29:08'),
('7e3cd302-cefc-4fd0-834a-c7f5f132fb78', 'App\\Notifications\\NotifySubscriberNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   maitar2ekt3tt22@gmail.com\",\"redirect\":\"contacts\\/#td-5\",\"created_at\":\"2024-08-16T22:25:38.000000Z\",\"data\":{\"notification_type\":2,\"id\":5}}', '2025-01-23 22:47:46', '2024-08-16 22:25:38', '2025-01-23 22:47:46'),
('84d098aa-2e3a-44cd-81f2-364a048d25db', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/53\",\"data\":{\"notification_type\":3,\"product_id\":53,\"listing_number\":\"AUC11202553\"},\"created_at\":\"2025-04-25T14:54:38.000000Z\"}', NULL, '2025-04-25 14:54:39', '2025-04-25 14:54:39'),
('85f5ada3-99ba-4df6-9e59-aff1ba4ead82', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   Abdullah Ashraf\",\"redirect\":\"contacts\\/#td-32\",\"data\":{\"id\":32,\"name\":\"Abdullah Ashraf\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-06T12:40:38.000000Z\"}', '2025-02-06 12:40:46', '2025-02-06 12:40:38', '2025-02-06 12:40:46'),
('86fd5774-10b9-49cb-8177-18661d384beb', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/54\",\"data\":{\"notification_type\":3,\"product_id\":54,\"listing_number\":\"AUC11202554\"},\"created_at\":\"2025-04-25T14:54:48.000000Z\"}', NULL, '2025-04-25 14:54:49', '2025-04-25 14:54:49'),
('8855e546-e56e-4399-aba5-c4689aa7758d', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/56\",\"data\":{\"notification_type\":3,\"product_id\":56,\"listing_number\":\"AUC11202556\"},\"created_at\":\"2025-04-25T14:55:58.000000Z\"}', '2025-04-25 15:04:05', '2025-04-25 14:55:59', '2025-04-25 15:04:05'),
('8a4d09be-659b-41be-928c-faba53ada3b5', 'App\\Notifications\\NotifySubscriberNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   jjudy@yahoo.com\",\"redirect\":\"contacts\\/#td-9\",\"created_at\":\"2024-08-22T20:44:04.000000Z\",\"data\":{\"notification_type\":2,\"id\":9}}', '2025-01-23 22:47:45', '2024-08-22 20:44:04', '2025-01-23 22:47:45'),
('8a8045bf-99bf-4bb2-bdea-edd490f39e5b', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/59\",\"data\":{\"notification_type\":3,\"product_id\":59,\"listing_number\":\"AUC11202559\"},\"created_at\":\"2025-04-25T14:57:58.000000Z\"}', '2025-04-25 15:04:05', '2025-04-25 14:57:59', '2025-04-25 15:04:05');
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('95ab720e-7edb-48ad-b5db-7d49a63d1787', 'App\\Notifications\\NewInvestmentNotification', 'App\\Models\\User', 77, '{\"title\":\"\\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\",\"body\":\"\\u062a\\u0645\\u062a \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \\u0628\\u0645\\u0628\\u0644\\u063a 9,999,000 \\u0631\\u064a\\u0627\\u0644 \\u0641\\u064a \\u0627\\u0644\\u0639\\u0642\\u0627\\u0631 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0634\\u0627\\u0631\\u0643 \\u0628\\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629\"}', NULL, '2025-04-26 21:04:13', '2025-04-26 21:04:13'),
('96e56e7b-d17e-4e73-8682-06b0d735b898', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Non sunt aperiam lab \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/66\",\"data\":{\"notification_type\":3,\"product_id\":66,\"listing_number\":\"SHA13202566\"},\"created_at\":\"2025-04-29T12:19:48.000000Z\"}', NULL, '2025-04-29 12:19:50', '2025-04-29 12:19:50'),
('995d3f98-f5c8-4842-8999-e6de530ffdd2', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/61\",\"data\":{\"notification_type\":3,\"product_id\":61,\"listing_number\":\"AUC11202561\"},\"created_at\":\"2025-04-25T14:58:24.000000Z\"}', '2025-04-25 15:04:05', '2025-04-25 14:58:25', '2025-04-25 15:04:05'),
('998157e1-68e4-44c2-83ca-45e690498639', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   \\u0639\\u0644\\u0649\",\"redirect\":\"contacts\\/#td-33\",\"data\":{\"id\":33,\"name\":\"\\u0639\\u0644\\u0649\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-06T13:05:59.000000Z\"}', NULL, '2025-02-06 13:05:59', '2025-02-06 13:05:59'),
('9aecfc83-8d2b-4bbc-be7d-6bdad25ba3fa', 'App\\Notifications\\NotifySubscriberNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   d@yahoo.com\",\"redirect\":\"contacts\\/#td-10\",\"created_at\":\"2024-08-22T20:53:14.000000Z\",\"data\":{\"notification_type\":2,\"id\":10}}', '2025-01-23 22:47:45', '2024-08-22 20:53:14', '2025-01-23 22:47:45'),
('9af5d8c7-a788-466f-b86b-15f5e837b693', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Victoria Flores\",\"redirect\":\"pending_vendors\\/7\",\"data\":[],\"created_at\":\"2025-01-24T20:07:17.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 20:07:17', '2025-01-24 20:22:28'),
('9d0604db-17bc-4f76-b3ec-4aa6a6e013e3', 'App\\Notifications\\NotifyAdminNewVendorCoupon', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628hg;,f,khj\",\"text\":\"\\u0644\\u0642\\u062f \\u0623\\u0636\\u0627\\u0641 \\u0627\\u0644\\u062a\\u0627\\u062c\\u0631   mai tarek \\u0643\\u0648\\u0628\\u0648\\u0646 \\u062e\\u0635\\u0645 \\u062c\\u062f\\u064a\\u062f \\u0628\\u0627\\u0633\\u0645 fggvfd\",\"redirect\":\"coupons\\/44\",\"data\":[],\"created_at\":\"2025-01-25T15:55:34.000000Z\"}', '2025-01-25 15:55:44', '2025-01-25 15:55:38', '2025-01-25 15:55:44'),
('9dfa3360-4f87-42bb-a9f5-09638aca106f', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/57\",\"data\":{\"notification_type\":3,\"product_id\":57,\"listing_number\":\"AUC11202557\"},\"created_at\":\"2025-04-25T14:56:23.000000Z\"}', NULL, '2025-04-25 14:56:24', '2025-04-25 14:56:24'),
('9f59879a-71d7-46a2-a9c4-f8475f480cb3', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/54\",\"data\":{\"notification_type\":3,\"product_id\":54,\"listing_number\":\"AUC11202554\"},\"created_at\":\"2025-04-25T14:54:48.000000Z\"}', NULL, '2025-04-25 14:54:50', '2025-04-25 14:54:50'),
('a359c251-ab9a-43e7-ab67-da0df3b083bf', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   Abdullah Ashraf\",\"redirect\":\"contacts\\/#td-31\",\"data\":{\"id\":31,\"name\":\"Abdullah Ashraf\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-06T11:25:55.000000Z\"}', NULL, '2025-02-06 11:25:55', '2025-02-06 11:25:55'),
('a726e8c5-dbd7-4724-af88-4e98ceb599cb', 'App\\Notifications\\NotifySubscriberNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   m@y.co\",\"redirect\":\"contacts\\/#td-7\",\"created_at\":\"2024-08-22T20:32:24.000000Z\",\"data\":{\"notification_type\":2,\"id\":7}}', '2025-01-23 22:47:46', '2024-08-22 20:32:24', '2025-01-23 22:47:46'),
('aaf6fc08-98b0-4e8e-9db8-6fc8f60a2fa6', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Hyatt Frye\",\"redirect\":\"pending_vendors\\/3\",\"data\":[],\"created_at\":\"2025-01-24T19:55:29.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 19:55:30', '2025-01-24 20:22:28'),
('b10c93ac-4940-41da-84da-4e7cf8b17285', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Dolores nihil sed ni \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/69\",\"data\":{\"notification_type\":3,\"product_id\":69,\"listing_number\":\"SHA13202569\"},\"created_at\":\"2025-04-29T12:45:26.000000Z\"}', NULL, '2025-04-29 12:45:30', '2025-04-29 12:45:30'),
('b22b0ecd-8ef2-4fa0-8249-61abfc1f99f8', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/52\",\"data\":{\"notification_type\":3,\"product_id\":52,\"listing_number\":\"AUC11202552\"},\"created_at\":\"2025-04-25T14:54:27.000000Z\"}', NULL, '2025-04-25 14:54:28', '2025-04-25 14:54:28'),
('b8829d55-56da-4fb7-9c19-770fc7a7f789', 'App\\Notifications\\NotifyVendorStatusCoupon', 'App\\Models\\User', 32, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0643\\u0648\\u0628\\u0648\\u0646\\u0627\\u062a\",\"text\":\"\\u062a\\u0645 \\u062a\\u063a\\u064a\\u064a\\u0631 \\u062d\\u0627\\u0644\\u0629 \\u0627\\u0644\\u0643\\u0648\\u0628\\u0648\\u0646    xcvfbhn \\u0625\\u0644\\u064a main.coupons.approve\",\"redirect\":\"coupons\\/45\",\"data\":[],\"created_at\":\"2025-01-25T20:22:18.000000Z\"}', '2025-01-25 20:42:22', '2025-01-25 20:42:14', '2025-01-25 20:42:22'),
('b90f677e-69b5-4124-bae9-3545fa9e2210', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Consequatur unde qu \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/65\",\"data\":{\"notification_type\":3,\"product_id\":65,\"listing_number\":\"SHA13202565\"},\"created_at\":\"2025-04-29T11:35:26.000000Z\"}', NULL, '2025-04-29 11:35:39', '2025-04-29 11:35:39'),
('bce78963-b2a6-4d37-95f8-22de0bd197cb', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   \\u0639\\u0644\\u0649\",\"redirect\":\"contacts\\/#td-33\",\"data\":{\"id\":33,\"name\":\"\\u0639\\u0644\\u0649\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-06T13:05:59.000000Z\"}', '2025-02-06 15:43:55', '2025-02-06 13:05:59', '2025-02-06 13:07:18'),
('bf35c5f5-eb66-489d-a9dc-bc0863b6abbc', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/50\",\"data\":{\"notification_type\":3,\"product_id\":50,\"listing_number\":\"AUC11202550\"},\"created_at\":\"2025-04-25T14:53:52.000000Z\"}', '2025-04-25 15:04:05', '2025-04-25 14:53:53', '2025-04-25 15:04:05'),
('c007c6d8-1c1c-4b84-9ea6-95bb53f5459f', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Abdullah\",\"redirect\":\"pending_vendors\\/14\",\"data\":[],\"created_at\":\"2025-02-06T13:31:06.000000Z\"}', '2025-02-06 15:15:39', '2025-02-06 13:31:06', '2025-02-06 15:15:39'),
('c02081f6-cf18-4ce1-8a33-68d220e2aada', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/51\",\"data\":{\"notification_type\":3,\"product_id\":51,\"listing_number\":\"AUC11202551\"},\"created_at\":\"2025-04-25T14:54:12.000000Z\"}', '2025-04-25 15:04:05', '2025-04-25 14:54:13', '2025-04-25 15:04:05'),
('c2707d32-ba52-427c-a24c-398eb51c20c3', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/55\",\"data\":{\"notification_type\":3,\"product_id\":55,\"listing_number\":\"AUC11202555\"},\"created_at\":\"2025-04-25T14:55:14.000000Z\"}', NULL, '2025-04-25 14:55:15', '2025-04-25 14:55:15'),
('c5a2eb08-efbf-4771-bade-0f9a41d5c748', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Akeem Pugh\",\"redirect\":\"pending_vendors\\/5\",\"data\":[],\"created_at\":\"2025-01-24T20:00:50.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 20:00:51', '2025-01-24 20:22:28'),
('ca782fcd-a010-4582-aeb2-3b8a24f8ff04', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Atque ad rerum in pa \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/72\",\"data\":{\"notification_type\":3,\"product_id\":72,\"listing_number\":\"AUC11202572\"},\"created_at\":\"2025-04-29T16:04:55.000000Z\"}', NULL, '2025-04-29 16:04:56', '2025-04-29 16:04:56'),
('d2305b2d-40fe-48fb-be36-6eecb4d84a4f', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/55\",\"data\":{\"notification_type\":3,\"product_id\":55,\"listing_number\":\"AUC11202555\"},\"created_at\":\"2025-04-25T14:55:14.000000Z\"}', '2025-04-25 15:04:05', '2025-04-25 14:55:15', '2025-04-25 15:04:05'),
('d3132b08-ebec-48fc-8830-6507a862e4ef', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/59\",\"data\":{\"notification_type\":3,\"product_id\":59,\"listing_number\":\"AUC11202559\"},\"created_at\":\"2025-04-25T14:57:58.000000Z\"}', NULL, '2025-04-25 14:57:59', '2025-04-25 14:57:59'),
('d5a8d31e-ecd1-4218-af86-a39f675bc403', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Dolor cillum consequ \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u0634\\u0627\\u0631\\u0643\\u0629\",\"redirect\":\"products\\/64\",\"data\":{\"notification_type\":3,\"product_id\":64,\"listing_number\":\"SHA13202564\"},\"created_at\":\"2025-04-25T23:14:28.000000Z\"}', NULL, '2025-04-25 23:14:33', '2025-04-25 23:14:33'),
('d934d109-44f3-403f-9808-5132b4a9e769', 'App\\Notifications\\NotifySubscriberNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   v@ya.com\",\"redirect\":\"contacts\\/#td-6\",\"created_at\":\"2024-08-22T20:29:06.000000Z\",\"data\":{\"notification_type\":2,\"id\":6}}', '2025-01-23 22:47:46', '2024-08-22 20:29:08', '2025-01-23 22:47:46'),
('e4fcf50f-691c-43bf-8689-e08e2181a35f', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   Abdullah Ashraf\",\"redirect\":\"contacts\\/#td-32\",\"data\":{\"id\":32,\"name\":\"Abdullah Ashraf\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-06T12:40:38.000000Z\"}', NULL, '2025-02-06 12:40:38', '2025-02-06 12:40:38'),
('e5c77f9d-ff7d-4f87-9a97-b424dd0a5ed9', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Numquam numquam quia \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/70\",\"data\":{\"notification_type\":3,\"product_id\":70,\"listing_number\":\"AUC11202570\"},\"created_at\":\"2025-04-29T13:53:05.000000Z\"}', NULL, '2025-04-29 13:53:07', '2025-04-29 13:53:07'),
('e68a6fb6-33b3-4af0-a93e-a9d9245cfd22', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Winter Holder\",\"redirect\":\"pending_vendors\\/11\",\"data\":[],\"created_at\":\"2025-02-03T13:08:23.000000Z\"}', '2025-02-06 11:29:08', '2025-02-03 13:08:29', '2025-02-06 11:29:08'),
('e748af72-6dbf-4f1f-9c83-4127dd65dec8', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 47, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/56\",\"data\":{\"notification_type\":3,\"product_id\":56,\"listing_number\":\"AUC11202556\"},\"created_at\":\"2025-04-25T14:55:58.000000Z\"}', NULL, '2025-04-25 14:55:59', '2025-04-25 14:55:59'),
('e8806b4c-8167-41d9-8569-cea63bb6eba1', 'App\\Notifications\\NotifyAdminNewVendorCoupon', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628hg;,f,khj\",\"text\":\"\\u0644\\u0642\\u062f \\u0623\\u0636\\u0627\\u0641 \\u0627\\u0644\\u062a\\u0627\\u062c\\u0631   mai tarek \\u0643\\u0648\\u0628\\u0648\\u0646 \\u062e\\u0635\\u0645 \\u062c\\u062f\\u064a\\u062f \\u0628\\u0627\\u0633\\u0645 xcvfbhn\",\"redirect\":\"coupons\\/45\",\"data\":[],\"created_at\":\"2025-01-25T20:22:18.000000Z\"}', '2025-02-06 11:29:08', '2025-01-25 20:22:23', '2025-02-06 11:29:08'),
('e9b88bc8-802c-41e9-b603-cba9b4835cc1', 'App\\Notifications\\AuctionWinnerNotification', 'App\\Models\\User', 77, '{\"title\":\"\\u0645\\u0628\\u0631\\u0648\\u0643! \\u0644\\u0642\\u062f \\u0641\\u0632\\u062a \\u0628\\u0627\\u0644\\u0645\\u0632\\u0627\\u062f\",\"body\":\"\\u0644\\u0642\\u062f \\u0641\\u0632\\u062a \\u0628\\u0645\\u0632\\u0627\\u062f \\u0627\\u0644\\u0639\\u0642\\u0627\\u0631 \\\"\\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f\\\" \\u0628\\u0645\\u0628\\u0644\\u063a 1,200,000 \\u0631\\u064a\\u0627\\u0644.\"}', NULL, '2025-04-27 18:43:06', '2025-04-27 18:43:06'),
('ebd68921-ed4f-444b-aba2-22e153de8b1a', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Mohammad Nielsen\",\"redirect\":\"pending_vendors\\/4\",\"data\":[],\"created_at\":\"2025-01-24T19:57:38.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 19:57:38', '2025-01-24 20:22:28'),
('eed334f9-e675-43ed-b240-1332e5c9f6df', 'App\\Notifications\\InvestmentCompletedNotification', 'App\\Models\\User', 79, '{\"title\":\"\\u0627\\u0643\\u062a\\u0645\\u0644 \\u0627\\u0644\\u0627\\u0633\\u062a\\u062b\\u0645\\u0627\\u0631\",\"body\":\"\\u062a\\u0645 \\u0627\\u0643\\u062a\\u0645\\u0627\\u0644 \\u0627\\u0644\\u0627\\u0633\\u062a\\u062b\\u0645\\u0627\\u0631 \\u0641\\u064a \\u0627\\u0644\\u0639\\u0642\\u0627\\u0631 \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0634\\u0627\\u0631\\u0643 \\u0628\\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629. \\u0634\\u0643\\u0631\\u064b\\u0627 \\u0644\\u0645\\u0634\\u0627\\u0631\\u0643\\u062a\\u0643!\"}', NULL, '2025-04-26 21:04:14', '2025-04-26 21:04:14'),
('ef5688f0-6c41-4d26-8eaa-eab6479fad94', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Atque ad rerum in pa \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/72\",\"data\":{\"notification_type\":3,\"product_id\":72,\"listing_number\":\"AUC11202572\"},\"created_at\":\"2025-04-29T16:04:55.000000Z\"}', NULL, '2025-04-29 16:04:56', '2025-04-29 16:04:56'),
('f312896e-eec4-44a4-a3ec-425d622141f4', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Abdullah Elgazzar\",\"redirect\":\"pending_vendors\\/12\",\"data\":[],\"created_at\":\"2025-02-06T12:17:01.000000Z\"}', '2025-02-06 12:19:29', '2025-02-06 12:17:01', '2025-02-06 12:19:29'),
('f463de13-85e4-473e-8de2-f8c8186d3c36', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  \\u0639\\u0642\\u0627\\u0631 \\u0645\\u062a\\u0632\\u0627\\u064a\\u062f \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/60\",\"data\":{\"notification_type\":3,\"product_id\":60,\"listing_number\":\"AUC11202560\"},\"created_at\":\"2025-04-25T14:58:12.000000Z\"}', NULL, '2025-04-25 14:58:14', '2025-04-25 14:58:14'),
('f9981f80-bd77-49dd-ba48-19e25b8cd420', 'App\\Notifications\\NotifyNewProductToAdmin', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0639\\u0642\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f  Numquam numquam quia \\u0648\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0645\\u0632\\u0627\\u064a\\u062f\\u0629 \\\"\\u0633\\u0648\\u0645\\\"\",\"redirect\":\"products\\/70\",\"data\":{\"notification_type\":3,\"product_id\":70,\"listing_number\":\"AUC11202570\"},\"created_at\":\"2025-04-29T13:53:05.000000Z\"}', NULL, '2025-04-29 13:53:07', '2025-04-29 13:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assign_to` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_no` bigint(6) UNSIGNED ZEROFILL DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','accepted','shipped','completed','declined','return') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type` enum('online','cash','v_cash','instapay','bank_transfer') DEFAULT NULL,
  `delivery_price` double(8,2) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `assign_to`, `user_id`, `order_no`, `store_id`, `status`, `created_at`, `updated_at`, `user_address_id`, `payment_type`, `delivery_price`, `order_date`, `coupon_id`, `deleted_at`, `notes`) VALUES
(2, NULL, 25, 091002, 8, 'completed', '2025-02-18 11:41:12', '2024-08-02 18:15:58', NULL, NULL, NULL, '2024-07-07 10:51:23', 17, NULL, NULL),
(3, 32, 26, 091003, NULL, 'pending', '2024-08-02 18:48:07', '2024-08-02 18:48:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, 30, 091004, NULL, 'accepted', '2024-08-17 12:35:43', '2025-01-12 08:47:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 3, NULL, 091005, NULL, 'return', '2024-08-23 16:02:38', '2025-02-18 09:22:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 3, 25, 091006, NULL, 'accepted', '2024-08-23 16:03:27', '2025-01-21 13:52:40', 41, 'cash', 60.00, NULL, 17, NULL, 'cvhjggggg'),
(8, NULL, NULL, 091007, 1, 'accepted', '2025-02-10 22:00:00', '2024-08-23 16:04:05', 41, 'cash', 60.00, NULL, 42, NULL, NULL),
(13, NULL, 32, 084847, 1, 'completed', '2025-02-19 17:26:16', '2024-09-28 16:26:16', NULL, 'v_cash', NULL, NULL, NULL, NULL, NULL),
(15, NULL, NULL, NULL, NULL, 'pending', '2025-03-06 12:52:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, NULL, NULL, 11111111111111, 1, 'completed', '2025-03-05 22:00:00', NULL, NULL, 'cash', NULL, NULL, NULL, NULL, NULL),
(17, NULL, 25, 11111111111112, NULL, 'pending', '2025-01-16 12:08:14', '2025-01-16 12:08:14', NULL, NULL, NULL, '2025-01-15 22:00:00', NULL, NULL, '3erftgh'),
(18, NULL, 25, 11111111111113, NULL, 'pending', '2025-01-16 12:08:34', '2025-01-16 12:08:34', NULL, NULL, NULL, '2025-01-15 22:00:00', NULL, '2025-01-20 08:44:58', '3erftgh');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `status` enum('show','hide') DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content_ar` longtext DEFAULT NULL,
  `content_en` longtext DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول التصنيفات';

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `admin_id`, `title_ar`, `title_en`, `status`, `created_at`, `updated_at`, `content_ar`, `content_en`, `link`) VALUES
(1, 1, 'سياسة الخصوصية', 'privacy policy', 'show', '2024-07-25 13:40:50', '2024-08-24 11:35:48', 'الاتةنسمو', 'hvshbmklc,', 'privacy-policy'),
(2, 1, 'شرح آليات النظام', 'شرح آليات النظام', 'show', '2024-08-17 13:14:27', '2025-04-20 17:39:12', 'شرح آليات النظام', 'شرح آليات النظام', 'return-policy'),
(3, 1, 'الشروط والأحكام', 'الشروط والأحكام', 'hide', '2024-08-17 13:14:54', '2025-01-22 09:09:34', 'الشروط والأحكامالشروط والأحكام', 'الشروط والأحكام', 'term-conditions'),
(4, 1, 'المصداقية والخدمات المدفوعة', 'المصداقية والخدمات المدفوعة', 'show', '2025-04-20 17:38:30', '2025-04-20 17:38:30', 'المصداقية والخدمات المدفوعة', 'المصداقية والخدمات المدفوعة', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `mobile` varchar(30) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`mobile`, `token`, `created_at`) VALUES
('1097979797', '1234', '2025-02-23 13:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `admin_id`) VALUES
(1, 'admins-create', 'admin', '2024-07-24 10:12:54', NULL, NULL),
(2, 'admins-list', 'admin', NULL, NULL, NULL),
(3, 'admins-edit', 'admin', NULL, NULL, NULL),
(4, 'admins-delete', 'admin', NULL, NULL, NULL),
(5, 'roles-create', 'admin', NULL, NULL, NULL),
(6, 'roles-list', 'admin', NULL, NULL, NULL),
(7, 'roles-edit', 'admin', NULL, NULL, NULL),
(8, 'roles-delete', 'admin', NULL, NULL, NULL),
(9, 'products-create', 'admin', NULL, NULL, NULL),
(10, 'products-list', 'admin', NULL, NULL, NULL),
(11, 'products-edit', 'admin', NULL, NULL, NULL),
(12, 'products-delete', 'admin', NULL, NULL, NULL),
(13, 'blogs-create', 'admin', NULL, NULL, NULL),
(14, 'blogs-list', 'admin', NULL, NULL, NULL),
(15, 'blogs-edit', 'admin', NULL, NULL, NULL),
(16, 'blogs-delete', 'admin', NULL, NULL, NULL),
(17, 'users-create', 'admin', NULL, NULL, NULL),
(18, 'users-list', 'admin', NULL, NULL, NULL),
(19, 'users-edit', 'admin', NULL, NULL, NULL),
(20, 'users-delete', 'admin', NULL, NULL, NULL),
(21, 'complaint-list', 'admin', NULL, NULL, NULL),
(22, 'complaint-delete', 'admin', NULL, NULL, NULL),
(23, 'pages-create', 'admin', NULL, NULL, NULL),
(24, 'pages-list', 'admin', NULL, NULL, NULL),
(25, 'pages-edit', 'admin', NULL, NULL, NULL),
(26, 'pages-delete', 'admin', NULL, NULL, NULL),
(27, 'vendors-create', 'admin', NULL, NULL, NULL),
(28, 'vendors-list', 'admin', NULL, NULL, NULL),
(29, 'vendors-edit', 'admin', NULL, NULL, NULL),
(30, 'vendors-delete', 'admin', NULL, NULL, NULL),
(49, 'settings-list', 'admin', NULL, NULL, NULL),
(85, 'home-list', 'admin', NULL, NULL, NULL),
(95, 'about-list', 'admin', NULL, NULL, NULL),
(96, 'about-edit', 'admin', NULL, NULL, NULL),
(118, 'contacts-list', 'admin', NULL, NULL, NULL),
(119, 'contacts-delete', 'admin', NULL, NULL, NULL),
(120, 'reports-list', 'admin', NULL, NULL, NULL),
(121, 'notification-list', 'admin', NULL, NULL, NULL),
(122, 'subscribers-list', 'admin', NULL, NULL, NULL),
(123, 'subscribers-delete', 'admin', NULL, NULL, NULL),
(126, 'question_answer-create', 'admin', '2024-04-22 09:33:58', NULL, NULL),
(127, 'question_answer-list', 'admin', NULL, NULL, NULL),
(128, 'question_answer-edit', 'admin', NULL, NULL, NULL),
(129, 'question_answer-delete', 'admin', NULL, NULL, NULL),
(150, 'orders-create', 'admin', NULL, NULL, NULL),
(151, 'orders-list', 'admin', NULL, NULL, NULL),
(152, 'orders-edit', 'admin', NULL, NULL, NULL),
(153, 'orders-delete', 'admin', NULL, NULL, NULL),
(154, 'orders-assign', 'admin', NULL, NULL, NULL),
(167, 'subadmins-create', 'admin', '2024-07-24 10:12:54', NULL, NULL),
(168, 'subadmins-list', 'admin', NULL, NULL, NULL),
(169, 'subadmins-edit', 'admin', NULL, NULL, NULL),
(170, 'subadmins-delete', 'admin', NULL, NULL, NULL),
(171, 'locations-create', 'admin', NULL, NULL, NULL),
(172, 'locations-list', 'admin', NULL, NULL, NULL),
(173, 'locations-edit', 'admin', NULL, NULL, NULL),
(174, 'locations-delete', 'admin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `listing_number` varchar(20) DEFAULT NULL,
  `qr_code` text DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `map_location` longtext DEFAULT NULL,
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','shared_onsite','approved','rejected','closed') DEFAULT NULL,
  `is_private` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `approved_at` timestamp NULL DEFAULT NULL,
  `type` enum('auction','shared','investment') DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_for` enum('sale','rent') NOT NULL COMMENT 'ايجار ولا بيع',
  `link_video` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `in_home` enum('yes','no') DEFAULT NULL,
  `investment_collected` decimal(15,2) NOT NULL DEFAULT 0.00 COMMENT 'أعلي سعر مزايده اتسجل حتي الان \r\nواعلي سعر مشاركة اتجمع ',
  `phone_numbers` text DEFAULT NULL COMMENT 'أرقام هواتف للعقارات الخاصه'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول المنتجات';

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `added_by`, `title`, `listing_number`, `qr_code`, `price`, `description`, `map_location`, `owner_id`, `status`, `is_private`, `created_at`, `updated_at`, `views`, `approved_at`, `type`, `deleted_at`, `area_id`, `product_for`, `link_video`, `start_date`, `end_date`, `in_home`, `investment_collected`, `phone_numbers`) VALUES
(1, 1, 'ggggggggggggggg', 'AUCTION-42-2025', NULL, 1112.00, '2222222erfggg', 'https://www.google.com', NULL, 'shared_onsite', 1, '2025-04-19 22:54:01', '2025-04-26 19:07:11', 0, NULL, 'auction', NULL, 5, 'sale', 'https://www.vide.come', '2025-04-01', '2025-04-09', 'yes', 0.00, NULL),
(47, 77, 'عقار متشارك بالمزايدة', 'INV12202547', 'qr_codes/qr_47.png', 10000000.00, 'Itaque anim tempor i', NULL, NULL, 'pending', 0, '2025-04-25 14:42:56', '2025-04-26 21:04:13', 0, NULL, 'investment', NULL, 5, 'sale', NULL, NULL, NULL, NULL, 10000000.00, NULL),
(49, 77, 'عقار متزايد', 'AUC11202548', 'qr_codes/qr_49.png', 100000.00, 'Doloribus dignissimo', NULL, NULL, 'closed', 0, '2025-04-25 14:53:06', '2025-04-27 18:43:03', 0, NULL, 'auction', NULL, 5, 'sale', NULL, '2025-04-25', '2025-05-09', NULL, 1200000.00, NULL),
(64, 77, 'عقار مشاركة خاص', 'SHA13202564', 'qr_codes/qr_64.png', 0.00, 'Sapiente perspiciati', NULL, NULL, 'pending', 0, '2025-04-25 23:14:28', '2025-04-25 23:14:32', 0, NULL, 'shared', NULL, NULL, 'rent', NULL, NULL, NULL, NULL, 0.00, NULL),
(65, 77, 'Consequatur unde qu', 'SHA13202565', 'qr_codes/qr_65.png', NULL, 'Inventore quasi in s', NULL, NULL, 'approved', 0, '2025-04-29 11:35:26', '2025-04-29 11:58:40', 0, NULL, 'shared', NULL, 5, 'rent', NULL, NULL, NULL, NULL, 0.00, NULL),
(66, 77, 'Non sunt aperiam lab', 'SHA13202566', 'qr_codes/qr_66.png', NULL, 'Incididunt fuga Sim', NULL, NULL, 'pending', 0, '2025-04-29 12:19:48', '2025-04-29 12:19:50', 0, NULL, 'shared', NULL, 5, 'sale', NULL, NULL, NULL, NULL, 0.00, NULL),
(67, 77, 'Consequatur est par', 'SHA13202567', 'qr_codes/qr_67.png', NULL, 'Pariatur Asperiores', NULL, NULL, 'pending', 0, '2025-04-29 12:24:29', '2025-04-29 12:24:31', 0, NULL, 'shared', NULL, 5, 'rent', NULL, NULL, NULL, NULL, 0.00, NULL),
(68, 77, 'Consequatur est par', 'SHA13202568', 'qr_codes/qr_68.png', NULL, 'Pariatur Asperiores', NULL, NULL, 'pending', 0, '2025-04-29 12:24:52', '2025-04-29 12:24:53', 0, NULL, 'shared', NULL, 5, 'rent', NULL, NULL, NULL, NULL, 0.00, '[\"222222222,4484884848,828881811,282882222\"]'),
(69, 77, 'Dolores nihil sed ni', 'SHA13202569', '[\"qr_codes\\/qr_69_0.png\",\"qr_codes\\/qr_69_1.png\",\"qr_codes\\/qr_69_2.png\"]', NULL, 'Excepteur ullam vel', NULL, NULL, 'pending', 0, '2025-04-29 12:45:26', '2025-04-29 12:45:30', 0, NULL, 'shared', NULL, 5, 'sale', NULL, NULL, NULL, NULL, 0.00, '[\"2339939391\",\"182833883\",\"17737474\"]'),
(70, 77, 'Numquam numquam quia', 'AUC11202570', 'qr_codes/qr_70.png', 10000000.00, 'Cumque perspiciatis', NULL, NULL, 'pending', 0, '2025-04-29 13:53:05', '2025-04-29 13:53:07', 0, NULL, 'auction', NULL, 5, 'rent', NULL, '2025-04-29', '2025-05-01', NULL, 0.00, NULL),
(71, 77, 'Culpa rerum recusan', 'AUC11202571', 'qr_codes/qr_71.png', 10000000.00, 'Cupiditate iure fugi', NULL, NULL, 'pending', 0, '2025-04-29 14:13:45', '2025-04-29 14:13:46', 0, NULL, 'auction', NULL, 5, 'rent', NULL, '2025-04-29', '2025-05-09', NULL, 0.00, NULL),
(72, 77, 'Atque ad rerum in pa', 'AUC11202572', 'qr_codes/qr_72.png', 604.00, 'Laudantium sunt re', NULL, NULL, 'pending', 0, '2025-04-29 16:04:55', '2025-04-29 16:04:56', 0, NULL, 'auction', NULL, 5, 'sale', NULL, '1995-01-04', '1987-07-13', NULL, 0.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_bids`
--

CREATE TABLE `product_bids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('decline','approve') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_bids`
--

INSERT INTO `product_bids` (`id`, `created_at`, `updated_at`, `amount`, `user_id`, `product_id`, `status`) VALUES
(1, '2025-04-27 18:04:28', '2025-04-27 18:04:28', 111111.00, 77, 49, 'decline'),
(2, '2025-04-27 18:04:54', '2025-04-27 18:04:54', 120000.00, 77, 49, 'decline'),
(3, '2025-04-27 18:05:13', '2025-04-27 18:05:13', 1200000.00, 77, 49, 'decline');

-- --------------------------------------------------------

--
-- Table structure for table `product_features`
--

CREATE TABLE `product_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `plan_number` varchar(50) DEFAULT NULL,
  `plot_number` varchar(50) DEFAULT NULL,
  `area` decimal(8,2) DEFAULT NULL,
  `area_after_development` decimal(8,2) DEFAULT NULL,
  `valuation` decimal(8,2) DEFAULT NULL,
  `valuation_date` date DEFAULT NULL,
  `has_planning_diagram` tinyint(4) DEFAULT NULL,
  `has_electronic_deed` tinyint(4) DEFAULT NULL,
  `has_real_estate_market` tinyint(4) DEFAULT NULL,
  `has_survey_decision` tinyint(4) DEFAULT NULL,
  `has_mortgage` tinyint(4) DEFAULT NULL,
  `has_penalties` tinyint(4) DEFAULT NULL,
  `penalty_type` enum('cash','installment') DEFAULT NULL,
  `valuation_type` tinyint(4) DEFAULT NULL,
  `accepts_mortgage` tinyint(4) DEFAULT NULL,
  `usufruct_lease` tinyint(4) DEFAULT NULL,
  `is_rented` tinyint(4) DEFAULT NULL,
  `annual_rent` decimal(15,2) DEFAULT NULL,
  `remaining_lease_years` int(20) DEFAULT NULL,
  `license_number` int(30) DEFAULT NULL,
  `additional_info` text DEFAULT NULL,
  `represented_by` enum('owner','agent','co-owner','other') DEFAULT NULL,
  `product_type` enum('residential','commercial') DEFAULT NULL,
  `owner_type` enum('other','company','individual') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_features`
--

INSERT INTO `product_features` (`id`, `product_id`, `created_at`, `updated_at`, `plan_number`, `plot_number`, `area`, `area_after_development`, `valuation`, `valuation_date`, `has_planning_diagram`, `has_electronic_deed`, `has_real_estate_market`, `has_survey_decision`, `has_mortgage`, `has_penalties`, `penalty_type`, `valuation_type`, `accepts_mortgage`, `usufruct_lease`, `is_rented`, `annual_rent`, `remaining_lease_years`, `license_number`, `additional_info`, `represented_by`, `product_type`, `owner_type`) VALUES
(10, 1, '2025-04-19 22:54:01', '2025-04-26 19:07:11', '444', '333', 333.00, 234.00, 22.00, '2025-04-01', 0, 0, 0, 0, 0, 0, 'cash', 1, 0, 1, 0, 2234.00, 222, 3222, 'fgbhtgyju', 'owner', 'residential', 'individual'),
(11, 43, '2025-04-23 20:52:00', '2025-04-23 20:52:00', '284', '333', 1111.00, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'residential', NULL),
(12, 44, '2025-04-25 01:00:02', '2025-04-25 01:00:02', '907', '652', 999.00, 999.00, 72.00, '2010-09-01', 1, 1, 0, 0, 0, 1, 'cash', NULL, 0, 1, 0, 52.00, 2000, 889, 'Veniam unde volupta', 'agent', 'commercial', NULL),
(13, 45, '2025-04-25 01:02:03', '2025-04-25 01:02:03', '907', '652', 999.00, 999.00, 72.00, '2010-09-01', 1, 1, 0, 0, 0, 1, 'cash', NULL, 0, 1, 0, 52.00, 2000, 889, 'Veniam unde volupta', 'agent', 'commercial', NULL),
(14, 46, '2025-04-25 01:26:59', '2025-04-25 01:26:59', '907', '652', 999.00, 999.00, 72.00, '2010-09-01', 1, 1, 0, 0, 0, 1, 'cash', NULL, 0, 1, 0, 52.00, 2000, 889, 'Veniam unde volupta', 'agent', 'commercial', NULL),
(15, 47, '2025-04-25 14:42:56', '2025-04-25 14:42:56', '428', '425', 66.00, 50.00, 69.00, '1977-02-14', 0, 0, 1, 0, 1, 0, 'installment', NULL, 0, 0, 1, 88.00, 1986, 502, 'Non inventore molest', 'agent', 'residential', NULL),
(17, 49, '2025-04-25 14:53:06', '2025-04-25 14:53:06', '44', '726', 11111.00, 999999.99, 9.00, '2008-01-09', 0, 1, 1, 1, 0, 0, 'cash', NULL, 0, 0, 1, 10.00, 1999, 532, 'Quia non et aut sint', 'agent', 'commercial', NULL),
(30, 62, '2025-04-25 23:11:17', '2025-04-25 23:11:17', '632', '662', 9999.00, 44.00, 28.00, '2004-11-18', 1, 1, 0, 0, 0, 1, 'cash', NULL, 1, 1, 1, 7.00, 2011, 562, 'Aliquip magna ut com', 'agent', 'residential', NULL),
(31, 63, '2025-04-25 23:12:37', '2025-04-25 23:12:37', '632', '662', 9999.00, 44.00, 28.00, '2004-11-18', 1, 1, 0, 0, 0, 1, 'cash', NULL, 1, 1, 1, 7.00, 2011, 562, 'Aliquip magna ut com', 'agent', 'residential', NULL),
(32, 64, '2025-04-25 23:14:28', '2025-04-25 23:14:28', '632', '662', 9999.00, 44.00, 28.00, '2004-11-18', 1, 1, 0, 0, 0, 1, 'cash', NULL, 1, 1, 1, 7.00, 2011, 562, 'Aliquip magna ut com', 'agent', 'residential', NULL),
(33, 65, '2025-04-29 11:35:26', '2025-04-29 11:35:26', '181', '984', 23456.00, 444.00, 42.00, '1990-08-07', 1, 1, 1, 0, 0, 1, 'installment', NULL, 0, 1, 1, 98.00, 2003, 493, 'Nemo saepe dolorum q', 'agent', 'residential', NULL),
(34, 66, '2025-04-29 12:19:48', '2025-04-29 12:19:48', '714', '274', 4.00, 33.00, 9.00, '1972-10-01', 0, 1, 1, 1, 1, 0, 'installment', NULL, 0, 1, 1, 2.00, 2008, 603, 'Doloremque iste iure', 'agent', 'commercial', NULL),
(35, 67, '2025-04-29 12:24:29', '2025-04-29 12:24:29', '300', '657', 3.00, 33.00, 47.00, '1997-04-03', 1, 0, 0, 0, 0, 0, 'cash', NULL, 1, 0, 1, 14.00, 2011, 762, 'Ea velit architecto', 'agent', 'commercial', NULL),
(36, 68, '2025-04-29 12:24:52', '2025-04-29 12:24:52', '300', '657', 3.00, 33.00, 47.00, '1997-04-03', 1, 0, 0, 0, 0, 0, 'cash', NULL, 1, 0, 1, 14.00, 2011, 762, 'Ea velit architecto', 'agent', 'commercial', NULL),
(37, 69, '2025-04-29 12:45:26', '2025-04-29 12:45:26', '458', '73', 1.00, 11.00, 34.00, '2021-07-28', 1, 0, 1, 0, 1, 1, 'installment', NULL, 0, 1, 1, 58.00, 1995, 532, 'Magni sed hic aut re', 'agent', 'commercial', NULL),
(38, 70, '2025-04-29 13:53:05', '2025-04-29 13:53:05', '612', '978', 99.00, 22.00, 48.00, '1983-12-24', 1, 0, 0, 0, 0, 0, 'installment', NULL, 0, 1, 0, 85.00, 1987, 661, 'Voluptates in aperia', 'agent', 'commercial', NULL),
(39, 71, '2025-04-29 14:13:45', '2025-04-29 14:13:45', '496', '713', 234.00, 44.00, 47.00, '2010-11-13', 1, 1, 0, 0, 0, 0, 'cash', NULL, 0, 0, 1, 54.00, 2009, 481, 'Magni in id dolorem', 'agent', 'residential', NULL),
(40, 72, '2025-04-29 16:04:55', '2025-04-29 16:04:55', '626', '800', 4.00, 4567.00, 4.00, '1971-07-10', 0, 0, 1, 1, 1, 1, 'cash', NULL, 1, 0, 1, 14.00, 1976, 116, 'Asperiores beatae fu', 'agent', 'residential', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_investments`
--

CREATE TABLE `product_investments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `group_number` varchar(100) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_investments`
--

INSERT INTO `product_investments` (`id`, `created_at`, `updated_at`, `amount`, `group_number`, `user_id`, `product_id`) VALUES
(1, '2025-04-26 19:53:33', '2025-04-26 19:53:33', 1000.00, NULL, 77, 47),
(4, '2025-04-26 21:04:13', '2025-04-26 21:04:13', 9999000.00, NULL, 79, 47);

-- --------------------------------------------------------

--
-- Table structure for table `product_letters`
--

CREATE TABLE `product_letters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('approve','decline') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_offers`
--

CREATE TABLE `product_offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('decline','approve') NOT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_verifications`
--

CREATE TABLE `product_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_number` varchar(100) DEFAULT NULL,
  `method` enum('qr','link','code') DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `via_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `verification_level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_verifications`
--

INSERT INTO `product_verifications` (`id`, `user_id`, `created_at`, `updated_at`, `product_id`, `group_number`, `method`, `verified_at`, `via_user_id`, `verification_level`) VALUES
(42, 81, '2025-04-29 16:43:19', '2025-04-29 16:43:19', 72, NULL, 'link', NULL, 77, '3'),
(43, 82, '2025-04-29 16:43:24', '2025-04-29 16:43:24', 72, NULL, 'link', NULL, 77, '4'),
(44, 80, '2025-04-29 16:46:15', '2025-04-29 16:46:15', 72, NULL, 'link', NULL, 82, '4');

-- --------------------------------------------------------

--
-- Table structure for table `property_access_links`
--

CREATE TABLE `property_access_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `source_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `token` text DEFAULT NULL,
  `current_level` int(20) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_access_links`
--

INSERT INTO `property_access_links` (`id`, `product_id`, `source_user_id`, `token`, `current_level`, `created_at`, `updated_at`) VALUES
(34, 72, 77, 'dcf13420-11a1-4028-a370-709a296c57f2', 2, '2025-04-29 16:04:55', NULL),
(59, 72, 81, '5a4a2675-53f8-4439-8304-4c31459bb1d4', 3, '2025-04-29 16:43:20', '2025-04-29 16:43:20'),
(60, 72, 82, 'c0c7e775-624a-472f-9591-b31fa89b360c', 4, '2025-04-29 16:43:25', '2025-04-29 16:43:25'),
(61, 72, 80, '9451481b-1c4f-4271-b341-16c09019259e', 4, '2025-04-29 16:46:15', '2025-04-29 16:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `property_invited_numbers`
--

CREATE TABLE `property_invited_numbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `token` text DEFAULT NULL,
  `verification_level` int(20) NOT NULL DEFAULT 2,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_private_links`
--

CREATE TABLE `property_private_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `token` text DEFAULT NULL,
  `verification_level` int(20) NOT NULL DEFAULT 3 COMMENT 'بدأت 3 عشان الاداره رقم 1 و 2 رقم صاحب العقار الخاص ',
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `referral_code` varchar(50) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `user_id`, `referral_code`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 'S45ZVW3E', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `referral_logs`
--

CREATE TABLE `referral_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referrer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `referred_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `points_awarded` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referral_logs`
--

INSERT INTO `referral_logs` (`id`, `referrer_id`, `referred_user_id`, `points_awarded`, `created_at`, `updated_at`) VALUES
(1, 1, 25, 10, '2025-01-02 08:58:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', NULL, NULL),
(3, 'subadmin', 'admin', '2025-01-18 19:10:24', '2025-02-18 14:02:21'),
(4, 'vendor', 'admin', '2025-01-21 14:02:49', '2025-01-22 20:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 6),
(2, 1),
(2, 6),
(3, 1),
(3, 6),
(4, 1),
(5, 1),
(5, 2),
(5, 5),
(5, 6),
(6, 1),
(6, 2),
(6, 5),
(6, 6),
(7, 1),
(7, 2),
(7, 5),
(7, 6),
(8, 1),
(8, 2),
(8, 5),
(9, 1),
(9, 2),
(9, 4),
(9, 6),
(10, 1),
(10, 2),
(10, 4),
(10, 6),
(11, 1),
(11, 2),
(11, 4),
(11, 6),
(12, 1),
(12, 2),
(12, 4),
(12, 6),
(13, 1),
(13, 2),
(13, 5),
(14, 1),
(14, 2),
(14, 5),
(15, 1),
(15, 2),
(15, 5),
(16, 1),
(16, 2),
(16, 5),
(17, 1),
(17, 2),
(17, 6),
(18, 1),
(18, 2),
(18, 6),
(19, 1),
(19, 2),
(19, 6),
(20, 1),
(20, 2),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(29, 4),
(30, 1),
(49, 1),
(49, 6),
(85, 6),
(90, 2),
(90, 6),
(91, 2),
(91, 6),
(92, 2),
(92, 6),
(93, 6),
(98, 4),
(98, 6),
(99, 4),
(99, 6),
(100, 4),
(100, 6),
(101, 4),
(101, 6),
(106, 6),
(107, 6),
(108, 6),
(109, 6),
(118, 1),
(118, 6),
(119, 1),
(119, 6),
(120, 1),
(120, 2),
(120, 4),
(120, 6),
(121, 5),
(121, 6),
(122, 1),
(122, 5),
(122, 6),
(123, 1),
(123, 5),
(123, 6),
(124, 6),
(125, 6),
(150, 2),
(150, 4),
(151, 0),
(151, 2),
(151, 3),
(151, 4),
(152, 0),
(152, 2),
(152, 3),
(152, 4),
(153, 2),
(153, 4),
(154, 2),
(154, 4),
(155, 4),
(156, 4),
(157, 4),
(158, 4),
(164, 4),
(165, 4),
(167, 4),
(168, 4),
(169, 4),
(170, 4),
(171, 1),
(172, 1),
(173, 1),
(174, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seo_tags`
--

CREATE TABLE `seo_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `page_title` text NOT NULL,
  `page_description` longtext DEFAULT NULL,
  `page_url` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `model_name` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول التصنيفات';

--
-- Dumping data for table `seo_tags`
--

INSERT INTO `seo_tags` (`id`, `admin_id`, `page_title`, `page_description`, `page_url`, `keywords`, `created_at`, `updated_at`, `model_name`, `model_id`) VALUES
(1, 1, 'مل', 'ml', NULL, NULL, '2024-04-13 17:45:30', '2024-04-13 17:53:41', '', 0),
(2, 1, 'جم', 'garam', NULL, NULL, '2024-04-13 17:45:30', '2024-04-22 10:36:55', '', 0),
(3, 1, 'Illum obcaecati mag', 'Doloribus excepteur', NULL, NULL, '2024-07-26 16:29:23', '2024-07-26 16:29:23', '\\App\\Models\\Product', 8),
(4, 1, 'Tempora non anim exe', 'Odit laboriosam eum', NULL, NULL, '2024-08-03 16:45:59', '2024-08-03 16:45:59', '\\App\\Models\\Product', 9),
(5, 1, 'Sit recusandae Offi', 'Sint in sed rerum re', NULL, NULL, '2024-08-03 16:56:14', '2024-08-03 16:56:14', '\\App\\Models\\Product', 11),
(6, 1, 'Tempor quia suscipit', 'Eos ut hic nisi sus', NULL, NULL, '2024-08-03 16:59:07', '2024-08-03 16:59:07', '\\App\\Models\\Product', 19),
(7, 1, 'Eaque recusandae Au', 'Nemo nisi sed rem ra', NULL, NULL, '2024-08-06 08:07:43', '2024-08-06 08:07:43', '\\App\\Models\\Product', 20),
(8, 1, 'Eaque recusandae Au', 'Nemo nisi sed rem ra', NULL, NULL, '2024-08-06 08:08:47', '2024-08-06 08:08:47', '\\App\\Models\\Product', 21),
(9, 1, 'Assumenda qui tempor', 'A odit tempor vero n', NULL, NULL, '2024-08-07 08:03:44', '2024-08-07 08:03:44', '\\App\\Models\\Product', 23),
(10, 1, 'Excepteur et necessi', 'Cupiditate excepteur', NULL, NULL, '2024-08-17 13:02:15', '2024-08-17 13:02:15', '\\App\\Models\\Product', 24),
(11, 1, 'عنوان المقال', 'dfghjkltdes', 'maqaal-tqkepy', 'يبلاتةن،يتبالت،لاتن', '2025-01-24 21:26:49', '2025-04-29 16:55:45', '\\App\\Models\\Blog', 12);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `locked` tinyint(1) NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `group`, `name`, `locked`, `payload`, `created_at`, `updated_at`) VALUES
(1, 'general', 'site_name_ar', 0, '\"\\u0639\\u0642\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0633\\u0639\\u0648\\u062f\\u064a\\u0629\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(2, 'general', 'site_name_en', 0, '\"Aqarat Saudi\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(3, 'general', 'site_active', 0, 'true', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(4, 'general', 'logo', 0, '\"\\/uploadedImages\\/\\/settings-1745531571.png\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(5, 'general', 'email', 0, '\"info@email.com\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(6, 'general', 'address_ar', 0, '\"\\u0645\\u0635\\u0631\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(7, 'general', 'address_en', 0, '\"Egypt\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(8, 'general', 'facebook_link', 0, '\"https:\\/\\/www.facebook.com\"', '2024-12-08 09:28:24', '2024-12-08 09:28:24'),
(9, 'general', 'base_logo', 0, '\"https:\\/\\/www.google.com\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(10, 'general', 'favicon', 0, '\"\\/uploadedImages\\/\\/settings-1745531571.png\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(11, 'general', 'phone', 0, '\"96658033832\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(12, 'general', 'whatsapp_phone', 0, '\"1123333332\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(16, 'seo', 'meta_title_ar', 0, '\"\\u0639\\u0642\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0633\\u0639\\u0648\\u062f\\u064a\\u0629 - \\u0633\\u0647\\u0648\\u0644\\u0629 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u0641\\u064a \\u0645\\u062a\\u0646\\u0627\\u0648\\u0644 \\u064a\\u062f\\u0643\"', '2024-12-08 09:44:07', '2025-04-20 17:30:54'),
(17, 'seo', 'meta_title_en', 0, '\"\\u0639\\u0642\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0633\\u0639\\u0648\\u062f\\u064a\\u0629 - \\u0633\\u0647\\u0648\\u0644\\u0629 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u0641\\u064a \\u0645\\u062a\\u0646\\u0627\\u0648\\u0644 \\u064a\\u062f\\u0643\"', '2024-12-08 09:44:07', '2025-04-20 17:30:54'),
(18, 'seo', 'meta_description_ar', 0, '\"\\u0627\\u0643\\u062a\\u0634\\u0641 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u062a\\u0633\\u0648\\u0642 \\u0641\\u0631\\u064a\\u062f\\u0629 \\u0645\\u0639 \\u062a\\u0637\\u0628\\u064a\\u0642 \\u0644\\u0627\\u0645\\u0648\\u0631! \\u0627\\u062d\\u0635\\u0644 \\u0639\\u0644\\u0649 \\u0623\\u062d\\u062f\\u062b \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0648\\u0627\\u0644\\u0639\\u0631\\u0648\\u0636 \\u0627\\u0644\\u0645\\u0645\\u064a\\u0632\\u0629 \\u0628\\u0633\\u0647\\u0648\\u0644\\u0629 \\u0648\\u0631\\u0627\\u062d\\u0629 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0648\\u0627\\u062c\\u0647\\u0629 \\u0645\\u0635\\u0645\\u0645\\u0629 \\u062e\\u0635\\u064a\\u0635\\u064b\\u0627 \\u0644\\u062a\\u0644\\u0628\\u064a\\u0629 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643. \\u0627\\u0628\\u062f\\u0623 \\u0631\\u062d\\u0644\\u062a\\u0643 \\u0627\\u0644\\u0622\\u0646\"', '2024-12-08 09:44:07', '2025-04-20 17:30:54'),
(19, 'seo', 'meta_description_en', 0, '\"\\u0627\\u0643\\u062a\\u0634\\u0641 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u062a\\u0633\\u0648\\u0642 \\u0641\\u0631\\u064a\\u062f\\u0629 \\u0645\\u0639 \\u062a\\u0637\\u0628\\u064a\\u0642 \\u0644\\u0627\\u0645\\u0648\\u0631! \\u0627\\u062d\\u0635\\u0644 \\u0639\\u0644\\u0649 \\u0623\\u062d\\u062f\\u062b \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0648\\u0627\\u0644\\u0639\\u0631\\u0648\\u0636 \\u0627\\u0644\\u0645\\u0645\\u064a\\u0632\\u0629 \\u0628\\u0633\\u0647\\u0648\\u0644\\u0629 \\u0648\\u0631\\u0627\\u062d\\u0629 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0648\\u0627\\u062c\\u0647\\u0629 \\u0645\\u0635\\u0645\\u0645\\u0629 \\u062e\\u0635\\u064a\\u0635\\u064b\\u0627 \\u0644\\u062a\\u0644\\u0628\\u064a\\u0629 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643. \\u0627\\u0628\\u062f\\u0623 \\u0631\\u062d\\u0644\\u062a\\u0643 \\u0627\\u0644\\u0622\\u0646\"', '2024-12-08 09:44:07', '2025-04-20 17:30:54'),
(20, 'seo', 'keywords', 0, '\"\\u0645\\u0648\\u0642\\u0639 \\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a,\\u0639\\u0642\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0633\\u0639\\u0648\\u062f\\u064a\\u0629\"', '2024-12-08 09:44:07', '2025-04-20 17:30:54'),
(30, 'social', 'facebook_link', 0, '\"https:\\/\\/www.facebook.com\"', '2024-12-08 10:35:20', '2025-04-24 21:52:51'),
(31, 'social', 'whatsapp_link', 0, '\"Spatie\"', '2024-12-08 10:35:20', '2025-04-24 21:52:51'),
(32, 'social', 'twitter_link', 0, '\"https:\\/\\/www.twitter.com\\/\"', '2024-12-08 10:35:20', '2025-04-24 21:52:51'),
(33, 'social', 'instagram_link', 0, '\"https:\\/\\/www.instagram.com\\/\"', '2024-12-08 10:35:20', '2025-04-24 21:52:51'),
(34, 'social', 'tiktok_link', 0, '\"https:\\/\\/www.tiktok.com\\/\"', '2024-12-08 10:35:21', '2025-04-24 21:52:51'),
(35, 'social', 'linkedin_link', 0, '\"https:\\/\\/www.facebook.com\\/\"', '2024-12-08 10:35:21', '2025-04-24 21:52:51'),
(36, 'social', 'snapchat_link', 0, '\"https:\\/\\/www.snapchat.com\\/\"', '2024-12-08 10:35:21', '2025-04-24 21:52:51'),
(37, 'social', 'youtube_link', 0, '\"https:\\/\\/www.youtube.com\\/\"', '2024-12-08 10:35:21', '2025-04-24 21:52:51'),
(38, 'social', 'google_link', 0, '\"info@email.com\"', '2024-12-08 10:35:21', '2025-04-24 21:52:51'),
(39, 'social', 'android_link', 0, 'null', '2024-12-08 10:35:21', '2025-04-24 21:52:51'),
(40, 'social', 'ios_link', 0, 'null', '2024-12-08 10:35:21', '2025-04-24 21:52:51'),
(41, 'general', 'bank_account_number', 0, '\"96658033832\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(42, 'general', 'instapay_number', 0, '\"https:\\/\\/www.twitter.com\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(43, 'general', 'vodafone_cash_number', 0, '\"https:\\/\\/www.twitter.com\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(44, 'general', 'iban_number', 0, '\"96658033832\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(45, 'general', 'bank_name', 0, '\"https:\\/\\/www.twitter.com\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(46, 'general', 'bank_account_name', 0, '\"https:\\/\\/www.twitter.com\"', '2024-12-08 09:28:24', '2025-04-24 21:52:51'),
(47, 'landing', 'about_title_ar', 0, '\"\\u0639\\u0646 \\u0627\\u0644\\u062a\\u0637\\u0628\\u064a\\u0642\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(48, 'landing', 'about_title_en', 0, '\"\\u0639\\u0646 \\u0627\\u0644\\u062a\\u0637\\u0628\\u064a\\u0642\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(49, 'landing', 'about_image', 0, '\"\\/uploadedImages\\/\\/settings-1738839952.png\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(50, 'landing', 'about_text_ar', 0, '\"\\\"\\u0644\\u0627\\u0645\\u0648\\u0631 \\u0647\\u0648 \\u0623\\u0643\\u062b\\u0631 \\u0645\\u0646 \\u0645\\u062c\\u0631\\u062f \\u062a\\u0637\\u0628\\u064a\\u0642 \\u062a\\u0633\\u0648\\u0642\\u061b \\u0625\\u0646\\u0647 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u0645\\u062a\\u0643\\u0627\\u0645\\u0644\\u0629 \\u062a\\u0647\\u062f\\u0641 \\u0625\\u0644\\u0649 \\u062a\\u062d\\u0648\\u064a\\u0644 \\u0637\\u0631\\u064a\\u0642\\u0629 \\u062a\\u0633\\u0648\\u0642\\u0643 \\u0625\\u0644\\u0649 \\u0644\\u062d\\u0638\\u0627\\u062a \\u0645\\u0646 \\u0627\\u0644\\u0631\\u0627\\u062d\\u0629 \\u0648\\u0627\\u0644\\u0633\\u0647\\u0648\\u0644\\u0629. \\u0646\\u062d\\u0646 \\u0646\\u0624\\u0645\\u0646 \\u0623\\u0646 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u064a\\u062c\\u0628 \\u0623\\u0646 \\u064a\\u0643\\u0648\\u0646 \\u0645\\u0645\\u062a\\u0639\\u064b\\u0627\\u060c \\u0644\\u0630\\u0644\\u0643 \\u0646\\u0642\\u062f\\u0645 \\u0644\\u0643 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u0648\\u0627\\u0633\\u0639\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0639\\u0627\\u0644\\u064a\\u0629 \\u0627\\u0644\\u062c\\u0648\\u062f\\u0629 \\u0627\\u0644\\u062a\\u064a \\u062a\\u0644\\u0628\\u064a \\u0643\\u0644 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643\\u060c \\u0633\\u0648\\u0627\\u0621 \\u0643\\u0627\\u0646\\u062a \\u0644\\u0644\\u0645\\u0646\\u0632\\u0644\\u060c \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u060c \\u0623\\u0648 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643 \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\\u0629 \\u0641\\u064a \\u0644\\u0627\\u0645\\u0648\\u0631\\u060c \\u0646\\u0633\\u0639\\u0649 \\u0625\\u0644\\u0649 \\u062a\\u062d\\u0642\\u064a\\u0642 \\u0627\\u0644\\u062a\\u0645\\u064a\\u0632 \\u0641\\u064a \\u0643\\u0644 \\u062e\\u0637\\u0648\\u0629 \\u0645\\u0646 \\u062e\\u0637\\u0648\\u0627\\u062a \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642. \\u0645\\u0646 \\u0648\\u0627\\u062c\\u0647\\u062a\\u0646\\u0627 \\u0627\\u0644\\u0645\\u0628\\u062a\\u0643\\u0631\\u0629 \\u0648\\u0627\\u0644\\u0633\\u0647\\u0644\\u0629 \\u0627\\u0644\\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645\\u060c \\u0625\\u0644\\u0649 \\u0637\\u0631\\u064a\\u0642\\u0629 \\u062a\\u0648\\u0635\\u064a\\u0644 \\u0627\\u0644\\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u0633\\u0631\\u064a\\u0639\\u0629 \\u0648\\u0627\\u0644\\u062f\\u0642\\u064a\\u0642\\u0629\\u060c \\u0643\\u0644 \\u0634\\u064a\\u0621 \\u062a\\u0645 \\u062a\\u0635\\u0645\\u064a\\u0645\\u0647 \\u0628\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0644\\u062a\\u0648\\u0641\\u064a\\u0631 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u062a\\u0633\\u0648\\u0642 \\u0644\\u0627 \\u0645\\u062b\\u064a\\u0644 \\u0644\\u0647\\u0627. \\u0646\\u062d\\u0631\\u0635 \\u0639\\u0644\\u0649 \\u0623\\u0646 \\u0646\\u0642\\u062f\\u0645 \\u0644\\u0643 \\u0623\\u0641\\u0636\\u0644 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0628\\u0623\\u0639\\u0644\\u0649 \\u0645\\u0639\\u0627\\u064a\\u064a\\u0631 \\u0627\\u0644\\u062c\\u0648\\u062f\\u0629\\u060c \\u0628\\u0627\\u0644\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0625\\u0644\\u0649 \\u062e\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062f\\u0641\\u0639 \\u0627\\u0644\\u0622\\u0645\\u0646\\u0629 \\u0648\\u0627\\u0644\\u0645\\u0631\\u064a\\u062d\\u0629 \\u0627\\u0644\\u062a\\u064a \\u062a\\u0646\\u0627\\u0633\\u0628\\u0643 \\u0631\\u0624\\u064a\\u062a\\u0646\\u0627 \\u062a\\u0643\\u0645\\u0646 \\u0641\\u064a \\u062a\\u0642\\u062f\\u064a\\u0645 \\u062a\\u0633\\u0648\\u0642 \\u0630\\u0643\\u064a \\u0648\\u0633\\u0644\\u0633 \\u064a\\u064f\\u0633\\u0647\\u0644 \\u0639\\u0644\\u064a\\u0643 \\u0627\\u0644\\u0648\\u0635\\u0648\\u0644 \\u0625\\u0644\\u0649 \\u0643\\u0644 \\u0645\\u0627 \\u062a\\u062d\\u062a\\u0627\\u062c\\u0647 \\u0641\\u064a \\u0623\\u064a \\u0648\\u0642\\u062a \\u0648\\u0645\\u0646 \\u0623\\u064a \\u0645\\u0643\\u0627\\u0646. \\u0646\\u062d\\u0646 \\u0646\\u0631\\u0643\\u0632 \\u0639\\u0644\\u0649 \\u0631\\u0636\\u0627 \\u0639\\u0645\\u0644\\u0627\\u0626\\u0646\\u0627\\u060c \\u0648\\u0646\\u0633\\u0639\\u0649 \\u062f\\u0627\\u0626\\u0645\\u064b\\u0627 \\u0644\\u0644\\u0627\\u0628\\u062a\\u0643\\u0627\\u0631 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0632\\u0627\\u064a\\u0627 \\u062c\\u062f\\u064a\\u062f\\u0629 \\u062a\\u062a\\u064a\\u062d \\u0644\\u0643 \\u062a\\u0633\\u0648\\u0642\\u064b\\u0627 \\u0645\\u0631\\u0646\\u064b\\u0627 \\u0648\\u0645\\u062a\\u0646\\u0648\\u0639\\u064b\\u0627. \\u0641\\u0631\\u064a\\u0642\\u0646\\u0627 \\u064a\\u0636\\u0645\\u0646 \\u0644\\u0643 \\u0627\\u0644\\u062f\\u0639\\u0645 \\u0627\\u0644\\u0645\\u0633\\u062a\\u0645\\u0631 \\u0639\\u0644\\u0649 \\u0645\\u062f\\u0627\\u0631 \\u0627\\u0644\\u0633\\u0627\\u0639\\u0629\\u060c \\u0644\\u0636\\u0645\\u0627\\u0646 \\u062d\\u0635\\u0648\\u0644\\u0643 \\u0639\\u0644\\u0649 \\u0623\\u0641\\u0636\\u0644 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u0645\\u0645\\u0643\\u0646\\u0629 \\u0627\\u0646\\u0636\\u0645 \\u0625\\u0644\\u0649 \\u0644\\u0627\\u0645\\u0648\\u0631 \\u0627\\u0644\\u0622\\u0646 \\u0644\\u062a\\u0643\\u062a\\u0634\\u0641 \\u0639\\u0627\\u0644\\u0645\\u0627\\u064b \\u062c\\u062f\\u064a\\u062f\\u0627\\u064b \\u0645\\u0646 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u0627\\u0644\\u0630\\u0643\\u064a \\u0627\\u0644\\u0630\\u064a \\u064a\\u0636\\u0639 \\u0631\\u0627\\u062d\\u062a\\u0643 \\u0641\\u064a \\u0627\\u0644\\u0645\\u0642\\u0627\\u0645 \\u0627\\u0644\\u0623\\u0648\\u0644. \\u0646\\u062d\\u0646 \\u0647\\u0646\\u0627 \\u0644\\u0646\\u0642\\u062f\\u0645 \\u0644\\u0643 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u0641\\u0631\\u064a\\u062f\\u0629 \\u0645\\u0646 \\u0646\\u0648\\u0639\\u0647\\u0627 \\u062a\\u062a\\u0646\\u0627\\u0633\\u0628 \\u0645\\u0639 \\u0623\\u0633\\u0644\\u0648\\u0628 \\u062d\\u064a\\u0627\\u062a\\u0643 \\u0648\\u062a\\u0644\\u0628\\u064a \\u0643\\u0627\\u0641\\u0629 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(51, 'landing', 'about_text_en', 0, '\"\\\"\\u0644\\u0627\\u0645\\u0648\\u0631 \\u0647\\u0648 \\u0623\\u0643\\u062b\\u0631 \\u0645\\u0646 \\u0645\\u062c\\u0631\\u062f \\u062a\\u0637\\u0628\\u064a\\u0642 \\u062a\\u0633\\u0648\\u0642\\u061b \\u0625\\u0646\\u0647 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u0645\\u062a\\u0643\\u0627\\u0645\\u0644\\u0629 \\u062a\\u0647\\u062f\\u0641 \\u0625\\u0644\\u0649 \\u062a\\u062d\\u0648\\u064a\\u0644 \\u0637\\u0631\\u064a\\u0642\\u0629 \\u062a\\u0633\\u0648\\u0642\\u0643 \\u0625\\u0644\\u0649 \\u0644\\u062d\\u0638\\u0627\\u062a \\u0645\\u0646 \\u0627\\u0644\\u0631\\u0627\\u062d\\u0629 \\u0648\\u0627\\u0644\\u0633\\u0647\\u0648\\u0644\\u0629. \\u0646\\u062d\\u0646 \\u0646\\u0624\\u0645\\u0646 \\u0623\\u0646 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u064a\\u062c\\u0628 \\u0623\\u0646 \\u064a\\u0643\\u0648\\u0646 \\u0645\\u0645\\u062a\\u0639\\u064b\\u0627\\u060c \\u0644\\u0630\\u0644\\u0643 \\u0646\\u0642\\u062f\\u0645 \\u0644\\u0643 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u0648\\u0627\\u0633\\u0639\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0639\\u0627\\u0644\\u064a\\u0629 \\u0627\\u0644\\u062c\\u0648\\u062f\\u0629 \\u0627\\u0644\\u062a\\u064a \\u062a\\u0644\\u0628\\u064a \\u0643\\u0644 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643\\u060c \\u0633\\u0648\\u0627\\u0621 \\u0643\\u0627\\u0646\\u062a \\u0644\\u0644\\u0645\\u0646\\u0632\\u0644\\u060c \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u060c \\u0623\\u0648 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643 \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\\u0629 \\u0641\\u064a \\u0644\\u0627\\u0645\\u0648\\u0631\\u060c \\u0646\\u0633\\u0639\\u0649 \\u0625\\u0644\\u0649 \\u062a\\u062d\\u0642\\u064a\\u0642 \\u0627\\u0644\\u062a\\u0645\\u064a\\u0632 \\u0641\\u064a \\u0643\\u0644 \\u062e\\u0637\\u0648\\u0629 \\u0645\\u0646 \\u062e\\u0637\\u0648\\u0627\\u062a \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642. \\u0645\\u0646 \\u0648\\u0627\\u062c\\u0647\\u062a\\u0646\\u0627 \\u0627\\u0644\\u0645\\u0628\\u062a\\u0643\\u0631\\u0629 \\u0648\\u0627\\u0644\\u0633\\u0647\\u0644\\u0629 \\u0627\\u0644\\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645\\u060c \\u0625\\u0644\\u0649 \\u0637\\u0631\\u064a\\u0642\\u0629 \\u062a\\u0648\\u0635\\u064a\\u0644 \\u0627\\u0644\\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u0633\\u0631\\u064a\\u0639\\u0629 \\u0648\\u0627\\u0644\\u062f\\u0642\\u064a\\u0642\\u0629\\u060c \\u0643\\u0644 \\u0634\\u064a\\u0621 \\u062a\\u0645 \\u062a\\u0635\\u0645\\u064a\\u0645\\u0647 \\u0628\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0644\\u062a\\u0648\\u0641\\u064a\\u0631 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u062a\\u0633\\u0648\\u0642 \\u0644\\u0627 \\u0645\\u062b\\u064a\\u0644 \\u0644\\u0647\\u0627. \\u0646\\u062d\\u0631\\u0635 \\u0639\\u0644\\u0649 \\u0623\\u0646 \\u0646\\u0642\\u062f\\u0645 \\u0644\\u0643 \\u0623\\u0641\\u0636\\u0644 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0628\\u0623\\u0639\\u0644\\u0649 \\u0645\\u0639\\u0627\\u064a\\u064a\\u0631 \\u0627\\u0644\\u062c\\u0648\\u062f\\u0629\\u060c \\u0628\\u0627\\u0644\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0625\\u0644\\u0649 \\u062e\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062f\\u0641\\u0639 \\u0627\\u0644\\u0622\\u0645\\u0646\\u0629 \\u0648\\u0627\\u0644\\u0645\\u0631\\u064a\\u062d\\u0629 \\u0627\\u0644\\u062a\\u064a \\u062a\\u0646\\u0627\\u0633\\u0628\\u0643 \\u0631\\u0624\\u064a\\u062a\\u0646\\u0627 \\u062a\\u0643\\u0645\\u0646 \\u0641\\u064a \\u062a\\u0642\\u062f\\u064a\\u0645 \\u062a\\u0633\\u0648\\u0642 \\u0630\\u0643\\u064a \\u0648\\u0633\\u0644\\u0633 \\u064a\\u064f\\u0633\\u0647\\u0644 \\u0639\\u0644\\u064a\\u0643 \\u0627\\u0644\\u0648\\u0635\\u0648\\u0644 \\u0625\\u0644\\u0649 \\u0643\\u0644 \\u0645\\u0627 \\u062a\\u062d\\u062a\\u0627\\u062c\\u0647 \\u0641\\u064a \\u0623\\u064a \\u0648\\u0642\\u062a \\u0648\\u0645\\u0646 \\u0623\\u064a \\u0645\\u0643\\u0627\\u0646. \\u0646\\u062d\\u0646 \\u0646\\u0631\\u0643\\u0632 \\u0639\\u0644\\u0649 \\u0631\\u0636\\u0627 \\u0639\\u0645\\u0644\\u0627\\u0626\\u0646\\u0627\\u060c \\u0648\\u0646\\u0633\\u0639\\u0649 \\u062f\\u0627\\u0626\\u0645\\u064b\\u0627 \\u0644\\u0644\\u0627\\u0628\\u062a\\u0643\\u0627\\u0631 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0632\\u0627\\u064a\\u0627 \\u062c\\u062f\\u064a\\u062f\\u0629 \\u062a\\u062a\\u064a\\u062d \\u0644\\u0643 \\u062a\\u0633\\u0648\\u0642\\u064b\\u0627 \\u0645\\u0631\\u0646\\u064b\\u0627 \\u0648\\u0645\\u062a\\u0646\\u0648\\u0639\\u064b\\u0627. \\u0641\\u0631\\u064a\\u0642\\u0646\\u0627 \\u064a\\u0636\\u0645\\u0646 \\u0644\\u0643 \\u0627\\u0644\\u062f\\u0639\\u0645 \\u0627\\u0644\\u0645\\u0633\\u062a\\u0645\\u0631 \\u0639\\u0644\\u0649 \\u0645\\u062f\\u0627\\u0631 \\u0627\\u0644\\u0633\\u0627\\u0639\\u0629\\u060c \\u0644\\u0636\\u0645\\u0627\\u0646 \\u062d\\u0635\\u0648\\u0644\\u0643 \\u0639\\u0644\\u0649 \\u0623\\u0641\\u0636\\u0644 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u0645\\u0645\\u0643\\u0646\\u0629 \\u0627\\u0646\\u0636\\u0645 \\u0625\\u0644\\u0649 \\u0644\\u0627\\u0645\\u0648\\u0631 \\u0627\\u0644\\u0622\\u0646 \\u0644\\u062a\\u0643\\u062a\\u0634\\u0641 \\u0639\\u0627\\u0644\\u0645\\u0627\\u064b \\u062c\\u062f\\u064a\\u062f\\u0627\\u064b \\u0645\\u0646 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u0627\\u0644\\u0630\\u0643\\u064a \\u0627\\u0644\\u0630\\u064a \\u064a\\u0636\\u0639 \\u0631\\u0627\\u062d\\u062a\\u0643 \\u0641\\u064a \\u0627\\u0644\\u0645\\u0642\\u0627\\u0645 \\u0627\\u0644\\u0623\\u0648\\u0644. \\u0646\\u062d\\u0646 \\u0647\\u0646\\u0627 \\u0644\\u0646\\u0642\\u062f\\u0645 \\u0644\\u0643 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u0641\\u0631\\u064a\\u062f\\u0629 \\u0645\\u0646 \\u0646\\u0648\\u0639\\u0647\\u0627 \\u062a\\u062a\\u0646\\u0627\\u0633\\u0628 \\u0645\\u0639 \\u0623\\u0633\\u0644\\u0648\\u0628 \\u062d\\u064a\\u0627\\u062a\\u0643 \\u0648\\u062a\\u0644\\u0628\\u064a \\u0643\\u0627\\u0641\\u0629 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(52, 'landing', 'banner_title_ar', 0, '\"\\u0644\\u0627\\u0645\\u0648\\u0631 - \\u0633\\u0647\\u0648\\u0644\\u0629 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u0641\\u064a \\u0645\\u062a\\u0646\\u0627\\u0648\\u0644 \\u064a\\u062f\\u0643\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(53, 'landing', 'banner_title_en', 0, '\"\\u0644\\u0627\\u0645\\u0648\\u0631 - \\u0633\\u0647\\u0648\\u0644\\u0629 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u0641\\u064a \\u0645\\u062a\\u0646\\u0627\\u0648\\u0644 \\u064a\\u062f\\u0643\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(54, 'landing', 'banner_image', 0, '\"\\/uploadedImages\\/\\/settings-1738839849.png\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(55, 'landing', 'banner_text_ar', 0, '\"\\u0627\\u0643\\u062a\\u0634\\u0641 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u062a\\u0633\\u0648\\u0642 \\u0641\\u0631\\u064a\\u062f\\u0629 \\u0645\\u0639 \\u062a\\u0637\\u0628\\u064a\\u0642 \\u0644\\u0627\\u0645\\u0648\\u0631! \\u0627\\u062d\\u0635\\u0644 \\u0639\\u0644\\u0649 \\u0623\\u062d\\u062f\\u062b \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0648\\u0627\\u0644\\u0639\\u0631\\u0648\\u0636 \\u0627\\u0644\\u0645\\u0645\\u064a\\u0632\\u0629 \\u0628\\u0633\\u0647\\u0648\\u0644\\u0629 \\u0648\\u0631\\u0627\\u062d\\u0629 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0648\\u0627\\u062c\\u0647\\u0629 \\u0645\\u0635\\u0645\\u0645\\u0629 \\u062e\\u0635\\u064a\\u0635\\u064b\\u0627 \\u0644\\u062a\\u0644\\u0628\\u064a\\u0629 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643. \\u0627\\u0628\\u062f\\u0623 \\u0631\\u062d\\u0644\\u062a\\u0643 \\u0627\\u0644\\u0622\\u0646\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(56, 'landing', 'banner_text_en', 0, '\"\\u0627\\u0643\\u062a\\u0634\\u0641 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u062a\\u0633\\u0648\\u0642 \\u0641\\u0631\\u064a\\u062f\\u0629 \\u0645\\u0639 \\u062a\\u0637\\u0628\\u064a\\u0642 \\u0644\\u0627\\u0645\\u0648\\u0631! \\u0627\\u062d\\u0635\\u0644 \\u0639\\u0644\\u0649 \\u0623\\u062d\\u062f\\u062b \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0648\\u0627\\u0644\\u0639\\u0631\\u0648\\u0636 \\u0627\\u0644\\u0645\\u0645\\u064a\\u0632\\u0629 \\u0628\\u0633\\u0647\\u0648\\u0644\\u0629 \\u0648\\u0631\\u0627\\u062d\\u0629 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0648\\u0627\\u062c\\u0647\\u0629 \\u0645\\u0635\\u0645\\u0645\\u0629 \\u062e\\u0635\\u064a\\u0635\\u064b\\u0627 \\u0644\\u062a\\u0644\\u0628\\u064a\\u0629 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643. \\u0627\\u0628\\u062f\\u0623 \\u0631\\u062d\\u0644\\u062a\\u0643 \\u0627\\u0644\\u0622\\u0646\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(57, 'landing', 'feature_title_ar', 0, '\"\\u0645\\u0645\\u064a\\u0632\\u0627\\u062a \\u0627\\u0644\\u062a\\u0637\\u0628\\u064a\\u0642\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(58, 'landing', 'feature_title_en', 0, '\"\\u0645\\u0645\\u064a\\u0632\\u0627\\u062a \\u0627\\u0644\\u062a\\u0637\\u0628\\u064a\\u0642\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(59, 'landing', 'feature_image', 0, '\"\\/uploadedImages\\/\\/settings-1738840041.png\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(60, 'landing', 'feature_text_ar', 0, '\"<p class=\\\"about-txt my-4 fw-medium\\\">\\r\\n                \\u0644\\u0627\\u0645\\u0648\\u0631 \\u0647\\u0648 \\u0623\\u0643\\u062b\\u0631 \\u0645\\u0646 \\u0645\\u062c\\u0631\\u062f \\u062a\\u0637\\u0628\\u064a\\u0642 \\u062a\\u0633\\u0648\\u0642\\u060c \\u0641\\u0647\\u0648 \\u0639\\u0627\\u0644\\u0645 \\u0643\\u0627\\u0645\\u0644 \\u0645\\u0646 \\u0627\\u0644\\u0631\\u0627\\u062d\\u0629 \\u0648\\u0627\\u0644\\u0633\\u0647\\u0648\\u0644\\u0629 \\u0641\\u064a \\u0643\\u0644 \\u0639\\u0645\\u0644\\u064a\\u0629 \\u0634\\u0631\\u0627\\u0621 \\u062a\\u0642\\u0648\\u0645 \\u0628\\u0647\\u0627. \\u0646\\u062d\\u0646 \\u0646\\u0642\\u062f\\u0645 \\u0644\\u0643 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u062a\\u0633\\u0648\\u0642 \\u0645\\u0628\\u062a\\u0643\\u0631\\u0629 \\u062a\\u062c\\u0645\\u0639 \\u0628\\u064a\\u0646 \\u0627\\u0644\\u062a\\u0646\\u0648\\u0639 \\u0648\\u0627\\u0644\\u062c\\u0648\\u062f\\u0629 \\u0627\\u0644\\u0639\\u0627\\u0644\\u064a\\u0629\\u060c \\u062d\\u064a\\u062b \\u062a\\u062c\\u062f \\u0643\\u0644 \\u0645\\u0627 \\u062a\\u062d\\u062a\\u0627\\u062c\\u0647 \\u0648\\u0623\\u0643\\u062b\\u0631 \\u0641\\u064a \\u0645\\u0643\\u0627\\u0646 \\u0648\\u0627\\u062d\\u062f. \\u0646\\u062d\\u0646 \\u0646\\u062f\\u0631\\u0643 \\u0623\\u0646 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643 \\u0627\\u0644\\u064a\\u0648\\u0645\\u064a\\u0629 \\u062a\\u0633\\u062a\\u062d\\u0642 \\u0627\\u0644\\u0623\\u0641\\u0636\\u0644\\u060c \\u0644\\u0630\\u0644\\u0643 \\u0646\\u062d\\u0631\\u0635 \\u0639\\u0644\\u0649 \\u0623\\u0646 \\u0646\\u0642\\u062f\\u0645 \\u0644\\u0643 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u0648\\u0627\\u0633\\u0639\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0627\\u0644\\u062a\\u064a \\u062a\\u063a\\u0637\\u064a \\u062c\\u0645\\u064a\\u0639 \\u062c\\u0648\\u0627\\u0646\\u0628 \\u062d\\u064a\\u0627\\u062a\\u0643 \\u0627\\u0644\\u064a\\u0648\\u0645\\u064a\\u0629\\u060c \\u0645\\u0646 \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\\u0627\\u062a \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0645\\u0644\\u0627\\u0628\\u0633\\u060c \\u0645\\u0646 \\u0627\\u0644\\u0623\\u062f\\u0648\\u0627\\u062a \\u0627\\u0644\\u0645\\u0646\\u0632\\u0644\\u064a\\u0629 \\u0625\\u0644\\u0649 \\u0645\\u0633\\u062a\\u062d\\u0636\\u0631\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0645\\u064a\\u0644\\u060c \\u0648\\u0643\\u0644 \\u0645\\u0627 \\u064a\\u0645\\u0643\\u0646 \\u0623\\u0646 \\u064a\\u0633\\u0627\\u0639\\u062f \\u0641\\u064a \\u062a\\u0633\\u0647\\u064a\\u0644 \\u062d\\u064a\\u0627\\u062a\\u0643 \\u0646\\u062d\\u0646 \\u0641\\u064a \\u0644\\u0627\\u0645\\u0648\\u0631 \\u0646\\u0641\\u0647\\u0645 \\u0623\\u0646 \\u062a\\u0633\\u0648\\u0642\\u0643 \\u064a\\u062c\\u0628 \\u0623\\u0646 \\u064a\\u0643\\u0648\\u0646 \\u0623\\u0643\\u062b\\u0631 \\u0645\\u0646 \\u0645\\u062c\\u0631\\u062f \\u0634\\u0631\\u0627\\u0621 \\u0645\\u0646\\u062a\\u062c\\u0627\\u062a\\u061b \\u064a\\u062c\\u0628 \\u0623\\u0646 \\u064a\\u0643\\u0648\\u0646 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u0645\\u0645\\u062a\\u0639\\u0629 \\u0648\\u0633\\u0647\\u0644\\u0629. \\u0644\\u0630\\u0644\\u0643\\u060c \\u0646\\u0631\\u0643\\u0632 \\u0639\\u0644\\u0649 \\u062a\\u0648\\u0641\\u064a\\u0631 \\u0648\\u0627\\u062c\\u0647\\u0629 \\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0645\\u0631\\u064a\\u062d\\u0629 \\u0648\\u0633\\u0647\\u0644\\u0629 \\u0627\\u0644\\u062a\\u0646\\u0642\\u0644 \\u062a\\u062a\\u064a\\u062d \\u0644\\u0643 \\u0627\\u0644\\u0648\\u0635\\u0648\\u0644 \\u0625\\u0644\\u0649 \\u0643\\u0644 \\u0645\\u0627 \\u062a\\u0628\\u062d\\u062b \\u0639\\u0646\\u0647 \\u0641\\u064a \\u062b\\u0648\\u0627\\u0646\\u064d \\u0645\\u0639\\u062f\\u0648\\u062f\\u0629. \\u0633\\u0648\\u0627\\u0621 \\u0643\\u0646\\u062a \\u062a\\u0628\\u062d\\u062b \\u0639\\u0646 \\u0645\\u0646\\u062a\\u062c \\u0645\\u0639\\u064a\\u0646 \\u0623\\u0648 \\u062a\\u0631\\u063a\\u0628 \\u0641\\u064a \\u0627\\u0633\\u062a\\u0643\\u0634\\u0627\\u0641 \\u062e\\u064a\\u0627\\u0631\\u0627\\u062a \\u062c\\u062f\\u064a\\u062f\\u0629\\u060c \\u0646\\u062d\\u0646 \\u0646\\u0642\\u062f\\u0645 \\u0644\\u0643 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u062a\\u0633\\u0648\\u0642 \\u0644\\u0627 \\u062a\\u0636\\u0627\\u0647\\u0649.\\r\\n              <\\/p>\\r\\n              <div class=\\\"app-features\\\">\\r\\n                <ul>\\r\\n                  <li>\\r\\n                    <div class=\\\"shape bg-main\\\">\\r\\n                      <img src=\\\"images\\/shape.svg\\\" alt=\\\"\\\">\\r\\n                    <\\/div>\\r\\n                    <div>\\r\\n                      <h3 class=\\\"fw-bold fs-4\\\">\\u062a\\u062e\\u0635\\u064a\\u0635 \\u0627\\u0644\\u0631\\u0648\\u062a\\u064a\\u0646 \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a<\\/h3>\\r\\n                      <p class=\\\"text-muted fs-6\\\">\\r\\n                        \\u064a\\u062a\\u064a\\u062d \\u0644\\u0643 \\u0627\\u0644\\u062a\\u0637\\u0628\\u064a\\u0642 \\u0625\\u0646\\u0634\\u0627\\u0621 \\u0631\\u0648\\u062a\\u064a\\u0646 \\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0628\\u0634\\u0631\\u0629 \\u0645\\u0635\\u0645\\u0645 \\u062e\\u0635\\u064a\\u0635\\u064b\\u0627 \\u0644\\u064a\\u0646\\u0627\\u0633\\u0628 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a \\u0628\\u0634\\u0631\\u062a\\u0643 \\u0648\\u0646\\u0648\\u0639\\u0647\\u0627\\r\\n                      <\\/p>\\r\\n                    <\\/div>\\r\\n                  <\\/li>\\r\\n                  <li>\\r\\n                    <div class=\\\"shape bg-main\\\">\\r\\n                      <img src=\\\"images\\/shape.svg\\\" alt=\\\"\\\">\\r\\n                    <\\/div>\\r\\n                    <div>\\r\\n                      <h3 class=\\\"fw-bold fs-4\\\">\\u0627\\u0642\\u062a\\u0631\\u0627\\u062d \\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0645\\u062b\\u0627\\u0644\\u064a\\u0629<\\/h3>\\r\\n                      <p class=\\\"text-muted fs-6\\\">\\r\\n                        \\u064a\\u0648\\u0641\\u0631 \\u0627\\u0644\\u062a\\u0637\\u0628\\u064a\\u0642 \\u062a\\u0648\\u0635\\u064a\\u0627\\u062a \\u062f\\u0642\\u064a\\u0642\\u0629 \\u0644\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0627\\u0644\\u0645\\u0646\\u0627\\u0633\\u0628\\u0629 \\u0644\\u0628\\u0634\\u0631\\u062a\\u0643 \\u0628\\u0646\\u0627\\u0621\\u064b \\u0639\\u0644\\u0649 \\u062d\\u0627\\u0644\\u062a\\u0647\\u0627 \\u0648\\u0623\\u0647\\u062f\\u0627\\u0641\\u0643 \\u0627\\u0644\\u062c\\u0645\\u0627\\u0644\\u064a\\u0629\\r\\n                      <\\/p>\\r\\n                    <\\/div>\\r\\n                  <\\/li>\\r\\n                  <li>\\r\\n                    <div class=\\\"shape bg-main\\\">\\r\\n                      <img src=\\\"images\\/shape.svg\\\" alt=\\\"\\\">\\r\\n                    <\\/div>\\r\\n                    <div>\\r\\n                      <h3 class=\\\"fw-bold fs-4\\\">\\u0645\\u062a\\u0627\\u0628\\u0639\\u0629 \\u0648\\u062a\\u062d\\u0644\\u064a\\u0644 \\u0627\\u0644\\u0628\\u0634\\u0631\\u0629<\\/h3>\\r\\n                      <p class=\\\"text-muted fs-6\\\">\\r\\n                        \\u064a\\u062a\\u0627\\u0628\\u0639 \\u0627\\u0644\\u062a\\u0637\\u0628\\u064a\\u0642 \\u062a\\u0642\\u062f\\u0645 \\u062d\\u0627\\u0644\\u062a\\u0643 \\u0627\\u0644\\u062c\\u0644\\u062f\\u064a\\u0629 \\u0648\\u064a\\u0642\\u062f\\u0645 \\u062a\\u062d\\u0644\\u064a\\u0644\\u0627\\u062a \\u0648\\u0646\\u0635\\u0627\\u0626\\u062d \\u0644\\u062a\\u062d\\u0633\\u064a\\u0646 \\u0631\\u0648\\u062a\\u064a\\u0646\\u0643 \\u0628\\u0634\\u0643\\u0644 \\u0645\\u0633\\u062a\\u0645\\u0631\\r\\n                      <br><\\/p><h3 class=\\\"fw-bold fs-4\\\" style=\\\"font-family: Almarai, sans-serif;\\\"><br><\\/h3><p class=\\\"text-muted fs-6\\\" style=\\\"font-size: 16px;\\\">.<\\/p>\\r\\n                    <\\/div>\\r\\n                  <\\/li>\\r\\n                <\\/ul>\\r\\n              <\\/div>\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53'),
(61, 'landing', 'feature_text_en', 0, '\"<div class=\\\"section-title\\\" style=\\\"font-family: Beiruti, sans-serif; margin: 0px; padding: 0px; outline: none; border: none; transition-duration: 0.35s; transition-timing-function: linear; color: rgb(33, 37, 41);\\\"><h2 class=\\\"secTitle fw-bold secondry fs-2\\\" style=\\\"font-family: Beiruti, sans-serif; margin-right: 0px; margin-left: 0px; padding: 0px; outline: none; border: none; transition-duration: 0.35s; transition-timing-function: linear;\\\">\\u0645\\u0645\\u064a\\u0632\\u0627\\u062a \\u0627\\u0644\\u062a\\u0637\\u0628\\u064a\\u0642<\\/h2><div><br><\\/div><\\/div>\"', '2024-12-08 09:28:24', '2025-02-06 15:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `zone_id` varchar(20) DEFAULT NULL,
  `city_name` varchar(255) NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('show','hide') NOT NULL DEFAULT 'show'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `admin_id`, `zone_id`, `city_name`, `cost`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, '1', 'القاهرة', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(2, 1, '1', 'الأسكندرية', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(3, 1, '1', 'القاهرة الجديدة', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(4, 1, '1', 'الرحاب', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(5, 1, '1', 'حلوان', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(6, 1, '1', 'الجيزة', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(7, 1, '1', 'مدينة السادس من أكتوبر', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(8, 1, '1', 'الشيخ زايد', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(9, 1, '1', 'مدينة العاشر من رمضان', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(10, 1, '1', 'مدينة بدر', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(11, 1, '1', 'الشروق', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(12, 1, '1', 'العبور', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(13, 1, '1', 'مدينتي', 30.00, '2024-07-24 10:13:44', NULL, 'show'),
(14, 1, '2', 'بورسعيد', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(15, 1, '2', 'الإسماعلية', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(16, 1, '2', 'السويس', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(17, 1, '2', 'السخنه', 60.00, '2024-07-24 10:13:44', '2024-07-24 17:53:34', 'show'),
(18, 1, '3', 'البحيرة', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(20, 1, '3', 'دمياط', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(21, 1, '3', 'الدقهلية', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(22, 1, '3', 'كفر الشيخ', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(23, 1, '3', 'الغربية', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(24, 1, '3', 'المنوفية', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(25, 1, '3', 'الشرقية', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(26, 1, '3', 'القليوبية', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(27, 1, '3', 'دمنهور', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(28, 1, '3', 'المنصورة', 0.00, '2024-07-24 10:13:44', NULL, 'show'),
(29, 1, '3', 'Elsaf', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(30, 1, '3', 'سقارة', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(31, 1, '3', 'البدرشين', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(32, 1, '3', 'الحوامدية', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(33, 1, '3', 'Elkhatatba', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(34, 1, '3', 'دهشور', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(35, 1, '3', 'Owaism', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(36, 1, '3', 'Elharranyia', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(37, 1, '3', 'Shabramant', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(38, 1, '3', 'Atfeeh', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(39, 1, '3', 'أبو النمرس', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(40, 1, '3', 'Burkash', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(41, 1, '3', 'Arab mosaeed', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(42, 1, '3', 'العياط', 60.00, '2024-07-24 10:13:44', NULL, 'show'),
(43, 1, '4', 'الفيوم', 75.00, '2024-07-24 10:13:44', NULL, 'show'),
(44, 1, '4', 'بني سويف', 75.00, '2024-07-24 10:13:44', NULL, 'show'),
(45, 1, '4', 'المنيا', 75.00, '2024-07-24 10:13:44', NULL, 'show'),
(46, 1, '4', 'أسيوط', 75.00, '2024-07-24 10:13:44', NULL, 'show'),
(47, 1, '4', 'سوهاج', 75.00, '2024-07-24 10:13:44', NULL, 'show'),
(48, 1, '5', 'قنا', 85.00, '2024-07-24 10:13:44', NULL, 'show'),
(49, 1, '5', 'الأقصر', 85.00, '2024-07-24 10:13:44', NULL, 'show'),
(50, 1, '5', 'أسوان', 85.00, '2024-07-24 10:13:44', NULL, 'show'),
(51, 1, '5', 'شرم الشيخ', 85.00, '2024-07-24 10:13:44', NULL, 'show'),
(52, 1, '5', 'الغردقة', 85.00, '2024-07-24 10:13:44', NULL, 'show'),
(53, 1, '5', 'عيون موسي', 85.00, '2024-07-24 10:13:44', NULL, 'show'),
(54, 1, '5', 'راس سدر', 85.00, '2024-07-24 10:13:44', NULL, 'show'),
(55, 1, '5', 'شمال سيناء', 85.00, '2024-07-24 10:13:44', NULL, 'show'),
(56, 1, '5', 'الساحل الشمالي', 85.00, '2024-07-24 10:13:44', NULL, 'show'),
(57, 1, '5', 'مرسي مطروح', 85.00, '2024-07-24 10:13:44', NULL, 'show'),
(58, 1, '5', 'دهب', 85.00, '2024-07-24 10:13:44', NULL, 'show'),
(59, 1, '5', 'الطور', 85.00, '2024-07-24 10:13:44', NULL, 'show'),
(60, 1, '5', 'نويبع', 85.00, '2024-07-24 10:13:44', NULL, 'show'),
(61, 1, '6', 'جنوب سيناء', 95.00, '2024-07-24 10:13:44', NULL, 'show'),
(62, 1, '6', 'مرسي علم', 95.00, '2024-07-24 10:13:44', NULL, 'show'),
(63, 1, '6', 'العريش', 95.00, '2024-07-24 10:13:44', NULL, 'show'),
(64, 1, '6', 'الجونة', 95.00, '2024-07-24 10:13:44', NULL, 'show'),
(65, 1, '6', 'سفاجا', 95.00, '2024-07-24 10:13:44', NULL, 'show'),
(66, 1, '6', 'البحر الأحمر', 95.00, '2024-07-24 10:13:44', NULL, 'show'),
(67, 1, '6', 'طابا', 95.00, '2024-07-24 10:13:44', NULL, 'show'),
(68, 1, '6', 'Kosseir', 95.00, '2024-07-24 10:13:44', NULL, 'show'),
(69, 1, '3', 'المحلة الكبري', 100.00, '2024-07-24 10:13:44', '2024-08-17 13:12:29', 'show');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'fooz@gmail.com', '2024-03-06 10:31:14', '2024-03-06 10:31:14'),
(2, 'maitarekttt@gmail.com', '2024-08-16 22:23:49', '2024-08-16 22:23:49'),
(3, 'maitarekttt22@gmail.com', '2024-08-16 22:24:00', '2024-08-16 22:24:00'),
(4, 'maitarekt3tt22@gmail.com', '2024-08-16 22:24:18', '2024-08-16 22:24:18'),
(5, 'maitar2ekt3tt22@gmail.com', '2024-08-16 22:25:38', '2024-08-16 22:25:38'),
(6, 'v@ya.com', '2024-08-22 20:29:06', '2024-08-22 20:29:06'),
(7, 'm@y.co', '2024-08-22 20:32:24', '2024-08-22 20:32:24'),
(8, 'r@ya.co', '2024-08-22 20:35:14', '2024-08-22 20:35:14'),
(9, 'jjudy@yahoo.com', '2024-08-22 20:44:04', '2024-08-22 20:44:04'),
(10, 'd@yahoo.com', '2024-08-22 20:53:14', '2024-08-22 20:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `trackers`
--

CREATE TABLE `trackers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `visit_time` time DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `account_type` enum('vendors','admins','subadmins','users') NOT NULL,
  `roles_name` varchar(200) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `country_code` varchar(50) DEFAULT NULL,
  `mobile_code` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','accepted','blocked') NOT NULL DEFAULT 'pending',
  `mobile_verified_at` timestamp NULL DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `fcm_id` varchar(120) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `user_type` enum('owner','agent','co-owner','other') NOT NULL,
  `id_number` varchar(40) NOT NULL,
  `agency_number` int(20) DEFAULT NULL,
  `card_code` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `added_by`, `account_type`, `roles_name`, `name`, `email`, `mobile`, `country_code`, `mobile_code`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `mobile_verified_at`, `provider`, `provider_id`, `fcm_id`, `parent_id`, `last_login`, `user_type`, `id_number`, `agency_number`, `card_code`) VALUES
(1, 1, 'admins', '[\"Super Admin\"]', 'admin', 'admin@admin.com', '1097987077', '966', 1299, NULL, '$2y$10$BawRjI9.H1yRsa60HkmDUea1KozI1recHEBO/PZd4yzXu7JoKrKf6', '35oHmDVopdy6AfIg33NYRAWzZvCk4go1LZFvc3eXzx8PgXQVTUcDagvt7WGu', '2023-11-14 14:48:38', '2025-04-29 10:48:31', 'accepted', NULL, NULL, NULL, 'sdfghjk', NULL, '2025-04-29 10:48:31', 'owner', '', NULL, NULL),
(2, 1, 'admins', '[\"admin\"]', 'mohamed ahmmed', 'mohamed@admin.com', '1232142232', NULL, NULL, NULL, '$2y$10$6zhGKUsUSf8XoNyLIJS66eZo06LQHMka/HqD95tAlxLtemJGOCTQm', NULL, '2025-01-19 11:54:48', '2025-03-09 09:13:58', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(3, 1, 'subadmins', '[\"order employee\"]', 'yasser ahmed', 'yasser@admin.com', NULL, NULL, NULL, NULL, '$2y$10$pwyYu1W5JVTOhf29Jy7qCu7KcOYomfz7nTb4r9mckP/6ZQx3UJN4G', NULL, '2025-01-19 11:57:02', '2025-01-19 12:37:15', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(25, 1, 'users', '[\"user\"]', 'wessam sakr', 'wessam@user.com', '1097980291', '20', NULL, NULL, '$2y$10$cY8DuxeFlcyAqVjPzSbA8eqd4RZ.iJAGKMVHqN3y.4APAnvPu4Kxe', NULL, '2024-08-02 16:54:36', '2025-02-20 11:15:23', 'accepted', NULL, NULL, NULL, 'ffghjkl', NULL, NULL, 'owner', '', NULL, NULL),
(26, 1, 'users', '[\"user\"]', 'mahekhalifa', 'mahekhalifa@user.com', '0109797069', '20', NULL, NULL, '$2y$10$8rPvKCvXnzgRasR1MJztm.MisHthvn6/tEDaITYfQ8Esr/Zr6XToS', NULL, '2024-08-02 17:37:31', '2025-02-20 11:20:54', 'accepted', NULL, NULL, NULL, 'gbhnjk,l;\'', NULL, NULL, 'owner', '', NULL, NULL),
(32, 1, 'users', '[\"user\"]', 'mai tarek', 'maitarek@gmail.com', '2090987069', '20', NULL, NULL, '$2y$10$92wgv4PVjc75OI6Oc5JhROD24bMpbDrbxp2UbxSYXQrHTwUp/fVyW', NULL, '2024-09-28 16:26:13', '2025-02-20 11:22:47', 'accepted', '2025-01-16 10:02:10', NULL, NULL, 'dfghjk,l.;/\'\\', NULL, NULL, 'owner', '', NULL, NULL),
(36, 1, 'vendors', '[\"vendor\"]', 'Imani Hubbard', 'caxuvugyz@mailinator.com', '1098989866', NULL, NULL, NULL, '$2y$10$pfvLjzmKs4BTSr7jbkGSzOaHGWaZp0ifUEd1HIf0mJBVH5B87N70y', NULL, '2025-01-24 19:11:01', '2025-03-10 09:33:05', 'accepted', NULL, NULL, NULL, NULL, NULL, '2025-03-10 09:33:05', 'owner', '', NULL, NULL),
(37, 1, 'vendors', '[\"vendor\"]', 'dcfgbhk', 'caxuv22ugyz@mailinator.com', '6666666666', NULL, NULL, NULL, '$2y$10$nwzj4Q9zDWCtVNMuXcXR4OPnavIk55dLMVEXKVRx..DshPtJ9GfAG', NULL, '2025-01-24 19:42:48', '2025-01-24 19:42:49', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(38, 1, 'vendors', '[\"vendor\"]', 'Julian Davis', 'potuhoz@mailinator.com', '2666666666', NULL, NULL, NULL, '$2y$10$uR9zRl7ywTmzlAt5tj96auOmDsfYIm7Zh1GSKm7ijaX/OP5OAgVxy', NULL, '2025-01-24 20:33:22', '2025-01-24 20:33:22', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(39, 1, 'vendors', '[\"vendor\"]', 'mai tarek', 'admin@admine.com', '1223333332', NULL, NULL, NULL, '$2y$10$WJeF8doD.avU4VxlUOcwS.it1m4bxW7be/KLBRmhd5juKAkBxWDwS', NULL, '2025-01-25 11:10:59', '2025-01-25 11:11:00', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(40, 1, 'vendors', '[\"vendor\"]', 'dfgh', 'admin@ad1min.com', '0107987069', NULL, NULL, NULL, '$2y$10$HSoGJp7m.f1h7fwO0mB5SebXIxou7eOTdT9LipE7yB04JWd3qvSOG', NULL, '2025-01-25 11:14:02', '2025-01-25 11:14:03', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(41, 1, 'vendors', '[\"vendor\"]', 'mai tarek2', 'admin@admin.c22om', '0129797069', NULL, NULL, NULL, '$2y$10$U1QDoGev3QSJfaIu6vmFQe/.4Gmjqf77CPC.dzhf0NoqPC5RknwGC', NULL, '2025-01-25 11:15:57', '2025-01-25 11:15:57', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(42, 1, 'vendors', '[\"vendor\"]', 'Abdullah Elgazzar', 'info999@email.com', '1234567890', NULL, NULL, NULL, '$2y$10$b8cRu6TqC1/5.biIoQQFvebnyplyseW347dSwARTtPzrvidJJqyIK', NULL, '2025-02-06 12:18:11', '2025-02-06 12:18:11', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(43, 1, 'vendors', '[\"vendor\"]', 'Abdullah', 'elgazzara912@gmail.com', '0109398222', NULL, NULL, NULL, '$2y$10$EpGB1HWaXaRpXOGE/siMMOIPLpeF3wk6Ujri25ZWHoDeF8vB2np2K', NULL, '2025-02-06 13:53:56', '2025-02-06 13:53:56', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(44, 1, 'vendors', '[\"vendor\"]', 'Abdullah Ashraf', 'elgazzara2912@gmail.com', '9663455345', NULL, NULL, NULL, '$2y$10$U/6CtS6PX90hjnUHKPTbMuEuC/IsIQLll3qSZyUZ2Fy3b/w0OrqPW', NULL, '2025-02-06 13:57:02', '2025-02-06 13:57:02', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(45, 1, 'vendors', '[\"vendor\"]', 'Winter Holder', 'zujux@mailinator.com', '1232345678', NULL, NULL, NULL, '$2y$10$RERrIYYHg9Vw8Y.2GfOs9..ukekABqNvB9wJfGy3Ktn/GEvJdAu8y', NULL, '2025-02-06 14:41:16', '2025-03-06 13:28:43', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(46, 1, 'vendors', '[\"vendor\"]', 'Gisela Shaw', 'nypasi@mailinator.com', '1111111181', NULL, NULL, NULL, '$2y$10$oJYe7/V30G0/EeZMYdpb..vmJc4PjcWiSsXOE6hRj.WFPrqMnM4uO', NULL, '2025-02-17 12:21:38', '2025-02-17 12:21:38', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(47, 1, 'admins', '[\"admin\"]', 'ertghjtrrr', 'admin22@admin.com', '1232342232', NULL, NULL, NULL, '$2y$10$TYLvkEFDpGsK4cSXr0aZaeykBh9aPqua9wCVNH9omgSArk9D/w9jW', NULL, '2025-02-18 09:33:48', '2025-02-18 09:33:48', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(48, 1, 'vendors', '[\"vendor\"]', 'fffffff', 'fffffff@admin.com', '1232342232', NULL, NULL, NULL, '$2y$10$WTVWHwyeheLV6NaL9qyU6egGDGYEtfSHu3x3rcQT2c8rnz6YOJ9PK', NULL, '2025-02-18 10:58:17', '2025-02-18 10:58:17', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(49, 1, 'vendors', '[\"vendor\"]', 'Hyatt Frye', 'teju@mailinator.com', '2828222828', NULL, NULL, NULL, '$2y$10$UUKYJfCvpiLuVxOqOQknZu8u4WWubbQRgBQH0WJ1NTABv/wtxf4ji', NULL, '2025-02-18 11:26:25', '2025-02-18 11:31:43', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(50, 1, 'vendors', '[\"vendor\"]', 'mai tarek', 'maitarektt2222@gmail.com', '1097987069', NULL, NULL, NULL, '$2y$10$y4Am7B7zeLZW15MPoDtXwuiMxZksVU8yI9RxHo3n6GlMLsl5O9ZDK', NULL, '2025-02-18 11:38:05', '2025-02-18 11:46:54', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(51, 1, 'vendors', '[\"vendor\"]', 'Mohammad Nielsen', 'suda@mailinator.com', '2929299292', NULL, NULL, NULL, '$2y$10$J8EDggCsnB8z/ryM8EIYjuKO3QLQhExMSImJVAiZR1Eqx3L3Vrdve', NULL, '2025-02-18 11:45:37', '2025-02-18 11:45:37', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(57, 1, 'users', '[\"user\"]', 'mohamed', 'mohamed@user.com', '2222222222', NULL, NULL, NULL, '$2y$10$DdQdaSdBA7ml33c12hx9IeSkFgwSwKu4AuEAZpjGf3MjN5tToJt7K', NULL, '2025-02-19 09:20:13', '2025-02-20 11:16:10', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(58, 1, 'vendors', '[\"vendor\"]', 'محمد الطرشوبي', 'vendor@admin.com', '2222222222', NULL, NULL, NULL, '$2y$10$qtkxqhrsEQ6c8UkP.s86xO3/jeRslvl2VSAZUr1E6SlFmk.ADy3VK', NULL, '2025-02-19 09:30:18', '2025-02-20 09:28:13', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(59, 58, 'subadmins', '[\"subadmin\"]', 'cfghjk', 'cfghjk@admin.com', '2233344444', NULL, NULL, NULL, '$2y$10$SQz7ltUaCCcWFxiAE4rtCOI7lRV2niAuBhATZodX2fjSBl.x2KskO', NULL, '2025-02-19 09:31:40', '2025-02-19 09:31:42', 'accepted', NULL, NULL, NULL, NULL, 58, NULL, 'owner', '', NULL, NULL),
(60, 1, 'vendors', '[\"vendor\"]', 'frgrdg11', 'adminwwww@admin.com', '1232342232', NULL, NULL, NULL, '$2y$10$Orkrvl5d7x7eAQPkf6psEuhzLS5JCHty3yQd5kZQE3iRBZqwtj3G2', NULL, '2025-02-19 10:15:35', '2025-02-19 10:15:35', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(62, NULL, 'vendors', NULL, 'ahmed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-23 09:40:09', '2025-02-23 09:40:09', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(70, NULL, 'users', NULL, 'ahmed', 'medo@user.com', '1097979797', NULL, NULL, NULL, '$2y$10$OtRQtcQpX/ManeK4.csG0uFRUTx69QlE6oWdoMofLoI070E2TIwAu', NULL, '2025-02-23 09:49:59', '2025-03-05 11:21:35', 'accepted', '2025-02-23 13:18:29', NULL, NULL, NULL, NULL, '2025-03-05 11:21:35', 'owner', '', NULL, NULL),
(72, NULL, 'users', NULL, 'ahmed', NULL, '1097979795', NULL, NULL, NULL, '$2y$10$pATqTxOfNHaljePOf1Zki.twGhloRU4m0IY2PV08d1VnJ3khUqJSi', NULL, '2025-02-23 12:21:02', '2025-02-26 13:11:33', 'accepted', '2025-02-26 13:05:11', NULL, NULL, NULL, NULL, '2025-02-26 13:11:33', 'owner', '', NULL, NULL),
(73, NULL, 'users', NULL, 'ahmed', NULL, '1097979793', NULL, NULL, NULL, '$2y$10$V3.B95JsXCVJUQDAJiHeAucWykKOuhKBzznYZA3yHVXytxQdBbnBW', NULL, '2025-02-23 13:20:49', '2025-02-23 13:20:49', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(74, NULL, 'users', NULL, 'ahmed', NULL, '1097979792', NULL, 1234, NULL, '$2y$10$4AH8H7PGdYSeNnT9cUpOAua5OmAxqUiUXFiZw0CNwSncmDJ1E2sJO', NULL, '2025-02-23 13:22:38', '2025-02-23 13:22:38', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(75, 1, 'users', '[\"user\"]', 'ashraf12', 'ashraf12@user.com', '1097987033', NULL, NULL, NULL, '$2y$10$bsqiDzKFk230yHp97VNEpe3Fr6hbzXfsPQoG.A.YMqpCbtggaNJZ6', NULL, '2025-03-09 09:27:13', '2025-03-09 09:27:37', 'accepted', NULL, NULL, NULL, NULL, NULL, '2025-03-09 09:27:37', 'owner', '', NULL, NULL),
(76, 1, 'vendors', '[\"vendor\"]', 'Akeem Pugh', 'zybyxosoci@mailinator.com', '1888282828', NULL, NULL, NULL, '$2y$10$1MbeoxQd0qcCT8Rw1A7SCuIyb3h46fXolpZ77CnU7jY/WHtp0MhoO', NULL, '2025-03-09 11:03:22', '2025-03-09 11:03:22', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '', NULL, NULL),
(77, NULL, 'users', NULL, 'lllllllllllll', NULL, '1010101010', '20', NULL, NULL, '$2y$10$lWcUV9hMCcrlJ09PQ7dMiuOXxDgRiAf8TgYUN3OIFAIrXsq1DrAvu', NULL, '2025-04-20 16:29:44', '2025-04-23 13:57:16', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'agent', '22222222222', 2147483647, 2025277),
(78, NULL, 'users', NULL, 'أبو طاحون', NULL, '1112342232', NULL, NULL, NULL, '$2y$10$C5cFxJxTIr3idVyOxVDcuuDQe8x5yKcpiFmeF5/o2NVaf3MFuRv1a', NULL, '2025-04-21 12:22:21', '2025-04-21 12:22:21', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '1122333333', NULL, 2025178),
(79, NULL, 'users', NULL, 'muhamed', NULL, '1991919191', NULL, NULL, NULL, '$2y$10$ECWy.StsEoJW1bdewMTsTeZtUwpPhDsNyvMRnM0ES8qaTwnCMGMBq', NULL, '2025-04-24 22:45:27', '2025-04-24 22:45:27', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '1123444444', NULL, 2025179),
(80, NULL, 'users', NULL, '233993939', NULL, '2339939391', NULL, NULL, NULL, '$2y$10$UxXmeFcvQeQyCpn9b8lWzu4lKgIZg1ZyolpK8ZSUGFDQzYQ.DrVry', NULL, '2025-04-29 12:58:52', '2025-04-29 12:58:52', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '1123444444', NULL, 2025180),
(81, NULL, 'users', NULL, 'ee333333', NULL, '1233456699', NULL, NULL, NULL, '$2y$10$IxGnUCcc2XYrNeKJlqo0ReXAMGzLbxFrLaeU2lPTSAL0efj3wRx/.', NULL, '2025-04-29 15:51:41', '2025-04-29 15:51:41', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '1234567896', NULL, 2025181),
(82, NULL, 'users', NULL, '34t56789', NULL, '1212345678', NULL, NULL, NULL, '$2y$10$KBYxMJX07eJZKD/sxfbjCuE8uDelvyXBPxWkHNWu.k6XOiQyc2E42', NULL, '2025-04-29 16:01:36', '2025-04-29 16:01:36', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, 'owner', '1234567890', NULL, 2025182);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('apartment','house','office') DEFAULT NULL,
  `mark` text DEFAULT NULL,
  `label_name` text DEFAULT NULL,
  `street_name` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `apartment_no` varchar(250) DEFAULT NULL,
  `floor_no` varchar(250) DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `type`, `mark`, `label_name`, `street_name`, `created_at`, `updated_at`, `apartment_no`, `floor_no`, `district_id`) VALUES
(51, 72, 'office', 'أمام مسجد الصلاح', 'العنوان الرئيسي', 'شارع الهدي والنور', '2025-02-27 10:46:57', '2025-02-27 10:46:57', 'الشقة الرابع', 'الدور الأول', 5);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('deposit','withdrawal') NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_added_by_foreign` (`added_by`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_admin_id_foreign` (`added_by`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_replies`
--
ALTER TABLE `contact_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_notifies`
--
ALTER TABLE `general_notifies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `user_address_id` (`user_address_id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `assign_to` (`assign_to`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`mobile`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_admin_id_foreign` (`added_by`),
  ADD KEY `subcategory_id` (`owner_id`),
  ADD KEY `store_id` (`area_id`);

--
-- Indexes for table `product_bids`
--
ALTER TABLE `product_bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_coupon_package_id` (`product_id`),
  ADD KEY `user_coupon_coupon_id` (`user_id`);

--
-- Indexes for table `product_features`
--
ALTER TABLE `product_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_investments`
--
ALTER TABLE `product_investments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_coupon_coupon_id` (`user_id`);

--
-- Indexes for table `product_letters`
--
ALTER TABLE `product_letters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indexes for table `product_offers`
--
ALTER TABLE `product_offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_coupon_package_id` (`product_id`),
  ADD KEY `user_coupon_coupon_id` (`user_id`);

--
-- Indexes for table `product_verifications`
--
ALTER TABLE `product_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_answers_admin_id_foreign` (`user_id`),
  ADD KEY `user_coupon_package_id` (`product_id`),
  ADD KEY `via_user_id` (`via_user_id`);

--
-- Indexes for table `property_access_links`
--
ALTER TABLE `property_access_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `source_user_id` (`source_user_id`);

--
-- Indexes for table `property_invited_numbers`
--
ALTER TABLE `property_invited_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `source_user_id` (`receiver_id`);

--
-- Indexes for table `property_private_links`
--
ALTER TABLE `property_private_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `source_user_id` (`receiver_id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `referral_code` (`referral_code`),
  ADD KEY `question_answers_admin_id_foreign` (`user_id`);

--
-- Indexes for table `referral_logs`
--
ALTER TABLE `referral_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referred_user_id` (`referred_user_id`),
  ADD KEY `referrer_id` (`referrer_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `seo_tags`
--
ALTER TABLE `seo_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_group_index` (`group`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trackers`
--
ALTER TABLE `trackers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abouts_admin_id_foreign` (`user_id`),
  ADD KEY `zone_id` (`district_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_answers_admin_id_foreign` (`user_id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_answers_admin_id_foreign` (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `contact_replies`
--
ALTER TABLE `contact_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=516;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `product_bids`
--
ALTER TABLE `product_bids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_features`
--
ALTER TABLE `product_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_investments`
--
ALTER TABLE `product_investments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_letters`
--
ALTER TABLE `product_letters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `product_offers`
--
ALTER TABLE `product_offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_verifications`
--
ALTER TABLE `product_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `property_access_links`
--
ALTER TABLE `property_access_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `property_invited_numbers`
--
ALTER TABLE `property_invited_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_private_links`
--
ALTER TABLE `property_private_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `referral_logs`
--
ALTER TABLE `referral_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seo_tags`
--
ALTER TABLE `seo_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD CONSTRAINT `blog_comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
