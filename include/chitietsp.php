<?php
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
	}else {
		$id = '';
	}

	$sql_chitiet = mysqli_query($conn, "SELECT * FROM tbl_product WHERE product_id = '$id'");
?>
	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">Trang chủ</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
<?php 
	while($row_chitiet = mysqli_fetch_array($sql_chitiet)) {
		 $_SESSION['idsp'] = $row_chitiet['product_id'];
?>
	<!-- Single Page -->
	<div class="banner-bootom-w3-agileits">
		<div class="container py-xl-4 py-lg-2">
			<div class="row">
				<div class="col-lg-5 col-md-8 single-right-left ">
					<div class="grid images_3_of_2">
						<div class="flexslider">
							<ul class="slides">

								<li data-thumb="images/<?php echo $row_chitiet['product_image']; ?>">
									<div class="thumb-image">
										<img src="images/<?php echo $row_chitiet['product_image']; ?>" data-imagezoom="true" class="img-fluid" alt=""> </div>
								</li>
								
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="col-lg-7 single-right-left simpleCart_shelfItem">
					<h3 class="mb-3"><?php echo $row_chitiet['product_name']; ?></h3>
					<p class="mb-3">
						<span class="item_price"><?php echo number_format($row_chitiet['product_giakhuyenmai']).'vnđ'; ?></span>
						<del class="mx-2 font-weight-light"><?php echo number_format($row_chitiet['product_gia']).'vnđ'; ?></del>
						<label>Miễn phí vận chuyển</label>
					</p>
					<div class="product-single-w3l">
						<p><?php echo $row_chitiet['product_chitiet']; ?></p> </br>
						<p><?php echo $row_chitiet['product_mota']; ?></p> <br>
					</div>
					<div class="occasion-cart">
						<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
							<form action="?quanly=giohang" method="post">
								<fieldset>
									<input type="hidden" name="tensanpham" value="<?php echo $row_chitiet['product_name']; ?>" />
									<input type="hidden" name="product_id" value="<?php echo $row_chitiet['product_id']; ?>" />
									<input type="hidden" name="giasanpham" value="<?php echo $row_chitiet['product_gia']; ?>" />
									<input type="hidden" name="hinhanh" value="<?php echo $row_chitiet['product_image']; ?>" />
									<input type="hidden" name="soluong" value="1" />
									<input type="submit" name="themgiohang" value="Thêm vào giỏ hàng" class="button" />
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- COMMENT -->
		<?php
			if($_SESSION['name']) {
		?>
		<h3 style="text-align: center;padding: 1rem 0;color: #d60404;">Đánh giá sản phẩm</h3>
		<div class="cmt">
			<iframe style="width: 100%;height: 25rem;" src="binhluan.php?idsp=<?php=$_GET['id']; ?>" frameborder="0"></iframe>
			<div style="width: 100%;display: flex;flex-direction: column;" class="py-xl-4 py-lg-2 container item_view align-items-start gap-2 border-top p-2">
				<?php
					$sql_cmt2 = mysqli_query($conn, "SELECT * FROM tbl_comment WHERE product_id = '$id' ORDER BY id DESC");
					while($row_comment = mysqli_fetch_array($sql_cmt2)) {
				?>
				<div class="box">
					<a href="" class="d-block p-2 rounded-circle bg-body-tertiary">
						<i class="fa-solid fa-user p-2 text-light-emphasis fs-5"></i>
					</a>
				</div>
				<div class="list_info">
					<div class="group_info">
						<span class="fs-6 text-black"><?php echo $row_comment['tenKH']; ?></span>
					</div>
					<p style="color: #20c997;" class="comment fs-6 text-black"><?php echo $row_comment['noidung']; ?></p>
					<p class="date-time text-body-tertiary" style="font-size: 0.8rem;"><?php echo $row_comment['ngayBL']; ?></p>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
		<!-- COMMENT -->
	</div>
<?php } ?>

	<!-- //Single Page -->