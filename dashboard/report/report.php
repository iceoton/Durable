<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-bar-chart fa-fw"></i> <?php echo "รายงานครุภัณฑ์"; ?></h1>
    </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME; ?></a></li>
    <li class="active"><?php echo "รายงานครุภัณฑ์"; ?></li>
</ol>
<div class="button_center">
    <div class="panel panel-primary">
        <div class="panel-heading">รายงานการตรวจนับครุภัณฑ์</div>
        <div class="panel-body">
            <a href="?p=report_counting" class="btn btn-primary btn_main_wd"><i
                        class="fa fa-share-alt fa-fw fa-6x"></i><br/><br/>แยกตามชนิดครุภัณฑ์</a>

        </div>

    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">รายงานการ เบิก/ยืม/คืน/ส่งซ่อม ครุภัณฑ์</div>
        <div class="panel-body">
            <a href="?p=report_pickup" class="btn btn-primary btn_main_wd"><i
                    class="fa fa-minus-circle fa-fw fa-6x"></i><br/><br/>การเบิกครุภัณฑ์</a>
            <a href="?p=report_borrow" class="btn btn-primary btn_main_wd"><i
                    class="fa fa-retweet fa-fw fa-6x"></i><br/><br/>การยืมครุภัณฑ์</a>
            <a href="?p=report_return" class="btn btn-primary btn_main_wd"><i
                    class="fa fa-plus-circle fa-fw fa-6x"></i><br/><br/>การคืนครุภัณฑ์</a>
            <a href="?p=report_repair" class="btn btn-primary btn_main_wd"><i
                    class="fa fa-wrench fa-fw fa-6x"></i><br/><br/>การส่งซ่อมครุภัณฑ์</a>

        </div>

    </div>

</div>
