
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa flaticon-bullet1 fa-fw"></i> <?php echo @LA_LB_EXPENDITURES;?></h1>
     </div>        
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
  <li class="active"><?php echo @LA_LB_EXPENDITURES;?></li>
</ol>
<?php
if(isset($_POST['save_categories'])){
	if(addslashes($_POST['cat_name']) != NULL){
		$cat_key = md5(addslashes($_POST['cat_name']).time("now"));
		$getdata->my_sql_insert("categories","cat_key='".$cat_key."',cat_name='".addslashes($_POST['cat_name'])."',cat_status='".addslashes($_POST['cat_status'])."'");
		$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_EXPENDITURES_GROUP.'</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
}
if(isset($_POST['save_product'])){
	if(addslashes($_POST['pro_name']) != NULL && addslashes($_POST['pro_price']) != NULL){
	if (!defined('UPLOADDIR')) define('UPLOADDIR','../resource/products/images/');
				if (is_uploaded_file($_FILES["pro_cover"]["tmp_name"])) {	
				$File_name = $_FILES["pro_cover"]["name"];
				$File_tmpname = $_FILES["pro_cover"]["tmp_name"];
				
				$File_ext = pathinfo($File_name, PATHINFO_EXTENSION);
				$newfilename = md5(time("now")).'.'.$File_ext;
				if (move_uploaded_file($File_tmpname, (UPLOADDIR.$newfilename)));
	}
	$pro_key = md5(addslashes($_POST['pro_code']).time("now"));
	
	if($File_name != NULL){
		resizeProductThumb($File_ext,$newfilename);
		$getdata->my_sql_insert("products","pro_key='".$pro_key."',cat_key='".addslashes($_REQUEST['cat_key'])."',pro_std_code='".addslashes($_POST['pro_std_code'])."',pro_name='".addslashes($_POST['pro_name'])."',pro_detail='".addslashes($_POST['pro_detail'])."',pro_cover='".$newfilename."',pro_price='".addslashes($_POST['pro_price'])."',pro_status='".addslashes($_REQUEST['pro_status'])."'");
	}else{
		$getdata->my_sql_insert("products","pro_key='".$pro_key."',cat_key='".addslashes($_REQUEST['cat_key'])."',pro_std_code='".addslashes($_POST['pro_std_code'])."',pro_name='".addslashes($_POST['pro_name'])."',pro_detail='".addslashes($_POST['pro_detail'])."',pro_price='".addslashes($_POST['pro_price'])."',pro_status='".addslashes($_REQUEST['pro_status'])."'");
	}
	//updateLynda();
	$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_EXPENDITURES.'</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
}

if(isset($_POST['save_edit_item'])){
	if(addslashes($_POST['edit_pro_name']) != NULL && addslashes($_POST['edit_pro_price']) != NULL){
	if (!defined('UPLOADDIRE')) define('UPLOADDIRE','../resource/products/images/');
				if (is_uploaded_file($_FILES["edit_pro_cover"]["tmp_name"])) {	
				$File_name_e = $_FILES["edit_pro_cover"]["name"];
				$File_tmpname_e = $_FILES["edit_pro_cover"]["tmp_name"];
				
				$File_ext_e = pathinfo($File_name_e, PATHINFO_EXTENSION);
				$newfilename_e = md5(time("now")).'.'.$File_ext_e;
				if (move_uploaded_file($File_tmpname_e, (UPLOADDIRE.$newfilename_e)));
	}
	$pro_key = md5(addslashes($_POST['edit_pro_code']).time("now"));
	
	if($File_name_e != NULL){
		resizeProductThumb($File_ext_e,$newfilename_e);
		$getdata->my_sql_update("products","cat_key='".addslashes($_REQUEST['edit_cat_key'])."',pro_std_code='".addslashes($_POST['edit_pro_std_code'])."',pro_name='".addslashes($_POST['edit_pro_name'])."',pro_detail='".addslashes($_POST['edit_pro_detail'])."',pro_cover='".$newfilename_e."',pro_price='".addslashes($_POST['edit_pro_price'])."'","pro_key='".addslashes($_POST['pro_key'])."'");
	}else{
		$getdata->my_sql_update("products","cat_key='".addslashes($_REQUEST['edit_cat_key'])."',pro_std_code='".addslashes($_POST['edit_pro_std_code'])."',pro_name='".addslashes($_POST['edit_pro_name'])."',pro_detail='".addslashes($_POST['edit_pro_detail'])."',pro_price='".addslashes($_POST['edit_pro_price'])."'","pro_key='".addslashes($_POST['pro_key'])."'");
	}
	updateLynda();
	$alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_UPDATE_DATA_DONE.'</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
}
?>
<!-- Modal Edit -->
<div class="modal fade" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" name="form2" id="form2">
     
     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel"><?php echo @LA_LB_EDIT_EXPENDITURES;?></h4>
                </div>
                <div class="ct">
              
                </div>
            </div>
        </div>
  </form>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><?php echo @LA_LB_ADD_NEW_CATEGORIES;?></h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="form-group">
                                            <label for="cat_name"><?php echo @LA_LB_CAT_NAME;?></label>
                                            <input type="text" name="cat_name" id="cat_name" class="form-control" autofocus>
                                          </div>
                                           
                                            <div class="form-group">
                                              <label for="cat_status"><?php echo @LA_LB_STATUS;?></label>
                                              <select name="cat_status" id="cat_status" class="form-control">
                                                <option value="1" selected="selected"><?php echo @LA_BTN_SHOW;?></option>
                                                <option value="0"><?php echo @LA_BTN_HIDE;?></option>
                                              
                                              </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_categories" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                </form>
                                <!-- /.modal-dialog -->
</div>
                            <!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="model_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><?php echo @LA_LB_ADD_NEW_EXPENDITURES;?></h4>
                                        </div>
                                        <div class="modal-body">
                                        
                                          
                                         <div class="form-group">
                                           <label for="cat_key"><?php echo @LA_LB_CAT_NAME;?></label>
                                           <select name="cat_key" id="cat_key" class="form-control">
                                            <?php $getcat = $getdata->my_sql_select(NULL,"categories","cat_status='1' ORDER BY cat_insert");
											while($showcat = mysql_fetch_object($getcat)){
												echo '<option value="'.$showcat->cat_key.'">'.$showcat->cat_name.'</option>';
											}
											?>
                                           </select>
                                         </div>
                                         <div class="form-group">
                                           <label for="pro_std_code"><?php echo @LA_LB_EXPENDITURES_CODE;?></label>
                                           <input type="text" name="pro_std_code" id="pro_std_code" class="form-control">
                                         </div>
                                         <div class="form-group">
                                           <label for="pro_name"><?php echo @LA_LB_EXPENDITURES_NAME;?></label>
                                           <input type="text" name="pro_name" id="pro_name" class="form-control">
                                         </div>
                                          <div class="form-group">
                                            <label for="pro_detail"><?php echo @LA_LB_DETAIL;?></label>
                                            <textarea name="pro_detail" id="pro_detail" class="form-control"></textarea>
                                          </div>
                                          <div class="form-group">
                                            <label for="pro_cover"><?php echo @LA_LB_PHOTO;?></label>
                                            <input type="file" name="pro_cover" id="pro_cover" class="form-control">
                                          </div>
                                         
                                          <div class="form-group">
                                            <label for="pro_price"><?php echo @LA_LB_PRICE;?></label>
                                            <input type="text" name="pro_price" id="pro_price" class="form-control">
                                          </div>
                                      
                                        
                                         <div class="form-group">
                                              <label for="pro_status"><?php echo @LA_LB_STATUS;?></label>
                                           <select name="pro_status" id="pro_status" class="form-control">
                                                <option value="1" selected="selected"><?php echo @LA_BTN_SHOW;?></option>
                                                <option value="0"><?php echo @LA_BTN_HIDE;?></option>
                                              
                                              </select>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> <?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_product" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> <?php echo @LA_BTN_SAVE;?></button>
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
 
 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i><?php echo @LA_LB_ADD_NEW_CATEGORIES;?></button><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#model_product"><i class="fa flaticon-bullet1 fa-fw"></i><?php echo @LA_LB_ADD_NEW_EXPENDITURES;?></button>
 <br/><br/>

 <nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><i class="fa fa-folder-o"></i></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo @LA_LB_EXPENDITURES_GROUP;?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
          <?php
		  if(addslashes($_GET['type']) != NULL){
			  $gettype_detail = $getdata->my_sql_query(NULL,"categories","cat_key='".addslashes($_GET['type'])."'");
			  $text_cat = $gettype_detail->cat_name;
		  }else{
			 $text_cat = LA_LB_ALL;
		  }
		  $gettype = $getdata->my_sql_select(NULL,"categories","cat_status='1' ORDER BY cat_insert");
		  		echo '<li><a href="?p=setting_products">'.LA_LB_ALL.'</a></li>';
            while($showtype = mysql_fetch_object($gettype)){
				echo '<li><a href="?p=setting_products&type='.$showtype->cat_key.'">'.$showtype->cat_name.'</a></li>';
            }
			?>
          </ul>
        </li>
        <li><a><?php echo @$text_cat;?></a></li>
      </ul>
     <!-- <form class="navbar-form navbar-right" method="get" role="search" action="">
        <div class="input-group">
         <span class="input-group-addon" id="sizing-addon2">ค้นหา</span>
         <input type="hidden" name="p" id="p" value="product_search">
<input type="text" class="form-control" name="search" placeholder="พิมพ์ชื่อรายการค่าใช้จ่ายหรือ รหัสที่นี่">
    </div>
      </form>-->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 <div class="panel panel-default">
   <div class="table-responsive tooltipx">
  <!-- Table -->
  <table width="100%" class="table table-bordered ">
  <thead>
  <tr style="color:#FFF;">
    <th width="4%" bgcolor="#5fb760">#</th>
    <th width="7%" bgcolor="#5fb760"><?php echo @LA_LB_PHOTO;?></th>
    <th width="43%" bgcolor="#5fb760"><?php echo @LA_LB_EXPENDITURES_NAME;?></th>
    <th width="13%" bgcolor="#5fb760"><?php echo @LA_LB_PRICE;?></th>
    <th width="19%" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $x=0;
   if(@addslashes($_GET['type']) != NULL){
	   $getproduct = $getdata->my_sql_select(NULL,"products","cat_key='".addslashes($_GET['type'])."' ORDER BY pro_std_code");
   }else{
	   $getproduct = $getdata->my_sql_select(NULL,"products","pro_status <> '2' ORDER BY pro_std_code");
	}
  while($showproduct = mysql_fetch_object($getproduct)){
	  $x++;
	  if($showproduct->pro_instore <= $showproduct->pro_alert){
		  $proalert = 'style="font-weight:bold; color:#FFF; background:#FF5E6B;"';
	  }else{
		  $proalert = 'style="font-weight:bold; color:#FFF; background:#6EC038;"';
	  }
	  if($showproduct->pro_vat_type == 1){
		  $tax = 'style="color:#6EC038"';
	  }else if($showproduct->pro_vat_type == 2){
		  $tax = 'style="color:#FF66FF"';
	  }else{
		  $tax = 'style="color:#CCCCCC"';
	  }
  ?>
  <tr id="<?php echo @$showproduct->pro_key;?>">
    <td align="center" ><?php echo @$x;?></td>
    <td align="center"><img src="../resource/products/thumbs/<?php echo @$showproduct->pro_cover;?>" height="40" id="img_border" alt=""/></td>
    <td>&nbsp;<span data-toggle="tooltip" data-placement="right" title="<?php echo $showproduct->pro_detail;?>"><?php echo @$showproduct->pro_name;?></span></td>
    <td align="right" valign="middle"><strong><?php echo @convertPoint2($showproduct->pro_price,'2');?></strong>&nbsp;</td>
    <td align="center" valign="middle">
      <?php
	  if($showproduct->pro_status == '1'){
		  echo '<button type="button" class="btn btn-success btn-xs" id="btn-'.@$showproduct->pro_key.'" onClick="javascript:changeproductsStatus(\''.@$showproduct->pro_key.'\',\''.$_SESSION['lang'].'\');"><i class="fa fa-unlock-alt" id="icon-'.@$showproduct->pro_key.'"></i> <span id="text-'.@$showproduct->pro_key.'">'.LA_BTN_SHOW.'</span></button>';
	  }else{
		  echo '<button type="button" class="btn btn-danger btn-xs" id="btn-'.@$showproduct->pro_key.'" onClick="javascript:changeproductsStatus(\''.@$showproduct->pro_key.'\',\''.$_SESSION['lang'].'\');"><i class="fa fa-lock" id="icon-'.@$showproduct->pro_key.'"></i> <span id="text-'.@$showproduct->pro_key.'">'.LA_BTN_HIDE.'</span></button>';
	  }
	  ?><a data-toggle="modal" data-target="#edit_item" data-whatever="<?php echo @$showproduct->pro_key;?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> <?php echo @LA_BTN_EDIT;?></a><a onClick="javascript:deleteProduct('<?php echo @$showproduct->pro_key;?>');" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> <?php echo @LA_BTN_DELETE;?></a></td>
  </tr>
  <?php
  }
  ?>
  </tbody>
</table>
</div>
</div>
<script language="javascript">

function changeproductsStatus(prokey,lang){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var es = document.getElementById('btn-'+prokey);
	if(es.className == 'btn btn-success btn-xs'){
		var sts= 1;
	}else{
		var sts= 0;
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			
			if(es.className == 'btn btn-success btn-xs'){
				document.getElementById('btn-'+prokey).className = 'btn btn-danger btn-xs';
				document.getElementById('icon-'+prokey).className = 'fa fa-lock';
				if(lang == 'en'){
					document.getElementById('text-'+prokey).innerHTML = 'Hide';
				}else{
					document.getElementById('text-'+prokey).innerHTML = 'ซ่อน';
				}
				
			}else{
				document.getElementById('btn-'+prokey).className = 'btn btn-success btn-xs';
				document.getElementById('icon-'+prokey).className = 'fa fa-unlock-alt';
				if(lang == 'en'){
					document.getElementById('text-'+prokey).innerHTML = 'Show';
				}else{
					document.getElementById('text-'+prokey).innerHTML = 'แสดง';
				}
				
			}
  		}
	}
	
	xmlhttp.open("GET","function.php?type=change_products_status&key="+prokey+"&sts="+sts,true);
	xmlhttp.send();
}
	function deleteProduct(prokey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById(prokey).innerHTML = '';
			
  		}
	}
	xmlhttp.open("GET","function.php?type=delete_products&key="+prokey,true);
	xmlhttp.send();
}

    $('#edit_item').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "settings/edit_item.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.ct').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });  
    })
    </script>