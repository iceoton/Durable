<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-sitemap fa-fw"></i> [ผู้ดูแลระบบ] เมนู</h1>
     </div>        
</div>
<ol class="breadcrumb">
   <li><a href="index.php">หน้าร้าน</a></li>
  <li><a href="?p=setting">ตั้งค่า</a></li>
  <li class="active">[ผู้ดูแลระบบ] เมนู</li>
</ol>
<?php
if(isset($_POST['save_menu'])){
	if(addslashes($_POST['menu_name']) != NULL){
		$menu_key = md5(addslashes($_POST['menu_name']).time("now"));
		if(addslashes($_REQUEST['main_menu']) != NULL){
			$menu_upkey = addslashes($_REQUEST['main_menu']);
		}else{
			$menu_upkey = $menu_key;
		}
		$getdata->my_sql_insert("menus","menu_key='".$menu_key."',menu_upkey='".$menu_upkey."',menu_icon='".addslashes($_POST['menu_icon'])."',menu_name='".addslashes($_POST['menu_name'])."',menu_case='".addslashes($_POST['menu_case'])."',menu_link='".addslashes($_POST['menu_link'])."',menu_status='".addslashes($_REQUEST['menu_status'])."',menu_sorting='".addslashes($_POST['menu_sorting'])."'");
		$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>เพิ่มข้อมูลเมนู สำเร็จ !</div>';
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
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลเมนู</h4>
                                        </div>
                                        <div class="modal-body">
                                        <div class="form-group">
                                          <label for="main_menu">เมนูหลัก</label>
                                            <select name="main_menu" id="main_menu" class="form-control">
                                            <option value=""></option>
                                            <?php
													$getmain = $getdata->my_sql_select(NULL,"menus","menu_key=menu_upkey AND menu_status='1' ORDER BY menu_sorting");
													while($showmain = mysql_fetch_object($getmain)){
														echo '<option value="'.$showmain->menu_key.'">'.menuLanguage($showmain->menu_name).'</option>';
													}
                                            ?>
                                            </select>
                                        </div>
                                          <div class="form-group">
                                            <label for="menu_name">ชื่อเมนู (ตัวแปรสำหรับแปลภาษา)</label>
                                            <input type="text" name="menu_name" id="menu_name" class="form-control" autofocus>
                                          </div>
                                           <div class="form-group">
                                            <label for="menu_icon">ไอคอน</label>
                                            <textarea name="menu_icon" id="menu_icon" class="form-control" ></textarea>
                                          </div>
                                           <div class="form-group">
                                            <label for="menu_case">case</label>
                                            <input type="text" name="menu_case" id="menu_case" class="form-control" >
                                          </div>
                                          <div class="form-group">
                                            <label for="menu_link">ลิงค์</label>
                                            <input type="text" name="menu_link" id="menu_link" class="form-control" >
                                          </div>
                                           <div class="form-group">
                                              <label for="menu_sorting">ลำดับ</label>
                                               <input type="text" name="menu_sorting" id="menu_sorting" class="form-control" >
                                            </div>
                                          <div class="form-group">
                                              <label for="menu_status">สถานะ</label>
                                              <select name="menu_status" id="menu_status" class="form-control">
                                                <option value="1" selected="selected">แสดง</option>
                                                <option value="0">ซ่อน</option>
                                              
                                              </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i>ปิด</button>
                                          <button type="submit" name="save_menu" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i>บันทึก</button>
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
 
 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i>เพิ่มเมนู</button>
 <br/><br/>
 <?php
 if(@addslashes($_GET['e'])=="y"){
	 if(isset($_POST['save_edit_menu'])){
		 if(addslashes($_POST['edit_menu_name'])!= NULL){
			 if(@addslashes($_REQUEST['edit_main_menu']) != NULL){
				 $muk = addslashes($_REQUEST['edit_main_menu']);
			 }else{
				 $muk = addslashes($_GET['key']);
			 }
			 $getdata->my_sql_update("menus","menu_upkey='".$muk."',menu_icon='".addslashes($_POST['edit_menu_icon'])."',menu_name='".addslashes($_POST['edit_menu_name'])."',menu_case='".addslashes($_POST['edit_menu_case'])."',menu_link='".addslashes($_POST['edit_menu_link'])."',menu_sorting='".addslashes($_POST['edit_menu_sorting'])."'","menu_key='".addslashes($_GET['key'])."'");
			 echo '<script>window.location="?p=administrator_menus";</script>';
		 }else{
			 $alert2 = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุข้อมูลอีกครั้ง !</div>'; 
		 }
	 }
	 $getmenu_detail = $getdata->my_sql_query(NULL,"menus","menu_key='".addslashes($_GET['key'])."'");
	 if($getmenu_detail->menu_key == $getmenu_detail->menu_upkey){
		 $getupmenu = '';
	 }else{
		 $getupmenu = $getmenu_detail->menu_upkey;
	 }
	 ?>
      <form id="form2" name="form2" method="post">
 <div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading">แก้ไขเมนู</div>
   <div class="panel-body">  <div class="form-group">
                                          <label for="edit_main_menu">เมนูหลัก</label>
                                            <select name="edit_main_menu" id="edit_main_menu" class="form-control">
                                            <option value=""></option>
                                            <?php
													$getmain = $getdata->my_sql_select(NULL,"menus","menu_key=menu_upkey AND menu_status='1' ORDER BY menu_sorting");
													while($showmain = mysql_fetch_object($getmain)){
														if($showmain->menu_key == $getupmenu){
															echo '<option value="'.$showmain->menu_key.'" selected>'.menuLanguage($showmain->menu_name).'</option>';
														}else{
															echo '<option value="'.$showmain->menu_key.'">'.menuLanguage($showmain->menu_name).'</option>';
														}
													}
                                            ?>
                                            </select>
                                        </div>
                                          <div class="form-group">
                                            <label for="edit_menu_name">ชื่อเมนู (ตัวแปรสำหรับแปลภาษา)</label>
                                            <input type="text" name="edit_menu_name" id="edit_menu_name" class="form-control" value="<?php echo @$getmenu_detail->menu_name;?>" autofocus>
                                          </div>
                                           <div class="form-group">
                                            <label for="edit_menu_icon">ไอคอน</label>
                                            <textarea name="edit_menu_icon" id="edit_menu_icon" class="form-control"><?php echo @$getmenu_detail->menu_icon;?></textarea>
                                          </div>
                                           <div class="form-group">
                                            <label for="edit_menu_case">case</label>
                                            <input type="text" name="edit_menu_case" id="edit_menu_case" class="form-control" value="<?php echo @$getmenu_detail->menu_case;?>" >
                                          </div>
                                          <div class="form-group">
                                            <label for="edit_menu_link">ลิงค์</label>
                                            <input type="text" name="edit_menu_link" id="edit_menu_link" class="form-control" value="<?php echo @$getmenu_detail->menu_link;?>" >
                                          </div>
                                           <div class="form-group">
                                              <label for="edit_menu_sorting">ลำดับ</label>
                                               <input type="text" name="edit_menu_sorting" id="edit_menu_sorting" class="form-control" value="<?php echo @$getmenu_detail->menu_sorting;?>" >
                                            </div>
                                           </div>
    <div class="panel-footer"><button type="submit" class="btn btn-info btn-sm" name="save_edit_menu"><i class="fa fa-save fa-fw"></i>บันทึก</button></div>
   </div>
 </form>
	 <?php
 }
 echo @$alert2;
 ?>
 <div class="panel panel-default">
  
   <div class="table-responsive">
  <!-- Table -->
  <table width="100%" class="table table-bordered table-hover">
  <thead>
  <tr style="color:#FFF;">
    <th width="3%" bgcolor="#5fb760">#</th>
    <th colspan="3" bgcolor="#5fb760">ชื่อเมนู</th>
    <th width="23%" bgcolor="#5fb760">ตัวจัดการ</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $x=0;
  $getmenu = $getdata->my_sql_select(NULL,"menus","menu_key=menu_upkey ORDER BY menu_sorting");
  while($showmenu = mysql_fetch_object($getmenu)){
	  $x++;
  ?>
  <tr id="<?php echo @$showmenu->menu_key;?>">
    <td align="center" bgcolor="#CDCDCD"><?php echo @$x;?></td>
    <td width="7%" align="center" bgcolor="#CDCDCD"><?php echo @$showmenu->menu_icon;?></td>
    <td colspan="2" bgcolor="#CDCDCD"><?php echo @menuLanguage($showmenu->menu_name);?></td>
    <td align="center" valign="middle" bgcolor="#CDCDCD">
      <?php
	  if($showmenu->menu_status == '1'){
		  echo '<button type="button" class="btn btn-success btn-xs" id="btn-'.@$showmenu->menu_key.'" onClick="javascript:changeMenuStatus(\''.@$showmenu->menu_key.'\');"><i class="fa fa-unlock-alt" id="icon-'.@$showmenu->menu_key.'"></i> <span id="text-'.@$showmenu->menu_key.'">แสดง</span></button>';
	  }else{
		  echo '<button type="button" class="btn btn-danger btn-xs" id="btn-'.@$showmenu->menu_key.'" onClick="javascript:changeMenuStatus(\''.@$showmenu->menu_key.'\');"><i class="fa fa-lock" id="icon-'.@$showmenu->menu_key.'"></i> <span id="text-'.@$showmenu->menu_key.'">ซ่อน</span></button>';
	  }
	  ?>
      <a href="?p=administrator_menus&e=y&key=<?php echo @$showmenu->menu_key;?>" type="button" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> แก้ไข</a><button type="button" class="btn btn-danger btn-xs" onClick="javascript:deleteMenu('<?php echo @$showmenu->menu_key;?>');"><i class="glyphicon glyphicon-remove"></i> ลบ</button></td>
  </tr>
  <?php
 	 $getsubmenu = $getdata->my_sql_select(NULL,"menus","menu_upkey='".$showmenu->menu_key."' AND menu_key <> menu_upkey ORDER BY menu_sorting");
  	 while($showsubmenu = mysql_fetch_object($getsubmenu)){
  ?>
  <tr id="<?php echo @$showmenu->menu_key;?>">
    <td colspan="2" align="center" bgcolor="#CDCDCD">&nbsp;</td>
    <td width="7%" align="center" bgcolor="#EEEEEE"><?php echo $showsubmenu->menu_icon;?></td>
    <td width="60%" bgcolor="#EEEEEE">&nbsp;<?php echo @menuLanguage($showsubmenu->menu_name);?></td>
    <td align="center" valign="middle" bgcolor="#EEEEEE"> <?php
	  if($showsubmenu->menu_status == '1'){
		  echo '<button type="button" class="btn btn-success btn-xs" id="btn-'.@$showsubmenu->menu_key.'" onClick="javascript:changeMenuStatus(\''.@$showsubmenu->menu_key.'\');"><i class="fa fa-unlock-alt" id="icon-'.@$showsubmenu->menu_key.'"></i> <span id="text-'.@$showsubmenu->menu_key.'">แสดง</span></button>';
	  }else{
		  echo '<button type="button" class="btn btn-danger btn-xs" id="btn-'.@$showsubmenu->menu_key.'" onClick="javascript:changeMenuStatus(\''.@$showsubmenu->menu_key.'\');"><i class="fa fa-lock" id="icon-'.@$showsubmenu->menu_key.'"></i> <span id="text-'.@$showsubmenu->menu_key.'">ซ่อน</span></button>';
	  }
	  ?>
      <a href="?p=administrator_menus&e=y&key=<?php echo @$showsubmenu->menu_key;?>" type="button" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> แก้ไข</a><button type="button" class="btn btn-danger btn-xs" onClick="javascript:deleteMenu('<?php echo @$showsubmenu->menu_key;?>');"><i class="glyphicon glyphicon-remove"></i> ลบ</button></td>
  </tr>
  <?php
  	}
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

function changeMenuStatus(menukey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var es = document.getElementById('btn-'+menukey);
	if(es.className == 'btn btn-success btn-xs'){
		var sts= 1;
	}else{
		var sts= 0;
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			
			if(es.className == 'btn btn-success btn-xs'){
				document.getElementById('btn-'+menukey).className = 'btn btn-danger btn-xs';
				document.getElementById('icon-'+menukey).className = 'fa fa-lock';
				document.getElementById('text-'+menukey).innerHTML = 'ซ่อน';
			}else{
				document.getElementById('btn-'+menukey).className = 'btn btn-success btn-xs';
				document.getElementById('icon-'+menukey).className = 'fa fa-unlock-alt';
				document.getElementById('text-'+menukey).innerHTML = 'แสดง';
			}
  		}
	}
	
	xmlhttp.open("GET","function.php?type=change_menu_status&key="+menukey+"&sts="+sts,true);
	xmlhttp.send();
}
	function deleteMenu(menukey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(menukey).innerHTML = '';
  		}
	}
	xmlhttp.open("GET","function.php?type=delete_menu&key="+menukey,true);
	xmlhttp.send();
}
</script>
