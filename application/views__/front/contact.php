<?php $this->load->view('front/header'); ?>

<div class="breadcrumb-area bg-overlay" style="background-image:url('<?php echo base_url() ;?>assets/images/bg/3.png')">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="section-title mb-0 text-center">
                <h2 class="page-title">Contact</h2>
                <ul class="page-list">
                    <li><a href="<?php echo site_url(); ?>">Home</a></li>
                    <li>Contact</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<div class="contact-list pd-top-120 pd-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="contact-list-inner">
                    <div class="media">
                        <div class="media-left">
                            <img src="<?php echo base_url() ;?>assets/images/ci1.png" alt="img">
                        </div>
                        <div class="media-body align-self-center">
                            <h5>Our Phone</h5>
                            <p>+917047156048</p>
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
                            <p>kosdigital0@gmail.com</p>
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
                            <p>2 St, Loskia, amukara.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact list end -->

<!-- counter area start -->
<div class="counter-area pd-bottom-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-title mb-0">
                    <h6 class="sub-title right-line">Get in touch</h6>
                    <h2 class="title">Write Us a Message</h2>
                    <p class="content pb-3">The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax
                        quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, </p>
                    <ul class="social-media style-base pt-3">
                        <li>
                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 mt-5 mt-lg-0">
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
                <form class="contact-form-inner  mt-5 mt-md-0" action="<?php echo site_url('contact'); ?>" method="post" id="contact-form">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-input-inner style-bg-border">
                                <input type="text" placeholder="First Name" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single-input-inner style-bg-border">
                                <input type="text" placeholder="Last Name" name="last_name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="single-input-inner style-bg-border">
                                <input type="email" placeholder="Email" name="email" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="single-input-inner style-bg-border">
                                <input type="text" placeholder="Subject" name="subject" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-input-inner style-bg-border">
                                <textarea placeholder="Message" name="message" required></textarea>
                            </div>
                        </div>
                        <p class="form-messege mb-0 mt-20 text-center"></p>
                        <div class="col-12">
                            <button type="submit" class="btn btn-base">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- counter area end -->

<!-- contact area start -->
<div class="contact-g-map pd-bottom-120">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d29208.601361499546!2d90.3598076!3d23.7803374!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1589109092857!5m2!1sen!2sbd"></iframe>
</div>
<!-- contact area end -->

<?php $this->load->view('front/footer'); ?>