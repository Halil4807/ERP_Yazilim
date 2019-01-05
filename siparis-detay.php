<?php include 'header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="bigtitle">Sipariş Detaylarınız</div>
							<p >Vermiş olduğunuz siparişinizdeki ürünler listeliyorsunuz</p>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<form action="nedmin/netting/islem.php" method="POST" class="form-horizontal checkout" role="form">
		<div class="row">
			<div class="col-md-12">
				<div class="title-bg">
					<div class="title">Siparişteki Ürünler</div>
				</div>

				<div class="table-responsive">
					<table class="table table-bordered chart">
						<thead>
							<tr>
								<th>Sipariş No</th> 
								<th>Ürün</th>
								<th>Adet</th>
								<th>Birim Tutarı</th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
							$siparisdetaysor=$db->prepare("SELECT * FROM siparis_detay WHERE siparis_id=:siparis_id");
							$siparisdetaysor->execute(array(
								'siparis_id'=> $_GET['siparis_id']
								));
							while($siparisdetaycek=$siparisdetaysor->fetch(PDO::FETCH_ASSOC)) 
							{ 
								$urunsor=$db->prepare("SELECT * FROM urunler WHERE urun_id=:urun_id");
								$urunsor->execute(array(
									'urun_id'=>$siparisdetaycek['urun_id']
									));
								$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
								?>

								<tr>
									<td><?php echo $siparisdetaycek['siparis_id']; ?></td>
									<td><?php echo $uruncek['urun_ad']; ?></td>
									<td><?php echo $siparisdetaycek['urun_adet']; ?></td>
									<td><?php echo $siparisdetaycek['urun_fiyat']; ?></td>
								</tr>
								<?php } ?>



							</tbody>
						</table>
					</div>











				</div>

			</div>
		</div>
	</form>
	<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>