<?php
	if(isset($_POST['search_btn'])) {
        $tukhoa = $_POST['search_prd'];
        $sql_product = mysqli_query($conn, "SELECT * FROM tbl_product WHERE product_name LIKE '%$tukhoa%' ORDER BY product_id DESC");
    }
?>

<!-- top Products -->
<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">Từ khóa tìm kiếm: <?php echo $tukhoa; ?></h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<div class="row">
								<?php 
									while($row_product = mysqli_fetch_array($sql_product)) {
								?>
								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="images/<?php echo $row_product['product_image'] ;?>" alt="" class="h-50 w-75">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="?quanly=chitietsp&id=<?php echo $row_product['product_id']; ?>" class="link-product-add-cart">
														Xem sản phẩm
													</a>
												</div>
											</div>
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="?quanly=chitietsp&id=<?php echo $row_product['product_id']; ?>">
													<?php echo $row_product['product_name']; ?>
												</a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price"><?php echo number_format($row_product['product_giakhuyenmai']).'vnđ'; ?></span>
												<del><?php echo number_format($row_product['product_gia']).'vnđ'; ?></del>
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
											<form action="?quanly=giohang" method="post">
												<fieldset>
													<input type="hidden" name="tensanpham" value="<?php echo $row_product['product_name']; ?>" />
													<input type="hidden" name="product_id" value="<?php echo $row_product['product_id']; ?>" />
													<input type="hidden" name="giasanpham" value="<?php echo $row_product['product_gia']; ?>" />
													<input type="hidden" name="hinhanh" value="<?php echo $row_product['product_image']; ?>" />
													<input type="hidden" name="soluong" value="1" />
													<input type="submit" name="themgiohang" value="Thêm vào giỏ hàng" class="button" />
												</fieldset>
											</form>
											</div>
										</div>
									</div>
								</div>
										<?php } ?>
									</div>
								</div>
						<!-- first section -->
					</div>
				</div>
				<!-- //product left -->
				<!-- product right -->
				<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
					<div class="side-bar p-sm-4 p-3">
						
						<!-- Danh mục sản phẩm -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Danh mục sản phẩm</h3>
							<ul>
								<?php
									$sql_category_sidebar = mysqli_query($conn, "SELECT * FROM tbl_category ORDER BY category_id DESC");
									while($row_category_sidebar = mysqli_fetch_array($sql_category_sidebar)) {
								?>
								<li>
									<!-- <input type="checkbox" class="checked"> -->
									<span class="span">
										<a href="danhmucsp.php?id=<?php echo $row_category_sidebar['category_id']; ?>">
										<?php echo $row_category_sidebar['category_name']; ?>
										</a>
									</span>
								</li>
								<?php } ?>
							</ul>
						</div>
						<!-- //Danh mục sản phẩm -->
						<!-- Sản phẩm bán chạy -->
						<div class="f-grid py-2">
							<h3 class="agileits-sear-head mb-3">Sản phẩm bán chạy</h3>
							<div class="box-scroll">
								<div class="scroll">
									<?php
										$sql_product_sidebar = mysqli_query($conn, "SELECT * FROM tbl_product 
										WHERE product_hot = '0' ORDER BY product_id DESC");
										while($row_product_sidebar = mysqli_fetch_array($sql_product_sidebar)) {
									?>
									<div class="row">
										<div class="col-lg-3 col-sm-2 col-3 left-mar">
											<img src="images/<?php echo $row_product_sidebar['product_image']; ?>" alt="" class="img-fluid">
										</div>
										<div class="col-lg-9 col-sm-10 col-9 w3_mvd">
											<a href="?quanly=chitietsp&id=<?php echo $row_product_sidebar['product_id']; ?>"><?php echo $row_product_sidebar['product_name']; ?></a>
											<a href="?quanly=chitietsp&id=<?php echo $row_product_sidebar['product_id']; ?>" class="price-mar mt-2"><?php echo number_format($row_product_sidebar['product_giakhuyenmai']).'vnđ'; ?></a>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
						<!-- //Sản phẩm bán chạy -->
					</div>
					<!-- //product right -->
				</div>
			</div>
		</div>
	</div>
	<!-- //top products -->