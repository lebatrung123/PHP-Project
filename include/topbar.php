<?php
    if (isset($_POST['inpdangnhap'])) {
        $taikhoan = $_POST['email_login'];
        $matkhau = md5($_POST['matkhau_login']);
        if ($taikhoan == '' || $matkhau == '') {
            echo "<script>alert('Vui lòng nhập tài khoản và mật khẩu!')</script>";
        }else{
            $sql_select_khachhang = mysqli_query($conn, "SELECT * FROM tbl_khachhang WHERE email = '$taikhoan' AND password = '$matkhau'");
            $count = mysqli_num_rows($sql_select_khachhang);
            $row_dangnhap = mysqli_fetch_array($sql_select_khachhang);
            if ($count>0) {
                $_SESSION['name'] = $row_dangnhap['name'];
                $_SESSION['khachhang_id'] = $row_dangnhap['khachhang_id'];

				setcookie('username', $_SESSION['name'], time() + 3600 * 24, '/');
				setcookie('userid', $_SESSION['khachhang_id'], time() + 3600 * 24, '/');
                header("Location: index.php");
            }else{
                echo "<script>alert('Tài khoản hoặc mật khẩu không đúng!')</script>";
            }
        }
    }elseif (isset($_POST['dangky'])) {
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$note = $_POST['note'];
		$giaohang = $_POST['giaohang'];

		$sql_khachhang = mysqli_query($conn,"INSERT INTO tbl_khachhang(name,phone,address,email,note,giaohang,password)
			VALUES ('$name', '$phone', '$address', '$email', '$note', '$giaohang', '$password')");
		$sql_select_khachhang = mysqli_query($conn, "SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
		$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
		$_SESSION['name'] = $name;
        $_SESSION['khachhang_id'] = $row_khachhang['khachhang_id'];
		header("Location: index.php?quanly=giohang");
	}elseif(isset($_GET['dangxuat'])){
		$id = $_GET['dangxuat'];
		if($id = 1) {
			unset($_SESSION['name']);
		}
	}
?>

<!-- top-header -->
<div class="agile-main-top">
		<div class="container-fluid">
			<div class="row main-top-w3l py-2">
				<div class="col-lg-3 header-most-top">
	
				</div>
				<div class="col-lg-9 header-right mt-lg-0 mt-2">
					<!-- header lists -->
					<ul style="margin-bottom: 0;">
						<?php
							if(isset($_SESSION['name'])){ 
						?>
						<li class="text-center border-right text-white">
							<a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id']; ?>" class="text-white">
								<i class="fas fa-truck mr-2"></i>Xem đơn hàng</a>
						</li>
						<?php
							} 
							$sql_khachhang1 = mysqli_query($conn, "SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC");
							$row = mysqli_fetch_array($sql_khachhang1);
						?>
						<li class="text-center border-right text-white">
							<i class="fas fa-phone mr-2"></i> <?php echo $row['phone']; ?>
						</li>
					<?php
						if(!isset($_SESSION['name'])){
					?>
						<li class="text-center border-right text-white">
							<a href="#" data-toggle="modal" data-target="#dangnhap" class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i> Đăng nhập </a>
						</li>
						<li class="text-center text-white">
							<a href="#" data-toggle="modal" data-target="#dangky" class="text-white">
								<i class="fas fa-sign-out-alt mr-2"></i>Đăng ký </a>
						</li>
					<?php
						}else{
					?>
						<li class="text-center border-right text-white">
							<a href="#" data-toggle="modal" data-target="#user" class="text-white">
								<!-- <i class="fas fa-sign-out-alt mr-2"></i> -->
								<i class="fa-solid fa-user mr-2"></i>
								<?php echo $_SESSION['name']; ?> </a> 
						</li>
						<li class="text-center text-white">
							<a href="index.php?dangxuat=1" class="text-white">
								<i class="fas fa-sign-out-alt mr-2"></i>Đăng xuất </a>
						</li>
					<?php
						}
					?>
					</ul>
					<!-- //header lists -->
				</div>
			</div>
		</div>
	</div>

	<!-- modals -->
	<!-- log in -->
	<div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center">Đăng nhập</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder=" " name="email_login" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="matkhau_login" required="">
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" name="inpdangnhap" value="Đăng nhập">
						</div>
						<p class="text-center dont-do mt-3">Chưa có tài khoản?
							<a href="#" data-toggle="modal" data-target="#dangky">
								Đăng ký ngay</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>

    <!-- register -->
	<div class="modal fade" id="dangky" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Đăng ký</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label class="col-form-label">Tên khách hàng</label>
							<input type="text" class="form-control" placeholder=" " name="name" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder=" " name="email" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Phone</label>
							<input type="text" class="form-control" placeholder=" " name="phone" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Address</label>
							<input type="text" class="form-control" placeholder=" " name="address" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Password</label>
							<input type="password" class="form-control" placeholder=" " name="password" required="">
							<input type="hidden" class="form-control" placeholder=" " name="giaohang" value="0">
						</div>
						<div class="form-group">
							<label class="col-form-label">Ghi chú</label>
							<textarea name="note" class="form-control"></textarea>
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" name="dangky" value="Đăng ký">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //modal -->
	<!-- //top-header -->

    
	<!-- header-bottom-->
	<div class="header-bot">
		<div class="container">
			<div class="row header-bot_inner_wthreeinfo_header_mid">
				<!-- logo -->
				<div class="col-md-3 logo_agile">
					<h1 class="text-center">
						<a href="index.php" class="font-weight-bold font-italic">
							<img src="images/logo2.png" alt=" " class="img-fluid">Electro Store
						</a>
					</h1>
				</div>
				<!-- //logo -->
				<!-- header-bot -->
				<div class="col-md-9 header mt-4 mb-md-0 mb-4">
					<div class="row">
						<!-- search -->
						<div class="col-10 agileits_search">
							<form class="form-inline" action="index.php?quanly=timkiem" method="POST">
								<input class="form-control mr-sm-2" name="search_prd" type="search" placeholder="Tìm kiếm" aria-label="Search" required>
								<button class="btn my-2 my-sm-0" name="search_btn" type="submit">Tìm kiếm</button>
							</form>
						</div>
						<!-- //search -->
						<!-- cart details -->
						<?php 
							if(isset($_POST['submit']) && !isset($_SESSION['name'])){
								echo '<script>
									alert("Bạn chưa đăng nhập!");
									window.location.href = "index.php";
								</script>';
							}else{
						?>
						<div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
							<div class="wthreecartaits wthreecartaits2 cart cart box_1">
								<form action="?quanly=giohang" method="post" class="last">
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="display" value="1">
									<button class="btn w3view-cart" type="submit" name="submit" value="">
										<i class="fas fa-cart-arrow-down"></i>
									</button>
								</form>
							</div>
						</div>
						<?php } ?>
						<!-- //cart details -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- shop locator (popup) -->
	<!-- //header-bottom -->
	<!-- navigation -->