<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-home fa-fw"></i> <?php echo @LA_MN_HOME;?></h1>
     </div>        
</div>
<ol class="breadcrumb">
  <li class="active"><?php echo @LA_MN_HOME;?></li>
</ol>
<?php
if(isset($_POST['save_card'])){
	if(htmlentities($_POST['card_customer_name'])!= NULL && htmlentities($_POST['card_customer_phone']) != NULL ){
		$card_key=md5(htmlentities($_POST['card_customer_name']).htmlentities($_POST['card_code']).time("now"));
		$getdata->my_sql_insert("card_info","card_key='".$card_key."',card_code='".htmlentities($_POST['card_code'])."',card_customer_name='".htmlentities($_POST['card_customer_name'])."',card_customer_lastname='".htmlentities($_POST['card_customer_lastname'])."',card_customer_address='".htmlentities($_POST['card_customer_address'])."',card_customer_phone='".htmlentities($_POST['card_customer_phone'])."',card_customer_email='".htmlentities($_POST['card_customer_email'])."',card_note='".htmlentities($_POST['card_note'])."',card_done_aprox='0000-00-00',user_key='".$user_data->user_key."',card_status=''");
		echo '<script>window.location="?p=card_create_detail&key='.$card_key.'";</script>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
	}
}
?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มใบส่งซ่อม/เคลม</h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="form-group">
                                            <label for="card_code">รหัสการส่งซ่อม/เคลม</label>
                                            <input type="text" name="card_code" id="card_code" value="<?php echo @RandomString(4,'C',7);?>" class="form-control" readonly>
                                          </div>
                                          <div class="form-group row">
                                           	<div class="col-md-6">
                                           	  <label for="card_customer_name">ชื่อผู้ส่งซ่อม</label>
                                              <input type="text" name="card_customer_name" id="card_customer_name" class="form-control" autofocus  autocomplete="off">
                                           	</div>
                                            <div class="col-md-6">
                                              <label for="card_customer_lastname">นามสกุล</label>
                                              <input type="text" name="card_customer_lastname" id="card_customer_lastname" class="form-control"  autocomplete="off">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="card_customer_address">ที่อยู่</label>
                                            <textarea name="card_customer_address" id="card_customer_address" class="form-control"></textarea>
                                          </div>
                                          <div class="form-group row">
                                          <div class="col-md-6">
                                            <label for="card_customer_phone">หมายเลขโทรศัพท์</label>
                                            <input type="text" name="card_customer_phone" id="card_customer_phone" class="form-control"  autocomplete="off">
                                            </div>
                                            <div class="col-md-6"> <label for="card_customer_email">อีเมล</label>
                                            <input type="text" name="card_customer_email" id="card_customer_email" class="form-control"  autocomplete="off"></div>
                                          </div>
                                          <div class="form-group">
                                            <label for="card_note">หมายเหตุ</label>
                                            <textarea name="card_note" id="card_note" class="form-control"></textarea>
                                          </div>
                                      </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_card" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                </form>
                                <!-- /.modal-dialog -->
</div>
   <?php
   echo @$alert;?>
                 
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><i class="fa fa-edit"></i></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
      <ul class="nav navbar-nav">
   <li><a data-toggle="modal" data-target="#myModal" style="cursor:pointer;"><i class="fa fa-plus"></i> เพิ่มใบส่งซ่อม/เคลม</a></li>
       </ul>
      
  <form class="navbar-form from-group navbar-right" role="search" method="get" action="?p=search">
 
    <input type="text" class="form-control" name="q" placeholder="ระบุชื่อ/หมายเลขโทรศัพท์หรือรหัสส่งซ่อม/เคลม เพื่อค้นหา" size="50" autofocus  autocomplete="off">
    <input type="hidden" name="p" id="p" value="search" >
 
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
                                    <i class="fa fa-edit fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php @$getall = $getdata->my_sql_show_rows("card_info","card_status <> 'hidden'"); echo @number_format($getall);?></div>
                                    <div>ใบสั่งซ่อม/เคลมทั้งหมด</div>
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
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php @$gettoday = $getdata->my_sql_show_rows("card_info","card_status <> 'hidden' AND (card_insert LIKE '%".date("Y-m-d")."%')"); echo @number_format($gettoday);?></div>
                                    <div>ใบสั่งซ่อม/เคลม วันนี้</div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            รายการสั่งซ่อม/เคลม 10 อันดับล่าสุด
                        </div>
                       
                        
                     <div class="table-responsive">
  	<table width="100%" border="0" class="table table-bordered">
    <thead>
  <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
    <td width="18%">รหัส</td>
    <td width="27%">วันที่</td>
     <td width="35%">ชื่อผู้ส่งซ่อม/เคลม</td>
    <td width="20%">สถานะ</td>
    </tr>
  </thead>
  <tbody>
  <?php
  if(htmlentities($_GET['type']) != NULL){
	   $getcard = $getdata->my_sql_select(NULL,"card_info","card_status = '".htmlentities($_GET['type'])."' ORDER BY card_insert");
  }else{
	   $getcard = $getdata->my_sql_select(NULL,"card_info","card_status <> 'hidden'  AND  card_status <> '' ORDER BY card_insert DESC LIMIT 10");
  }
 
  while($showcard = mysql_fetch_object($getcard)){
  ?>
  <tr style="font-weight:bold;" id="<?php echo @$showcard->card_key;?>">
    <td align="center"><a href="?q=<?php echo @$showcard->card_code;?>&p=search"><?php echo @$showcard->card_code;?></a></td>
     
    <td align="center"><?php echo @dateTimeConvertor($showcard->card_insert);?></td>
     <td>&nbsp;<?php echo @$showcard->card_customer_name.'&nbsp;&nbsp;&nbsp;'.$showcard->card_customer_lastname;?></td>
    <td align="center"><?php echo @cardStatus($showcard->card_status);?></td>
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