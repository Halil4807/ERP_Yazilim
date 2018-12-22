<?php include 'header.php'; 

$kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail");
$kullanicisor->execute(array(
	'mail' => $_SESSION['userkullanici_mail']
	));

$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">
							<h2>Hesabımı Güncelle
							<small><?php 
								if($_GET['durum']=="ok")  {  ?>

								<b style="color:green;">İşlem Başarılı...</b>

								<?php } elseif($_GET['durum']=="no"){  ?>

								<b style="color:red;">İşlem Başarısız...</b>

								<?php } ?>
								</small>
								</h2>
							<p >Kullanıcı bilgilerinizi güncelleme işlemlerini aşağıda ki form aracılığı ile gerçekleştirebilirsiniz.</p>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<form action="nedmin/netting/islem.php" method="POST" class="form-horizontal checkout" role="form">
		<div class="row">
			<div class="col-md-6">
				<div class="title-bg">
					<div class="title">Kullanıcı Bilgileriniz</div>
				</div>

				<?php 

				if ($_GET['durum']=="farklisifre") {?>

				<div class="alert alert-danger">
					<strong>Hata!</strong> Girdiğiniz şifreler eşleşmiyor.
				</div>
				
				<?php } elseif ($_GET['durum']=="eksiksifre") {?>

				<div class="alert alert-danger">
					<strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
				</div>

				<?php } elseif ($_GET['durum']=="basarisiz") {?>

				<div class="alert alert-danger">
					<strong>Hata!</strong> Kayıt Yapılamadı Sistem Yöneticisine Danışınız.
				</div>
				
				<?php }
				?>


				<?php 

				$zaman=explode(" ",$kullanicicek['kullanici_zaman']);

				?>

				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="hidden" class="form-control"  required="" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>" placeholder="Telefon Numaranızı Giriniz...">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control" disabled="" required="" name="kullanici_tc" value="<?php echo $zaman[0]; ?>">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control" disabled="" required="" name="kullanici_adsoyad" value="<?php echo $zaman[1]; ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="email" class="form-control" readonly="" required="" name="kullanici_mail"  value="<?php echo $kullanicicek['kullanici_mail'] ?>">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-6">
						<input type="password" class="form-control" name="kullanici_passwordone"    placeholder="Şifrenizi Giriniz...">
					</div>
					<div class="col-sm-6">
						<input type="password" class="form-control" name="kullanici_passwordtwo"   placeholder="Şifrenizi Tekrar Giriniz...">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control"  required="" name="kullanici_gsm" value="<?php echo $kullanicicek['kullanici_gsm'] ?>" placeholder="Telefon Numaranızı Giriniz...">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control"  required="" name="kullanici_il" value="<?php echo $kullanicicek['kullanici_il'] ?>" placeholder="Yaşadığınız İli Giriniz...">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control"  required="" name="kullanici_ilce" value="<?php echo $kullanicicek['kullanici_ilce'] ?>" placeholder="Yaşadığınız İlçeyi Giriniz...">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<textarea rows="10" cols="69%" required="" name="kullanici_adres" placeholder="Açık Adresinizi Giriniz..."><?php echo $kullanicicek['kullanici_adres'] ?></textarea>
						
					</div>
				</div>
				<button type="submit" name="userkullaniciguncelle" class="btn btn-default btn-red">Bilgilerimi Güncelle</button>
			</div>
		</div>
	</div>
</form>
<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>