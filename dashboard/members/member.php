<link href="../css/plugins/dataTables.bootstrap.css" rel="stylesheet">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-users fa-fw"></i> <?php echo @LA_LB_MEMBER; ?></h1>
    </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME; ?></a></li>
    <li class="active"><?php echo @LA_LB_MEMBER; ?></li>
</ol>
<?php
if (isset($_POST['save_user'])) {
    if (addslashes($_POST['username']) != NULL && addslashes($_POST['password']) != NULL && addslashes($_POST['repassword']) != NULL) {
        $getuser = $getDB->my_sql_show_rows("user", "username='" . addslashes($_POST['username']) . "' OR email='" . addslashes($_POST['email']) . "'");
        if ($getuser == 0) {
            if (addslashes($_POST['password']) == addslashes($_POST['repassword'])) {
                $user_key = md5(addslashes($_POST['username']) . time("now"));
                $getDB->my_sql_insert("user", "user_key='" . $user_key . "',name='" . addslashes($_POST['name']) . "',lastname='" . addslashes($_POST['lastname']) . "',username='" . addslashes($_POST['username']) . "',password='" . md5(addslashes($_POST['password'])) . "',email='" . addslashes($_POST['email']) . "',user_status='1',user_class='" . addslashes($_POST['user_class']) . "'");
                $alert = '  <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . LA_ALERT_INSERT_USER_DONE . '</div>';
            } else {
                $alert = ' <div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . LA_ALERT_PASSWORD_MISMATCH . '</div>';
            }
        } else {
            $alert = ' <div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . LA_ALERT_USERNAME_UNAVAILABLE . '</div>';
        }
    } else {
        $alert = ' <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . LA_ALERT_DATA_MISMATCH . '</div>';
    }
}
if(isset($_GET['edit_success'])) {
    $alert2 = '  <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . 'แก้ไขข้อมูลสำเร็จ' . '</div>';
    echo @$alert2;
}

echo @$alert;
?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" name="form1" id="form1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo @LA_LB_INSERT_USER_DATA; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name"><?php echo @LA_LB_NAME; ?></label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="lastname"><?php echo @LA_LB_LASTNAME; ?></label>
                        <input type="text" name="lastname" id="lastname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username"><?php echo @LA_LB_USERNAME; ?></label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password"><?php echo @LA_LB_PASSWORD; ?></label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="repassword"><?php echo @LA_LB_PASSWORD_AGAIN; ?></label>
                        <input type="password" name="repassword" id="repassword" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email"><?php echo @LA_LB_EMAIL; ?></label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="user_class">ระดับผู้ใช้งาน</label>
                        <select name="user_class" id="user_class" class="form-control">
                            <option value="1" selected="selected">เจ้าหน้าที่</option>
                            <option value="0">ผู้บริหาร</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE; ?></button>
                    <button type="submit" name="save_user" class="btn btn-primary btn-sm"><i
                                class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE; ?></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i
            class="fa fa-plus fa-fw"></i>เพิ่มผู้ใช้งาน
</button><br/><br/>


<div class="table-responsive tooltipx">
    <!-- Table -->
    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr style=" font-weight:bold;">
            <th width="8%">#</th>
            <th width="11%"><?php echo @LA_LB_PHOTO; ?></th>
            <th width="31%"><?php echo @LA_LB_NAME; ?></th>
            <th width="21%"><?php echo @LA_LB_USERNAME; ?></th>
            <?php
            if (@$_SESSION['uclass'] >= 2) {
                ?>
                <th width="29%"><?php echo @LA_LB_MANAGE; ?></th>
                <?php
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $l = 0;

        @$getalluser = $getDB->my_sql_select(NULL, "user", "user_class = '0' OR user_class = '1' ORDER BY username");

        while (@$showalluser = mysql_fetch_object($getalluser)) {
            $l++;

            $getonline = $getDB->my_sql_show_rows("user_online", "user_key='" . $showalluser->user_key . "'");
            if ($getonline != 0) {
                $color = 'color:#0C0;';
            } else {
                $color = 'color:#CCC;';
            }
            ?>
            <tr id="<?php echo @$showalluser->user_key; ?>">
                <td align="center"><?php echo @$l; ?></td>
                <td align="center">
                    <div class="box_img_cycle3"><img
                                src="../resource/users/thumbs/<?php echo @$showalluser->user_photo; ?>" <?php echo getPhotoSize('../resource/users/thumbs/' . @$showalluser->user_photo . ''); ?>
                                id="img_cycle3" alt=""/></div>
                </td>
                <td>&nbsp;<span style="font-size:12px; <?php echo $color; ?>"><i class="fa fa-circle fa-fw"></i></span>&nbsp;<?php echo @$showalluser->name . "&nbsp;&nbsp;&nbsp;" . $showalluser->lastname; ?>
                </td>
                <td align="center"><?php echo @$showalluser->username; ?></td>
                <?php
                if (@$_SESSION['uclass'] >= 2) {
                    ?>

                    <td align="center"> <?php
                        if ($showalluser->user_status == '1') {
                            echo '<button type="button" class="btn btn-success btn-xs" id="btn-' . @$showalluser->user_key . '" onClick="javascript:changeUserStatus(\'' . @$showalluser->user_key . '\');"><i class="fa fa-unlock-alt" id="icon-' . @$showalluser->user_key . '"></i> <span id="text-' . @$showalluser->user_key . '">' . "บล็อค" . '</span></button>';
                        } else {
                            echo '<button type="button" class="btn btn-danger btn-xs" id="btn-' . @$showalluser->user_key . '" onClick="javascript:changeUserStatus(\'' . @$showalluser->user_key . '\');"><i class="fa fa-lock" id="icon-' . @$showalluser->user_key . '"></i> <span id="text-' . @$showalluser->user_key . '">' . "เลิกบล็อค" . '</span></button>';
                        }
                        ?><a href="?p=edit_member&e=y&key=<?php echo @$showalluser->user_key; ?>"
                             class="btn btn-info btn-xs "><i
                                    class="fa fa-edit fa-fw"></i><?php echo @LA_BTN_EDIT; ?></a>
                        <!--<a href="?p=setting_user_access&key=<?php echo @$showalluser->user_key; ?>" class="btn btn-primary btn-xs " ><i class="fa fa-gear fa-fw"></i><?php echo @LA_BTN_ACCESS; ?></a>-->
                        <button type="button" class="btn btn-danger btn-xs "
                                onClick="javascript:deleteUser('<?php echo @$showalluser->user_key; ?>');"><i
                                    class="fa fa-times fa-fw"></i><?php echo @LA_BTN_DELETE; ?></button>
                    </td>
                    <?php
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
    function changeUserStatus(userkey) {
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var es = document.getElementById('btn-' + userkey);
        if (es.className == 'btn btn-success btn-xs') {
            var sts = 1;
        } else {
            var sts = 0;
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                if (es.className == 'btn btn-success btn-xs') {
                    document.getElementById('btn-' + userkey).className = 'btn btn-danger btn-xs';
                    document.getElementById('icon-' + userkey).className = 'fa fa-lock';
                    document.getElementById('text-' + userkey).innerHTML = 'เลิกบล็อค';
                } else {
                    document.getElementById('btn-' + userkey).className = 'btn btn-success btn-xs';
                    document.getElementById('icon-' + userkey).className = 'fa fa-unlock-alt';
                    document.getElementById('text-' + userkey).innerHTML = ' บล็อค';
                }
            }
        }

        xmlhttp.open("GET", "function.php?type=change_user_status&key=" + userkey + "&sts=" + sts, true);
        xmlhttp.send();
    }

    function deleteUser(userkey) {
        if (confirm('การลบข้อมูลจะไม่สามารถกู้คืนได้, คุณแน่ใจที่จะทำการลบหรือไม่?')) {
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById(userkey).innerHTML = '';
                }
            }
            xmlhttp.open("GET", "function.php?type=delete_user&key=" + userkey, true);
            xmlhttp.send();
        }
    }
</script>
<script>
    $('#edit_member').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'key=' + recipient;

        $.ajax({
            type: "GET",
            url: "members/edit_member.php",
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

    function copyAddress() {
        var addr = document.getElementById('member_address').value;
        document.getElementById('member_address_now').value = addr;
    }

    function randomPassword(password_id, password_pattern, password_prefix, password_length) {
        var text = "";
        if (password_pattern == 1) {
            var possible = "0123456789";
        } else if (password_pattern == 2) {
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        } else if (password_pattern == 3) {
            var possible = "abcdefghijklmnopqrstuvwxyz";
        } else if (password_pattern == 4) {
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        } else if (password_pattern == 5) {
            var possible = "abcdefghijklmnopqrstuvwxyz0123456789";
        } else if (password_pattern == 6) {
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        } else {
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        }

        for (var i = 0; i < password_length; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        document.getElementById(password_id).value = password_prefix + text;
    }
</script>
<!-- DataTables JavaScript -->

<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>