<div id="maincontent">
    <div class="container">
        <div class="col-md-9 bor">
            <?php while ($row = mysqli_fetch_array($products)) {?>
            <section class="box_main1">
                <div class="col-md-6 text_center">
                    <a href="<?php echo $row['hinh'] ?>">
                        <img src="<?php echo $row['hinh'] ?>"  class="img-responsive bor" id="imgmain" width="100%" height="300px" data-zoom-image="images/16-270x270.png">
                    </a>
                </div>
                <div class="col-md-6 bor">
                    <ul id="right">
                        <li><h1><?php echo $row['tenhh']?></h1></li>
                        <li><b class="price"><?php echo number_format($row['gia'],0,' ','.'); ?>đ</b></li>
                        <form action="cart.php?action=add" method="POST">
                            <input type="number" value="1" name="quantity[<?php echo $row['mshh'] ?>]" style="width:50px; margin-top: 5px;" min="1" max="<?php echo $row['soluonghang'] ?>"><br>
                            <button type="submit" class="btn-grad" style="margin-top: 15px;"> <i class="fa fa-shopping-basket"></i> MUA NGAY</button>
                        </form>
                            
                        <div id="home" class="tab-pane fade in active">
                            <div class="rightInfo phone">
                                <ul class="policy ">
                                    <li class="inpr">
                                        <span>Giao hàng miễn phí, nhanh chóng từ 2 đến 10 ngày.<a href="./chinhsachgiaohang.php"> Xem chính sách</a></span>
                                        <!-- <span>Bộ sản phẩm gồm: <span style="color: #4c8e00;">Hộp, Sạc, Tai nghe, Sách hướng dẫn, Cáp, Cây lấy sim <i class="icondetail-camera standkit" href="#"></i></span></span> -->
                                    </li>
                                    <li class="wrpr">
                                        <span>
                                            Bảo hành chính hãng <span style="color: #4c8e00;">12 tháng</span>.
                                        </span>
                                    </li>
                                    <li class="chpr">
                                        Lỗi là đổi mới trong 1 tháng.
                                        <a href="./chinhsachdoitra.php">Xem chính sách</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                    
                </div>

            </section>
            <!-- <h3>THÔNG TIN SẢN PHẨM</h3> -->
                    <!-- <p><?php echo $row['motahh']?>Hiện tại chưa có thông tin cho sản phẩm này</p> -->
            <!-- <?php }?> -->
        </div>
    </div>
</div>
