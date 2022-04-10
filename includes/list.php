<div id="maincontent">
    <div class="container">
        <div class="col-md-3  fixside" >
            <div class="box-left box-menu">
                <h3 class="box-title"><i class="fa fa-shopping-basket"></i>  Sản phẩm nổi bật </h3>
                <ul>                                
                    <li class="clearfix">
                        <a href="detail.php?id=10001">
                            <img src="images/iphone1.png" class="img-responsive pull-left" width="80" height="80">
                            <div class="info pull-right">
                                <p class="name">iPhone 11 Pro 64GB</p>
                                <b class="price">30.990.000đ</b><br><br>                               
                            </div>
                        </a>
                    </li>

                     <li class="clearfix">
                        <a href="detail.php?id=30001">
                            <img src="images/oppo1.png" class="img-responsive pull-left" width="80" height="80">
                            <div class="info pull-right">
                                <p class="name">OPPO Find X2</p >
                                <b class="price">21.990.000đ</b><br><br>                                     
                            </div>
                        </a>
                    </li>

                     <li class="clearfix">
                        <a href="detail.php?id=20001">
                            <img src="images/samsung1.png" class="img-responsive pull-left" width="80" height="80">
                            <div class="info pull-right">
                                <p class="name">Samsung Galaxy S20 Ultra</p >
                                <b class="price">29.990.000đ</b><br><br>                                           
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9 bor">
            <?php while ($row = mysqli_fetch_array($products)) {?>
            <section class="box-main1">            
                <div class="showitem">
                    <div class="col-md-3 item-product bor" style="height: 260px;">
                        <a href="detail.php?id=<?php echo $row['mshh']?>">
                            <img src="<?php echo $row['hinh'] ?>" class="" width="157" height="180">
                        </a>
                        <div class="info-item">
                            <a href="detail.php?id=<?php echo $row['mshh']?>"><?php echo $row['tenhh']?></a>
                            <p><b class="price"><?php echo number_format($row['gia'],0,' ','.'); ?>đ</b></p>
                        </div>
                    </div>                    
                </div>
            </section>
            <?php }?>
        </div>

        <nav aria-label="Page navigation example" class="per_page">
        <ul class="pagination justify-content-center">
        <?php if ($current_page > 1) {
            $prev_page = $current_page - 1;
        ?>
            <li class="page-item">
        <a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>">Previous</a>
            </li>
        <?php } else{ ?>
            <li class="page-item disabled">
                <a class="page-link" href="#">Previous</a>
            </li>
        <?php } ?>

        <?php for ($num = 1; $num <= $totalPages; $num++) { ?>    
            <li class="page-item"><a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a></li>
        <?php } ?>

        <?php if ($current_page < $totalPages) {
            $next_page = $current_page + 1;
        ?>
            <li class="page-item">
        <a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>">Next</a>
            </li>
        <?php } else{?>
            <li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
            </li>
        <?php } ?>
        </ul>
        </nav>







    </div>            
</div> 