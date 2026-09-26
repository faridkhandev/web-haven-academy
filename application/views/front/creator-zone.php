<?php $this->load->view('front/header'); ?>

<style>
.creator-zone-section{
    background:#f8f9fa;
}

.section-title{
    font-size:42px;
    font-weight:700;
    color:#222;
    margin-bottom:15px;
}

.section-desc{
    max-width:700px;
    margin:0 auto;
    color:#666;
    font-size:16px;
}

.creator-card{
    background:#fff;
    padding:40px 30px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    transition:0.3s;
    height:100%;
}

.creator-card:hover{
    transform:translateY(-10px);
}

.creator-icon{
    width:90px;
    height:90px;
    line-height:90px;
    border-radius:50%;
    margin:0 auto 25px;
    font-size:38px;
    color:#fff;
}

.facebook{
    background:#1877F2;
}

.instagram{
    background:linear-gradient(
        45deg,
        #f09433,
        #e6683c,
        #dc2743,
        #cc2366,
        #bc1888
    );
}

.whatsapp{
    background:#25D366;
}

.creator-card h3{
    font-size:24px;
    font-weight:600;
    margin-bottom:15px;
}

.creator-card p{
    color:#666;
    line-height:1.8;
    margin-bottom:25px;
}

.creator-btn{
    display:inline-block;
    padding:12px 28px;
    background:#0d6efd;
    color:#fff;
    border-radius:50px;
    text-decoration:none;
    transition:0.3s;
}

.creator-btn:hover{
    background:#084298;
    color:#fff;
    text-decoration:none;
}
</style>

<div class="container-fluid page-header" >
    <div class="container">
        <div class="d-flex flex-column justify-content-center" style="min-height:300px">
            <h3 class="display-4 text-white text-uppercase">
                Creator Zone
            </h3>

            <div class="d-inline-flex text-white">
                <p class="m-0 text-uppercase">
                    <a class="text-white" href="<?php echo base_url();?>">
                        Home
                    </a>
                </p>

                <i class="fa fa-angle-double-right pt-1 px-3"></i>

                <p class="m-0 text-uppercase">
                    Creator Zone
                </p>
            </div>
        </div>
    </div>
</div>

<section class="creator-zone-section py-5">
    <div class="container">
        
        <div class="text-center mb-5">
            <h2 class="section-title">Connect With Us</h2>
            <p class="section-desc">
                Choose your favorite platform and become part of the Web Haven Media creator community.
            </p>
        </div>

        <div class="row">

            <!-- Facebook -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="creator-card text-center">
                    <div class="creator-icon facebook">
                        <i class="fab fa-facebook-f"></i>
                    </div>

                    <h3>Facebook Community</h3>

                    <p>
                        Join our Facebook community and connect with creators,
                        students, and professionals.
                    </p>

                    <a href="https://facebook.com/" target="_blank" class="creator-btn">
                        Join on Facebook
                    </a>
                </div>
            </div>

            <!-- Instagram -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="creator-card text-center">
                    <div class="creator-icon instagram">
                        <i class="fab fa-instagram"></i>
                    </div>

                    <h3>Instagram Updates</h3>

                    <p>
                        Follow us on Instagram for creative inspiration,
                        updates, and exclusive content.
                    </p>

                    <a href="https://instagram.com/" target="_blank" class="creator-btn">
                        Follow on Instagram
                    </a>
                </div>
            </div>

            <!-- WhatsApp -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="creator-card text-center">
                    <div class="creator-icon whatsapp">
                        <i class="fab fa-whatsapp"></i>
                    </div>

                    <h3>WhatsApp Support</h3>

                    <p>
                        Message us on WhatsApp for quick support,
                        inquiries, and collaboration opportunities.
                    </p>

                    <a href="https://wa.me/919999999999" target="_blank" class="creator-btn">
                        Chat on WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<?php $this->load->view('front/footer'); ?>z