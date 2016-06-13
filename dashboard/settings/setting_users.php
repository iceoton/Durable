<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-user fa-fw"></i> <?php echo @LA_LB_SYSTEM_USER;?></h1>
     </div>        
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
  <li class="active"><?php echo @LA_LB_SYSTEM_USER;?></li>
</ol>
<?php
if(isset($_POST['save_user'])){
	if(addslashes($_POST['username']) != NULL && addslashes($_POST['password']) != NULL && addslashes($_POST['repassword']) != NULL){
		$getuser =$getdata->my_sql_show_rows("user","username='".addslashes($_POST['username'])."' OR email='".addslashes($_POST['email'])."'");
		if($getuser == 0){
			if(addslashes($_POST['password']) == addslashes($_POST['repassword'])){
				$user_key=md5(addslashes($_POST['username']).time("now"));
				$getdata->my_sql_insert("user","user_key='".$user_key."',name='".addslashes($_POST['name'])."',lastname='".addslashes($_POST['lastname'])."',username='".addslashes($_POST['username'])."',password='".md5(addslashes($_POST['password']))."',email='".addslashes($_POST['email'])."',user_class='2',user_status='".addslashes($_REQUEST['user_status'])."'");
				$alert = '  <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_INSERT_USER_DONE.'</div>';
			}else{
				$alert = ' <div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_PASSWORD_MISMATCH.'</div>';
			}
		}else{
			$alert = ' <div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_USERNAME_UNAVAILABLE.'</div>';
		}
	}else{
		$alert = ' <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
}
?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><?php echo @LA_LB_INSERT_USER_DATA;?></h4>
                                        </div>
                                        <div class="modal-body">
                                           <div class="form-group">
                                             <label for="name"><?php echo @LA_LB_NAME;?></label>
                                             <input type="text" name="name" id="name" class="form-control">
                                          </div>
                                           <div class="form-group">
                                            <label for="lastname"><?php echo @LA_LB_LASTNAME;?></label>
                                             <input type="text" name="lastname" id="lastname" class="form-control">
                                          </div>
                                           <div class="form-group">
                                            <label for="username"><?php echo @LA_LB_USERNAME;?></label>
                                             <input type="text" name="username" id="username" class="form-control">
                                          </div>
                                           <div class="form-group">
                                            <label for="password"><?php echo @LA_LB_PASSWORD;?></label>
                                             <input type="password" name="password" id="password" class="form-control">
                                          </div>
                                           <div class="form-group">
                                            <label for="repassword"><?php echo @LA_LB_PASSWORD_AGAIN;?></label>
                                             <input type="password" name="repassword" id="repassword" class="form-control">
                                          </div>
                                            <div class="form-group">
                                            <label for="email"><?php echo @LA_LB_EMAIL;?></label>
                                             <input type="email" name="email" id="email" class="form-control">
                                          </div>
                                           <div class="form-group">
                                             <label for="user_status"><?php echo @LA_LB_STATUS;?></label>
                                             <select name="user_status" id="user_status" class="form-control">
                                               <option value="1" selected="selected"><?php echo @LA_BTN_SHOW;?></option>
                                               <option value="0"><?php echo @LA_BTN_HIDE;?></option>
                                             </select>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_user" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
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
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i><?php echo @LA_LB_NEW_USER;?></button>
 <br/><br/>
 <?php
 if(@addslashes($_GET['e']) == 'y'){
	 $getuser_detail = $getdata->my_sql_query(NULL,"user","user_key='".addslashes($_GET['key'])."'");
	 if(isset($_POST['edit_user_info'])){
		 if(addslashes($_POST['edit_password']) != NULL && addslashes($_POST['edit_repassword']) != NULL){
			 if(addslashes($_POST['edit_password']) == addslashes($_POST['edit_repassword'])){
				 $getdata->my_sql_update("user","name='".addslashes($_POST['edit_name'])."',lastname='".addslashes($_POST['edit_lastname'])."',password='".md5(addslashes($_POST['edit_password']))."',email='".addslashes($_POST['edit_email'])."'","user_key='".addslashes($_GET['key'])."'");
				  echo '<script>window.location="?p=setting_users"</script>';
			 }else{
				  $alert2 = '  <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_PASSWORD_MISMATCH.'</div>';
			 }
			
		 }else{
			 $getdata->my_sql_update("user","name='".addslashes($_POST['edit_name'])."',lastname='".addslashes($_POST['edit_lastname'])."',email='".addslashes($_POST['edit_email'])."'","user_key='".addslashes($_GET['key'])."'");
			  echo '<script>window.location="?p=setting_users"</script>';
		 }
	 }
 ?>
 <?php
  echo @$alert2;
  ?>
 <form id="form2" name="form2" method="post">
  <div class="panel panel-info">
   <div class="panel-heading"><?php echo @LA_LB_EDIT_USER;?></div>
        <div class="panel-body">
        <table width="100%" border="0">
  <tr>
    <td width="28%"><?php echo @LA_LB_USERNAME;?></td>
    <td width="72%"> <div class="form-group">
      <input name="edit_username" type="text" disabled="disabled" id="edit_username" value="<?php echo @$getuser_detail->username;?>" class="form-control"></div></td>
  </tr>
  <tr>
    <td><?php echo @LA_LB_NAME;?></td>
    <td> <div class="form-group">
      <input type="text" name="edit_name" id="edit_name" class="form-control" value="<?php echo @$getuser_detail->name;?>"></div></td>
  </tr>
  <tr>
    <td><?php echo @LA_LB_LASTNAME;?></td>
    <td> <div class="form-group">
      <input type="text" name="edit_lastname" id="edit_lastname" class="form-control" value="<?php echo @$getuser_detail->lastname;?>"></div></td>
  </tr>
  <tr>
    <td><?php echo @LA_LB_EMAIL;?></td>
    <td> <div class="form-group">
      <input type="email" name="edit_email" id="edit_email" class="form-control" value="<?php echo @$getuser_detail->email;?>"></div></td>
  </tr>
  <tr>
    <td colspan="2"><hr/></td>
    </tr>
  <tr>
    <td><?php echo @LA_LB_NEW_PASSWORD;?></td>
    <td> <div class="form-group">
      <input type="password" name="edit_password" id="edit_password" class="form-control"></div></td>
  </tr>
  <tr>
    <td><?php echo @LA_LB_NEW_PASSWORD_AGAIN;?></td>
    <td> <div class="form-group">
      <input type="password" name="edit_repassword" id="edit_repassword" class="form-control"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
        </table>
        
        </div>
        <div class="panel-footer">
        <button type="submit" name="edit_user_info" class="btn btn-info btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
        </div>
 </div>
 </form>
 <?php
 }
 ?>
  <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#administrator" data-toggle="tab">ผู้ดูแลระบบ</a>
                                </li>
                            <!--    <li><a href="#members" data-toggle="tab">สมาชิก</a>
                                </li>-->
                                
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="administrator">
                                    <div class="table-responsive">
  <table width="100%" border="0" class="table table-bordered table-hover">
  <thead>
  <tr style="color:#FFF">
    <th width="3%" align="center" bgcolor="#5fb760">#</th>
    <th width="8%" align="center" bgcolor="#5fb760"><?php echo @LA_LB_PHOTO;?></th>
    <th width="30%" align="center" bgcolor="#5fb760"><?php echo @LA_LB_NAME;?></th>
    <th width="27%" align="center" bgcolor="#5fb760"><?php echo @LA_LB_USERNAME;?></th>
    <th width="32%" align="center" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
  </tr>
  </thead>
  <tbody>
   <?php
   $l=0;
	   $getalluser  = $getdata->my_sql_select(NULL,"user","user_class='2' AND user_status <> '2' ORDER BY username");
	   while($showalluser = mysql_fetch_object($getalluser)){
		   $l++;
		   $getonline = $getdata->my_sql_show_rows("user_online","user_key='".$showalluser->user_key."'");
		   if($getonline != 0){
			   $color = 'color:#0C0;';
		   }else{
			   $color = 'color:#CCC;';
		   }
	   ?>
  <tr id="<?php echo @$showalluser->user_key;?>">
    <td align="center"><?php echo @$l;?></td>
    <td align="center"><div class="box_img_cycle3"><img src="../resource/users/thumbs/<?php echo @$showalluser->user_photo;?>" <?php echo getPhotoSize('../resource/users/thumbs/'.@$showalluser->user_photo.'');?> id="img_cycle3" alt=""/></div></td>
    <td>&nbsp;<span style="font-size:12px; <?php echo $color;?>"><i class="fa fa-circle fa-fw"></i></span>&nbsp;<?php echo @$showalluser->name."&nbsp;&nbsp;&nbsp;".$showalluser->lastname;?></td>
    <td align="center"><?php echo @$showalluser->username;?></td>
    <td align="center"> <?php
	  if($showalluser->user_status == '1'){
		  echo '<button type="button" class="btn btn-success btn-xs" id="btn-'.@$showalluser->user_key.'" onClick="javascript:changeUserStatus(\''.@$showalluser->user_key.'\');"><i class="fa fa-unlock-alt" id="icon-'.@$showalluser->user_key.'"></i> <span id="text-'.@$showalluser->user_key.'">'.LA_BTN_SHOW.'</span></button>';
	  }else{
		  echo '<button type="button" class="btn btn-danger btn-xs" id="btn-'.@$showalluser->user_key.'" onClick="javascript:changeUserStatus(\''.@$showalluser->user_key.'\');"><i class="fa fa-lock" id="icon-'.@$showalluser->user_key.'"></i> <span id="text-'.@$showalluser->user_key.'">'.LA_BTN_HIDE.'</span></button>';
	  }
	  ?><a href="?p=setting_users&e=y&key=<?php echo @$showalluser->user_key;?>" class="btn btn-info btn-xs " ><i class="fa fa-edit fa-fw"></i><?php echo @LA_BTN_EDIT;?></a><!--<a href="?p=setting_user_access&key=<?php echo @$showalluser->user_key;?>" class="btn btn-primary btn-xs " ><i class="fa fa-gear fa-fw"></i><?php echo @LA_BTN_ACCESS;?></a>--><button type="button" class="btn btn-danger btn-xs " onClick="javascript:deleteUser('<?php echo @$showalluser->user_key;?>');"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_DELETE;?></button></td>
  </tr>
   <?php
	   }
   ?>
   </tbody>
</table>
		</div>
                                </div>
                                <div class="tab-pane fade" id="members">
                                    <div class="table-responsive">
  <table width="100%" border="0" class="table table-bordered table-hover">
  <thead>
  <tr style="color:#FFF">
    <th width="2%" align="center" bgcolor="#5fb760">#</th>
    <th width="6%" align="center" bgcolor="#5fb760"><?php echo @LA_LB_PHOTO;?></th>
    <th width="28%" align="center" bgcolor="#5fb760"><?php echo @LA_LB_NAME;?></th>
    <th width="22%" align="center" bgcolor="#5fb760"><?php echo @LA_LB_USERNAME;?></th>
    <th width="26%" align="center" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
  </tr>
  </thead>
  <tbody>
   <?php
   $l=0;
	   $getalluser  = $getdata->my_sql_select(NULL,"user","user_class='1' AND user_status <> '2' ORDER BY username");
	   while($showalluser = mysql_fetch_object($getalluser)){
		   $l++;
		   $getonline = $getdata->my_sql_show_rows("user_online","user_key='".$showalluser->user_key."'");
		   if($getonline != 0){
			   $color = 'color:#0C0;';
		   }else{
			   $color = 'color:#CCC;';
		   }
	   ?>
  <tr id="<?php echo @$showalluser->user_key;?>">
    <td align="center"><?php echo @$l;?></td>
    <td align="center"><div class="box_img_cycle3"><img src="../resource/members/thumbs/<?php echo @$showalluser->user_photo;?>" <?php echo getPhotoSize('../resource/members/thumbs/'.@$showalluser->user_photo.'');?> id="img_cycle3" alt=""/></div></td>
    <td>&nbsp;<span style="font-size:12px; <?php echo $color;?>"><i class="fa fa-circle fa-fw"></i></span>&nbsp;<?php echo @$showalluser->name."&nbsp;&nbsp;&nbsp;".$showalluser->lastname;?></td>
    <td align="center"><?php echo @$showalluser->username;?></td>
    <td align="center"> <?php
	  if($showalluser->user_status == '1'){
		  echo '<button type="button" class="btn btn-success btn-xs" id="btn-'.@$showalluser->user_key.'" onClick="javascript:changeUserStatus(\''.@$showalluser->user_key.'\');"><i class="fa fa-unlock-alt" id="icon-'.@$showalluser->user_key.'"></i> <span id="text-'.@$showalluser->user_key.'">'.LA_BTN_SHOW.'</span></button>';
	  }else{
		  echo '<button type="button" class="btn btn-danger btn-xs" id="btn-'.@$showalluser->user_key.'" onClick="javascript:changeUserStatus(\''.@$showalluser->user_key.'\');"><i class="fa fa-lock" id="icon-'.@$showalluser->user_key.'"></i> <span id="text-'.@$showalluser->user_key.'">'.LA_BTN_HIDE.'</span></button>';
	  }
	  ?><a href="?p=setting_users&e=y&key=<?php echo @$showalluser->user_key;?>" class="btn btn-info btn-xs " ><i class="fa fa-edit fa-fw"></i><?php echo @LA_BTN_EDIT;?></a><button type="button" class="btn btn-danger btn-xs " onClick="javascript:deleteUser('<?php echo @$showalluser->user_key;?>');"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_DELETE;?></button></td>
  </tr>
   <?php
	   }
   ?>
   </tbody>
</table>
		</div>
                                </div>
                                
                            </div>

<script language="javascript">

function changeUserStatus(userkey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var es = document.getElementById('btn-'+userkey);
	if(es.className == 'btn btn-success btn-xs'){
		var sts= 1;
	}else{
		var sts= 0;
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			
			if(es.className == 'btn btn-success btn-xs'){
				document.getElementById('btn-'+userkey).className = 'btn btn-danger btn-xs';
				document.getElementById('icon-'+userkey).className = 'fa fa-lock';
				document.getElementById('text-'+userkey).innerHTML = 'ซ่อน';
			}else{
				document.getElementById('btn-'+userkey).className = 'btn btn-success btn-xs';
				document.getElementById('icon-'+userkey).className = 'fa fa-unlock-alt';
				document.getElementById('text-'+userkey).innerHTML = 'แสดง';
			}
  		}
	}
	
	xmlhttp.open("GET","function.php?type=change_user_status&key="+userkey+"&sts="+sts,true);
	xmlhttp.send();
}
	function deleteUser(userkey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(userkey).innerHTML = '';
  		}
	}
	xmlhttp.open("GET","function.php?type=delete_user&key="+userkey,true);
	xmlhttp.send();
}
</script>
