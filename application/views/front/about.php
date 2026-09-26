<?php $this->load->view('front/header'); ?>

<style type="text/css">
	
	:root{
    --whm-primary:#0f3e98;
    --whm-accent:#28a745;
    --whm-text:#555;
    --whm-dark:#111;
    --whm-bg:#F7F9FC;
}

h1, h2{
	color: #FFF;
}

section{
    padding:100px 0;
}

.whm-heading-center{
    text-align:center;
    margin-bottom:60px;
}

.whm-heading-center span,
.whm-section-title span{
    color:var(--whm-accent);
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:1px;
}

.whm-heading-center h2,
.whm-section-title h2{
    font-size:42px;
    font-weight:700;
    margin-top:10px;
    color:var(--whm-dark);
}

.whm-about-hero{
    background-color: #0a3993;
    color: #fff;
    text-align: center;
    padding: 140px 0;
    background-image: url(https://webhavenmedia.com/newassets/img/about.jpg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    background-blend-mode: soft-light;
}

.whm-about-hero h1{
    font-size:60px;
    font-weight:800;
    margin:20px 0;
}

.whm-about-hero p{
    max-width:700px;
    margin:auto;
    font-size:18px;
    line-height:1.8;
}

.whm-badge{
    background:rgba(255,255,255,.15);
    padding:10px 25px;
    border-radius:50px;
}

.whm-btn-group{
    margin-top:40px;
}

.whm-btn-primary,
.whm-btn-outline{
    display:inline-block;
    padding:14px 35px;
    border-radius:50px;
    text-decoration:none;
    margin:0 10px;
    font-weight:600;
}

.whm-btn-primary{
    background:var(--whm-accent);
    color:#fff;
}

.whm-btn-primary:hover{
	background-color: #FFF;
	color: #000;
	text-decoration: none;
}

.whm-btn-outline{
    border:2px solid #fff;
    color:#fff;
    text-decoration: none;
}

.whm-btn-outline:hover{
	background-color: #FFF;
	color: #000;
	text-decoration: none;
}

.whm-about-image img{
    width:100%;
    border-radius:20px;
}

.whm-about-story p{
    color:var(--whm-text);
    line-height:1.9;
}

.whm-mission-vision{
    background-color:var(--whm-bg);
    background-repeat: repeat;
    background-position: center;
    background-size: 65%;
    background-blend-mode: multiply;
}

.whm-card{
    background:#fff;
    padding:40px;
    border-radius:20px;
    height:100%;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.whm-card h3{
    margin-bottom:20px;
}

.whm-values{
    text-align:center;
}

.whm-value-box{
    padding:40px;
    background:#fff;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.whm-counter-section{
    background:linear-gradient(135deg,#1267c2,#0e388a);
}

.whm-counter-box{
    text-align:center;
    color:#fff;
}

.whm-counter-box h3{
    font-size:52px;
    font-weight:800;
    color: #FFF;
}

.whm-counter-box p{
    margin:0;
}

.whm-cta-box{
    color:#fff;
    text-align:center;
    padding:80px;
    border-radius:30px;
}

.whm-cta-box h2{
    font-size:48px;
    margin-bottom:20px;
}

.whm-cta-box p{
    max-width:700px;
    margin:0 auto 30px;
}

</style>

<section class="whm-about-hero">
    <div class="container">
        <div class="whm-about-hero-content">
            <span class="whm-badge">ওয়েবহ্যাভেন একাডেমি</span>
            <h1>ডিজিটাল দক্ষতায় গড়ুন আপনার ভবিষ্যৎ</h1>
            <p>
                আমরা বিশ্বাস করি সঠিক প্রশিক্ষণ, সঠিক দিকনির্দেশনা এবং বাস্তব অভিজ্ঞতা
                একজন শিক্ষার্থীর জীবন পরিবর্তন করতে পারে।
            </p>

            <div class="whm-btn-group">
                <a href="https://webhavenmedia.com/courses" class="whm-btn-primary">কোর্স দেখুন</a>
                <a href="https://webhavenmedia.com/register" class="whm-btn-outline">যোগাযোগ করুন</a>
            </div>
        </div>
    </div>
</section>


<section class="whm-about-story">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6">
                <div class="whm-about-image">
                    <img src="<?php echo base_url() ;?>newassets/img/about-pic.jpg" alt="">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="whm-section-title">
                    <span>আমাদের সম্পর্কে</span>
                    <h2>শেখা থেকে আয়ের পথে আপনার বিশ্বস্ত সঙ্গী</h2>
                </div>

                <p>
                    ওয়েবহ্যাভেন একাডেমি একটি আধুনিক ডিজিটাল শিক্ষা প্ল্যাটফর্ম,
                    যেখানে শিক্ষার্থীরা বাস্তবমুখী দক্ষতা অর্জনের মাধ্যমে
                    ফ্রিল্যান্সিং, ডিজিটাল মার্কেটিং, কনটেন্ট ক্রিয়েশন এবং
                    অনলাইন ব্যবসার সুযোগ তৈরি করতে পারে।
                </p>

                <p>
                    আমাদের লক্ষ্য শুধুমাত্র কোর্স করানো নয়,
                    বরং একজন শিক্ষার্থীকে দক্ষ ও আত্মবিশ্বাসী করে তোলা।
                </p>
            </div>

        </div>
    </div>
</section>


<section class="whm-mission-vision" style="background-image: url(<?php echo base_url() ;?>newassets/img/school_items-bg.jpg);">
    <div class="container">

        <div class="whm-heading-center">
            <span>আমাদের লক্ষ্য</span>
            <h2>ভিশন ও মিশন</h2>
        </div>

        <div class="row">

            <div class="col-lg-6">
                <div class="whm-card">
                    <h3>আমাদের মিশন</h3>
                    <p>
                        আধুনিক ডিজিটাল দক্ষতা সবার জন্য সহজলভ্য করা এবং
                        শিক্ষার্থীদের কর্মমুখী প্রশিক্ষণের মাধ্যমে
                        আয় ও ক্যারিয়ারের সুযোগ তৈরি করা।
                    </p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="whm-card">
                    <h3>আমাদের ভিশন</h3>
                    <p>
                        বাংলাদেশের অন্যতম বিশ্বস্ত ডিজিটাল শিক্ষা ও
                        দক্ষতা উন্নয়ন প্ল্যাটফর্ম হিসেবে প্রতিষ্ঠিত হওয়া।
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="whm-values">
    <div class="container">

        <div class="whm-heading-center">
            <span>আমাদের দর্শন</span>
            <h2>Learn • Create • Earn</h2>
        </div>

        <div class="row">

            <div class="col-lg-4">
                <div class="whm-value-box">
                    <h3>শিখুন</h3>
                    <p>প্রয়োজনীয় ডিজিটাল দক্ষতা অর্জন করুন।</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="whm-value-box">
                    <h3>তৈরি করুন</h3>
                    <p>বাস্তব প্রজেক্টের মাধ্যমে অভিজ্ঞতা অর্জন করুন।</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="whm-value-box">
                    <h3>আয় করুন</h3>
                    <p>ফ্রিল্যান্সিং ও অনলাইন কাজের মাধ্যমে আয় শুরু করুন।</p>
                </div>
            </div>

        </div>

    </div>
</section>


<section class="whm-counter-section">
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <div class="whm-counter-box">
                    <h3>২,৫০০+</h3>
                    <p>শিক্ষার্থী</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="whm-counter-box">
                    <h3>৫০০+</h3>
                    <p>লাইভ সেশন</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="whm-counter-box">
                    <h3>১৩+</h3>
                    <p>কোর্স</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="whm-counter-box">
                    <h3>৫,০০০+</h3>
                    <p>কমিউনিটি সদস্য</p>
                </div>
            </div>

        </div>

    </div>
</section>


<section class="whm-cta-section" style="background-color: #0e5e53; background-image: url(<?php echo base_url() ;?>newassets/img/page-header.jpg); background-repeat: no-repeat; background-position: center center;
    background-size: cover;
    margin-bottom: 60px;
    background-blend-mode: soft-light;">
    <div class="container">
        <div class="whm-cta-box">
            <h2>আজই শুরু করুন আপনার ডিজিটাল যাত্রা</h2>
            <p>
                দক্ষতা অর্জন করুন, আত্মবিশ্বাস বাড়ান এবং
                নিজের জন্য নতুন সম্ভাবনার দরজা খুলুন।
            </p>

            <a href="https://webhavenmedia.com/register" class="whm-btn-primary">
                এখনই যুক্ত হোন
            </a>
        </div>
    </div>
</section>

<!-- About Start -->
<div class="container-fluid" style="padding-bottom: 60px;">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-sm-6 text-center"><h5>Trade licence no:SSNOCIAEI67918439N</h5></div>
			<div class="col-sm-6 text-center"><h5>ISO Certificate No.: WHA/QMS/IND/2026/0214-7789</h5></div>
		</div>
	</div>
</div>
<!-- About End -->
<?php $this->load->view('front/footer'); ?>