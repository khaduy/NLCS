<!DOCTYPE html>
<html>
    <head>
        <title>Trang quản trị</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KTD SHOP</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      
        <link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        
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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    ?>
    <body>
        <!-- HEADER -->     
        <?php include ('includes/header.php') ?>
        <!-- END HEADER -->
        
        <!-- MENUNAV -->
        <?php include ('includes/menunav.php') ?>
        <!-- END MENUNAV -->

        <?php
        session_start();
        include '../conn.php';
        $error = false;
        if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $result = mysqli_query($conn, "Select * from `user` WHERE (`username` ='" . $_POST['username'] . "' AND `password` = md5('" . $_POST['password'] . "'))");
            if (!$result) {
                $error = mysqli_error($conn);
            } else {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['current_admin'] = $user;
            }
            mysqli_close($conn);
            if ($error !== false || $result->num_rows == 0) {
                ?>
                <div id="login-notify" class="box-content">
                    <h1>Thông báo</h1>
                    <h4><?= !empty($error) ? $error : "Thông tin đăng nhập không chính xác" ?></h4>
                    <a href="./index.php">Quay lại</a>
                </div>
                <?php
                exit;
            }
            ?>
        <?php } ?>
        <?php if (empty($_SESSION['current_admin'])) { ?>
            <div id="user_login" class="box-content">
                <h1>Đăng nhập tài khoản</h1>
                <form action="./index.php" method="Post" autocomplete="off">
                    <label>Username</label></br>
                    <input type="text" name="username" value="" /><br/>
                    <label>Password</label></br>
                    <input type="password" name="password" value="" /></br>
                    <br>
                    <input type="submit" value="Đăng nhập" />
                </form>
            </div>
            <?php
        } else {
            $currentUser = $_SESSION['current_admin'];
            ?>
            <div id="login-notify" class="box-content">
                <h1>Chào mừng bạn đến trang quản trị</h1>
                <h3>Họ và tên: <?= $currentUser['fullname'] ?></h3>
                <h3>Mã nhân viên: <?= $currentUser['id'] ?></h3>
                <h3>Chức vụ: <?= $currentUser['username'] ?></h3>
                <h3>Ngày tạo tài khoản: <?= date("d/m/Y g:i a" , $currentUser['created_time']) ?></h3>
                <a href="./edit.php?id=<?= $currentUser['id'] ?>">Đổi mật khẩu</a><br>
                <a href="./logout.php">Đăng xuất</a>
            </div>
        <?php } ?>
    </body>
</html>