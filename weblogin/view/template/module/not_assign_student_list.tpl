<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i>Not Assign <?php echo $text_list; ?></h3>
				</div>
				<div class="pull-right">
				</div>
				<div class="pull-right">
					<button class="btn btn-warning btn-xs" id="btn-refresh" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></button>
					<button class="btn btn-primary btn-xs" id="btn-form"><i class="fa fa-filter"></i></button>
				</div>
				<div class="pull-right" style="width:250px;">
					<select name="trainer_id" class="form-control select2"><option value="">-Select Trainer-</option><?php foreach($trainers as $trainer){ echo '<option value="'.$trainer['user_id'].'">'.$trainer['firstname'].' '.$trainer['lastname'].'-'.$trainer['user_no'].'</option>'; } ?></select>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="well" id="well2" style="display: none;">
					<div class="row">
						<form enctype="multipart/form-data" id="form-filter">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label" for="input-search">Search By Anything</label>
									<input type="text" name="filter_search" value="" id="input-search" class="form-control" />
								</div>
							</div>
							<div class="col-sm-6 pull-right">
								<button type="button" id="button-search" class="btn btn-primary pull-right" style="margin-top:22px;"><i class="fa fa-search"></i>Search</button>				
							</div>
						</form>
					</div>
				</div>
				
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
									<label class="control-label" for="input-phone">Phone</label>
									<input type="text" name="filter_phone" value="" id="input-phone" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-whatsapp">Whatsapp</label>
									<input type="text" name="filter_whatsapp" value="" id="input-whatsapp" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-email">Email</label>
									<input type="text" name="filter_email" value="" id="input-email" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-student_no">Student ID</label>
									<input type="text" name="filter_student_no" value="" id="input-student_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-refer_no">Refer Student ID</label>
									<input type="text" name="filter_refer_no" value="" id="input-refer_no" class="form-control" />
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
									<th class="text-left">SL</th>
									<th class="text-left">No</th>
									<th class="text-left">Name</th>
									<th class="text-left">Phone</th>
									<th class="text-left">Whatsapp</th>
									<th class="text-left">Telegram</th>
									<th class="text-left">Gender</th>
									<th class="text-left">City</th>
									<th class="text-left">Country</th>
									<th class="text-left">Language</th>
									<th class="text-left">Created At</th>
									<th class="text-left">Refer</th>
									<th class="text-left">Status</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th class="text-left">SL</th>
									<th class="text-left">No</th>
									<th class="text-left">Name</th>
									<th class="text-left">Phone</th>
									<th class="text-left">Whatsapp</th>
									<th class="text-left">Telegram</th>
									<th class="text-left">Gender</th>
									<th class="text-left">City</th>
									<th class="text-left">Country</th>
									<th class="text-left">Language</th>
									<th class="text-left">Created At</th>
									<th class="text-left">Refer</th>
									<th class="text-left">Status</th>
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
		var url = 'index.php?route=module/assignstudent&token=<?php echo $token; ?>';
		var tableExportColumns = [0,1,2,3,4,5,6,7,8,9,10,11,12,13];
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
					
					var filter_name = $.trim($('input[name=\'filter_name\']').val());
					if (filter_name) {
						data.filter_name = filter_name;
					}
					
					var filter_phone = $.trim($('input[name=\'filter_phone\']').val());
					if (filter_phone) {
						data.filter_phone = filter_phone;
					}
					
					var filter_whatsapp = $.trim($('input[name=\'filter_whatsapp\']').val());
					if (filter_whatsapp) {
						data.filter_whatsapp = filter_whatsapp;
					}
					
					var filter_email = $.trim($('input[name=\'filter_email\']').val());
					if (filter_email) {
						data.filter_email = filter_email;
					}
					
					var filter_student_no = $.trim($('input[name=\'filter_student_no\']').val());
					if (filter_student_no) {
						data.filter_student_no = filter_student_no;
					}
					
					var filter_refer_no = $.trim($('input[name=\'filter_refer_no\']').val());
					if (filter_refer_no) {
						data.filter_refer_no = filter_refer_no	;
					}
					
					var filter_user_no = $.trim($('input[name=\'filter_user_no\']').val());
					if (filter_user_no) {
						data.filter_user_no = filter_user_no;
					}
					
					var filter_team_leader_no = $.trim($('input[name=\'filter_team_leader_no\']').val());
					if (filter_team_leader_no) {
						data.filter_team_leader_no = filter_team_leader_no;
					}
					
					var filter_status = $.trim($('select[name=\'filter_status\']').val());
					if (filter_status) {
						data.filter_status = filter_status;
					}
					
					var filter_start_date = $.trim($('input[name=\'filter_start_date\']').val());
					if (filter_start_date) {
						data.filter_start_date = filter_start_date;
					}
					
					var filter_end_date = $.trim($('input[name=\'filter_end_date\']').val());
					if (filter_end_date) {
						data.filter_end_date = filter_end_date;
					}
				}
			},
			"columns": [
				{"data": "id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "student_no", "searchable": false},
				{"data": "student_name", "searchable": false},
				{"data": "student_phone", "searchable": false},
				{"data": "student_whatsapp", "searchable": false},
				{"data": "student_telegram", "searchable": false},
				{"data": "student_gender", "searchable": false},
				{"data": "student_city", "searchable": false},
				{"data": "student_country", "searchable": false},
				{"data": "student_language", "searchable": false},
				{"data": "created_at", "searchable": false},
				{"data": "student_refer_name", "searchable": false, "orderable": false},
				{"data": "student_status", "searchable": false, "orderable": false}
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
			/* $('#form-filter')[0].reset();
			table.order([]).ajax.reload(); */
			location.reload();
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
			pickDate: true,
			pickTime: false,
			format: 'YYYY-MM-DD',
			inline: false,
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
	$('.select2').select2();
	
	$('select[name=\'trainer_id\']').on('change', function() {
		filter = [];

		$('input[name^=\'selected\']:checked').each(function(element) {
			filter.push(this.value);
		});
		
		if(filter.length == 0){
			alert('Please select Students first.');
		}else{
			$.ajax({
				url: 'index.php?route=module/assignstudent/assign&token=<?php echo $token; ?>&trainer_id=' + this.value+'&filter=' + filter.join(','),
				dataType: 'json',
				beforeSend: function() {
					$('select[name=\'trainer_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
				},
				complete: function() {
					$('.fa-spin').remove();
				},
				success: function(json) {
					if(json['success']){
						alert(json['success']);
						location.reload();
					}else{
						alert(json['error']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	});
	//--></script>
	
	
<?php echo $footer; ?> 