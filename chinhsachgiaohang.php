<!DOCTYPE html>
<html lang="en">
<head>
	<title>KTD SHOP</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="css/css.css">
</head>
<?php
	session_start();
	include './conn.php';
	
	$search = isset($_GET['keywork']) ? $_GET['keywork'] : "";
	if($search){
		$where = "WHERE 'keywork' LIKE '%" . $search . "%'";
	}

	$item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:8;
    $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
    $offset = ($current_page - 1) * $item_per_page;
    if($search){
    	$products = mysqli_query($conn, "SELECT * FROM hanghoa WHERE tenhh LIKE '%" . $search . "%' ORDER BY gia DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
   		$totalRecords = mysqli_query($conn, "SELECT * FROM `hanghoa` WHERE manhom < 90000 ");
    } else {
    	$products = mysqli_query($conn, "SELECT * FROM hanghoa WHERE manhom < 90000 ORDER BY gia DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    	$totalRecords = mysqli_query($conn, "SELECT * FROM `hanghoa` WHERE manhom < 90000 ");
    }
    
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);

	$category = mysqli_query($conn, "SELECT * FROM nhomhanghoa WHERE manhom < 90000 ");

	$accessories = mysqli_query($conn, "SELECT * FROM `hanghoa` WHERE `manhom` LIKE '90000'");
	$accessories1 = mysqli_query($conn, "SELECT * FROM `hanghoa` WHERE `mshh` BETWEEN '90001' AND '90004'");
	$accessories2 = mysqli_query($conn, "SELECT * FROM `hanghoa` WHERE `mshh` BETWEEN '90005' AND '90008'");
?>
<body>
	

	<div class="wrapper">

		<!-- HEADER --> 	
		<?php include ('includes/header.php') ?>
		<!-- END HEADER -->
		
		<!-- MENUNAV -->
		<div id="menunav">
			<div class="container">
				<nav>
					<!-- menu-main -->
					<ul class="menu-main" style="margin-left: -50px;">
                    <li>
                        <a href="index.php" style="border-left: 1px solid #555;">Trang chủ</a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="dropbtn" disabled="">Hãng điện thoại</button>
                            <div class="dropdown-content">
                                <?php while ($row = mysqli_fetch_array($category)) {?>
                                <a href="category.php?id=<?php echo $row['manhom']?>"><?php echo $row['tennhom']?></a>
                                <?php }?>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="./category.php?id=90000">Phụ kiện</a>
                    </li>
                    <li>
                        <a href="./chinhsachdoitra.php">Chính sách đổi trả</a>
                    </li>
                    <li>
                        <a href="./chinhsachgiaohang.php" style="background-color: #666;">Chính sách giao hàng</a>
                    </li>
                    <li>
                        <a href="./cart.php">Quản lý giỏ hàng</a>
                    </li>
                </ul>
					<!-- end menu-main -->
				
					<!-- dndk -->
					<ul class="pull-right" id="dndk">
						<div id="dndk1">
							<?php if (empty($_SESSION['current_user'])) { ?>
							<li>
								<a href="dangnhap.php">Đăng nhập</a>
								<a href="dangky.php">Đăng ký</a>
							</li>
							<?php
							} else { 
							$currentUser = $_SESSION['current_user']; ?>
							<li>
								<a href="#">Xin chào: <?= $currentUser['HoTenKH'] ?></a>
								<a href="dangxuat.php">Đăng xuất</a>
							</li>
						<?php } ?>
						</div>
					</ul>
					<!-- end dndk -->
				</nav>
			</div>			
		</div>
		<!-- END MENUNAV -->

		<!-- CS -->
		<div style="width: 1000px;;margin: 20px 60px 50px 80px; ">
			<h4 style="font-weight: bold;">1. Phạm vi áp dụng:</h4>
				<p>Những khu vực tỉnh thành thuộc địa phận Việt Nam.</p>

			<h4 style="font-weight: bold;">2. Thời gian nhận hàng:</h4>
				<p>
					Đặt hàng trước 11h30p bạn sẽ nhận hàng trước 18h cùng ngày. <br>
					Đặt hàng sau 11h30p đơn hàng chuyển sang giao trước 18h ngày hôm sau .
				</p>

			<h4 style="font-weight: bold;">3. Phí giao hàng:</h4>
				<p>
					Đơn hàng trên 300.000đ: miễn phí giao hàng. <br>
					Đơn hàng dưới 300.000đ: phụ thu 10.000đ phí giao hàng:
				</p>
		</div>
		<!-- END CS -->

		<!-- FOOTER -->
        <?php include ('includes/footer.php') ?>
		<!-- END FOOTER -->

	</div>
</body>
</html>