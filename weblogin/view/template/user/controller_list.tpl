<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<?php /* ?>
	<div class="page-header">
	<div class="container-fluid">
	<div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
	<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button>
	</div>
	<h1><?php echo $heading_title; ?></h1>
	<ul class="breadcrumb">
	<?php foreach ($breadcrumbs as $breadcrumb) { ?>
	<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
	<?php } ?>
	</ul>
	</div>
	</div>
  <?php */ ?>
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
				</div>
				<div class="pull-right">
					<a href="<?php echo $add; ?>" data-toggle="tooltip" title="Add" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
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
									<label class="control-label" for="input-user_no">Counsellor Id</label>
									<input type="text" name="filter_user_no" value="" id="input-user_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">			
								<div class="form-group">
									<label class="control-label" for="input-status">Status</label>
									<select name="filter_status" id="input-status" class="form-control">
										<option value=""></option>
										<option value="1">Enabled</option>
										<option value="0">Disabled</option>
									</select>
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
									<th class="text-left">Email</th>
									<th class="text-left">Phone</th>
									<th class="text-left">Whatsapp</th>
									<th class="text-left">Permission Lang</th>
									<th class="text-left">Created At</th>
									<th class="text-left">Status</th>
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
									<th class="text-left">Email</th>
									<th class="text-left">Phone</th>
									<th class="text-left">Whatsapp</th>
									<th class="text-left">Permission Lang</th>
									<th class="text-left">Created At</th>
									<th class="text-left">Status</th>
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
		var url = 'index.php?route=user/controller&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4,5,6,7];
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
					
					var filter_status = $.trim($('select[name=\'filter_status\']').val());
					if (filter_status) {
						data.filter_status = filter_status;
					}
				}
			},
			"columns": [
				{"data": "user_id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "user_no", "searchable": false},
				{"data": "name", "searchable": false},
				{"data": "email", "searchable": false},
				{"data": "phone", "searchable": false},
				{"data": "whatsapp", "searchable": false},
				{"data": "permission_language", "searchable": false},
				{"data": "date_added", "searchable": false},
				{"data": "status", "searchable": false, "render": status},
				{"data": "action", "orderable": false, "searchable": false, "className": "text-center", "render": function(data, type, full) {
					var html = '<a href="<?php echo $edit;?>&controller_id=' + data + '&user_no=' + full.user_no + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil"></i></a>';
					html += '&nbsp;<a target="_blank" href="<?php echo $passbook;?>&id=' + data + '&user_no=' + full.user_no + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Show Passbook"><i class="fa fa-book"></i></a>';
					html += '&nbsp;<a target="_blank" href="<?php echo $withdrawal;?>&id=' + data + '&user_no=' + full.user_no + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Show Withdrawal Request"><i class="fa fa-hand-lizard-o"></i></a>';
					html += '&nbsp;<a target="_blank" href="<?php echo $payment;?>&id=' + data + '&user_no=' + full.user_no + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Show Payment History"><i class="fa fa-money"></i></a>';
					html += '&nbsp;<a target="_blank" href="<?php echo $student;?>&id=' + data + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Show Student List"><i class="fa fa-users"></i></a>';
					html += '&nbsp;<a href="<?php echo $attendance;?>&meeting_time_id=0" type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Counsellor Attendance"><i class="fa fa-clock-o"></i></a>';
					html += '&nbsp;<a data-toggle="modal" data-target="#confirm-status" data-id=' + data + ' data-user_no=' + full.user_no + ' data-name="' + full.name + '" data-phone="' + full.phone + '" data-whatsapp="' + full.whatsapp + '" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Send Point"><i class="fa fa-share"></i></a>';
					
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
		
		$('#button-reset-filter').on('click', function() {
			location.reload();
		});
		
		$('#btn-form').on('click', function() {
			$('.well').stop().slideToggle('fast', 'linear');
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
						<input type="hidden" name="user_id" value="" />
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
		$('#section-add input[name=\'user_id\']').val(id);
		$('#myModalLabel').html('ID:'+user_no+' Name:'+name+' Phone:'+phone);
	});
	$('#button-add').click(function(){
		$.ajax({
			url: 'index.php?route=user/user/addpoint&token=<?php echo $token ?>',
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
<?php echo $footer; ?> 