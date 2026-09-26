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
				</div>
				<div class="pull-right">
					<button class="btn btn-warning btn-xs" id="btn-refresh" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></button>
					<button class="btn btn-primary btn-xs" id="btn-form"><i class="fa fa-filter"></i></button>
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
							<?php if($user_group_id != 14){?>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-start-date">Created Start Date</label>
									<div class="input-group date">
										<input type="text" name="filter_start_date" value="<?php echo $filter_start_date;?>" id="input-start-date" class="form-control">
										<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
									</div>
								</div>	
							</div>
							
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-end-date">Created End Date</label>
									<div class="input-group date">
										<input type="text" name="filter_end_date" value="<?php echo $filter_end_date;?>" id="input-end-date" class="form-control">
										<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
									</div>
								</div>	
							</div>
							<?php } ?>
							<?php if($user_group_id == 12){?>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-user_no">Trainer ID</label>
									<input type="text" name="filter_user_no" value="" id="input-user_no" class="form-control" />
								</div>
							</div>
							<?php } ?>
							
							<?php if($user_group_id == 13){ ?>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-user_no">Trainer ID</label>
									<input type="text" name="filter_user_no" value="" id="input-user_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-team_leader_no">Team Leader ID</label>
									<input type="text" name="filter_team_leader_no" value="" id="input-team_leader_no" class="form-control" />
								</div>
							</div>
							<?php } ?>
							<?php if($user_group_id == 11 || $user_group_id == 12 || $user_group_id == 13){ ?>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-status">Status</label>
									<select name="filter_status" class="form-control">
										<option value="">-Select-</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</div>
							</div>
							<?php } ?>
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
									<th class="text-left">Phone</th>
									<th class="text-left">Email</th>
									<th class="text-left">Whatsapp</th>
									<th class="text-left">Gender</th>
									<th class="text-left">City</th>
									<th class="text-left">Country</th>
									<th class="text-left">Language</th>
									<th class="text-left">Created At</th>
									<?php if($user_group_id == 14){?>
									<th class="text-left">Action</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th class="text-left">No</th>
									<th class="text-left">Name</th>
									<th class="text-left">Phone</th>
									<th class="text-left">Email</th>
									<th class="text-left">Whatsapp</th>
									<th class="text-left">Gender</th>
									<th class="text-left">City</th>
									<th class="text-left">Country</th>
									<th class="text-left">Language</th>
									<th class="text-left">Created At</th>
									<?php if($user_group_id == 14){?>
									<th class="text-left">Action</th>
									<?php } ?>
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
		var url = 'index.php?route=module/mystudent&token=<?php echo $token; ?>';
		var tableExportColumns = [0,1,2,3,4,5,6,7,8,9,10];
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
				{"data": "student_no", "searchable": false},
				{"data": "student_name", "searchable": false},
				{"data": "student_phone", "searchable": false},
				{"data": "student_email", "searchable": false},
				{"data": "student_whatsapp", "searchable": false},
				{"data": "student_gender", "searchable": false},
				{"data": "student_city", "searchable": false},
				{"data": "student_country", "searchable": false},
				{"data": "student_language", "searchable": false},
				{"data": "created_at", "searchable": false},
				<?php if($user_group_id == 14){?>
				{"data": "action", "orderable": false, "searchable": false, "className": "text-center", "render": function(data, type, full) {
					var html ='<a href="#" data-id="'+full.id+'" data-student_no="'+full.student_no+'" data-student_name="'+full.student_name+'" data-student_phone="'+full.student_phone+'" class="btn btn-primary btn-status btn-xs" data-toggle="modal" data-target="#show-status"><span data-toggle="tooltip" data-placement="top" data-original-title="Send Point"><i class="fa fa-paper-plane"></i></span></a>';
					return html;
				}}
				<?php } ?>
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
	$('.select2').select2();
	//--></script>
	
	<div class="modal fade" id="show-status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width:875px">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body">
					<form id="form-pay">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group required"><label for="dtp_input2" class="control-label">Point:</label><input type="text" name="point" class="form-control" style="margin-bottom:5px;" value="" /></div>
								<div class="form-group required"><label for="dtp_input2" class="control-label">Reason:</label><input type="text" name="reason" class="form-control" style="margin-bottom:5px;" value="" /></div>
								<p><textarea name="comment" id="input-note" class="form-control" placeholder="Any additional comments"></textarea></p>
								<input type="hidden" name="id" id="point_id" value=""/>
							</div>
						</div>
					</form>
					<div id="status_rep"></div>
				</div>
				<div class="modal-footer" id="footer-printslip">
					
					<div class="col-sm-12 pull-left">				 
						<button type="button" id="button-bill" data-loading-text="Loading" class="btn btn-danger">Pay Now</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	$('#show-status').on('show.bs.modal', function(e) {
		var id = ($(e.relatedTarget).data('id'));
		var student_no = ($(e.relatedTarget).data('student_no'));
		var student_name = ($(e.relatedTarget).data('student_name'));
		var student_phone = ($(e.relatedTarget).data('student_phone'));
		$('#point_id').val(id);
		$('#myModalLabel').html('ID:'+student_no+'||Name:'+student_name+'||Phone:'+student_phone);

	});
	
	$('#button-bill').click(function(){
		$.ajax({
			url: 'index.php?route=user/withdrawal/payment&token=<?php echo $token; ?>',
			type: 'post',
			dataType: 'json',
			data: $("#form-pay").serialize(),
			beforeSend: function() {
				$('#button-bill').button('loading');
			},
			complete: function() {
				$('#button-bill').button('reset');
			},
			success: function(json) {
				$('.alert-success, .alert-danger').remove();

				if (json['error']) {
					$('#status_rep').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				}

				if (json['success']) {
					$('#footer-printslip').hide();
					$('#status_rep').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
					location.reload();
				}
			}
		});
	});
	</script>
	
<?php echo $footer; ?> 