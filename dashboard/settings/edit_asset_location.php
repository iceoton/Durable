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
$getlocation_detail = $getdata->my_sql_query(NULL, "location", "id='" . addslashes($_GET['key']) . "'");
?>
<div class="modal-body">
    <div class="form-group row">
        <div class="col-md-6">
            <label for="edit_location_code">รหัสสถานที่</label>
            <input type="text" name="edit_location_code" id="edit_location_code" class="form-control"
                   value="<?php echo @$getlocation_detail->code; ?>" autofocus>
        </div>
        <div class="col-md-6">
            <label for="edit_location_name">ชื่อสถานที่ตั้งครุภัณฑ์์</label>
            <input type="text" name="edit_location_name" id="edit_location_name" class="form-control"
                   value="<?php echo @$getlocation_detail->name; ?>">
        </div>
        <input type="hidden" name="location_id" id="location_id" value="<?php echo @addslashes($_GET['key']);?>">
    </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
            class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE; ?></button>
    <button type="submit" name="save_edit_location" class="btn btn-primary btn-sm"><i
            class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE; ?></button>
</div>
                                        