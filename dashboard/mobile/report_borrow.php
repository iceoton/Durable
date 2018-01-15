<?php
error_reporting(1);
date_default_timezone_set('Asia/Bangkok');
?>
<!DOCTYPE html>
<html>
<?php
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getDB = new clear_db();
$connect = $getDB->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$getDB->my_sql_set_utf8();
$system_info = $getDB->my_sql_query(NULL, "system_info", NULL);
date_default_timezone_set('Asia/Bangkok');
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Durable</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/datepicker.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../../css/plugins/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../css/sb-admin-2.css" rel="stylesheet">
    <link href="../../css/bootstrap-combobox.css" rel="stylesheet">
    <link href="../../css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../css/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/iconset/ios7-set-filled-1/flaticon.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="../../media/favicon/<?php echo @$system_info->site_favicon; ?>"/>
    <link rel="stylesheet" href="../../css/selectize.default.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.../js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php
if (@$_GET['lang'] != NULL) {
    require("../../language/" . @$_GET['lang'] . "/site.lang");
    require("../../language/" . @$_GET['lang'] . "/menu.lang");
} else {
    require("../../language/th/site.lang");
    require("../../language/th/menu.lang");
}
?>
<!-- jQuery Version 1.11.0 -->
<!--<script src="../js/jquery-1.11.0.js"></script>-->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/bootstrap-datepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->

<script src="../../js/plugins/morris/raphael.min.js"></script>
<script src="../../js/plugins/morris/morris.min.js"></script>


<!-- Custom Theme JavaScript -->
<script src="../../js/sb-admin-2.js"></script>
<script src="../../js/bootstrap-combobox.js"></script>
<script src="../../js/bootstrap-colorpicker.js"></script>
<script src="../../js/bootstrap-dialog.min.js"></script>
<script src="../../js/standalone/selectize.js"></script>
<!--for export table to excel-->
<script type="text/javascript" src="../../js/xls.core.js"></script>
<script type="text/javascript" src="../../js/xlsx.core.js"></script>
<script type="text/javascript" src="../../js/Blob.js"></script>
<script type="text/javascript" src="../../js/file-saver.js"></script>
<script type="text/javascript" src="../../js/table-export.js"></script>
<script type="text/javascript" src="../../js/jquery.base64.js"></script>
<body>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-retweet fa-fw"></i> <?php echo "รายงานการยืมครุภัณฑ์"; ?></h1>
    </div>
</div>
<ol class="breadcrumb">
    <!--<li><a href="index.php"><?php /*echo @LA_MN_HOME; */?></a></li>
    <li><a href="?p=report"><?php /*echo "รายงานครุภัณฑ์"; */?></a></li>-->
    <li class="active"><?php echo "รายงานการยืมครุภัณฑ์"; ?></li>
</ol>

<?php
$manageType = 2;
$exportFileName = "รายงานการยืมครุภัณฑ์_". date("d-m-Y");
?>

<div class="table-responsive">
    <table width="100%" border="0" class="table table-bordered" id="table_export">
        <thead>
        <tr style="font-weight:bold; color:#FFF; text-align:left; background:#ff7709;">
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
        </thead>
        <tbody>
        <?php
        $index = 0;
        //SELECT * FROM asset LEFT JOIN asset_management ON asset.id = asset_management.asset_id
        $getcard = $getDB->my_sql_select(null, "asset_management", "manage_type = " . $manageType . "  ORDER BY create_date");
        while ($showcard = mysql_fetch_object($getcard)) {
            $asset = getAssetById($showcard->asset_id)
            ?>
            <tr style="font-weight:bold;" id="<?php echo @$showcard->id; ?>">
                <!--<td align="center"><a
                            href="?p=asset_detail&id=<?php /*echo @$showcard->id; */ ?>"><?php /*echo @$showcard->code; */ ?></a>
                    </td>-->
                <td align="center"><?php echo $index += 1 ?></td>
                <td align="left"><?php echo @$asset->code; ?></td>
                <td align="left"><?php echo @$asset->name; ?></td>
                <td align="left"><?php echo @$asset->detail; ?></td>
                <td align="left"><?php echo @getAssetTypeById($asset->type_id)->name;  ?></td>
                <td align="center"><?php echo @$showcard->quantity; ?></td>
                <td align="left"><?php echo @$showcard->create_date; ?></td>
                <td align="center"><?php echo @getUserByKey($showcard->user_key)->name; ?></td>
                <td align="center"><?php echo ""; ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>

    </table>

</div>
</body>
</html>

<script type="text/javascript" charset="utf-8">
    function exportData(filename) {
        // var blob = $("#table_export").tableExport({type:'xlsx',escape:'true',formats:['xlsx'],exportButtons: false});
        // blob.getExportData();
        var ExportButtons = document.getElementById('table_export');

        var instance = new TableExport(ExportButtons, {
            formats: ['xlsx'],
            exportButtons: false
        });

        //                                        // "id" of selector    // format
        var exportData = instance.getExportData()['table_export']['xlsx'];

        // var XLSbutton = document.getElementById('export-buttons-table');

        // XLSbutton.addEventListener('click', function (e) {
        //     //                   // data          // mime              // name              // extension
        instance.export2file(exportData.data, exportData.mimeType, filename, exportData.fileExtension);
        // });

    }

    $(document).ready(function () {
        $('#export-buttons-table').css("display", "unset");
    });

    function exportExcel(assetType,filename) {
        var url = "report/export_asset_management.php?type=" + assetType + "&filename=" + filename;
        var win = window.open(url, '_blank');
        win.focus();
    }

</script>