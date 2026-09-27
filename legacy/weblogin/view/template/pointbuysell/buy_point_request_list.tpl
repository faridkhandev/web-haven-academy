<?php echo $header; ?>
<?php echo $column_left; ?>
<style>
.redClass{
	color:red;
}
</style>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i>Buy Point Request By Student</h3>
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
				
				<div class="well" id="well" style="display: none;">
					<div class="row">
						<form enctype="multipart/form-data" id="form-filter">
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-student_no">Student ID</label>
									<input type="text" name="filter_student_no" value="" id="input-student_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-buysell_no">Point Buy Seller ID</label>
									<input type="text" name="filter_buysell_no" value="" id="input-buysell_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">			
								<div class="form-group">
									<label class="control-label" for="input-status">Status</label>
									<select name="filter_status" id="input-status" class="form-control">
									<option value=""></option>
									<option value="Pending">Pending</option>
									<option value="Cancel">Cancel</option>
									<option value="Paid">Paid</option>
									</select>
								</div>		
							</div>
							
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-date-added">Request At Started</label>
									<div class="input-group date">
									<input type="text" name="filter_date_added" value="" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control">
									<span class="input-group-btn">
									<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
									</span></div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-date-added">Withdrawal Date Ended</label>
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
									<th class="text-left">Student ID</th>
									<th class="text-left">Student Name</th>
									<th class="text-left">Withdrawal Point</th>
									<th class="text-left">BuySell ID</th>
									<th class="text-left">Status</th>
									<th class="text-left">Requested At</th>
									<th class="text-left">Approve At</th>
									<th class="text-left">Cancelled At</th>
									<th class="text-left">Screenshot</th>
									<th class="text-left">Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th style="width: 1px;" class="text-center"></th>
									<th class="text-left">Student ID</th>
									<th class="text-left">Student Name</th>
									<th class="text-left">Withdrawal Point</th>
									<th class="text-left">BuySell ID</th>
									<th class="text-left">Status</th>
									<th class="text-left">Requested At</th>
									<th class="text-left">Approve At</th>
									<th class="text-left">Cancelled At</th>
									<th class="text-left">Screenshot</th>
									<th class="text-left">Action</th>
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
		var url = 'index.php?route=pointbuysell/buyrequest&token=<?php echo $token; ?>';
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
					var filter_student_no = $.trim($('input[name=\'filter_student_no\']').val());
					if (filter_student_no) {
						data.filter_student_no = filter_student_no;
					}
					
					var filter_buysell_no = $.trim($('input[name=\'filter_buysell_no\']').val());
					if (filter_buysell_no) {
						data.filter_buysell_no = filter_buysell_no;
					}
					
					var filter_status = $.trim($('select[name=\'filter_status\']').val());
					if (filter_status) {
						data.filter_status = filter_status;
					}
					
					var filter_date_added = $.trim($('input[name=\'filter_date_added\']').val());
					if (filter_date_added) {
						data.filter_date_added = filter_date_added;
					}
					
					var filter_date_ended = $.trim($('input[name=\'filter_date_ended\']').val());
					if (filter_date_ended) {
						data.filter_date_ended = filter_date_ended;
					}
				}
			},
			"columns": [
				{"data": "id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "student_no", "searchable": false},
				{"data": "student_name", "searchable": false},
				{"data": "point", "searchable": false},
				{"data": "user_no", "searchable": false},
				{"data": "status", "searchable": false},
				{"data": "requested_at", "searchable": false},
				{"data": "approve_at", "searchable": false},
				{"data": "cancelled_at", "searchable": false},
				{"data": "screenshot", "orderable": false, "searchable": false},
				{"data": "action", "orderable": false, "searchable": false, "className": "text-center", "render": function(data, type, full) {
					if(full.status=='Pending'){
						var html ='<a data-toggle="modal" data-target="#confirm-status" data-id=' + data + ' data-status="' + full.status + '" data-student_name="' + full.student_name + '" class="btn btn-success btn-sm"><span data-toggle="tooltip" data-placement="top" data-original-title="Make Payment"><i class="fa fa-paper-plane"></i></span></a>';
						
						html +='<a class="btn btn-warning btn-sm" onclick="confirm(\'Are you sure for raising an issue?\') ? raiseIssue('+full.id+') : false;"><span data-toggle="tooltip" data-placement="top" data-original-title="Raise issue"><i class="fa fa-bell"></i></span></a>';
					}else if(full.status=='Paid'){
						if(full.complain_by_user == 1){
							if(full.is_transfer == 1){
								html +='<a class="btn btn-warning btn-sm" onclick="confirm(\'Are you sure for raising an issue?\') ? raiseIssue('+full.id+') : false;"><span data-toggle="tooltip" data-placement="top" data-original-title="Raise issue"><i class="fa fa-bell"></i></span></a>';
							}
						}
					}else{
						var html ='';
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
			],
			
			"fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				if ((aData['complain_by_user'] == 2)) {
					$('td', nRow).addClass('redClass');
				}
			}
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
	
	function acceptPoint(id){
		$.ajax({
			url: 'index.php?route=pointbuysell/buyrequest/acceptPoint&token=<?php echo $token; ?>&id='+id,
			type: 'post',
			dataType: 'json',
			success: function(json) {
				alert(json['message']);
				location.reload();
			}
		});
	}
	
	function raiseIssue(id){
		$.ajax({
			url: 'index.php?route=pointbuysell/buyrequest/issue&token=<?php echo $token; ?>&id='+id,
			type: 'post',
			dataType: 'json',
			success: function(json) {
				alert(json['message']);
				location.reload();
			}
		});
	}
	</script>
	<script type="text/javascript"><!--
	$('.date').datetimepicker({
	pickTime: false
	});
	$('.select2').select2();
	
	//--></script>
	<div class="modal fade" id="confirm-status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form id="form" action="#" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body" style="min-height:140px">
					<div id="section-add">
						<div class="form-group"><label for="dtp_input2" class="control-label">Status:</label><select class="form-control" style="margin-bottom:5px;" name="status" id="lstatus"><option value="Paid">Paid</option></select></div>
						<div class="form-group"><label for="dtp_input2" class="control-label">Upload Screenshot(Image only):</label><input type="file" name="file" class="form-control" style="margin-bottom:5px;" value="" /></div>
						<input type="hidden" name="id" value="" />
					</div>
					
					<div id="add-msg"></div>
				</div>
				<div class="modal-footer" id="footer-add">
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					<button type="button" id="button-add" data-loading-text="Loading" class="btn btn-danger">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$('#confirm-status').on('show.bs.modal', function(e) {
	var id = ($(e.relatedTarget).data('id'));
	var status = ($(e.relatedTarget).data('status'));
	var student_name = ($(e.relatedTarget).data('student_name'));
	var name = student_name;
	
	$('#section-add input[name=\'id\']').val(id);
	//$('#section-add input[name=\'status\']').val(nextstatus);
	$('#myModalLabel').html('Name:'+name+' || Current Status:<b style="color:red;">'+status+'</b>');
});

$('#button-add').click(function(){
	$.ajax({
		url: 'index.php?route=pointbuysell/buyrequest/updatestatus&token=<?php echo $token ?>',
		type: 'post',
		dataType: 'json',
		data: new FormData($('#form')[0]),
		cache: false,
		contentType: false,
		processData: false,
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
				//table.ajax.reload();
				setTimeout(function () {window.location.href = "index.php?route=pointbuysell/buyrequest&token=<?php echo $token ?>"; }, 2000);
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
</script>
<?php echo $footer; ?> 