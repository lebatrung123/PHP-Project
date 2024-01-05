<?php
    session_start();
    include("../db/connect.php");
?>
<?php
    if (isset($_POST['dangnhap'])) {
        $taikhoan = $_POST['taikhoan'];
        $matkhau = md5($_POST['matkhau']);
        if ($taikhoan == '' || $matkhau == '') {
            echo "<p>Bạn chưa nhập tài khoản hoặc mật khẩu</p>";
        }else{
            $sql_select_admin = mysqli_query($conn, "SELECT * FROM tbl_admin WHERE email = '$taikhoan' AND password = '$matkhau' LIMIT 1");
            $count = mysqli_num_rows($sql_select_admin);
            $row_dangnhap = mysqli_fetch_array($sql_select_admin);
            if ($count>0) {
                $_SESSION['admin_name'] = $row_dangnhap['admin_name'];
                $_SESSION['admin_id'] = $row_dangnhap['admin_id'];
                header("Location: dashboard.php");
            }else{
                echo "<p>Tài khoản hoặc mật khẩu không đúng</p>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập admin</title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body class="d-flex justify-content-center align-items-center">
    <style>
        .admin1{
            margin: auto;
            background-color: #fff;
            padding: 3rem;
            border-radius: 1rem;
            width: 25rem;
        }
        body {
            width: 100vw;
            height: 100vh;
            background: linear-gradient(45deg,#00d8ff,#0142fe);
        }
    </style>
    <div class="admin1">
        <h2 class="align-items-center mb-4">Đăng nhập Admin</h2>
        <div class="form-group">
            <form action="" method="POST">
                <label for="">Tài khoản</label>
                <input type="email" name="taikhoan" placeholder="Điền Email" class="form-control"> <br>
                <label for="">Mật khẩu</label>
                <input type="password" name="matkhau" placeholder="Điền Mật khẩu" class="form-control"> <br>
                <input type="submit" name="dangnhap" class="btn btn-primary" value="Đăng nhập Admin">
            </form>
        </div>
    </div>
</body>
</html>