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
    <link href="<?php echo base_url() ;?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ;?>assets/css/metro.css" rel="stylesheet" />
    <link href="<?php echo base_url() ;?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ;?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo base_url() ;?>assets/css/style.css" rel="stylesheet" />
    <link href="<?php echo base_url() ;?>assets/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" />
    <link href="<?php echo base_url() ;?>assets/css/style_responsive.css" rel="stylesheet" />
    <link href="<?php echo base_url() ;?>assets/css/style_default.css" rel="stylesheet" id="style_color" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ;?>assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ;?>assets/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ;?>assets/uniform/css/uniform.default.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ;?>assets/bootstrap-daterangepicker/daterangepicker.css" />
    <link href="<?php echo base_url() ;?>assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
    <link href="<?php echo base_url() ;?>assets/jqvmap/jqvmap/jqvmap.css" media="screen" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url() ;?>assets/data-tables/DT_bootstrap.css" />
	<script src="<?php echo base_url() ;?>assets/js/jquery-1.8.3.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url() ;?>assets/ckeditor/ckeditor.js"></script> 
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-inverse navbar-fixed-top">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="navbar-inner">
            <div class="container-fluid">
                <!-- BEGIN LOGO -->
                <!--a class="brand" href="<?php echo base_url('webadmin/dashboard') ;?>">
                <img src="<?php echo base_url() ;?>assets/img/logo.png" alt="logo" style="height:30px;" />
                </a-->
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                <img src="<?php echo base_url() ;?>assets/img/menu-toggler.png" alt="" />
                </a>          
                <!-- END RESPONSIVE MENU TOGGLER -->                
                <!-- BEGIN TOP NAVIGATION MENU -->                  
                <ul class="nav pull-right"> 
                    <!-- END TODO DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown user">
                    <?php
					$user_name=$this->session->user_name;
					$this->db->select('*');
					$this->db->from('admin_members');
					$this->db->where_in('user_name', $user_name);
					$query = $this->db->get();	
					//$data['result']=$query->result_object();
					$data=$query->row();
				    $user_photo=$data->photo;
					if($user_photo=="")
					{
						 $user_photo='user.png';
					}
					?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img alt="<?php echo $user_name;?>" src="<?php echo base_url() ;?>uploads/<?php echo $user_photo;?>"  style="width:29px; height:29px;"/>
                    <span class="username"><?php echo $user_name;?></span>
                    <i class="fa fa-angle-down"></i>
                    </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo  base_url();?>webadmin/profile"><i class="fa fa-user"></i> My Profile</a></li>
                            <li><a href="<?php echo  base_url();?>webadmin/profile/change_password"><i class="fa fa-key"></i> Change Password</a></li>
                          
                            <li class="divider"></li>
                            <li><a  href="<?php echo  base_url();?>webadmin/user/logout"><i class="fa fa-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
                <!-- END TOP NAVIGATION MENU -->    
            </div>
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>
    <!-- END HEADER --> 