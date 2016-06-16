<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-edit fa-fw"></i>  รายการครุภัณฑ์</h1>
     </div>
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active">ครุภัณฑ์</li>
</ol>
<?php
if(isset($_POST['save_card'])){
	if(addslashes($_POST['card_customer_name'])!= NULL && addslashes($_POST['card_customer_phone']) != NULL ){
		$card_key=md5(htmlentities($_POST['card_customer_name']).htmlentities($_POST['card_code']).time("now"));
		$getdata->my_sql_insert("card_info","card_key='".$card_key."',card_code='".htmlentities($_POST['card_code'])."',card_customer_name='".htmlentities($_POST['card_customer_name'])."',card_customer_lastname='".htmlentities($_POST['card_customer_lastname'])."',card_customer_address='".htmlentities($_POST['card_customer_address'])."',card_customer_phone='".htmlentities($_POST['card_customer_phone'])."',card_customer_email='".htmlentities($_POST['card_customer_email'])."',card_note='".htmlentities($_POST['card_note'])."',card_done_aprox='0000-00-00',user_key='".$user_data->user_key."',card_status=''");
		echo '<script>window.location="?p=card_create_detail&key='.$card_key.'";</script>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
	}
}
?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มครุภัณฑ์</h4>
                                        </div>
                                        <div class="modal-body">
                                          <!--<div class="form-group">
                                            <label for="card_code">รหัสของครุภัณฑ์</label>
                                            <input type="text" name="card_code" id="card_code" class="form-control" autofocus  autocomplete="off">
                                          </div> -->
                                          <div class="form-group row">
                                           	<div class="col-md-6">
                                           	  <label for="card_customer_name">รหัสครุภัณฑ์</label>
                                              <input type="text" name="card_asset_code" id="card_asset_code" class="form-control" autocomplete="off">
                                           	</div>
                                            <div class="col-md-6">
                                              <label for="card_customer_lastname">ชื่อครุภัณฑ์</label>
                                              <input type="text" name="card_asset_name" id="card_asset_name" class="form-control"  autocomplete="off">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="card_asset_detail">รายละเอียด</label>
                                            <textarea name="card_asset_detail" id="card_asset_detail" class="form-control"></textarea>
                                          </div>
                                          <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="card_asset_category">ประเภทสินทรัพย์</label>
                                              <input type="text" name="card_asset_category" id="card_asset_category" class="form-control"  autocomplete="off">
                                            </div>
                                            <div class="col-md-6">
                                              <label for="card_come_date">วันที่ได้มาครั้งแรก</label>
                                              <input type="text" name="card_come_date" id="card_come_date" class="form-control"  autocomplete="off">
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="card_asset_location">สถานที่ตั้ง</label>
                                              <input type="text" name="card_asset_location" id="card_asset_location" class="form-control"  autocomplete="off">
                                            </div>
                                            <div class="col-md-6">
                                              <label for="card_asset_source">แหล่งที่มา</label>
                                              <input type="text" name="card_asset_source" id="card_asset_source" class="form-control"  autocomplete="off">
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <div class="col-md-4">
                                              <label for="card_asset_status">สถานะ</label>
                                              <input type="text" name="card_asset_status" id="card_asset_status" class="form-control"  autocomplete="off">
                                            </div>
                                            <div class="col-md-4">
                                              <label for="card_asset_quantity">ปริมาณ</label>
                                              <input type="text" name="card_asset_quantity" id="card_asset_quantity" class="form-control"  autocomplete="off">
                                            </div>
                                            <div class="col-md-4">
                                              <label for="card_asset_unit">หน่วยนับ</label>
                                              <input type="text" name="card_asset_unit" id="card_asset_unit" class="form-control"  autocomplete="off">
                                            </div>
                                          </div>
                                          <!--<div class="form-group">
                                            <label for="card_note">หมายเหตุ</label>
                                            <textarea name="card_note" id="card_note" class="form-control"></textarea>
                                          </div> -->
                                      </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_card" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                </form>
                                <!-- /.modal-dialog -->
</div>
   <?php
   echo @$alert;?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><i class="fa fa-edit"></i></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
      <ul class="nav navbar-nav">
   <li><a data-toggle="modal" data-target="#myModal" style="cursor:pointer;"><i class="fa fa-plus"></i> เพิ่มครุภัณฑ์</a></li>
       </ul>

  <form class="navbar-form from-group navbar-right" role="search" method="get" action="?p=search">

    <input type="text" class="form-control" name="q" placeholder="ระบุชื่อครุภัณฑ์/รหัสครุภัณฑ์ เพื่อค้นหา" size="50" autofocus  autocomplete="off">
    <input type="hidden" name="p" id="p" value="search" >

</form>
</div>

  </div>
  </nav>
  <?php
   $getcard_count = $getdata->my_sql_show_rows("card_info","card_status = ''  ORDER BY card_insert");
   if($getcard_count != 0){
  ?>
  <div class="table-responsive">
  	<table width="100%" border="0" class="table table-bordered">
    <thead>
  <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
    <td width="5%">รหัสครุภัณฑ์</td>
    <td width="15%">ชื่อครุภัณฑ์</td>
    <td width="25%">รายละเอียด</td>
    <td width="5%">ประเภท</td>
    <td width="5%">วันที่ได้มาครั้งแรก</td>
    <td width="10%">สถานที่ตั้ง</td>
    <td width="10%">แหล่งที่มา</td>
    <td width="5%">สถานะ</td>
    <td width="5%">ปริมาณ</td>
    <td width="5%">หน่วยนับ</td>
    <td width="10%">จัดการ</td>
  </tr>
  </thead>
  <tbody>
  <?php
  $getcard = $getdata->my_sql_select(NULL,"card_info"," card_status = ''  ORDER BY card_insert");
  while($showcard = mysql_fetch_object($getcard)){
  ?>
  <tr style="font-weight:bold;" id="<?php echo @$showcard->card_key;?>">
    <td align="center"><?php echo @$showcard->card_code;?></td>
    <td align="center"><?php echo @dateTimeConvertor($showcard->card_insert);?></td>
    <td>&nbsp;<?php echo @$showcard->card_customer_name.'&nbsp;&nbsp;&nbsp;'.$showcard->card_customer_lastname;?></td>
    <td align="center"><?php echo @$showcard->card_customer_phone;?></td>
    <td align="center"><?php echo @cardStatus($showcard->card_status);?></td>
    <td align="center"><?php echo ""?></td>
    <td align="center"><?php echo ""?></td>
    <td align="center"><?php echo ""?></td>
    <td align="center"><?php echo ""?></td>
    <td align="center"><?php echo ""?></td>
    <td align="right"><a href="?p=card_create_detail&key=<?php echo @$showcard->card_key;?>" title="แก้ไข" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a><a onClick="javascript:deleteCard('<?php echo @$showcard->card_key;?>');" title="ลบข้อมูล" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
  </tr>
  <?php
  }
  ?>
  </tbody>

</table>

</div>
<?php
   }else{
	   echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ไม่พบข้อมูลครุภัณฑ์</div>';
   }
?>
<script language="javascript">
function deleteCard(cardkey){
	if(confirm('คุณต้องการลบครุภัณฑ์นี้ใช่หรือไม่ ?')){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(cardkey).innerHTML = '';
  		}
	}
	xmlhttp.open("GET","function.php?type=delete_card&key="+cardkey,true);
	xmlhttp.send();
	}
}
</script>
