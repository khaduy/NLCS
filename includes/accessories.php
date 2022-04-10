<div class="container">
  <div class="row" >
    <div class="col-md-12">
      <div id="carousel" class="carousel slide" data-ride="carousel" data-type="multi" data-interval="2500" style="margin-top: 20px;">
        <h1 class="btn-grad3">Phụ Kiện</h1>

        <!--carousel itmes-->
        <div class="carousel-inner">
          <div class="item active">
            <div class="row">
                <?php while ($row = mysqli_fetch_array($accessories1)) {?>     
                <div class="showitem">
                    <div class="col-md-3 item-product bor">
                        <a href="detail.php?id=<?php echo $row['mshh']?>">
                            <img src="<?php echo $row['hinh'] ?>" class="" width="157" height="180">
                        </a>
                        <div class="info-item">
                            <a href="detail.php?id=<?php echo $row['mshh']?>"><?php echo $row['tenhh']?></a>
                            <p><b class="price"><?php echo number_format($row['gia'],0,' ','.'); ?>đ</b></p>
                        </div>
                    </div>                    
                </div>
                <?php }?>
            </div><!--.row-->
          </div><!--.item-->

          <div class="item">
            <div class="row">
              <?php while ($row = mysqli_fetch_array($accessories2)) {?>     
                <div class="showitem">
                    <div class="col-md-3 item-product bor">
                        <a href="detail.php?id=<?php echo $row['mshh']?>">
                            <img src="<?php echo $row['hinh'] ?>" class="" width="157" height="180">
                        </a>
                        <div class="info-item">
                            <a href="detail.php?id=<?php echo $row['mshh']?>"><?php echo $row['tenhh']?></a>
                            <p><b class="price"><?php echo number_format($row['gia'],0,' ','.'); ?>đ</b></p>
                        </div>
                    </div>                    
                </div>
                <?php }?>
            </div><!--.row-->
          </div><!--.item-->
          
        </div><!--.carousel-inner-->
        <a data-slide="prev" href="#carousel" class="left carousel-control"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
        <a data-slide="next" data-ride="carousel" href="#carousel" class="right carousel-control"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
      </div>
    </div><!--carousel-->
  </div>
</div>
<script type="text/javascript">
    $('.carousel').carousel({
        interval: 6000
    })  
</script>
