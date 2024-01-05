<?php 
    include("../db/connect.php");
?>
<?php
    if (isset($_POST['themsanpham'])) {
        $tensanpham = $_POST['tensanpham'];
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $soluong = $_POST['soluong'];
        $giasanpham = $_POST['giasanpham'];
        $giakhuyenmai = $_POST['giakhuyenmai'];
        $danhmuc = $_POST['danhmuc'];
        $chitiet = $_POST['chitiet'];
        $mota = $_POST['mota'];

        $sql_insert_product = mysqli_query($conn, "INSERT INTO tbl_product(product_name, category_id, product_chitiet, 
        product_mota, product_gia, product_giakhuyenmai, product_soluong, product_image) VALUES 
        ('$tensanpham', '$danhmuc', '$chitiet', '$mota', '$giasanpham', '$giakhuyenmai', '$soluong', '$hinhanh')");
        move_uploaded_file($hinhanh_tmp, '../uploads/'.$hinhanh);
    }elseif(isset($_POST['capnhatsanpham'])){
        $id_update = $_POST['id_update'];
        $tensanpham = $_POST['tensanpham'];
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $soluong = $_POST['soluong'];
        $giasanpham = $_POST['giasanpham'];
        $giakhuyenmai = $_POST['giakhuyenmai'];
        $danhmuc = $_POST['danhmuc'];
        $chitiet = $_POST['chitiet'];
        $mota = $_POST['mota'];

        if($hinhanh==''){
            $sql_update_image = "UPDATE tbl_product SET product_name = '$tensanpham', product_soluong = '$soluong',
            product_gia = '$giasanpham', product_giakhuyenmai = '$giakhuyenmai', product_chitiet = '$chitiet',
            product_mota = '$mota', category_id = '$danhmuc' WHERE product_id = '$id_update'";
        }else{
            move_uploaded_file($hinhanh_tmp, '../uploads/'.$hinhanh);
            $sql_update_image = "UPDATE tbl_product SET product_name = '$tensanpham',product_image = '$hinhanh', product_soluong = '$soluong',
            product_gia = '$giasanpham', product_giakhuyenmai = '$giakhuyenmai', product_chitiet = '$chitiet',
            product_mota = '$mota', category_id = '$danhmuc' WHERE product_id = '$id_update'";
        }
        mysqli_query($conn, $sql_update_image);
    }
    if (isset($_GET['xoa'])) {
        $prd_id = $_GET['xoa'];
        $sql_delete = mysqli_query($conn, "DELETE FROM tbl_product WHERE product_id = '$prd_id'");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xử lý sản phẩm</title>
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
                    if (isset($_GET['quanly']) == 'capnhat') {
                        $id_capnhat = $_GET['id_capnhat'];
                        $sql_capnhat = mysqli_query($conn, "SELECT * FROM tbl_product WHERE product_id = '$id_capnhat'");
                        $row_capnhat = mysqli_fetch_array($sql_capnhat);
                        $category_id_1 = $row_capnhat['category_id'];
                    ?>
                    <div class="col-md-3">
                            <h4>Cập nhật sản phẩm</h4>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <label for="">Tên sản phẩm</label>
                                <input type="text" name="tensanpham" class="form-control" placeholder="Tên sản phẩm" 
                                value="<?php echo $row_capnhat['product_name']; ?>"> <br>
                                <input type="hidden" name="id_update" class="form-control" placeholder="id sản phẩm" 
                                value="<?php echo $row_capnhat['product_id']; ?>"> <br>
                                <label for="">Hình ảnh</label>
                                <input type="file" name="hinhanh" class="form-control"> <br>
                                <img src="../images/<?php echo $row_capnhat['product_image']; ?>" width="100" height="120" alt=""> <br>
                                <label for="">Giá sản phẩm</label>
                                <input type="text" name="giasanpham" class="form-control" placeholder="Giá sản phẩm"
                                value="<?php echo $row_capnhat['product_gia']; ?>"> <br>
                                <label for="">Giá khuyến mãi</label>
                                <input type="text" name="giakhuyenmai" class="form-control" placeholder="Giá khuyến mãi"
                                value="<?php echo $row_capnhat['product_giakhuyenmai']; ?>"> <br>
                                <label for="">Số lượng</label>
                                <input type="text" name="soluong" class="form-control" placeholder="Số lượng"
                                value="<?php echo $row_capnhat['product_soluong']; ?>"> <br>
                                <label for="">Mô tả</label>
                                <textarea name="mota" rows="7" class="form-control"><?php echo $row_capnhat['product_mota']; ?></textarea> <br>
                                <label for="">Chi tiết</label>
                                <textarea name="chitiet" rows="7" class="form-control"><?php echo $row_capnhat['product_chitiet']; ?></textarea> <br>
                                <label for="">Danh mục</label>
                                <select name="danhmuc" class="form-control">
                                    <option value="0">-------Chọn danh mục-------</option>
                                    <?php
                                        $sql_danhmuc = mysqli_query($conn, "SELECT * FROM tbl_category ORDER BY category_id DESC");
                                        while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                            if($category_id_1 == $row_danhmuc['category_id']){
                                    ?>
                                    <option selected value="<?php echo $row_danhmuc['category_id']; ?>"><?php echo $row_danhmuc['category_name']; ?></option>
                                        <?php 
                                            }else{
                                        ?>
                                    <option value="<?php echo $row_danhmuc['category_id']; ?>"><?php echo $row_danhmuc['category_name']; ?></option>
                                    <?php 
                                            } 
                                        }
                                    ?>
                                </select> <br>
                                <input type="submit" name="capnhatsanpham" class="btn btn-success" value="Cập nhật sản phẩm">
                            </form>
                        </div>
                <?php
                    }else{
                ?>    
                        <div class="col-md-3">
                            <h4 class="list-donhang">Thêm sản phẩm</h4>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <label for="">Tên sản phẩm</label>
                                <input type="text" name="tensanpham" class="form-control" placeholder="Tên sản phẩm"> <br>
                                <label for="">Hình ảnh</label>
                                <input type="file" name="hinhanh" class="form-control"> <br>
                                <label for="">Giá sản phẩm</label>
                                <input type="text" name="giasanpham" class="form-control" placeholder="Giá sản phẩm"> <br>
                                <label for="">Giá khuyến mãi</label>
                                <input type="text" name="giakhuyenmai" class="form-control" placeholder="Giá khuyến mãi"> <br>
                                <label for="">Số lượng</label>
                                <input type="text" name="soluong" class="form-control" placeholder="Số lượng"> <br>
                                <label for="">Mô tả</label>
                                <textarea name="mota" class="form-control"></textarea> <br>
                                <label for="">Chi tiết</label>
                                <textarea name="chitiet" class="form-control"></textarea> <br>
                                <label for="">Danh mục</label>
                                <select name="danhmuc" class="form-control">
                                    <option value="0">-------Chọn danh mục-------</option>
                                    <?php
                                        $sql_danhmuc = mysqli_query($conn, "SELECT * FROM tbl_category ORDER BY category_id DESC");
                                        while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                    ?>
                                    <option value="<?php echo $row_danhmuc['category_id']; ?>"><?php echo $row_danhmuc['category_name']; ?></option>
                                    <?php } ?>
                                </select> <br>
                                <input type="submit" name="themsanpham" class="btn btn-success" value="Thêm sản phẩm">
                            </form>
                        </div>
                <?php } ?>
                <div class="col-md-9">
                    <h4 class="list-donhang">Danh sách sản phẩm</h4>
                    <?php
                        $sql_select_prd = mysqli_query($conn, "SELECT * FROM tbl_product,tbl_category WHERE tbl_product.category_id 
                        = tbl_category.category_id ORDER BY tbl_product.product_id DESC");
                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>Thứ tự</th>
                            <th>Tên sản phẩm</th>
                            <th style="width: 7rem;">Hình ảnh</th>
                            <th>Số lượng</th>
                            <th>Danh mục</th>
                            <th>Giá sản phẩm</th>
                            <th>Giá khuyến mãi</th>
                            <th style="width: max-content;text-align: center;">Quản lý</th>
                        </tr>
                    <?php 
                        $i = 0;
                        while($row_prd = mysqli_fetch_array($sql_select_prd)){
                            $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row_prd['product_name']; ?></td>
                            <td>
                                <img style="width: 120px; height: 100px;" src="../images/<?php echo $row_prd['product_image']; ?>" alt="">
                            </td>
                            <td><?php echo $row_prd['product_soluong']; ?></td>
                            <td><?php echo $row_prd['category_name']; ?></td>
                            <td><?php echo number_format($row_prd['product_gia']).'vnđ'; ?></td>
                            <td><?php echo number_format($row_prd['product_giakhuyenmai']).'vnđ'; ?></td>
                            <td style="display: flex;">
                                <a  style="padding-right: 0.5rem;"href="?xoa=<?php echo $row_prd['product_id']; ?>">
                                    <button type="button" class="btn btn-danger">Xóa</button>
                                </a> 
                                <a href="xulysp.php?quanly=capnhat&id_capnhat=<?php echo $row_prd['product_id']; ?>">
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