<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-user fa-fw"></i> <?php echo @LA_LB_SYSTEM_USER; ?></h1>
    </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME; ?></a></li>
    <li><a href="index.php?p=member"><?php echo @LA_LB_MEMBER; ?></a></li>
    <li class="active">แก้ไขข้อมูล</li>
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
<?php
echo @$alert;
?>
<!--<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i
        class="fa fa-plus fa-fw"></i>เพิ่มผู้ใช้งาน
</button>-->
<?php
if (@addslashes($_GET['e']) == 'y') {
    $getuser_detail = $getDB->my_sql_query(NULL, "user", "user_key='" . addslashes($_GET['key']) . "'");
    if (isset($_POST['edit_user_info'])) {
        if (addslashes($_POST['edit_password']) != NULL && addslashes($_POST['edit_repassword']) != NULL) {
            if (addslashes($_POST['edit_password']) == addslashes($_POST['edit_repassword'])) {
                $getDB->my_sql_update("user", "name='" . addslashes($_POST['edit_name']) . "',lastname='" . addslashes($_POST['edit_lastname']) . "',password='" . md5(addslashes($_POST['edit_password'])) . "',email='" . addslashes($_POST['edit_email']) ."',user_class='" . addslashes($_POST['user_class']) ."'", "user_key='" . addslashes($_GET['key']) . "'");
                echo '<script>window.location="?p=member"</script>';
            } else {
                $alert2 = '  <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . LA_ALERT_PASSWORD_MISMATCH . '</div>';
            }

        } else {
            $getDB->my_sql_update("user", "name='" . addslashes($_POST['edit_name']) . "',lastname='" . addslashes($_POST['edit_lastname']) . "',email='" . addslashes($_POST['edit_email']) ."',user_class='" . addslashes($_POST['user_class']) ."'", "user_key='" . addslashes($_GET['key']) . "'");
            echo '<script>window.location="?p=member"</script>';
        }
    }
    ?>
    <?php
    echo @$alert2;
    ?>
    <form id="form2" name="form2" method="post">
        <div class="panel panel-info">
            <div class="panel-heading"><?php echo @LA_LB_EDIT_USER; ?></div>
            <div class="panel-body">
                <table width="100%" border="0">
                    <tr>
                        <td width="28%"><?php echo @LA_LB_USERNAME; ?></td>
                        <td width="72%">
                            <div class="form-group">
                                <input name="edit_username" type="text" disabled="disabled" id="edit_username"
                                       value="<?php echo @$getuser_detail->username; ?>" class="form-control"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo @LA_LB_NAME; ?></td>
                        <td>
                            <div class="form-group">
                                <input type="text" name="edit_name" id="edit_name" class="form-control"
                                       value="<?php echo @$getuser_detail->name; ?>"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo @LA_LB_LASTNAME; ?></td>
                        <td>
                            <div class="form-group">
                                <input type="text" name="edit_lastname" id="edit_lastname" class="form-control"
                                       value="<?php echo @$getuser_detail->lastname; ?>"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo @LA_LB_EMAIL; ?></td>
                        <td>
                            <div class="form-group">
                                <input type="email" name="edit_email" id="edit_email" class="form-control"
                                       value="<?php echo @$getuser_detail->email; ?>"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>ระดับผู้ใช้งาน</td>
                        <td>
                            <div class="form-group">
                                <select name="user_class" id="user_class" class="form-control">
                                    <option value="1" <?php if(@$getuser_detail->user_class == 1) echo "selected=\"selected\"";?>>เจ้าหน้าที่</option>
                                    <option value="0" <?php if(@$getuser_detail->user_class == 0) echo "selected=\"selected\"";?>>ผู้บริหาร</option>
                                </select>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo @LA_LB_NEW_PASSWORD; ?></td>
                        <td>
                            <div class="form-group">
                                <input type="password" name="edit_password" id="edit_password" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo @LA_LB_NEW_PASSWORD_AGAIN; ?></td>
                        <td>
                            <div class="form-group">
                                <input type="password" name="edit_repassword" id="edit_repassword" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>

            </div>
            <div class="panel-footer">
                <button type="submit" name="edit_user_info" class="btn btn-info btn-sm"><i
                        class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE; ?></button>
            </div>
        </div>
    </form>
    <?php
}
?>

