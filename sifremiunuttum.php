<?php include 'header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="bigtitle">Şifremi Unuttum!</div>
							<p >Şifrenizi Yenilemek için Aşağıdaki bilgileri doldurun...</p>
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
					<div class="title">Şifremi Unuttum!</div>
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
				
				<?php } elseif ($_GET['durum']=="yanlis") {?>

				<div class="alert alert-danger">
					<strong>Hata!</strong> Bilgileri Eksik veya Yanlış Girdiniz.
				</div>
				
				<?php } elseif ($_GET['durum']=="basarisiz") {?>

				<div class="alert alert-danger">
					<strong>Hata!</strong>  Sistem Yöneticisine Danışınız.
				</div>
				
				<?php }
				?>


				

				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control"  required="" name="kullanici_tc" placeholder="TC Kimlik Numaranızı Giriniz...">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="email" class="form-control" required="" name="kullanici_mail"  placeholder="Dikkat! Mail adresiniz kullanıcı adınız olacaktır.">
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

				<button type="submit" name="sifreyenile" class="btn btn-default btn-red">Şifremi Unuttum</button>
			</div>
		</div>
	</div>
</form>
<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>