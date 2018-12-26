<?php 
include 'header.php';

$urunsor=$db->prepare("SELECT * FROM urun where urun_seourl=:seourl AND urun_id=:urun_id");
$urunsor->execute(array(
	'seourl' => $_GET['sef'],
	'urun_id' => $_GET['urun_id']
	));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
$kategoriid=$uruncek['kategori_id'];
if($urunsor->rowCount()==0)
{
	header("Location:index.php?durum=oynasma");
	exit;
}

$kategorisor=$db->prepare("SELECT * FROM kategori where kategori_id=:id");
$kategorisor->execute(array(
	'id' => $kategoriid
	));

$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);


?>


<div class="container">
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title"><?php echo $uruncek['urun_ad'] ?></div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="dt-img">
						<div class="detpricetag  on-sale"><div class="inner on-sa"><span class="onsale">
							<span class="oldprice"><?php echo $uruncek['urun_fiyat']*1.5 ?>₺</span>
							<?php echo $uruncek['urun_fiyat']*1 ?>₺</span></div></div>

							<a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
						</div>
						<div class="thumb-img">
							<a class="fancybox" href="images\sample-4.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-4.jpg" alt="" class="img-responsive"></a>
						</div>
						<div class="thumb-img">
							<a class="fancybox" href="images\sample-5.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-5.jpg" alt="" class="img-responsive"></a>
						</div>
						<div class="thumb-img">
							<a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
						</div>
					</div>
					<div class="col-md-6 det-desc">
						<div class="productdata">
							<div class="infospan">Ürün Kodu <span><?php echo $uruncek['urun_id'];?></span></div>
							<div class="infospan">Kategori <span  align="right"><?php echo $kategoricek['kategori_ad']; ?></span></div>
							<div class="infospan"> <span></span></div>



							<form class="form-horizontal ava" role="form">
								<div class="form-group">
									<label for="qty" class="col-sm-2 control-label">Adet</label>
									<div class="col-sm-4">
										<select class="form-control" id="qty">
											<option>1
												<option>2
													<option>3 
														<option>4
															<option>5
															</select>
														</div>
														<div class="col-sm-4">
															<button class="btn btn-default btn-red btn-sm"><span class="addchart">Sepete Ekle</span></button>
														</div>
														<div class="clearfix"></div>
													</div>
												</form>

												<div class="sharing">
													<div class="share-bt">
														<div class="addthis_toolbox addthis_default_style ">
															<a class="addthis_counter addthis_pill_style"></a>
														</div>
														<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f0d0827271d1c3b"></script>
														<div class="clearfix"></div>
													</div>

													<div class="avatock"><span>


														<?php 
														if($uruncek['urun_stok']>0) 
														{
															echo "Stok Adedi  ".$uruncek['urun_stok'];
														}
														else
														{
															echo "Stokta Ürün Yok :(";
														}

														?>

													</span></div>
												</div>

											</div>
										</div>
									</div>

									<div class="tab-review">
										<ul id="myTab" class="nav nav-tabs shop-tab">
											<li class="active"><a href="#desc" data-toggle="tab">AÇıklama</a></li>
											<li class=""><a href="#rev" data-toggle="tab">Yorumlar (0)</a></li>
										</ul>
										<div id="myTabContent" class="tab-content shop-tab-ct">
											<div class="tab-pane fade active in" id="desc">
												<p>
													<?php echo $uruncek['urun_detay']?>
												</p>
											</div>
											<div class="tab-pane fade" id="rev">

<!-- yorumlar
						<p class="dash">
							<span>Jhon Doe</span> (11/25/2012)<br><br>
							Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.
						</p>
					-->

					<h4>Yorum Yazın</h4>

					<?php if(isset($_SESSION['userkullanici_mail'])) {?>

					<form role="form">
						<div class="form-group">
							<textarea class="form-control" placeholder="Lütfen Yorumunuzu Yazınız" id="text" ></textarea>
						</div>
						<button type="submit" class="btn btn-default btn-red btn-sm">Yorum Ekle</button>
					</form>
					<?php } else {
						echo "Yorum yapmak için Giriş Yapın!";
					} ?>


				</div>
			</div>
		</div>

		<div id="title-bg">
			<div class="title">Related Product</div>
		</div>
		<div class="row prdct"><!--Products-->

			<?php 
			$kategori_id=$uruncek['kategori_id'];
			$urunaltsor=$db->prepare("SELECT * FROM urun WHERE kategori_id=:kategori_id ORDER BY rand() limit 3");
			$urunaltsor->execute(array(
				'kategori_id'=>$kategori_id
				));

				while($urunaltcek=$urunaltsor->fetch(PDO::FETCH_ASSOC)) {?>
				<div class="col-md-4">
					<div class="productwrap">
						<div class="pr-img">
							<div class="new"></div>
						<a href="urun-<?=seo($urunaltcek["urun_ad"]).'-'.$urunaltcek["urun_id"] ?>"><img src="images\sample-3.jpg" alt="" class="img-responsive"></a>

						<div class="pricetag on-sale">
							<div class="inner on-sale">
								<span class="onsale">
									<span class="oldprice"><?php echo $urunaltcek['urun_fiyat']*1.5 ?>₺</span>
									<?php echo $urunaltcek['urun_fiyat']*1 ?>₺</span>
								</div>
							</div>
						</div>
						<span class="smalltitle"><a href="product.htm"><?php echo $urunaltcek['urun_ad'] ?></a></span>
						<span class="smalldesc">Item no.: <?php echo $urunaltcek['urun_id'] ?></span>
					</div>
				</div>

				<?php } ?>


			</div><!--Products-->
			<div class="spacer"></div>
		</div><!--Main content-->
		<?php include 'sidebar.php'; ?>
	</div>
</div>
<?php include 'footer.php'; ?>