<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-gear fa-fw"></i> <?php echo @LA_BTN_ACCESS_DATA;?></h1>
     </div>        
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
   <li><a href="?p=setting_users"><?php echo @LA_LB_SYSTEM_USER;?></a></li>
  <li class="active"><?php echo @LA_BTN_ACCESS_DATA;?></li>
</ol>
<?php
$showuser_detail = $getdata->my_sql_query(NULL,"user","user_key='".addslashes($_GET['key'])."'");
if(isset($_POST['save_access'])){
	$getdata->my_sql_delete("access_user","user_key='".addslashes($_GET['key'])."'");
	for($ac=0;$ac<count($_POST['access_list']);$ac++){
		$getdata->my_sql_insert("access_user","access_key='".addslashes($_POST['access_list'][$ac])."',user_key='".addslashes($_GET['key'])."'");
	}
}
?>
<form id="form1" name="form1" method="post">
<div class="panel panel-default">
                        <div class="panel-heading"><div class="box_img_cycle2"><img src="../resource/users/thumbs/<?php echo @$showuser_detail->user_photo;?>" <?php echo getPhotoSize('../resource/users/thumbs/'.@$showuser_detail->user_photo.'');?> id="img_cycle2" alt=""/></div><strong><?php echo @$showuser_detail->name."&nbsp;&nbsp;&nbsp;".$showuser_detail->lastname;?></strong>
                        </div>
                        <div class="panel-body">
                          <?php
	   $getaccess  = $getdata->my_sql_select(NULL,"access_list","access_status='1' ORDER BY access_name");
	   while($showaccess = mysql_fetch_object($getaccess)){
		   $nowaccess = $getdata->my_sql_show_rows("access_user","user_key='".addslashes($_GET['key'])."' AND access_key='".$showaccess->access_key."'");
		   if($nowaccess != 0 ){
			   echo '<div class="col-lg-6"><label><div class="input-group"><span class="input-group-addon"><input type="checkbox" name="access_list[]" id="access_list[]"  value="'.$showaccess->access_key.'" checked="checked"></span><p class="form-control" style="background:#468cc8;color:#FFF">'.$showaccess->access_name.'</p></div></label></div>';
		   }else{
			   echo '<div class="col-lg-6"><label><div class="input-group"><span class="input-group-addon"><input type="checkbox" name="access_list[]" id="access_list[]"  value="'.$showaccess->access_key.'"></span><p class="form-control" style="background:#eee;">'.$showaccess->access_name.'</p></div></label></div>';
		   }
		  
		  
	   }
	   ?>
                        </div>
                        <div class="panel-footer">
                          <button type="submit" name="save_access" id="save_access" class="btn btn-success btn-sm" ><i class="fa fa-save fa-fw"></i> <?php echo @LA_BTN_SAVE;?></button>
                        </div>
  </div>

</form>
