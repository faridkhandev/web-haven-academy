<?php $this->load->view('student/header'); ?>

<style>
:root{
  --blue:#1154b4;
  --green:#318d5d;
}

/* Compact heading */
.page__heading{
  padding:10px 0 !important;
  background:#fff;
}
.page__heading h1{
  font-size:22px;
  font-weight:800;
  margin:0;
}

/* Section title */
.course-section-title{
  font-size:18px;
  font-weight:900;
  letter-spacing:.3px;
  color:var(--blue);
  margin:30px 0 16px;
  text-align:center;
  text-transform:uppercase;
}

/* Course card */
.course-card{
  border-radius:16px;
  border:1px solid rgba(0,0,0,.06);
  box-shadow:0 10px 25px rgba(0,0,0,.06);
  overflow:hidden;
  transition:all .25s ease;
  background:#fff;
}
.course-card:hover{
  transform: translateY(-4px);
  box-shadow:0 14px 30px rgba(17,84,180,.20);
}

/* Course image */
.course-card img{
  width:100%;
  height:185px;
  object-fit:cover;
}

/* Course body */
.course-body{
  padding:14px;
  text-align:center;
}
.course-name{
  font-size:14px;
  font-weight:800;
  letter-spacing:.2px;
  color:#222;
  margin-bottom:10px;
  text-transform:uppercase;
}

/* View button */
.btn-course{
  background:var(--blue);
  color:#fff;
  font-weight:800;
  border-radius:12px;
  padding:8px 14px;
  font-size:13px;
  display:inline-block;
}
.btn-course:hover{
  opacity:.9;
  color:#fff;
}

/* Beta badge */
.beta-badge{
  background:rgba(49,141,93,.12);
  color:var(--green);
  font-size:12px;
  font-weight:800;
  border-radius:999px;
  padding:4px 12px;
  display:inline-block;
}
</style>

<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top:60px;">

  <!-- Heading -->
  <div class="page__heading border-bottom">
    <div class="container-fluid page__container">
      <h1 class="mb-0">Course List</h1>
    </div>
  </div>

  <div class="container-fluid page__container mt-3">

    <!-- Alpha Courses -->
    <div class="course-section-title alert alert-info" style="background-color:coral;">Ignite Program</div>

    <div class="row">
      <?php foreach($courses as $item){?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="course-card">
            <img src="<?php echo base_url();?>/weblogin/image/<?php echo $item['course_image'];?>" alt="course">
            <div class="course-body">
              <div class="course-name" style="color:#0165fc; font-weight:700;">
                <?php echo $item['course_name'];?>
              </div>
              <a href="<?php echo base_url('student/course/view');?>?id=<?php echo $item['course_id'];?>" class="btn-course">
                View Course
              </a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>

    <!-- Beta Courses -->
    <div class="course-section-title alert alert-info" style="background-color:coral;">Elevate Program</div>

    <div class="row">
      <?php foreach($betacourses as $item){?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="course-card">
            <img src="<?php echo base_url();?>/weblogin/image/<?php echo $item['course_image'];?>" alt="course">
            <div class="course-body">
              <div class="course-name" style="color:#0165fc; font-weight:700;">
                <?php echo $item['course_name'];?>
              </div>
              <span class="beta-badge">Coming Soon</span>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>

  </div>
</div>

<?php $this->load->view('student/footer'); ?>
