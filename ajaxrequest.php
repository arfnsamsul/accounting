<?php
	include "koneksi.php";
	class ajaxrequest{

		function getdetailbarang()
		{
			$id = isset($_GET['id']) ? $_GET['id'] : "";
			$sql = "select * from barang where id = ".$id;
			$res = mysql_query($sql);
			$row = mysql_fetch_assoc($res);

			$result = $row;

			$sql = "select bahanbaku from barang_bahanbaku where idbarang = ".$id;
			$res = mysql_query($sql);
			$bahanbaku = [];
			while ($row = mysql_fetch_assoc($res)) {
				$bahanbaku[] = $row['bahanbaku'];
			}
			$result['bahanbaku'] = $bahanbaku;

			return $result;
		}

		function defaultFunc(){
			return [];
		}


		
	}

	$method = isset($_GET['method']) ? $_GET['method'] : "";
	if(is_callable($method, true)){
	    echo json_encode(ajaxrequest::$method());
	}else{
	    echo json_encode(ajaxrequest::defaultFunc()); //or some kind of error message
	}
?>