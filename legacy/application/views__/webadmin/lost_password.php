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

<style>
.forget-form
{
	display:block !important;
}
.login .content .input-icon .m-wrap {
	width:100% !important;
    height: 33px !important;
}
</style>
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
   
    <!-- BEGIN FORGOT PASSWORD FORM -->
      <?php 
        $attributes = array('class' => 'form-vertical forget-form');
        echo form_open('webadmin/user/lost_password', $attributes);
      ?>
      
      <h3 class="">Forget Password ?</h3>
      <p>Enter your e-mail address below to reset your password.</p>
       <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-sign"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?>
       <?php echo $this->session->flashdata('msg'); ?>
         <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="fa fa-envelope"></i>
            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="user_email"  autocomplete="off"/>
          </div>
        </div>
      </div>
      <div class="form-actions">
        
        <a class="btn"  href="<?php echo base_url('webadmin/user/login')?>"> <i class="m-fa fa-swapleft"></i> Back</a>
       
        <button type="submit" class="btn green pull-right">
        Submit <i class="m-fa fa-swapright m-fa fa-white"></i>
        </button>            
      </div>
   
    </form>
    <!-- END FORGOT PASSWORD FORM -->
   			 <?php echo form_close(); ?> 
    <!-- END REGISTRATION FORM -->
  </div>
  <!-- END LOGIN -->
  <!-- BEGIN COPYRIGHT -->
  <div class="copyright">
     <div class="copyright">     <a href="#" title="Web Soft Bridge" style="text-decoration:none; color:#fff;" target="_blank">Powered by Codeignitor</a>.  </div>
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