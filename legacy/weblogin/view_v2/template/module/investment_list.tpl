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
					<a href="<?php echo $add; ?>" data-toggle="tooltip" title="Add Doctor Investment" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-xs" onclick="confirm('Are you sure?') ? $('#form-type').submit() : false;"><i class="fa fa-trash-o"></i></button>
				</div>
				<div class="pull-right">
					<button class="btn btn-danger btn-xs" id="btn-loading" data-toggle="tooltip" data-placement="top" title="Refresh Page"><i class="fa fa-spinner"></i></button>
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
									<label class="control-label" for="input-doctor">Select Doctor</label>
									<select name="filter_doctor_id" id="input-doctor" class="form-control select2">
										<option value="">-Select-</option>
										<?php foreach($doctors as $doctor){ ?>
										<option value="<?php echo $doctor['doctor_id']; ?>" <?php if($filter_doctor_id ==$doctor['doctor_id']) echo 'selected';?> ><?php echo $doctor['doctor_name'].'('.$doctor['doctor_id'].')'; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-minimum_investment_amount">Minimum Investment Amount</label>
									<input type="text" name="minimum_investment_amount" value="" id="input-minimum_investment_amount" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-maximum_investment_amount">Maximum Investment Amount</label>
									<input type="text" name="maximum_investment_amount" value="" id="input-maximum_investment_amount" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-minimum_limit_amount">Minimum Limit Amount</label>
									<input type="text" name="minimum_limit_amount" value="" id="input-minimum_limit_amount" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-maximum_limit_amount">Maximum Limit Amount</label>
									<input type="text" name="maximum_limit_amount" value="" id="input-maximum_limit_amount" class="form-control" />
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
									<label class="control-label" for="input-investment_status">Investment Status</label>
									<select name="filter_investment_status" id="input-investment_status" class="form-control">
										<option value="">-Select-</option>
										<option value="1">Pending</option>
										<option value="2">Complete</option>
									</select>
								</div>
							</div>
							<div class="col-sm-3">			
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
									<th class="text-left">Doctor</th>
									<th class="text-left">Note</th>
									<th class="text-left">Inv. Amount</th>
									<th class="text-left">Limit Amount</th>
									<th class="text-left">Status</th>
									<th class="text-left">Date Added</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<th class="text-center"></th>
									<th class="text-left">Doctor</th>
									<th class="text-left">Note</th>
									<th class="text-left">Inv. Amount</th>
									<th class="text-left">Limit Amount</th>
									<th class="text-left">Status</th>
									<th class="text-left">Date Added</th>
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
		var url = 'index.php?route=module/investment&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4,5,6];
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
					
					var minimum_investment_amount = $.trim($('input[name=\'minimum_investment_amount\']').val());
					if (minimum_investment_amount) {
						data.minimum_investment_amount = minimum_investment_amount;
					}
					
					var maximum_investment_amount = $.trim($('input[name=\'maximum_investment_amount\']').val());
					if (maximum_investment_amount) {
						data.maximum_investment_amount = maximum_investment_amount;
					}
					
					var minimum_limit_amount = $.trim($('input[name=\'minimum_limit_amount\']').val());
					if (minimum_limit_amount) {
						data.minimum_limit_amount = minimum_limit_amount;
					}
					
					var maximum_limit_amount = $.trim($('input[name=\'maximum_limit_amount\']').val());
					if (maximum_limit_amount) {
						data.maximum_limit_amount = maximum_limit_amount;
					}
					
					var filter_doctor_id = $.trim($('select[name=\'filter_doctor_id\']').val());
					if (filter_doctor_id) {
						data.filter_doctor_id = filter_doctor_id;
					}
					
					var filter_investment_status = $.trim($('select[name=\'filter_investment_status\']').val());
					if (filter_investment_status) {
						data.filter_investment_status = filter_investment_status;
					}
					<?php if(isset($doctor_investment_id)){?>
					var doctor_investment_id = <?php echo $doctor_investment_id;?>;
					if (doctor_investment_id) {
						data.doctor_investment_id = doctor_investment_id;
					}
					<?php } ?>
				}
			},
			"columns": [
				{"data": "doctor_investment_id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "doctor_name", "searchable": false},
				{"data": "description", "searchable": false},
				{"data": "investment_amount", "searchable": false},
				{"data": "limit_amount", "searchable": false},
				{"data": "investment_status", "searchable": false, "render": invstatus},
				{"data": "date_added", "searchable": false},
				{"data": "action", "orderable": false, "searchable": false, "className": "text-center", "render": function(data, type, full) {
					if(full.investment_status == 1){
					return '<a href="<?php echo $edit;?>&doctor_investment_id=' + data + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Edit Investment"><i class="fa fa-pencil"></i></a>';
					}else{
						return 'Goal Reach';
					}
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
		
		$('#btn-loading').on('click', function() {
			window.location.href = 'index.php?route=module/investment&token=<?php echo $token;?>';
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
</div>
<?php echo $footer; ?>