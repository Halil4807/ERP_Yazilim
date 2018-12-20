<?php 
ob_start();
session_start();
include 'baglan.php';



if(isset($_POST['kullanicikaydet'])){

	// htmlspecialchars fonksiyonu script gibi 
	//şifre kırma yöntemlerine karşı koruma sağlıyor
	$kullanici_adsoyad=htmlspecialchars($_POST['kullanici_adsoyad']);
	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);
	$kullanici_tc=htmlspecialchars($_POST['kullanici_tc']);

	$kullanici_passwordone=htmlspecialchars($_POST['kullanici_passwordone']);
	$kullanici_passwordtwo=htmlspecialchars($_POST['kullanici_passwordtwo']);

	$kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail OR kullanici_tc=:tc");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'tc' => htmlspecialchars($_POST['kullanici_tc'])
		));
	$kayittsor=$db->prepare("select * from kullanici");
	$kayittsor->execute(array());
	$kayittsay=$kayittsor->rowCount();
	//dönen satır sayısını belirtir
	$say=$kullanicisor->rowCount();
	if ($say==0) 
	{
		if($kullanici_passwordone==$kullanici_passwordtwo)
		{
			if($kullanici_passwordone>=6)
			{
					//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$password=md5($kullanici_passwordone);

				$kullanici_yetki=1;

					//Kullanıcı kayıt işlemi yapılıyor...
				$kullanicikaydet=$db->prepare("INSERT INTO kullanici SET
					kullanici_id=:kullanici_id,
					kullanici_tc=:kullanici_tc,
					kullanici_gsm=:kullanici_gsm,
					kullanici_adsoyad=:kullanici_adsoyad,
					kullanici_mail=:kullanici_mail,
					kullanici_password=:kullanici_password,
					kullanici_il=:kullanici_il,
					kullanici_ilce=:kullanici_ilce,
					kullanici_adres=:kullanici_adres,
					kullanici_yetki=:kullanici_yetki
					");
				$insert=$kullanicikaydet->execute(array(
					'kullanici_id'=>$kayittsay,
					'kullanici_tc'=>htmlspecialchars($_POST['kullanici_tc']),
					'kullanici_gsm'=>htmlspecialchars($_POST['kullanici_gsm']),
					'kullanici_adsoyad' => $kullanici_adsoyad,
					'kullanici_mail' => $kullanici_mail,
					'kullanici_password' => $password,
					'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
					'kullanici_ilce' => htmlspecialchars($_POST['kullanici_ilce']),
					'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
					'kullanici_yetki' => $kullanici_yetki
					));
				if ($insert) 
				{
					header("Location:../../index.php?durum=loginbasarili");
				} 
				else 
				{
					header("Location:../../register.php?durum=basarisiz");
				}
			}
			else
			{
				header("Location:../../register.php?durum=eksiksifre");
			}
		}
		else
		{
			header("Location:../../register.php?durum=farklisifre");
		}
		
	}
	else 
	{
		header("Location:../../register.php?durum=mukerrerkayit");
	}
}

if (isset($_POST['admingiris'])) {

	$kullanici_mail=$_POST['kullanici_mail'];
	$kullanici_password=md5($_POST['kullanici_password']);

	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_password=:password and kullanici_yetki=:yetki");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'password' => $kullanici_password,
		'yetki' => 5
		));

	echo $say=$kullanicisor->rowCount();

	if ($say==1) {

		$_SESSION['kullanici_mail']=$kullanici_mail;
		header("Location:../production/index.php");
		exit;
	} else {

		header("Location:../production/login.php?durum=no");
		exit;
	}
}

if (isset($_POST['genelayarkaydet'])) {

	// Genel Ayar Tablosu Gğncelleme
	$ayarkaydet=$db->prepare("UPDATE ayar SET

		ayar_title=:ayar_title,
		ayar_description=:ayar_description,
		ayar_keywords=:ayar_keywords,
		ayar_author=:ayar_author
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(
		'ayar_title'=> $_POST['ayar_title'],
		'ayar_description'=> $_POST['ayar_description'],
		'ayar_keywords'=> $_POST['ayar_keywords'],
		'ayar_author'=> $_POST['ayar_author']
		));

	if($update)
	{
		header("Location:../production/genel-ayar.php?durum=ok");
	}
	else
	{
		header("Location:../production/genel-ayar.php?durum=no");
	}
}

if (isset($_POST['iletisimayarkaydet'])) {

	// Genel Ayar Tablosu Gğncelleme
	$ayarkaydet=$db->prepare("UPDATE ayar SET

		ayar_tel=:ayar_tel,
		ayar_gsm=:ayar_gsm,
		ayar_faks=:ayar_faks,
		ayar_mail=:ayar_mail,
		ayar_ilce=:ayar_ilce,
		ayar_il=:ayar_il,
		ayar_adres=:ayar_adres,
		ayar_mesai=:ayar_mesai
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(
		'ayar_tel'=> $_POST['ayar_tel'],
		'ayar_gsm'=> $_POST['ayar_gsm'],
		'ayar_faks'=> $_POST['ayar_faks'],
		'ayar_mail'=> $_POST['ayar_mail'],
		'ayar_ilce'=> $_POST['ayar_ilce'],
		'ayar_il'=> $_POST['ayar_il'],
		'ayar_adres'=> $_POST['ayar_adres'],
		'ayar_mesai'=> $_POST['ayar_mesai']
		));

	if($update)
	{
		header("Location:../production/iletisim-ayarlar.php?durum=ok");
	}
	else
	{
		header("Location:../production/iletisim-ayarlar.php?durum=no");
	}
}

if (isset($_POST['hakkimizdakaydet'])) {

	// Genel Ayar Tablosu Gğncelleme


	/*

	
	Kopyala Yapıştır Yaparken

	Tablo Adına
	İşaret Satırlarına Dikkat et!!!!


	*/
	$hakkimizdakaydet=$db->prepare("UPDATE hakkimizda SET

		hakkimizda_baslik=:hakkimizda_baslik,
		hakkimizda_icerik=:hakkimizda_icerik,
		hakkimizda_video=:hakkimizda_video,
		hakkimizda_vizyon=:hakkimizda_vizyon,
		hakkimizda_misyon=:hakkimizda_misyon
		WHERE hakkimizda_id=0");

	$update=$hakkimizdakaydet->execute(array(
		'hakkimizda_baslik'=> $_POST['hakkimizda_baslik'],
		'hakkimizda_icerik'=> $_POST['hakkimizda_icerik'],
		'hakkimizda_video'=> $_POST['hakkimizda_video'],
		'hakkimizda_vizyon'=> $_POST['hakkimizda_vizyon'],
		'hakkimizda_misyon'=> $_POST['hakkimizda_misyon']
		));

	if($update)
	{
		header("Location:../production/hakkimizda.php?durum=ok");
	}
	else
	{
		header("Location:../production/hakkimizda.php?durum=no");
	}
}

if (isset($_POST['kullaniciduzenle'])) {

	$kullanici_id=$_POST['kullanici_id'];

	$ayarkaydet=$db->prepare("UPDATE kullanici SET

		kullanici_tc=:kullanici_tc,
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_durum=:kullanici_durum
		WHERE kullanici_id={$_POST['kullanici_id']}");

	$update=$ayarkaydet->execute(array(
		'kullanici_tc'=> $_POST['kullanici_tc'],
		'kullanici_adsoyad'=> $_POST['kullanici_adsoyad'],
		'kullanici_durum'=> $_POST['kullanici_durum']
		));

	if($update)
	{
		header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok");
	}
	else
	{
		header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
	}
}

if($_GET['kullanicisil']==ok){
	$sil=$db->prepare("DELETE FROM kullanici WHERE kullanici_id=:id");

	$kontrol=$sil->execute(array(
		'id'=>$_GET['kullanici_id']
		));

	if($kontrol){
		header("Location:../production/kullanici.php?sil=ok");
	}
	else{
		header("Location:../production/kullanici.php?sil=no");
	}
}



?>