<?php
    if (isset($_GET['id_tin'])) {
        $id_baiviet = $_GET['id_tin'];
    }else{
        $id_baiviet = '';
    }
?>

<!-- page -->
<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">Trang chủ</a>
						<i>|</i>
					</li>
                    <?php
                        $sql_baiviet = mysqli_query($conn, "SELECT * FROM tbl_baiviet WHERE baiviet_id = '$id_baiviet'");
                        $row_baiviet = mysqli_fetch_array($sql_baiviet); 
                    ?>
					<li><?php echo $row_baiviet['tenbaiviet']; ?></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- about -->
	<div class="welcome py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
            <?php
                $sql_baiviet1 = mysqli_query($conn, "SELECT * FROM tbl_baiviet WHERE baiviet_id = '$id_baiviet'");
                $row_baiviet1 = mysqli_fetch_array($sql_baiviet1);
            ?>
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<?php echo $row_baiviet1['tenbaiviet']; ?></h3>
			<!-- //tittle heading -->
			<?php
				$sql_baiviet2 = mysqli_query($conn, "SELECT * FROM tbl_baiviet WHERE baiviet_id = '$id_baiviet'");
				while($row_baiviet2 = mysqli_fetch_array($sql_baiviet2)){
			?>
			<div class="row">
				<div class="col-lg-8 welcome-left">
					<!-- <h3><a style="color: #f4696a;" href="index.php?quanly=chitiettin&id_tin=<?php echo $row_baiviet['baiviet_id']; ?>">
						<?php echo $row_baiviet['tenbaiviet']; ?>
					</a></h3> -->
					<h4 class="my-sm-3 my-2"><?php echo $row_baiviet['tomtat']; ?></h4>
					<p><?php echo $row_baiviet['noidung']; ?></p>
				</div>
				<div class="col-lg-4 welcome-right-top mt-lg-0 mt-sm-5 mt-4">
					<img src="images/<?php echo $row_baiviet['image']; ?>" class="img-fluid" alt=" ">
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<!-- //about -->
