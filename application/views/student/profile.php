<?php $this->load->view('student/header'); ?>

<style>
:root{ --blue:#1154b4; --green:#318d5d; }

/* Compact heading */
.page__heading{
  padding:10px 0 !important;
  background:#fff;
}
.page__heading h1{
  font-size:22px;
  font-weight:900;
  margin:0;
  letter-spacing:.2px;
}
.page__heading.border-bottom{
  border-bottom:1px solid rgba(0,0,0,.08) !important;
}

/* Card */
.card-soft{
  border:1px solid rgba(0,0,0,.06);
  border-radius:16px;
  box-shadow:0 12px 30px rgba(0,0,0,.06);
  overflow:hidden;
  background:#fff;
}
.card-soft .card-header{
  background: rgba(17,84,180,.06);
  border-bottom:1px solid rgba(0,0,0,.06);
}
.card-soft .card-header .title{
  font-weight:900;
  margin:0;
}

/* Form controls */
label{
  font-size:12px;
  font-weight:900;
  letter-spacing:.4px;
  text-transform:uppercase;
  color:#6c757d;
  margin-bottom:6px;
}
.form-control{
  border-radius:12px;
  height:44px;
}
.form-control:focus{
  border-color: rgba(17,84,180,.55);
  box-shadow: 0 0 0 .2rem rgba(17,84,180,.12);
}

/* Readonly look */
.form-control[disabled]{
  background:#f7f9fc;
  color:#5b6778;
}

/* Buttons */
.btn-blue{
  background:var(--blue);
  border-color:var(--blue);
  color:#fff;
  font-weight:900;
  border-radius:12px;
  padding:10px 16px;
}
.btn-blue:hover{ opacity:.92; color:#fff; }

.btn-green{
  background:var(--green);
  border-color:var(--green);
  color:#fff;
  font-weight:900;
  border-radius:12px;
  padding:10px 16px;
}
.btn-green:hover{ opacity:.92; color:#fff; }

/* Note box */
.note-box{
  background: rgba(49,141,93,0);
  border:1px solid rgba(49,141,93,.9);
  border-radius:14px;
  padding:14px 16px;
  color:#FFF;
}
.note-box strong{ color:#FFF; }

/* Section divider title */
.section-title{
  font-weight:900;
  color:var(--blue);
  margin:0;
}
.section-sub{
  color:#6c757d;
  font-size:13px;
}

/* Profile upload */
.avatar-card{
  border:1px dashed rgba(17,84,180,.35);
  background: rgba(17,84,180,.03);
  border-radius:16px;
  padding:14px;
}
.avatar-preview{
  width:160px;
  height:160px;
  border-radius:16px;
  border:2px solid rgba(17,84,180,.18);
  object-fit:cover;
  background:#fff;
}
.small-hint{
  font-size:12px;
  color:#6c757d;
}
    
        .btn-green{
        background-color: lawngreen!important;
        color: black !important;
        
    }
    
    
    .section-sub{
        color: #FFF;
    }
 .filter-group label{
        color: #FFF;
    }
    
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
    background: linear-gradient(135deg, var(--bg1), var(--bg2), var(--bg3));
    color: #fff;
    }  
    
    .card-glass{
  background: var(--glass);
  border: 1px solid var(--glass-border);
  border-radius: 18px;
  backdrop-filter: blur(12px);
  box-shadow: 0 18px 45px rgba(0,0,0,.25);
}
    
.page__container .card-body {
    padding: 15px 20px;
}
    .card-glass-thumb{
        color: #FFF;
    }
    .card-glass-thumb .label{
        color: var(--accent);
        min-height: 50px;
    }
    
    
    .card-glass-thumb .value{
        font-size: 2.2rem;
    font-weight: 400;
    margin-top: 20px;
    margin-bottom: 7px;
    }
    
    
.page__heading {
    background: none !important;
    color: #FFF;
}
    
[dir=ltr] .card {
    background: var(--glass);
    border: 1px solid var(--glass-border);
    border-radius: 18px;
    backdrop-filter: blur(12px);
    box-shadow: 0 18px 45px rgba(0, 0, 0, .25);
          color: #FFF;
}
[dir=ltr] .card-header:first-child{
  border-radius: 18px 18px 0 0;
}

[dir=ltr] .card .badge{
  background: rgba(255, 193, 7, .15);
border: 1px solid rgba(255, 193, 7, .35);
color: var(--accent);
  font-size: 18px;
}
    
[dir=ltr] .btn.btn-accent{
  background: var(--accent);
  color: #111;
  border: none;
  border-radius: 999px;
  font-weight: 700;
  padding: 10px 18px;
}
[dir=ltr] .btn.btn-accent:hover{ background:#ffb300; }
    
    [dir=ltr] .card .form-control{
        background: rgba(255, 255, 255, .12) !important;
    color: #fff;
    border: 1px solid rgba(255, 255, 255, .18) !important;
    border-radius: 999px;
    font-weight: 400;
    padding: 10px 18px;
    height: auto;
    }
    
    [dir=ltr] .card .form-control option{
        color: #000
    }
    
    [dir=ltr] .table thead th{
        color: #FFF;
    }
    .dataTables_scrollHeadInner{
        max-width: 100%;
    }
    [dir=ltr] .dataTable{
         max-width: 100%;
    }
    
    [dir=ltr] .page-link{
        height: 34px;
    }
    
    
    .form-group label{
        color: #FFF;
    }
    
    
</style>

<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top:60px;">

  <div class="page__heading border-bottom">
    <div class="container-fluid page__container d-flex align-items-center justify-content-between">
      <h1 class="mb-0">Profile</h1>
    </div>
  </div>
	
  <div class="container-fluid page__container mt-3 mb-5">

    <!-- Info Note -->
    <div class="note-box mb-3 d-flex flex-wrap align-items-center justify-content-between">
      <div class="mr-2">
        <strong>Note:</strong> You can update only <strong>Profile Image, City, Facebook, YouTube</strong>.
        For other changes, please contact administrator.
      </div>
      <a target="_blank" class="btn btn-accent mt-2 mt-md-0" href="<?php echo base_url('contact');?>">
        Contact Admin
      </a>
    </div>

    <?php echo validation_errors(); ?>

    <?php if(isset($success)){?>
      <div class="alert alert-success alert-dismissible">
        <strong>Success!</strong> <?php echo $success;?>
      </div>
    <?php } ?>

    <?php if(isset($error)){?>
      <div class="alert alert-danger alert-dismissible">
        <strong>Danger!</strong> <?php echo $error;?>
      </div>
    <?php } ?>

    <form method="POST" action="<?php echo site_url('student/profile'); ?>" enctype="multipart/form-data">

      <!-- READ ONLY INFO -->
      <div class="card card-soft mb-3">
        <div class="card-header p-4">
          <p class="title h5 mb-1">Account Information</p>
          <div class="section-sub">These fields are locked for security.</div>
        </div>

        <div class="card-body p-4">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Student Name</label>
              <input type="text" class="form-control" value="<?php echo $student['student_name'];?>" disabled>
            </div>

            <div class="form-group col-md-4">
              <label>Email</label>
              <input type="text" class="form-control" value="<?php echo $student['student_email'];?>" disabled>
            </div>

            <div class="form-group col-md-4">
              <label>Phone</label>
              <input type="text" class="form-control" value="<?php echo $student['student_phone'];?>" disabled>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label>WhatsApp</label>
              <input id="student_whatsapp" name="student_whatsapp" type="text" class="form-control"
                value="<?php echo $student['student_whatsapp'];?>"
                <?php if($total_whatsapp_status['total_whatsapp_status']){?> disabled <?php } ?>>
              <?php if($total_whatsapp_status['total_whatsapp_status']){?>
                <small class="small-hint">WhatsApp number is locked because wrong number was submitted earlier.</small>
              <?php } ?>
            </div>

            <div class="form-group col-md-4">
              <label>Gender</label>
              <input type="text" class="form-control" value="<?php echo $student['student_gender'];?>" disabled>
            </div>

            <div class="form-group col-md-4">
              <label>Language</label>
              <input type="text" class="form-control" value="<?php echo $student['student_language'];?>" disabled>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Country</label>
              <input type="text" class="form-control" value="<?php echo $student['student_country'];?>" disabled>
            </div>
          </div>

        </div>
      </div>

      <!-- EDITABLE INFO -->
      <div class="card card-soft">
        <div class="card-header p-4">
          <p class="title h5 mb-1">Editable Details</p>
          <div class="section-sub">Update your city, social links & profile image.</div>
        </div>

        <div class="card-body p-4">

          <div class="form-row">
            <div class="form-group col-md-4">
              <label>City</label>
              <input id="student_city" name="student_city" type="text" class="form-control" value="<?php echo $student['student_city'];?>">
            </div>

            <div class="form-group col-md-4">
              <label>Facebook Profile URL</label>
              <input id="student_fb_link" name="student_fb_link" type="text" class="form-control" value="<?php echo $student['student_fb_link'];?>">
            </div>

            <div class="form-group col-md-4">
              <label>YouTube Profile URL</label>
              <input id="student_youtube_link" name="student_youtube_link" type="text" class="form-control" value="<?php echo $student['student_youtube_link'];?>">
            </div>
          </div>

          <div class="row mt-2">
            <div class="col-lg-6">

              <div class="avatar-card">
                <label>Profile Picture</label>
                <div class="small-hint mb-2">Upto 2 MB. Only jpg, jpeg, png allowed.</div>

                <input type="file" name="student_image" class="form-control" id="input-image">
                <input type="hidden" name="student_image_hidden" value="<?php echo $student['student_image'];?>" />

                <div class="mt-3" id="file_image-holder">
                  <?php
                    if($student['student_image'] != ''){
                      $src = $student['student_image'];
                    } else {
                      $src = 'uploads/no-image.jpg';
                    }
                  ?>
                  <img class="avatar-preview" src="<?php echo base_url($src);?>" alt="profile">
                </div>
              </div>

            </div>
              <div class="col-12">
                  <div class="avatar-card">
                <div class="d-flex justify-content-start mt-4">
            <button type="submit" name="submit" class="btn btn-green">
              Update Profile
            </button>
                    </div>
          </div>
              </div>
          </div>

          

        </div>
      </div>

    </form>

  </div>
</div>

<?php $this->load->view('student/footer'); ?>

<script>
$("#input-image").on('change', function () {
  if (typeof(FileReader) != "undefined") {
    var image_holder = $("#file_image-holder");
    image_holder.empty();

    var reader = new FileReader();
    reader.onload = function (e) {
      $("<img />", {
        "src": e.target.result,
        "class": "avatar-preview",
        "alt": "preview"
      }).appendTo(image_holder);
    }
    reader.readAsDataURL($(this)[0].files[0]);
  } else {
    alert("This browser does not support FileReader.");
  }
});
</script>
