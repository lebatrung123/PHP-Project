<?php
	session_start();
	include_once('db/connect.php');
	date_default_timezone_set('Asia/Ho_Chi_Minh');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<!-- Custom-Files -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Bootstrap css -->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Main css -->
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<!-- pop-up-box -->
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<!-- menu style -->
	<!-- //Custom-Files -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

	<!-- web fonts -->
	<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
	    rel="stylesheet">
	<!-- //web fonts -->
</head>
<body>
    <form action="binhluan.php" method="POST">
        <input type="hidden" name="name" value="<?php echo $_SESSION['name']; ?>">
        <input type="hidden" name="khachhang_id" value="<?php echo $_SESSION['khachhang_id']; ?>">
        <input type="hidden" name="idsp" value="<?php echo $_SESSION['idsp']; ?>">
		<input type="hidden" name="date" value="<?php echo date("d-m-y H:i:s");?>">
        <div style="display: flex;flex-direction: column;" class="py-xl-4 py-lg-2 container">
			<textarea style="height: 10rem;" name="noidung"></textarea>
			<button name="guibinhluan" style="margin-top: 1rem; width: 15%;" class="btn btn-success">Gửi</button>
		</div>
		<?php
			if(isset($_POST['guibinhluan'])) {
				$name = $_POST['name'];
				$idsp = $_POST['idsp'];
				$noidung = $_POST['noidung'];
				$date = $_POST['date'];
				$khachhang_id = $_POST['khachhang_id'];

				$sql_cmt1 = mysqli_query($conn, "INSERT INTO tbl_comment(product_id, khachhang_id, tenKH, noidung, ngayBL) VALUES
				($idsp, $khachhang_id, '$name', '$noidung', '$date')");
		
				echo '<div class="py-xl-4 py-lg-2 container item_view d-flex align-items-start gap-2 border-top p-2">
						<div class="box">
							<a href="" class="d-block p-2 rounded-circle bg-body-tertiary">
								<i class="fa-solid fa-user p-2 text-light-emphasis fs-5"></i>
							</a>
						</div>
						<div class="list_info">
							<div class="group_info">
								<span class="fs-6 text-black">'.$name.'</span>
							</div>
							<p class="comment fs-6 text-black">'.$noidung.'</p>
							<p class="date-time text-body-tertiary" style="font-size: 0.8rem;">'.$date.'</p>
						</div>
					</div>';
			}
		?>
    </form>
    <!-- <div class="apps p-3">
			<div class="container border border-2 border-warning h-100 p-3">
				<h3>ĐÁNH GIÁ SẢN PHẨM</h3>
				<form action="" method="POST">
					<div class="list_review">
                    <?php
							$sql_comment = mysqli_query($conn, "SELECT * FROM tbl_comment WHERE product_id = '$id' ORDER BY id DESC");
							while($row_comment = mysqli_fetch_array($sql_comment)){
						?>
						<div class=" mt-4 mb-4" style="width: 100%; height: 10rem;">
							<input type="hidden" id="product_id" value="<?php echo $id; ?>">
							<input type="hidden" id="name" value="<?php echo  $_SESSION['name']; ?>" >
							<input type="hidden" id ="date" value="<?php echo date("d-m-y H:i:s");?>">
							<input type="text" id="massage" style="width: 100%; height: 10rem;">
						</div>
						<button id="btn-cmt" name="btn-cmt" style="margin-bottom: 1rem; width: 15%;" class="btn btn-success">Gửi</button>
						<div id="dsbinhluan" class="item_view d-flex align-items-start gap-2 border-top p-2">
							<div class="box">
								<a href="" class="d-block p-2 rounded-circle bg-body-tertiary">
									<i class="fa-solid fa-user p-2 text-light-emphasis fs-5"></i>
								</a>
							</div>
							<div class="list_info">
								<div class="group_info">
									<span class="fs-6 text-black"><?php echo $row_comment['tenKH']; ?></span>
									<p class="text-body-tertiary" style="font-size: 0.9rem;"><?php echo $row_comment['note']; ?></p>
								</div>
								<p class="comment fs-6 text-black"><?php echo $row_comment['message']; ?></p>
								<p class="date-time text-body-tertiary" style="font-size: 0.8rem;"><?php echo $row_comment['ngayBL']; ?></p>
							</div>
						</div>
						<?php } ?>
					</div>
				</form>
			</div>
		</div> -->
</body>
</html>