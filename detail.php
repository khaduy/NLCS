<!DOCTYPE html>
<html lang="en">
<head>
	<title>KTD SHOP</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<link rel="stylesheet" type="text/css" href="css/detail.css">
</head>
<?php
	session_start();
	include './conn.php';
	$category = mysqli_query($conn,"SELECT * FROM nhomhanghoa WHERE manhom < 90000 ");
	$products = mysqli_query($conn, "SELECT * FROM hanghoa WHERE mshh = ".$_GET['id']);

?>
<body>
	

	<div class="wrapper">

		<!-- HEADER --> 	
		<?php include ('includes/header.php') ?>
		<!-- END HEADER -->
		
		<!-- MENUNAV -->
		<?php include ('includes/menunav.php') ?>
		<!-- END MENUNAV -->

		<!-- LIST PRODUCT-->
		<?php include ('includes/detail_product.php') ?>
		<!-- END LIST PRODUCT -->

		<!-- FOOTER -->
        <?php include ('includes/footer.php') ?>
		<!-- END FOOTER -->

	</div>
</body>
</html>