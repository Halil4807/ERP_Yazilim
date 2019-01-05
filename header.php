<?php
ob_start();
session_start();
include 'nedmin/netting/baglan.php';
include 'nedmin/production/fonksiyon.php';

//Belirli veriyi seçme işlemi
$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
	'id' => 0
	));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

$kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail");
$kullanicisor->execute(array(
  'mail' => $_SESSION['userkullanici_mail']
  ));
$say=$kullanicisor->rowCount();
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $ayarcek['ayar_title'] ?></title>

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='font-awesome\css\font-awesome.css' rel="stylesheet" type="text/css">
	<!-- Bootstrap -->
	<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
	
	<!-- Main Style -->
	<link rel="stylesheet" href="style.css">
	
	<!-- owl Style -->
	<link rel="stylesheet" href="css\owl.carousel.css">
	<link rel="stylesheet" href="css\owl.transitions.css">
	
  <!-- fancy Style -->
  <link rel="stylesheet" type="text/css" href="js\product\jquery.fancybox.css?v=2.1.5" media="screen">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   
    <body>
     <div id="wrapper">
      <div class="header"><!--Header -->
       <div class="container">
        <div class="row">
         <div class="col-xs-6 col-md-4 main-logo">
          <img src="images\logo.JPG" alt="logo" class="logo img-responsive">
        </div>






        <div class="col-md-8">
          <div class="pushright">
           <div class="top">

            <?php  if(isset($_SESSION['userkullanici_mail'])) {	 ?>
            <a class="btn btn-default btn-dark">Hoş Geldin - <?php echo $kullanicicek['kullanici_adsoyad'] ?> </a>
            <?php } else {?>
            <a href="#" id="reg" class="btn btn-default btn-dark"> Giriş Yap <span>-- Yada --</span>Kayıt Ol</a>
            <?php } ?>

            <div class="regwrap">
             <div class="row">
              <div class="col-md-6 regform">
               <div class="title-widget-bg">
                <div class="title-widget">Kullanıcı Girişi</div>
              </div>


              <form action="nedmin/netting/islem.php" method="POST" role="form">


                <div class="form-group">
                 <input type="text" class="form-control" name="kullanici_mail" id="username" placeholder="Kullanıcı Adınız (Mail Adresiniz)">
               </div>


               <div class="form-group">
                 <input type="password" class="form-control" name="kullanici_password" id="password" placeholder="Şifreniz">
               </div>


               <div class="form-group">
                 <button type="submit" name="kullanicigiris" class="btn btn-default btn-red btn-sm">Giriş Yap</button>
               </div>

             </form>

             
           </div>
           <div class="col-md-6">
             <div class="title-widget-bg">
              <div class="title-widget">Kayıt Ol</div>
            </div>
            <p>
              Yeni Kullanıcı mısınız? Alışverişe başlamak için hemen kayıt olmalısın!
            </p>
            <a href="register.php"><button class="btn btn-default btn-yellow">Kayıt Ol</button></a>
          </div>
        </div>
      </div>
      <div class="srch-wrap">
       <a href="#" id="srch" class="btn btn-default btn-search"><i class="fa fa-search"></i></a>
     </div>
     <div class="srchwrap">
       <div class="row">
        <div class="col-md-12">
         <form class="form-horizontal" role="form">
          <div class="form-group">
           <label for="search" class="col-sm-2 control-label">Search</label>
           <div class="col-sm-10">
            <input type="text" class="form-control" id="search">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="dashed"></div>
</div><!--Header -->
<div class="main-nav"><!--end main-nav -->
 <div class="navbar navbar-default navbar-static-top">
  <div class="container">
   <div class="row">
    <div class="col-md-10">
     <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
   </div>
   <div class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
      <li><a href="index.php" class="active">Ana Sayfa</a><div class="curve"></div></li>
      <li class="dropdown"></li>

      <li><a href="kategoriler.php">Kategoriler</a></li>
      <li><a href="hakkimizda.php">Hakkımızda</a></li>
    </ul>
  </div>
</div>
<?php
$sepetsor=$db->prepare("SELECT * FROM sepet WHERE kullanici_id=:id");
$sepetsor->execute(array(
  'id' => $kullanicicek['kullanici_id']
  ));

while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC))
{
  $urunsepet_id=$sepetcek['urun_id'];
  $urunsepetsor=$db->prepare("SELECT * FROM urunler WHERE urun_id=:id");
  $urunsepetsor->execute(array(
    'id' => $urunsepet_id
    ));
  $urunsepetcek=$urunsepetsor->fetch(PDO::FETCH_ASSOC);
  $toplamcartust_fiyat+=$urunsepetcek['urun_fiyat']*$sepetcek['urun_adet'];
} ?>
<div class="col-md-2 machart">
 <button id="popcart" class="btn btn-default btn-chart btn-sm "><span class="mychart">Alışveriş Sepeti</span>|<span class="allprice"><?php if($toplamcartust_fiyat>0){ echo $toplamcartust_fiyat;} else{echo "0";} ?> ₺</span></button>
 <div class="popcart">
  <table class="table table-condensed popcart-inner">
   <tbody>

    <?php
    $sepetsor=$db->prepare("SELECT * FROM sepet WHERE kullanici_id=:id");
    $sepetsor->execute(array(
      'id' => $kullanicicek['kullanici_id']
      ));

    while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC))
    {
      $urunsepet_id=$sepetcek['urun_id'];
      $urunsepetsor=$db->prepare("SELECT * FROM urunler WHERE urun_id=:id");
      $urunsepetsor->execute(array(
        'id' => $urunsepet_id
        ));
      $urunsepetcek=$urunsepetsor->fetch(PDO::FETCH_ASSOC);
      $toplamcartalt_fiyat+=$urunsepetcek['urun_fiyat']*$sepetcek['urun_adet'];
      ?>
      <tr>
       <td>
       <img src="<?php echo $urunsepetcek['urun_foto'] ?>" width="50" height="50" alt="" class="">
      </td>
      <td><?php echo $urunsepetcek['urun_ad'] ?><br></td>
      <td><?php echo $sepetcek['urun_adet']*1 ?>X</td>
      <td><?php echo $urunsepetcek['urun_fiyat']*1 ?>₺</td>
    </tr>
    <tr>
      <?php } ?>
    </tbody>
  </table>
  <br>
  <div class="btn-popcart">
   <a href="sepet.php" class="btn btn-default btn-red btn-sm">Sepete Git</a>
 </div>
 <div class="popcart-tot">
   <p>
    Toplam<br>
    <span><?php echo $toplamcartalt_fiyat ?> ₺</span>
  </p>
</div>
<div class="clearfix"></div>
</div>
</div>

<?php  if(isset($_SESSION['userkullanici_mail'])) {	 ?>
<ul class="small-menu"><!--small-nav -->
 <li><a href="hesabim" class="myacc">Hesap Bilgilerim</a></li>
 <li><a href="siparislerim" class="myshop">Siparişlerim</a></li>
 <li><a href="logout" class="mycheck">Güvenli Çıkış</a></li>
</ul><!--small-nav -->
<?php } ?>

</div>
</div>
</div>
	</div><!--end main-nav -->