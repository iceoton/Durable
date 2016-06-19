<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-chain fa-fw"></i> แหล่งที่มาของครุภัณฑ์์</h1>
    </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME; ?></a></li>
    <li><a href="?p=setting"><?php echo @LA_LB_SETTING; ?></a></li>
    <li class="active">แหล่งที่มาของครุภัณฑ์</li>
</ol>

<?php
if (isset($_POST['save_source'])) {
    if ((addslashes($_POST['source_code']) != NULL) && (addslashes($_POST['source_name']) != NULL)) {
        $statusCode = $_POST['source_code'];
        $statusName = $_POST['source_name'];
        $getDB->my_sql_insert("source", "code='" . $statusCode . "', name='" . $statusName . "'");
        $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . "เพิ่มแหล่งที่มาของครุภัณฑ์์สำเร็จ" . '</div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . "เพิ่มแหล่งที่มาของครุภัณฑ์์ไม่สำเร็จ กรุณากรอกข้อมูลให้ครบ" . '</div>';
    }
}
if (isset($_POST['save_edit_source'])) {
    if ((addslashes($_POST['edit_source_code']) != NULL) && (addslashes($_POST['edit_source_name']) != NULL)) {
        $statusCode = $_POST['edit_source_code'];
        $statusName = $_POST['edit_source_name'];
        $getDB->my_sql_update("source", "code='" . $statusCode . "', name='" . $statusName. "'", "id='" . addslashes($_POST['source_id']) . "'");
        $alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . "แก้ไขแหล่งที่มาของครุภัณฑ์์์สำเร็จ"  . '</div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . LA_ALERT_DATA_MISMATCH . '</div>';
    }
}
?>
<!-- Modal Edit -->
<div class="modal fade" id="edit_asset_source" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form id="form2" name="form2" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE; ?></span>
                    </button>
                    <h4 class="modal-title" id="memberModalLabel">แหล่งที่มาของครุภัณฑ์์</h4>
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
                    <h4 class="modal-title" id="myModalLabel">เพิ่มแหล่งที่มาของครุภัณฑ์์</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="source_code">รหัสแหล่งที่มา</label>
                            <input type="text" name="source_code" id="source_code" class="form-control" autofocus>
                        </div>
                        <div class="col-md-6">
                            <label for="source_name">ชื่อแหล่งที่มาของครุภัณฑ์</label>
                            <input type="text" name="source_name" id="source_name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                            class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE; ?></button>
                    <button type="submit" name="save_source" class="btn btn-primary btn-sm"><i
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
        class="fa fa-plus fa-fw"></i> เพิ่มแหล่งที่มาของครุภัณฑ์์
</button><br/><br/>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">แหล่งที่มาของครุภัณฑ์์์ทั้งหมด</div>
    <div class="table-responsive">
        <!-- Table -->
        <table width="100%" class="table table-striped table-bordered table-hover">
            <thead>
            <tr style="color:#FFF;">
                <th width="3%" bgcolor="#5fb760">#</th>
                <th width="10%" bgcolor="#5fb760">รหัสแหล่งที่มา</th>
                <th width="64%" bgcolor="#5fb760">ชื่อแหล่งที่มาของครุภัณฑ์</th>
                <th width="23%" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE; ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $x = 0;
            $getcat = $getDB->my_sql_select(NULL, "source", "code <> '' ORDER BY code");
            while ($showsource = mysql_fetch_object($getcat)) {
                $x++;
                ?>
                <tr id="<?php echo @$showsource->id; ?>">
                    <td align="center"><?php echo @$x; ?></td>
                    <td><?php echo @$showsource->code; ?></td>
                    <td><?php echo @$showsource->name; ?></td>
                    <td align="center" valign="middle">
                        <a data-toggle="modal" data-target="#edit_asset_source"
                           data-whatever="<?php echo @$showsource->id; ?>" class="btn btn-xs btn-info"
                           style="color:#FFF;"><i class="fa fa-edit fa-fw"></i> <?php echo @LA_BTN_EDIT; ?>
                        </a>
                        <button type="button" class="btn btn-danger btn-xs"
                                onClick="javascript:deletesource('<?php echo @$showsource->id; ?>');"><i
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
    function deletesource(sourcekey) {
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(sourcekey).innerHTML = '';
            }
        }
        xmlhttp.open("GET", "function.php?type=delete_asset_source&id=" + sourcekey, true);
        xmlhttp.send();
    }
</script>
<script>
    $('#edit_asset_source').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'key=' + recipient;

        $.ajax({
            type: "GET",
            url: "settings/edit_asset_source.php",
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