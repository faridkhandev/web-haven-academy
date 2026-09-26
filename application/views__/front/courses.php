<?php $this->load->view('front/header'); ?>
<div class="breadcrumb-area bg-overlay" style="background-image:url('<?php echo base_url() ;?>assets/images/bg/3.png')">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="section-title mb-0 text-center">
                <h2 class="page-title">Courses</h2>
                <ul class="page-list">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li>Courses</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

    
 <!-- course area start -->
 <div class="course-area pd-top-110 pd-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <h6 class="sub-title double-line">OUR COURSES</h6>
                    <h2 class="title">All Courses</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if($courses){?>
				<?php foreach($courses as $item){ ?>
				<div class="col-lg-4 col-md-6">
					<div class="single-course-inner style-two">
						<div class="thumb">
							<img src="<?php echo base_url() ;?>/webadmin/image/<?php echo $item['course_image'];?>" alt="img">
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
<?php $this->load->view('front/footer'); ?>