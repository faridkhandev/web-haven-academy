<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?>(Minimum Withdrawal Point:<?php echo $minimum_withdrawal_point;?> || Request Withdrawal Point:<?php echo $user_request_point;?> || Balance Point: <?php echo $user_point;?> || Final Balance Point After Request: <?php echo ($user_point-$user_request_point);?>|| 1 Point = <?php echo $subadmin_money_conversion;?> Rs)</h3>
				</div>
				<div class="pull-right">
					<button type="button" data-toggle="modal" data-target="#confirm-status" class="btn btn-primary btn-xs"><i class="fa fa-plus" data-toggle="tooltip" title="Withdrawal Request" ></i></button>
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
									<label class="control-label" for="input-status">Withdrawal Status</label>
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
									<label class="control-label" for="input-date-added">Withdrawal Date Added</label>
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
									<th class="text-left">Point</th>
									<th class="text-left">Medium</th>
									<th class="text-left">Approve Status</th>
									<th class="text-left">Requested At</th>
									<th class="text-left">Approve At</th>
									<th class="text-left">Cancelled At</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th style="width: 1px;" class="text-center"></th>
									<th class="text-left">Point</th>
									<th class="text-left">Medium</th>
									<th class="text-left">Approve Status</th>
									<th class="text-left">Requested At</th>
									<th class="text-left">Approve At</th>
									<th class="text-left">Cancelled At</th>
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
		var url = 'index.php?route=module/withdrawal&token=<?php echo $token; ?>';
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
					var filter_status = $.trim($('select[name=\'filter_status\']').val());
					if (filter_status) {
						data.filter_status = filter_status;
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
				{"data": "withdrawal_point", "searchable": false},
				{"data": "payment_medium", "searchable": false},
				{"data": "approve_status", "searchable": false},
				{"data": "requested_at", "searchable": false},
				{"data": "approve_at", "searchable": false},
				{"data": "cancelled_at", "searchable": false}
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
	<div class="modal fade" id="confirm-status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Minimum Withdrawal Point:<?php echo $minimum_withdrawal_point;?> || 1 Point = <?php echo $subadmin_money_conversion;?> Rs</h4>
				</div>
				<div class="modal-body" style="min-height:140px">
					<div id="section-add">
						<div class="form-group required"><label for="dtp_input2" class="control-label">Point:</label><input type="text" name="withdrawal_point" class="form-control" style="margin-bottom:5px;" value="" /></div>
						
						<div class="form-group required"><label for="dtp_input2" class="control-label">Select Payment Medium:</label>
						<select name="payment_medium" class="form-control"><option value="">-Please Select-</option><?php foreach($user_payment_medium as $medium){?><option value="<?php echo $medium['medium_name'].'-'.$medium['medium_code']; ?>"><?php echo $medium['medium_name'].' - '.$medium['medium_code']; ?></option><?php } ?></select>
						</div>
						
						<p><textarea name="withdrawal_message" id="input-note" class="form-control" placeholder="Any additional message(optional)"></textarea></p>
					</div>
					
					<div id="add-msg"></div>
				</div>
				<div class="modal-footer" id="footer-add">
					<?php if(!empty($user_payment_medium)){?>
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					<button type="button" id="button-add" data-loading-text="Loading" class="btn btn-danger">Send</button>
					<?php }else{ ?>
					<p class="pull-left">No Payment Medium Added. Please add by editing your profile</p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<script>
	$('#button-add').click(function(){
		$.ajax({
			url: 'index.php?route=module/withdrawal/addrequest&token=<?php echo $token ?>',
			type: 'post',
			data: $('#section-add input[type=\'text\'], #section-add input[type=\'hidden\'], #section-add select, #section-add textarea'),
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
					
					location.reload();
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
	</script>	
<?php echo $footer; ?> 