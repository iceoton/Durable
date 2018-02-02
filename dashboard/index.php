<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Bangkok');
?>
<!DOCTYPE html>
<html>
<?php
if ($_SESSION['uname'] == NULL || $_SESSION['uclass'] == 1) {
    echo '<script>window.location="../"</script>';
}
require("../core/config.core.php");
require("../core/connect.core.php");
require("../core/functions.core.php");
$getDB = new clear_db();
$connect = $getDB->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$getDB->my_sql_set_utf8();
$userdata = $getDB->my_sql_query(NULL, "user", "user_key='" . $_SESSION['ukey'] . "'");
$system_info = $getDB->my_sql_query(NULL, "system_info", NULL);
date_default_timezone_set('Asia/Bangkok');
require("../core/online.core.php");
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Durable</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css"/>
    <link href="../css/datepicker.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../css/plugins/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../css/bootstrap-combobox.css" rel="stylesheet">
    <link href="../css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/iconset/ios7-set-filled-1/flaticon.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="../media/favicon/<?php echo @$system_info->site_favicon; ?>"/>
    <link rel="stylesheet" href="../css/selectize.default.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.../js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php
if (@addslashes($_GET['lang'])) {
    $_SESSION['lang'] = addslashes($_GET['lang']);
} else {
    $_SESSION['lang'] = $_SESSION['lang'];
}
if (@$_SESSION['lang'] != NULL) {
    require("../language/" . @$_SESSION['lang'] . "/site.lang");
    require("../language/" . @$_SESSION['lang'] . "/menu.lang");
} else {
    require("../language/th/site.lang");
    require("../language/th/menu.lang");
    $_SESSION['lang'] = 'th';

}
?>
<!-- jQuery Version 1.11.0 -->
<!--<script src="../js/jquery-1.11.0.js"></script>-->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->

<script src="../js/plugins/morris/raphael.min.js"></script>
<script src="../js/plugins/morris/morris.min.js"></script>


<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>
<script src="../js/bootstrap-combobox.js"></script>
<script src="../js/bootstrap-colorpicker.js"></script>
<script src="../js/bootstrap-dialog.min.js"></script>
<script src="../js/latest/typeahead.bundle.js"></script>
<script src="../js/standalone/selectize.js"></script>
<!--for export table to excel-->
<script type="text/javascript" src="../js/xls.core.js"></script>
<script type="text/javascript" src="../js/xlsx.core.js"></script>
<script type="text/javascript" src="../js/Blob.js"></script>
<script type="text/javascript" src="../js/file-saver.js"></script>
<script type="text/javascript" src="../js/table-export.js"></script>
<script type="text/javascript" src="../js/jquery.base64.js"></script>
<?php
if (@addslashes($_GET['p']) == "cashier_nomember" || addslashes($_GET['p']) == "import" || addslashes($_GET['p']) == "cashier_member") {
    $stime = 'onLoad="startDateTime();"';
}
?>
<body <?php echo @$stime; ?>>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img src="../media/logo/<?php echo @$system_info->site_logo; ?>"
                                                          height="27" alt=""/></a>
        </div>
        <!-- /.navbar-header -->

        <a href="?p=setting_info">
            <div class="box_user_right">
                <div class="box_img_cycle2"><img
                            src="../resource/users/thumbs/<?php echo @$userdata->user_photo; ?>" <?php echo getPhotoSize('../resource/users/thumbs/' . @$userdata->user_photo . ''); ?>
                            id="img_cycle2" alt=""/>
                </div><?php echo @$userdata->name . "&nbsp;&nbsp;&nbsp;" . $userdata->lastname; ?></div>
        </a>


        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <?php
                    $getmenus = $getDB->my_sql_select(NULL, "menus", "menu_status='1' AND menu_key=menu_upkey ORDER BY menu_sorting");
                    while ($showmenus = mysql_fetch_object($getmenus)) {
                        // ตรวจสอบว่ามีเมนูนั้นจริงๆ
                        $cksub = $getDB->my_sql_show_rows("menus", "menu_status='1' AND menu_key <> menu_upkey AND '" . $showmenus->menu_key . "' = menu_upkey");

                        if ($cksub != 0) {
                            $showm = '<li><a href="' . $showmenus->menu_link . '" ';
                            if (@addslashes($_GET['p']) == $showmenus->menu_link) {
                                $showm .= 'class="active"';
                            }
                            $showm .= '>' . $showmenus->menu_icon . ' ' . menuLanguage($showmenus->menu_name) . ' <span class="fa arrow"></span></a><ul class="nav nav-second-level">';
                            $getsubmenus = $getDB->my_sql_select(NULL, "menus", "menu_status='1' AND menu_key <> menu_upkey AND '" . $showmenus->menu_key . "' = menu_upkey ORDER BY menu_sorting");
                            while ($showsubmenus = mysql_fetch_object($getsubmenus)) {
                                $getactive = $getDB->my_sql_query("menu", "list", "cases='" . addslashes($_GET['p']) . "'");
                                $showm .= '<li><a href="' . $showsubmenus->menu_link . '" ';
                                if (@addslashes($_GET['p']) == $showsubmenus->menu_case || $getactive->menu == $showsubmenus->menu_case) {
                                    $showm .= 'class="active"';
                                }
                                $showm .= '>' . $showsubmenus->menu_icon . ' ' . menuLanguage($showsubmenus->menu_name) . ' </a></li>';
                            }
                            $showm .= '</ul></li>';
                            echo @$showm;
                        } else {
                            $showm = '<li><a href="' . $showmenus->menu_link . '" ';
                            $getactive = $getDB->my_sql_query("menu", "list", "cases='" . addslashes($_GET['p']) . "'");
                            if (@addslashes($_GET['p']) == $showmenus->menu_case || $getactive->menu == $showmenus->menu_case) {
                                $showm .= 'class="active"';
                            }
                            $showm .= '>' . $showmenus->menu_icon . ' ' . menuLanguage($showmenus->menu_name) . ' </a></li>';
                            echo @$showm;
                        }
                    }
                    ?>

                </ul>
                <div style="color:#CCC; text-align:center; padding-top:10px;">&copy;&nbsp;<?php echo @date("Y"); ?>
                    &nbsp;Durable ครุภัณฑ์
                </div>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->

        <div class="center-block" style="font-size:24px; color:#000000; text-align:center; padding-top:10px;">
            โปรแกรมครุภัณฑ์และตรวจครุภัณฑ์บนระบบปฏิบัติการแอนดรอยด์
        </div>
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="margin_top">
            <?php
            $page = addslashes(@$_GET['p']);
            $listdata = $getDB->my_sql_query(NULL, "list", "cases='" . $page . "' AND case_status='1'");
            if ($listdata != NULL) {
                require($listdata->pages);
            } else {
                require("main/main.php");
            }

            ?>
        </div>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->


</body>

</html>
<script>
    $(window).load(function () {
        checkCardCount();

    });
    // tooltip demo
    $('.tooltipx').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })


    // popover demo
    $("[data-toggle=popover]")
        .popover()
</script>
<script>
    function startTime() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth();
        var yy = today.getFullYear();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
// add a zero in front of numbers<10
        dd = checkTime(dd);
        m = checkTime(m);
        s = checkTime(s);

        document.getElementById('showtime').value = h + ":" + m + ":" + s;
        t = setTimeout(function () {
            startTime()
        }, 500);
    }

    function startDateTime() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth();
        var yy = today.getFullYear();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
// add a zero in front of numbers<10
        dd = checkTime(dd);
        m = checkTime(m);
        s = checkTime(s);

        document.getElementById('showtimex').value = dd + "/" + (mm + 1) + "/" + (yy + 543) + " " + h + ":" + m + ":" + s;
        t = setTimeout(function () {
            startDateTime()
        }, 500);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
</script>
<script language="javascript">
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var checkin = $('#dpd1').datepicker({
        format: "yyyy-mm-dd",
        onRender: function (date) {
            return date.valueOf() < now.valueOf() ? '' : '';
        }
    }).on('changeDate', function (ev) {
        if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
        }
        checkin.hide();
        $('#dpd2')[0].focus();
    }).data('datepicker');
    var checkout = $('#dpd2').datepicker({
        format: "yyyy-mm-dd",
        onRender: function (date) {
            return date.valueOf() < checkin.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function (ev) {
        checkout.hide();
    }).data('datepicker');
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.combobox').combobox();
        $('.dpk').datepicker({
            format: "yyyy-mm-dd"
        });
    });

</script>
<script>
    $(function () {
        $('.cp1').colorpicker();
    });

    function checkCardCount() {
        $.ajax({
            async: false,
            url: 'function.php?type=show_card_count',
            success: function (data) {
                $('#card_count').html(data);
            }
        });
    }
</script>
