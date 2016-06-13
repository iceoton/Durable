  <center><div class="step_active">1</div><div class="step_detail_active"><?php echo @LA_IS_ABOUT_SYSTEM;?></div><div class="step_active">2</div><div class="step_detail_active"><?php echo @LA_IS_DATABASE;?></div><div class="step_active">3</div><div class="step_detail_unactive"><?php echo @LA_IS_ADMINISTRATOR;?></div><div class="step_unactive">4</div></center>
  <h4><?php echo @LA_IS_ADMINISTRATOR;?></h4>
  <?php
echo @$alert;
?>
  <div class="form-group">
  <label for="name"><?php echo @LA_IS_NAME;?></label><input type="text" name="name" id="name" class="form-control" autofocus>
</div>
<div class="form-group">
  <label for="lastname"><?php echo @LA_IS_LASTNAME;?></label><input type="text" name="lastname" id="lastname" class="form-control">
</div>
<div class="form-group">
  <label for="username"><?php echo @LA_IS_USERNAME;?></label><input type="text" name="username" id="username" class="form-control">
</div>
<div class="form-group">
  <label for="password"><?php echo @LA_IS_PASSWORD;?></label><input type="password" name="password" id="password" class="form-control">
</div>
<div class="form-group">
  <label for="email"><?php echo @LA_IS_EMAIL;?></label><input type="text" name="email" id="email" class="form-control">
</div>
