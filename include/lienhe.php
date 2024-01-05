<?php
    if(isset($_POST['guilienhe']) && $_POST['guilienhe'] && isset($_SESSION['name'])){
        $noidung = $_POST['noidung'];
        $khachhang_id = $_SESSION['khachhang_id'];

        $sql_insert_lienhe = mysqli_query($conn, "INSERT INTO tbl_lienhe(khachhang_id, noidung) VALUES
        ('$khachhang_id', '$noidung')");
    }elseif(isset($_POST['guilienhe']) && $_POST['guilienhe'] && !isset($_SESSION['name'])){
		echo '<script>
				alert("Bạn chưa đăng nhập!");
				window.location.href = "index.php";
			</script>';
	}
?>
<!-- page -->
<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.html">Home</a>
						<i>|</i>
					</li>
					<li>Liên hệ</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- contact -->
	<div class="contact py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Liên hệ với chúng tôi
			</h3>
			<!-- //tittle heading -->
			<div class="row contact-grids agile-1 mb-5">
				<div class="col-sm-4 contact-grid agileinfo-6 mt-sm-0 mt-2">
					<div class="contact-grid1 text-center">
						<div class="con-ic">
							<i class="fas fa-map-marker-alt rounded-circle"></i>
						</div>
						<h4 class="font-weight-bold mt-sm-4 mt-3 mb-3">Địa chỉ</h4>
						<p>129 Trần Cao Vân, Thanh Khê, Đà Nẵng
							<label>Vietnam</label>
						</p>
					</div>
				</div>
				<div class="col-sm-4 contact-grid agileinfo-6 my-sm-0 my-4">
					<div class="contact-grid1 text-center">
						<div class="con-ic">
							<i class="fas fa-phone rounded-circle"></i>
						</div>
						<h4 class="font-weight-bold mt-sm-4 mt-3 mb-3">Gọi cho chúng tôi</h4>
						<p>0123456789
							<label>0987654321</label>
						</p>
					</div>
				</div>
				<div class="col-sm-4 contact-grid agileinfo-6">
					<div class="contact-grid1 text-center">
						<div class="con-ic">
							<i class="fas fa-envelope-open rounded-circle"></i>
						</div>
						<h4 class="font-weight-bold mt-sm-4 mt-3 mb-3">Email</h4>
						<p>
							<a href="mailto:phongnt@vku.udn.vn">phongnt@vku.udn.vn</a>
							<label>
								<a href="mailto:thaipn@vku.udn.vn">thaipn@vku.udn.vn</a>
							</label>
						</p>
					</div>
				</div>
			</div>
			<!-- form -->
			<form action="" method="post">
				<div class="contact-grids1 w3agile-6">
					<div class="contact-me animated wow slideInUp form-group">
						<label class="col-form-label">Nội dung</label>
						<textarea name="noidung" class="form-control" placeholder="" required=""> </textarea>
					</div>
					<div class="contact-form">
						<input type="submit" name="guilienhe" value="Gửi">
					</div>
				</div>
			</form>
			<!-- //form -->
		</div>
	</div>
	<!-- //contact -->