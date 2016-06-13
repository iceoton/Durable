<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-gear fa-fw"></i> จัดการข้อมูลสมาชิก</h1>
     </div>        
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li><a href="?p=member"><?php echo @LA_LB_MEMBER;?></a></li>
  <li class="active">จัดการข้อมูลสมาชิก</li>
</ol>
<script language="javascript">
function redirectLink(url) {
    return function () {
        window.location.replace(url);
    };
}
</script>
<?php
if(isset($_POST['save_member_info'])){
	if(addslashes($_POST['member_name']) != NULL && addslashes($_POST['member_lastname']) != NULL){
		if (!defined('UPLOADDIR')) define('UPLOADDIR','../resource/members/images/');
				if (is_uploaded_file($_FILES["member_photo"]["tmp_name"])) {	
				$File_name = $_FILES["member_photo"]["name"];
				$File_tmpname = $_FILES["member_photo"]["tmp_name"];
				$File_ext = pathinfo($File_name, PATHINFO_EXTENSION);
				$newfilename = md5(time("now")).'.'.$File_ext;
				if (move_uploaded_file($File_tmpname, (UPLOADDIR.$newfilename)));
	}
	$member_key = md5(addslashes($_POST['member_name']).time("now"));
	$member_born = addslashes($_REQUEST['year']).'-'.addslashes($_REQUEST['month']).'-'.addslashes($_REQUEST['day']);
	if($File_name != NULL){
		resizeMemberThumb($File_ext,$newfilename);
		$getdata->my_sql_update("member","member_name='".addslashes($_POST['member_name'])."',member_lastname='".addslashes($_POST['member_lastname'])."',member_passport='".addslashes($_POST['member_passport'])."',member_pid='".addslashes($_POST['member_pid'])."',member_tax_id='".addslashes($_POST['member_tax_id'])."',member_born='".$member_born."',member_nationality='".addslashes($_POST['member_nationality'])."',member_religion='".addslashes($_POST['member_religion'])."',member_photo='".$newfilename."',member_address='".addslashes($_POST['member_address'])."',member_address_now='".addslashes($_POST['member_address_now'])."',member_tel='".addslashes($_POST['member_phone'])."',member_email='".addslashes($_POST['member_email'])."',member_relative_name='".addslashes($_POST['member_relative_name'])."',member_relative='".addslashes($_POST['member_relative'])."',member_status='".addslashes($_REQUEST['member_status'])."',member_group='".addslashes($_REQUEST['member_group'])."'","member_key='".addslashes($_GET['key'])."'");
		$getdata->my_sql_update("user","name='".addslashes($_POST['member_name'])."',lastname='".addslashes($_POST['member_lastname'])."',user_photo='".$newfilename."',email='".addslashes($_POST['member_email'])."',user_status='".addslashes($_REQUEST['member_status'])."'","user_key='".addslashes($_GET['key'])."'");
	}else{
		$getdata->my_sql_update("member","member_name='".addslashes($_POST['member_name'])."',member_lastname='".addslashes($_POST['member_lastname'])."',member_passport='".addslashes($_POST['member_passport'])."',member_pid='".addslashes($_POST['member_pid'])."',member_tax_id='".addslashes($_POST['member_tax_id'])."',member_born='".$member_born."',member_nationality='".addslashes($_POST['member_nationality'])."',member_religion='".addslashes($_POST['member_religion'])."',member_address='".addslashes($_POST['member_address'])."',member_address_now='".addslashes($_POST['member_address_now'])."',member_tel='".addslashes($_POST['member_phone'])."',member_email='".addslashes($_POST['member_email'])."',member_relative_name='".addslashes($_POST['member_relative_name'])."',member_relative='".addslashes($_POST['member_relative'])."',member_status='".addslashes($_REQUEST['member_status'])."',member_group='".addslashes($_REQUEST['member_group'])."'","member_key='".addslashes($_GET['key'])."'");
		$getdata->my_sql_update("user","name='".addslashes($_POST['member_name'])."',lastname='".addslashes($_POST['member_lastname'])."',email='".addslashes($_POST['member_email'])."',user_status='".addslashes($_REQUEST['member_status'])."'","user_key='".addslashes($_GET['key'])."'");
	}
		$alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>แก้ไขข้อมูลผู้ใช้งาน สำเร็จ</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
}
if(isset($_POST['submit_bank'])){
	$getdata->my_sql_update("member","member_bank_name='".addslashes($_POST['member_bank_name'])."',member_bank_acc='".addslashes($_POST['member_bank_acc'])."',member_bank_acc_name='".addslashes($_POST['member_bank_acc_name'])."',member_bank_type='".addslashes($_POST['member_bank_type'])."',member_bank_branch='".addslashes($_POST['member_bank_branch'])."'","member_key='".addslashes($_GET['key'])."'");
	$alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>แก้ไขข้อมูลบัญชีธนาคาร สำเร็จ</div>';
}
if(isset($_POST['save_info_login'])){
	if(addslashes($_POST['member_username'])!= NULL && addslashes($_POST['member_password']) != NULL){
		$check_old =  $getdata->my_sql_query("username","user","user_key='".addslashes($_GET['key'])."'");
		$check = $getdata->my_sql_show_rows("user","username='".addslashes($_POST['member_username'])."'");
		if($check != 0 && $check_old->username != addslashes($_POST['member_username'])){
			$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ชื่อผู้ใช้งานนี้ไม่พร้อมใช้งาน</div>';
		}else{
			$getdata->my_sql_update("user","username='".addslashes($_POST['member_username'])."',password='".md5(addslashes($_POST['member_password']))."'","user_key='".addslashes($_GET['key'])."'");
			$getdata->my_sql_update("member","member_password='".addslashes($_POST['member_password'])."'","member_key='".addslashes($_GET['key'])."'");
			$alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>แก้ไขข้อมูลผู้ใช้งาน สำเร็จ</div>';
		}
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
}

if(isset($_POST['save_acc_close'])){
	$getdata->my_sql_update("member","member_status='2'","member_key='".addslashes($_GET['key'])."'");
	$getdata->my_sql_update("user","user_status='2'","user_key='".addslashes($_GET['key'])."'");
	$alert = '  <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ทำการปิดบัญชีของสมาชิก สำเร็จ กำลังพาท่านไปยังหน้าสมาชิกทั้งหมด...</div>';
		echo '<script>javascript:setTimeout(redirectLink("?p=member"), 3000);</script>';
}
if(isset($_POST['save_acc_transfer'])){
	if(addslashes($_POST['point_transfer']) <= addslashes($_POST['h_point_member']) && addslashes($_POST['point_transfer']) != NULL && addslashes($_POST['point_transfer']) != '0'){
		if(addslashes($_REQUEST['member_receipt']) != NULL){
			$point_key = md5(addslashes($_GET['key']).time("now"));
			$getdata->my_sql_update("member","`member_point`=`member_point`-".addslashes($_POST['point_transfer'])."","member_key='".addslashes($_GET['key'])."'");
			
			$getdata->my_sql_update("member","`member_point`=`member_point`+".addslashes($_POST['point_transfer'])."","member_key='".addslashes($_REQUEST['member_receipt'])."'");
			$getdata->my_sql_insert("point_logs","point_key='".$point_key."',transfer_reciept='".addslashes($_REQUEST['member_receipt'])."',transfer_member='".addslashes($_GET['key'])."',user_key='".$_SESSION['ukey']."',point_type='2',point_transfer='".addslashes($_POST['point_transfer'])."'");
			$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>โอนย้ายแต้มสะสม สำเร็จ</div>';
			
		}else{
			$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 	
		}
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
}
$member_detail = $getdata->my_sql_query(NULL,"member,user","member.member_key='".addslashes($_GET['key'])."' AND member.member_key=user.user_key");
echo @$alert;

$tab1h=$tab1=$tab2h=$tab3h=$tab2=$tab3=NULL;
if(addslashes($_GET['tab']) == NULL){
	$tab1h = 'class="active"';$tab1 = 'in active';
}
switch(addslashes($_GET['tab'])){
	case "1" : $tab1h = 'class="active"';$tab1 = 'in active';
	break;
	case "2" : $tab2h = 'class="active"';$tab2 = 'in active';
	break;
	case "3" : $tab3h = 'class="active"';$tab3 = 'in active';
	break;
	case "4" : $tab4h = 'class="active"';$tab4 = 'in active';
	break;
}
?>
 <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li <?php echo @$tab1h;?>><a href="#general" data-toggle="tab">ข้อมูลทั่วไป</a>
                                </li>
                                 <li <?php echo @$tab4h;?>><a href="#bank" data-toggle="tab">ข้อมูลบัญชีธนาคาร</a>
                                </li>
                                <li <?php echo @$tab2h;?>><a href="#userlogin" data-toggle="tab">ข้อมูลเข้าใช้งานระบบ</a>
                                </li>
                                <li <?php echo @$tab3h;?>><a href="#usertransfer" data-toggle="tab">ปิดบัญชีสมาชิก/โอนย้ายแต้ม</a>
                                </li>
                                
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div class="tab-pane fade <?php echo @$tab1;?> " id="general"><br/>
                                <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="?p=member_detail&key=<?php echo @addslashes($_GET['key']);?>&tab=1">
                                <div class="panel panel-green">
                                <div class="panel-heading">
                                    ข้อมูลทั่วไปของสมาชิก
                                </div>
                                <div class="panel-body">
                                
                                    <div class="form-group">
                                            <label for="member_code"><?php echo @LA_LB_CODE;?></label>
                                            <input type="text" name="member_code" id="member_code" class="form-control" value="<?php echo @$member_detail->member_code;?>" readonly>
                                          </div>
                                         <div class="row form-group">
                                          
                                            <div class="col-md-6"> <label for="member_name"><?php echo @LA_LB_NAME;?></label>
                                              <input type="text" name="member_name" id="member_name" class="form-control" value="<?php echo @$member_detail->member_name;?>"></div>
                                            <div class="col-md-6"><label for="member_lastname"><?php echo @LA_LB_LASTNAME;?></label>
                                               <input type="text" name="member_lastname" id="member_lastname" class="form-control" value="<?php echo @$member_detail->member_lastname;?>"> </div>
                                            </div>
                                            
                                            
                                            <div class="row form-group">
                                          
                                            <div class="col-md-6"><label for="member_passport">หมายเลขพาสปอร์ต</label>
                                               <input type="text" name="member_passport" id="member_passport" class="form-control" value="<?php echo @$member_detail->member_passport;?>"></div>
                                            <div class="col-md-6"><label for="member_pid">หมายเลขบัตรประจำตัวประชาชน</label>
                                               <input type="text" name="member_pid" id="member_pid" class="form-control" value="<?php echo @$member_detail->member_pid;?>"></div>
                                            </div>
                                            
                                           
                                            
                                            <div class="row form-group">
                                            <div class="col-md-6"><label for="member_tax_id">หมายเลขประจำตัวผู้เสียภาษี</label>
                                               <input type="text" name="member_tax_id" id="member_tax_id" class="form-control" value="<?php echo @$member_detail->member_tax_id;?>"></div>
                                          <div class="col-md-2">
                                          <?php
										  $md = explode("-",$member_detail->member_born);
										  ?>
                                          <label for="day">วันเกิด</label>
                                                  <select name="day" id="day" class="form-control">
                                                  <option value="0" selected>วันที่</option>
                                                  <?php
														  for($d=1;$d<=31;$d++){
															  if($md[2] == $d){
																   echo '<option value="'.$d.'" selected>'.$d.'</option>';
															  }else{
																   echo '<option value="'.$d.'">'.$d.'</option>';
															  }
															 
														  }
														?>
                                                  </select>
                                                </div>
                                                <div class="col-md-2">
                                                <label for="day">&nbsp;</label>
                                                  <select name="month" id="month" class="form-control">
                                                  <option value="0" selected>เดือน</option>
                                                  <?php 
			  $mlabel = array('มกราคม','กุมพาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
			  for($m=1;$m<=12;$m++){
			  	if($md[1] == $m){
					  echo '<option value="'.$m.'" selected>'.$mlabel[$m-1].'</option>';
			  	}else{
					  echo '<option value="'.$m.'">'.$mlabel[$m-1].'</option>';
				}
			  }
			  ?>
                                                  </select>
                                                </div>
                                                <div class="col-md-2">
                                                <label for="day">&nbsp;</label>
                                                <select name="year" id="year"class="form-control">
                                                <option value="0" selected>ปีเกิด</option>
                                                  <?php
														  for($y=date("Y");$y>=1980;$y--){
															  if($md[0] == $y){
																  echo '<option value="'.$y.'" selected>'.($y+543).'</option>';  
															  }else{
																  echo '<option value="'.$y.'">'.($y+543).'</option>';
															  }
															  
														  }
														?>
                                                  </select></div>
                                          </div>
                                          
                                         
                                            <div class="row form-group">
                                          
                                            <div class="col-md-6"><label for="member_nationality">สัญชาติ</label>
                                               <input type="text" name="member_nationality" id="member_nationality" value="<?php echo @$member_detail->member_nationality;?>" class="form-control"></div>
                                            <div class="col-md-6"><label for="member_religion">ศาสนา</label>
                                               <input type="text" name="member_religion" id="member_religion" value="<?php echo @$member_detail->member_religion;?>" class="form-control"></div>
                                            </div>
                                           
                                            <div class="row form-group">
                                            <div class="col-md-3"><center><div class="box_img_cyclex"><img src="../resource/members/thumbs/<?php echo @$member_detail->member_photo;?>" <?php echo getPhotoSize('../../resource/members/thumbs/'.@$member_detail->member_photo.'');?> id="img_cyclex"  alt=""/></div></center></div>
                                            <div class="col-md-9"> 
                                               <label for="member_photo"><?php echo @LA_LB_PHOTO;?></label>
                                               <input type="file" name="member_photo" id="member_photo"  class="form-control">
                                             </div>
                                            </div>
                                           
                                            <div class="row form-group">
                                            <div class="col-md-6"><label for="member_address"><?php echo @LA_LB_ADDRESS;?>ตามบัตรประจำตัวประชาชน</label>
                                               <textarea name="member_address" id="member_address" class="form-control"><?php echo @$member_detail->member_address;?></textarea></div>
                                            <div class="col-md-6"><label for="member_address_now"><?php echo @LA_LB_ADDRESS;?>ปัจจุบัน</label> <button type="button" name="button" id="button" class="btn btn-xs btn-info" onClick="javascript:copyAddress();">ใช้ที่อยู่เดียวกัน</button>
                                               <textarea name="member_address_now" id="member_address_now" class="form-control"><?php echo @$member_detail->member_address_now;?></textarea></div>
                                               
                                            </div>
                                          
                                             <div class="row form-group">
                                          <div class="col-md-6"><label for="member_phone"><?php echo @LA_LB_MEMBER_PHONE_NUMBER;?></label>
                                               <input type="text" name="member_phone" id="member_phone" class="form-control" value="<?php echo @$member_detail->member_tel;?>"></div>
                                            <div class="col-md-6"><label for="member_email"><?php echo @LA_LB_EMAIL;?></label>
                                               <input type="text" name="member_email" id="member_email" class="form-control" value="<?php echo @$member_detail->member_email;?>"></div>
                                            </div>
                                             
                                            <div class="row form-group">
                                          <div class="col-md-6"><label for="member_relative_name">ชื่อ-สกุล ผู้รับผลประโยชน์</label>
                                               <input type="text" name="member_relative_name" id="member_relative_name" value="<?php echo @$member_detail->member_relative_name;?>" class="form-control"></div>
                                           <div class="col-md-6"><label for="member_relative">ความสัมพันธ์</label>
                                               <input type="text" name="member_relative" id="member_relative" value="<?php echo @$member_detail->member_relative;?>" class="form-control"></div>
                                          </div>
                                          <?php
										  if($member_detail->member_ref != NULL){
										  ?>
                                  <div class="form-group">
                                    <label for="member_ref">ผู้แนะนำ</label>
                                    <input type="text" name="member_ref" id="member_ref" class="form-control" value="<?php @$refx = $getdata->my_sql_query("member_name,member_lastname,member_code","member","member_key='".@$member_detail->member_ref."'"); echo '['.@$refx->member_code.'] '.@$refx->member_name.'&nbsp;&nbsp;&nbsp;'.@$refx->member_lastname;?>" readonly>
                                    </div>
                                    <?php
										  }
									?>
                                            <div class="row form-group">
                                            <div class="col-md-6">
                                               <label for="member_group"><?php echo @LA_LB_GROUP;?></label>
                                               <select name="member_group" id="select" class="form-control">
                                               <?php 
											   $getgroup = $getdata->my_sql_select(NULL,"member_group","grp_status='1' ORDER BY grp_name");
											   while($showgroup = mysql_fetch_object($getgroup)){
												   if($member_detail->member_group == $showgroup->grp_key){
													   echo '<option value="'.$showgroup->grp_key.'" selected>'.$showgroup->grp_name.'</option>';
												   }else{
													   echo '<option value="'.$showgroup->grp_key.'">'.$showgroup->grp_name.'</option>';
												   }
												   
											   }
											   ?>
                                               </select>
                                             </div>
                                            <div class="col-md-6">
                                              <label for="member_status"><?php echo @LA_LB_STATUS;?></label>
                                              <select name="member_status" id="member_status" class="form-control">
                                              <?php
											  if($member_detail->member_status == 1){
												  $a='selected="selected"';$b='';
											  }else{
												  $b='selected="selected"';$a='';
											  }
											  ?>
                                                <option value="1" <?php echo @$a;?>><?php echo @LA_BTN_SHOW;?></option>
                                                <option value="0" <?php echo @$b;?>><?php echo @LA_BTN_HIDE;?></option>
                                              
                                              </select>
                                            </div>
                                            </div>
                                             
                                             
                                            
                                </div>
                                <div class="panel-footer" align="center">
                                  <button type="submit" name="save_member_info" id="submit" class="btn btn-sm btn-success"><i class="fa fa-save fa-fw"></i> บันทึกข้อมูล</button>
                                </div>
                                </div>
                                </form>
                                </div>
                                <div class="tab-pane fade <?php echo @$tab2;?>" id="userlogin"><br/>
                                  <form id="form2" name="form2" method="post" action="?p=member_detail&key=<?php echo @addslashes($_GET['key']);?>&tab=2">
                                   <div class="panel panel-yellow">
                        <div class="panel-heading">
                            ข้อมูลเข้าใช้ใช้งานระบบ
                        </div>
                        <div class="panel-body">
                            <div class="row form-group">
                            <div class="col-md-5">
                              <label for="member_username"><?php echo @LA_LB_USERNAME;?></label>
                              <input type="text" name="member_username" id="member_username" class="form-control" value="<?php echo @$member_detail->username;?>">
                            </div>
                             
                            <div class="col-md-5">
                              <label for="member_password"><?php echo @LA_LB_PASSWORD;?></label>
                              <input type="text" name="member_password" id="member_password" value="<?php echo @$member_detail->member_password;?>" class="form-control">
                            </div>
                            <div class="col-md-2"><br/>
                              <button type="button" name="button2" id="button2" onClick="javascript:randomPassword('member_password','1','','6');" class="btn btn-sm btn-warning"><i class="fa fa-random fa-fw"></i> สุ่มรหัส</button>
                            </div>
                            </div>
                        </div>
                        <div class="panel-footer" align="center">
                          <button type="submit" name="save_info_login" class="btn btn-sm btn-warning"><i class="fa fa-lock fa-fw"></i> บันทึกข้อมูล</button>
                        </div>
                    </div>
                                  </form>
                                </div>
<div class="tab-pane fade <?php echo @$tab4;?>" id="bank"><br/>
  <form id="form4" name="form4" method="post" action="?p=member_detail&key=<?php echo @addslashes($_GET['key']);?>&tab=4">
  <div class="panel panel-primary">
                        <div class="panel-heading">
                            ข้อมูลบัญชีธนาคารสำหรับโอนค่าคอมมิชชั่น
                        </div>
                        <div class="panel-body">
                        <div class="row form-group">
                          <div class="col-md-6">
                            <label for="member_bank_name">ธนาคาร</label>
                            <input type="text" name="member_bank_name" id="member_bank_name" class="form-control" value="<?php echo @$member_detail->member_bank_name;?>">
                          </div>
                          <div class="col-md-6">
                            <label for="member_bank_type">ประเภทบัญชี</label>
                            <input type="text" name="member_bank_type" id="member_bank_type" value="<?php echo @$member_detail->member_bank_type;?>" class="form-control">
                          </div>
                         </div>
                        
                        <div class="row form-group">
                        <div class="col-md-6">
                         
                              <label for="member_bank_acc">เลขบัญชี</label>
                              <input type="text" name="member_bank_acc" id="member_bank_acc" value="<?php echo @$member_detail->member_bank_acc;?>" class="form-control">
                            
                        </div>
                        <div class="col-md-6">
                        
                              <label for="member_bank_acc_name">ชื่อบัญชี</label>
                              <input type="text" name="member_bank_acc_name" id="member_bank_acc_name" value="<?php echo @$member_detail->member_bank_acc_name;?>" class="form-control">
                           
                            </div>
                        </div>
                          <div class="row form-group"><div class="col-md-6">  <label for="member_bank_branch">สาขา</label>
                              <input type="text" name="member_bank_branch" id="member_bank_branch" value="<?php echo @$member_detail->member_bank_branch;?>" class="form-control"></div></div>
      </div>
                        <div class="panel-footer" align="center">
                          <button type="submit" name="submit_bank" id="submit_bank" class="btn btn-sm btn-primary"><i class="fa fa-save fa-fw"></i> บันทึก</button>
                        </div>
    </div>
  </form>
  </div>
                                <div class="tab-pane fade <?php echo @$tab3;?>" id="usertransfer"><br/>
                                  <form id="form3" name="form3" method="post" action="?p=member_detail&key=<?php echo @addslashes($_GET['key']);?>&tab=3">
                                  <div class="row">
                                  <div class="col-md-6"> <div class="panel panel-info">
                        <div class="panel-heading">
                            โอนย้ายแต้มสะสม
                        </div>
                        <div class="panel-body">
                           <div class="row form-group">
                           <div class="col-md-4">แต้มสะสมทั้งหมด</div>
                           <div class="col-md-8"><?php echo @number_format($member_detail->member_point);?>&nbsp;แต้ม
                             <input type="hidden" name="h_point_member" id="h_point_member" value="<?php echo $member_detail->member_point;?>">
                           </div>
                           </div>
                           
                           <div class="row form-group">
                           <div class="col-md-4">ผู้รับแต้มสะสม</div>
                           <div class="col-md-8"> <select  id="member_receipt" class="form-control combobox" name="member_receipt" autofocus>
                                           <option></option>
                                           <?php
										   $getmember = $getdata->my_sql_select(NULL,"member","member_status='1' AND member_key <> '".addslashes($_GET['key'])."' ORDER BY member_code");
										   while($showmember = mysql_fetch_object($getmember)){
											   echo '<option value="'.$showmember->member_key.'">['.$showmember->member_code.']&nbsp;'.$showmember->member_name.'&nbsp;&nbsp;&nbsp;'.$showmember->member_lastname.'</option>';
										   }
										   ?>
                                            </select></div>
                           </div>
                           
                           <div class="row form-group">
                           <div class="col-md-4">จำนวนที่โอนแต้ม</div>
                           <div class="col-md-8">
                            
                             <input type="text" name="point_transfer" id="point_transfer" class="form-control" value="<?php echo @$member_detail->member_point;?>">
                           </div>
                           </div>
                        </div>
                        <div class="panel-footer" align="center">
                            <button type="submit" name="save_acc_transfer" class="btn btn-sm btn-info"><i class="fa fa-refresh fa-fw"></i> โอนย้ายแต้มสะสม</button>
                        </div>
                        </div></div>
                                  <div class="col-md-6">
                                    <div class="panel panel-red">
                        <div class="panel-heading">
                            ปิดบัญชีสมาชิก
                        </div>
                        <div class="panel-body" align="center">
                           ข้อมูลของสมาชิกจะถูกลบออกจากระบบแต่ประวัติการสั่งซื้อย้อนหลังจะยังคงอยู่ แต่สมาชิกจะไม่สามารถเข้าใช้งานระบบได้อีกต่อไป
                        </div>
                        <div class="panel-footer" align="center">
                            <button type="submit" name="save_acc_close" class="btn btn-sm btn-danger"><i class="fa fa-power-off fa-fw"></i> ปิดบัญชี</button>
                        </div>
                        </div>
                        
                        </div>
                        
                                </div>
                              
                                  </form>
                            </div>
   <script language="javascript">
   function copyAddress(){
		var addr = document.getElementById('member_address').value;
		document.getElementById('member_address_now').value = addr;
	}
	function randomPassword(password_id,password_pattern,password_prefix,password_length){
	 var text = "";
	 if(password_pattern == 1){
		 var possible = "0123456789";
	 }else if(password_pattern == 2){
		 var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	 }else if(password_pattern == 3){
		 var possible = "abcdefghijklmnopqrstuvwxyz";
	 }else if(password_pattern == 4){
		 var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	 }else if(password_pattern == 5){
		 var possible = "abcdefghijklmnopqrstuvwxyz0123456789";
	 }else if(password_pattern == 6){
		 var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	 }else{
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; 
	 }

    for( var i=0; i < password_length; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    document.getElementById(password_id).value = password_prefix+text;
}


   </script>