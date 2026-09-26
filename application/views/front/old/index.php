<?php $this->load->view('front/header'); ?>
    
    <!-- banner start -->
    <div class="banner-area banner-area-2" style="background-image: url('<?php echo base_url() ;?>assets/images/homeimage.jpeg');     background-position: center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 align-self-center">
                    <div class="banner-inner style-white text-center text-lg-left">
                        <p style="color:#E0CD67;font-weight:800">WebHaven Academy একটি আধুনিক ডিজিটাল স্কিল শেখার প্ল্যাটফর্ম যেখানে অনলাইন কাজের জন্য প্রয়োজনীয় বাস্তব দক্ষতা শেখানো হয়। এখানে শিক্ষার্থীরা প্র্যাকটিক্যাল কাজের মাধ্যমে হাতে-কলমে অভিজ্ঞতা পায় এবং ডিজিটাল মার্কেটিং, কনটেন্ট ক্রিয়েশন ও AI টুল ব্যবহারে বিশেষ গুরুত্ব দেওয়া হয়। লাইভ সাপোর্ট ও মেন্টরশিপের মাধ্যমে শেখার পথ সহজ করা হয়, যাতে শেখা স্কিল ব্যবহার করে অনলাইনে আয়ের সুযোগ তৈরি করা যায়। WebHaven Academy এর মূল লক্ষ্য—Learn, Create, Earn।</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->   

    <!-- intro start -->
    <div class="intro-area intro-area--top">
        <div class="container">
            <div class="intro-area-inner-2">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title text-center">
                            <h6 class="sub-title double-line">FEATURES</h6>
                            <h2 class="title">An exemplary <br> learning community</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-intro-inner style-thumb text-center">
                            <div class="thumb">
                                <img src="<?php echo base_url() ;?>assets/images/4.png" alt="img">
                            </div>
                            <div class="details">
                                <h4>13+ COURSES</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-intro-inner style-thumb text-center">
                            <div class="thumb">
                                <img src="<?php echo base_url() ;?>assets/images/5.png" alt="img">
                            </div>
                            <div class="details">
                                <h4>STUDENTS SUPPORT</h4>
                                <p>At 8:00am-11:00pm×7days</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-intro-inner style-thumb text-center">
                            <div class="thumb">
                                <img src="<?php echo base_url() ;?>assets/images/6.png" alt="img">
                            </div>
                            <div class="details">
                                <h4>LIFE TIME OPPORTUNITY</h4>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title text-center">
                            <h6 class="sub-title double-line">Webhavenmedia Information</h6>
                        </div>
                    </div>
                </div>
                <div class="row">
					<div class="col-md-6">
                        <div class="single-intro-inner text-center">
                            <div class="details">
                                <h4>Join Telegram Group</h4>
								<?php if($this->session->userdata('id')){ ?>
								<a class="btn btn-primary" onclick="gotolink('<?php echo $this->session->userdata('id') ?>', 'https://t.me/kosdigital2', 'telegram');">Join</a>
								<?php }else{ ?>
								<a class="btn btn-primary" href="https://t.me/kosdigital2" target="_blank">Join</a>
								<?php } ?>
                            </div>
                        </div>
                    </div>
					<div class="col-md-6">
                        <div class="single-intro-inner text-center">
                            <div class="details">
                                <h4>Join Whatsapp Group</h4>
								<?php if($this->session->userdata('id')){ ?>
								<a class="btn btn-primary" onclick="gotolink('<?php echo $this->session->userdata('id') ?>', 'https://whatsapp.com/channel/0029VasnNS4InlqOjLntaf06', 'whatsapp');">Join</a>
								<?php }else{ ?>
								<a class="btn btn-primary" href="https://whatsapp.com/channel/0029VasnNS4InlqOjLntaf06" target="_blank">Join</a>
								<?php } ?>
                            </div>
                        </div>
                    </div>
				</div>
                <div class="intro-footer bg-base">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-list-inner">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo base_url() ;?>assets/images/19.png" alt="img">
                                    </div>
                                    <div class="media-body align-self-center">
                                        <h5>DIGITAL MARKATING</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-list-inner">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo base_url() ;?>assets/images/20.png" alt="img">
                                    </div>
                                    <div class="media-body align-self-center">
                                        <h5>SPOKEN ENGLISH</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-list-inner">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo base_url() ;?>assets/images/21.png" alt="img">
                                    </div>
                                    <div class="media-body align-self-center">
                                        <h5>RESELLING</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- intro end -->

    <!-- about area start -->
    <div class="about-area pd-top-120">
        <div class="container">
            <div class="about-area-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-10">
                        <div class="about-thumb-wrap after-shape" style="background-image: url('<?php echo base_url() ;?>assets/images/2.png');">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-inner-wrap">  
                            <div class="section-title mb-0">
                                <h6 class="sub-title right-line">ABOUT US</h6>
                                <!--h2 class="title">Education in continuing a proud tradition.</h2-->
                                <p class="content">The key of success is a multifaceted concept that encompasses various elements and principles crucial for achieving personal and professional fulfilment. It is an amalgamation of mindset, skills, attitudes, and strategies that empower individuals to reach their goals and excel in their endeavours.</p>
                                <div class="row">
                                    <!--div class="col-sm-6">
                                        <ul class="single-list-wrap">
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> Metus interdum metus
                                            </li>
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> Ligula cur maecenas
                                            </li>
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> Fringilla nulla 
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="single-list-wrap">
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> Metus interdum metus
                                            </li>
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> Ligula cur maecenas
                                            </li>
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> Fringilla nulla 
                                            </li>
                                        </ul>
                                    </div>
                                </div-->
                                <a class="btn btn-base b-animate-3" href="<?php echo base_url('about') ;?>">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about area end -->
	<?php /* ?>
    <!-- course area start -->
    <div class="course-area pd-top-110 pd-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h6 class="sub-title double-line">OUR COURSES</h6>
                        <h2 class="title">Top Featured Courses</h2>
                    </div>
                </div>
            </div>
            <div class="row">
				<?php if($courses){?>
					<?php foreach($courses as $item){ ?>
					<div class="col-lg-4 col-md-6">
						<div class="single-course-inner style-two">
							<div class="thumb">
								<img src="<?php echo base_url() ;?>/adminlogin/image/<?php echo $item['course_image'];?>" alt="img">
							</div>
							<div class="details">
								<div class="emt-course-meta border-0">
									<div class="row">
										<div class="col-10">
											<h6><a href="<?php echo base_url('coursedetails') ;?>?id=<?php echo $item['course_id'];?>"><?php echo $item['course_name'];?></a></h6>
										</div>
										<div class="col-2 text-right">
											<a class="arrow-right" href="<?php echo base_url('coursedetails') ;?>?id=<?php echo $item['course_id'];?>"><img src="<?php echo base_url() ;?>assets/images/arrow.png" alt="img"></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				<?php } ?>
            </div>
        </div>
    </div>
    <!-- course area end -->
	<?php */ ?>
   
	<?php /* ?>
   
    <!--client-area start-->
    <div class="client-area bg-base pd-top-100 pd-bottom-100" style="background-image: url(<?php echo base_url() ;?>assets/images/bg.png);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="institute-slider owl-carousel">
                        <div class="item">
                            <img src="<?php echo base_url() ;?>assets/images/i1.png" alt="img">
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url() ;?>assets/images/i2.png" alt="img">
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url() ;?>assets/images/i3.png" alt="img">
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url() ;?>assets/images/i4.png" alt="img">
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url() ;?>assets/images/i5.png" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--client-area end-->
	<?php */ ?>
    <!--events-area start-->
    <div class="events-area pd-top-110 pd-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-11">
                    <div class="section-title text-center">
                        <h6 class="sub-title double-line">Projects</h6>
                        <h2 class="title"> Upcoming Projects</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <ul class="single-blog-list-wrap style-white" style="background-color: var(--heading-color);">
                        <li>
                            <div class="media single-blog-list-inner style-white">
                                <div class="media-body details">
                                    <h5><a href="#">GAMING ZOON</a></h5>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="media single-blog-list-inner">
                                <div class="media-body details">
                                    <h5><a href="#">EDUCATION</a></h5>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="media single-blog-list-inner">
                                <div class="media-body details">
                                    <h5><a href="#">MOTIVATIONAL SPEAKER</a></h5>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 align-self-center">
                    <div class="event-thumb">
                        <img src="<?php echo base_url() ;?>assets/images/events.png" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--events-area end-->
	<?php $this->load->view('front/footer'); ?>
	<script>
	function gotolink(id, link, type){
        $.ajax({
            url: 'https://kosdigital.in/page/sendlink',
            method: 'POST',
            data: { id: id, type: type },
            success: function(response) {
                if(response == 'success') {
                    location.href = link;
                } else {
                    alert("You have unauthorize access");
                }
            }
        });
    }
	</script>