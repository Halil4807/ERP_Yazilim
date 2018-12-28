<?php include'header.php'; 


$urunsor=$db->prepare("SELECT * FROM urun WHERE urun_durum=:durum AND urun_onecikar=:onecikar");
$urunsor->execute(array(
	'durum' => 1,
	'onecikar' => 1
	));


	?>

</head>
<?php if($_GET['durum']=="odeme"){ ?>
<script type="text/javascript">
	alert("Ödeme İşleminiz Başarıyla Tamamlandı.");
</script>
<?php } ?>
<div class="f-widget featpro">
	<div class="container">
		<div class="title-widget-bg">
			<div class="title-widget">Öne Çıkan Ürünler</div>
			<div class="carousel-nav">
				<a class="prev"></a>
				<a class="next"></a>
			</div>
		</div>

		<div id="product-carousel" class="owl-carousel owl-theme">
			<?php 
			while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {

				?>
				<div class="item">
					<div class="productwrap">
						<div class="pr-img">
							<div class="hot"></div>
							<a href="urun-<?=seo($uruncek["urun_ad"]).'-'.$uruncek["urun_id"] ?>"><img src="images\sample-3.jpg" alt="" class="img-responsive"></a>

							<div class="pricetag on-sale">
								<div class="inner on-sale">
									<span class="onsale">
										<span class="oldprice"><?php echo $uruncek['urun_fiyat']*1.5 ?>₺</span>
										<?php echo $uruncek['urun_fiyat']*1 ?>₺</span>
									</div>
								</div>
							</div>
							<span class="smalltitle"><a href="product.htm"><?php echo $uruncek['urun_ad'] ?></a></span>
							<span class="smalldesc">Item no.: <?php echo $uruncek['urun_id'] ?></span>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>



		<div class="container">
			<div class="row">
				<div class="col-md-9"><!--Main content-->
					

					<div class="title-bg"> 
						<div class="title">Son Eklenen 6 Ürün</div>
					</div>
					<div class="row prdct"><!--Products-->
						<?php 
						$urunsor=$db->prepare("SELECT * FROM urun ORDER BY urun_id DESC limit 6");
						$urunsor->execute();
						while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {?><br>
						<div class="col-md-4">
							<div class="productwrap">
								<div class="pr-img">
									<div class="new"></div>
									<a href="urun-<?=seo($uruncek["urun_ad"]).'-'.$uruncek["urun_id"] ?>"><img src="images\sample-3.jpg" alt="" class="img-responsive"></a>

									<div class="pricetag on-sale">
										<div class="inner on-sale">
											<span class="onsale">
												<span class="oldprice"><?php echo $uruncek['urun_fiyat']*1.5 ?>₺</span>
												<?php echo $uruncek['urun_fiyat']*1 ?>₺</span>
											</div>
										</div>
									</div>
									<span class="smalltitle"><a href="product.htm"><?php echo $uruncek['urun_ad'] ?></a></span>
									<span class="smalldesc">Item no.: <?php echo $uruncek['urun_id'] ?></span>
								</div>
							</div>

							<?php } ?>
						</div><!--Products-->
						<div class="title-bg">
							<div class="title">Hakkımızda</div>
						</div>
						<p class="ct">
							<?php 
							$hakkimizdasor=$db->prepare("SELECT * FROM hakkimizda WHERE hakkimizda_id=:id");
							$hakkimizdasor->execute(array(
								'id' => 0
								));

							$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC); 
							echo $hakkimizdacek['hakkimizda_icerik'];
							?>
						</p>
						<a href="hakkimizda" class="btn btn-default btn-red btn-sm">Devamını Oku</a>
						
						<div class="spacer"></div>
					</div><!--Main content-->
					<?php include'sidebar.php'; ?>
				</div>
			</div>

			<?php include'footer.php'; ?>