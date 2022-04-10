<!DOCTYPE html>
<html>
<head>
    <title>Quản lý đơn hàng</title>
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
$products = mysqli_query($conn, "SELECT * FROM dathang ORDER BY NgayDH DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
$totalRecords = mysqli_query($conn, "SELECT * FROM `dathang`");
$totalRecords = $totalRecords->num_rows;
$totalPages = ceil($totalRecords / $item_per_page); //Làm tròn số
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
                        <a href="order_listing.php" style="background-color: #666;">Quản lý đơn hàng</a>
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
                        <a href="./user_listing.php">Quản lý nhân viên</a>
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
<div class="main-content">
    <h1 style="text-align: center;">Danh sách đơn hàng</h1>
    <div class="product-items">
        <div class="buttons">
            <!-- <a href="./product_create.php">Thêm sản phẩm</a> -->
        </div>
        <table>
            <tr>
                <th><div class="product-prop product-id">ID</div></th>
                <th><div class="product-prop product-sdt">Số điện thoại</div></th>
                <th><div class="product-prop product-name">Họ tên khách hàng</div></th>
                <th><div class="product-prop product-id" style="width: 70px;">MSNV</div></th>
                <th><div class="product-prop product-right" style="width: 250px;">Địa chỉ giao hàng</div></th>
                <th><div class="product-prop product-right" style="width: 250px;">Ghi chú</div></th>
                <th><div class="product-prop product-price">Tổng giá</div></th>
                <th><div class="product-prop product-right" style="width: 200px;">Ngày đặt hàng</div></th>
                <th><div class="product-prop product-right" style="width: 120px;">Trạng thái</div></th>
                <th><div class="product-prop product-button" style="width: 100px;">Chi tiết</div></th>
            </tr>
             <?php while ($row = mysqli_fetch_array($products)) { ?>
            <tr>
                <th><div class="product-prop product-id"><?= $row['dh_id'] ?></div></th>
                <th><div class="product-prop product-sdt"><?= $row['SoDienThoai'] ?></div></th>
                <th><div class="product-prop product-name"><?= $row['HoTen'] ?></div></th>
                <th><div class="product-prop product-id" style="width: 70px;"><?= $row['nv_id'] ?></div></th>
                <th><div class="product-prop product-right" style="width: 250px;"><?= $row['DiaChi'] ?></div></th>
                <th><div class="product-prop product-note"><?= $row['chuthich'] ?></div></th>
                <th><div class="product-prop product-price"><?= number_format($row['tonggia'], 0, ",", ".") ?>đ</div></th>
                <th><div class="product-prop product-right" style="width: 200px;"><?= date("d/m/Y g:i a" ,$row['NgayDH']) ?></div></th>
                <th>
                    <div class="product-prop product-right" style="width: 120px; color: red;">
                        <?php if($row['TrangThai'] == 1) {echo "Đã xác nhận";} ?>
                        <?php if($row['TrangThai'] == 0) {echo "Chờ xác nhận";}?>
                        <?php if($row['TrangThai'] == 2) {echo "Đã huỷ đơn";} ?>
                    </div>
                </th>
                <th><div class="product-prop product-button" style="width: 100px;">
                        <a href="./order_detail.php?id=<?= $row['dh_id'] ?>">Chi tiết</a>
                    </div>
                </th>
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
