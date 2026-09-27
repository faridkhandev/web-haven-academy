<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo isset($page_title) ? $page_title : 'Student Dashboard'; ?></title>

    <meta name="robots" content="noindex">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="<?php echo base_url(); ?>studentassets/vendor/perfect-scrollbar.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="<?php echo base_url(); ?>studentassets/css/app.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>studentassets/css/app.rtl.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>studentassets/css/jquery-ui.min.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="<?php echo base_url(); ?>studentassets/css/vendor-material-icons.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>studentassets/css/vendor-material-icons.rtl.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link type="text/css" href="<?php echo base_url(); ?>studentassets/css/vendor-fontawesome-free.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>studentassets/css/vendor-fontawesome-free.rtl.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>studentassets/vendor/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>studentassets/js/jquery-ui.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>studentassets/vendor/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>studentassets/vendor/bootstrap.min.js"></script>

    <!-- DataTables (keep as you had) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.6/css/select.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.19/integration/font-awesome/dataTables.fontAwesome.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.bootstrap.min.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.6/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XCGYZ8RLKT"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-XCGYZ8RLKT');
    </script>

    <!-- ✅ Embedded CSS for Modern Header -->
    <style>
      :root{
        --nav-grad: linear-gradient(135deg, #0d6efd, #6f42c1);
      }
      .navbar-main.bg-primary{
        background: var(--nav-grad) !important;
      }
      .portal-brand{
        display:flex;
        align-items:center;
        gap:10px;
        color:#fff !important;
        font-weight:700;
        letter-spacing:.2px;
        text-decoration:none !important;
      }
      .portal-brand .brand-dot{
        width:10px;height:10px;border-radius:999px;
        background: rgba(255,255,255,.9);
        box-shadow: 0 0 0 6px rgba(255,255,255,.12);
      }
      .portal-subtitle{
        font-size:12px;
        opacity:.85;
        margin-top:-2px;
      }
      .nav-pill{
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 999px;
        padding: 6px 12px;
        color:#fff;
        display:flex;
        align-items:center;
        gap:8px;
        font-weight:600;
      }
      .status-badge{
        font-size:11px;
        padding: 3px 8px;
        border-radius: 999px;
        font-weight:700;
        letter-spacing:.3px;
      }
      .status-active{
        background: rgba(40,167,69,.18);
        color:#d4ffdf;
        border: 1px solid rgba(40,167,69,.35);
      }
      .status-inactive{
        background: rgba(255,193,7,.20);
        color:#fff3cd;
        border: 1px solid rgba(255,193,7,.40);
      }
      .profile-trigger{
        border-left: 1px solid rgba(255,255,255,.18) !important;
        background: rgba(255,255,255,.10);
        border-radius: 12px;
        padding: 8px 12px;
        color:#fff !important;
      }
      .profile-trigger:hover{
        background: rgba(255,255,255,.16);
        text-decoration:none !important;
      }
      .navbar-company-menu{
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,.25);
        border: 1px solid rgba(0,0,0,.06);
      }
      .dropdown-item .material-icons{
        font-size: 20px;
      }
      .dropdown-item:hover{
        background:#f6f7fb;
      }
      .company-head{
        background: #fff;
      }
      .company-head strong{
        font-weight:800;
      }
      .company-meta{
        font-size: 12px;
        color:#6c757d;
        text-transform: uppercase;
        letter-spacing: .6px;
      }
    </style>
</head>

<body class="layout-default">
<div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px" data-fullbleed>
  <div class="mdk-drawer-layout__content">

    <div class="mdk-header-layout js-mdk-header-layout" data-has-scrolling-region>
      <div id="header" class="mdk-header js-mdk-header m-0" data-fixed data-effects="waterfall" data-retarget-mouse-scroll="false">
        <div class="mdk-header__content">

          <div class="navbar navbar-expand-sm navbar-main navbar-dark bg-primary pl-md-0 pr-0" id="navbar" data-primary>
            <div class="container-fluid page__container pr-0">

              <!-- Sidebar toggler -->
              <button class="navbar-toggler navbar-toggler-custom d-lg-none d-flex mr-navbar" type="button" data-toggle="sidebar">
                <span class="material-icons icon-14pt">menu</span>
              </button>

              <!-- Brand / Title -->
              <a class="portal-brand mr-3" href="<?php echo base_url('student/dashboard'); ?>">
                <span class="brand-dot"></span>
                <div class="d-none d-sm-block">
                  <div>Student Portal</div>
                  <div class="portal-subtitle">Web Haven Media</div>
                </div>
              </a>

              <!-- Left spacer -->
              <ul class="nav navbar-nav d-none d-md-flex"></ul>

              <!-- Right side: Welcome + Status + Profile -->
              <div class="ml-auto d-flex align-items-center" style="gap:10px;">

                <div class="d-none d-md-flex nav-pill">
                  <span class="material-icons" style="font-size:18px;">person</span>
                  <span>Hi, <?php echo $this->session->userdata('student_name'); ?></span>

                  <?php if($this->session->userdata('student_status')==0){ ?>
                    <span class="status-badge status-inactive">INACTIVE</span>
                  <?php } else { ?>
                    <span class="status-badge status-active">ACTIVE</span>
                  <?php } ?>
                </div>

                <!-- Profile dropdown -->
                <div class="dropdown">
                  <a href="#" data-toggle="dropdown" data-caret="false"
                     class="dropdown-toggle d-flex align-items-center profile-trigger">
                    <span class="material-icons mr-1">account_circle</span>
                    <span class="d-none d-sm-inline">My Profile</span>
                    <span class="material-icons ml-1" style="font-size:18px;">expand_more</span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right navbar-company-menu">
                    <div class="dropdown-item d-flex align-items-center py-3 company-head">
                      <span class="flex d-flex flex-column">
                        <strong class="h5 m-0"><?php echo $this->session->userdata('student_name'); ?></strong>
                        <span class="company-meta">Student</span>
                        <?php if($this->session->userdata('student_status')==0){ ?>
                          <span class="mt-2 status-badge status-inactive" style="width:max-content;">INACTIVE</span>
                        <?php } else { ?>
                          <span class="mt-2 status-badge status-active" style="width:max-content;">ACTIVE</span>
                        <?php } ?>
                      </span>
                    </div>

                    <div class="dropdown-divider m-0"></div>

                    <a class="dropdown-item d-flex align-items-center py-2" href="<?php echo base_url('student/profile');?>">
                      <span class="material-icons mr-2">edit</span> Edit Profile
                    </a>

                    <a class="dropdown-item d-flex align-items-center py-2" href="<?php echo base_url('student/password');?>">
                      <span class="material-icons mr-2">lock</span> Change Password
                    </a>

                    <div class="dropdown-divider m-0"></div>

                    <a class="dropdown-item d-flex align-items-center py-2 text-danger" href="<?php echo base_url('student/logout');?>">
                      <span class="material-icons mr-2">exit_to_app</span> Logout
                    </a>
                  </div>
                </div>

              </div><!-- /right -->

            </div>
          </div>

        </div>
      </div>
      <!-- Header END -->
