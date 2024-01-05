<?php 
    include("../db/connect.php");
?>
<?php
    if (isset($_POST['thembaiviet'])) {
        $tenbaiviet = $_POST['tenbaiviet'];
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $danhmuc = $_POST['danhmuc'];
        $tomtat = $_POST['tomtat'];
        $noidung = $_POST['noidung'];

        $sql_insert_product = mysqli_query($conn, "INSERT INTO tbl_baiviet(tenbaiviet, image, danhmuctin_id, tomtat, noidung) VALUES 
        ('$tenbaiviet','$hinhanh','$danhmuc', '$tomtat', '$noidung')");
        move_uploaded_file($hinhanh_tmp, '../uploads/'.$hinhanh);
    }elseif(isset($_POST['capnhatbaiviet'])){
        $id_update = $_POST['id_update'];
        $tenbaiviet = $_POST['tenbaiviet'];
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $danhmuc = $_POST['danhmuc'];
        $tomtat = $_POST['tomtat'];
        $noidung = $_POST['noidung'];

        if($hinhanh==''){
            $sql_update_image = "UPDATE tbl_baiviet SET tenbaiviet = '$tenbaiviet', tomtat = '$tomtat',
            noidung = '$noidung', danhmuctin_id = '$danhmuc' WHERE baiviet_id = '$id_update'";
        }else{
            move_uploaded_file($hinhanh_tmp, '../uploads/'.$hinhanh);
            $sql_update_image = "UPDATE tbl_baiviet SET tenbaiviet = '$tenbaiviet',image = '$hinhanh', tomtat = '$tomtat',
            noidung = '$noidung', danhmuctin_id = '$danhmuc' WHERE baiviet_id = '$id_update'";
        }
        mysqli_query($conn, $sql_update_image);
    }
    if (isset($_GET['xoa'])) {
        $baiviet_id = $_GET['xoa'];
        $sql_delete = mysqli_query($conn, "DELETE FROM tbl_baiviet WHERE baiviet_id = '$baiviet_id'");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xử lý bài viết</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
    <div style="height: max-content !important;" class="main">
    <?php
        include("nav.php");
    ?>
        <br><br>
        <div class="main1">
            <div class="box1"></div>
            <div class="container">
                <div class="row">
                    <?php 
                        if (isset($_GET['quanly']) == 'capnhat') {
                            $id_capnhat = $_GET['id_capnhat'];
                            $sql_capnhat = mysqli_query($conn, "SELECT * FROM tbl_baiviet WHERE baiviet_id = '$id_capnhat'");
                            $row_capnhat = mysqli_fetch_array($sql_capnhat);
                            $danhmuctin_id_1 = $row_capnhat['danhmuctin_id'];
                        ?>
                        <div class="col-md-4">
                                <h4 class="list-donhang">Cập nhật bài viết</h4>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <label for="">Tên bài viết</label>
                                    <input type="text" name="tenbaiviet" class="form-control" placeholder="Tên bài viết" 
                                    value="<?php echo $row_capnhat['tenbaiviet']; ?>"> <br>
                                    <input type="hidden" name="id_update" class="form-control" placeholder="id bài viết" 
                                    value="<?php echo $row_capnhat['baiviet_id']; ?>"> <br>
                                    <label for="">Hình ảnh</label>
                                    <input type="file" name="hinhanh" class="form-control"> <br>
                                    <img src="../images/<?php echo $row_capnhat['image']; ?>" width="100" height="120" alt=""> <br>
                                    <label for="">Tóm tắt</label>
                                    <textarea name="tomtat" rows="10" class="form-control"><?php echo $row_capnhat['tomtat']; ?></textarea> <br>
                                    <label for="">Nội dung</label>
                                    <textarea name="noidung" rows="10" class="form-control"><?php echo $row_capnhat['noidung']; ?></textarea> <br>
                                    <label for="">Danh mục</label>
                                    <select name="danhmuc" class="form-control">
                                        <option value="0">-------Chọn danh mục-------</option>
                                        <?php
                                            $sql_danhmuc = mysqli_query($conn, "SELECT * FROM tbl_danhmuctin ORDER BY danhmuctin_id DESC");
                                            while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                                if($danhmuctin_id_1 == $row_danhmuc['danhmuctin_id']){
                                        ?>
                                        <option selected value="<?php echo $row_danhmuc['danhmuctin_id']; ?>"><?php echo $row_danhmuc['tendanhmuc']; ?></option>
                                            <?php 
                                                }else{
                                            ?>
                                        <option value="<?php echo $row_danhmuc['danhmuctin_id']; ?>"><?php echo $row_danhmuc['tendanhmuc']; ?></option>
                                        <?php 
                                                } 
                                            }
                                        ?>
                                    </select> <br>
                                    <input type="submit" name="capnhatbaiviet" class="btn btn-success" value="Cập nhật bài viết">
                                </form>
                            </div>
                    <?php
                        }else{
                    ?>    
                            <div class="col-md-4">
                                <h4 class="list-donhang">Thêm bài viết</h4>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <label for="">Tên bài viết</label>
                                    <input type="text" name="tenbaiviet" class="form-control" placeholder="Tên bài viết"> <br>
                                    <label for="">Hình ảnh</label>
                                    <input type="file" name="hinhanh" class="form-control"> <br>
                                    <label for="">Tóm tắt</label>
                                    <textarea name="tomtat" class="form-control"></textarea> <br>
                                    <label for="">Nội dung</label>
                                    <textarea name="noidung" class="form-control"></textarea> <br>
                                    <label for="">Danh mục</label>
                                    <select name="danhmuc" class="form-control">
                                        <option value="0">-------Chọn danh mục-------</option>
                                        <?php
                                            $sql_danhmuc = mysqli_query($conn, "SELECT * FROM tbl_danhmuctin ORDER BY danhmuctin_id DESC");
                                            while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                        ?>
                                        <option value="<?php echo $row_danhmuc['danhmuctin_id']; ?>"><?php echo $row_danhmuc['tendanhmuc']; ?></option>
                                        <?php } ?>
                                    </select> <br>
                                    <input type="submit" name="thembaiviet" class="btn btn-success" value="Thêm bài viết">
                                </form>
                            </div>
                    <?php } ?>
                    <div class="col-md-8">
                        <h4 class="list-donhang">Danh sách bài viết</h4>
                        <?php
                            $sql_select_baiviet = mysqli_query($conn, "SELECT * FROM tbl_baiviet,tbl_danhmuctin WHERE tbl_baiviet.danhmuctin_id 
                            = tbl_danhmuctin.danhmuctin_id ORDER BY tbl_baiviet.danhmuctin_id DESC");
                        ?>
                        <table class="table table-bordered">
                            <tr>
                                <th>Thứ tự</th>
                                <th>Tên bài viết</th>
                                <th>Hình ảnh</th>
                                <th>Danh mục</th>
                                <th style="text-align: center;">Quản lý</th>
                            </tr>
                        <?php 
                            $i = 0;
                            while($row_baiviet = mysqli_fetch_array($sql_select_baiviet)){
                                $i++;
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row_baiviet['tenbaiviet']; ?></td>
                                <td>
                                    <img style="width: 120px; height: 100px;" src="../images/<?php echo $row_baiviet['image']; ?>" alt="">
                                </td>
                                <td><?php echo $row_baiviet['tendanhmuc']; ?></td>
                                <td style="display: flex;">
                                    <a style="padding-right: 0.5rem;" href="?xoa=<?php echo $row_baiviet['baiviet_id']; ?>">
                                        <button type="button" class="btn btn-danger">Xóa</button>
                                    </a> 
                                    <a href="xulybaiviet.php?quanly=capnhat&id_capnhat=<?php echo $row_baiviet['baiviet_id']; ?>">
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
    </div>
</body>
</html>