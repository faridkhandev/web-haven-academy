<?php echo $header; ?>
<div id="content" class="login">
  <div class="container-fluid">
    <div class="row d-flex">
      <div class="col-xs-12 col-sm-6">
      <div class="wrap">
        <span style="display:inline-block; margin-bottom:20px"><img src="<?php echo $logo;?>" alt="KOS Digital" title="KOS Digital" style="width: 280px;"></span>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="panel-title"><?php echo $heading_title; ?></h1>
          </div>
          <div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
				<p><?php echo $text_password; ?></p>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-password"><?php echo $entry_password; ?></label>
                <div class="col-sm-10">
                  <input type="password" name="password" value="<?php echo $password; ?>" id="input-password" class="form-control" />
                  <?php if ($error_password) { ?>
                  <div class="text-danger"><?php echo $error_password; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
                <div class="col-sm-10">
                  <input type="password" name="confirm" value="<?php echo $confirm; ?>" id="input-confirm" class="form-control" />
                  <?php if ($error_confirm) { ?>
                  <div class="text-danger"><?php echo $error_confirm; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button_save; ?></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
              </div>
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
</div>
<?php/* <?php echo $footer; ?>*/?>