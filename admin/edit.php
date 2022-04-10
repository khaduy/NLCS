<!DOCTYPE html>
<html>
<head>
    <title>Sửa thông tin</title>
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
    <?php include ('includes/menunav.php') ?>
    <!-- END MENUNAV -->

    <!-- MAIN -->
<?php if (!empty($_SESSION['current_admin'])) { ?>
<?php

    $error = false;
    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
        $fullname = $_POST['fullname'];
        $pass = $_POST['pass'];
        // $mota = $_POST['mota'];
        if (!$fullname || !$pass ) {
            echo "<div class='form-text'>Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a></div>";

            exit;
        }

        $ud = $conn->query("UPDATE user SET fullname = '" . $fullname . "',
                                            password = MD5('" . $pass . "')
                                            WHERE id = " . $_POST['id'] . ";
                                            ");
        if (!$ud) {
            $error = "<div class='form-text'>Không thể sửa thành viên</div>";
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
                <h4>Sửa thông tin thành công</h4>
                <a href=index.php>Trang chủ</a>
            </div>
        <?php
    }
} else {

    //var_dump($_GET['MSHH']);exit;
    $result = $conn->query("SELECT * FROM user WHERE id ='" . $_GET['id'] . "'");
    $row = $result->fetch_assoc();

    if (!empty($row)) {
        ?>
            <div class="form-text main-content uedit">
                <form action='edit.php?action=edit' method="POST">
                    <h1 style="text-align: center;">Sửa thông tin "<?php echo $row['fullname'] ?>"</h1>
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <label>Tên nhân viên:</label> <br><input type="text" name="fullname" value="<?php echo $row['fullname'] ?>" size="30"><br><br>
                    <label>Mật khẩu:</label> <br><input type="text" name="pass" size="30"><br><br>
                  
                    <input type="submit" value="Submit">
                    <input type="reset" value="Reset">
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






















