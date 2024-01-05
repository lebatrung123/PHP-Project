<?php 
    include("../db/connect.php");
?>
<?php
    if (isset($_POST['themdanhmuc'])) {
        $tendanhmuc = $_POST['danhmuc'];
        $sql_insert = mysqli_query($conn, "INSERT INTO tbl_danhmuctin(tendanhmuc) values ('$tendanhmuc')");
    }elseif(isset($_POST['capnhatdanhmuc'])){
        $id_danhmuc = $_POST['id_danhmuc'];
        $tendanhmuc = $_POST['danhmuc'];
        $sql_update = mysqli_query($conn, "UPDATE tbl_danhmuctin SET tendanhmuc = '$tendanhmuc' WHERE danhmuctin_id = '$id_danhmuc'");
        header("Location: xulydanhmucbaiviet.php");
    }
    if (isset($_GET['xoa'])){
        $id = $_GET['xoa'];
        $sql_delete = mysqli_query($conn, "DELETE FROM tbl_danhmuctin WHERE danhmuctin_id = '$id'");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xử lý danh mục</title>
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
                <?php 
                    if (isset($_GET['quanly'])) {
                        $capnhat = $_GET['quanly'];
                    }else{
                        $capnhat = '';
                    }
                    if ($capnhat == 'capnhat') {
                        $id_capnhat = $_GET['id'];
                        $sql_capnhat = mysqli_query($conn, "SELECT * FROM tbl_danhmuctin WHERE danhmuctin_id = '$id_capnhat'");
                        $row_capnhat = mysqli_fetch_array($sql_capnhat);
                ?>    
                        <div class="col-md-4">
                            <h4 class="list-donhang">Cập nhật danh mục bài viết</h4>
                            <label for="">Tên danh mục bài viết</label>
                            <form action="" method="POST">
                                <input type="text" name="danhmuc" class="form-control" value="<?php echo $row_capnhat['tendanhmuc']; ?>"> <br>
                                <input type="hidden" name="id_danhmuc" class="form-control" value="<?php echo $row_capnhat['danhmuctin_id']; ?>">
                                <input type="submit" name="capnhatdanhmuc" class="btn btn-success" value="Cập nhật danh mục">
                            </form>
                        </div>
                <?php
                    }else{
                ?>
                        <div class="col-md-4">
                            <h4 class="list-donhang">Thêm danh mục bài viết</h4>
                            <label for="">Tên danh mục bài viết</label>
                            <form action="" method="POST">
                                <input type="text" name="danhmuc" class="form-control" placeholder="Tên danh mục"> <br>
                                <input type="submit" name="themdanhmuc" class="btn btn-success" value="Thêm danh mục">
                            </form>
                        </div>
                <?php } ?>
                <div class="col-md-8">
                    <h4 class="list-donhang">Danh sách danh mục bài viết</h4>
                    <?php
                        $sql_select_cate = mysqli_query($conn, "SELECT * FROM tbl_danhmuctin ORDER BY danhmuctin_id DESC");
                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>Thứ tự</th>
                            <th>Tên danh mục bài viết</th>
                            <th style="text-align: center;">Quản lý</th>
                        </tr>
                    <?php 
                        $i = 0;
                        while($row_cate = mysqli_fetch_array($sql_select_cate)){
                            $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row_cate['tendanhmuc']; ?></td>
                            <td style="text-align: center;">
                                <a href="?xoa=<?php echo $row_cate['danhmuctin_id']; ?>">
                                    <button type="button" class="btn btn-danger">Xóa</button>
                                </a> 
                                <a href="?quanly=capnhat&id=<?php echo $row_cate['danhmuctin_id']; ?>">
                                    <button type="button" class="btn btn-info">Cập nhật</button>
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