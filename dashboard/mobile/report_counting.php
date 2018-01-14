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
        <h1 class="page-header"><i class="fa fa-share-alt fa-fw"></i> <?php echo "รายงานครุภัณฑ์"; ?></h1>
    </div>
</div>
<ol class="breadcrumb">
    <li class="active"><?php echo "แยกตามชนิดครุภัณฑ์"; ?></li>
</ol>

<?php
$assetTypeId = 1;
$assetTypeName = "";
if (isset($_POST['change_asset_type'])) {
    if ((addslashes($_POST['asset_type']) != NULL)) {
        $assetTypeId = $_POST['asset_type'];

        $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . "เพิ่มครุภัณฑ์สำเร็จ" . '</div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
    }
}
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-default" id="bs-example-navbar-collapse-1">

            <form class="navbar-form from-group navbar-left" method="post" action="?p=report">

                <label for="asset_type">ชนิดครุภัณฑ์ :</label>
                <select name="asset_type" id="asset_type" class="form-control">
                    <?php
                    $get_asset_type = $getDB->my_sql_select(NULL, "asset_type", NULL);
                    while ($show_asset_type = mysql_fetch_object($get_asset_type)) {
                        if ($assetTypeId == $show_asset_type->id) {
                            $assetTypeName = $show_asset_type->name;
                            ?>
                            <option value="<?php echo @$show_asset_type->id; ?>"
                                    selected="selected"><?php echo @$show_asset_type->name; ?></option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo @$show_asset_type->id; ?>"><?php echo @$show_asset_type->name; ?></option>
                            <?php
                        }
                    }
                    $exportFileName = "รายงานครุภัณฑ์_" . $assetTypeName . "_" . date("d-m-Y");
                    ?>
                </select>
                <button type="submit" name="change_asset_type" class="btn btn-primary btn-sm"><i
                            class="fa fa-refresh fa-fw"></i><?php echo "สร้างรายงาน"; ?></button>
                <!--<button id="export-buttons-table" name="export-buttons-table"
                        onclick="javascript:exportExcel(<?php /*echo "'$assetTypeId'".",'$exportFileName'"; */?> )"
                        class="btn btn-success btn-sm"><i
                            class="fa fa-cloud-download fa-fw"></i><?php /*echo "ดาวน์โหลด excel"; */?></button>-->

                <!--onclick="javascript:exportData('<?php /*echo $exportFileName; */ ?>');"-->
            </form>

            <!--<ul class="nav navbar-nav">
                <li><a class="navbar-brand" href="?p=#" style="cursor:pointer;">
                        <i class="fa fa-refresh"></i>
                        สร้างรายงาน</a></li>
            </ul>

            <ul class="nav navbar-nav">
                <li><a class="navbar-brand" href="?p=#" style="cursor:pointer;">
                        <i class="fa fa-cloud-download"></i>
                        ดาวน์โหลด excel</a></li>
            </ul>-->

        </div>

    </div>
</nav>

<div class="table-responsive">
    <table width="100%" border="0" class="table table-bordered" id="table_export">
        <thead>
        <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
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
        </thead>
        <tbody>
        <?php
        $index = 0;
        //SELECT * FROM asset LEFT JOIN asset_management ON asset.id = asset_management.asset_id
        $getcard = $getDB->my_sql_select("*, asset.quantity, asset_management.quantity as q", "asset LEFT JOIN asset_management ON asset.id = asset_management.asset_id", "type_id = '" . $assetTypeId . "'  ORDER BY code");
        while ($showcard = mysql_fetch_object($getcard)) {
            ?>
            <tr style="font-weight:bold;" id="<?php echo @$showcard->id; ?>">
                <!--<td align="center"><a
                            href="?p=asset_detail&id=<?php /*echo @$showcard->id; */ ?>"><?php /*echo @$showcard->code; */ ?></a>
                    </td>-->
                <td align="center"><?php echo $index += 1 ?></td>
                <td align="left"><?php echo @$showcard->code; ?></td>
                <td align="left"><?php echo @$showcard->name; ?></td>
                <td align="left"><?php echo @$showcard->detail; ?></td>
                <!--<td align="center"><?php /*echo @getAssetCategoryById($showcard->category_id)->code; */ ?></td>
                <td align="center"><?php /*echo @getAssetTypeById($showcard->type_id)->name; */ ?></td>-->
                <td align="left"><?php echo @$showcard->come_date; ?></td>
                <td align="center"><?php echo @locationIdToString($showcard->location_id); ?></td>
                <!--<td align="center"><?php /*echo @sourceIdToString($showcard->source_id); */ ?></td>-->
                <!--<td align="center"><?php /*echo @statusIdToString($showcard->status_id); */ ?></td>-->
                <td align="center"><?php echo @getAssetStatusCode($showcard->status_id); ?></td>
                <td align="center"><?php echo @$showcard->quantity; ?></td>
                <td align="center"><?php echo @unitIdToString($showcard->unit_id); ?></td>
                <td align="center">
                    <?php
                    if ($showcard->q != null) {
                        //echo @($showcard->quantity - $showcard->q);
                        echo @$showcard->quantity;
                    } else {
                        echo @$showcard->quantity;
                    }

                    ?></td>
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
        var url = "report/export_excel.php?type=" + assetType + "&filename=" + filename;
        var win = window.open(url, '_blank');
        win.focus();
    }

</script>