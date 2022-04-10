
<div id="header">
	<div class="container">
		<div class="row">
			<div class=" col-md-5">
				<form class="form-inline" action="category.php?action=add">
					<div class="form-group">
						<input type="text" name="keywork" placeholder="Bạn tìm gì..." class="form-control" value="<?=isset($_GET['keywork']) ? $_GET['keywork'] : ""?>">
						<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
					</div>						
				</form>
			</div>
			<div class="col-md-4">
				<a href="./index.php">
                    <img src="./images/logo_3.png">
                </a>
			</div>
			<div class="col-md-3">
				<div class="pull-left">
					<i class="fa fa-phone"></i>
				</div>
				<div class="pull-right">
					<p class="phone">ĐẶT ỐP LƯNG</p>
					<a href="tel:0386580528">038.658.0528</a>
				</div>						
			</div>
		</div>
	</div>
</div>