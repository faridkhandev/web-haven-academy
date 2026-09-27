<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8" />
  <title>Admin Panel</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/assets/css/metro.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/assets/css/style.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/assets/css/style_responsive.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/assets/css/style_default.css" rel="stylesheet" id="style_color" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/uniform/css/uniform.default.css" />
  <link rel="shortcut icon" href="<?php echo base_url(); ?>/favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
  <!-- BEGIN LOGO -->
   <div class="logo">
   
  </div>
  <!-- END LOGO -->
  <!-- BEGIN LOGIN -->
  <div class="content">
 
    <!-- BEGIN LOGIN FORM -->
   <?php 
      $attributes = array('class'=>'form-vertical login-form');
      echo form_open('webadmin/user/login', $attributes);
   ?>
      <h3 class="form-title">Login to your Admin</h3>
     
       <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-sign"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?>
       <?php echo $this->session->flashdata('msg'); ?>
      <div class="control-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <div class="controls">
          <div class="input-icon left">
            <i class="fa fa-user"></i>
            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Username" name="user_name"  autocomplete="off"  value="<?php echo set_value('user_name'); ?>"/>
          </div>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="controls">
          <div class="input-icon left">
            <i class="fa fa-lock"></i>
            <input class="m-wrap placeholder-no-fix" type="password" placeholder="Password" name="password" autocomplete="off"  value=""/>
          </div>
        </div>
      </div>
      <div class="form-actions">
        <label class="checkbox">
        <input type="checkbox" name="remember" value="1"/> Remember me
        </label>
        <button type="submit" class="btn green pull-right">
        Login <i class="m-fa fa-swapright m-fa fa-white"></i>
        </button>  
      </div>
      <div class="forget-password">
        <h4>Forgot your password ?</h4>
    <p>
    No worries, click <a href="<?php echo site_url('webadmin/user/lost_password') ?>" id="" >here</a>
      to reset your password.
    </p>
      </div>
      

      <?php
        echo form_close();
      ?>
    <!-- END LOGIN FORM -->        
  
  </div>
  <!-- END LOGIN -->
  <!-- BEGIN COPYRIGHT -->
  <div class="copyright">
     <a href="#" title="Web Soft Bridge" style="text-decoration:none; color:#fff;" target="_blank">Powered by Codeignitor</a>.
  </div>
  <!-- END COPYRIGHT -->
  <!-- BEGIN JAVASCRIPTS -->
  <script src="<?php echo base_url(); ?>/assets/js/$-1.8.3.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/bootstrap/js/bootstrap.min.js"></script>  
  <script src="<?php echo base_url(); ?>/assets/uniform/$.uniform.min.js"></script> 
  <script src="<?php echo base_url(); ?>/assets/js/$.blockui.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/$-validation/dist/$.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/app.js"></script>
  <script>
    $(document).ready(function() {     
      App.initLogin();
    });
  </script>
  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>