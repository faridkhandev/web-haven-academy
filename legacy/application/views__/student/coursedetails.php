<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="hero-banner bg-primary d-flex flex-row align-items-center" style="height:250px;">
		<div class="container-fluid page__container">
			<div class="d-flex flex-column">
				<div class="mb-1">
					<a href="<?php echo base_url('student/course');?>" class="badge badge-dark-gray text-white">Back to Courses</a>
				</div>
				<div class="d-flex align-items-center mb-3">
					<div class="mr-3">
						<img src="<?php echo base_url() ;?>/webadmin/image/<?php echo $course['course_image'];?>" width="100" alt="<?php echo $course['course_name'];?>">
					</div>
					<div>
						<h1 class="text-white mb-0"><?php echo $course['course_name'];?></h1>
					</div>
				</div>
			</div>	
		</div>
    </div>

	<div class="container-fluid page__container">
		<div class="row">
			<div class="col-md-12">

				<div class="mb-3"><strong class="text-dark-gray">DESCRIPTION</strong></div>
				<p class="mb-3">
					<?php echo strip_tags(html_entity_decode($course['course_description'], ENT_QUOTES, 'UTF-8'), "<p>");?>
				</p>
				
				<div class="">
					<ul class="list-group list-lessons">
						<?php for($i=1;$i<=$course['no_of_classes']; $i++){?>
						<li class="list-group-item d-flex">
							<a href="#">Session <?php echo $i;?> >> Click Here To View Session Detail</a>
						</li>
						<?php } ?>
					</ul>
										
				</div>	
			</div>	
		</div>	
	</div>	
</div>	
<?php $this->load->view('student/footer'); ?>