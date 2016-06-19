<?php
if (htmlentities($_GET['id']) == NULL) {
    echo '<script>window.location="?p=asset_main";</script>';
} else {
    $asset_detail = $getDB->my_sql_query(NULL, "asset", "id='" . htmlentities($_GET['id']) . "'");
    updateDateNow();
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-edit fa-fw"></i> รายละเอียดครุภัณฑ์รหัส
            [<?php echo @$asset_detail->code; ?>]</h1>
    </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME; ?></a></li>
    <li><a href="?p=asset">รายการครุภัณฑ์</a></li>
    <li class="active">ครุภัณฑ์รหัส [<?php echo @$asset_detail->code; ?>]</li>
</ol>
<?php
if (isset($_POST['save_item'])) {
    if (htmlentities($_POST['item_name']) != NULL && htmlentities($_POST['item_note']) != NULL) {
        $item_key = md5(htmlentities($_POST['item_name']) . time("now") . rand());
        if (htmlentities($_POST['item_price_aprox']) != NULL) {
            $price_aprox = htmlentities($_POST['item_price_aprox']);
        } else {
            $price_aprox = 0;
        }

        $getDB->my_sql_insert("card_item", "item_key='" . $item_key . "',card_key='" . $asset_detail->card_key . "',item_number='" . INumber() . "',item_name='" . htmlentities($_POST['item_name']) . "',item_note='" . @htmlentities($_POST['item_note']) . "',item_price_aprox='" . @$price_aprox . "'");
        updateItem();
        $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>บันทึกข้อมูล สำเร็จ !</div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
    }
}
if (isset($_POST['save_edit_item'])) {
    if (htmlentities($_POST['edit_item_name']) != NULL && htmlentities($_POST['edit_item_note']) != NULL) {
        $getDB->my_sql_update("card_item", "item_name='" . htmlentities($_POST['edit_item_name']) . "',item_note='" . htmlentities($_POST['edit_item_note']) . "',item_price_aprox='" . @htmlentities($_POST['edit_item_price_aprox']) . "'", "item_key='" . htmlentities($_POST['item_key']) . "'");
        $alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>อัพเดทข้อมูล สำเร็จ !</div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
    }
}
if (isset($_POST['save_confirm_card'])) {
    if (htmlentities($_POST['card_done_aprox']) != NULL) {
        $card_done_aprox = htmlentities($_POST['card_done_aprox']);
    } else {
        $card_done_aprox = '0000-00-00';
    }
    $getDB->my_sql_update("card_info", "card_done_aprox='" . @$card_done_aprox . "',card_status='" . htmlentities($_REQUEST['card_status']) . "',user_key='" . $userdata->user_key . "'", "card_key='" . $asset_detail->card_key . "'");
    $cstatus_key = md5(htmlentities($_REQUEST['card_status']) . rand() . time("now"));
    $getDB->my_sql_insert("card_status", "cstatus_key='" . $cstatus_key . "',card_key='" . $asset_detail->card_key . "',card_status='" . htmlentities($_REQUEST['card_status']) . "',card_status_note='" . htmlentities($_POST['card_status_note']) . "',user_key='" . $userdata->user_key . "'");
    echo '<script>alert("บันทึกข้อมูล สำเร็จ !");window.open("card/print_card.php?key=' . $asset_detail->card_key . '", "_blank");window.location="?p=card";</script>';
}
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        รายละเอียดผู้ส่งซ่อม/เคลม
    </div>
    <div class="panel-body">
        <div class="row form-group">
            <div class="col-md-3"><strong>รหัสการส่งซ่อม/เคลม</strong></div>
            <div class="col-md-3"><?php echo @$asset_detail->card_code; ?></div>
            <div class="col-md-3"><strong>วันที่</strong></div>
            <div class="col-md-3"><?php echo @dateTimeConvertor($asset_detail->card_insert); ?></div>
        </div>
        <div class="row form-group">
            <div class="col-md-3"><strong>ชื่อผู้ส่งซ่อม</strong></div>
            <div
                class="col-md-3"><?php echo @$asset_detail->card_customer_name . '&nbsp;&nbsp;&nbsp;' . $asset_detail->card_customer_lastname; ?></div>
            <div class="col-md-3"><strong>หมายเลขโทรศัพท์</strong></div>
            <div class="col-md-3"><?php echo @$asset_detail->card_customer_phone; ?></div>

        </div>

    </div>

</div>
