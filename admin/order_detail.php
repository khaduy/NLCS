<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết đơn hàng</title>
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
<?php if (isset($_GET['action']) && $_GET['action'] == 'save') {
    // var_dump("UPDATE `dathang` SET `TrangThai` = " . $_POST['status'] . "  WHERE `dh_id` = " . $_POST['id'] . "");
    $orders = mysqli_query($conn, "UPDATE `dathang` SET `TrangThai` = " . $_POST['status'] . "  WHERE `dh_id` = " . $_POST['id'] . ";");
    $orders = mysqli_query($conn, "UPDATE `dathang` SET `nv_id` = " . $_POST['nv_id'] . "  WHERE `dh_id` = " . $_POST['id'] . ";");
    header('Location: ./order_listing.php');
} if (!empty($_SESSION['current_admin'])) {
    $currentUser = $_SESSION['current_admin'];
    $orders = mysqli_query($conn, "SELECT dathang.HoTen, dathang.nv_id, dathang.DiaChi, dathang.SoDienThoai, dathang.chuthich, chitietdathang.*, hanghoa.tenhh as tenhanghoa
        FROM dathang
        INNER JOIN chitietdathang ON dathang.dh_id = chitietdathang.dh_id
        INNER JOIN hanghoa ON hanghoa.mshh = chitietdathang.mshh
        WHERE dathang.dh_id = " . $_GET['id']);
    $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
     ?>    
    <div id="order-detail-wrapper">
        <div id="order-detail" class="main-content" style="width: 840px;">
            <h1 style="text-align: center;">Chi tiết đơn hàng</h1>
            <label>Người nhận: </label><span> <?= $orders[0]['HoTen'] ?></span><br/>
            <label>Điện thoại: </label><span> <?= $orders[0]['SoDienThoai'] ?></span><br/>
            <label>Địa chỉ: </label><span> <?= $orders[0]['DiaChi'] ?></span>
            <h3>Danh sách sản phẩm</h3>
            <ul>
                <?php
                $totalQuantity = 0;
                $totalMoney = 0;
                foreach ($orders as $row) {
                    ?>
                    <li>
                        <span class="item-name"><?= $row['tenhanghoa'] ?></span>
                        <span class="item-quantity"> - SL: <?= $row['soluong'] ?> sản phẩm</span>
                    </li>
                    <?php
                    $totalMoney += ($row['gia'] * $row['soluong']);
                    $totalQuantity += $row['soluong'];
                }
                ?>
            </ul>
            <hr/>
            <label>Tổng SL:</label> <?= $totalQuantity ?> - <label>Tổng tiền:</label> <?= number_format($totalMoney, 0, ",", ".") ?>đ
            <p><label>Ghi chú: </label><?= $orders[0]['chuthich'] ?></p>
            <form action="./order_detail.php?action=save" method="POST">
                <input type="hidden" name="id" value="<?= $orders[0]['dh_id'] ?>" />
                <input type="hidden" name="nv_id" value="<?= $currentUser['id'] ?>" />
                <hr>
                <select name="status">
                    <option value="1">Đã xác nhận</option>
                    <option value="0">Chờ xác nhận</option>
                    <option value="2">Đã huỷ đơn</option>
                </select>
                <input type="submit" value ="Lưu">    
            </form>
            <hr>
        </div>
    </div>
<?php } ?>
    <!-- END MAIN -->
</body>
</html>
