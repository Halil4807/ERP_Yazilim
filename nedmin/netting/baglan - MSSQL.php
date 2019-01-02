<?php

//mssql connection için gerekli kodlar  

$serverName = 'DESKTOP-5OKR8U9'; //mssql server name buraya gelecek.

$connectionInfo = array( 'Database'=>'erp'); //db name buraya gelecek.
$conn = sqlsrv_connect($serverName, $connectionInfo);
//$conn = odbc_connect('DRIVER={DESKTOP-5OKR8U9};SERVER=20.40.27.80;DATABASE=erp');
//$conn = new PDO('sqlsrv:Server=[DESKTOP-5OKR8U9];Database=[erp]');
if ($conn) {
	echo 'Connection Successfull <hr>';
}else{
	echo 'Bağlantı Başarısız! <hr>';
	die(print_r(sqlsrv_errors(), true));
}

?>