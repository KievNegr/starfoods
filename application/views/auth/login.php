<!DOCTYPE html>
<html>
  <head>
    <title>Авторизация</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/auth.css');?>" />
  </head>
  <body>
    <div id="login-form">
      <h1>Sing in to your account<?php //echo lang('login_heading');?></h1>

      <?php echo form_open("auth/login");?>

        <input type="text" name="identity" value="as" id="identity"  />

        <input type="password" name="password" value="" id="password"  />

        <p class="rem-text">Запомнить</p>
        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
        <?php echo form_submit('submit', lang('login_submit_btn'));?>
        <div style="clear: both;"></div>
      <?php echo form_close();?>

      <a href="forgot_password"><?php echo lang('login_forgot_password');?></a>
    </div>
    <div id="infoMessage"><?php echo $message;?></div>
  </body>
</html>