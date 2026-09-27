<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i> Change Password</h3>
				</div>
				<div class="pull-left">
					
				</div>
				<div class="pull-right">
					
				</div>
				<div class="pull-right">
					<button type="submit" id="btn-submit" form="form-change-password" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-change-password" class="form-horizontal">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group required">
								<label class="control-label" for="input-password"><?php echo $entry_password; ?></label>
								<div class="input-group">
								<input type="password" name="password" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control password-control" <?php if (isset($disabed)) { echo 'disabled="disabled"'; } ?> />
								<span class="input-group-btn"><button class="btn btn-default btn-show-password" type="button"><i class="fa fa-eye"></i></button></span>
								</div>
								<?php if ($error_password) { ?>
								<div class="text-danger"><?php echo $error_password; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group required">
							<label class="control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
							<div class="input-group">
							<input type="password" name="confirm" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control password-control" <?php if (isset($disabed)) { echo 'disabled="disabled"'; } ?> />
							<span class="input-group-btn"><button class="btn btn-default btn-show-password" type="button"><i class="fa fa-eye"></i></button></span>
							</div>
							<?php if ($error_confirm) { ?>
							<div class="text-danger"><?php echo $error_confirm; ?></div>
							<?php } ?>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php echo $footer; ?>
