<?php
session_start();
error_reporting(0);
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
require("core/config.core.php");
$connect = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, true);
if (!mysql_select_db(DB_NAME, $connect)) {
    //echo '<script>window.location="install/"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<?php

require("core/connect.core.php");
require("core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$getdata->my_sql_set_utf8();
$userdata = $getdata->my_sql_query(NULL, "user", "user_key='" . $_SESSION['ukey'] . "'");
$system_info = $getdata->my_sql_query(NULL, "system_info", NULL);
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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="css/iconset/ios7-set-filled-1/flaticon.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="media/favicon/<?php echo @$system_info->site_favicon; ?>"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php

if (@addslashes($_GET['lang'])) {
    $_SESSION['lang'] = addslashes($_GET['lang']);
} else {
    $_SESSION['lang'] = $_SESSION['lang'];
}
if (@$_SESSION['lang'] != NULL) {
    require("language/" . @$_SESSION['lang'] . "/site.lang");
    require("language/" . @$_SESSION['lang'] . "/menu.lang");
} else {
    require("language/th/site.lang");
    require("language/th/menu.lang");
    $_SESSION['lang'] = 'th';

}
?>
<body>
<div class="container">
    <div class="row">
        <div  style="font-size:24px; color:#000000; text-align:center; padding-top:10px; margin-top: 5%;">
            <h1 class="page-header">โปรแกรมครุภัณฑ์และตรวจครุภัณฑ์บนระบบปฏิบัติการแอนดรอยด์</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">
                    <img src="media/logo/<?php echo @$system_info->site_logo; ?>" width="150" alt=""/></div>
                <div class="panel-body">
                    <?php
                    if (@addslashes($_GET['c']) == 'nouser') {
                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . LA_ALERT_USERNAME_OR_PASSWORD_INCORRECT . '</div>';
                    }
                    ?>

                    <form role="form" action="core/takelogin.core.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="<?php echo @LA_LB_USERNAME; ?>" name="username"
                                       type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="<?php echo @LA_LB_PASSWORD; ?>" name="password"
                                       type="password">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" name="login" class="btn btn-lg btn-default btn-block"><i
                                        class="fa fa-lock fa-fw"></i><?php echo @LA_BTN_LOGIN; ?></button>
                        </fieldset>
                    </form>

                    <div style="color:#CCC; text-align:center; padding-top:10px;">&copy;&nbsp;<?php echo date("Y"); ?>
                        &nbsp;Durable ครุภัณฑ์
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- jQuery Version 1.11.0 -->
<script src="js/jquery-1.11.0.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/sb-admin-2.js"></script>

</body>

</html>
