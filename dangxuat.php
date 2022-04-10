<!DOCTYPE html>

<html>
    <head>
        <title>Đăng xuất tài khoản</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        session_start();
        unset($_SESSION['current_user']);
        header('Location:' .'index.php');
        ?>
    </body>
</html>
