<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left w50">
					<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
				</div>
				<div class="pull-left">
					
				</div>
				<div class="pull-right">
					<a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary  btn-xs"><i class="fa fa-plus"></i></a>
					
					<button type="button" data-toggle="tooltip" title="Download Excel File" class="btn successBg excel btn-xs" onclick="$('#form-customer').attr('action', '<?php echo $excel; ?>');confirm('Do you want to download excel file?') ? $('#form-customer').submit() : false;"><i class="fa fa-file-excel-o"></i></button>
					
					<button type="button" data-toggle="tooltip" title="Download Pdf File" class="btn dangerBg pdf btn-xs" onclick="$('#form-customer').attr('action', '<?php echo $pdf; ?>');confirm('Do you want to download pdf file?') ? $('#form-customer').submit() : false;"><i class="fa fa-file-pdf-o"></i></button>
					<?php /* ?>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger  btn-xs" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-customer').submit() : false;"><i class="fa fa-trash-o"></i></button>
					<?php */ ?>
				</div>
				<div class="pull-right">
					<button class="btn btn-warning btn-xs" id="btn-refresh" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></button>
					<button class="btn btn-xs warningBg" id="btn-form"><i class="fa fa-filter"></i></button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="well" id="well" style="display: none;">
					<div class="row">
						<form name="form_filter" enctype="multipart/form-data" id="form-filter">							
							<div class="col-sm-3">	
								<div class="form-group">
									<label class="control-label" for="input-customer-type">Customer Type</label>
									<select name="filter_group" id="input-type" class="form-control">
										<option value=""></option>
										<?php foreach ($types as $type) { ?>
										<option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
									<input type="text" name="filter_name" value="" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
									<input type="text" name="filter_email" value="" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
									<input type="text" name="filter_telephone" value="" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
								</div>
							</div>							
							<div class="col-sm-4">							
								<div class="form-group">
									<label class="control-label" for="input-whatsapp">Whatsapp</label>
									<input type="text" name="filter_whatsapp" value="" placeholder="Search by whatsapp" id="input-whatsapp" class="form-control" />
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-dog">Dog Name</label>
									<input type="text" name="filter_dog" value="" id="input-dog" class="form-control" />
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-due">Has Invoice Dues</label>
									<select name="filter_due" id="input-due" class="form-control">
										<option value=""></option>
										<option value="1">No</option>
										<option value="0">Yes</option>
									</select>
								</div>
							</div>
							<div class="col-sm-4 margefield">
								<div class="form-group">
								<label class="control-label" for="input-price-from">Wallet Balance(From-To)</label>
									<input type="text" name="filter_wallet_balance_from" value="" id="input-price-from" class="form-control start_range" placeholder="Minimum Wallet Price" />
									<div class="input-group">
									<input type="text" name="filter_wallet_balance_to" value="" id="input-price-to" class="form-control" placeholder="Maximum Wallet Price" />
									<span class="input-group-addon">AED</span>
									</div>
								</div>
							</div>
							<div class="col-sm-4 margefield">
								<div class="form-group">
								<label class="control-label">Due Balance(From-To)</label>
									<input type="text" name="filter_due_balance_from" value="" id="input-due-price-from" class="form-control start_range" placeholder="Minimum Due Balance" />
									<div class="input-group">
									<input type="text" name="filter_due_balance_to" value="" id="input-due-price-to" class="form-control" placeholder="Maximum Due Balance" />
									<span class="input-group-addon">AED</span>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-location">Location</label>
									<input type="text" name="filter_location" value="" id="input-location" class="form-control" />
									<input type="hidden" name="filter_location_id" value="" />
								</div>
							</div>
							<div class="col-sm-12">																
								<button type="button" id="button-reset-filter" class="btn btn-info filterBtns pull-right"><i class="fa fa-search"></i> <?php echo $button_reset_filter; ?></button>&nbsp;
								<button type="button" id="button-filter" class="btn btn-primary filterBtns pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
							</div>
						</form>
					</div>
				</div>
				<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-customer">
					<!--div class="table-responsive"-->
						<table class="table table-bordered table-hover table-striped nowrap" id="table" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></th>
									<th class="text-left">Id</th>
									<th class="text-left">Type</th>
									<th class="text-left">Name</th>
									<th class="text-left">Dogs</th>
									<th class="text-left">Email</th>
									<th class="text-left">Telephone</th>
									<th class="text-left">Location</th>
									<th class="text-left">Address</th>
									<th class="text-left">Wallet</th>
									<th class="text-left">Due</th>
									<th class="text-left">Status</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<th class="text-center"></th>
									<th class="text-left">Id</th>
									<th class="text-left">Type</th>
									<th class="text-left">Name</th>
									<th class="text-left">Dogs</th>
									<th class="text-left">Email</th>
									<th class="text-left">Telephone</th>
									<th class="text-left">Location</th>
									<th class="text-left">Address</th>
									<th class="text-left">Wallet</th>
									<th class="text-left">Due</th>
									<th class="text-left">Status</th>
									<th class="text-center">Action</th>
								</tr>
							</tfoot>
						</table>
					<!--/div-->
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {	
		var url = 'index.php?route=user/customer&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4,5,6,7,8,9,10];
		var table = $('#table').DataTable({
			"stateSave": true,
			"scrollY": "100%",
			//"dom": "lftipr",
			"scrollX":true,
			//"dom": '<"top"lip>rt<"bottom"><"clear">',
			"dom": "Bfrtip",
			"searching": false,
			"order": [],
			"processing": false,
			"serverSide": true,
			"lengthMenu": [[10,20,50,100, 250, 500, 750, 1000,-1], [10,20,50,100, 250, 500, 750, 1000,"All"]],
			"pageLength": <?php echo $page_length; ?>,
			"ajax": {
				"url": url,
				"type": "POST",
				"data": function (data) {
					var filter_name = $.trim($('input[name=\'filter_name\']').val());
					if (filter_name) {
						data.filter_name = filter_name;
					}
					
					var filter_email = $.trim($('input[name=\'filter_email\']').val());
					if (filter_email) {
						data.filter_email = filter_email;
					}
					
					var filter_dog = $.trim($('input[name=\'filter_dog\']').val());
					if (filter_dog) {
						data.filter_dog = filter_dog;
					}
					
					var filter_telephone = $.trim($('input[name=\'filter_telephone\']').val());
					if (filter_telephone) {
						data.filter_telephone = filter_telephone;
					}
					
					var filter_whatsapp = $.trim($('input[name=\'filter_whatsapp\']').val());
					if (filter_whatsapp) {
						data.filter_whatsapp = filter_whatsapp;
					}
					
					var filter_wallet_balance_from = $.trim($('input[name=\'filter_wallet_balance_from\']').val());
					if (filter_wallet_balance_from) {
						data.filter_wallet_balance_from = filter_wallet_balance_from;
					}
					
					var filter_wallet_balance_to = $.trim($('input[name=\'filter_wallet_balance_to\']').val());
					if (filter_wallet_balance_to) {
						data.filter_wallet_balance_to = filter_wallet_balance_to;
					}
					
					var filter_due_balance_from = $.trim($('input[name=\'filter_due_balance_from\']').val());
					if (filter_due_balance_from) {
						data.filter_due_balance_from = filter_due_balance_from;
					}
					
					var filter_due_balance_to = $.trim($('input[name=\'filter_due_balance_to\']').val());
					if (filter_due_balance_to) {
						data.filter_due_balance_to = filter_due_balance_to;
					}
					
					var filter_status = $.trim($('select[name=\'filter_status\']').val());
					if (filter_status) {
						data.filter_status = filter_status;
					}
					
					var filter_due = $.trim($('select[name=\'filter_due\']').val());
					if (filter_due) {
						data.filter_due = filter_due;
					}
					
					var filter_group = $.trim($('select[name=\'filter_group\']').val());
					if (filter_group) {
						data.filter_group = filter_group;
					}
					
					var filter_location = $.trim($('input[name=\'filter_location\']').val());
					if (filter_location) {
						data.filter_location = filter_location;
					}
					
					var filter_location_id = $.trim($('input[name=\'filter_location_id\']').val());
					if (filter_location_id) {
						data.filter_location_id = filter_location_id;
					}
					
					var filter_date_added = $.trim($('input[name=\'filter_date_added\']').val());
					if (filter_date_added) {
						data.filter_date_added = filter_date_added;
					}
					
					var filter_date_ended = $.trim($('input[name=\'filter_date_ended\']').val());
					if (filter_date_ended) {
						data.filter_date_ended = filter_date_ended;
					}
					
					if (localStorage.getItem('transactionTable_filter')) {
						return $.extend({}, data,JsonToForm('form_filter', 'transactionTable_filter'));
					}
				}
			},
			"columns": [
				{"data": "id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "customer_id", "searchable": false},
				{"data": "customer_type", "searchable": false},
				{"data": "name", "searchable": false},
				{"data": "total_dogs", "searchable": false},
				{"data": "email", "searchable": false},
				{"data": "telephone", "searchable": false},
				{"data": "location_name", "searchable": false},
				{"data": "address", "searchable": false},
				{"data": "wallet_balance", "searchable": false},
				{"data": "dues_amount", "searchable": false},
				{"data": "status", "orderable": false, "searchable": false, "render": status},
				{"data": "action", "orderable": false, "searchable": false, "className": "text-center", "render": function(data, type, full) {
					var html = '';
					html+= '<a href="<?php echo $edit;?>&customer_id=' + data + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil"></i></a>';
					if(full.total_dues>0){
						html +='<a href="#" data-id="'+full.customer_id+'" data-name="'+full.name+'" data-phone="'+full.telephone+'" class="btn btn-primary btn-status btn-xs" data-toggle="modal" data-target="#show-order"><span data-toggle="tooltip" data-placement="top" data-original-title="View pending order"><i class="fa fa-cart-arrow-down"></i></span></a>';
					}
					if(full.total_due_payment>0){	
						html +='<a href="#" data-id="'+full.customer_id+'" data-name="'+full.name+'" data-phone="'+full.telephone+'" class="btn btn-primary btn-status btn-xs" data-toggle="modal" data-target="#show-bill"><span data-toggle="tooltip" data-placement="top" data-original-title="View pending bill"><i class="fa fa-paypal"></i></span></a>';
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
		
		$('#button-filter').on('click', function() {
			formToJson('form_filter', 'transactionTable_filter');
			table.ajax.reload();
		});

		$('#btn-form').on('click', function() {
			$('.well').stop().slideToggle('fast', 'linear');
		});

		$('.date').datetimepicker({
			pickTime: false,
			maxDate: moment()
		});
		
		JsonToForm('form_filter', 'transactionTable_filter', 'reload');
		
		$('#button-reset-filter').on('click', function() {
			window.location.reload();
		});
	});
	</script>
	<script type="text/javascript"><!--
	$('.date').datetimepicker({
		pickTime: false
	});
	//--></script>
	<script type="text/javascript"><!--
	$('input[name=\'filter_location\']').autocomplete({
		'minLength':2,
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=pickupdrop/locations/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {
					response($.map(json, function(item) {
						return {
						label: item['name'],
						value: item['location_id']
						}
					}));
				}
			});
		},
		'select': function(item) {
			$('input[name=\'filter_location\']').val(item['label']);
			$('input[name=\'filter_location_id\']').val(item['value']);
		}
	});
	
	$('input[name=\'filter_name\']').autocomplete({
		'minLength':2,
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=user/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',			
				success: function(json) {
					response($.map(json, function(item) {
						return {
							label: item['name'],
							value: item['customer_id']
						}
					}));
				}
			});
		},
		'select': function(item) {
			$('input[name=\'filter_name\']').val(item['label']);
		}	
	});

	$('input[name=\'filter_email\']').autocomplete({
		'minLength':2,
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=user/customer/autocomplete&token=<?php echo $token; ?>&filter_email=' +  encodeURIComponent(request),
				dataType: 'json',			
				success: function(json) {
					response($.map(json, function(item) {
						return {
							label: item['email'],
							value: item['customer_id']
						}
					}));
				}
			});
		},
		'select': function(item) {
			$('input[name=\'filter_email\']').val(item['label']);
		}	
	});
	
	$('input[name=\'filter_dog\']').autocomplete({
		'minLength':2,
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=item/dog/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {
					response($.map(json, function(item) {
						return {
						label: item['name'],
						value: item['dog_id']
						}
					}));
				}
			});
		},
		'select': function(item) {
			$('input[name=\'filter_dog\']').val(item['label']);
		}
	});
	//--></script> 
	<script type="text/javascript"><!--
	$('.date').datetimepicker({
		pickTime: false
	});
	//--></script>
</div>
<div class="modal fade" id="show-bill" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:875px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Due Invoices Bill <strong id="dogcustomerinfo"></strong></h4>
            </div>
            <div class="modal-body">
				<form class="form-horizontal" id="form-pay">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr><th></th><th>Invoice</th><th>Dog</th><th>Date</th><th>Sub Total</th><th>Add. Amt.</th><th>Discount</th><th>Vat</th><th>Total</th></tr>
									</thead>
									<tbody id="bill"></tbody>	
									<tfoot>
										<tr><td class="text-right">Sub Total:</td><td></td><td></td><td></td><td id="sub_total_amt"></td><td id="add_amt"></td><td id="dis_amt"></td><td id="vat_amt"></td><td id="total_amt"></td></td></tr>
									</tfoot>
								</table>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group payment-mode">
										<label class="col-sm-3 control-label">Payment mode</label>
										<div class="col-sm-9 input-group">
											<select name="payment_mode" id="input-payment-mode" class="form-control">
												<option value="1">Bank</option>
												<option value="2">Card</option>
												<option value="3">Cash</option>
												<option value="4">Cheque</option>
												<option value="5">Online</option>
												<option value="6">Wallet</option>
											</select>
										</div>
									</div>
									<br/>
									<div class="form-group">
										<label class="col-sm-3 control-label">Transaction no(If any)</label>
										<div class="col-sm-9 input-group">
											<input type="test" class="form-control" name="transaction_no" id="transaction_no" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Payment Comment</label>
										<div class="col-sm-9 input-group">
											<textarea class="form-control" name="payment_comment" id="payment_comment"></textarea>
										</div>
									</div>
									<input type="hidden" name="customer_id" id="customer_id" value=""/>
								</div>
								<div class="col-md-6">
									<p><strong>Total Amount For Selected Invoice:</strong><span id="invoice_amount">0 AUD</span></p>
								</div>
							</div>
						</div>
					</div>
				</form>
				<div id="status_rep"></div>
            </div>
            <div class="modal-footer" id="footer-printslip">
				<div class="col-sm-3 pull-left">
				 <a type="button" id="button-print" data-print_customer_id='' target="_blank" class="btn btn-danger">Print This</a>
                <button type="button" id="button-bill" data-loading-text="Loading" class="btn btn-danger">Pay Now</button>
				</div>
				<div class="col-sm-9">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="show-order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:875px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Incomplete Order <strong id="ordercustomerinfo"></strong></h4>
            </div>
            <div class="modal-body">
				<form class="form-horizontal" id="form-pay">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr><th class="text-right">No</th><th class="text-right">Dog</th><th class="text-right">Service</th><th class="text-right">Total</th><th class="text-right">Booking Date</th><th class="text-right">Process Date</th><th class="text-right">Complete Date</th><th class="text-right">Status</th></tr>
							</thead>
							<tbody id="pendingorder"></tbody>
						</table>
					</div>
					<br/>
					<input type="hidden" name="customer_id" id="order_customer_id" value=""/>
				</form>
            </div>
            <div class="modal-footer" id="footer-order">
				<div class="col-sm-3 pull-left">
				</div>
				<div class="col-sm-9">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
            </div>
        </div>
    </div>
</div>
<script>
$('#button-print').click(function(){
	var numberOfChecked = $('#form-pay input:checkbox:checked').length;
	if(numberOfChecked<1){
		alert('Please select at least one checkbox to print the bill.');	
	}else{
		invoice = [];
		$('#form-pay input[type=\'checkbox\']:checked').each(function(element) {
			invoice.push(this.value);
		});
		var customer_id = $('#customer_id').val();
		//window.location.href = 'index.php?route=user/customer/printbill&token=<?php echo $token; ?>&customer_id='+customer_id+'&invoice_ids=' + invoice.join(',');
		window.open('index.php?route=user/customer/printbill&token=<?php echo $token; ?>&customer_id='+customer_id+'&invoice_ids=' + invoice.join(','), '_blank');

	}
});
$('#show-bill').on('show.bs.modal', function(e) {
	var id = ($(e.relatedTarget).data('id'));
	var phone = ($(e.relatedTarget).data('phone'));
	var name = ($(e.relatedTarget).data('name'));
	$('#customer_id').val(id);
	//var href = 'index.php?route=user/customer/printbill&token=<?php echo $token; ?>&customer_id='+id;
	//$('#button-print').attr('href',href); //setter
	$('#button-print').data('print_customer_id',id); //setter
	$('#dogcustomerinfo').html('Customer:'+name+'('+phone+')');
	$.ajax({
		url: 'index.php?route=user/customer/generateList&token=<?php echo $token; ?>',
		type: 'post',
		data: 'customer_id='+id,
		dataType: 'json',
		success: function(json) {
			var sum = 0;
			var html='';
			if (json['result'].length != 0) {
				for (i = 0; i < json['result'].length; i++) {
					html +='<tr>';
					html += '<td><input type="checkbox" class="invoicecheck" name="selected[invoice][]" value="' + json['result'][i]['id'] + '" data-amount="' + json['result'][i]['grand_total_amount'] + '" /></td>';
					html += '<td>' + json['result'][i]['invoice_no'] + '</td>';
					html += '<td>' + json['result'][i]['dog_name'] + '</td>';
					html += '<td>' + json['result'][i]['invoice_date'] + '</td>';
					html += '<td>' + json['result'][i]['sub_total_amount'] + '</td>';
					html += '<td>' + json['result'][i]['additional_charge'] + '</td>';
					html += '<td>' + json['result'][i]['discount_amount'] + '</td>';
					html += '<td>' + json['result'][i]['tax_amount'] + '</td>';
					html += '<td>' + json['result'][i]['grand_total_amount'] + '</td>';
					html +='</tr>';
				}
				$('#bill').html(html);
				$('#sub_total_amt').html(json['sub_total_amt']);
				$('#add_amt').html(json['additional_charge']);
				$('#dis_amt').html(json['discount_amount']);
				$('#vat_amt').html(json['tax_amount']);
				$('#total_amt').html(json['grand_total_amount']);
			}else{
				alert('Great! No pending invoice.');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}	
	});
});
$('#button-bill').click(function(){
	$.ajax({
		url: 'index.php?route=user/customer/paybill&token=<?php echo $token; ?>',
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
			}
		}
	});
});

$('#show-order').on('show.bs.modal', function(e) {
	var id = ($(e.relatedTarget).data('id'));
	var phone = ($(e.relatedTarget).data('phone'));
	var name = ($(e.relatedTarget).data('name'));
	$('#order_customer_id').val(id);
	$('#ordercustomerinfo').html('Customer:'+name+'('+phone+')');
	$.ajax({
		url: 'index.php?route=user/customer/pendingOrderList&token=<?php echo $token; ?>',
		type: 'post',
		data: 'customer_id='+id,
		dataType: 'json',
		success: function(json) {
			var sum = 0;
			var html='';
			if (json['result'].length != 0) {
				for (i = 0; i < json['result'].length; i++) {
					html +='<tr>';
					html += '<td>' + json['result'][i]['order_no'] + '</td>';
					html += '<td>' + json['result'][i]['dog_name'] + '</td>';
					html += '<td>' + json['result'][i]['type'] + '</td>';
					html += '<td>' + json['result'][i]['total'] + '</td>';
					html += '<td>' + json['result'][i]['booking_date'] + '</td>';
					html += '<td>' + json['result'][i]['process_date'] + '</td>';
					html += '<td>' + json['result'][i]['complete_date'] + '</td>';
					html += '<td>' + json['result'][i]['status'] + '</td>';
					html +='</tr>';
				}
				$('#pendingorder').html(html);
			}else{
				alert('Great! No pending order.');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}	
	});
});

$(document).on('change', '.invoicecheck', function() {
	var total = 0;
	$('#form-pay input[type=\'checkbox\']:checked').each(function(){
		var amount = $(this).data('amount');
		//console.log(amount);
		total = total+amount;
	});
	$('#invoice_amount').html(total+' AUD');
});
</script>
<?php echo $footer; ?> 