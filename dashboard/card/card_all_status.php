<?php
if(addslashes($_GET['key']) == NULL){
	echo '<script>window.location="?p=card_create";</script>';
}else{
	$card_detail = $getdata->my_sql_query(NULL,"card_info","card_key='".addslashes($_GET['key'])."'");
}
?>
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-history fa-fw"></i> ประวัติการบันทึกสถานะ [<?php echo @$card_detail->card_code;?>]</h1>
     </div>        
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
<li><a href="?p=card">รายการส่งซ่อม/เคลม</a></li>
  <li class="active">ประวัติการบันทึกสถานะ [<?php echo @$card_detail->card_code;?>]</li>
</ol>
<!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#all_detail" data-toggle="tab">รายละเอียดใบสั่งซ่อม/เคลม</a>
                                </li>
                                <li><a href="#all_status" data-toggle="tab">ประวัติการอัพเดทสถานะ</a>
                                </li>
                              
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="all_detail"><br/>
                                   <div class="panel panel-primary">
 <div class="panel-heading">
                            รายละเอียดผู้ส่งซ่อม/เคลม<span class="pull-right"><a href="?p=card_create_detail&key=<?php echo @$card_detail->card_key;?>" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> แก้ไข</a></span>
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
                             <div class="col-md-3"><strong>หมายเหตุ</strong></div>
                             <div class="col-md-3"><?php echo @$card_detail->card_note;?></div>
                              
                              </div>
                              <div class="row form-group">
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
                                <div class="tab-pane fade" id="all_status"><br/>
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
                              
                            </div>
 