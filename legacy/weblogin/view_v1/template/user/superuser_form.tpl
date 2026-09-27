<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">		
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
				</div>
				<div class="pull-right">
					<button type="submit" form="form-user" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-username"><?php echo $entry_username; ?></label>
								<input type="text" name="username" value="<?php echo $username; ?>" placeholder="<?php echo $entry_username; ?>" id="input-username" class="form-control" />
								<?php if ($error_username) { ?>
								<div class="text-danger"><?php echo $error_username; ?></div>
								<?php } ?>
							</div>
						</div>
						<input type="hidden" name="user_group_id" value="1" />
						<?php if(empty($id)){?>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-password"><span data-toggle="tooltip" title="" data-original-title="For Update Password, Please add value. Otherwise leave blank."><?php echo $entry_password; ?></span></label>
								<input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" autocomplete="off" />
								<?php if ($error_password) { ?>
								<div class="text-danger"><?php echo $error_password; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-confirm"><span data-toggle="tooltip" title="" data-original-title="For Update Password, Please add value. Otherwise leave blank."><?php echo $entry_confirm; ?> Password</span></label>
								<input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
								<?php if ($error_confirm) { ?>
								<div class="text-danger"><?php echo $error_confirm; ?></div>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
					</div>
					
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-firstname"><?php echo $entry_firstname; ?></label>
								<input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="form-control" />
								<?php if ($error_firstname) { ?>
								<div class="text-danger"><?php echo $error_firstname; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-lastname"><?php echo $entry_lastname; ?></label>
								<input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname" class="form-control" />
								<?php if ($error_lastname) { ?>
								<div class="text-danger"><?php echo $error_lastname; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
								<input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
								<?php if ($error_email) { ?>
								<div class="text-danger"><?php echo $error_email; ?></div>
								<?php } ?>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-phone">Phone No</label>
								<input type="text" name="phone" value="<?php echo $phone; ?>" id="input-phone" class="form-control" />
								<?php if ($error_phone) { ?>
								<div class="text-danger"><?php echo $error_phone; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-whatsapp">Whatsapp</label>
								<input type="text" name="whatsapp" value="<?php echo $whatsapp; ?>" id="input-whatsapp" class="form-control" />
								<?php if ($error_whatsapp) { ?>
								<div class="text-danger"><?php echo $error_whatsapp; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-gender">Gender</label>
								<select name="gender" id="input-gender" class="form-control">
									<option value="Male" <?php if($gender=='Male') { ?> selected="selected" <?php } ?> >Male</option>
									<option value="Female" <?php if($gender=='Female') { ?> selected="selected" <?php } ?>>Female</option>
								</select>
							</div>
						</div>
					</div>
					
					<input type="hidden" name="city" value="" />
					<input type="hidden" name="language" value="" />
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label" for="input-image"><?php echo $entry_image; ?></label>
								<a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
								<input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
								<select name="status" id="input-status" class="form-control">
								<?php if ($status) { ?>
								<option value="0"><?php echo $text_disabled; ?></option>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<?php } else { ?>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<option value="1"><?php echo $text_enabled; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
$('.select2').select2();
$('.date').datetimepicker({
	pickDate: true,
	pickTime: false,
	format: 'YYYY-MM-DD',
	inline: false,
});
</script>

<?php echo $footer; ?> 