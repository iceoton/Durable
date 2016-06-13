 <link href="../css/plugins/dataTables.bootstrap.css" rel="stylesheet">
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-users fa-fw"></i> <?php echo @LA_LB_MEMBER;?></h1>
     </div>        
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active"><?php echo @LA_LB_MEMBER;?></li>
</ol>
<?php
if(isset($_POST['save_member'])){
	if(addslashes($_POST['member_name']) != NULL && addslashes($_POST['member_lastname']) != NULL){
		if (!defined('UPLOADDIR')) define('UPLOADDIR','../resource/members/images/');
				if (is_uploaded_file($_FILES["member_photo"]["tmp_name"])) {	
				$File_name = $_FILES["member_photo"]["name"];
				$File_tmpname = $_FILES["member_photo"]["tmp_name"];
				$File_ext = pathinfo($File_name, PATHINFO_EXTENSION);
				$newfilename = md5(time("now")).'.'.$File_ext;
				if (move_uploaded_file($File_tmpname, (UPLOADDIR.$newfilename)));
	}
	$member_key = md5(addslashes($_POST['member_name']).time("now"));
	$member_born = addslashes($_REQUEST['year']).'-'.addslashes($_REQUEST['month']).'-'.addslashes($_REQUEST['day']);
	if($File_name != NULL){
		resizeMemberThumb($File_ext,$newfilename);
		$getdata->my_sql_insert("member","member_key='".$member_key."',member_ref='".addslashes($_REQUEST['member_ref'])."',member_code='".addslashes($_POST['member_code'])."',member_name='".addslashes($_POST['member_name'])."',member_lastname='".addslashes($_POST['member_lastname'])."',member_password='".addslashes($_POST['member_password'])."',member_passport='".addslashes($_POST['member_passport'])."',member_pid='".addslashes($_POST['member_pid'])."',member_tax_id='".addslashes($_POST['member_tax_id'])."',member_born='".$member_born."',member_nationality='".addslashes($_POST['member_nationality'])."',member_religion='".addslashes($_POST['member_religion'])."',member_photo='".$newfilename."',member_address='".addslashes($_POST['member_address'])."',member_address_now='".addslashes($_POST['member_address_now'])."',member_tel='".addslashes($_POST['member_phone'])."',member_email='".addslashes($_POST['member_email'])."',member_relative_name='".addslashes($_POST['member_relative_name'])."',member_relative='".addslashes($_POST['member_relative'])."',member_bank_name='".addslashes($_POST['member_bank_name'])."',member_bank_acc='".addslashes($_POST['member_bank_acc'])."',member_bank_acc_name='".addslashes($_POST['member_bank_acc_name'])."',member_bank_type='".addslashes($_POST['member_bank_type'])."',member_bank_branch='".addslashes($_POST['member_bank_branch'])."',member_status='".addslashes($_REQUEST['member_status'])."',member_group='".addslashes($_REQUEST['member_group'])."'");
		$getdata->my_sql_insert("user","user_key='".$member_key."',name='".addslashes($_POST['member_name'])."',lastname='".addslashes($_POST['member_lastname'])."',username='".addslashes($_POST['member_code'])."',password='".md5(addslashes($_POST['member_password']))."',user_photo='".$newfilename."',user_class='1',user_language='th',email='".addslashes($_POST['member_email'])."',user_status='".addslashes($_REQUEST['member_status'])."'");
	}else{
		$getdata->my_sql_insert("member","member_key='".$member_key."',member_ref='".addslashes($_REQUEST['member_ref'])."',member_code='".addslashes($_POST['member_code'])."',member_name='".addslashes($_POST['member_name'])."',member_lastname='".addslashes($_POST['member_lastname'])."',member_password='".addslashes($_POST['member_password'])."',member_passport='".addslashes($_POST['member_passport'])."',member_pid='".addslashes($_POST['member_pid'])."',member_tax_id='".addslashes($_POST['member_tax_id'])."',member_born='".$member_born."',member_nationality='".addslashes($_POST['member_nationality'])."',member_religion='".addslashes($_POST['member_religion'])."',member_address='".addslashes($_POST['member_address'])."',member_address_now='".addslashes($_POST['member_address_now'])."',member_tel='".addslashes($_POST['member_phone'])."',member_email='".addslashes($_POST['member_email'])."',member_relative_name='".addslashes($_POST['member_relative_name'])."',member_relative='".addslashes($_POST['member_relative'])."',member_bank_name='".addslashes($_POST['member_bank_name'])."',member_bank_acc='".addslashes($_POST['member_bank_acc'])."',member_bank_acc_name='".addslashes($_POST['member_bank_acc_name'])."',member_bank_type='".addslashes($_POST['member_bank_type'])."',member_bank_branch='".addslashes($_POST['member_bank_branch'])."',member_status='".addslashes($_REQUEST['member_status'])."',member_group='".addslashes($_REQUEST['member_group'])."'");
		$getdata->my_sql_insert("user","user_key='".$member_key."',name='".addslashes($_POST['member_name'])."',lastname='".addslashes($_POST['member_lastname'])."',username='".addslashes($_POST['member_code'])."',password='".md5(addslashes($_POST['member_password']))."',user_class='1',user_language='th',email='".addslashes($_POST['member_email'])."',user_status='".addslashes($_REQUEST['member_status'])."'");
	}
	
		updateMember();
		$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_INSERT_MEMBER_DATA_DONE.'</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
}
if(isset($_POST['save_edit_member'])){
		if(addslashes($_POST['edit_member_name']) != NULL && addslashes($_POST['edit_member_lastname']) != NULL){
		if (!defined('UPLOADDIR2')) define('UPLOADDIR2','../resource/members/images/');
				if (is_uploaded_file($_FILES["edit_member_photo"]["tmp_name"])) {	
				$File_name2 = $_FILES["edit_member_photo"]["name"];
				$File_tmpname2 = $_FILES["edit_member_photo"]["tmp_name"];
				$File_ext2 = pathinfo($File_name2, PATHINFO_EXTENSION);
				$newfilename2 = md5(time("now")).'.'.$File_ext2;
				if (move_uploaded_file($File_tmpname2, (UPLOADDIR2.$newfilename2)));
	}
	if($File_name2 != NULL){
		resizeMemberThumb($File_ext2,$newfilename2);
		$getdata->my_sql_update("member","member_name='".addslashes($_POST['edit_member_name'])."',member_lastname='".addslashes($_POST['edit_member_lastname'])."',member_photo='".$newfilename2."',member_address='".addslashes($_POST['edit_member_address'])."',member_tel='".addslashes($_POST['edit_member_phone'])."',member_email='".addslashes($_POST['edit_member_email'])."'","member_key='".addslashes($_POST['member_keyx'])."'");
	}else{
		$getdata->my_sql_update("member","member_name='".addslashes($_POST['edit_member_name'])."',member_lastname='".addslashes($_POST['edit_member_lastname'])."',member_address='".addslashes($_POST['edit_member_address'])."',member_tel='".addslashes($_POST['edit_member_phone'])."',member_email='".addslashes($_POST['edit_member_email'])."'","member_key='".addslashes($_POST['member_keyx'])."'");
	}
		$alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_EDIT_MEMBER_DATA_DONE.'</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
	}

echo @$alert;
?>
<!-- Modal -->
<div class="modal fade" id="edit_member" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form id="form2" name="form2" method="post" enctype="multipart/form-data">
     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel"><?php echo @LA_LB_EDIT_MEMBER_DATA;?></h4>
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
                                            <h4 class="modal-title" id="myModalLabel"><?php echo @LA_LB_INSERT_MEMBER_DATA;?></h4>
                                        </div>
                                        <div class="modal-body">
                                         
                                            <div class="form-group">
                                            <div class="row">
                                          
                                            <div class="col-md-6"> <label for="member_name"><?php echo @LA_LB_NAME;?></label>
                                              <input type="text" name="member_name" id="member_name" class="form-control"></div>
                                            <div class="col-md-6"><label for="member_lastname"><?php echo @LA_LB_LASTNAME;?></label>
                                               <input type="text" name="member_lastname" id="member_lastname" class="form-control"> </div>
                                            </div>
                                            </div>
                                             <div class="form-group">
                                            <div class="row">
                                          
                                          
                                            <div class="col-md-12"><label for="member_pid"><?php echo @LA_LB_PID;?></label>
                                               <input type="text" name="member_pid" id="member_pid" class="form-control"></div>
                                            </div>
                                            </div>
                                           
                                             <div class="form-group">
                                               <label for="member_photo"><?php echo @LA_LB_PHOTO;?></label>
                                               <input type="file" name="member_photo" id="member_photo"  class="form-control">
                                             </div>
                                             <div class="form-group">
                                               <label for="member_address"><?php echo @LA_LB_ADDRESS;?></label>
                                               <textarea name="member_address" id="member_address" class="form-control"></textarea>
                                            </div>
                                           
                                             <div class="form-group">
                                             <div class="row">
                                          <div class="col-md-6"><label for="member_phone"><?php echo @LA_LB_MEMBER_PHONE_NUMBER;?></label>
                                               <input type="text" name="member_phone" id="member_phone" class="form-control"></div>
                                            <div class="col-md-6"><label for="member_email"><?php echo @LA_LB_EMAIL;?></label>
                                               <input type="text" name="member_email" id="member_email" class="form-control"></div>
                                            </div>
                                               
                                            </div>
                                         </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_member" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                </form>
                                <!-- /.modal-dialog -->
</div>
                            <!-- /.modal -->
<!--<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i><?php // echo @LA_LB_NEW_MEMBER;?></button><br/><br/>-->


   <div class="table-responsive tooltipx">
  <!-- Table -->
  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
  <thead>
  <tr style=" font-weight:bold;">
    <th width="8%" >#</th>
    <th width="11%" ><?php echo @LA_LB_PHOTO;?></th>
    <th width="31%" ><?php echo @LA_LB_NAME;?></th>
    <th width="21%" ><?php echo @LA_LB_PHONE;?></th>
    <th width="29%" ><?php echo @LA_LB_MANAGE;?></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $x=0;
  
	    @$getmember = $getdata->my_sql_select(NULL,"member","member_status <> '2' ORDER BY member_insert DESC");
   
	 while(@$showmember = mysql_fetch_object($getmember)){
	  $x++;
	 
  ?>
  <tr id="<?php echo @$showmember->member_key;?>">
    <td align="center"><?php echo @$x;?></td>
    <td align="center"><div class="box_img_cycle3"><img src="../resource/members/thumbs/<?php echo @$showmember->member_photo;?>" id="img_cycle3" <?php echo getPhotoSize('../resource/members/thumbs/'.@$showmember->member_photo.'');?> alt=""/></div></td>
    <td>&nbsp;<span data-toggle="tooltip" data-placement="right" title="<?php echo $showmember->member_address;?>"><?php echo @$showmember->member_name."&nbsp;&nbsp;&nbsp;".$showmember->member_lastname;?></span></td>
    <td align="center" valign="middle"><?php echo @$showmember->member_tel;?></td>
    <td align="center" valign="middle"><?php
	/*  if($showmember->member_status == '1'){
		  echo '<button type="button" class="btn btn-success btn-xs" id="btn-'.@$showmember->member_key.'" onClick="javascript:changeMemberStatus(\''.@$showmember->member_key.'\');"><i class="fa fa-unlock-alt" id="icon-'.@$showmember->member_key.'"></i> <span id="text-'.@$showmember->member_key.'">'.@LA_BTN_SHOW.'</span></button>';
	  }else{
		  echo '<button type="button" class="btn btn-danger btn-xs" id="btn-'.@$showmember->member_key.'" onClick="javascript:changeMemberStatus(\''.@$showmember->member_key.'\');"><i class="fa fa-lock" id="icon-'.@$showmember->member_key.'"></i> <span id="text-'.@$showmember->member_key.'">'.@LA_BTN_HIDE.'</span></button>';
	  }*/
	  ?><a href="?p=member_history&key=<?php echo @$showmember->member_key;?>" class="btn btn-xs btn-primary"><i class="fa fa-list"></i> <?php echo @LA_LB_HISTORY;?></a><a data-toggle="modal" data-target="#edit_member" data-whatever="<?php echo @$showmember->member_key;?>" class="btn btn-xs btn-info" style="color:#FFF;"><i class="fa fa-edit fa-fw"></i> <?php echo @LA_BTN_EDIT;?></a><button type="button" class="btn btn-danger btn-xs" onClick="javascript:deleteMember('<?php echo @$showmember->member_key;?>');"><i class="glyphicon glyphicon-remove"></i> <?php echo @LA_BTN_DELETE;?></button></td>
  </tr>
  <?php
  }
  ?>
  </tbody>
</table>

</div>

<!--<div style="text-align:right">
<nav>
  <ul class="pagination">
    <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>-->
<script language="javascript">
function changeMemberStatus(memberkey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var es = document.getElementById('btn-'+memberkey);
	if(es.className == 'btn btn-success btn-xs'){
		var sts= 1;
	}else{
		var sts= 0;
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			
			if(es.className == 'btn btn-success btn-xs'){
				document.getElementById('btn-'+memberkey).className = 'btn btn-danger btn-xs';
				document.getElementById('icon-'+memberkey).className = 'fa fa-lock';
				document.getElementById('text-'+memberkey).innerHTML = 'ซ่อน';
			}else{
				document.getElementById('btn-'+memberkey).className = 'btn btn-success btn-xs';
				document.getElementById('icon-'+memberkey).className = 'fa fa-unlock-alt';
				document.getElementById('text-'+memberkey).innerHTML = 'แสดง';
			}
  		}
	}
	
	xmlhttp.open("GET","function.php?type=change_member_status&key="+memberkey+"&sts="+sts,true);
	xmlhttp.send();
}
	function deleteMember(memberkey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById(memberkey).innerHTML = '';
			
  		}
	}
	xmlhttp.open("GET","function.php?type=delete_member&key="+memberkey,true);
	xmlhttp.send();
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
                error: function(err) {
                    console.log(err);
                }
            });  
    })
	function copyAddress(){
		var addr = document.getElementById('member_address').value;
		document.getElementById('member_address_now').value = addr;
	}
	function randomPassword(password_id,password_pattern,password_prefix,password_length){
	 var text = "";
	 if(password_pattern == 1){
		 var possible = "0123456789";
	 }else if(password_pattern == 2){
		 var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	 }else if(password_pattern == 3){
		 var possible = "abcdefghijklmnopqrstuvwxyz";
	 }else if(password_pattern == 4){
		 var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	 }else if(password_pattern == 5){
		 var possible = "abcdefghijklmnopqrstuvwxyz0123456789";
	 }else if(password_pattern == 6){
		 var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	 }else{
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; 
	 }

    for( var i=0; i < password_length; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    document.getElementById(password_id).value = password_prefix+text;
}
    </script> 
                             <!-- DataTables JavaScript -->
    
    <script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

                            <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>