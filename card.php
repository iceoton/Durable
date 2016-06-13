<?php session_start();?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
require("core/config.core.php");
require("core/connect.core.php");
require("core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$getdata->my_sql_set_utf8();
date_default_timezone_set('Asia/Bangkok');
$system_info = $getdata->my_sql_query(NULL,"system_info",NULL);
$card_detail = $getdata->my_sql_query(NULL,"card_info","card_code='".addslashes($_GET['key'])."'");

?>
<title><?php echo @$card_detail->card_code;?></title>
<link rel="shortcut icon" href="media/favicon/<?php echo @$system_info->site_favicon;?>"/>
<link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/iconset/ios7-set-filled-1/flaticon.css" rel="stylesheet" type="text/css">
     <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<style type="text/css">
body{
	font-family:'thaisansliter1',sans-serif;
	margin:10px;
}


</style>
<!--   onLoad="javascript:window.print();" -->
<body>
<center>
 <img src="media/logo/<?php echo @$system_info->site_logo;?>" width="100" alt=""/> </div>
</center><br/>
<ul class="nav nav-tabs">
    <li class="active"><a href="#all_status" data-toggle="tab">ประวัติการอัพเดทสถานะ</a>
                                </li>
                                <li ><a href="#all_detail" data-toggle="tab">รายละเอียดใบสั่งซ่อม/เคลม</a>
                                </li>
                               
                              
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                             <div class="tab-pane fade in active" id="all_status"><br/>
                                    <div class="table-responsive">
                                   <table width="100%" border="0" class="table table-bordered">
                                   <thead>
  <tr style="font-weight:bold; color:#FFF; background:#006EBD; text-align:center;">
    <td width="17%">วันที่</td>
    <td width="17%">สถานะ</td>
    <td width="46%">หมายเหตุ</td>
    <td width="20%">ผู้บันทึกรายการ</td>
  </tr>
  </thead>
  <tbody>
  <?php
  $getcard_status = $getdata->my_sql_select(NULL,"card_status,card_type","card_status.card_key='".$card_detail->card_key."' AND card_status.card_status=card_type.ctype_key ORDER BY card_status.cstatus_insert DESC");
  while($showcard_status = mysql_fetch_object($getcard_status)){
  ?>
  <tr style="font-weight:bold;">
    <td align="center"><?php echo @dateTimeConvertor($showcard_status->cstatus_insert);?></td>
    <td align="center"><?php echo @cardStatus($showcard_status->card_status);?></td>
    <td>&nbsp;<?php echo @$showcard_status->card_status_note;?></td>
    <td align="center"><?php $getusery = $getdata->my_sql_query("name,lastname","user","user_key='".$showcard_status->user_key."'"); echo $getusery->name.'&nbsp;&nbsp;&nbsp;&nbsp;'.$getusery->lastname;?></td>
  </tr>
  <?php
  }
  ?>
  </tbody>
</table>

                                   </div>
                                
                                </div>
                              
                                <div class="tab-pane fade " id="all_detail"><br/>
                                   <div class="panel panel-primary">
 <div class="panel-heading">
                            รายละเอียดผู้ส่งซ่อม/เคลม
                        </div>
                        <div class="panel-body">
                            <div class="row form-group">
                            <div class="col-md-3"><strong>รหัสการส่งซ่อม/เคลม</strong></div>
                            <div class="col-md-3"><?php echo @$card_detail->card_code;?></div>
                            <div class="col-md-3"><strong>วันที่</strong></div>
                            <div class="col-md-3"><?php echo @dateTimeConvertor($card_detail->card_insert);?></div>
                            </div>
                            <div class="row form-group">
                            <div class="col-md-3"><strong>ชื่อผู้ส่งซ่อม</strong></div>
                            <div class="col-md-3"><?php echo @$card_detail->card_customer_name.'&nbsp;&nbsp;&nbsp;'.$card_detail->card_customer_lastname;?></div>
                             <div class="col-md-3"><strong>หมายเลขโทรศัพท์</strong></div>
                            <div class="col-md-3"><?php echo @$card_detail->card_customer_phone;?></div>
                            
                            </div>
                             <div class="row form-group">
                              <div class="col-md-3"><strong>ที่อยู่</strong></div>
                               <div class="col-md-3"><?php echo @$card_detail->card_customer_address;?></div>
                                <div class="col-md-3"><strong>อีเมล</strong></div>
                                 <div class="col-md-3"><?php echo @$card_detail->card_customer_email;?></div>
                             </div>
                             <div class="row form-group">
                             <div class="col-md-3"><strong>วันที่คาดว่าจะแล้วเสร็จ</strong></div>
                             <div class="col-md-3" style="color:#00BB32"><strong><?php echo @($card_detail->card_done_aprox != '0000-00-00')?dateConvertor($card_detail->card_done_aprox):'ไม่ระบุ';?></strong></div>
                             <div class="col-md-3"><strong>เจ้าหน้าที่</strong></div>
                             <div class="col-md-3"><?php $getuserx = $getdata->my_sql_query("name,lastname","user","user_key='".$card_detail->user_key."'"); echo $getuserx->name.'&nbsp;&nbsp;&nbsp;&nbsp;'.$getuserx->lastname;?></div>
                             </div>
                             <div class="table-responsive">
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
</div>
     </div>
 </div>
</div>
    </div>
 
                   
</body>
</html>
  <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>