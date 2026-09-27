<?php echo $header; ?>

<style>
/* =========================================================
   Super Admin Login (Bootstrap 3) - Complete Page Styles
   ========================================================= */

/* Page background + spacing */
.login-v2{
  min-height: 100vh;
  background: #f5f7fb;
  padding: 40px 0;
}

/* Center vertically without flex (BS3-safe) */
.login-v2 .login-table{
  display: table;
  width: 100%;
  min-height: calc(100vh - 80px);
}
.login-v2 .login-cell{
  display: table-cell;
  vertical-align: middle;
}
@media (max-width: 767px){
  .login-v2{ padding: 20px 0; }
  .login-v2 .login-table{ display:block; min-height:auto; }
  .login-v2 .login-cell{ display:block; }
}

/* Card */
.login-card{
  background:#fff;
  border-radius: 12px;
  padding: 28px;
  border:1px solid rgba(16,24,40,.06);
  box-shadow: 0 10px 30px rgba(16,24,40,.12);
  margin-bottom: 20px;
}

/* Brand header */
.login-brand{ margin-bottom: 18px; }
.login-logo{
  max-width: 220px;
  width: 100%;
  height: auto;
  margin: 0 auto 10px;
  display:block;
}
.login-title{
  font-size: 18px;
  font-weight: 700;
  margin-top: 6px;
}
.login-subtitle{
  font-size: 13px;
  color: #667085;
  margin-top: 4px;
}

/* Super badge */
.super-admin .super-badge{
  display:inline-block;
  margin: 8px 0 10px;
  padding: 6px 12px;
  border-radius: 999px;
  background: rgba(220,38,38,0.10);
  border: 1px solid rgba(220,38,38,0.25);
  color: #b42318;
  font-weight: 800;
  font-size: 12px;
  letter-spacing: .6px;
}

/* Form */
.login-form .form-group label{
  font-weight: 600;
  color: #344054;
}
.input-group-lg > .form-control,
.input-group-lg > .input-group-addon{
  height: 46px;
  padding: 10px 12px;
  font-size: 14px;
}
.input-group-addon{
  background:#f2f4f7;
  border-color:#d0d5dd;
  color:#667085;
}
.form-control{
  border-color:#d0d5dd;
  box-shadow:none;
}
.form-control:focus{
  border-color:#7f56d9;
  box-shadow: 0 0 0 3px rgba(127,86,217,.15);
}

/* Actions */
.login-actions{ margin-top: 10px; }
.login-link{
  display:inline-block;
  margin-top: 12px;
  color:#475467;
  text-decoration:none;
}
.login-link:hover{ color:#7f56d9; text-decoration:underline; }

.login-btn{
  border-radius: 10px;
  padding-left: 18px;
  padding-right: 18px;
}

/* Alerts */
.alert{ border-radius: 10px; }

/* Footer inside card */
.login-meta{
  margin-top: 18px;
  color:#98a2b3;
}

/* Right panel */
.login-side{
  border-radius: 12px;
  padding: 28px;
  color: #fff;
  box-shadow: 0 10px 30px rgba(16,24,40,.12);
  border: 1px solid rgba(255,255,255,.12);
  min-height: 420px;
  position: relative;
  overflow: hidden;
  margin-bottom: 20px;
}
.login-side:before{
  content:"";
  position:absolute;
  width: 320px;
  height: 320px;
  right: -140px;
  top: -140px;
  background: rgba(255,255,255,0.10);
  border-radius:50%;
}
.login-side-inner{ position:relative; z-index:1; }

.side-title{
  font-size: 26px;
  font-weight: 800;
  margin-bottom: 10px;
}
.side-text{
  opacity: .92;
  line-height: 1.6;
  margin-bottom: 18px;
}
.side-point{
  margin-bottom: 10px;
  font-size: 14px;
  opacity: .95;
}
.side-point i{
  width: 22px;
  text-align:center;
  margin-right: 8px;
}

/* Serious gradient panel */
.super-side{
  background: linear-gradient(135deg, #111827, #4c1d95);
}
.super-side .side-note{
  margin-top: 18px;
  opacity: .92;
  font-size: 13px;
  padding: 10px 12px;
  border-radius: 10px;
  background: rgba(255,255,255,0.10);
}

/* Optional: page bottom footer (outside card) */
.logfooter{
  text-align:center;
  padding: 10px 0 25px;
  color:#98a2b3;
}
</style>

<div id="content" class="login login-v2 super-admin">
  <div class="container">

    <div class="login-table">
      <div class="login-cell">

        <div class="row">

          <!-- LEFT: Login Card -->
          <div class="col-xs-12 col-sm-6">
            <div class="login-card">
              <div class="login-brand text-center">
                <img src="<?php echo $logo; ?>" alt="Web Haven Academy" title="Web Haven Academy" class="login-logo">

                <div class="super-badge">
                  <i class="fa fa-shield"></i> SUPER ADMIN
                </div>

                <div class="login-title"><?php echo $text_login; ?></div>
                <div class="login-subtitle">Restricted access</div>
              </div>

              <?php if ($success) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                  <i class="fa fa-check-circle"></i> <?php echo $success; ?>
                </div>
              <?php } ?>

              <?php if ($error_warning) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                  <i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                </div>
              <?php } ?>

              <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="login-form">
                <input type="hidden" name="user_group_id" value="1" />

                <div class="form-group">
                  <label for="input-username"><?php echo $entry_username; ?></label>
                  <div class="input-group input-group-lg">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input
                      type="text"
                      name="username"
                      value="<?php echo $username; ?>"
                      placeholder="<?php echo $entry_username; ?>"
                      id="input-username"
                      class="form-control"
                      autocomplete="username"
                    />
                  </div>
                </div>

                <div class="form-group">
                  <label for="input-password"><?php echo $entry_password; ?></label>
                  <div class="input-group input-group-lg">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input
                      type="password"
                      name="password"
                      value="<?php echo $password; ?>"
                      placeholder="<?php echo $entry_password; ?>"
                      id="input-password"
                      class="form-control"
                      autocomplete="current-password"
                    />
                  </div>
                </div>

                <div class="login-actions clearfix">
                  <div class="pull-left">
                    <?php if ($forgotten) { ?>
                      <a class="login-link" href="<?php echo $forgotten; ?>">
                        <?php echo $text_forgotten; ?>
                      </a>
                    <?php } ?>
                  </div>

                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-lg login-btn">
                      <i class="fa fa-key"></i> <?php echo $button_login; ?>
                    </button>
                  </div>
                </div>

                <?php if ($redirect) { ?>
                  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                <?php } ?>
              </form>

              <div class="login-meta text-center">
                <small><?php echo APPNAME." ".APPVERSION.' © '. COPYRIGHTYEAR; ?> All Rights Reserved.</small>
              </div>
            </div>
          </div>

          <!-- RIGHT: Branding Panel -->
          <div class="col-xs-12 col-sm-6 hidden-xs">
            <div class="login-side super-side">
              <div class="login-side-inner">
                <div class="side-title">Web Haven Academyl</div>
                <div class="side-text">
                  This area is for high-privilege accounts only. Unauthorized access is prohibited.
                </div>

                <div class="side-points">
                  <div class="side-point"><i class="fa fa-lock"></i> Encrypted Sessions</div>
                  <div class="side-point"><i class="fa fa-user-secret"></i> Admin-only Controls</div>
                  <div class="side-point"><i class="fa fa-history"></i> Audit-friendly Access</div>
                </div>

                <div class="side-note">
                  Tip: Use a strong password and keep access limited.
                </div>
              </div>
            </div>
          </div>

        </div><!-- /.row -->

      </div><!-- /.login-cell -->
    </div><!-- /.login-table -->

  </div><!-- /.container -->
</div><!-- /#content -->

<div class="logfooter">
  <small><?php echo APPNAME." ".APPVERSION.' © '. COPYRIGHTYEAR; ?> All Rights Reserved.</small>
</div>