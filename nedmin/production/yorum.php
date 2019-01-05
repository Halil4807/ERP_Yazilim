<?php
include 'header.php';

$hakkimizdasor=$db->prepare("SELECT * FROM hakkimizda WHERE hakkimizda_id=:id");
$hakkimizdasor->execute(array(
  'id' => 0
  ));
$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);


$yorumsor=$db->prepare("SELECT * FROM yorumlar");
$yorumsor->execute();



?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Yorum Listeleme<small>

              <?php if($_GET['sil']=="ok")  {  ?>

              <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif($_GET['sil']=="no"){  ?>

              <b style="color:red;">İşlem Başarısız...</b>

              <?php } ?>

            </small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!--    Div içerik  başlangıçı   -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Ürün Adı</th>
                  <th>Yorum Yazanın Adı Soyadı</th>
                  <th>Yorum</th>
                  <th>Yorum Tarihi</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                <?php while($yorumcek=$yorumsor->fetch(PDO::FETCH_ASSOC)){
                  $kulaniciyorumsor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
                  $kulaniciyorumsor->execute(array(
                    'id' => $yorumcek['kullanici_id']
                    ));
                  $kulaniciyorumcek=$kulaniciyorumsor->fetch(PDO::FETCH_ASSOC);

                  $urunyorumsor=$db->prepare("SELECT * FROM urunler where urun_id=:id");
                  $urunyorumsor->execute(array(
                    'id' => $yorumcek['urun_id']
                    ));
                  $urunyorumcek=$urunyorumsor->fetch(PDO::FETCH_ASSOC);
                    ?>


                    <tr>
                      <td><?php echo $urunyorumcek['urun_ad'] ?></td>
                      <td><?php echo $kulaniciyorumcek['kullanici_adsoyad'] ?></td>
                      <td><?php echo $yorumcek['yorum_detay'] ?></td>
                      <td><?php echo $yorumcek['yorum_zaman'] ?></td>


                      <td><center><a href="../netting/islem.php?yorum_id=<?php echo $yorumcek['yorum_id'];?>&yorumsil=ok">
                      <button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                    </tr>

                    <?php  }  ?>


                  </tbody>
                </table>




                <!--Div İçerik Bitişi -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <?php include 'footer.php';?>