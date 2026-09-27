<?php $this->load->view('front/header'); ?>

<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

<style type="text/css">
/* =========================================================
   INDEX & HERO EXCLUSIVE STYLES
   ========================================================= */
html{scroll-behavior:smooth}

/* পুরো পেজ বা বডির ব্যাকগ্রাউন্ড হালকা আকাশী কালার */
body {
    background-color: #f0fdf4 !important;
}

/* হিরো সেকশন (আগের অরিজিনাল ব্যানার ইমেজ ও লেআউট) */
.wh-hero{
    position:relative;
    min-height:600px;
    overflow:hidden;
    isolation:isolate;
    background-color:#e0f2fe;
    background-image:
        linear-gradient(90deg,
            rgba(224,242,254,.98) 0%,
            rgba(224,242,254,.95) 25%,
            rgba(224,242,254,.78) 42%,
            rgba(224,242,254,.22) 62%,
            rgba(224,242,254,0) 78%),
        url('<?php echo base_url();?>assets/images/eduction_banner.png');
    background-repeat:no-repeat;
    background-size:cover;
    background-position:center center;
}
.wh-hero-inner{
    position:relative;
    z-index:3;
    min-height:600px;
}
.wh-hero-copy{
    position:relative;
    z-index:6;
    max-width:660px;
    padding:72px 0 62px;
}
.wh-academy-pill{
    display:inline-flex;
    align-items:center;
    gap:9px;
    background:rgba(255,255,255,.82);
    border:1px solid #b8d8ff;
    color:#1762dc;
    border-radius:50px;
    padding:9px 15px;
    font-size:13px;
    font-weight:700;
    box-shadow:0 8px 25px rgba(39,91,180,.10);
    backdrop-filter:blur(12px);
}
.wh-title{
    font-size:clamp(48px,5.4vw,78px);
    line-height:.95;
    letter-spacing:-3px;
    font-weight:900;
    margin:20px 0 18px;
    color:#09234d;
}
.wh-gradient-text{
    background:linear-gradient(100deg,#087fff 0%,#4f5cff 48%,#c43bf2 100%);
    -webkit-background-clip:text;
    background-clip:text;
    -webkit-text-fill-color:transparent;
}
.wh-hero-desc{
    max-width:535px;
    color:#304e78;
    font-size:16px;
    line-height:1.72;
    margin-bottom:25px;
    font-weight:550;
}
.wh-actions{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
    margin-bottom:34px;
}
.wh-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:9px;
    min-height:48px;
    padding:0 25px;
    border-radius:28px;
    font-size:14px;
    font-weight:750;
    transition:.3s ease;
}
.wh-btn-primary{
    color:#fff!important;
    background:linear-gradient(135deg,#1769ff,#7a3ff0);
    box-shadow:0 12px 28px rgba(50,88,240,.30);
}
.wh-btn-primary:hover{transform:translateY(-3px);box-shadow:0 17px 34px rgba(50,88,240,.38)}
.wh-btn-outline{
    color:#0b2854!important;
    border:1.5px solid #91b8ef;
    background:rgba(255,255,255,.78);
    backdrop-filter:blur(10px);
}
.wh-btn-outline:hover{border-color:#5c68ef;transform:translateY(-3px)}

.wh-hero-features{
    display:flex;
    flex-wrap:nowrap;
    max-width:650px;
    border-top:1px solid rgba(79,116,165,.25);
    padding-top:20px;
}
.wh-mini-feature{
    flex:1 1 0;
    display:flex;
    align-items:center;
    gap:10px;
    min-width:0;
    padding:4px 18px 4px 0;
}
.wh-mini-feature + .wh-mini-feature{
    border-left:1px solid rgba(124,153,195,.25);
    padding-left:18px;
}
.wh-mini-icon{
    width:42px;height:42px;min-width:42px;border-radius:14px;
    display:flex;align-items:center;justify-content:center;
    background:linear-gradient(135deg,#e6f2ff,#eef0ff);
    color:#1769ff;
    box-shadow:0 6px 18px rgba(57,115,207,.10);
}
.wh-mini-feature strong{display:block;font-size:12px;color:#122e59}
.wh-mini-feature small{display:block;font-size:10px;color:#72839d;margin-top:2px}

/* Bottom Banner Strip (Trade & ISO) - Placed right above footer */
.banner-bottom-strip {
    background: linear-gradient(135deg, #0b0f19 0%, #1e1b4b 100%);
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    padding: 15px 0;
    font-size: 13px;
    color: #cbd5e1;
    box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
}
.banner-bottom-strip h5 {
    font-size: 13px;
    margin-bottom: 0;
    font-weight: 500;
    letter-spacing: 0.5px;
}
@media (max-width: 767.98px) {
    .banner-bottom-strip {
        text-align: center;
        padding: 12px 15px;
    }
    .banner-bottom-strip .row > div {
        margin-bottom: 8px;
    }
    .banner-bottom-strip .row > div:last-child {
        margin-bottom: 0;
    }
}

/* Category Cards */
.cat-item {
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.08);
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    transition: transform 0.3s ease;
}
.cat-item:hover {
    transform: translateY(-5px);
}
.cat-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(11,15,25,0.85), transparent);
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}

/* Registration / Media Info Section */
.bg-registration {
    background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%) !important;
    border-radius: 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

/* Mobile Responsive Fixes */
@media (max-width:991.98px){
    .wh-hero{
        min-height:auto;
        background-image:linear-gradient(180deg,rgba(224,242,254,.85) 0%,rgba(224,242,254,.92) 50%,#e0f2fe 100%),url('<?php echo base_url();?>assets/images/eduction_banner.png');
        background-size: cover;
        background-position: center top;
        background-repeat: no-repeat;
    }
    .wh-hero-inner{min-height:auto}
    .wh-hero-copy{
        max-width:100%;
        padding: 30px 15px 45px 15px;
        text-align:center;
        margin:0 auto;
    }
    .wh-hero-desc{margin-left:auto;margin-right:auto}
    .wh-actions{justify-content:center}
    .wh-hero-features{margin:0 auto;text-align:left; max-width: 100%;}
    .wh-mini-feature{flex:1 1 30%;padding:5px 8px}
    .wh-mini-feature + .wh-mini-feature{padding-left:10px}
    .wh-mini-icon{width:35px;height:35px;min-width:35px;font-size:13px}
    .wh-mini-feature strong{font-size:10px}
    .wh-mini-feature small{font-size:8px}
}
@media (max-width:767.98px){
    .wh-hero{
        background-image:linear-gradient(180deg,rgba(224,242,254,.85) 0%,rgba(224,242,254,.95) 55%,#e0f2fe 100%),url('<?php echo base_url();?>assets/images/eduction_banner.png');
        background-size: cover;
        background-position: center top;
        background-repeat: no-repeat;
    }
    .wh-title{font-size:36px;letter-spacing:-1.5px}
    .wh-hero-copy{padding: 25px 15px 35px}
    .wh-hero-desc{font-size:13px;line-height:1.65}
    .wh-actions{gap:8px}
    .wh-btn{min-height:44px;padding:0 18px;font-size:12px}
    .wh-hero-features{width:100%;padding-top:16px}
    .wh-mini-feature{display:block;text-align:center;flex:1 1 33.33%;padding:0 4px!important}
    .wh-mini-feature + .wh-mini-feature{border-left:1px solid rgba(124,153,195,.2)}
    .wh-mini-icon{margin:0 auto 7px}
    .wh-mini-feature strong{font-size:9px}
    .wh-mini-feature small{font-size:7px}
}
</style>

<!-- Hero Section -->
<section class="wh-hero">
    <div class="container wh-hero-inner">
        <div class="wh-hero-copy" data-aos="fade-right" data-aos-duration="800">
            <div class="wh-academy-pill mb-3">
                <span class="play"><i class="fa fa-play"></i></span> WebHaven Academy
            </div>
            <h1 class="wh-title">
                Learn, Create, <br><span class="wh-gradient-text">Earn</span>
            </h1>
            <p class="wh-hero-desc">
                WebHaven Academy একটি আধুনিক ডিজিটাল স্কিল শেখার প্ল্যাটফর্ম যেখানে অনলাইন কাজের জন্য প্রয়োজনীয় বাস্তব দক্ষতা শেখানো হয়। এখানে শিক্ষার্থীরা প্র্যাকটিক্যাল কাজের মাধ্যমে হাতে-কলমে অভিজ্ঞতা পায় এবং ডিজিটাল মার্কেটিং, কনটেন্ট ক্রিয়েশন ও AI টুল ব্যবহারে বিশেষ গুরুত্ব দেওয়া হয়। লাইভ সাপোর্ট ও মেন্টরশিপের মাধ্যমে শেখার পথ সহজ করা হয়, যাতে শেখা স্কিল ব্যবহার করে অনলাইনে আয়ের সুযোগ তৈরি করা যায়।
            </p>
            <div class="wh-actions">
                <a href="#courses" class="wh-btn wh-btn-primary">View Courses <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="wh-hero-features">
                <div class="wh-mini-feature">
                    <div class="wh-mini-icon"><i class="fa fa-user-tie"></i></div>
                    <div>
                        <strong>Expert Instructors</strong>
                        <small>Learn from pros</small>
                    </div>
                </div>
                <div class="wh-mini-feature">
                    <div class="wh-mini-icon"><i class="fa fa-infinity"></i></div>
                    <div>
                        <strong>Lifetime Access</strong>
                        <small>Study at your pace</small>
                    </div>
                </div>
                <div class="wh-mini-feature">
                    <div class="wh-mini-icon"><i class="fa fa-award"></i></div>
                    <div>
                        <strong>Certificate</strong>
                        <small>Get recognized</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">WEB HAVEN ACADEMY এর প্রধান লক্ষ্য ও উদ্দেশ্য</h5>
        </div>
        <div class="row align-items-center mb-5">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <img class="img-fluid rounded shadow-sm w-100" src="<?php echo base_url() ;?>/newassets/img/goal.jpeg" alt="">
            </div>
            <div class="col-lg-7">
                <p>Web Haven Academy-এর প্রধান লক্ষ্য হলো দেশের প্রান্তিক নারী ও শিক্ষার্থীদের দক্ষতাকে বাস্তব কাজে লাগানোর সুযোগ তৈরি করা। সমাজে বহু প্রতিভাবান নারী রয়েছেন, কিন্তু সঠিক দিকনির্দেশনা ও উপযুক্ত প্ল্যাটফর্মের অভাবে তারা নিজেদের যোগ্যতা কাজে লাগাতে পারেন না। এই একাডেমি তাদের জন্য অনলাইনভিত্তিক দক্ষতা প্রশিক্ষণ ও পার্ট-টাইম কাজের সুযোগ তৈরি করে।</p>
                <p>একই সঙ্গে, যেসব ক্ষুদ্র ব্যবসায়ী অনলাইনে নিজেদের ব্যবসা সঠিকভাবে প্রচার করতে পারেন না, Web Haven Academy তাদের জন্য ডিজিটাল প্রচার ও মার্কেটিং সহায়তা প্রদান করে। আমাদের প্রশিক্ষিত শিক্ষার্থীরাই সেই ব্যবসাগুলোর জন্য অনলাইন মার্কেটিং, কনটেন্ট তৈরি ও প্রমোশনের কাজ করে বাস্তব অভিজ্ঞতা অর্জন করে এবং আয়ের সুযোগ পায়।</p>
                <p class="mb-0">এর ফলে একদিকে নারী ও শিক্ষার্থীরা স্বাবলম্বী হয়ে ওঠে, অন্যদিকে ছোট ব্যবসাগুলো অনলাইনে পরিচিতি বৃদ্ধি ও বিক্রি বাড়ানোর সুযোগ পায়। Web Haven Academy দক্ষতা, কাজ ও ব্যবসার মধ্যে একটি কার্যকর সেতুবন্ধন গড়ে তোলার একটি উদ্যোগ।</p>
            </div>
        </div>
        <div class="row align-items-center py-5">
            <div class="col-lg-5 order-lg-2 mb-4 mb-lg-0">
                <img class="img-fluid rounded shadow-sm w-100" src="<?php echo base_url() ;?>/newassets/img/achive.jpeg" alt="">
            </div>
            <div class="col-lg-7 order-lg-1">
                <p class="mb-0">নারীদের হাতের কাজকে বিশ্ববাজারে তুলে ধরা Web Haven Academy নারীদের হাতের তৈরি বিভিন্ন পণ্য—হস্তশিল্প, সেলাই, নকশিকাঁথা, হ্যান্ডমেড জিনিস, ঘরোয়া পণ্য ইত্যাদি—অনলাইনের মাধ্যমে বৃহত্তর বাজারে পৌঁছে দিতে কাজ করবে। অনেক নারী অসাধারণ কাজ জানেন, কিন্তু সঠিক বাজার ও প্রচারণার অভাবে তারা ন্যায্য মূল্য পান না। <br/><br/>আমরা তাদের পণ্যগুলোর ছবি, কনটেন্ট, ব্র্যান্ডিং এবং সোশ্যাল মিডিয়া ও অনলাইন প্ল্যাটফর্মে প্রচারের মাধ্যমে দেশব্যাপী এবং আন্তর্জাতিক ক্রেতাদের কাছে পৌঁছে দেওয়ার ব্যবস্থা করব। এর ফলে নারীরা ঘরে বসেই নিজের দক্ষতা দিয়ে নিয়মিত আয়ের সুযোগ পাবেন এবং আর্থিকভাবে স্বাবলম্বী হতে পারবেন। এভাবে Web Haven Academy দক্ষতা, প্রযুক্তি ও বাজার—এই তিনটিকে একত্র করে নারীদের আয়ের বাস্তব পথ তৈরি করবে।</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <img class="img-fluid rounded shadow-sm w-100" src="<?php echo base_url() ;?>newassets/img/about.jpg" alt="">
            </div>
            <div class="col-lg-7">
                <div class="text-left mb-4">
                    <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">About Us</h5>
                    <h1>Learn, Create, Earn</h1>
                </div>
                <p>WebHaven Academy একটি আধুনিক ডিজিটাল স্কিল শেখার প্ল্যাটফর্ম যেখানে অনলাইন কাজের জন্য প্রয়োজনীয় বাস্তব দক্ষতা শেখানো হয়। এখানে শিক্ষার্থীরা প্র্যাকটিক্যাল কাজের মাধ্যমে হাতে-কলমে অভিজ্ঞতা পায় এবং ডিজিটাল মার্কেটিং, কনটেন্ট ক্রিয়েশন ও AI টুল ব্যবহারে বিশেষ গুরুত্ব দেওয়া হয়। লাইভ সাপোর্ট ও মেন্টরশিপের মাধ্যমে শেখার পথ সহজ করা হয়, যাতে শেখা স্কিল ব্যবহার করে অনলাইনে আয়ের সুযোগ তৈরি করা যায়। WebHaven Academy এর মূল লক্ষ্য—Learn, Create, Earn</p>
                <a href="<?php echo base_url('about');?>" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Learn More</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Media Info Section -->
<div class="container py-5">
    <div class="container bg-registration py-5 px-4 px-md-5">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-6 text-center">
                <h1 class="text-white h3 font-weight-bold">Web Haven Media Information</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3 mb-md-0 text-center">
                <div class="p-4 rounded" style="background: rgba(255,255,255,0.08);">
                    <h4 class="text-white h5 mb-3">Subscribe Youtube Channel</h4>
                    <?php if($this->session->userdata('id')){ ?>
                    <a class="btn btn-primary px-4" onclick="gotolink('<?php echo $this->session->userdata('id') ?>', 'https://youtube.com/@webhavenacademy-p1y', 'youtube');">Subscribe</a>
                    <?php }else{ ?>
                    <a class="btn btn-primary px-4" href="https://youtube.com/@webhavenacademy-p1y" target="_blank">Subscribe</a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="p-4 rounded" style="background: rgba(255,255,255,0.08);">
                    <h4 class="text-white h5 mb-3">Join Facebook Group</h4>
                    <?php if($this->session->userdata('id')){ ?>
                    <a class="btn btn-primary px-4" onclick="gotolink('<?php echo $this->session->userdata('id') ?>', 'https://www.facebook.com/share/1CCgfmjC7C/', 'facebook');">Follow</a>
                    <?php }else{ ?>
                    <a class="btn btn-primary px-4" href="https://www.facebook.com/share/1CCgfmjC7C/" target="_blank">Follow</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>  
</div>  

<!-- Category Start -->
<div class="container-fluid pt-5 pb-5">
    <div class="container">
        <div class="text-center mb-5">
            <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">FEATURES</h5>
            <h1>An exemplary <br> learning community</h1>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="cat-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid w-100" src="<?php echo base_url() ;?>newassets/img/cat-1.jpg" alt="" style="height: 230px; object-fit: cover;">
                    <a class="cat-overlay text-white text-decoration-none" href="">
                        <h4 class="text-white font-weight-medium">COURSES</h4>
                        <span class="text-warning font-weight-bold">13+ COURSES</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="cat-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid w-100" src="<?php echo base_url() ;?>newassets/img/cat-2.jpg" alt="" style="height: 230px; object-fit: cover;">
                    <a class="cat-overlay text-white text-decoration-none" href="">
                        <h4 class="text-white font-weight-medium">STUDENTS SUPPORT</h4>
                        <span class="text-warning font-weight-bold">At 8:00am-11:00pm×7days</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="cat-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid w-100" src="<?php echo base_url() ;?>newassets/img/cat-3.jpg" alt="" style="height: 230px; object-fit: cover;">
                    <a class="cat-overlay text-white text-decoration-none" href="">
                        <h4 class="text-white font-weight-medium">OPPORTUNITY</h4>
                        <span class="text-warning font-weight-bold">LIFE TIME OPPORTUNITY</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Category End -->

<!-- Courses Start (Detailed Grid with Image Cards) -->
<div class="container-fluid py-5 bg-light" id="courses">
    <div class="container py-3">
        <div class="text-center mb-5">
            <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Courses</h5>
            <h1>Our Popular Courses</h1>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="rounded overflow-hidden mb-2 bg-white shadow-sm border">
                    <img class="img-fluid w-100" src="<?php echo base_url() ;?>newassets/img/course-1.jpg" alt="" style="height: 200px; object-fit: cover;">
                    <div class="p-4">
                        <a class="h5 text-dark font-weight-bold" href="javascript:void();">DIGITAL MARKETING</a>
                        <div class="border-top mt-4 pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.6 <small class="text-muted">(560)</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="rounded overflow-hidden mb-2 bg-white shadow-sm border">
                    <img class="img-fluid w-100" src="<?php echo base_url() ;?>newassets/img/course-2.jpg" alt="" style="height: 200px; object-fit: cover;">
                    <div class="p-4">
                        <a class="h5 text-dark font-weight-bold" href="javascript:void();">SPOKEN ENGLISH</a>
                        <div class="border-top mt-4 pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.7 <small class="text-muted">(670)</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="rounded overflow-hidden mb-2 bg-white shadow-sm border">
                    <img class="img-fluid w-100" src="<?php echo base_url() ;?>newassets/img/course-3.jpg" alt="" style="height: 200px; object-fit: cover;">
                    <div class="p-4">
                        <a class="h5 text-dark font-weight-bold" href="javascript:void();">RESELLING</a>
                        <div class="border-top mt-4 pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small class="text-muted">(500)</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="rounded overflow-hidden mb-2 bg-white shadow-sm border">
                    <img class="img-fluid w-100" src="<?php echo base_url() ;?>newassets/img/course-4.jpg" alt="" style="height: 200px; object-fit: cover;">
                    <div class="p-4">
                        <a class="h5 text-dark font-weight-bold" href="javascript:void();">PHOTO MAKING</a>
                        <div class="border-top mt-4 pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small class="text-muted">(750)</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="rounded overflow-hidden mb-2 bg-white shadow-sm border">
                    <img class="img-fluid w-100" src="<?php echo base_url() ;?>newassets/img/course-5.jpg" alt="" style="height: 200px; object-fit: cover;">
                    <div class="p-4">
                        <a class="h5 text-dark font-weight-bold" href="javascript:void();">VIDEO MAKING</a>
                        <div class="border-top mt-4 pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small class="text-muted">(450)</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="rounded overflow-hidden mb-2 bg-white shadow-sm border">
                    <img class="img-fluid w-100" src="<?php echo base_url() ;?>newassets/img/course-6.jpg" alt="" style="height: 200px; object-fit: cover;">
                    <div class="p-4">
                        <a class="h5 text-dark font-weight-bold" href="javascript:void();">DATA ENTRY</a>
                        <div class="border-top mt-4 pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small class="text-muted">(250)</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Courses End -->

<!-- Trade Licence & ISO Certificate Strip (Right above footer) -->
<div class="banner-bottom-strip">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 Trade_licence mb-2 mb-md-0 text-center text-md-left">
                <h5><i class="fa fa-shield-alt text-primary mr-1"></i> Trade licence no: <span class="text-white font-weight-bold">SSNOCIAEI67918439N</span></h5>
            </div>
            <div class="col-md-6 ISO_Certificate text-center text-md-right">
                <h5><i class="fa fa-certificate text-warning mr-1"></i> ISO Certificate No.: <span class="text-white font-weight-bold">WHA/QMS/IND/2026/0214-7789</span></h5>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Libraries & Toggle Script -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ once: true, offset: 80, duration: 800 });

  // মোবাইল মেনু টগল ও বাইরে ক্লিক করলে অটো ক্লোজ হওয়ার ফাংশন
  $(document).ready(function () {
      $('.navbar-toggler').on('click', function (e) {
          e.stopPropagation();
          $('#navbarCollapse').collapse('toggle');
      });

      // মেনুর বাইরে যেকোনো জায়গায় ক্লিক করলে ড্রপডাউন বন্ধ হয়ে যাবে
      $(document).on('click', function (e) {
          if (!$(e.target).closest('.navbar').length) {
              $('#navbarCollapse').collapse('hide');
          }
      });

      // মেনুর ভেতরে কোনো লিঙ্কে ক্লিক করলেও মেনু বন্ধ হয়ে যাবে
      $('.navbar-nav a').on('click', function () {
          $('#navbarCollapse').collapse('hide');
      });
  });
</script>

<?php $this->load->view('front/footer'); ?>
