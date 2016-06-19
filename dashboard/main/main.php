<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-home fa-fw"></i> <?php echo @LA_MN_HOME; ?></h1>
    </div>
</div>
<ol class="breadcrumb">
    <li class="active"><?php echo @LA_MN_HOME; ?></li>
</ol>
<?php
if (isset($_POST['save_card'])) {
    if (htmlentities($_POST['card_customer_name']) != NULL && htmlentities($_POST['card_customer_phone']) != NULL) {
        $card_key = md5(htmlentities($_POST['card_customer_name']) . htmlentities($_POST['card_code']) . time("now"));
        $getDB->my_sql_insert("card_info", "card_key='" . $card_key . "',card_code='" . htmlentities($_POST['card_code']) . "',card_customer_name='" . htmlentities($_POST['card_customer_name']) . "',card_customer_lastname='" . htmlentities($_POST['card_customer_lastname']) . "',card_customer_address='" . htmlentities($_POST['card_customer_address']) . "',card_customer_phone='" . htmlentities($_POST['card_customer_phone']) . "',card_customer_email='" . htmlentities($_POST['card_customer_email']) . "',card_note='" . htmlentities($_POST['card_note']) . "',card_done_aprox='0000-00-00',user_key='" . $user_data->user_key . "',card_status=''");
        echo '<script>window.location="?p=card_create_detail&key=' . $card_key . '";</script>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
    }
}
?>

<?php
echo @$alert; ?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form from-group navbar-right" role="search" method="get" action="?p=search">

                <input type="text" class="form-control" name="q"
                       placeholder="ระบุชื่อครุภัณฑ์/รหัสครุภัณฑ์ เพื่อค้นหา" size="50" autofocus
                       autocomplete="off">
                <input type="hidden" name="p" id="p" value="search">

            </form>
        </div>

    </div>
</nav>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div
                            class="huge"><?php @$gettoday = $getDB->my_sql_show_rows("card_info", "card_status <> 'hidden' AND (card_insert LIKE '%" . date("Y-m-d") . "%')");
                            echo @number_format($gettoday); ?></div>
                        <div>จำนวนสมาชิก</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-edit fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div
                            class="huge"><?php @$getall = $getDB->my_sql_show_rows("asset", NULL);
                            echo @number_format($getall); ?></div>
                        <div>รายการครุภัณฑ์ทั้งหมด</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                รายการครุภัณฑ์ 10 อันดับล่าสุดที่มีการเคลื่อนไหว
            </div>


            <div class="table-responsive">
                <table width="100%" border="0" class="table table-bordered">
                    <thead>
                    <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
                        <td width="25%">วันที่</td>
                        <td width="18%">รหัส</td>
                        <td width="37%">ชื่อครุภัณฑ์</td>
                        <td width="20%">สถานะ</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $getcard = $getDB->my_sql_select(NULL, "asset", "update_date != '' ORDER BY update_date DESC LIMIT 10");
                    while ($showAsset = mysql_fetch_object($getcard)) {
                        ?>
                        <tr style="font-weight:bold;" id="<?php echo @$showAsset->id; ?>">
                            <td align="center"><?php echo @dateTimeConvertor($showAsset->update_date); ?></td>
                            <td align="center"><a href="?q=<?php echo @$showAsset->code; ?>&p=search"><?php echo @$showAsset->code; ?></a>
                            </td>
                            <td td align="center"><?php echo @$showAsset->name; ?></td>
                            <td align="center"><?php echo @statusIdToString($showAsset->status_id); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>

</div>