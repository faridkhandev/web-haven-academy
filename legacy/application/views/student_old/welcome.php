<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web Haven Media Welcome Page</title>
    <link rel="icon" href="https://webhavenmedia.com/favicon.ico" >

    <!-- Stylesheet -->
    <link rel="stylesheet" href="https://webhavenmedia.com/assets/css/homepage/vendor.css">
    <link rel="stylesheet" href="https://webhavenmedia.com/assets/css/homepage/style.css">
    <link rel="stylesheet" href="https://webhavenmedia.com/assets/css/homepage/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>

</head>
<body>	

    <!-- navbar start -->
    <div class="navbar-area">
        <!-- navbar top start -->
        <div class="navbar-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-md-left text-center">
                        <h3><center>Welcome to Student Panel</center></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- navbar end -->
    
 
 
 <div class="event-area pd-top-120 pd-bottom-70">
    <div class="container">
        <div class="row">
			<?php if($student['student_status'] == 1){ ?>
			<div class="col-lg-4 col-md-6"></div>
			<div class="col-lg-4 col-md-6">
				<div class="single-course-inner bg-yellow">
					<div class="details">
						<div class="details-inner">
							<div class="emt-user">
								<h3 class="sub-title right-line" style="color:#000;"><center><a href="<?php echo base_url('student/ourcourse'); ?>">Our Course</a></center></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6"></div>
			
            <?php } ?>
            <?php if(!empty($notifications)){?>
            <div class="col-lg-12 col-md-12">
				
				<h3 class="sub-title right-line" style="color:#fd7e14;"><center>Notification</center></h3>
				<div class="testimonial-area-inner bg-cover" style="background-image: url('<?php echo base_url('assets/images/2bg.png');?>');">
					<div class="testimonial-slider owl-carousel" style="padding-right: 0%;">
						<?php foreach($notifications as $item){?>
						<div class="item">
							<div class="single-testimonial-inner style-white">
								<span class="testimonial-quote"><i class="fa fa-quote-left"></i></span>
								<p class="mb-4"><?php echo $item['notifcation']; ?></p>
							</div>
						</div>
						<?php } ?>
                    </div>						
				</div>	
			</div>
			
            <?php } ?>
        </div>
    </div>
</div>
<?php if(!empty($daily)){?>
<div class="team-area pd-top-60 pd-bottom-90" style="background: maroon;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-7">
				<div class="section-title text-center">
					<h5 class="sub-title right-line" style="color:#fd7e14">Daily Best Performer</h5>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="intro-slider owl-carousel">
				<?php foreach($daily as $item){?>
				<div class="item">
					<div class="single-intro-inner style-icon-bg bg-gray text-center">
						<div style="line-height: 90px;text-align: center;display: inline-block;border-radius: 5px;position: relative;margin-bottom: 22px;">
							<img src="<?php echo 'https://webhavenmedia.com/weblogin/image/'.$item['entity_image'];?>" alt="img" style="width:280px;height:375px;">
						</div>
						<div class="details">
							<h5><?php echo $item['entity_name'] ?><br/><?php echo strtoupper($item['type']); ?></h5>
							<p><?php echo $item['entity_description'] ?></p>
							<a class="read-more-text"><?php echo $item['entity_no'] ?></a>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<div class="team-area pd-top-60 pd-bottom-90" style="background: lightskyblue;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-7">
				<div class="section-title text-center">
					<h5 class="sub-title right-line" style="color:#fd7e14">Weekly Best Performer</h5>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-4 col-md-6">
				<div class="single-intro-inner style-icon-bg bg-gray text-center">
					<div style="line-height: 90px;text-align: center;display: inline-block;border-radius: 5px;position: relative;margin-bottom: 22px;">
						<img src="<?php echo 'https://webhavenmedia.com/weblogin/image/'.$week_student['entity_image'];?>" alt="img">
					</div>
					<div class="details">
						<h5><?php echo $week_student['entity_name'] ?></h5>
						<p><?php echo $week_student['entity_description'] ?></p>
						<a class="read-more-text"><?php echo $week_student['entity_no'] ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if($student['student_status'] == 1){?>
<div class="course-single-area pd-top-60 pd-bottom-70">
    <div class="container">
		<div class="row justify-content-center">
			<?php if(!empty($mytrainer)){?>
			<div class="col-lg-4 col-md-6">
				<div class="single-course-inner bg-green">
					<div class="details">
						<div class="details-inner">
							<div class="emt-user">
								<h4 class="align-self-center" style="color:#fd7e14"><center>My Trainer</center></h4>
							</div>
						</div>
						<div class="emt-course-meta">
							<div class="row">
								<div class="col-6">
									<div class="rating">
										<?php echo $mytrainer['firstname'].' '.$mytrainer['lastname'];?>
									</div>
								</div>
								<div class="col-6">
									<div class="price text-right">
										<a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $mytrainer['whatsapp'];?>" class="btn btn-primary"><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;Click</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php if(!empty($mytl)){?>
			<div class="col-lg-4 col-md-6">
				<div class="single-course-inner bg-yellow">
					<div class="details">
						<div class="details-inner">
							<div class="emt-user">
								<h4 class="align-self-center" style="color:#17a2b8"><center>My Team Leader</center></h4>
							</div>
						</div>
						<div class="emt-course-meta">
							<div class="row">
								<div class="col-6">
									<div class="rating">
										<?php echo $mytl['firstname'].' '.$mytl['lastname'];?>
									</div>
								</div>
								<div class="col-6">
									<div class="price text-right">
										<a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $mytl['whatsapp'];?>" class="btn btn-primary"><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;Click</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php if(!empty($mystl)){?>
			<div class="col-lg-4 col-md-6">
				<div class="single-course-inner bg-red style-white">
					<div class="details">
						<div class="details-inner">
							<div class="emt-user">
								<h4 class="align-self-center" style="color:#fff"><center>My STL</center></h4>
							</div>
						</div>
						<div class="emt-course-meta">
							<div class="row">
								<div class="col-6">
									<div class="rating">
										<?php echo $mystl['firstname'].' '.$mystl['lastname'];?>
									</div>
								</div>
								<div class="col-6">
									<div class="price text-right">
										<a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $mystl['whatsapp'];?>" class="btn btn-primary"><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;Click</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
			<?php } ?>
		</div>		
	</div>		
</div>		
<?php } ?>
<div class="intro-area pd-top-60 pd-bottom-70 intro-area--top">
	<div class="container">
		<div class="intro-area-inner intro-home-1" style="background: chocolate;">
			<div class="row no-gutters">
				
				<div class="col-lg-12 align-self-center">
					<ul class="row no-gutters">
						<li class="col-md-12">
							<div class="single-intro-inner style-white text-center">
								<div class="thumb">
									<img src="<?php echo base_url('assets/images/icon/7.png');?>" alt="img">
								</div>
								<div class="details">
									<h5>Help line</h5>
									<?php if($helpline_link != ''){ ?>
									<p><a class="btn btn-base" href="<?php echo $helpline_link;?>">Click Here</a></p>
									<?php }else{ ?>
									<p>Upcoming</p>
									<?php } ?>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="intro-area pd-top-60 pd-bottom-70 intro-area--top">
	<div class="container">
		<div class="intro-area-inner intro-home-1" style="background: blueviolet;">
			<div class="row no-gutters">
				
				<div class="col-lg-12 align-self-center">
					<ul class="row no-gutters">
						
						<li class="col-md-12">
							<div class="single-intro-inner style-white text-center">
								<div class="thumb">
									<img src="<?php echo base_url('assets/images/icon/8.png');?>" alt="img">
								</div>
								<div class="details">
									<h5>Town hall Meeting</h5>
									<?php if($townhall_link != ''){ ?>
									<p><a class="btn btn-base" href="<?php echo $townhall_link;?>">Click Here</a></p>
									<?php }else{ ?>
									<p>Upcoming</p>
									<?php } ?>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="event-area pd-top-60 pd-bottom-70" style="background:#fdc800;">
	<div class="container">	
		<?php if(!empty($photos)){ ?>
		<div class="row">
            <div class="col-lg-12 col-md-12">			
				<h3 class="sub-title right-line" style="color:#007bff"><center>Photo Zoon</center></h3>
			
				<div class="popup-gallery">
					<div class="row">
						<div class="team-slider owl-carousel">
							<?php foreach($photos as $photo){?>
							<div class="item">
								<div class="single-gallery-inner">
									<div class="thumb">
										<a href="<?php echo $photo;?>" ><img src="<?php echo $photo;?>" ></a>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>	
			</div>
        </div>
		<?php } ?>
	</div>
</div>

<div class="event-area pd-top-60 pd-bottom-70">	
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6">
				<h5 class="sub-title right-line" style="color:#ff7f50;"><center>Weekly Best Trainer</center></h5>
				<div class="single-intro-inner style-icon-bg bg-blue text-center">
					<div style="line-height: 90px;text-align: center;display: inline-block;border-radius: 5px;position: relative;margin-bottom: 22px;">
						<img src="<?php echo 'https://webhavenmedia.com/weblogin/image/'.$week_trainer['entity_image'];?>" alt="img" style="width:280px;height:375px;">
					</div>
					<div class="details">
						<h5><?php echo $week_trainer['entity_name'] ?></h5>
						<p><?php echo $week_trainer['entity_description'] ?></p>
						<a class="read-more-text"><?php echo $week_trainer['entity_no'] ?></a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<h5 class="sub-title right-line" style="color:#556b2f;"><center>Weekly Best TL</center></h5>
				<div class="single-intro-inner style-icon-bg bg-gray text-center">
					<div style="line-height: 90px;text-align: center;display: inline-block;border-radius: 5px;position: relative;margin-bottom: 22px;">
						<img src="<?php echo 'https://webhavenmedia.com/weblogin/image/'.$week_teamleader['entity_image'];?>" alt="img" style="width:280px;height:375px;">
					</div>
					<div class="details">
						<h5><?php echo $week_teamleader['entity_name'] ?></h5>
						<p><?php echo $week_teamleader['entity_description'] ?></p>
						<a class="read-more-text"><?php echo $week_teamleader['entity_no'] ?></a>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
			
			
<?php if(!empty($weekly_activity)){?>
<div  class="testimonial-area pd-top-60 pd-bottom-60" style="background-image: url('<?php echo base_url('assets/images/bg/2.png');?>')">
	<div class="container">
		<div class="row justify-content-center">
               <div class="col-xl-6 col-lg-7">
				<div class="section-title text-center">
					<h4 class="sub-title style-btn">Weekly Activity</h4>
				</div>
			</div>
		</div>
		<div class="testimonial-slider-3 owl-carousel">
			<?php foreach($weekly_activity as $item){?>
			<div class="item">
				<div class="single-testimonial-inner">
					<div class="media testimonial-author mb-4">
						<img src="<?php echo 'https://webhavenmedia.com/weblogin/image/'.$item['image'];?>" alt="img">
						
					</div>
					<div class="media-body align-self-center">
						<h6><?php echo $item['name']; ?></h6>
					</div>
					<p class="mb-0"><?php echo $item['description']; ?></p>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>
<?php /* ?>
<!-- team area start -->
<div class="team-area bg-red pd-top-60 pd-bottom-70">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-7">
				<div class="section-title text-center">
					<h5 class="sub-title style-btn" style="color:#fff;">Game Zoon</h5>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="intro-slider owl-carousel">
				<div class="item">
					<div class="single-team-inner">
						<div class="thumb">
							<img src="<?php echo base_url('assets/images/jackpot.png');?>" alt="img">
						</div>
						<div class="details"> 
							<h4><a href="#"><center>Jackpot</center></a></h4>
						</div>  
					</div>
				</div>
				<div class="item">
					<div class="single-team-inner">
						<div class="thumb">
							<img src="<?php echo base_url('assets/images/jackpot2.png');?>" alt="img">
						</div>
						<div class="details"> 
							<h4><a href="#"><center>Jackpot</center></a></h4>
						</div>  
					</div>
				</div>
				<div class="item">
					<div class="single-team-inner">
						<div class="thumb">
							<img src="<?php echo base_url('assets/images/jackpot3.png');?>" alt="img">
						</div>
						<div class="details"> 
							<h4><a href="#"><center>Jackpot</center></a></h4>
						</div>  
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php */ ?>


<div class="intro-area pd-top-60 pd-bottom-70 intro-area--top" style="margin-top:40px;">
	<div class="container">
		<div class="intro-area-inner intro-home-1 bg-black">
			<div class="row no-gutters">
				
				<div class="col-lg-12 align-self-center">
					<ul class="row no-gutters">
						<li class="col-md-12">
							<div class="single-intro-inner style-white text-center">
								<div class="thumb">
									<img src="<?php echo base_url('assets/images/icon/9.png');?>" alt="img">
								</div>
								<div class="details">
									<h5>Motivational Speech</h5>
									<?php if($motivational_link != ''){ ?>
									<p><a class="btn btn-base" href="<?php echo $motivational_link;?>">Click Here</a></p>
									<?php }else{ ?>
									<p>Upcoming</p>
									<?php } ?>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<div class="course-area pd-top-60 pd-bottom-90">
	<div class="container">
		<div class="section-title">
			<div class="row">
				<div class="col-md-6 align-self-center">
					<a class="btn btn-base mt-0" href="<?php echo base_url('student/dashboard'); ?>">Go To Student Profile</a>
				</div>
				<div class="col-md-6 text-md-right mt-3 mt-md-0">
					<a class="btn btn-base mt-0" href="https://www.facebook.com/profile.php?id=100094887172397" target="_blank">Teacher FB Profile</a>
				</div>
			</div>
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