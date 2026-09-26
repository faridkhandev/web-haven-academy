<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web Haven Media Online Courses</title>
    <link rel="icon" href="<?php echo base_url() ;?>favicon.ico" >

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo base_url() ;?>newassets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo base_url() ;?>newassets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid d-none d-lg-block">
        <div class="row align-items-center py-4 px-xl-5">
            <div class="col-lg-3">
				<a href="<?php echo base_url();?>" class="text-decoration-none"><img src="<?php echo base_url() ;?>assets/images/webhavenlogo.jpeg" alt="img" style="width:250px !important"></a>
            </div>
            <div class="col-lg-3 text-right">
                <div class="d-inline-flex align-items-center">
                    <i class="fa fa-2x fa-map-marker-alt text-primary mr-3"></i>
                    <div class="text-left">
                        <h6 class="font-weight-semi-bold mb-1">Our Office</h6>
                        <small>Kolkata, India</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-right">
                <div class="d-inline-flex align-items-center">
                    <i class="fa fa-2x fa-envelope text-primary mr-3"></i>
                    <div class="text-left">
                        <h6 class="font-weight-semi-bold mb-1">Email Us</h6>
                        <small>webhavenmedia@gmail.com</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-right">
                <!--div class="d-inline-flex align-items-center">
                    <i class="fa fa-2x fa-phone text-primary mr-3"></i>
                    <div class="text-left">
                        <h6 class="font-weight-semi-bold mb-1">Call Us</h6>
                        <small>+012 345 6789</small>
                    </div>
                </div-->
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-3">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-1 px-0">
                    <a href="<?php echo base_url() ;?>" class="text-decoration-none d-block d-lg-none">
                        <img src="<?php echo base_url() ;?>assets/images/webhavenlogo.jpeg" alt="img" style="width:250px !important">
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
                        <div class="navbar-nav py-0">
                            <a href="<?php echo base_url();?>" class="nav-item nav-link <?php echo ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') ? 'active' : ''; ?>">Home</a>
                            <a href="<?php echo base_url('about');?>" class="nav-item nav-link <?php echo ($this->uri->segment(1) == 'about') ? 'active' : ''; ?>">About</a>
                            <a href="<?php echo base_url('courses');?>" class="nav-item nav-link <?php echo ($this->uri->segment(1) == 'courses') ? 'active' : ''; ?>">Courses</a>
                            <a href="<?php echo base_url('contact');?>" class="nav-item nav-link <?php echo ($this->uri->segment(1) == 'contact') ? 'active' : ''; ?>">Contact</a>
                        </div>
						<?php if(!$this->session->userdata('student')){ ?>
							<a class="btn btn-primary py-1 px-3 ml-2 <?php echo ($this->uri->segment(1) == 'studentlogin') ? 'active' : ''; ?>" href="<?php echo base_url('studentlogin');?>">Sign In</a>
							<a class="btn btn-primary py-1 px-3 ml-2 <?php echo ($this->uri->segment(1) == 'register') ? 'active' : ''; ?>" href="<?php echo base_url('register');?>">Sign Up</a>
						<?php }else{ ?>
							<a class="btn btn-primary py-1 px-3 ml-2" href="<?php echo base_url('student/dashboard');?>">Profile</a>
							<a class="btn btn-primary py-1 px-3 ml-2" href="<?php echo base_url('student/logout');?>">Logout</a>
						<?php } ?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->