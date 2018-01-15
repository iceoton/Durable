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
        <h1 class="page-header"><i class="fa fa-bar-chart fa-fw"></i> <?php echo "รายงานครุภัณฑ์"; ?></h1>
    </div>
</div>

<div class="button_center">
    <div class="panel panel-primary">
        <div class="panel-heading">รายงานการตรวจนับครุภัณฑ์</div>
        <div class="panel-body">
            <a href="./report_counting.php" class="btn btn-primary btn_main_wd"><i
                        class="fa fa-share-alt fa-fw fa-6x"></i><br/><br/>แยกตามชนิดครุภัณฑ์</a>

        </div>

    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">รายงานการ เบิก/ยืม/คืน/ส่งซ่อม ครุภัณฑ์</div>
        <div class="panel-body">
            <a href="./report_pickup.php" class="btn btn-primary btn_main_wd"><i
                        class="fa fa-minus-circle fa-fw fa-6x"></i><br/><br/>การเบิกครุภัณฑ์</a>
            <a href="./report_borrow.php" class="btn btn-primary btn_main_wd"><i
                        class="fa fa-retweet fa-fw fa-6x"></i><br/><br/>การยืมครุภัณฑ์</a>
            <a href="./report_return.php" class="btn btn-primary btn_main_wd"><i
                        class="fa fa-plus-circle fa-fw fa-6x"></i><br/><br/>การคืนครุภัณฑ์</a>
            <a href="./report_repair.php" class="btn btn-primary btn_main_wd"><i
                        class="fa fa-wrench fa-fw fa-6x"></i><br/><br/>การส่งซ่อมครุภัณฑ์</a>

        </div>

    </div>

</div>

</body>
</html>