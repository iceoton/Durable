<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-edit fa-fw"></i> รายการครุภัณฑ์</h1>
    </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME; ?></a></li>
    <li class="active">รายการครุภัณฑ์</li>
</ol>
<?php
if (isset($_POST['save_asset'])) {
    if ((addslashes($_POST['asset_code']) != NULL) && (addslashes($_POST['asset_name']) != NULL)
        && (addslashes($_POST['come_date']) != NULL) && (addslashes($_POST['asset_quantity']) != NULL)
    ) {

        $assetCode = $_POST['asset_code'];
        $assetName = $_POST['asset_name'];
        $assetDetail = $_POST['asset_detail'];
        $assetTypeId = $_POST['asset_type'];
        $assetCategoryId = $_POST['asset_category'];
        $assetComeDate = $_POST['come_date'];
        $assetLocationId = $_POST['asset_location'];
        $assetSourceId = $_POST['asset_source'];
        $assetStatus = $_POST['asset_status'];
        $assetQuantity = $_POST['asset_quantity'];
        $assetUnit = $_POST['asset_unit'];
        //$card_key = md5(htmlentities($_POST['card_customer_name']) . htmlentities($_POST['card_code']) . time("now"));

        $getDB->my_sql_insert("asset", "code='" . $assetCode . "', name='" . $assetName . "', detail='" . $assetDetail
            . "', category_id=" . $assetCategoryId . ", type_id=" . $assetTypeId . ", come_date='" . $assetComeDate . "', location_id=" . $assetLocationId
            . ", source_id=" . $assetSourceId . ", status_id=" . $assetStatus . ", quantity=" . $assetQuantity . ", unit_id=" . $assetUnit
            . ", update_date='" . date("Y-m-d H:i:s") . "'");

        $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . "เพิ่มครุภัณฑ์สำเร็จ" . '</div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
    }
}

if (isset($_POST['save_manage_add_asset'])) {
    if ((addslashes($_POST['asset_code']) != NULL) && (addslashes($_POST['asset_name']) != NULL)
        && (addslashes($_POST['come_date']) != NULL) && (addslashes($_POST['asset_quantity']) != NULL)
    ) {

        $assetCode = $_POST['asset_code'];
        $assetName = $_POST['asset_name'];
        $assetDetail = $_POST['asset_detail'];
        $assetTypeId = $_POST['asset_type'];
        $assetCategoryId = $_POST['asset_category'];
        $assetComeDate = $_POST['come_date'];
        $assetLocationId = $_POST['asset_location'];
        $assetSourceId = $_POST['asset_source'];
        $assetStatus = $_POST['asset_status'];
        $assetQuantity = $_POST['asset_quantity'];
        $assetUnit = $_POST['asset_unit'];
        //$card_key = md5(htmlentities($_POST['card_customer_name']) . htmlentities($_POST['card_code']) . time("now"));

        $getDB->my_sql_insert("asset", "code='" . $assetCode . "', name='" . $assetName . "', detail='" . $assetDetail
            . "', category_id=" . $assetCategoryId . ", type_id=" . $assetTypeId . ", come_date='" . $assetComeDate . "', location_id=" . $assetLocationId
            . ", source_id=" . $assetSourceId . ", status_id=" . $assetStatus . ", quantity=" . $assetQuantity . ", unit_id=" . $assetUnit
            . ", update_date='" . date("Y-m-d H:i:s") . "'");

        $assetId = mysql_insert_id();
        //echo "last insert asset id = ".$assetId;

        $manageType = $_POST['manage_type'];
        $userKey = $_SESSION['ukey'];
        $enumManageType = "";

        $strManageType = "";
        switch ($manageType) {
            case 0:
                $strManageType = "เบิกครุภัณฑ์";
                $enumManageType = "PICK_UP";
                break;
            case 1:
                $strManageType = "ยืมครุภัณฑ์";
                $enumManageType = "BORROW";
                break;
            case 2:
                $strManageType = "คืนครุภัณฑ์";
                $enumManageType = "RETURN";
                break;
            case 3:
                $strManageType = "ส่งซ่อมครุภัณฑ์";
                $enumManageType = "REPAIR";
            default:
                break;
        }

        $getDB->my_sql_insert("asset_management", "user_key='" . $userKey . "', asset_id='" . $assetId
            . "', manage_type='" . $enumManageType
            . "', quantity=" . "1" . ", create_date='" . date("Y-m-d H:i:s") . "'"
            . ", update_date='" . date("Y-m-d H:i:s") . "'");


        $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . "ทำการ $strManageType สำเร็จ" . '</div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
    }
}

if (isset($_POST['save_edit_asset'])) {
    if ((addslashes($_POST['asset_id']) != NULL) && (addslashes($_POST['asset_code']) != NULL) && (addslashes($_POST['asset_name']) != NULL)
        && (addslashes($_POST['come_date']) != NULL) && (addslashes($_POST['asset_quantity']) != NULL)
    ) {

        $assetId = addslashes($_POST['asset_id']);
        $assetCode = $_POST['asset_code'];
        $assetName = $_POST['asset_name'];
        $assetDetail = $_POST['asset_detail'];
        $assetTypeId = $_POST['asset_type'];
        $assetCategoryId = $_POST['asset_category'];
        $assetComeDate = $_POST['come_date'];
        $assetLocationId = $_POST['asset_location'];
        $assetSourceId = $_POST['asset_source'];
        $assetStatus = $_POST['asset_status'];
        $assetQuantity = $_POST['asset_quantity'];
        $assetUnit = $_POST['asset_unit'];

        $getDB->my_sql_update("asset", "code='" . $assetCode . "', name='" . $assetName . "', detail='" . $assetDetail
            . "', category_id=" . $assetCategoryId . ", type_id=" . $assetTypeId . ", come_date='" . $assetComeDate . "', location_id=" . $assetLocationId
            . ", source_id=" . $assetSourceId . ", status_id=" . $assetStatus . ", quantity=" . $assetQuantity . ", unit_id=" . $assetUnit
            . ", update_date='" . date("Y-m-d H:i:s") . "'"
            , "id='" . $assetId . "'");
        $alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . "แก้ไขรายละเอียดครุภัณฑ์สำเร็จ" . '</div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . LA_ALERT_DATA_MISMATCH . '</div>';
    }
}
?>

<!-- Modal Edit -->
<div class="modal fade" id="edit_asset" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel"
     aria-hidden="true">
    <form id="form2" name="form2" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only"><?php echo @LA_BTN_CLOSE; ?></span>
                    </button>
                    <h4 class="modal-title" id="memberModalLabel">แก้ไขข้อมูลครุภัณฑ์</h4>
                </div>
                <div class="ct">

                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" name="form1" id="form1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">เพิ่มครุภัณฑ์</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="asset_code">รหัสครุภัณฑ์</label>
                            <input type="text" name="asset_code" id="asset_code" class="form-control"
                                   autofocus autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label for="asset_name">ชื่อครุภัณฑ์</label>
                            <input type="text" name="asset_name" id="asset_name" class="form-control"
                                   autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="asset_detail">รายละเอียด</label>
                        <textarea name="asset_detail" id="asset_detail" class="form-control"></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="asset_category">ประเภทสินทรัพย์</label>
                            <select name="asset_category" id="asset_category" class="form-control">
                                <?php
                                $getcategory = $getDB->my_sql_select(NULL, "category", NULL);
                                while ($showcategory = mysql_fetch_object($getcategory)) {
                                    ?>
                                    <option
                                            value="<?php echo @$showcategory->id; ?>"><?php echo @$showcategory->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="asset_type">ชนิดครุภัณฑ์</label>
                            <select name="asset_type" id="asset_type" class="form-control">
                                <?php
                                $get_asset_type = $getDB->my_sql_select(NULL, "asset_type", NULL);
                                while ($show_asset_type = mysql_fetch_object($get_asset_type)) {
                                    ?>
                                    <option
                                            value="<?php echo @$show_asset_type->id; ?>"><?php echo @$show_asset_type->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="come_date">วันที่ได้มาครั้งแรก</label>
                            <input type="text" name="come_date" id="come_date" class="form-control"
                                   autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="asset_location">สถานที่ตั้ง</label>
                            <select name="asset_location" id="asset_location" class="form-control">
                                <?php
                                $getlocation = $getDB->my_sql_select(NULL, "location", NULL);
                                while ($showlocation = mysql_fetch_object($getlocation)) {
                                    ?>
                                    <option
                                            value="<?php echo @$showlocation->id; ?>"><?php echo @$showlocation->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="asset_source">แหล่งที่มา</label>
                            <select name="asset_source" id="asset_source" class="form-control">
                                <?php
                                $getsource = $getDB->my_sql_select(NULL, "source", NULL);
                                while ($showsource = mysql_fetch_object($getsource)) {
                                    ?>
                                    <option
                                            value="<?php echo @$showsource->id; ?>"><?php echo @$showsource->name; ?></option>
                                    <?php
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
                                $getstatus = $getDB->my_sql_select(NULL, "status", NULL);
                                while ($showstatus = mysql_fetch_object($getstatus)) {
                                    ?>
                                    <option
                                            value="<?php echo @$showstatus->id; ?>"><?php echo @$showstatus->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="asset_quantity">ปริมาณ</label>
                            <input type="text" name="asset_quantity" id="asset_quantity" class="form-control"
                                   autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label for="asset_unit">หน่วยนับ</label>
                            <select name="asset_unit" id="asset_unit" class="form-control">
                                <?php
                                $getunit = $getDB->my_sql_select(NULL, "unit", NULL);
                                while ($showunit = mysql_fetch_object($getunit)) {
                                    ?>
                                    <option
                                            value="<?php echo @$showunit->id; ?>"><?php echo @$showunit->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--<div class="form-group">
                      <label for="card_note">หมายเหตุ</label>
                      <textarea name="card_note" id="card_note" class="form-control"></textarea>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                        <i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE; ?></button>
                    <button type="submit" name="save_asset" class="btn btn-primary btn-sm">
                        <i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE; ?></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Management Add -->
<div class="modal fade" id="management_add" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel"
     aria-hidden="true">
    <form id="form3" name="form3" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only"><?php echo @LA_BTN_CLOSE; ?></span>
                    </button>
                    <h4 class="modal-title" id="memberModalLabel">เบิกครุภัณฑ์/ยืมครุภัณฑ์</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="asset_code">คุณต้องการทำรายการ</label>
                            <select name="manage_type" id="manage_type" class="form-control">
                                <option value="0" selected="selected">เบิกครุภัณฑ์</option>
                                <option value="1">ยืมครุภัณฑ์</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="asset_code">รหัสครุภัณฑ์</label>
                            <input type="text" name="asset_code" id="asset_code" class="form-control"
                                   autofocus autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label for="asset_name">ชื่อครุภัณฑ์</label>
                            <input type="text" name="asset_name" id="asset_name" class="form-control"
                                   autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="asset_detail">รายละเอียด</label>
                        <textarea name="asset_detail" id="asset_detail" class="form-control"></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="asset_category">ประเภทสินทรัพย์</label>
                            <select name="asset_category" id="asset_category" class="form-control">
                                <?php
                                $getcategory = $getDB->my_sql_select(NULL, "category", NULL);
                                while ($showcategory = mysql_fetch_object($getcategory)) {
                                    ?>
                                    <option
                                            value="<?php echo @$showcategory->id; ?>"><?php echo @$showcategory->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="asset_type">ชนิดครุภัณฑ์</label>
                            <select name="asset_type" id="asset_type" class="form-control">
                                <?php
                                $get_asset_type = $getDB->my_sql_select(NULL, "asset_type", NULL);
                                while ($show_asset_type = mysql_fetch_object($get_asset_type)) {
                                    ?>
                                    <option
                                            value="<?php echo @$show_asset_type->id; ?>"><?php echo @$show_asset_type->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="come_date">วันที่ได้มาครั้งแรก</label>
                            <input type="text" name="come_date" id="come_date" class="form-control"
                                   autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="asset_location">สถานที่ตั้ง</label>
                            <select name="asset_location" id="asset_location" class="form-control">
                                <?php
                                $getlocation = $getDB->my_sql_select(NULL, "location", NULL);
                                while ($showlocation = mysql_fetch_object($getlocation)) {
                                    ?>
                                    <option
                                            value="<?php echo @$showlocation->id; ?>"><?php echo @$showlocation->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="asset_source">แหล่งที่มา</label>
                            <select name="asset_source" id="asset_source" class="form-control">
                                <?php
                                $getsource = $getDB->my_sql_select(NULL, "source", NULL);
                                while ($showsource = mysql_fetch_object($getsource)) {
                                    ?>
                                    <option
                                            value="<?php echo @$showsource->id; ?>"><?php echo @$showsource->name; ?></option>
                                    <?php
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
                                $getstatus = $getDB->my_sql_select(NULL, "status", NULL);
                                while ($showstatus = mysql_fetch_object($getstatus)) {
                                    ?>
                                    <option
                                            value="<?php echo @$showstatus->id; ?>"><?php echo @$showstatus->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="asset_quantity">ปริมาณ</label>
                            <input type="text" name="asset_quantity" id="asset_quantity" class="form-control"
                                   autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label for="asset_unit">หน่วยนับ</label>
                            <select name="asset_unit" id="asset_unit" class="form-control">
                                <?php
                                $getunit = $getDB->my_sql_select(NULL, "unit", NULL);
                                while ($showunit = mysql_fetch_object($getunit)) {
                                    ?>
                                    <option
                                            value="<?php echo @$showunit->id; ?>"><?php echo @$showunit->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--<div class="form-group">
                      <label for="card_note">หมายเหตุ</label>
                      <textarea name="card_note" id="card_note" class="form-control"></textarea>
                    </div> -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE; ?></button>
                    <button type="submit" name="save_manage_add_asset" class="btn btn-primary btn-sm"><i
                                class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE; ?></button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
echo @$alert;
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-default" id="bs-example-navbar-collapse-1">
            <?php
            if ($_SESSION['uclass'] > 0) {
                echo '
                <ul class="nav navbar-nav" >
                <li ><a data-toggle = "modal" data-target = "#myModal" style = "cursor:pointer;" >
                        <i class="fa fa-plus" ></i >
                เพิ่มครุภัณฑ์</a ></li >
            </ul >
            <ul class="nav navbar-nav" >
                <li ><a data-toggle = "modal" data-target = "#management_add" style = "cursor:pointer;" >
                        <i class="fa fa-pencil-square" ></i >
                เบิกครุภัณฑ์ / ยืมครุภัณฑ์</a ></li >
            </ul >

            <ul class="nav navbar-nav" >
                <li ><a class="navbar-brand" href = "?p=asset_management" style = "cursor:pointer;" >
                        <i class="fa fa-pencil-square-o" ></i >
                คืนครุภัณฑ์ / ส่งซ่อมครุภัณฑ์</a ></li >
            </ul >';
            }
            ?>
            <form class="navbar-form from-group navbar-right" role="search" method="get" action="?p=search">

                <input type="text" class="form-control" name="q" placeholder="ระบุชื่อครุภัณฑ์/รหัสครุภัณฑ์ เพื่อค้นหา"
                       size="50" autofocus autocomplete="off">
                <input type="hidden" name="p" id="p" value="search">

            </form>
        </div>

    </div>
</nav>
<?php
$getcard_count = $getDB->my_sql_show_rows("card_info", "card_status = ''  ORDER BY card_insert");
if ($getcard_count != 0) {
    ?>
    <div class="table-responsive">
        <table width="100%" border="0" class="table table-bordered">
            <thead>
            <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
                <td width="5%">รหัสครุภัณฑ์</td>
                <td width="15%">ชื่อครุภัณฑ์</td>
                <td width="20%">รายละเอียด</td>
                <td width="5%">ประเภท</td>
                <th width="5%">ชนิดครุภัณฑ์</th>
                <td width="5%">วันที่ได้มาครั้งแรก</td>
                <td width="10%">สถานที่ตั้ง</td>
                <td width="10%">แหล่งที่มา</td>
                <td width="5%">สถานะ</td>
                <td width="5%">ปริมาณ</td>
                <td width="5%">หน่วยนับ</td>
                <?php
                if ($_SESSION['uclass'] > 0) {
                    echo '<td width="10%">จัดการ</td>';
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            $getcard = $getDB->my_sql_select(NULL, "asset", NULL);
            while ($showcard = mysql_fetch_object($getcard)) {
                ?>
                <tr style="font-weight:bold;" id="<?php echo @$showcard->id; ?>">
                    <!--<td align="center"><a
                            href="?p=asset_detail&id=<?php /*echo @$showcard->id; */ ?>"><?php /*echo @$showcard->code; */ ?></a>
                    </td>-->
                    <td align="center"><?php echo @$showcard->code; ?></td>
                    <td align="left"><?php echo @$showcard->name; ?></td>
                    <td align="left"><?php echo @$showcard->detail; ?></td>
                    <td align="center"><?php echo @getAssetCategoryById($showcard->category_id)->code; ?></td>
                    <td align="center"><?php echo @getAssetTypeById($showcard->type_id)->name; ?></td>
                    <td align="center"><?php echo @$showcard->come_date; ?></td>
                    <td align="center"><?php echo @locationIdToString($showcard->location_id); ?></td>
                    <td align="center"><?php echo @sourceIdToString($showcard->source_id); ?></td>
                    <td align="center"><?php echo @statusIdToString($showcard->status_id); ?></td>
                    <td align="center"><?php echo @$showcard->quantity; ?></td>
                    <td align="center"><?php echo @unitIdToString($showcard->unit_id); ?></td>

                    <?php
                    if ($_SESSION['uclass'] > 0) {
                        echo '<td align="right"><a data-toggle="modal" data-target="#edit_asset" data-whatever="' . @$showcard->id . '"
                                title="แก้ไข" class="btn btn-xs btn-info"><i class="fa fa-edit"></i>
                            </a>
                            <a onClick="javascript:deleteAsset(' . @$showcard->id . ');"
                                title="ลบข้อมูล" class="btn btn-xs btn-danger"><i class="fa fa-times"></i>
                            </a></td>';
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
            </tbody>

        </table>

    </div>
    <?php
} else {
    echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ไม่พบข้อมูลครุภัณฑ์</div>';
}
?>
<script language="javascript">
    function deleteAsset(assetId) {
        if (confirm('คุณต้องการลบครุภัณฑ์นี้ใช่หรือไม่ ?')) {
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById(assetId).innerHTML = '';
                }
            }
            xmlhttp.open("GET", "function.php?type=delete_asset&id=" + assetId, true);
            xmlhttp.send();
        }
    }
</script>
<script>
    $('#edit_asset').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'key=' + recipient;

        $.ajax({
            type: "GET",
            url: "asset/edit_asset.php",
            data: dataString,
            cache: false,
            success: function (data) {
                console.log(data);
                modal.find('.ct').html(data);
            },
            error: function (err) {
                console.log(err);
            }
        });
    });

    //เพื่อให้ใช้ autofocus ใน modal ได้
    $('#myModal').on('shown.bs.modal', function () {
        $(this).find('[autofocus]').focus();
    });

    $('#management_add').on('show.bs.modal', function () {
        /*var modal = $(this);
        $.ajax({
            type: "GET",
            url: "asset/management_add.php",
            cache: false,
            success: function (data) {
                console.log(data);
                modal.find('.ct').html(data);
                modal.find('[autofocus]').focus();
            },
            error: function (err) {
                console.log(err);
            }
        });*/
        $(this).find('[autofocus]').focus();
    });
</script>