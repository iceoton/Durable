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
$getitem = $getdata->my_sql_query(NULL,"products","pro_key='".addslashes($_GET['key'])."'");
?>
 <div class="modal-body">
  <div class="form-group">
    <label for="edit_cat_key"><?php echo @LA_LB_CAT_NAME;?></label>
    <select name="edit_cat_key" id="edit_cat_key" class="form-control">
                                            <?php $getcat = $getdata->my_sql_select(NULL,"categories","cat_status='1' ORDER BY cat_insert");
											while($showcat = mysql_fetch_object($getcat)){
												if($showcat->cat_key == $getitem->cat_key){
													echo '<option value="'.$showcat->cat_key.'" selected>'.$showcat->cat_name.'</option>';
												}else{
													echo '<option value="'.$showcat->cat_key.'">'.$showcat->cat_name.'</option>';
												}
												
											}
											?>
                                           </select>
   </div>
                                         <div class="form-group">
                                           <label for="edit_pro_std_code"><?php echo @LA_LB_EXPENDITURES_CODE;?></label>
                                           <input type="text" name="edit_pro_std_code" id="edit_pro_std_code" class="form-control" value="<?php echo @$getitem->pro_std_code;?>">
                                         </div>
                                         <div class="form-group">
                                           <label for="edit_pro_name"><?php echo @LA_LB_EXPENDITURES_NAME;?></label>
                                           <input type="text" name="edit_pro_name" id="edit_pro_name" value="<?php echo @$getitem->pro_name;?>" class="form-control">
                                         </div>
                                          <div class="form-group">
                                            <label for="edit_pro_detail"><?php echo @LA_LB_DETAIL;?></label>
                                            <textarea name="edit_pro_detail" id="edit_pro_detail" class="form-control"><?php echo @$getitem->pro_detail;?></textarea>
                                          </div>
                                          <div class="form-group row">
                                            
                                            <div class="col-md-4" align="center"><img src="../resource/products/thumbs/<?php echo @$getitem->pro_cover;?>"  id="img_border" alt="" width="120"/></div>
                                            <div class="col-md-8"><label for="edit_pro_cover"><?php echo @LA_LB_PHOTO;?></label><input type="file" name="edit_pro_cover" id="edit_pro_cover" class="form-control"></div>
                                           
                                          </div>
                                         
   <div class="form-group">
     <label for="edit_pro_price"><?php echo @LA_LB_PRICE;?></label>
     <input type="text" name="edit_pro_price" id="edit_pro_price" value="<?php echo $getitem->pro_price;?>" class="form-control">
                                          </div>
                                      
                                        
   <input type="hidden" name="pro_key" id="pro_key" value="<?php echo @addslashes($_GET['key']);?>">
 </div>
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_edit_item" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
                                    
