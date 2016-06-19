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
$getAsset_detail = $getdata->my_sql_query(NULL, "asset", "id='" . addslashes($_GET['key']) . "'");
?>
<div class="modal-body">
    <div class="form-group row">
        <div class="col-md-6">
            <label for="asset_code">รหัสครุภัณฑ์</label>
            <input type="text" name="asset_code" id="asset_code" class="form-control"
                   value="<?php echo @$getAsset_detail->code; ?>" autofocus>
        </div>
        <div class="col-md-6">
            <label for="asset_name">ชื่อครุภัณฑ์</label>
            <input type="text" name="asset_name" id="asset_name" class="form-control"
                   value="<?php echo @$getAsset_detail->name; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="asset_detail">รายละเอียด</label>
        <textarea name="asset_detail" id="asset_detail"
                  class="form-control"><?php echo @$getAsset_detail->detail; ?></textarea>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label for="asset_category">ประเภทสินทรัพย์</label>
            <select name="asset_category" id="asset_category" class="form-control">
                <?php
                $getcategory = $getdata->my_sql_select(NULL, "category", NULL);
                while ($showcategory = mysql_fetch_object($getcategory)) {
                    if ($getAsset_detail->category_id == $showcategory->id) {
                        ?>
                        <option value="<?php echo @$showcategory->id; ?>"
                                selected="selected"><?php echo @$showcategory->name; ?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo @$showcategory->id; ?>"><?php echo @$showcategory->name; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="come_date">วันที่ได้มาครั้งแรก</label>
            <input type="text" name="come_date" id="come_date" class="form-control"
                   value="<?php echo @$getAsset_detail->come_date; ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label for="asset_location">สถานที่ตั้ง</label>
            <select name="asset_location" id="asset_location" class="form-control">
                <?php
                $getlocation = $getdata->my_sql_select(NULL, "location", NULL);
                while ($showlocation = mysql_fetch_object($getlocation)) {
                    if ($getAsset_detail->location_id == $showlocation->id) {
                        ?>
                        <option value="<?php echo @$showlocation->id; ?>"
                                selected="selected"><?php echo @$showlocation->name; ?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo @$showlocation->id; ?>"><?php echo @$showlocation->name; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="asset_source">แหล่งที่มา</label>
            <select name="asset_source" id="asset_source" class="form-control">
                <?php
                $getsource = $getdata->my_sql_select(NULL, "source", NULL);
                while ($showsource = mysql_fetch_object($getsource)) {
                    if ($getAsset_detail->source_id == $showsource->id) {
                        ?>
                        <option value="<?php echo @$showsource->id; ?>"
                                selected="selected"><?php echo @$showsource->name; ?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo @$showsource->id; ?>"><?php echo @$showsource->name; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <label for="asset_status">สถานะ</label>
            <select name="asset_status" id="asset_status" class="form-control">
                <?php
                $getstatus = $getdata->my_sql_select(NULL, "status", NULL);
                while ($showstatus = mysql_fetch_object($getstatus)) {
                    if ($getAsset_detail->status_id == $showstatus->id) {
                        ?>
                        <option value="<?php echo @$showstatus->id; ?>"
                                selected="selected"><?php echo @$showstatus->name; ?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo @$showstatus->id; ?>"><?php echo @$showstatus->name; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="asset_quantity">ปริมาณ</label>
            <input type="text" name="asset_quantity" id="asset_quantity" class="form-control"
                   value="<?php echo @$getAsset_detail->quantity; ?>">
        </div>
        <div class="col-md-4">
            <label for="asset_unit">หน่วยนับ</label>
            <select name="asset_unit" id="asset_unit" class="form-control">
                <?php
                $getunit = $getdata->my_sql_select(NULL, "unit", NULL);
                while ($showunit = mysql_fetch_object($getunit)) {
                    if ($getAsset_detail->unit_id == $showunit->id) {
                        ?>
                        <option value="<?php echo @$showunit->id; ?>"
                                selected="selected"><?php echo @$showunit->name; ?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo @$showunit->id; ?>"><?php echo @$showunit->name; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
    </div>

    <input type="hidden" name="asset_id" id="asset_id" value="<?php echo @addslashes($_GET['key']); ?>">
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
            class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE; ?></button>
    <button type="submit" name="save_edit_asset" class="btn btn-primary btn-sm"><i
            class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE; ?></button>
</div>
                                        