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
				<div class="pull-right">
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-xs" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
									<label class="control-label" for="input-reason">Reason</label>
									<input type="text" name="filter_reason" value="" id="input-reason" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-type">Type</label>
									<select name="filter_type" id="input-type" class="form-control">
									<option value=""></option>
									<option value="Credit">Credit</option>
									<option value="Debit">Debit</option>
									</select>
								</div>				
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-date-added">Point Date Added</label>
									<div class="input-group date">
									<input type="text" name="filter_date_added" value="" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control">
									<span class="input-group-btn">
									<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
									</span></div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-date-added">Point Date Ended</label>
									<div class="input-group date">
									<input type="text" name="filter_date_ended" value="" data-date-format="YYYY-MM-DD" id="input-date-ended" class="form-control">
									<span class="input-group-btn">
									<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
									</span></div>
								</div>
							</div>
							<div class="col-sm-3">
								<button type="button" id="button-filter" class="btn btn-primary filterBtns pull-right"><i class="fa fa-search"></i> Filter</button>	
							</div>
						</form>
					</div>
				</div>
				<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-user">
					<div class="table-responsive">
						<table class="table table-striped table-bordered nowrap" id="table" width="100%">
							<thead>
								<tr>
									<th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
									<th class="text-left">Reason</th>
									<th class="text-left">Description</th>
									<th class="text-left">Credit Point</th>
									<th class="text-left">Debit Point</th>
									<th class="text-left">Balance</th>
									<th class="text-left">Created At</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th style="width: 1px;" class="text-center"></th>
									<th class="text-left">Reason</th>
									<th class="text-left">Description</th>
									<th class="text-left">Credit Point</th>
									<th class="text-left">Debit Point</th>
									<th class="text-left">Balance</th>
									<th class="text-left">Created At</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {	
		var url = 'index.php?route=module/passbook&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4,5,6];
		var table = $('#table').DataTable({
			"dom": "Bfrtip",
			"searching": false,
			"order": [],
			"processing": false,
			"serverSide": true,
			"pageLength": <?php echo $page_length; ?>,
			"lengthMenu": [[10,20,50,100, 250, 500, 750, 1000], [10,20,50,100, 250, 500, 750, 1000]],
			"ajax": {
				"url": url,
				"type": "POST",
				"data": function (data) {
					var filter_search = $.trim($('input[name=\'filter_search\']').val());
					if (filter_search) {
						data.filter_search = filter_search;
					}
					
					var filter_reason = $.trim($('input[name=\'filter_reason\']').val());
					if (filter_reason) {
						data.filter_reason = filter_reason;
					}
					
					var filter_date_added = $.trim($('input[name=\'filter_date_added\']').val());
					if (filter_date_added) {
						data.filter_date_added = filter_date_added;
					}
					
					var filter_date_ended = $.trim($('input[name=\'filter_date_ended\']').val());
					if (filter_date_ended) {
						data.filter_date_ended = filter_date_ended;
					}
					
					var filter_type = $.trim($('select[name=\'filter_type\']').val());
					if (filter_type) {
						data.filter_type = filter_type;
					}
				}
			},
			"columns": [
				{"data": "id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "reason", "searchable": false},
				{"data": "description", "searchable": false},
				{"data": "credit_point", "searchable": false},
				{"data": "debit_point", "searchable": false},
				{"data": "balance_point", "searchable": false},
				{"data": "created_at", "searchable": false}
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
		
		$('#button-search').on('click', function() {
			table.ajax.reload();
		});
		
		$('#button-reset-filter').on('click', function() {
			location.reload();
		});
		
		$('#btn-form').on('click', function() {
			$('#well').stop().slideToggle('fast', 'linear');
		});
		
		
		$('.date').datetimepicker({
			pickTime: false,
			maxDate: moment()
		});
	});
	</script>
	<script type="text/javascript"><!--
	$('.date').datetimepicker({
	pickTime: false
	});
	$('.select2').select2();
	//--></script>
<?php echo $footer; ?> 