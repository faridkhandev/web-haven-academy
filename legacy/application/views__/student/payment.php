<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading border-bottom">
		<div class="container-fluid page__container">
			<h1 class="mb-0">Payment List</h1>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<form name="form_filter" enctype="multipart/form-data" id="form-filter" class="form-inline">
					<label class="mr-sm-2" for="inlineFormFilterBy">Start Date:</label>

					<label class="sr-only" for="inlineFormRole">Start Date</label>
					<input type="text" class="form-control mb-3 mr-sm-3 mb-sm-0 flatpickrStart" name="filter_start_date" placeholder="YYYY-MM-DD" value="<?php echo $filter_start_date;?>">
					
					<label class="mr-sm-2" for="inlineFormFilterBy">End Date:</label>
					<label class="sr-only" for="inlineFormRole">End Date</label>
					<input type="text" class="form-control mb-3 mr-sm-3 mb-sm-0 flatpickrEnd" placeholder="YYYY-MM-DD" name="filter_end_date" placeholder="YYYY-MM-DD" value="<?php echo $filter_end_date;?>">

					<div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
						<div class="ml-auto"><button type="button" class="btn btn-success" id="button-filter"> Filter</button></div>
					</div>
				</form>
		</div>
		<div class="container-fluid page__container">
			<div class="table-responsive">
				<table class="table table-striped table-bordered nowrap" id="table" width="100%">
					<thead>
						<tr>
							<th class="text-left">Amount</th>
							<th class="text-left">Withdrawal Point</th>
							<th class="text-left">Rate</th>
							<th class="text-left">Transaction Id</th>
							<th class="text-left">Payment Medium</th>
							<th class="text-left">Payment Date</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
					<tfoot>
						<tr>
							<th class="text-left">Amount</th>
							<th class="text-left">Withdrawal Point</th>
							<th class="text-left">Rate</th>
							<th class="text-left">Transaction Id</th>
							<th class="text-left">Payment Medium</th>
							<th class="text-left">Payment Date</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {	
	var url = '<?php echo base_url('student/payment'); ?>';
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
				
				var filter_type = $.trim($('select[name=\'filter_type\']').val());
				if (filter_type) {
					data.filter_type = filter_type;
				}
			}
		},
		"columns": [
			{"data": "reason", "searchable": false},
			{"data": "credit_point", "searchable": false},
			{"data": "debit_point", "searchable": false},
			{"data": "balance_point", "searchable": false},
			{"data": "created_at", "searchable": false},		
			{"data": "description", "searchable": false}
		]
	});
	
	$('#button-filter').on('click', function() {
		table.ajax.reload();
	});
});
</script>					
<?php $this->load->view('student/footer'); ?>