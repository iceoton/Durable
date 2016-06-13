<?php session_start();?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Print Member History</title>
<link href="../../css/bootstrap.min.css" rel="stylesheet">
 <link href="../../css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/iconset/ios7-set-filled-1/flaticon.css" rel="stylesheet" type="text/css">
     <link href="../../css/sb-admin-2.css" rel="stylesheet">

</head>
<?php
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$getdata->my_sql_set_utf8();
$system_info = $getdata->my_sql_query(NULL,"system_info",NULL);
date_default_timezone_set($system_info->time_zone);
if(@addslashes($_GET['lang'])!=NULL){
	require("../../language/".@addslashes($_GET['lang'])."/site.lang");
	$langx = @addslashes($_GET['lang']);
}else{
	require("../../language/th/site.lang");
	$langx = 'th';
	

}
$getmember_detail = $getdata->my_sql_query(NULL,"member","member_key='".addslashes($_GET['key'])."'");
?>
<style type="text/css">
body{
	font-family:'thaisansliter1',sans-serif;
	font-size:13px;
}
.bill_header{
	font-size:17px;
	font-weight:bold;
}
.bill_content{
	font-size:13px;
	color:#666;
}
.logox{
	min-height:90px;
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
                           <?php echo @LA_LB_CUSTOMER_DETAIL;?>
                          
                        </div>
                        <div class="table-responsive">
                        <table width="100%" border="0" class="table">
  <tr>
    <td width="38%"><strong><?php echo @LA_LB_NAME_CHECKIN;?></strong></td>
    <td width="41%">&nbsp;<?php echo @$getmember_detail->member_name.'&nbsp;&nbsp;&nbsp;'.$getmember_detail->member_lastname;?></td>
    <td width="21%" rowspan="3" align="center"><div class="box_img_cycle"><img src="../../resource/members/thumbs/<?php echo @$getmember_detail->member_photo;?>" id="img_cycle" <?php echo getPhotoSize('../../resource/members/thumbs/'.@$getmember_detail->member_photo.'');?> alt=""/></div></td>
  </tr>
  <tr>
    <td><strong><?php echo @LA_LB_PID;?></strong></td>
    <td>&nbsp;<?php echo @$getmember_detail->member_pid;?></td>
    </tr>
  <tr>
    <td><strong><?php echo @LA_LB_ADDRESS;?></strong></td>
    <td>&nbsp;<?php echo @$getmember_detail->member_address;?></td>
    </tr>
  <tr>
    <td><strong><?php echo @LA_LB_PHONE;?></strong></td>
    <td colspan="2">&nbsp;<?php echo @$getmember_detail->member_tel;?></td>
  </tr>
  <tr>
    <td><strong><?php echo @LA_LB_EMAIL;?></strong></td>
    <td colspan="2">&nbsp;<?php echo @$getmember_detail->member_email;?></td>
  </tr>
 
</table>

                        </div>
                       
</div>
 <div class="panel panel-green">
                        <div class="panel-heading">
                            <?php echo @LA_LB_HISTORY_CHECKIN_OF;?> <?php echo @$getmember_detail->member_name.'&nbsp;&nbsp;&nbsp;'.$getmember_detail->member_lastname;?>
                        </div>
                        <div class="table-responsive">
                            <table width="100%" border="0" class="table table-hover table-bordered">
                      <thead>
  <tr>
    <td width="3%" align="center" bgcolor="#CCCCCC"><strong>#</strong></td>
    <td width="32%" align="center" bgcolor="#CCCCCC"><strong><?php echo @LA_LB_START_DATE;?></strong></td>
    <td width="21%" align="center" bgcolor="#CCCCCC"><strong><?php echo @LA_LB_ROOM_NAME;?></strong></td>
    <td width="19%" align="center" bgcolor="#CCCCCC"><strong><?php echo @LA_LB_STATUS;?></strong></td>
    <td width="25%" align="center" bgcolor="#CCCCCC"><strong><?php echo @LA_LB_USER;?></strong></td>
    </tr>
  </thead>
  <tbody>
  <?php
  $i=0;
  $getneed_checkin_today=$getdata->my_sql_select(NULL,"booking,member,bed","booking.member_key='".addslashes($_GET['key'])."' AND booking.member_key=member.member_key AND booking.bed_key=bed.bed_key ORDER BY booking.booking_insert");
  while($showneed_checkin_today = mysql_fetch_object($getneed_checkin_today)){
	  $i++;
  ?>
  <tr>
    <td rowspan="2" align="center"><?php echo @$i;?></td>
    <td rowspan="2" align="center"><strong><?php echo @dateOnlyConvertor($showneed_checkin_today->booking_start_date,$system_info->year_type,$system_info->year_format).' - '.dateOnlyConvertor($showneed_checkin_today->booking_end_date,$system_info->year_type,$system_info->year_format).' ('.dateCount($showneed_checkin_today->booking_start_date,$showneed_checkin_today->booking_end_date).' '.LA_LB_NIGHT.')';?></strong></td>
    <td rowspan="2" align="center"><?php echo @$showneed_checkin_today->bed_name;?></td>
    <td align="center"><strong><?php echo @$showneed_checkin_today->booking_code;?></strong></td>
    <td rowspan="2" align="center"><?php $getuserx = $getdata->my_sql_query("name,lastname","user","user_key='".$showneed_checkin_today->user_key."'"); echo $getuserx->name.'&nbsp;&nbsp;&nbsp;&nbsp;'.$getuserx->lastname;?></td>
    </tr>
  <tr>
    <td align="center"><?php echo @bookingStatus($showneed_checkin_today->booking_key);?></td>
    </tr>
  
  <?php
  }
  ?>
  </tbody>
</table>
                        </div>
                        </div>
                        <div class="footerx"></div>

</body>
</html>
<script language="javascript">
	window.onfocus = function(){
		window.close();
	}
</script>