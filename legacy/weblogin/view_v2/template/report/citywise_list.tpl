<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i> Headquater Doctor Report</h3>
				</div>
				<div class="pull-left">
					
				</div>
				<div class="pull-right">
					
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
						<form enctype="multipart/form-data" name="form-filter" id="form-filter">
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-city">Select Headquater</label>
									<select name="filter_city" id="input-city" class="form-control select2">
										<option value="">-Select-</option>
										<?php foreach($cities as $city){ ?>
										<option value="<?php echo $city['city_id']; ?>"><?php echo $city['name']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-area">Area</label>
									<select name="filter_area_id" id="input-area" class="form-control select2" multiple></select>
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
									<th class="text-left">Doctor</th>
									<th class="text-left">Investment No</th>
									<th class="text-left">Inv. Amount</th>
									<th class="text-left">Limit Amount</th>
									<th class="text-left">Sale Amount</th>
									<th class="text-left">Area</th>
									<th class="text-left">Note</th>
									<th class="text-left">Date Added</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<th class="text-center"></th>
									<th class="text-left">Doctor</th>
									<th class="text-left">Investment No</th>
									<th class="text-left">Inv. Amount</th>
									<th class="text-left">Limit Amount</th>
									<th class="text-left">Sale Amount</th>
									<th class="text-left">Area</th>
									<th class="text-left">Note</th>
									<th class="text-left">Date Added</th>
								</tr>
							</tfoot>
						</table>
						<table class="table table-bordered table-hover table-striped nowrap" cellspacing="0" width="100%">
							<tr><td><strong>Total Investment</strong></td><td>Rs. <strong id="inv-amount"><?php echo $summmery['investment']; ?></strong></td><td><strong>Total Sales</strong></td><td>Rs. <strong id="sale-amount"><?php echo $summmery['sales']; ?>(<?php echo $summmery['percentage']; ?>%)</strong></td></tr>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {	
		var url = 'index.php?route=report/citywise&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4,5,6,7,8];
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
					var filter_start_date = $.trim($('input[name=\'filter_start_date\']').val());
					if (filter_start_date) {
						data.filter_start_date = filter_start_date;
					}
					
					var filter_end_date = $.trim($('input[name=\'filter_end_date\']').val());
					if (filter_end_date) {
						data.filter_end_date = filter_end_date;
					}
					
					var filter_city = $.trim($('select[name=\'filter_city\']').val());
					if (filter_city) {
						data.filter_city = filter_city;
					}
					
					var filter_area_id = $.trim($('select[name=\'filter_area_id\']').val());
					if (filter_area_id) {
						data.filter_area_id = filter_area_id;
					}
				}
			},
			"columns": [
				{"data": "doctor_transaction_id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "doctor_name", "searchable": false},
				{"data": "doctor_investment_id", "searchable": false},
				{"data": "investment_amount", "searchable": false},
				{"data": "limit_amount", "searchable": false},
				{"data": "amount", "searchable": false},
				{"data": "location_name", "searchable": false},
				{"data": "description", "searchable": false},
				{"data": "date_added", "searchable": false}
				
			],
			buttons: [
				{extend: 'copy', text: '<i class="fa fa-files-o"></i>', titleAttr: 'Copy', exportOptions: {columns: tableExportColumns}},
				{extend: 'print', className: 'btn-info', text: '<i class="fa fa-print"></i>', titleAttr: 'Print', exportOptions: {columns: tableExportColumns}},
				{extend: 'excel', className: 'btn-success', text: '<i class="fa fa-file-excel-o"></i>', titleAttr: 'Excel', exportOptions: {columns: tableExportColumns}},
				{extend: 'pdf', className: 'btn-danger', text: '<i class="fa fa-file-text-o"></i>', titleAttr: 'PDF', exportOptions: {columns: tableExportColumns}},
				{extend: 'pageLength', className: 'btn-primary'},
			],
		});
		
		
		$('#btn-refresh').on('click', function() {
			$('#form-filter')[0].reset();
			//need to create a function to manage this ajax in future
			str = '';
			
			var filter_start_date = $.trim($('input[name=\'filter_start_date\']').val());
			if (filter_start_date) {
				str += '&filter_start_date='+filter_start_date;
			}
			
			var filter_end_date = $.trim($('input[name=\'filter_end_date\']').val());
			if (filter_end_date) {
				str += '&filter_end_date='+filter_end_date;
			}
			
			var filter_city = $.trim($('select[name=\'filter_city\']').val());
			if (filter_city) {
				str += '&filter_city='+filter_city;
			}
			
			var filter_area_id = $.trim($('select[name=\'filter_area_id\']').val());
			if (filter_area_id) {
				str += '&filter_area_id='+filter_area_id;
			}
					
			$.ajax({
				url: 'index.php?route=report/citywise/calculation&token=<?php echo $token; ?>',
				type: 'post',
				dataType: 'json',
				data: str,
				dataType: 'json',
				success: function(json) {
					
					$('#inv-amount').html(json['investment']);
					$('#sale-amount').html(json['sales']);
				}
			});
			table.order([]).ajax.reload();
		});
		
		$('#button-filter').on('click', function() {
			str = '';
			var filter_start_date = $.trim($('input[name=\'filter_start_date\']').val());
			if (filter_start_date) {
				str += '&filter_start_date='+filter_start_date;
			}
			
			var filter_end_date = $.trim($('input[name=\'filter_end_date\']').val());
			if (filter_end_date) {
				str += '&filter_end_date='+filter_end_date;
			}
			
			var filter_city = $.trim($('select[name=\'filter_city\']').val());
			if (filter_city) {
				str += '&filter_city='+filter_city;
			}
			
			var filter_area_id = $.trim($('select[name=\'filter_area_id\']').val());
			if (filter_area_id) {
				str += '&filter_area_id='+filter_area_id;
			}
					
			$.ajax({
				url: 'index.php?route=report/citywise/calculation&token=<?php echo $token; ?>',
				type: 'post',
				dataType: 'json',
				data: str,
				dataType: 'json',
				success: function(json) {
					
					$('#inv-amount').html(json['investment']);
					$('#sale-amount').html(json['sales']);
				}
			});
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
				$('select[name=\'filter_area_id\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
		
	});
	</script>
</div>
<?php echo $footer; ?>