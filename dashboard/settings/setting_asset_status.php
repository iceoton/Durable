<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa flaticon-tag20 fa-fw"></i> สถานะของครุภัณฑ์</h1>
    </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME; ?></a></li>
    <li><a href="?p=setting"><?php echo @LA_LB_SETTING; ?></a></li>
    <li class="active">สถานะของครุภัณฑ์</li>
</ol>

<?php
if (isset($_POST['save_card'])) {
    if ((addslashes($_POST['status_code']) != NULL) && (addslashes($_POST['status_name']) != NULL)) {
        $statusCode = $_POST['status_code'];
        $statusName = $_POST['status_name'];
        if (@getAssetStatus($statusCode) != null) {
            $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . "เพิ่มสถานะไม่สำเร็จ รหัสครุภัณฑ์ซ้ำ" . '</div>';
        } else {
            $getDB->my_sql_insert("status", "code='" . $statusCode . "', name='" . $statusName . "'");
            $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . "เพิ่มสถานะครุภัณฑ์สำเร็จ" . '</div>';
        }
    } else {
        $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . "เพิ่มสถานะไม่สำเร็จ กรุณากรอกข้อมูลให้ครบ" . '</div>';
    }
}
if (isset($_POST['save_edit_card'])) {
    if ((addslashes($_POST['edit_status_code']) != NULL) && (addslashes($_POST['edit_status_name']) != NULL)) {
        $statusCode = $_POST['edit_status_code'];
        $statusName = $_POST['edit_status_name'];
        if (@getAssetStatus($statusCode) != null) {
            $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . "แก้ไขไม่สำเร็จ รหัสครุภัณฑ์ซ้ำ" . '</div>';
        } else {
            $getDB->my_sql_update("status", "code='" . $statusCode . "', name='" . $statusName . "'", "id='" . addslashes($_POST['status_id']) . "'");
            $alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . "แก้ไขสถานะครุภัณฑ์สำเร็จ" . '</div>';
        }
    } else {
        $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . LA_ALERT_DATA_MISMATCH . '</div>';
    }
}
?>
<!-- Modal Edit -->
<div class="modal fade" id="edit_asset_status" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel"
     aria-hidden="true">
    <form id="form2" name="form2" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE; ?></span>
                    </button>
                    <h4 class="modal-title" id="memberModalLabel">สถานะครุภัณฑ์</h4>
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
                    <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลสถานะของครุภัณฑ์</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="status_code">รหัสสถานะ</label>
                            <input type="text" name="status_code" id="status_code" class="form-control" autofocus>
                        </div>
                        <div class="col-md-6">
                            <label for="status_name">ชื่อสถานะของครุภัณฑ์</label>
                            <input type="text" name="status_name" id="status_name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                            class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE; ?></button>
                    <button type="submit" name="save_card" class="btn btn-primary btn-sm"><i
                            class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE; ?></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
echo @$alert;
?>

<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i
        class="fa fa-plus fa-fw"></i> เพิ่มสถานะของครุภัณฑ์
</button><br/><br/>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">สถานะของครุภัณฑ์ทั้งหมด</div>
    <div class="table-responsive">
        <!-- Table -->
        <table width="100%" class="table table-striped table-bordered table-hover">
            <thead>
            <tr style="color:#FFF;">
                <th width="3%" bgcolor="#5fb760">#</th>
                <th width="10%" bgcolor="#5fb760">รหัสสถานะ</th>
                <th width="64%" bgcolor="#5fb760">ชื่อสถานะของครุภัณฑ์</th>
                <th width="23%" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE; ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $x = 0;
            $getcat = $getDB->my_sql_select(NULL, "status", "code <> '' ORDER BY code");
            while ($showcat = mysql_fetch_object($getcat)) {
                $x++;
                ?>
                <tr id="<?php echo @$showcat->id; ?>">
                    <td align="center"><?php echo @$x; ?></td>
                    <td><?php echo @$showcat->code; ?></td>
                    <td><?php echo @$showcat->name; ?></td>
                    <td align="center" valign="middle">
                        <a data-toggle="modal" data-target="#edit_asset_status"
                           data-whatever="<?php echo @$showcat->id; ?>" class="btn btn-xs btn-info"
                           style="color:#FFF;"><i class="fa fa-edit fa-fw"></i> <?php echo @LA_BTN_EDIT; ?>
                        </a>
                        <button type="button" class="btn btn-danger btn-xs"
                                onClick="javascript:deletecat('<?php echo @$showcat->id; ?>');"><i
                                class="glyphicon glyphicon-remove"></i> <?php echo @LA_BTN_DELETE; ?>
                        </button>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    function MM_jumpMenu(targ, selObj, restore) { //v3.0
        eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
        if (restore) selObj.selectedIndex = 0;
    }
</script>
<script language="javascript">
    function deletecat(catkey) {
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(catkey).innerHTML = '';
            }
        }
        xmlhttp.open("GET", "function.php?type=delete_asset_status&id=" + catkey, true);
        xmlhttp.send();
    }
</script>
<script>
    $('#edit_asset_status').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'key=' + recipient;

        $.ajax({
            type: "GET",
            url: "settings/edit_asset_status.php",
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
</script>