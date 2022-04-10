<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sản phẩm</title>
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
$item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:5;
$current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
$offset = ($current_page - 1) * $item_per_page; //Offset sản phẩm bắt đầu
$products = mysqli_query($conn, "SELECT * FROM hanghoa ORDER BY gia DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
$totalRecords = mysqli_query($conn, "SELECT * FROM `hanghoa`");
$totalRecords = $totalRecords->num_rows;
$totalPages = ceil($totalRecords / $item_per_page);
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
                        <a href="./kh_listing.php">Quản lý khách hàng</a>
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
                        <a href="./user_listing.php"  >Quản lý nhân viên</a>
                    </li>
                    <li>
                        <a href="./gr_listing.php">Quản lý nhóm sản phẩm</a>
                    </li>
                    <li>
                        <a href="./product_listing.php" style="background-color: #666;">Quản lý sản phẩm</a>
                    </li>
                </ul>
                <!-- end menu-main -->
            
                <!-- dndk -->
                <ul class="pull-right" id="dndk">
                    <div id="dndk1">
                    <!-- <?php if (empty($_SESSION['current_user'])) { ?>
                        <li>
                            <a href="dangnhap.php">Đăng nhập</a>
                            <a href="dangky.php">Đăng ký</a>
                        </li>
                        <?php
                        } else { 
                        $currentUser = $_SESSION['current_user']; ?>
                        <li>
                            <a href="#">Xin chào: Admin ?></a>
                            <!-- <a href="#">Xin chào: <?= $currentUser['HoTenKH'] ?></a> -->
                            <!-- <a href="dangxuat.php">Đăng xuất</a> -->
                        </li>
                    <?php } ?> -->
                    </div>
                </ul>
                <!-- end dndk -->
            </nav>
        </div>          
    </div>
    <!-- END MENUNAV -->

    <!-- MAIN -->
<?php if (!empty($_SESSION['current_admin'])) { ?>
<div class="main-content" style="width: 970px;">
    <h1 style="text-align: center;">Danh sách sản phẩm</h1>
    <div class="product-items">
        <div class="buttons">
            <a href="./product_create.php">Thêm sản phẩm</a>
        </div>
        <table>
            <tr>
                <th><div class="product-prop product-img" style="height: 50px; text-align: center;">Ảnh</div></th>
                <th><div class="product-prop product-name">Tên sản phẩm</div></th>
                <th><div class="product-prop product-right">Số lượng</div></th>
                <th><div class="product-prop product-right">Mã nhóm</div></th>
                <th><div class="product-prop product-right">Giá</div></th>
                <th><div class="product-prop product-button">Sửa</div></th>
                <th><div class="product-prop product-button">Xóa</div></th>
            </tr>
             <?php while ($row = mysqli_fetch_array($products)) { ?>
            <tr>
                <th><div class="product-prop product-img"><img src="../<?= $row['hinh'] ?>" alt="<?= $row['tenhh'] ?>" title="<?= $row['tenhh'] ?>" width="157" height="180" /></div></th>
                <th><div class="product-prop product-name" style="height: 150px;"><?= $row['tenhh'] ?></div></th>
                <th><div class="product-prop product-right" style="height: 150px;"><?= $row['soluonghang'] ?></div></th>
                <th><div class="product-prop product-right" style="height: 150px;"><?= $row['manhom'] ?></div></th>
                <th><div class="product-prop product-right" style="height: 150px;"><?= number_format($row['gia'], 0, ",", ".") ?>đ</div></th>
                <th><div class="product-prop product-button" style="height: 150px;">
                        <a href="./product_editing.php?id=<?= $row['mshh'] ?>">Sửa</a>
                    </div></th>
                <th><div class="product-prop product-button" style="height: 150px;">
                        <a href="./product_delete.php?id=<?= $row['mshh'] ?>">Xóa</a>
                    </div></th>
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
