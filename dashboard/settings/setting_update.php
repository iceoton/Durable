<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-refresh fa-fw"></i> <?php echo @LA_LB_UPDATE;?></h1>
     </div>        
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
  <li class="active"><?php echo @LA_LB_UPDATE;?></li>
</ol>
<?php

//update Check
updateCenter($system_info->system_version,$system_info->system_update_url);
$system_info = $getdata->my_sql_query(NULL,"system_info","1");
?>


<form id="form1" name="form1" method="post">
<div class="row">
<div class="col-lg-9">
<?php
if($system_info->system_need_update == 1){
	echo '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning fa-fw"></i> '.LA_ALERT_UPDATE.'</div>
	
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            '.LA_LB_UPDATE_DETAIL.'
                        </div>
                        <div class="panel-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                        </div>
                        <div class="panel-footer">
                          <button type="submit" name="update" class="btn btn-sm btn-warning" id="submit" ><i class="fa fa-refresh fa-fw"></i> '.LA_BTN_UPDATE_NOW.'</button>
                        </div>
                    </div>
                ';
}else{
	echo '<div class="alert alert-success alert-dismissable"><i class="fa fa-check-square fa-fw"></i> '.LA_ALERT_NOUPDATE.'</div>';
}
?>
</div>
  
                <div class="col-lg-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                           <?php echo @LA_LB_YOUR_VERSION;?>
                        </div>
                        <div class="panel-body text-version">
                         <?php echo @$system_info->system_version;?>
                        </div>
                        
                    </div>
   </div>
 </div>
</form>

 