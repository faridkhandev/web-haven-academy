<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
				</div>
				<div class="pull-left">
					
				</div>
				<div class="pull-right">
					<a href="<?php echo $add; ?>" data-toggle="tooltip" title="Add Doctor" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_copy; ?>" class="btn btn-default btn-xs" onclick="$('#form-type').attr('action', '<?php echo $copy; ?>').submit()"><i class="fa fa-copy"></i></button>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-xs" onclick="confirm('Are you sure?') ? $('#form-type').submit() : false;"><i class="fa fa-trash-o"></i></button>
				</div>
				<div class="pull-right">
					<button class="btn btn-warning btn-xs" id="btn-refresh" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></button>
					<button class="btn btn-primary btn-xs" id="btn-form"><i class="fa fa-filter"></i></button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="well" id="well" style="display: none;">
					<div class="row">
						<form enctype="multipart/form-data" id="form-filter">
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-name">Name</label>
									<input type="text" name="filter_name" value="" id="input-name" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-state">State</label>
									<select name="filter_state" id="input-state" class="form-control">
										<option value="">-Select-</option>
										<?php foreach($zones as $zone){ ?>
										<option value="<?php echo $zone['zone_id']; ?>"><?php echo $zone['name']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-city">City</label>
									<select name="filter_city" id="input-city" class="form-control"></select>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-area">Area</label>
									<select name="filter_area" id="input-area" class="form-control"></select>
								</div>
							</div>
							
							<div class="col-sm-3">			
								<div class="form-group">
									<label class="control-label" for="input-gender">Gender</label>
									<select name="filter_gender" id="input-gender" class="form-control">
									<option value="">-Select-</option>
									<option value="Male">Male</option>	
									<option value="Female">Female</option>		
									<option value="Other">Other</option>
									</select>
								</div>		
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-start-date">Added Start Date</label>
									<div class="input-group date">
										<input type="text" name="filter_start_date" value="" id="input-start-date" class="form-control">
										<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
									</div>
								</div>	
							</div>
							
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-end-date">Added End Date</label>
									<div class="input-group date">
										<input type="text" name="filter_end_date" value="" id="input-end-date" class="form-control">
										<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
									</div>
								</div>	
							</div>
							
							<div class="col-sm-3">			
								<div class="form-group">
									<label class="control-label" for="input-status">Status</label>
									<select name="filter_status" id="input-status" class="form-control">
									<option value=""></option>
									<option value="1">Enabled</option>
									<option value="0">Disabled</option>
									</select>
								</div>		
							</div>
							<div class="col-sm-4">			
								<button type="button" id="button-reset-filter" class="btn btn-info filterBtns pull-right"><i class="fa fa-search"></i> <?php echo $button_reset_filter; ?></button>
								<button type="button" id="button-filter" class="btn btn-primary filterBtns pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>				
							</div>
						</form>
					</div>
				</div>
				<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-type">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped nowrap" id="table" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></th>
									<th class="text-left">Id</th>
									<th class="text-left">Name</th>
									<th class="text-left">Degree</th>
									<th class="text-left">Address</th>
									<th class="text-left">Contact</th>
									<th class="text-left">Gender</th>
									<th class="text-left">Status</th>
									<th class="text-left">Date Added</th>
									<th class="text-left">Last Modified</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<th class="text-center"></th>
									<th class="text-left">Id</th>
									<th class="text-left">Name</th>
									<th class="text-left">Degree</th>
									<th class="text-left">Address</th>
									<th class="text-left">Contact</th>
									<th class="text-left">Gender</th>
									<th class="text-left">Status</th>
									<th class="text-left">Date Added</th>
									<th class="text-left">Last Modified</th>
									<th class="text-center">Action</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {	
		var url = 'index.php?route=module/doctor&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4,5,6,7,8,9];
		var table = $('#table').DataTable({
			"stateSave": true,
			"scrollY": "100%",		
			"lengthMenu": [[10,20,50,100, 250, 500, 750, 1000], [10,20,50,100, 250, 500, 750, 1000]],
			"scrollX":true,
			"dom": "Bfrtip",
			"searching": false,
			"order": [],
			"processing": false,
			"serverSide": true,
			"pageLength": <?php echo $page_length; ?>,
			"ajax": {
				"url": url,
				"type": "POST",
				"data": function (data) {
					var filter_name = $.trim($('input[name=\'filter_name\']').val());
					if (filter_name) {
						data.filter_name = filter_name;
					}
					
					var filter_start_date = $.trim($('input[name=\'filter_start_date\']').val());
					if (filter_start_date) {
						data.filter_start_date = filter_start_date;
					}
					
					var filter_end_date = $.trim($('input[name=\'filter_end_date\']').val());
					if (filter_end_date) {
						data.filter_end_date = filter_end_date;
					}
					
					var filter_status = $.trim($('select[name=\'filter_status\']').val());
					if (filter_status) {
						data.filter_status = filter_status;
					}
					
					var filter_gender = $.trim($('select[name=\'filter_gender\']').val());
					if (filter_gender) {
						data.filter_gender = filter_gender;
					}
					
					var filter_state = $.trim($('select[name=\'filter_state\']').val());
					if (filter_state) {
						data.filter_state = filter_state;
					}
					var filter_city = $.trim($('select[name=\'filter_city\']').val());
					if (filter_city) {
						data.filter_city = filter_city;
					}
					
					var filter_area = $.trim($('select[name=\'filter_area\']').val());
					if (filter_area) {
						data.filter_area = filter_area;
					}
				}
			},
			"columns": [
				{"data": "doctor_id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "doctor_id", "searchable": false},
				{"data": "doctor_name", "searchable": false},
				{"data": "doctor_degree", "searchable": false},
				{"data": "doctor_address", "searchable": false},
				{"data": "doctor_contact", "searchable": false},
				{"data": "doctor_gender", "searchable": false},
				{"data": "doctor_status", "searchable": false, "render": status},
				{"data": "doctor_date_added", "searchable": false},
				{"data": "doctor_date_modified", "searchable": false},
				{"data": "action", "width":"10%", "orderable": false, "searchable": false, "className": "text-center", "render": function(data, type, full) {
					return '<a href="<?php echo $edit;?>&doctor_id=' + data + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Edit Doctor"><i class="fa fa-pencil"></i></a>&nbsp;<a href="<?php echo $location;?>&filter_doctor_id=' + data + '"  type="button" class="btn btn-default btn-xs"><i data-toggle="tooltip" data-placement="top" data-original-title="View Doctor Location" class="fa fa-map-marker"></i></a>&nbsp;<a href="<?php echo $investment;?>&filter_doctor_id=' + data + '"  type="button" class="btn btn-default btn-xs"><i data-toggle="tooltip" data-placement="top" data-original-title="View Doctor Investment" class="fa fa-money"></i></a>&nbsp;<a href="<?php echo $transaction;?>&filter_doctor_id=' + data + '"  type="button" class="btn btn-default btn-xs"><i data-toggle="tooltip" data-placement="top" data-original-title="View Doctor Revenue" class="fa fa-inr"></i></a>';
				}}
			],
			buttons: [
				{extend: 'copy', text: '<i class="fa fa-files-o"></i>', titleAttr: 'Copy', exportOptions: {columns: tableExportColumns}},
				{extend: 'print', className: 'btn-info', text: '<i class="fa fa-print"></i>', titleAttr: 'Print', exportOptions: {columns: tableExportColumns}},
				{extend: 'excel', className: 'btn-success', text: '<i class="fa fa-file-excel-o"></i>', titleAttr: 'Excel', exportOptions: {columns: tableExportColumns}},
				{extend: 'pdf', className: 'btn-danger', text: '<i class="fa fa-file-text-o"></i>', titleAttr: 'PDF', exportOptions: {columns: tableExportColumns}},
				{extend: 'pageLength', className: 'btn-primary'},
			]
		});
		
		$('#btn-refresh').on('click', function() {
			$('#form-filter')[0].reset();
			table.order([]).ajax.reload();
		});
		
		$('#button-filter').on('click', function() {
			table.ajax.reload();
		});
		
		$('#btn-form').on('click', function() {
			$('.well').stop().slideToggle('fast', 'linear');
		});
		
		$('.date').datetimepicker({
			pickDate: true,
			pickTime: false,
			format: 'YYYY-MM-DD',
			inline: false,
		});
		$('.select2').select2();
	});
	</script>
	<script type="text/javascript"><!--
	$('select[name=\'filter_state\']').on('change', function() {
		$.ajax({
			url: 'index.php?route=localisation/city/zone&token=<?php echo $token; ?>&zone_id=' + this.value,
			dataType: 'json',
			beforeSend: function() {
				$('select[name=\'filter_state\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
			},
			complete: function() {
				$('.fa-spin').remove();
			},
			success: function(json) {
				html = '<option value=""><?php echo '--Please Select--'; ?></option>';
				if (json['city'] && json['city'] != '') {
					for (i = 0; i < json['city'].length; i++) {
						html += '<option value="' + json['city'][i]['city_id'] + '"';
						html += '>' + json['city'][i]['name'] + '</option>';
					}
				} else {
					html += '<option value="" selected="selected"><?php echo '--None--'; ?></option>';
				}
				$('select[name=\'filter_city\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
	$('select[name=\'filter_city\']').on('change', function() {
		$.ajax({
			url: 'index.php?route=localisation/location/city&token=<?php echo $token; ?>&city_id=' + this.value,
			dataType: 'json',
			beforeSend: function() {
				$('select[name=\'filter_city\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
			},
			complete: function() {
				$('.fa-spin').remove();
			},
			success: function(json) {
				html = '<option value=""><?php echo '--Please Select--'; ?></option>';
				if (json['location'] && json['location'] != '') {
					for (i = 0; i < json['location'].length; i++) {
						html += '<option value="' + json['location'][i]['location_id'] + '"';
						html += '>' + json['location'][i]['location_name'] + '</option>';
					}
				} else {
					html += '<option value="" selected="selected"><?php echo '--None--'; ?></option>';
				}
				$('select[name=\'filter_area\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
	//--></script>
</div>
<?php echo $footer; ?>