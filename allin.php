<?php
	date_default_timezone_set('Asia/Jakarta');  // you are required to set a timezone

	function getAllData($table, $col, $last = ""){
		$sql = "select ".$col." from ".$table." where 1 ".$last;
		$res = mysql_query($sql);
		$result = [];
		while ($row = mysql_fetch_assoc($res)) {
			$result[] = $row;
		}
		return $result;
	}

	function deleteDB($table, $where = 1){
		$sql = "DELETE FROM ".$table." WHERE ".$where;
		$res = mysql_query($sql);
		return $res;
	}

	function insertDB($table,$data){
		$sql = "INSERT INTO ".$table." ";

		$fields = "(";
		$values = "(";
		foreach ($data as $key => $val) {
			$fields .= $key.", ";
			$values .= "'".$val."', ";
		}
		
		$fields = substr($fields, 0, strlen($fields) - 2);
		$values = substr($values, 0, strlen($values) - 2);

		$fields .= ")";
		$values .= ")";
		
		$sql .= $fields;
		$sql .= " VALUES ".$values;

		$res = mysql_query($sql);
		return $res;
	}

	function generateID($table, $col, $length){
		$id = 1;
		$sql = "select ".$col."*1 as ".$col." from ".$table." where 1 order by ".$col."*1 desc limit 1";
		$res = mysql_query($sql);
		while ($row = mysql_fetch_assoc($res)) {
			$id = $row[$col] + 1;
		}

		while (strlen($id) < $length) {
			$id = '0'.$id;
		}

		return $id;
	}

	function updateDB($table,$data, $where = '1'){
		$sql = "UPDATE ".$table." ";

		$str = " SET ";

		foreach ($data as $key => $val) {
			$str .= " ".$key." = '".$val."', ";
		}
		
		$str = substr($str, 0, strlen($str) - 2);
		
		$sql .= $str;
		$sql .= " WHERE ".$where;
		$res = mysql_query($sql);
		return $res;
	}

	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}

?>