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
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-xs" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button>
				</div>
				<div class="pull-right">
					<button class="btn btn-warning btn-xs" id="btn-refresh" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></button>
					<button class="btn btn-primary btn-xs" id="btn-search" data-toggle="tooltip" data-placement="top" title="" data-original-title="Search"><i class="fa fa-search"></i></button>
					<button class="btn btn-primary btn-xs" id="btn-form"><i class="fa fa-filter"></i></button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="well" id="well2" style="display: none;">
					<div class="row">
						<form enctype="multipart/form-data" id="form-filter">
							<div class="col-sm-9">
								<div class="form-group">
									<label class="control-label" for="input-search">Search By Anything(Name, ID, Phone, Whatsapp, Email, Gender, Language, Trainer Name)</label>
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
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-name">Name</label>
									<input type="text" name="filter_name" value="" id="input-name" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-phone">Phone/Whatsapp</label>
									<input type="text" name="filter_phone" value="" id="input-phone" class="form-control" />
								</div>
							</div>
<!--
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-email">Email</label>
									<input type="text" name="filter_email" value="" id="input-email" class="form-control" />
								</div>
							</div>
-->
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-student_no">Student ID</label>
									<input type="text" name="filter_student_no" value="" id="input-student_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-user_no">Trainer ID</label>
									<input type="text" name="filter_user_no" value="" id="input-user_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-counsellor_no">Counsellor ID</label>
									<input type="text" name="filter_counsellor_no" value="" id="input-counsellor_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-refer_no">Refer Student ID</label>
									<input type="text" name="filter_refer_no" value="" id="input-refer_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-date-added">Start Date</label>
									<div class="input-group date">
									<input type="text" name="filter_date_added" value="" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control">
									<span class="input-group-btn">
									<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
									</span></div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-date-added">End Date</label>
									<div class="input-group date">
									<input type="text" name="filter_date_ended" value="" data-date-format="YYYY-MM-DD" id="input-date-ended" class="form-control">
									<span class="input-group-btn">
									<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
									</span></div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-date-added">Act. St. Date</label>
									<div class="input-group date">
									<input type="text" name="filter_activated_start_date" value="" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control">
									<span class="input-group-btn">
									<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
									</span></div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-date-added">Act. En. Date</label>
									<div class="input-group date">
									<input type="text" name="filter_activated_end_date" value="" data-date-format="YYYY-MM-DD" id="input-date-ended" class="form-control">
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
<!--									<th class="text-left">Email</th>-->
									<th class="text-left">Point</th>
									<th class="text-left">Refer By</th>
									<th class="text-left">Trainer</th>
									<th class="text-left">Counsellor</th>
									<th class="text-left">Activated At</th>
									<th class="text-right">Action</th>
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
<!--									<th class="text-left">Email</th>-->
									<th class="text-left">Point</th>
									<th class="text-left">Refer By</th>
									<th class="text-left">Trainer</th>
									<th class="text-left">Counsellor</th>
									<th class="text-left">Activated At</th>
									<th class="text-right">Action</th>
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
		var url = 'index.php?route=student/student&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4,5,6,7,8,9,10,11,12,13];
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
					
//					var filter_email = $.trim($('input[name=\'filter_email\']').val());
//					if (filter_email) {
//						data.filter_email = filter_email;
//					}
					
					var filter_user_no = $.trim($('input[name=\'filter_user_no\']').val());
					if (filter_user_no) {
						data.filter_user_no = filter_user_no;
					}
					
					var filter_counsellor_no = $.trim($('input[name=\'filter_counsellor_no\']').val());
					if (filter_counsellor_no) {
						data.filter_counsellor_no = filter_counsellor_no;
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
					
					var filter_activated_start_date = $.trim($('input[name=\'filter_activated_start_date\']').val());
					if (filter_activated_start_date) {
						data.filter_activated_start_date = filter_activated_start_date;
					}
					
					var filter_activated_end_date = $.trim($('input[name=\'filter_activated_end_date\']').val());
					if (filter_activated_end_date) {
						data.filter_activated_end_date = filter_activated_end_date;
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
				{"data": "student_phone", "searchable": false},
//				{"data": "student_email", "searchable": false},
				{"data": "student_point", "searchable": false},
				{"data": "student_refer_name", "searchable": false},
				{"data": "trainer_name", "searchable": false},
				{"data": "counsellor_name", "searchable": false},
				{"data": "activated_at", "searchable": false},
				{"data": "action", "width":"14%", "orderable": false, "searchable": false, "className": "text-center", "render": function(data, type, full) {
					var html = '<a href="<?php echo $edit;?>&id=' + data + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil"></i></a>';
					html += '&nbsp;<a target="_blank" href="<?php echo $passbook;?>&id=' + data + '&student_no=' + full.student_no + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Show Passbook"><i class="fa fa-book"></i></a>';
					html += '&nbsp;<a target="_blank" href="<?php echo $withdrawal;?>&id=' + data + '&student_no=' + full.student_no + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Show Withdrawal Request"><i class="fa fa-hand-lizard-o"></i></a>';
					html += '&nbsp;<a target="_blank" href="<?php echo $payment;?>&id=' + data + '&student_no=' + full.student_no + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Show Payment History"><i class="fa fa-money"></i></a>';
					html += '&nbsp;<a data-toggle="modal" data-target="#confirm-status" data-id=' + data + ' data-user_no=' + full.student_no + ' data-name="' + full.student_name + '" data-phone="' + full.student_phone_raw + '" data-whatsapp="' + full.student_whatsapp + '" class="btn btn-primary btn-xs"><span data-toggle="tooltip" data-placement="top" data-original-title="Send Point"><i class="fa fa-share"></i></span></a>';
					html += '&nbsp;<a onclick="confirm(\'Do you want to block this student?\') ? blockStudent(' + data + ') : false;" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Block Student"><i class="fa fa-ban"></i></a>';
					if(full.admin_approve == 1 && full.is_point_requested == 1 && full.is_point_send == 0){
					html += '&nbsp;<a onclick="confirm(\'Do you want to send link joining point for this student?\') ? sendLinkJoiningStudent(' + data + ') : false;" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Block Student"><i class="fa fa-check"></i></a>';
					}
					if(full.admin_approve == 0 && full.joining_point == 10000){
					html += '&nbsp;<a data-toggle="modal" data-target="#confirm-join" data-id=' + data + ' data-user_no=' + full.student_no + ' data-name="' + full.student_name + '" data-phone="' + full.student_phone_raw + '" class="btn btn-primary btn-xs"><span data-toggle="tooltip" data-placement="top" data-original-title="Approve Group Join Point"><i class="fa fa-thumbs-up"></i></span></a>';
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
	
	function blockStudent(student_id){
		$.ajax({
			url: 'index.php?route=student/student/blockstudent&token=<?php echo $token ?>',
			type: 'get',
			data: 'student_id='+student_id,
			dataType: 'json',
			success: function(json) {
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
	
	function sendLinkJoiningStudent(student_id){
		$.ajax({
			url: 'index.php?route=student/student/sendlinkjoiningstudent&token=<?php echo $token ?>',
			type: 'get',
			data: 'student_id='+student_id,
			dataType: 'json',
			success: function(json) {
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
	//--></script>
	<div class="modal fade" id="confirm-status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body" style="min-height:140px">
					<div id="section-add">
						<div class="form-group"><label for="dtp_input2" class="control-label">Point:</label><input type="text" name="point" class="form-control" style="margin-bottom:5px;" value="" /></div>
						
						<div class="form-group"><label for="dtp_input2" class="control-label">Reason:</label><input type="text" name="reason" class="form-control" style="margin-bottom:5px;" value="" /></div>
						
						<p><textarea name="payment_note" id="input-note" class="form-control" placeholder="Any additional comments"></textarea></p>
						<input type="hidden" name="student_id" value="" />
					</div>
					
					<div id="add-msg"></div>
				</div>
				<div class="modal-footer" id="footer-add">
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					<button type="button" id="button-add" data-loading-text="Loading" class="btn btn-danger">Save</button>
				</div>
			</div>
		</div>
	</div>
	<script>
	$('#confirm-status').on('show.bs.modal', function(e) {
		var id = ($(e.relatedTarget).data('id'));
		var user_no = ($(e.relatedTarget).data('user_no'));
		var name = ($(e.relatedTarget).data('name'));
		var phone = ($(e.relatedTarget).data('phone'));
		$('#section-add input[name=\'student_id\']').val(id);
		$('#myModalLabel').html('ID:'+user_no+' Name:'+name+' Phone:'+phone);
	});
	$('#button-add').click(function(){
		$.ajax({
			url: 'index.php?route=student/student/addpoint&token=<?php echo $token ?>',
			type: 'post',
			data: $('#section-add input[type=\'text\'], #section-add input[type=\'hidden\'], #section-add textarea'),
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
					$('#add-msg').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					$('#footer-add').hide();
					$('#add-msg').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '  <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
	</script>	
	<div class="modal fade" id="confirm-join" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabelj"></h4>
				</div>
				<div class="modal-body" style="min-height:140px">
					<div id="section-join">
					    <p>Do you want to approve the group join point. After approve, student can see this join point and request to withdraw.</p>
						<input type="hidden" name="student_id" value="" />
					</div>
					
					<div id="join-msg"></div>
				</div>
				<div class="modal-footer" id="footer-join">
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					<button type="button" id="button-join" data-loading-text="Loading" class="btn btn-danger">Yes</button>
				</div>
			</div>
		</div>
	</div>
	<script>
	$('#confirm-join').on('show.bs.modal', function(e) {
		var id = ($(e.relatedTarget).data('id'));
		var user_no = ($(e.relatedTarget).data('user_no'));
		var name = ($(e.relatedTarget).data('name'));
		var phone = ($(e.relatedTarget).data('phone'));
		$('#section-join input[name=\'student_id\']').val(id);
		$('#myModalLabelj').html('ID:'+user_no+' Name:'+name+' Phone:'+phone);
	});
	$('#button-join').click(function(){
		$.ajax({
			url: 'index.php?route=student/student/joinpoint&token=<?php echo $token ?>',
			type: 'post',
			data: $('#section-join input[type=\'text\'], #section-join input[type=\'hidden\'], #section-join textarea'),
			dataType: 'json',
			beforeSend: function() {
				$('#button-join').button('loading');
			},
			complete: function() {
				 $('#button-join').button('reset');
			},
			success: function(json) {
				$('.alert, .text-danger').remove();
				if (json['error']) {
					$('#join-msg').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					$('#footer-join').hide();
					$('#join-msg').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '  <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
	</script>
<?php echo $footer; ?> 