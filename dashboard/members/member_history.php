<?php
$getmember_detail = $getdata->my_sql_query(NULL,"member","member_key='".addslashes($_GET['key'])."'");
?>
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-list fa-fw"></i> <?php echo @LA_LB_HISTORY_CHECKIN;?></h1>
     </div>        
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li><a href="?p=member"><?php echo @LA_MN_MEMBERS;?></a></li>
  <li class="active"><?php echo @LA_LB_HISTORY_CHECKIN;?></li>
</ol>
<div class="panel panel-primary">
                        <div class="panel-heading">
                           <?php echo @LA_LB_CUSTOMER_DETAIL;?>                          
                        </div>
                        <div class="table-responsive">
                        <table width="100%" border="0" class="table">
  <tr>
    <td width="38%"><strong><?php echo @LA_LB_NAME_CHECKIN;?></strong></td>
    <td width="41%">&nbsp;<?php echo @$getmember_detail->member_name.'&nbsp;&nbsp;&nbsp;'.$getmember_detail->member_lastname;?></td>
    <td width="21%" rowspan="3" align="center"><div class="box_img_cycle"><img src="../resource/members/thumbs/<?php echo @$getmember_detail->member_photo;?>" id="img_cycle" <?php echo getPhotoSize('../resource/members/thumbs/'.@$getmember_detail->member_photo.'');?> alt=""/></div></td>
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
    <td rowspan="2" align="center"><strong><?php echo @dateOnlyConvertor($showneed_checkin_today->booking_start_date,$system_info->year_type,$system_info->year_format).' - '.dateOnlyConvertor($showneed_checkin_today->booking_end_date,$system_info->year_type,$system_info->year_format).' ('.dateCount($showneed_checkin_today->booking_start_date,$showneed_checkin_today->booking_end_date).' '.@LA_LB_NIGHT.')';?></strong></td>
    <td rowspan="2" align="center"><?php echo @$showneed_checkin_today->bed_name;?></td>
    <td align="center"><strong><a href="?p=search_code&keyword=<?php echo @$showneed_checkin_today->booking_code;?>"><?php echo @$showneed_checkin_today->booking_code;?></a></strong></td>
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
                        <div class="panel-footer">
                            <a href="members/print_member_history.php?key=<?php echo @$getmember_detail->member_key;?>&lang=en" class="btn btn-sm btn-warning" target="_blank" style="color:#FFF;"><i class="fa fa-print"></i> <?php echo @LA_BTN_PRINT_EN;?></a><a href="members/print_member_history.php?key=<?php echo @$getmember_detail->member_key;?>&lang=th" class="btn btn-sm btn-warning" target="_blank" style="color:#FFF;"><i class="fa fa-print"></i> <?php echo @LA_BTN_PRINT_TH;?></a>
                        </div>
</div>