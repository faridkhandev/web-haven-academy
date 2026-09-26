<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ;?>assets/css/style.css">
</head>
<body>
    <div class="login_form_wrapper d-flex align-items-center justify-content-center">
        <div class="main_wrapper">

            <img src="<?php echo base_url() ;?>assets/images/logo.jpg" alt="">
			<?php echo validation_errors(); ?>
			<?php if(isset($error)){?>
			<div class="alert alert-danger alert-dismissible">
			<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			<strong>Danger!</strong><?php echo $error;?>
			</div>
			<?php } ?>
            <form method="POST" action="<?php echo site_url('login'); ?>" class="row g-3 needs-validation" novalidate>
				<div class="portion">
					<label for="">* Phone No</label>
					<div class="d-flex withForm">
						<select id="code_select1" name="country" class="form-control code" style="width: 70px;">
							<option value="+91">+91</option>
							<option value="+88">+88</option>
							<option value="+977">+977</option>
						</select>
						<input type="text" name="email" placeholder="Your Phone No" class="form-control" required>
					</div>
					
				</div>
                <div class="portion">
                    <label for="">* Password</label>
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                </div>
                <div class="forgot d-flex align-items-center justify-content-between">
                    <div class="for">
                        <a href="<?php echo base_url() ;?>" class="btn btn-theme">< Back to Home</a>
                        <input type="submit" class="btn btn-theme" value="Login">
                    </div>
                    
                    <a href="<?php echo base_url('forgot') ;?>">Forgot Password</a>
                </div>
                <div class="register d-flex align-items-center text-center">
                    <p>Don't have account? <a href="<?php echo base_url('register') ;?>">Register Now</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="<?php echo base_url() ;?>assets/js/app.js"></script>
</body>
</html>