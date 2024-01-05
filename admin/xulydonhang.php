<?php 
    include("../db/connect.php");
?>
<?php 
    if (isset($_POST['capnhatdonhang'])) {
        $mahang1 = $_POST['mahang1'];
        $tinhtrang = $_POST['tinhtrang'];
        $sql_update_tinhtrang = mysqli_query($conn, "UPDATE tbl_donhang SET tinhtrang = '$tinhtrang' WHERE mahang = '$mahang1'");
        $sql_update_giaodich = mysqli_query($conn, "UPDATE tbl_giaodich SET tinhtrang = '$tinhtrang' WHERE magiaodich = '$mahang1'");
    }
?>
<?php
    if (isset($_GET['xoadonhang'])) {
        $mahang = $_GET['xoadonhang'];
        $sql_delete = mysqli_query($conn, "DELETE FROM tbl_donhang WHERE mahang = '$mahang'");
        header('Location: xulydonhang.php');
    }
    if(isset($_GET['xacnhanhuy']) && isset($_GET['mahang'])) {
        $mahang = $_GET['mahang'];
        $huydon = $_GET['xacnhanhuy'];
    }else{
        $mahang = '';
        $huydon = '';
    }

    $sql_huydonhang = mysqli_query($conn, "UPDATE tbl_donhang SET huydon = '$huydon' WHERE mahang = '$mahang'");
    $sql_huygiaodich = mysqli_query($conn, "UPDATE tbl_giaodich SET huydon = '$huydon' WHERE magiaodich = '$mahang'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xử lý Đơn hàng</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style1.css">
</head>
<body>
<div class="main">
<?php
    include("nav.php");
?>
    <br>
    <div class="container">
        <div class="row">
            <?php 
                if (isset($_GET['quanly']) == 'xemdonhang') {
                    $mahang = $_GET['mahang'];
                    $sql_chitiet = mysqli_query($conn, "SELECT * FROM tbl_donhang, tbl_product WHERE 
                    tbl_donhang.product_id = tbl_product.product_id AND tbl_donhang.mahang = '$mahang'");
            ?>    
                <div class="col-md-12">
                <h4 class="list-donhang">Danh sách đơn hàng</h4>
                <?php
                    $sql_donhang = mysqli_query($conn, "SELECT * FROM tbl_donhang, tbl_khachhang, tbl_product WHERE tbl_donhang.product_id
                    = tbl_product.product_id AND tbl_donhang.khachhang_id = tbl_khachhang.khachhang_id GROUP BY tbl_donhang.mahang ORDER BY donhang_id DESC");
                ?>
                    <table class="table table-bordered">
                        <tr style="background-color: #eee;">
                            <th>Thứ tự</th>
                            <th>Tên khách hàng</th>
                            <th>Mã hàng</th>
                            <th>Tình trạng đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th>Địa chỉ giao hàng</th>
                            <th>Hủy đơn</th>
                            <th>Quản lý</th>
                        </tr>
                        <?php 
                        $i = 0;
                        while($row_donhang = mysqli_fetch_array($sql_donhang)){
                            $i++;
                            ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row_donhang['name']; ?></td>
                            <td><?php echo $row_donhang['mahang']; ?></td>
                            <td>
                                <?php
                                    if($row_donhang['tinhtrang'] == 0){
                                        echo 'Đã đặt hàng';
                                    }else{
                                        echo 'Đã xử lý và đang giao hàng';
                                    }
                                    ?>
                            </td>
                            <td><?php echo $row_donhang['ngaythang']; ?></td>
                            <td><?php echo $row_donhang['address']; ?></td>
                            <td><?php 
                                if($row_donhang['huydon'] == 0){
                                    
                                }elseif($row_donhang['huydon'] == 1){
                                    echo '<a href="xulydonhang.php?quanly=xemdonhang&mahang='.$row_donhang['mahang'].'&xacnhanhuy=2">
                                        <button type="button" class="btn btn-primary">Hủy đơn</button>
                                    </a>';
                                }else{
                                    echo 'Đã hủy';
                                }
                                ?></td>
                            <td style="display: flex;">
                                <a style="padding-right: 0.5rem;" href="?xoadonhang=<?php echo $row_donhang['mahang']; ?>">
                                    <button type="button" class="btn btn-danger">Xóa</button>
                                </a>
                                <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang']; ?>">
                                    <button type="button" class="btn btn-info">Xem</button>
                                </a>
                            </td>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    <form action="" method="POST">
                    <div class="main1">
                    <div class="box1"></div>
                    <table class="table table-bordered">
                    <tr style="background: #eee;">
                        <th>Thứ tự</th>
                        <th>Tên sản phẩm</th>
                        <th>Mã hàng</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>
                        <th>Ngày đặt</th>
                    </tr>
                <?php 
                    $i = 0;
                    while($row_chitiet = mysqli_fetch_array($sql_chitiet)){
                        $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row_chitiet['product_name']; ?></td>
                        <td><?php echo $row_chitiet['mahang']; ?></td>
                        <td><?php echo $row_chitiet['soluong']; ?></td>
                        <td><?php echo number_format($row_chitiet['product_giakhuyenmai']).'vnđ'; ?></td>
                        <td><?php echo number_format($row_chitiet['soluong'] * $row_chitiet['product_giakhuyenmai']).'vnđ'; ?></td>
                        <td><?php echo $row_chitiet['ngaythang']; ?></td>
                        <input type="hidden" name="mahang1" value="<?php echo $row_chitiet['mahang']; ?>">
                        <?php } ?>
                    </tr>
                </table>
                    </div>
                <select class="form-control" name="tinhtrang">
                    <option value="1">Đã xử lý và đang giao hàng</option>
                    <option value="0">Đã đặt hàng</option>
                </select> <br>
                <input type="submit" class="btn btn-success" name="capnhatdonhang" value="Cập nhật đơn hàng">
                </form>
            </div>
            <?php }else{ ?>
            <div class="col-md-12">
                <h4 class="list-donhang">Danh sách đơn hàng</h4>
                <?php
                    $sql_donhang = mysqli_query($conn, "SELECT * FROM tbl_donhang, tbl_khachhang, tbl_product WHERE tbl_donhang.product_id
                    = tbl_product.product_id AND tbl_donhang.khachhang_id = tbl_khachhang.khachhang_id GROUP BY tbl_donhang.mahang ORDER BY donhang_id DESC");
                ?>
                <table class="table table-bordered">
                    <tr style="background-color: #eee;">
                        <th>Thứ tự</th>
                        <th>Tên khách hàng</th>
                        <th>Mã hàng</th>
                        <th>Tình trạng đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Địa chỉ giao hàng</th>
                        <th>Hủy đơn</th>
                        <th>Quản lý</th>
                    </tr>
                    <?php 
                    $i = 0;
                    while($row_donhang = mysqli_fetch_array($sql_donhang)){
                        $i++;
                        ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row_donhang['name']; ?></td>
                        <td><?php echo $row_donhang['mahang']; ?></td>
                        <td>
                            <?php
                                if($row_donhang['tinhtrang'] == 0){
                                    echo 'Đã đặt hàng';
                                }else{
                                    echo 'Đã xử lý và đang giao hàng';
                                }
                                ?>
                        </td>
                        <td><?php echo $row_donhang['ngaythang']; ?></td>
                        <td><?php echo $row_donhang['address']; ?></td>
                        <td><?php 
                            if($row_donhang['huydon'] == 0){
                                
                            }elseif($row_donhang['huydon'] == 1){
                                echo '<a href="xulydonhang.php?quanly=xemdonhang&mahang='.$row_donhang['mahang'].'&xacnhanhuy=2">
                                        <button type="button" class="btn btn-primary">Hủy đơn</button>
                                    </a>';
                            }else{
                                echo 'Đã hủy';
                            }
                            ?></td>
                        <td style="display: flex;">
                            <a style="padding-right: 0.5rem;" href="?xoadonhang=<?php echo $row_donhang['mahang']; ?>">
                                <button type="button" class="btn btn-danger">Xóa</button>
                            </a>
                            <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang']; ?>">
                                <button type="button" class="btn btn-info">Xem</button>
                            </a>
                        </td>
                        <?php } ?>
                    </tr>
                </table>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>