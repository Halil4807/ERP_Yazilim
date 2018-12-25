<?php 

include 'header.php'; 



$urunsor=$db->prepare("SELECT * FROM urun order by urun_id DESC");
$urunsor->execute();


?>


<div class="container">
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title">Ürünler</div>
				<div class="title-nav">
					<a href="category.htm"><i class="fa fa-th-large"></i>grid</a>
					<a href="category-list.htm"><i class="fa fa-bars"></i>List</a>
				</div>
			</div>
			<div class="row prdct"><!--Products-->
			<?php while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {?>
				<div class="col-md-4">
					<div class="productwrap">
						<div class="pr-img">
							<div class="new"></div>
							<a href="product.htm"><img src="images\sample-3.jpg" alt="" class="img-responsive"></a>
							<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"><?php echo $uruncek['urun_fiyat']*1.5 ?>₺</span><?php echo $uruncek['urun_fiyat']*1 ?>₺</span></div></div>
						</div>
						<span class="smalltitle"><a href="product.htm"><?php echo $uruncek['urun_ad'] ?></a></span>
						<span class="smalldesc">Item no.: <?php echo $uruncek['urun_id'] ?></span>
					</div>
				</div>
				<?php } ?>
			</div>
					<!--Products
				<ul class="pagination shop-pag">
					<li><a href="#"><i class="fa fa-caret-left"></i></a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
				</ul>		pagination-->

			</div>
			<?php include 'sidebar.php'; ?>
		</div>
		<div class="spacer"></div>
	</div>
	<?php include'footer.php'; ?>