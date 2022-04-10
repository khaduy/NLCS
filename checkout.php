<!DOCTYPE html>
<html>
<head>
    <title>KTD SHOP</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!--slide-->
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <link rel="stylesheet" type="text/css" href="css/dndk.css">
</head>
<?php session_start(); ?>
<body>
<div id="wrapper">
    <!-- HEADER -->     
    <?php include ('includes/header.php') ?>
    <!-- END HEADER -->
    
    <!-- MENUNAV -->
    <div id="menunav">
        <div class="container">
            <nav>
                <!-- <h1 class="nav">Trang đăng nhập:</h1> -->
            </nav>
        </div>          
    </div>
    <!-- END MENUNAV -->
    
    <!-- LOGIN -->
    <?php     
        if(!isset($_SESSION['current_user'])){
            include('xulydangnhap.php');
        }else{
            header('Location:'.'cart.php');
        } 
    ?>
    <!-- END LOGIN -->
    
    <!-- FOOTER -->
    <?php include ('includes/footer.php') ?>
    <!-- END FOOTER -->

</div>      
</body>
</html>

