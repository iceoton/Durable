<?php
session_start();
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$getdata->my_sql_set_utf8();

if (@addslashes($_GET['lang'])) {
    $_SESSION['lang'] = addslashes($_GET['lang']);
} else {
    $_SESSION['lang'] = $_SESSION['lang'];
}
if (@$_SESSION['lang'] != NULL) {
    require("../../language/" . @$_SESSION['lang'] . "/site.lang");
    require("../../language/" . @$_SESSION['lang'] . "/menu.lang");
} else {
    require("../../language/th/site.lang");
    require("../../language/th/menu.lang");
    $_SESSION['lang'] = 'th';

}
$getcat_detail = $getdata->my_sql_query(NULL, "category", "id='" . addslashes($_GET['key']) . "'");
?>
<div class="modal-body">
    <div class="form-group row">
        <div class="col-md-6">
            <label for="edit_category_code">รหัสประเภท</label>
            <input type="text" name="edit_category_code" id="edit_category_code" class="form-control"
                   value="<?php echo @$getcat_detail->code; ?>" autofocus>
        </div>
        <div class="col-md-6">
            <label for="edit_category_name">ชื่อประเภทของครุภัณฑ์</label>
            <input type="text" name="edit_category_name" id="edit_category_name" class="form-control"
                   value="<?php echo @$getcat_detail->name; ?>">
        </div>
        <input type="hidden" name="category_id" id="category_id" value="<?php echo @addslashes($_GET['key']);?>">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
            class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE; ?></button>
    <button type="submit" name="save_edit_cat" class="btn btn-primary btn-sm"><i
            class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE; ?></button>
</div>
                                    
