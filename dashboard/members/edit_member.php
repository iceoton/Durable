<?php
session_start();
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$getdata->my_sql_set_utf8();

if(@addslashes($_GET['lang'])){
	$_SESSION['lang'] = addslashes($_GET['lang']);
}else{
	$_SESSION['lang'] = $_SESSION['lang'];
}
if(@$_SESSION['lang']!=NULL){
	require("../../language/".@$_SESSION['lang']."/site.lang");
	require("../../language/".@$_SESSION['lang']."/menu.lang");
}else{
	require("../../language/th/site.lang");
	require("../../language/th/menu.lang");
	$_SESSION['lang'] = 'th';

}
$getmember_detail = $getdata->my_sql_query(NULL,"member","member_key='".addslashes($_GET['key'])."'");
?>
 <div class="modal-body"> 
                                            <div class="form-group">
                                            <div class="row">
                                          
                                            <div class="col-md-6"> <label for="edit_member_name"><?php echo @LA_LB_NAME;?></label>
                                              <input type="text" name="edit_member_name" id="edit_member_name" class="form-control" value="<?php echo @$getmember_detail->member_name;?>">
                                              <input type="hidden" name="member_keyx" id="member_keyx" value="<?php echo @$getmember_detail->member_key;?>">
                                            </div>
                                            <div class="col-md-6"><label for="edit_member_lastname"><?php echo @LA_LB_LASTNAME;?></label>
                                               <input type="text" name="edit_member_lastname" id="edit_member_lastname" class="form-control" value="<?php echo @$getmember_detail->member_lastname;?>"> </div>
                                            </div>
                                            </div>
                                             <div class="form-group">
                                            <div class="row">
                                          
                                           
                                            <div class="col-md-12"><label for="edit_member_pid"><?php echo @LA_LB_PID;?></label>
                                               <input type="text" name="edit_member_pid" id="edit_member_pid" class="form-control" value="<?php echo @$getmember_detail->member_pid;?>"></div>
                                            </div>
                                            </div>
                                           
                                            
                                             <div class="form-group row">
                                             <div class="col-md-4" align="center"><div class="box_img_cycle"><img src="../resource/members/thumbs/<?php echo @$getmember_detail->member_photo;?>" id="img_cycle" <?php echo @getPhotoSize('../resource/members/thumbs/'.@$getmember_detail->member_photo.'');?> alt=""/></div></div>
                                             <div class="col-md-8"> <label for="edit_member_photo"><?php echo @LA_LB_PHOTO;?></label>
                                               <input type="file" name="edit_member_photo" id="edit_member_photo"  class="form-control"></div>
                                              
                                             </div>
                                             <div class="form-group">
                                               <label for="edit_member_address"><?php echo @LA_LB_ADDRESS;?></label>
                                               <textarea name="edit_member_address" id="edit_member_address" class="form-control"><?php echo @$getmember_detail->member_address;?></textarea>
                                            </div>
                                            
                                             <div class="form-group">
                                             <div class="row">
                                          <div class="col-md-6"><label for="edit_member_phone"><?php echo @LA_LB_PHONE;?></label>
                                               <input type="text" name="edit_member_phone" id="edit_member_phone" class="form-control" value="<?php echo @$getmember_detail->member_tel;?>"></div>
                                            <div class="col-md-6"><label for="edit_member_email"><?php echo @LA_LB_EMAIL;?></label>
                                               <input type="text" name="edit_member_email" id="edit_member_email" class="form-control" value="<?php echo @$getmember_detail->member_email;?>"></div>
                                            </div>
                                               
                                            </div>
                                          
                                             
                        </div>
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_edit_member" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
                                    
