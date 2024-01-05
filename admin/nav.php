<?php
    session_start();
    if (!isset($_SESSION['admin_name'])) {
        header("Location: index.php");
    }
    if (isset($_GET['login'])) {
        $dangxuat = $_GET['login'];
    }else{
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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="apps">
        <div class="container1">
            <div class="admin-user">
                <img class="admin-img" src="../images/user.jpg" alt="">
                <h5 class="admin-name">Xin chào: <?php echo $_SESSION['admin_name']; ?></h5>
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
                <h5><a style="text-decoration: none;color: #fff;" href="dashboard.php">DASHBOARD</a></h5>
            </div>
            <div class="header-right">
                <img src="../images/user.jpg" alt="">
                <span><?php echo $_SESSION['admin_name']; ?></span>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="header-right1">
                <a href="?login=dangxuat">Đăng xuất</a>
            </div>
        </header>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>