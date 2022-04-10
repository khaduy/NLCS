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
	

	$item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:8;
    $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
    $offset = ($current_page - 1) * $item_per_page;  
	$products = mysqli_query($conn, "SELECT * FROM hanghoa WHERE manhom < 90000 ORDER BY gia DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
	$totalRecords = mysqli_query($conn, "SELECT * FROM `hanghoa` WHERE manhom < 90000 ");

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
		<?php include ('includes/menunav.php') ?>
		<!-- END MENUNAV -->

		<!--BANNER -->
        <?php include ('includes/banner.php') ?>
		<!--END BANNER -->

		<!-- LIST -->
		<?php include ('includes/list.php') ?>
		<!-- END LIST -->

		<!-- PHUKIEN -->
		<?php include ('includes/accessories.php') ?>
		<!-- END PHUKIEN -->

		<!-- FOOTER -->
        <?php include ('includes/footer.php') ?>
		<!-- END FOOTER -->

	</div>
</body>
</html>