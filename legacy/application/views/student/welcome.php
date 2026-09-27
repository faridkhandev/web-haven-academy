<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome | Student Panel - Web Haven Media</title>
<link rel="icon" href="https://webhavenmedia.com/favicon.ico">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome 6 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<!-- Lightbox (Photo Zoon) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">



<style>
:root{
  --bg1:#0f2027;
  --bg2:#203a43;
  --bg3:#2c5364;
  --glass: rgba(255,255,255,.10);
  --glass-border: rgba(255,255,255,.16);
  --accent:#ffc107;
  --text-soft: rgba(255,255,255,.78);
}

body{
  background: linear-gradient(135deg,var(--bg1),var(--bg2),var(--bg3));
  color:#fff;
  font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
  min-height: 100vh;
}

a{ text-decoration:none; }
.text-soft{ color: var(--text-soft) !important; }

.topbar{
  background: rgba(0,0,0,.35);
  border-bottom: 1px solid rgba(255,255,255,.08);
  position: sticky;
  top: 0;
  z-index: 10;
  backdrop-filter: blur(10px);
}

.brand-title{
  font-weight: 800;
  letter-spacing:.3px;
}

.hero{
  padding: 48px 0 24px;
}

.hero .badge{
  background: rgba(255,193,7,.15);
  border: 1px solid rgba(255,193,7,.35);
  color: var(--accent);
}

.section-title{
  margin: 44px 0 18px;
  display:flex;
  align-items:center;
  justify-content: space-between;
  gap: 12px;
}
.section-title h2{
  font-size: 22px;
  font-weight: 800;
  margin: 0;
}
.section-title .line{
  flex: 1;
  height: 1px;
  background: rgba(255,255,255,.15);
}

.card-glass{
  background: var(--glass);
  border: 1px solid var(--glass-border);
  border-radius: 18px;
  backdrop-filter: blur(12px);
  box-shadow: 0 18px 45px rgba(0,0,0,.25);
}
.card-glass:hover{
  transform: translateY(-3px);
  transition: .25s ease;
  box-shadow: 0 22px 55px rgba(0,0,0,.32);
}

.btn-accent{
  background: var(--accent);
  color: #111;
  border: none;
  border-radius: 999px;
  font-weight: 700;
  padding: 10px 18px;
}
.btn-accent:hover{ background:#ffb300; }

.btn-soft{
  background: rgba(255,255,255,.12);
  color:#fff;
  border: 1px solid rgba(255,255,255,.18);
  border-radius: 999px;
  font-weight: 700;
  padding: 10px 18px;
}
.btn-soft:hover{ background: rgba(255,255,255,.18); color:#fff; }

.pill{
  display:inline-flex;
  align-items:center;
  gap:10px;
  padding: 12px 14px;
  border-radius: 14px;
  background: rgba(255,255,255,.10);
  border: 1px solid rgba(255,255,255,.14);
}

.icon-circle{
  width: 44px; height: 44px;
  display:grid; place-items:center;
  border-radius: 14px;
  background: rgba(255,193,7,.18);
  border: 1px solid rgba(255,193,7,.28);
  color: var(--accent);
}

.profile-img{
  width:100%;
  height: 320px;
  object-fit: cover;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.16);
}

.small-meta{
  font-size: 13px;
  color: var(--text-soft);
}

.kpi{
  display:flex;
  gap: 12px;
  align-items:center;
}
.kpi .kpi-title{
  font-weight: 800;
  margin: 0;
}
.kpi .kpi-sub{
  margin: 0;
  font-size: 13px;
  color: var(--text-soft);
}

.notice{
  border-left: 4px solid var(--accent);
}

.gallery-img{
  width:100%;
  height: 180px;
  object-fit: cover;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.14);
}

footer{
  margin-top: 70px;
  padding: 28px 0;
  background: rgba(0,0,0,.35);
  border-top: 1px solid rgba(255,255,255,.08);
}
footer a{ color: rgba(255,255,255,.85); }
footer a:hover{ color: #fff; }

</style>
</head>

<body>

<!-- TOPBAR -->
<div class="topbar py-3">
  <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
    <div class="d-flex align-items-center gap-2">
      <i class="fa-solid fa-graduation-cap text-warning"></i>
      <div>
        <div class="brand-title">Welcome to Student Panel</div>
        <div class="small-meta">Web Haven Media • Learn • Grow • Earn</div>
      </div>
    </div>

    <div class="d-flex gap-2">
      <a class="btn btn-soft" href="<?php echo base_url('student/dashboard'); ?>">
        <i class="fa-solid fa-user me-2"></i> Student Profile
      </a>
      <a class="btn btn-accent" target="_blank" href="https://www.facebook.com/profile.php?id=100094887172397">
        <i class="fa-brands fa-facebook me-2"></i> Teacher FB
      </a>
    </div>
  </div>
</div>
<?php if($student['student_status'] == 1){ ?>
<!-- HERO -->
<div class="hero">
  <div class="container">
    <div class="card card-glass p-4 p-md-5">
      <div class="row align-items-center g-4">
        <div class="col-lg-8">
          <span class="badge rounded-pill px-3 py-2 mb-3">
            <i class="fa-solid fa-circle-info me-2"></i> Student Dashboard
          </span>
          <h1 class="mb-2" style="font-weight:900;">Your Growth Hub</h1>
          <p class="text-soft mb-0">
            Access courses, important updates, top performers, meetings, photo gallery, and support links — all in one place.
          </p>
        </div>
        <div class="col-lg-4">
          <div class="d-flex flex-column gap-2">
            
              <a class="btn btn-accent w-100" href="<?php echo base_url('student/ourcourse'); ?>">
                <i class="fa-solid fa-book-open me-2"></i> Our Course
              </a>
           
            <a class="btn btn-soft w-100" href="<?php echo base_url('student/dashboard'); ?>">
              <i class="fa-solid fa-id-card me-2"></i> Go To Student Profile
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <?php } ?>

<div class="container">
<?php if($student['student_status'] == 1){ ?>
  <!-- QUICK LINKS: Help line & Town hall -->
  <div class="row g-3">
    <div class="col-md-6">
      <div class="card card-glass p-3">
        <div class="pill">
          <div class="icon-circle"><i class="fa-solid fa-headset"></i></div>
          <div class="flex-grow-1">
            <div class="kpi-title">Help line</div>
            <div class="kpi-sub">Support & assistance</div>
          </div>
          <?php if($helpline_link != ''){ ?>
            <a class="btn btn-accent" href="<?php echo $helpline_link; ?>">Click Here</a>
          <?php } else { ?>
            <span class="badge rounded-pill text-bg-secondary">Upcoming</span>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card card-glass p-3">
        <div class="pill">
          <div class="icon-circle"><i class="fa-solid fa-people-group"></i></div>
          <div class="flex-grow-1">
            <div class="kpi-title">Town hall Meeting</div>
            <div class="kpi-sub">Company updates & Q/A</div>
          </div>
          <?php if($townhall_link != ''){ ?>
            <a class="btn btn-accent" href="<?php echo $townhall_link; ?>">Click Here</a>
          <?php } else { ?>
            <span class="badge rounded-pill text-bg-secondary">Upcoming</span>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
 <?php } ?>

 <?php if($student['student_status'] == 1){ ?>
  <!-- NOTIFICATIONS -->
  <?php if(!empty($notifications)){ ?>
  <div class="section-title">
    <h2><span style="color:var(--accent);">Notifications</span></h2>
    <div class="line"></div>
  </div>

  <div class="row g-3">
    <?php foreach($notifications as $item){ ?>
    <div class="col-md-6">
      <div class="card card-glass p-4 notice">
        <div class="d-flex gap-3">
          <div class="icon-circle"><i class="fa-solid fa-bullhorn"></i></div>
          <div>
            <div class="fw-bold mb-1">Update</div>
            <div class="text-soft"><?php echo $item['notifcation']; ?></div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <?php } ?>

   <?php } ?>

<?php if($student['student_status'] == 1){ ?>
  <!-- DAILY BEST PERFORMER -->
  <?php if(!empty($daily)){ ?>
  <div class="section-title">
    <h2><span style="color:var(--accent);">Daily Best Performer</span></h2>
    <div class="line"></div>
  </div>

  <div class="row g-4 justify-content-center">
    <?php foreach($daily as $item){ ?>
    <div class="col-md-4">
      <div class="card card-glass p-3 text-center">
        <img class="profile-img mb-3" src="<?php echo 'https://webhavenmedia.com/weblogin/image/'.$item['entity_image'];?>" alt="img">
        <h5 class="mb-1 fw-bold"><?php echo $item['entity_name']; ?></h5>
        <div class="small-meta mb-2"><?php echo strtoupper($item['type']); ?> • <?php echo $item['entity_no']; ?></div>
        <p class="text-soft mb-0"><?php echo $item['entity_description']; ?></p>
      </div>
    </div>
    <?php } ?>
  </div>
  <?php } ?>
    <?php } ?>

<?php if($student['student_status'] == 1){ ?>
  <!-- WEEKLY BEST PERFORMER (Student) -->
  <div class="section-title">
    <h2><span style="color:var(--accent);">Weekly Best Performer</span></h2>
    <div class="line"></div>
  </div>

  <div class="row g-4 justify-content-center">
    <div class="col-md-5">
      <div class="card card-glass p-3 text-center">
        <img class="profile-img mb-3" src="<?php echo 'https://webhavenmedia.com/weblogin/image/'.$week_student['entity_image'];?>" alt="img">
        <h5 class="mb-1 fw-bold"><?php echo $week_student['entity_name']; ?></h5>
        <div class="small-meta mb-2"><?php echo $week_student['entity_no']; ?></div>
        <p class="text-soft mb-0"><?php echo $week_student['entity_description']; ?></p>
      </div>
    </div>
  </div>
 <?php } ?>

  <!-- MY TEAM (only if active) -->
  <?php if($student['student_status'] == 1){ ?>
  <div class="section-title">
    <h2><span style="color:var(--accent);">My Team</span></h2>
    <div class="line"></div>
  </div>

  <div class="row g-3">
    <?php if(!empty($mytrainer)){ ?>
    <div class="col-md-4">
      <div class="card card-glass p-4 text-center">
        <div class="icon-circle mx-auto mb-3"><i class="fa-solid fa-chalkboard-user"></i></div>
        <h5 class="fw-bold mb-1">My Trainer</h5>
        <div class="text-soft mb-3"><?php echo $mytrainer['firstname'].' '.$mytrainer['lastname']; ?></div>
        <a target="_blank" class="btn btn-accent" href="https://api.whatsapp.com/send?phone=<?php echo $mytrainer['whatsapp']; ?>">
          <i class="fa-brands fa-whatsapp me-2"></i> WhatsApp
        </a>
      </div>
    </div>
    <?php } ?>

    <?php if(!empty($mytl)){ ?>
    <div class="col-md-4">
      <div class="card card-glass p-4 text-center">
        <div class="icon-circle mx-auto mb-3"><i class="fa-solid fa-user-tie"></i></div>
        <h5 class="fw-bold mb-1">My Team Leader</h5>
        <div class="text-soft mb-3"><?php echo $mytl['firstname'].' '.$mytl['lastname']; ?></div>
        <a target="_blank" class="btn btn-accent" href="https://api.whatsapp.com/send?phone=<?php echo $mytl['whatsapp']; ?>">
          <i class="fa-brands fa-whatsapp me-2"></i> WhatsApp
        </a>
      </div>
    </div>
    <?php } ?>

    <?php if(!empty($mystl)){ ?>
    <div class="col-md-4">
      <div class="card card-glass p-4 text-center">
        <div class="icon-circle mx-auto mb-3"><i class="fa-solid fa-people-arrows"></i></div>
        <h5 class="fw-bold mb-1">My STL</h5>
        <div class="text-soft mb-3"><?php echo $mystl['firstname'].' '.$mystl['lastname']; ?></div>
        <a target="_blank" class="btn btn-accent" href="https://api.whatsapp.com/send?phone=<?php echo $mystl['whatsapp']; ?>">
          <i class="fa-brands fa-whatsapp me-2"></i> WhatsApp
        </a>
      </div>
    </div>
    <?php } ?>
  </div>
  <?php } ?>

  <!-- PHOTO ZOON -->
  <?php if(!empty($photos)){ ?>
  <div class="section-title">
    <h2><span style="color:var(--accent);">Photo Zoon</span></h2>
    <div class="line"></div>
  </div>

  <div class="row g-3">
    <?php foreach($photos as $photo){ ?>
    <div class="col-6 col-md-4 col-lg-3">
      <a href="<?php echo $photo; ?>" data-lightbox="gallery">
        <img src="<?php echo $photo; ?>" class="gallery-img" alt="photo">
      </a>
    </div>
    <?php } ?>
  </div>
  <?php } ?>

<?php if($student['student_status'] == 1){ ?>
  <!-- WEEKLY BEST TRAINER & TL -->
  <div class="section-title">
    <h2><span style="color:var(--accent);">Weekly Leaders</span></h2>
    <div class="line"></div>
  </div>

  <div class="row g-4">
    <div class="col-md-6">
      <div class="card card-glass p-3 text-center">
        <h5 class="fw-bold mb-3"><i class="fa-solid fa-trophy text-warning me-2"></i> Weekly Best Trainer</h5>
        <img class="profile-img mb-3" src="<?php echo 'https://webhavenmedia.com/weblogin/image/'.$week_trainer['entity_image'];?>" alt="img">
        <h6 class="fw-bold mb-1"><?php echo $week_trainer['entity_name']; ?></h6>
        <div class="small-meta mb-2"><?php echo $week_trainer['entity_no']; ?></div>
        <p class="text-soft mb-0"><?php echo $week_trainer['entity_description']; ?></p>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card card-glass p-3 text-center">
        <h5 class="fw-bold mb-3"><i class="fa-solid fa-trophy text-warning me-2"></i> Weekly Best TL</h5>
        <img class="profile-img mb-3" src="<?php echo 'https://webhavenmedia.com/weblogin/image/'.$week_teamleader['entity_image'];?>" alt="img">
        <h6 class="fw-bold mb-1"><?php echo $week_teamleader['entity_name']; ?></h6>
        <div class="small-meta mb-2"><?php echo $week_teamleader['entity_no']; ?></div>
        <p class="text-soft mb-0"><?php echo $week_teamleader['entity_description']; ?></p>
      </div>
    </div>
  </div>

  <?php } ?>

  <?php if($student['student_status'] == 1){ ?>

  <!-- WEEKLY ACTIVITY -->
  <?php if(!empty($weekly_activity)){ ?>
  <div class="section-title">
    <h2><span style="color:var(--accent);">Weekly Activity</span></h2>
    <div class="line"></div>
  </div>

  <div class="row g-3">
    <?php foreach($weekly_activity as $item){ ?>
    <div class="col-md-6">
      <div class="card card-glass p-4">
        <div class="d-flex gap-3 align-items-center mb-3">
          <img src="<?php echo 'https://webhavenmedia.com/weblogin/image/'.$item['image'];?>" alt="img"
               style="width:64px;height:64px;border-radius:14px;object-fit:cover;border:1px solid rgba(255,255,255,.16);">
          <div>
            <div class="fw-bold"><?php echo $item['name']; ?></div>
            <div class="small-meta">Activity Update</div>
          </div>
        </div>
        <p class="text-soft mb-0"><?php echo $item['description']; ?></p>
      </div>
    </div>
    <?php } ?>
  </div>
  <?php } ?>
  <?php } ?>

  <?php if($student['student_status'] == 1){ ?>

  <!-- MOTIVATIONAL SPEECH -->
  <div class="section-title">
    <h2><span style="color:var(--accent);">Motivational Speech</span></h2>
    <div class="line"></div>
  </div>

  <div class="card card-glass p-4 text-center">
    <div class="icon-circle mx-auto mb-3"><i class="fa-solid fa-microphone-lines"></i></div>
    <h5 class="fw-bold mb-2">Motivational Speech</h5>
    <?php if($motivational_link != ''){ ?>
      <a class="btn btn-accent" href="<?php echo $motivational_link; ?>">Click Here</a>
    <?php } else { ?>
      <div class="text-soft">Upcoming</div>
    <?php } ?>
  </div>

  <?php } ?>

  <?php if($student['student_status'] == 1){ ?>
  <!-- BOTTOM ACTIONS -->
  <div class="section-title">
    <h2><span style="color:var(--accent);">Quick Actions</span></h2>
    <div class="line"></div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-md-6">
      <a class="btn btn-soft w-100 py-3" href="<?php echo base_url('student/dashboard'); ?>">
        <i class="fa-solid fa-user-graduate me-2"></i> Go To Student Profile
      </a>
    </div>
    <div class="col-md-6">
      <a class="btn btn-accent w-100 py-3" target="_blank" href="https://www.facebook.com/share/1CCgfmjC7C/">
        <i class="fa-brands fa-facebook me-2"></i> Teacher FB Profile
      </a>
    </div>
  </div>
  <?php } ?>
</div><!-- /container -->

<!-- FOOTER -->
<footer>
  <div class="container">
    <div class="row align-items-center g-2">
      <div class="col-md-5 text-center text-md-start">
        <div class="text-soft">© Copyright <?php echo date('Y'); ?> by Web Haven Media</div>
      </div>
      <div class="col-md-7 text-center text-md-end">
        <a class="me-3" href="<?php echo base_url();?>">Home</a>
        <a class="me-3" href="<?php echo base_url('about');?>">About Us</a>
        <a class="me-3" href="<?php echo base_url('courses');?>">Courses</a>
        <a href="<?php echo base_url('contact');?>">Contact Us</a>
      </div>
    </div>
  </div>
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

</body>
</html>
<script src="<?php echo base_url() ;?>assets/js/main.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$('.popup-gallery').magnificPopup({
  delegate: 'a',
  type: 'image',
  tLoading: 'Loading image #%curr%...',
  mainClass: 'mfp-img-mobile',
  gallery: {
	enabled: true,
	navigateByImgClick: true,
	preload: [0,1] // Will preload 0 - before current, and 1 after the current image
  },
  image: {
	tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
	titleSrc: function(item) {
	  return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
	}
  }
});
});
</script>