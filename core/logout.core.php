<?php
	session_start();
	require("config.core.php");
	require("connect.core.php");
	require("logs.core.php");
	insertLogs($_SESSION['uname']." ออกจากระบบ.",$_SERVER['REMOTE_ADDR'],$_SESSION['ukey']);
	unset( $_SESSION['uname']);
	unset( $_SESSION['thumb']);
	unset( $_SESSION['uid']);
	unset( $_SESSION['uclass']);
	unset($_SESSION['ukey']);
	
	echo"<script>window.location.href='../';</script>";
?>
