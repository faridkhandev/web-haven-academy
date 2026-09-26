<?php $this->load->view('front/header'); ?>
<div class="breadcrumb-area bg-overlay" style="background-image:url('<?php echo base_url() ;?>assets/images/bg/3.png')">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="section-title mb-0 text-center">
                <h2 class="page-title">Course Detail</h2>
                <ul class="page-list">
                    <li><a href="<?php echo base_url() ;?>">Home</a></li>
                    <li>Course Detail</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<div class="course-single-area pd-top-120 pd-bottom-90">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="course-course-detaila-inner">
                    <div class="details-inner">
                        
                        <h3 class="title"><a href="javascript:void();"><?php echo $course['course_name'];?></a></h3>
                    </div>
                    <div class="thumb">
                        <img src="<?php echo base_url() ;?>/webadmin/image/<?php echo $course['course_image'];?>" alt="img">
                    </div>
                    
                    <div class="course-details-content">
						<div class="row">
							<div class="col-md-12">
								<?php echo strip_tags(html_entity_decode($course['course_description'], ENT_QUOTES, 'UTF-8'), "<p>");?>
							</div>	
							<div class="col-md-12">	
								<a class="btn btn-base b-animate-3" style="margin-top: 30px" href="<?php echo base_url('login') ;?>">Start Now</a>
							</div>
						</div>
                    </div>
                </div>
            </div>
           
        </div>
       

    </div>
</div>
<?php $this->load->view('front/footer'); ?>