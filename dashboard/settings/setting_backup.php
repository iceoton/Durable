<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-database fa-fw"></i> <?php echo @LA_LB_BACKUP;?></h1>
     </div>        
</div>
<ol class="breadcrumb">
   <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
  <li class="active"><?php echo @LA_LB_BACKUP;?></li>
</ol>
<?php
//$getpath = $getdata->my_sql_query("backup_path","autonumber",NULL);
if(isset($_POST['backup'])){
	require("../core/mysql_dump.core.php");
	$myFile = "../backup/".date("Y-m-d.bk").".sql";
	$fn = date("Y-m-d.bk").".sql";
	$fh = fopen($myFile, 'w') or die("can't open file");
	$showresult = $getdata->my_sql_string("SHOW TABLES;");
	while ( $row = mysql_fetch_row($showresult) ) {
  		$table = $row[0];
	    // dump data
		datadump($table, true, true);
		$stringData = datadump($table, true, true);
		fwrite($fh, $stringData);
	
	}
fclose($fh);
//mkdir($getpath->backup_path.'/lynda_backup',777,true);
//$newfile = $getpath->backup_path.'/lynda_backup/'.$fn;
//if (!copy($myFile, $newfile)) {
  //  $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> '.LA_ALERT_NOT_BACKUP_PATH_ERROR.'</div>'; 
//}
$bk=md5($fn.time("now"));
$getdata->my_sql_insert("backup_logs","backup_key='".$bk."',backup_file='".$fn."',user_key='".$_SESSION['ukey']."'");
}

if(isset($_POST['submit_restore'])){
	if (!defined('UPLOADDIR')) define('UPLOADDIR','../temp/');
				if (is_uploaded_file($_FILES["file_restore"]["tmp_name"])) {	
				$File_name = $_FILES["file_restore"]["name"];
				$File_tmpname = $_FILES["file_restore"]["tmp_name"];
				$File_ext = pathinfo($File_name, PATHINFO_EXTENSION);
				if($File_ext == 'sql'){
					if (move_uploaded_file($File_tmpname, (UPLOADDIR.$File_name)));
				}else{
					$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_FILE_FORMAT_ERROR_SQL_ONLY.'</div>'; 
				}
						
	}
	if($File_name != NULL){
		if($File_ext == 'sql'){
			require("../core/mysql_restore.core.php");
			require("../core/config.core.php");
			$restore_obj = new MySQL_Restore();
			$restore_obj->server = DB_HOST;
			$restore_obj->username = DB_USERNAME;
			$restore_obj->password = DB_PASSWORD;
			$restore_obj->database = DB_NAME;
			if (!$restore_obj->Execute('../temp/'.$File_name,MSR_FILE, false, false))
			{
				die($restore_obj->error);
			}
			$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_RESTORE_DATABASE_SUCCESS.'</div>';
		}
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>';
	}
}
echo @$alert;
?>
<script language="javascript">
	function deleteBackup(nkey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(nkey).innerHTML = '';
  		}
	}
	xmlhttp.open("GET","function.php?type=delete_backup&key="+nkey,true);
	xmlhttp.send();
}
</script>
 <ul class="nav nav-tabs">
                                <li class="active"><a href="#backup" data-toggle="tab"><?php echo @LA_LB_BACKUP;?></a>
                                </li>
                                <li><a href="#restore" data-toggle="tab"><?php echo @LA_BTN_RESTORE;?></a>
                                </li>
                               <!-- <li><a href="#cloud" data-toggle="tab">Cloud Backup</a>
                                </li>-->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="backup"><br/>
                                  <form name="form1" method="post" action="">
                                  
  <button type="submit" name="backup" class="btn btn-primary btn-sm"><i class="fa fa-database fa-fw"></i> <?php echo @LA_LB_BACKUP_NOW;?></button><?php //echo dirname(__FILE__);?></form>
<br/>
<div class="panel panel-default">
                        <div class="panel-heading">
                          ฐานข้อมูลที่สำรองไว้ทั้งหมด
                        </div>
                          <div class="table-responsive tooltipx">
  <table width="100%" border="0" class="table table-bordered  table-hover">
  <thead>
  <tr style="color:#FFF;">
    <th width="7%" align="center" bgcolor="#5fb760">#</th>
    <th width="27%" align="center" bgcolor="#5fb760"><?php echo @LA_LB_FILE_NAME;?></th>
    <th width="18%" align="center" bgcolor="#5fb760"><?php echo @LA_LB_DATE;?></th>
    <th width="19%" align="center" bgcolor="#5fb760"><?php echo @LA_LB_USER;?></th>
    <th width="29%" align="center" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $i=0;
  $getbackup = $getdata->my_sql_select(NULL,"backup_logs,user","backup_logs.user_key=user.user_key ORDER BY backup_date DESC");
  while($showbackup = mysql_fetch_object($getbackup)){
	  $i++;
  ?>
  <tr  id="<?php echo @$showbackup->backup_key;?>">
    <td align="center"><?php echo @$i;?></td>
    <td>&nbsp;<?php echo @$showbackup->backup_file;?></td>
    <td align="center"><?php echo @dateTimeConvertor($showbackup->backup_date);?></td>
    <td align="center"><?php echo @$showbackup->name."&nbsp;&nbsp;&nbsp;".$showbackup->lastname;?></td>
    <td align="center"><a href="function.php?type=download_backup&key=<?php echo @$showbackup->backup_key;?>" class="btn btn-success btn-xs"><i class="fa fa-download fa-fw"></i><?php echo @LA_BTN_DOWNLOAD;?></a><a href="settings/go_restore.php?fn=<?php echo @$showbackup->backup_file;?>" class="btn btn-warning btn-xs"><i class="fa fa-rotate-left fa-fw"></i><?php echo @LA_BTN_RESTORE;?></a><div class="btn btn-danger btn-xs" title="<?php echo @LA_BTN_DELETE;?>" onClick="javascript:deleteBackup('<?php echo @$showbackup->backup_key;?>');"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_DELETE;?></div></td>
  </tr>
  <?php
  }
  ?>
  </tbody>
</table>
</div>
</div>

                                </div>
                                <div class="tab-pane fade" id="restore"><br/>
                                  <form method="post" enctype="multipart/form-data" name="form3" id="form3">
                                    <table width="100%" border="0">
                                      <tr>
                                        <td width="91%"><div class="input-group ">
                          <span class="input-group-addon"><?php echo @LA_LB_FILE_FOR_RESTORE;?></span>
                                  
                                    <input type="file" name="file_restore" id="file_restore" class="form-control">
                                    </div></td>
                                        <td width="9%"><button type="submit" name="submit_restore" id="submit_restore" class=" btn btn-sm btn-danger"><i class="fa fa-history fa-fw"></i> <?php echo @LA_BTN_RESTORE;?></button></td>
                                      </tr>
                                    </table>
                                   
                                  </form>
                                </div>
                               <!-- <div class="tab-pane fade" id="cloud"><br/>
                                    <h4>Cloud Backup</h4>
                                  
                                </div>-->
                               
                            </div>
