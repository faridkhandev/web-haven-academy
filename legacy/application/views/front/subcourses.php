<?php $this->load->view('front/header'); ?>
<!-- Header Start -->
<div class="container-fluid page-header" style="margin-bottom: 90px;">
	<div class="container">
		<div class="d-flex flex-column justify-content-center" style="min-height: 300px">
			<h3 class="display-4 text-white text-uppercase">Sub Courses</h3>
			<div class="d-inline-flex text-white">
				<p class="m-0 text-uppercase"><a class="text-white" href="<?php echo base_url();?>">Home</a></p>
				<i class="fa fa-angle-double-right pt-1 px-3"></i>
				<p class="m-0 text-uppercase">Sub Courses</p>
			</div>
		</div>
	</div>
</div>
<!-- Header End -->
	<div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Courses</h5>
                <h1><?php echo $course['course_name'];?></h1>
            </div>
            <div class="row">
			<?php if($childcourses){?>
				<?php foreach($childcourses as $item){ ?>
				<?php
				$seed = crc32($item['course_id']);   // stable hash

				$rating = 4 + (($seed % 11) / 10);   // 4.0 – 5.0
				$rating = number_format($rating, 1);

				$ratingCount = 200 + ($seed % 601);  // 200 – 800
				?>
				<div class="col-lg-4 col-md-6 mb-4">
                    <div class="rounded overflow-hidden mb-2">
                        <img class="img-fluid" src="<?php echo base_url() ;?>/weblogin/image/<?php echo $item['course_image'];?>" alt="">
                        <div class="bg-secondary p-4">
                            <a class="h5" href="" style="color:#000; font-weight:700;"><?php echo $item['course_name'];?></a>
                            <div class="border-top mt-4 pt-4">
                                <div class="d-flex justify-content-between">
                                    <h6 class="m-0">
										<i class="fa fa-star text-primary mr-2"></i>
										<?php echo $rating; ?>
										<small>(<?php echo $ratingCount; ?>)</small>
									</h6>
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
    <!-- Courses End -->
<?php $this->load->view('front/footer'); ?>