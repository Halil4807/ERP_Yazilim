<?php

include '../netting/baglan.php'; 

$sorgu=mysql_query("SELECT * FROM ayar" );



while($a=mysql_fetch_array($sorgu ) ){

$veri=$a['veri'];

echo "<input type='text' value='$veri'><br>";

}//döngü sonu

?>
