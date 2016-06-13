<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-chain fa-fw"></i> [ผู้ดูแลระบบ] ลิงค์หน้า</h1>
     </div>        
</div>
<ol class="breadcrumb">
  <li><a href="index.php">หน้าร้าน</a></li>
  <li><a href="?p=setting">ตั้งค่า</a></li>
  <li class="active">[ผู้ดูแลระบบ] ลิงค์หน้า</li>
</ol>
<?php
if(isset($_POST['save_case'])){
	if(addslashes($_POST['case_name']) != NULL){
		$getdata->my_sql_insert("list","cases='".addslashes($_POST['case_name'])."',menu='".addslashes($_POST['case_menu'])."',pages='".addslashes($_POST['case_page'])."',case_status='".addslashes($_REQUEST['case_status'])."'");
		$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>เพิ่มข้อมูลหน้า สำเร็จ !</div>';
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
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลหน้า</h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="form-group">
                                            <label for="case_name">case</label>
                                            <input type="text" name="case_name" id="case_name" class="form-control" autofocus>
                                          </div>
                                          <div class="form-group">
                                            <label for="case_menu">menu</label>
                                            <input type="text" name="case_menu" id="case_menu" class="form-control" >
                                          </div>
                                          <div class="form-group">
                                            <label for="case_page">page</label>
                                            <textarea name="case_page" id="case_page" class="form-control"></textarea>
                                          </div>
                                            <div class="form-group">
                                              <label for="case_status">สถานะ</label>
                                              <select name="case_status" id="case_status" class="form-control">
                                                <option value="1" selected="selected">แสดง</option>
                                                <option value="0">ซ่อน</option>
                                              
                                              </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i>ปิด</button>
                                          <button type="submit" name="save_case" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i>บันทึก</button>
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
 
 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i>เพิ่มข้อมูลหน้า</button>
 <br/><br/>
 <?php
 if(@addslashes($_GET['e'])=="y"){
	 if(isset($_POST['save_edit_case'])){
		 if(addslashes($_POST['edit_case_name'])!= NULL){
			 $getdata->my_sql_update("list","cases='".addslashes($_POST['edit_case_name'])."',menu='".addslashes($_POST['edit_case_menu'])."',pages='".addslashes($_POST['edit_case_page'])."'","cases='".addslashes($_GET['key'])."'");
			 echo '<script>window.location="?p=administrator_cases";</script>';
		 }else{
			 $alert2 = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุข้อมูลอีกครั้ง !</div>'; 
		 }
	 }
	 $getcase_detail =$getdata->my_sql_query(NULL,"list","cases='".addslashes($_GET['key'])."'");
	 ?>
      <form id="form2" name="form2" method="post">
 <div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading">แก้ไขข้อมูลหน้า</div>
   <div class="panel-body"><div class="form-group">
                                            <label for="edit_case_name">case</label>
                                            <input type="text" name="edit_case_name" id="edit_case_name" class="form-control" value="<?php echo @$getcase_detail->cases;?>" autofocus>
                                          </div>
                                          <div class="form-group">
                                            <label for="edit_case_menu">menu</label>
                                            <input type="text" name="edit_case_menu" id="edit_case_menu" class="form-control" value="<?php echo @$getcase_detail->menu;?>" >
                                          </div>
                                          <div class="form-group">
                                            <label for="edit_case_page">page</label>
                                            <textarea name="edit_case_page" id="edit_case_page" class="form-control"><?php echo @$getcase_detail->pages;?></textarea>
                                          </div>
                                           </div>
    <div class="panel-footer"><button type="submit" class="btn btn-info btn-sm" name="save_edit_case"><i class="fa fa-save fa-fw"></i>บันทึก</button></div>
   </div>
 </form>
	 <?php
 }
 echo @$alert2;
 ?>
 <div class="panel panel-default">
  <!-- Default panel contents -->
   <div class="table-responsive">
  <!-- Table -->
  <table width="100%" class="table table-striped table-bordered table-hover">
  <thead>
  <tr style="color:#FFF;">
    <th width="2%" bgcolor="#5fb760">#</th>
    <th width="21%" bgcolor="#5fb760">cases</th>
    <th width="15%" bgcolor="#5fb760">menu</th>
    <th width="41%" bgcolor="#5fb760">pages</th>
    <th width="21%" bgcolor="#5fb760">ตัวจัดการ</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $x=0;
  $getcase = $getdata->my_sql_select(NULL,"list","1 ORDER BY cases,menu");
  while($showcase = mysql_fetch_object($getcase)){
	  $x++;
  ?>
  <tr id="<?php echo @$showcase->cases;?>">
    <td align="center"><?php echo @$x;?></td>
    <td>&nbsp;<?php echo @$showcase->cases;?></td>
    <td align="center" valign="middle"><?php echo @$showcase->menu;?></td>
    <td valign="middle"><?php echo @$showcase->pages;?></td>
    <td align="center" valign="middle">
      <?php
	  if($showcase->case_status == '1'){
		  echo '<button type="button" class="btn btn-success btn-xs" id="btn-'.@$showcase->cases.'" onClick="javascript:changeCaseStatus(\''.@$showcase->cases.'\');"><i class="fa fa-unlock-alt" id="icon-'.@$showcase->cases.'"></i> <span id="text-'.@$showcase->cases.'">แสดง</span></button>';
	  }else{
		  echo '<button type="button" class="btn btn-danger btn-xs" id="btn-'.@$showcase->cases.'" onClick="javascript:changeCaseStatus(\''.@$showcase->cases.'\');"><i class="fa fa-lock" id="icon-'.@$showcase->cases.'"></i> <span id="text-'.@$showcase->cases.'">ซ่อน</span></button>';
	  }
	  ?>
      <a href="?p=administrator_cases&e=y&key=<?php echo @$showcase->cases;?>" type="button" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> แก้ไข</a><button type="button" class="btn btn-danger btn-xs" onClick="javascript:deleteCases('<?php echo @$showcase->cases;?>');"><i class="glyphicon glyphicon-remove"></i> ลบ</button></td>
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
function changeCaseStatus(unitkey){
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
	
	xmlhttp.open("GET","function.php?type=change_case_status&key="+unitkey+"&sts="+sts,true);
	xmlhttp.send();
}
	function deleteCases(unitkey){
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
	xmlhttp.open("GET","function.php?type=delete_case&key="+unitkey,true);
	xmlhttp.send();
}
</script>
