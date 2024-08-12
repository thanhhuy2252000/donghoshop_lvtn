-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 12, 2024 lúc 12:59 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `donghoshop_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_donhangs`
--

CREATE TABLE `chitiet_donhangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tong` int(11) NOT NULL DEFAULT 0,
  `soluong` int(11) NOT NULL DEFAULT 0,
  `giagoc` int(11) NOT NULL DEFAULT 0,
  `giaban` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sanpham_id` bigint(20) UNSIGNED NOT NULL,
  `donhang_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiet_donhangs`
--

INSERT INTO `chitiet_donhangs` (`id`, `tong`, `soluong`, `giagoc`, `giaban`, `created_at`, `updated_at`, `sanpham_id`, `donhang_id`) VALUES
(1, 4500000, 1, 5000000, 4500000, '2024-06-01 14:12:10', '2024-06-01 14:12:10', 1, 1),
(2, 5600000, 2, 3000000, 2800000, '2024-06-01 14:12:10', '2024-06-01 14:12:10', 2, 2),
(3, 5500000, 1, 8000000, 5500000, '2024-06-01 14:12:10', '2024-06-01 14:12:10', 3, 3),
(4, 3500000, 1, 4000000, 3500000, '2024-06-01 14:12:10', '2024-06-01 14:12:10', 4, 4),
(5, 3600000, 2, 2000000, 1800000, '2024-06-01 14:12:10', '2024-06-01 14:12:10', 5, 5),
(50, 3500000, 1, 4000000, 3500000, '2024-07-17 00:19:17', '2024-07-17 00:19:17', 10, 57),
(51, 800000, 1, 800000, 800000, '2024-07-17 00:23:05', '2024-07-17 00:23:05', 12, 58),
(91, 2000000, 1, 2000000, 2000000, '2024-07-28 19:30:41', '2024-07-28 19:30:41', 31, 93),
(94, 6800000, 1, 8200000, 6800000, '2024-08-04 02:02:54', '2024-08-04 02:02:54', 29, 96),
(97, 7000000, 2, 4000000, 3500000, '2024-08-05 00:38:16', '2024-08-05 00:38:16', 11, 98),
(98, 7000000, 1, 10000000, 7000000, '2024-08-05 00:38:16', '2024-08-05 00:38:16', 4, 98),
(99, 16000000, 1, 16000000, 16000000, '2024-08-05 06:11:19', '2024-08-05 06:11:19', 9, 99),
(101, 5000000, 1, 5000000, 5000000, '2024-08-07 10:25:32', '2024-08-07 10:25:32', 6, 101),
(102, 16000000, 1, 16000000, 16000000, '2024-08-07 10:29:14', '2024-08-07 10:29:14', 9, 102),
(106, 4500000, 1, 5000000, 4500000, '2024-08-07 10:34:46', '2024-08-07 10:34:46', 1, 108),
(108, 16000000, 1, 16000000, 16000000, '2024-08-09 03:09:28', '2024-08-09 03:09:28', 9, 110),
(109, 5000000, 1, 5000000, 5000000, '2024-08-09 03:09:37', '2024-08-09 03:09:37', 6, 111),
(110, 5000000, 1, 5000000, 5000000, '2024-08-09 03:09:44', '2024-08-09 03:09:44', 6, 112),
(118, 10000000, 2, 5000000, 5000000, '2024-08-11 04:37:21', '2024-08-11 04:37:21', 6, 120),
(121, 4500000, 1, 5000000, 4500000, '2024-08-11 21:44:31', '2024-08-11 21:44:31', 1, 122),
(122, 3500000, 1, 4000000, 3500000, '2024-08-11 21:47:42', '2024-08-11 21:47:42', 11, 123),
(123, 4500000, 1, 5000000, 4500000, '2024-08-11 23:00:37', '2024-08-11 23:00:37', 1, 124),
(124, 5000000, 1, 5000000, 5000000, '2024-08-11 23:00:37', '2024-08-11 23:00:37', 6, 124);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmucs`
--

CREATE TABLE `danhmucs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenDM` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmucs`
--

INSERT INTO `danhmucs` (`id`, `tenDM`, `created_at`, `updated_at`) VALUES
(1, 'Đồng hồ nam', '2024-06-01 14:12:10', '2024-08-11 08:17:32'),
(2, 'Đồng hồ nữ', '2024-06-01 14:12:10', '2024-06-01 14:12:10'),
(3, 'Đồng hồ đôi', '2024-06-01 14:12:10', '2024-06-01 14:12:10'),
(4, 'Đồng hồ cơ', '2024-06-01 14:12:10', '2024-06-01 14:12:10'),
(5, 'Đồng hồ điện tử', '2024-06-01 14:12:10', '2024-06-01 14:12:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhangs`
--

CREATE TABLE `donhangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `sdt` varchar(191) NOT NULL DEFAULT '',
  `diachi` varchar(255) NOT NULL DEFAULT '',
  `tongDH` int(11) NOT NULL DEFAULT 0,
  `pt_thanhtoan` varchar(191) NOT NULL DEFAULT '',
  `trangthai` varchar(191) NOT NULL DEFAULT 'Chưa xác nhận',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhangs`
--

INSERT INTO `donhangs` (`id`, `name`, `email`, `sdt`, `diachi`, `tongDH`, `pt_thanhtoan`, `trangthai`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Nguyễn Văn A', 'nguyenvana@example.com', '0123456789', '123 ABC Street, XYZ City', 1000000, 'COD', 'Đã giao', '2024-06-01 14:12:10', '2024-08-11 22:35:02', 1),
(2, 'Trần Thị B', 'tranthib@example.com', '0987654321', '456 XYZ Street, ABC City', 2000000, 'momo', 'Đã giao', '2024-06-01 14:12:10', '2024-08-11 22:35:10', 2),
(3, 'Lê Văn C', 'levanc@example.com', '0456123789', '789 XYZ Street, ABC City', 1500000, 'COD', 'Đã giao', '2024-06-01 14:12:10', '2024-08-11 22:35:19', 3),
(4, 'Phạm Thị D', 'phamthid@example.com', '0321654987', '987 ABC Street, XYZ City', 3000000, 'COD', 'Đã giao', '2024-06-01 14:12:10', '2024-08-11 22:35:25', 4),
(5, 'Hoàng Văn E', 'hoangvane@example.com', '0789123456', '456 ABC Street, XYZ City', 2500000, 'COD', 'Đã giao', '2024-06-01 14:12:10', '2024-08-11 22:35:34', 5),
(57, 'Phan Hùng', 'hungphan@gmail.com', '0939384675', '123 ahg, uio, city', 3500000, 'COD', 'Đã giao', '2024-07-17 00:19:17', '2024-08-11 21:49:28', 64),
(58, 'Phan Hùng', 'hungphan@gmail.com', '0939384675', '123 ahg, uio, city', 800000, 'momo', 'Đã giao', '2024-07-17 00:23:05', '2024-08-11 22:35:54', 64),
(93, 'Phan Hùng', 'hungphan@gmail.com', '0939384675', '123 Hoàng Sơn, Đống Đa, Hà Nội', 2200000, 'momo', 'Đã xác nhận', '2024-07-28 19:30:41', '2024-07-28 19:44:47', 64),
(96, 'Hoàng Thị Hậu', 'hoanghau46@gmail.com', '0309300046', '1 Lý Thái Tổ, Phường 1, Quận 10, TP.HCM', 7480000, 'COD', 'Đã hủy', '2024-08-04 02:02:54', '2024-08-11 22:38:19', 96),
(98, 'Hoàng Thị Hậu', 'hoanghau46@gmail.com', '0309300046', '1 Lý Thái Tổ, Phường 1, Quận 10, TP.HCM', 15400000, 'COD', 'Đã hủy', '2024-08-05 00:38:16', '2024-08-11 22:47:18', 96),
(99, 'Phan Hùng', 'hungphan@gmail.com', '0939384675', '123 Hoàng Sơn, Đống Đa, Hà Nội', 17600000, 'COD', 'Đã hủy', '2024-08-05 06:11:19', '2024-08-05 06:11:23', 64),
(101, 'Hoàng Thị Hậu', 'hoanghau46@gmail.com', '0309300046', '1 Lý Thái Tổ, Phường 1, Quận 10, TP.HCM', 5500000, 'COD', 'Đã hủy', '2024-08-07 10:25:32', '2024-08-11 22:56:23', 96),
(102, 'Hoàng Thị Hậu', 'hoanghau46@gmail.com', '0309300046', '1 Lý Thái Tổ, Phường 1, Quận 10, TP.HCM', 17600000, 'momo', 'Đã giao', '2024-08-07 10:29:14', '2024-08-11 22:48:06', 96),
(108, 'Hoàng Thị Hậu', 'hoanghau46@gmail.com', '0309300046', '1 Lý Thái Tổ, Phường 1, Quận 10, TP.HCM', 4950000, 'COD', 'Đã hủy', '2024-08-07 10:34:46', '2024-08-11 23:00:09', 96),
(110, 'Phan Hùng', 'hungphan@gmail.com', '0939384675', '123 Hoàng Sơn, Đống Đa, Hà Nội', 17600000, 'COD', 'Đã hủy', '2024-08-09 03:09:28', '2024-08-09 03:11:26', 64),
(111, 'Phan Hùng', 'hungphan@gmail.com', '0939384675', '123 Hoàng Sơn, Đống Đa, Hà Nội', 5500000, 'COD', 'Đã hủy', '2024-08-09 03:09:37', '2024-08-09 03:11:29', 64),
(112, 'Phan Hùng', 'hungphan@gmail.com', '0939384675', '123 Hoàng Sơn, Đống Đa, Hà Nội', 5500000, 'COD', 'Đang giao', '2024-08-09 03:09:44', '2024-08-10 08:31:39', 64),
(120, 'Phan Hùng', 'hungphan@gmail.com', '0939384675', '123 Hoàng Sơn, Đống Đa, Hà Nội', 11000000, 'momo', 'Đã hủy', '2024-08-11 04:37:21', '2024-08-11 21:24:23', 64),
(122, 'Phan Hùng', 'hungphan@gmail.com', '0939384675', '123 Hoàng Sơn, Đống Đa, Hà Nội', 4950000, 'COD', 'Chưa xác nhận', '2024-08-11 21:44:31', '2024-08-11 21:44:31', 64),
(123, 'Phan Hùng', 'hungphan@gmail.com', '0939384675', '123 Hoàng Sơn, Đống Đa, Hà Nội', 3850000, 'momo', 'Đã thanh toán', '2024-08-11 21:47:42', '2024-08-11 21:47:42', 64),
(124, 'Hoàng Thị Hậu', 'hoanghau46@gmail.com', '0309300046', '1 Lý Thái Tổ, Phường 1, Quận 10, TP.HCM', 10450000, 'COD', 'Đã hủy', '2024-08-11 23:00:37', '2024-08-11 23:00:45', 96);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhsanphams`
--

CREATE TABLE `hinhsanphams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imgs` varchar(255) NOT NULL DEFAULT '',
  `loaihinh` int(11) NOT NULL DEFAULT 1,
  `sanpham_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hinhsanphams`
--

INSERT INTO `hinhsanphams` (`id`, `imgs`, `loaihinh`, `sanpham_id`, `created_at`, `updated_at`) VALUES
(1, '1721293326.jpg', 1, 1, NULL, '2024-07-18 02:02:06'),
(2, '1721294197.jpg', 1, 1, NULL, '2024-07-18 02:16:37'),
(3, '1721293630.jpg', 1, 1, NULL, '2024-07-18 02:07:10'),
(4, '1721293999.jpg', 1, 1, NULL, '2024-07-18 02:13:19'),
(6, '1721293638.jpg', 1, 1, NULL, '2024-07-18 02:07:18'),
(13, '1721755271.jpg', 1, 12, '2024-07-23 10:21:11', '2024-07-23 10:21:11'),
(14, '1721755288.jpg', 1, 12, '2024-07-23 10:21:28', '2024-07-23 10:21:28'),
(15, '1721755295.jpg', 1, 12, '2024-07-23 10:21:35', '2024-07-23 10:21:35'),
(16, '1721755306.jpg', 1, 12, '2024-07-23 10:21:46', '2024-07-23 10:21:46'),
(17, '1721755314.jpg', 1, 12, '2024-07-23 10:21:54', '2024-07-23 10:21:54'),
(19, '1721802570.jpg', 1, 29, '2024-07-23 23:27:11', '2024-07-23 23:29:30'),
(20, '1721802444.jpg', 1, 29, '2024-07-23 23:27:24', '2024-07-23 23:27:24'),
(21, '1721802455.jpg', 1, 29, '2024-07-23 23:27:35', '2024-07-23 23:27:35'),
(22, '1721802485.jpg', 1, 29, '2024-07-23 23:28:05', '2024-07-23 23:28:05'),
(23, '1722080049.jpg', 1, 29, '2024-07-23 23:29:19', '2024-07-27 04:34:09'),
(25, '1722181208.jpg', 1, 2, '2024-07-28 08:29:54', '2024-07-28 08:40:08'),
(26, '1722181158.jpg', 1, 2, '2024-07-28 08:39:18', '2024-07-28 08:39:18'),
(27, '1722181174.jpg', 1, 2, '2024-07-28 08:39:34', '2024-07-28 08:39:34'),
(28, '1722181224.jpg', 1, 2, '2024-07-28 08:40:24', '2024-07-28 08:40:24'),
(29, '1722181477.jpg', 1, 2, '2024-07-28 08:44:37', '2024-07-28 08:44:37'),
(30, '1722182586.jpg', 1, 33, '2024-07-28 09:03:06', '2024-07-28 09:03:06'),
(31, '1722182607.jpg', 1, 33, '2024-07-28 09:03:27', '2024-07-28 09:03:27'),
(32, '1722182618.jpg', 1, 33, '2024-07-28 09:03:38', '2024-07-28 09:03:38'),
(33, '1722182628.jpg', 1, 33, '2024-07-28 09:03:48', '2024-07-28 09:03:48'),
(34, '1722182640.jpg', 1, 33, '2024-07-28 09:04:00', '2024-07-28 09:04:00'),
(35, '1722183343.jpg', 1, 4, '2024-07-28 09:15:43', '2024-07-28 09:15:43'),
(36, '1722183363.jpg', 1, 4, '2024-07-28 09:16:03', '2024-07-28 09:16:03'),
(37, '1722183373.jpg', 1, 4, '2024-07-28 09:16:13', '2024-07-28 09:16:13'),
(38, '1722183386.jpg', 1, 4, '2024-07-28 09:16:26', '2024-07-28 09:16:26'),
(39, '1722183402.jpg', 1, 4, '2024-07-28 09:16:42', '2024-07-28 09:16:42'),
(40, '1722184006.jpg', 1, 6, '2024-07-28 09:26:46', '2024-07-28 09:26:46'),
(41, '1722184019.jpg', 1, 6, '2024-07-28 09:26:59', '2024-07-28 09:26:59'),
(42, '1722184031.jpg', 1, 6, '2024-07-28 09:27:11', '2024-07-28 09:27:11'),
(43, '1722184040.jpg', 1, 6, '2024-07-28 09:27:20', '2024-07-28 09:27:20'),
(44, '1722184050.jpg', 1, 6, '2024-07-28 09:27:30', '2024-07-28 09:27:30'),
(45, '1722184210.jpg', 1, 9, '2024-07-28 09:30:10', '2024-07-28 09:30:10'),
(46, '1722184393.jpg', 1, 9, '2024-07-28 09:33:13', '2024-07-28 09:33:13'),
(47, '1722184403.jpg', 1, 9, '2024-07-28 09:33:23', '2024-07-28 09:33:23'),
(48, '1722184412.jpg', 1, 9, '2024-07-28 09:33:32', '2024-07-28 09:33:32'),
(49, '1722184436.jpg', 1, 9, '2024-07-28 09:33:56', '2024-07-28 09:33:56'),
(50, '1722184761.jpg', 1, 10, '2024-07-28 09:38:58', '2024-07-28 09:39:21'),
(51, '1722184839.jpg', 1, 10, '2024-07-28 09:40:39', '2024-07-28 09:40:39'),
(52, '1722184857.jpg', 1, 10, '2024-07-28 09:40:57', '2024-07-28 09:40:57'),
(53, '1722184866.jpg', 1, 10, '2024-07-28 09:41:06', '2024-07-28 09:41:06'),
(54, '1722184874.jpg', 1, 10, '2024-07-28 09:41:14', '2024-07-28 09:41:14'),
(55, '1723119578.jpg', 1, 11, '2024-07-28 09:41:58', '2024-08-08 05:19:38'),
(58, '1723119602.jpg', 1, 11, '2024-08-08 05:20:02', '2024-08-08 05:20:02'),
(59, '1723119608.jpg', 1, 11, '2024-08-08 05:20:08', '2024-08-08 05:20:08'),
(60, '1723119615.jpg', 1, 11, '2024-08-08 05:20:15', '2024-08-08 05:20:15'),
(61, '1723119623.jpg', 1, 11, '2024-08-08 05:20:23', '2024-08-08 05:20:23'),
(62, '1723119666.jpg', 1, 30, '2024-08-08 05:21:06', '2024-08-08 05:21:06'),
(63, '1723119678.jpg', 1, 30, '2024-08-08 05:21:18', '2024-08-08 05:21:18'),
(64, '1723119699.jpg', 1, 30, '2024-08-08 05:21:39', '2024-08-08 05:21:39'),
(65, '1723119709.jpg', 1, 30, '2024-08-08 05:21:49', '2024-08-08 05:21:49'),
(66, '1723119721.jpg', 1, 30, '2024-08-08 05:22:01', '2024-08-08 05:22:01'),
(67, '1723120109.jpg', 1, 28, '2024-08-08 05:28:29', '2024-08-08 05:28:29'),
(68, '1723120126.jpg', 1, 28, '2024-08-08 05:28:46', '2024-08-08 05:28:46'),
(69, '1723120141.jpg', 1, 28, '2024-08-08 05:29:01', '2024-08-08 05:29:01'),
(70, '1723120150.jpg', 1, 28, '2024-08-08 05:29:10', '2024-08-08 05:29:10'),
(71, '1723120156.jpg', 1, 28, '2024-08-08 05:29:16', '2024-08-08 05:29:16'),
(72, '1723120226.jpg', 1, 31, '2024-08-08 05:30:26', '2024-08-08 05:30:26'),
(73, '1723120366.jpg', 1, 31, '2024-08-08 05:32:46', '2024-08-08 05:32:46'),
(74, '1723120372.jpg', 1, 31, '2024-08-08 05:32:52', '2024-08-08 05:32:52'),
(75, '1723120379.jpg', 1, 31, '2024-08-08 05:32:59', '2024-08-08 05:32:59'),
(76, '1723120385.jpg', 1, 31, '2024-08-08 05:33:05', '2024-08-08 05:33:05'),
(78, '1723121092.jpg', 1, 3, '2024-08-08 05:44:52', '2024-08-08 05:44:52'),
(79, '1723121136.jpg', 1, 3, '2024-08-08 05:45:36', '2024-08-08 05:45:36'),
(80, '1723121145.jpg', 1, 3, '2024-08-08 05:45:45', '2024-08-08 05:45:45'),
(81, '1723121150.jpg', 1, 3, '2024-08-08 05:45:50', '2024-08-08 05:45:50'),
(82, '1723121156.jpg', 1, 3, '2024-08-08 05:45:56', '2024-08-08 05:45:56'),
(83, '1723123071.jpg', 1, 36, '2024-08-08 06:17:51', '2024-08-08 06:17:51'),
(84, '1723123080.jpg', 1, 36, '2024-08-08 06:18:00', '2024-08-08 06:18:00'),
(85, '1723123092.jpg', 1, 36, '2024-08-08 06:18:12', '2024-08-08 06:18:12'),
(86, '1723123099.jpg', 1, 36, '2024-08-08 06:18:19', '2024-08-08 06:18:19'),
(87, '1723123107.jpg', 1, 36, '2024-08-08 06:18:27', '2024-08-08 06:18:27'),
(88, '1723123878.jpg', 1, 34, '2024-08-08 06:31:19', '2024-08-08 06:31:19'),
(89, '1723123889.jpg', 1, 34, '2024-08-08 06:31:29', '2024-08-08 06:31:29'),
(90, '1723123897.jpg', 1, 34, '2024-08-08 06:31:37', '2024-08-08 06:31:37'),
(91, '1723123909.jpg', 1, 34, '2024-08-08 06:31:49', '2024-08-08 06:31:49'),
(92, '1723123916.jpg', 1, 34, '2024-08-08 06:31:56', '2024-08-08 06:31:56'),
(93, '1723124389.jpg', 1, 38, '2024-08-08 06:39:49', '2024-08-08 06:39:49'),
(94, '1723124424.jpg', 1, 38, '2024-08-08 06:40:24', '2024-08-08 06:40:24'),
(95, '1723124476.jpg', 1, 38, '2024-08-08 06:41:16', '2024-08-08 06:41:16'),
(96, '1723124483.jpg', 1, 38, '2024-08-08 06:41:23', '2024-08-08 06:41:23'),
(97, '1723124489.jpg', 1, 38, '2024-08-08 06:41:29', '2024-08-08 06:41:29'),
(98, '1723125191.jpg', 1, 35, '2024-08-08 06:53:11', '2024-08-08 06:53:11'),
(99, '1723125215.jpg', 1, 35, '2024-08-08 06:53:35', '2024-08-08 06:53:35'),
(100, '1723125222.jpg', 1, 35, '2024-08-08 06:53:42', '2024-08-08 06:53:42'),
(101, '1723125234.jpg', 1, 35, '2024-08-08 06:53:54', '2024-08-08 06:53:54'),
(102, '1723125240.jpg', 1, 35, '2024-08-08 06:54:00', '2024-08-08 06:54:00'),
(103, '1723127050.jpg', 1, 37, '2024-08-08 07:24:10', '2024-08-08 07:24:10'),
(104, '1723127061.jpg', 1, 37, '2024-08-08 07:24:21', '2024-08-08 07:24:21'),
(105, '1723127067.jpg', 1, 37, '2024-08-08 07:24:27', '2024-08-08 07:24:27'),
(106, '1723127076.jpg', 1, 37, '2024-08-08 07:24:36', '2024-08-08 07:24:36'),
(107, '1723127084.jpg', 1, 37, '2024-08-08 07:24:44', '2024-08-08 07:24:44'),
(108, '1723127716.jpg', 1, 5, '2024-08-08 07:35:16', '2024-08-08 07:35:16'),
(109, '1723127727.jpg', 1, 5, '2024-08-08 07:35:27', '2024-08-08 07:35:27'),
(110, '1723127735.jpg', 1, 5, '2024-08-08 07:35:35', '2024-08-08 07:35:35'),
(111, '1723127740.jpg', 1, 5, '2024-08-08 07:35:40', '2024-08-08 07:35:40'),
(112, '1723127745.jpg', 1, 5, '2024-08-08 07:35:45', '2024-08-08 07:35:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(68, '2014_10_12_000000_create_users_table', 1),
(69, '2014_10_12_100000_create_password_resets_table', 1),
(70, '2019_08_19_000000_create_failed_jobs_table', 1),
(71, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(72, '2024_06_01_105451_create_donhangs_table', 1),
(73, '2024_06_01_105506_create_thuonghieus_table', 1),
(74, '2024_06_01_105535_create_danhmucs_table', 1),
(75, '2024_06_01_105733_create_sanphams_table', 1),
(76, '2024_06_01_105841_create_hinhsanphams_table', 1),
(77, '2024_06_01_105900_create_chitiet_donhangs_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('huylethanh2252@gmail.com', 'rPYTZfjBcLimevuoeB6y8TWTC2MXmCK4upqbrPlNveXLaNYFdTpk2mNNbX3i', '2024-08-06 23:18:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `comment` varchar(1000) DEFAULT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 0,
  `chitietdh_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `rating`, `comment`, `trangthai`, `chitietdh_id`, `created_at`, `updated_at`) VALUES
(5, 96, 5, 'tôi thấy đẹp', 1, 106, '2024-08-10 11:09:44', '2024-08-10 11:17:50'),
(6, 96, 5, 'siêu ưa chuộng', 0, 94, '2024-08-10 11:21:45', '2024-08-10 11:21:45'),
(23, 64, 5, 'Rất đẹp !', 1, 121, '2024-08-11 21:44:55', '2024-08-11 21:45:51'),
(24, 64, 5, NULL, 0, 109, '2024-08-12 02:41:45', '2024-08-12 02:41:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanphams`
--

CREATE TABLE `sanphams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL DEFAULT '',
  `size` int(11) NOT NULL DEFAULT 0,
  `gia` int(11) NOT NULL DEFAULT 0,
  `giaKM` int(11) DEFAULT NULL,
  `km_tungay` datetime DEFAULT NULL,
  `km_denngay` datetime DEFAULT NULL,
  `soluong` int(11) NOT NULL DEFAULT 0,
  `loai_day` varchar(255) NOT NULL,
  `loai_mat` varchar(255) NOT NULL,
  `loai_kinh` varchar(255) NOT NULL,
  `mau_day` varchar(255) NOT NULL,
  `mau_mat` varchar(255) NOT NULL,
  `mau_vo` varchar(255) NOT NULL,
  `nangluong` varchar(255) NOT NULL DEFAULT '',
  `mota` varchar(1200) NOT NULL,
  `trangthai` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `danhmuc_id` bigint(20) UNSIGNED NOT NULL,
  `thuonghieu_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanphams`
--

INSERT INTO `sanphams` (`id`, `name`, `slug`, `img`, `size`, `gia`, `giaKM`, `km_tungay`, `km_denngay`, `soluong`, `loai_day`, `loai_mat`, `loai_kinh`, `mau_day`, `mau_mat`, `mau_vo`, `nangluong`, `mota`, `trangthai`, `created_at`, `updated_at`, `danhmuc_id`, `thuonghieu_id`) VALUES
(1, 'Đồng hồ nam Rolex Datejust 126331', 'dong-ho-nam-rolex-1', '1722076152.jpg', 36, 5000000, 4500000, '2024-01-01 00:00:00', '2024-12-01 00:00:00', 2, 'Dây thép', 'Tròn', 'Kính saphire', 'Trắng', 'Nâu', 'Trắng', 'Pin', 'Đồng hồ Rolex Datejust 126231 có đường kính 36mm, được các nhà sản xuất thiết kế ưu ái hơn để dễ dàng phù hợp với nhiều dáng cổ tay. Không chỉ nam giới mà size 36mm cũng được nhiều bạn nữ lựa chọn để thể hiện cá tính của mình. Mẫu đồng hồ này có hai màu tươi sáng nhất là thép không gỉ màu bạc Oyster Steel và vàng hồng Everose cao cấp.', 1, '2024-06-01 14:12:10', '2024-08-11 23:00:45', 1, 1),
(2, 'Đồng hồ nữ Omega Constellation 131.10.36.20.06.00', 'dong-ho-nu-omega-2', 'Omega-Constellation 131-10-36-20-06-00.jpg', 36, 3000000, 2800000, '2024-01-01 00:00:00', '2024-10-01 00:00:00', 1, 'Dây thép', 'Tròn', 'Kính saphire', 'Bạc', 'Bạc', 'Bạc', 'Automatic', 'Thiết kế ấn tượng và bền bỉ của OMEGA Constellation được đặc trưng bởi hình bán nguyệt nổi tiếng, “móng vuốt” trên vỏ và dây đeo đơn rang. Mẫu thép không gỉ 36 mm này có gờ được khắc chữ số La Mã, mặt số màu xám rhodium dập nổi bằng lụa và cửa sổ ngày ở vị trí 6 giờ. Các kim, logo OMEGA, ngôi sao Constellation và các cọc số đều bằng vàng Sedna™ 18K.\r\nTrung tâm của chiếc đồng hồ này là bộ máy OMEGA Co-Axial Master Chronometer Calibre 8800, có thể nhìn thấy qua mặt kính sapphire hình vòm chống trầy xước.\r\nTổng trọng lượng sản phẩm (xấp xỉ): 145 g', 1, '2024-06-01 14:12:10', '2024-07-26 21:06:28', 2, 2),
(3, 'Đồng hồ đôi Longines La Grande Classique Đôi – Kính Sapphire – Quartz (Pin) – Dây Kim Loại (L4.709.2.11.8 – L4.209.2.11.8)', 'dong-ho-doi-longines-3', '1720934013.jpg', 33, 10000000, NULL, NULL, NULL, 5, 'Dây thép lưới', 'Tròn', 'Kính saphire', 'Vàng', 'Trắng', 'Vàng', 'Automatic', 'Đồng hồ Longines Đôi có vỏ và dây đeo kim loại màu vàng sáng bóng, kim chỉ và vạch số mỏng phủ màu đen nổi bật trên nền số màu trắng, mang đến vẻ thanh lịch sang trọng dành cho cặp đôi.', 1, '2024-06-01 14:12:10', '2024-07-17 02:02:10', 3, 3),
(4, 'Đồng hồ cơ nam Tissot Le Locle Powermatic 80 T006.407.16.033.00', 'dong-ho-co-tissot-4', '1720927017.jpg', 39, 10000000, 7000000, '2024-01-01 00:00:00', '2024-08-30 00:00:00', 10, 'Dây da', 'Tròn', 'Kính saphire', 'Đen', 'Bạc', 'Bạc', 'Automatic', 'Tissot Le Locle Powermatic 80 39.3mm T006.407.16.033.00 – Mẫu đồng hồ cơ cổ điển sang trọng của Tissot được đánh giá cao bởi bộ máy automatic tích cót lên đến 80 giờ. Thiết kế dây đeo da bò vân cá sấu kết hợp khóa bướm cao cấp chống nứt gãy.', 1, '2024-06-01 14:12:10', '2024-08-07 10:38:32', 1, 4),
(5, 'Đồng hồ điện tử Casio bgd-560-7dr', 'dong-ho-dien-tu-casio-5', '1720926642.jpg', 44, 2900000, 2100000, '2024-01-01 00:00:00', '2024-12-01 00:00:00', 18, 'Dây nhựa', 'Vuông', 'Kính mineral', 'Trắng', 'Trắng', 'Trắng', 'Pin', 'Phiên bản Baby-G BGD-560-7DR thiết kế mặt đồng hồ được tích hợp thêm ô số điện tử tăng thêm vẻ năng động, cùng với thiết kế phần vỏ máy cùng dây đeo được phối tông màu trắng mang đến một sắc màu dịu dàng cho các bạn nữ.', 1, '2024-06-01 14:12:10', '2024-08-08 07:37:08', 5, 5),
(6, 'Đồng Hồ nam Rolex Cellini Date 50515-0011', 'dong-ho-nam-rolex-2', '1723117693.jpg', 39, 5000000, 4500000, '2024-01-01 00:00:00', '2024-06-01 00:00:00', 3, 'Dây da', 'Tròn', 'Kính saphire', 'Đen', 'Đen', 'Đen', 'Automatic', 'Đồng hồ Rolex Celline Date 50515-0011 Mặt Số Đen Dây Đeo Da 39mm sở hữu bộ vỏ được gia công bằng chất liệu Vàng Hồng 18k sang trọng hàng đầu của Rolex, với dáng mặt số tròn kích thước 39mm lấy tone màu đen huyền bí làm chủ đạo, đặc biệt ở vành bezel và núm vặn đều được hoàn thiện bằng phương pháp chải rãnh đồng xu vừa toát lên vẻ đẹp lịch lãm đặc trưng, vừa giúp người đeo thao tác chỉnh giờ dễ dàng hơn. Ở vị trí góc 3 giờ chính là ô sổ phụ chỉ ngày đã góp phần khiến chiếc đồng hồ trở nên đẳng cấp hơn bao giờ hết. Mặt kính chất liệu Sapphire với khả năng chống sốc và chống xây xước tuyệt vời. Dây đeo da cá sấu cổ điển được tô điểm ấn tượng bởi những đường vân to vô cùng tinh tế đem lại khí chất mạnh mẽ cho các quý ông thượng lưu.', 1, '2024-06-04 07:19:12', '2024-08-11 23:00:45', 1, 1),
(9, 'Đồng hồ Omega De Ville 433.33.41.21.03.00', '', '1723117832.jpg', 41, 16000000, 14000000, '2024-06-11 00:00:00', '2024-07-31 00:00:00', 4, 'Dây da', 'Tròn', 'Kính saphire', 'Xanh dương', 'Xanh dương', 'Trắng', 'Pin', 'Với trình độ tay nghề phức tạp bên ngoài và cơ chế mang tính cách mạng bên trong, OMEGA Hour Vision là chiếc đồng hồ được cân bằng tinh tế về mọi mặt.\r\nĐược trình bày trên dây đeo bằng da màu xanh lam, vỏ được làm từ thép không gỉ, với mặt số màu xanh lam hai vùng độc đáo mang lại ấn tượng tinh tế ngay lập tức.\r\nCác kim mảnh và cọc số La Mã được chế tác từ vàng trắng 18K, trong khi ngày và tháng có thể được kiểm tra bằng cửa sổ lịch ngày ở vị trí 3 giờ.\r\nỞ bên trong, chiếc đồng hồ đẹp mang phong cách cổ điển này được vận hành bởi Co-Axial Master Chronometer Calibre 8902 của OMEGA, một bộ chuyển động hiện đại có thể chống lại từ trường lên tới 15.000 gauss.', 1, '2024-06-09 06:30:58', '2024-08-09 03:09:28', 1, 2),
(10, 'Đồng hồ  Yellow Gold Gilt Dial Square Case Wristwatch Ref 9347', '', '1723117808.jpg', 41, 4000000, 3500000, '2024-06-11 00:00:00', '2024-08-02 00:00:00', 5, 'Dây thép', 'Vuông', 'Kính saphire', 'Vàng', 'Nâu', 'Vàng', 'Automatic', 'Một ví dụ đặc biệt hiếm gặp sẽ phù hợp với người sưu tập đồ hiếm cổ điển, được chú ý bởi nhiều chi tiết đặc biệt. Rolex sản xuất rất ít đồng hồ vỏ vuông thuộc bất kỳ loại nào. Chiếc đồng hồ này có viền có kết cấu khác thường với các góc được đánh bóng, mặt số mạ vàng màu đen với nhiều loại điểm đánh dấu độc đáo và dây đeo hoàn toàn nguyên bản của nhà máy Rolex với logo \"Rolex\" lớn được đánh dấu bên trong móc cài. Đồng hồ có kích thước 26 x 26mm nhưng lại có kích thước lớn hơn so với các phiên bản vỏ tròn. Tình trạng cổ điển tuyệt vời.', 1, '2024-06-12 08:54:29', '2024-08-08 04:50:08', 1, 1),
(11, 'Đồng Hồ Nữ Omega Seamaster AquaTerra Master Co-Axial 34mm – 23158342055003', '', '1723119559.jpg', 34, 4000000, 3500000, '2024-06-13 00:00:00', '2024-09-25 00:00:00', 5, 'Dây da', 'Tròn', 'Kính saphire', 'Trắng', 'Trắng', 'Vàng', 'Automatic', 'Omega Seamaster Aqua Terra 150M Master Co-Axial Chronometer 34mm 231.58.34.20.55.003 – 23158342055003\r\nMẫu đồng hồ sang trọng này có mặt số làm bằng ngọc trai với 12 viên kim cương. Cùng với bộ niềng kim cương tự nhiên quý giá kết hợp với thân vàng khối 18K.', 1, '2024-06-14 05:40:29', '2024-08-11 21:47:42', 2, 2),
(12, 'Đồng hồ nam CASIO W-218H-4B', '', 'CASIO W-218H-4B.jpg', 43, 800000, NULL, NULL, NULL, 20, 'Dây cao su', 'Vuông', 'Kính acrylic', 'Đỏ', 'Xám', 'Đen', 'Pin', 'Thương hiệu đồng hồ Casio Nhật Bản đã thành công chế tác ra chiếc đồng hồ CASIO W-218H-4B – chiếc đồng hồ điện tử huyền thoại nổi tiếng với thiết kế cổ điển, phong cách thời trang với nhiều tính năng tiện ích. Huyền thoại của dòng thể thao điện tử gọi tên Casio W-218H-4B. Mặt đồng hồ thiết kế vuông vắn, tối giản, thông tin hiển thị tiện dụng mà giá thành lại rất “mềm”, đây xứng đáng là chiếc đồng hồ phong cách thể thao rất đáng để bạn đầu tư.', 1, '2024-06-14 05:51:20', '2024-08-08 03:24:12', 1, 5),
(28, 'Đồng hồ Citizen EM0493-85P', '', '1720935643.jpg', 28, 6000000, NULL, NULL, NULL, 6, 'Dây thép lưới', 'Vuông', 'Kính saphire', 'Vàng', 'Trắng', 'Vàng', 'Eco', 'Mẫu Citizen Eco-Drive EM0493-85P sang trọng với thiết kế đính 2 viên pha lê tại vị trí 12 giờ trên nền mặt số vuông được phối tone màu trắng ngà.', 1, '2024-07-13 22:40:43', '2024-08-11 21:22:55', 2, 8),
(29, 'Đồng hồ Citizen EM0899-81X', '', '1720945171.jpg', 30, 8200000, 6800000, '2024-07-01 15:18:00', '2024-11-30 15:18:00', 7, 'Dây thép lưới', 'Tròn', 'Kính saphire', 'Bạc', 'Hồng', 'Bạc', 'Eco', 'Citizen nữ 30mm Eco-Drive EM0899-81X kiểu dáng thanh lịch ấn tượng bởi 3 kim Leaf uyển chuyển trên nền mặt số hồng nhạt, dây đeo thép lưới Milanese hiện đại sang trọng dành cho quý cô.', 1, '2024-07-14 01:19:31', '2024-08-09 03:10:02', 2, 8),
(30, 'Đồng hồ nam Citizen C7 NH8390-71L', '', '1720945390.jpg', 40, 8000000, NULL, NULL, NULL, 14, 'Dây thép', 'Tròn', 'Kính saphire', 'Bạc', 'Xanh dương', 'Bạc', 'Automatic', 'Citizen C7 NH8390-71L phiên bản nền mặt số xanh size 40mm với họa tiết trải tia nhẹ phong cách trẻ trung với thiết kế đơn giản 3 kim.', 1, '2024-07-14 01:23:10', '2024-07-14 01:23:10', 1, 8),
(31, 'Đồng hồ nữ Casio B640WC-5ADF', '', '1720946066.jpg', 38, 2000000, NULL, NULL, NULL, 13, 'Dây thép', 'Tonneau', 'Kính acrylic', 'Hồng', 'Hồng', 'Hồng', 'Pin', 'Casio B640WC-5ADF là phiên bản dùng được cho cả nam lẫn nữ nhờ đặc trưng riêng dòng đồng hồ điện tử. Với ưu điểm máy quartz, nhiều tiện ích, phối màu vàng hồng trẻ trung đúng xu hướng đã giúp thiết kế chinh phục hàng triệu bạn trẻ đam mê thời trang – phong cách.', 1, '2024-07-14 01:34:26', '2024-07-28 19:30:41', 2, 5),
(33, 'Đồng Hồ  Datejust 278384RBR', '', '1722182529.jpg', 31, 21000000, NULL, NULL, NULL, 0, 'Dây thép', 'Tròn', 'Kính saphire', 'Bạc', 'Đen', 'Bạc', 'Automatic', 'Đồng hồ Oyster Perpetual Datejust 31 bằng Thép Oystersteel và vàng trắng đi kèm mặt số màu đen sáng và dây đeo Jubilee.', 1, '2024-07-14 06:09:59', '2024-07-28 09:02:09', 2, 1),
(34, 'Casio Đôi – Quartz (Pin) – Dây Da (MTP-1308L-1AVDF – LTP-1308L-1AVDF) – Mặt Số 43mm – 31mm', '', '1721710992.jpg', 43, 3200000, 2700000, '2024-07-01 12:02:00', '2024-10-30 12:02:00', 10, 'Dây da', 'Tròn', 'Kính mineral', 'Đen', 'Đen', 'Trắng', 'Pin', 'Mẫu Casio đôi dây da phiên bản tạo hình vân lịch lãm, thiết kế đơn giản chức năng 3 kim 1 lịch, chi tiết vạch số mạ bạc sang trọng nổi bật trên nền mặt số đen.', 1, '2024-07-22 22:03:12', '2024-07-22 22:03:12', 3, 5),
(35, 'Casio Đôi – Quartz (Pin) – Dây Kim Loại (MTP-V300G-1AUDF – LTP-V300G-1AUDF) – Mặt Số 38mm – 33mm', '', '1721711270.jpg', 38, 4700000, NULL, NULL, NULL, 20, 'Dây thép', 'Tròn', 'Kính mineral', 'Vàng', 'Đen', 'Vàng', 'Pin', 'Mẫu Casio đôi mạ vàng sang trọng trên phần dây vỏ đồng hồ, thiết kế độc đáo với các ô lịch tạo nên kiểu dáng 6 kim trên nền mặt số.', 0, '2024-07-22 22:07:50', '2024-08-11 08:30:05', 3, 5),
(36, 'Citizen Đôi – Kính Sapphire – Eco-Drive (Năng Lượng Ánh Sáng) – Dây Kim Loại (BJ6481-58E – EM0401-59E)', '', '1723123017.jpg', 37, 15600000, 13200000, '2024-07-01 12:09:00', '2024-12-31 12:09:00', 10, 'Dây thép', 'Tròn', 'Kính saphire', 'Bạc', 'Đen', 'Bạc', 'Eco', 'Đồng hồ đôi Citizen với kim chỉ cùng vạch số thiết kế giản dị trên nền kính Sapphire nổi bật với nền mặt số màu đen huyền bí, vỏ máy cùng dây đeo kim loại màu bạc, đem lại vẻ giản dị sang trọng.', 1, '2024-07-22 22:11:41', '2024-08-08 06:16:57', 3, 8),
(37, 'Tissot Đôi – Kính Sapphire – Quartz (Pin) – Dây Da (T101.410.26.031.00 – T101.210.26.036.00)', '', '1721711928.jpg', 39, 22700000, 19000000, '2024-07-10 12:17:00', '2024-10-01 12:17:00', 4, 'Dây da', 'Tròn', 'Kính saphire', 'Nâu', 'Trắng', 'Vàng', 'Pin', 'Đồng hồ đôi Tissot với xu hướng giản dị, mặt đồng hồ tròn với viền ngoài mạ đồng nổi bật trên nền kính Sapphire, vỏ máy bằng thép không gỉ phối cùng dây đeo bằng da đem lại phong cách đầy cổ điển cho cặp đôi.', 1, '2024-07-22 22:18:48', '2024-07-22 22:18:48', 3, 4),
(38, 'Casio Đôi – Quartz (Pin) – Dây Kim Loại (MTP-V004D-7BUDF – LTP-V004D-7BUDF) – Mặt Số 42mm -30 mm', '', '1721712268.jpg', 42, 2000000, NULL, NULL, NULL, 20, 'Dây thép', 'Tròn', 'Kính saphire', 'Trắng', 'Trắng', 'Trắng', 'Pin', 'Mẫu Casio đôi thiết kế mỏng thời trang với phần vỏ máy pin chỉ 8mm, mặt số trắng kiểu dáng đơn giản 3 kim 1 lịch.', 1, '2024-07-22 22:24:28', '2024-08-11 08:44:14', 3, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuonghieus`
--

CREATE TABLE `thuonghieus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenTH` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thuonghieus`
--

INSERT INTO `thuonghieus` (`id`, `tenTH`, `created_at`, `updated_at`) VALUES
(1, 'Rolex', '2024-06-01 14:12:10', '2024-07-06 11:22:21'),
(2, 'Omega', '2024-06-01 14:12:10', '2024-06-01 14:12:10'),
(3, 'Longines', '2024-06-01 14:12:10', '2024-07-13 20:21:54'),
(4, 'Tissot', '2024-06-01 14:12:10', '2024-06-01 14:12:10'),
(5, 'Casio', '2024-06-01 14:12:10', '2024-06-01 14:12:10'),
(6, 'Seiko', '2024-06-07 04:53:30', '2024-06-07 04:53:30'),
(8, 'Citizen', '2024-06-07 05:01:00', '2024-06-07 05:01:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avt` varchar(255) DEFAULT NULL,
  `sdt` varchar(255) DEFAULT NULL,
  `gioitinh` tinyint(4) NOT NULL DEFAULT 0,
  `diachi` varchar(255) DEFAULT NULL,
  `loai` tinyint(4) NOT NULL DEFAULT 0,
  `trangthai` tinyint(4) NOT NULL DEFAULT 1,
  `google_id` varchar(255) DEFAULT NULL,
  `google_token` varchar(500) DEFAULT NULL,
  `github_id` varchar(255) DEFAULT NULL,
  `github_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avt`, `sdt`, `gioitinh`, `diachi`, `loai`, `trangthai`, `google_id`, `google_token`, `github_id`, `github_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyen Van A', 'nguyenvana@example.com', '2024-06-01 14:12:10', '$2y$10$8Ex.FpV/o9GI/zy/N1WEsugPgFRXGA/6DE2KlExoP/AZKr0yjpYZa', '1723117287.jpg', '033333344', 0, '123 ABC Street, XYZ City', 0, 1, NULL, NULL, NULL, NULL, NULL, '2024-06-01 14:12:10', '2024-08-08 04:41:27'),
(2, 'Tran Thi B', 'tranthib@example.com', '2024-06-01 14:12:10', '$2y$10$8Ex.FpV/o9GI/zy/N1WEsugPgFRXGA/6DE2KlExoP/AZKr0yjpYZa', '1723117300.jpg', '0987654321', 1, '456 XYZ Street, ABC City', 0, 1, NULL, NULL, NULL, NULL, NULL, '2024-06-01 14:12:10', '2024-08-08 04:41:40'),
(3, 'Le Van C', 'levanc@example.com', '2024-06-01 14:12:10', '$2y$10$8Ex.FpV/o9GI/zy/N1WEsugPgFRXGA/6DE2KlExoP/AZKr0yjpYZa', '1723117313.jpg', '0456123789', 0, '789 XYZ Street, ABC City', 0, 1, NULL, NULL, NULL, NULL, NULL, '2024-06-01 14:12:10', '2024-08-08 04:41:53'),
(4, 'Pham Thi D', 'phamthid@example.com', '2024-06-01 14:12:10', '$2y$10$8Ex.FpV/o9GI/zy/N1WEsugPgFRXGA/6DE2KlExoP/AZKr0yjpYZa', '1723117246.jpg', '0321654987', 1, '987 ABC Street, XYZ City', 0, 1, NULL, NULL, NULL, NULL, NULL, '2024-06-01 14:12:10', '2024-08-08 04:40:46'),
(5, 'Hoang Van E', 'hoangvane@example.com', '2024-06-01 14:12:10', '$2y$10$8Ex.FpV/o9GI/zy/N1WEsugPgFRXGA/6DE2KlExoP/AZKr0yjpYZa', '1723117326.jpg', '0789123456', 0, '0456 ABC Street, XYZ City', 0, 1, NULL, NULL, NULL, NULL, NULL, '2024-06-01 14:12:10', '2024-08-08 04:42:06'),
(7, 'admin', 'admin@example.com', '2024-06-02 14:04:57', '$2y$10$ubYcx1U8.YTsXxd4dDwbIeDVk/fZ9eLKxGZl95Ru0WmsrkGh5WHhu', '1723117271.jpg', '0123456789', 0, '123 ABC Street, XYZ City', 1, 1, NULL, NULL, NULL, NULL, NULL, '2024-06-02 14:04:57', '2024-08-08 04:41:11'),
(16, 'Nguyễn Thị Hoa', 'nguyenthihoa@gmail.com', '2024-06-04 08:24:41', '$2y$10$8Ex.FpV/o9GI/zy/N1WEsugPgFRXGA/6DE2KlExoP/AZKr0yjpYZa', '1723117143.jpg', '0977556644', 1, '456 Cao Lỗ, Phường 4, Quận 8, tp.HCM', 0, 1, NULL, NULL, NULL, NULL, NULL, '2024-06-04 08:24:41', '2024-08-10 00:27:44'),
(18, 'Phan Thị Ngọc Bích', 'ngocbich@gmail.com', '2024-06-04 08:26:53', '$2y$10$8Ex.FpV/o9GI/zy/N1WEsugPgFRXGA/6DE2KlExoP/AZKr0yjpYZa', '1723117133.jpg', '0476634535', 1, '111 Nguyễn Chí Thanh, phường 5, Quận 10, tp.HCM', 0, 0, NULL, NULL, NULL, NULL, NULL, '2024-06-04 08:26:53', '2024-08-11 08:03:25'),
(19, 'Lê Chí Tài', 'chitai@gmail.com', '2024-06-04 08:31:42', '$2y$10$8Ex.FpV/o9GI/zy/N1WEsugPgFRXGA/6DE2KlExoP/AZKr0yjpYZa', '', '0987877665', 0, '22 CMT8, phường 10, quận 3, tp.HCM', 0, 1, NULL, NULL, NULL, NULL, NULL, '2024-06-04 08:31:42', '2024-08-08 04:38:41'),
(64, 'Phan Hùng', 'hungphan@gmail.com', '2024-07-06 10:43:18', '$2y$10$8Ex.FpV/o9GI/zy/N1WEsugPgFRXGA/6DE2KlExoP/AZKr0yjpYZa', '1721312117.jpg', '0939384675', 0, '123 Hoàng Sơn, Đống Đa, Hà Nội', 0, 1, NULL, NULL, NULL, NULL, NULL, '2024-07-06 10:43:18', '2024-08-11 04:35:55'),
(96, 'Hoàng Thị Hậu', 'hoanghau46@gmail.com', '2024-08-04 02:01:33', '$2y$10$8Ex.FpV/o9GI/zy/N1WEsugPgFRXGA/6DE2KlExoP/AZKr0yjpYZa', NULL, '0309300046', 1, '1 Lý Thái Tổ, Phường 1, Quận 10, TP.HCM', 0, 1, NULL, NULL, NULL, NULL, NULL, '2024-08-04 02:01:33', '2024-08-05 02:25:10');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitiet_donhangs`
--
ALTER TABLE `chitiet_donhangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chitiet_donhangs_sanpham_id_foreign` (`sanpham_id`),
  ADD KEY `chitiet_donhangs_donhang_id_foreign` (`donhang_id`);

--
-- Chỉ mục cho bảng `danhmucs`
--
ALTER TABLE `danhmucs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `donhangs`
--
ALTER TABLE `donhangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donhangs_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `hinhsanphams`
--
ALTER TABLE `hinhsanphams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hinhsanphams_sanpham_id_foreign` (`sanpham_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_users_id_foreign` (`user_id`),
  ADD KEY `ratings_chitiet_donhangs_id_foreign` (`chitietdh_id`);

--
-- Chỉ mục cho bảng `sanphams`
--
ALTER TABLE `sanphams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sanphams_danhmuc_id_foreign` (`danhmuc_id`),
  ADD KEY `sanphams_thuonghieu_id_foreign` (`thuonghieu_id`);

--
-- Chỉ mục cho bảng `thuonghieus`
--
ALTER TABLE `thuonghieus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitiet_donhangs`
--
ALTER TABLE `chitiet_donhangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT cho bảng `danhmucs`
--
ALTER TABLE `danhmucs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `donhangs`
--
ALTER TABLE `donhangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hinhsanphams`
--
ALTER TABLE `hinhsanphams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `sanphams`
--
ALTER TABLE `sanphams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `thuonghieus`
--
ALTER TABLE `thuonghieus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiet_donhangs`
--
ALTER TABLE `chitiet_donhangs`
  ADD CONSTRAINT `chitiet_donhangs_donhang_id_foreign` FOREIGN KEY (`donhang_id`) REFERENCES `donhangs` (`id`),
  ADD CONSTRAINT `chitiet_donhangs_sanpham_id_foreign` FOREIGN KEY (`sanpham_id`) REFERENCES `sanphams` (`id`);

--
-- Các ràng buộc cho bảng `donhangs`
--
ALTER TABLE `donhangs`
  ADD CONSTRAINT `donhangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `hinhsanphams`
--
ALTER TABLE `hinhsanphams`
  ADD CONSTRAINT `hinhsanphams_sanpham_id_foreign` FOREIGN KEY (`sanpham_id`) REFERENCES `sanphams` (`id`);

--
-- Các ràng buộc cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_chitiet_donhangs_id_foreign` FOREIGN KEY (`chitietdh_id`) REFERENCES `chitiet_donhangs` (`id`),
  ADD CONSTRAINT `ratings_users_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `sanphams`
--
ALTER TABLE `sanphams`
  ADD CONSTRAINT `sanphams_danhmuc_id_foreign` FOREIGN KEY (`danhmuc_id`) REFERENCES `danhmucs` (`id`),
  ADD CONSTRAINT `sanphams_thuonghieu_id_foreign` FOREIGN KEY (`thuonghieu_id`) REFERENCES `thuonghieus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
