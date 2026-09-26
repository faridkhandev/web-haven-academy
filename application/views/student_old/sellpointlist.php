<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading border-bottom">
		<div class="container-fluid page__container d-flex align-items-center">
			<h1 class="mb-0">Sell Point Request List</h1>
		</div>
	</div>
	
	<div class="container-fluid page__container">
		<div class="card">
			<div class="card-header">
				<form name="form_filter" enctype="multipart/form-data" id="form-filter" class="form-inline">
					<label class="mr-sm-2" for="inlineFormFilterBy">Start Date:</label>

					<label class="sr-only" for="inlineFormRole">Start Date</label>
					<input type="text" class="form-control mb-3 mr-sm-3 mb-sm-0 flatpickrStart" name="filter_start_date" placeholder="YYYY-MM-DD" value="<?php echo $filter_start_date;?>">
					
					<label class="mr-sm-2" for="inlineFormFilterBy">End Date:</label>
					<label class="sr-only" for="inlineFormRole">End Date</label>
					<input type="text" class="form-control mb-3 mr-sm-3 mb-sm-0 flatpickrEnd" placeholder="YYYY-MM-DD" name="filter_end_date" placeholder="YYYY-MM-DD" value="<?php echo $filter_end_date;?>">
					
					<label class="mr-sm-2" for="inlineFormFilterBy">Status:</label>
					<label class="sr-only" for="inlineFormRole">Status</label>
					<select name="filter_approve_status" class="form-control mb-3 mr-sm-3 mb-sm-0">
						<option value="">-Select-</option>
						<option value="Paid">Approve</option>
						<option value="Pending">Pending</option>
						<option value="Cancel">Cancel</option>
					</select>

					<div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
						<div class="ml-auto"><button type="button" class="btn btn-success" id="button-filter"> Filter</button></div>
					</div>
				</form>
			</div>
			<div class="container-fluid page__container">
				<table class="table table-striped table-bordered nowrap" id="table" width="100%">
					<thead>
						<tr>
							<th class="text-left">Request Point</th>
							<th class="text-left">Requested At</th>
							<th class="text-left">Buyer ID</th>
							<th class="text-left">Status</th>
							<th class="text-left">Screenshot</th>
							<th class="text-left">Approve At</th>
							<th class="text-left">Cancel At</th>
							<th class="text-left">Action</th>
						</tr>
					</thead>
					<tbody></tbody>
					<tfoot>
						<tr>
							<th class="text-left">Request Point</th>
							<th class="text-left">Requested At</th>
							<th class="text-left">Buyer ID</th>
							<th class="text-left">Status</th>
							<th class="text-left">Screenshot</th>
							<th class="text-left">Approve At</th>
							<th class="text-left">Cancel At</th>
							<th class="text-left">Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>	
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {	
	var url = '<?php echo base_url('student/sellpointlist'); ?>';
	var table = $('#table').DataTable({
		"stateSave": true,
		"scrollY": "100%",
		//"dom": "lftipr",
		"scrollX":true,
		//"dom": '<"top"lip>rt<"bottom"><"clear">',
		//"dom": "Bfrtip",
		"searching": false,
		"order": [],
		"processing": false,
		"serverSide": true,
		"lengthMenu": [[10,20,50,100, 250, 500, 750, 1000,-1], [10,20,50,100, 250, 500, 750, 1000,"All"]],
		"pageLength": 20,
		"ajax": {
			"url": url,
			"type": "POST",
			"data": function (data) {
				var filter_end_date = $.trim($('input[name=\'filter_end_date\']').val());
				if (filter_end_date) {
					data.filter_end_date = filter_end_date;
				}
				
				var filter_start_date = $.trim($('input[name=\'filter_start_date\']').val());
				if (filter_start_date) {
					data.filter_start_date = filter_start_date;
				}
				
				var filter_approve_status = $.trim($('input[name=\'filter_approve_status\']').val());
				if (filter_approve_status) {
					data.filter_approve_status = filter_approve_status;
				}
			}
		},
		"columns": [
			{"data": "point", "searchable": false},
			{"data": "requested_at", "searchable": false},
			{"data": "username", "searchable": false},
			{"data": "status", "searchable": false},
			{"data": "screenshot", "searchable": false},
			{"data": "approve_at", "searchable": false},
			{"data": "cancelled_at", "searchable": false},
			{"data": "action", "width":"10%", "orderable": false, "searchable": false, "className": "text-center", "render": function(data, type, full) {
				var html ='';
				if(full.raw_status == 'Pending'){
					html +='<a onclick="confirm(\'Are you sure?\') ? makeComplain('+full.id+') : false;" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" data-title="Make complain agenist this request">Complain</a>';
					
				}
				if(full.raw_status == 'Paid'){
					if(full.is_transfer == 1){
						html +='<a onclick="confirm(\'Are you sure?\') ? makeComplain('+full.id+') : false;" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" data-title="Make complain agenist this request">Complain</a>&nbsp;<a onclick="confirm(\'Are you sure?\') ? makeAccept('+full.id+') : false;" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Confirm Payment Receive">Confirm Payment</a>';
						
					}
				}
				return html;
			}}		
		]
	});
	
	$('#button-filter').on('click', function() {
		table.ajax.reload();
	});
});

function makeComplain(id){
	$.ajax({
		url: '<?php echo base_url('student/sellpointlist/complain'); ?>',
		type: 'post',
		data: 'id='+id,
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

function makeAccept(id){
	$.ajax({
		url: '<?php echo base_url('student/sellpointlist/accept'); ?>',
		type: 'post',
		data: 'id='+id,
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
</script>				
<?php $this->load->view('student/footer'); ?>
<div id="modal-large" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-large-title" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
				<div class="col-md-12"><?php if($status == 0){?> <p style="color:red;">Your Pending Withdrawal Point <?php $student_pending_point;?> is not clear. Admin will deduct the Pending Point from your account first, then remaning point amount will be transfer to your account.</p> <?php } ?></div>
				<div class="col-md-12"><h6 class="modal-title" id="modal-large-title">Minimum Withdrawal Point:<?php echo $minimum_withdrawal_point;?> || 1 Point = <?php echo $money_conversion;?> Rs</h6></div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
			</div> <!-- // END .modal-header -->
			<div class="modal-body">
				<div id="section-add">
					<?php if($balance_point>$minimum_withdrawal_point){?>
					<div class="form-group required"><label for="dtp_input2" class="control-label">Point:</label><input type="text" name="withdrawal_point" class="form-control" style="margin-bottom:5px;" value="" /></div>
					
					<div class="form-group required"><label for="dtp_input2" class="control-label">Select Payment Medium:</label>
					<?php if(!empty($payment_medium)){?>
					<select name="payment_medium" class="form-control">
					<option value="">-Please Select-</option>
					<?php foreach($payment_medium as $item){?>
					<option value="<?php echo $item['medium_name'];?> - <?php echo $item['medium_code'];?>"><?php echo $item['medium_name'];?> - <?php echo $item['medium_code'];?></option>
					<?php } ?>
					</select>
					<?php }else{ ?>
					<p>No Withdrawal Medium Added. Please add from <a href="<?php echo base_url('student/medium'); ?>">here</a>.</p>
					<?php } ?>
					</div>
					
					<p><textarea name="withdrawal_message" id="input-note" class="form-control" placeholder="Any additional message(optional)"></textarea></p>
					<?php }else{ ?>
					<p>You can not send withdrawal request due to low point.</p>
					<?php } ?>
				</div>
				
				<div id="add-msg"></div>
			</div> <!-- // END .modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
				<?php if($balance_point>$minimum_withdrawal_point){?>
				<button type="button" id="button-add" class="btn btn-primary">Send</button>
				<?php } ?>
			</div> <!-- // END .modal-footer -->
		</div> <!-- // END .modal-content -->
	</div> <!-- // END .modal-dialog -->
</div> <!-- // END .modal -->

<script>
$('#button-add').click(function(){
	$.ajax({
		url: '<?php echo base_url('student/withdrawal/addrequest'); ?>',
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