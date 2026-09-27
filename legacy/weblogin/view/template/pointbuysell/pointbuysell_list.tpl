<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i>Wallet Management</h3>
				</div>
				<div class="pull-right">
					<?php echo $user['firstname'].' '.$user['lastname'];?>-<?php echo $user['email'];?>-<?php echo $user['phone'];?>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<ul class="nav nav-tabs">
				<li class="active"><a href="#tab-buy" data-toggle="tab">Buy</a></li>
				<li><a href="#tab-sell" data-toggle="tab">Sell</a></li>
			  </ul>
			  <div class="tab-content">
				<div class="tab-pane active" id="tab-buy">
					<div class="row">
						<form enctype="multipart/form-data" id="form-buy">
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-type">Type</label>
									<select name="filter_type" id="input-type" class="form-control">
									<option value=""></option>
									<option value="1">Credit</option>
									<option value="2">Debit</option>
									</select>
								</div>				
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-student">Student Id</label>
									<input type="text" name="filter_student_no" value="" id="input-student_no" class="form-control">
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
								<button type="button" id="button-buy-filter" class="btn btn-primary filterBtns pull-right"><i class="fa fa-search"></i> Filter</button>	
							</div>
						</form>
					</div>
					<div class="table-responsive">
						<table class="table table-striped table-bordered nowrap" id="buytable" width="100%">
							<thead>
								<tr>
									<th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
									<th class="text-left">Type</th>
									<th class="text-left">Point</th>
									<th class="text-left">Detail</th>
									<th class="text-left">Created At</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th style="width: 1px;" class="text-center"></th>
									<th class="text-left">Type</th>
									<th class="text-left">Point</th>
									<th class="text-left">Detail</th>
									<th class="text-left">Created At</th>
								</tr>
							</tfoot>
						</table>
					</div>				
				</div>	
				
				<div class="tab-pane" id="tab-sell">
					<div class="row">
						<form enctype="multipart/form-data" id="form-sell">
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-type">Type</label>
									<select name="filter_type" id="input-type" class="form-control">
									<option value=""></option>
									<option value="1">Credit</option>
									<option value="2">Debit</option>
									</select>
								</div>				
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-student">Student Id</label>
									<input type="text" name="filter_student_no" value="" id="input-student_no" class="form-control">
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
								<button type="button" id="button-sell-filter" class="btn btn-primary filterBtns pull-right"><i class="fa fa-search"></i> Filter</button>	
							</div>
						</form>
					</div>
					<div class="table-responsive">
						<table class="table table-striped table-bordered nowrap" id="selltable" width="100%">
							<thead>
								<tr>
									<th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
									<th class="text-left">Type</th>
									<th class="text-left">Point</th>
									<th class="text-left">Student</th>
									<th class="text-left">Created At</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th style="width: 1px;" class="text-center"></th>
									<th class="text-left">Type</th>
									<th class="text-left">Point</th>
									<th class="text-left">Student</th>
									<th class="text-left">Created At</th>
								</tr>
							</tfoot>
						</table>
					</div>				
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {	
		var url = 'index.php?route=pointbuysell/wallet/buy&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4];
		var table1 = $('#buytable').DataTable({
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
					
					var filter_date_added = $.trim($('#form-buy input[name=\'filter_date_added\']').val());
					if (filter_date_added) {
						data.filter_date_added = filter_date_added;
					}
					
					var filter_date_ended = $.trim($('#form-buy input[name=\'filter_date_ended\']').val());
					if (filter_date_ended) {
						data.filter_date_ended = filter_date_ended;
					}
					
					var filter_student_no = $.trim($('#form-buy input[name=\'filter_student_no\']').val());
					if (filter_student_no) {
						data.filter_student_no = filter_student_no;
					}
					
					var filter_type = $.trim($('#form-buy select[name=\'filter_type\']').val());
					if (filter_type) {
						data.filter_type = filter_type;
					}
					
					data.filter_user_id = '<?php echo $current_user_id;?>';
					
				}
			},
			"columns": [
				{"data": "id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "type", "searchable": false},
				{"data": "point", "searchable": false},
				{"data": "detail", "searchable": false},
				{"data": "created_at", "searchable": false}
			],
			buttons: [
				{extend: 'copy', text: '<i class="fa fa-files-o"></i>', titleAttr: 'Copy', exportOptions: {columns: tableExportColumns}},
				{extend: 'print', className: 'btn-info', text: '<i class="fa fa-print"></i>', titleAttr: 'Print', exportOptions: {columns: tableExportColumns}},
				{extend: 'excel', className: 'btn-success', text: '<i class="fa fa-file-excel-o"></i>', titleAttr: 'Excel', exportOptions: {columns: tableExportColumns}},
				{extend: 'pdf', className: 'btn-danger', text: '<i class="fa fa-file-text-o"></i>', titleAttr: 'PDF', exportOptions: {columns: tableExportColumns}},
				{extend: 'pageLength', className: 'btn-primary'},
			]
		});
		
		$('#btn-refresh-buy').on('click', function() {
			$('#form-buy')[0].reset();
			table1.order([]).ajax.reload();
		});
		
		$('#button-buy-filter').on('click', function() {
			table1.ajax.reload();
		});
		
		var url = 'index.php?route=pointbuysell/wallet/sell&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4];
		var table2 = $('#selltable').DataTable({
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
					
					var filter_date_added = $.trim($('#form-sell input[name=\'filter_date_added\']').val());
					if (filter_date_added) {
						data.filter_date_added = filter_date_added;
					}
					
					var filter_date_ended = $.trim($('#form-sell input[name=\'filter_date_ended\']').val());
					if (filter_date_ended) {
						data.filter_date_ended = filter_date_ended;
					}
					
					var filter_student_no = $.trim($('#form-sell input[name=\'filter_student_no\']').val());
					if (filter_student_no) {
						data.filter_student_no = filter_student_no;
					}
					
					var filter_type = $.trim($('#form-sell select[name=\'filter_type\']').val());
					if (filter_type) {
						data.filter_type = filter_type;
					}
					
					data.filter_user_id = '<?php echo $current_user_id;?>';
					
				}
			},
			"columns": [
				{"data": "id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "type", "searchable": false},
				{"data": "point", "searchable": false},
				{"data": "detail", "searchable": false},
				{"data": "created_at", "searchable": false}
			],
			buttons: [
				{extend: 'copy', text: '<i class="fa fa-files-o"></i>', titleAttr: 'Copy', exportOptions: {columns: tableExportColumns}},
				{extend: 'print', className: 'btn-info', text: '<i class="fa fa-print"></i>', titleAttr: 'Print', exportOptions: {columns: tableExportColumns}},
				{extend: 'excel', className: 'btn-success', text: '<i class="fa fa-file-excel-o"></i>', titleAttr: 'Excel', exportOptions: {columns: tableExportColumns}},
				{extend: 'pdf', className: 'btn-danger', text: '<i class="fa fa-file-text-o"></i>', titleAttr: 'PDF', exportOptions: {columns: tableExportColumns}},
				{extend: 'pageLength', className: 'btn-primary'},
			]
		});
		
		$('#btn-refresh-sell').on('click', function() {
			$('#form-sell')[0].reset();
			table2.order([]).ajax.reload();
		});
		
		$('#button-sell-filter').on('click', function() {
			table2.ajax.reload();
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
								<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_info['user_id']; ?>"/>
							</div>
						</div>
					</form>
					<div id="status_rep"></div>
				</div>
				<div class="modal-footer" id="footer-printslip">
					
					<div class="col-sm-12 pull-left">				 
						<button type="button" id="button-bill" data-loading-text="Loading" class="btn btn-danger">Debit Now</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	$('#show-status').on('show.bs.modal', function(e) {
		var id = ($(e.relatedTarget).data('id'));
		var user_no = ($(e.relatedTarget).data('user_no'));
		var name = ($(e.relatedTarget).data('name'));
		$('#point_id').val(id);
		$('#myModalLabel').html('ID:'+user_no+'||Name:'+name);

	});
	
	$('#button-bill').click(function(){
		$.ajax({
			url: 'index.php?route=user/passbook/deductpoint&token=<?php echo $token; ?>',
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