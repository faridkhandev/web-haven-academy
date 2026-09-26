<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Web Haven Media Online Courses</title>
    <link rel="icon" href="<?php echo base_url() ;?>favicon.ico" >

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo base_url() ;?>newassets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo base_url() ;?>newassets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* =========================================================
   HEADER & NAVBAR EXCLUSIVE STYLES
   ========================================================= */
:root{
    --wh-primary:#1769ff;
    --wh-blue:#1677ff;
    --wh-purple:#7b3ff2;
    --wh-pink:#d946ef;
    --wh-green:#18b77a;
    --wh-orange:#ff9f1c;
    --wh-navy:#071b41;
    --wh-text:#0d2347;
    --wh-muted:#64748b;
    --wh-bg:#f7faff;
    --wh-border:#e5edf8;
}

body{
    margin:0;
    background:#fff !important;
    color:var(--wh-text) !important;
    font-family:'Poppins', sans-serif;
    overflow-x:hidden;
}
a{text-decoration:none!important}

.topbar-area {
    background: #ffffff;
    border-bottom: 1px solid #f1f5f9;
}
.header-right-col {
    background: #f8fafc;
    padding: 8px 16px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}
.header-right-col:hover {
    border-color: #c084fc;
    box-shadow: 0 4px 15px rgba(124, 58, 237, 0.08);
}
.header-right-col i {
    font-size: 18px;
    color: #7c3aed;
    margin-right: 12px;
    background: #ede9fe;
    padding: 10px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
}

.navbar-custom {
    background: #ffffff !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    border-radius: 16px;
    padding: 10px 20px !important;
    margin-top: 15px;
    border: 1px solid #f1f5f9;
}
.navbar-light .navbar-nav .nav-link {
    color: #1e293b !important;
    font-weight: 500;
    padding: 8px 16px !important;
    border-radius: 8px;
    transition: all 0.3s ease;
    margin: 0 2px;
}
.navbar-light .navbar-nav .nav-link:hover,
.navbar-light .navbar-nav .nav-link.active {
    color: #7c3aed !important;
    background: #ede9fe;
}

.btn-custom-login {
    background: #ffffff;
    border: 2px solid #7c3aed;
    color: #7c3aed;
    border-radius: 30px;
    padding: 8px 22px !important;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-custom-login:hover {
    background: #7c3aed;
    color: #fff;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
}

.btn-custom-signup {
    background: linear-gradient(135deg, #7c3aed 0%, #db2777 100%);
    border: none;
    color: #fff;
    border-radius: 30px;
    padding: 9px 24px !important;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(124, 58, 237, 0.35);
    transition: all 0.3s ease;
}
.btn-custom-signup:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(124, 58, 237, 0.5);
    color: #fff;
}

/* Mobile Menu Overlay Fix */
@media (max-width:991.98px){
    .navbar-custom {
        position: relative;
        z-index: 9999;
    }
    .navbar-collapse {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #ffffff;
        padding: 20px;
        border-radius: 0 0 16px 16px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        border: 1px solid #f1f5f9;
        z-index: 10000;
    }
}
</style>
</head>

<body>

<!-- Topbar Start -->
<div class="topbar-area d-none d-lg-block">
    <div class="container">
        <div class="row align-items-center py-3">
            <div class="col-lg-4">
                <a href="<?php echo base_url();?>" class="text-decoration-none">
                    <img src="<?php echo base_url();?>assets/images/webhavenlogo.jpeg" alt="Logo" class="img-fluid" style="max-width:190px; border-radius: 8px;">
                </a>
            </div>
            <div class="col-lg-8">
                <div class="d-flex justify-content-end align-items-center" style="gap: 15px;">
                    <div class="header-right-col d-flex align-items-center">
                        <i class="fa fa-map-marker-alt"></i>
                        <div>
                            <h6 class="mb-0 font-weight-bold" style="font-size: 13px; color: #0f172a;">Our Office</h6>
                            <span class="text-muted" style="font-size: 12px;">Kolkata, India</span>
                        </div>
                    </div>
                    <div class="header-right-col d-flex align-items-center">
                        <i class="fa fa-envelope"></i>
                        <div>
                            <h6 class="mb-0 font-weight-bold" style="font-size: 13px; color: #0f172a;">Email Us</h6>
                            <span style="font-size: 12px;"><a href="mailto:Webhaven755@gmail.com" class="text-muted text-decoration-none">Webhaven755@gmail.com</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
                <a href="<?php echo base_url() ;?>" class="text-decoration-none d-block d-lg-none">
                    <img src="<?php echo base_url() ;?>assets/images/webhavenlogo.jpeg" alt="img" style="width:130px !important; border-radius: 6px;">
                </a>
                <button type="button" class="navbar-toggler border-0" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav py-0 mx-auto align-items-lg-center">
                        <a href="<?php echo base_url();?>" class="nav-item nav-link <?php echo ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') ? 'active' : ''; ?>">Home</a>
                        <a href="<?php echo base_url('about');?>" class="nav-item nav-link <?php echo ($this->uri->segment(1) == 'about') ? 'active' : ''; ?>">About Us</a>
                        <a href="<?php echo base_url('courses');?>" class="nav-item nav-link <?php echo ($this->uri->segment(1) == 'courses') ? 'active' : ''; ?>">Courses</a>
                        <a href="https://www.grihomart.store/" class="nav-item nav-link" target="_blank">Shop</a>
                        <a href="<?php echo base_url('creatorzone');?>" class="nav-item nav-link <?php echo ($this->uri->segment(1) == 'creator-zone') ? 'active' : ''; ?>">Creator Zone</a>
                        <a href="<?php echo base_url('contact');?>" class="nav-item nav-link <?php echo ($this->uri->segment(1) == 'contact') ? 'active' : ''; ?>">Contact</a>
                    </div>
                    <div class="nv-button-rgt d-flex align-items-center mt-3 mt-lg-0">
                    <?php if(!$this->session->userdata('student')){ ?>
                        <a class="btn btn-custom-login ml-2 <?php echo ($this->uri->segment(1) == 'studentlogin') ? 'active' : ''; ?>" href="<?php echo base_url('studentlogin');?>">Login</a>
                        <a class="btn btn-custom-signup ml-2 <?php echo ($this->uri->segment(1) == 'register') ? 'active' : ''; ?>" href="<?php echo base_url('register');?>">Get Started</a>
                    <?php }else{ ?>
                        <a class="btn btn-custom-login ml-2" href="<?php echo base_url('student/dashboard');?>">Profile</a>
                        <a class="btn btn-danger ml-2 rounded-pill px-3 py-2 font-weight-bold shadow-sm" href="<?php echo base_url('student/logout');?>">Logout</a>
                    <?php } ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->
