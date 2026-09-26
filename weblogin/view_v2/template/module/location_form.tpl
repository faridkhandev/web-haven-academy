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

					<div class="row">	
						<div class="col-sm-3">
							<div class="form-group required">
								<label class="control-label" for="input-doctor">Select Doctor</label>
								<select name="doctor_id" id="input-doctor" class="form-control select2">
									<option value="">-Select-</option>
									<?php foreach($doctors as $doctor){ ?>
									<option value="<?php echo $doctor['doctor_id']; ?>" <?php if($doctor_id == $doctor['doctor_id']) echo 'selected';?>><?php echo $doctor['doctor_name'].'('.$doctor['doctor_id'].')'; ?></option>
									<?php } ?>
								</select>
								<?php if ($error_doctor_id) { ?>
								<div class="text-danger"><?php echo $error_doctor_id; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group required">
								<label class="control-label" for="input-state">State</label>
								<select name="zone_id" id="input-state" class="form-control">
									<option value="">-Select-</option>
									<?php foreach($zones as $zone){ ?>
									<option value="<?php echo $zone['zone_id']; ?>" <?php if($zone_id == $zone['zone_id']) echo 'selected';?>><?php echo $zone['name']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="form-group required">
								<label class="control-label" for="input-city">City</label>
								<select name="city_id" id="input-city" class="form-control"></select>
								<?php if ($error_city_id) { ?>
								<div class="text-danger"><?php echo $error_city_id; ?></div>
								<?php } ?>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="form-group required">
								<label class="control-label" for="input-area">Area</label>
								<select name="area_id" id="input-area" class="form-control"></select>
								<?php if ($error_area_id) { ?>
								<div class="text-danger"><?php echo $error_area_id; ?></div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="row">	
						<div class="col-sm-3">
							<div class="form-group">
								<label class="control-label" for="input-status">Status</label>
								<select name="status" id="input-status" class="form-control">
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
					html += '<option value="" selected="selected"><?php echo '--None--'; ?></option>';
				}
				$('select[name=\'city_id\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
	$('select[name=\'zone_id\']').trigger('change');
	$('select[name=\'city_id\']').on('change', function() {
		$.ajax({
			url: 'index.php?route=localisation/location/city&token=<?php echo $token; ?>&city_id=' + this.value,
			dataType: 'json',
			beforeSend: function() {
				$('select[name=\'city_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
			},
			complete: function() {
				$('.fa-spin').remove();
			},
			success: function(json) {
				html = '<option value=""><?php echo '--Please Select--'; ?></option>';
				if (json['location'] && json['location'] != '') {
					for (i = 0; i < json['location'].length; i++) {
						html += '<option value="' + json['location'][i]['location_id'] + '"';
						if (json['location'][i]['location_id'] == '<?php echo $area_id; ?>') {
							html += ' selected="selected"';
						}
						html += '>' + json['location'][i]['location_name'] + '</option>';
					}
				} else {
					html += '<option value="" selected="selected"><?php echo '--None--'; ?></option>';
				}
				$('select[name=\'area_id\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
	setTimeout(function(){
		$('select[name=\'city_id\']').trigger('change');	
	}, 2000);

	
//--></script>
<?php echo $footer; ?>