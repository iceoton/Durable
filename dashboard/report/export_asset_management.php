<?php
error_reporting(0);
date_default_timezone_set('Asia/Bangkok');
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getDB = new clear_db();
$connect = $getDB->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$getDB->my_sql_set_utf8();

$strExcelFileName = $_GET['filename'] . ".xls";
header("Content-Type: application/vnd.ms-excel; name=\"$strExcelFileName\"");
header("Content-Disposition: attachment; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

$manageType = $_GET['type'];
$titleOfFile = "";
if ($manageType == 1) {
    $titleOfFile = "รายงานการเบิกครุภัณฑ์";
} else if ($manageType == 2) {
    $titleOfFile = "รายงานการยืมครุภัณฑ์";
} else if ($manageType == 3) {
    $titleOfFile = "รายงานการคืนครุภัณฑ์";
} else if ($manageType == 4) {
    $titleOfFile = "รายงานการส่งซ่อมครุภัณฑ์";
}

$assetList = $getDB->my_sql_select(null, "asset_management", "manage_type = " . $manageType . "  ORDER BY create_date");
$num = mysql_num_rows($assetList);
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<strong><?php echo "$titleOfFile วันที่". date("d/m/Y"); ?> ทั้งหมด <?php echo number_format($num); ?>
    ครุภัณฑ์</strong><br>
<br>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
    <table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
        <tr>
            <td width="1%">ลำดับที่</td>
            <td width="10%">รหัสครุภัณฑ์</td>
            <td width="15s%">ชื่อครุภัณฑ์</td>
            <td width="30%">รายละเอียด</td>
            <td width="10%">ชนิดครุภัณฑ์</td>
            <td width="5%">จำนวน</td>
            <td width="10%">วันที่ทำรายการ</td>
            <td width="10%">ผู้ทำรายการ</td>
            <td width="10%">หมายเหตุ</td>
        </tr>
        <?php
        if ($num > 0) {
            $index = 0;
            while ($row = mysql_fetch_object($assetList)) {
                $asset = getAssetById($row->asset_id)
                ?>
                <tr>
                    <td align="center"><?php echo $index += 1 ?></td>
                    <td align="left"><?php echo @$asset->code; ?></td>
                    <td align="left"><?php echo @$asset->name; ?></td>
                    <td align="left"><?php echo @$asset->detail; ?></td>
                    <td align="left"><?php echo @getAssetTypeById($asset->type_id)->name;  ?></td>
                    <td align="center"><?php echo @$row->quantity; ?></td>
                    <td align="left"><?php echo @$row->create_date; ?></td>
                    <td align="center"><?php echo @getUserByKey($row->user_key)->name; ?></td>
                    <td align="center"><?php echo ""; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
</body>
</html>