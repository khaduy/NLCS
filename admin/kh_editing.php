<!DOCTYPE html>
<html>
<head>
    <title>Sửa khách hàng</title>
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
<?php

    $error = false;
    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
        // $fullname = $_POST['fullname'];
        $pass = $_POST['pass'];
        // $mota = $_POST['mota'];
        if ( !$pass ) {
            echo "<div class='form-text'>Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a></div>";

            exit;
        }

        $ud = $conn->query("UPDATE khachhang SET MatKhau = MD5('" . $pass . "')
                                            WHERE SoDienThoai = " . $_POST['id'] . ";
                                            ");
        if (!$ud) {
            $error = "<div class='form-text'>Không thể sửa thành viên</div>";
        }
        if ($error !== false) {
    ?>
            <div class="form-text" style="text-align: center;">
                <h1>Thông báo</h1>
                <h4><?php echo $error ?></h4>
            </div>
        <?php } else {
        ?>
            <?php if ($error !== false)
            ?>
            <div class="form-text" style="text-align: center;">
                <h1>Thông báo</h1>
                <h4>Sửa khách hàng thành công</h4>
                <a href="kh_listing.php">Danh sách</a>
            </div>
        <?php
    }
} else {

    //var_dump($_GET['MSHH']);exit;
    $result = $conn->query("SELECT * FROM khachhang WHERE SoDienThoai ='" . $_GET['id'] . "'");
    $row = $result->fetch_assoc();

    if (!empty($row)) {
        ?>
            <div class="form-text">
                <form action='kh_editing.php?action=edit' method="POST" class="main-content uedit">
                    <h1 style="text-align: center;">Sửa khách hàng <?php echo $row['HoTenKH'] ?></h1>
                    <br>
                    <input type="hidden" name="id" value="<?php echo $row['SoDienThoai'] ?>">
                    <!-- <label>Tên nhân viên:</label> <br><input type="text" name="fullname" value="<?php echo $row['HoTenKH'] ?>" size="30"><br><br> -->
                    <label>Mật khẩu:</label> <br><input type="text" name="pass" size="30"> <br> <br>
                    <input type="submit" value="Submit">
                    <input type="reset" value="Reset"><br><br>
                </form>
            </div>
    <?php
    }
}
    ?>
<?php } ?>
    <!-- END MAIN -->
</body>
</html>






















