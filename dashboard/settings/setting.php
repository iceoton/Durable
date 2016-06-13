<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-gear fa-fw"></i> <?php echo @LA_LB_SETTING;?></h1>
     </div>        
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active"><?php echo @LA_LB_SETTING;?></li>
</ol>
<div class="button_center">

<?php
if($system_info->system_need_update == 1){
	$software_update = 'btn-warning';
	$software_update_icon = 'fa-spin';
}else{
	$software_update = 'btn-primary';
	$software_update_icon = '';
}
?>
<div class="panel panel-primary">
     <div class="panel-heading">การตั้งค่าการใช้งาน</div>
         <div class="panel-body">
          <a href="?p=setting_card_status" class="btn btn-primary btn_main_wd"><i class="fa flaticon-tag20 fa-fw fa-6x"></i><br/><br/>สถานะการซ่อม/เคลม</a>
          <!-- <a href="?p=setting_categories" class="btn btn-primary btn_main_wd"><i class="fa flaticon-stack4 fa-fw fa-6x"></i><br/><br/>หมวดหมู่ค่าใช้จ่าย</a>
          <a href="?p=setting_products" class="btn btn-primary btn_main_wd"><i class="fa flaticon-bullet1 fa-fw fa-6x"></i><br/><br/>รายการค่าใช้จ่าย</a>-->
                
         </div>
                       
</div>   
<div class="panel panel-primary">
     <div class="panel-heading"><?php echo @LA_LB_ABOUT_SYSTEM;?></div>
         <div class="panel-body">
          <a href="?p=setting_system" class="btn btn-primary btn_main_wd"><i class="fa fa-wrench fa-fw fa-6x"></i><br/><br/><?php echo @LA_LB_SYSTEM_SETTING;?></a>
          
               <a href="?p=setting_users" class="btn btn-primary btn_main_wd"><i class="fa fa-user fa-fw fa-6x"></i><br/><br/><?php echo @LA_LB_SYSTEM_USER;?></a>
               <a href="?p=setting_backup" class="btn btn-primary btn_main_wd"><i class="fa fa-database fa-fw fa-6x"></i><br/><br/><?php echo @LA_LB_BACKUP;?></a>
                
         </div>
                       
</div>      
<div class="panel panel-primary">
     <div class="panel-heading"><?php echo @LA_LB_USER_DATA;?></div>
         <div class="panel-body">
               <a href="?p=setting_info" class="btn btn-primary btn_main_wd"><i class="fa flaticon-id fa-fw fa-6x"></i><br/><br/><?php echo @LA_LB_USER_DATA;?></a>
               
         </div>
                       
</div> 
<?php echo @accessModule('5b9c14b5d0d3466b6b41930fa42c881f','<div class="panel panel-primary">
     <div class="panel-heading">Lynda Link</div>
         <div class="panel-body">
               <a href="?p=setting_link_slide" class="btn btn-primary btn_main_wd"><i class="fa flaticon-pictures fa-fw fa-6x"></i><br/><br/>'.LA_LB_SLIDE_SHOW.'</a>
			   <a href="?p=setting_link_how_to_buy" class="btn btn-primary btn_main_wd"><i class="fa flaticon-basket8 fa-fw fa-6x"></i><br/><br/>'.LA_LB_HOW_TO_BUY.'</a>
			   <a href="?p=setting_link_how_to_pay" class="btn btn-primary btn_main_wd"><i class="fa flaticon-dollar22 fa-fw fa-6x"></i><br/><br/>'.LA_LB_HOW_TO_PAY.'</a>
			   <a href="?p=setting_link_about" class="btn btn-primary btn_main_wd"><i class="fa flaticon-information26 fa-fw fa-6x"></i><br/><br/>'.LA_LB_ABOUT_ME.'</a>
         </div>
                       
</div>');?>

<?php

if(@$_SESSION['uclass'] == 3){
?>    
<div class="panel panel-danger">
     <div class="panel-heading"><?php echo @LA_LB_ADMINISTRATOR;?></div>
         <div class="panel-body">
               <a href="?p=administrator_access_list" class="btn btn-danger btn_main_wd"><i class="fa fa-list fa-fw fa-6x"></i><br/><br/><?php echo @LA_LB_ADMIN_ACCESS_LIST;?></a>
               <a href="?p=administrator_cases" class="btn btn-danger btn_main_wd"><i class="fa fa-chain fa-fw fa-6x"></i><br/><br/><?php echo @LA_LB_ADMIN_PAGE_LINK;?></a>
               <a href="?p=administrator_menus" class="btn btn-danger btn_main_wd"><i class="fa fa-sitemap fa-fw fa-6x"></i><br/><br/><?php echo @LA_LB_ADMIN_MENU;?></a>
               <a href="?p=administrator_modules" class="btn btn-danger btn_main_wd"><i class="fa fa-puzzle-piece fa-fw fa-6x"></i><br/><br/><?php echo @LA_LB_ADMIN_MODULE;?></a>
               <a href="?p=administrator_helper" class="btn btn-danger btn_main_wd"><i class="fa flaticon-ring7 fa-fw fa-6x"></i><br/><br/><?php echo @LA_LB_HELP;?></a>
               
         </div>
                       
</div>         
<?php
}
?>
</div>