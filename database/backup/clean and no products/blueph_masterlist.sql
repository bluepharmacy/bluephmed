-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2020 at 05:32 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blueph_masterlist`
--

-- --------------------------------------------------------

--
-- Table structure for table `classification`
--

CREATE TABLE `classification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classification`
--

INSERT INTO `classification` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ANTISEPTIC', '2020-10-02 18:55:35', '2020-10-02 18:55:35'),
(2, 'ANTI FLATULENT', '2020-10-02 18:56:19', '2020-10-02 18:56:19'),
(3, 'MEDICAL SUPPLIES', '2020-10-02 18:56:39', '2020-10-02 18:56:39'),
(4, 'ANALGESIC / ANTIPYRETIC', '2020-10-02 18:57:02', '2020-10-02 18:57:02'),
(5, 'ANTI ARRYTHMIC AGENTS', '2020-10-02 18:57:42', '2020-10-02 18:57:42'),
(6, 'ANTI CONVULSANT', '2020-10-02 18:57:57', '2020-10-02 18:57:57'),
(7, 'ANTACID', '2020-10-02 18:58:21', '2020-10-02 18:58:21'),
(10, 'ANTIBACTERIAL', '2020-10-02 18:58:48', '2020-10-02 18:58:48'),
(11, 'ANTI ALLERGY', '2020-10-02 18:58:57', '2020-10-02 18:58:57'),
(12, 'ANTI FUNGAL', '2020-10-02 18:59:06', '2020-10-02 18:59:06'),
(13, 'ANTI GOUT', '2020-10-02 18:59:14', '2020-10-02 18:59:14'),
(14, 'ANTI HELMINTHS', '2020-10-02 18:59:28', '2020-10-02 18:59:28'),
(16, 'ANTI MOTILITY', '2020-10-02 19:00:03', '2020-10-02 19:00:03'),
(17, 'ANTI SPASMODIC', '2020-10-02 19:00:20', '2020-10-02 19:00:20'),
(18, 'ANTI TUBERCOLOSIS', '2020-10-02 19:00:30', '2020-10-02 19:00:30'),
(19, 'ANTI VERTIGO', '2020-10-02 19:00:38', '2020-10-02 19:00:38'),
(20, 'CORTICOSTEROID', '2020-10-02 19:00:54', '2020-10-02 19:00:54'),
(21, 'DIURETICS', '2020-10-02 19:01:10', '2020-10-02 19:01:10'),
(22, 'DIAPERS', '2020-10-02 19:01:19', '2020-10-02 19:01:19'),
(23, 'DYSLIPIDAEMIC AGENTS', '2020-10-02 19:01:32', '2020-10-02 19:01:32'),
(24, 'FOR COUGH / COLDS', '2020-10-02 19:01:46', '2020-10-02 19:01:46'),
(25, 'FOR MOTION SICKNESS', '2020-10-02 19:01:57', '2020-10-02 19:01:57'),
(26, 'FOR SKIN INFECTIONS', '2020-10-02 19:02:08', '2020-10-02 19:02:08'),
(27, 'FOR STOMACH DISORDERS / ULCERS', '2020-10-02 19:02:28', '2020-10-02 19:02:28'),
(28, 'GALENICALS', '2020-10-02 19:02:38', '2020-10-02 19:02:38'),
(29, 'HYPERSENTIVE DRUGS', '2020-10-02 19:02:50', '2020-10-02 19:02:50'),
(30, 'NSAID\'s', '2020-10-02 19:03:02', '2020-10-02 19:03:02'),
(31, 'VITAMINS / MINERALS', '2020-10-02 19:03:20', '2020-10-02 19:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locate`
--

CREATE TABLE `locate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `map_id` int(11) NOT NULL,
  `tr` int(11) NOT NULL,
  `td` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE `map` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `map`
--

INSERT INTO `map` (`id`, `name`, `table`, `created_at`, `updated_at`) VALUES
(1, 'Main Area', '<table class=\"table table-bordered\" id=\"main_area\">\r\n                    <thead>\r\n                        <tr></tr>\r\n                    </thead>\r\n                    <tbody>\r\n                        <tr>\r\n                            <td colspan=\"6\">-</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td id=\"totest\" colspan=\"2\">x</td>\r\n                            <td colspan=\"2\">x</td>\r\n                            <td colspan=\"2\">x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>o</td>\r\n                            <td>o</td>\r\n                            <td>o</td>\r\n                            <td>o</td>\r\n                            <td>o</td>\r\n                            <td>o</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                    </tbody>\r\n                </table>', '2020-10-02 19:15:46', '2020-10-02 19:15:46'),
(2, 'Main Desk Area', '<table class=\"table table-bordered\" id=\"main_desk_area\">\r\n                    <thead>\r\n                        <tr></tr>\r\n                    </thead>\r\n                    <tbody>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                    </tbody>\r\n                </table>', '2020-10-02 19:16:40', '2020-10-02 19:16:40'),
(3, 'Diapers Area', '<table class=\"table table-bordered\" id=\"diapers_area\">\r\n                    <thead>\r\n                        <tr></tr>\r\n                    </thead>\r\n                    <tbody>\r\n                        <tr>\r\n                            <td colspan=\"4\">-</td>\r\n                        </tr>\r\n                        <tr></tr>\r\n                        <tr>\r\n                            <td colspan=\"2\">x</td>\r\n                            <td colspan=\"2\">x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"2\">x</td>\r\n                            <td colspan=\"2\">x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"2\">x</td>\r\n                            <td colspan=\"2\">x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"3\">x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"3\">x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"3\">x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td></td>\r\n                            <td></td>\r\n                            <td></td>\r\n                            <td></td>\r\n                        </tr>\r\n                    </tbody>\r\n                </table>', '2020-10-02 19:17:26', '2020-10-02 19:17:26'),
(4, 'Cosmetics Area', '<table class=\"table table-bordered\" id=\"cosmetics_area\">\r\n                    <thead>\r\n                        <tr></tr>\r\n                    </thead>\r\n                    <tbody>\r\n                        <tr>\r\n                            <td colspan=\"2\">x</td>\r\n                            <td colspan=\"2\">x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"2\">x</td>\r\n                            <td colspan=\"2\">x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"2\">x</td>\r\n                            <td colspan=\"2\">x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"2\">x</td>\r\n                            <td colspan=\"2\">x</td>\r\n                        </tr>\r\n                    </tbody>\r\n                </table>', '2020-10-02 19:18:04', '2020-10-02 19:18:04'),
(5, 'Cashier\'s Back Area', '<table class=\"table table-bordered\" id=\"cashiers_back_area\">\r\n                    <thead>\r\n                        <tr></tr>\r\n                    </thead>\r\n                    <tbody>\r\n                        <tr>\r\n                            <td colspan=\"3\">-</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td id=\"test\">x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                            <td>x</td>\r\n                        </tr>\r\n                    </tbody>\r\n                </table>', '2020-10-02 19:19:18', '2020-10-02 19:19:18');

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
(35, '2014_10_12_000000_create_users_table', 1),
(36, '2014_10_12_100000_create_password_resets_table', 1),
(37, '2019_08_19_000000_create_failed_jobs_table', 1),
(38, '2020_08_19_055741_create_products_table', 1),
(39, '2020_08_19_062737_create_unit_table', 1),
(40, '2020_08_19_064228_create_selling_table', 1),
(41, '2020_08_19_074030_create_or_number_table', 1),
(42, '2020_09_05_080552_create_prices_table', 1),
(43, '2020_09_07_032216_create_stocks_table', 1),
(44, '2020_09_08_050348_create_history_table', 1),
(45, '2020_09_12_023303_create_classification_table', 1),
(46, '2020_09_12_023912_create_supplier_table', 1),
(47, '2020_09_14_024420_create_map_table', 1),
(48, '2020_09_14_024522_create_locate_table', 1),
(49, '2020_09_24_034102_create_pending_sales_table', 1),
(50, '2020_09_24_062731_create_sales_table', 1),
(51, '2020_09_24_092608_create_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `or_number`
--

CREATE TABLE `or_number` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_receipt_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_amount_total` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending_sales`
--

CREATE TABLE `pending_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` int(11) NOT NULL,
  `sales` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` int(11) NOT NULL,
  `sold_from` int(11) DEFAULT NULL,
  `classification_id` int(11) DEFAULT NULL,
  `locate_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discounted` int(11) NOT NULL,
  `discount_rate` int(11) DEFAULT NULL,
  `price_per_unit` decimal(8,2) NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `original_total_price` decimal(8,2) NOT NULL,
  `discount_less_note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `selling`
--

CREATE TABLE `selling` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `available` int(11) NOT NULL,
  `alert` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `contact_number`, `contact_email`, `created_at`, `updated_at`) VALUES
(1, 'CROSSMED PHARMA', NULL, NULL, '2020-10-02 19:08:20', '2020-10-02 19:08:20'),
(2, 'JMV PHARMACY AND MEDICAL SUPPLIES', NULL, NULL, '2020-10-02 19:09:49', '2020-10-02 19:09:49'),
(3, 'JVM PHARMACY AND MEDICAL SUPPLIES', NULL, NULL, '2020-10-02 19:10:22', '2020-10-02 19:10:22'),
(4, 'MEEDPHARMA', NULL, NULL, '2020-10-02 19:10:30', '2020-10-02 19:10:30'),
(5, 'R8 DRUGS DISTRIBUTOR', NULL, NULL, '2020-10-02 19:10:42', '2020-10-02 19:10:42'),
(6, '0601 HANZO MEDICAL CORPORATION', NULL, NULL, '2020-10-02 19:10:53', '2020-10-02 19:10:53'),
(7, 'HEALTH CRAFT MEDICAL SUPPLY', NULL, NULL, '2020-10-02 19:11:02', '2020-10-02 19:11:02'),
(8, 'KISSES & CHOCOLATE', NULL, NULL, '2020-10-02 19:11:09', '2020-10-02 19:11:09'),
(9, 'INTERNATIONA PHARMACEUTICALS, INC.', NULL, NULL, '2020-10-02 19:11:17', '2020-10-02 19:11:17'),
(10, 'EVY VENTURES Enterprises', NULL, NULL, '2020-10-02 19:11:29', '2020-10-02 19:11:29'),
(11, 'DRB SALES, INC.', NULL, NULL, '2020-10-02 19:11:38', '2020-10-02 19:11:38'),
(12, 'MAC TYCOON MARKETING', NULL, NULL, '2020-10-02 19:11:51', '2020-10-02 19:11:51'),
(13, 'STA. CRUZ MEDICAL SUPPLIES', NULL, NULL, '2020-10-02 19:11:59', '2020-10-02 19:11:59'),
(15, 'BELTRAN\'S FOOD & DELICACIES', NULL, NULL, '2020-10-02 19:12:26', '2020-10-02 19:12:26'),
(16, 'PGI', NULL, NULL, '2020-10-02 19:12:36', '2020-10-02 19:12:36'),
(17, 'ADVECT MARKETING CORPORATION', NULL, NULL, '2020-10-02 19:12:49', '2020-10-02 19:12:49'),
(18, 'CSI', NULL, NULL, '2020-10-02 19:13:03', '2020-10-02 19:13:03'),
(19, 'KUYA AHENTE', NULL, NULL, '2020-10-02 19:13:11', '2020-10-02 19:13:11'),
(20, 'MEDGENIX', NULL, NULL, '2020-10-02 19:13:20', '2020-10-02 19:13:20'),
(21, 'MAGICLUB INC.', NULL, NULL, '2020-10-02 19:13:28', '2020-10-02 19:13:28'),
(22, 'SKYMED PHARMA DISTRIBUTOR', NULL, NULL, '2020-10-02 19:13:37', '2020-10-02 19:13:37'),
(23, 'SUNMED PHARMA', NULL, NULL, '2020-10-02 19:13:47', '2020-10-02 19:13:47'),
(24, 'TRIPLE 888 MEDICAL & PHARMA INC.', NULL, NULL, '2020-10-02 19:13:57', '2020-10-02 19:13:57'),
(25, 'AJI 3 MEDICAL SUPPLIES', NULL, NULL, '2020-10-02 19:14:06', '2020-10-02 19:14:06'),
(26, 'NORVIC', NULL, NULL, '2020-10-02 19:14:13', '2020-10-02 19:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping` decimal(8,2) DEFAULT NULL,
  `discount_less` decimal(8,2) DEFAULT NULL,
  `grand_total` decimal(8,2) NOT NULL,
  `customer_money` decimal(8,2) NOT NULL,
  `change` decimal(8,2) NOT NULL,
  `staff_id_counter` int(11) NOT NULL,
  `staff_id_cashier` int(11) NOT NULL,
  `pending_sales_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `per` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `per`, `created_at`, `updated_at`) VALUES
(1, 'PCS', '2020-10-02 18:50:47', '2020-10-02 18:50:47'),
(2, 'PACK', '2020-10-02 18:51:33', '2020-10-02 18:51:33'),
(3, 'EACH', '2020-10-02 18:51:48', '2020-10-02 18:51:48'),
(4, 'TABLETS', '2020-10-02 18:52:00', '2020-10-02 18:52:00'),
(5, 'CAPSULES', '2020-10-02 18:52:18', '2020-10-02 18:52:18'),
(6, 'BOTTLES', '2020-10-02 18:52:36', '2020-10-02 18:52:36'),
(7, 'BOXES', '2020-10-02 18:52:50', '2020-10-02 18:52:50'),
(8, 'SUSPENSIONS', '2020-10-02 18:53:16', '2020-10-02 18:53:16'),
(9, 'SYRUP', '2020-10-02 18:53:31', '2020-10-02 18:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classification`
--
ALTER TABLE `classification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classification_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locate`
--
ALTER TABLE `locate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locate_target_unique` (`target`);

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `map_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_number`
--
ALTER TABLE `or_number`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pending_sales`
--
ALTER TABLE `pending_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selling`
--
ALTER TABLE `selling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_name_unique` (`name`),
  ADD UNIQUE KEY `supplier_contact_email_unique` (`contact_email`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unit_per_unique` (`per`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classification`
--
ALTER TABLE `classification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locate`
--
ALTER TABLE `locate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `map`
--
ALTER TABLE `map`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `or_number`
--
ALTER TABLE `or_number`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pending_sales`
--
ALTER TABLE `pending_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `selling`
--
ALTER TABLE `selling`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
