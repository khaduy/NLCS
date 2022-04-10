<?php     
    //Nhúng file kết nối với database
    include('conn.php');
          
    //Khai báo utf-8 để hiển thị được tiếng việt
    header('Content-Type: text/html; charset=UTF-8');
    if(isset($_POST['submit'])) {     
	    //Lấy dữ liệu từ file dangky.php
	    $sdt 		= $_POST['sdt'];
	    $username   = $_POST['hoten'];
	    $password   = $_POST['pass'];
	    $diachi 	= $_POST['diachi'];
	    $email      = $_POST['email'];
	          
	        // Mã hóa mật khẩu
	        $password = md5($password);
	          
	    //Kiểm tra số điện thoại này đã có người dùng chưa
		$result = $conn->query("SELECT SoDienThoai FROM khachhang WHERE SoDienThoai ='$sdt' ");
	    if (mysqli_num_rows($result) > 0){
	        echo "Số điện thoại này đã có người dùng. Vui lòng dùng số điện thoại khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
	        exit;
	    }
	         
	    //Kiểm tra email đã có người dùng chưa

	    if (mysqli_num_rows($conn->query("SELECT Email FROM khachhang WHERE Email='$email'")) > 0)
	    {
	        echo "Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
	        exit;
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
	        header('Location: '.'dangnhap.php');
	    }
	}
?>