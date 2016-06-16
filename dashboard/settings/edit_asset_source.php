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
$getsource_detail = $getdata->my_sql_query(NULL, "source", "id='" . addslashes($_GET['key']) . "'");
?>
<div class="modal-body">
    <div class="form-group row">
        <div class="col-md-6">
            <label for="edit_source_code">รหัสแหล่งที่มา</label>
            <input type="text" name="edit_source_code" id="edit_source_code" class="form-control"
                   value="<?php echo @$getsource_detail->code; ?>" autofocus>
        </div>
        <div class="col-md-6">
            <label for="edit_source_name">ชื่อแหล่งที่มาของครุภัณฑ์</label>
            <input type="text" name="edit_source_name" id="edit_source_name" class="form-control"
                   value="<?php echo @$getsource_detail->name; ?>">
        </div>
        <input type="hidden" name="source_id" id="source_id" value="<?php echo @addslashes($_GET['key']);?>">
    </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
            class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE; ?></button>
    <button type="submit" name="save_edit_source" class="btn btn-primary btn-sm"><i
            class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE; ?></button>
</div>
                                        