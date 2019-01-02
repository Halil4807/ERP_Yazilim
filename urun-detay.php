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

<?php if($_GET['durum']=="ok"){ ?>
<script type="text/javascript">
	alert("Yorum Başarıyla Eklendi.");
</script>
<?php } else if ($_GET['durum']=="fazlaadet")
{?>
<script type="text/javascript">
	alert("Stok Miktarından fazla adet girdiniz!");
</script>
<?php } ?>


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

							<a class="" href="#" data-fancybox-group="gallery" title="<?php echo $uruncek['urun_ad'] ?>"><img src="<?php echo $uruncek['urun_foto'] ?>" alt="" class="img-responsive"></a>
						</div>
					</div>
					<div class="col-md-6 det-desc">
						<div class="productdata">
							<div class="infospan">Ürün Kodu <span><?php echo $uruncek['urun_id'];?></span></div>
							<div class="infospan">Kategori <span  align="right"><?php echo $kategoricek['kategori_ad']; ?></span></div>
							<div class="infospan"> <span></span></div>



							<form action="nedmin/netting/islem.php" method="POST">
								<div class="form-group">
									<label for="urun_adet" class="col-sm-2 control-label">Adet</label>
									<div class="col-sm-4">
										<input type="number" name="urun_adet" value="1" min="1" max="20">
									</div>
									<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">
									<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'];?>">
									<div class="col-sm-4">
										<button type="submit" name="sepeteekle" class="btn btn-default btn-red btn-sm"><span class="addchart">Sepete Ekle</span></button>
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
						<li class="active"><a href="#desc" data-toggle="tab">Açıklama</a></li>
						<?php 
						$yorumlarsaysor=$db->prepare("SELECT * FROM yorumlar WHERE urun_id=:id");
						$yorumlarsaysor->execute(array(
							'id' => $uruncek['urun_id']
							));
						$yorumlarsaycek=$yorumlarsaysor->fetch(PDO::FETCH_ASSOC);
						$yorumsay=$yorumlarsaysor->rowCount();
						?>
						<li class=""><a href="#rev" data-toggle="tab">Yorumlar (<?php echo $yorumsay ?>)</a></li>
					</ul>
					<div id="myTabContent" class="tab-content shop-tab-ct">
						<div class="tab-pane fade active in" id="desc">
							<p>
								<?php echo $uruncek['urun_detay']?>
							</p>
						</div>
						<div class="tab-pane fade" id="rev">

							<?php 
							$yorumlarsor=$db->prepare("SELECT * FROM yorumlar WHERE urun_id=:id ORDER BY yorum_zaman DESC");
							$yorumlarsor->execute(array(
								'id' => $uruncek['urun_id']
								));
							while($yorumlarcek=$yorumlarsor->fetch(PDO::FETCH_ASSOC)) {

								$kulaniciyorumsor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
								$kulaniciyorumsor->execute(array(
									'id' => $yorumlarcek['kullanici_id']
									));

								$kulaniciyorumcek=$kulaniciyorumsor->fetch(PDO::FETCH_ASSOC);
								?>
								<p class="dash">
									<span><?php echo $kulaniciyorumcek['kullanici_adsoyad'] ?></span> <?php echo $yorumlarcek['yorum_zaman'] ?><br><br>
									<?php echo $yorumlarcek['yorum_detay'] ?>
								</p>

								<?php } ?>
								<h4>Yorum Yazın</h4>

								<?php if(isset($_SESSION['userkullanici_mail'])) {?>
								<form action="nedmin/netting/islem.php" method="POST" role="form">
									<?php if($yorumsay>0) {?>
									<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">
									<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'];?>">
									<input type="hidden" name="gelenurl" value="<?php echo "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'].""; ?>">
									<?php } else { echo "Bu ürün hakkında hiç yorum yapılmamış."; ?><br><br> <?php } ?>
									<div class="form-group">
										<textarea name="yorum_detay" class="form-control" placeholder="Lütfen Yorumunuzu Yazınız" id="text" ></textarea>
									</div>
									<button type="submit" name="yorumekle" class="btn btn-default btn-red btn-sm">Yorum Ekle</button>
								</form>
								<?php } else {
									echo "Yorum yapmak için Giriş Yapın!";
								} ?>


							</div>
						</div>
					</div>

					<div id="title-bg">
						<div class="title">Benzer Ürünler</div>
					</div>
					<div class="row prdct"><!--Products-->

						<?php 
						$kategori_id=$uruncek['kategori_id'];
						$urunaltsor=$db->prepare("SELECT * FROM urun WHERE kategori_id=:kategori_id AND urun_id!=:urun_id ORDER BY rand() limit 3");
						$urunaltsor->execute(array(
							'kategori_id'=>$kategori_id,
							'urun_id'=>$uruncek['urun_id']
							));

							while($urunaltcek=$urunaltsor->fetch(PDO::FETCH_ASSOC)) {?>
							<div class="col-md-4">
								<div class="productwrap">
									<div class="pr-img">
										<div class="new"></div>
										<a href="urun-<?=seo($urunaltcek["urun_ad"]).'-'.$urunaltcek["urun_id"] ?>"><img src="<?php echo $urunaltcek['urun_foto'] ?>" width="200" height="200" alt="" class=""></a>

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