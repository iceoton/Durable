
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa flaticon-tag20 fa-fw"></i> สถานะการซ่อม/เคลม</h1>
     </div>        
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
  <li class="active">สถานะการซ่อม/เคลม</li>
</ol>

<?php
if(isset($_POST['save_card'])){
	if(addslashes($_POST['cat_title']) != NULL){
		$ctype_key = md5(addslashes($_POST['cat_title']).time("now"));
		$getdata->my_sql_insert("card_type","ctype_key='".$ctype_key."',ctype_name='".addslashes($_POST['cat_title'])."',ctype_color='".addslashes($_POST['ctype_color'])."',ctype_status='".addslashes($_REQUEST['ctype_status'])."'");
		$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_NEW_TYPE_OF_ROOM_IS_DONE.'</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
}
if(isset($_POST['save_edit_card'])){
		 if(addslashes($_POST['edit_ctype_title'])!= NULL){
			 $getdata->my_sql_update("card_type","ctype_name='".addslashes($_POST['edit_ctype_title'])."',ctype_color='".addslashes($_POST['edit_ctype_color'])."'","ctype_key='".addslashes($_POST['ctype_key'])."'");
			$alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_UPDATE_DATA_DONE.'</div>';
		 }else{
			 $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
		 }
	 }
?>
<!-- Modal Edit -->
<div class="modal fade" id="edit_card_type" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form id="form2" name="form2" method="post">
     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel"><?php echo @LA_LB_ROOM_TYPE_DATA;?></h4>
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
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลสถานะการซ่อม/เคลม</h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="form-group">
                                            <label for="cat_title">ชื่อสถานะการซ่อม/เคลม</label>
                                            <input type="text" name="cat_title" id="cat_title" class="form-control" autofocus>
                                          </div>
                                          
                                          <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="ctype_color">แทบสี</label>
                                              <input type="text" name="ctype_color" id="ctype_color" class="form-control cp1">
                                            </div>
                                             <div class="col-md-6"><label for="ctype_status"><?php echo @LA_LB_STATUS;?></label>
                                              <select name="ctype_status" id="ctype_status" class="form-control">
                                                <option value="1" selected="selected"><?php echo @LA_BTN_SHOW;?></option>
                                                <option value="0"><?php echo @LA_BTN_HIDE;?></option>
                                              
                                              </select></div>
                                            
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
                            <!-- /.modal -->
  <?php
  echo @$alert;
  ?>
 
 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i> เพิ่มสถานะการซ่อม/เคลม</button><br/><br/>
 <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">สถานะการซ่อม/เคลม ทั้งหมด</div>
   <div class="table-responsive">
  <!-- Table -->
  <table width="100%" class="table table-striped table-bordered table-hover">
  <thead>
  <tr style="color:#FFF;">
    <th width="3%" bgcolor="#5fb760">#</th>
    <th width="74%" bgcolor="#5fb760">ชื่อสถานะการซ่อม/เคลม </th>
    <th width="23%" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $x=0;
  $getcat = $getdata->my_sql_select(NULL,"card_type","ctype_status <> '2' AND ctype_name <> '' ORDER BY ctype_insert");
  while($showcat = mysql_fetch_object($getcat)){
	  $x++;
  ?>
  <tr id="<?php echo @$showcat->ctype_key;?>">
    <td align="center"><?php echo @$x;?></td>
    <td>&nbsp;<i class="fa fa-circle" style="color:<?php echo @$showcat->ctype_color;?>"></i>&nbsp;<?php echo @$showcat->ctype_name;?></td>
    <td align="center" valign="middle">
      <?php
	  if($showcat->ctype_status == '1'){
		  echo '<button type="button" class="btn btn-success btn-xs" id="btn-'.@$showcat->ctype_key.'" onClick="javascript:changecatStatus(\''.@$showcat->ctype_key.'\',\''.$_SESSION['lang'].'\');"><i class="fa fa-unlock-alt" id="icon-'.@$showcat->ctype_key.'"></i> <span id="text-'.@$showcat->ctype_key.'">'.@LA_BTN_SHOW.'</span></button>';
	  }else{
		  echo '<button type="button" class="btn btn-danger btn-xs" id="btn-'.@$showcat->ctype_key.'" onClick="javascript:changecatStatus(\''.@$showcat->ctype_key.'\',\''.$_SESSION['lang'].'\');"><i class="fa fa-lock" id="icon-'.@$showcat->ctype_key.'"></i> <span id="text-'.@$showcat->ctype_key.'">'.@LA_BTN_HIDE.'</span></button>';
	  }
	  ?><a data-toggle="modal" data-target="#edit_card_type" data-whatever="<?php echo @$showcat->ctype_key;?>" class="btn btn-xs btn-info" style="color:#FFF;"><i class="fa fa-edit fa-fw"></i> <?php echo @LA_BTN_EDIT;?></a><button type="button" class="btn btn-danger btn-xs" onClick="javascript:deletecat('<?php echo @$showcat->ctype_key;?>');"><i class="glyphicon glyphicon-remove"></i> <?php echo @LA_BTN_DELETE;?></button></td>
  </tr>
  <?php
  }
  ?>
  </tbody>
</table>
</div>
</div>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<script language="javascript">
function changecatStatus(catkey,lang){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var es = document.getElementById('btn-'+catkey);
	if(es.className == 'btn btn-success btn-xs'){
		var sts= 1;
	}else{
		var sts= 0;
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			
			if(es.className == 'btn btn-success btn-xs'){
				document.getElementById('btn-'+catkey).className = 'btn btn-danger btn-xs';
				document.getElementById('icon-'+catkey).className = 'fa fa-lock';
				if(lang == 'en'){
					document.getElementById('text-'+catkey).innerHTML = 'Hide';
				}else{
					document.getElementById('text-'+catkey).innerHTML = 'ซ่อน';
				}
				
			}else{
				document.getElementById('btn-'+catkey).className = 'btn btn-success btn-xs';
				document.getElementById('icon-'+catkey).className = 'fa fa-unlock-alt';
				if(lang == 'en'){
					document.getElementById('text-'+catkey).innerHTML = 'Show';
				}else{
					document.getElementById('text-'+catkey).innerHTML = 'แสดง';
				}
				
			}
  		}
	}
	
	xmlhttp.open("GET","function.php?type=change_cardtype_status&key="+catkey+"&sts="+sts,true);
	xmlhttp.send();
}
	function deletecat(catkey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(catkey).innerHTML = '';
  		}
	}
	xmlhttp.open("GET","function.php?type=delete_cardtype&key="+catkey,true);
	xmlhttp.send();
}
</script>
<script>
    $('#edit_card_type').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "settings/edit_card_type.php",
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