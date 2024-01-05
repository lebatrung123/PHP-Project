<?php
$khachhang_id = $_SESSION['khachhang_id'];
if (isset($_POST['themgiohang'])) {
	$tensanpham = $_POST['tensanpham'];
	$product_id = $_POST['product_id'];
	$giasanpham = $_POST['giasanpham'];
	$hinhanh = $_POST['hinhanh'];
	$soluong = $_POST['soluong'];
	$sql_select_giohang = mysqli_query($conn, "SELECT * FROM tbl_giohang WHERE product_id = '$product_id'");
	$count = mysqli_num_rows($sql_select_giohang);
	if ($count > 0) {
		$row_prd = mysqli_fetch_array($sql_select_giohang);
		$soluong = $row_prd['soluong'];
		$sql_giohang = "UPDATE tbl_giohang SET soluong = '$soluong' WHERE product_id = '$product_id'";
	} else {
		$soluong = $soluong;
		$sql_giohang = "INSERT INTO tbl_giohang(tensanpham,product_id,khachhang_id,giasanpham,hinhanh,soluong)
			VALUES ('$tensanpham', '$product_id', '$khachhang_id', '$giasanpham', '$hinhanh', '$soluong')";
	}
	$insert_row = mysqli_query($conn, $sql_giohang);
	if ($insert_row == 0) {
		header("Location:index.php?quanly=chitietsp&id=" . $product_id);
	}
} elseif (isset($_POST['capnhatgiohang'])) {
	for ($i = 0; $i < count($_POST['prd_id']); $i++) {
		$prd_id = $_POST['prd_id'][$i];
		$soluong = $_POST['soluong'][$i];
		if ($soluong <= 0) {
			$sql_delete = mysqli_query($conn, "DELETE FROM tbl_giohang WHERE product_id = '$prd_id'");
		} else {
			$sql_update = mysqli_query($conn, "UPDATE tbl_giohang SET soluong = '$soluong' WHERE product_id = '$prd_id'");
		}
	}
} elseif (isset($_GET['xoa'])) {
	$id = $_GET['xoa'];
	$sql_delete = mysqli_query($conn, "DELETE FROM tbl_giohang WHERE giohang_id = '$id'");
} elseif (isset($_GET['dangxuat'])) {
	$id = $_GET['dangxuat'];
	if ($id = 1) {
		unset($_SESSION['name']);
	}
} elseif (isset($_POST['thanhtoan'])) {
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$note = $_POST['note'];
	$giaohang = $_POST['giaohang'];
	$sql_khachhang = mysqli_query($conn, "INSERT INTO tbl_khachhang(name,phone,address,email,note,giaohang,password)
			VALUES ('$name', '$phone', '$address', '$email', '$note', '$giaohang', '$password')");
	if ($sql_khachhang) {
		$sql_select_khachhang = mysqli_query($conn, "SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
		$mahang = rand(0, 9999);
		$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
		$khachhang_id = $row_khachhang['khachhang_id'];
		$_SESSION['name'] = $row_khachhang['name'];
		$_SESSION['khachhang_id'] = $khachhang_id;
		for ($i = 0; $i < count($_POST['thanhtoan_prd_id']); $i++) {
			$prd_id = $_POST['thanhtoan_prd_id'][$i];
			$soluong = $_POST['thanhtoan_soluong'][$i];
			$sql_khachhang = mysqli_query($conn, "INSERT INTO tbl_donhang(product_id,khachhang_id,soluong,mahang)
					VALUES ('$prd_id', '$khachhang_id', '$soluong', '$mahang')");
			$sql_giaodich = mysqli_query($conn, "INSERT INTO tbl_giaodich(product_id,soluong,magiaodich,khachhang_id)
				VALUES ('$prd_id', '$soluong', '$mahang', '$khachhang_id')");
			$sql_delete_thanhtoan = mysqli_query($conn, "DELETE FROM tbl_giohang WHERE product_id = '$prd_id'");
		}
	}
} elseif (isset($_POST['thanhtoandangnhap'])) {
	$mahang = rand(0, 9999);
	for ($i = 0; $i < count($_POST['thanhtoan_prd_id']); $i++) {
		$prd_id = $_POST['thanhtoan_prd_id'][$i];
		$soluong = $_POST['thanhtoan_soluong'][$i];
		$sql_khachhang = mysqli_query($conn, "INSERT INTO tbl_donhang(product_id,khachhang_id,soluong,mahang)
				VALUES ('$prd_id', '$khachhang_id', '$soluong', '$mahang')");
		$sql_giaodich = mysqli_query($conn, "INSERT INTO tbl_giaodich(product_id,soluong,magiaodich,khachhang_id)
			VALUES ('$prd_id', '$soluong', '$mahang', '$khachhang_id')");
		$sql_delete_thanhtoan = mysqli_query($conn, "DELETE FROM tbl_giohang WHERE product_id = '$prd_id'");
	}
}
?>
<!-- checkout page -->
<div class="privacy py-sm-5 py-4">
	<div class="container py-xl-4 py-lg-2">
		<!-- tittle heading -->
		<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
			Giỏ hàng của bạn
		</h3>
		<!-- <?php
				if (isset($_SESSION['name'])) {
					echo '<p style="color: #000;">Xin chào bạn: ' . $_SESSION['name'] . '<a href="index.php?quanly=giohang&dangxuat=1">Đăng xuất</a></p>';
				} else {
					echo '';
				}
				?> -->
		<!-- //tittle heading -->
		<div class="checkout-right">
			<?php
			$sql_lay_giohang = mysqli_query($conn, "SELECT * FROM tbl_giohang, tbl_product WHERE tbl_giohang.product_id
					= tbl_product.product_id AND tbl_giohang.khachhang_id = '$khachhang_id' ORDER BY tbl_giohang.giohang_id DESC");
			?>
			<div class="table-responsive">
				<form action="" method="POST">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Thứ tự</th>
								<th>Hình ảnh sản phẩm</th>
								<th>Số lượng</th>
								<th>Tên sản phẩm</th>

								<th>Giá</th>
								<th>Giá tổng</th>
								<th>Remove</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$total = 0;
							$i = 0;
							while ($row_lay_giohang = mysqli_fetch_array($sql_lay_giohang)) {
								$subtotal = $row_lay_giohang['soluong'] * $row_lay_giohang['giasanpham'];
								$total += $subtotal;
								$i++;
							?>
								<tr class="rem1">
									<td class="invert"><?php echo $i ?></td>
									<td class="invert-image">
										<a href="index.php?quanly=chitietsp&id=<?php echo $row_lay_giohang['product_id'] ?>">
											<img src="images/<?php echo $row_lay_giohang['hinhanh']; ?>" alt=" " class="img-responsive">
										</a>
									</td>
									<td class="invert">
										<input type="hidden" name="prd_id[]" value="<?php echo $row_lay_giohang['product_id']; ?>">
										<input type="number" min="1" name="soluong[]" value="<?php echo $row_lay_giohang['soluong']; ?>" style="width: 2.5rem;">
									</td>
									<td class="invert"><?php echo $row_lay_giohang['tensanpham']; ?></td>
									<td class="invert"><?php echo number_format($row_lay_giohang['giasanpham']) . 'vnđ'; ?></td>
									<td class="invert"><?php echo number_format($subtotal) . 'vnđ'; ?></td>
									<td class="invert">
										<a href="?quanly=giohang&xoa=<?php echo $row_lay_giohang['giohang_id']; ?>">
											<button type="button" class="btn btn-danger">Xóa</button>
										</a>
									</td>
								</tr>
							<?php } ?>
							<tr>
								<td colspan="7">Tổng tiền : <?php echo number_format($total); ?></td>
							</tr>
							<tr>
								<td colspan="7">
									<input type="submit" name="capnhatgiohang" value="cập nhật giỏ hàng" class="btn btn-success">
									<?php
									$sql_select_giohang1 = mysqli_query($conn, "SELECT * FROM tbl_giohang");
									$count_select_giohang1 = mysqli_num_rows($sql_select_giohang1);

									if (isset($_SESSION['name']) && $count_select_giohang1 > 0) {
										while ($row_select_giohang1 = mysqli_fetch_array($sql_select_giohang1)) {
									?>
											<input type="hidden" name="thanhtoan_prd_id[]" value="<?php echo $row_select_giohang1['product_id']; ?>">
											<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_select_giohang1['soluong']; ?>">
										<?php } ?>
										<input type="submit" name="thanhtoandangnhap" value="Thanh toán giỏ hàng" class="btn btn-primary">
									<?php } ?>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>
		<?php
		if (!isset($_SESSION['name'])) {
		?>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Thêm địa chỉ giao hàng</h4>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Họ và tên" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Số điện thoại" name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Địa chỉ" name="address" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="email" class="form-control" placeholder="Email" name="email" required="">
									</div>
									<div class="controls form-group">
										<input type="password" class="form-control" placeholder="Password" name="password" required="">
									</div>
									<div class="controls form-group">
										<textarea style="resize: none;" class="form-control" placeholder="Ghi chú" name="note" required=""></textarea>
									</div>
									<div class="controls form-group">
										<select class="option-w3ls" name="giaohang">
											<option>Chọn hình thức thanh toán</option>
											<option value="1">Thanh toán qua thẻ ATM</option>
											<option value="0">Thanh toán khi nhận hàng</option>
										</select>
									</div>
								</div>
								<?php
								$sql_lay_giohang = mysqli_query($conn, "SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");
								while ($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang)) {
								?>
									<input type="hidden" name="thanhtoan_prd_id[]" value="<?php echo $row_thanhtoan['product_id']; ?>">
									<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong']; ?>">
								<?php } ?>
								<input type="submit" name="thanhtoan" class="btn btn-success" style="width: 20%;" value="Thanh toán">
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<!-- //checkout page -->