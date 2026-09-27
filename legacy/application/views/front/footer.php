<!-- =========================
     WEBHAVEN PREMIUM FOOTER
========================= -->

<style>
/* Footer Main */
.wh-footer {
    position: relative;
    background:
        radial-gradient(circle at 10% 20%, rgba(59,130,246,.12), transparent 28%),
        radial-gradient(circle at 90% 10%, rgba(168,85,247,.14), transparent 30%),
        radial-gradient(circle at 50% 100%, rgba(14,165,233,.08), transparent 35%),
        #070b14;
    color: #fff;
    overflow: hidden;
    border-top: 1px solid rgba(255,255,255,.08);
}

/* Animated top glow */
.wh-footer::before {
    content: "";
    position: absolute;
    top: 0;
    left: 5%;
    width: 90%;
    height: 1px;
    background: linear-gradient(
        90deg,
        transparent,
        #38bdf8,
        #8b5cf6,
        #d946ef,
        #38bdf8,
        transparent
    );
    opacity: .9;
}

/* Decorative blurred lights */
.wh-footer::after {
    content: "";
    position: absolute;
    width: 280px;
    height: 280px;
    right: -120px;
    bottom: -160px;
    border-radius: 50%;
    background: rgba(124,58,237,.15);
    filter: blur(70px);
    pointer-events: none;
}

/* Footer container */
.wh-footer-inner {
    position: relative;
    z-index: 2;
    padding: 70px 0 35px;
}

/* Brand section */
.wh-footer-brand {
    padding-right: 30px;
}

.wh-footer-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #a78bfa;
    margin-bottom: 15px;
}

.wh-footer-label::before {
    content: "";
    width: 28px;
    height: 2px;
    border-radius: 10px;
    background: linear-gradient(90deg,#38bdf8,#8b5cf6);
}

.wh-footer-brand h3 {
    font-size: 28px;
    font-weight: 800;
    margin-bottom: 15px;
    background: linear-gradient(
        90deg,
        #ffffff,
        #c4b5fd,
        #67e8f9
    );
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.wh-footer-description {
    color: #94a3b8;
    font-size: 14px;
    line-height: 1.9;
    max-width: 470px;
}

/* Logo */
.wh-footer-logo {
    margin-top: 22px;
    display: inline-flex;
    align-items: center;
    padding: 9px 14px;
    border-radius: 14px;
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.08);
    backdrop-filter: blur(12px);
}

.wh-footer-logo img {
    width: 180px !important;
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}

/* Footer columns */
.wh-footer-column {
    height: 100%;
}

.wh-footer-heading {
    color: #ffffff;
    font-size: 15px;
    font-weight: 800;
    margin-bottom: 22px;
    position: relative;
    padding-bottom: 10px;
}

.wh-footer-heading::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 35px;
    height: 2px;
    border-radius: 10px;
    background: linear-gradient(90deg,#3b82f6,#a855f7);
}

/* Contact */
.wh-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 15px;
    color: #94a3b8;
    font-size: 14px;
    line-height: 1.6;
}

.wh-contact-icon {
    width: 34px;
    height: 34px;
    min-width: 34px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    background: linear-gradient(135deg,#2563eb,#7c3aed);
    box-shadow: 0 8px 20px rgba(79,70,229,.25);
}

/* Course links */
.wh-footer-links a {
    position: relative;
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 7px 0;
    color: #94a3b8 !important;
    text-decoration: none !important;
    font-size: 14px;
    transition: all .25s ease;
}

.wh-footer-links a i {
    color: #8b5cf6;
    transition: transform .25s ease;
}

.wh-footer-links a:hover {
    color: #ffffff !important;
    transform: translateX(5px);
}

.wh-footer-links a:hover i {
    transform: translateX(3px);
}

/* Social */
.wh-social-title {
    margin-top: 24px;
    margin-bottom: 12px;
    color: #cbd5e1;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.wh-social {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.wh-social a {
    width: 42px;
    height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 13px;
    color: #fff !important;
    text-decoration: none !important;
    border: 1px solid rgba(255,255,255,.10);
    background: rgba(255,255,255,.06);
    backdrop-filter: blur(10px);
    transition: all .3s ease;
}

.wh-social a:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 12px 25px rgba(59,130,246,.25);
}

.wh-facebook:hover {
    background: #1877f2 !important;
}

.wh-youtube:hover {
    background: #ff0000 !important;
}

/* MSME */
.wh-msme {
    margin-top: 22px;
    padding: 13px 15px;
    border-radius: 14px;
    background: linear-gradient(
        135deg,
        rgba(59,130,246,.08),
        rgba(168,85,247,.10)
    );
    border: 1px solid rgba(255,255,255,.08);
}

.wh-msme-title {
    color: #64748b;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 1.3px;
    margin-bottom: 4px;
}

.wh-msme-number {
    color: #f8fafc;
    font-size: 12px;
    font-weight: 700;
    word-break: break-word;
}

.wh-msme-number span {
    color: #fbbf24;
}

/* Bottom Footer */
.wh-footer-bottom {
    position: relative;
    z-index: 3;
    background: rgba(2,6,23,.65);
    border-top: 1px solid rgba(255,255,255,.07);
    padding: 20px 0;
    backdrop-filter: blur(12px);
}

.wh-footer-bottom p {
    margin: 0;
    color: #64748b;
    font-size: 13px;
}

.wh-footer-bottom a {
    color: #c4b5fd !important;
    text-decoration: none !important;
    font-weight: 700;
}

.wh-footer-policy {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 14px;
}

.wh-footer-policy a {
    color: #64748b !important;
    font-size: 13px;
    transition: color .25s ease;
}

.wh-footer-policy a:hover {
    color: #c4b5fd !important;
}

.wh-footer-divider {
    color: #334155;
}

/* Back to Top */
.wh-back-top {
    position: fixed;
    right: 22px;
    bottom: 22px;
    z-index: 9999;

    width: 48px;
    height: 48px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 15px !important;
    color: #fff !important;
    border: 1px solid rgba(255,255,255,.18) !important;

    background: linear-gradient(
        135deg,
        #2563eb,
        #7c3aed,
        #d946ef
    ) !important;

    box-shadow:
        0 12px 30px rgba(79,70,229,.35),
        0 0 25px rgba(139,92,246,.18);

    transition: all .3s ease;
}

.wh-back-top:hover {
    transform: translateY(-5px);
    box-shadow:
        0 18px 35px rgba(79,70,229,.45),
        0 0 35px rgba(168,85,247,.25);
}

/* Mobile */
@media (max-width: 767.98px) {

    .wh-footer-inner {
        padding: 50px 20px 25px;
    }

    .wh-footer-brand {
        padding-right: 0;
        margin-bottom: 35px;
    }

    .wh-footer-brand h3 {
        font-size: 24px;
    }

    .wh-footer-description {
        font-size: 13px;
    }

    .wh-footer-column {
        margin-bottom: 30px;
    }

    .wh-footer-heading {
        margin-bottom: 16px;
    }

    .wh-footer-bottom {
        padding: 20px 15px;
    }

    .wh-footer-bottom p {
        text-align: center;
        line-height: 1.7;
    }

    .wh-footer-policy {
        justify-content: center;
        margin-top: 12px;
    }

    .wh-back-top {
        width: 44px;
        height: 44px;
        right: 15px;
        bottom: 15px;
        border-radius: 13px !important;
    }
}

@media (max-width: 380px) {

    .wh-footer-inner {
        padding-left: 15px;
        padding-right: 15px;
    }

    .wh-footer-brand h3 {
        font-size: 21px;
    }

    .wh-social a {
        width: 39px;
        height: 39px;
    }

    .wh-msme-number {
        font-size: 10px;
    }
}
</style>


<!-- =========================
     FOOTER
========================= -->

<footer class="wh-footer">

    <div class="container wh-footer-inner">

        <div class="row">

      
            <!-- CONTACT -->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">

                <div class="wh-footer-column">

                    <h5 class="wh-footer-heading">
                        Get In Touch
                    </h5>

                    <div class="wh-contact-item">

                        <div class="wh-contact-icon">
                            <i class="fa fa-envelope"></i>
                        </div>

                        <div>
                            Webhaven755@gmail.com
                        </div>

                    </div>


                    <div class="wh-contact-item">

                        <div class="wh-contact-icon">
                            <i class="fa fa-globe"></i>
                        </div>

                        <div>
                            WebHaven Academy
                        </div>

                    </div>


                    <!-- SOCIAL -->
                    <div class="wh-social-title">
                        Follow Us
                    </div>

                    <div class="wh-social">

                        <a
                            href="https://www.facebook.com/share/187Y7auCCZ/"
                            target="_blank"
                            class="wh-facebook"
                            aria-label="Facebook"
                        >
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <a
                            href="https://youtube.com/@webhavenacademy-p1y?si=YIi5dWdDzg7z6vaU"
                            target="_blank"
                            class="wh-youtube"
                            aria-label="YouTube"
                        >
                            <i class="fab fa-youtube"></i>
                        </a>

                    </div>


                    <!-- MSME -->
                    <div class="wh-msme">

                        <div class="wh-msme-title">
                            Official Registration
                        </div>

                        <div class="wh-msme-number">
                            <i class="fa fa-certificate mr-1"
                               style="color:#38bdf8;"></i>

                            MSME:
                            <span>
                                UDYAM-WB-15-0134063
                            </span>
                        </div>

                    </div>

                </div>

            </div>


            <!-- COURSES -->
            <div class="col-lg-4 col-md-6">

                <div class="wh-footer-column">

                    <h5 class="wh-footer-heading">
                        Our Courses
                    </h5>

                    <div class="wh-footer-links">

                        <a href="#">
                            <i class="fa fa-angle-right"></i>
                            Photo Making
                        </a>

                        <a href="#">
                            <i class="fa fa-angle-right"></i>
                            Video Editing
                        </a>

                        <a href="#">
                            <i class="fa fa-angle-right"></i>
                            Reference Joining
                        </a>

                        <a href="#">
                            <i class="fa fa-angle-right"></i>
                            Graphic Design
                        </a>

                        <a href="#">
                            <i class="fa fa-angle-right"></i>
                            Digital Marketing
                        </a>

                        <a href="#">
                            <i class="fa fa-angle-right"></i>
                            Freelancing & Online Earning
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================
         COPYRIGHT
    ========================= -->

    <div class="wh-footer-bottom">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-7 text-center text-lg-left">

                    <p>
                        &copy; <?php echo date('Y'); ?>

                        <a href="<?php echo base_url(); ?>">
                            WEB HAVEN ACADEMY
                        </a>

                        . All Rights Reserved.
                    </p>

                </div>


                <div class="col-lg-5">

                    <div class="wh-footer-policy">

                        <a href="<?php echo base_url('privacy'); ?>">
                            Privacy Policy
                        </a>

                        <span class="wh-footer-divider">
                            |
                        </span>

                        <a href="<?php echo base_url('termsconditions'); ?>">
                            Terms & Conditions
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</footer>


<!-- =========================
     BACK TO TOP
========================= -->

<a
    href="#"
    class="wh-back-top"
    aria-label="Back to top"
>
    <i class="fa fa-angle-up"></i>
</a>


<!-- =========================
     JAVASCRIPT
========================= -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo base_url(); ?>newassets/lib/easing/easing.min.js"></script>

<script src="<?php echo base_url(); ?>newassets/lib/owlcarousel/owl.carousel.min.js"></script>

<script src="<?php echo base_url(); ?>newassets/js/main.js"></script>

</body>
</html>