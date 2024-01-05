-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2023 at 12:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bandienmay`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `email`, `password`, `admin_name`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Phong Nguyễn');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_baiviet`
--

CREATE TABLE `tbl_baiviet` (
  `baiviet_id` int(11) NOT NULL,
  `tenbaiviet` varchar(100) NOT NULL,
  `tomtat` text NOT NULL,
  `noidung` text NOT NULL,
  `image` text NOT NULL,
  `danhmuctin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_baiviet`
--

INSERT INTO `tbl_baiviet` (`baiviet_id`, `tenbaiviet`, `tomtat`, `noidung`, `image`, `danhmuctin_id`) VALUES
(1, 'Cách kết nối iPhone với Windows 11 chỉ trong vòng một nốt nhạc đơn giản', 'Hiện nay, Microsoft đã cho phép người dùng kết nối iPhone với máy tính chạy hệ điều hành Windows 11 bằng ứng dụng Phone Link. Việc kết nối này sẽ giúp bạn có thể nhận tin nhắn, nhận cuộc gọi trực tiếp trên máy tính mà không cần dùng đến điện thoại cực kỳ nhanh chóng.\n                    Vậy trong bài viết này mình sẽ chia sẻ cách kết nối iPhone với Windows 11 rất dễ thôi nha.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', 'tintuc.jpg', 1),
(2, 'Cách kết nối iPhone với Windows 11 chỉ trong vòng một nốt nhạc đơn giản', 'Hiện nay, Microsoft đã cho phép người dùng kết nối iPhone với máy tính chạy hệ điều hành Windows 11 bằng ứng dụng Phone Link. Việc kết nối này sẽ giúp bạn có thể nhận tin nhắn, nhận cuộc gọi trực tiếp trên máy tính mà không cần dùng đến điện thoại cực kỳ nhanh chóng.\n                    Vậy trong bài viết này mình sẽ chia sẻ cách kết nối iPhone với Windows 11 rất dễ thôi nha.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', 'tintuc.jpg', 2),
(3, 'quốc màng tang', 'kjskahdasadsa', 'djfksdfhuhadsad', 'a3.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(1, 'Tủ lạnh'),
(2, 'Máy giặt'),
(3, 'Laptop'),
(4, 'Điện thoại'),
(5, 'Tivi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_danhmuctin`
--

CREATE TABLE `tbl_danhmuctin` (
  `danhmuctin_id` int(11) NOT NULL,
  `tendanhmuc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_danhmuctin`
--

INSERT INTO `tbl_danhmuctin` (`danhmuctin_id`, `tendanhmuc`) VALUES
(1, 'Tin tức laptop'),
(2, 'Tin tức máy lạnh');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_donhang`
--

CREATE TABLE `tbl_donhang` (
  `donhang_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `mahang` varchar(50) NOT NULL,
  `khachhang_id` int(11) NOT NULL,
  `ngaythang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tinhtrang` int(11) NOT NULL,
  `huydon` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_donhang`
--

INSERT INTO `tbl_donhang` (`donhang_id`, `product_id`, `soluong`, `mahang`, `khachhang_id`, `ngaythang`, `tinhtrang`, `huydon`) VALUES
(8, 8, 1, '7488', 11, '2023-12-06 08:22:40', 1, 0),
(9, 3, 3, '8022', 12, '2023-11-30 11:08:53', 0, 0),
(10, 3, 1, '4882', 9, '2023-12-02 09:28:52', 1, 1),
(11, 2, 2, '1594', 9, '2023-12-02 10:15:41', 1, 2),
(12, 7, 1, '1594', 9, '2023-12-02 10:15:41', 1, 2),
(13, 20, 3, '603', 9, '2023-12-04 09:43:26', 0, 2),
(14, 19, 2, '603', 9, '2023-12-04 09:43:26', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_giaodich`
--

CREATE TABLE `tbl_giaodich` (
  `giaodich_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `khachhang_id` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `magiaodich` varchar(50) NOT NULL,
  `ngaythang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tinhtrang` int(11) NOT NULL DEFAULT 0,
  `huydon` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_giaodich`
--

INSERT INTO `tbl_giaodich` (`giaodich_id`, `product_id`, `khachhang_id`, `soluong`, `magiaodich`, `ngaythang`, `tinhtrang`, `huydon`) VALUES
(2, 3, 10, 3, '3132', '2023-11-27 12:57:10', 0, 0),
(3, 8, 11, 1, '7488', '2023-12-06 08:22:40', 1, 0),
(6, 2, 9, 2, '1594', '2023-12-02 10:15:41', 1, 2),
(7, 7, 9, 1, '1594', '2023-12-02 10:15:41', 1, 2),
(8, 20, 9, 3, '603', '2023-12-04 09:43:26', 0, 2),
(9, 19, 9, 2, '603', '2023-12-04 09:43:26', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_giohang`
--

CREATE TABLE `tbl_giohang` (
  `giohang_id` int(11) NOT NULL,
  `tensanpham` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `giasanpham` varchar(50) NOT NULL,
  `hinhanh` varchar(50) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_khachhang`
--

CREATE TABLE `tbl_khachhang` (
  `khachhang_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `note` text NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `giaohang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_khachhang`
--

INSERT INTO `tbl_khachhang` (`khachhang_id`, `name`, `phone`, `address`, `note`, `email`, `password`, `giaohang`) VALUES
(6, 'Nguyễn Văn B', '1252155', 'adca', 'kaahdjsn', 'phong2@gmail.com', '86e256da41d824de44e181b13992d898', 1),
(7, 'Nguyễn Văn C', '02154512154', 'Việt Nam', 'sdlkajdkjs', 'phong3@gmail.com', 'd744dc411dc674ebfebd7b1680b7085c', 0),
(9, 'Nguyễn Văn A', '0358741256', 'Đà Nẵng', 'skjdkajd', 'phong1@gmail.com', '8c0e4fe20ce7752a5e3441ac873aea3a', 1),
(11, 'Nguyễn Văn D', '02115454487', 'Hà Nội', 'sdkjadk', 'phong4@gmail.com', '370bfcd7a30de990924ef7ebed829c2c', 1),
(12, 'Nguyễn Văn E', '0125648712', 'Lào Cai', 'thành viên mới', 'phong5@gmail.com', 'e9a3e7b8fc6e1f9d66e968113ebe1ba8', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lienhe`
--

CREATE TABLE `tbl_lienhe` (
  `lienheid` int(11) NOT NULL,
  `khachhang_id` int(11) NOT NULL,
  `noidung` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_lienhe`
--

INSERT INTO `tbl_lienhe` (`lienheid`, `khachhang_id`, `noidung`) VALUES
(1, 9, ' ạdasndjanskcm');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_chitiet` text NOT NULL,
  `product_mota` text NOT NULL,
  `product_gia` varchar(100) NOT NULL,
  `product_giakhuyenmai` varchar(100) NOT NULL,
  `product_active` int(11) NOT NULL,
  `product_hot` int(11) NOT NULL,
  `product_soluong` int(11) NOT NULL,
  `product_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `category_id`, `product_name`, `product_chitiet`, `product_mota`, `product_gia`, `product_giakhuyenmai`, `product_active`, `product_hot`, `product_soluong`, `product_image`) VALUES
(1, 4, 'Samsung Galaxy A05s ', 'Samsung Galaxy A05s 6GB được ra mắt tại Việt Nam vào tháng 9/2023. Máy gây chú ý ngay từ khi ra mắt nhờ sở hữu mức giá bán hợp lý nhưng vẫn được trang bị cấu hình ổn định, nổi bật với chip Snapdragon 680, hệ thống camera 50 MP chất lượng và trang bị pin lớn 5000 mAh.', 'Nhìn tổng thể, Galaxy A05s có thiết kế vuông vắn với mặt lưng và màn hình phẳng. Đây là một thiết kế khá phổ biến ở các dòng smartphone hiện nay. Mặt lưng được làm bằng nhựa, nhưng được phủ một lớp nhám nhẹ nhờ kiểu thiết kế vân nổi. Điều này giúp cho máy có cảm giác cầm nắm chắc chắn và không bị bám dấu vân tay.', '4000000', '3600000', 1, 0, 1, 'dienthoai2.jpeg'),
(2, 4, 'iPhone 15 Pro Max', 'iPhone 15 Pro là chiếc iPhone đầu tiên sở hữu thiết kế từ titan chuẩn hàng không vũ trụ, cùng loại hợp kim sử dụng trong thiết kế tàu vũ trụ cho các chuyến du hành đến Sao Hỏa.', 'Thiết kế bằng titan\r\nMặt trước Ceramic Shield\r\nThiết kế mặt sau bằng kính nhám', '35000000', '33700000', 1, 0, 1, 'dienthoai1.jpg'),
(4, 5, 'Smart Tivi QLED 4K ', 'Smart Tivi QLED 4K 75 inch Samsung QA75Q80C mang đến niềm tự hào cho gia chủ với thiết kế sang trọng, màn hình 75 inch hiển thị hình ảnh 4K sống động nhờ trang bị bộ xử lý Neural Quantum 4K AI 20 nơ-ron mạnh mẽ, công nghệ Direct Full Array 8X hiển thị hình ảnh chi tiết, Real Depth Enhancer tái tạo khung hình chuẩn như mắt nhìn, công nghệ Dolby Atmos, OTS Lite mang đến âm vòm theo dõi chuyển động hình ảnh cuốn hút, trợ lý ảo Bixby cho bạn điều khiển tivi bằng khẩu lệnh dễ dàng.', 'Mẫu Smart tivi Samsung này có thiết kế tinh giản, kết cấu gọn gàng, đường viền thanh mảnh bao bọc và tăng cường bảo vệ màn hình. Chân đế được làm từ kim loại bền chắc, chống biến dạng, đặt tivi trên bàn, kệ tủ ổn định, không lo mất thăng bằng', '45000000', '40190000', 1, 0, 1, 'tivi3.jpg'),
(5, 1, 'Tủ lạnh LG Inverter', 'Tủ lạnh LG Inverter 519 lít GR-B256JDS thuộc dòng tủ lạnh side by side được trang bị công nghệ Smart Inverter giúp tiết kiệm điện năng. Bên cạnh đó, công nghệ làm lạnh đa chiều mang hơi lạnh lan tỏa khắp các ngăn.', 'Dòng tủ lạnh side by side, chất liệu cửa tủ được làm từ thép không gỉ bền chắc với màu bạc tinh tế, hòa hợp với mọi không gian nội thất.', '19000000', '12990000', 1, 1, 1, 'tulanh2.jpg'),
(6, 1, 'Tủ lạnh Casper Inverter', 'Tủ lạnh Casper Inverter 458 lít Side By Side RS-460PG mang thiết kế Side by Side sang trọng, hỗ trợ công nghệ làm lạnh đa chiều, làm lạnh trực tiếp cho hiệu quả giữ tươi thực phẩm cao, dùng tiết kiệm điện với công nghệ Advanced Inverter.', 'Vỏ ngoài bằng kim loại phủ sơn tĩnh điện có độ bền cao, chống ăn mòn, bảo vệ tốt các linh kiện bên trong. Lòng tủ làm bằng nhôm kháng khuẩn giúp không gian tủ sạch sẽ, bảo quản thực phẩm an toàn hơn', '12000000', '9990000', 1, 1, 1, 'tulanh1.jpg'),
(7, 2, 'Máy giặt Toshiba', 'Thiết kế tối giản, sang trọng, hiện đại với khối lượng giặt 7 kg phù hợp cho gia đình 2 - 3 người', 'Máy giặt Toshiba 7 Kg AW-L805AV (SG) có màu xám bạc vừa toát lên vẻ sang trọng, hiện đại vừa đảm bảo vệ sinh hơn trong quá trình sử dụng. ', '5000000', '3990000', 1, 1, 1, 'maygiat2.jpg'),
(8, 2, 'Máy giặt Casper', 'Máy giặt Casper 7.5 kg WT-75NG1 có khả năng tiết kiệm điện và nước hiệu quả nhờ tích hợp công nghệ suy luận ảo Fuzzy Logic hiện đại. Không những thế, mẫu máy giặt Casper này còn lần đầu tiên được trang bị chế độ sấy gió AirDry, giúp rút ngắn thời gian phơi quần áo đáng kể.', 'Máy giặt Casper 7.5 kg WT-75NG1 được thiết kế theo kiểu máy giặt lồng đứng với chất liệu vỏ máy được làm bằng kim loại sơn tĩnh điện có độ bền cao, phù hợp cho mọi không gian lắp đặt.', '4000000', '3500000', 1, 1, 1, 'maygiat1.jpg'),
(9, 3, 'Apple MacBook Pro', 'Khép lại một năm đầy sự cấp tiến về hiệu năng, Apple đã cho ra mắt chiếc Apple MacBook Pro 16 inch M3 Max 2023 30-core GPU này với khả năng xử lý “Quái vật”, cân tốt toàn bộ các nhu cầu về đồ họa và thậm chí là dựng phim bởi con chip M3 tiên tiến nhất, dung lượng RAM 36 GB và bộ nhớ lên đến 1 TB.', 'Cấu hình Laptop Apple MacBook Pro 16 inch M3 Max 2023 14-core CPU/36GB/1TB/30-core GPU', '90000000', '87990000', 1, 0, 1, 'laptop1.jpg'),
(19, 5, 'Smart Tivi NanoCell LG', 'Smart Tivi NanoCell LG 4K 75 inch 75NANO76SQA thể hiện khung hình 4K rực rỡ với công nghệ NanoCell, cuốn hút người dùng từ âm thanh tinh chỉnh theo nội dung, thỏa mãn nhu cầu giải trí cùng kho ứng dụng phong phú webOS 22, mang đến lựa chọn tuyệt vời cho gia đình bạn.', 'Smart Tivi NanoCell LG 4K 75 inch 75NANO76SQA phù hợp cho các phòng có diện tích trung bình lớn nhờ thiết kế thanh mảnh với kích thước màn hình 75 inch cùng chân đế bán nguyệt có thể tháo rời, bố trí để bàn hay treo tường linh hoạt.', '22000000', '18900000', 0, 0, 1, 'tivi1.jpg'),
(20, 5, 'Smart Tivi OLED LG 4K', 'Smart Tivi OLED LG 4K 48 inch 48A3PSA tái tạo hình ảnh 4K sắc nét, có chiều sâu nhờ trang bị màn hình OLED, độ phân giải 4K, công nghệ Pixel Dimming, bộ xử lý α7 Gen6 AI 4K cho bạn thưởng thức hình ảnh và âm thanh sống động, âm thanh AI Sound Pro chân thật, hệ điều hành webOS 23 giải trí đậm chất cá nhân, điều khiển bằng giọng nói không cần remote.', 'LG 48A3PSA được thiết kế theo xu hướng tối giản với các chi tiết có độ hoàn thiện cao, viền màn hình làm từ chất liệu kim loại cứng cáp, cho tivi chịu lực tốt khi di chuyển, bố trí trong không gian phòng của bạn. ', '31000000', '25990000', 0, 0, 1, 'tivi2.jpg'),
(21, 4, 'OPPO Find N3 Flip 5G', 'OPPO Find N3 Flip 5G Hồng, mẫu smartphone màn hình gập thế hệ mới của OPPO đã chính thức ra mắt tại Việt Nam. Điện thoại gây ấn tượng với thiết kế độc đáo, hiệu năng mạnh mẽ nhờ con chip MediaTek Dimensity 9200 và màn hình phụ có kích thước lớn cùng nhiều tính năng tiện ích.', 'Thiết kế của OPPO Find N3 Flip 5G Hồng gây ấn tượng với cơ chế gập mới lạ, sử dụng bản lề gập Flex cho phép gập mở 180 độ, tạo nên một diện mạo thanh lịch và tinh tế.', '25000000', '22600000', 0, 0, 1, 'dienthoai3.jpeg'),
(22, 3, 'Asus TUF Gaming', 'Laptop Asus TUF Gaming F15 FX506HF i5 (HN014W) cho bạn tạo nên những trận chiến mãn nhãn, tận hưởng các cảnh chuyển động siêu mượt với con chip Intel Core i5 thế hệ thứ 11 và tần số quét 144 Hz cho trải nghiệm game thêm phấn khích, hào hứng. ', 'Chiếc laptop Asus này sử dụng CPU Intel Core i5 11400H cho xung nhịp Turbo Boost 4.5 GHz cùng với card màn hình rời NVIDIA RTX 2050, 4 GB cho hiệu năng mạnh mẽ', '19000000', '16990000', 0, 0, 1, 'laptop2.jpg'),
(23, 3, 'Acer Aspire 5 Gaming', 'Khám phá thế giới đồ họa và gaming cực mượt với laptop Acer Aspire 5 Gaming A515 58GM 51LB i5 13420H (NX.KQ4SV.002), là sản phẩm đa năng với khả năng xử lý mạnh mẽ và hiệu suất đồ họa ấn tượng. Chiếc laptop đi kèm nhiều tính năng hiện đại cùng sự kết hợp hoàn hảo của công nghệ và thiết kế tinh tế là trợ thủ đắc lực cho công việc hàng ngày và thời gian giải trí, cho bạn trải nghiệm thú vị.', 'Sở hữu bộ vi xử lý Intel Core i5 Raptor Lake - 13420H với 8 nhân và 12 luồng, laptop dễ dàng cùng bạn thực hiện mọi tác vụ văn phòng, các tác vụ nặng hơn như thiết kế đồ họa, edit video hay đa nhiệm một cách ổn định và nhanh chóng.', '20000000', '17500000', 0, 0, 1, 'laptop3.jpg'),
(24, 2, 'Máy giặt Aqua', 'Với kháng sinh kháng khuẩn ABT, mâm giặt được phun một dung dịch đặc biệt, kháng khuẩn đến 99,99% và ngăn nấm mốc phát triển bên trong lồng giặt. Bảo vệ sức khỏe toàn diện cho người sử dụng. Sản phẩm thích hợp cho các gia đình có con nhỏ, người dễ bị kích ứng với vi khuẩn, bụi bẩn.', 'Ngăn ngừa vi khuẩn, nấm mốc với mâm giặt kháng khuẩn ABT', '8000000', '5990000', 0, 0, 1, 'maygiat3.jpg'),
(25, 1, 'Tủ lạnh LG Inverter', 'Tủ lạnh LG Inverter 519 lít GR-B256BL thuộc dòng tủ lạnh Side by side, có sự kết hợp giữa Smart Inverter và Linear Inverter giúp vận hành êm ái, tiết kiệm điện năng. Bên cạnh đó, công nghệ làm lạnh đa chiều mang hơi lạnh lan tỏa đều và bộ lọc khử mùi than hoạt tính loại bỏ mùi hôi hiệu quả.', 'Thuộc dòng tủ lạnh Side by side, chất liệu cửa tủ được làm từ thép không gỉ bền đẹp với thời gian, màu đen sang trọng phù hợp với nhiều kiểu thiết kế nội thất.', '21000000', '14990000', 0, 0, 1, 'tulanh3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `slider_id` int(11) NOT NULL,
  `slider_image` text NOT NULL,
  `slider_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`slider_id`, `slider_image`, `slider_active`) VALUES
(2, 'b2.jpg', 1),
(3, 'b3.jpg', 1),
(4, 'b4.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_baiviet`
--
ALTER TABLE `tbl_baiviet`
  ADD PRIMARY KEY (`baiviet_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_danhmuctin`
--
ALTER TABLE `tbl_danhmuctin`
  ADD PRIMARY KEY (`danhmuctin_id`);

--
-- Indexes for table `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  ADD PRIMARY KEY (`donhang_id`);

--
-- Indexes for table `tbl_giaodich`
--
ALTER TABLE `tbl_giaodich`
  ADD PRIMARY KEY (`giaodich_id`);

--
-- Indexes for table `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  ADD PRIMARY KEY (`giohang_id`);

--
-- Indexes for table `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  ADD PRIMARY KEY (`khachhang_id`);

--
-- Indexes for table `tbl_lienhe`
--
ALTER TABLE `tbl_lienhe`
  ADD PRIMARY KEY (`lienheid`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_baiviet`
--
ALTER TABLE `tbl_baiviet`
  MODIFY `baiviet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_danhmuctin`
--
ALTER TABLE `tbl_danhmuctin`
  MODIFY `danhmuctin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  MODIFY `donhang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_giaodich`
--
ALTER TABLE `tbl_giaodich`
  MODIFY `giaodich_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  MODIFY `giohang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  MODIFY `khachhang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_lienhe`
--
ALTER TABLE `tbl_lienhe`
  MODIFY `lienheid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
