<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-country" data-toggle="tooltip" title="<?php echo 'Save'; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			</div>
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
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-country" class="form-horizontal">

					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-name">Area Name</label>
						<div class="col-sm-10">
							<input type="text" name="location_name" value="<?php echo $location_name; ?>" id="input-name" class="form-control" autocomplete="on" runat="server" />
							<?php if ($error_location_name) { ?>
							<div class="text-danger"><?php echo $error_location_name; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-state">State</label>
						<div class="col-sm-10">
							<select name="zone_id" id="input-state" class="form-control">
								<option value=""><?php echo '--Please Select--'; ?></option>
								<?php foreach ($zones as $zone) { ?>
								<?php if ($zone['zone_id'] == $zone_id) { ?>
								<option value="<?php echo $zone['zone_id']; ?>" selected="selected"><?php echo $zone['name']; ?></option>
								<?php } else { ?>
								<option value="<?php echo $zone['zone_id']; ?>"><?php echo $zone['name']; ?></option>
								<?php } ?>
								<?php } ?>
							</select>
							<?php if ($error_zone_id) { ?>
							<div class="text-danger"><?php echo $error_zone_id; ?></div>
							<?php } ?>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-city">City</label>
						<div class="col-sm-10">
							<select name="city_id" id="input-city" class="form-control"></select>
							<?php if ($error_city_id) { ?>
							<div class="text-danger"><?php echo $error_city_id; ?></div>
							<?php } ?>
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-status">Status</label>
						<div class="col-sm-10">
						<select name="location_status" id="input-status" class="form-control">
						<?php if ($status) { ?>
						<option value="1" selected="selected">Active</option>
						<option value="0">In Active</option>
						<?php } else { ?>
						<option value="1">Active</option>
						<option value="0" selected="selected">In Active</option>
						<?php } ?>
						</select>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript"><!--
$('select[name=\'zone_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=localisation/city/zone&token=<?php echo $token; ?>&zone_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'zone_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			html = '<option value=""><?php echo '--Please Select--'; ?></option>';
			if (json['city'] && json['city'] != '') {
				for (i = 0; i < json['city'].length; i++) {
					html += '<option value="' + json['city'][i]['city_id'] + '"';
					if (json['city'][i]['city_id'] == '<?php echo $city_id; ?>') {
						html += ' selected="selected"';
					}
					html += '>' + json['city'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo '--None--'; ?></option>';
			}
			$('select[name=\'city_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
$('select[name=\'zone_id\']').trigger('change');
//--></script>
<?php echo $footer; ?>