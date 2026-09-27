<?php $this->load->view('student/header'); ?>

<style>
:root{
  --blue:#1154b4;
  --green:#318d5d;
}

/* Page heading */
.page__heading{
  padding: 18px 0 10px;
}
.page__heading h1{
  font-weight: 900;
  letter-spacing: .3px;
}

/* Card */
.card-soft{
  border:1px solid rgba(0,0,0,.06);
  border-radius:16px;
  box-shadow:0 12px 30px rgba(0,0,0,.06);
  overflow:hidden;
}
.card-soft .card-header{
  background: rgba(17,84,180,.06);
  border-bottom:1px solid rgba(0,0,0,.06);
}
.card-soft .card-header .title{
  font-weight: 900;
  margin:0;
}
.card-soft .card-header small{
  color:#6c757d;
}

/* Inputs */
.form-control{
  border-radius:12px;
  height:44px;
}
.form-control:focus{
  border-color: rgba(17,84,180,.55);
  box-shadow: 0 0 0 .2rem rgba(17,84,180,.12);
}

/* Button */
.btn-brand{
  background: var(--green);
  border-color: var(--green);
  color:#fff;
  font-weight: 900;
  border-radius:12px;
  padding:10px 16px;
}
.btn-brand:hover{ opacity:.92; color:#fff; }

/* Labels */
label{
  font-weight: 800;
  font-size: 13px;
  letter-spacing:.2px;
  margin-bottom: 6px;
}

/* Small helper text */
.pass-hint{
  background: rgba(49,141,93,.10);
  border: 1px solid rgba(49,141,93,.25);
  border-radius: 12px;
  padding: 10px 12px;
  color:#245d42;
  font-size: 13px;
}

/* Password field with button */
.pass-wrap{
  position:relative;
}
.pass-toggle{
  position:absolute;
  right:10px;
  top:50%;
  transform: translateY(-50%);
  border:0;
  background: transparent;
  color: var(--blue);
  font-weight: 900;
  cursor:pointer;
  padding: 6px 8px;
  border-radius: 10px;
}
.pass-toggle:hover{
  background: rgba(17,84,180,.08);
}
/* Compact page heading */
.page__heading{
    padding: 10px 0 !important;
    background: #ffffff;
}

.page__heading h1{
    font-size: 22px;        /* smaller, cleaner */
    font-weight: 800;
    letter-spacing: .2px;
    margin: 0;
}

/* Reduce container vertical spacing */
.page__container{
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

/* Thin border */
.page__heading.border-bottom{
    border-bottom: 1px solid rgba(0,0,0,.08) !important;
}

</style>

<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top:60px;">
  <div class="page__heading border-bottom">
    <div class="container-fluid page__container d-flex align-items-center justify-content-between">
      <h1 class="mb-0">Update Password</h1>
    </div>
  </div>

  <div class="container-fluid page__container mt-4 mb-5">
    <div class="row">
      <div class="col-lg-6 col-md-8 offset-lg-3 offset-md-2">

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

        <div class="card card-soft">
          <div class="card-header p-4">
            <p class="title h5 mb-1">Change your password</p>
            <small>Use a strong password to keep your account safe.</small>
          </div>

          <div class="card-body p-4">

            <div class="pass-hint mb-3">
              Password should be at least <strong>8 characters</strong> and include a mix of letters, numbers & symbols.
            </div>

            <form method="POST" action="<?php echo site_url('student/password'); ?>">

              <div class="form-group">
                <label for="student_password">Old Password</label>
                <div class="pass-wrap">
                  <input id="student_password" name="student_password" type="password" class="form-control" autocomplete="current-password">
                  <button type="button" class="pass-toggle" data-target="#student_password">Show</button>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="student_new_password">New Password</label>
                  <div class="pass-wrap">
                    <input id="student_new_password" name="student_new_password" type="password" class="form-control" autocomplete="new-password">
                    <button type="button" class="pass-toggle" data-target="#student_new_password">Show</button>
                  </div>
                </div>

                <div class="form-group col-md-6">
                  <label for="student_confirm_password">Confirm Password</label>
                  <div class="pass-wrap">
                    <input id="student_confirm_password" name="student_confirm_password" type="password" class="form-control" autocomplete="new-password">
                    <button type="button" class="pass-toggle" data-target="#student_confirm_password">Show</button>
                  </div>
                </div>
              </div>

              <div class="d-flex align-items-center justify-content-between mt-4">
                <a href="<?php echo base_url('student/dashboard'); ?>" class="btn btn-light" style="border-radius:12px;">
                  Back
                </a>

                <button type="submit" name="submit" class="btn btn-brand">
                  Update Password
                </button>
              </div>

            </form>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
/* show/hide password */
document.querySelectorAll('.pass-toggle').forEach(btn => {
  btn.addEventListener('click', function(){
    const input = document.querySelector(this.getAttribute('data-target'));
    if(!input) return;

    if(input.type === 'password'){
      input.type = 'text';
      this.innerText = 'Hide';
    }else{
      input.type = 'password';
      this.innerText = 'Show';
    }
  });
});
</script>

<?php $this->load->view('student/footer'); ?>
