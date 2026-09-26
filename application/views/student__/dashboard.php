<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading">
		<div class="container-fluid page__container">
			<h1 class="mb-0">My Profile</h1>
		</div>
	</div>
	
	<div class="container-fluid page__container">
		<div class="row">
			<div class="col-md-12">		
				<div class="row">
					<div class="col avator">
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
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="student_no">Student ID</label>
							<input id="student_no" name="student_no" type="text" class="form-control" value="<?php echo $student['student_no'];?>" readonly>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="student_no">Total Point</label>
							<input id="student_point" name="student_point" type="text" class="form-control" value="<?php echo $student['student_point'];?>" readonly>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="fname">Student Name</label>
							<input id="fname" name="fname" type="text" class="form-control" value="<?php echo $student['student_name'];?>" readonly>
						</div>
					</div>
				</div>
				<div class="row">					
					<div class="col">
						<div class="form-group">
							<label for="student_email">Student Email</label>
							<input id="student_email" name="student_email" type="text" class="form-control" value="<?php echo $student['student_email'];?>" readonly>
						</div>
					</div>
					<div class="col">
							<div class="form-group">
								<label for="student_phone">Student Phone</label>
								<input id="student_phone" name="student_phone" type="text" class="form-control" value="<?php echo $student['student_phone'];?>" readonly>
							</div>
						</div>
						
					<div class="col">
						<div class="form-group">
							<label for="student_phone">Student Whatsapp</label>
							<input id="student_whatsapp" name="student_whatsapp" type="text" class="form-control" value="<?php echo $student['student_whatsapp'];?>" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="student_gender">Student Gender</label>
							<input id="student_gender" name="student_gender" type="text" class="form-control" value="<?php echo $student['student_gender'];?>" readonly>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="student_language">Student Language</label>
							<input id="student_language" name="student_language" type="text" class="form-control" value="<?php echo $student['student_language'];?>" readonly>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="student_city">Student City</label>
							<input id="student_city" name="student_city" type="text" class="form-control" value="<?php echo $student['student_city'];?>" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col">
						<div class="form-group">
							<label for="student_city">Student Country</label>
							<input id="student_country" name="student_country" type="text" class="form-control" value="<?php echo $student['student_country'];?>" readonly>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="student_city">Trainer</label>
							<input id="student_country" name="student_country" type="text" class="form-control" value="<?php echo $student['firstname'].' '.$student['lastname'].'-'.$student['user_no'];?>" readonly>
						</div>
					</div>
					<?php if($this->session->userdata('student_status')==1){?> 
					<div class="col">
						<div class="form-group">
							<label for="student_city">Refer To Other</label>
							<a href="https://api.whatsapp.com/send?text=<?php echo $this->session->userdata('refer_link');?>" data-action="share/whatsapp/share" target="_blank" class="btn btn-success ml-auto"><i class="material-icons">send</i> New Refer Request</a>
						</div>
					</div>
					<?php } ?>
				</div>
				
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="student_city">FB Profile</label>
							<input id="student_fb_link" name="student_fb_link" type="text" class="form-control" value="<?php echo $student['student_fb_link'];?>" readonly>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="student_city">Youtube Profile</label>
							<input id="student_youtube_link" name="student_youtube_link" type="text" class="form-control" value="<?php echo $student['student_youtube_link'];?>" readonly>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
				
<?php $this->load->view('student/footer'); ?>