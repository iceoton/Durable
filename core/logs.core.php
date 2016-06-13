<?php
function insertLogs($logtext,$log_ipaddr,$log_user){
	$insertlog = new clear_db();
	$connect = $insertlog->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$log_key = substr(md5($logtext.$log_ipaddr.time("now")),8,16);
	$insertlog->my_sql_set_utf8();
	$insertlog->my_sql_insert("logs","log_key='".$log_key."',log_ipaddress='".$log_ipaddr."',log_text='".$logtext."',log_user='".$log_user."'");
	//$stringData = date("d/m/Y H:i:s")." | Address : ".$_SERVER['REMOTE_ADDR']." | User : ".$_SESSION['uname'].$logs."<br/>\n";
}
?>