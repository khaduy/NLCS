<div id="menunav">
	<div class="container">
		<nav>
			<div class="home pull-left">
				<a href="index.php">Trang chủ</a>
			</div>
			<!-- menu-main -->
			<ul class="menu-main">
				<li>
					<div class="dropdown">
						<!-- <button class="dropbtn" disabled="">Hãng điện thoại</button>
						<div class="dropdown-content">
							<?php while ($row = mysqli_fetch_array($category)) {?>
							<a href="category.php?id=<?php echo $row['manhom']?>"><?php echo $row['tennhom']?></a>
							<?php }?>
						</div> -->
					</div>
				</li>
				<li>
					<a href="./order_listing.php">Quản lý đơn hàng</a>
				</li>
				<li>
					<a href="./kh_listing.php">Quản lý khách hàng</a>
				</li>
				<li>
					<a href="./user_listing.php">Quản lý nhân viên</a>
				</li>
				<li>
					<a href="./gr_listing.php">Quản lý nhóm sản phẩm</a>
				</li>
				<li>
					<a href="./product_listing.php">Quản lý sản phẩm</a>
				</li>
			</ul>
			<!-- end menu-main -->
		
			<!-- dndk -->
			<ul class="pull-right" id="dndk">
				<div id="dndk1">
				<!-- <?php if (empty($_SESSION['current_user'])) { ?>
					<li>
						<a href="dangnhap.php">Đăng nhập</a>
						<a href="dangky.php">Đăng ký</a>
					</li>
					<?php
					} else { 
					$currentUser = $_SESSION['current_user']; ?>
					<li>
						<a href="#">Xin chào: Admin ?></a>
						<!-- <a href="#">Xin chào: <?= $currentUser['HoTenKH'] ?></a> -->
						<!-- <a href="dangxuat.php">Đăng xuất</a> -->
					</li>
				<?php } ?> -->
				</div>
			</ul>
			<!-- end dndk -->
		</nav>
	</div>			
</div>