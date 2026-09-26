<?php $this->load->view('front/header'); ?>
<style>
/* ===== Login Form Styling ===== */
.bg-secondary {
    background: #ffffff !important;
    padding: 40px 35px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.08);
}

label {
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
    background: #f8f9fa;
    font-weight: 600;
    text-align: center;
    border-radius: 6px 0 0 6px;
}

.withForm .form-control:last-child {
    border-radius: 0 6px 6px 0;
}

.alert {
    border-radius: 6px;
    font-size: 14px;
}

.btn-theme {
    background: linear-gradient(135deg, #1e90ff, #0066cc);
    color: #fff;
    border-radius: 6px;
    padding: 10px 26px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-theme:hover {
    background: linear-gradient(135deg, #0066cc, #1e90ff);
    transform: translateY(-1px);
}

.forgot {
    margin-top: 25px;
}

.forgot a {
    font-size: 13px;
    color: #1e90ff;
    font-weight: 600;
}

.register {
    margin-top: 20px;
    font-size: 14px;
}

.register a {
    font-weight: 600;
    color: #1e90ff;
}

.for .btn {
    display: block;
    width: 100%;
}

@media (max-width: 768px) {
    .bg-secondary {
        padding: 30px 20px;
    }
}
</style>

<!-- Header Start -->
<div class="container-fluid page-header" style="margin-bottom: 40px;">
	<div class="container">
		<div class="d-flex flex-column justify-content-center" style="min-height: 200px">
			<h3 class="display-4 text-white text-uppercase">Login</h3>
			<div class="d-inline-flex text-white">
				<p class="m-0 text-uppercase"><a class="text-white" href="<?php echo base_url();?>">Home</a></p>
				<i class="fa fa-angle-double-right pt-1 px-3"></i>
				<p class="m-0 text-uppercase">Login</p>
			</div>
		</div>
	</div>
</div>
<!-- Header End -->
<div class="container-fluid">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
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
					
					<form method="POST" action="<?php echo site_url('studentlogin'); ?>">
						<div class="row">
							<div class="col-md-12">
								<label for="">* Phone No</label>
								<div class="d-flex withForm">
									<select id="code_select1" name="country" class="form-control code" style="width: 70px;">
										<option value="+91">+91</option>
										<option value="+88">+88</option>
										<option value="+977">+977</option>
										<option value="+966">+966</option>
										<option value="+971">+971</option>
									</select>
									<input type="text" name="email" placeholder="Your Phone No" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="">* Password</label>
								<input type="password" name="password" placeholder="Password" class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="forgot d-flex align-items-center justify-content-between">
									<div class="for">
										<input type="submit" class="btn btn-theme" value="Login" style="margin-bottom:10px;">
										<a href="<?php echo base_url() ;?>" style="margin-bottom:10px;">Back to Home</a>
									</div>
									
									<a href="<?php echo base_url('forgot') ;?>">Forgot Password</a>
								</div>
							</div>
							<div class="col-md-12">
								<div class="register d-flex align-items-center text-center">
									<p>Don't have account? <a href="<?php echo base_url('register') ;?>">Register Now</a></p>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('front/footer'); ?>