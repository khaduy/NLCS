<!DOCTYPE html>
<html lang="en">
<head>
	<title>KTD SHOP</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="css/css.css">
</head>
<?php
	session_start();
	include './conn.php';
	// $products = mysqli_query($conn, "SELECT * FROM hanghoa WHERE manhom = $id  ORDER BY gia DESC");
	$category = mysqli_query($conn,"SELECT * FROM nhomhanghoa WHERE manhom < 90000 ");
	$search = isset($_GET['keywork']) ? $_GET['keywork'] : "";

	if(isset( $_GET['id'] )  ){
		$products = mysqli_query($conn, "SELECT * FROM hanghoa WHERE manhom = ".$_GET['id']);
	} else if(empty( $_GET['id'] )){
		if($search) {
			$where = "WHERE 'keywork' LIKE '%" . $search . "%'";
			$products = mysqli_query($conn, "SELECT * FROM hanghoa WHERE tenhh LIKE '%" . $search . "%' ORDER BY gia DESC");
		} else if(empty($search)) {
			header('Location: '.'index.php');
		}
	}
?>
<body>
	

	<div class="wrapper">

		<!-- HEADER --> 	
		<?php include ('includes/header.php') ?>
		<!-- END HEADER -->
		
		<!-- MENUNAV -->
		<?php include ('includes/menunav.php') ?>
		<!-- END MENUNAV -->

		<!-- LIST -->
		<div id="maincontent">
		    <div class="container">
		        <div class="col-md-3  fixside" >
		            <div class="box-left box-menu">
		                <h3 class="box-title"><i class="fa fa-shopping-basket"></i>  Sản phẩm nổi bật </h3>
		                <ul>                                
		                    <li class="clearfix">
		                        <a href="detail.php?id=10001">
		                            <img src="images/iphone1.png" class="img-responsive pull-left" width="80" height="80">
		                            <div class="info pull-right">
		                                <p class="name">iPhone 11 Pro 64GB</p>
		                                <b class="price">30.990.000đ</b><br><br>                               
		                            </div>
		                        </a>
		                    </li>

		                     <li class="clearfix">
		                        <a href="detail.php?id=30001">
		                            <img src="images/oppo1.png" class="img-responsive pull-left" width="80" height="80">
		                            <div class="info pull-right">
		                                <p class="name">OPPO Find X2</p >
		                                <b class="price">21.990.000đ</b><br><br>                                     
		                            </div>
		                        </a>
		                    </li>

		                     <li class="clearfix">
		                        <a href="detail.php?id=20001">
		                            <img src="images/samsung1.png" class="img-responsive pull-left" width="80" height="80">
		                            <div class="info pull-right">
		                                <p class="name">Samsung Galaxy S20 Ultra</p >
		                                <b class="price">29.990.000đ</b><br><br>                                           
		                            </div>
		                        </a>
		                    </li>
		                </ul>
		            </div>
		        </div>

		        <div class="col-md-9 bor">
		            <?php while ($row = mysqli_fetch_array($products)) {?>
		            <section class="box-main1">            
		                <div class="showitem">
		                    <div class="col-md-3 item-product bor" style="height: 280px">
		                        <a href="detail.php?id=<?php echo $row['mshh']?>">
		                            <img src="<?php echo $row['hinh'] ?>" class="" width="157" height="180">
		                        </a>
		                        <div class="info-item">
		                            <a href="detail.php?id=<?php echo $row['mshh']?>"><?php echo $row['tenhh']?></a>
		                            <p><b class="price"><?php echo number_format($row['gia'],0,' ','.'); ?>đ</b></p>
		                        </div>
		                    </div>                    
		                </div>
		            </section>
		            <?php }?>
		            </div>
		        </div>
		    </div>            
		</div> 
		<!-- END LIST -->

		<!-- FOOTER -->
        <?php include ('includes/footer.php') ?>
		<!-- END FOOTER -->

	</div>
</body>
</html>