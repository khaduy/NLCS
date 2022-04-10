<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>Sửa sản phẩm</title>
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
<?php
    $error = false;
    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
        $mshh = $_POST['mshh'];
        $tenhh = $_POST['tenhh'];
        $gia = $_POST['gia'];
        $soluong = $_POST['soluong'];
        $manhom = $_POST['manhom'];
        $hinh = $_POST['hinh'];
        // $mota = $_POST['mota'];
        if (!$tenhh || !$gia || !$soluong || !$manhom ) {
            echo "<div class='form-text'>Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a></div>";

            exit;
        }

        $getthh = $conn->query("SELECT tenhh FROM hanghoa WHERE mshh = '" . $mshh . "'");
        $gthh = $getthh->fetch_row();
        $kttenhh = $conn->query("SELECT tenhh FROM hanghoa WHERE tenhh ='" . $tenhh . "'");
        if (mysqli_num_rows($kttenhh) > 0 && $tenhh != $gthh[0]) {
            echo "<div class='form-text'>Tên hàng hóa đã tồn tại, vui lòng chỉnh sửa hoặc nhập tên khác!. <a href='javascript: history.go(-1)'>Trở lại</a></div>";
            exit;
        }

        $ktmanhom = $conn->query("SELECT manhom FROM nhomhanghoa WHERE manhom ='" . $manhom . "'");
        if (mysqli_num_rows($ktmanhom) == 0) {
            echo "<div class='form-text'>Mã nhóm hàng hóa không hợp lệ. <a href='javascript: history.go(-1)'>Trở lại</a></div>";
            exit;
        }
        $ud = $conn->query("UPDATE hanghoa SET  tenhh = '" . $tenhh . "',
                                                gia = '$gia',
                                                soluonghang = '$soluong', 
                                                manhom = '" . $manhom . "', 
                                                hinh ='" . $hinh . "',
                                                motahh = NULL
                                                WHERE mshh = '" . $mshh . "'");
        if (!$ud) {
            $error = "<div class='form-text'>Không thể cập nhật sản phẩm</div>";
        }
        if ($error !== false) {
    ?>
            <div class="form-text main-content uedit" style="text-align: center;">
                <h1>Thông báo</h1>
                <h4><?php echo $error ?></h4>
            </div>
        <?php } else {
        ?>
            <?php if ($error !== false)
            ?>
            <div class="form-text main-content uedit" style="text-align: center;">
                <h1>Thông báo</h1>
                <h4>Sửa sản phẩm thành công</h4>
                <a href=product_listing.php ?>Danh sách</a>
            </div>
        <?php
    }
} else {

    //var_dump($_GET['MSHH']);exit;
    $result = $conn->query("SELECT * FROM hanghoa WHERE mshh ='" . $_GET['id'] . "'");
    $hh = $result->fetch_assoc();

    if (!empty($hh)) {
        ?>
            <div class="form-text main-content uedit">
                <form action='product_editing.php?action=edit' method="POST">
                    <h1 style="text-align: center;">Sửa sản phẩm "<?php echo $hh['tenhh'] ?>"</h1>
                    <input type="hidden" name="mshh" value="<?php echo $hh['mshh'] ?>">
                    <label>Tên sản phẩm:</label> <br><input type="text" name="tenhh" value="<?php echo $hh['tenhh'] ?>" size="30"><br><br>
                    <label>Giá:</label> <br><input type="number" name="gia" value="<?php echo $hh['gia'] ?>" size="30"><br><br>
                    <label>Số lượng:</label> <br><input type="number" name="soluong" value="<?php echo $hh['soluonghang'] ?>" size="30"><br><br>
                    <label for="manhom">Mã nhóm hành hóa: </label>
                    <select name="manhom" id="manhom">
                        <?php
                        $bgproduct = $conn->query("SELECT * FROM nhomhanghoa");
                        while ($row = $bgproduct->fetch_array()) {
                            echo "<option>" . $row['manhom'] . " </option>";
                        }
                        ?>

                    </select><br><br>
                    <label>Hình:</label> <br><input type="text" name="hinh" value="<?php echo $hh['hinh'] ?>" size="30"><br><br>
                    <input type="submit" value="Submit">
                    <input type="reset" value="Reset">
                </form><br>
            </div>
    <?php
    }
}
    ?>
<?php } ?>
    <!-- END MAIN -->
    
</body>
</html>






















