<?php echo $header; ?>
<style>
/* ===== Login v2 (Bootstrap 3) ===== */
.login-v2 {
  min-height: calc(100vh - 20px);
  padding: 40px 0;
  background: #f5f7fb;
}

.login-row {
  display: flex;
  align-items: stretch;
}
@media (max-width: 767px) {
  .login-row { display: block; }
}

.login-card {
  background: #fff;
  border-radius: 12px;
  padding: 28px;
  box-shadow: 0 10px 30px rgba(16, 24, 40, 0.12);
  border: 1px solid rgba(16, 24, 40, 0.06);
  margin-bottom: 20px;
}

.login-brand { margin-bottom: 20px; }
.login-logo {
  max-width: 260px;
  width: 100%;
  height: auto;
  margin-bottom: 12px;
}
.login-title {
  font-size: 20px;
  font-weight: 700;
  margin-top: 6px;
}
.login-subtitle {
  font-size: 13px;
  color: #667085;
  margin-top: 4px;
}

.login-form .form-group label {
  font-weight: 600;
  color: #344054;
}

.input-group-lg > .form-control,
.input-group-lg > .input-group-addon {
  height: 46px;
  padding: 10px 12px;
  font-size: 14px;
}

.input-group-addon {
  background: #f2f4f7;
  border-color: #d0d5dd;
  color: #667085;
}

.form-control {
  border-color: #d0d5dd;
  box-shadow: none;
}
.form-control:focus {
  border-color: #7f56d9;
  box-shadow: 0 0 0 3px rgba(127, 86, 217, 0.15);
}

.login-actions { margin-top: 10px; }
.login-link {
  display: inline-block;
  margin-top: 12px;
  color: #475467;
  text-decoration: none;
}
.login-link:hover { color: #7f56d9; text-decoration: underline; }

.login-btn {
  border-radius: 10px;
  padding-left: 18px;
  padding-right: 18px;
}

.alert { border-radius: 10px; }

.login-meta {
  margin-top: 18px;
  color: #98a2b3;
}

/* Right side panel */
.login-side {
  height: 100%;
  border-radius: 12px;
  background: linear-gradient(135deg, #7f56d9, #4f46e5);
  color: #fff;
  box-shadow: 0 10px 30px rgba(16, 24, 40, 0.12);
  padding: 28px;
  margin-bottom: 20px;
  position: relative;
  overflow: hidden;
}
.login-side:before {
  content: "";
  position: absolute;
  width: 320px;
  height: 320px;
  right: -140px;
  top: -140px;
  background: rgba(255,255,255,0.12);
  border-radius: 50%;
}
.login-side-inner { position: relative; z-index: 1; }

.side-title {
  font-size: 26px;
  font-weight: 800;
  margin-bottom: 10px;
}
.side-text {
  opacity: 0.92;
  line-height: 1.6;
  margin-bottom: 18px;
}

.side-points { margin-top: 18px; }
.side-point {
  margin-bottom: 10px;
  font-size: 14px;
  opacity: 0.95;
}
.side-point i {
  width: 22px;
  text-align: center;
  margin-right: 8px;
}
</style>
<div id="content" class="login login-v2">
  <div class="container">
    <div class="row login-row">

      <!-- LEFT: Login Card -->
      <div class="col-xs-12 col-sm-6">
        <div class="login-card">
          <div class="login-brand text-center">
            <img src="<?php echo $logo; ?>" alt="Web haven academy" title="Web haven academy" class="login-logo">
            <div class="login-title"><?php echo $text_login; ?></div>
            <div class="login-subtitle">Web Admin Panel</div>
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

            <div class="form-group">
              <label for="input-user-type">User Type</label>
              <div class="input-group input-group-lg">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="user_group_id" id="input-user-type" class="form-control">
                  <option value="">-Select-</option>
                  <?php foreach($groups as $group){ ?>
                    <?php if($group['user_group_id'] != 1){ ?>
                      <option value="<?php echo $group['user_group_id']; ?>">
                        <?php echo $group['name']; ?>
                      </option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>

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
        <div class="login-side">
          <div class="login-side-inner">
            <div class="side-title">Web haven academy</div>
            <div class="side-text">
              Secure admin access for staff and management. Please login with your credentials.
            </div>

            <div class="side-points">
              <div class="side-point"><i class="fa fa-shield"></i> Secure Login</div>
              <div class="side-point"><i class="fa fa-bolt"></i> Fast Dashboard</div>
              <div class="side-point"><i class="fa fa-support"></i> Support Ready</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>