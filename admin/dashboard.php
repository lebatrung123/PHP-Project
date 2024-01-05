<?php
include("../db/connect.php");
?>
<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    header("Location: index.php");
}
if (isset($_GET['login'])) {
    $dangxuat = $_GET['login'];
} else {
    $dangxuat = '';
}
if ($dangxuat == 'dangxuat') {
    session_destroy();
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="main">
        <div class="box">

        </div>
        <div class="all-content">
            <div class="apps">
                <div class="container1">
                    <div class="admin-user">
                        <img src="../images/user.jpg" alt="">
                        <h3>Xin chào: <?php echo $_SESSION['admin_name']; ?></h3>
                    </div>
                    <div class="list-category">
                        <a href="xulydonhang.php">Đơn hàng</a>
                        <a href="xulydanhmuc.php">Danh mục sản phẩm</a>
                        <a href="xulysp.php">Sản phẩm</a>
                        <a href="xulydanhmucbaiviet.php">Danh mục bài viết</a>
                        <a href="xulybaiviet.php">Bài viết</a>
                        <a href="xulykhachhang.php">Khách hàng</a>
                        <a href="phanhoikhachhang.php">Phản hồi khách hàng</a>
                    </div>
                </div>
                <header>
                    <div class="header-left">
                        <i class="fa-solid fa-bars"></i>
                        <h3><a style="text-decoration: none;color: #fff;" href="dashboard.php">DASHBOARD</a></h3>
                    </div>
                    <div class="header-right">
                        <img src="../images/user.jpg" alt="">
                        <span><?php echo $_SESSION['admin_name']; ?></span>
                        <i class="fa-solid fa-chevron-down"></i>
                        <div class="header-right1">
                            <a href="?login=dangxuat">Đăng xuất</a>
                        </div>
                    </div>
                </header>

                <section class="list-cateicons">
                    <?php
                    $sql_donhang = mysqli_query($conn, "SELECT * FROM tbl_donhang ORDER BY donhang_id DESC");
                    $i = 0;
                    while ($row_donhang = mysqli_fetch_array($sql_donhang)) {
                        $i++;
                    }
                    $sql_category = mysqli_query($conn, "SELECT * FROM tbl_category ORDER BY category_id DESC");
                    $i1 = 0;
                    while ($row_category = mysqli_fetch_array($sql_category)) {
                        $i1++;
                    }
                    $sql_product = mysqli_query($conn, "SELECT * FROM tbl_product ORDER BY product_id DESC");
                    $i2 = 0;
                    while ($row_product = mysqli_fetch_array($sql_product)) {
                        $i2++;
                    }
                    $sql_danhmuctin = mysqli_query($conn, "SELECT * FROM tbl_danhmuctin ORDER BY danhmuctin_id DESC");
                    $i3 = 0;
                    while ($row_danhmuctin = mysqli_fetch_array($sql_danhmuctin)) {
                        $i3++;
                    }
                    $sql_baiviet = mysqli_query($conn, "SELECT * FROM tbl_baiviet ORDER BY baiviet_id DESC");
                    $i4 = 0;
                    while ($row_baiviet = mysqli_fetch_array($sql_baiviet)) {
                        $i4++;
                    }
                    $sql_khachhang = mysqli_query($conn, "SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC");
                    $i5 = 0;
                    while ($row_khachhang = mysqli_fetch_array($sql_khachhang)) {
                        $i5++;
                    }
                    ?>
                    <div class="admin1 admin7">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <h3><?php echo $i; ?></h3>
                        <p>Đơn hàng</p>
                    </div>
                    <div class="admin2 admin7">
                        <i class="fa-solid fa-folder"></i>
                        <h3><?php echo $i1; ?></h3>
                        <p>Danh mục sản phẩm</p>
                    </div>
                    <div class="admin3 admin7">
                        <i class="fa-solid fa-gift"></i>
                        <h3><?php echo $i2; ?></h3>
                        <p>Sản phẩm</p>
                    </div>
                    <div class="admin4 admin7">
                        <i class="fa-solid fa-folder-open"></i>
                        <h3><?php echo $i3; ?></h3>
                        <p>Danh mục bài viết</p>
                    </div>
                    <div class="admin5 admin7">
                        <i class="fa-solid fa-book"></i>
                        <h3><?php echo $i4; ?></h3>
                        <p>Bài viết</p>
                    </div>
                    <div class="admin6 admin7">
                        <i class="fa-solid fa-user"></i>
                        <h3><?php echo $i5; ?></h3>
                        <p>Khách hàng</p>
                    </div>
                </section>

                <footer>
                    <p>Copyright © 2018 Designed by html.design. All rights reserved. <br>

                        Distributed By: ThemeWagon</p>
                </footer>
            </div>
        </div>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>