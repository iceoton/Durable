<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-list fa-fw"></i> [ผู้ดูแลระบบ] จัดการข้อมูลการเข้าถึง</h1>
     </div>        
</div>
<ol class="breadcrumb">
  <li><a href="index.php">หน้าร้าน</a></li>
  <li><a href="?p=setting">ตั้งค่า</a></li>
  <li class="active">[ผู้ดูแลระบบ] จัดการข้อมูลการเข้าถึง</li>
</ol>
<?php
if(isset($_POST['save_access'])){
	if(addslashes($_POST['access_title']) != NULL){
		$access_key = md5(addslashes($_POST['access_title']).time("now"));
		$getdata->my_sql_insert("access_list","access_key='".$access_key."',access_name='".addslashes($_POST['access_title'])."',access_detail='".addslashes($_POST['access_detail'])."',access_status='".addslashes($_REQUEST['access_status'])."'");
		$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>เพิ่มข้อมูลการเข้าถึง สำเร็จ !</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุข้อมูลอีกครั้ง !</div>'; 
	}
}
?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลการเข้าถึง</h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="form-group">
                                            <label for="access_title">ชื่อข้อมูล</label>
                                            <input type="text" name="access_title" id="access_title" class="form-control" autofocus>
                                          </div>
                                            <div class="form-group">
                                              <label for="access_detail">รายละเอียด</label>
                                              <textarea name="access_detail" class="form-control" id="access_detail"></textarea>
                                          </div>
                                          
                                            <div class="form-group">
                                              <label for="access_status">สถานะ</label>
                                              <select name="access_status" id="access_status" class="form-control">
                                                <option value="1" selected="selected">แสดง</option>
                                                <option value="0">ซ่อน</option>
                                              
                                              </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i>ปิด</button>
                                          <button type="submit" name="save_access" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i>บันทึก</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                </form>
                                <!-- /.modal-dialog -->
</div>
                            <!-- /.modal -->
  <?php
  echo @$alert;
  ?>
 
 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i>เพิ่มข้อมูลการเข้าถึง</button>
 <br/><br/>
 <?php
 if(@addslashes($_GET['e'])=="y"){
	 if(isset($_POST['save_edit_unit'])){
		 if(addslashes($_POST['edit_access_title'])!= NULL){
			 $getdata->my_sql_update("access_list","access_name='".addslashes($_POST['edit_access_title'])."',access_detail='".addslashes($_POST['edit_access_detail'])."'","access_key='".addslashes($_GET['key'])."'");
			 echo '<script>window.location="?p=administrator_access_list";</script>';
		 }else{
			 $alert2 = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุข้อมูลอีกครั้ง !</div>'; 
		 }
	 }
	 $getaccess_detail =$getdata->my_sql_query(NULL,"access_list","access_key='".addslashes($_GET['key'])."'");
	 ?>
      <form id="form2" name="form2" method="post">
 <div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading">แก้ไขข้อมูลการเข้าถึง</div>
   <div class="panel-body"><div class="form-group">
                                            <label for="edit_access_title">ชื่อข้อมูลการเข้าถึง</label>
                                            <input type="text" name="edit_access_title" id="edit_access_title" class="form-control" value="<?php echo @$getaccess_detail->access_name;?>" autofocus>
                                          </div>
                                           <div class="form-group">
                                              <label for="edit_access_detail">รายละเอียด</label>
                                              <textarea name="edit_access_detail" class="form-control" id="edit_access_detail"><?php echo @$getaccess_detail->access_detail;?></textarea>
                                          </div>
    </div>
    <div class="panel-footer"><button type="submit" class="btn btn-info btn-sm" name="save_edit_unit"><i class="fa fa-save fa-fw"></i>บันทึก</button></div>
   </div>
 </form>
	 <?php
 }
 echo @$alert2;
 ?>
 <div class="panel panel-default">
  <!-- Default panel contents -->
   <div class="table-responsive tooltipx">
  <!-- Table -->
  <table width="100%" class="table table-striped table-bordered table-hover">
  <thead>
  <tr style="color:#FFF;">
    <th width="2%" bgcolor="#5fb760">#</th>
    <th width="32%" bgcolor="#5fb760">access_key</th>
    <th width="32%" bgcolor="#5fb760">access_name</th>
    <th width="13%" bgcolor="#5fb760">จำนวนผู้เข้าถึง</th>
    <th width="21%" bgcolor="#5fb760">ตัวจัดการ</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $x=0;
  $getaccess = $getdata->my_sql_select(NULL,"access_list","1 ORDER BY access_name");
  while($showaccess = mysql_fetch_object($getaccess)){
	  $x++;
  ?>
  <tr id="<?php echo @$showaccess->access_key;?>">
    <td align="center"><?php echo @$x;?></td>
    <td align="center"><?php echo @$showaccess->access_key;?></td>
    <td>&nbsp;<span data-toggle="tooltip" data-placement="right" title="<?php echo $showaccess->access_detail;?>"><?php echo @$showaccess->access_name;?></span></td>
    <td align="center" valign="middle"><?php echo @number_format($getdata->my_sql_show_rows("access_user","access_key='".$showaccess->access_key."'"));?></td>
    <td align="center" valign="middle"><?php
	  if($showaccess->access_status == '1'){
		  echo '<button type="button" class="btn btn-success btn-xs" id="btn-'.@$showaccess->access_key.'" onClick="javascript:changeAccessStatus(\''.@$showaccess->access_key.'\');"><i class="fa fa-unlock-alt" id="icon-'.@$showaccess->access_key.'"></i> <span id="text-'.@$showaccess->access_key.'">แสดง</span></button>';
	  }else{
		  echo '<button type="button" class="btn btn-danger btn-xs" id="btn-'.@$showaccess->access_key.'" onClick="javascript:changeAccessStatus(\''.@$showaccess->access_key.'\');"><i class="fa fa-lock" id="icon-'.@$showaccess->access_key.'"></i> <span id="text-'.@$showaccess->access_key.'">ซ่อน</span></button>';
	  }
	  ?>
      <a href="?p=administrator_access_list&e=y&key=<?php echo @$showaccess->access_key;?>" type="button" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> แก้ไข</a><button type="button" class="btn btn-danger btn-xs" onClick="javascript:deleteUnit('<?php echo @$showaccess->access_key;?>');"><i class="glyphicon glyphicon-remove"></i> ลบ</button></td>
  </tr>
  <?php
  }
  ?>
  </tbody>
</table>
</div>
</div>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<script language="javascript">
function changeAccessStatus(unitkey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var es = document.getElementById('btn-'+unitkey);
	if(es.className == 'btn btn-success btn-xs'){
		var sts= 1;
	}else{
		var sts= 0;
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			
			if(es.className == 'btn btn-success btn-xs'){
				document.getElementById('btn-'+unitkey).className = 'btn btn-danger btn-xs';
				document.getElementById('icon-'+unitkey).className = 'fa fa-lock';
				document.getElementById('text-'+unitkey).innerHTML = 'ซ่อน';
			}else{
				document.getElementById('btn-'+unitkey).className = 'btn btn-success btn-xs';
				document.getElementById('icon-'+unitkey).className = 'fa fa-unlock-alt';
				document.getElementById('text-'+unitkey).innerHTML = 'แสดง';
			}
  		}
	}
	
	xmlhttp.open("GET","function.php?type=change_access_status&key="+unitkey+"&sts="+sts,true);
	xmlhttp.send();
}
	function deleteUnit(unitkey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(unitkey).innerHTML = '';
  		}
	}
	xmlhttp.open("GET","function.php?type=delete_unit&key="+unitkey,true);
	xmlhttp.send();
}
</script>
