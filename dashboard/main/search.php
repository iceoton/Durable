<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-search fa-fw"></i> ค้นหา</h1>
    </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME; ?></a></li>
    <li class="active">ค้นหา</li>
</ol>
<?php

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


<?php
echo @$alert; ?>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><i class="fa fa-search"></i></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <form class="navbar-form navbar-left" role="search" method="get">
                <div class="form-group">
                    <input type="hidden" name="p" id="p" value="search">
                    <input type="text" class="form-control  " name="q"
                           placeholder="ระบุชื่อครุภัณฑ์/รหัสครุภัณฑ์ เพื่อค้นหา"
                           value="<?php echo @htmlentities($_GET['q']); ?>" size="100">
                </div>
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> <?php echo @LA_BTN_SEARCH; ?>
                </button>
            </form>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
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

        $getAsset = $getDB->my_sql_select(NULL, "asset", " (code LIKE '%" . htmlentities($_GET['q']) . "%') OR (name LIKE '%" . htmlentities($_GET['q']) . "%') ORDER BY update_date DESC");
        while ($showAsset = mysql_fetch_object($getAsset)) {
            ?>
            <tr style="font-weight:bold;" id="<?php echo @$showAsset->id; ?>">
                <td align="center"><?php echo @$showAsset->code; ?></td>
                <td align="left"><?php echo @$showAsset->name; ?></td>
                <td align="left"><?php echo @$showAsset->detail; ?></td>
                <td align="center"><?php echo @categoryIdToString($showAsset->category_id); ?></td>
                <td align="center"><?php echo @getAssetTypeById($showAsset->type_id)->name; ?></td>
                <td align="center"><?php echo @$showAsset->come_date; ?></td>
                <td align="center"><?php echo @locationIdToString($showAsset->location_id); ?></td>
                <td align="center"><?php echo @sourceIdToString($showAsset->source_id); ?></td>
                <td align="center"><?php echo @statusIdToString($showAsset->status_id); ?></td>
                <td align="center"><?php echo @$showAsset->quantity; ?></td>
                <td align="center"><?php echo @unitIdToString($showAsset->unit_id); ?></td>

                <?php
                if ($_SESSION['uclass'] > 0) {
                    echo '<td align="right">
                    <a data-toggle="modal" data-target="#edit_asset" data-whatever="' . @$showAsset->id . '"
                       title="แก้ไข" class="btn btn-xs btn-info"><i class="fa fa-edit"></i>
                    </a>
                    <a onClick="javascript:deleteAsset(' . @$showAsset->id . ');"
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
<script language="javascript">
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
    })

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