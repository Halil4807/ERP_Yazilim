<?php include'header.php';

$sepetsor=$db->prepare("SELECT * FROM sepet WHERE kullanici_id=:id");
$sepetsor->execute(array(
	'id' => $kullanicicek['kullanici_id']
	));




	?>


	<div class="container">
		<div class="title-bg">
			<div class="title">Alışveriş Tamamlandı.</div>
		</div>
		
		<div class="table-responsive"><br><br><br><br><br>
			<h1 style="color:green;">ÖDEME İŞLEMİNİZ BAŞARIYLA TAMAMLANDI... </h1><br><br><br><br><br><br><br><br><br><br>
		</div>
	</div>
	<?php include 'footer.php'; ?>