<?php include'header.php';

$sepetsor=$db->prepare("SELECT * FROM sepet WHERE kullanici_id=:id");
$sepetsor->execute(array(
	'id' => $kullanicicek['kullanici_id']
	));




	?>


	<div class="container">
		<div class="title-bg">
			<div class="title">Alışveriş Sepeti</div>
		</div>
		
		<div class="table-responsive">
			<table class="table table-bordered chart">
				<thead>
					<tr>
						<th>Ürünün Resim</th>
						<th>Ürünün Adı</th>
						<th>Ürünün Kodu</th>
						<th>Adet</th>
						<th>Birim Fiyat</th>
						<th>Toplam Fiyat</th>
					</tr>
				</thead>
				<form action="nedmin/netting/islem.php" method="POST">
					<tbody>
						<?php 
						while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC))
						{
							$urunsepet_id=$sepetcek['urun_id'];
							$urunsepetsor=$db->prepare("SELECT * FROM urun WHERE urun_id=:id");
							$urunsepetsor->execute(array(
								'id' => $urunsepet_id
								));
							$urunsepetcek=$urunsepetsor->fetch(PDO::FETCH_ASSOC);
							$toplam_fiyat+=$urunsepetcek['urun_fiyat']*$sepetcek['urun_adet'];
							?>

							<input type="hidden" name="urun_id[]" value="<?php echo $urunsepetcek['urun_id']; ?>">
							<tr>

								<td><img src="images\demo-img.jpg" width="100" alt=""></td>
								<td><?php echo $urunsepetcek['urun_ad'] ?></td>
								<td><?php echo $urunsepetcek['urun_id'] ?></td>
								<td><input type="text" class="form-control quantity" value="<?php echo $sepetcek['urun_adet'] ?>"></td>
								<td><?php echo $urunsepetcek['urun_fiyat']*1 ?>₺</td>
								<td><?php echo $urunsepetcek['urun_fiyat']*$sepetcek['urun_adet'] ?>₺</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="row">
					<div class="col-md-6">
					</div>
					<div class="col-md-3 col-md-offset-3">
						<div class="subtotal-wrap">
							<div class="subtotal">
								<p>Ara Toplam : <?php echo $toplam_fiyat*0.82 ?> ₺</p>
								<p>KDV 18% : <?php echo $toplam_fiyat*0.18 ?> ₺</p>
							</div>
							<div class="total">Toplam Fiyat : <span class="bigprice"><?php echo $toplam_fiyat ?> ₺</span></div>
							<div class="clearfix"></div>
							<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">
							<input type="hidden" name="siparis_toplam" value="<?php echo $toplam_fiyat; ?>">
							<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">
							<button name="siparisekle" type="submit" class="btn btn-default btn-yellow">Ödeme Sayfası</button>
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="spacer"></div>
		</div>
		<?php include 'footer.php'; ?>