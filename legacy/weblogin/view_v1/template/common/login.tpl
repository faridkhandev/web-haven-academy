<?php echo $header; ?>
<div id="content" class="login">
  <div class="container-fluid">
    <div class="row d-flex">
      <div class="col-xs-12 col-sm-6">
        <div class="wrap">
          <span style="display:inline-block; margin-bottom:20px"><img src="<?php echo $logo;?>" alt="KOS Digital" title="KOS Digital" style="width: 280px;"></span>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h1 class="panel-title"><i class="fa fa-lock"></i> <?php echo $text_login; ?></h1>
            </div>
            <div class="panel-body">
              <?php if ($success) { ?>
              <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>
              <?php } ?>
              <?php if ($error_warning) { ?>
              <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>
              <?php } ?>
              <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="input-username">User Types</label>
                  <div class="input-group"><span class="input-group-addon"><i class="fa fa-users"></i></span>
					<select name="user_group_id" id="input-username" class="form-control">
						<option value="">-Select</option>
						<?php foreach($groups as $group){?>
							<option value="<?php echo $group['user_group_id']; ?>"><?php echo $group['name']; ?></option>
						<?php } ?>
					</select>
                  </div>
                </div>
				<div class="form-group">
                  <label for="input-username"><?php echo $entry_username; ?></label>
                  <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" name="username" value="<?php echo $username; ?>" placeholder="<?php echo $entry_username; ?>" id="input-username" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="input-password"><?php echo $entry_password; ?></label>
                  <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
                  </div>
                </div>
                <div class="autoLeft">
                  <?php if ($forgotten) { ?>
                    <span class="help-block"><a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a></span>
                  <?php } ?>
                </div>
                <div class="autoRight">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> <?php echo $button_login; ?></button>
                </div>
                <?php if ($redirect) { ?>
                <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                <?php } ?>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 right-part">
        <span style="display:inline-block; margin-bottom:10px; color:var(--text-color); font-size:25px;" class="login-subtitle"><?php echo $tagline; ?></span>
      </div>
    </div>
  </div>
</div>
<div class="logfooter">
    <small class="autowidthL"><?php echo APPNAME." ".APPVERSION.' © '. COPYRIGHTYEAR; ?>  All Rights Reserved.</small>
    <!--small class="autowidthR text-right">Developed By<a href="https://google.com/" target="_blank"><img src="image/designedbylogo.png" alt="" class="img-fluid designby"></a></small-->
</div>