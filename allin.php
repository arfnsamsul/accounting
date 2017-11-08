<?php
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

?>