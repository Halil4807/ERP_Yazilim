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

			<?php 

			if ($_GET['durum']=="ok") {?>
			<h1 style="color:green;">ÖDEME İŞLEMİNİZ BAŞARIYLA TAMAMLANDI... </h1>
			<?php } elseif ($_GET['durum']=="no") {?>

			<h1 style="color:red;">ÖDEME İŞLEMİNİZ BAŞARISIZ OLDU... </h1>

			<?php }

			?>
			<br><br><br><br><br><br><br><br><br><br>
		</div>
	</div>
	<?php include 'footer.php'; ?>