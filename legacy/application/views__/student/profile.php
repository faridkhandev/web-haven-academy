<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading">
		<div class="container-fluid page__container">
			<h1 class="mb-0">Profile</h1>
		</div>
	</div>
	
	<div class="container-fluid page__container">
		<div class="row">
			<div class="col-md-12">
				
				<div class="row">
					<div class="col"><p>You can only change your profile image, city, fb, youtube link. For changing other details please contact administartor by fillup contact us form. <a target="_blank" class="btn btn-warning" href="<?php echo base_url('contact');?>">Click Here</a></p></div>
				</div>	
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="fname">Student Name</label>
							<input id="fname" name="student_name" type="text" class="form-control" value="<?php echo $student['student_name'];?>" disabled>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="student_email">Student Email</label>
							<input id="student_email" name="student_email" type="text" class="form-control" value="<?php echo $student['student_email'];?>" disabled>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="student_phone">Student Phone</label>
							<input id="student_phone" name="student_phone" type="text" class="form-control" value="<?php echo $student['student_phone'];?>" disabled>
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col">
						<div class="form-group">
							<label for="student_phone">Student Whatsapp</label>
							<input id="student_whatsapp" name="student_whatsapp" type="text" class="form-control" value="<?php echo $student['student_whatsapp'];?>" disabled>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="student_gender">Student Gender</label>
							<input id="student_gender" name="student_gender" type="text" class="form-control" value="<?php echo $student['student_gender'];?>" disabled>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="student_language">Student Language</label>
							<input id="student_language" name="student_language" type="text" class="form-control" value="<?php echo $student['student_language'];?>" disabled>
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col">
						<div class="form-group">
							<label for="student_city">Student Country</label>
							<input id="student_country" name="student_country" type="text" class="form-control" value="<?php echo $student['student_country'];?>" disabled>
						</div>
					</div>
				</div>
				<?php echo validation_errors(); ?>
				<?php if(isset($success)){?>
				<div class="alert alert-success alert-dismissible">
				<strong>Success!</strong><?php echo $success;?>
				</div>
				<?php } ?>
				<?php if(isset($error)){?>
				<div class="alert alert-danger alert-dismissible">
				<strong>Danger!</strong><?php echo $error;?>
				</div>
				<?php } ?>
				<form method="POST" action="<?php echo site_url('student/profile'); ?>" enctype='multipart/form-data'>	
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="student_city">Student City</label>
								<input id="student_city" name="student_city" type="text" class="form-control" value="<?php echo $student['student_city'];?>">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="student_fb_link">FB Profile URL</label>
								<input id="student_fb_link" name="student_fb_link" type="text" class="form-control" value="<?php echo $student['student_fb_link'];?>">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="student_youtube_link">Youtube Profile URL</label>
								<input id="student_youtube_link" name="student_youtube_link" type="text" class="form-control" value="<?php echo $student['student_youtube_link'];?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="student_city">Profile Picture(Upto 2 MB. Only jpg,jpeg,png allowed)</label>
								<input type='file' name='student_image' class="form-control" id="input-image">
								<input type="hidden" name="student_image_hidden" value="<?php echo $student['student_image'];?>" />

								<div id="file_image-holder">
									<?php 
										if($student['student_image'] != ''){
										$src= $student['student_image'];
										}else{
										$src= 'uploads/no-image.jpg';
										}
									?>	
									<img src="<?php echo base_url($src);?>" width="150px;" height="150px;" />
								</div>
							</div>	
						</div>	
					</div>
					<div class="text-right mb-5"><button type="submit" name="submit" class="btn btn-success">Update</button></div>
				</form>	
			</div>
		</div>
	</div>
</div>
				
<?php $this->load->view('student/footer'); ?>
<script>
$("#input-image").on('change', function () {		
	if (typeof (FileReader) != "undefined") {
		var image_holder = $("#file_image-holder");
		image_holder.empty();
		
		var reader = new FileReader();
		reader.onload = function (e) {
			$("<img />", {
				"src": e.target.result,
				"class": "thumb-image",
				"width": "200px",
				"height": "250px"
			}).appendTo(image_holder);
		
		}
		image_holder.show();
		reader.readAsDataURL($(this)[0].files[0]);
	} else {
		alert("This browser does not support FileReader.");
	}
});
</script>