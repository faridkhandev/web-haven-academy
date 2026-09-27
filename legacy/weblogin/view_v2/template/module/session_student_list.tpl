<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i> Session <?php echo $session_info['session_no'] ?>|| Course:<?php echo $session_info['course_name'];?></h3>
				</div>
				<div class="pull-left">
					
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
							<?php /* ?>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-start-date">Session Start Date</label>
									<div class="input-group date">
										<input type="text" name="filter_start_date" value="" id="input-start-date" class="form-control">
										<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
									</div>
								</div>	
							</div>
							
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-end-date">Session End Date</label>
									<div class="input-group date">
										<input type="text" name="filter_end_date" value="" id="input-end-date" class="form-control">
										<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
									</div>
								</div>	
							</div>
							<?php */ ?>
							<div class="col-sm-3">			
								<div class="form-group">
									<label class="control-label" for="input-course">Student No</label>
									<input type="text" name="student_no" value="" class="form-control" />
								</div>		
							</div>
							<?php if($user_group_id != 14){?>
							<div class="col-sm-3">			
								<div class="form-group">
									<label class="control-label" for="input-teacher">Teacher</label>
									<select name="filter_teacher_id" id="input-teacher" class="form-control">
									<option value=""></option>
									<?php foreach($teachers as $item){?>
									<option value="<?php echo $item['user_id'];?>"><?php echo $item['firstname'].' '.$item['lastname'];?></option>
									<?php } ?>
									</select>
								</div>		
							</div>
							<?php } ?>
							<div class="col-sm-4">
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
									<th class="text-left">Student Name</th>
									<th class="text-left">Student No</th>
									<th class="text-left">Work</th>
									<th class="text-left">Point</th>
									<th class="text-left">Added At</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<th class="text-center"></th>
									<th class="text-left">Student Name</th>
									<th class="text-left">Student No</th>
									<th class="text-left">Work</th>
									<th class="text-left">Point</th>
									<th class="text-left">Added At</th>
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
		var url = 'index.php?route=module/session/view&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4,5];
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
					
					var filter_student = $.trim($('select[name=\'filter_student\']').val());
					if (filter_student) {
						data.filter_student = filter_student;
					}
					
					var filter_teacher_id = $.trim($('select[name=\'filter_teacher_id\']').val());
					if (filter_teacher_id) {
						data.filter_teacher_id = filter_teacher_id;
					}
					
					data.session_id = '<?php echo $session_id;?>';
				}
			},
			"columns": [
				{"data": "id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "student_name", "searchable": false},
				{"data": "student_no", "searchable": false},
				{"data": "work_link", "searchable": false},
				{"data": "point", "searchable": false},
				{"data": "date_added", "searchable": false},
				{"data": "action", "width":"10%", "orderable": false, "searchable": false, "className": "text-center", "render": function(data, type, full) {
					if(full.point_status == 2){ 
					var text = 'Point For Course:'+ full.course_name+' & Session:'+full.session_no; 
					var html = '&nbsp;<a data-toggle="modal" onclick="confirm(\'Are you sure?\') ? sendPoint(' + full.student_id + ',' + full.session_point + ',\''+text+ '\') : false;" data-id=' + data + ' data-user_no=' + full.student_no + ' data-name="' + full.student_name + '" class="btn btn-primary btn-xs"><span data-toggle="tooltip" data-placement="top" data-original-title="Send Point"><i class="fa fa-share"></i></span></a>';
					}else{
						var html = '';
					}
					return html;
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
	
	
	function sendPoint(student_id, point, text){
		$.ajax({
			url: 'index.php?route=module/session/addpoint&token=<?php echo $token; ?>',
			type: 'post',
			data: 'student_id='+student_id+'&point='+point+'&reason='+text,
			dataType: 'json',
			beforeSend: function() {
				$('#button-add').button('loading');
			},
			complete: function() {
				 $('#button-add').button('reset');
			},
			success: function(json) {
				$('.alert, .text-danger').remove();
				if (json['error']) {
					alert(json['error']);
				}
				
				if (json['success']) {
					alert(json['success']);
					location.reload();
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
	</script>
</div>
<?php echo $footer; ?>