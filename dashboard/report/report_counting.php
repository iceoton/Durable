<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-home fa-fw"></i> <?php echo "รายงานครุภัณฑ์"; ?></h1>
    </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME; ?></a></li>
    <li><a href="?p=report"><?php echo "รายงานครุภัณฑ์"; ?></a></li>
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
                <button id="export-buttons-table" name="export-buttons-table"
                        onclick="javascript:exportExcel(<?php echo "'$assetTypeId'".",'$exportFileName'"; ?> )"
                        class="btn btn-success btn-sm"><i
                            class="fa fa-cloud-download fa-fw"></i><?php echo "ดาวน์โหลด excel"; ?></button>

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