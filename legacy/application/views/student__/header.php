<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="<?php echo base_url() ;?>studentassets/vendor/perfect-scrollbar.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="<?php echo base_url() ;?>studentassets/css/app.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url() ;?>studentassets/css/app.rtl.css" rel="stylesheet">
	
    <link type="text/css" href="<?php echo base_url() ;?>studentassets/css/jquery-ui.min.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="<?php echo base_url() ;?>studentassets/css/vendor-material-icons.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url() ;?>studentassets/css/vendor-material-icons.rtl.css" rel="stylesheet">

    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="<?php echo base_url() ;?>studentassets/css/vendor-fontawesome-free.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url() ;?>studentassets/css/vendor-fontawesome-free.rtl.css" rel="stylesheet">
	
    <!-- jQuery -->
    <script src="<?php echo base_url() ;?>studentassets/vendor/jquery.min.js"></script>
    <script src="<?php echo base_url() ;?>studentassets/js/jquery-ui.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?php echo base_url() ;?>studentassets/vendor/popper.min.js"></script>
    <script src="<?php echo base_url() ;?>studentassets/vendor/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.6/css/select.bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.19/integration/font-awesome/dataTables.fontAwesome.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.bootstrap.min.css" />
	
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/select/1.2.6/js/dataTables.select.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js" type="text/javascript"></script>
</head>

<body class="layout-default">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px" data-fullbleed>
        <div class="mdk-drawer-layout__content">
            <!-- Header Layout -->
            <div class="mdk-header-layout js-mdk-header-layout" data-has-scrolling-region>
                <!-- Header -->
                <div id="header" class="mdk-header js-mdk-header m-0" data-fixed data-effects="waterfall" data-retarget-mouse-scroll="false">
                    <div class="mdk-header__content">
                        <div class="navbar navbar-expand-sm navbar-main navbar-dark bg-primary pl-md-0 pr-0" id="navbar" data-primary>
                            <div class="container-fluid page__container pr-0">
                                <!-- Navbar toggler -->
                                <button class="navbar-toggler navbar-toggler-custom  d-lg-none d-flex mr-navbar" type="button" data-toggle="sidebar">
                                    <span class="material-icons icon-14pt">menu</span>
                                </button>
                                <ul class="nav navbar-nav d-none d-md-flex">
                                    
                                </ul>

                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" data-caret="false" class="dropdown-toggle navbar-toggler navbar-toggler-dashboard border-left d-flex align-items-center ml-navbar">
                                        <span class="material-icons">laptop</span> My Profile
                                    </a>
                                    <div id="company_menu" class="dropdown-menu dropdown-menu-right navbar-company-menu">
                                        <div class="dropdown-item d-flex align-items-center py-2 navbar-company-info py-3">
                                            <span class="flex d-flex flex-column">
                                                <strong class="h5 m-0"><?php echo $this->session->userdata('student_name');?></strong>
                                                <small class="text-muted text-uppercase">STUDENT</small>
												<?php if($this->session->userdata('student_status')==0){?>
                                                <small class="text-muted text-uppercase btn btn-warning">Inactive</small>
												<?php } ?>
                                            </span>

                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="<?php echo base_url('student/profile');?>">
                                            <span class="material-icons mr-2">account_circle</span> Edit Account
                                        </a>
										<a class="dropdown-item d-flex align-items-center py-2" href="<?php echo base_url('student/password');?>">
                                            <span class="material-icons mr-2">account_circle</span> Change Password
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="<?php echo base_url('student/logout');?>">
                                            <span class="material-icons mr-2">exit_to_app</span> Logout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // END Header -->