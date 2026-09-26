<?php $this->load->view('front/header'); ?>
<style>
/* ===== Register Form Styling ===== */
.bg-secondary {
    background: #ffffff !important;
    box-shadow: 0 10px 35px rgba(0,0,0,0.08);
}

.portion {
    margin-bottom: 18px;
}

.portion label {
    font-weight: 600;
    font-size: 14px;
    color: #333;
    margin-bottom: 6px;
}

.form-control {
    height: 48px;
    border-radius: 6px;
    border: 1px solid #ddd;
    font-size: 14px;
}

.form-control:focus {
    border-color: #1e90ff;
    box-shadow: 0 0 0 0.15rem rgba(30,144,255,.15);
}

.withForm .form-control {
    border-radius: 0;
}

.withForm .code {
    max-width: 90px;
    background: #f8f9fa;
    font-weight: 600;
    text-align: center;
}

.withForm .code:first-child {
    border-radius: 6px 0 0 6px;
}

.withForm .form-control:last-child {
    border-radius: 0 6px 6px 0;
}

p {
    font-size: 13px;
    color: #666;
    line-height: 1.6;
}

.alert {
    border-radius: 6px;
    font-size: 14px;
}

.btn-theme {
    background: linear-gradient(135deg, #1e90ff, #0066cc);
    color: #fff;
    border-radius: 6px;
    padding: 12px 35px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-theme:hover {
    background: linear-gradient(135deg, #0066cc, #1e90ff);
    transform: translateY(-1px);
}

.forgot {
    margin-top: 20px;
}

.register {
    margin-top: 25px;
    font-size: 14px;
}

.register a {
    font-weight: 600;
    color: #1e90ff;
}


</style>

<!-- Header Start -->
    <div class="container-fluid page-header" style="margin-bottom: 40px;">
        <div class="container">
            <div class="d-flex flex-column justify-content-center" style="min-height: 200px">
                <h3 class="display-4 text-white text-uppercase">Register</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="<?php echo base_url();?>">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Register</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

	<div class="container-fluid">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bg-secondary rounded ">
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
                        <form action="<?php echo site_url('register'); ?>?refer_id=<?php echo $refer_code; ?>" method="post">
                            <div class="row">
								<div class="col-md-6">
									<div class="portion">
										<label for="">* Name</label>
										<input type="text" name="student_name" placeholder="Name" class="form-control" value="<?php echo set_value('student_name'); ?>" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="portion">
										<label for="">* Email</label>
										<input type="email" name="student_email" placeholder="Email" class="form-control" value="<?php echo set_value('student_email'); ?>" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="portion">
										<label for="">* Password</label>
										<input type="password" name="student_password" placeholder="Password" value="<?php echo set_value('student_password'); ?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="portion">
										<label for="">* Confirm Password</label>
										<input type="password" name="student_confirm_password" placeholder="Confirm Password" value="<?php echo set_value('student_confirm_password'); ?>" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row"><div class="col-md-12"><p class="text-muted small">The Password must be at least 8 characters long and contain at least one letter, one number, and one special character.(@$!%*?&#)</p></div></div>
							<div class="row">
								<div class="col-md-6">
									<div class="portion">
										<label for="">* City</label>
										<input type="text" name="student_city" placeholder="City" value="<?php echo set_value('student_city'); ?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="portion">
										<label for="">* Gender</label>
										<select id="student_gender" name="student_gender" class="form-control"required>
											<option value="Male" <?php if(set_value('student_gender') == 'Male') echo 'selected'; ?>>Male</option>
											<option value="Female" <?php if(set_value('student_gender') == 'Female') echo 'selected'; ?>>Female</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="portion">
										<label for="">* Country</label>
										<select id="code_select1" name="country" class="form-control" required>
											<option value="">-Please Select-</option>
											<option value="+91" <?php if(set_value('country') == '+91') echo 'selected'; ?>>India</option>
											<option value="+88" <?php if(set_value('country') == '+88') echo 'selected'; ?>>Bangladesh</option>
											<option value="+966" <?php if(set_value('country') == '+966') echo 'selected'; ?>>Saudi Arabia</option>
											<option value="+971" <?php if(set_value('country') == '+971') echo 'selected'; ?>>United Arab Emirates</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="portion">
										<label for="">* Language</label>
										<select name="student_language" class="form-control" id="" required>
											<option value="">-Please Select-</option>
											<!--<option value="Hindi" <?php if(set_value('student_language') == 'Hindi') echo 'selected'; ?>>Hindi</option>
											 <option value="Assamese" <?php if(set_value('student_language') == 'Assamese') echo 'selected'; ?>>Assamese</option>  -->
											<option value="Bengali" <?php if(set_value('student_language') == 'Bengali') echo 'selected'; ?>>Bengali</option>
										   
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="portion">
										<label for="">* Phone No</label>
										<div class="d-flex withForm">
											<input type="text" value="<?php echo set_value('phone_code', '+91'); ?>" class="form-control code" readonly name="phone_code" id="">
											<input type="text" name="student_phone" placeholder="Phone No" value="<?php echo set_value('student_phone'); ?>" class="form-control" required>
										</div>
										
									</div>
								</div>
								<div class="col-md-6">
									<div class="portion">
										<label for="">* Whatsapp</label>
										<div class="d-flex withForm">
											<input type="text" value="<?php echo set_value('whatsapp_code', '+91'); ?>" class="form-control code" readonly name="whatsapp_code" id="">
											<input type="text" name="student_whatsapp" placeholder="Whatsapp" value="<?php echo set_value('student_whatsapp'); ?>" class="form-control" required>
										</div>
									</div>
								</div> 
							</div> 
							<div class="row">
								<div class="col-md-6">
									<div class="portion">
										<label for="">* Imo Number</label>
										<div class="d-flex withForm">
											<input type="text" value="<?php echo set_value('telegram_code', '+91'); ?>" class="form-control code" readonly name="telegram_code" id="">
											<input type="text" name="student_telegram" placeholder="Telegram" value="<?php echo set_value('student_telegram'); ?>" class="form-control" required>
										</div>
									</div>
								</div>
							</div>
							
							<input type="hidden" name="refferal_code" value="<?php echo $refer_code; ?>" />
							
							
							<div class="forgot d-flex align-items-center justify-content-between">
								<input type="submit" class="btn btn-theme" value="Register">
							</div>
							<div class="register d-flex align-items-center text-center">
								<p>Have account? <a href="<?php echo base_url('studentlogin') ;?>">Login Now</a></p>
							</div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
<?php $this->load->view('front/footer'); ?>
<script src="https://webhavenmedia.com/assets/js/app.js"></script>