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
									<label class="control-label" for="input-doctor">Filter By</label>
									<select name="filter_doctor_id" id="input-doctor" class="form-control select2">
										<option value="">-Select-</option>
										<?php foreach($doctors as $doctor){ ?>
										<option value="<?php echo $doctor['doctor_id']; ?>" <?php if($filter_doctor_id ==$doctor['doctor_id']) echo 'selected';?> ><?php echo $doctor['doctor_name'].'('.$doctor['doctor_id'].')'; ?></option>
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
							
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-investment">Investment</label>
									<select name="filter_investment_id" id="input-investment" class="form-control select2"></select>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-investment-minimum_amount">Minimum Investment Amount</label>
									<input type="text" name="filter_minimum_investment_amount" value="" id="input-investment_minimum_amount" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-maximum_investment_amount">Maximum Investment Amount</label>
									<input type="text" name="filter_maximum_investment_amount" value="" id="input-maximum_investment_amount" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-limit-minimum_amount">Minimum Limit Amount</label>
									<input type="text" name="filter_minimum_limit_amount" value="" id="input-limit_minimum_amount" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-maximum_limit_amount">Maximum Limit Amount</label>
									<input type="text" name="filter_maximum_limit_amount" value="" id="input-maximum_limit_amount" class="form-control" />
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
		var url = 'index.php?route=report/doctor&token=<?php echo $token; ?>';
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
					
					var filter_minimum_investment_amount = $.trim($('input[name=\'filter_minimum_investment_amount\']').val());
					if (filter_minimum_investment_amount) {
						data.filter_minimum_investment_amount = filter_minimum_investment_amount;
					}
					
					var filter_maximum_investment_amount = $.trim($('input[name=\'filter_maximum_investment_amount\']').val());
					if (filter_maximum_investment_amount) {
						data.filter_maximum_investment_amount = filter_maximum_investment_amount;
					}
					
					var filter_minimum_limit_amount = $.trim($('input[name=\'filter_minimum_limit_amount\']').val());
					if (filter_minimum_limit_amount) {
						data.filter_minimum_limit_amount = filter_minimum_limit_amount;
					}
					
					var filter_maximum_limit_amount = $.trim($('input[name=\'filter_maximum_limit_amount\']').val());
					if (filter_maximum_limit_amount) {
						data.filter_maximum_limit_amount = filter_maximum_limit_amount;
					}
					
					var filter_doctor_id = $.trim($('select[name=\'filter_doctor_id\']').val());
					if (filter_doctor_id) {
						data.filter_doctor_id = filter_doctor_id;
					}
					
					var filter_area_id = $.trim($('select[name=\'filter_area_id\']').val());
					if (filter_area_id) {
						data.filter_area_id = filter_area_id;
					}
					
					var filter_investment_id = $.trim($('select[name=\'filter_investment_id\']').val());
					if (filter_investment_id) {
						data.filter_investment_id = filter_investment_id;
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
			
			var filter_minimum_investment_amount = $.trim($('input[name=\'filter_minimum_investment_amount\']').val());
			if (filter_minimum_investment_amount) {
				str += '&filter_minimum_investment_amount='+filter_minimum_investment_amount;
			}
			
			var filter_maximum_investment_amount = $.trim($('input[name=\'filter_maximum_investment_amount\']').val());
			if (filter_maximum_investment_amount) {
				str += '&filter_maximum_investment_amount='+filter_maximum_investment_amount;
			}
			
			var filter_minimum_limit_amount = $.trim($('input[name=\'filter_minimum_limit_amount\']').val());
			if (filter_minimum_limit_amount) {
				str += '&filter_minimum_limit_amount='+filter_minimum_limit_amount;
			}
			
			var filter_maximum_limit_amount = $.trim($('input[name=\'filter_maximum_limit_amount\']').val());
			if (filter_maximum_limit_amount) {
				str += '&filter_maximum_limit_amount='+filter_maximum_limit_amount;
			}
			
			var filter_doctor_id = $.trim($('select[name=\'filter_doctor_id\']').val());
			if (filter_doctor_id) {
				str += '&filter_doctor_id='+filter_doctor_id;
			}
			
			var filter_area_id = $.trim($('select[name=\'filter_area_id\']').val());
			if (filter_area_id) {
				str += '&filter_area_id='+filter_area_id;
			}
			
			var filter_investment_id = $.trim($('select[name=\'filter_investment_id\']').val());
			if (filter_investment_id) {
				str += '&filter_investment_id='+filter_investment_id;
			}
					
			$.ajax({
				url: 'index.php?route=report/doctor/calculation&token=<?php echo $token; ?>',
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
			
			var filter_minimum_investment_amount = $.trim($('input[name=\'filter_minimum_investment_amount\']').val());
			if (filter_minimum_investment_amount) {
				str += '&filter_minimum_investment_amount='+filter_minimum_investment_amount;
			}
			
			var filter_maximum_investment_amount = $.trim($('input[name=\'filter_maximum_investment_amount\']').val());
			if (filter_maximum_investment_amount) {
				str += '&filter_maximum_investment_amount='+filter_maximum_investment_amount;
			}
			
			var filter_minimum_limit_amount = $.trim($('input[name=\'filter_minimum_limit_amount\']').val());
			if (filter_minimum_limit_amount) {
				str += '&filter_minimum_limit_amount='+filter_minimum_limit_amount;
			}
			
			var filter_maximum_limit_amount = $.trim($('input[name=\'filter_maximum_limit_amount\']').val());
			if (filter_maximum_limit_amount) {
				str += '&filter_maximum_limit_amount='+filter_maximum_limit_amount;
			}
			
			var filter_doctor_id = $.trim($('select[name=\'filter_doctor_id\']').val());
			if (filter_doctor_id) {
				str += '&filter_doctor_id='+filter_doctor_id;
			}
			
			var filter_area_id = $.trim($('select[name=\'filter_area_id\']').val());
			if (filter_area_id) {
				str += '&filter_area_id='+filter_area_id;
			}
			
			var filter_investment_id = $.trim($('select[name=\'filter_investment_id\']').val());
			if (filter_investment_id) {
				str += '&filter_investment_id='+filter_investment_id;
			}
					
			$.ajax({
				url: 'index.php?route=report/doctor/calculation&token=<?php echo $token; ?>',
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
	
	
	$('select[name=\'filter_doctor_id\']').on('change', function() {
		$.ajax({
			url: 'index.php?route=localisation/zone/doctorarea&token=<?php echo $token; ?>&doctor_id=' + this.value,
			dataType: 'json',
			beforeSend: function() {
				$('select[name=\'filter_doctor_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
			},
			complete: function() {
				$('.fa-spin').remove();
			},
			success: function(json) {
				html = '<option value=""><?php echo '--Please Select--'; ?></option>';
				if (json['areas'] && json['areas'] != '') {
					for (i = 0; i < json['areas'].length; i++) {
						html += '<option value="' + json['areas'][i]['location_id'] + '"';
						html += '>' + json['areas'][i]['location_name'] + '</option>';
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
		
		$.ajax({
			url: 'index.php?route=module/investment/doctorinvestment&token=<?php echo $token; ?>&doctor_id=' + this.value,
			dataType: 'json',
			beforeSend: function() {
				$('select[name=\'filter_doctor_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
			},
			complete: function() {
				$('.fa-spin').remove();
			},
			success: function(json) {
				html = '<option value=""><?php echo '--Please Select--'; ?></option>';
				if (json['investments'] && json['investments'] != '') {
					for (i = 0; i < json['investments'].length; i++) {
						html += '<option value="' + json['investments'][i]['doctor_investment_id'] + '"';
						html += '>' + json['investments'][i]['text'] + '</option>';
					}
				} else {
					html += '<option value="" selected="selected"><?php echo '--None--'; ?></option>';
				}
				$('select[name=\'filter_investment_id\']').html(html);
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
	
	</script>
</div>
<?php echo $footer; ?>