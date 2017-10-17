<?php 	
	$host = 'localhost' ;
	$user = 'root' ;
	$pass = '' ;
	$db = 'acc_app' ;

	$cnn = mysql_connect($host,$user,$pass);
	if (!$cnn) {
		exit ('Koneksi Gagal');
	}
	$db = mysql_select_db($db);
	if (!$db) {
		exit ('Gagal Memilih Database');
	}

	session_start();
?>
