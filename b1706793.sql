-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 10, 2021 lúc 02:25 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `b1706793`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `id` int(11) NOT NULL,
  `dh_id` int(11) NOT NULL,
  `mshh` varchar(5) NOT NULL,
  `soluong` tinyint(4) NOT NULL,
  `gia` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `chitietdathang`
--

INSERT INTO `chitietdathang` (`id`, `dh_id`, `mshh`, `soluong`, `gia`) VALUES
(26, 28, '30001', 1, 23990000),
(27, 29, '30001', 1, 23990000),
(28, 29, '90006', 2, 2100000),
(29, 30, '10001', 1, 30990000),
(30, 30, '20001', 1, 29990000),
(38, 35, '10002', 1, 25990000),
(39, 35, '90004', 1, 6990000),
(58, 45, '20001', 1, 29990000),
(61, 48, '10001', 1, 30990000),
(62, 48, '20003', 1, 26990000),
(89, 66, '10001', 1, 30990000),
(90, 66, '20001', 1, 29990000),
(91, 67, '20002', 1, 23990000),
(92, 67, '90003', 1, 8490000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `dh_id` int(11) NOT NULL,
  `SoDienThoai` varchar(10) NOT NULL,
  `HoTen` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nv_id` int(11) DEFAULT NULL,
  `DiaChi` varchar(100) CHARACTER SET utf8 NOT NULL,
  `chuthich` text CHARACTER SET utf8 NOT NULL,
  `tonggia` int(11) NOT NULL,
  `NgayDH` int(11) DEFAULT NULL,
  `TrangThai` tinyint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `dathang`
--

INSERT INTO `dathang` (`dh_id`, `SoDienThoai`, `HoTen`, `nv_id`, `DiaChi`, `chuthich`, `tonggia`, `NgayDH`, `TrangThai`) VALUES
(28, '0386580528', 'Kha Thiên Duy', 3, 'Ninh Kieu, Can Tho', '', 23990000, 1606554573, 2),
(29, '0386580528', 'Kha Thiên Duy', 1, 'Ninh Kieu, Can Tho', '', 28190000, 1606563735, 1),
(30, '1234567890', 'Đặng Hoài Linh', NULL, 'Cà Mau', '', 60980000, 1606676280, 0),
(35, '0386580528', 'Kha Thiên Duy', NULL, 'Ninh Kieu, Can Tho', '', 32980000, 1609170082, 0),
(45, '0386580528', 'Kha Thiên Duy', NULL, 'Ninh Kieu, Can Tho', '', 29990000, 1609277472, 0),
(48, '0386580528', 'Kha Thiên Duy', 1, 'Ninh Kieu, Can Tho', '', 57980000, 1609776435, 2),
(66, '0386580528', 'Kha Thiên Duy', 1, 'Ninh Kieu, Can Tho', '', 60980000, 1609811655, 1),
(67, '1234567893', 'Kha Ngọc Anh Thư', 1, 'Tân Hiệp, Kiên Giang', '', 32480000, 1610185838, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `mshh` varchar(5) NOT NULL,
  `tenhh` varchar(50) CHARACTER SET utf8 NOT NULL,
  `gia` int(11) NOT NULL,
  `soluonghang` tinyint(4) NOT NULL,
  `manhom` varchar(5) NOT NULL,
  `hinh` varchar(50) NOT NULL,
  `motahh` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`mshh`, `tenhh`, `gia`, `soluonghang`, `manhom`, `hinh`, `motahh`) VALUES
('10001', 'iPhone 11 Pro 64GB', 30990000, 98, '10000', 'images/iphone1.png', NULL),
('10002', 'iPhone Xs Max 64GB', 25990000, 99, '10000', 'images/iphone2.png', NULL),
('10003', 'iPhone 8 Plus 64GB', 15990000, 99, '10000', 'images/iphone3.png', NULL),
('10004', 'iPhone 7 Plus 32GB', 9990000, 99, '10000', 'images/iphone4.png', NULL),
('20001', 'Samsung Galaxy S20 Ultra', 29990000, 98, '20000', 'images/samsung1.png', NULL),
('20002', 'Samsung Galaxy S20+', 23990000, 98, '20000', 'images/samsung2.png', NULL),
('20003', 'Samsung Galaxy Note 10+', 26990000, 99, '20000', 'images/samsung3.png', NULL),
('20004', 'Samsung Galaxy Note 10', 20990000, 99, '20000', 'images/samsung4.png', NULL),
('20005', 'Samsung Galaxy Note 20 Ultra', 25990000, 99, '20000', 'images/samsung5.png', NULL),
('30001', 'OPPO Find X2', 23990000, 99, '30000', 'images/oppo1.png', NULL),
('30002', 'OPPO Reno3 Pro', 13990000, 99, '30000', 'images/oppo2.png', NULL),
('30003', 'OPPO Reno2 F', 7490000, 99, '30000', 'images/oppo3.png', NULL),
('30004', 'OPPO A9 (2020)', 5990000, 99, '30000', 'images/oppo4.png', NULL),
('40001', 'Realme 6 (4GB/128GB)', 5690000, 99, '40000', 'images/realme1.png', NULL),
('40002', 'Realme 6 Pro', 7990000, 99, '40000', 'images/realme2.png', NULL),
('40003', 'Realme 5i (4GB/64GB)', 3690000, 99, '40000', 'images/realme3.png', NULL),
('40004', 'Realme C11', 2690000, 99, '40000', 'images/realme4.png', NULL),
('50001', 'Xiaomi Redmi Note 9 Pro', 6990000, 99, '50000', 'images/xiaomi1.png', NULL),
('50002', 'Xiaomi Redmi Note 9', 4990000, 99, '50000', 'images/xiaomi2.png', NULL),
('50003', 'Xiaomi Redmi Note 8', 4990000, 99, '50000', 'images/xiaomi3.png', NULL),
('50004', 'Xiaomi Redmi Note 7', 3990000, 99, '50000', 'images/xiaomi4.png', NULL),
('90001', 'Pin sạc dự phòng Polymer 20.000mAh Xiaomi Pro Đen', 1490000, 99, '90000', 'images/phukien1.png', NULL),
('90002', 'Pin sạc dự phòng Polymer 20.000mAh Anker Pro', 1200000, 99, '90000', 'images/phukien2.png', NULL),
('90003', 'Tai nghe chụp tai Bluetooth Sony WH-1000XM4', 8490000, 98, '90000', 'images/phukien3.png', NULL),
('90004', 'Tai nghe AirPods Pro sạc không dây Apple MWP22', 6990000, 98, '90000', 'images/phukien4.png', NULL),
('90005', 'Loa Bluetooth Anker Soundcore Motion Q A3108 Đen', 1500000, 99, '90000', 'images/phukien5.png', NULL),
('90006', 'Loa Bluetooth Anker Soundcore Flare 2 A3165 Đen', 2100000, 99, '90000', 'images/phukien6.png', NULL),
('90007', 'Thẻ nhớ MicroSD 200 GB SanDisk Class 10', 1680000, 99, '90000', 'images/phukien7.png', NULL),
('90008', 'Thẻ nhớ MicroSD 128 GB Class 10', 872000, 99, '90000', 'images/phukien8.png', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `SoDienThoai` varchar(10) NOT NULL,
  `HoTenKH` varchar(50) CHARACTER SET utf8 NOT NULL,
  `DiaChi` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `MatKhau` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`SoDienThoai`, `HoTenKH`, `DiaChi`, `MatKhau`, `Email`) VALUES
('0386580528', 'Kha Thiên Duy', 'Ninh Kieu, Can Tho', '202cb962ac59075b964b07152d234b70', 'khathienduy@gmail.com'),
('1234567890', 'Đặng Hoài Linh', 'Cà Mau', '202cb962ac59075b964b07152d234b70', 'danghoailinh@gmail.com'),
('1234567891', 'Nguyễn Văn Vỏ', 'Việt Nam', '202cb962ac59075b964b07152d234b70', 'nguyenvanvo@gmail.com'),
('1234567892', 'test', '123', '202cb962ac59075b964b07152d234b70', 'test@gmail.com'),
('1234567893', 'Kha Ngọc Anh Thư', 'Tân Hiệp, Kiên Giang', '202cb962ac59075b964b07152d234b70', 'anhthu2009@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhomhanghoa`
--

CREATE TABLE `nhomhanghoa` (
  `manhom` varchar(5) NOT NULL,
  `tennhom` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `nhomhanghoa`
--

INSERT INTO `nhomhanghoa` (`manhom`, `tennhom`) VALUES
('10000', 'Apple'),
('20000', 'Samsung'),
('30000', 'Oppo'),
('40000', 'Realme'),
('50000', 'Xiaomi'),
('90000', 'Phụ Kiện');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `password`, `created_time`) VALUES
(1, 'admin', 'Kha Thiên Duy', '202cb962ac59075b964b07152d234b70', 0),
(2, 'employee', 'Phan Thanh Thành', '202cb962ac59075b964b07152d234b70', 1606593507),
(3, 'employee2', 'Đặng Hoài Linh', '202cb962ac59075b964b07152d234b70', 1606675558);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dh_id` (`dh_id`),
  ADD KEY `mshh` (`mshh`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`dh_id`),
  ADD KEY `SoDienThoai` (`SoDienThoai`),
  ADD KEY `nv_id` (`nv_id`);

--
-- Chỉ mục cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`mshh`),
  ADD KEY `manhom` (`manhom`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`SoDienThoai`);

--
-- Chỉ mục cho bảng `nhomhanghoa`
--
ALTER TABLE `nhomhanghoa`
  ADD PRIMARY KEY (`manhom`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT cho bảng `dathang`
--
ALTER TABLE `dathang`
  MODIFY `dh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `chitietdathang_ibfk_1` FOREIGN KEY (`mshh`) REFERENCES `hanghoa` (`mshh`),
  ADD CONSTRAINT `chitietdathang_ibfk_2` FOREIGN KEY (`dh_id`) REFERENCES `dathang` (`dh_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `dathang_ibfk_1` FOREIGN KEY (`SoDienThoai`) REFERENCES `khachhang` (`SoDienThoai`),
  ADD CONSTRAINT `dathang_ibfk_2` FOREIGN KEY (`nv_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `hanghoa_ibfk_1` FOREIGN KEY (`manhom`) REFERENCES `nhomhanghoa` (`manhom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
