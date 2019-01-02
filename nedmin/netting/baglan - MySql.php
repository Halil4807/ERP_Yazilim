<?php 

try {

	$db=new PDO("mysql:host=localhost;dbname=erp;charset=utf8",'root','1201710208');

	//echo "Veritabanı bağlantısı başarılı";

} catch (PDOExpception $e) {

	echo $e->getMessage();
}


?>