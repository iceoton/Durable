  <center><div class="step_active">1</div><div class="step_detail_active"><?php echo @LA_IS_ABOUT_SYSTEM;?></div><div class="step_active">2</div><div class="step_detail_unactive"><?php echo @LA_IS_DATABASE;?></div><div class="step_unactive">3</div><div class="step_detail_unactive"><?php echo @LA_IS_ADMINISTRATOR;?></div><div class="step_unactive">4</div></center>
<h4><?php echo @LA_IS_DATABASE;?></h4>
<?php
echo @$alert;
?>
<div class="form-group">
  <label for="host_name"><?php echo @LA_IS_HOST_NAME;?></label><input type="text" name="host_name" id="host_name" class="form-control" value="localhost">
</div>
<div class="form-group">
  <label for="user_name"><?php echo @LA_IS_USERNAME;?></label><input type="text" name="user_name" id="user_name" class="form-control" autofocus>
</div>
<div class="form-group">
  <label for="password"><?php echo @LA_IS_PASSWORD;?></label><input type="password" name="password" id="password" class="form-control">
</div>
<div class="form-group">
  <label for="db_name"><?php echo @LA_IS_DBNAME;?></label><input type="text" name="db_name" id="db_name" class="form-control">
</div>
  