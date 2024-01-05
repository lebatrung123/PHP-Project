<?php
    if(isset($_GET['huydon']) && isset($_GET['magiaodich'])) {
        $mahang = $_GET['magiaodich'];
        $huydon = $_GET['huydon'];
    }else{
        $mahang = '';
        $huydon = '';
    }

    $sql_huydonhang = mysqli_query($conn, "UPDATE tbl_donhang SET huydon = '$huydon' WHERE mahang = '$mahang'");
    $sql_huygiaodich = mysqli_query($conn, "UPDATE tbl_giaodich SET huydon = '$huydon' WHERE magiaodich = '$mahang'");
?>
<style>
    th{
        background-color: #eee !important;
    }

    table{
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    }
</style>
<div class="ads-grid py-sm-5 py-4">
	<div class="container py-xl-4 py-lg-2">
		<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">Xem đơn hàng</h3>
		<div class="row" style="justify-content: center;">
			<div class="agileinfo-ads-display col-lg-9">
				<div class="wrapper">
					<div class="row">
                        <h4 style="text-align: center;color: #d60404;">
                        <?php
                            if(isset($_SESSION['name'])){
                                echo 'Đơn hàng của: '.$_SESSION['name'];
                            } 
                        ?>
                        </h4>
                        <div class="col-md-12">
                        <?php
                            if (isset($_GET['khachhang'])){
                                $khachhang_id = $_GET['khachhang'];
                            }else{
                                $khachhang_id = '';
                            }
                            $sql_giaodich1 = mysqli_query($conn, "SELECT * FROM tbl_giaodich WHERE khachhang_id = 
                            '$khachhang_id' GROUP BY magiaodich");
                        ?>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Thứ tự</th>
                                    <th>Mã giao dịch</th>
                                    <th>Ngày đặt</th>
                                    <th>Tình trạng đơn hàng</th>
                                    <th>Quản lý</th>
                                    <th>Hủy đơn</th>
                                </tr>
                            <?php 
                                $i = 0;
                                while($row_giaodich1 = mysqli_fetch_array($sql_giaodich1)){
                                    $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row_giaodich1['magiaodich']; ?></td>
                                    <td><?php echo $row_giaodich1['ngaythang']; ?></td>
                                    <td><?php 
                                        if($row_giaodich1['tinhtrang'] == 0){
                                            echo 'Đã đặt hàng';
                                        }else{
                                            echo 'Đã xử lý và đang giao hàng';
                                        }
                                    ?></td>
                                    <td>
                                        <a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id']; ?>&magiaodich=<?php echo $row_giaodich1['magiaodich']; ?>">
                                            <button type="button" class="text-white btn btn-info">Xem chi tiết đơn hàng</button>
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                            if($row_giaodich1['huydon'] == 0){ 
                                        ?>
                                            <a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id']; ?>&magiaodich=<?php echo $row_giaodich1['magiaodich']; ?>&huydon=1">
                                                <button type="button" class="btn btn-danger">Hủy đơn hàng</button>
                                            </a>
                                        <?php
                                            }elseif($row_giaodich1['huydon'] == 1){
                                        ?>
                                            <p>Đang chờ hủy</p>
                                        <?php
                                            }else{
                                                echo 'Đã hủy';
                                            }
                                        ?>
                                    </td>
                                <?php } ?>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-12">
                        <h4 style="text-align: center;">Chi tiết đơn hàng</h4>
                        <?php
                            if (isset($_GET['magiaodich'])){
                                $magiaodich = $_GET['magiaodich'];
                            }else{
                                $magiaodich = '';
                            }
                            $sql_giaodich = mysqli_query($conn, "SELECT * FROM tbl_giaodich, tbl_khachhang, tbl_product WHERE tbl_giaodich.product_id
                            = tbl_product.product_id AND tbl_giaodich.khachhang_id = tbl_khachhang.khachhang_id AND tbl_giaodich.magiaodich
                            = '$magiaodich' ORDER BY tbl_giaodich.giaodich_id DESC");
                        ?>
                            <table class="table table-bordered">
                                <tr style="background-color: #eee;">
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
                                    <td><?php echo $row_giaodich['product_soluong']; ?></td>
                                    <td><?php echo $row_giaodich['ngaythang']; ?></td>
                            <?php } ?>
                                </tr>
                            </table>
                        </div>
					</div>
				</div>
            </div>				
		</div>
	</div>
</div>