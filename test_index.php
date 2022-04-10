<!DOCTYPE html>
<html lang="en">
<head>
    <title>KTD SHOP</title>
    <meta charset="utf-8"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>

      .carousel 
      {
        margin-bottom: 0; 
        padding: 0 40px 30px 40px;
      }
      /*the controlsy*/
      .carousel-control 
      {
        left: -12px; 
        height: 40px; 
        width: 40px; 
        background: none repeat scroll 0 0 #222222; 
        border: 4px solid black; 
        border-radius: 23px 23px 23px 23px; 
        margin-top: 90px;
      }
      .carousel-control.right
      {
        right: -12px;
      }
      /*the indicators*/
      .carousel-indicators 
      {
        right: 50%; 
        top: auto; 
        bottom: -10px; 
        margin-right: -19px;
      }
      /*the color of indicators*/
      .carousel-indicators li
      {
        background: #ececec;
      }
      .carousel-indicators .active
      {
        background: #420bca;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" type="text/css" href="css/css.css">
</head>
<?php
    session_start();
    include './conn.php';
    $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:8;
    $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
    $offset = ($current_page - 1) * $item_per_page;
    $products = mysqli_query($conn, "SELECT * FROM hanghoa ORDER BY gia DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    $totalRecords = mysqli_query($conn, "SELECT * FROM `hanghoa`");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);

    $category = mysqli_query($conn,"SELECT * FROM nhomhanghoa WHERE manhom < 90000 ");
?>
<body>
    

    <div class="wrapper">

        <!-- HEADER -->     
        <?php include ('includes/header.php') ?>
        <!-- END HEADER -->
        
        <!-- MENUNAV -->
        <?php include ('includes/menunav.php') ?>
        <!-- END MENUNAV -->

        <!-- PHUKIEN -->
        <div class="container">
          <div class="row" style="margin-top: 100px;">
            <div class="col-md-12">
              <div id="carousel" class="carousel slide" data-ride="carousel" data-type="multi" data-interval="2500">
                <ol class="carousel-indicators">
                  <li data-target="carousel" data-slide-to="0" class="active"></li>
                  <li data-target="carousel" data-slide-to="1"></li>
                  <li data-target="carousel" data-slide-to="2"></li>
                </ol>
       
                <!--carousel itmes-->
                <div class="carousel-inner">
                  <div class="item active">
                    <div class="row">
                             
                        <div class="showitem">
                            <div class="col-md-3 item-product bor">
                                <a href="detail.php?id=20001">
                                    <img src="images/samsung1.png" class="" width="157" height="180">
                                </a>
                                <div class="info-item">
                                    <a href="detail.php?id=20001">Samsung Galaxy S20 Ultra</a>
                                    <p><b class="price">29.990.000đ</b></p>
                                </div>
                            </div>                    
                        </div>
                   
                      <div class="col-md-3"><a href="#" class="thumbnail"><img src="http://placehold.it/250x250" alt="asia" style="max-width:100%;"></a></div>
                      <div class="col-md-3"><a href="#" class="thumbnail"><img src="http://placehold.it/250x250" alt="asia" style="max-width:100%;"></a></div>
                      <div class="col-md-3"><a href="#" class="thumbnail"><img src="http://placehold.it/250x250" alt="asia" style="max-width:100%;"></a></div>
                    </div><!--.row-->
                  </div><!--.item-->
        
                  <div class="item">
                    <div class="row">
                      <div class="col-md-3"><a href="#" class="thumbnail"><img src="http://placehold.it/250x250" alt="asia" style="max-width:100%;"></a></div>
                      <div class="col-md-3"><a href="#" class="thumbnail"><img src="http://placehold.it/250x250" alt="asia" style="max-width:100%;"></a></div>
                      <div class="col-md-3"><a href="#" class="thumbnail"><img src="http://placehold.it/250x250" alt="asia" style="max-width:100%;"></a></div>
                      <div class="col-md-3"><a href="#" class="thumbnail"><img src="http://placehold.it/250x250" alt="asia" style="max-width:100%;"></a></div>
                    </div><!--.row-->
                  </div><!--.item-->
                  
                  <div class="item">
                    <div class="row">
                      <div class="col-md-3"><a href="#" class="thumbnail"><img src="http://placehold.it/250x250" alt="asia" style="max-width:100%;"></a></div>
                      <div class="col-md-3"><a href="#" class="thumbnail"><img src="http://placehold.it/250x250" alt="asia" style="max-width:100%;"></a></div>
                      <div class="col-md-3"><a href="#" class="thumbnail"><img src="http://placehold.it/250x250" alt="asia" style="max-width:100%;"></a></div>
                      <div class="col-md-3"><a href="#" class="thumbnail"><img src="http://placehold.it/250x250" alt="asia" style="max-width:100%;"></a></div>
                    </div><!--.row-->
                  </div><!--.item-->
                </div><!--.carousel-inner-->
                <a data-slide="prev" href="#carousel" class="left carousel-control"></a>
                <a data-slide="next" href="#carousel" class="right carousel-control"></a>
              </div>
            </div><!--carousel-->
          </div>
        </div>
        <!-- END PHUKIEN -->
    </div>
</body>
</html>