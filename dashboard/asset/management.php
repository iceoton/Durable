<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-edit fa-fw"></i> คืนครุภัณฑ์/ส่งซ่อมครุภัณฑ์</h1>
    </div>
</div>
<?php
session_start();
if ('POST' === $_SERVER['REQUEST_METHOD']) {
    if (isset($_POST['item']) && !empty($_POST['item'] . trim())) {
        $_SESSION['assets'][] = $_POST['item'];
        //var_dump($_SESSION['assets']);
    }

    if (isset($_POST['remove_asset'])) {
        //$key = array_search($_POST['remove_asset'], $_SESSION['assets']);
        $assetAll = $_SESSION['assets'];
        unset($_SESSION['assets']);
        //var_dump($assetAll);
        $key = $_POST['remove_asset'];
        //echo "<br>remove=$key<br>";
        /*if ($key != false) {
            //unset($assetAll[$key]);
            array_splice($assetAll, $key, 1);
        }*/
        for ($i = 0; $i < count($assetAll); $i++) {
            if ($i != $key) {
                $_SESSION["assets"][] = $assetAll[$i];
            }
        }
        //echo "removed=";
        //var_dump($_SESSION['assets']);

        /*foreach ($assetAll as $asset) {
            if ($asset != null)
                $_SESSION["assets"][] = $asset;
        }*/
    }

    if (isset($_POST['manage_asset'])) {
        if ($_SESSION['assets'] != null) {
            $arrayAsset = $_SESSION['assets'];
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

            foreach ($arrayAsset as $assetId) {
                $getDB->my_sql_insert("asset_management", "user_key='" . $userKey . "', asset_id='" . $assetId
                    . "', manage_type='" . $enumManageType
                    . "', quantity=" . "1" . ", create_date='" . date("Y-m-d H:i:s"). "'"
                    . ", update_date='" . date("Y-m-d H:i:s") . "'");

            }
            unset($_SESSION['assets']);

            $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . "บันทึกการ" . $strManageType . "สำเร็จ" . '</div>';

        } else {
            $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
        }
    }
}
?>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME; ?></a></li>
    <li><a href="?p=asset"><?php echo "รายการครุภัณฑ์"; ?></a></li>
    <li class="active">คืน-ส่งซ่อม</li>
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
?>

<?php
echo @$alert;
?>

<div class="panel panel-info">
    <div class="panel-heading">ครุภัณฑ์ที่ต้องการทำรายการ</div>
    <div class="panel-body">
        <div class="table-responsive tooltipx">
            <!-- Table -->
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr style=" font-weight:bold;">
                    <th width="5%">#</th>
                    <th width="69%"><?php echo "รายการ"; ?></th>
                    <th width="10%"><?php echo "รหัสสินทรัพย์"; ?></th>
                    <th width="8%"><?php echo "จำนวน"; ?></th>
                    <th width="8%"><?php echo @LA_LB_MANAGE; ?></th>
                </thead>
                <tbody>
                <?php

                if (isset($_SESSION['assets']) && !empty($_SESSION['assets'])) {
                    //echo "array count=" . count($_SESSION['assets']);
                    $arrayAsset = $_SESSION['assets'];

                    for ($i = 0; $i < count($arrayAsset); $i++) {
                        $assetAtRow = $getDB->my_sql_query(NULL, "asset", "id='" . $arrayAsset[$i] . "'");
                        ?>
                        <tr id="<?php echo @$assetAtRow->id; ?>">
                            <td align="center"><?php echo @$i + 1; ?></td>
                            <td align="left"><?php echo @$assetAtRow->name . " " . @$assetAtRow->detail; ?></td>
                            <td align="center"><?php echo @$assetAtRow->code; ?></td>
                            <td align="center"><?php echo @$assetAtRow->quantity; ?></td>
                            <td align="center">
                                <form method="post">
                                    <input type="hidden" name="remove_asset" id="remove_asset"
                                           value="<?php echo $i; ?>">
                                    <button type="submit" class="btn btn-danger btn-xs ">
                                        <i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_DELETE; ?>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>

        </div><!-- /.table-responsive -->
        <form id="form2" name="form2" method="post" class="navbar-form navbar-right">
            <div class="collapse navbar-collapse">
                <div class="form-group">
                    <select name="manage_type" id="manage_type" class="form-control">
                        <!--<option value="0" selected="selected">เบิกครุภัณฑ์</option>
                        <option value="1">ยืมครุภัณฑ์</option>-->
                        <option value="2" selected="selected">คืนครุภัณฑ์</option>
                        <option value="3">ส่งซ่อมครุภัณฑ์</option>
                    </select>
                </div>
                <button type="submit" name="manage_asset" class="btn btn-info btn-sm"><i
                            class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE; ?></button>
            </div>
        </form>
    </div> <!-- /.panel-body -->
</div> <!-- /.panel-primary -->
<p id="demo"></p>
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
                    <input type="hidden" name="p" id="p" value="asset_management">
                    <input type="text" class="form-control  " name="q"
                           placeholder="ระบุชื่อครุภัณฑ์/รหัสครุภัณฑ์ ที่ต้องการทำรายการ"
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
            <td width="10%">จัดการ</td>
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
                <td align="center">
                    <form method="post">
                        <input type="hidden" name="item" id="item" value="<?php echo @$showAsset->id; ?>">
                        <button type="submit" class="btn btn-success btn-xs "
                        <i class="fa fa-plus fa-fw"></i>เพิ่มรายการ
                        </button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>

    </table>

</div>

<script language="javascript">
    function removeAsset(assetId) {
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
            xmlhttp.open("POST", "", true);
            xmlhttp.send();
        }
    }
</script>
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
    });

    var values = [];

    function addAsset(assetId) {
        if (confirm('คุณต้องการเพิ่มเข้ารายการครุภัณฑ์ใช่หรือไม่ ?')) {
            //var dataString = "asset" + values.length +"=" + assetId;
            values.push(assetId);
            values.toString();
            document.getElementById("demo").innerHTML = values;

            $.ajax({
                type: "POST",
                data: {
                    assets: values
                },
                cache: false,
                success: function (data) {
                    console.log(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    }
</script>