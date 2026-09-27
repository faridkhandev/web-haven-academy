<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ;?>assets/css/style.css">
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-XCGYZ8RLKT"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-XCGYZ8RLKT');
	</script>
</head>
<body>
    <div class="login_form_wrapper register d-flex align-items-center justify-content-center">
        <div class="main_wrapper">
            <img src="<?php echo base_url() ;?>assets/images/webhavenlogo.jpeg" alt="">
			<?php echo validation_errors(); ?>
			<?php if(isset($success)){?>
			<div class="alert alert-success alert-dismissible">
			<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			<strong>Success!</strong><?php echo $success;?>
			</div>
			<?php } ?>
			<?php if(isset($error)){?>
			<div class="alert alert-danger alert-dismissible">
			<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			<strong>Danger!</strong><?php echo $error;?>
			</div>
			<?php } ?>
			<?php /* if(!empty($refer_code)){ */ ?>
            <form method="POST" action="<?php echo site_url('register'); ?>?refer_id=<?php echo $refer_code; ?>" class="row g-3 needs-validation" novalidate>
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
				<p>The Password must be at least 8 characters long and contain at least one letter, one number, and one special character.(@$!%*?&#)</p>
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
				<div class="col-md-6">
                    <div class="portion">
                        <label for="">* Imo Number</label>
                        <div class="d-flex withForm">
                            <input type="text" value="<?php echo set_value('telegram_code', '+91'); ?>" class="form-control code" readonly name="telegram_code" id="">
                            <input type="text" name="student_telegram" placeholder="Telegram" value="<?php echo set_value('student_telegram'); ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                
                <input type="hidden" name="refferal_code" value="<?php echo $refer_code; ?>" />
                
                
                <div class="forgot d-flex align-items-center justify-content-between">
                    <input type="submit" class="btn btn-theme" value="Register">
                </div>
                <div class="register d-flex align-items-center text-center">
                    <p>Have account? <a href="<?php echo base_url('login') ;?>">Login Now</a></p>
                </div>
            </form>
			<?php /* }else { ?>
			<p>Refer code is mandatory for register. Please join us with refer code. Contact our team for join with refer code. </p>
			<?php } */ ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="<?php echo base_url() ;?>assets/js/app.js"></script>
</body>
</html>