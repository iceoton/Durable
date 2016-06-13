<?php
session_start();
error_reporting(0);
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
$getnow_status = $getdata->my_sql_query("card_status","card_info","card_key='".addslashes($_GET['key'])."'");
?>

<div class="modal-body">
   <div class="form-group">
                                             <label for="card_status">สถานะปัจจุบัน</label>
                                             <select name="card_status" id="card_status" class="form-control">
                                             <?php
											 $getcard_type = $getdata->my_sql_select(NULL,"card_type","ctype_status='1' ORDER BY ctype_insert");
											 while($showcard_type = mysql_fetch_object($getcard_type)){
												 if($showcard_type->ctype_key == $getnow_status->card_status){
													   echo '<option value="'.$showcard_type->ctype_key.'" selected>'.$showcard_type->ctype_name.'</option>';
												 }else{
													  echo '<option value="'.$showcard_type->ctype_key.'">'.$showcard_type->ctype_name.'</option>';
												 }
											 }
											 ?>
                                             </select>
                                           </div>
                                           <div class="form-group">
                                             <label for="card_status_note">หมายเหตุสถานะ</label>
                                             <textarea name="card_status_note" id="card_status_note" class="form-control"></textarea>
                                           </div>
 <div class="form-group">
  <input type="hidden" name="card_key" id="card_key" value="<?php echo @addslashes($_GET['key']);?>">
 </div>
 </div>
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_new_status" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
                                        