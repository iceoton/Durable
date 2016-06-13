<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
require("config.core.php");
require("connect.core.php");
require("logs.core.php");
$loginclass = new clear_db();
$connect = $loginclass->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$check=$loginclass->my_sql_show_rows('user','email="'.addslashes($_POST['username']).'" OR username="'.addslashes($_POST['username']).'" AND user_status="1"');
	if($check == 0){
		echo "<script>window.location=\"../index.php?c=nouser\"</script>";
	}else{
		$info=$loginclass->my_sql_select(NULL,'user','email="'.addslashes($_POST['username']).'" OR username="'.addslashes($_POST['username']).'"');
		while($getinfo=mysql_fetch_object($info)){
			$getpassword = md5(addslashes($_POST['password']));
			if($getinfo->password != $getpassword){
				//ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง
				echo "<script>window.location=\"../index.php?c=nouser\"</script>";
			}else{


				$_SESSION['uname'] = $getinfo->username;
				$_SESSION['uclass'] = $getinfo->user_class;
				$_SESSION['lang'] = $getinfo->user_language;
				$_SESSION['ukey'] = $getinfo->user_key;
				insertLogs($getinfo->username." เข้าสู่ระบบ.",$_SERVER['REMOTE_ADDR'],$getinfo->user_key);
				if($getinfo->user_class != 1){
					echo "<script>window.location=\"../dashboard/\"</script>";
				}else{
					echo "<script>window.location=\"../members/\"</script>";
				}

			}
		}
	}
$loginclass->my_sql_close();
?>
