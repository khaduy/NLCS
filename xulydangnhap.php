<div class="height">
    <div class="dndk">
        <h1>Trang đăng nhập</h1>
        <div class="thongtin">
            <form method="POST">
                <table class="tabledndk">
                    <tr>
                        <td>Nhập số điện thoại</td>
                        <td><input type="text" name="sdt" id="sdt"/></td>
                    </tr>
                    <tr>
                        <td>Nhập mật khẩu</td>
                        <td><input type="password" name="pass" id="pass"/></td>
                    </tr>
                    <tr class="submit">
                        <td colspan="2" align="center">
                            <input type="submit" name="submit" value="Đăng nhập">
                            <input type="reset" value="Làm lại">
                        </td>
                    </tr>   
                </table>
            </form>
            <p><a href="dangky.php">Chưa có tài khoản? Hãy đăng ký tại đây!!!</a></p>
        </div>
    </div>
</div>
<?php
    // session_start();
    include ('conn.php');
    // Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
    if (isset($_POST["submit"])) {
        // lấy thông tin người dùng
        $sdt = $_POST["sdt"];
        $password = $_POST["pass"];
        $password = md5($password);

        if ($sdt == "" || $password =="") 
        {
            echo "<script>alert('Vui lòng nhập đầy đủ thông tin')</script>";
            // echo "TÊN ĐĂNG NHẬP HOẶC MẬT KHẨU KHÔNG ĐƯỢC ĐỂ TRỐNG!!!";
        }
        else
        {
            $sql = "SELECT * FROM khachhang where SoDienThoai = '$sdt' and MatKhau = '$password' ";
            $result = mysqli_query($conn,$sql);
            $user = mysqli_fetch_assoc($result);
            $_SESSION['current_user'] = $user;
            $num_rows = mysqli_num_rows($result);
            if ($num_rows==0) 
            {
                // echo "TÊN ĐĂNG NHẬP HOẶC MẬT KHẨU KHÔNG ĐÚNG!!!";
                echo "<script>alert('Password or email is incorrect, please try again!')</script>";
                exit();
                // header('Location: '.'dangnhap.php');
            }
            else
            {
                header('Location:'.'index.php');
                // echo "ĐĂNG NHẬP THÀNH CÔNG!!! <a href='index.php'>Về trang chủ</a>";
            }
        }
    }
?>