<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KOS Digital Online Courses</title>
    <link rel="icon" href="https://webhavenmedia.com/favicon.ico" >

    <!-- Stylesheet -->
    <link rel="stylesheet" href="https://webhavenmedia.com/assets/css/homepage/vendor.css">
    <link rel="stylesheet" href="https://webhavenmedia.com/assets/css/homepage/style.css">
    <link rel="stylesheet" href="https://webhavenmedia.com/assets/css/homepage/responsive.css">
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

    <!-- navbar start -->
    <div class="navbar-area">
        <!-- navbar top start -->
        <div class="navbar-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-md-left text-center">
                        <h3><center>Our Courses</center></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- navbar end -->
	
	<div class="event-area pd-top-120 pd-bottom-70">
		<div class="container">
			<div class="row">
				<div class="col-md-12"><h3><center><a href="<?php echo base_url('student/welcome'); ?>">Back To Welcome Page</a></center></h3></div>
				<div class="col-md-12"><center>Alpha Courses</center></div>
    			<?php foreach($courses as $item){?>
    			<div class="col-md-4">
    				<div class="card card__course" style="padding: 10px;">
    					<img style="height:185px;" src="<?php echo base_url() ;?>/weblogin/image/<?php echo $item['course_image'];?>" alt="img">
    					<a style="font-size:.8rem;padding: 5px;" class="card-header__title justify-content-center align-self-center d-flex flex-column" href="<?php echo base_url('student/course/view') ;?>?id=<?php echo $item['course_id'];?>">
    						<span class="course__subtitle"><?php echo $item['course_name'];?></span>
    					</a>
    				</div>
    			</div>
    			<?php } ?>
    			<hr/>
    			<div class="col-md-12"><center>Beta Courses</center></div>
    			<?php foreach($betacourses as $item){?>
    			<div class="col-md-4">
    				<div class="card card__course" style="padding: 10px;">
    					<img style="height:185px;" src="<?php echo base_url() ;?>/weblogin/image/<?php echo $item['course_image'];?>" alt="img">
    					<a style="font-size:.8rem;padding: 5px;" class="card-header__title justify-content-center align-self-center d-flex flex-column" >
    						<span class="course__subtitle"><?php echo $item['course_name'];?></span>
    					</a>
    				</div>
    			</div>
    			<?php } ?>
			</div>
		</div>
	</div>
	
	   <!-- footer area start -->
    <footer class="footer-area-2 bg-gray">
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 align-self-center">
                        <p>&copy; Copyright <?php echo date('Y'); ?> by KOS Digital</p>
                    </div>
                    <div class="col-md-7 text-md-right align-self-center mt-md-0 mt-2">
                        <div class="widget_nav_menu">
                            <ul>
                                <li><a href="<?php echo base_url();?>">Home</a></li>
                                <li><a href="<?php echo base_url('about');?>">About Us</a></li>
                                <li><a href="<?php echo base_url('courses');?>">Courses</a></li>
                                <li><a href="<?php echo base_url('contact');?>">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->

    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <!-- back to top area end -->


    <!-- all plugins here -->
    <script src="<?php echo base_url() ;?>assets/js/vendor.js"></script>
    <!-- main js  -->
    <script src="<?php echo base_url() ;?>assets/js/main.js"></script>
	 <script type="text/javascript">
      $(document).ready(function() {
        $('.popup-gallery').magnificPopup({
          delegate: 'a',
          type: 'image',
          tLoading: 'Loading image #%curr%...',
          mainClass: 'mfp-img-mobile',
          gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
          },
          image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
              return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
            }
          }
        });
      });
    </script>
</body>
</html>