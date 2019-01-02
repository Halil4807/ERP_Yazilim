<?php include 'header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="bigtitle">Sipariş Bilgilerim</div>
							<p >Vermiş olduğunuz siparişlerinizi listeliyorsunuz</p>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

		<div class="row">
			<div class="col-md-12">
				<div class="title-bg">
					<div class="title">Sipariş Bilgileri</div>
				</div>

				<div class="table-responsive">
					<table class="table table-bordered chart">
						<thead>
							<tr>
								<th>Sipariş No</th> 
								<th>Tarih</th>
								<th>Tutar</th>
								<th>Durum</th>
								<th></th>
								
							</tr>
						</thead>
						<tbody>
							<tr>
								<?php 
								$siparissor=$db->prepare("SELECT * FROM siparis WHERE kullanici_id=:kullanici_id ORDER BY siparis_zaman DESC");
								$siparissor->execute(array(
									'kullanici_id' => $kullanicicek['kullanici_id']
									));
								while($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) 
								{ ?>
									<td><?php echo $sipariscek['siparis_id'] ?></td>
									<td><?php echo $sipariscek['siparis_zaman'] ?></td>
									<td><?php echo $sipariscek['siparis_toplam'] ?></td>
									<td><?php echo $sipariscek['siparis_tip'] ?></td>

									<td><center><a href="siparis-detay.php?siparis_id=<?php echo $sipariscek['siparis_id']; ?>"><button class="btn btn-primary btn-xs">Detay</button></a></center></td>
								<?php } ?>
								
							</tr>

						</tbody>
					</table>
				</div>
			</div>
			
		</div>
	</div>
<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>