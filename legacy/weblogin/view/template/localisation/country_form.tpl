<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-country" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>			</div>
			<h1><?php echo $heading_title; ?></h1>
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div class="container-fluid">
		<?php if ($error_warning) { ?>
		<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-country">					<div class="row">						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
								<input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
								<?php if ($error_name) { ?>
								<div class="text-danger"><?php echo $error_name; ?></div>
								<?php } ?>
							</div>						</div>						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-iso-code-2"><?php echo $entry_iso_code_2; ?></label>
								<input type="text" name="iso_code_2" value="<?php echo $iso_code_2; ?>" placeholder="<?php echo $entry_iso_code_2; ?>" id="input-iso-code-2" class="form-control" />
							</div>						</div>						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-iso-code-3"><?php echo $entry_iso_code_3; ?></label>
								<input type="text" name="iso_code_3" value="<?php echo $iso_code_3; ?>" placeholder="<?php echo $entry_iso_code_3; ?>" id="input-iso-code-3" class="form-control" />
							</div>						</div>						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label"><?php echo $entry_postcode_required; ?></label>
								<label class="radio-inline">
									<?php if ($postcode_required) { ?>
									<input type="radio" name="postcode_required" value="1" checked="checked" />
									<?php echo $text_yes; ?>
									<?php } else { ?>
									<input type="radio" name="postcode_required" value="1" />
									<?php echo $text_yes; ?>
									<?php } ?>
								</label>
								<label class="radio-inline">
									<?php if (!$postcode_required) { ?>
									<input type="radio" name="postcode_required" value="0" checked="checked" />
									<?php echo $text_no; ?>
									<?php } else { ?>
									<input type="radio" name="postcode_required" value="0" />
									<?php echo $text_no; ?>
									<?php } ?>
								</label>
							</div>						</div>							<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
								<select name="status" id="input-status" class="form-control">
									<?php if ($status) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
							</div>						</div>						<div class="col-sm-4">			
							<div class="form-group required">
								<label class="control-label" for="input-country_phone_code">Country Phone Code</label>
								<input type="text" name="country_phone_code" value="<?php echo $country_phone_code; ?>" id="input-country_phone_code" class="form-control" />
								<?php if ($error_country_phone_code) { ?>
								<div class="text-danger"><?php echo $error_country_phone_code; ?></div>
								<?php } ?>
							</div>						</div>						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-country_phone_code">Country Flag</label>
								<a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
								<input type="hidden" name="country_flag" value="<?php echo $country_flag; ?>" id="input-image" />
							</div>						</div>												<div class="col-sm-4">							<div class="form-group">								<label class="control-label" for="input-address-format"><span data-toggle="tooltip" data-html="true" title="<?php echo htmlspecialchars($help_address_format); ?>"><?php echo $entry_address_format; ?></span></label>								<textarea name="address_format" rows="5" placeholder="<?php echo $entry_address_format; ?>" id="input-address-format" class="form-control"><?php echo $address_format; ?></textarea>							</div>						</div>					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php echo $footer; ?>