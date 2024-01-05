<?php 
    include("../db/connect.php");
?>
<?php
    if (isset($_GET['xoa'])){
        $id = $_GET['xoa'];
        $sql_delete = mysqli_query($conn, "DELETE FROM tbl_lienhe WHERE lienheid = '$id'");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xử lý phản hồi của khách hàng</title>
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
                    <h4 class="list-donhang">Phản hồi của khách hàng</h4>
                    <?php
                        $sql_select_lienhe = mysqli_query($conn, "SELECT * FROM tbl_lienhe,tbl_khachhang WHERE tbl_lienhe.khachhang_id =
                        tbl_khachhang.khachhang_id ORDER BY tbl_lienhe.lienheid DESC");
                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>Thứ tự</th>
                            <th>Tên khách hàng</th>
                            <th>Nội dung phản hồi</th>
                            <th style="text-align: center;">Quản lý</th>
                        </tr>
                    <?php 
                        $i = 0;
                        while($row_lienhe = mysqli_fetch_array($sql_select_lienhe)){
                            $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row_lienhe['name']; ?></td>
                            <td><?php echo $row_lienhe['noidung']; ?></td>
                            <td style="text-align: center;">
                                <a href="?xoa=<?php echo $row_lienhe['lienheid']; ?>">
                                    <button type="button" class="btn btn-danger">Xóa</button>
                                </a> 
                            </td>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>