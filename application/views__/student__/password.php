<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading">
		<div class="container-fluid page__container">
			<h1 class="mb-0">Update Password</h1>
		</div>
	</div>
	
	<div class="container-fluid page__container">
		<div class="row">
			<div class="col-md-8 offset-md-2">
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
				<form method="POST" action="<?php echo site_url('student/password'); ?>">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="student_password">Old Password</label>
								<input id="student_password" name="student_password" type="password" class="form-control" value="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="student_password">New Password</label>
								<input id="student_new_password" name="student_new_password" type="password" class="form-control" value="">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="student_password">Confirm Password</label>
								<input id="student_confirm_password" name="student_confirm_password" type="password" class="form-control" value="">
							</div>
						</div>
					</div>
					<div class="text-right mb-5"><button type="submit" name="submit" class="btn btn-success">Update Password</button></div>
				</form>	
			</div>
		</div>
	</div>
</div>
				
<?php $this->load->view('student/footer'); ?>