<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading border-bottom">
		<div class="container-fluid page__container d-flex align-items-center">
			<h3 class="mb-0">Buy Seller Point ID List</h3>
		</div>
	</div>
	
	<div class="container-fluid page__container">
		<div class="card">
			<div class="card-header">
			
				<div class="row">
					<div class="col-md-12"><?php if($status == 0){?> <p style="color:red;">Your Account Pending Withdrawal Point is:<?php echo $student_pending_point;?></p> <?php } ?></div>
					<div class="col-md-12"><p>Total Balance Point: <?php echo $balance_point;?> || 1 Point = <?php echo $money_conversion;?> Rs</p></div>
				</div>
			</div>
			<div class="container-fluid page__container">
				<table class="table table-striped table-bordered nowrap" id="table" width="100%">
					<thead>
						<tr>
							<th class="text-left">ID No</th>
							<th class="text-left">Name</th>
							<th class="text-left">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php if($user_lists){ ?>
						<?php foreach($user_lists as $item){?>
						<tr><td><?php echo $item['username'];?></td><td><?php echo $item['firstname'].' '.$item['lastname'];?></td><td><a data-toggle="modal" data-target="#confirm-status" data-id='<?php echo $item['user_id']; ?>' type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Send Sell Request"><i class="fa fa-edit"></i></a></td></tr>
						<?php } ?>
					<?php } ?>	
					</tbody>
					<tfoot>
						<tr>
							<th class="text-left">ID No</th>
							<th class="text-left">Name</th>
							<th class="text-left">Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>	
	</div>
</div>

<?php $this->load->view('student/footer'); ?>
<div id="confirm-status" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-large-title" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<?php if($status == 0){ ?> 
					<div class="col-md-12"><p style="color:red;">Your Pending Withdrawal Point <?php $student_pending_point;?> is not clear. You can not sell point to any Buy Seller ID.</p></div>
					<?php }else{ ?>
					<div class="col-md-12"><h6 class="modal-title" id="modal-large-title">Minimum Withdrawal Point:<?php echo $minimum_withdrawal_point;?> || 1 Point = <?php echo $money_conversion;?> Rs</h6></div>
					<?php } ?>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div> <!-- // END .modal-header -->
			<div class="modal-body">
				<div id="section-add">
					<?php if($status != 0){ ?> 
						<?php if($balance_point>$minimum_withdrawal_point){ ?>
						<div class="form-group required"><label for="dtp_input2" class="control-label">Point:</label><input type="text" name="point" class="form-control" style="margin-bottom:5px;" value="" /></div>
						<input type="hidden" name="user_id" id="input-user_id" value="" />
						<?php }else{ ?>
						<p>You can not send withdrawal request due to low point.</p>
						<?php } ?>
					<?php } ?>
				</div>
				
				<div id="add-msg"></div>
			</div> <!-- // END .modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
				<?php if($status != 0){ if($balance_point>$minimum_withdrawal_point){?>
				<button type="button" id="button-add" class="btn btn-primary">Send</button>
				<?php } } ?>
			</div> <!-- // END .modal-footer -->
		</div> <!-- // END .modal-content -->
	</div> <!-- // END .modal-dialog -->
</div> <!-- // END .modal -->

<script>
$('#confirm-status').on('show.bs.modal', function(e) {
	var id = ($(e.relatedTarget).data('id'));
	$('#input-user_id').val(id);
});
$('#button-add').click(function(){
	$.ajax({
		url: '<?php echo base_url('student/sellpoint/addrequest'); ?>',
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