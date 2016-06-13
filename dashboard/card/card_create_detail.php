<?php
if(htmlentities($_GET['key']) == NULL){
	echo '<script>window.location="?p=card_create";</script>';
}else{
	$card_detail = $getdata->my_sql_query(NULL,"card_info","card_key='".htmlentities($_GET['key'])."'");
	updateDateNow();
}
?>
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-edit fa-fw"></i> เพิ่มรายการส่งซ่อม/เคลม [<?php echo @$card_detail->card_code;?>]</h1>
     </div>        
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
<li><a href="?p=card_create">ส่งซ่อมสินค้า/เคลม</a></li>
  <li class="active">เพิ่มรายการส่งซ่อม/เคลม [<?php echo @$card_detail->card_code;?>]</li>
</ol>
<?php
if(isset($_POST['save_item'])){
	if(htmlentities($_POST['item_name']) != NULL && htmlentities($_POST['item_note']) != NULL){
		$item_key = md5(htmlentities($_POST['item_name']).time("now").rand());
		if(htmlentities($_POST['item_price_aprox']) != NULL){
			$price_aprox = htmlentities($_POST['item_price_aprox']);
		}else{
			$price_aprox=0;
		}
		
		
		$getdata->my_sql_insert("card_item","item_key='".$item_key."',card_key='".$card_detail->card_key."',item_number='".INumber()."',item_name='".htmlentities($_POST['item_name'])."',item_note='".@htmlentities($_POST['item_note'])."',item_price_aprox='".@$price_aprox."'");
		updateItem();
		$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>บันทึกข้อมูล สำเร็จ !</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
	}
}
if(isset($_POST['save_edit_item'])){
	if(htmlentities($_POST['edit_item_name']) != NULL && htmlentities($_POST['edit_item_note']) != NULL){
		$getdata->my_sql_update("card_item","item_name='".htmlentities($_POST['edit_item_name'])."',item_note='".htmlentities($_POST['edit_item_note'])."',item_price_aprox='".@htmlentities($_POST['edit_item_price_aprox'])."'","item_key='".htmlentities($_POST['item_key'])."'");
		$alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>อัพเดทข้อมูล สำเร็จ !</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
	}
}
if(isset($_POST['save_confirm_card'])){
	if(htmlentities($_POST['card_done_aprox']) != NULL){
		$card_done_aprox = htmlentities($_POST['card_done_aprox']);
	}else{
		$card_done_aprox = '0000-00-00';
	}
	$getdata->my_sql_update("card_info","card_done_aprox='".@$card_done_aprox."',card_status='".htmlentities($_REQUEST['card_status'])."',user_key='".$userdata->user_key."'","card_key='".$card_detail->card_key."'");
	$cstatus_key=md5(htmlentities($_REQUEST['card_status']).rand().time("now"));
	$getdata->my_sql_insert("card_status","cstatus_key='".$cstatus_key."',card_key='".$card_detail->card_key."',card_status='".htmlentities($_REQUEST['card_status'])."',card_status_note='".htmlentities($_POST['card_status_note'])."',user_key='".$userdata->user_key."'");
	echo '<script>alert("บันทึกข้อมูล สำเร็จ !");window.open("card/print_card.php?key='.$card_detail->card_key.'", "_blank");window.location="?p=card";</script>';
}
?>
<!-- Modal Edit -->
<div class="modal fade" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" name="form2" id="form2">
     
     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel">ข้อมูลรายการ</h4>
                </div>
                <div class="ct">
              
                </div>
            </div>
        </div>
  </form>
</div>
<!-- Modal -->
<div class="modal fade" id="create_card" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">ยืนยันข้อมูล</h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="form-group">
                                            <label for="card_done_aprox">วันที่คาดว่าจะแล้วเสร็จ</label>
                                            <input type="text" name="card_done_aprox" id="card_done_aprox" class="form-control dpk"  autocomplete="off">
                                          </div>
                                           
                                           <div class="form-group">
                                             <label for="card_status">สถานะปัจจุบัน</label>
                                             <select name="card_status" id="card_status" class="form-control">
                                             <?php
											 $getcard_type = $getdata->my_sql_select(NULL,"card_type","ctype_status='1' ORDER BY ctype_insert");
											 while($showcard_type = mysql_fetch_object($getcard_type)){
												 if($showcard_type->ctype_key == '89da7d193f3c67e4310f50cbb5b36b90'){
													   echo '<option value="'.$showcard_type->ctype_key.'" selected>'.$showcard_type->ctype_name.'</option>';
												 }else{
													  echo '<option value="'.$showcard_type->ctype_key.'">'.$showcard_type->ctype_name.'</option>';
												 }
											 }
											 ?>
                                             </select>
                                           </div>
                                           <div class="form-group">
                                             <label for="card_status_note">หมายเหตุสถานะ</label>
                                             <textarea name="card_status_note" id="card_status_note" class="form-control"></textarea>
                                           </div>
                                     </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_confirm_card" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                </form>
                                <!-- /.modal-dialog -->
</div>
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
                          
                        </div>
                       
                    </div>
                    <?php echo @$alert;?>
<div class="panel panel-green">
                        <div class="panel-heading">
                            รายละเอียดสินค้าที่ส่งซ่อม/เคลม
  </div>
                       
                          <form id="form1" name="form1" method="post">
                           <div class="table-responsive">
                           <table width="100%"  class="table table-bordered">
  <tr>
    <td colspan="2"><label for="item_name">ชื่อรายการ</label>
      <input type="text" name="item_name" id="item_name" class="form-control" autofocus></td>
    <td width="44%"><label for="item_note">สาเหตุที่ส่งซ่อม/เคลม</label>
      <input type="text" name="item_note" id="item_note" class="form-control"></td>
    <td width="15%"><label for="item_price_aprox">ราคาโดยประมาณ</label>
      <input type="text" name="item_price_aprox" id="item_price_aprox" class="form-control"></td>
    <td width="8%"><button type="submit" name="save_item" id="save_item" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> เพิ่มรายการ</button></td>
    </tr>
  <tr style="font-weight:bold; color:#FFF; text-align:center;">
    <td width="10%" bgcolor="#888888">หมายเลข</td>
    <td width="23%" bgcolor="#888888">ชื่อรายการ</td>
    <td bgcolor="#888888">สาเหตุที่ส่งซ่อม/เคลม</td>
    <td bgcolor="#888888">ราคาโดยประมาณ</td>
    <td bgcolor="#888888">จัดการ</td>
    </tr>
    <?php 
	$getitem = $getdata->my_sql_select(NULL,"card_item","card_key='".$card_detail->card_key."' ORDER BY item_insert");
	while($showitem = mysql_fetch_object($getitem)){
	?>
  <tr id="<?php echo @$showitem->item_key;?>">
    <td align="center" bgcolor="#EFEFEF"><strong><?php echo @$showitem->item_number;?></strong></td>
    <td><strong><?php echo @$showitem->item_name;?></strong></td>
    <td style="color:#970002;"><strong><?php echo @$showitem->item_note;?></strong></td>
    <td align="right"><strong><?php echo @($showitem->item_price_aprox == 0)?'ไม่ระบุ':convertPoint2($showitem->item_price_aprox,2);?></strong></td>
    <td align="center"><a data-toggle="modal" data-target="#edit_item" data-whatever="<?php echo @$showitem->item_key;?>" class="btn btn-xs btn-info" style="color:#FFF;" title="แก้ไข"><i class="fa fa-edit"></i></a><a onClick="javascript:deleteItem('<?php echo @$showitem->item_key;?>');" class="btn btn-xs btn-danger" style="color:#FFF;" title="ลบ"><i class="fa fa-times"></i></a></td>
    </tr>
    <?php
	}
	?>
</table>
                     </div>      </form>
                      
                     <div class="panel-footer" align="center" ><a class="btn btn-sm btn-success" style="color:#FFF;" data-toggle="modal" data-target="#create_card"><i class="fa fa-check-square-o"></i> บันทึกข้อมูล</a></div>
</div>

                </div>
               <script language="javascript">
			   function deleteItem(item_key){
				   if(confirm("คุณต้องการจะลบรายการนี้ใช่หรือไม่ ?")){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(item_key).innerHTML = '';
  		}
	}
	xmlhttp.open("GET","function.php?type=delete_item&key="+item_key,true);
	xmlhttp.send();
				   }
}

$('#edit_item').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "card/edit_item.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.ct').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });  
    })
			   </script>