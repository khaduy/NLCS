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
						<button class="dropbtn" disabled="">Hãng điện thoại</button>
						<div class="dropdown-content">
							<?php while ($row = mysqli_fetch_array($category)) {?>
							<a href="category.php?id=<?php echo $row['manhom']?>"><?php echo $row['tennhom']?></a>
							<?php }?>
						</div>
					</div>
				</li>
				<li>
					<a href="category.php?id=90000">Phụ kiện</a>
				</li>
				<li>
					<a href="chinhsachdoitra.php">Chính sách đổi trả</a>
				</li>
				<li>
					<a href="chinhsachgiaohang.php">Chính sách giao hàng</a>
				</li>
				<li>
					<a href="cart.php">Quản lý giỏ hàng</a>
				</li>
			</ul>
			<!-- end menu-main -->
		
			<!-- dndk -->
			<ul class="pull-right" id="dndk">
				<div id="dndk1">
					<?php if (empty($_SESSION['current_user'])) { ?>
					<li>
						<a href="dangnhap.php">Đăng nhập</a>
						<a href="dangky.php">Đăng ký</a>
					</li>
					<?php
					} else { 
					$currentUser = $_SESSION['current_user']; ?>
					<li>
						<a href="#">Xin chào: <?= $currentUser['HoTenKH'] ?></a>
						<a href="dangxuat.php">Đăng xuất</a>
					</li>
				<?php } ?>
				</div>
			</ul>
			<!-- end dndk -->
		</nav>
	</div>			
</div>