<?php
date_default_timezone_set('Asia/Bangkok');
//------------ in use -------------

function updateDateNow(){
	$getdata = new clear_db();
	$getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$getdata->my_sql_set_utf8();
	$gety = $getdata->my_sql_query("month","autonumber",NULL);
	if(date("m") != $gety->month){
		$getdata->my_sql_update("autonumber","item_number='1',finance_number='1',quotation_number='1',invoice_number='1',year='".date("Y")."',month='".date("m")."',day='".date("d")."'",NULL);
	}else{
		$getdata->my_sql_update("autonumber","year='".date("Y")."',month='".date("m")."',day='".date("d")."'",NULL);
	}
	
}
function INumber(){
	$getdata = new clear_db();
	$getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$getdata->my_sql_set_utf8();
	$getlynda = $getdata->my_sql_query(NULL,"autonumber",NULL);
	return substr($getlynda->year,2,2).$getlynda->month.$getlynda->item_number;
}
function updateItem(){
	$getdata = new clear_db();
	$getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$getdata->my_sql_set_utf8();
	$getdata->my_sql_update("autonumber","`item_number`=`item_number`+1",NULL);
}
function memberNumber(){
	$getdata = new clear_db();
	$getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$getdata->my_sql_set_utf8();
	$getlynda = $getdata->my_sql_query(NULL,"autonumber",NULL);
	return ($getlynda->year+543).$getlynda->member_number;
}
function updateMember(){
	$getdata = new clear_db();
	$getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$getdata->my_sql_set_utf8();
	$getdata->my_sql_update("autonumber","`member_number`=`member_number`+1",NULL);
}
function financeNumber(){
	$getdata = new clear_db();
	$getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$getdata->my_sql_set_utf8();
	$getlynda = $getdata->my_sql_query(NULL,"autonumber",NULL);
	return 'REC'.$getlynda->year.$getlynda->month.$getlynda->finance_number;
}
function updateFinance(){
	$getdata = new clear_db();
	$getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$getdata->my_sql_set_utf8();
	$getdata->my_sql_update("autonumber","`finance_number`=`finance_number`+1",NULL);
}
function importNumber(){
	$getdata = new clear_db();
	$getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$getdata->my_sql_set_utf8();
	$getlynda = $getdata->my_sql_query(NULL,"autonumber",NULL);
	return 'LOT'.$getlynda->year.$getlynda->month.$getlynda->import_number;
}
function updateImport(){
	$getdata = new clear_db();
	$getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$getdata->my_sql_set_utf8();
	$getdata->my_sql_update("autonumber","`import_number`=`import_number`+1",NULL);
}
function dateConvertor($date){
	$epd = explode("-",$date);
		$Y=$epd[0]+543;
		return $epd[2]."/".$epd[1]."/".$Y;
	
}
function dateConvertorAD($date){
	return date("F d, Y", strtotime($date));
	
}
function dateTimeConvertor($datetime){
	$epd = explode(" ",$datetime);
	$date = new DateTime($epd[0]);
	$exptime = explode(":",$epd[1]);
	$date->setTime($exptime[0],$exptime[1],$exptime[2]);
	$Y=$epd[0]+543;
	return $date->format("d/m/$Y H:i:s");
}
function dateOnlyConvertor($datetime){
	$epd = explode(" ",$datetime);
	$epx = explode("-",$epd[0]);
	return $epx[2].'/'.$epx[1].'/'.$epx[0];
}
function substr_word($body,$maxlength){
    if (strlen($body)<$maxlength) return $body;
    $body = substr($body, 0, $maxlength);
    $rpos = strrpos($body,' ');
    if ($rpos>0) $body = substr($body, 0, $rpos);
    return $body;
}
function convertToLanguage($dis_thai,$dis_eng,$dis_now){
	if($dis_now == "en"){
		if($dis_eng == NULL){
			return $dis_thai;
		}else{
			return $dis_eng;
		}
	}else{
		if($dis_thai == NULL){
			return $dis_eng;
		}else{
			return $dis_thai;
		}
	}
}
function convertPoint($value,$point){
	if($value != NULL){
		return number_format($value,$point, '.', '');
	}else{
		return NULL;
	}
}
function convertPoint2($value,$point){
	if($value != NULL){
		return number_format($value,$point, '.', ',');
	}else{
		return number_format(0,$point, '.', ',');
	}
}
function resizeProductThumb($imgext,$imgname){
	switch($imgext){
		case "jpg" :
		case "jpeg" : 		$images = "../resource/products/images/".$imgname;
							$new_images = "../resource/products/thumbs/".$imgname;
						
					
							$width=400; //*** Fix Width & Heigh (Auto caculate) ***//
							$size=GetimageSize($images);
							$height=round($width*$size[1]/$size[0]);
							$images_orig = ImageCreateFromJPEG($images);
							$photoX = ImagesX($images_orig);
							$photoY = ImagesY($images_orig);
							$images_fin = ImageCreateTrueColor($width, $height);
							ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
							ImageJPEG($images_fin,$new_images);
							ImageDestroy($images_fin);
			break;
			case "png" : 	$images = "../resource/products/images/".$imgname;
							$new_images = "../resource/products/thumbs/".$imgname;
						
					
							$width=400; //*** Fix Width & Heigh (Auto caculate) ***//
							$size=GetimageSize($images);
							$height=round($width*$size[1]/$size[0]);
							$images_orig = ImageCreateFromPNG($images);
							$photoX = ImagesX($images_orig);
							$photoY = ImagesY($images_orig);
							$images_fin = ImageCreateTrueColor($width, $height);
							ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
							ImagePNG($images_fin,$new_images);
			break;
			case "gif"	:	$images = "../resource/products/images/".$imgname;
							$new_images = "../resource/products/thumbs/".$imgname;
					
					
							$width=400; //*** Fix Width & Heigh (Auto caculate) ***//
							$size=GetimageSize($images);
							$height=round($width*$size[1]/$size[0]);
							$images_orig = ImageCreateFromGIF($images);
							$photoX = ImagesX($images_orig);
							$photoY = ImagesY($images_orig);
							$images_fin = ImageCreateTrueColor($width, $height);
							ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
							ImageGIF($images_fin,$new_images);
			break;
			default : $images = "../resource/products/images/".$imgname;
							$new_images = "../resource/products/thumbs/".$imgname;
						
					
							$width=400; //*** Fix Width & Heigh (Auto caculate) ***//
							$size=GetimageSize($images);
							$height=round($width*$size[1]/$size[0]);
							$images_orig = ImageCreateFromJPEG($images);
							$photoX = ImagesX($images_orig);
							$photoY = ImagesY($images_orig);
							$images_fin = ImageCreateTrueColor($width, $height);
							ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
							ImageJPEG($images_fin,$new_images);
							ImageDestroy($images_fin);
							
	}
	
}
function resizeMemberThumb($imgext,$imgname){
	switch($imgext){
		case "jpg" :
		case "jpeg" : 		$images = "../resource/members/images/".$imgname;
							$new_images = "../resource/members/thumbs/".$imgname;
						
					
							$width=250; //*** Fix Width & Heigh (Auto caculate) ***//
							$size=GetimageSize($images);
							$height=round($width*$size[1]/$size[0]);
							$images_orig = ImageCreateFromJPEG($images);
							$photoX = ImagesX($images_orig);
							$photoY = ImagesY($images_orig);
							$images_fin = ImageCreateTrueColor($width, $height);
							ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
							ImageJPEG($images_fin,$new_images);
							ImageDestroy($images_fin);
			break;
			case "png" : 	$images = "../resource/members/images/".$imgname;
							$new_images = "../resource/members/thumbs/".$imgname;
						
					
							$width=250; //*** Fix Width & Heigh (Auto caculate) ***//
							$size=GetimageSize($images);
							$height=round($width*$size[1]/$size[0]);
							$images_orig = ImageCreateFromPNG($images);
							$photoX = ImagesX($images_orig);
							$photoY = ImagesY($images_orig);
							$images_fin = ImageCreateTrueColor($width, $height);
							ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
							ImagePNG($images_fin,$new_images);
			break;
			case "gif"	:	$images = "../resource/members/images/".$imgname;
							$new_images = "../resource/members/thumbs/".$imgname;
					
					
							$width=250; //*** Fix Width & Heigh (Auto caculate) ***//
							$size=GetimageSize($images);
							$height=round($width*$size[1]/$size[0]);
							$images_orig = ImageCreateFromGIF($images);
							$photoX = ImagesX($images_orig);
							$photoY = ImagesY($images_orig);
							$images_fin = ImageCreateTrueColor($width, $height);
							ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
							ImageGIF($images_fin,$new_images);
			break;
			default : $images = "../resource/members/images/".$imgname;
							$new_images = "../resource/members/thumbs/".$imgname;
						
					
							$width=250; //*** Fix Width & Heigh (Auto caculate) ***//
							$size=GetimageSize($images);
							$height=round($width*$size[1]/$size[0]);
							$images_orig = ImageCreateFromJPEG($images);
							$photoX = ImagesX($images_orig);
							$photoY = ImagesY($images_orig);
							$images_fin = ImageCreateTrueColor($width, $height);
							ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
							ImageJPEG($images_fin,$new_images);
							ImageDestroy($images_fin);
							
	}
	
}
function resizeUserThumb($imgext,$imgname){
	switch($imgext){
		case "jpg" :
		case "jpeg" : 		$images = "../resource/users/images/".$imgname;
							$new_images = "../resource/users/thumbs/".$imgname;
						
					
							$width=250; //*** Fix Width & Heigh (Auto caculate) ***//
							$size=GetimageSize($images);
							$height=round($width*$size[1]/$size[0]);
							$images_orig = ImageCreateFromJPEG($images);
							$photoX = ImagesX($images_orig);
							$photoY = ImagesY($images_orig);
							$images_fin = ImageCreateTrueColor($width, $height);
							ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
							ImageJPEG($images_fin,$new_images);
							ImageDestroy($images_fin);
			break;
			case "png" : 	$images = "../resource/users/images/".$imgname;
							$new_images = "../resource/users/thumbs/".$imgname;
						
					
							$width=250; //*** Fix Width & Heigh (Auto caculate) ***//
							$size=GetimageSize($images);
							$height=round($width*$size[1]/$size[0]);
							$images_orig = ImageCreateFromPNG($images);
							$photoX = ImagesX($images_orig);
							$photoY = ImagesY($images_orig);
							$images_fin = ImageCreateTrueColor($width, $height);
							ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
							ImagePNG($images_fin,$new_images);
			break;
			case "gif"	:	$images = "../resource/users/images/".$imgname;
							$new_images = "../resource/users/thumbs/".$imgname;
					
					
							$width=250; //*** Fix Width & Heigh (Auto caculate) ***//
							$size=GetimageSize($images);
							$height=round($width*$size[1]/$size[0]);
							$images_orig = ImageCreateFromGIF($images);
							$photoX = ImagesX($images_orig);
							$photoY = ImagesY($images_orig);
							$images_fin = ImageCreateTrueColor($width, $height);
							ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
							ImageGIF($images_fin,$new_images);
			break;
			default : $images = "../resource/users/images/".$imgname;
							$new_images = "../resource/users/thumbs/".$imgname;
						
					
							$width=250; //*** Fix Width & Heigh (Auto caculate) ***//
							$size=GetimageSize($images);
							$height=round($width*$size[1]/$size[0]);
							$images_orig = ImageCreateFromJPEG($images);
							$photoX = ImagesX($images_orig);
							$photoY = ImagesY($images_orig);
							$images_fin = ImageCreateTrueColor($width, $height);
							ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
							ImageJPEG($images_fin,$new_images);
							ImageDestroy($images_fin);
							
	}
	
}

function accessModule($module_key,$return_value){
	$getdata = new clear_db();
	$getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$getdata->my_sql_set_utf8();
	$getmodule_status = $getdata->my_sql_show_rows("modules","module_key='".$module_key."' AND module_status='1'");
	if($getmodule_status != 1){
		return '';
	}else{
		return $return_value;
	}
}
function updateCenter($user_version,$update_url){
	$getdata = new clear_db();
	$getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$getdata->my_sql_set_utf8();
	$curlurl = $update_url."check/getversion.php";
	$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
	$params = "uv=".$user_version; 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST,1); // method ที่เราจะส่ง เป็น get หรือ post
	curl_setopt($ch, CURLOPT_POSTFIELDS,$params); // paremeter สำหรับส่งไปยังไฟล์ ที่กำหนด
	curl_setopt($ch, CURLOPT_URL,$curlurl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

	$result = curl_exec($ch); // ผลการ execute กลับมาเป็น ข้อมูลใน url ที่เรา ส่งคำร้องขอไป
	curl_close ($ch);
	if($result == "update"){
		$getdata->my_sql_update("system_info","system_need_update='1'",NULL);
	}else{
		$getdata->my_sql_update("system_info","system_need_update='0'",NULL);
	}
	return $result;
}
function resizeSlideThumb($imgname){
	$images = "../resource/link/slide/images/".$imgname;
	$new_images = "../resource/link/slide/thumbs/".$imgname;

		$width=240; //*** Fix Width & Heigh (Auto caculate) ***//
		$size=GetimageSize($images);
		$height=round($width*$size[1]/$size[0]);
		$images_orig = ImageCreateFromJPEG($images);
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);
		$images_fin = ImageCreateTrueColor($width, $height);
  		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		ImageJPEG($images_fin,$new_images);
		ImageDestroy($images_fin);
}
function ClearProductsCareNumber($serial){
	$set1 = substr($serial, 0, 4);
	$set2 = substr($serial, 4, 4);
	$set3 = substr($serial, 8, 4);
	$set4 = substr($serial, 12, 4);
	return $set1.' &ndash; '.$set2.' &ndash; '.$set3.' &ndash; '.$set4;
}
function getPhotoSize($photo){
	$size=GetimageSize($photo);
	if($size[0] > $size[1]){
		return 'height="50%"';
	}else if($size[0] < $size[1]){
		return 'width="50%"';
	}else{
		return 'height="50%" width="50%"';
	}
}

function RandomString($password_pattern,$password_prefix,$password_length)
{
	if($password_pattern == 1){
		$characters = '0123456789';
	}else if($password_pattern == 2){
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	}else if($password_pattern == 3){
		$characters = 'abcdefghijklmnopqrstuvwxyz';
	}else if($password_pattern == 4){
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	}else if($password_pattern == 5){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	}else if($password_pattern == 6){
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	}else{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	}
    
    $randstring = '';
    for ($i = 0; $i < $password_length; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
	if($randstring < $password_length){
		$randstring = '';
		 for ($i = 0; $i < $password_length; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
		return $password_prefix.$randstring;
	}else{
		return $password_prefix.$randstring;
	}
    
}
function cardStatus($card_status){
	$getdata = new clear_db();
	$getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$getdata->my_sql_set_utf8();
	$getall_status=$getdata->my_sql_select(NULL,"card_type","ctype_status='1'");
	while($showall_status = mysql_fetch_object($getall_status)){
		if($card_status == $showall_status->ctype_key){
			return '<span class="label" style="background:'.$showall_status->ctype_color.'">'.$showall_status->ctype_name.'</span>';
		}else if($card_status == ''){
			return '<span class="label  label-default" >ข้อมูลไม่สมบูรณ์</span>';
		}else if($card_status == 'hidden'){
			return '<span class="label  label-danger" >ข้อมูลถูกซ่อน</span>';
		}
	}
}
function url(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
	
    $full = $protocol . "://" . $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
	$cut = str_replace('dashboard/card/print_card.php','card.php?key=',$full);
	return $cut;
}
?>