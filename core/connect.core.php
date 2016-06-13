<?php
class clear_db{
	function my_sql_connect($host,$username,$password,$dbname){
		$connect= mysql_connect($host, $username, $password,true) or die(mysql_error());
     	$db=mysql_select_db($dbname,$connect) or die(mysql_error());
		return $db;
	}
	function my_sql_query($field,$table,$event){
		if($field == NULL && $event == NULL){
			$objQuery=mysql_query("SELECT * FROM ".$table);
		}else if($field == NULL){
			$objQuery=mysql_query("SELECT * FROM ".$table." WHERE ".$event);
		}else if($event == NULL){
			$objQuery=mysql_query("SELECT ".$field." FROM ".$table);
		}else {
			$objQuery=mysql_query("SELECT ".$field." FROM ".$table." WHERE ".$event);
		}
		$objShow=mysql_fetch_object($objQuery);
		return $objShow;
	}
	function my_sql_select($field,$table,$event){
		if($field == NULL && $event == NULL){
			$objQuery=mysql_query("SELECT * FROM ".$table);
		}else if($field == NULL){
			$objQuery=mysql_query("SELECT * FROM ".$table." WHERE ".$event);
		}else if($event == NULL){
			$objQuery=mysql_query("SELECT ".$field." FROM ".$table);
		}else {
			$objQuery=mysql_query("SELECT ".$field." FROM ".$table." WHERE ".$event);
		}
		return $objQuery;
	}
	function my_sql_show_rows($table,$event){
		if($event != NULL){
			$objQuery=mysql_query("SELECT * FROM ".$table." WHERE ".$event);
		}else{
			$objQuery=mysql_query("SELECT * FROM ".$table);
		}
		$objShow=mysql_num_rows($objQuery);
		return $objShow;
	}
	function my_sql_show_field($table,$event){
		if($event != NULL){
			$objQuery=mysql_query("SELECT * FROM ".$table." WHERE ".$event);
		}else{
			$objQuery=mysql_query("SELECT * FROM ".$table);
		}
		$objShow=mysql_num_fields($objQuery);
		return $objShow;
	}
	function my_sql_update($table,$set,$event){
		if($event != NULL){
			return mysql_query("UPDATE ".$table." SET ".$set." WHERE ".$event);
		}else{
			return mysql_query("UPDATE ".$table." SET ".$set);
		}
	}
	function my_sql_insert($table,$set){
			return mysql_query("INSERT INTO ".$table." SET ".$set);
	}
	function my_sql_delete($table,$event){
		if($event != NULL){
			return mysql_query("DELETE FROM ".$table." WHERE ".$event);
		}else{
			return mysql_query("DELETE FROM ".$table);
		}
	}
	function my_sql_string($string){
		return mysql_query($string);
	}
	function my_sql_set_utf8(){
		$cs1 = "SET character_set_results=utf8";
		mysql_query($cs1) or die('Error query: ' . mysql_error());
		$cs2 = "SET character_set_client = utf8";
		mysql_query($cs2) or die('Error query: ' . mysql_error());
		$cs3 = "SET character_set_connection = utf8";
		mysql_query($cs3) or die('Error query: ' . mysql_error());

		mysql_query("SET NAMES utf8");
		mysql_query("SET CHARACTER SET utf8");
		mysql_query("SET collation_connection='utf8_unicode_ci'");
		mysql_query("SET character_set_results=utf8");
		mysql_query("SET character_set_client='utf8'");
		mysql_query("SET character_set_connection='utf8'");
		mysql_query("collation_connection = utf8_unicode_ci");
		mysql_query("collation_database = utf8_unicode_ci");
		mysql_query("collation_server = utf8_unicode_ci");
	}
	function my_sql_set_tis620(){
		$cs1 = "SET character_set_results=tis620";
		mysql_query($cs1) or die('Error query: ' . mysql_error());
		$cs2 = "SET character_set_client = tis620";
		mysql_query($cs2) or die('Error query: ' . mysql_error());
		$cs3 = "SET character_set_connection = tis620";
		mysql_query($cs3) or die('Error query: ' . mysql_error());

		mysql_query("SET NAMES tis620");
		mysql_query("SET CHARACTER SET tis620");
		mysql_query("SET collation_connection='tis620_thai_ci'");
		mysql_query("SET character_set_results=tis620");
		mysql_query("SET character_set_client='tis620'");
		mysql_query("SET character_set_connection='tis620'");
		mysql_query("collation_connection = tis620_thai_ci");
		mysql_query("collation_database = tis620_thai_ci");
		mysql_query("collation_server = tis620_thai_ci");
	}
	function my_sql_close(){
		return mysql_close();
	}
}
?>
