<?php
session_start();
error_reporting(0);
//Remove
function EmptyDir($dir) {
$handle=opendir($dir);

while (($file = readdir($handle))!==false) {
@unlink($dir.'/'.$file);
}

closedir($handle);
}
//set_time_default
date_default_timezone_set('Asia/Bangkok'); 
require("../core/connect.core.php");
require("../core/config.core.php");
$getdata=new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$getdata->my_sql_set_utf8();
	switch(addslashes($_GET['type'])){

		case "chg_ordering" : $getdata->my_sql_update("slideshow","slide_sorting='".addslashes($_GET['sort'])."'","slide_key='".addslashes($_GET['key'])."'");
								 echo '<script>window.location="index.php?p=slideshow";</script>';
		break;
		case "change_cat_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("categories","cat_status='0'","cat_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("categories","cat_status='1'","cat_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		case "change_grp_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("member_group","grp_status='0'","grp_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("member_group","grp_status='1'","grp_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		case "change_level_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("level","level_status='0'","level_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("level","level_status='1'","level_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		
		case "change_user_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("user","user_status='0'","user_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("user","user_status='1'","user_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		case "change_member_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("member","member_status='0'","member_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("member","member_status='1'","member_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		case "change_menu_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("menus","menu_status='0'","menu_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("menus","menu_status='1'","menu_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		case "change_unit_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("product_unit","unit_status='0'","unit_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("product_unit","unit_status='1'","unit_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		case "change_products_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("products","pro_status='0'","pro_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("products","pro_status='1'","pro_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		case "change_barcode_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("products_barcode","barcode_status='0'","barcode_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("products_barcode","barcode_status='1'","barcode_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		case "change_cardtype_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("card_type","ctype_status='0'","ctype_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("card_type","ctype_status='1'","ctype_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		
		case "change_discount_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("member_discount","disc_status='0'","disc_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("member_discount","disc_status='1'","disc_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		
		case "change_access_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("access_list","access_status='0'","access_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("access_list","access_status='1'","access_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		case "change_export_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("products_export","export_status='0'","export_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("products_export","export_status='1'","export_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		case "change_slide_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("link_slideshow","slide_status='0'","slide_key='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("link_slideshow","slide_status='1'","slide_key='".addslashes($_GET['key'])."'");
										}
										
		break;
		case "change_case_status" : if(addslashes($_GET['sts']) == "1"){
											$getdata->my_sql_update("list","case_status='0'","cases='".addslashes($_GET['key'])."'");
										}else{
											$getdata->my_sql_update("list","case_status='1'","cases='".addslashes($_GET['key'])."'");
										}
										
		break;
		
		case "hide_card" : $getdata->my_sql_update("card_info","card_status='hidden'","card_key='".addslashes($_GET['key'])."'");
		break;
		
	
		case "delete_cat" : $getdata->my_sql_delete("categories","cat_key='".addslashes($_GET['key'])."'");
		break;
		case "delete_period" : $getdata->my_sql_delete("commission_period","period_key='".addslashes($_GET['key'])."'");
		break;
		
		case "delete_grp" : $getdata->my_sql_delete("member_group","grp_key='".addslashes($_GET['key'])."'");
		break;
		
		case "delete_user" : $getdata->my_sql_delete("user","user_key='".addslashes($_GET['key'])."'");
		break;
		case "delete_level" : $getdata->my_sql_delete("level","level_key='".addslashes($_GET['key'])."'");
		break;
		
		case "delete_case" : $getdata->my_sql_delete("list","cases='".addslashes($_GET['key'])."'");
		break;
		case "delete_member" : $getdata->my_sql_update("member","member_status='2'","member_key='".addslashes($_GET['key'])."'");
		break;
		case "delete_cardtype" : $getdata->my_sql_update("card_type","ctype_status='2'","ctype_key='".addslashes($_GET['key'])."'");
		break;
		case "delete_card" : $getdata->my_sql_delete("card_info","card_key='".addslashes($_GET['key'])."'");
		$getdata->my_sql_delete("card_item","card_key='".addslashes($_GET['key'])."'");
		$getdata->my_sql_delete("card_status","card_key='".addslashes($_GET['key'])."'");
		break;
		case "delete_menu" : $getdata->my_sql_delete("menus","menu_key='".addslashes($_GET['key'])."'");
		break;
		case "delete_barcode" : $getdata->my_sql_delete("products_barcode","barcode_key='".addslashes($_GET['key'])."'");
		break;
		case "delete_discount" : $getdata->my_sql_delete("member_discount","disc_key='".addslashes($_GET['key'])."'");
		break;
		case "delete_item" : $getdata->my_sql_delete("card_item","item_key='".addslashes($_GET['key'])."'");
		break;
		
		
		case "delete_unit" : $getdata->my_sql_update("product_unit","unit_status='2'","unit_key='".addslashes($_GET['key'])."'");
		break;
		
		case "delete_products" : $getdata->my_sql_update("products","pro_status='2'","pro_key='".addslashes($_GET['key'])."'");
									$getdata->my_sql_update("products_barcode","barcode_status='0'","product_key='".addslashes($_GET['key'])."'");
		break;
		case "delete_pro_import_temp_item" : $getdata->my_sql_delete("import_temp","import_temp_key='".addslashes($_GET['key'])."'");
		break;
		case "delete_pro_export_temp_item" : $getdata->my_sql_delete("export_temp","export_temp_key='".addslashes($_GET['key'])."'");
		break;
		case "delete_other_temp_item" : $getdata->my_sql_delete("products_export_other_temp","other_key='".addslashes($_GET['key'])."'");
		break;
		case "delete_free_temp_item" : $getdata->my_sql_delete("products_export_free_temp","free_key='".addslashes($_GET['key'])."'");
		break;
		
		case "cancel_reciept":
		
		$totalpoint = $getdata->my_sql_select(NULL,"point_logs","fin_key='".addslashes($_GET['key'])."'");
		while($subtotalpoint = mysql_fetch_object($totalpoint)){
			$getdata->my_sql_update("member","`member_point`=`member_point`-".$subtotalpoint->point_transfer."","member_key='".$subtotalpoint->transfer_reciept."'");
		}
		$totalcom = $getdata->my_sql_query(NULL,"commission_logs","fin_key='".addslashes($_GET['key'])."'");
		while($subtotalcom = mysql_fetch_object($totalcom)){
			$getdata->my_sql_update("member","`member_commission`=`member_commission`-".$subtotalcom->commission_transfer."","member_key='".$subtotalcom->transfer_reciept."'");
		}
		//$member_finance = $getdata->my_sql_query("member_key","member_finance","fin_key='".addslashes($_GET['key'])."'");
		//$getdata->my_sql_update("member","`member_point`=`member_point`-".$totalpoint->total_point.",`member_commission`=`member_commission`-".$totalcom->total_com."","member_key='".$member_finance->member_key."'");
		$cancel_rec = $getdata->my_sql_select(NULL,"products_export","fin_key='".addslashes($_GET['key'])."'");
		while($showpex = mysql_fetch_object($cancel_rec)){
			$getdata->my_sql_update("products","`pro_instore`=`pro_instore`+".$showpex->export_quantity."","pro_key='".$showpex->pro_key."'");
		}
		$cancel_free = $getdata->my_sql_select(NULL,"products_export_free","fin_key='".addslashes($_GET['key'])."'");
		while($showfree = mysql_fetch_object($cancel_free)){
			$getdata->my_sql_update("products","`pro_instore`=`pro_instore`+".$showfree->pro_quantity."","pro_key='".$showfree->pro_key."'");
		}
		$getdata->my_sql_update("point_logs","point_type='6'","fin_key='".addslashes($_GET['key'])."'");
		$getdata->my_sql_update("commission_logs","commission_type='6'","fin_key='".addslashes($_GET['key'])."'");
		$getdata->my_sql_update("finance","fin_status='2'","fin_key='".addslashes($_GET['key'])."'");
		$can_key = md5(addslashes($_GET['key']).time('now'));
		$getdata->my_sql_insert("finance_cancel","cancel_key='".$can_key."',fin_key='".addslashes($_GET['key'])."',user_key='".addslashes($_GET['user'])."',cancel_note='".addslashes($_GET['note'])."'");
		
		break;
		case "cancel_import":
		$getdata->my_sql_update("products_import_header","pim_status='2'","pim_key='".addslashes($_GET['key'])."'");
		$cancel_pim = $getdata->my_sql_select(NULL,"products_import","pim_key='".addslashes($_GET['key'])."'");
		while($showpim = mysql_fetch_object($cancel_pim)){
			$getdata->my_sql_update("products","`pro_instore`=`pro_instore`-".$showpim->import_quantity."","pro_key='".$showpim->pro_key."'");
		}
		$can_key = md5(addslashes($_GET['key']).time('now'));
		$getdata->my_sql_insert("import_cancel","cancel_key='".$can_key."',fin_key='".addslashes($_GET['key'])."',user_key='".addslashes($_GET['user'])."',cancel_note='".addslashes($_GET['note'])."'");
		break;
	case "delete_backup" : 
									
									$getremove = $getdata->my_sql_query(NULL,"backup_logs","backup_key='".addslashes($_GET['key'])."'");
									unlink("../backup/".$getremove->backup_file);
									$getdata->my_sql_delete("backup_logs","backup_key='".addslashes($_GET['key'])."'");
		break;
		case "download_backup" : 
							$getlink = $getdata->my_sql_query("backup_file","backup_logs","backup_key='".addslashes($_GET['key'])."'");
							$file = "../backup/".$getlink->backup_file; 
							$filename = $getlink->backup_file;
							header("Content-Description: Clear Download"); 
							header("Content-Type: application/octet-stream"); 
							header("Content-Disposition: attachment; filename=\"$filename\""); 
							readfile ($file);
							
	break;
	case "delete_slide" : $slide = $getdata->my_sql_query("slide_file","link_slideshow","slide_key='".addslashes($_GET['key'])."'");
								unlink("../resource/link/slide/images/".$slide->slide_file);
								unlink("../resource/link/slide/thumbs/".$slide->slide_file);
								$getdata->my_sql_delete("link_slideshow","slide_key='".addslashes($_GET['key'])."'");
		break;
	case "show_card_count" : $card_count = $getdata->my_sql_show_rows("card_info","card_status <> '' AND card_status <> 'hidden'");
		if($card_count != 0){
			echo @number_format($card_count);
		}
		break;
		
		

	}