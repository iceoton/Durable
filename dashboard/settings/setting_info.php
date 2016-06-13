<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa flaticon-id fa-fw"></i> <?php echo @LA_LB_USER_DATA;?></h1>
     </div>        
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
  <li class="active"><?php echo @LA_LB_USER_DATA;?></li>
</ol>

 <?php
 if(isset($_POST['info_save'])){
		if (!defined('UPLOADDIR2')) define('UPLOADDIR2','../resource/users/images/');
				if (is_uploaded_file($_FILES["user_photo"]["tmp_name"])) {	
				$File_name2 = $_FILES["user_photo"]["name"];
				$File_tmpname2 = $_FILES["user_photo"]["tmp_name"];
				$File_ext2 = pathinfo($File_name2, PATHINFO_EXTENSION);
				$newfilename2 = md5(time("now")).'.'.$File_ext2;
				if (move_uploaded_file($File_tmpname2, (UPLOADDIR2.$newfilename2)));
	}
	if($File_name2 != NULL){
		resizeUserThumb($File_ext2,$newfilename2);
		$getdata->my_sql_update("user","name='".addslashes($_POST['mname'])."',lastname='".addslashes($_POST['mlastname'])."',user_language='".addslashes($_REQUEST['mlanguage'])."',email='".addslashes($_POST['memail'])."',user_photo='".$newfilename2."'","user_key='".$userdata->user_key."'");
	}else{
		$getdata->my_sql_update("user","name='".addslashes($_POST['mname'])."',lastname='".addslashes($_POST['mlastname'])."',user_language='".addslashes($_REQUEST['mlanguage'])."',email='".addslashes($_POST['memail'])."'","user_key='".$userdata->user_key."'");
	}
	$_SESSION['lang'] = addslashes($_REQUEST['mlanguage']);
	 $alert = '<div class="alert alert-block alert-success fade in"><button data-dismiss="alert" class="close" type="button">×</button>'.LA_ALERT_EDIT_DATA_INFO_DONE.'</div>';
 }
 

 if(isset($_POST['password_save'])){
	 if($userdata->password != md5(addslashes($_POST['old_password']))){
			$alert = '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close" type="button">×</button>'.LA_ALERT_OLD_PASSWORD_INCORRECT.'</div>';
		}else{
			if(md5(addslashes($_POST['new_password'])) != md5(addslashes($_POST['re_new_password']))){
				$alert = '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close" type="button">×</button>'.LA_ALERT_NEW_PASSWORD_NOTMATCH.'</div>';
			}else{
				if(addslashes($_POST['new_password']) != NULL && addslashes($_POST['re_new_password']) != NULL){
					$getdata->my_sql_update("user","password='".md5(addslashes($_POST['new_password']))."'","user_key='".$_SESSION['ukey']."'");
					$alert = '<div class="alert alert-block alert-success fade in"><button data-dismiss="alert" class="close" type="button">×</button>'.LA_ALERT_PASSWORD_CHANGED.'</div>';
				}else{
					$alert = '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close" type="button">×</button>'.LA_ALERT_DATA_MISMATCH.'</div>';
				}
			}
			
		}
 }
 if(isset($_POST['change_font_size'])){
	 $getdata->my_sql_update("user","system_font_size='".addslashes($_POST['change_font_size'])."'","user_key='".$_SESSION['ukey']."'");
	 $userdata = $getdata->my_sql_query(NULL,"user,system_font_size","user.user_key='".$_SESSION['ukey']."' AND user.system_font_size=system_font_size.font_key");
	 $alert = '<div class="alert alert-block alert-success fade in"><button data-dismiss="alert" class="close" type="button">×</button>เปลี่ยนขนาดตัวอักษร สำเร็จ!</div>';
 }
 
  $getmember_info = $getdata->my_sql_query(NULL,"user","user_key='".$_SESSION['ukey']."'");
 echo @$alert;
 ?>
 <style>
	body{
		<?php echo @$userdata->font_size_text;?>
	}
	</style>
 <ul class="nav nav-tabs">
                                <li class="active"><a href="#info_data" data-toggle="tab"><?php echo @LA_LB_EDIT_USER_INFO;?></a>
                                </li>
                                <li><a href="#password_change" data-toggle="tab"><?php echo @LA_LB_PASSWORD_CHANGE;?></a>
                                </li>
                                
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="info_data">
                                <br/>
                                  <form method="post" enctype="multipart/form-data" name="form1" id="form1">
  <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo @LA_LB_EDIT_USER_INFO;?>
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                                            <label for="musername"><?php echo @LA_LB_USERNAME;?></label>
                                            <input class="form-control" type="text" name="musername" id="musername" value="<?php echo @$getmember_info->username;?>" readonly>
                                            
                           </div>
                           <div class="form-group row">
                           	
                             	   <div class="col-xs-6">
                             	     <label for="mname"><?php echo @LA_LB_NAME;?></label>
                                     <input type="text" name="mname" id="mname" value="<?php echo @$getmember_info->name;?>" class="form-control">
                             	   </div>
                                   <div class="col-xs-6">
                                     <label for="mlastname"><?php echo @LA_LB_LASTNAME;?></label>
                                     <input type="text" name="mlastname" id="mlastname" value="<?php echo @$getmember_info->lastname;?>" class="form-control">
                                   </div>
                           	
                           </div>
                          
                                             <div class="form-group row">
                                             <div class="col-xs-6">
                                             <label for="memail"><?php echo @LA_LB_EMAIL;?></label>
                                               <input type="text" name="memail" id="memail" class="form-control" value="<?php echo @$getmember_info->email;?>">
                                            </div>
                                            <div class="col-xs-6">
                                              <label for="mlanguage"><?php echo @LA_LB_LANGUAGE;?></label>
                                              <select name="mlanguage" id="mlanguage" class="form-control">
                                              <?php
											  $getlanguage = $getdata->my_sql_select(NULL,"language","language_status='1' ORDER BY language_name");
											  while($showlanguage = mysql_fetch_object($getlanguage)){
												  if($getmember_info->user_language == $showlanguage->language_code){
													  echo '<option value="'.$showlanguage->language_code.'" selected>'.$showlanguage->language_name.'</option>';
												  }else{
													  echo '<option value="'.$showlanguage->language_code.'">'.$showlanguage->language_name.'</option>';
												  }
											  }
											  ?>
                                              </select>
                                            </div>
                                               
                          </div>
                           <div class="form-group row">
                           	<div class="col-xs-3"><center><div class="box_img_cyclex"><img src="../resource/users/thumbs/<?php echo @$getmember_info->user_photo;?>" <?php echo getPhotoSize('../resource/users/thumbs/'.@$getmember_info->user_photo.'');?> id="img_cyclex"  alt=""/></div></center></div>
                            <div class="col-xs-9">
                              <label for="user_photo"><?php echo @LA_LB_PHOTO;?></label>
                              <input type="file" name="user_photo" id="user_photo" class="form-control">
                            </div>
                          </div>
                             <div class="form-group row">
                             
                             <div class="col-md-12"><strong>ขนาดตัวอักษร</strong></div>
                             <?php
							 $getfont = $getdata->my_sql_select(NULL,"system_font_size","font_status='1' ORDER BY font_name");
							 while($showfont = mysql_fetch_object($getfont)){
								  if($showfont->font_key == $userdata->system_font_size){
									  echo '<div class="col-md-2"><button type="submit" name="change_font_size" class="btn btn-primary btn-block" id="submit" value="'.$showfont->font_key.'">'.$showfont->font_name.'</button></div>';
								  }else{
									  echo '<div class="col-md-2"><button type="submit" name="change_font_size" class="btn btn-default btn-block" id="submit" value="'.$showfont->font_key.'">'.$showfont->font_name.'</button></div>';
								  }
							 }
							 ?>
                             </div>
                                           
                        </div>
                        <div class="panel-footer">
                          <button type="submit" name="info_save" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo @LA_BTN_SAVE;?></button>
                        </div>
  </div>
</form>
                                </div>
                              <div class="tab-pane fade" id="password_change">
                              <br/>
                                <form id="form2" name="form2" method="post" action="#password_change">
<div class="panel panel-red">
                        <div class="panel-heading">
                            <?php echo @LA_LB_PASSWORD_CHANGE;?>
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                                               <label for="old_password"><?php echo @LA_LB_OLD_PASSWORD;?></label>
                                               <input type="password" name="old_password" id="old_password"  class="form-control">
                           </div>
                           <div class="form-group">
                                               <label for="new_password"><?php echo @LA_LB_NEW_PASSWORD;?></label>
                                               <input type="password" name="new_password" id="new_password"  class="form-control">
                           </div>
                           <div class="form-group">
                                               <label for="re_new_password"><?php echo @LA_LB_NEW_PASSWORD_AGAIN;?></label>
                                               <input type="password" name="re_new_password" id="re_new_password"  class="form-control">
                           </div>
                        </div>
                        <div class="panel-footer" >
                            <button type="submit" name="password_save" class="btn btn-danger"><i class="fa fa-unlock-alt fa-fw"></i> <?php echo @LA_LB_PASSWORD_CHANGE;?></button>
                        </div>
                    </div>
</form>

                              </div>
                               
                            </div>
