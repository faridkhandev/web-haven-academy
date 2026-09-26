<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading border-bottom">
		<div class="container-fluid page__container">
			<h1 class="mb-0">Course List</h1>
		</div>
	</div>
	<div class="container-fluid page__container">
		<div class="row">
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
<?php $this->load->view('student/footer'); ?>