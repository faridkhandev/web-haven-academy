
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web Haven Media Online Courses</title>
    <link rel="icon" href="<?php echo base_url() ;?>favicon.ico" >

    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url() ;?>assets/css/homepage/vendor.css">
    <link rel="stylesheet" href="<?php echo base_url() ;?>assets/css/homepage/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ;?>assets/css/homepage/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
	
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-XCGYZ8RLKT"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-XCGYZ8RLKT');
	</script>

</head>
<body>
	<?php /* ?>
    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->
    <!-- search popup start-->
    
    <!-- search popup end-->
    <div class="body-overlay" id="body-overlay"></div>
	
	<?php */ ?>
    <!-- navbar start -->
    <div class="navbar-area">
        <!-- navbar top start -->
        <div class="navbar-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 text-md-left text-center">
                        <ul>
                            <li><p style="color:#000;"><i class="fa fa-envelope-o"></i>webhavenmedia@gmail.com</p></li>
							<!--li><p><i class="fa fa-phone"></i> +917047156048, +919007457660, +917602430975</p></li-->
                        </ul>
                    </div>
                    <div class="col-md-4">
						<?php /* ?>
                        <ul class="topbar-right text-md-right text-center">
                            <li class="social-area">
                                <a href="https://www.facebook.com/profile.php?id=100092638069853&mibextid=ZbWKwL" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="https://t.me/kosdigital" target="_blank"><i class="fa fa-telegram"></i></a></a>
                                <a href="https://twitter.com/kos_digital" target="_blank"><i class="fa fa-twitter"></i></a></a>
                                <a href="https://youtube.com/@Kosdigital" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                            </li>
                        </ul>
						<?php */ ?>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-area-2 navbar-area navbar-expand-lg">
            <div class="container nav-container">
                <div class="responsive-mobile-menu">
                    <button class="menu toggle-btn d-block d-lg-none" data-target="#edumint_main_menu" 
                    aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-left"></span>
                        <span class="icon-right"></span>
                    </button>
                </div>
                <div class="logo">
                    <a href="<?php echo base_url();?>"><img src="<?php echo base_url() ;?>assets/images/webhavenlogo.jpeg" alt="img"></a>
                </div>
				
                <div class="nav-right-part nav-right-part-mobile">
					<?php if(!$this->session->userdata('student')){ ?>
						<a class="btn btn-base" href="<?php echo base_url('studentlogin');?>">Sign In</a>
						<a class="signin-btn" href="<?php echo base_url('register');?>">Sign Up</a>
					<?php }else{ ?>
						<a class="signin-btn" href="<?php echo base_url('student/dashboard');?>">Profile</a>
						<a class="btn btn-base" href="<?php echo base_url('student/logout');?>">Logout</a>
					<?php } ?>
                </div>
				
                <div class="collapse navbar-collapse" id="edumint_main_menu">
                    <ul class="navbar-nav menu-open">
                        <li class="current-menu-item">
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li><a href="<?php echo base_url('about');?>">About Us</a></li>
                      
                        <li><a href="<?php echo base_url('contact');?>">Contact Us</a></li>
                    </ul>
                </div>
                <div class="nav-right-part nav-right-part-desktop style-black">
					<?php if(!$this->session->userdata('student')){ ?>
                    <a class="btn btn-base" href="<?php echo base_url('studentlogin');?>">Sign In</a>
                    <a class="signin-btn" href="<?php echo base_url('register');?>">Sign Up</a>
					<?php }else{ ?>
						<a class="signin-btn" href="<?php echo base_url('student/dashboard');?>">Profile</a>
						<a class="btn btn-base" href="<?php echo base_url('student/logout');?>">Logout</a>
					<?php } ?>
                </div>
            </div>
        </nav>
    </div>
    <!-- navbar end -->