<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-retweet fa-fw"></i> <?php echo "รายงานการยืมครุภัณฑ์"; ?></h1>
    </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME; ?></a></li>
    <li><a href="?p=report"><?php echo "รายงานครุภัณฑ์"; ?></a></li>
    <li class="active"><?php echo "รายงานการยืมครุภัณฑ์"; ?></li>
</ol>

<?php
$manageType = 2;
$exportFileName = "รายงานการยืมครุภัณฑ์_". date("d-m-Y");
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-default" id="bs-example-navbar-collapse-1">

            <form class="navbar-form from-group navbar-left" method="post" action="?p=report">
                <button id="export-buttons-table" name="export-buttons-table"
                        onclick="javascript:exportExcel(<?php echo "'$manageType'".",'$exportFileName'"; ?> )"
                        class="btn btn-success btn-sm"><i
                            class="fa fa-cloud-download fa-fw"></i><?php echo "ดาวน์โหลด excel"; ?></button>

                <!--onclick="javascript:exportData('<?php /*echo $exportFileName; */ ?>');"-->
            </form>

        </div>

    </div>
</nav>

<div class="table-responsive">
    <table width="100%" border="0" class="table table-bordered" id="table_export">
        <thead>
        <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
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