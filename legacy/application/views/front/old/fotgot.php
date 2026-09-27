<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ;?>assets/css/style.css">
</head>
<body>
	<?php var_dump($error);?>
    <div class="login_form_wrapper d-flex align-items-center justify-content-center">
        <div class="main_wrapper">
            <img src="<?php echo base_url() ;?>assets/images/logo.jpg" alt="">
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
            <form method="POST" action="<?php echo site_url('forgot'); ?>" class="row g-3 needs-validation" novalidate>
                <div class="portion">
                    <label for="">Email</label>
                    <input type="email" name="email" placeholder="Email" class="form-control" required>
                </div>
                <div class="forgot d-flex align-items-center justify-content-between">
                    <input type="submit" class="btn btn-theme" value="Forgot Password">
                </div>
                <div class="register d-flex align-items-center text-center">
                    <p>Have account? <a href="<?php echo base_url('login') ;?>">Login Now</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="<?php echo base_url() ;?>assets/js/app.js"></script>
	</body>
</html>