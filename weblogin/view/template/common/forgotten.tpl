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
            <?php if ($error_warning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php } ?>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="input-email"><?php echo $entry_email; ?></label>
                <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
                </div>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $button_reset; ?></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
              </div>
            </form>
          </div>
        </div>
      </div>  
      </div>
      <div class="col-xs-12 col-sm-6 right-part">
        <span style="display:inline-block; margin-bottom:10px; color:var(--text-color); font-size:25px;" class="login-subtitle">KOS Digital Web Admin</span>
      </div>
    </div>
  </div>
</div>
<div class="logfooter">
    <small class="autowidthL">om Boarding 1.0.2 © 2020-2023 All Rights Reserved.</small>
    <small class="autowidthR text-right">Developed By<a href="https://shirsendu.com/" target="_blank"><img src="https://dip.cosmogini.com/image/designedbylogo.png" alt="" class="img-fluid designby"></a></small>
</div>
<?php/* <?php echo $footer; ?>*/?>