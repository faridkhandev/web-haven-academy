<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<div class="panel panel-default">
			
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
				</div>
				<div class="pull-right">
					<button type="submit" form="form-doctor" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<?php include 'view/template/common/message.tpl' ; ?>
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-doctor">
					<div class="row">	
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-doctor">Select Doctor</label>
								<select name="doctor_id" id="input-doctor" class="form-control select2">
									<option value="">-Select-</option>
									<?php foreach($doctors as $doctor){ ?>
									<option value="<?php echo $doctor['doctor_id']; ?>"><?php echo $doctor['doctor_name'].'('.$doctor['doctor_id'].')'; ?></option>
									<?php } ?>
								</select>
								<?php if ($error_doctor_id) { ?>
								<div class="text-danger"><?php echo $error_doctor_id; ?></div>
								<?php } ?>
							</div>
						</div>
						
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-area">Area</label>
								<select name="area_id" id="input-area" class="form-control select2"></select>
								<?php if ($error_area_id) { ?>
								<div class="text-danger"><?php echo $error_area_id; ?></div>
								<?php } ?>
							</div>
						</div>
							
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-investment_amount">Amount</label>
								<input type="text" name="amount" value="" id="input-amount" class="form-control" />
								<?php if ($error_amount) { ?>
								<div class="text-danger"><?php echo $error_amount; ?></div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="row">
						
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-date">Added Date</label>
								<div class="input-group date">
									<input type="text" name="date_added" value="" id="input-date" class="form-control">
									<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
								</div>
							</div>	
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-own_by">Reporting By/Employee Name</label>
								<input type="text" name="own_by" value="" id="input-own_by" class="form-control" />
							</div>
						</div>
					</div>
					<div class="row">	
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label" for="input-note">Any Note</label>
								<input type="text" name="description" value="<?php echo $description; ?>" id="input-description" class="form-control" />
							</div>
						</div>
						
					</div>
				</form>
			</div>
			<div class="panel-footer">
				<div class="pull-right">
					<button type="submit" form="form-doctor" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickDate: true,
	pickTime: false,
	format: 'YYYY-MM-DD',
	inline: false,
});
$(document).ready(function() {	
	$('.select2').select2();
});
//--></script>
<script type="text/javascript"><!--	
	$('select[name=\'doctor_id\']').on('change', function() {
		$.ajax({
			url: 'index.php?route=localisation/zone/doctorarea&token=<?php echo $token; ?>&doctor_id=' + this.value,
			dataType: 'json',
			beforeSend: function() {
				$('select[name=\'doctor_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
			},
			complete: function() {
				$('.fa-spin').remove();
			},
			success: function(json) {
				html = '<option value=""><?php echo '--Please Select--'; ?></option>';
				if (json['areas'] && json['areas'] != '') {
					for (i = 0; i < json['areas'].length; i++) {
						html += '<option value="' + json['areas'][i]['location_id'] + '"';
						if (json['areas'][i]['zone_id'] == <?php echo $area_id;?>) {
						html += ' selected="selected"';
						}
						html += '>' + json['areas'][i]['location_name'] + '</option>';
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
	<?php if($doctor_transaction_id != 0){?>
	setTimeout(function(){
		$('select[name=\'filter_doctor_id\']').trigger('change');
	}, 1000);
	<?php } ?>
	//--></script>
<?php echo $footer; ?>