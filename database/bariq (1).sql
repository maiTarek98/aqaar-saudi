-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2025 at 12:26 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bariq`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(2, 'order', 'created', 'App\\Models\\Order', 'created', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":17,\"order_no\":\"11111111111112\",\"assign_to\":null,\"user_id\":25}}', NULL, '2025-01-16 12:08:15', '2025-01-16 12:08:15'),
(3, 'order', 'created', 'App\\Models\\Order', 'created', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":18,\"order_no\":\"11111111111113\",\"assign_to\":null,\"user_id\":25}}', NULL, '2025-01-16 12:08:34', '2025-01-16 12:08:34'),
(4, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"assign_to\":2},\"old\":{\"assign_to\":null}}', NULL, '2025-01-20 08:24:28', '2025-01-20 08:24:28'),
(5, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', NULL, '2025-01-20 08:45:13', '2025-01-20 08:45:13'),
(6, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', NULL, '2025-01-20 08:45:21', '2025-01-20 08:45:21'),
(7, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', NULL, '2025-01-20 08:46:31', '2025-01-20 08:46:31'),
(8, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', NULL, '2025-01-20 08:46:40', '2025-01-20 08:46:40'),
(9, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', NULL, '2025-01-20 08:47:09', '2025-01-20 08:47:09'),
(10, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":\"completed\"},\"old\":{\"status\":\"accepted\"}}', NULL, '2025-01-20 09:24:18', '2025-01-20 09:24:18'),
(11, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":\"return\"},\"old\":{\"status\":\"completed\"}}', NULL, '2025-01-20 11:25:44', '2025-01-20 11:25:44'),
(12, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"notes\":\"dfghj\"},\"old\":{\"notes\":null}}', NULL, '2025-01-20 12:10:48', '2025-01-20 12:10:48'),
(13, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":\"accepted\",\"notes\":null},\"old\":{\"status\":\"return\",\"notes\":\"dfghj\"}}', NULL, '2025-01-20 14:28:09', '2025-01-20 14:28:09'),
(14, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"assign_to\":3},\"old\":{\"assign_to\":2}}', NULL, '2025-01-21 12:47:57', '2025-01-21 12:47:57'),
(15, 'default', 'A post was updated by subadmin: yasser ahmed', 'App\\Models\\Order', NULL, 7, 'App\\Models\\User', 3, '[]', NULL, '2025-01-21 12:47:58', '2025-01-21 12:47:58'),
(16, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 3, '{\"attributes\":{\"status\":\"shipped\"},\"old\":{\"status\":\"accepted\"}}', NULL, '2025-01-21 13:03:11', '2025-01-21 13:03:11'),
(18, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 3, '{\"attributes\":{\"status\":\"accepted\"},\"old\":{\"status\":\"shipped\"}}', NULL, '2025-01-21 13:27:36', '2025-01-21 13:27:36'),
(19, 'default', 'An order was updated by subadmin: yasser ahmed', 'App\\Models\\Order', NULL, 7, 'App\\Models\\User', 3, '[]', NULL, '2025-01-21 13:27:36', '2025-01-21 13:27:36'),
(20, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 3, '{\"attributes\":{\"status\":\"return\"},\"old\":{\"status\":\"accepted\"}}', NULL, '2025-01-21 13:37:37', '2025-01-21 13:37:37'),
(21, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 3, '{\"attributes\":{\"status\":\"accepted\"},\"old\":{\"status\":\"return\"}}', NULL, '2025-01-21 13:38:39', '2025-01-21 13:38:39'),
(22, 'order', 'updated', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 3, '{\"attributes\":{\"status\":\"completed\"},\"old\":{\"status\":\"accepted\"}}', NULL, '2025-01-21 13:40:06', '2025-01-21 13:40:06'),
(23, 'default', 'An order was updated by subadmin: yasser ahmed', 'App\\Models\\Order', NULL, 7, 'App\\Models\\User', 3, '{\"attributes\":{\"status\":\"accepted\",\"updated_at\":\"2025-01-21 15:42:55\"},\"old\":{\"status\":\"completed\",\"updated_at\":\"2025-01-21T13:40:05.000000Z\"},\"event\":\"updated\"}', NULL, '2025-01-21 13:42:55', '2025-01-21 13:42:55'),
(24, 'default', 'An order was updated by subadmin: yasser ahmed', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 3, '{\"attributes\":{\"status\":\"accepted\",\"updated_at\":\"2025-01-21 15:45:12\"},\"old\":{\"status\":\"shipped\",\"updated_at\":\"2025-01-21T13:44:16.000000Z\"},\"event\":\"updated\"}', NULL, '2025-01-21 13:45:13', '2025-01-21 13:45:13'),
(25, 'default', 'An order was updated by subadmin: yasser ahmed', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 3, '{\"attributes\":{\"status\":\"accepted\",\"updated_at\":\"2025-01-21 15:49:42\"},\"old\":{\"status\":\"return\",\"updated_at\":\"2025-01-21T13:47:56.000000Z\"}}', NULL, '2025-01-21 13:49:42', '2025-01-21 13:49:42'),
(26, 'default', 'An order was updated by subadmin: yasser ahmed', 'App\\Models\\Order', 'updated', 7, 'App\\Models\\User', 3, '{\"attributes\":{\"updated_at\":\"2025-01-21 15:52:40\",\"notes\":\"cvhjggggg\"},\"old\":{\"updated_at\":\"2025-01-21T13:49:42.000000Z\",\"notes\":null}}', NULL, '2025-01-21 13:52:40', '2025-01-21 13:52:40'),
(27, 'default', 'An order was updated by subadmin: admin', 'App\\Models\\Order', 'updated', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"assign_to\":\"3\",\"updated_at\":\"2025-01-22 21:04:22\"},\"old\":{\"assign_to\":null,\"updated_at\":\"2024-08-23T16:02:38.000000Z\"}}', NULL, '2025-01-22 19:04:23', '2025-01-22 19:04:23'),
(28, 'default', 'An order was updated by subadmin: admin', 'App\\Models\\Order', 'updated', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"updated_at\":\"2025-02-18 11:22:26\",\"notes\":\"bvcyxt\"},\"old\":{\"updated_at\":\"2025-01-22T19:04:22.000000Z\",\"notes\":null}}', NULL, '2025-02-18 09:22:27', '2025-02-18 09:22:27'),
(29, 'default', 'An order was updated by subadmin: admin', 'App\\Models\\Order', 'updated', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"updated_at\":\"2025-02-18 11:22:39\",\"notes\":null},\"old\":{\"updated_at\":\"2025-02-18T09:22:26.000000Z\",\"notes\":\"bvcyxt\"}}', NULL, '2025-02-18 09:22:39', '2025-02-18 09:22:39'),
(30, 'default', 'An order was updated by subadmin: admin', 'App\\Models\\Order', 'updated', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"status\":\"declined\",\"updated_at\":\"2025-02-18 11:22:55\"},\"old\":{\"status\":\"pending\",\"updated_at\":\"2025-02-18T09:22:39.000000Z\"}}', NULL, '2025-02-18 09:22:55', '2025-02-18 09:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `text_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci DEFAULT NULL
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
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_ar` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_en` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_tags_ar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_tags_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_ar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `in_home` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `added_by`, `name_ar`, `name_en`, `description_ar`, `description_en`, `content_ar`, `content_en`, `meta_tags_ar`, `meta_tags_en`, `meta_description_ar`, `meta_description_en`, `status`, `created_at`, `updated_at`, `in_home`, `views`) VALUES
(10, 1, 'Colette Moore', 'Jayme Snow', 'Deserunt nihil ullam', 'Veniam dolores quia', NULL, NULL, 'Est error quos vel', 'Non ea dolor necessi', 'Lorem sint accusamu', 'Laudantium nemo ad', 'show', '2025-01-24 21:23:05', '2025-02-09 09:35:18', 'no', 6),
(11, 1, 'Jescie Mcintyre', 'Zena Ingram', 'Doloribus dolorum re', 'Dolorem deleniti ea', 'dcfvghjkl;', NULL, NULL, NULL, NULL, NULL, 'show', '2025-01-24 21:25:25', '2025-02-09 08:05:12', 'yes', 8),
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
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `in_home` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول التصنيفات';

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `added_by`, `title_ar`, `title_en`, `parent_id`, `status`, `created_at`, `updated_at`, `order`, `in_home`) VALUES
(1, 1, 'ليورال', 'l\'oreal', NULL, 'show', '2025-01-22 18:00:15', '2025-02-06 19:47:47', NULL, 'yes'),
(2, 1, 'لاروش', 'laroche', NULL, 'show', '2025-01-22 18:00:35', '2025-02-06 19:48:36', NULL, 'yes'),
(3, 1, 'إيفا', 'Eva', NULL, 'show', '2025-01-25 20:59:15', '2025-02-06 19:47:59', NULL, 'yes'),
(7, 1, 'كابكسي', 'Capixy', NULL, 'show', '2025-02-19 11:01:55', '2025-02-19 11:19:59', NULL, 'yes'),
(8, 1, 'ماك', 'mac', NULL, 'show', '2025-02-19 11:20:41', '2025-02-19 11:20:41', NULL, 'yes'),
(9, 1, 'أماندا', 'Amanda', NULL, 'show', '2025-02-20 08:23:17', '2025-02-20 08:23:17', NULL, 'yes'),
(10, 1, 'سيفورا', 'sephora', NULL, 'show', '2025-02-20 09:14:22', '2025-02-20 09:14:22', NULL, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `capacities`
--

CREATE TABLE `capacities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول التصنيفات';

--
-- Dumping data for table `capacities`
--

INSERT INTO `capacities` (`id`, `admin_id`, `title_ar`, `title_en`, `created_at`, `updated_at`, `amount`, `order`) VALUES
(1, 1, 'مل', 'ml', '2024-04-13 17:45:30', '2024-04-13 17:53:41', '120,50', NULL),
(2, 1, 'جم', 'garam', '2024-04-13 17:45:30', '2024-04-22 10:36:55', '50,100,150,300,450,600,900,1000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `total_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `capacity` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `order_id`, `user_id`, `store_id`, `product_id`, `created_at`, `updated_at`, `price`, `qty`, `total_price`, `capacity`) VALUES
(4, 2, 25, 8, 7, '2024-08-02 18:18:45', '2024-08-02 18:18:45', '929.00', 1, '929.00', NULL),
(5, 2, 25, 8, 8, '2024-08-02 18:18:45', '2024-08-02 18:18:45', '929.00', 2, '1858.00', NULL),
(10, 3, 26, NULL, 21, '2024-08-16 21:32:03', '2024-08-16 21:44:28', '480.00', 1, '480.00', NULL),
(13, 5, 30, NULL, 11, '2024-08-17 15:53:58', '2024-08-17 15:53:58', '627.00', 1, '627.00', NULL),
(14, 6, NULL, NULL, 8, '2024-08-23 16:02:38', '2024-08-23 16:02:38', '900.00', 1, '900.00', NULL),
(15, 7, NULL, NULL, 8, '2024-08-23 16:03:27', '2024-08-23 16:03:27', '900.00', 1, '900.00', NULL),
(16, 8, NULL, NULL, 8, '2024-08-23 16:04:05', '2024-08-23 16:04:05', '900.00', 1, '900.00', NULL),
(18, 13, 26, 1, 8, '2024-08-23 23:32:45', '2024-08-23 23:32:45', '900.00', 1, '900.00', NULL),
(21, 13, 32, 1, 7, '2024-09-28 16:26:16', '2024-09-28 16:26:16', '480.00', 5, '2400.00', NULL),
(23, 18, 25, NULL, 7, '2025-01-16 12:08:34', '2025-01-16 12:08:34', '222.00', 1, '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('shop','consultation') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `in_home` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_viewed` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `mobile` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
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
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `offer_type` enum('fixed_amount','percentage','buy_x_get_y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'buy_x_get_y',
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('show','hide','approve','decline') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide' COMMENT 'اول حالة تبقي hide عشان لسه الاداارة موافقتش\r\nshow => قام التاجر بنشر الكوبون\r\nhide => قام التاجر بالاخفاء\r\napprove => تم الموافقة من قبل الادارة\r\ndecline => تم الرفض من الادارة'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `added_by`, `created_at`, `updated_at`, `offer_type`, `start_date`, `end_date`, `text`, `coupon_code`, `status`) VALUES
(17, 1, '2024-12-03 11:55:34', '2024-12-03 11:55:34', 'percentage', '2024-12-12 10:46:00', '2024-12-19 10:47:00', 'cfghjk', 'err44', 'show'),
(27, 1, '2024-12-03 14:32:43', '2024-12-03 14:32:43', 'buy_x_get_y', '2024-12-18 13:31:00', '2024-12-20 13:31:00', 'fgbhngbfvc', NULL, 'show'),
(28, 1, '2024-12-03 14:41:03', '2024-12-03 14:41:03', 'buy_x_get_y', '2024-12-04 13:40:00', '2024-12-18 13:40:00', 'fgrhftgkuh', NULL, 'show'),
(41, 1, '2025-01-25 13:09:50', '2025-01-25 13:09:50', 'percentage', '2025-01-29 13:06:00', '2025-02-08 13:06:00', 'sdfgbhk', NULL, 'show'),
(42, 32, '2025-01-25 13:46:04', '2025-01-25 13:46:04', 'fixed_amount', '2025-01-26 13:45:00', '2025-02-07 13:45:00', 'fghj', NULL, 'show'),
(44, 32, '2025-01-25 15:55:34', '2025-01-25 15:55:34', 'fixed_amount', '2025-01-27 15:54:00', '2025-02-08 15:54:00', 'fggvfd', 'FGh', 'show'),
(45, 32, '2025-01-25 20:22:18', '2025-01-25 20:34:47', 'percentage', '2025-01-28 20:22:00', '2025-02-07 20:22:00', 'xcvfbhn', NULL, 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_conditions`
--

CREATE TABLE `coupon_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buy_x` int(11) NOT NULL,
  `get_y` int(11) NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `min_purchase_value` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_conditions`
--

INSERT INTO `coupon_conditions` (`id`, `buy_x`, `get_y`, `coupon_id`, `min_purchase_value`, `created_at`, `updated_at`) VALUES
(7, 1, 1, 27, NULL, '2024-12-03 14:32:43', '2024-12-03 14:32:43'),
(8, 1, 1, 28, NULL, '2024-12-03 14:41:04', '2024-12-03 14:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_discounts`
--

CREATE TABLE `coupon_discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount_type` enum('fixed','percentage') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_value` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_discounts`
--

INSERT INTO `coupon_discounts` (`id`, `coupon_id`, `discount_type`, `discount_value`, `created_at`, `updated_at`, `category_id`, `brand_id`) VALUES
(16, 17, 'percentage', '11.00', '2024-12-03 11:55:34', '2024-12-03 11:55:34', NULL, NULL),
(25, 27, 'percentage', '11.00', '2024-12-03 14:32:43', '2024-12-03 14:32:43', NULL, NULL),
(26, 28, 'percentage', '11.00', '2024-12-03 14:41:04', '2024-12-03 14:41:04', NULL, NULL),
(38, 41, 'percentage', '22.00', '2025-01-25 13:09:50', '2025-01-25 13:09:50', 21, NULL),
(42, 45, 'percentage', '111.00', '2025-01-25 20:22:18', '2025-01-25 20:22:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_product`
--

CREATE TABLE `coupon_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `apply_for` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_product`
--

INSERT INTO `coupon_product` (`id`, `coupon_id`, `apply_for`, `product_id`, `created_at`, `updated_at`) VALUES
(29, 17, 'buy', 10, NULL, NULL),
(30, 17, 'buy', 12, NULL, NULL),
(54, 27, 'buy', 7, NULL, NULL),
(55, 27, 'buy', 9, NULL, NULL),
(56, 27, 'buy', 10, NULL, NULL),
(57, 27, 'get', 7, NULL, NULL),
(58, 27, 'get', 9, NULL, NULL),
(59, 28, 'buy', 9, NULL, NULL),
(60, 28, 'buy', 10, NULL, NULL),
(61, 28, 'get', 7, NULL, NULL),
(62, 28, 'get', 9, NULL, NULL),
(63, 28, 'get', 10, NULL, NULL),
(64, 45, 'buy', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_notifies`
--

CREATE TABLE `general_notifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- Table structure for table `invoice_templates`
--

CREATE TABLE `invoice_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `html_template` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `css_styles` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_templates`
--

INSERT INTO `invoice_templates` (`id`, `name`, `created_at`, `updated_at`, `html_template`, `css_styles`) VALUES
(1, 'first', NULL, '2025-01-16 12:46:30', 'dfgbhnjk,l.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `created_at`, `updated_at`, `description`) VALUES
(3, 'sdfgh', '2024-12-03 12:30:19', '2024-12-03 12:30:19', 'gbhnjkl');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('governorate','city','district') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول البرنات فالهوم';

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`, `type`, `parent_id`) VALUES
(1, 'الدقهلية', 'الدقهلية', '2025-02-25 12:23:31', '2025-02-25 12:44:31', 'governorate', NULL),
(2, 'المنصورة', 'المنصورة', '2025-02-25 12:23:57', '2025-02-25 12:23:57', 'city', 1),
(3, 'طلخا', 'طلخا', '2025-02-25 12:24:35', '2025-02-25 12:24:35', 'city', 1),
(4, 'ميت غمر', 'ميت غمر', '2025-02-25 12:24:49', '2025-02-25 12:24:49', 'city', 1),
(5, 'تلبانة', 'تلبانة', '2025-02-25 12:25:04', '2025-02-25 12:25:04', 'district', 2),
(6, 'دكرنس', 'دكرنس', '2025-02-25 12:25:37', '2025-02-25 12:25:37', 'city', 1),
(7, 'السنبلاوين', 'السنبلاوين', '2025-02-25 12:25:44', '2025-02-25 12:25:44', 'city', 1),
(8, 'القاهرة', 'القاهرة', '2025-02-25 12:27:16', '2025-02-25 12:27:16', 'governorate', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(392, 'App\\Models\\Blog', 12, '0771f88d-9b1f-44a2-b7b8-47a0a44f49fd', 'blogs_image', 'blogs_image-1738840173', 'blogs_image-1738840173.webp', 'image/webp', 'blogs', 'blogs', 12074, '[]', '[]', '[]', '[]', 23, '2025-02-06 11:09:34', '2025-02-06 11:09:34'),
(394, 'App\\Models\\Brand', 5, 'e8d338f6-5276-4e00-8a61-0208d83f23cd', 'brands_image', 'brands_image-1738843367', 'brands_image-1738843367.webp', 'image/webp', 'brands', 'brands', 57534, '[]', '[]', '[]', '[]', 24, '2025-02-06 12:02:48', '2025-02-06 12:02:48'),
(396, 'App\\Models\\Blog', 14, '13c728f4-99ee-4714-abd5-4201bd3a6d57', 'blogs_image', 'blogs_image-1738851565', 'blogs_image-1738851565.webp', 'image/webp', 'blogs', 'blogs', 72800, '[]', '[]', '[]', '[]', 25, '2025-02-06 14:19:26', '2025-02-06 14:19:26'),
(397, 'App\\Models\\Blog', 10, 'dc80ef90-8ea7-4264-8fbf-8ba23819c13b', 'blogs_image', 'blogs_image-1738855434', 'blogs_image-1738855434.webp', 'image/webp', 'blogs', 'blogs', 26388, '[]', '[]', '[]', '[]', 26, '2025-02-06 15:23:54', '2025-02-06 15:23:54'),
(398, 'App\\Models\\Blog', 11, '44e36ee2-e30b-481a-a0e7-2d237015e080', 'blogs_image', 'blogs_image-1738855436', 'blogs_image-1738855436.webp', 'image/webp', 'blogs', 'blogs', 12074, '[]', '[]', '[]', '[]', 27, '2025-02-06 15:23:56', '2025-02-06 15:23:56'),
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
(458, 'App\\Models\\User', 1, 'ee381641-1a1c-4dad-9643-b558b28e5aae', 'photo_profile', 'photo_profile-1741511304', 'photo_profile-1741511304.jpg', 'image/webp', 'users', 'users', 4388, '[]', '[]', '[]', '[]', 79, '2025-03-09 09:08:48', '2025-03-09 09:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('1a649797-eaa8-48f1-a654-acc3bb9d05fc', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Gisela Shaw\",\"redirect\":\"pending_vendors\\/10\",\"data\":[],\"created_at\":\"2025-01-24T20:16:59.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 20:17:00', '2025-01-24 20:22:28'),
('26f298b7-fe80-4cba-acf0-eea2382d5b6d', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Julian Davis\",\"redirect\":\"pending_vendors\\/6\",\"data\":[],\"created_at\":\"2025-01-24T20:03:59.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 20:03:59', '2025-01-24 20:22:28'),
('2a245e8d-8bc7-4431-a5e1-ab2200a62bfa', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   xcfvgbhnjk\",\"redirect\":\"contacts\\/#td-30\",\"data\":{\"id\":30,\"name\":\"xcfvgbhnjk\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-03T12:34:42.000000Z\"}', NULL, '2025-02-03 12:34:43', '2025-02-03 12:34:43'),
('45e0dfa7-1bba-4bbb-a52c-ffcfc4a03daf', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Imani Hubbard\",\"redirect\":\"pending_vendors\\/2\",\"data\":[],\"created_at\":\"2025-01-23T22:47:13.000000Z\"}', '2025-01-23 22:47:45', '2025-01-23 22:47:13', '2025-01-23 22:47:45'),
('510b9e3a-75f0-4f68-b0b2-6f5a0ffa9d52', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Abdullah\",\"redirect\":\"pending_vendors\\/13\",\"data\":[],\"created_at\":\"2025-02-06T12:36:18.000000Z\"}', '2025-02-06 12:36:41', '2025-02-06 12:36:18', '2025-02-06 12:36:41'),
('5918c690-34b6-43dc-a393-0491b1f11068', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   Abdullah Ashraf\",\"redirect\":\"contacts\\/#td-31\",\"data\":{\"id\":31,\"name\":\"Abdullah Ashraf\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-06T11:25:55.000000Z\"}', '2025-02-06 11:29:08', '2025-02-06 11:25:55', '2025-02-06 11:29:08'),
('5a97e480-64d6-4357-8e90-f9586e4595c0', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  mai tarek\",\"redirect\":\"pending_vendors\\/8\",\"data\":[],\"created_at\":\"2025-01-24T20:08:10.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 20:08:11', '2025-01-24 20:22:28'),
('79ac571d-2dac-4a9a-bed6-d4c9d1f1f827', 'App\\Notifications\\NotifyVendorStatusCoupon', 'App\\Models\\User', 70, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0643\\u0648\\u0628\\u0648\\u0646\\u0627\\u062a\",\"text\":\"\\u062a\\u0645 \\u062a\\u063a\\u064a\\u064a\\u0631 \\u062d\\u0627\\u0644\\u0629 \\u0627\\u0644\\u0643\\u0648\\u0628\\u0648\\u0646    xcvfbhn \\u0625\\u0644\\u064a main.coupons.approve\",\"redirect\":\"coupons\\/45\",\"data\":[],\"created_at\":\"2025-01-25T20:22:18.000000Z\"}', '2025-02-02 12:49:05', '2025-02-02 12:48:54', '2025-02-02 12:49:05'),
('7d6c4717-68fc-4263-94d4-660acbc2df9d', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   xcfvgbhnjk\",\"redirect\":\"contacts\\/#td-30\",\"data\":{\"id\":30,\"name\":\"xcfvgbhnjk\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-03T12:34:42.000000Z\"}', '2025-02-06 11:29:08', '2025-02-03 12:34:43', '2025-02-06 11:29:08'),
('7e3cd302-cefc-4fd0-834a-c7f5f132fb78', 'App\\Notifications\\NotifySubscriberNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   maitar2ekt3tt22@gmail.com\",\"redirect\":\"contacts\\/#td-5\",\"created_at\":\"2024-08-16T22:25:38.000000Z\",\"data\":{\"notification_type\":2,\"id\":5}}', '2025-01-23 22:47:46', '2024-08-16 22:25:38', '2025-01-23 22:47:46'),
('85f5ada3-99ba-4df6-9e59-aff1ba4ead82', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   Abdullah Ashraf\",\"redirect\":\"contacts\\/#td-32\",\"data\":{\"id\":32,\"name\":\"Abdullah Ashraf\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-06T12:40:38.000000Z\"}', '2025-02-06 12:40:46', '2025-02-06 12:40:38', '2025-02-06 12:40:46'),
('8a4d09be-659b-41be-928c-faba53ada3b5', 'App\\Notifications\\NotifySubscriberNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   jjudy@yahoo.com\",\"redirect\":\"contacts\\/#td-9\",\"created_at\":\"2024-08-22T20:44:04.000000Z\",\"data\":{\"notification_type\":2,\"id\":9}}', '2025-01-23 22:47:45', '2024-08-22 20:44:04', '2025-01-23 22:47:45'),
('998157e1-68e4-44c2-83ca-45e690498639', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   \\u0639\\u0644\\u0649\",\"redirect\":\"contacts\\/#td-33\",\"data\":{\"id\":33,\"name\":\"\\u0639\\u0644\\u0649\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-06T13:05:59.000000Z\"}', NULL, '2025-02-06 13:05:59', '2025-02-06 13:05:59'),
('9aecfc83-8d2b-4bbc-be7d-6bdad25ba3fa', 'App\\Notifications\\NotifySubscriberNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   d@yahoo.com\",\"redirect\":\"contacts\\/#td-10\",\"created_at\":\"2024-08-22T20:53:14.000000Z\",\"data\":{\"notification_type\":2,\"id\":10}}', '2025-01-23 22:47:45', '2024-08-22 20:53:14', '2025-01-23 22:47:45'),
('9af5d8c7-a788-466f-b86b-15f5e837b693', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Victoria Flores\",\"redirect\":\"pending_vendors\\/7\",\"data\":[],\"created_at\":\"2025-01-24T20:07:17.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 20:07:17', '2025-01-24 20:22:28'),
('9d0604db-17bc-4f76-b3ec-4aa6a6e013e3', 'App\\Notifications\\NotifyAdminNewVendorCoupon', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628hg;,f,khj\",\"text\":\"\\u0644\\u0642\\u062f \\u0623\\u0636\\u0627\\u0641 \\u0627\\u0644\\u062a\\u0627\\u062c\\u0631   mai tarek \\u0643\\u0648\\u0628\\u0648\\u0646 \\u062e\\u0635\\u0645 \\u062c\\u062f\\u064a\\u062f \\u0628\\u0627\\u0633\\u0645 fggvfd\",\"redirect\":\"coupons\\/44\",\"data\":[],\"created_at\":\"2025-01-25T15:55:34.000000Z\"}', '2025-01-25 15:55:44', '2025-01-25 15:55:38', '2025-01-25 15:55:44'),
('a359c251-ab9a-43e7-ab67-da0df3b083bf', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   Abdullah Ashraf\",\"redirect\":\"contacts\\/#td-31\",\"data\":{\"id\":31,\"name\":\"Abdullah Ashraf\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-06T11:25:55.000000Z\"}', NULL, '2025-02-06 11:25:55', '2025-02-06 11:25:55'),
('a726e8c5-dbd7-4724-af88-4e98ceb599cb', 'App\\Notifications\\NotifySubscriberNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   m@y.co\",\"redirect\":\"contacts\\/#td-7\",\"created_at\":\"2024-08-22T20:32:24.000000Z\",\"data\":{\"notification_type\":2,\"id\":7}}', '2025-01-23 22:47:46', '2024-08-22 20:32:24', '2025-01-23 22:47:46'),
('aaf6fc08-98b0-4e8e-9db8-6fc8f60a2fa6', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Hyatt Frye\",\"redirect\":\"pending_vendors\\/3\",\"data\":[],\"created_at\":\"2025-01-24T19:55:29.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 19:55:30', '2025-01-24 20:22:28'),
('b8829d55-56da-4fb7-9c19-770fc7a7f789', 'App\\Notifications\\NotifyVendorStatusCoupon', 'App\\Models\\User', 32, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0643\\u0648\\u0628\\u0648\\u0646\\u0627\\u062a\",\"text\":\"\\u062a\\u0645 \\u062a\\u063a\\u064a\\u064a\\u0631 \\u062d\\u0627\\u0644\\u0629 \\u0627\\u0644\\u0643\\u0648\\u0628\\u0648\\u0646    xcvfbhn \\u0625\\u0644\\u064a main.coupons.approve\",\"redirect\":\"coupons\\/45\",\"data\":[],\"created_at\":\"2025-01-25T20:22:18.000000Z\"}', '2025-01-25 20:42:22', '2025-01-25 20:42:14', '2025-01-25 20:42:22'),
('bce78963-b2a6-4d37-95f8-22de0bd197cb', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   \\u0639\\u0644\\u0649\",\"redirect\":\"contacts\\/#td-33\",\"data\":{\"id\":33,\"name\":\"\\u0639\\u0644\\u0649\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-06T13:05:59.000000Z\"}', '2025-02-06 15:43:55', '2025-02-06 13:05:59', '2025-02-06 13:07:18'),
('c007c6d8-1c1c-4b84-9ea6-95bb53f5459f', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Abdullah\",\"redirect\":\"pending_vendors\\/14\",\"data\":[],\"created_at\":\"2025-02-06T13:31:06.000000Z\"}', '2025-02-06 15:15:39', '2025-02-06 13:31:06', '2025-02-06 15:15:39'),
('c5a2eb08-efbf-4771-bade-0f9a41d5c748', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Akeem Pugh\",\"redirect\":\"pending_vendors\\/5\",\"data\":[],\"created_at\":\"2025-01-24T20:00:50.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 20:00:51', '2025-01-24 20:22:28'),
('d934d109-44f3-403f-9808-5132b4a9e769', 'App\\Notifications\\NotifySubscriberNotification', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   v@ya.com\",\"redirect\":\"contacts\\/#td-6\",\"created_at\":\"2024-08-22T20:29:06.000000Z\",\"data\":{\"notification_type\":2,\"id\":6}}', '2025-01-23 22:47:46', '2024-08-22 20:29:08', '2025-01-23 22:47:46'),
('e4fcf50f-691c-43bf-8689-e08e2181a35f', 'App\\Notifications\\NotifyContactUsNotification', 'App\\Models\\User', 2, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0648\\u062c\\u0648\\u062f \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"text\":\"\\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u0645\\u0646   Abdullah Ashraf\",\"redirect\":\"contacts\\/#td-32\",\"data\":{\"id\":32,\"name\":\"Abdullah Ashraf\",\"account_type\":\"admins\",\"notification_type\":8},\"created_at\":\"2025-02-06T12:40:38.000000Z\"}', NULL, '2025-02-06 12:40:38', '2025-02-06 12:40:38'),
('e68a6fb6-33b3-4af0-a93e-a9d9245cfd22', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Winter Holder\",\"redirect\":\"pending_vendors\\/11\",\"data\":[],\"created_at\":\"2025-02-03T13:08:23.000000Z\"}', '2025-02-06 11:29:08', '2025-02-03 13:08:29', '2025-02-06 11:29:08'),
('e8806b4c-8167-41d9-8569-cea63bb6eba1', 'App\\Notifications\\NotifyAdminNewVendorCoupon', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628hg;,f,khj\",\"text\":\"\\u0644\\u0642\\u062f \\u0623\\u0636\\u0627\\u0641 \\u0627\\u0644\\u062a\\u0627\\u062c\\u0631   mai tarek \\u0643\\u0648\\u0628\\u0648\\u0646 \\u062e\\u0635\\u0645 \\u062c\\u062f\\u064a\\u062f \\u0628\\u0627\\u0633\\u0645 xcvfbhn\",\"redirect\":\"coupons\\/45\",\"data\":[],\"created_at\":\"2025-01-25T20:22:18.000000Z\"}', '2025-02-06 11:29:08', '2025-01-25 20:22:23', '2025-02-06 11:29:08'),
('ebd68921-ed4f-444b-aba2-22e153de8b1a', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Mohammad Nielsen\",\"redirect\":\"pending_vendors\\/4\",\"data\":[],\"created_at\":\"2025-01-24T19:57:38.000000Z\"}', '2025-01-24 20:22:28', '2025-01-24 19:57:38', '2025-01-24 20:22:28'),
('f312896e-eec4-44a4-a3ec-425d622141f4', 'App\\Notifications\\NotifyAdminNewVendors', 'App\\Models\\User', 1, '{\"title\":\"\\u0644\\u062f\\u064a\\u0643 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u062c\\u062f\\u064a\\u062f \\u062e\\u0627\\u0635 \\u0628\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\",\"text\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0637\\u0644\\u0628 \\u0645\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u0627\\u0633\\u0645  Abdullah Elgazzar\",\"redirect\":\"pending_vendors\\/12\",\"data\":[],\"created_at\":\"2025-02-06T12:17:01.000000Z\"}', '2025-02-06 12:19:29', '2025-02-06 12:17:01', '2025-02-06 12:19:29');

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
  `status` enum('pending','accepted','shipped','completed','declined','return') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type` enum('online','cash','v_cash','instapay','bank_transfer') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_price` double(8,2) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
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
(16, NULL, NULL, 11111111111111, 1, 'completed', '2025-03-05 22:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, NULL, 25, 11111111111112, NULL, 'pending', '2025-01-16 12:08:14', '2025-01-16 12:08:14', NULL, NULL, NULL, '2025-01-15 22:00:00', NULL, NULL, '3erftgh'),
(18, NULL, 25, 11111111111113, NULL, 'pending', '2025-01-16 12:08:34', '2025-01-16 12:08:34', NULL, NULL, NULL, '2025-01-15 22:00:00', NULL, '2025-01-20 08:44:58', '3erftgh');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content_ar` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_en` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول التصنيفات';

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `admin_id`, `title_ar`, `title_en`, `status`, `created_at`, `updated_at`, `content_ar`, `content_en`, `link`) VALUES
(1, 1, 'سياسة الخصوصية', 'privacy policy', 'show', '2024-07-25 13:40:50', '2024-08-24 11:35:48', 'الاتةنسمو', 'hvshbmklc,', 'privacy-policy'),
(2, 1, 'سياسة الإرجاع', 'سياسة الإرجاع', 'show', '2024-08-17 13:14:27', '2024-09-07 18:26:17', 'سياسة الإرجاعسياسة الإرجاع', 'سياسة الإرجاع', 'return-policy'),
(3, 1, 'الشروط والأحكام', 'الشروط والأحكام', 'hide', '2024-08-17 13:14:54', '2025-01-22 09:09:34', 'الشروط والأحكامالشروط والأحكام', 'الشروط والأحكام', 'term-conditions');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `mobile` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`mobile`, `token`, `created_at`) VALUES
('1097979797', '1234', '2025-02-23 13:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `pending_vendors`
--

CREATE TABLE `pending_vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commercial_registration_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `connected_mobile` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `another_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vodafone_cash_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','accepted','declined') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pending_vendors`
--

INSERT INTO `pending_vendors` (`id`, `added_by`, `full_name`, `shipping_address`, `brand_name`, `bank_account_no`, `commercial_registration_no`, `connected_mobile`, `tax_no`, `mobile`, `another_mobile`, `vodafone_cash_mobile`, `status`, `created_at`, `updated_at`, `email`) VALUES
(1, NULL, 'dcfgbhk', 'Ducimus quae cum of', 'Autumn Mathis', '43555555442', '233455444', '6666666666', '222222222', '6666666666', '4444444566', '2345444444', 'accepted', '2025-01-23 22:45:56', '2025-01-24 19:42:49', 'caxuvugyz@mailinator.com'),
(2, NULL, 'Imani Hubbard', 'Ducimus quae cum of', 'Autumn Mathis', '43555555442', '233455444', '6666666666', '222222222', '6666666666', '4444444566', '2345444444', 'accepted', '2025-01-23 22:47:13', '2025-01-24 19:11:01', 'caxuvugyz@mailinator.com'),
(3, NULL, 'Hyatt Frye', 'Dolores exercitation', 'Raya Byrd', 'Reprehenderit dolore', '123234325678', '1929222822', '22929292929', '2828222828', '2838458858', '8475757577', 'accepted', '2025-01-24 19:55:29', '2025-02-18 11:26:26', 'teju@mailinator.com'),
(4, NULL, 'Mohammad Nielsen', 'Nam unde officia vol', 'Merritt Robinson', 'Voluptas rem sunt f', '29393939393', '1010100101', '192348849393', '2929299292', '2939456939', '1111283458', 'accepted', '2025-01-24 19:57:38', '2025-02-18 11:45:37', 'suda@mailinator.com'),
(5, NULL, 'Akeem Pugh', 'Laboris ratione in p', 'Lani Bishop', 'Do quibusdam molesti', '123133333333', '1919191991', '92934874747477', '1888282828', '8183845757', '8183845757', 'accepted', '2025-01-24 20:00:50', '2025-03-09 11:03:22', 'zybyxosoci@mailinator.com'),
(6, NULL, 'Julian Davis', 'Consequuntur ad sint', 'Hector Stein', 'Est exercitationem q', '123133333333', '2666666666', '2666666666', '2666666666', '2666666666', '2666666666', 'accepted', '2025-01-24 20:03:59', '2025-01-24 20:33:22', 'potuhoz@mailinator.com'),
(7, NULL, 'Victoria Flores', 'Non itaque consectet', 'Lewis Miranda', 'Quia quis pariatur', '123133333333', '2666666666', '2666666666', '2666666666', '2666666666', '2666666666', 'pending', '2025-01-24 20:07:17', '2025-01-24 20:07:17', 'lozupaf@mailinator.com'),
(8, NULL, 'mai tarek', '23 شارع فريد أبو الفتوح منشية المصطفي أمام مسجد الصلاح ... خلف كليه تربية نوعيه', 'Donna Fuller', 'Neque est qui proide', '123133333333', '1097987069', 'Quis sit et quia nis', '1097987069', '1097987069', '1097987069', 'accepted', '2025-01-24 20:08:10', '2025-02-18 11:38:05', 'maitarekttt@gmail.com'),
(9, NULL, 'Gisela Shaw', 'Ea magnam voluptas q', 'Darryl Diaz', 'Libero aut do evenie', '123133333333', '1111111181', '1111111181', '1111111181', '1111111181', '1111111181', 'pending', '2025-01-24 20:16:44', '2025-01-24 20:16:44', 'nypasi@mailinator.com'),
(10, NULL, 'Gisela Shaw', 'Ea magnam voluptas q', 'Darryl Diaz', 'Libero aut do evenie', '123133333333', '1111111181', '1111111181', '1111111181', '1111111181', '1111111181', 'accepted', '2025-01-24 20:16:59', '2025-02-17 12:21:38', 'nypasi@mailinator.com'),
(11, 1, 'Winter Holder2', 'Earum et irure sit', 'Amethyst Banks', '1111111113332', '12323456', '1232345678', '73', '1232345678', '1232345678', '1232345678', 'accepted', '2025-02-03 13:08:23', '2025-02-19 12:14:59', 'zujux@mailinator.com'),
(14, NULL, 'Abdullah', 'مصر', 'علامتنا', '685768768768', '8979468143', '0109398225', '1567843456', '0109398222', '1234567890', '0109398225', 'accepted', '2025-02-06 13:31:06', '2025-02-06 13:53:56', 'elgazzara912@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(50, 'gallery-create', 'admin', '2024-07-24 10:12:54', NULL, NULL),
(51, 'gallery-list', 'admin', NULL, NULL, NULL),
(52, 'gallery-edit', 'admin', NULL, NULL, NULL),
(54, 'gallery-delete', 'admin', NULL, NULL, NULL),
(85, 'home-list', 'admin', NULL, NULL, NULL),
(90, 'categorys-create', 'admin', NULL, NULL, NULL),
(91, 'categorys-list', 'admin', NULL, NULL, NULL),
(92, 'categorys-edit', 'admin', NULL, NULL, NULL),
(93, 'categorys-delete', 'admin', NULL, NULL, NULL),
(95, 'about-list', 'admin', NULL, NULL, NULL),
(96, 'about-edit', 'admin', NULL, NULL, NULL),
(98, 'coupons-create', 'admin', NULL, NULL, NULL),
(99, 'coupons-list', 'admin', NULL, NULL, NULL),
(100, 'coupons-edit', 'admin', NULL, NULL, NULL),
(101, 'coupons-delete', 'admin', NULL, NULL, NULL),
(106, 'banner-create', 'admin', NULL, NULL, NULL),
(107, 'banner-list', 'admin', NULL, NULL, NULL),
(108, 'banner-edit', 'admin', NULL, NULL, NULL),
(109, 'banner-delete', 'admin', NULL, NULL, NULL),
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
(155, 'brands-create', 'admin', NULL, NULL, NULL),
(156, 'brands-list', 'admin', NULL, NULL, NULL),
(157, 'brands-edit', 'admin', NULL, NULL, NULL),
(158, 'brands-delete', 'admin', NULL, NULL, NULL),
(159, 'pending_vendors-list', 'admin', NULL, NULL, NULL),
(160, 'pending_vendors-create', 'admin', NULL, NULL, NULL),
(161, 'pending_vendors-edit', 'admin', NULL, NULL, NULL),
(162, 'pending_vendors-delete', 'admin', NULL, NULL, NULL),
(163, 'stores-create', 'admin', NULL, NULL, NULL),
(164, 'stores-list', 'admin', NULL, NULL, NULL),
(165, 'stores-edit', 'admin', NULL, NULL, NULL),
(166, 'stores-delete', 'admin', NULL, NULL, NULL),
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
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` enum('on','off') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `description_ar` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subcategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_in_home` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_most_review` tinyint(1) DEFAULT NULL,
  `new_arrival` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `link_video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `we_choose_for_u` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('product','offer') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overview_ar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overview_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avg_rate` int(11) DEFAULT 0,
  `barcode` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` enum('pound','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `product_tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول المنتجات';

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `added_by`, `name_ar`, `name_en`, `stock`, `sku`, `discount`, `price`, `description_ar`, `description_en`, `category_id`, `subcategory_id`, `status`, `is_in_home`, `created_at`, `updated_at`, `is_most_review`, `new_arrival`, `publish_date`, `views`, `link_video`, `we_choose_for_u`, `type`, `overview_ar`, `overview_en`, `avg_rate`, `barcode`, `slug`, `discount_type`, `order`, `deleted_at`, `product_tags`, `brand_id`, `store_id`) VALUES
(7, 1, 'غسول لاروش', 'cleanser', 'on', 'gm-0002', '10.00', '1200.00', 'Id rerum anim repell', 'Dolore dolore volupt', 20, 22, 'show', 0, '2024-07-26 16:28:19', '2025-03-05 08:53:54', NULL, NULL, NULL, 11, NULL, NULL, NULL, 'غسول لاروش', 'غسول لاروش', 0, 'Sint lorem ut sit s', 'prodv-cd', 'percent', NULL, NULL, NULL, 2, 14),
(8, 1, 'زيت الروزماري', 'زيت الروزماري', 'on', 'Ratione sit nesciunt', '29.00', '929.00', 'نبذه كبيره عن زيت الروزماري', 'نبذه كبيره عن زيت الروزماري', 28, 22, 'show', NULL, '2024-07-26 16:29:23', '2025-02-20 08:54:20', NULL, 'yes', NULL, 23, NULL, 'yes', NULL, 'نبذه عن زيت الروزماري', 'نبذه عن زيت الروزماري', 0, 'Sint lorem ut sit s', 'Cube-adventure2-game', 'pound', NULL, NULL, NULL, 1, 8),
(9, 1, 'سيروم لاروش للبشرة', 'serum fo', 'on', 'gm-0001', '27.00', '1222.00', 'Nisi beatae ab omnis', 'Quae repellendus Fu', 78, 22, 'show', NULL, '2024-08-03 16:45:58', '2025-02-20 09:03:29', NULL, 'no', NULL, 1, 'https://youtu.be/wDchsz8nmbo?si=Onrecoubknzl66t3', NULL, NULL, 'سيروم لاروش للبشرة', 'سيروم لاروش للبشرة', 0, '19229292', 'Cube-adventure-game', 'pound', NULL, NULL, NULL, 2, 14),
(10, 1, 'زيت الأرجان للشعر', 'زيت الأرجان للشعر', 'on', 'In perferendis cumqu', '10.00', '737.00', 'زيت الأرجان للشعر', 'زيت الأرجان للشعر', 19, 19, 'show', NULL, '2024-08-03 16:55:08', '2025-02-20 08:59:59', NULL, 'yes', NULL, 1, NULL, 'no', NULL, 'زيت الأرجان للشعر', 'زيت الأرجان للشعر', 0, 'Consequat Assumenda', 'Different-floats-set', 'percent', NULL, NULL, NULL, 1, 8),
(11, 1, 'زيت شجرة الشاي', 'زيت شجرة الشاي', 'on', 'In perferendis cumqu', '10.00', '737.00', 'Ut voluptatem dolor', 'Sed consequat Dolor', 28, 19, 'show', NULL, '2024-08-03 16:56:14', '2025-02-20 08:57:39', NULL, 'yes', NULL, 2, NULL, 'no', NULL, 'نبذه صغيره عن زيت شجرة الشاي', 'نبذه صغيره عن زيت شجرة الشاي', 0, 'Consequat Assumenda', 'Float--water-ball', 'percent', 10, NULL, NULL, 1, 8),
(12, 1, 'لوشن للشعر', 'لوشن للشعر', 'on', 'gm-0003', '140.00', '673.00', 'Tempora et delectus', 'Nostrum proident se', 19, 19, 'show', NULL, '2024-08-03 16:57:38', '2025-02-20 09:06:48', NULL, 'yes', NULL, 0, NULL, 'no', NULL, 'لوشن للشعر', 'لوشن للشعر', 0, 'Ut reprehenderit ma', 'Sea-game-for-kids', 'pound', 7, NULL, NULL, 7, 14),
(13, 1, 'شامبو للشعر', 'شامبو للشعر', 'on', 'Fuga Et voluptas el', '10.00', '455.00', 'Tempora et delectus', 'Nostrum proident se', 19, 19, 'show', NULL, '2024-08-03 16:57:57', '2025-02-20 09:07:40', NULL, 'yes', NULL, 6, NULL, 'no', NULL, 'شامبو للشعر', 'شامبو للشعر', 0, 'Ut reprehenderit ma', 'lunch-box-girls', 'percent', 9, NULL, NULL, 7, 14),
(14, 1, 'Amanda liquid blusher', 'Amanda liquid blusher', 'off', 'gm-000134', '0.00', '673.00', 'Tempora et delectus', 'Nostrum proident se', 78, 19, 'show', NULL, '2024-08-03 16:58:14', '2025-02-20 09:08:39', NULL, 'yes', NULL, 2, NULL, 'yes', NULL, 'Amanda liquid blusher', 'Amanda liquid blusher', 0, 'Ut reprehenderit ma', 'Cube-adventure-kids', 'pound', 8, NULL, NULL, 9, 14),
(15, 1, 'شامبو إيفا', 'شامبو إيفا', 'on', 'gm-0005', '2.00', '150.00', 'Tempora et delectus', 'Nostrum proident se', 19, 19, 'show', NULL, '2024-08-03 16:58:27', '2025-02-20 09:11:15', NULL, NULL, NULL, 61, NULL, NULL, NULL, 'شامبو إيفا', 'شامبو إيفا', 0, 'Ut reprehenderit ma', 'mecano-car', 'percent', 6, NULL, NULL, 3, 14),
(16, 1, 'body cream', 'body cream', 'off', 'Fuga Et voluptas el', '0.00', '150.00', 'Tempora et delectus', 'Nostrum proident se', 21, 19, 'show', NULL, '2024-08-03 16:58:40', '2025-02-20 09:23:14', NULL, NULL, NULL, 0, NULL, NULL, NULL, 'body cream', 'body cream', 0, 'Ut reprehenderit ma', 'set-of-pens', 'pound', 5, NULL, NULL, 3, 14),
(19, 1, 'كريم للوجه', 'كريم للوجه', 'off', 'Fuga Et voluptas el', '340.00', '673.00', 'Tempora et delectus', 'Nostrum proident se', 78, NULL, 'show', NULL, '2024-08-03 16:59:07', '2025-02-20 09:25:38', NULL, NULL, NULL, 0, NULL, NULL, NULL, 'كريم للوجه', 'كريم للوجه', 0, 'Ut reprehenderit ma', 'Stephen-Joseph-Sip-And-Snack-Woodland-Water-Bottle', 'pound', 3, NULL, NULL, 3, 14),
(20, 1, 'النجوم السديمية 11587 دفتر ملاحظات صغير لبيتوليا', 'Nebulous Stars 11587 Petulia\'s Mini Notebook', 'on', 'Nulla eos atque vol', '278.00', '758.00', 'Modi odit qui velit', 'Voluptatem mollitia', 21, NULL, 'show', NULL, '2024-08-06 08:07:43', '2025-01-19 11:28:57', NULL, 'yes', NULL, 39, NULL, NULL, NULL, NULL, NULL, 0, 'Aspernatur enim expl', 'Nebulous-Stars-11587-Petulia\'s-Mini-Notebook', 'pound', NULL, '2025-01-19 11:28:57', NULL, NULL, NULL),
(21, 1, 'شنطة مدرسية للبنات', 'School bag for girls', 'on', 'Nulla eos atque vol', '278.00', '758.00', 'Modi odit qui velit', 'Voluptatem mollitia', 21, NULL, 'show', NULL, '2024-08-06 08:08:47', '2025-01-19 11:25:53', NULL, 'yes', NULL, 46, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/wDchsz8nmbo?si=S9vpsH2Ts0_taClr\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', NULL, NULL, NULL, NULL, 3, 'Aspernatur enim expl', 'School-bag-girls', 'pound', NULL, '2025-01-19 11:25:53', NULL, NULL, NULL),
(25, 1, 'جل الصبار للبشرة', 'جل الصبار للبشرة', 'off', 'Fuga Et voluptas el', '340.00', '673.00', 'Tempora et delectus', 'Nostrum proident se', 21, NULL, 'show', NULL, '2025-01-28 13:41:59', '2025-02-20 09:23:52', NULL, NULL, NULL, 0, NULL, NULL, NULL, 'جل الصبار للبشرة', 'جل الصبار للبشرة', 0, 'Ut reprehenderit ma', 'Stephen-Joseph-Sip-And-Snack-Woodland-Water-Bottle', 'pound', 2, NULL, NULL, 1, 11),
(26, 1, 'age perfect night cream', 'age perfect night cream', 'on', 'Fuga Et voluptas el', '15.00', '1273.00', 'Tempora et delectus', 'Nostrum proident se', 78, NULL, 'show', NULL, '2025-01-28 13:49:29', '2025-02-20 09:20:13', NULL, 'yes', NULL, 0, NULL, 'no', NULL, 'نبذه صغيره age perfect night cream', 'نبذه صغيره age perfect night cream', 0, 'Ut reprehenderit ma', 'Stephen-Joseph-Sip-And-Snack-Woodland-Water-Bottle', 'percent', 4, NULL, NULL, 1, 12),
(27, 1, 'makeup remover', 'makeup remover', 'on', 'Fuga Et voluptas el', '10.00', '673.00', 'Tempora et delectus', 'Nostrum proident se', 10, NULL, 'show', NULL, '2025-01-28 13:50:18', '2025-02-20 09:12:37', NULL, 'yes', NULL, 0, NULL, 'no', NULL, 'makeup remover', 'makeup remover', 0, 'Ut reprehenderit ma', 'Stephen-Joseph-Sip-And-Snack-Woodland-Water-Bottle', 'percent', 1, NULL, NULL, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `product_capacities`
--

CREATE TABLE `product_capacities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `capacity_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_capacities`
--

INSERT INTO `product_capacities` (`id`, `admin_id`, `created_at`, `updated_at`, `amount`, `price`, `capacity_id`, `product_id`) VALUES
(124, 1, '2024-05-20 12:42:46', '2024-05-20 12:42:46', '150.00', '1.00', 2, 7),
(125, 1, '2024-05-20 12:42:46', '2024-05-20 12:42:46', '300.00', '1.00', 2, 7),
(126, 1, '2024-05-20 12:42:46', '2024-05-20 12:42:46', '600.00', '1.00', 2, 7),
(127, 1, '2024-05-20 12:42:46', '2024-05-20 12:42:46', '900.00', '1.00', 2, 7),
(204, 1, '2024-05-20 17:29:21', '2024-05-20 17:29:21', '150.00', '1.00', 2, 117),
(205, 1, '2024-05-20 17:29:21', '2024-05-20 17:29:21', '300.00', '1.00', 2, 117),
(206, 1, '2024-05-20 17:29:21', '2024-05-20 17:29:21', '600.00', '1.00', 2, 117),
(207, 1, '2024-05-20 17:29:21', '2024-05-20 17:29:21', '900.00', '1.00', 2, 117),
(224, 1, '2024-05-21 08:57:32', '2024-05-21 08:57:32', '150.00', '1.00', 2, 120),
(225, 1, '2024-05-21 08:57:32', '2024-05-21 08:57:32', '300.00', '1.00', 2, 120),
(226, 1, '2024-05-21 08:57:32', '2024-05-21 08:57:32', '600.00', '1.00', 2, 120),
(227, 1, '2024-05-21 08:57:32', '2024-05-21 08:57:32', '900.00', '1.00', 2, 120),
(228, 1, '2024-05-21 09:00:29', '2024-05-21 09:00:29', '150.00', '1.00', 2, 116),
(229, 1, '2024-05-21 09:00:29', '2024-05-21 09:00:29', '300.00', '1.00', 2, 116),
(230, 1, '2024-05-21 09:00:29', '2024-05-21 09:00:29', '600.00', '1.00', 2, 116),
(231, 1, '2024-05-21 09:00:29', '2024-05-21 09:00:29', '900.00', '1.00', 2, 116),
(256, 1, '2024-05-21 10:37:33', '2024-05-21 10:37:33', '100.00', '1.00', 2, 128),
(257, 1, '2024-05-21 10:37:33', '2024-05-21 10:37:33', '150.00', '1.00', 2, 128),
(258, 1, '2024-05-21 10:37:33', '2024-05-21 10:37:33', '300.00', '1.00', 2, 128),
(259, 1, '2024-05-21 10:37:33', '2024-05-21 10:37:33', '600.00', '1.00', 2, 128),
(260, 1, '2024-05-21 10:37:33', '2024-05-21 10:37:33', '900.00', '1.00', 2, 128),
(373, 1, '2024-05-22 08:34:33', '2024-05-22 08:34:33', '150.00', '1.00', 2, 159),
(374, 1, '2024-05-22 08:34:33', '2024-05-22 08:34:33', '300.00', '1.00', 2, 159),
(375, 1, '2024-05-22 08:34:33', '2024-05-22 08:34:33', '600.00', '1.00', 2, 159),
(376, 1, '2024-05-22 08:34:33', '2024-05-22 08:34:33', '900.00', '1.00', 2, 159),
(381, 1, '2024-05-22 08:37:22', '2024-05-22 08:37:22', '150.00', '1.00', 2, 158),
(382, 1, '2024-05-22 08:37:22', '2024-05-22 08:37:22', '300.00', '1.00', 2, 158),
(383, 1, '2024-05-22 08:37:22', '2024-05-22 08:37:22', '600.00', '1.00', 2, 158),
(384, 1, '2024-05-22 08:37:22', '2024-05-22 08:37:22', '900.00', '1.00', 2, 158),
(393, 1, '2024-05-22 08:42:09', '2024-05-22 08:42:09', '150.00', '1.00', 2, 155),
(394, 1, '2024-05-22 08:42:09', '2024-05-22 08:42:09', '300.00', '1.00', 2, 155),
(395, 1, '2024-05-22 08:42:09', '2024-05-22 08:42:09', '600.00', '1.00', 2, 155),
(396, 1, '2024-05-22 08:42:09', '2024-05-22 08:42:09', '900.00', '1.00', 2, 155),
(409, 1, '2024-05-22 08:49:12', '2024-05-22 08:49:12', '150.00', '1.00', 2, 151),
(410, 1, '2024-05-22 08:49:12', '2024-05-22 08:49:12', '300.00', '1.00', 2, 151),
(411, 1, '2024-05-22 08:49:12', '2024-05-22 08:49:12', '600.00', '1.00', 2, 151),
(412, 1, '2024-05-22 08:49:12', '2024-05-22 08:49:12', '900.00', '1.00', 2, 151),
(449, 1, '2024-05-22 09:07:08', '2024-05-22 09:07:08', '150.00', '1.00', 2, 140),
(450, 1, '2024-05-22 09:07:08', '2024-05-22 09:07:08', '300.00', '1.00', 2, 140),
(451, 1, '2024-05-22 09:07:08', '2024-05-22 09:07:08', '600.00', '1.00', 2, 140),
(452, 1, '2024-05-22 09:07:08', '2024-05-22 09:07:08', '900.00', '1.00', 2, 140),
(805, 1, '2024-05-25 08:52:36', '2024-05-25 08:52:36', '150.00', '1.00', 2, 186),
(806, 1, '2024-05-25 08:52:36', '2024-05-25 08:52:36', '300.00', '1.00', 2, 186),
(807, 1, '2024-05-25 08:52:36', '2024-05-25 08:52:36', '600.00', '1.00', 2, 186),
(808, 1, '2024-05-25 08:52:36', '2024-05-25 08:52:36', '900.00', '1.00', 2, 186),
(913, 1, '2024-05-26 09:17:19', '2024-05-26 09:17:19', '150.00', '1.00', 2, 189),
(914, 1, '2024-05-26 09:17:19', '2024-05-26 09:17:19', '300.00', '1.00', 2, 189),
(915, 1, '2024-05-26 09:17:19', '2024-05-26 09:17:19', '600.00', '1.00', 2, 189),
(916, 1, '2024-05-26 09:17:19', '2024-05-26 09:17:19', '900.00', '1.00', 2, 189),
(1163, 1, '2024-06-27 18:22:05', '2024-06-27 18:22:05', '150.00', '1.00', 2, 203),
(1164, 1, '2024-06-27 18:22:05', '2024-06-27 18:22:05', '300.00', '1.00', 2, 203),
(1165, 1, '2024-06-27 18:22:05', '2024-06-27 18:22:05', '600.00', '1.00', 2, 203),
(1166, 1, '2024-06-27 18:22:05', '2024-06-27 18:22:05', '900.00', '1.00', 2, 203),
(1167, 1, '2024-06-27 18:24:27', '2024-06-27 18:24:27', '150.00', '1.00', 2, 202),
(1168, 1, '2024-06-27 18:24:27', '2024-06-27 18:24:27', '300.00', '1.00', 2, 202),
(1169, 1, '2024-06-27 18:24:27', '2024-06-27 18:24:27', '600.00', '1.00', 2, 202),
(1170, 1, '2024-06-27 18:24:27', '2024-06-27 18:24:27', '900.00', '1.00', 2, 202),
(1171, 1, '2024-06-27 18:24:58', '2024-06-27 18:24:58', '150.00', '1.00', 2, 201),
(1172, 1, '2024-06-27 18:24:58', '2024-06-27 18:24:58', '300.00', '1.00', 2, 201),
(1173, 1, '2024-06-27 18:24:58', '2024-06-27 18:24:58', '600.00', '1.00', 2, 201),
(1174, 1, '2024-06-27 18:24:58', '2024-06-27 18:24:58', '900.00', '1.00', 2, 201),
(1179, 1, '2024-06-27 18:26:38', '2024-06-27 18:26:38', '150.00', '1.00', 2, 200),
(1180, 1, '2024-06-27 18:26:38', '2024-06-27 18:26:38', '300.00', '1.00', 2, 200),
(1181, 1, '2024-06-27 18:26:38', '2024-06-27 18:26:38', '600.00', '1.00', 2, 200),
(1182, 1, '2024-06-27 18:26:38', '2024-06-27 18:26:38', '900.00', '1.00', 2, 200),
(1183, 1, '2024-06-27 18:27:08', '2024-06-27 18:27:08', '150.00', '1.00', 2, 199),
(1184, 1, '2024-06-27 18:27:08', '2024-06-27 18:27:08', '300.00', '1.00', 2, 199),
(1185, 1, '2024-06-27 18:27:08', '2024-06-27 18:27:08', '600.00', '1.00', 2, 199),
(1186, 1, '2024-06-27 18:27:08', '2024-06-27 18:27:08', '900.00', '1.00', 2, 199),
(1187, 1, '2024-06-27 18:27:47', '2024-06-27 18:27:47', '150.00', '1.00', 2, 198),
(1188, 1, '2024-06-27 18:27:47', '2024-06-27 18:27:47', '300.00', '1.00', 2, 198),
(1189, 1, '2024-06-27 18:27:47', '2024-06-27 18:27:47', '600.00', '1.00', 2, 198),
(1190, 1, '2024-06-27 18:27:47', '2024-06-27 18:27:47', '900.00', '1.00', 2, 198),
(1195, 1, '2024-06-27 18:29:07', '2024-06-27 18:29:07', '150.00', '1.00', 2, 196),
(1196, 1, '2024-06-27 18:29:07', '2024-06-27 18:29:07', '300.00', '1.00', 2, 196),
(1197, 1, '2024-06-27 18:29:07', '2024-06-27 18:29:07', '600.00', '1.00', 2, 196),
(1198, 1, '2024-06-27 18:29:07', '2024-06-27 18:29:07', '900.00', '1.00', 2, 196),
(1199, 1, '2024-06-27 18:29:31', '2024-06-27 18:29:31', '150.00', '1.00', 2, 197),
(1200, 1, '2024-06-27 18:29:31', '2024-06-27 18:29:31', '300.00', '1.00', 2, 197),
(1201, 1, '2024-06-27 18:29:31', '2024-06-27 18:29:31', '600.00', '1.00', 2, 197),
(1202, 1, '2024-06-27 18:29:31', '2024-06-27 18:29:31', '900.00', '1.00', 2, 197),
(1203, 1, '2024-06-27 18:29:57', '2024-06-27 18:29:57', '150.00', '1.00', 2, 195),
(1204, 1, '2024-06-27 18:29:57', '2024-06-27 18:29:57', '300.00', '1.00', 2, 195),
(1205, 1, '2024-06-27 18:29:57', '2024-06-27 18:29:57', '600.00', '1.00', 2, 195),
(1206, 1, '2024-06-27 18:29:57', '2024-06-27 18:29:57', '900.00', '1.00', 2, 195),
(1207, 1, '2024-06-27 18:30:36', '2024-06-27 18:30:36', '150.00', '1.00', 2, 194),
(1208, 1, '2024-06-27 18:30:36', '2024-06-27 18:30:36', '300.00', '1.00', 2, 194),
(1209, 1, '2024-06-27 18:30:36', '2024-06-27 18:30:36', '600.00', '1.00', 2, 194),
(1210, 1, '2024-06-27 18:30:36', '2024-06-27 18:30:36', '900.00', '1.00', 2, 194),
(1211, 1, '2024-06-27 18:31:03', '2024-06-27 18:31:03', '150.00', '1.00', 2, 193),
(1212, 1, '2024-06-27 18:31:03', '2024-06-27 18:31:03', '300.00', '1.00', 2, 193),
(1213, 1, '2024-06-27 18:31:03', '2024-06-27 18:31:03', '600.00', '1.00', 2, 193),
(1214, 1, '2024-06-27 18:31:03', '2024-06-27 18:31:03', '900.00', '1.00', 2, 193),
(1215, 1, '2024-06-27 18:31:38', '2024-06-27 18:31:38', '150.00', '1.00', 2, 191),
(1216, 1, '2024-06-27 18:31:38', '2024-06-27 18:31:38', '300.00', '1.00', 2, 191),
(1217, 1, '2024-06-27 18:31:38', '2024-06-27 18:31:38', '600.00', '1.00', 2, 191),
(1218, 1, '2024-06-27 18:31:38', '2024-06-27 18:31:38', '900.00', '1.00', 2, 191),
(1219, 1, '2024-06-27 18:32:10', '2024-06-27 18:32:10', '150.00', '1.00', 2, 190),
(1220, 1, '2024-06-27 18:32:10', '2024-06-27 18:32:10', '300.00', '1.00', 2, 190),
(1221, 1, '2024-06-27 18:32:10', '2024-06-27 18:32:10', '600.00', '1.00', 2, 190),
(1222, 1, '2024-06-27 18:32:10', '2024-06-27 18:32:10', '900.00', '1.00', 2, 190),
(1223, 1, '2024-06-27 18:32:54', '2024-06-27 18:32:54', '150.00', '1.00', 2, 188),
(1224, 1, '2024-06-27 18:32:54', '2024-06-27 18:32:54', '300.00', '1.00', 2, 188),
(1225, 1, '2024-06-27 18:32:54', '2024-06-27 18:32:54', '600.00', '1.00', 2, 188),
(1226, 1, '2024-06-27 18:32:54', '2024-06-27 18:32:54', '900.00', '1.00', 2, 188),
(1227, 1, '2024-06-27 18:33:25', '2024-06-27 18:33:25', '150.00', '1.00', 2, 187),
(1228, 1, '2024-06-27 18:33:25', '2024-06-27 18:33:25', '300.00', '1.00', 2, 187),
(1229, 1, '2024-06-27 18:33:25', '2024-06-27 18:33:25', '600.00', '1.00', 2, 187),
(1230, 1, '2024-06-27 18:33:25', '2024-06-27 18:33:25', '900.00', '1.00', 2, 187),
(1231, 1, '2024-06-27 18:33:50', '2024-06-27 18:33:50', '150.00', '1.00', 2, 184),
(1232, 1, '2024-06-27 18:33:50', '2024-06-27 18:33:50', '300.00', '1.00', 2, 184),
(1233, 1, '2024-06-27 18:33:50', '2024-06-27 18:33:50', '600.00', '1.00', 2, 184),
(1234, 1, '2024-06-27 18:33:50', '2024-06-27 18:33:50', '900.00', '1.00', 2, 184),
(1235, 1, '2024-06-27 18:34:16', '2024-06-27 18:34:16', '150.00', '1.00', 2, 183),
(1236, 1, '2024-06-27 18:34:16', '2024-06-27 18:34:16', '300.00', '1.00', 2, 183),
(1237, 1, '2024-06-27 18:34:16', '2024-06-27 18:34:16', '600.00', '1.00', 2, 183),
(1238, 1, '2024-06-27 18:34:16', '2024-06-27 18:34:16', '900.00', '1.00', 2, 183),
(1239, 1, '2024-06-27 18:34:46', '2024-06-27 18:34:46', '150.00', '1.00', 2, 181),
(1240, 1, '2024-06-27 18:34:46', '2024-06-27 18:34:46', '300.00', '1.00', 2, 181),
(1241, 1, '2024-06-27 18:34:46', '2024-06-27 18:34:46', '600.00', '1.00', 2, 181),
(1242, 1, '2024-06-27 18:34:46', '2024-06-27 18:34:46', '900.00', '1.00', 2, 181),
(1243, 1, '2024-06-27 18:35:08', '2024-06-27 18:35:08', '150.00', '1.00', 2, 180),
(1244, 1, '2024-06-27 18:35:08', '2024-06-27 18:35:08', '300.00', '1.00', 2, 180),
(1245, 1, '2024-06-27 18:35:08', '2024-06-27 18:35:08', '600.00', '1.00', 2, 180),
(1246, 1, '2024-06-27 18:35:08', '2024-06-27 18:35:08', '900.00', '1.00', 2, 180),
(1251, 1, '2024-06-27 18:35:56', '2024-06-27 18:35:56', '150.00', '1.00', 2, 178),
(1252, 1, '2024-06-27 18:35:56', '2024-06-27 18:35:56', '300.00', '1.00', 2, 178),
(1253, 1, '2024-06-27 18:35:56', '2024-06-27 18:35:56', '600.00', '1.00', 2, 178),
(1254, 1, '2024-06-27 18:35:56', '2024-06-27 18:35:56', '900.00', '1.00', 2, 178),
(1255, 1, '2024-06-27 18:36:20', '2024-06-27 18:36:20', '150.00', '1.00', 2, 177),
(1256, 1, '2024-06-27 18:36:20', '2024-06-27 18:36:20', '300.00', '1.00', 2, 177),
(1257, 1, '2024-06-27 18:36:20', '2024-06-27 18:36:20', '600.00', '1.00', 2, 177),
(1258, 1, '2024-06-27 18:36:20', '2024-06-27 18:36:20', '900.00', '1.00', 2, 177),
(1259, 1, '2024-06-27 18:37:19', '2024-06-27 18:37:19', '150.00', '1.00', 2, 176),
(1260, 1, '2024-06-27 18:37:19', '2024-06-27 18:37:19', '300.00', '1.00', 2, 176),
(1261, 1, '2024-06-27 18:37:19', '2024-06-27 18:37:19', '600.00', '1.00', 2, 176),
(1262, 1, '2024-06-27 18:37:19', '2024-06-27 18:37:19', '900.00', '1.00', 2, 176),
(1263, 1, '2024-06-27 18:37:45', '2024-06-27 18:37:45', '150.00', '1.00', 2, 175),
(1264, 1, '2024-06-27 18:37:45', '2024-06-27 18:37:45', '300.00', '1.00', 2, 175),
(1265, 1, '2024-06-27 18:37:45', '2024-06-27 18:37:45', '600.00', '1.00', 2, 175),
(1266, 1, '2024-06-27 18:37:45', '2024-06-27 18:37:45', '900.00', '1.00', 2, 175),
(1267, 1, '2024-06-27 18:38:09', '2024-06-27 18:38:09', '150.00', '1.00', 2, 174),
(1268, 1, '2024-06-27 18:38:09', '2024-06-27 18:38:09', '300.00', '1.00', 2, 174),
(1269, 1, '2024-06-27 18:38:09', '2024-06-27 18:38:09', '600.00', '1.00', 2, 174),
(1270, 1, '2024-06-27 18:38:09', '2024-06-27 18:38:09', '900.00', '1.00', 2, 174),
(1271, 1, '2024-06-27 18:38:31', '2024-06-27 18:38:31', '150.00', '1.00', 2, 173),
(1272, 1, '2024-06-27 18:38:31', '2024-06-27 18:38:31', '300.00', '1.00', 2, 173),
(1273, 1, '2024-06-27 18:38:31', '2024-06-27 18:38:31', '600.00', '1.00', 2, 173),
(1274, 1, '2024-06-27 18:38:31', '2024-06-27 18:38:31', '900.00', '1.00', 2, 173),
(1275, 1, '2024-06-27 18:38:55', '2024-06-27 18:38:55', '150.00', '1.00', 2, 172),
(1276, 1, '2024-06-27 18:38:55', '2024-06-27 18:38:55', '300.00', '1.00', 2, 172),
(1277, 1, '2024-06-27 18:38:55', '2024-06-27 18:38:55', '600.00', '1.00', 2, 172),
(1278, 1, '2024-06-27 18:38:55', '2024-06-27 18:38:55', '900.00', '1.00', 2, 172),
(1279, 1, '2024-06-27 18:39:21', '2024-06-27 18:39:21', '150.00', '1.00', 2, 171),
(1280, 1, '2024-06-27 18:39:21', '2024-06-27 18:39:21', '300.00', '1.00', 2, 171),
(1281, 1, '2024-06-27 18:39:21', '2024-06-27 18:39:21', '600.00', '1.00', 2, 171),
(1282, 1, '2024-06-27 18:39:21', '2024-06-27 18:39:21', '900.00', '1.00', 2, 171),
(1283, 1, '2024-06-27 18:39:50', '2024-06-27 18:39:50', '150.00', '1.00', 2, 170),
(1284, 1, '2024-06-27 18:39:50', '2024-06-27 18:39:50', '300.00', '1.00', 2, 170),
(1285, 1, '2024-06-27 18:39:50', '2024-06-27 18:39:50', '600.00', '1.00', 2, 170),
(1286, 1, '2024-06-27 18:39:50', '2024-06-27 18:39:50', '900.00', '1.00', 2, 170),
(1287, 1, '2024-06-27 18:40:15', '2024-06-27 18:40:15', '150.00', '1.00', 2, 169),
(1288, 1, '2024-06-27 18:40:15', '2024-06-27 18:40:15', '300.00', '1.00', 2, 169),
(1289, 1, '2024-06-27 18:40:15', '2024-06-27 18:40:15', '600.00', '1.00', 2, 169),
(1290, 1, '2024-06-27 18:40:15', '2024-06-27 18:40:15', '900.00', '1.00', 2, 169),
(1291, 1, '2024-06-27 18:40:45', '2024-06-27 18:40:45', '150.00', '1.00', 2, 168),
(1292, 1, '2024-06-27 18:40:45', '2024-06-27 18:40:45', '300.00', '1.00', 2, 168),
(1293, 1, '2024-06-27 18:40:45', '2024-06-27 18:40:45', '600.00', '1.00', 2, 168),
(1294, 1, '2024-06-27 18:40:45', '2024-06-27 18:40:45', '900.00', '1.00', 2, 168),
(1295, 1, '2024-06-27 18:41:21', '2024-06-27 18:41:21', '150.00', '1.00', 2, 167),
(1296, 1, '2024-06-27 18:41:21', '2024-06-27 18:41:21', '300.00', '1.00', 2, 167),
(1297, 1, '2024-06-27 18:41:21', '2024-06-27 18:41:21', '600.00', '1.00', 2, 167),
(1298, 1, '2024-06-27 18:41:21', '2024-06-27 18:41:21', '900.00', '1.00', 2, 167),
(1299, 1, '2024-06-27 18:41:46', '2024-06-27 18:41:46', '150.00', '1.00', 2, 166),
(1300, 1, '2024-06-27 18:41:46', '2024-06-27 18:41:46', '300.00', '1.00', 2, 166),
(1301, 1, '2024-06-27 18:41:46', '2024-06-27 18:41:46', '600.00', '1.00', 2, 166),
(1302, 1, '2024-06-27 18:41:46', '2024-06-27 18:41:46', '900.00', '1.00', 2, 166),
(1303, 1, '2024-06-27 18:42:17', '2024-06-27 18:42:17', '150.00', '1.00', 2, 165),
(1304, 1, '2024-06-27 18:42:17', '2024-06-27 18:42:17', '300.00', '1.00', 2, 165),
(1305, 1, '2024-06-27 18:42:17', '2024-06-27 18:42:17', '600.00', '1.00', 2, 165),
(1306, 1, '2024-06-27 18:42:17', '2024-06-27 18:42:17', '900.00', '1.00', 2, 165),
(1307, 1, '2024-06-27 18:42:50', '2024-06-27 18:42:50', '150.00', '1.00', 2, 164),
(1308, 1, '2024-06-27 18:42:50', '2024-06-27 18:42:50', '300.00', '1.00', 2, 164),
(1309, 1, '2024-06-27 18:42:50', '2024-06-27 18:42:50', '600.00', '1.00', 2, 164),
(1310, 1, '2024-06-27 18:42:50', '2024-06-27 18:42:50', '900.00', '1.00', 2, 164),
(1311, 1, '2024-06-27 18:43:24', '2024-06-27 18:43:24', '150.00', '1.00', 2, 163),
(1312, 1, '2024-06-27 18:43:24', '2024-06-27 18:43:24', '300.00', '1.00', 2, 163),
(1313, 1, '2024-06-27 18:43:24', '2024-06-27 18:43:24', '600.00', '1.00', 2, 163),
(1314, 1, '2024-06-27 18:43:24', '2024-06-27 18:43:24', '900.00', '1.00', 2, 163),
(1315, 1, '2024-06-27 18:43:51', '2024-06-27 18:43:51', '150.00', '1.00', 2, 162),
(1316, 1, '2024-06-27 18:43:51', '2024-06-27 18:43:51', '300.00', '1.00', 2, 162),
(1317, 1, '2024-06-27 18:43:51', '2024-06-27 18:43:51', '600.00', '1.00', 2, 162),
(1318, 1, '2024-06-27 18:43:51', '2024-06-27 18:43:51', '900.00', '1.00', 2, 162),
(1323, 1, '2024-06-27 18:44:51', '2024-06-27 18:44:51', '150.00', '1.00', 2, 161),
(1324, 1, '2024-06-27 18:44:51', '2024-06-27 18:44:51', '300.00', '1.00', 2, 161),
(1325, 1, '2024-06-27 18:44:51', '2024-06-27 18:44:51', '600.00', '1.00', 2, 161),
(1326, 1, '2024-06-27 18:44:51', '2024-06-27 18:44:51', '900.00', '1.00', 2, 161),
(1327, 1, '2024-06-27 18:45:22', '2024-06-27 18:45:22', '150.00', '1.00', 2, 157),
(1328, 1, '2024-06-27 18:45:22', '2024-06-27 18:45:22', '300.00', '1.00', 2, 157),
(1329, 1, '2024-06-27 18:45:22', '2024-06-27 18:45:22', '600.00', '1.00', 2, 157),
(1330, 1, '2024-06-27 18:45:22', '2024-06-27 18:45:22', '900.00', '1.00', 2, 157),
(1331, 1, '2024-06-27 18:45:57', '2024-06-27 18:45:57', '150.00', '1.00', 2, 160),
(1332, 1, '2024-06-27 18:45:57', '2024-06-27 18:45:57', '300.00', '1.00', 2, 160),
(1333, 1, '2024-06-27 18:45:57', '2024-06-27 18:45:57', '600.00', '1.00', 2, 160),
(1334, 1, '2024-06-27 18:45:57', '2024-06-27 18:45:57', '900.00', '1.00', 2, 160),
(1335, 1, '2024-06-27 18:46:27', '2024-06-27 18:46:27', '150.00', '1.00', 2, 156),
(1336, 1, '2024-06-27 18:46:27', '2024-06-27 18:46:27', '300.00', '1.00', 2, 156),
(1337, 1, '2024-06-27 18:46:27', '2024-06-27 18:46:27', '600.00', '1.00', 2, 156),
(1338, 1, '2024-06-27 18:46:27', '2024-06-27 18:46:27', '900.00', '1.00', 2, 156),
(1339, 1, '2024-06-27 18:46:59', '2024-06-27 18:46:59', '150.00', '1.00', 2, 154),
(1340, 1, '2024-06-27 18:46:59', '2024-06-27 18:46:59', '300.00', '1.00', 2, 154),
(1341, 1, '2024-06-27 18:46:59', '2024-06-27 18:46:59', '600.00', '1.00', 2, 154),
(1342, 1, '2024-06-27 18:46:59', '2024-06-27 18:46:59', '900.00', '1.00', 2, 154),
(1343, 1, '2024-06-27 18:47:24', '2024-06-27 18:47:24', '150.00', '1.00', 2, 153),
(1344, 1, '2024-06-27 18:47:24', '2024-06-27 18:47:24', '300.00', '1.00', 2, 153),
(1345, 1, '2024-06-27 18:47:24', '2024-06-27 18:47:24', '600.00', '1.00', 2, 153),
(1346, 1, '2024-06-27 18:47:24', '2024-06-27 18:47:24', '900.00', '1.00', 2, 153),
(1347, 1, '2024-06-27 18:47:55', '2024-06-27 18:47:55', '150.00', '1.00', 2, 152),
(1348, 1, '2024-06-27 18:47:55', '2024-06-27 18:47:55', '300.00', '1.00', 2, 152),
(1349, 1, '2024-06-27 18:47:55', '2024-06-27 18:47:55', '600.00', '1.00', 2, 152),
(1350, 1, '2024-06-27 18:47:55', '2024-06-27 18:47:55', '900.00', '1.00', 2, 152),
(1351, 1, '2024-06-27 18:48:21', '2024-06-27 18:48:21', '150.00', '1.00', 2, 150),
(1352, 1, '2024-06-27 18:48:21', '2024-06-27 18:48:21', '300.00', '1.00', 2, 150),
(1353, 1, '2024-06-27 18:48:21', '2024-06-27 18:48:21', '600.00', '1.00', 2, 150),
(1354, 1, '2024-06-27 18:48:21', '2024-06-27 18:48:21', '900.00', '1.00', 2, 150),
(1355, 1, '2024-06-27 18:49:29', '2024-06-27 18:49:29', '150.00', '1.00', 2, 149),
(1356, 1, '2024-06-27 18:49:29', '2024-06-27 18:49:29', '300.00', '1.00', 2, 149),
(1357, 1, '2024-06-27 18:49:29', '2024-06-27 18:49:29', '600.00', '1.00', 2, 149),
(1358, 1, '2024-06-27 18:49:29', '2024-06-27 18:49:29', '900.00', '1.00', 2, 149),
(1363, 1, '2024-06-27 18:52:25', '2024-06-27 18:52:25', '150.00', '1.00', 2, 147),
(1364, 1, '2024-06-27 18:52:25', '2024-06-27 18:52:25', '300.00', '1.00', 2, 147),
(1365, 1, '2024-06-27 18:52:25', '2024-06-27 18:52:25', '600.00', '1.00', 2, 147),
(1366, 1, '2024-06-27 18:52:25', '2024-06-27 18:52:25', '900.00', '1.00', 2, 147),
(1367, 1, '2024-06-27 18:52:49', '2024-06-27 18:52:49', '150.00', '1.00', 2, 146),
(1368, 1, '2024-06-27 18:52:49', '2024-06-27 18:52:49', '300.00', '1.00', 2, 146),
(1369, 1, '2024-06-27 18:52:49', '2024-06-27 18:52:49', '600.00', '1.00', 2, 146),
(1370, 1, '2024-06-27 18:52:49', '2024-06-27 18:52:49', '900.00', '1.00', 2, 146),
(1371, 1, '2024-06-27 18:53:13', '2024-06-27 18:53:13', '150.00', '1.00', 2, 145),
(1372, 1, '2024-06-27 18:53:13', '2024-06-27 18:53:13', '300.00', '1.00', 2, 145),
(1373, 1, '2024-06-27 18:53:13', '2024-06-27 18:53:13', '600.00', '1.00', 2, 145),
(1374, 1, '2024-06-27 18:53:13', '2024-06-27 18:53:13', '900.00', '1.00', 2, 145),
(1375, 1, '2024-06-27 18:53:30', '2024-06-27 18:53:30', '150.00', '1.00', 2, 144),
(1376, 1, '2024-06-27 18:53:30', '2024-06-27 18:53:30', '300.00', '1.00', 2, 144),
(1377, 1, '2024-06-27 18:53:30', '2024-06-27 18:53:30', '600.00', '1.00', 2, 144),
(1378, 1, '2024-06-27 18:53:30', '2024-06-27 18:53:30', '900.00', '1.00', 2, 144),
(1379, 1, '2024-06-27 18:53:57', '2024-06-27 18:53:57', '150.00', '1.00', 2, 142),
(1380, 1, '2024-06-27 18:53:57', '2024-06-27 18:53:57', '300.00', '1.00', 2, 142),
(1381, 1, '2024-06-27 18:53:57', '2024-06-27 18:53:57', '600.00', '1.00', 2, 142),
(1382, 1, '2024-06-27 18:53:57', '2024-06-27 18:53:57', '900.00', '1.00', 2, 142),
(1383, 1, '2024-06-27 18:54:25', '2024-06-27 18:54:25', '50.00', '1.00', 2, 141),
(1384, 1, '2024-06-27 18:54:25', '2024-06-27 18:54:25', '100.00', '1.00', 2, 141),
(1385, 1, '2024-06-27 18:54:25', '2024-06-27 18:54:25', '300.00', '1.00', 2, 141),
(1386, 1, '2024-06-27 18:54:25', '2024-06-27 18:54:25', '450.00', '1.00', 2, 141),
(1387, 1, '2024-06-27 18:55:11', '2024-06-27 18:55:11', '150.00', '1.00', 2, 139),
(1388, 1, '2024-06-27 18:55:11', '2024-06-27 18:55:11', '300.00', '1.00', 2, 139),
(1389, 1, '2024-06-27 18:55:11', '2024-06-27 18:55:11', '600.00', '1.00', 2, 139),
(1390, 1, '2024-06-27 18:55:11', '2024-06-27 18:55:11', '900.00', '1.00', 2, 139),
(1391, 1, '2024-06-27 18:56:04', '2024-06-27 18:56:04', '150.00', '1.00', 2, 138),
(1392, 1, '2024-06-27 18:56:04', '2024-06-27 18:56:04', '300.00', '1.00', 2, 138),
(1393, 1, '2024-06-27 18:56:04', '2024-06-27 18:56:04', '600.00', '1.00', 2, 138),
(1394, 1, '2024-06-27 18:56:04', '2024-06-27 18:56:04', '900.00', '1.00', 2, 138),
(1395, 1, '2024-06-27 18:56:31', '2024-06-27 18:56:31', '150.00', '1.00', 2, 137),
(1396, 1, '2024-06-27 18:56:31', '2024-06-27 18:56:31', '300.00', '1.00', 2, 137),
(1397, 1, '2024-06-27 18:56:31', '2024-06-27 18:56:31', '600.00', '1.00', 2, 137),
(1398, 1, '2024-06-27 18:56:31', '2024-06-27 18:56:31', '900.00', '1.00', 2, 137),
(1403, 1, '2024-06-27 18:57:28', '2024-06-27 18:57:28', '150.00', '1.00', 2, 136),
(1404, 1, '2024-06-27 18:57:28', '2024-06-27 18:57:28', '300.00', '1.00', 2, 136),
(1405, 1, '2024-06-27 18:57:28', '2024-06-27 18:57:28', '600.00', '1.00', 2, 136),
(1406, 1, '2024-06-27 18:57:28', '2024-06-27 18:57:28', '900.00', '1.00', 2, 136),
(1407, 1, '2024-06-27 18:58:29', '2024-06-27 18:58:29', '150.00', '1.00', 2, 135),
(1408, 1, '2024-06-27 18:58:29', '2024-06-27 18:58:29', '300.00', '1.00', 2, 135),
(1409, 1, '2024-06-27 18:58:29', '2024-06-27 18:58:29', '600.00', '1.00', 2, 135),
(1410, 1, '2024-06-27 18:58:29', '2024-06-27 18:58:29', '900.00', '1.00', 2, 135),
(1411, 1, '2024-06-27 19:00:10', '2024-06-27 19:00:10', '150.00', '1.00', 2, 133),
(1412, 1, '2024-06-27 19:00:10', '2024-06-27 19:00:10', '300.00', '1.00', 2, 133),
(1413, 1, '2024-06-27 19:00:10', '2024-06-27 19:00:10', '600.00', '1.00', 2, 133),
(1414, 1, '2024-06-27 19:00:10', '2024-06-27 19:00:10', '900.00', '1.00', 2, 133),
(1415, 1, '2024-06-27 19:00:34', '2024-06-27 19:00:34', '150.00', '1.00', 2, 132),
(1416, 1, '2024-06-27 19:00:34', '2024-06-27 19:00:34', '300.00', '1.00', 2, 132),
(1417, 1, '2024-06-27 19:00:34', '2024-06-27 19:00:34', '600.00', '1.00', 2, 132),
(1418, 1, '2024-06-27 19:00:34', '2024-06-27 19:00:34', '900.00', '1.00', 2, 132),
(1419, 1, '2024-06-27 19:01:03', '2024-06-27 19:01:03', '150.00', '1.00', 2, 131),
(1420, 1, '2024-06-27 19:01:03', '2024-06-27 19:01:03', '300.00', '1.00', 2, 131),
(1421, 1, '2024-06-27 19:01:03', '2024-06-27 19:01:03', '600.00', '1.00', 2, 131),
(1422, 1, '2024-06-27 19:01:03', '2024-06-27 19:01:03', '900.00', '1.00', 2, 131),
(1423, 1, '2024-06-27 19:01:42', '2024-06-27 19:01:42', '150.00', '1.00', 2, 129),
(1424, 1, '2024-06-27 19:01:42', '2024-06-27 19:01:42', '300.00', '1.00', 2, 129),
(1425, 1, '2024-06-27 19:01:42', '2024-06-27 19:01:42', '600.00', '1.00', 2, 129),
(1426, 1, '2024-06-27 19:01:42', '2024-06-27 19:01:42', '900.00', '1.00', 2, 129),
(1427, 1, '2024-06-27 19:02:08', '2024-06-27 19:02:08', '150.00', '1.00', 2, 127),
(1428, 1, '2024-06-27 19:02:08', '2024-06-27 19:02:08', '300.00', '1.00', 2, 127),
(1429, 1, '2024-06-27 19:02:08', '2024-06-27 19:02:08', '600.00', '1.00', 2, 127),
(1430, 1, '2024-06-27 19:02:08', '2024-06-27 19:02:08', '900.00', '1.00', 2, 127),
(1431, 1, '2024-06-27 19:02:31', '2024-06-27 19:02:31', '150.00', '1.00', 2, 126),
(1432, 1, '2024-06-27 19:02:31', '2024-06-27 19:02:31', '300.00', '1.00', 2, 126),
(1433, 1, '2024-06-27 19:02:31', '2024-06-27 19:02:31', '600.00', '1.00', 2, 126),
(1434, 1, '2024-06-27 19:02:31', '2024-06-27 19:02:31', '900.00', '1.00', 2, 126),
(1435, 1, '2024-06-27 19:03:04', '2024-06-27 19:03:04', '150.00', '1.00', 2, 125),
(1436, 1, '2024-06-27 19:03:04', '2024-06-27 19:03:04', '300.00', '1.00', 2, 125),
(1437, 1, '2024-06-27 19:03:04', '2024-06-27 19:03:04', '600.00', '1.00', 2, 125),
(1438, 1, '2024-06-27 19:03:04', '2024-06-27 19:03:04', '900.00', '1.00', 2, 125),
(1439, 1, '2024-06-27 19:19:26', '2024-06-27 19:19:26', '150.00', '1.00', 2, 124),
(1440, 1, '2024-06-27 19:19:26', '2024-06-27 19:19:26', '300.00', '1.00', 2, 124),
(1441, 1, '2024-06-27 19:19:26', '2024-06-27 19:19:26', '600.00', '1.00', 2, 124),
(1442, 1, '2024-06-27 19:19:26', '2024-06-27 19:19:26', '900.00', '1.00', 2, 124),
(1447, 1, '2024-06-27 19:20:35', '2024-06-27 19:20:35', '150.00', '1.00', 2, 123),
(1448, 1, '2024-06-27 19:20:35', '2024-06-27 19:20:35', '300.00', '1.00', 2, 123),
(1449, 1, '2024-06-27 19:20:35', '2024-06-27 19:20:35', '600.00', '1.00', 2, 123),
(1450, 1, '2024-06-27 19:20:35', '2024-06-27 19:20:35', '900.00', '1.00', 2, 123),
(1451, 1, '2024-06-27 19:20:59', '2024-06-27 19:20:59', '150.00', '1.00', 2, 122),
(1452, 1, '2024-06-27 19:20:59', '2024-06-27 19:20:59', '300.00', '1.00', 2, 122),
(1453, 1, '2024-06-27 19:20:59', '2024-06-27 19:20:59', '600.00', '1.00', 2, 122),
(1454, 1, '2024-06-27 19:20:59', '2024-06-27 19:20:59', '900.00', '1.00', 2, 122),
(1455, 1, '2024-06-27 19:22:18', '2024-06-27 19:22:18', '150.00', '1.00', 2, 121),
(1456, 1, '2024-06-27 19:22:18', '2024-06-27 19:22:18', '300.00', '1.00', 2, 121),
(1457, 1, '2024-06-27 19:22:18', '2024-06-27 19:22:18', '600.00', '1.00', 2, 121),
(1458, 1, '2024-06-27 19:22:18', '2024-06-27 19:22:18', '900.00', '1.00', 2, 121),
(1459, 1, '2024-06-27 19:22:49', '2024-06-27 19:22:49', '150.00', '1.00', 2, 119),
(1460, 1, '2024-06-27 19:22:49', '2024-06-27 19:22:49', '300.00', '1.00', 2, 119),
(1461, 1, '2024-06-27 19:22:49', '2024-06-27 19:22:49', '900.00', '1.00', 2, 119),
(1462, 1, '2024-06-27 19:23:22', '2024-06-27 19:23:22', '150.00', '1.00', 2, 118),
(1463, 1, '2024-06-27 19:23:22', '2024-06-27 19:23:22', '300.00', '1.00', 2, 118),
(1464, 1, '2024-06-27 19:23:22', '2024-06-27 19:23:22', '600.00', '1.00', 2, 118),
(1465, 1, '2024-06-27 19:23:22', '2024-06-27 19:23:22', '900.00', '1.00', 2, 118),
(1474, 1, '2024-06-27 19:24:47', '2024-06-27 19:24:47', '150.00', '1.00', 2, 112),
(1475, 1, '2024-06-27 19:24:47', '2024-06-27 19:24:47', '300.00', '1.00', 2, 112),
(1476, 1, '2024-06-27 19:24:47', '2024-06-27 19:24:47', '600.00', '1.00', 2, 112),
(1477, 1, '2024-06-27 19:24:47', '2024-06-27 19:24:47', '900.00', '1.00', 2, 112),
(1478, 1, '2024-06-27 19:25:41', '2024-06-27 19:25:41', '150.00', '1.00', 2, 111),
(1479, 1, '2024-06-27 19:25:41', '2024-06-27 19:25:41', '300.00', '1.00', 2, 111),
(1480, 1, '2024-06-27 19:25:41', '2024-06-27 19:25:41', '600.00', '1.00', 2, 111),
(1481, 1, '2024-06-27 19:25:41', '2024-06-27 19:25:41', '900.00', '1.00', 2, 111),
(1482, 1, '2024-06-27 19:26:05', '2024-06-27 19:26:05', '150.00', '1.00', 2, 110),
(1483, 1, '2024-06-27 19:26:05', '2024-06-27 19:26:05', '300.00', '1.00', 2, 110),
(1484, 1, '2024-06-27 19:26:05', '2024-06-27 19:26:05', '600.00', '1.00', 2, 110),
(1485, 1, '2024-06-27 19:26:05', '2024-06-27 19:26:05', '900.00', '1.00', 2, 110),
(1486, 1, '2024-06-27 19:26:28', '2024-06-27 19:26:28', '150.00', '1.00', 2, 109),
(1487, 1, '2024-06-27 19:26:28', '2024-06-27 19:26:28', '300.00', '1.00', 2, 109),
(1488, 1, '2024-06-27 19:26:28', '2024-06-27 19:26:28', '600.00', '1.00', 2, 109),
(1489, 1, '2024-06-27 19:26:28', '2024-06-27 19:26:28', '900.00', '1.00', 2, 109),
(1494, 1, '2024-06-27 19:27:41', '2024-06-27 19:27:41', '150.00', '1.00', 2, 107),
(1495, 1, '2024-06-27 19:27:41', '2024-06-27 19:27:41', '300.00', '1.00', 2, 107),
(1496, 1, '2024-06-27 19:27:41', '2024-06-27 19:27:41', '600.00', '1.00', 2, 107),
(1497, 1, '2024-06-27 19:27:41', '2024-06-27 19:27:41', '900.00', '1.00', 2, 107),
(1498, 1, '2024-06-27 19:28:02', '2024-06-27 19:28:02', '150.00', '1.00', 2, 106),
(1499, 1, '2024-06-27 19:28:02', '2024-06-27 19:28:02', '300.00', '1.00', 2, 106),
(1500, 1, '2024-06-27 19:28:02', '2024-06-27 19:28:02', '600.00', '1.00', 2, 106),
(1501, 1, '2024-06-27 19:28:02', '2024-06-27 19:28:02', '900.00', '1.00', 2, 106),
(1506, 1, '2024-06-27 19:28:55', '2024-06-27 19:28:55', '150.00', '1.00', 2, 105),
(1507, 1, '2024-06-27 19:28:55', '2024-06-27 19:28:55', '300.00', '1.00', 2, 105),
(1508, 1, '2024-06-27 19:28:55', '2024-06-27 19:28:55', '600.00', '1.00', 2, 105),
(1509, 1, '2024-06-27 19:28:55', '2024-06-27 19:28:55', '900.00', '1.00', 2, 105),
(1514, 1, '2024-06-27 19:30:02', '2024-06-27 19:30:02', '150.00', '1.00', 2, 104),
(1515, 1, '2024-06-27 19:30:02', '2024-06-27 19:30:02', '300.00', '1.00', 2, 104),
(1516, 1, '2024-06-27 19:30:02', '2024-06-27 19:30:02', '600.00', '1.00', 2, 104),
(1517, 1, '2024-06-27 19:30:02', '2024-06-27 19:30:02', '900.00', '1.00', 2, 104),
(1518, 1, '2024-06-27 19:30:27', '2024-06-27 19:30:27', '150.00', '1.00', 2, 103),
(1519, 1, '2024-06-27 19:30:27', '2024-06-27 19:30:27', '300.00', '1.00', 2, 103),
(1520, 1, '2024-06-27 19:30:27', '2024-06-27 19:30:27', '600.00', '1.00', 2, 103),
(1521, 1, '2024-06-27 19:30:27', '2024-06-27 19:30:27', '900.00', '1.00', 2, 103),
(1530, 1, '2024-06-27 19:51:17', '2024-06-27 19:51:17', '150.00', '1.00', 2, 102),
(1531, 1, '2024-06-27 19:51:17', '2024-06-27 19:51:17', '300.00', '1.00', 2, 102),
(1532, 1, '2024-06-27 19:51:17', '2024-06-27 19:51:17', '600.00', '1.00', 2, 102),
(1533, 1, '2024-06-27 19:51:17', '2024-06-27 19:51:17', '900.00', '1.00', 2, 102),
(1534, 1, '2024-06-27 19:52:05', '2024-06-27 19:52:05', '150.00', '1.00', 2, 101),
(1535, 1, '2024-06-27 19:52:05', '2024-06-27 19:52:05', '300.00', '1.00', 2, 101),
(1536, 1, '2024-06-27 19:52:05', '2024-06-27 19:52:05', '600.00', '1.00', 2, 101),
(1537, 1, '2024-06-27 19:52:05', '2024-06-27 19:52:05', '900.00', '1.00', 2, 101),
(1538, 1, '2024-06-27 19:52:43', '2024-06-27 19:52:43', '150.00', '1.00', 2, 100),
(1539, 1, '2024-06-27 19:52:43', '2024-06-27 19:52:43', '300.00', '1.00', 2, 100),
(1540, 1, '2024-06-27 19:52:43', '2024-06-27 19:52:43', '600.00', '1.00', 2, 100),
(1541, 1, '2024-06-27 19:52:43', '2024-06-27 19:52:43', '900.00', '1.00', 2, 100),
(1542, 1, '2024-06-27 19:53:09', '2024-06-27 19:53:09', '150.00', '1.00', 2, 99),
(1543, 1, '2024-06-27 19:53:09', '2024-06-27 19:53:09', '300.00', '1.00', 2, 99),
(1544, 1, '2024-06-27 19:53:09', '2024-06-27 19:53:09', '600.00', '1.00', 2, 99),
(1545, 1, '2024-06-27 19:53:09', '2024-06-27 19:53:09', '900.00', '1.00', 2, 99),
(1546, 1, '2024-06-27 19:54:03', '2024-06-27 19:54:03', '150.00', '1.00', 2, 98),
(1547, 1, '2024-06-27 19:54:03', '2024-06-27 19:54:03', '300.00', '1.00', 2, 98),
(1548, 1, '2024-06-27 19:54:03', '2024-06-27 19:54:03', '600.00', '1.00', 2, 98),
(1549, 1, '2024-06-27 19:54:03', '2024-06-27 19:54:03', '900.00', '1.00', 2, 98),
(1550, 1, '2024-06-27 19:54:30', '2024-06-27 19:54:30', '150.00', '1.00', 2, 93),
(1551, 1, '2024-06-27 19:54:30', '2024-06-27 19:54:30', '300.00', '1.00', 2, 93),
(1552, 1, '2024-06-27 19:54:30', '2024-06-27 19:54:30', '600.00', '1.00', 2, 93),
(1553, 1, '2024-06-27 19:54:30', '2024-06-27 19:54:30', '900.00', '1.00', 2, 93),
(1554, 1, '2024-06-27 20:13:33', '2024-06-27 20:13:33', '150.00', '1.00', 2, 4),
(1555, 1, '2024-06-27 20:13:33', '2024-06-27 20:13:33', '300.00', '1.00', 2, 4),
(1556, 1, '2024-06-27 20:13:33', '2024-06-27 20:13:33', '600.00', '1.00', 2, 4),
(1557, 1, '2024-06-27 20:13:33', '2024-06-27 20:13:33', '900.00', '1.00', 2, 4),
(1558, 1, '2024-06-30 12:46:24', '2024-06-30 12:46:24', '100.00', '1.00', 2, 248),
(1559, 1, '2024-06-30 12:46:24', '2024-06-30 12:46:24', '150.00', '1.00', 2, 248),
(1560, 1, '2024-06-30 12:46:24', '2024-06-30 12:46:24', '300.00', '1.00', 2, 248),
(1561, 1, '2024-06-30 12:46:24', '2024-06-30 12:46:24', '450.00', '1.00', 2, 248),
(1574, 1, '2024-10-10 12:38:09', '2024-10-10 12:38:09', '150.00', '1.00', 2, 223),
(1575, 1, '2024-10-10 12:38:09', '2024-10-10 12:38:09', '300.00', '1.00', 2, 223),
(1576, 1, '2024-10-10 12:38:09', '2024-10-10 12:38:09', '600.00', '1.00', 2, 223),
(1577, 1, '2024-10-10 12:38:09', '2024-10-10 12:38:09', '900.00', '1.00', 2, 223),
(1578, 1, '2024-10-10 12:45:42', '2024-10-10 12:45:42', '150.00', '1.00', 2, 221),
(1579, 1, '2024-10-10 12:45:42', '2024-10-10 12:45:42', '300.00', '1.00', 2, 221),
(1580, 1, '2024-10-10 12:45:42', '2024-10-10 12:45:42', '600.00', '1.00', 2, 221),
(1581, 1, '2024-10-10 12:45:42', '2024-10-10 12:45:42', '900.00', '1.00', 2, 221),
(1582, 1, '2024-10-10 12:49:08', '2024-10-10 12:49:08', '150.00', '1.00', 2, 220),
(1583, 1, '2024-10-10 12:49:08', '2024-10-10 12:49:08', '300.00', '1.00', 2, 220),
(1584, 1, '2024-10-10 12:49:08', '2024-10-10 12:49:08', '600.00', '1.00', 2, 220),
(1585, 1, '2024-10-10 12:49:08', '2024-10-10 12:49:08', '900.00', '1.00', 2, 220),
(1586, 1, '2024-10-10 13:01:40', '2024-10-10 13:01:40', '150.00', '1.00', 2, 217),
(1587, 1, '2024-10-10 13:01:40', '2024-10-10 13:01:40', '300.00', '1.00', 2, 217),
(1588, 1, '2024-10-10 13:01:40', '2024-10-10 13:01:40', '600.00', '1.00', 2, 217),
(1589, 1, '2024-10-10 13:01:40', '2024-10-10 13:01:40', '900.00', '1.00', 2, 217),
(1590, 1, '2024-10-10 13:05:50', '2024-10-10 13:05:50', '150.00', '1.00', 2, 216),
(1591, 1, '2024-10-10 13:05:50', '2024-10-10 13:05:50', '300.00', '1.00', 2, 216),
(1592, 1, '2024-10-10 13:05:50', '2024-10-10 13:05:50', '600.00', '1.00', 2, 216),
(1593, 1, '2024-10-10 13:05:50', '2024-10-10 13:05:50', '900.00', '1.00', 2, 216),
(1594, 1, '2024-10-10 13:09:03', '2024-10-10 13:09:03', '150.00', '1.00', 2, 215),
(1595, 1, '2024-10-10 13:09:03', '2024-10-10 13:09:03', '300.00', '1.00', 2, 215),
(1596, 1, '2024-10-10 13:09:03', '2024-10-10 13:09:03', '600.00', '1.00', 2, 215),
(1597, 1, '2024-10-10 13:09:03', '2024-10-10 13:09:03', '900.00', '1.00', 2, 215),
(1598, 1, '2024-10-10 13:11:23', '2024-10-10 13:11:23', '150.00', '1.00', 2, 214),
(1599, 1, '2024-10-10 13:11:23', '2024-10-10 13:11:23', '300.00', '1.00', 2, 214),
(1600, 1, '2024-10-10 13:11:23', '2024-10-10 13:11:23', '600.00', '1.00', 2, 214),
(1601, 1, '2024-10-10 13:11:23', '2024-10-10 13:11:23', '900.00', '1.00', 2, 214),
(1606, 1, '2024-10-15 10:58:33', '2024-10-15 10:58:33', '100.00', '1.00', 2, 249),
(1607, 1, '2024-10-15 10:58:33', '2024-10-15 10:58:33', '150.00', '1.00', 2, 249),
(1608, 1, '2024-10-15 10:58:33', '2024-10-15 10:58:33', '300.00', '1.00', 2, 249),
(1609, 1, '2024-10-15 10:58:33', '2024-10-15 10:58:33', '450.00', '1.00', 2, 249),
(1610, 1, '2024-10-16 17:17:12', '2024-10-16 17:17:12', '150.00', '1.00', 2, 247),
(1611, 1, '2024-10-16 17:17:12', '2024-10-16 17:17:12', '300.00', '1.00', 2, 247),
(1612, 1, '2024-10-16 17:17:12', '2024-10-16 17:17:12', '600.00', '1.00', 2, 247),
(1613, 1, '2024-10-16 17:17:12', '2024-10-16 17:17:12', '900.00', '1.00', 2, 247),
(1614, 1, '2024-10-17 07:39:32', '2024-10-17 07:39:32', '150.00', '1.00', 2, 213),
(1615, 1, '2024-10-17 07:39:32', '2024-10-17 07:39:32', '300.00', '1.00', 2, 213),
(1616, 1, '2024-10-17 07:39:32', '2024-10-17 07:39:32', '600.00', '1.00', 2, 213),
(1617, 1, '2024-10-17 07:39:32', '2024-10-17 07:39:32', '900.00', '1.00', 2, 213),
(1618, 1, '2024-10-17 07:41:55', '2024-10-17 07:41:55', '150.00', '1.00', 2, 212),
(1619, 1, '2024-10-17 07:41:55', '2024-10-17 07:41:55', '300.00', '1.00', 2, 212),
(1620, 1, '2024-10-17 07:41:55', '2024-10-17 07:41:55', '600.00', '1.00', 2, 212),
(1621, 1, '2024-10-17 07:41:55', '2024-10-17 07:41:55', '900.00', '1.00', 2, 212),
(1626, 1, '2024-10-17 07:48:46', '2024-10-17 07:48:46', '150.00', '1.00', 2, 210),
(1627, 1, '2024-10-17 07:48:46', '2024-10-17 07:48:46', '300.00', '1.00', 2, 210),
(1628, 1, '2024-10-17 07:48:46', '2024-10-17 07:48:46', '600.00', '1.00', 2, 210),
(1629, 1, '2024-10-17 07:48:46', '2024-10-17 07:48:46', '900.00', '1.00', 2, 210),
(1630, 1, '2024-10-17 07:53:03', '2024-10-17 07:53:03', '150.00', '1.00', 2, 209),
(1631, 1, '2024-10-17 07:53:03', '2024-10-17 07:53:03', '300.00', '1.00', 2, 209),
(1632, 1, '2024-10-17 07:53:03', '2024-10-17 07:53:03', '600.00', '1.00', 2, 209),
(1633, 1, '2024-10-17 07:53:03', '2024-10-17 07:53:03', '900.00', '1.00', 2, 209),
(1634, 1, '2024-10-17 07:57:07', '2024-10-17 07:57:07', '150.00', '1.00', 2, 208),
(1635, 1, '2024-10-17 07:57:07', '2024-10-17 07:57:07', '300.00', '1.00', 2, 208),
(1636, 1, '2024-10-17 07:57:07', '2024-10-17 07:57:07', '600.00', '1.00', 2, 208),
(1637, 1, '2024-10-17 07:57:07', '2024-10-17 07:57:07', '900.00', '1.00', 2, 208),
(1638, 1, '2024-10-17 08:00:08', '2024-10-17 08:00:08', '150.00', '1.00', 2, 207),
(1639, 1, '2024-10-17 08:00:08', '2024-10-17 08:00:08', '300.00', '1.00', 2, 207),
(1640, 1, '2024-10-17 08:00:08', '2024-10-17 08:00:08', '600.00', '1.00', 2, 207),
(1641, 1, '2024-10-17 08:00:08', '2024-10-17 08:00:08', '900.00', '1.00', 2, 207),
(1642, 1, '2024-10-17 08:03:07', '2024-10-17 08:03:07', '150.00', '1.00', 2, 206),
(1643, 1, '2024-10-17 08:03:07', '2024-10-17 08:03:07', '300.00', '1.00', 2, 206),
(1644, 1, '2024-10-17 08:03:07', '2024-10-17 08:03:07', '600.00', '1.00', 2, 206),
(1645, 1, '2024-10-17 08:03:07', '2024-10-17 08:03:07', '900.00', '1.00', 2, 206),
(1646, 1, '2024-10-17 08:05:32', '2024-10-17 08:05:32', '150.00', '1.00', 2, 205),
(1647, 1, '2024-10-17 08:05:32', '2024-10-17 08:05:32', '300.00', '1.00', 2, 205),
(1648, 1, '2024-10-17 08:05:32', '2024-10-17 08:05:32', '600.00', '1.00', 2, 205),
(1649, 1, '2024-10-17 08:05:32', '2024-10-17 08:05:32', '900.00', '1.00', 2, 205),
(1650, 1, '2024-10-17 08:07:09', '2024-10-17 08:07:09', '150.00', '1.00', 2, 204),
(1651, 1, '2024-10-17 08:07:09', '2024-10-17 08:07:09', '300.00', '1.00', 2, 204),
(1652, 1, '2024-10-17 08:07:09', '2024-10-17 08:07:09', '600.00', '1.00', 2, 204),
(1653, 1, '2024-10-17 08:07:09', '2024-10-17 08:07:09', '900.00', '1.00', 2, 204),
(1658, 1, '2024-10-17 12:10:06', '2024-10-17 12:10:06', '150.00', '1.00', 2, 179),
(1659, 1, '2024-10-17 12:10:06', '2024-10-17 12:10:06', '300.00', '1.00', 2, 179),
(1660, 1, '2024-10-17 12:10:06', '2024-10-17 12:10:06', '600.00', '1.00', 2, 179),
(1661, 1, '2024-10-17 12:10:06', '2024-10-17 12:10:06', '900.00', '1.00', 2, 179),
(1662, 1, '2024-11-17 12:08:05', '2024-11-17 12:08:05', '150.00', '1.00', 2, 211),
(1663, 1, '2024-11-17 12:08:05', '2024-11-17 12:08:05', '300.00', '1.00', 2, 211),
(1664, 1, '2024-11-17 12:08:05', '2024-11-17 12:08:05', '600.00', '1.00', 2, 211),
(1665, 1, '2024-11-17 12:08:05', '2024-11-17 12:08:05', '900.00', '1.00', 2, 211),
(1666, 1, '2024-12-10 11:41:56', '2024-12-10 11:41:56', '150.00', '1.00', 2, 113),
(1667, 1, '2024-12-10 11:41:56', '2024-12-10 11:41:56', '300.00', '1.00', 2, 113),
(1668, 1, '2024-12-10 11:41:56', '2024-12-10 11:41:56', '600.00', '1.00', 2, 113),
(1669, 1, '2024-12-10 11:41:56', '2024-12-10 11:41:56', '900.00', '1.00', 2, 113),
(1670, 1, '2025-01-07 21:18:41', '2025-01-07 21:18:41', '150.00', '1.00', 2, 108),
(1671, 1, '2025-01-07 21:18:41', '2025-01-07 21:18:41', '300.00', '1.00', 2, 108),
(1672, 1, '2025-01-07 21:18:41', '2025-01-07 21:18:41', '600.00', '1.00', 2, 108),
(1673, 1, '2025-01-07 21:18:41', '2025-01-07 21:18:41', '900.00', '1.00', 2, 108);

-- --------------------------------------------------------

--
-- Table structure for table `product_coupons`
--

CREATE TABLE `product_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount` decimal(8,2) NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_id`, `created_at`, `updated_at`, `product_id`, `review`, `star`, `status`) VALUES
(4, 2, '2025-03-05 08:57:10', NULL, 7, NULL, 2, 'hide'),
(5, 1, '2025-03-05 08:57:10', NULL, 7, 'rtt', 4, 'show'),
(6, 70, '2025-03-05 12:25:10', '2025-03-05 12:25:10', 7, 'very good', 2, 'show');

-- --------------------------------------------------------

--
-- Table structure for table `question_answers`
--

CREATE TABLE `question_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `question_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_ar` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer_en` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_logged` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول الأسئلة الشائعة';

--
-- Dumping data for table `question_answers`
--

INSERT INTO `question_answers` (`id`, `added_by`, `question_en`, `question_ar`, `answer_ar`, `answer_en`, `created_at`, `updated_at`, `is_logged`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut e', 'لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم ?', 'لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق \"ليتراسيت\" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل \"ألدوس بايج مايكر\" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut e', '2024-03-03 12:34:34', '2024-10-18 20:03:05', 'yes'),
(2, 1, 'تجريبي', 'تجريبي', 'تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي', 'تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي تجريبي', '2024-03-06 13:59:47', '2024-07-20 20:14:37', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `referral_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(27, 1),
(28, 1),
(29, 1),
(29, 4),
(30, 1),
(49, 1),
(49, 6),
(85, 6),
(90, 1),
(90, 2),
(90, 6),
(91, 1),
(91, 2),
(91, 6),
(92, 1),
(92, 2),
(92, 6),
(93, 1),
(93, 6),
(98, 1),
(98, 4),
(98, 6),
(99, 1),
(99, 4),
(99, 6),
(100, 1),
(100, 4),
(100, 6),
(101, 1),
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
(122, 5),
(122, 6),
(123, 5),
(123, 6),
(124, 6),
(125, 6),
(150, 1),
(150, 2),
(150, 4),
(151, 0),
(151, 1),
(151, 2),
(151, 3),
(151, 4),
(152, 0),
(152, 1),
(152, 2),
(152, 3),
(152, 4),
(153, 1),
(153, 2),
(153, 4),
(154, 1),
(154, 2),
(154, 4),
(155, 1),
(155, 4),
(156, 1),
(156, 4),
(157, 1),
(157, 4),
(158, 1),
(158, 4),
(159, 1),
(160, 1),
(161, 1),
(162, 1),
(163, 1),
(164, 1),
(164, 4),
(165, 1),
(165, 4),
(166, 1),
(167, 1),
(167, 4),
(168, 1),
(168, 4),
(169, 1),
(169, 4),
(170, 1),
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
  `page_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(11, 1, 'عنوان المقال', 'dfghjkltdes', 'maqaal-tqkepy', 'يبلاتةن،يتبالت،لاتن', '2025-01-24 21:26:49', '2025-02-06 13:10:23', '\\App\\Models\\Blog', 12);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `group`, `name`, `locked`, `payload`, `created_at`, `updated_at`) VALUES
(1, 'general', 'site_name_ar', 0, '\"Lumora\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(2, 'general', 'site_name_en', 0, '\"Lumora\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(3, 'general', 'site_active', 0, 'true', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(4, 'general', 'logo', 0, '\"\\/uploadedImages\\/\\/settings-1738835852.svg\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(5, 'general', 'email', 0, '\"info@email.com\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(6, 'general', 'address_ar', 0, '\"\\u0645\\u0635\\u0631\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(7, 'general', 'address_en', 0, '\"Egypt\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(8, 'general', 'facebook_link', 0, '\"https:\\/\\/www.facebook.com\"', '2024-12-08 09:28:24', '2024-12-08 09:28:24'),
(9, 'general', 'base_logo', 0, '\"https:\\/\\/www.google.com\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(10, 'general', 'favicon', 0, '\"\\/uploadedImages\\/\\/settings-1738833866.svg\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(11, 'general', 'phone', 0, '\"96658033832\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(12, 'general', 'whatsapp_phone', 0, '\"1123333332\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(16, 'seo', 'meta_title_ar', 0, '\"\\u0644\\u0627\\u0645\\u0648\\u0631 - \\u0633\\u0647\\u0648\\u0644\\u0629 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u0641\\u064a \\u0645\\u062a\\u0646\\u0627\\u0648\\u0644 \\u064a\\u062f\\u0643\"', '2024-12-08 09:44:07', '2025-02-06 21:17:12'),
(17, 'seo', 'meta_title_en', 0, '\"\\u0644\\u0627\\u0645\\u0648\\u0631 - \\u0633\\u0647\\u0648\\u0644\\u0629 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u0641\\u064a \\u0645\\u062a\\u0646\\u0627\\u0648\\u0644 \\u064a\\u062f\\u0643\"', '2024-12-08 09:44:07', '2025-02-06 21:17:12'),
(18, 'seo', 'meta_description_ar', 0, '\"\\u0627\\u0643\\u062a\\u0634\\u0641 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u062a\\u0633\\u0648\\u0642 \\u0641\\u0631\\u064a\\u062f\\u0629 \\u0645\\u0639 \\u062a\\u0637\\u0628\\u064a\\u0642 \\u0644\\u0627\\u0645\\u0648\\u0631! \\u0627\\u062d\\u0635\\u0644 \\u0639\\u0644\\u0649 \\u0623\\u062d\\u062f\\u062b \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0648\\u0627\\u0644\\u0639\\u0631\\u0648\\u0636 \\u0627\\u0644\\u0645\\u0645\\u064a\\u0632\\u0629 \\u0628\\u0633\\u0647\\u0648\\u0644\\u0629 \\u0648\\u0631\\u0627\\u062d\\u0629 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0648\\u0627\\u062c\\u0647\\u0629 \\u0645\\u0635\\u0645\\u0645\\u0629 \\u062e\\u0635\\u064a\\u0635\\u064b\\u0627 \\u0644\\u062a\\u0644\\u0628\\u064a\\u0629 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643. \\u0627\\u0628\\u062f\\u0623 \\u0631\\u062d\\u0644\\u062a\\u0643 \\u0627\\u0644\\u0622\\u0646\"', '2024-12-08 09:44:07', '2025-02-06 21:17:12'),
(19, 'seo', 'meta_description_en', 0, '\"\\u0627\\u0643\\u062a\\u0634\\u0641 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u062a\\u0633\\u0648\\u0642 \\u0641\\u0631\\u064a\\u062f\\u0629 \\u0645\\u0639 \\u062a\\u0637\\u0628\\u064a\\u0642 \\u0644\\u0627\\u0645\\u0648\\u0631! \\u0627\\u062d\\u0635\\u0644 \\u0639\\u0644\\u0649 \\u0623\\u062d\\u062f\\u062b \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0648\\u0627\\u0644\\u0639\\u0631\\u0648\\u0636 \\u0627\\u0644\\u0645\\u0645\\u064a\\u0632\\u0629 \\u0628\\u0633\\u0647\\u0648\\u0644\\u0629 \\u0648\\u0631\\u0627\\u062d\\u0629 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0648\\u0627\\u062c\\u0647\\u0629 \\u0645\\u0635\\u0645\\u0645\\u0629 \\u062e\\u0635\\u064a\\u0635\\u064b\\u0627 \\u0644\\u062a\\u0644\\u0628\\u064a\\u0629 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643. \\u0627\\u0628\\u062f\\u0623 \\u0631\\u062d\\u0644\\u062a\\u0643 \\u0627\\u0644\\u0622\\u0646\"', '2024-12-08 09:44:07', '2025-02-06 21:17:12'),
(20, 'seo', 'keywords', 0, '\"\\u0645\\u0648\\u0642\\u0639 \\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a,\\u062a\\u0637\\u0628\\u064a\\u0642,\\u062a\\u062c\\u0645\\u064a\\u0644,\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0628\\u0634\\u0631\\u0629,\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0634\\u0639\\u0631,\\u0630\\u0647\\u0628,\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0644\\u0644\\u0628\\u0634\\u0631\\u0629,\\u062a\\u0637\\u0628\\u064a\\u0642 \\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a,\\u0628\\u0634\\u0631\\u0629 \\u0632\\u062c\\u0627\\u062c\\u064a\\u0629,\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0623\\u0638\\u0627\\u0641\\u0631\"', '2024-12-08 09:44:07', '2025-02-06 21:17:12'),
(30, 'social', 'facebook_link', 0, '\"https:\\/\\/www.facebook.com\"', '2024-12-08 10:35:20', '2025-02-06 19:52:52'),
(31, 'social', 'whatsapp_link', 0, '\"Spatie\"', '2024-12-08 10:35:20', '2025-02-06 19:52:52'),
(32, 'social', 'twitter_link', 0, '\"https:\\/\\/www.twitter.com\\/\"', '2024-12-08 10:35:20', '2025-02-06 19:52:52'),
(33, 'social', 'instagram_link', 0, '\"https:\\/\\/www.instagram.com\\/\"', '2024-12-08 10:35:20', '2025-02-06 19:52:52'),
(34, 'social', 'tiktok_link', 0, '\"https:\\/\\/www.tiktok.com\\/\"', '2024-12-08 10:35:21', '2025-02-06 19:52:52'),
(35, 'social', 'linkedin_link', 0, '\"https:\\/\\/www.facebook.com\\/\"', '2024-12-08 10:35:21', '2025-02-06 19:52:52'),
(36, 'social', 'snapchat_link', 0, '\"https:\\/\\/www.snapchat.com\\/\"', '2024-12-08 10:35:21', '2025-02-06 19:52:52'),
(37, 'social', 'youtube_link', 0, '\"https:\\/\\/www.youtube.com\\/\"', '2024-12-08 10:35:21', '2025-02-06 19:52:52'),
(38, 'social', 'google_link', 0, '\"info@email.com\"', '2024-12-08 10:35:21', '2025-02-06 19:52:52'),
(39, 'social', 'android_link', 0, '\"https:\\/\\/www.facebook.com\\/\"', '2024-12-08 10:35:21', '2025-02-06 19:52:52'),
(40, 'social', 'ios_link', 0, '\"https:\\/\\/www.facebook.com\\/\"', '2024-12-08 10:35:21', '2025-02-06 19:52:52'),
(41, 'general', 'bank_account_number', 0, '\"96658033832\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(42, 'general', 'instapay_number', 0, '\"https:\\/\\/www.twitter.com\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(43, 'general', 'vodafone_cash_number', 0, '\"https:\\/\\/www.twitter.com\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(44, 'general', 'iban_number', 0, '\"96658033832\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(45, 'general', 'bank_name', 0, '\"https:\\/\\/www.twitter.com\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
(46, 'general', 'bank_account_name', 0, '\"https:\\/\\/www.twitter.com\"', '2024-12-08 09:28:24', '2025-02-06 19:52:52'),
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
  `zone_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `admin_id`, `zone_id`, `city_name`, `cost`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, '1', 'القاهرة', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(2, 1, '1', 'الأسكندرية', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(3, 1, '1', 'القاهرة الجديدة', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(4, 1, '1', 'الرحاب', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(5, 1, '1', 'حلوان', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(6, 1, '1', 'الجيزة', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(7, 1, '1', 'مدينة السادس من أكتوبر', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(8, 1, '1', 'الشيخ زايد', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(9, 1, '1', 'مدينة العاشر من رمضان', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(10, 1, '1', 'مدينة بدر', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(11, 1, '1', 'الشروق', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(12, 1, '1', 'العبور', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(13, 1, '1', 'مدينتي', '30.00', '2024-07-24 10:13:44', NULL, 'show'),
(14, 1, '2', 'بورسعيد', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(15, 1, '2', 'الإسماعلية', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(16, 1, '2', 'السويس', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(17, 1, '2', 'السخنه', '60.00', '2024-07-24 10:13:44', '2024-07-24 17:53:34', 'show'),
(18, 1, '3', 'البحيرة', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(20, 1, '3', 'دمياط', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(21, 1, '3', 'الدقهلية', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(22, 1, '3', 'كفر الشيخ', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(23, 1, '3', 'الغربية', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(24, 1, '3', 'المنوفية', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(25, 1, '3', 'الشرقية', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(26, 1, '3', 'القليوبية', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(27, 1, '3', 'دمنهور', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(28, 1, '3', 'المنصورة', '0.00', '2024-07-24 10:13:44', NULL, 'show'),
(29, 1, '3', 'Elsaf', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(30, 1, '3', 'سقارة', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(31, 1, '3', 'البدرشين', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(32, 1, '3', 'الحوامدية', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(33, 1, '3', 'Elkhatatba', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(34, 1, '3', 'دهشور', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(35, 1, '3', 'Owaism', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(36, 1, '3', 'Elharranyia', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(37, 1, '3', 'Shabramant', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(38, 1, '3', 'Atfeeh', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(39, 1, '3', 'أبو النمرس', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(40, 1, '3', 'Burkash', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(41, 1, '3', 'Arab mosaeed', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(42, 1, '3', 'العياط', '60.00', '2024-07-24 10:13:44', NULL, 'show'),
(43, 1, '4', 'الفيوم', '75.00', '2024-07-24 10:13:44', NULL, 'show'),
(44, 1, '4', 'بني سويف', '75.00', '2024-07-24 10:13:44', NULL, 'show'),
(45, 1, '4', 'المنيا', '75.00', '2024-07-24 10:13:44', NULL, 'show'),
(46, 1, '4', 'أسيوط', '75.00', '2024-07-24 10:13:44', NULL, 'show'),
(47, 1, '4', 'سوهاج', '75.00', '2024-07-24 10:13:44', NULL, 'show'),
(48, 1, '5', 'قنا', '85.00', '2024-07-24 10:13:44', NULL, 'show'),
(49, 1, '5', 'الأقصر', '85.00', '2024-07-24 10:13:44', NULL, 'show'),
(50, 1, '5', 'أسوان', '85.00', '2024-07-24 10:13:44', NULL, 'show'),
(51, 1, '5', 'شرم الشيخ', '85.00', '2024-07-24 10:13:44', NULL, 'show'),
(52, 1, '5', 'الغردقة', '85.00', '2024-07-24 10:13:44', NULL, 'show'),
(53, 1, '5', 'عيون موسي', '85.00', '2024-07-24 10:13:44', NULL, 'show'),
(54, 1, '5', 'راس سدر', '85.00', '2024-07-24 10:13:44', NULL, 'show'),
(55, 1, '5', 'شمال سيناء', '85.00', '2024-07-24 10:13:44', NULL, 'show'),
(56, 1, '5', 'الساحل الشمالي', '85.00', '2024-07-24 10:13:44', NULL, 'show'),
(57, 1, '5', 'مرسي مطروح', '85.00', '2024-07-24 10:13:44', NULL, 'show'),
(58, 1, '5', 'دهب', '85.00', '2024-07-24 10:13:44', NULL, 'show'),
(59, 1, '5', 'الطور', '85.00', '2024-07-24 10:13:44', NULL, 'show'),
(60, 1, '5', 'نويبع', '85.00', '2024-07-24 10:13:44', NULL, 'show'),
(61, 1, '6', 'جنوب سيناء', '95.00', '2024-07-24 10:13:44', NULL, 'show'),
(62, 1, '6', 'مرسي علم', '95.00', '2024-07-24 10:13:44', NULL, 'show'),
(63, 1, '6', 'العريش', '95.00', '2024-07-24 10:13:44', NULL, 'show'),
(64, 1, '6', 'الجونة', '95.00', '2024-07-24 10:13:44', NULL, 'show'),
(65, 1, '6', 'سفاجا', '95.00', '2024-07-24 10:13:44', NULL, 'show'),
(66, 1, '6', 'البحر الأحمر', '95.00', '2024-07-24 10:13:44', NULL, 'show'),
(67, 1, '6', 'طابا', '95.00', '2024-07-24 10:13:44', NULL, 'show'),
(68, 1, '6', 'Kosseir', '95.00', '2024-07-24 10:13:44', NULL, 'show'),
(69, 1, '3', 'المحلة الكبري', '100.00', '2024-07-24 10:13:44', '2024-08-17 13:12:29', 'show');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci DEFAULT 'hide',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='جدول التصنيفات';

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `added_by`, `name`, `location`, `status`, `created_at`, `updated_at`, `user_id`, `link`) VALUES
(1, 1, 'Pure', 'privacy policy', 'show', '2024-07-25 13:40:50', '2025-02-20 08:28:16', 36, 'privacy-policy'),
(8, 1, 'ثراء', NULL, 'show', '2025-01-24 19:39:14', '2025-02-20 08:21:06', 45, NULL),
(10, 1, 'raw african', NULL, 'show', '2025-02-06 13:54:24', '2025-02-20 08:22:21', 39, NULL),
(11, 1, 'امتنان', NULL, 'show', '2025-02-17 12:22:34', '2025-02-20 08:22:52', 38, NULL),
(12, 1, 'Sandy\'s', NULL, 'show', '2025-02-18 11:33:26', '2025-02-20 08:28:41', 51, NULL),
(13, 1, 'aura', NULL, 'show', '2025-02-19 11:32:06', '2025-02-20 08:28:00', 46, NULL),
(14, 1, 'الطرشوبي', NULL, 'show', '2025-02-19 11:38:52', '2025-02-19 11:38:52', 58, NULL),
(15, 1, 'sephora shop', NULL, 'show', '2025-02-19 11:39:37', '2025-02-19 11:39:37', 50, NULL),
(16, 1, 'ghjjjhh', NULL, 'show', '2025-03-05 10:08:31', '2025-03-05 10:08:31', 48, NULL),
(17, 1, 'Lani Bishop', NULL, 'show', '2025-03-09 11:07:53', '2025-03-09 11:07:53', 76, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci DEFAULT 'hide',
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_instructor` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `admin_id`, `name`, `email`, `created_at`, `updated_at`, `status`, `gender`, `whatsapp_phone`, `job_title`, `is_instructor`) VALUES
(12, 1, 'vfhbnj', 'bvhbjn@ta.com', '2024-07-21 12:02:10', '2024-07-25 13:48:03', 'hide', 'male', '01011001', 'jcdvghjk', 'yes'),
(13, 1, 'mai tarek', 'maitarekttt@gmail.com', '2024-09-28 15:25:47', '2024-09-28 15:25:47', 'hide', 'male', '01097987069', 'Unde incidunt est v', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `temp_carts`
--

CREATE TABLE `temp_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_ip` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trackers`
--

CREATE TABLE `trackers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `visit_time` time DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trackers`
--

INSERT INTO `trackers` (`id`, `ip`, `date`, `created_at`, `updated_at`, `hits`, `visit_time`, `country`, `city`) VALUES
(7, '::1', '2023-10-25', '2023-10-26 08:32:38', '2023-10-26 10:46:39', 2, '13:46:39', NULL, NULL),
(8, '::1', '2023-10-26', '2023-10-26 10:47:05', '2023-10-26 10:48:01', 18, '13:48:01', NULL, NULL),
(9, '41.43.162.170', '2023-10-26', '2023-10-26 12:24:35', '2023-10-26 12:24:48', 4, '15:24:48', NULL, NULL),
(10, '31.166.26.71', '2023-10-26', '2023-10-26 12:24:40', '2023-10-26 12:25:06', 4, '15:25:06', NULL, NULL),
(11, '156.206.17.50', '2023-10-26', '2023-10-26 12:25:27', '2023-10-26 12:36:57', 6, '15:36:57', NULL, NULL),
(12, '31.166.26.71', '2023-10-27', '2023-10-27 18:14:34', '2023-10-27 18:53:16', 3, '20:53:16', NULL, NULL),
(13, '102.45.142.111', '2023-10-28', '2023-10-28 17:38:44', '2023-10-28 18:11:17', 8, '20:11:17', NULL, NULL),
(14, '31.13.127.119', '2023-10-28', '2023-10-28 17:56:13', '2023-10-28 17:56:13', 2, '19:56:13', NULL, NULL),
(15, '31.13.127.21', '2023-10-28', '2023-10-28 17:56:14', '2023-10-28 17:56:14', 2, '19:56:14', NULL, NULL),
(16, '31.13.127.116', '2023-10-28', '2023-10-28 17:56:16', '2023-10-28 17:56:17', 2, '19:56:17', NULL, NULL),
(17, '31.13.127.18', '2023-10-28', '2023-10-28 17:56:16', '2023-10-28 17:56:17', 2, '19:56:17', NULL, NULL),
(18, '31.13.127.6', '2023-10-28', '2023-10-28 17:56:16', '2023-10-28 17:56:17', 2, '19:56:17', NULL, NULL),
(19, '31.13.127.11', '2023-10-28', '2023-10-28 17:56:17', '2023-10-28 17:56:18', 2, '19:56:18', NULL, NULL),
(20, '31.13.127.8', '2023-10-28', '2023-10-28 17:56:17', '2023-10-28 17:56:18', 2, '19:56:18', NULL, NULL),
(21, '197.61.203.255', '2023-10-29', '2023-10-29 09:04:32', '2023-10-29 14:57:38', 21, '16:57:38', NULL, NULL),
(22, '176.224.146.68', '2023-10-29', '2023-10-29 09:34:19', '2023-10-29 09:34:19', 2, '11:34:19', NULL, NULL),
(23, '197.43.52.117', '2023-10-29', '2023-10-29 12:54:25', '2023-10-29 14:49:35', 25, '16:49:35', NULL, NULL),
(24, '27.115.124.45', '2023-10-29', '2023-10-29 13:39:08', '2023-10-29 13:39:08', 2, '15:39:08', NULL, NULL),
(25, '197.43.105.148', '2023-10-29', '2023-10-29 17:40:35', '2023-10-29 18:41:38', 17, '20:41:38', NULL, NULL),
(26, '197.61.203.255', '2023-10-30', '2023-10-30 08:34:39', '2023-10-30 10:03:21', 10, '12:03:21', NULL, NULL),
(27, '3.234.251.132', '2023-10-30', '2023-10-30 14:14:47', '2023-10-30 14:14:47', 2, '16:14:47', NULL, NULL),
(28, '34.238.123.119', '2023-10-31', '2023-10-31 12:04:26', '2023-10-31 12:04:26', 2, '14:04:26', NULL, NULL),
(29, '197.61.203.255', '2023-11-01', '2023-11-01 12:04:07', '2023-11-01 12:04:08', 2, '14:04:08', NULL, NULL),
(30, '154.185.58.190', '2023-11-04', '2023-11-04 14:40:26', '2023-11-04 14:42:29', 3, '16:42:29', NULL, NULL),
(31, '46.251.149.84', '2023-11-07', '2023-11-07 15:42:56', '2023-11-07 15:42:56', 2, '17:42:56', NULL, NULL),
(32, '197.43.15.102', '2023-11-09', '2023-11-09 19:15:27', '2023-11-09 19:15:27', 2, '21:15:27', NULL, NULL),
(33, '154.186.100.75', '2023-11-15', '2023-11-15 16:00:51', '2023-11-15 16:00:51', 2, '18:00:51', NULL, NULL),
(34, '46.251.149.84', '2023-11-19', '2023-11-19 18:55:16', '2023-11-19 18:55:17', 2, '20:55:17', NULL, NULL),
(35, '95.186.64.154', '2023-11-20', '2023-11-20 06:45:35', '2023-11-20 06:45:35', 2, '08:45:35', NULL, NULL),
(36, '46.251.149.84', '2023-11-20', '2023-11-20 19:11:08', '2023-11-20 19:11:08', 2, '21:11:08', NULL, NULL),
(37, '2.90.144.86', '2023-11-21', '2023-11-21 10:49:35', '2023-11-21 10:52:15', 4, '12:52:15', NULL, NULL),
(38, '156.206.152.42', '2023-12-04', '2023-12-04 08:39:41', '2023-12-04 08:39:42', 2, '10:39:42', NULL, NULL),
(39, '31.167.122.0', '2023-12-11', '2023-12-11 18:13:05', '2023-12-11 18:13:05', 2, '20:13:05', NULL, NULL),
(40, '31.167.122.0', '2023-12-12', '2023-12-12 18:24:36', '2023-12-12 19:29:36', 10, '21:29:36', NULL, NULL),
(41, '149.154.161.249', '2023-12-12', '2023-12-12 18:57:44', '2023-12-12 18:57:45', 2, '20:57:45', NULL, NULL),
(42, '34.247.245.218', '2023-12-12', '2023-12-12 18:58:03', '2023-12-12 18:58:03', 2, '20:58:03', NULL, NULL),
(43, '3.249.255.96', '2023-12-12', '2023-12-12 19:01:47', '2023-12-12 19:01:47', 2, '21:01:47', NULL, NULL),
(44, '176.18.123.61', '2023-12-12', '2023-12-12 19:01:54', '2023-12-12 19:03:06', 3, '21:03:06', NULL, NULL),
(45, '54.74.225.200', '2023-12-12', '2023-12-12 21:07:17', '2023-12-12 21:07:17', 2, '23:07:17', NULL, NULL),
(46, '34.243.250.32', '2023-12-13', '2023-12-12 23:25:28', '2023-12-12 23:25:28', 2, '01:25:28', NULL, NULL),
(47, '34.247.164.87', '2023-12-13', '2023-12-12 23:25:28', '2023-12-12 23:25:29', 2, '01:25:29', NULL, NULL),
(48, '54.171.240.49', '2023-12-13', '2023-12-12 23:25:30', '2023-12-12 23:25:30', 2, '01:25:30', NULL, NULL),
(49, '54.74.70.145', '2023-12-13', '2023-12-13 06:21:59', '2023-12-13 06:21:59', 2, '08:21:59', NULL, NULL),
(50, '151.254.194.246', '2023-12-13', '2023-12-13 07:00:37', '2023-12-13 07:03:50', 3, '09:03:50', NULL, NULL),
(51, '34.247.183.143', '2023-12-13', '2023-12-13 10:20:48', '2023-12-13 10:20:49', 2, '12:20:49', NULL, NULL),
(52, '54.229.158.249', '2023-12-13', '2023-12-13 14:34:04', '2023-12-13 14:34:04', 2, '16:34:04', NULL, NULL),
(53, '54.228.104.168', '2023-12-13', '2023-12-13 18:59:28', '2023-12-13 18:59:28', 2, '20:59:28', NULL, NULL),
(54, '3.254.133.81', '2023-12-13', '2023-12-13 19:04:46', '2023-12-13 19:04:46', 2, '21:04:46', NULL, NULL),
(55, '54.194.49.122', '2023-12-14', '2023-12-13 23:33:01', '2023-12-13 23:33:02', 2, '01:33:02', NULL, NULL),
(56, '34.255.197.23', '2023-12-14', '2023-12-13 23:33:03', '2023-12-13 23:33:03', 2, '01:33:03', NULL, NULL),
(57, '54.74.70.145', '2023-12-14', '2023-12-14 09:59:30', '2023-12-14 09:59:30', 2, '11:59:30', NULL, NULL),
(58, '34.249.12.51', '2023-12-14', '2023-12-14 12:22:25', '2023-12-14 12:22:25', 2, '14:22:25', NULL, NULL),
(59, '197.120.143.236', '2023-12-14', '2023-12-14 14:52:35', '2023-12-14 14:52:35', 2, '16:52:35', NULL, NULL),
(60, '31.167.122.0', '2023-12-14', '2023-12-14 14:59:46', '2023-12-14 14:59:46', 2, '16:59:46', NULL, NULL),
(61, '34.254.179.209', '2023-12-14', '2023-12-14 16:10:21', '2023-12-14 16:10:21', 2, '18:10:21', NULL, NULL),
(62, '52.208.143.151', '2023-12-14', '2023-12-14 18:17:39', '2023-12-14 18:17:39', 2, '20:17:39', NULL, NULL),
(63, '5.163.48.244', '2023-12-14', '2023-12-14 19:43:16', '2023-12-14 19:43:16', 2, '21:43:16', NULL, NULL),
(64, '34.243.245.9', '2023-12-14', '2023-12-14 21:11:03', '2023-12-14 21:11:03', 2, '23:11:03', NULL, NULL),
(65, '54.75.39.125', '2023-12-14', '2023-12-14 21:12:41', '2023-12-14 21:12:41', 2, '23:12:41', NULL, NULL),
(66, '54.171.240.49', '2023-12-14', '2023-12-14 21:12:42', '2023-12-14 21:12:42', 2, '23:12:42', NULL, NULL),
(67, '34.244.200.29', '2023-12-15', '2023-12-15 12:15:07', '2023-12-15 12:15:07', 2, '14:15:07', NULL, NULL),
(68, '34.244.102.253', '2023-12-15', '2023-12-15 20:26:59', '2023-12-15 20:26:59', 2, '22:26:59', NULL, NULL),
(69, '3.252.137.126', '2023-12-15', '2023-12-15 20:27:00', '2023-12-15 20:27:00', 2, '22:27:00', NULL, NULL),
(70, '3.250.173.91', '2023-12-15', '2023-12-15 21:41:25', '2023-12-15 21:41:25', 2, '23:41:25', NULL, NULL),
(71, '3.252.106.248', '2023-12-16', '2023-12-15 22:45:15', '2023-12-15 22:45:15', 2, '00:45:15', NULL, NULL),
(72, '52.214.249.47', '2023-12-16', '2023-12-15 22:45:15', '2023-12-15 22:45:15', 2, '00:45:15', NULL, NULL),
(73, '34.245.22.236', '2023-12-17', '2023-12-17 03:46:03', '2023-12-17 03:46:03', 2, '05:46:03', NULL, NULL),
(74, '34.245.234.191', '2023-12-18', '2023-12-18 12:41:20', '2023-12-18 12:41:20', 2, '14:41:20', NULL, NULL),
(75, '3.252.209.233', '2023-12-18', '2023-12-18 12:41:21', '2023-12-18 12:41:21', 2, '14:41:21', NULL, NULL),
(76, '34.248.240.42', '2023-12-18', '2023-12-18 12:41:21', '2023-12-18 12:41:21', 2, '14:41:21', NULL, NULL),
(77, '18.202.175.37', '2023-12-18', '2023-12-18 21:08:50', '2023-12-18 21:08:50', 2, '23:08:50', NULL, NULL),
(78, '54.171.141.43', '2023-12-18', '2023-12-18 21:08:50', '2023-12-18 21:08:50', 2, '23:08:50', NULL, NULL),
(79, '3.253.104.152', '2023-12-20', '2023-12-20 09:35:04', '2023-12-20 09:35:04', 2, '11:35:04', NULL, NULL),
(80, '54.76.124.17', '2023-12-20', '2023-12-20 09:35:04', '2023-12-20 09:35:04', 2, '11:35:04', NULL, NULL),
(81, '54.74.171.160', '2023-12-20', '2023-12-20 15:23:22', '2023-12-20 15:23:22', 2, '17:23:22', NULL, NULL),
(82, '34.241.251.95', '2023-12-20', '2023-12-20 15:23:22', '2023-12-20 15:23:23', 2, '17:23:23', NULL, NULL),
(83, '3.253.241.211', '2023-12-21', '2023-12-20 22:08:00', '2023-12-20 22:08:00', 2, '00:08:00', NULL, NULL),
(84, '34.244.134.120', '2023-12-22', '2023-12-21 22:13:27', '2023-12-21 22:13:27', 2, '00:13:27', NULL, NULL),
(85, '34.254.174.98', '2023-12-22', '2023-12-21 22:13:27', '2023-12-21 22:13:27', 2, '00:13:27', NULL, NULL),
(86, '3.253.250.137', '2023-12-22', '2023-12-21 22:13:28', '2023-12-21 22:13:28', 2, '00:13:28', NULL, NULL),
(87, '34.240.220.167', '2023-12-22', '2023-12-22 00:25:51', '2023-12-22 00:25:51', 2, '02:25:51', NULL, NULL),
(88, '54.155.184.209', '2023-12-22', '2023-12-22 00:25:51', '2023-12-22 00:25:51', 2, '02:25:51', NULL, NULL),
(89, '54.171.161.24', '2023-12-23', '2023-12-23 00:53:14', '2023-12-23 00:53:14', 2, '02:53:14', NULL, NULL),
(90, '54.195.61.242', '2023-12-23', '2023-12-23 00:53:14', '2023-12-23 00:53:14', 2, '02:53:14', NULL, NULL),
(91, '54.216.202.49', '2023-12-23', '2023-12-23 02:07:43', '2023-12-23 02:07:43', 2, '04:07:43', NULL, NULL),
(92, '3.249.47.122', '2023-12-24', '2023-12-24 09:39:40', '2023-12-24 09:39:40', 2, '11:39:40', NULL, NULL),
(93, '52.50.124.151', '2023-12-24', '2023-12-24 09:39:40', '2023-12-24 09:39:40', 2, '11:39:40', NULL, NULL),
(94, '34.244.191.39', '2023-12-24', '2023-12-24 09:39:41', '2023-12-24 09:39:41', 2, '11:39:41', NULL, NULL),
(95, '63.33.211.224', '2023-12-24', '2023-12-24 15:47:19', '2023-12-24 15:47:19', 2, '17:47:19', NULL, NULL),
(96, '18.201.138.167', '2023-12-24', '2023-12-24 15:47:19', '2023-12-24 15:47:19', 2, '17:47:19', NULL, NULL),
(97, '3.253.250.137', '2023-12-24', '2023-12-24 15:47:19', '2023-12-24 15:47:19', 2, '17:47:19', NULL, NULL),
(98, '52.211.36.147', '2023-12-27', '2023-12-26 22:00:18', '2023-12-26 22:00:18', 2, '00:00:18', NULL, NULL),
(99, '3.254.142.85', '2023-12-27', '2023-12-26 22:00:18', '2023-12-26 22:00:18', 2, '00:00:18', NULL, NULL),
(100, '54.170.120.155', '2023-12-27', '2023-12-27 12:39:29', '2023-12-27 12:39:29', 2, '14:39:29', NULL, NULL),
(101, '18.201.131.210', '2023-12-27', '2023-12-27 12:39:29', '2023-12-27 12:39:29', 2, '14:39:29', NULL, NULL),
(102, '34.207.207.161', '2023-12-27', '2023-12-27 14:10:52', '2023-12-27 14:10:52', 2, '16:10:52', NULL, NULL),
(103, '156.197.6.217', '2023-12-31', '2023-12-31 13:04:59', '2023-12-31 13:25:12', 8, '15:25:12', NULL, NULL),
(104, '156.197.6.217', '2023-12-31', '2023-12-31 14:02:26', '2023-12-31 15:21:01', 7, '17:21:01', 'EG', 'Damietta'),
(105, '44.206.238.207', '2023-12-31', '2023-12-31 15:32:25', '2023-12-31 15:32:25', 2, '17:32:25', 'US', 'Ashburn'),
(106, '197.35.252.78', '2024-01-02', '2024-01-02 08:32:03', '2024-01-02 15:17:58', 8, '17:17:58', 'EG', 'Damanhur'),
(107, '34.224.71.0', '2024-01-02', '2024-01-02 15:15:57', '2024-01-02 15:15:57', 2, '17:15:57', 'US', 'Ashburn'),
(108, '3.76.220.73', '2024-01-03', '2024-01-02 22:57:03', '2024-01-02 22:57:03', 2, '00:57:03', 'DE', 'Frankfurt am Main'),
(109, '162.55.85.228', '2024-01-05', '2024-01-05 08:47:44', '2024-01-05 08:47:44', 2, '10:47:44', 'DE', 'Falkenstein'),
(110, '54.246.147.41', '2024-01-06', '2024-01-06 06:32:40', '2024-01-06 06:32:40', 2, '08:32:40', 'IE', 'Dublin'),
(111, '95.108.213.243', '2024-01-06', '2024-01-06 20:41:49', '2024-01-06 20:41:49', 2, '22:41:49', 'RU', 'Moscow'),
(112, '213.180.203.44', '2024-01-06', '2024-01-06 20:56:54', '2024-01-06 20:56:54', 2, '22:56:54', 'RU', 'Moscow'),
(113, '162.55.85.228', '2024-01-08', '2024-01-07 22:24:31', '2024-01-07 22:24:31', 2, '00:24:31', 'DE', 'Falkenstein'),
(114, '197.35.211.187', '2024-01-08', '2024-01-08 11:57:06', '2024-01-08 11:57:26', 3, '13:57:26', 'EG', 'Shibīn al Kawm'),
(115, '197.43.40.209', '2024-01-08', '2024-01-08 18:54:00', '2024-01-08 19:07:48', 4, '21:07:48', 'EG', 'Al Maḩallah al Kubrá'),
(116, '197.43.190.159', '2024-01-12', '2024-01-12 16:47:05', '2024-01-12 16:58:48', 3, '18:58:48', 'EG', 'Suez'),
(117, '198.251.73.109', '2024-01-13', '2024-01-13 05:49:15', '2024-01-13 05:49:15', 2, '07:49:15', 'US', 'Kansas City'),
(118, '162.55.85.228', '2024-01-13', '2024-01-13 08:18:41', '2024-01-13 08:18:41', 2, '10:18:41', 'DE', 'Falkenstein'),
(119, '154.236.92.145', '2024-01-14', '2024-01-14 14:15:13', '2024-01-14 14:15:13', 2, '16:15:13', 'EG', 'Cairo'),
(120, '31.167.160.184', '2024-01-14', '2024-01-14 16:02:03', '2024-01-14 16:02:03', 2, '18:02:03', 'SA', 'Jeddah'),
(121, '156.197.41.153', '2024-01-15', '2024-01-15 14:35:26', '2024-01-15 14:40:04', 4, '16:40:04', 'EG', 'Damietta'),
(122, '74.208.2.221', '2024-01-16', '2024-01-16 03:23:14', '2024-01-16 03:23:14', 2, '05:23:14', 'US', 'Kansas City'),
(123, '31.167.160.184', '2024-01-16', '2024-01-16 14:29:10', '2024-01-16 14:31:48', 4, '16:31:48', 'SA', 'Jeddah'),
(124, '50.21.188.68', '2024-01-18', '2024-01-18 02:26:54', '2024-01-18 02:26:54', 2, '04:26:54', 'US', 'Kansas City'),
(125, '50.21.188.64', '2024-01-19', '2024-01-19 15:25:02', '2024-01-19 15:25:02', 2, '17:25:02', 'US', 'Kansas City'),
(126, '197.43.152.16', '2024-01-19', '2024-01-19 15:32:07', '2024-01-19 21:29:51', 4, '23:29:51', 'EG', 'Tanta'),
(127, '50.21.188.97', '2024-01-21', '2024-01-21 02:27:38', '2024-01-21 02:27:38', 2, '04:27:38', 'US', 'Kansas City'),
(128, '50.21.188.38', '2024-01-22', '2024-01-22 08:51:30', '2024-01-22 08:51:30', 2, '10:51:30', 'US', 'Kansas City'),
(129, '50.21.188.55', '2024-01-23', '2024-01-23 16:24:55', '2024-01-23 16:24:55', 2, '18:24:55', 'US', 'Kansas City'),
(130, '50.21.188.99', '2024-01-25', '2024-01-25 07:49:05', '2024-01-25 07:49:05', 2, '09:49:05', 'US', 'Kansas City'),
(131, '54.152.38.224', '2024-01-25', '2024-01-25 12:29:07', '2024-01-25 12:29:07', 2, '14:29:07', 'US', 'Ashburn'),
(132, '197.43.94.180', '2024-01-25', '2024-01-25 13:12:45', '2024-01-25 18:44:38', 4, '20:44:38', 'EG', 'Al Maḩallah al Kubrá'),
(133, '217.55.167.81', '2024-01-25', '2024-01-25 13:44:17', '2024-01-25 13:44:17', 2, '15:44:17', 'EG', 'Cairo'),
(134, '52.167.144.191', '2024-01-25', '2024-01-25 14:56:36', '2024-01-25 14:56:36', 2, '16:56:36', 'US', 'Boydton'),
(135, '66.249.64.100', '2024-01-26', '2024-01-25 23:37:38', '2024-01-25 23:37:38', 2, '01:37:38', 'US', 'Moncks Corner'),
(136, '197.43.96.51', '2024-01-26', '2024-01-26 14:39:22', '2024-01-26 16:06:46', 4, '18:06:46', 'EG', 'Al Maḩallah al Kubrá'),
(137, '40.77.167.59', '2024-01-27', '2024-01-27 06:19:30', '2024-01-27 06:19:30', 2, '08:19:30', 'US', 'Boydton'),
(138, '197.43.52.29', '2024-01-27', '2024-01-27 14:54:41', '2024-01-27 14:54:41', 2, '16:54:41', 'EG', 'Suez'),
(139, '40.77.167.76', '2024-01-28', '2024-01-27 23:06:13', '2024-01-27 23:06:13', 2, '01:06:13', 'US', 'Boydton'),
(140, '154.187.248.168', '2024-01-28', '2024-01-28 08:04:42', '2024-01-28 08:04:42', 2, '10:04:42', 'EG', 'Cairo'),
(141, '156.197.64.255', '2024-01-28', '2024-01-28 08:32:48', '2024-01-28 12:12:54', 7, '14:12:54', 'EG', 'Damietta'),
(142, '54.235.232.52', '2024-01-28', '2024-01-28 10:15:52', '2024-01-28 10:15:52', 2, '12:15:52', 'US', 'Ashburn'),
(143, '74.208.2.179', '2024-01-28', '2024-01-28 13:45:32', '2024-01-28 13:45:32', 2, '15:45:32', 'US', 'Kansas City'),
(144, '44.206.238.207', '2024-01-28', '2024-01-28 16:33:51', '2024-01-28 16:33:51', 2, '18:33:51', 'US', 'Ashburn'),
(145, '197.43.77.210', '2024-01-28', '2024-01-28 17:03:05', '2024-01-28 17:03:05', 2, '19:03:05', 'EG', 'Al Maḩallah al Kubrá'),
(146, '157.55.39.51', '2024-01-28', '2024-01-28 21:48:37', '2024-01-28 21:48:37', 2, '23:48:37', 'US', 'Moses Lake'),
(147, '156.197.29.135', '2024-01-29', '2024-01-29 08:48:56', '2024-01-29 09:13:09', 3, '11:13:09', 'EG', 'Damietta'),
(148, '197.43.87.241', '2024-01-29', '2024-01-29 16:52:52', '2024-01-29 16:52:52', 2, '18:52:52', 'EG', 'Al Maḩallah al Kubrá'),
(149, '207.46.13.78', '2024-01-29', '2024-01-29 18:20:53', '2024-01-29 18:20:53', 2, '20:20:53', 'US', 'Moses Lake'),
(150, '197.43.87.241', '2024-01-29', '2024-01-29 18:44:37', '2024-01-29 18:44:37', 2, '20:44:37', 'EG', 'Hurghada'),
(151, '74.208.2.180', '2024-01-30', '2024-01-30 08:38:59', '2024-01-30 08:38:59', 2, '10:38:59', 'US', 'Kansas City'),
(152, '197.35.197.171', '2024-01-30', '2024-01-30 08:42:00', '2024-01-30 08:42:00', 2, '10:42:00', 'EG', 'Shibīn al Kawm'),
(153, '197.35.194.226', '2024-01-30', '2024-01-30 12:29:40', '2024-01-30 13:13:12', 5, '15:13:12', 'EG', 'Shibīn al Kawm'),
(154, '176.224.140.236', '2024-01-30', '2024-01-30 13:53:57', '2024-01-30 13:53:57', 2, '15:53:57', 'SA', 'Riyadh'),
(155, '197.43.98.26', '2024-01-30', '2024-01-30 17:41:23', '2024-01-30 17:41:23', 2, '19:41:23', 'EG', 'Tanta'),
(156, '51.253.180.4', '2024-01-31', '2024-01-31 07:04:25', '2024-01-31 07:07:46', 3, '09:07:46', 'SA', 'Jeddah'),
(157, '156.197.99.194', '2024-01-31', '2024-01-31 08:34:24', '2024-01-31 08:34:24', 2, '10:34:24', 'EG', 'Munūf'),
(158, '176.224.140.236', '2024-01-31', '2024-01-31 13:31:44', '2024-01-31 13:31:44', 2, '15:31:44', 'SA', 'Riyadh'),
(159, '197.43.163.12', '2024-01-31', '2024-01-31 19:21:09', '2024-01-31 19:22:54', 3, '21:22:54', 'EG', 'Al Maḩallah al Kubrá'),
(160, '156.197.36.190', '2024-02-01', '2024-02-01 08:39:47', '2024-02-01 10:07:01', 3, '12:07:01', 'EG', 'Damietta'),
(161, '85.208.96.198', '2024-02-01', '2024-02-01 13:34:34', '2024-02-01 13:34:34', 2, '15:34:34', 'US', 'Ashburn'),
(162, '3.78.146.173', '2024-02-01', '2024-02-01 14:31:05', '2024-02-01 14:31:05', 2, '16:31:05', 'DE', 'Frankfurt am Main'),
(163, '157.55.39.205', '2024-02-01', '2024-02-01 14:57:02', '2024-02-01 14:57:02', 2, '16:57:02', 'US', 'Moses Lake'),
(164, '197.43.10.131', '2024-02-02', '2024-02-02 21:01:06', '2024-02-02 21:01:06', 2, '23:01:06', 'EG', 'Al Maḩallah al Kubrá'),
(165, '23.22.35.162', '2024-02-04', '2024-02-04 02:42:40', '2024-02-04 02:42:40', 2, '04:42:40', 'US', 'Ashburn'),
(166, '44.193.209.35', '2024-02-04', '2024-02-04 09:50:16', '2024-02-04 09:50:16', 2, '11:50:16', 'US', 'Ashburn'),
(167, '156.197.12.68', '2024-02-04', '2024-02-04 10:27:01', '2024-02-04 10:27:01', 2, '12:27:01', 'EG', 'Damietta'),
(168, '18.234.216.190', '2024-02-04', '2024-02-04 12:53:10', '2024-02-04 12:53:10', 2, '14:53:10', 'US', 'Ashburn'),
(169, '176.224.140.236', '2024-02-04', '2024-02-04 19:00:01', '2024-02-04 19:00:01', 2, '21:00:01', 'SA', 'Riyadh'),
(170, '192.187.125.37', '2024-02-04', '2024-02-04 19:09:36', '2024-02-04 19:11:22', 4, '21:11:22', 'US', 'Kansas City'),
(171, '3.85.135.20', '2024-02-04', '2024-02-04 19:43:16', '2024-02-04 19:43:16', 2, '21:43:16', 'US', 'Ashburn'),
(172, '156.197.33.148', '2024-02-05', '2024-02-05 10:20:21', '2024-02-05 10:20:21', 2, '12:20:21', 'EG', 'Munūf'),
(173, '34.207.207.161', '2024-02-05', '2024-02-05 11:04:44', '2024-02-05 11:04:44', 2, '13:04:44', 'US', 'Ashburn'),
(174, '52.167.144.16', '2024-02-06', '2024-02-06 03:33:44', '2024-02-06 03:33:44', 2, '05:33:44', 'US', 'Boydton'),
(175, '162.55.85.228', '2024-02-06', '2024-02-06 05:03:09', '2024-02-06 05:03:09', 2, '07:03:09', 'DE', 'Falkenstein'),
(176, '156.197.55.233', '2024-02-06', '2024-02-06 08:34:25', '2024-02-06 08:44:57', 3, '10:44:57', 'EG', 'Ţalkhā'),
(177, '18.234.216.190', '2024-02-06', '2024-02-06 14:37:57', '2024-02-06 14:37:57', 2, '16:37:57', 'US', 'Ashburn'),
(178, '156.197.92.192', '2024-02-07', '2024-02-07 08:37:03', '2024-02-07 08:40:01', 3, '10:40:01', 'EG', 'Damietta'),
(179, '192.187.125.37', '2024-02-07', '2024-02-07 08:44:00', '2024-02-07 17:15:48', 3, '19:15:47', 'US', 'Kansas City'),
(180, '185.191.171.12', '2024-02-07', '2024-02-07 10:58:12', '2024-02-07 10:58:12', 2, '12:58:12', 'US', 'Ashburn'),
(181, '156.197.56.35', '2024-02-07', '2024-02-07 14:16:54', '2024-02-07 14:16:54', 2, '16:16:54', 'EG', 'Ţalkhā'),
(182, '197.43.21.118', '2024-02-07', '2024-02-07 16:53:08', '2024-02-07 20:31:11', 5, '22:31:11', 'EG', 'Tanta'),
(183, '197.43.94.144', '2024-02-07', '2024-02-07 20:32:26', '2024-02-07 20:32:50', 3, '22:32:50', 'EG', 'Al Maḩallah al Kubrá'),
(184, '52.167.144.191', '2024-02-08', '2024-02-07 22:56:28', '2024-02-07 22:56:28', 2, '00:56:28', 'US', 'Boydton'),
(185, '162.55.85.228', '2024-02-08', '2024-02-08 07:50:56', '2024-02-08 07:50:56', 2, '09:50:56', 'DE', 'Falkenstein'),
(186, '156.197.1.36', '2024-02-08', '2024-02-08 08:50:56', '2024-02-08 08:50:56', 2, '10:50:56', 'EG', 'Ţalkhā'),
(187, '52.167.144.176', '2024-02-09', '2024-02-09 00:47:54', '2024-02-09 00:47:54', 2, '02:47:54', 'US', 'Boydton'),
(188, '197.43.121.86', '2024-02-09', '2024-02-09 06:57:18', '2024-02-09 06:57:18', 2, '08:57:18', 'EG', 'Tanta'),
(189, '52.165.149.97', '2024-02-10', '2024-02-10 07:27:47', '2024-02-10 07:27:47', 2, '09:27:47', 'US', 'Des Moines'),
(190, '197.43.123.180', '2024-02-10', '2024-02-10 09:00:00', '2024-02-10 09:00:00', 2, '11:00:00', 'EG', 'Suez'),
(191, '197.43.37.16', '2024-02-10', '2024-02-10 13:22:43', '2024-02-10 13:22:43', 2, '15:22:43', 'EG', 'Al Maḩallah al Kubrá'),
(192, '85.208.96.212', '2024-02-10', '2024-02-10 20:10:35', '2024-02-10 20:10:35', 2, '22:10:35', 'US', 'Ashburn'),
(193, '20.169.168.224', '2024-02-11', '2024-02-11 07:01:34', '2024-02-11 07:01:34', 2, '09:01:34', 'US', 'Ashburn'),
(194, '156.197.88.17', '2024-02-11', '2024-02-11 09:03:15', '2024-02-11 09:03:15', 2, '11:03:15', 'EG', 'Damietta'),
(195, '197.43.57.210', '2024-02-11', '2024-02-11 17:00:01', '2024-02-11 17:00:01', 2, '19:00:01', 'EG', 'Al Maḩallah al Kubrá'),
(196, '156.197.50.46', '2024-02-12', '2024-02-12 12:08:30', '2024-02-12 12:15:57', 6, '14:15:57', 'EG', 'Damietta'),
(197, '197.43.21.71', '2024-02-12', '2024-02-12 16:14:31', '2024-02-12 16:14:31', 2, '18:14:31', 'EG', 'Tanta'),
(198, '20.169.168.224', '2024-02-12', '2024-02-12 20:05:05', '2024-02-12 20:09:04', 4, '22:09:04', 'US', 'Ashburn'),
(199, '40.94.90.75', '2024-02-12', '2024-02-12 20:39:01', '2024-02-12 20:39:01', 2, '22:39:01', 'NL', 'Amsterdam'),
(200, '156.197.20.79', '2024-02-13', '2024-02-13 08:36:44', '2024-02-13 13:29:49', 3, '15:29:49', 'EG', 'Munūf'),
(201, '197.43.6.248', '2024-02-13', '2024-02-13 16:46:57', '2024-02-13 16:46:57', 2, '18:46:57', 'EG', 'Al Maḩallah al Kubrá'),
(202, '162.55.85.228', '2024-02-14', '2024-02-14 02:15:41', '2024-02-14 02:15:41', 2, '04:15:41', 'DE', 'Falkenstein'),
(203, '156.197.78.181', '2024-02-14', '2024-02-14 08:40:45', '2024-02-14 08:40:45', 2, '10:40:45', 'EG', 'Ţalkhā'),
(204, '197.32.22.234', '2024-02-14', '2024-02-14 09:34:58', '2024-02-14 09:34:58', 2, '11:34:58', 'EG', 'Banhā'),
(205, '207.46.13.168', '2024-02-14', '2024-02-14 19:10:10', '2024-02-14 19:10:10', 2, '21:10:10', 'US', 'Moses Lake'),
(206, '156.197.23.14', '2024-02-15', '2024-02-15 08:49:16', '2024-02-15 08:49:16', 2, '10:49:16', 'EG', 'Ţalkhā'),
(207, '197.43.100.153', '2024-02-15', '2024-02-15 18:23:41', '2024-02-15 18:23:41', 2, '20:23:41', 'EG', 'Tanta'),
(208, '52.167.144.184', '2024-02-16', '2024-02-16 04:14:41', '2024-02-16 04:14:41', 2, '06:14:41', 'US', 'Boydton'),
(209, '52.167.144.235', '2024-02-18', '2024-02-17 22:06:20', '2024-02-17 22:06:20', 2, '00:06:20', 'US', 'Boydton'),
(210, '52.167.144.228', '2024-02-20', '2024-02-20 02:06:42', '2024-02-20 02:06:42', 2, '04:06:42', 'US', 'Boydton'),
(211, '52.167.144.192', '2024-02-23', '2024-02-23 08:52:01', '2024-02-23 08:52:01', 2, '10:52:01', 'US', 'Boydton'),
(212, '136.243.220.214', '2024-02-23', '2024-02-23 09:03:44', '2024-02-23 09:03:44', 2, '11:03:44', 'DE', 'Falkenstein'),
(213, '74.208.2.232', '2024-02-24', '2024-02-24 02:38:38', '2024-02-24 02:38:38', 2, '04:38:38', 'US', 'Kansas City'),
(214, '::1', '2024-02-25', '2024-02-25 17:54:06', '2024-02-25 20:10:33', 10, '22:10:33', '0', '0'),
(215, '::1', '2024-02-26', '2024-02-26 09:05:34', '2024-02-26 14:24:50', 31, '16:24:50', '0', '0'),
(216, '::1', '2024-02-27', '2024-02-27 08:48:20', '2024-02-27 19:19:34', 32, '21:19:34', '0', '0'),
(217, '::1', '2024-02-28', '2024-02-27 22:09:55', '2024-02-28 20:09:07', 34, '22:09:07', '0', '0'),
(218, '::1', '2024-02-29', '2024-02-29 09:02:09', '2024-02-29 11:36:39', 10, '13:36:39', '0', '0'),
(219, '::1', '2024-03-02', '2024-03-02 13:08:16', '2024-03-02 19:47:55', 42, '21:47:55', '0', '0'),
(220, '::1', '2024-03-03', '2024-03-03 09:04:36', '2024-03-03 10:34:12', 22, '12:34:12', '0', '0'),
(221, '217.52.228.40', '2024-03-03', '2024-03-03 12:05:20', '2024-03-03 14:39:31', 8, '16:39:31', 'EG', 'Cairo'),
(222, '34.205.135.69', '2024-03-03', '2024-03-03 12:47:23', '2024-03-03 12:47:23', 2, '14:47:23', 'US', 'Ashburn'),
(223, '197.43.56.35', '2024-03-03', '2024-03-03 12:49:06', '2024-03-03 20:52:32', 40, '22:52:32', 'EG', 'Al Maḩallah al Kubrá'),
(224, '45.242.171.80', '2024-03-03', '2024-03-03 12:57:00', '2024-03-03 17:30:46', 30, '19:30:46', 'EG', 'Alexandria'),
(225, '217.55.164.149', '2024-03-03', '2024-03-03 18:22:45', '2024-03-03 19:22:38', 32, '21:22:38', 'EG', 'Cairo'),
(226, '66.249.93.172', '2024-03-03', '2024-03-03 20:58:21', '2024-03-03 20:58:22', 3, '22:58:22', 'BE', 'Brussels'),
(227, '66.249.93.165', '2024-03-03', '2024-03-03 20:58:27', '2024-03-03 20:58:46', 3, '22:58:46', 'BE', 'Brussels'),
(228, '66.249.93.163', '2024-03-03', '2024-03-03 20:58:28', '2024-03-03 20:58:28', 2, '22:58:28', 'BE', 'Brussels'),
(229, '66.249.93.164', '2024-03-03', '2024-03-03 20:58:43', '2024-03-03 20:58:43', 2, '22:58:43', 'BE', 'Brussels'),
(230, '172.255.48.133', '2024-03-03', '2024-03-03 20:59:11', '2024-03-03 20:59:35', 4, '22:59:35', 'CA', 'Vancouver'),
(231, '104.192.142.240', '2024-03-04', '2024-03-04 09:29:09', '2024-03-04 09:29:09', 2, '11:29:09', 'US', 'Reston'),
(232, '44.192.4.49', '2024-03-04', '2024-03-04 09:29:11', '2024-03-04 09:29:11', 2, '11:29:11', 'US', 'Ashburn'),
(233, '196.134.54.176', '2024-03-04', '2024-03-04 10:26:48', '2024-03-04 10:26:48', 2, '12:26:48', 'EG', 'Ţalkhā'),
(234, '196.134.53.197', '2024-03-04', '2024-03-04 14:53:13', '2024-03-04 14:53:13', 2, '16:53:13', 'EG', 'Ţalkhā'),
(235, '34.207.207.161', '2024-03-04', '2024-03-04 15:50:32', '2024-03-04 15:50:32', 2, '17:50:32', 'US', 'Ashburn'),
(236, '197.162.60.212', '2024-03-04', '2024-03-04 19:28:49', '2024-03-04 19:28:49', 2, '21:28:49', 'EG', 'Alexandria'),
(237, '197.43.97.206', '2024-03-04', '2024-03-04 21:46:27', '2024-03-04 21:48:18', 3, '23:48:18', 'EG', 'Al Maḩallah al Kubrá'),
(238, '197.162.60.212', '2024-03-05', '2024-03-04 22:03:10', '2024-03-04 22:03:22', 3, '00:03:22', 'EG', 'Alexandria'),
(239, '156.197.34.141', '2024-03-05', '2024-03-05 08:38:02', '2024-03-05 14:35:04', 67, '16:35:04', 'EG', 'Ţalkhā'),
(240, '34.224.97.54', '2024-03-05', '2024-03-05 10:40:29', '2024-03-05 10:40:29', 2, '12:40:29', 'US', 'Ashburn'),
(241, '66.249.93.173', '2024-03-05', '2024-03-05 10:41:28', '2024-03-05 10:41:28', 2, '12:41:28', 'BE', 'Brussels'),
(242, '66.249.93.172', '2024-03-05', '2024-03-05 10:41:30', '2024-03-05 10:41:30', 2, '12:41:30', 'BE', 'Brussels'),
(243, '66.102.9.35', '2024-03-05', '2024-03-05 10:41:35', '2024-03-05 10:41:35', 2, '12:41:35', 'FI', 'Hamina'),
(244, '66.102.9.36', '2024-03-05', '2024-03-05 10:41:35', '2024-03-05 10:41:54', 3, '12:41:54', 'FI', 'Hamina'),
(245, '66.102.9.37', '2024-03-05', '2024-03-05 10:41:54', '2024-03-05 10:41:54', 2, '12:41:54', 'FI', 'Hamina'),
(246, '44.192.33.131', '2024-03-05', '2024-03-05 14:33:50', '2024-03-05 14:33:50', 2, '16:33:50', 'US', 'Ashburn'),
(247, '154.187.243.125', '2024-03-05', '2024-03-05 15:35:21', '2024-03-05 15:41:13', 6, '17:41:13', 'EG', 'Cairo'),
(248, '197.43.56.16', '2024-03-05', '2024-03-05 18:17:00', '2024-03-05 19:31:48', 5, '21:31:48', 'EG', 'Al Maḩallah al Kubrá'),
(249, '45.242.193.235', '2024-03-05', '2024-03-05 19:09:31', '2024-03-05 21:06:26', 14, '23:06:26', 'EG', 'Alexandria'),
(250, '197.35.215.44', '2024-03-06', '2024-03-06 08:52:28', '2024-03-06 13:53:10', 33, '15:53:10', 'EG', 'Al Mansurah'),
(251, '156.197.60.233', '2024-03-06', '2024-03-06 09:42:21', '2024-03-06 09:42:21', 2, '11:42:21', 'EG', 'Ţalkhā'),
(252, '197.120.163.138', '2024-03-06', '2024-03-06 16:05:59', '2024-03-06 17:43:20', 20, '19:43:20', 'EG', 'Cairo'),
(253, '197.43.105.67', '2024-03-06', '2024-03-06 17:08:36', '2024-03-06 18:12:38', 9, '20:12:38', 'EG', 'Tanta'),
(254, '197.35.211.68', '2024-03-07', '2024-03-07 08:33:21', '2024-03-07 14:37:56', 35, '16:37:56', 'EG', 'Ţalkhā'),
(255, '196.134.29.90', '2024-03-07', '2024-03-07 15:44:42', '2024-03-07 15:47:04', 4, '17:47:04', 'EG', 'Ţalkhā'),
(256, '154.187.224.119', '2024-03-07', '2024-03-07 15:46:15', '2024-03-07 15:48:14', 5, '17:48:14', 'EG', 'Cairo'),
(257, '197.43.30.233', '2024-03-07', '2024-03-07 18:25:51', '2024-03-07 20:32:44', 16, '22:32:44', 'EG', 'Al Maḩallah al Kubrá'),
(258, '62.139.193.62', '2024-03-07', '2024-03-07 18:38:40', '2024-03-07 20:46:21', 6, '22:46:21', 'EG', 'Cairo'),
(259, '45.242.182.96', '2024-03-07', '2024-03-07 19:46:23', '2024-03-07 21:19:41', 5, '23:19:41', 'EG', 'Alexandria'),
(260, '197.43.10.195', '2024-03-08', '2024-03-08 06:18:14', '2024-03-08 09:56:35', 6, '11:56:35', 'EG', 'Al Maḩallah al Kubrá'),
(261, '50.17.28.216', '2024-03-08', '2024-03-08 12:41:49', '2024-03-08 12:41:49', 2, '14:41:49', 'US', 'Ashburn'),
(262, '197.162.209.103', '2024-03-08', '2024-03-08 12:41:57', '2024-03-08 16:36:42', 10, '18:36:42', 'EG', 'Alexandria'),
(263, '196.134.0.123', '2024-03-08', '2024-03-08 12:42:53', '2024-03-08 12:50:30', 7, '14:50:30', 'EG', 'Ţalkhā'),
(264, '197.43.47.154', '2024-03-09', '2024-03-09 14:12:00', '2024-03-09 14:40:34', 4, '16:40:34', 'EG', 'Al Maḩallah al Kubrá'),
(265, '197.43.102.151', '2024-03-10', '2024-03-09 22:52:26', '2024-03-09 22:52:33', 4, '00:52:33', 'EG', 'Suez'),
(266, '197.35.237.147', '2024-03-10', '2024-03-10 09:10:54', '2024-03-10 14:48:03', 154, '16:48:03', 'EG', 'Ţalkhā'),
(267, '52.90.161.130', '2024-03-10', '2024-03-10 10:14:39', '2024-03-10 10:14:39', 2, '12:14:39', 'US', 'Ashburn'),
(268, '41.176.32.217', '2024-03-10', '2024-03-10 11:00:19', '2024-03-10 11:51:57', 9, '13:51:57', 'EG', 'Cairo'),
(269, '3.94.200.225', '2024-03-10', '2024-03-10 11:00:32', '2024-03-10 11:00:32', 2, '13:00:32', 'US', 'Ashburn'),
(270, '154.239.241.195', '2024-03-10', '2024-03-10 12:43:16', '2024-03-10 14:21:42', 21, '16:21:42', 'EG', 'Cairo'),
(271, '27.115.124.53', '2024-03-10', '2024-03-10 12:44:00', '2024-03-10 12:44:00', 2, '14:44:00', 'CN', 'Shanghai'),
(272, '66.249.93.172', '2024-03-10', '2024-03-10 14:24:14', '2024-03-10 14:24:14', 2, '16:24:14', 'BE', 'Brussels'),
(273, '66.249.93.174', '2024-03-10', '2024-03-10 14:24:16', '2024-03-10 14:24:16', 2, '16:24:16', 'BE', 'Brussels'),
(274, '74.125.208.5', '2024-03-10', '2024-03-10 14:24:20', '2024-03-10 14:24:20', 2, '16:24:20', 'NL', 'Delfzijl'),
(275, '66.102.9.35', '2024-03-10', '2024-03-10 14:24:21', '2024-03-10 14:24:21', 2, '16:24:21', 'FI', 'Hamina'),
(276, '74.125.208.6', '2024-03-10', '2024-03-10 14:24:40', '2024-03-10 14:24:40', 2, '16:24:40', 'NL', 'Delfzijl'),
(277, '66.102.9.37', '2024-03-10', '2024-03-10 14:24:42', '2024-03-10 14:24:42', 2, '16:24:42', 'FI', 'Hamina'),
(278, '197.43.196.105', '2024-03-10', '2024-03-10 17:52:54', '2024-03-10 20:13:46', 13, '22:13:46', 'EG', 'Tanta'),
(279, '156.197.140.233', '2024-03-10', '2024-03-10 18:04:43', '2024-03-10 18:25:22', 10, '20:25:22', 'EG', 'Ţalkhā'),
(280, '102.190.68.85', '2024-03-10', '2024-03-10 18:05:33', '2024-03-10 18:55:04', 23, '20:55:04', 'EG', 'Cairo'),
(281, '2.48.78.112', '2024-03-10', '2024-03-10 18:12:38', '2024-03-10 18:13:05', 3, '20:13:05', 'AE', 'Sharjah'),
(282, '5.38.15.105', '2024-03-10', '2024-03-10 20:50:56', '2024-03-10 20:50:56', 2, '22:50:56', 'AE', 'Sharjah'),
(283, '197.43.196.105', '2024-03-11', '2024-03-10 23:25:21', '2024-03-11 17:26:38', 57, '19:26:38', 'EG', 'Tanta'),
(284, '217.52.187.195', '2024-03-11', '2024-03-11 11:05:07', '2024-03-11 14:40:39', 30, '16:40:39', 'EG', 'Cairo'),
(285, '3.91.240.58', '2024-03-11', '2024-03-11 14:07:45', '2024-03-11 14:07:45', 2, '16:07:45', 'US', 'Ashburn'),
(286, '54.221.96.20', '2024-03-11', '2024-03-11 14:07:45', '2024-03-11 14:07:45', 2, '16:07:45', 'US', 'Ashburn'),
(287, '102.190.68.85', '2024-03-11', '2024-03-11 14:12:29', '2024-03-11 14:12:29', 2, '16:12:29', 'EG', 'Cairo'),
(288, '156.197.112.50', '2024-03-12', '2024-03-12 08:39:17', '2024-03-12 13:14:38', 145, '15:14:38', 'EG', 'Ţalkhā'),
(289, '44.197.248.103', '2024-03-12', '2024-03-12 08:41:27', '2024-03-12 08:41:27', 2, '10:41:27', 'US', 'Ashburn'),
(290, '34.230.10.9', '2024-03-12', '2024-03-12 08:41:28', '2024-03-12 08:41:28', 2, '10:41:28', 'US', 'Ashburn'),
(291, '44.192.23.226', '2024-03-12', '2024-03-12 09:56:07', '2024-03-12 09:56:07', 2, '11:56:07', 'US', 'Ashburn'),
(292, '44.200.103.25', '2024-03-12', '2024-03-12 12:48:34', '2024-03-12 12:48:34', 2, '14:48:34', 'US', 'Ashburn'),
(293, '44.220.86.56', '2024-03-12', '2024-03-12 12:48:35', '2024-03-12 12:48:35', 2, '14:48:35', 'US', 'Ashburn'),
(294, '156.197.51.68', '2024-03-12', '2024-03-12 14:06:14', '2024-03-12 14:43:17', 25, '16:43:17', 'EG', 'Ţalkhā'),
(295, '44.211.191.47', '2024-03-12', '2024-03-12 14:11:19', '2024-03-12 14:11:19', 2, '16:11:19', 'US', 'Ashburn'),
(296, '44.200.184.225', '2024-03-12', '2024-03-12 14:11:20', '2024-03-12 14:11:20', 2, '16:11:20', 'US', 'Ashburn'),
(297, '197.35.248.9', '2024-03-12', '2024-03-12 15:12:10', '2024-03-12 15:12:10', 2, '17:12:10', 'EG', 'Ţalkhā'),
(298, '45.242.20.48', '2024-03-12', '2024-03-12 17:06:34', '2024-03-12 18:20:10', 5, '20:20:10', 'EG', 'Alexandria'),
(299, '154.190.73.126', '2024-03-13', '2024-03-13 08:28:34', '2024-03-13 08:28:47', 3, '10:28:47', 'EG', 'Cairo'),
(300, '156.197.51.68', '2024-03-13', '2024-03-13 08:41:53', '2024-03-13 08:51:54', 8, '10:51:54', 'EG', 'Ţalkhā'),
(301, '156.197.12.135', '2024-03-13', '2024-03-13 08:56:50', '2024-03-13 14:20:29', 125, '16:20:29', 'EG', 'Ţalkhā'),
(302, '66.249.93.166', '2024-03-13', '2024-03-13 09:54:27', '2024-03-13 09:54:27', 2, '11:54:27', 'BE', 'Brussels'),
(303, '66.249.93.167', '2024-03-13', '2024-03-13 09:54:28', '2024-03-13 09:54:28', 2, '11:54:28', 'BE', 'Brussels'),
(304, '74.125.208.14', '2024-03-13', '2024-03-13 09:54:33', '2024-03-13 09:54:33', 2, '11:54:33', 'NL', 'Delfzijl'),
(305, '74.125.208.13', '2024-03-13', '2024-03-13 09:54:33', '2024-03-13 09:54:50', 3, '11:54:50', 'NL', 'Delfzijl'),
(306, '74.125.208.15', '2024-03-13', '2024-03-13 09:54:48', '2024-03-13 09:54:48', 2, '11:54:48', 'NL', 'Delfzijl'),
(307, '18.208.203.57', '2024-03-13', '2024-03-13 11:38:04', '2024-03-13 11:38:04', 2, '13:38:04', 'US', 'Ashburn'),
(308, '104.192.142.247', '2024-03-13', '2024-03-13 11:40:58', '2024-03-13 11:40:58', 2, '13:40:58', 'US', 'Reston'),
(309, '3.84.96.232', '2024-03-13', '2024-03-13 11:41:00', '2024-03-13 11:41:00', 2, '13:41:00', 'US', 'Ashburn'),
(310, '172.255.48.136', '2024-03-13', '2024-03-13 11:45:47', '2024-03-13 11:46:17', 4, '13:46:17', 'CA', 'Vancouver'),
(311, '156.197.140.233', '2024-03-13', '2024-03-13 12:45:13', '2024-03-13 14:18:32', 8, '16:18:32', 'EG', 'Ţalkhā'),
(312, '92.99.132.241', '2024-03-13', '2024-03-13 13:06:09', '2024-03-13 16:29:10', 5, '18:29:10', 'AE', 'Sharjah'),
(313, '196.134.1.210', '2024-03-13', '2024-03-13 13:12:50', '2024-03-13 13:12:50', 2, '15:12:50', 'EG', 'Al Mansurah'),
(314, '31.219.43.31', '2024-03-13', '2024-03-13 14:16:58', '2024-03-13 14:16:58', 2, '16:16:58', 'AE', 'Sharjah'),
(315, '156.197.205.206', '2024-03-13', '2024-03-13 14:25:00', '2024-03-13 14:26:20', 3, '16:26:20', 'EG', 'Ţalkhā'),
(316, '192.34.62.146', '2024-03-13', '2024-03-13 15:30:05', '2024-03-13 15:30:06', 3, '17:30:06', 'US', 'North Bergen'),
(317, '43.134.37.211', '2024-03-13', '2024-03-13 16:37:29', '2024-03-13 16:37:29', 2, '18:37:29', 'SG', 'Singapore'),
(318, '197.43.210.158', '2024-03-13', '2024-03-13 16:47:55', '2024-03-13 16:47:55', 2, '18:47:55', 'EG', 'Al Maḩallah al Kubrá'),
(319, '182.40.104.255', '2024-03-13', '2024-03-13 17:52:37', '2024-03-13 17:52:37', 2, '19:52:37', 'CN', 'Qingdao'),
(320, '197.43.86.85', '2024-03-13', '2024-03-13 17:58:07', '2024-03-13 18:02:25', 5, '20:02:25', 'EG', 'Suez'),
(321, '40.77.167.71', '2024-03-13', '2024-03-13 18:34:18', '2024-03-13 18:34:20', 3, '20:34:20', 'US', 'Boydton'),
(322, '170.106.82.193', '2024-03-13', '2024-03-13 20:35:03', '2024-03-13 20:35:03', 2, '22:35:03', 'US', 'Mountain View'),
(323, '103.216.223.204', '2024-03-13', '2024-03-13 21:46:53', '2024-03-13 21:46:58', 4, '23:46:58', 'SG', 'Singapore'),
(324, '123.60.68.42', '2024-03-14', '2024-03-14 00:11:55', '2024-03-14 00:11:55', 2, '02:11:55', 'CN', 'Shanghai'),
(325, '43.130.7.211', '2024-03-14', '2024-03-14 02:27:20', '2024-03-14 02:27:20', 2, '04:27:20', 'US', 'Santa Clara'),
(326, '178.254.24.91', '2024-03-14', '2024-03-14 02:32:22', '2024-03-14 02:32:22', 2, '04:32:22', 'DE', 'Frankfurt am Main'),
(327, '34.208.170.233', '2024-03-14', '2024-03-14 02:52:19', '2024-03-14 02:52:19', 2, '04:52:19', 'US', 'Boardman'),
(328, '193.31.105.219', '2024-03-14', '2024-03-14 03:36:37', '2024-03-14 03:36:37', 2, '05:36:37', 'US', 'Miami'),
(329, '18.117.140.186', '2024-03-14', '2024-03-14 03:40:11', '2024-03-14 03:40:16', 6, '05:40:16', 'US', 'Columbus'),
(330, '36.133.35.23', '2024-03-14', '2024-03-14 03:53:58', '2024-03-14 03:53:58', 2, '05:53:58', 'CN', 'Shanghai'),
(331, '129.226.146.179', '2024-03-14', '2024-03-14 04:25:37', '2024-03-14 04:25:37', 2, '06:25:37', 'SG', 'Singapore'),
(332, '52.81.67.84', '2024-03-14', '2024-03-14 05:28:59', '2024-03-14 14:43:09', 3, '16:43:09', 'CN', 'Beijing'),
(333, '135.148.195.1', '2024-03-14', '2024-03-14 06:54:47', '2024-03-14 06:54:47', 2, '08:54:47', 'US', 'Ashburn'),
(334, '156.197.12.135', '2024-03-14', '2024-03-14 09:59:36', '2024-03-14 09:59:36', 2, '11:59:36', 'EG', 'Ţalkhā'),
(335, '193.233.233.29', '2024-03-14', '2024-03-14 11:56:38', '2024-03-14 11:56:38', 2, '13:56:38', 'AT', 'Vienna'),
(336, '5.133.192.136', '2024-03-14', '2024-03-14 13:35:30', '2024-03-14 13:35:30', 2, '15:35:30', 'SE', 'Stockholm'),
(337, '60.188.57.0', '2024-03-14', '2024-03-14 13:59:02', '2024-03-14 13:59:02', 2, '15:59:02', 'CN', 'Hangzhou'),
(338, '43.134.37.211', '2024-03-14', '2024-03-14 16:38:11', '2024-03-14 16:38:11', 2, '18:38:11', 'SG', 'Singapore'),
(339, '154.187.37.115', '2024-03-14', '2024-03-14 17:02:36', '2024-03-14 17:03:13', 4, '19:03:13', 'EG', 'Cairo'),
(340, '129.226.158.26', '2024-03-14', '2024-03-14 20:19:43', '2024-03-14 20:19:43', 2, '22:19:43', 'SG', 'Singapore'),
(341, '34.222.203.181', '2024-03-14', '2024-03-14 20:50:40', '2024-03-14 20:50:40', 2, '22:50:40', 'US', 'Boardman'),
(342, '137.226.113.44', '2024-03-15', '2024-03-14 22:00:51', '2024-03-14 22:00:51', 2, '00:00:51', 'DE', 'Aachen'),
(343, '103.216.223.204', '2024-03-15', '2024-03-14 23:03:44', '2024-03-14 23:03:49', 4, '01:03:49', 'SG', 'Singapore'),
(344, '43.163.8.36', '2024-03-15', '2024-03-14 23:55:13', '2024-03-14 23:55:13', 2, '01:55:13', 'SG', 'Singapore'),
(345, '43.159.128.68', '2024-03-15', '2024-03-15 02:38:27', '2024-03-15 20:37:22', 3, '22:37:22', 'US', 'Santa Clara'),
(346, '208.80.194.41', '2024-03-15', '2024-03-15 03:15:47', '2024-03-15 03:15:47', 2, '05:15:47', 'US', 'Dearing'),
(347, '193.233.233.29', '2024-03-15', '2024-03-15 03:26:59', '2024-03-15 03:26:59', 2, '05:26:59', 'AT', 'Vienna'),
(348, '35.161.220.190', '2024-03-15', '2024-03-15 04:35:56', '2024-03-15 04:35:56', 2, '06:35:56', 'US', 'Boardman'),
(349, '43.153.93.68', '2024-03-15', '2024-03-15 04:56:41', '2024-03-15 04:56:41', 2, '06:56:41', 'US', 'Santa Clara'),
(350, '34.73.43.92', '2024-03-15', '2024-03-15 07:52:15', '2024-03-15 07:52:15', 2, '09:52:15', 'US', 'North Charleston'),
(351, '192.42.116.219', '2024-03-15', '2024-03-15 09:46:46', '2024-03-15 09:46:46', 2, '11:46:46', 'NL', 'Amsterdam'),
(352, '36.111.67.189', '2024-03-15', '2024-03-15 10:19:55', '2024-03-15 10:19:55', 2, '12:19:55', 'CN', 'Chengdu'),
(353, '35.94.86.254', '2024-03-15', '2024-03-15 11:01:42', '2024-03-15 11:01:42', 2, '13:01:42', 'US', 'Boardman'),
(354, '52.167.144.212', '2024-03-15', '2024-03-15 12:06:08', '2024-03-15 12:06:08', 2, '14:06:08', 'US', 'Boydton'),
(355, '104.131.67.73', '2024-03-15', '2024-03-15 14:36:09', '2024-03-15 14:36:11', 3, '16:36:11', 'US', 'Clifton'),
(356, '43.133.77.208', '2024-03-15', '2024-03-15 16:37:26', '2024-03-15 16:37:26', 2, '18:37:26', 'KR', 'Seoul'),
(357, '199.244.88.219', '2024-03-15', '2024-03-15 17:08:34', '2024-03-15 17:08:34', 2, '19:08:34', 'US', 'Chicago'),
(358, '52.31.120.191', '2024-03-15', '2024-03-15 17:20:43', '2024-03-15 17:20:43', 2, '19:20:43', 'IE', 'Dublin'),
(359, '197.43.20.150', '2024-03-15', '2024-03-15 19:23:45', '2024-03-15 20:03:13', 6, '22:03:13', 'EG', 'Al Maḩallah al Kubrá'),
(360, '113.141.91.58', '2024-03-15', '2024-03-15 20:35:14', '2024-03-15 20:35:14', 2, '22:35:14', 'CN', 'Xi’an'),
(361, '34.162.195.207', '2024-03-15', '2024-03-15 20:57:48', '2024-03-15 20:57:48', 2, '22:57:48', 'US', 'Columbus'),
(362, '89.187.163.201', '2024-03-16', '2024-03-16 00:26:39', '2024-03-16 00:26:44', 4, '02:26:44', 'SG', 'Singapore'),
(363, '43.155.152.154', '2024-03-16', '2024-03-16 02:41:15', '2024-03-16 02:41:15', 2, '04:41:15', 'KR', 'Seoul'),
(364, '43.131.48.214', '2024-03-16', '2024-03-16 04:56:03', '2024-03-16 04:56:03', 2, '06:56:03', 'DE', 'Frankfurt am Main'),
(365, '52.167.144.238', '2024-03-16', '2024-03-16 05:03:11', '2024-03-16 05:03:11', 2, '07:03:11', 'US', 'Boydton'),
(366, '197.43.20.150', '2024-03-16', '2024-03-16 06:32:59', '2024-03-16 06:34:20', 3, '08:34:20', 'EG', 'Al Maḩallah al Kubrá'),
(367, '35.171.144.152', '2024-03-16', '2024-03-16 07:14:41', '2024-03-16 07:14:41', 2, '09:14:41', 'US', 'Ashburn'),
(368, '54.88.179.33', '2024-03-16', '2024-03-16 07:14:42', '2024-03-16 07:14:43', 3, '09:14:43', 'US', 'Ashburn'),
(369, '43.128.100.206', '2024-03-16', '2024-03-16 07:19:24', '2024-03-16 07:19:24', 2, '09:19:24', 'SG', 'Singapore'),
(370, '52.201.30.147', '2024-03-16', '2024-03-16 08:15:42', '2024-03-16 08:15:42', 2, '10:15:42', 'US', 'Ashburn'),
(371, '52.201.30.147', '2024-03-16', '2024-03-16 08:15:42', '2024-03-16 08:15:42', 2, '10:15:42', 'US', 'Ashburn'),
(372, '54.89.67.210', '2024-03-16', '2024-03-16 08:16:34', '2024-03-16 08:16:34', 2, '10:16:34', 'US', 'Ashburn'),
(373, '107.175.13.196', '2024-03-16', '2024-03-16 10:17:18', '2024-03-16 10:17:18', 2, '12:17:18', 'US', 'Dallas'),
(374, '34.221.8.38', '2024-03-16', '2024-03-16 11:10:02', '2024-03-16 11:10:02', 2, '13:10:02', 'US', 'Boardman'),
(375, '193.233.233.29', '2024-03-16', '2024-03-16 12:04:32', '2024-03-16 12:04:32', 2, '14:04:32', 'AT', 'Vienna'),
(376, '196.150.47.159', '2024-03-16', '2024-03-16 16:22:21', '2024-03-16 16:22:21', 2, '18:22:21', 'EG', 'Tanta'),
(377, '43.135.129.233', '2024-03-16', '2024-03-16 16:43:53', '2024-03-16 16:43:53', 2, '18:43:53', 'US', 'Santa Clara'),
(378, '130.255.166.24', '2024-03-16', '2024-03-16 17:27:17', '2024-03-16 17:27:17', 2, '19:27:17', 'SE', 'Stockholm'),
(379, '198.235.24.77', '2024-03-16', '2024-03-16 17:41:17', '2024-03-16 17:41:17', 2, '19:41:17', 'TW', 'Taichung'),
(380, '205.210.31.169', '2024-03-16', '2024-03-16 18:42:41', '2024-03-16 18:42:41', 2, '20:42:41', 'BR', 'São Paulo'),
(381, '43.135.166.178', '2024-03-16', '2024-03-16 20:43:06', '2024-03-16 20:43:06', 2, '22:43:06', 'US', 'Santa Clara'),
(382, '205.210.31.35', '2024-03-17', '2024-03-16 23:57:17', '2024-03-16 23:57:17', 2, '01:57:17', 'US', 'Council Bluffs'),
(383, '205.210.31.15', '2024-03-17', '2024-03-17 01:02:41', '2024-03-17 01:02:42', 2, '03:02:42', 'US', 'Council Bluffs'),
(384, '170.106.104.42', '2024-03-17', '2024-03-17 02:36:13', '2024-03-17 02:36:13', 2, '04:36:13', 'US', 'Mountain View'),
(385, '89.187.163.201', '2024-03-17', '2024-03-17 02:37:31', '2024-03-17 02:37:36', 4, '04:37:36', 'SG', 'Singapore'),
(386, '199.45.155.49', '2024-03-17', '2024-03-17 02:48:25', '2024-03-17 02:48:25', 2, '04:48:25', 'HK', 'Hong Kong'),
(387, '182.42.110.255', '2024-03-17', '2024-03-17 02:48:57', '2024-03-17 02:48:57', 2, '04:48:57', 'CN', 'Qingdao'),
(388, '193.233.233.29', '2024-03-17', '2024-03-17 03:09:16', '2024-03-17 03:09:16', 2, '05:09:16', 'AT', 'Vienna'),
(389, '199.45.155.17', '2024-03-17', '2024-03-17 04:39:03', '2024-03-17 04:39:03', 2, '06:39:03', 'HK', 'Hong Kong'),
(390, '43.135.129.233', '2024-03-17', '2024-03-17 04:42:08', '2024-03-17 04:42:08', 2, '06:42:08', 'US', 'Santa Clara'),
(391, '154.190.170.205', '2024-03-17', '2024-03-17 07:59:44', '2024-03-17 08:00:46', 6, '10:00:46', 'EG', 'Cairo'),
(392, '52.167.144.24', '2024-03-17', '2024-03-17 08:49:10', '2024-03-17 08:49:10', 2, '10:49:10', 'US', 'Boydton'),
(393, '52.158.250.227', '2024-03-17', '2024-03-17 10:09:46', '2024-03-17 10:20:05', 3, '12:20:05', 'US', 'Moses Lake'),
(394, '198.235.24.164', '2024-03-17', '2024-03-17 12:16:16', '2024-03-17 12:16:16', 2, '14:16:16', 'BE', 'Brussels'),
(395, '185.220.101.71', '2024-03-17', '2024-03-17 12:27:29', '2024-03-17 12:27:29', 2, '14:27:29', 'DE', 'Berlin'),
(396, '36.133.172.82', '2024-03-17', '2024-03-17 13:11:20', '2024-03-17 13:11:20', 2, '15:11:20', 'CN', 'Shanghai'),
(397, '161.35.79.223', '2024-03-17', '2024-03-17 13:16:04', '2024-03-17 13:16:05', 3, '15:16:05', 'DE', 'Frankfurt am Main'),
(398, '156.197.29.117', '2024-03-17', '2024-03-17 14:19:02', '2024-03-17 14:35:48', 19, '16:35:48', 'EG', 'Ţalkhā'),
(399, '27.115.124.53', '2024-03-17', '2024-03-17 14:22:29', '2024-03-17 14:22:29', 2, '16:22:29', 'CN', 'Shanghai'),
(400, '27.115.124.6', '2024-03-17', '2024-03-17 14:24:10', '2024-03-17 14:24:10', 2, '16:24:10', 'CN', 'Shanghai'),
(401, '172.255.48.132', '2024-03-17', '2024-03-17 14:33:00', '2024-03-17 14:33:35', 4, '16:33:35', 'CA', 'Vancouver'),
(402, '43.133.66.151', '2024-03-17', '2024-03-17 16:36:45', '2024-03-17 16:36:45', 2, '18:36:45', 'KR', 'Seoul'),
(403, '34.162.98.126', '2024-03-17', '2024-03-17 18:29:02', '2024-03-17 18:29:02', 2, '20:29:02', 'US', 'Columbus'),
(404, '43.159.128.149', '2024-03-17', '2024-03-17 20:28:51', '2024-03-17 20:28:51', 2, '22:28:51', 'US', 'Santa Clara'),
(405, '106.227.49.113', '2024-03-18', '2024-03-17 22:58:34', '2024-03-17 22:58:34', 2, '00:58:34', 'CN', 'Nanchang'),
(406, '205.210.31.134', '2024-03-18', '2024-03-18 01:01:22', '2024-03-18 01:01:22', 2, '03:01:22', 'BR', 'São Paulo'),
(407, '43.131.48.214', '2024-03-18', '2024-03-18 02:50:19', '2024-03-18 04:52:36', 3, '06:52:36', 'DE', 'Frankfurt am Main'),
(408, '89.187.163.201', '2024-03-18', '2024-03-18 04:47:29', '2024-03-18 04:47:34', 4, '06:47:34', 'SG', 'Singapore'),
(409, '36.133.172.82', '2024-03-18', '2024-03-18 09:24:02', '2024-03-18 09:24:02', 2, '11:24:02', 'CN', 'Shanghai'),
(410, '199.45.155.34', '2024-03-18', '2024-03-18 09:54:47', '2024-03-18 09:54:47', 2, '11:54:47', 'HK', 'Hong Kong'),
(411, '52.81.237.92', '2024-03-18', '2024-03-18 12:27:07', '2024-03-18 12:27:07', 2, '14:27:07', 'CN', 'Beijing'),
(412, '199.45.155.19', '2024-03-18', '2024-03-18 12:40:44', '2024-03-18 12:40:44', 2, '14:40:44', 'HK', 'Hong Kong'),
(413, '197.43.181.119', '2024-03-18', '2024-03-18 14:33:03', '2024-03-18 15:39:42', 6, '17:39:42', 'EG', 'Al Maḩallah al Kubrá'),
(414, '44.200.209.28', '2024-03-18', '2024-03-18 16:11:29', '2024-03-18 16:11:29', 2, '18:11:29', 'US', 'Ashburn'),
(415, '43.159.128.149', '2024-03-18', '2024-03-18 16:43:14', '2024-03-18 16:43:14', 2, '18:43:14', 'US', 'Santa Clara'),
(416, '34.162.104.195', '2024-03-18', '2024-03-18 17:48:25', '2024-03-18 17:48:25', 2, '19:48:25', 'US', 'Columbus'),
(417, '43.155.183.138', '2024-03-18', '2024-03-18 18:28:19', '2024-03-18 18:28:19', 2, '20:28:19', 'KR', 'Seoul'),
(418, '43.135.129.233', '2024-03-18', '2024-03-18 20:52:42', '2024-03-18 20:52:42', 2, '22:52:42', 'US', 'Santa Clara'),
(419, '128.90.170.38', '2024-03-19', '2024-03-18 22:18:00', '2024-03-18 23:12:14', 3, '01:12:14', 'NL', 'Amsterdam'),
(420, '38.122.112.147', '2024-03-19', '2024-03-18 22:35:30', '2024-03-18 22:35:30', 2, '00:35:30', 'US', 'Chicago'),
(421, '178.211.57.76', '2024-03-19', '2024-03-18 22:49:32', '2024-03-18 22:49:32', 2, '00:49:32', 'TR', 'Istanbul'),
(422, '65.49.2.30', '2024-03-19', '2024-03-18 22:50:37', '2024-03-18 22:50:37', 2, '00:50:37', 'US', 'Fremont'),
(423, '42.83.147.34', '2024-03-19', '2024-03-18 23:04:06', '2024-03-18 23:04:06', 2, '01:04:06', 'CN', 'Beijing'),
(424, '43.133.66.151', '2024-03-19', '2024-03-19 02:33:47', '2024-03-19 02:33:47', 2, '04:33:47', 'KR', 'Seoul'),
(425, '43.134.66.205', '2024-03-19', '2024-03-19 03:59:34', '2024-03-19 03:59:34', 2, '05:59:34', 'SG', 'Singapore'),
(426, '43.135.166.178', '2024-03-19', '2024-03-19 04:51:16', '2024-03-19 04:51:16', 2, '06:51:16', 'US', 'Santa Clara'),
(427, '143.198.80.211', '2024-03-19', '2024-03-19 05:01:12', '2024-03-19 05:01:16', 4, '07:01:16', 'SG', 'Singapore'),
(428, '89.187.163.201', '2024-03-19', '2024-03-19 06:03:18', '2024-03-19 06:03:23', 4, '08:03:23', 'SG', 'Singapore'),
(429, '45.242.179.44', '2024-03-19', '2024-03-19 08:25:04', '2024-03-19 10:25:22', 4, '12:25:22', 'EG', 'Alexandria'),
(430, '41.176.191.187', '2024-03-19', '2024-03-19 11:57:19', '2024-03-19 11:57:26', 3, '13:57:26', 'EG', 'Cairo'),
(431, '43.163.8.36', '2024-03-19', '2024-03-19 13:27:17', '2024-03-19 13:27:17', 2, '15:27:17', 'SG', 'Singapore'),
(432, '159.89.45.156', '2024-03-19', '2024-03-19 14:15:58', '2024-03-19 14:15:59', 3, '16:15:59', 'US', 'Clifton'),
(433, '92.99.132.241', '2024-03-19', '2024-03-19 14:34:57', '2024-03-19 17:57:12', 4, '19:57:12', 'AE', 'Sharjah'),
(434, '65.154.226.166', '2024-03-19', '2024-03-19 15:48:08', '2024-03-19 15:48:08', 2, '17:48:08', 'US', 'Dallas'),
(435, '94.156.64.15', '2024-03-19', '2024-03-19 16:15:12', '2024-03-19 16:15:12', 2, '18:15:12', 'NL', 'Amsterdam'),
(436, '185.220.101.16', '2024-03-19', '2024-03-19 16:37:38', '2024-03-19 16:37:38', 2, '18:37:38', 'DE', 'Berlin'),
(437, '43.131.44.218', '2024-03-19', '2024-03-19 16:38:30', '2024-03-19 16:38:30', 2, '18:38:30', 'DE', 'Frankfurt am Main'),
(438, '34.162.155.206', '2024-03-19', '2024-03-19 16:40:08', '2024-03-19 16:40:08', 2, '18:40:08', 'US', 'Columbus'),
(439, '197.43.181.119', '2024-03-19', '2024-03-19 17:45:47', '2024-03-19 17:45:47', 2, '19:45:47', 'EG', 'Al Maḩallah al Kubrá'),
(440, '37.19.195.75', '2024-03-19', '2024-03-19 20:09:24', '2024-03-19 20:09:26', 3, '22:09:26', 'AT', 'Vienna'),
(441, '43.157.40.112', '2024-03-19', '2024-03-19 20:36:10', '2024-03-19 20:36:10', 2, '22:36:10', 'DE', 'Frankfurt am Main'),
(442, '5.38.108.135', '2024-03-19', '2024-03-19 21:01:41', '2024-03-19 21:35:37', 5, '23:35:37', 'AE', 'Sharjah'),
(443, '111.172.249.49', '2024-03-20', '2024-03-19 22:42:42', '2024-03-20 08:25:12', 3, '10:25:12', 'CN', 'Wuhan'),
(444, '51.254.199.11', '2024-03-20', '2024-03-20 01:21:47', '2024-03-20 01:21:47', 2, '03:21:47', 'FR', 'Lille');
INSERT INTO `trackers` (`id`, `ip`, `date`, `created_at`, `updated_at`, `hits`, `visit_time`, `country`, `city`) VALUES
(445, '44.222.62.235', '2024-03-20', '2024-03-20 01:57:04', '2024-03-20 01:57:04', 2, '03:57:04', 'US', 'Ashburn'),
(446, '43.130.39.101', '2024-03-20', '2024-03-20 02:52:29', '2024-03-20 02:52:29', 2, '04:52:29', 'US', 'Santa Clara'),
(447, '128.90.141.17', '2024-03-20', '2024-03-20 04:45:04', '2024-03-20 06:35:31', 3, '08:35:31', 'NL', 'Amsterdam'),
(448, '43.155.152.154', '2024-03-20', '2024-03-20 05:08:05', '2024-03-20 16:43:33', 3, '18:43:33', 'KR', 'Seoul'),
(449, '44.234.231.186', '2024-03-20', '2024-03-20 06:36:56', '2024-03-20 06:36:56', 2, '08:36:56', 'US', 'Boardman'),
(450, '93.158.91.24', '2024-03-20', '2024-03-20 07:29:05', '2024-03-20 07:29:05', 2, '09:29:05', 'SE', 'Nyköping'),
(451, '156.197.29.117', '2024-03-20', '2024-03-20 08:42:37', '2024-03-20 14:44:17', 24, '16:44:17', 'EG', 'Ţalkhā'),
(452, '89.187.163.201', '2024-03-20', '2024-03-20 09:35:26', '2024-03-20 09:35:32', 4, '11:35:32', 'SG', 'Singapore'),
(453, '92.99.132.241', '2024-03-20', '2024-03-20 13:02:47', '2024-03-20 13:30:52', 7, '15:30:52', 'AE', 'Sharjah'),
(454, '176.123.2.160', '2024-03-20', '2024-03-20 15:46:11', '2024-03-20 15:46:11', 2, '17:46:11', 'MD', 'Chisinau'),
(455, '34.162.175.138', '2024-03-20', '2024-03-20 16:02:50', '2024-03-20 16:02:50', 2, '18:02:50', 'US', 'Columbus'),
(456, '129.226.158.26', '2024-03-20', '2024-03-20 17:46:26', '2024-03-20 17:46:26', 2, '19:46:26', 'SG', 'Singapore'),
(457, '178.62.74.6', '2024-03-20', '2024-03-20 18:02:04', '2024-03-20 18:02:04', 2, '20:02:04', 'GB', 'London'),
(458, '43.134.89.111', '2024-03-20', '2024-03-20 20:32:50', '2024-03-20 20:32:50', 2, '22:32:50', 'SG', 'Singapore'),
(459, '138.199.60.185', '2024-03-20', '2024-03-20 21:10:17', '2024-03-20 21:10:22', 4, '23:10:22', 'SG', 'Singapore'),
(460, '139.59.124.215', '2024-03-21', '2024-03-21 00:53:47', '2024-03-21 00:53:51', 4, '02:53:51', 'SG', 'Singapore'),
(461, '43.131.62.4', '2024-03-21', '2024-03-21 02:30:57', '2024-03-21 02:30:57', 2, '04:30:57', 'DE', 'Frankfurt am Main'),
(462, '135.148.195.12', '2024-03-21', '2024-03-21 03:25:03', '2024-03-21 03:25:03', 2, '05:25:03', 'US', 'Ashburn'),
(463, '175.6.217.4', '2024-03-21', '2024-03-21 04:24:14', '2024-03-21 04:24:14', 2, '06:24:14', 'CN', 'Changsha'),
(464, '170.106.101.31', '2024-03-21', '2024-03-21 05:26:56', '2024-03-21 05:26:56', 2, '07:26:56', 'US', 'Mountain View'),
(465, '65.154.226.168', '2024-03-21', '2024-03-21 05:31:20', '2024-03-21 05:31:20', 2, '07:31:20', 'US', 'Dallas'),
(466, '52.81.237.92', '2024-03-21', '2024-03-21 08:15:22', '2024-03-21 08:15:22', 2, '10:15:22', 'CN', 'Beijing'),
(467, '52.80.95.20', '2024-03-21', '2024-03-21 08:15:36', '2024-03-21 08:15:36', 2, '10:15:36', 'CN', 'Beijing'),
(468, '156.197.29.117', '2024-03-21', '2024-03-21 12:26:12', '2024-03-21 13:02:53', 5, '15:02:53', 'EG', 'Ţalkhā'),
(469, '43.135.149.154', '2024-03-21', '2024-03-21 14:44:46', '2024-03-21 14:44:46', 2, '16:44:46', 'US', 'Santa Clara'),
(470, '154.186.31.166', '2024-03-21', '2024-03-21 15:34:45', '2024-03-21 15:55:16', 8, '17:55:16', 'EG', 'Cairo'),
(471, '138.197.170.181', '2024-03-21', '2024-03-21 15:38:16', '2024-03-21 15:38:17', 3, '17:38:17', 'CA', 'Toronto'),
(472, '192.175.111.232', '2024-03-21', '2024-03-21 15:58:31', '2024-03-21 15:58:31', 2, '17:58:31', 'CA', 'Montréal'),
(473, '64.15.129.109', '2024-03-21', '2024-03-21 15:58:35', '2024-03-21 15:58:35', 2, '17:58:35', 'CA', 'Laval'),
(474, '192.175.111.242', '2024-03-21', '2024-03-21 15:58:36', '2024-03-21 15:58:36', 2, '17:58:36', 'CA', 'Montréal'),
(475, '192.175.111.231', '2024-03-21', '2024-03-21 15:58:37', '2024-03-21 15:58:37', 2, '17:58:37', 'CA', 'Montréal'),
(476, '197.43.186.20', '2024-03-21', '2024-03-21 16:38:35', '2024-03-21 16:52:06', 3, '18:52:06', 'EG', 'Tanta'),
(477, '129.226.146.179', '2024-03-21', '2024-03-21 16:44:19', '2024-03-21 16:44:19', 2, '18:44:19', 'SG', 'Singapore'),
(478, '43.130.62.164', '2024-03-21', '2024-03-21 20:24:39', '2024-03-21 20:24:39', 2, '22:24:39', 'US', 'Santa Clara'),
(479, '138.199.60.185', '2024-03-21', '2024-03-21 20:54:53', '2024-03-21 20:54:58', 4, '22:54:58', 'SG', 'Singapore'),
(480, '34.16.175.59', '2024-03-21', '2024-03-21 21:03:34', '2024-03-21 21:03:34', 2, '23:03:34', 'US', 'Las Vegas'),
(481, '137.226.113.44', '2024-03-21', '2024-03-21 21:43:36', '2024-03-21 21:43:36', 2, '23:43:36', 'DE', 'Aachen'),
(482, '198.235.24.228', '2024-03-22', '2024-03-21 23:47:33', '2024-03-21 23:47:33', 2, '01:47:33', 'BE', 'Brussels'),
(483, '222.79.103.59', '2024-03-22', '2024-03-22 00:29:57', '2024-03-22 00:29:57', 2, '02:29:57', 'CN', 'Xiamen'),
(484, '212.132.99.18', '2024-03-22', '2024-03-22 02:25:13', '2024-03-22 02:25:13', 2, '04:25:13', 'DE', 'Karlsruhe'),
(485, '199.45.154.65', '2024-03-22', '2024-03-22 02:43:55', '2024-03-22 02:43:55', 2, '04:43:55', 'HK', 'Hong Kong'),
(486, '43.131.62.4', '2024-03-22', '2024-03-22 02:54:14', '2024-03-22 02:54:14', 2, '04:54:14', 'DE', 'Frankfurt am Main'),
(487, '43.134.37.211', '2024-03-22', '2024-03-22 04:26:28', '2024-03-22 04:26:28', 2, '06:26:28', 'SG', 'Singapore'),
(488, '199.45.155.49', '2024-03-22', '2024-03-22 05:20:32', '2024-03-22 05:20:32', 2, '07:20:32', 'HK', 'Hong Kong'),
(489, '208.80.194.41', '2024-03-22', '2024-03-22 06:25:32', '2024-03-22 06:25:32', 2, '08:25:32', 'US', 'Dearing'),
(490, '204.101.161.19', '2024-03-22', '2024-03-22 07:09:59', '2024-03-22 07:09:59', 2, '09:09:59', 'CA', 'Burnaby'),
(491, '34.162.173.125', '2024-03-22', '2024-03-22 09:39:02', '2024-03-22 09:39:02', 2, '11:39:02', 'US', 'Columbus'),
(492, '36.134.147.75', '2024-03-22', '2024-03-22 10:29:03', '2024-03-22 10:29:03', 2, '12:29:03', 'CN', 'Shanghai'),
(493, '197.43.73.136', '2024-03-22', '2024-03-22 12:14:17', '2024-03-22 12:15:09', 3, '14:15:09', 'EG', 'Tanta'),
(494, '137.184.140.0', '2024-03-22', '2024-03-22 13:01:29', '2024-03-22 13:01:30', 3, '15:01:30', 'US', 'North Bergen'),
(495, '43.153.93.68', '2024-03-22', '2024-03-22 16:53:17', '2024-03-22 16:53:17', 2, '18:53:17', 'US', 'Santa Clara'),
(496, '198.235.24.95', '2024-03-22', '2024-03-22 17:06:08', '2024-03-22 17:06:08', 2, '19:06:08', 'TW', 'Taichung'),
(497, '178.254.12.183', '2024-03-22', '2024-03-22 17:31:17', '2024-03-22 17:31:17', 2, '19:31:17', 'DE', 'Frankfurt am Main'),
(498, '93.158.91.244', '2024-03-22', '2024-03-22 18:03:56', '2024-03-22 18:03:56', 2, '20:03:56', 'SE', 'Nyköping'),
(499, '43.131.48.214', '2024-03-22', '2024-03-22 18:59:37', '2024-03-22 18:59:37', 2, '20:59:37', 'DE', 'Frankfurt am Main'),
(500, '138.199.60.185', '2024-03-22', '2024-03-22 20:18:09', '2024-03-22 20:18:14', 4, '22:18:14', 'SG', 'Singapore'),
(501, '43.131.248.209', '2024-03-22', '2024-03-22 20:43:28', '2024-03-22 20:43:28', 2, '22:43:28', 'KR', 'Seoul'),
(502, '93.100.144.207', '2024-03-22', '2024-03-22 21:58:05', '2024-03-22 21:58:05', 2, '23:58:05', 'RU', 'Saint Petersburg'),
(503, '198.235.24.211', '2024-03-23', '2024-03-22 23:20:28', '2024-03-22 23:20:28', 2, '01:20:28', 'BE', 'Brussels'),
(504, '100.26.54.205', '2024-03-23', '2024-03-23 02:26:49', '2024-03-23 02:26:49', 2, '04:26:49', 'US', 'Ashburn'),
(505, '170.106.159.160', '2024-03-23', '2024-03-23 02:27:11', '2024-03-23 02:27:11', 2, '04:27:11', 'US', 'San Jose'),
(506, '54.88.179.33', '2024-03-23', '2024-03-23 03:05:28', '2024-03-23 07:48:59', 6, '09:48:59', 'US', 'Ashburn'),
(507, '43.130.7.211', '2024-03-23', '2024-03-23 04:25:12', '2024-03-23 04:25:12', 2, '06:25:12', 'US', 'Santa Clara'),
(508, '36.133.172.82', '2024-03-23', '2024-03-23 05:36:41', '2024-03-23 05:36:41', 2, '07:36:41', 'CN', 'Shanghai'),
(509, '35.171.144.152', '2024-03-23', '2024-03-23 07:48:58', '2024-03-23 07:48:58', 2, '09:48:58', 'US', 'Ashburn'),
(510, '198.235.24.100', '2024-03-23', '2024-03-23 08:25:29', '2024-03-23 08:25:29', 2, '10:25:29', 'TW', 'Taichung'),
(511, '159.253.120.5', '2024-03-23', '2024-03-23 08:55:51', '2024-03-23 08:55:51', 2, '10:55:51', 'MD', 'Chisinau'),
(512, '64.23.185.222', '2024-03-23', '2024-03-23 09:09:28', '2024-03-23 09:09:31', 4, '11:09:31', 'US', 'Santa Clara'),
(513, '197.43.14.240', '2024-03-23', '2024-03-23 11:09:18', '2024-03-23 15:49:19', 5, '17:49:19', 'EG', 'Al Maḩallah al Kubrá'),
(514, '165.232.106.124', '2024-03-23', '2024-03-23 13:52:21', '2024-03-23 13:52:22', 3, '15:52:22', 'GB', 'London'),
(515, '36.133.35.23', '2024-03-23', '2024-03-23 14:35:53', '2024-03-23 14:35:53', 2, '16:35:53', 'CN', 'Shanghai'),
(516, '198.235.24.139', '2024-03-23', '2024-03-23 16:54:01', '2024-03-23 16:54:01', 2, '18:54:01', 'BE', 'Brussels'),
(517, '43.157.66.187', '2024-03-23', '2024-03-23 17:04:17', '2024-03-23 17:04:17', 2, '19:04:17', 'DE', 'Frankfurt am Main'),
(518, '92.99.142.144', '2024-03-23', '2024-03-23 18:37:41', '2024-03-23 18:38:36', 3, '20:38:36', 'AE', 'Sharjah'),
(519, '104.28.131.93', '2024-03-23', '2024-03-23 18:48:22', '2024-03-23 20:03:16', 4, '22:03:16', 'KW', 'Kuwait City'),
(520, '138.199.60.185', '2024-03-23', '2024-03-23 19:45:43', '2024-03-23 19:45:49', 4, '21:45:49', 'SG', 'Singapore'),
(521, '43.159.141.180', '2024-03-23', '2024-03-23 20:32:59', '2024-03-23 20:32:59', 2, '22:32:59', 'US', 'Santa Clara'),
(522, '157.55.39.9', '2024-03-24', '2024-03-23 23:49:28', '2024-03-23 23:49:28', 2, '01:49:28', 'US', 'Moses Lake'),
(523, '43.133.66.151', '2024-03-24', '2024-03-24 00:31:03', '2024-03-24 00:31:03', 2, '02:31:03', 'KR', 'Seoul'),
(524, '5.75.225.234', '2024-03-24', '2024-03-24 01:13:17', '2024-03-24 01:13:17', 2, '03:13:17', 'DE', 'Falkenstein'),
(525, '43.134.89.111', '2024-03-24', '2024-03-24 02:37:42', '2024-03-24 04:34:15', 3, '06:34:15', 'SG', 'Singapore'),
(526, '93.191.29.99', '2024-03-24', '2024-03-24 06:17:37', '2024-03-24 06:17:37', 2, '08:17:37', 'GB', 'Crowthorne'),
(527, '156.197.75.128', '2024-03-24', '2024-03-24 09:04:04', '2024-03-24 14:26:28', 3, '16:26:28', 'EG', 'Damietta'),
(528, '34.239.151.27', '2024-03-24', '2024-03-24 09:52:59', '2024-03-24 09:52:59', 2, '11:52:59', 'US', 'Ashburn'),
(529, '23.104.161.82', '2024-03-24', '2024-03-24 10:43:21', '2024-03-24 10:43:21', 2, '12:43:21', 'US', 'Los Angeles'),
(530, '36.134.147.75', '2024-03-24', '2024-03-24 11:27:55', '2024-03-24 11:27:55', 2, '13:27:55', 'CN', 'Shanghai'),
(531, '205.210.31.133', '2024-03-24', '2024-03-24 15:13:14', '2024-03-24 15:13:15', 2, '17:13:15', 'BR', 'São Paulo'),
(532, '43.157.40.112', '2024-03-24', '2024-03-24 17:06:08', '2024-03-24 17:06:08', 2, '19:06:08', 'DE', 'Frankfurt am Main'),
(533, '13.232.74.70', '2024-03-24', '2024-03-24 18:40:17', '2024-03-24 18:40:17', 2, '20:40:17', 'IN', 'Mumbai'),
(534, '103.216.223.204', '2024-03-24', '2024-03-24 18:54:59', '2024-03-24 18:55:03', 4, '20:55:03', 'SG', 'Singapore'),
(535, '43.130.37.62', '2024-03-24', '2024-03-24 20:33:26', '2024-03-24 21:55:49', 3, '23:55:49', 'US', 'Santa Clara'),
(536, '43.134.37.211', '2024-03-25', '2024-03-25 02:35:42', '2024-03-25 02:35:42', 2, '04:35:42', 'SG', 'Singapore'),
(537, '43.134.89.111', '2024-03-25', '2024-03-25 04:18:58', '2024-03-25 04:18:58', 2, '06:18:58', 'SG', 'Singapore'),
(538, '46.19.138.210', '2024-03-25', '2024-03-25 07:31:56', '2024-03-25 07:31:56', 2, '09:31:56', 'IT', 'Milan'),
(539, '117.62.235.53', '2024-03-25', '2024-03-25 08:37:40', '2024-03-25 08:37:40', 2, '10:37:40', 'CN', 'Nanjing'),
(540, '197.43.14.240', '2024-03-25', '2024-03-25 09:26:49', '2024-03-25 14:29:39', 6, '16:29:39', 'EG', 'Al Maḩallah al Kubrá'),
(541, '34.162.243.34', '2024-03-25', '2024-03-25 11:40:58', '2024-03-25 11:40:58', 2, '13:40:58', 'US', 'Columbus'),
(542, '92.99.142.144', '2024-03-25', '2024-03-25 12:20:13', '2024-03-25 15:49:34', 8, '17:49:34', 'AE', 'Sharjah'),
(543, '157.55.39.9', '2024-03-25', '2024-03-25 12:38:41', '2024-03-25 12:38:41', 2, '14:38:41', 'US', 'Moses Lake'),
(544, '207.46.13.6', '2024-03-25', '2024-03-25 14:22:57', '2024-03-25 14:22:57', 2, '16:22:57', 'US', 'Moses Lake'),
(545, '207.46.13.14', '2024-03-25', '2024-03-25 14:59:22', '2024-03-25 14:59:22', 2, '16:59:22', 'US', 'Moses Lake'),
(546, '164.92.232.121', '2024-03-25', '2024-03-25 15:44:18', '2024-03-25 15:44:19', 3, '17:44:19', 'DE', 'Frankfurt am Main'),
(547, '43.131.248.209', '2024-03-25', '2024-03-25 17:07:46', '2024-03-25 17:07:46', 2, '19:07:46', 'KR', 'Seoul'),
(548, '43.159.128.172', '2024-03-25', '2024-03-25 19:05:37', '2024-03-25 19:05:37', 2, '21:05:37', 'US', 'Santa Clara'),
(549, '104.28.131.93', '2024-03-25', '2024-03-25 20:22:15', '2024-03-25 20:36:55', 3, '22:36:55', 'KW', 'Kuwait City'),
(550, '104.28.131.92', '2024-03-25', '2024-03-25 20:27:06', '2024-03-25 20:27:38', 3, '22:27:38', 'KW', 'Kuwait City'),
(551, '198.235.24.38', '2024-03-26', '2024-03-25 22:01:38', '2024-03-25 22:01:38', 2, '00:01:38', 'TW', 'Taichung'),
(552, '46.19.138.210', '2024-03-26', '2024-03-25 23:15:20', '2024-03-25 23:15:20', 2, '01:15:20', 'IT', 'Milan'),
(553, '5.133.192.88', '2024-03-26', '2024-03-26 01:38:09', '2024-03-26 01:38:09', 2, '03:38:09', 'SE', 'Stockholm'),
(554, '205.210.31.166', '2024-03-26', '2024-03-26 03:23:28', '2024-03-26 03:23:28', 2, '05:23:28', 'BR', 'São Paulo'),
(555, '193.27.90.63', '2024-03-26', '2024-03-26 04:19:39', '2024-03-26 04:19:39', 2, '06:19:39', 'NL', 'Zwolle'),
(556, '49.51.206.130', '2024-03-26', '2024-03-26 05:57:09', '2024-03-26 05:57:09', 2, '07:57:09', 'US', 'San Jose'),
(557, '52.81.80.21', '2024-03-26', '2024-03-26 07:39:25', '2024-03-26 07:39:25', 2, '09:39:25', 'CN', 'Beijing'),
(558, '156.197.52.173', '2024-03-26', '2024-03-26 08:55:33', '2024-03-26 08:55:33', 2, '10:55:33', 'EG', 'Damietta'),
(559, '20.65.168.203', '2024-03-26', '2024-03-26 09:04:53', '2024-03-26 09:04:56', 4, '11:04:56', 'US', 'San Antonio'),
(560, '52.81.185.110', '2024-03-26', '2024-03-26 09:38:36', '2024-03-26 09:38:36', 2, '11:38:36', 'CN', 'Beijing'),
(561, '34.125.157.250', '2024-03-26', '2024-03-26 10:22:54', '2024-03-26 10:22:56', 4, '12:22:56', 'US', 'Las Vegas'),
(562, '54.188.108.226', '2024-03-26', '2024-03-26 12:14:27', '2024-03-26 12:14:27', 2, '14:14:27', 'US', 'Boardman'),
(563, '18.236.70.110', '2024-03-26', '2024-03-26 12:14:40', '2024-03-26 12:14:40', 2, '14:14:40', 'US', 'Boardman'),
(564, '45.242.253.228', '2024-03-26', '2024-03-26 13:14:45', '2024-03-26 15:09:54', 9, '17:09:54', 'EG', 'Alexandria'),
(565, '92.99.142.144', '2024-03-26', '2024-03-26 13:55:59', '2024-03-26 15:24:52', 9, '17:24:52', 'AE', 'Sharjah'),
(566, '40.77.167.77', '2024-03-26', '2024-03-26 14:25:10', '2024-03-26 14:25:10', 2, '16:25:10', 'US', 'Boydton'),
(567, '40.77.167.32', '2024-03-26', '2024-03-26 14:41:14', '2024-03-26 15:12:40', 3, '17:12:40', 'US', 'Boydton'),
(568, '40.77.167.136', '2024-03-26', '2024-03-26 15:38:04', '2024-03-26 15:38:04', 2, '17:38:04', 'US', 'Boydton'),
(569, '185.220.101.31', '2024-03-26', '2024-03-26 17:15:38', '2024-03-26 17:15:38', 2, '19:15:38', 'DE', 'Berlin'),
(570, '87.236.20.91', '2024-03-27', '2024-03-26 22:40:45', '2024-03-26 22:40:45', 2, '00:40:45', 'RU', 'Saint Petersburg'),
(571, '125.94.144.102', '2024-03-27', '2024-03-27 00:43:37', '2024-03-27 00:43:37', 2, '02:43:37', 'CN', 'Shenzhen'),
(572, '198.235.24.71', '2024-03-27', '2024-03-27 09:31:57', '2024-03-27 09:31:57', 2, '11:31:57', 'TW', 'Taichung'),
(573, '197.35.242.127', '2024-03-27', '2024-03-27 09:43:53', '2024-03-27 13:55:35', 11, '15:55:35', 'EG', 'Ţalkhā'),
(574, '34.127.36.104', '2024-03-27', '2024-03-27 09:57:59', '2024-03-27 09:58:02', 4, '11:58:02', 'US', 'The Dalles'),
(575, '23.236.247.118', '2024-03-27', '2024-03-27 10:31:21', '2024-03-27 10:31:22', 3, '12:31:22', 'US', 'Los Angeles'),
(576, '43.133.77.208', '2024-03-27', '2024-03-27 11:19:55', '2024-03-27 11:19:55', 2, '13:19:55', 'KR', 'Seoul'),
(577, '5.188.62.21', '2024-03-27', '2024-03-27 11:54:58', '2024-03-27 11:55:07', 3, '13:55:07', 'RU', 'Saint Petersburg'),
(578, '172.255.48.144', '2024-03-27', '2024-03-27 13:44:35', '2024-03-27 13:45:06', 4, '15:45:06', 'CA', 'Vancouver'),
(579, '165.227.40.118', '2024-03-27', '2024-03-27 14:02:05', '2024-03-27 14:02:06', 3, '16:02:06', 'CA', 'Toronto'),
(580, '23.26.108.89', '2024-03-27', '2024-03-27 16:04:03', '2024-03-27 16:04:04', 2, '18:04:04', 'US', 'Newark'),
(581, '199.244.88.228', '2024-03-27', '2024-03-27 18:18:30', '2024-03-27 18:18:30', 2, '20:18:30', 'US', 'Chicago'),
(582, '135.148.195.15', '2024-03-27', '2024-03-27 21:27:45', '2024-03-27 21:27:45', 2, '23:27:45', 'US', 'Ashburn'),
(583, '109.245.225.39', '2024-03-28', '2024-03-27 22:23:13', '2024-03-27 22:23:28', 3, '00:23:28', 'RS', 'Belgrade'),
(584, '198.235.24.115', '2024-03-28', '2024-03-27 22:25:32', '2024-03-27 22:25:32', 2, '00:25:32', 'TW', 'Taichung'),
(585, '123.60.68.42', '2024-03-28', '2024-03-28 00:27:13', '2024-03-28 00:27:13', 2, '02:27:13', 'CN', 'Shanghai'),
(586, '18.197.97.14', '2024-03-28', '2024-03-28 01:18:45', '2024-03-28 01:33:51', 3, '03:33:51', 'DE', 'Frankfurt am Main'),
(587, '136.243.228.198', '2024-03-28', '2024-03-28 03:01:12', '2024-03-28 03:01:12', 2, '05:01:12', 'DE', 'Falkenstein'),
(588, '141.94.174.211', '2024-03-28', '2024-03-28 03:39:38', '2024-03-28 03:39:38', 2, '05:39:38', 'FR', 'Lille'),
(589, '23.26.108.89', '2024-03-28', '2024-03-28 04:52:31', '2024-03-28 04:52:34', 4, '06:52:34', 'US', 'Newark'),
(590, '36.133.172.82', '2024-03-28', '2024-03-28 05:53:22', '2024-03-28 05:53:22', 2, '07:53:22', 'CN', 'Shanghai'),
(591, '17.241.227.24', '2024-03-28', '2024-03-28 06:31:22', '2024-03-28 06:31:22', 2, '08:31:22', 'US', 'Cupertino'),
(592, '17.241.219.40', '2024-03-28', '2024-03-28 06:53:52', '2024-03-28 06:53:52', 2, '08:53:52', 'US', 'Cupertino'),
(593, '109.245.32.39', '2024-03-28', '2024-03-28 07:18:28', '2024-03-28 07:18:28', 2, '09:18:28', 'RS', 'Belgrade'),
(594, '3.17.37.36', '2024-03-28', '2024-03-28 07:25:10', '2024-03-28 07:25:10', 2, '09:25:10', 'US', 'Columbus'),
(595, '93.158.90.71', '2024-03-28', '2024-03-28 08:20:42', '2024-03-28 08:20:42', 2, '10:20:42', 'SE', 'Nyköping'),
(596, '17.241.227.163', '2024-03-28', '2024-03-28 08:39:35', '2024-03-28 08:39:35', 2, '10:39:35', 'US', 'Cupertino'),
(597, '17.241.75.185', '2024-03-28', '2024-03-28 08:41:20', '2024-03-28 08:41:20', 2, '10:41:20', 'US', 'Cupertino'),
(598, '197.35.242.127', '2024-03-28', '2024-03-28 09:32:17', '2024-03-28 11:01:33', 6, '13:01:33', 'EG', 'Ţalkhā'),
(599, '199.45.154.64', '2024-03-28', '2024-03-28 10:07:26', '2024-03-28 10:07:26', 2, '12:07:26', 'HK', 'Hong Kong'),
(600, '34.125.18.79', '2024-03-28', '2024-03-28 10:50:24', '2024-03-28 10:50:26', 4, '12:50:26', 'US', 'Las Vegas'),
(601, '51.161.15.95', '2024-03-28', '2024-03-28 11:23:13', '2024-03-28 11:23:13', 2, '13:23:13', 'CA', 'Beauharnois'),
(602, '197.35.242.127', '2024-03-31', '2024-03-31 09:22:17', '2024-03-31 12:33:16', 3, '14:33:16', 'EG', 'Ţalkhā'),
(603, '197.43.109.137', '2024-04-02', '2024-04-02 08:54:28', '2024-04-02 18:24:21', 22, '20:24:21', 'EG', 'Al Maḩallah al Kubrá'),
(604, '3.234.251.132', '2024-04-02', '2024-04-02 11:28:31', '2024-04-02 11:28:31', 2, '13:28:31', 'US', 'Ashburn'),
(605, '154.236.88.23', '2024-04-02', '2024-04-02 11:30:14', '2024-04-02 16:18:25', 25, '18:18:25', 'EG', 'Cairo'),
(606, '197.160.192.156', '2024-04-02', '2024-04-02 11:57:50', '2024-04-02 12:04:23', 3, '14:04:23', 'EG', 'Alexandria'),
(607, '197.43.109.137', '2024-04-03', '2024-04-03 00:34:51', '2024-04-03 00:34:51', 2, '02:34:51', 'EG', 'Al Maḩallah al Kubrá'),
(608, '197.35.228.197', '2024-04-03', '2024-04-03 08:40:10', '2024-04-03 14:29:45', 35, '16:29:45', 'EG', 'Ţalkhā'),
(609, '197.160.192.156', '2024-04-03', '2024-04-03 11:57:03', '2024-04-03 11:57:03', 2, '13:57:03', 'EG', 'Alexandria'),
(610, '197.35.228.197', '2024-04-04', '2024-04-04 08:34:09', '2024-04-04 10:09:27', 21, '12:09:27', 'EG', 'Ţalkhā'),
(611, '::1', '2024-04-24', '2024-04-24 11:19:51', '2024-04-24 13:07:14', 8, '15:07:14', '0', '0'),
(612, '::1', '2024-04-26', '2024-04-26 14:28:57', '2024-04-26 14:28:57', 2, '17:28:57', '0', '0'),
(613, '::1', '2024-04-27', '2024-04-27 15:25:16', '2024-04-27 19:52:03', 13, '22:52:03', '0', '0'),
(614, '::1', '2024-04-28', '2024-04-28 15:35:14', '2024-04-28 20:38:52', 51, '23:38:52', '0', '0'),
(615, '::1', '2024-04-29', '2024-04-29 07:31:06', '2024-04-29 20:50:41', 65, '23:50:41', '0', '0'),
(616, '::1', '2024-04-30', '2024-04-29 21:00:46', '2024-04-30 18:24:15', 195, '21:24:15', '0', '0'),
(617, '::1', '2024-05-01', '2024-05-01 07:43:52', '2024-05-01 18:49:13', 60, '21:49:13', '0', '0'),
(618, '156.197.44.223', '2024-05-02', '2024-05-02 15:56:18', '2024-05-02 18:56:18', 4, '21:56:18', 'EG', 'Al Mansurah'),
(619, '66.249.93.174', '2024-05-02', '2024-05-02 15:56:47', '2024-05-02 15:56:49', 3, '18:56:49', 'BE', 'Brussels'),
(620, '74.125.208.133', '2024-05-02', '2024-05-02 15:56:53', '2024-05-02 15:56:53', 2, '18:56:53', 'NL', 'Delfzijl'),
(621, '66.249.93.165', '2024-05-02', '2024-05-02 15:56:54', '2024-05-02 15:57:03', 3, '18:57:03', 'BE', 'Brussels'),
(622, '74.125.208.132', '2024-05-02', '2024-05-02 15:57:02', '2024-05-02 15:57:02', 2, '18:57:02', 'NL', 'Delfzijl'),
(623, '45.242.59.80', '2024-05-02', '2024-05-02 16:36:21', '2024-05-02 20:57:19', 12, '23:57:19', 'EG', 'Damietta'),
(624, '197.43.10.129', '2024-05-03', '2024-05-03 12:58:07', '2024-05-03 12:58:55', 3, '15:58:55', 'EG', 'Tanta'),
(625, '197.35.218.151', '2024-05-03', '2024-05-03 16:13:34', '2024-05-03 16:52:04', 11, '19:52:04', 'EG', 'Damanhur'),
(626, '196.134.85.7', '2024-05-05', '2024-05-05 13:29:12', '2024-05-05 13:32:19', 4, '16:32:19', 'EG', 'Giza'),
(627, '45.242.223.58', '2024-05-05', '2024-05-05 15:02:37', '2024-05-05 18:22:38', 6, '21:22:38', 'EG', 'Alexandria'),
(628, '45.242.77.229', '2024-05-06', '2024-05-06 11:08:23', '2024-05-06 11:08:23', 2, '14:08:23', 'EG', 'Alexandria'),
(629, '197.162.50.219', '2024-05-07', '2024-05-07 14:31:07', '2024-05-07 20:59:04', 12, '23:59:04', 'EG', 'Alexandria'),
(630, '197.162.50.219', '2024-05-08', '2024-05-07 21:00:15', '2024-05-07 21:30:40', 21, '00:30:40', 'EG', 'Alexandria'),
(631, '102.190.42.169', '2024-05-08', '2024-05-08 09:44:04', '2024-05-08 09:44:04', 2, '12:44:04', 'EG', 'Giza'),
(632, '156.197.4.225', '2024-05-08', '2024-05-08 10:20:14', '2024-05-08 11:41:45', 7, '14:41:45', 'EG', 'Al Mansurah'),
(633, '62.139.74.65', '2024-05-11', '2024-05-11 12:19:41', '2024-05-11 12:19:56', 3, '15:19:56', 'EG', 'Cairo'),
(634, '197.35.40.178', '2024-05-12', '2024-05-12 09:50:28', '2024-05-12 09:52:05', 4, '12:52:05', 'EG', 'Al Mansurah'),
(635, '::1', '2024-08-02', '2024-08-02 16:56:02', '2024-08-02 19:55:41', 9, '22:55:41', '0', '0'),
(636, '::1', '2024-08-14', '2024-08-14 07:04:21', '2024-08-14 11:07:44', 32, '14:07:44', '0', '0'),
(637, '127.0.0.1', '2024-08-14', '2024-08-14 09:16:29', '2024-08-14 09:16:29', 2, '12:16:29', '0', '0'),
(638, '::1', '2024-08-15', '2024-08-15 20:01:21', '2024-08-15 20:31:53', 4, '23:31:53', '0', '0'),
(639, '::1', '2024-08-16', '2024-08-16 14:08:37', '2024-08-16 18:10:53', 26, '21:10:53', '0', '0'),
(640, '::1', '2024-08-17', '2024-08-16 21:32:11', '2024-08-17 15:53:47', 18, '18:53:47', '0', '0'),
(641, '::1', '2024-08-21', '2024-08-21 18:37:21', '2024-08-21 20:15:59', 53, '23:15:59', '0', '0'),
(642, '::1', '2024-08-22', '2024-08-22 20:19:40', '2024-08-22 20:24:10', 21, '23:24:10', '0', '0'),
(643, '::1', '2024-08-23', '2024-08-22 21:56:49', '2024-08-23 19:01:17', 7, '22:01:17', '0', '0'),
(644, '::1', '2024-08-24', '2024-08-23 22:25:33', '2024-08-24 11:38:03', 11, '14:38:03', '0', '0'),
(645, '::1', '2024-08-25', '2024-08-25 17:53:14', '2024-08-25 17:53:15', 3, '20:53:15', '0', '0'),
(646, '::1', '2024-08-25', '2024-08-25 17:53:14', '2024-08-25 17:53:14', 2, '20:53:14', '0', '0'),
(647, '::1', '2024-08-26', '2024-08-26 14:57:56', '2024-08-26 14:57:56', 2, '17:57:56', '0', '0'),
(648, '::1', '2024-08-28', '2024-08-28 19:32:06', '2024-08-28 19:32:06', 2, '22:32:06', '0', '0'),
(649, '::1', '2024-08-29', '2024-08-29 18:51:36', '2024-08-29 18:51:36', 2, '21:51:36', '0', '0'),
(650, '::1', '2024-08-30', '2024-08-30 18:14:28', '2024-08-30 20:42:39', 19, '23:42:39', '0', '0'),
(651, '::1', '2024-08-31', '2024-08-30 23:49:46', '2024-08-31 19:36:51', 3, '22:36:51', '0', '0'),
(652, '::1', '2024-09-06', '2024-09-05 22:31:45', '2024-09-06 19:30:28', 4, '22:30:28', '0', '0'),
(653, '::1', '2024-09-06', '2024-09-05 22:31:45', '2024-09-05 22:31:45', 2, '01:31:45', '0', '0'),
(654, '::1', '2024-09-07', '2024-09-06 21:14:20', '2024-09-07 19:17:36', 11, '22:17:36', '0', '0'),
(655, '::1', '2024-09-28', '2024-09-28 14:55:01', '2024-09-28 19:55:15', 7, '22:55:15', '0', '0'),
(656, '::1', '2024-10-01', '2024-10-01 18:47:28', '2024-10-01 18:47:28', 2, '21:47:28', '0', '0'),
(657, '::1', '2024-10-04', '2024-10-04 20:48:07', '2024-10-04 20:48:19', 3, '23:48:19', '0', '0'),
(658, '::1', '2024-10-05', '2024-10-04 23:32:09', '2024-10-04 23:32:09', 2, '02:32:09', '0', '0'),
(659, '::1', '2024-10-18', '2024-10-18 12:49:56', '2024-10-18 12:49:56', 2, '15:49:56', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `order_id`, `status`, `created_at`, `updated_at`, `transaction_id`, `store_id`) VALUES
(36, 226, 2, 'true', '2024-12-29 11:45:49', '2024-12-29 11:45:49', '249071057', NULL),
(37, 226, 3, 'true', '2024-12-29 12:04:48', '2024-12-29 12:04:48', '249077406', NULL),
(38, 226, 5, 'true', '2024-12-29 12:30:42', '2024-12-29 12:30:42', '249085875', NULL),
(39, 226, 6, 'false', '2024-12-29 12:36:14', '2024-12-29 12:36:14', '249087564', NULL),
(40, 226, 7, 'true', '2024-12-29 12:48:05', '2024-12-29 12:48:05', '249091022', NULL),
(41, 227, 8, 'true', '2024-12-30 10:23:16', '2024-12-30 10:23:16', '249372512', NULL),
(42, 226, 16, 'false', '2024-12-30 12:56:55', '2024-12-30 12:56:55', '249418943', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `account_type` enum('vendors','admins','subadmins','users') COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_code` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','accepted','blocked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `mobile_verified_at` timestamp NULL DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_id` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending_vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `balance` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `added_by`, `account_type`, `roles_name`, `name`, `email`, `mobile`, `country_code`, `mobile_code`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `mobile_verified_at`, `provider`, `provider_id`, `fcm_id`, `pending_vendor_id`, `parent_id`, `last_login`, `balance`) VALUES
(1, 1, 'admins', '[\"Super Admin\"]', 'admin', 'admin@admin.com', '1097987077', '966', 1299, NULL, '$2y$10$BawRjI9.H1yRsa60HkmDUea1KozI1recHEBO/PZd4yzXu7JoKrKf6', '35oHmDVopdy6AfIg33NYRAWzZvCk4go1LZFvc3eXzx8PgXQVTUcDagvt7WGu', '2023-11-14 14:48:38', '2025-03-09 09:09:02', 'accepted', NULL, NULL, NULL, 'sdfghjk', NULL, NULL, '2025-03-09 08:34:08', NULL),
(2, 1, 'admins', '[\"admin\"]', 'mohamed ahmmed', 'mohamed@admin.com', '1232142232', NULL, NULL, NULL, '$2y$10$6zhGKUsUSf8XoNyLIJS66eZo06LQHMka/HqD95tAlxLtemJGOCTQm', NULL, '2025-01-19 11:54:48', '2025-03-09 09:13:58', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'subadmins', '[\"order employee\"]', 'yasser ahmed', 'yasser@admin.com', NULL, NULL, NULL, NULL, '$2y$10$pwyYu1W5JVTOhf29Jy7qCu7KcOYomfz7nTb4r9mckP/6ZQx3UJN4G', NULL, '2025-01-19 11:57:02', '2025-01-19 12:37:15', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 1, 'users', '[\"user\"]', 'wessam sakr', 'wessam@user.com', '1097980291', '20', NULL, NULL, '$2y$10$cY8DuxeFlcyAqVjPzSbA8eqd4RZ.iJAGKMVHqN3y.4APAnvPu4Kxe', NULL, '2024-08-02 16:54:36', '2025-02-20 11:15:23', 'accepted', NULL, NULL, NULL, 'ffghjkl', NULL, NULL, NULL, NULL),
(26, 1, 'users', '[\"user\"]', 'mahekhalifa', 'mahekhalifa@user.com', '0109797069', '20', NULL, NULL, '$2y$10$8rPvKCvXnzgRasR1MJztm.MisHthvn6/tEDaITYfQ8Esr/Zr6XToS', NULL, '2024-08-02 17:37:31', '2025-02-20 11:20:54', 'accepted', NULL, NULL, NULL, 'gbhnjk,l;\'', NULL, NULL, NULL, NULL),
(32, 1, 'users', '[\"user\"]', 'mai tarek', 'maitarek@gmail.com', '2090987069', '20', NULL, NULL, '$2y$10$92wgv4PVjc75OI6Oc5JhROD24bMpbDrbxp2UbxSYXQrHTwUp/fVyW', NULL, '2024-09-28 16:26:13', '2025-02-20 11:22:47', 'accepted', '2025-01-16 10:02:10', NULL, NULL, 'dfghjk,l.;/\'\\', NULL, NULL, NULL, NULL),
(36, 1, 'vendors', '[\"vendor\"]', 'Imani Hubbard', 'caxuvugyz@mailinator.com', '6666666666', NULL, NULL, NULL, '$2y$10$XMjROjQopjBc5ReZFbZaHOiKt8ecm67wEkCeRe32uSL21Pzu/VidO', NULL, '2025-01-24 19:11:01', '2025-01-24 19:11:01', 'accepted', NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(37, 1, 'vendors', '[\"vendor\"]', 'dcfgbhk', 'caxuv22ugyz@mailinator.com', '6666666666', NULL, NULL, NULL, '$2y$10$nwzj4Q9zDWCtVNMuXcXR4OPnavIk55dLMVEXKVRx..DshPtJ9GfAG', NULL, '2025-01-24 19:42:48', '2025-01-24 19:42:49', 'accepted', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(38, 1, 'vendors', '[\"vendor\"]', 'Julian Davis', 'potuhoz@mailinator.com', '2666666666', NULL, NULL, NULL, '$2y$10$uR9zRl7ywTmzlAt5tj96auOmDsfYIm7Zh1GSKm7ijaX/OP5OAgVxy', NULL, '2025-01-24 20:33:22', '2025-01-24 20:33:22', 'accepted', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL),
(39, 1, 'vendors', '[\"vendor\"]', 'mai tarek', 'admin@admine.com', '1223333332', NULL, NULL, NULL, '$2y$10$WJeF8doD.avU4VxlUOcwS.it1m4bxW7be/KLBRmhd5juKAkBxWDwS', NULL, '2025-01-25 11:10:59', '2025-01-25 11:11:00', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 1, 'vendors', '[\"vendor\"]', 'dfgh', 'admin@ad1min.com', '0107987069', NULL, NULL, NULL, '$2y$10$HSoGJp7m.f1h7fwO0mB5SebXIxou7eOTdT9LipE7yB04JWd3qvSOG', NULL, '2025-01-25 11:14:02', '2025-01-25 11:14:03', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 1, 'vendors', '[\"vendor\"]', 'mai tarek2', 'admin@admin.c22om', '0129797069', NULL, NULL, NULL, '$2y$10$U1QDoGev3QSJfaIu6vmFQe/.4Gmjqf77CPC.dzhf0NoqPC5RknwGC', NULL, '2025-01-25 11:15:57', '2025-01-25 11:15:57', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 1, 'vendors', '[\"vendor\"]', 'Abdullah Elgazzar', 'info999@email.com', '1234567890', NULL, NULL, NULL, '$2y$10$b8cRu6TqC1/5.biIoQQFvebnyplyseW347dSwARTtPzrvidJJqyIK', NULL, '2025-02-06 12:18:11', '2025-02-06 12:18:11', 'accepted', NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL),
(43, 1, 'vendors', '[\"vendor\"]', 'Abdullah', 'elgazzara912@gmail.com', '0109398222', NULL, NULL, NULL, '$2y$10$EpGB1HWaXaRpXOGE/siMMOIPLpeF3wk6Ujri25ZWHoDeF8vB2np2K', NULL, '2025-02-06 13:53:56', '2025-02-06 13:53:56', 'accepted', NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL),
(44, 1, 'vendors', '[\"vendor\"]', 'Abdullah Ashraf', 'elgazzara2912@gmail.com', '9663455345', NULL, NULL, NULL, '$2y$10$U/6CtS6PX90hjnUHKPTbMuEuC/IsIQLll3qSZyUZ2Fy3b/w0OrqPW', NULL, '2025-02-06 13:57:02', '2025-02-06 13:57:02', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 1, 'vendors', '[\"vendor\"]', 'Winter Holder', 'zujux@mailinator.com', '1232345678', NULL, NULL, NULL, '$2y$10$RERrIYYHg9Vw8Y.2GfOs9..ukekABqNvB9wJfGy3Ktn/GEvJdAu8y', NULL, '2025-02-06 14:41:16', '2025-03-06 13:28:43', 'accepted', NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL),
(46, 1, 'vendors', '[\"vendor\"]', 'Gisela Shaw', 'nypasi@mailinator.com', '1111111181', NULL, NULL, NULL, '$2y$10$oJYe7/V30G0/EeZMYdpb..vmJc4PjcWiSsXOE6hRj.WFPrqMnM4uO', NULL, '2025-02-17 12:21:38', '2025-02-17 12:21:38', 'accepted', NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL),
(47, 1, 'admins', '[\"admin\"]', 'ertghjtrrr', 'admin22@admin.com', '1232342232', NULL, NULL, NULL, '$2y$10$TYLvkEFDpGsK4cSXr0aZaeykBh9aPqua9wCVNH9omgSArk9D/w9jW', NULL, '2025-02-18 09:33:48', '2025-02-18 09:33:48', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 1, 'vendors', '[\"vendor\"]', 'fffffff', 'fffffff@admin.com', '1232342232', NULL, NULL, NULL, '$2y$10$WTVWHwyeheLV6NaL9qyU6egGDGYEtfSHu3x3rcQT2c8rnz6YOJ9PK', NULL, '2025-02-18 10:58:17', '2025-02-18 10:58:17', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 1, 'vendors', '[\"vendor\"]', 'Hyatt Frye', 'teju@mailinator.com', '2828222828', NULL, NULL, NULL, '$2y$10$UUKYJfCvpiLuVxOqOQknZu8u4WWubbQRgBQH0WJ1NTABv/wtxf4ji', NULL, '2025-02-18 11:26:25', '2025-02-18 11:31:43', 'accepted', NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(50, 1, 'vendors', '[\"vendor\"]', 'mai tarek', 'maitarektt2222@gmail.com', '1097987069', NULL, NULL, NULL, '$2y$10$y4Am7B7zeLZW15MPoDtXwuiMxZksVU8yI9RxHo3n6GlMLsl5O9ZDK', NULL, '2025-02-18 11:38:05', '2025-02-18 11:46:54', 'accepted', NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL),
(51, 1, 'vendors', '[\"vendor\"]', 'Mohammad Nielsen', 'suda@mailinator.com', '2929299292', NULL, NULL, NULL, '$2y$10$J8EDggCsnB8z/ryM8EIYjuKO3QLQhExMSImJVAiZR1Eqx3L3Vrdve', NULL, '2025-02-18 11:45:37', '2025-02-18 11:45:37', 'accepted', NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(57, 1, 'users', '[\"user\"]', 'mohamed', 'mohamed@user.com', '2222222222', NULL, NULL, NULL, '$2y$10$DdQdaSdBA7ml33c12hx9IeSkFgwSwKu4AuEAZpjGf3MjN5tToJt7K', NULL, '2025-02-19 09:20:13', '2025-02-20 11:16:10', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 1, 'vendors', '[\"vendor\"]', 'محمد الطرشوبي', 'vendor@admin.com', '2222222222', NULL, NULL, NULL, '$2y$10$qtkxqhrsEQ6c8UkP.s86xO3/jeRslvl2VSAZUr1E6SlFmk.ADy3VK', NULL, '2025-02-19 09:30:18', '2025-02-20 09:28:13', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 58, 'subadmins', '[\"subadmin\"]', 'cfghjk', 'cfghjk@admin.com', '2233344444', NULL, NULL, NULL, '$2y$10$SQz7ltUaCCcWFxiAE4rtCOI7lRV2niAuBhATZodX2fjSBl.x2KskO', NULL, '2025-02-19 09:31:40', '2025-02-19 09:31:42', 'accepted', NULL, NULL, NULL, NULL, NULL, 58, NULL, NULL),
(60, 1, 'vendors', '[\"vendor\"]', 'frgrdg11', 'adminwwww@admin.com', '1232342232', NULL, NULL, NULL, '$2y$10$Orkrvl5d7x7eAQPkf6psEuhzLS5JCHty3yQd5kZQE3iRBZqwtj3G2', NULL, '2025-02-19 10:15:35', '2025-02-19 10:15:35', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, NULL, 'vendors', NULL, 'ahmed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-23 09:40:09', '2025-02-23 09:40:09', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, NULL, 'users', NULL, 'ahmed', 'medo@user.com', '1097979797', NULL, NULL, NULL, '$2y$10$OtRQtcQpX/ManeK4.csG0uFRUTx69QlE6oWdoMofLoI070E2TIwAu', NULL, '2025-02-23 09:49:59', '2025-03-05 11:21:35', 'accepted', '2025-02-23 13:18:29', NULL, NULL, NULL, NULL, NULL, '2025-03-05 11:21:35', NULL),
(72, NULL, 'users', NULL, 'ahmed', NULL, '1097979795', NULL, NULL, NULL, '$2y$10$pATqTxOfNHaljePOf1Zki.twGhloRU4m0IY2PV08d1VnJ3khUqJSi', NULL, '2025-02-23 12:21:02', '2025-02-26 13:11:33', 'accepted', '2025-02-26 13:05:11', NULL, NULL, NULL, NULL, NULL, '2025-02-26 13:11:33', NULL),
(73, NULL, 'users', NULL, 'ahmed', NULL, '1097979793', NULL, NULL, NULL, '$2y$10$V3.B95JsXCVJUQDAJiHeAucWykKOuhKBzznYZA3yHVXytxQdBbnBW', NULL, '2025-02-23 13:20:49', '2025-02-23 13:20:49', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, NULL, 'users', NULL, 'ahmed', NULL, '1097979792', NULL, 1234, NULL, '$2y$10$4AH8H7PGdYSeNnT9cUpOAua5OmAxqUiUXFiZw0CNwSncmDJ1E2sJO', NULL, '2025-02-23 13:22:38', '2025-02-23 13:22:38', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 1, 'users', '[\"user\"]', 'ashraf12', 'ashraf12@user.com', '1097987033', NULL, NULL, NULL, '$2y$10$bsqiDzKFk230yHp97VNEpe3Fr6hbzXfsPQoG.A.YMqpCbtggaNJZ6', NULL, '2025-03-09 09:27:13', '2025-03-09 09:27:37', 'accepted', NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-09 09:27:37', NULL),
(76, 1, 'vendors', '[\"vendor\"]', 'Akeem Pugh', 'zybyxosoci@mailinator.com', '1888282828', NULL, NULL, NULL, '$2y$10$1MbeoxQd0qcCT8Rw1A7SCuIyb3h46fXolpZ77CnU7jY/WHtp0MhoO', NULL, '2025-03-09 11:03:22', '2025-03-09 11:03:22', 'accepted', NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('apartment','house','office') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `apartment_no` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor_no` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `type`, `mark`, `label_name`, `street_name`, `created_at`, `updated_at`, `apartment_no`, `floor_no`, `district_id`) VALUES
(51, 72, 'office', 'أمام مسجد الصلاح', 'العنوان الرئيسي', 'شارع الهدي والنور', '2025-02-27 10:46:57', '2025-02-27 10:46:57', 'الشقة الرابع', 'الدور الأول', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_rates`
--

CREATE TABLE `user_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  `ip_address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_rates`
--

INSERT INTO `user_rates` (`id`, `created_at`, `updated_at`, `note`, `star`, `ip_address`, `status`) VALUES
(1, '2024-07-20 17:58:00', '2024-07-20 18:02:30', 'very goood', 4, '192.162.1', 'hide'),
(2, '2024-08-21 19:58:57', '2024-08-21 19:58:57', NULL, 4, NULL, 'hide'),
(3, '2024-08-21 19:59:19', '2024-08-21 19:59:19', NULL, 4, NULL, 'hide'),
(4, '2024-08-21 20:00:43', '2024-08-21 20:00:43', NULL, 3, '::1', 'hide'),
(5, '2024-08-22 20:02:10', '2024-08-22 20:02:10', NULL, 2, '::1', 'hide'),
(6, '2024-08-22 20:03:46', '2024-08-22 20:03:46', 'fg', 3, '::1', 'hide'),
(7, '2024-08-22 20:05:29', '2024-08-22 20:05:29', NULL, 3, '::1', 'hide'),
(8, '2024-08-22 20:14:40', '2024-08-22 20:14:40', NULL, 2, '::1', 'hide'),
(9, '2024-08-22 20:26:33', '2024-08-22 20:26:33', NULL, 3, '::1', 'hide'),
(10, '2024-08-22 20:26:33', '2024-08-22 20:26:33', NULL, 3, '::1', 'hide'),
(11, '2024-08-22 20:26:34', '2024-08-22 20:26:34', NULL, 3, '::1', 'hide'),
(12, '2024-08-22 20:26:34', '2024-08-22 20:26:34', NULL, 3, '::1', 'hide'),
(13, '2024-08-22 20:29:11', '2024-08-22 20:29:11', NULL, 3, '::1', 'hide'),
(14, '2024-08-22 20:44:22', '2024-08-24 10:14:25', NULL, 4, '::1', 'show'),
(15, '2024-08-22 20:53:20', '2024-08-24 10:14:23', NULL, 3, '::1', 'show');

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
  `type` enum('deposit','withdrawal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `created_at`, `updated_at`, `product_id`) VALUES
(1, 70, '2025-03-05 12:10:20', '2025-03-05 12:10:20', 7),
(83, 25, '2024-08-02 18:00:34', '2024-08-02 18:00:34', 7);

-- --------------------------------------------------------

--
-- Table structure for table `working_hours`
--

CREATE TABLE `working_hours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` tinytext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'off',
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `morning_from` time DEFAULT NULL,
  `morning_to` time DEFAULT NULL,
  `evening_from` time DEFAULT NULL,
  `evening_to` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `working_hours`
--

INSERT INTO `working_hours` (`id`, `user_id`, `type`, `day`, `morning_from`, `morning_to`, `evening_from`, `evening_to`, `created_at`, `updated_at`) VALUES
(29, 1, 'all_day', 'saturday', NULL, NULL, NULL, NULL, '2024-12-25 09:29:24', '2024-12-25 09:29:24'),
(30, 1, 'all_day', 'sunday', NULL, NULL, NULL, NULL, '2024-12-25 09:29:25', '2024-12-25 09:29:25'),
(31, 1, 'all_day', 'monday', NULL, NULL, NULL, NULL, '2024-12-25 09:29:25', '2024-12-25 09:29:25'),
(32, 1, 'all_day', 'tuesday', NULL, NULL, NULL, NULL, '2024-12-25 09:29:27', '2024-12-25 09:29:27'),
(33, 1, 'periods', 'wednesday', '01:30:00', '02:30:00', '13:30:00', '15:30:00', '2024-12-25 09:29:27', '2024-12-25 09:30:19'),
(34, 1, 'off', 'thursday', NULL, NULL, NULL, NULL, '2024-12-25 09:29:27', '2024-12-25 09:30:20'),
(35, 1, 'all_day', 'friday', NULL, NULL, NULL, NULL, '2024-12-25 09:29:28', '2024-12-25 09:29:28');

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
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_admin_id_foreign` (`added_by`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `capacities`
--
ALTER TABLE `capacities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_order_id_foreign` (`order_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_resturant_id_foreign` (`product_id`),
  ADD KEY `store_id` (`store_id`);

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
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_answers_admin_id_foreign` (`added_by`);

--
-- Indexes for table `coupon_conditions`
--
ALTER TABLE `coupon_conditions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `coupon_discounts`
--
ALTER TABLE `coupon_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `coupon_product`
--
ALTER TABLE `coupon_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `product_id` (`product_id`);

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
-- Indexes for table `invoice_templates`
--
ALTER TABLE `invoice_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pending_vendors`
--
ALTER TABLE `pending_vendors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pending_vendors_added_by_foreign` (`added_by`);

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
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `product_capacities`
--
ALTER TABLE `product_capacities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_answers_admin_id_foreign` (`admin_id`),
  ADD KEY `user_coupon_package_id` (`product_id`),
  ADD KEY `user_coupon_coupon_id` (`capacity_id`);

--
-- Indexes for table `product_coupons`
--
ALTER TABLE `product_coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_answers_admin_id_foreign` (`admin_id`),
  ADD KEY `user_coupon_package_id` (`product_id`),
  ADD KEY `user_coupon_coupon_id` (`coupon_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_answers_admin_id_foreign` (`user_id`),
  ADD KEY `user_coupon_package_id` (`product_id`);

--
-- Indexes for table `question_answers`
--
ALTER TABLE `question_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gates_admin_id_foreign` (`added_by`);

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
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_admin_id_foreign` (`added_by`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_answers_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `temp_carts`
--
ALTER TABLE `temp_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_resturant_id_foreign` (`product_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `trackers`
--
ALTER TABLE `trackers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_order_id_foreign` (`order_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `pending_vendor_id` (`pending_vendor_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abouts_admin_id_foreign` (`user_id`),
  ADD KEY `zone_id` (`district_id`);

--
-- Indexes for table `user_rates`
--
ALTER TABLE `user_rates`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_answers_admin_id_foreign` (`user_id`),
  ADD KEY `user_coupon_package_id` (`product_id`);

--
-- Indexes for table `working_hours`
--
ALTER TABLE `working_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `center_id` (`user_id`);

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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `capacities`
--
ALTER TABLE `capacities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `coupon_conditions`
--
ALTER TABLE `coupon_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coupon_discounts`
--
ALTER TABLE `coupon_discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `coupon_product`
--
ALTER TABLE `coupon_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `invoice_templates`
--
ALTER TABLE `invoice_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=459;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pending_vendors`
--
ALTER TABLE `pending_vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_capacities`
--
ALTER TABLE `product_capacities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1674;

--
-- AUTO_INCREMENT for table `product_coupons`
--
ALTER TABLE `product_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `question_answers`
--
ALTER TABLE `question_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

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
-- AUTO_INCREMENT for table `working_hours`
--
ALTER TABLE `working_hours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD CONSTRAINT `blog_comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stores_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
