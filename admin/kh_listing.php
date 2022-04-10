<!DOCTYPE html>
<html>
<head>
    <title>Quản lý khách hàng</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KTD SHOP</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
    <link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    
    <link rel="stylesheet" type="text/css" href="./css/admin_style.css">
    <link rel="stylesheet" type="text/css" href="../css/css.css">
    <style>
        .box-content{
            margin: 0 auto;
            width: 800px;
            border: 1px solid #ccc;
            text-align: center;
            padding: 20px;
        }
        #user_login form{
            width: 200px;
            margin: 40px auto;
        }
        #user_login form input{
            margin: 5px 0;
        }
    </style>
</head>
<?php
include '../conn.php';
session_start();
$item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:8;
$current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
$offset = ($current_page - 1) * $item_per_page;
$user = mysqli_query($conn, "SELECT * FROM khachhang LIMIT " . $item_per_page . " OFFSET " . $offset);
$totalRecords = mysqli_query($conn, "SELECT * FROM `khachhang`");
$totalRecords = $totalRecords->num_rows;
$totalPages = ceil($totalRecords / $item_per_page);
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>


<body>
    <!-- HEADER -->     
    <?php include ('includes/header.php') ?>
    <!-- END HEADER -->
    
    <!-- MENUNAV -->
    <div id="menunav">
        <div class="container">
            <nav>
                <ul class="menu-main" style="margin-left: -50px;">
                    <li>
                        <a href="index.php" style="border-left: 1px solid #555;">Trang chủ</a>
                    </li>
                    <li>
                        <a href="order_listing.php">Quản lý đơn hàng</a>
                    </li>
                    <li>
                        <a href="./kh_listing.php" style="background-color: #666;">Quản lý khách hàng</a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <!-- <button class="dropbtn" disabled="">Hãng điện thoại</button>
                            <div class="dropdown-content">
                                <?php while ($row = mysqli_fetch_array($category)) {?>
                                <a href="category.php?id=<?php echo $row['manhom']?>"><?php echo $row['tennhom']?></a>
                                <?php }?>
                            </div> -->
                        </div>
                    </li>
                    <li>
                        <a href="./user_listing.php" >Quản lý nhân viên</a>
                    </li>
                    <li>
                        <a href="./gr_listing.php">Quản lý nhóm sản phẩm</a>
                    </li>
                    <li>
                        <a href="./product_listing.php">Quản lý sản phẩm</a>
                    </li>
                </ul>
                <!-- end menu-main -->
            
                <!-- dndk -->
                <ul class="pull-right" id="dndk">
                    <div id="dndk1">
           
                    </div>
                </ul>
                <!-- end dndk -->
            </nav>
        </div>          
    </div>
    <!-- END MENUNAV -->

    <!-- MAIN -->
<?php if (!empty($_SESSION['current_admin'])) { ?>
<div class="main-content" style="width: 890px;">
    <h1 style="text-align: center;">Danh sách khách hàng</h1>
    <div class="product-items">
        <div class="buttons">
            <!-- <a href="./user_create.php">Thêm nhân viên</a> -->
        </div>
        <table>
            <tr>
                <th><div class="product-prop product-right">Họ tên</div></th>
                <th><div class="product-prop product-right">Số điện thoại</div></th>
                <th><div class="product-prop product-name">Địa chỉ</div></th>
                <th><div class="product-prop product-name" style="width: 300px;">Email</div></th>
                <th><div class="product-prop product-button">Sửa</div></th>
                <!-- <th><div class="product-prop product-button">Xóa</div></th> -->
            </tr>
             <?php while ($row = mysqli_fetch_array($user)) { ?>
            <tr>
                <th><div class="product-prop product-right"><?= $row['HoTenKH'] ?></div></th>
                <th><div class="product-prop product-right"><?= $row['SoDienThoai'] ?></div></th>
                <th><div class="product-prop product-name"><?= $row['DiaChi'] ?></div></th>
                <th><div class="product-prop product-name" style="width: 300px;"><?= $row['Email'] ?></div></th>
                <th><div class="product-prop product-button">
                        <a href="./kh_editing.php?id=<?= $row['SoDienThoai'] ?>">Sửa</a>
                    </div></th>
          <!--       <th><div class="product-prop product-button">
                        <a href="./user_delete.php?id=<?= $row['id'] ?>">Xóa</a>
                    </div></th> -->
            </tr>
            <?php } ?>
        </table>
        <?php
        include './pagination.php';
        ?>
        <div class="clear-both"></div>
    </div>
</div>
<?php } ?>
    <!-- END MAIN -->
</body>
</html>
