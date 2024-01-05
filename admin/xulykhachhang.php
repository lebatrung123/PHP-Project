<?php 
    include("../db/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xử lý khách hàng</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
    <div class="main">
    <?php
        include("nav.php");
    ?>
        <br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="list-donhang">Danh sách khách hàng</h4>
                    <?php
                        $sql_khachhang = mysqli_query($conn, "SELECT * FROM tbl_khachhang, tbl_giaodich WHERE tbl_khachhang.khachhang_id
                        = tbl_giaodich.khachhang_id GROUP BY tbl_giaodich.ngaythang ORDER BY tbl_giaodich.giaodich_id DESC");
                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>Thứ tự</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Thời gian mua</th>
                            <th style="text-align: center;">Quản lý</th>
                        </tr>
                    <?php 
                        $i = 0;
                        while($row_khachhang = mysqli_fetch_array($sql_khachhang)){
                            $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row_khachhang['name']; ?></td>
                            <td><?php echo $row_khachhang['phone']; ?></td>
                            <td><?php echo $row_khachhang['address'] ?></td>
                            <td><?php echo $row_khachhang['email']; ?></td>
                            <td><?php echo $row_khachhang['ngaythang']; ?></td>
                            <td>
                                <a style="text-align: center;" href="?quanly=xemgiaodich&khachhang=<?php echo $row_khachhang['magiaodich']; ?>">
                                    <button type="button" class="btn btn-info">Xem giao dịch</button>
                                </a>
                            </td>
                            <?php } ?>
                        </tr>
                    </table>
                </div>

                <div class="col-md-12">
                    <h4 class="list-donhang">Lịch sử giao dịch đơn hàng</h4>
                    <?php
                        if (isset($_GET['khachhang'])){
                            $magiaodich = $_GET['khachhang'];
                        }else{
                            $magiaodich = '';
                        }
                        $sql_giaodich = mysqli_query($conn, "SELECT * FROM tbl_giaodich, tbl_khachhang, tbl_product WHERE tbl_giaodich.product_id
                        = tbl_product.product_id AND tbl_giaodich.khachhang_id = tbl_khachhang.khachhang_id AND tbl_giaodich.magiaodich
                        = '$magiaodich' ORDER BY tbl_giaodich.giaodich_id DESC");
                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>Thứ tự</th>
                            <th>Mã giao dịch</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Ngày đặt</th>
                        </tr>
                    <?php 
                        $i = 0;
                        while($row_giaodich = mysqli_fetch_array($sql_giaodich)){
                            $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row_giaodich['magiaodich']; ?></td>
                            <td><?php echo $row_giaodich['product_name']; ?></td>
                            <td><?php echo $row_giaodich['soluong']; ?></td>
                            <td><?php echo $row_giaodich['ngaythang']; ?></td>
                    <?php } ?>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>