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
					<a href="<?php echo $add; ?>" data-toggle="tooltip" title="Add Session" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
					<?php if($user_group_id != 14){ ?>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_copy; ?>" class="btn btn-default btn-xs" onclick="$('#form-type').attr('action', '<?php echo $copy; ?>').submit()"><i class="fa fa-copy"></i></button>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-xs" onclick="confirm('Are you sure?') ? $('#form-type').submit() : false;"><i class="fa fa-trash-o"></i></button>
					<?php } ?>
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
							
							<div class="col-sm-3">			
								<div class="form-group">
									<label class="control-label" for="input-course">Course</label>
									<select name="filter_course" id="input-course" class="form-control">
									<option value=""></option>
									<?php foreach($courses as $item){?>
									<option value="<?php echo $item['course_id'];?>"><?php echo $item['course_name'];?></option>
									<?php } ?>
									</select>
								</div>		
							</div>
							<?php if($user_group_id != 14){?>
							<div class="col-sm-3">			
								<div class="form-group">
									<label class="control-label" for="input-teacher">Teacher</label>
									<select name="filter_teacher" id="input-teacher" class="form-control">
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
									<th class="text-left">Course Name</th>
									<th class="text-left">Session No</th>
									<th class="text-left">Session Date</th>
									<th class="text-left">Session Teacher</th>
									<th class="text-left">Session Point</th>
									<th class="text-left">Created At</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<th class="text-center"></th>
									<th class="text-left">Course Name</th>
									<th class="text-left">Session No</th>
									<th class="text-left">Session Date</th>
									<th class="text-left">Session Teacher</th>
									<th class="text-left">Session Point</th>
									<th class="text-left">Created At</th>
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
		var url = 'index.php?route=module/session&token=<?php echo $token; ?>';
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
					
					var filter_course = $.trim($('select[name=\'filter_course\']').val());
					if (filter_course) {
						data.filter_course = filter_course;
					}
					
					var filter_teacher = $.trim($('select[name=\'filter_teacher\']').val());
					if (filter_teacher) {
						data.filter_teacher = filter_teacher;
					}
				}
			},
			"columns": [
				{"data": "session_id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "course_name", "searchable": false},
				{"data": "session_no", "searchable": false},
				{"data": "session_date", "searchable": false},
				{"data": "teacher_name", "searchable": false},
				{"data": "session_point", "searchable": false},
				{"data": "created_at", "searchable": false},
				{"data": "action", "width":"10%", "orderable": false, "searchable": false, "className": "text-center", "render": function(data, type, full) {
					return '<a href="<?php echo $edit;?>&session_id=' + data + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Edit Course"><i class="fa fa-pencil"></i></a>&nbsp;<a href="<?php echo $view;?>&session_id=' + data + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View Student Work"><i class="fa fa-eye"></i></a>';
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
</div>
<?php echo $footer; ?>