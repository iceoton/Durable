<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-user-plus fa-fw"></i> เพิ่มสมาชิกใหม่</h1>
     </div>        
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li><a href="?p=member"><?php echo @LA_LB_MEMBER;?></a></li>
  <li class="active">เพิ่มสมาชิกใหม่</li>
</ol>
<?php
if(isset($_POST['save_member'])){
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
		$getdata->my_sql_insert("member","member_key='".$member_key."',member_ref='".addslashes($_REQUEST['member_ref'])."',member_code='".addslashes($_POST['member_code'])."',member_name='".addslashes($_POST['member_name'])."',member_lastname='".addslashes($_POST['member_lastname'])."',member_password='".addslashes($_POST['member_password'])."',member_passport='".addslashes($_POST['member_passport'])."',member_pid='".addslashes($_POST['member_pid'])."',member_tax_id='".addslashes($_POST['member_tax_id'])."',member_born='".$member_born."',member_nationality='".addslashes($_POST['member_nationality'])."',member_religion='".addslashes($_POST['member_religion'])."',member_photo='".$newfilename."',member_address='".addslashes($_POST['member_address'])."',member_address_now='".addslashes($_POST['member_address_now'])."',member_tel='".addslashes($_POST['member_phone'])."',member_email='".addslashes($_POST['member_email'])."',member_relative_name='".addslashes($_POST['member_relative_name'])."',member_relative='".addslashes($_POST['member_relative'])."',member_bank_name='".addslashes($_POST['member_bank_name'])."',member_bank_acc='".addslashes($_POST['member_bank_acc'])."',member_bank_acc_name='".addslashes($_POST['member_bank_acc_name'])."',member_bank_type='".addslashes($_POST['member_bank_type'])."',member_bank_branch='".addslashes($_POST['member_bank_branch'])."',member_status='".addslashes($_REQUEST['member_status'])."',member_group='".addslashes($_REQUEST['member_group'])."'");
		$getdata->my_sql_insert("user","user_key='".$member_key."',name='".addslashes($_POST['member_name'])."',lastname='".addslashes($_POST['member_lastname'])."',username='".addslashes($_POST['member_code'])."',password='".md5(addslashes($_POST['member_password']))."',user_photo='".$newfilename."',user_class='1',user_language='th',email='".addslashes($_POST['member_email'])."',user_status='".addslashes($_REQUEST['member_status'])."'");
	}else{
		$getdata->my_sql_insert("member","member_key='".$member_key."',member_ref='".addslashes($_REQUEST['member_ref'])."',member_code='".addslashes($_POST['member_code'])."',member_name='".addslashes($_POST['member_name'])."',member_lastname='".addslashes($_POST['member_lastname'])."',member_password='".addslashes($_POST['member_password'])."',member_passport='".addslashes($_POST['member_passport'])."',member_pid='".addslashes($_POST['member_pid'])."',member_tax_id='".addslashes($_POST['member_tax_id'])."',member_born='".$member_born."',member_nationality='".addslashes($_POST['member_nationality'])."',member_religion='".addslashes($_POST['member_religion'])."',member_address='".addslashes($_POST['member_address'])."',member_address_now='".addslashes($_POST['member_address_now'])."',member_tel='".addslashes($_POST['member_phone'])."',member_email='".addslashes($_POST['member_email'])."',member_relative_name='".addslashes($_POST['member_relative_name'])."',member_relative='".addslashes($_POST['member_relative'])."',member_bank_name='".addslashes($_POST['member_bank_name'])."',member_bank_acc='".addslashes($_POST['member_bank_acc'])."',member_bank_acc_name='".addslashes($_POST['member_bank_acc_name'])."',member_bank_type='".addslashes($_POST['member_bank_type'])."',member_bank_branch='".addslashes($_POST['member_bank_branch'])."',member_status='".addslashes($_REQUEST['member_status'])."',member_group='".addslashes($_REQUEST['member_group'])."'");
		$getdata->my_sql_insert("user","user_key='".$member_key."',name='".addslashes($_POST['member_name'])."',lastname='".addslashes($_POST['member_lastname'])."',username='".addslashes($_POST['member_code'])."',password='".md5(addslashes($_POST['member_password']))."',user_class='1',user_language='th',email='".addslashes($_POST['member_email'])."',user_status='".addslashes($_REQUEST['member_status'])."'");
	}
	
		updateMember();
		$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_INSERT_MEMBER_DATA_DONE.'</div>';
		echo '<script>window.location="?p=member";</script>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
}

echo @$alert;
?>
<form name="form1" method="post" action="" enctype="multipart/form-data">
 <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo @LA_LB_INSERT_MEMBER_DATA;?>
                        </div>
                        <div class="panel-body">
                             <div class="form-group">
                                            <label for="member_code"><?php echo @LA_LB_CODE;?>สมาชิก</label>
                                            <input type="text" name="member_code" id="member_code" class="form-control" value="<?php echo @memberNumber();?>" readonly>
                                          </div>
                                            <div class="form-group">
                                            <div class="row">
                                          
                                            <div class="col-md-6"> <label for="member_name"><?php echo @LA_LB_NAME;?></label>
                                              <input type="text" name="member_name" id="member_name" class="form-control"></div>
                                            <div class="col-md-6"><label for="member_lastname"><?php echo @LA_LB_LASTNAME;?></label>
                                               <input type="text" name="member_lastname" id="member_lastname" class="form-control"> </div>
                                            </div>
                                            </div>
                                             <div class="form-group">
                                            <div class="row">
                                          
                                            <div class="col-md-6"><label for="member_passport">หมายเลขพาสปอร์ต</label>
                                               <input type="text" name="member_passport" id="member_passport" class="form-control"></div>
                                            <div class="col-md-6"><label for="member_pid">หมายเลขบัตรประจำตัวประชาชน</label>
                                               <input type="text" name="member_pid" id="member_pid" class="form-control"></div>
                                            </div>
                                            </div>
                                           
                                             <div class="form-group">
                                            <div class="row">
                                            <div class="col-md-6"><label for="member_tax_id">หมายเลขประจำตัวผู้เสียภาษี</label>
                                               <input type="text" name="member_tax_id" id="member_tax_id" class="form-control"></div>
                                          <div class="col-md-2">
                                          
                                          <label for="day">วันเกิด</label>
                                                  <select name="day" id="day" class="form-control">
                                                  <option value="0" selected>วันที่</option>
                                                  <?php
														  for($d=1;$d<=31;$d++){
															  echo '<option value="'.$d.'">'.$d.'</option>';
														  }
														?>
                                                  </select>
                                                </div>
                                                <div class="col-md-2">
                                                <label for="day">&nbsp;</label>
                                                  <select name="month" id="month" class="form-control">
                                                  <option value="0" selected>เดือน</option>
                                                    <option value="1" >มกราคม</option>
                                                    <option value="2">กุมพาพันธ์</option>
                                                    <option value="3">มีนาคม</option>
                                                    <option value="4">เมษายน</option>
                                                    <option value="5">พฤษภาคม</option>
                                                    <option value="6">มิถุนายน</option>
                                                    <option value="7">กรกฎาคม</option>
                                                    <option value="8">สิงหาคม</option>
                                                    <option value="9">กันยายน</option>
                                                    <option value="10">ตุลาคม</option>
                                                    <option value="11">พฤศจิกายน</option>
                                                    <option value="12">ธันวาคม</option>
                                                  </select>
                                                </div>
                                                <div class="col-md-2">
                                                <label for="day">&nbsp;</label>
                                                <select name="year" id="year"class="form-control">
                                                <option value="0" selected>ปีเกิด</option>
                                                  <?php
														  for($y=date("Y");$y>=1920;$y--){
															  echo '<option value="'.$y.'">'.($y+543).'</option>';
														  }
														?>
                                                  </select></div>
                                          </div>
                                          </div>
                                            <div class="form-group">
                                            <div class="row">
                                          
                                            <div class="col-md-6"><label for="member_nationality">สัญชาติ</label>
                                               <input type="text" name="member_nationality" id="member_nationality" class="form-control"></div>
                                            <div class="col-md-6"><label for="member_religion">ศาสนา</label>
                                               <input type="text" name="member_religion" id="member_religion" class="form-control"></div>
                                            </div>
                                            </div>
                                             <div class="form-group">
                                               <label for="member_photo"><?php echo @LA_LB_PHOTO;?></label>
                                               <input type="file" name="member_photo" id="member_photo"  class="form-control">
                                             </div>
                                             <div class="form-group">
                                               <label for="member_address"><?php echo @LA_LB_ADDRESS;?>ตามบัตรประจำตัวประชาชน</label>
                                               <textarea name="member_address" id="member_address" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                               <label for="member_address_now"><?php echo @LA_LB_ADDRESS;?>ปัจจุบัน</label>
                                               <button type="button" name="button" id="button" class="btn btn-xs btn-info" onClick="javascript:copyAddress();">ใช้ที่อยู่เดียวกัน</button>
<textarea name="member_address_now" id="member_address_now" class="form-control"></textarea>
                                            </div>
                                             <div class="form-group">
                                             <div class="row">
                                          <div class="col-md-6"><label for="member_phone"><?php echo @LA_LB_MEMBER_PHONE_NUMBER;?></label>
                                               <input type="text" name="member_phone" id="member_phone" class="form-control"></div>
                                            <div class="col-md-6"><label for="member_email"><?php echo @LA_LB_EMAIL;?></label>
                                               <input type="text" name="member_email" id="member_email" class="form-control"></div>
                                            </div>
                                               
                                            </div>
                                           
                                            <div class="form-group">
                                            <div class="row">
                                          <div class="col-md-6"><label for="member_relative_name">ชื่อ-สกุล ผู้รับผลประโยชน์</label>
                                               <input type="text" name="member_relative_name" id="member_relative_name" class="form-control"></div>
                                           <div class="col-md-6"><label for="member_relative">ความสัมพันธ์</label>
                                               <input type="text" name="member_relative" id="member_relative" class="form-control"></div>
                                          </div>
                                             
                                            </div>
                                          
                                            <div class="form-group">
                                            <label for="member_ref">ผู้แนะนำ</label>
                                             <select  id="member_ref" class="form-control combobox" name="member_ref">
                                           <option></option>
                                           <?php
										   $getmember = $getdata->my_sql_select(NULL,"member","member_status='1' ORDER BY member_code");
										   while($showmember = mysql_fetch_object($getmember)){
											   echo '<option value="'.$showmember->member_key.'">['.$showmember->member_code.']&nbsp;'.$showmember->member_name.'&nbsp;&nbsp;&nbsp;'.$showmember->member_lastname.'</option>';
										   }
										   ?>
                                            </select>
                                            </div>
                                            <div class="row form-group">
                                            <div class="col-md-9">
                                              <label for="member_password">รหัสผ่าน</label>
                                              <input type="text" name="member_password" id="member_password" class="form-control"  value="<?php echo @RandomString(1,'',6);?>">
                                            </div>
                                            <div class="col-md-3"><br/>
                                              <button type="button" name="button2" id="button2" onClick="javascript:randomPassword('member_password','1','','6');" class="btn btn-sm btn-warning"><i class="fa fa-random fa-fw"></i> สุ่มรหัส</button>
                                            </div>
                                            </div>
                                             <div class="row form-group">
                          <div class="col-md-6">
                            <label for="member_bank_name">ธนาคาร</label>
                            <input type="text" name="member_bank_name" id="member_bank_name" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <label for="member_bank_type">ประเภทบัญชี</label>
                            <input type="text" name="member_bank_type" id="member_bank_type" class="form-control">
                          </div>
                         </div>
                        
                        <div class=" form-group">
                        <label for="member_bank_acc">เลขบัญชี</label>
                              <input type="text" name="member_bank_acc" id="member_bank_acc" class="form-control">
                         </div>
                        <div class=" form-group"> <label for="member_bank_acc_name">ชื่อบัญชี</label>
                              <input type="text" name="member_bank_acc_name" id="member_bank_acc_name" class="form-control"></div>
                          <div class=" form-group"> <label for="member_bank_branch">สาขา</label>
                              <input type="text" name="member_bank_branch" id="member_bank_branch" class="form-control"></div>
                                             <div class="form-group">
                                               <label for="member_group"><?php echo @LA_LB_GROUP;?></label>
                                               <select name="member_group" id="select" class="form-control">
                                               <?php 
											   $getgroup = $getdata->my_sql_select(NULL,"member_group","grp_status='1' ORDER BY grp_name");
											   while($showgroup = mysql_fetch_object($getgroup)){
												   echo '<option value="'.$showgroup->grp_key.'">'.$showgroup->grp_name.'</option>';
											   }
											   ?>
                                               </select>
                                             </div>
                                             
                                            <div class="form-group">
                                              <label for="member_status"><?php echo @LA_LB_STATUS;?></label>
                                              <select name="member_status" id="member_status" class="form-control">
                                                <option value="1" selected="selected"><?php echo @LA_BTN_SHOW;?></option>
                                                <option value="0"><?php echo @LA_BTN_HIDE;?></option>
                                              
                                              </select>
                                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" name="save_member" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                        </div>
                    </div>
</form>
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
