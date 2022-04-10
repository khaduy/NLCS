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
                        <a href="./chinhsachdoitra.php" style="background-color: #666;">Chính sách đổi trả</a>
                    </li>
                    <li>
                        <a href="./chinhsachgiaohang.php">Chính sách giao hàng</a>
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
			<h4 style="font-weight: bold;">1. Sản phẩm lỗi do nhà sản xuất:</h4>
				<h5 style="font-weight: bold;">Tháng 1: </h5>
					<p>	
						1 đổi 1 (cùng mẫu, cùng màu, cùng dung lượng...) .<br>
						Trường hợp sản phẩm đổi hết hàng, khách hàng có thể đổi sang sản phẩm khác cùng nhóm hàng có giá trị lớn hơn 50% giá trị sản phẩm lỗi (KTD SHOP sẽ hoàn tiền phần chênh lệch cho khách hàng). <br>
						Hoặc: khách hàng trả máy & KTD SHOP hoàn lại tiền với mức giá bằng 80% giá trên hoá đơn.
					</p>
				<h5 style="font-weight: bold;">Tháng 2 - 12:</h5>
					<p>
						Gửi máy bảo hành theo quy định của hãng. <br>
						Hoặc: Khách hàng trả máy & KTD SHOP hoàn lại tiền và thu phí thêm 5% so với mức hoàn tiền khi trả ở tháng thứ 1. <br>
						VD: Ở tháng thứ nhất, nếu khách hàng trả sản phẩm sẽ được hoàn lại tiền với mức giá bằng 80% thì sang tháng thứ 2 nếu khách hàng trả máy sẽ thu phí thêm 5% nên mức hoàn tiền sẽ còn 75% giá trị sản phẩm trên hoá đơn, tháng thứ 3 mức hoàn tiền sẽ trừ thêm 5% thành 70%....
					</p>

			<h4 style="font-weight: bold;">2. Sản phẩm không lỗi (không phù hợp với nhu cầu của khách hàng):</h4>
				<h5 style="font-weight: bold;">Tháng 1: </h5>
					<p>
						Hoàn lại tiền máy với giá bằng 80% giá trên hoá đơn. <br>
				<h5 style="font-weight: bold;">Tháng 2 - 12 : </h5>
						Hoàn lại tiền với mức phí thêm 5% so với tháng thứ 1 (80%). VD: tháng thứ 2 hoàn lại tiền với mức giá 75% giá trên hoá đơn, tháng thứ 3 là 70%...
					</p>

			<h4 style="font-weight: bold;">3. Sản phẩm lỗi do người sử dụng:</h4>
				<p>
					> Không đủ điều kiện bảo hành theo qui định của hãng. <br>
					> Máy không giữ nguyên 100% hình dạng ban đầu. <br>
					> Màn hình bị trầy xước. <br>
					=> Không áp dụng bảo hành, đổi trả. KTD SHOP hỗ trợ chuyển bảo hành, khách hàng chịu chi phí sửa chữa.
				</p>
		</div>
		<!-- END CS -->

		<!-- FOOTER -->
        <?php include ('includes/footer.php') ?>
		<!-- END FOOTER -->

	</div>
</body>
</html>