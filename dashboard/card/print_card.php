<?php session_start();error_reporting();?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$getdata->my_sql_set_utf8();
date_default_timezone_set('Asia/Bangkok');
$card_detail = $getdata->my_sql_query(NULL,"card_info","card_key='".addslashes($_GET['key'])."'");
  //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = '../../plugins/phpqrcode/temp/';
    $PNG_WEB_DIR = '../../plugins/phpqrcode/temp/';
    require("../../plugins/phpqrcode/qrlib.php");    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);

        $filename = '../../plugins/phpqrcode/temp/card'.md5(@url().$card_detail->card_code.'|'.'H'.'|'.'2').'.png';
        QRcode::png(@url().$card_detail->card_code, $filename, 'H', 2, 2);    
        
?>
<title><?php echo @$card_detail->card_code;?></title>
<link href="../../css/bootstrap.min.css" rel="stylesheet">
 <link href="../../css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/iconset/ios7-set-filled-1/flaticon.css" rel="stylesheet" type="text/css">
     <link href="../../css/sb-admin-2.css" rel="stylesheet">

</head>
<style type="text/css">
body{
	font-family:'thaisansliter1',sans-serif;
	font-size:14px;
}

@media print {
    .footerx{page-break-after: always;}
	body {-webkit-print-color-adjust: exact;}
	
}

</style>

<!--   onLoad="javascript:window.print();" -->
<body onLoad="javascript:window.print();">
<div class="panel panel-primary">
 <div class="panel-heading">
                            รายละเอียดผู้ส่งซ่อม/เคลม
                        </div>
                        <div class="panel-body">
                        <table width="100%" border="0" class="table">
  <tr>
    <td width="23%"><strong>วันที่</strong></td>
    <td width="27%"><?php echo @dateTimeConvertor($card_detail->card_insert);?></td>
    <td colspan="2" rowspan="4" style="text-align:center"> สแกนเพื่อตรวจสอบสถานะ<br/><?php echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><br/>'; echo @url().$card_detail->card_code;  ?><div class="box_barcode"><img src="../../plugins/barcode/barcode.php?text=<?php echo @$card_detail->card_code;?>&orientation=orientation" alt="<?php echo @$card_detail->card_code;?>" width="20" height="120" class="img_barcode" /></div></td>
    </tr>
  <tr>
    <td><strong>รหัสการส่งซ่อม/เคลม</strong></td>
    <td><?php echo @$card_detail->card_code;?></td>
    </tr>
  <tr>
    <td><strong>ชื่อผู้ส่งซ่อม</strong></td>
    <td><?php echo @$card_detail->card_customer_name.'&nbsp;&nbsp;&nbsp;'.$card_detail->card_customer_lastname;?></td>
    </tr>
  <tr>
    <td><strong>ที่อยู่</strong></td>
    <td><?php echo @$card_detail->card_customer_address;?></td>
    </tr>
  <tr>
    <td><strong>โทร</strong></td>
    <td><?php echo @$card_detail->card_customer_phone;?></td>
    <td width="23%"><strong>อีเมล</strong></td>
    <td width="27%"><?php echo @$card_detail->card_customer_email;?></td>
  </tr>
  <tr>
    <td><strong>หมายเหตุ</strong></td>
    <td><?php echo @$card_detail->card_note;?></td>
    <td><strong>เจ้าหน้าที่</strong></td>
    <td><?php $getuserx = $getdata->my_sql_query("name,lastname","user","user_key='".$card_detail->user_key."'"); echo $getuserx->name.'&nbsp;&nbsp;&nbsp;&nbsp;'.$getuserx->lastname;?></td>
    </tr>
                        </table>

                          <table width="100%"  class="table table-bordered">
                          <thead>
  <tr style="font-weight:bold; color:#FFF; background:#888888; text-align:center;">
    <td width="11%">หมายเลข</td>
    <td width="26%">ชื่อรายการ</td>
    <td width="43%">สาเหตุที่ส่งซ่อม/เคลม</td>
    <td width="20%">ราคาโดยประมาณ</td>
    </tr>
    </thead>
    <tbody>
 <?php 
	$getitem = $getdata->my_sql_select(NULL,"card_item","card_key='".$card_detail->card_key."' ORDER BY item_insert");
	while($showitem = mysql_fetch_object($getitem)){
	?>
  <tr id="<?php echo @$showitem->item_key;?>">
    <td align="center" bgcolor="#EFEFEF"><?php echo @$showitem->item_number;?></td>
    <td><?php echo @$showitem->item_name;?></td>
    <td style="color:#970002;"><?php echo @$showitem->item_note;?></td>
    <td align="right"><?php echo @($showitem->item_price_aprox == 0)?'ไม่ระบุ':convertPoint2($showitem->item_price_aprox,2);?></td>
   
    </tr>
    <?php
	}
	?>
    </tbody>
</table>

                        
                           <div class="row form-group" style="text-align:center">
                       <div class="col-xs-5">(............................................)</div>
                       <div class="col-xs-2"></div>
                       <div class="col-xs-5">(............................................)</div>
                       </div>
                       <div class="row form-group" style="text-align:center">
                       <div class="col-xs-5">ผู้ส่งซ่อม/เคลม</div>
                       <div class="col-xs-2"></div>
                       <div class="col-xs-5">เจ้าหน้าที่</div>
                       </div>
                        </div>
                       
                    </div>

<div class="footerx"></div>
                   
</body>
</html>
<script language="javascript">
/*	window.onfocus = function(){
		window.close();
	}*/
</script>