<?php
error_reporting(0);
date_default_timezone_set('Asia/Bangkok');
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getDB = new clear_db();
$connect = $getDB->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$getDB->my_sql_set_utf8();

$strExcelFileName = $_GET['filename'].".xls";
header("Content-Type: application/vnd.ms-excel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

$assetTypeId = $_GET['type'];
$assetList = $getDB->my_sql_select("*, asset.quantity, asset_management.quantity as q", "asset LEFT JOIN asset_management ON asset.id = asset_management.asset_id", "type_id = '" . $assetTypeId . "'  ORDER BY code");
$num = mysql_num_rows($assetList);
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<strong>รายงานครุภัณฑ์ วันที่ <?php echo date("d/m/Y"); ?> ทั้งหมด <?php echo number_format($num); ?>
    ครุภัณฑ์</strong><br>
<br>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
    <table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
        <tr>
            <td width="1%">ลำดับที่</td>
            <td width="6%">รหัสครุภัณฑ์</td>
            <td width="14%">ชื่อครุภัณฑ์</td>
            <td width="29%">รายละเอียด</td>
            <td width="5%">วันที่ได้มาครั้งแรก</td>
            <td width="10%">สถานที่ตั้ง</td>
            <td width="5%">สถานะ</td>
            <td width="5%">ปริมาณ</td>
            <td width="5%">หน่วยนับ</td>
            <td width="10%">ผลการตรวจนับ</td>
            <td width="10%">หมายเหตุ</td>
        </tr>
        <?php
        if ($num > 0) {
            $index = 0;
            while ($row = mysql_fetch_object($assetList)) {
                ?>
                <tr>
                    <td align="center"><?php echo $index += 1 ?></td>
                    <td align="left"><?php echo @$row->code; ?></td>
                    <td align="left"><?php echo @$row->name; ?></td>
                    <td align="left"><?php echo @$row->detail; ?></td>
                    <td align="left"><?php echo @$row->come_date; ?></td>
                    <td align="center"><?php echo @locationIdToString($row->location_id); ?></td>
                    <td align="center"><?php echo @getAssetStatusCode($row->status_id); ?></td>
                    <td align="center"><?php echo @$row->quantity; ?></td>
                    <td align="center"><?php echo @unitIdToString($row->unit_id); ?></td>
                    <td align="center">
                        <?php
                        if ($row->q != null) {
                            //echo @($showcard->quantity - $showcard->q);
                            echo @$row->quantity;
                        } else {
                            echo @$row->quantity;
                        }

                        ?></td>
                    <td align="center"><?php echo ""; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
<script type="text/javascript" charset="utf-8">
    window.onbeforeunload = function(){return false;};
</script>
</body>
</html>