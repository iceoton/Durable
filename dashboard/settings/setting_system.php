<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-wrench fa-fw"></i> <?php echo @LA_LB_SYSTEM_SETTING;?></h1>
     </div>        
</div>
<ol class="breadcrumb">
 <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
  <li class="active"><?php echo  @LA_LB_SYSTEM_SETTING;?></li>
</ol>
<?php
if(isset($_POST['save_info'])){
	if (!defined('UPLOADDIR')) define('UPLOADDIR','../media/logo/');
				if (is_uploaded_file($_FILES["site_logo"]["tmp_name"])) {	
				$File_name = $_FILES["site_logo"]["name"];
				$File_tmpname = $_FILES["site_logo"]["tmp_name"];
				if (move_uploaded_file($File_tmpname, (UPLOADDIR.$File_name)));
						
	}
	if (!defined('UPLOADDIR2')) define('UPLOADDIR2','../media/favicon/');
				if (is_uploaded_file($_FILES["site_favicon"]["tmp_name"])) {	
				$File_name2 = $_FILES["site_favicon"]["name"];
				$File_tmpname2 = $_FILES["site_favicon"]["tmp_name"];
				if (move_uploaded_file($File_tmpname2, (UPLOADDIR2.$File_name2)));
						
	}
	if($File_name != NULL && $File_name2 != NULL){
		$getdata->my_sql_update("system_info","site_logo='".$File_name."',site_favicon='".$File_name2."'",NULL);
	}else if($File_name != NULL && $File_name2 == NULL){
		$getdata->my_sql_update("system_info","site_logo='".$File_name."'",NULL);
	}else if($File_name == NULL && $File_name2 != NULL){
		$getdata->my_sql_update("system_info","site_favicon='".$File_name2."'",NULL);
	}else{
		$getdata->my_sql_update("system_info","site_title='".addslashes($_POST['site_title'])."',site_footer='".addslashes($_POST['site_footer'])."'",NULL);
	}
	$alert = '  <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_UPDATE_DATA_DONE.'</div>';
}
$getsystem_info = $getdata->my_sql_query(NULL,"system_info",NULL);
?>
 <ul class="nav nav-tabs">
                                <li class="active"><a href="#basic_setting" data-toggle="tab"><?php echo @LA_LB_STD_DATA;?></a>
                                </li>
                               <!--  <li><a href="#modules" data-toggle="tab"><?php //echo @LA_LB_ADMIN_MODULE;?></a>
                                </li>
                                  <li><a href="#other_option" data-toggle="tab">ออฟชั่นอื่น ๆ</a>
                                </li>
                              <li><a href="#lyndacloud" data-toggle="tab">เชื่อมต่อข้อมูลออนไลน์</a>
                                </li>-->
                               
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="basic_setting"><br/>
                                   
<form action="" method="post" enctype="multipart/form-data" name="form1">
 <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo @LA_LB_STD_DATA;?>
                        </div>
                        <div class="panel-body">
                          <table width="100%" border="0">
                              <tr>
                                <td width="31%"><?php echo @LA_LB_LOGO;?></td>
                                <td width="69%">
                                <img src="../media/logo/<?php echo @$getsystem_info->site_logo;?>" width="256"  alt=""/><br/><br/>
                                <div class="form-group">
                                
                                <input type="file" name="site_logo" id="site_logo" class="form-control">
                                </div></td>
                              </tr>
                              <tr>
                                <td>Favicon</td>
                                <td>
                                <img src="../media/favicon/<?php echo @$getsystem_info->site_favicon;?>" width="32" height="32"  alt=""/><br/><br/>
                                <div class="form-group">
                                
                                <input type="file" name="site_favicon" id="site_favicon" class="form-control" >
                                </div></td>
                              </tr>
                            
                              
                          </table>
                        </div>
                        <div class="panel-footer">
                               <button type="submit" name="save_info" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> <?php echo @LA_BTN_SAVE;?></button>
                        </div>
  </div>
</form>
 
                                </div>
                                                             
</div>
<script language="javascript">
function changeModuleStatus(modulekey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var es = document.getElementById('btn-'+modulekey);
	if(es.className == 'btn btn-primary btn-xs'){
		var sts= 1;
	}else{
		var sts= 0;
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			
			if(es.className == 'btn btn-primary btn-xs'){
				document.getElementById('btn-'+modulekey).className = 'btn btn-warning btn-xs';
				document.getElementById('icon-'+modulekey).className = 'fa fa-times-circle';
				document.getElementById('text-'+modulekey).innerHTML = 'ปิดใช้งาน';
			}else{
				document.getElementById('btn-'+modulekey).className = 'btn btn-primary btn-xs';
				document.getElementById('icon-'+modulekey).className = 'fa fa-check-circle';
				document.getElementById('text-'+modulekey).innerHTML = 'เปิดใช้งาน';
			}
  		}
	}
	
	xmlhttp.open("GET","../core/modules.core.php?module="+modulekey+"&sts="+sts,true);
	xmlhttp.send();
}
</script>    