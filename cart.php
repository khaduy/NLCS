<!DOCTYPE html>
<html lang="en">
<head>
	<title>KTD SHOP</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<link rel="stylesheet" type="text/css" href="css/cart.css">
</head>
<?php
	session_start();
	include './conn.php';
	$category = mysqli_query($conn,"SELECT * FROM nhomhanghoa WHERE manhom < 90000 ");
    date_default_timezone_set('Asia/Ho_Chi_Minh');

?>
<body>
	<div class="wrapper">

		<!-- HEADER --> 	
		<?php include ('includes/header.php') ?>
		<!-- END HEADER -->
		
		<!-- MENUNAV -->
		<?php include ('includes/menunav_cart.php') ?>
		<!-- END MENUNAV -->

		<!-- CART -->
<?php
include './conn.php';
if (empty($_SESSION['current_user'])) {
    header('Location: ./dangnhap.php');
} else {   
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();

}
$error = false;
$success = false;                   
if (isset($_GET['action'])) {
    function update_cart($add = false) {
        foreach ($_POST['quantity'] as $id => $quantity) {
            if ($quantity == 0) {
                unset($_SESSION["cart"][$id]);
            } else {
                if ($add) {
                    $_SESSION["cart"][$id] += $quantity;
                } else {
                    $_SESSION["cart"][$id] = $quantity;
                }
            }
        }
    }
    switch ($_GET['action']) {
        case "add":
            update_cart(true);
            header('Location: ./cart.php');
            break;
        case "delete":
            if (isset($_GET['id'])) {
                unset($_SESSION["cart"][$_GET['id']]);
            }
            header('Location: ./cart.php');
            break;
        case "submit":
            if (isset($_POST['update_click'])) { //Cập nhật số lượng sản phẩm
                update_cart();
                header('Location: ./cart.php');
            } elseif ($_POST['order_click']) { //Đặt hàng sản phẩm
                if (empty($_POST['name'])) {
                $error = "Bạn chưa nhập tên của người nhận";
                } elseif (empty($_POST['address'])) {
                $error = "Bạn chưa nhập địa chỉ người nhận";
                } elseif (empty($_POST['quantity'])) {
                $error = "Giỏ hàng rỗng";
                }
                if ($error == false && !empty($_POST['quantity'])) { //Xử lý lưu giỏ hàng vào db
                    $products = mysqli_query($conn, "SELECT * FROM `hanghoa` WHERE `mshh` IN (" . implode(",", array_keys($_POST['quantity'])) . ")");
                    $total = 0;
                    $orderProducts = array();
                    while ($row = mysqli_fetch_array($products)) {
                        $orderProducts[] = $row;
                        $total += $row['gia'] * $_POST['quantity'][$row['mshh']];
                    }

                    $insertOrder = mysqli_query($conn, "INSERT INTO `dathang` (`dh_id`
                                , `SoDienThoai`
                                , `HoTen`
                                , `nv_id`
                                , `DiaChi`
                                , `chuthich`
                                , `tonggia`
                                , `NgayDH`
                                , `TrangThai`) VALUES (NULL
                                , '" . $currentUser['SoDienThoai'] . "' 
                                , '" . $_POST['name'] . "'
                                , NULL
                                , '" . $_POST['address'] . "'
                                , '" . $_POST['note'] . "'
                                , '" . $total . "'
                                , '" . time() . "'
                                , '0');");
                    $orderID = $conn->insert_id;
                    // INSERT INTO `chitietdathang` (`id`, `dh_id`, `mshh`, `soluong`, `gia`) VALUES (NULL, '4', '10001', '2', '12345');
                    // var_dump($conn->insert_id);  

                    $insertString = "";
                    foreach ($orderProducts as $key => $product) {
                        $insertString .= "(NULL
                                    , '" . $orderID . "'
                                    , '" . $product['mshh'] . "'
                                    , '" . $_POST['quantity'][$product['mshh']] . "'
                                    , '" . $product['gia'] . "')";
                        $update = mysqli_query($conn,"UPDATE `hanghoa` SET `soluonghang` = '".$product['soluonghang']."' - '".$_POST['quantity'][$product['mshh']]."' WHERE `hanghoa`.`mshh` = '".$product['mshh']."';");            
                        if ($key != count($orderProducts) - 1) {
                            $insertString .= ",";
                        }
                    }
                    $insertOrder = mysqli_query($conn, "INSERT INTO `chitietdathang` (`id`, `dh_id`, `mshh`, `soluong`, `gia`) VALUES " . $insertString . ";");
                    $success = "Đặt hàng thành công"; 
                    unset($_SESSION['cart']);
                }
            }
            break;
    }
}
if (!empty($_SESSION["cart"])) {
    $products = mysqli_query($conn, "SELECT * FROM `hanghoa` WHERE `mshh` IN (".implode(",", array_keys($_SESSION["cart"])).")");
}

?>
<div class="container-cart" >
    <?php if (!empty($error)) { ?> 
        <div id="notify-msg" style="font-size: 30px; text-align: center; border: 1px black solid; margin-bottom: 300px;">
            <?= $error ?>. <a href="javascript:history.back()">Quay lại</a>
        </div>
    <?php } elseif (!empty($success)) { ?>
        <div id="notify-msg" style="font-size: 30px; text-align: center; border: 1px black solid; margin-bottom: 300px;">
            <?= $success ?>. <a href="index.php">Tiếp tục mua hàng</a>
        </div>
    <?php } else { ?>
        <!-- <h1 class="cart-title"><i class="fa fa-shopping-cart"></i> Giỏ hàng của bạn:</h1> -->
        <form id="cart-form" action="cart.php?action=submit" method="POST">
            <table class="cart-table">
                <tr class="row1">
                    <th class="product-number">STT</th>
                    <th class="product-name">Tên sản phẩm</th>
                    <th class="product-img">Ảnh sản phẩm</th>
                    <th class="product-price" style="color: #333333;">Đơn giá</th>
                    <th class="product-quantity">Số lượng</th>
                    <th class="total-money">Thành tiền</th>
                    <th class="product-delete">Xóa</th>
                </tr>
                <?php 
                if (!empty($products)) {
                    $total = 0;
                    $num = 1;
                    while ($row = mysqli_fetch_array($products)) { ?>
                    <tr>
                        <td class="product-number"><?=$num;?></td>
                        <td class="product-name name-product"><?=$row['tenhh']?></td>
                        <td class="product-img"><img src="<?=$row['hinh']?>" /></td>
                        <td class="product-price"><?=number_format($row['gia'],0,",",".")?>đ</td>
                        <td class="product-quantity"><input type="number" value="<?=$_SESSION["cart"][$row['mshh']]?>" name="quantity[<?=$row['mshh']?>]" min="1" max="<?php echo $row['soluonghang'] ?>"/></td>
                        <td class="total-money"><?= number_format($row['gia'] * $_SESSION["cart"][$row['mshh']], 0, ",", ".") ?>đ</td>
                        <td class="product-delete"><a href="cart.php?action=delete&id=<?= $row['mshh'] ?>"><i class="fa fa-remove"></i></a></td>
                    </tr>
                    <?php 
                    $total += $row['gia'] * $_SESSION["cart"][$row['mshh']];
                    $num++;
                    } ?>
                    <tr id="row-total">
                        <td class="product-number">&nbsp;</td>
                        <td class="product-name">Tổng tiền</td>
                        <td class="product-img">&nbsp;</td>
                        <td class="product-price">&nbsp;</td>
                        <td class="product-quantity">&nbsp;</td>
                        <td class="total-money" style="font-weight: bold; font-size: 17px; color: #bf081f;"><?= number_format($total, 0, ",", ".") ?>đ</td>
                        <td class="product-delete"></td>
                    </tr>
                <?php } ?>
            </table>

            <div id="form-button">
                <button type="submit" class="btn-grad1" name="update_click" value="Cập nhật"><i class="fa fa-pencil-square-o"></i> Cập nhật </button> 
            </div>
            <hr>
            <div class="ttkh">
                <div class="row">
                    <div style="text-align: center; font-size: 20px; font-weight: bold;">Thông tin khách hàng</div>
                    <div class="col-md-7"><label>Điện thoại: </label><?= $currentUser['SoDienThoai'] ?><input type="hidden" name="phone" value="<?= $currentUser['SoDienThoai'] ?>" /></div>
                    <div class="col-md-5"><label>Người nhận: </label><input type="text" name="name" value="<?= $currentUser['HoTenKH'] ?>" /></div>
                    <div class="col-md-7"><label class="col-md-1" style="padding-left: 0;" >Ghi chú:</label><textarea name="note" cols="35" rows="5" ></textarea></div>
                    <div class="col-md-5" ><label>Địa chỉ: </label><input type="text" name="address" value = "<?= $currentUser['DiaChi'] ?>" /></div>
                </div>
            </div>
            <input type="submit" name="order_click" class="btn-grad" value="Đặt hàng" />
        </form>
    <?php } ?>
    <?php } ?>
</div>		
		
		<!-- END CART -->

		<!-- FOOTER -->
        <?php include ('includes/footer.php') ?>
		<!-- END FOOTER -->

	</div>
</body>
</html>