<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading border-bottom">
		<div class="container-fluid page__container d-flex align-items-center">
			<h1 class="mb-0">Withdrawal</h1>
			<a href="<?php echo base_url('student/withdrawal/add');?>" class="btn btn-success ml-auto"><i class="material-icons">add</i> New Withdrawal Request</a>
		</div>
	</div>
	
	<div class="container-fluid page__container">
		<div class="card">
			<div class="card-header">
				<p>Minimum Withdrawal Point is:<span class="badge badge-success"><?php echo $minimum_withdrawal_point;?></span></p>
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
							<th class="text-left">Status</th>
							<th class="text-left">Approve At</th>
							<th class="text-left">Cancel At</th>
							<th class="text-left">Comment</th>
						</tr>
					</thead>
					<tbody></tbody>
					<tfoot>
						<tr>
							<th class="text-left">Request Point</th>
							<th class="text-left">Requested At</th>
							<th class="text-left">Status</th>
							<th class="text-left">Approve At</th>
							<th class="text-left">Cancel At</th>
							<th class="text-left">Comment</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>	
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {	
	var url = '<?php echo base_url('student/withdrawal'); ?>';
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
			{"data": "withdrawal_point", "searchable": false},
			{"data": "requested_at", "searchable": false},
			{"data": "approve_status", "searchable": false},
			{"data": "approve_at", "searchable": false},
			{"data": "cancelled_at", "searchable": false},
			{"data": "comment", "searchable": false}
		]
	});
	
	$('#button-filter').on('click', function() {
		table.ajax.reload();
	});
});
</script>								
<?php $this->load->view('student/footer'); ?>