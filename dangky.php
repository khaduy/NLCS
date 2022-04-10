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
<script type="text/javascript">
    function Dangky()
    {
        var hoten = document.getElementById("hoten").value;
        var sdt = document.getElementById("sdt").value;
        var mk = document.getElementById("pass").value;
        var rmk = document.getElementById("repass").value;
        var diachi = document.getElementById("diachi").value;
        var email = document.getElementById("email").value;
        /*Dieu Kien Toan Bo*/
        if(hoten =="" || sdt =="" || mk =="" || rmk =="" || diachi =="" || email =="")
        {
            alert ("Vui lòng điền đầy đủ thông tin!");
            return false;
        }
        /*Dieu Kien Tung Phan*/
        if((hoten.charAt(0) >= '0') && (hoten.charAt('0') <= '9'))
        {
            alter ("Họ tên không hợp lệ!");
            return false;
        }
        if(sdt.length != 10)
        {
            alert("Số điện thoại gồm 12 số!")
            return false;
        }
        if ((mk.length < 7) && (mk.length > 17))
        {
            alert("Mật khẩu không hợp lệ!");
            return false;
        }
        if (mk != rmk)
        {
            alter ("Mật khẩu không khớp!");
            return false;
        }
        var acong = email.indexOf("@");
        var cham = email.lastIndexOf(".");
        if((acong < 1) || (email.indexOf(" ") != -1) || (cham < acong+6) || (email.length < 11))
        {
            alert("Email không hợp lệ!");
            return false;
        }
        else{
            // alert("Đăng ký thành công");
            return true;
        }
    }
</script>
<?php     
    //Nhúng file kết nối với database
    include('conn.php');
          
    //Khai báo utf-8 để hiển thị được tiếng việt
    header('Content-Type: text/html; charset=UTF-8');
    if(isset($_POST['submit'])) {     
        //Lấy dữ liệu từ file dangky.php
        $sdt        = $_POST['sdt'];
        $username   = $_POST['hoten'];
        $password   = $_POST['pass'];
        $diachi     = $_POST['diachi'];
        $email      = $_POST['email'];
              
            // Mã hóa mật khẩu
            $password = md5($password);
              
        //Kiểm tra số điện thoại này đã có người dùng chưa
        $result = $conn->query("SELECT SoDienThoai FROM khachhang WHERE SoDienThoai ='$sdt' ");
        if (mysqli_num_rows($result) > 0){
            // echo "Số điện thoại này đã có người dùng. Vui lòng dùng số điện thoại khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
            echo "Số điện thoại này đã có người dùng. Vui lòng dùng số điện thoại khác";
            exit;
        }
             
        //Kiểm tra email đã có người dùng chưa

        if (mysqli_num_rows($conn->query("SELECT Email FROM khachhang WHERE Email='$email'")) > 0)
        {
            // echo "Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
            echo "<script>alert('Email này đã có người dùng. Vui lòng dùng email khác.')</script>";
            // exit;
        }
        else{
            $sql = "INSERT INTO khachhang (
                SoDienThoai,
                HoTenKH,
                MatKhau,
                DiaChi,
                Email
            )
            VALUE (
                '{$sdt}',
                '{$username}',
                '{$password}',
                '{$diachi}',
                '{$email}'
            )";
            mysqli_query($conn, $sql);
            echo "<script>alert('Đăng ký thành công')</script>";
            echo "<script>window.open('dangnhap.php','_self')</script>";
            // header('Location: '.'dangnhap.php');
        }
    }
?>
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

    <div class="dndk">
        <h1>Đăng ký thành viên</h1>
        <div class="thongtin">
            <form method="POST" onsubmit="return Dangky()">
                <table class="tabledndk">
                    <tr>
                        <td> Họ tên của bạn</td>
                        <td><input type="text" name="hoten" id="hoten"></td>
                    </tr>
                    <tr>
                        <td> Số điện thoại</td>
                        <td><input type="text" name="sdt" id="sdt"></td>
                    </tr>
                    <tr>
                        <td> Nhập mật khẩu</td>
                        <td><input type="password" name="pass" id="pass"></td>         
                    </tr>
                    <tr>
                        <td> Nhập lại mật khẩu</td>
                        <td><input type="password" name="repass" id="repass"></td>
                    </tr>
                    <tr>
                        <td> Địa chỉ</td>
                        <td><input type="text" name="diachi" id="diachi"></td>
                    </tr>
                    <tr>
                        <td> Email</td>
                        <td><input type="text" name="email" id="email"></td>
                    </tr>
                    <tr class="submit">
                        <td colspan="2" align="center">
                            <input type="submit" name="submit" value="Đăng ký">
                            <input type="reset" value="Làm lại">
                        </td>
                    </tr>       
                </table>
            </form>
            <p><a href="dangnhap.php">Đã có tài khoản? Hãy đăng nhập tại đây!!!</a></p>   
        </div>
    </div>
    
    <!-- FOOTER -->
    <?php include ('includes/footer.php') ?>
    <!-- END FOOTER -->   
</div>
</body>
</html>

