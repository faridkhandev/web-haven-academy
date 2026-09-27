<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i>Active <?php echo $text_list; ?></h3>
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
									<label class="control-label" for="input-student_no">Student ID</label>
									<input type="text" name="filter_student_no" value="" id="input-student_no" class="form-control" />
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
									<th class="text-left">No</th>
									<th class="text-left">Name</th>
									<th class="text-left">FB Link</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th class="text-left">No</th>
									<th class="text-left">Name</th>
									<th class="text-left">FB Link</th>
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
		var url = 'index.php?route=module/facebook&token=<?php echo $token; ?>';
		var tableExportColumns = [0,1,2];
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
					var filter_name = $.trim($('input[name=\'filter_name\']').val());
					if (filter_name) {
						data.filter_name = filter_name;
					}
					
					var filter_student_no = $.trim($('input[name=\'filter_student_no\']').val());
					if (filter_student_no) {
						data.filter_student_no = filter_student_no;
					}
				}
			},
			"columns": [
				{"data": "student_no", "orderable": false, "searchable": false},
				{"data": "student_name", "orderable": false, "searchable": false},
				{"data": "student_fb_link", "orderable": false, "searchable": false},
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
			$('#well2').hide();
		});
		
		$('#btn-search').on('click', function() {
			$('#well2').stop().slideToggle('fast', 'linear');
			$('#well').hide();
		});
		
		$('.date').datetimepicker({
			pickTime: false,
			maxDate: moment()
		});
	});
	</script>
	<script type="text/javascript"><!--
	$(document).ready(function () {
		$('#table').on('click', 'tr', function (){
			$('#table tr').css('background-color', '');
			$(this).css('background-color', '#5bc0de');

		});
	});

	//--></script>
	
<?php echo $footer; ?> 