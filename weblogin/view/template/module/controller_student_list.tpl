<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i>Inactive <?php echo $text_list; ?></h3>
				</div>
				<div class="pull-right">
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-xs" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button>
				</div>
				<div class="pull-right">
					<button class="btn btn-warning btn-xs" id="btn-refresh" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></button>
					<button class="btn btn-primary btn-xs" id="btn-search" data-toggle="tooltip" data-placement="top" title="" data-original-title="Search"><i class="fa fa-search"></i></button>
					<button class="btn btn-danger btn-xs" id="btn-form"><i class="fa fa-filter"></i></button>
				</div>	
				<div class="pull-right" style="width:250px;">
					<select name="counsellor_id" class="form-control select2"><option value="">-Select Counsellor-</option><?php foreach($counsellors as $counsellor){ echo '<option value="'.$counsellor['user_id'].'">'.$counsellor['firstname'].' '.$counsellor['lastname'].'-'.$counsellor['user_no'].'</option>'; } ?></select>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="well" id="well2" style="display: none;">
					<div class="row">
						<form enctype="multipart/form-data" id="form-filter">
							<div class="col-sm-9">
								<div class="form-group">
									<label class="control-label" for="input-search">Search By Anything(Name, ID, Phone, Whatsapp, Email, Gender, Language)</label>
									<input type="text" name="filter_search" value="" id="input-search" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3 pull-right">
								<button type="button" id="button-search" class="btn btn-primary pull-right" style="margin-top:22px;"><i class="fa fa-search"></i>Search</button>				
							</div>
						</form>
					</div>
				</div>
				
				<div class="well" id="well" style="display: none;">
					<div class="row">
						<form enctype="multipart/form-data" id="form-filter">
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-name">Name</label>
									<input type="text" name="filter_name" value="" id="input-name" class="form-control" />
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-phone">Phone/Whatsapp</label>
									<input type="text" name="filter_phone" value="" id="input-phone" class="form-control" />
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-email">Email</label>
									<input type="text" name="filter_email" value="" id="input-email" class="form-control" />
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-student_no">Student ID</label>
									<input type="text" name="filter_student_no" value="" id="input-student_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-user_no">Counsellor ID</label>
									<input type="text" name="filter_user_no" value="" id="input-user_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-refer_no">Refer Student ID</label>
									<input type="text" name="filter_refer_no" value="" id="input-refer_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label class="control-label" for="input-language">Language</label>
									<select name="filter_language" class="form-control">
										<option value="">-Please Select-</option>
										<?php foreach($languages as $lang){?>
										<option value="<?php echo $lang['permission_language']; ?>"><?php echo $lang['permission_language']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label class="control-label" for="input-date-added">Student Added Start Date</label>
									<div class="input-group date">
									<input type="text" name="filter_date_added" value="" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control">
									<span class="input-group-btn">
									<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
									</span></div>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label class="control-label" for="input-date-added">Student Added End Date</label>
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
									<th class="text-left">No</th>
									<th class="text-left">Name</th>
									<th class="text-left">Whatsapp</th>
									<th class="text-left">Created At</th>
									<th class="text-left">Councillor</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th style="width: 1px;" class="text-center"></th>
									<th class="text-left">No</th>
									<th class="text-left">Name</th>
									<th class="text-left">Whatsapp</th>
									<th class="text-left">Created At</th>
									<th class="text-left">Councillor</th>
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
		var url = 'index.php?route=module/controllerstudent&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4,5];
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
					
					var filter_email = $.trim($('input[name=\'filter_email\']').val());
					if (filter_email) {
						data.filter_email = filter_email;
					}
					
					var filter_user_no = $.trim($('input[name=\'filter_user_no\']').val());
					if (filter_user_no) {
						data.filter_user_no = filter_user_no;
					}
					
					var filter_student_no = $.trim($('input[name=\'filter_student_no\']').val());
					if (filter_student_no) {
						data.filter_student_no = filter_student_no;
					}
					
					var filter_refer_no = $.trim($('input[name=\'filter_refer_no\']').val());
					if (filter_refer_no) {
						data.filter_refer_no = filter_refer_no;
					}
					
					var filter_date_added = $.trim($('input[name=\'filter_date_added\']').val());
					if (filter_date_added) {
						data.filter_date_added = filter_date_added;
					}
					
					var filter_date_ended = $.trim($('input[name=\'filter_date_ended\']').val());
					if (filter_date_ended) {
						data.filter_date_ended = filter_date_ended;
					}
					
					var filter_language = $.trim($('select[name=\'filter_language\']').val());
					if (filter_language) {
						data.filter_language = filter_language;
					}
					
					var filter_status = $.trim($('select[name=\'filter_status\']').val());
					if (filter_status) {
						data.filter_status = filter_status;
					}
				}
			},
			"columns": [
				{"data": "id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "student_no", "searchable": false},
				{"data": "student_name", "searchable": false},
				{"data": "student_phone", "orderable": false, "searchable": false},
				{"data": "created_at", "orderable": false, "searchable": false},
				{"data": "counsellor", "orderable": false, "searchable": false},
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
	$('.date').datetimepicker({
		pickTime: false
	});
	$('.select2').select2();
	
	$('select[name=\'counsellor_id\']').on('change', function() {
		filter = [];

		$('input[name^=\'selected\']:checked').each(function(element) {
			filter.push(this.value);
		});
		
		if(filter.length == 0){
			alert('Please select Students first.');
		}else{
			$.ajax({
				url: 'index.php?route=student/student/assignstudent&token=<?php echo $token; ?>',
				type: 'POST',  // Changed from GET
				beforeSend: function() {
					$('select[name=\'counsellor_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
				},
				complete: function() {
					$('.fa-spin').remove();
				},
				data: {
					filter: filter.join(','),
					counsellor_id: this.value
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
	
	function setActivate(){
		filter = [];

		$('input[name^=\'selected\']:checked').each(function(element) {
			filter.push(this.value);
		});
		
		if(filter.length == 0){
			alert('Please select Students first.');
		}else{
			$.ajax({
				url: 'index.php?route=student/student/activestudent&token=<?php echo $token; ?>&filter=' + filter.join(','),
				dataType: 'json',
				beforeSend: function() {
					$('#btn-activate').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
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
	}
	//--></script>
<?php echo $footer; ?> 