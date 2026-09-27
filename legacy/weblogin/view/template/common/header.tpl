<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($icon) { ?>
<link rel="icon" href="<?php echo $icon; ?>" sizes="16x16" type="image/png">
<?php } ?>
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
<!-- jQuery -->
<script type="text/javascript" src="view/assets/jquery.min.js"></script>
<!-- Bootstrap -->
<link href="view/stylesheet/bootstrap.min.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" type="text/css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<!-- DateTime Picker -->
<link href="view/assets/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
<script src="view/assets/moment.min.js" type="text/javascript"></script>
<script src="view/assets/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script src="view/assets/bootstrap-datepicker.js"></script>
<link href="view/assets/bootstrap-datepicker.css" rel="stylesheet"/>
<!--script src="view/javascript/bootstrap-notify.min.js" type="text/javascript"></script-->
<script src="view/javascript/notify.js" type="text/javascript"></script>
<!-- Select2 -->
<link href="view/assets/select2.min.css" type="text/css" rel="stylesheet"/>
<link href="view/assets/select2-bootstrap.min.css" type="text/css" rel="stylesheet"/>
<script src="view/assets/select2.full.min.js" type="text/javascript"></script>
<!-- Color Picker -->
<link href="view/assets/bootstrap-colorpicker.min.css" type="text/css" rel="stylesheet"/>
<script src="view/assets/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<!-- Toastr -->
<link type="text/css" href="view/assets/toastr.min.css" rel="stylesheet" />
<script src="view/assets/toastr.min.js" type="text/javascript"></script>
<!-- DataTable -->
<link rel="stylesheet" href="view/assets/dataTables.bootstrap.min.css" />
<link rel="stylesheet" href="view/assets/buttons.bootstrap.min.css" />
<link rel="stylesheet" href="view/assets/select.bootstrap.min.css" />
<link rel="stylesheet" href="view/assets/dataTables.fontAwesome.css" />
<link rel="stylesheet" href="view/assets/fixedColumns.bootstrap.min.css" />
<script src="view/assets/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="view/assets/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="view/assets/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="view/assets/buttons.bootstrap.min.js" type="text/javascript"></script>
<script src="view/assets/buttons.colVis.min.js" type="text/javascript"></script>
<script src="view/assets/buttons.flash.min.js" type="text/javascript"></script>
<script src="view/assets/jszip.min.js" type="text/javascript"></script>
<script src="view/assets/pdfmake.min.js" type="text/javascript"></script>
<script src="view/assets/vfs_fonts.js" type="text/javascript"></script>
<script src="view/assets/buttons.html5.min.js" type="text/javascript"></script>
<script src="view/assets/buttons.print.min.js" type="text/javascript"></script>
<script src="view/assets/dataTables.select.min.js" type="text/javascript"></script>
<script src="view/assets/dataTables.fixedColumns.min.js" type="text/javascript"></script>
<!-- Confirm JS -->
<link rel="stylesheet" href="view/assets/jquery-confirm.min.css">
<script src="view/assets/jquery-confirm.min.js"></script>

<?php if (count($styles)) : ?>
<!-- Dynamic Style -->
<?php foreach ($styles as $style) : ?>
<link type="text/css" href="<?php echo $style['href']; ?>" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php endforeach; endif; ?>
<?php if (count($links)) : ?>
<!-- Dynamic Links -->
<?php foreach ($links as $link) : ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php endforeach; endif; ?>
<?php if (count($scripts)) : ?>
<!-- Dynamic Scripts -->
<?php foreach ($scripts as $script) : ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php endforeach; endif; ?>
<!-- Common Style -->
<link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="screen" />
<?php
if(file_exists(DIR_APPLICATION.'view/stylesheet/'.$config_theme_css)){?>
<link type="text/css" href="view/stylesheet/<?php echo $config_theme_css;?>" rel="stylesheet" media="screen" />
<?php }else{ ?>
<link type="text/css" href="view/stylesheet/theme-blue.css" rel="stylesheet" media="screen" />
<?php } ?>
<link type="text/css" href="view/stylesheet/sd.css" rel="stylesheet" media="screen" />
<link type="text/css" href="view/stylesheet/jquery.mCustomScrollbar.min.css" rel="stylesheet" media="screen" />
<!-- Common Script -->
<script src="view/javascript/common.js" type="text/javascript"></script>
<script src="view/javascript/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
<style type="text/css">#loading { display: none; }</style>
<script type="text/javascript">
<?php if ($logged) { ?>
 	/*setInterval(function(){ pingServer() }, 10000);
	
	var autoLogOutCount=600;
	setInterval(function(){ autoLogOut() }, 1000);*/
	
	flag = true;
	serverClockTimer = '';
	tzString='UTC';
	loadTime=0;
	setInterval(function(){phpJavascriptClock();},1000);
	
	function phpJavascriptClock()
	{
		if ( flag ) {
			serverClockTimer = <?php echo time()*1000;?>;
			tzString = '<?php echo $app_time_zone; ?>';
		}
		var d = new Date(serverClockTimer);		
		
		document.getElementById("serverTime").innerHTML= "<h5>"+d.toLocaleString("en-US", {timeZone: tzString, hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit'})+" (<?php echo date('T'); ?>)</h5><small>"+d.toLocaleString("en-US", {timeZone: tzString, year: 'numeric', month: 'short', day: 'numeric',})+"</small>" ;

		flag = false;
		serverClockTimer = serverClockTimer + 1000;
		loadTime=loadTime+1;
		$('#loading > .counter').html(loadTime);
	}
</script>
<?php } ?>
</script> 
<?php if($user_group_id != 1){ ?>
<style>
    #header {
        background: #01fdf0;
        border-bottom: 1px solid #01fdf0;
    }
    .sidebar {
        background: #01fdf0;
    }
    .sidebar .nav .nav-item .nav-link{
        color: #000;
    }
    .tricker p{
        color: #000;
    }
</style>
<?php } ?>
</head>
<body <?php if ($logged) { echo 'class="body-logged"'; } ?>>
<div id="loading"><div class="circle"></div><div class="counter">0</div></div>
<div id="container">
<?php if ($logged) { ?>
<header id="header" class="navbar navbar-static-top">
  <div class="navbar-header">
    <a type="button" id="button-menu" class="pull-left"><i class="fa fa-indent fa-lg"></i></a>
    <a href="<?php echo $home; ?>" class="navbar-brand dpms-navbar-brand">
	  <!--span><img src="<?php echo HTTP_IMAGE; ?>omamf.png" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" /></span-->
	  <span class="logo"><img src="<?php echo $logo;?>" alt="KOS Digital" title="KOS Digital" /></span>
	</a>
  </div>
    <div class="d-flex header-middle">
		<div class="tricker">
			<p class="branchname"><?php echo html_entity_decode($tagline); ?></p>
		</div>

		<div class="profileBox pull-right">
			<span><img src="<?php echo $image; ?>" alt="<?php echo $firstname . ' ' . $lastname; ?>" title="<?php echo $firstname . ' ' . $lastname; ?>" class="img-circle img-responsive" /></span>
			<div class="profile_right">
			<h5><?php echo $firstname . ' ' . $lastname; ?> &nbsp <i class="fa fa-caret-down"></i></h5>
			<small><?php echo isset($user_group_info['name'])?$user_group_info['name']:'Super Admin'; ?></small>
			<ul style="display:none">
			<?php /* <li><a href="<?php //echo $profile; ?>javascript:void(0);"><i class="fa fa-user"></i> <?php echo $text_profile; ?></a></li> */?>
			<li><a href="<?php echo $user_profile; ?>"><i class="fa fa-user"></i>Manage Profile</a></li>
			<li><a href="<?php echo $change_password; ?>"><i class="fa fa-user"></i>Change password</a></li>
			<li><a href="<?php echo $logout; ?>"><i class="fa fa-lock"></i>Logout</a></li>
			</ul>
			</div>
		</div>
	</div>
</header>

<script>
$(function(){
  var tickerLength = $('.tricker ul li').length;
  var tickerHeight = $('.tricker ul li').outerHeight();
  $('.tricker ul li:last-child').prependTo('.tricker ul');
  $('.tricker ul').css('marginTop',-tickerHeight);
  function moveTop(){
    $('.tricker ul').animate({
      top : -tickerHeight
    },600, function(){
     $('.tricker ul li:first-child').appendTo('.tricker ul');
      $('.tricker ul').css('top','');
    });
   }
  setInterval( function(){
    moveTop();
  }, 6000);
  });
</script>
<div id="appbody">
<?php } ?>
