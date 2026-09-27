<?php $this->load->view('front/header'); ?>
<!-- Header Start -->
    <div class="container-fluid page-header" style="margin-bottom: 40px;">
        <div class="container">
            <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
                <h3 class="display-4 text-white text-uppercase">Contact</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="<?php echo base_url();?>">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Contact</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
	
	<div class="container-fluid py-5">
        <div class="container py-5">
			<div class="row justify-content-center">
				<div class="col-lg-4">
					<div class="contact-list-inner">
						<div class="media">
							<div class="media-left">
								<img src="<?php echo base_url() ;?>assets/images/ci1.png" alt="img">
							</div>
							<div class="media-body align-self-center">
								<h5>Our Contact</h5>
								<p>Ruma, Rahul</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="contact-list-inner">
						<div class="media">
							<div class="media-left">
								<img src="<?php echo base_url() ;?>assets/images/c2.png" alt="img">
							</div>
							<div class="media-body align-self-center">
								<h5>Our Email</h5>
								<p>webhavenmedia@gmail.com</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="contact-list-inner">
						<div class="media">
							<div class="media-left">
								<img src="<?php echo base_url() ;?>assets/images/ci3.png" alt="img">
							</div>
							<div class="media-body align-self-center">
								<h5>Our Address</h5>
								<p>No Physical Address</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- contact list end -->

	 <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Contact</h5>
                <h1>Contact For Any Query</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bg-secondary rounded p-5">
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
                        <form action="<?php echo site_url('contact'); ?>" method="post">
                            <div class="control-group mb-3">
                                <input type="text" class="form-control border-0 p-4" placeholder="First Name" name="first_name" required />
                            </div>
							<div class="control-group mb-3">
                                <input type="text" class="form-control border-0 p-4" placeholder="Last Name" name="last_name" required />
                            </div>
                            <div class="control-group mb-3">
                                <input type="email" placeholder="Your Email" name="email" required class="form-control border-0 p-4" />
                            </div>
                            <div class="control-group mb-3">
                                <input type="text" class="form-control border-0 p-4" placeholder="Subject" name="subject" required />
                            </div>
                            <div class="control-group mb-3">
                                <textarea class="form-control border-0 py-3 px-4" rows="5" placeholder="Message" name="message" required></textarea>
                            </div>
                            <div class="text-center">
								<button type="submit" class="btn btn-primary py-3 px-5">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
<?php $this->load->view('front/footer'); ?>