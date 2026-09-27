<?php echo $header; ?>
<link type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" />
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
		<div class="pull-right">
		<button type="button" data-toggle="tooltip" title="Download Excel File" class="btn btn-info excel" onclick="$('#form-expense').attr('action', '<?php echo $excel; ?>');confirm('Do you want to download excel file?') ? $('#form-expense').submit() : false;"><i class="fa fa-file-excel-o"></i></button>&nbsp;<!--button type="button" data-toggle="tooltip" title="Download Pdf File" class="btn btn-info pdf" onclick="$('#form-expense').attr('action', '<?php echo $pdf; ?>');confirm('Do you want to download pdf file?') ? $('#form-expense').submit() : false;"><i class="fa fa-file-pdf-o"></i></button-->
		</div>
		<h1><?php echo $heading_title; ?></h1>
		<ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
		</ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">  
		<div class="well">
          <div class="row">
            <div class="col-sm-3">
				<div class="form-group">
					<label class="control-label" for="input-expense-head"><?php echo $entry_expense_head; ?></label>
					<select name="filter_expense_head_id[]" id="input-expense-head" multiple="multiple" class="filter-expense-head form-control">
					  <?php foreach ($expense_heads as $expense_head) { ?>
						  <?php if(in_array($expense_head['id'], $filter_expense_head_id)){ ?>
							<option value="<?php echo $expense_head['id']; ?>" selected="selected"><?php echo $expense_head['name']; ?></option>
						  <?php } else { ?>
							<option value="<?php echo $expense_head['id']; ?>"><?php echo $expense_head['name']; ?></option>
						  <?php } ?>
					  <?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label" for="input-mode"><?php echo $entry_mode; ?></label>
					<select name="filter_mode[]" id="input-mode" multiple="multiple" class="filter-mode form-control">
						<option value="1" <?php if(in_array(1, $filter_mode)) echo 'Selected=selected'; ?>>Bank</option>
						<option value="2" <?php if(in_array(2, $filter_mode)) echo 'Selected=selected'; ?>>Card</option>
						<option value="3" <?php if(in_array(3, $filter_mode)) echo 'Selected=selected'; ?>>Cash</option>
						<option value="4" <?php if(in_array(4, $filter_mode)) echo 'Selected=selected'; ?>>Cheque</option>
					</select>
				</div>				
            </div>
			<div class="col-sm-3">
				<div class="form-group">
					<label class="control-label" for="input-expense-date-added"><?php echo $entry_expense_date_added; ?></label>
					<div class="input-group date">
					  <input type="text" name="filter_expense_date_added" value="<?php echo $filter_expense_date_added; ?>" placeholder="<?php echo $entry_expense_date_added; ?>" data-date-format="YYYY-MM-DD" id="input-expense-date-added" class="form-control" />
					  <span class="input-group-btn">
					  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
					  </span></div>
				</div>
				<div class="form-group">
                <label class="control-label" for="input-expense-date-ended"><?php echo $entry_expense_date_ended; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_expense_date_ended" value="<?php echo $filter_expense_date_ended; ?>" placeholder="<?php echo $entry_expense_date_ended; ?>" data-date-format="YYYY-MM-DD" id="input-expense-date-ended" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
				</div>			  
            </div>
			<?php /* ?>
            <div class="col-sm-3">
				<div class="form-group">
					<label class="control-label" for="input-date-added"><?php echo $entry_date_added; ?></label>
					<div class="input-group date">
					  <input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
					  <span class="input-group-btn">
					  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
					  </span></div>
				</div>
				<div class="form-group">
                <label class="control-label" for="input-date-ended"><?php echo $entry_date_ended; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_ended" value="<?php echo $filter_date_ended; ?>" placeholder="<?php echo $entry_date_ended; ?>" data-date-format="YYYY-MM-DD" id="input-date-ended" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
				</div>			  
            </div>
			<?php */ ?>
            <div class="col-sm-3">
				<div class="form-group">
					<label class="control-label" for="input-type"><?php echo $entry_type; ?></label>
					<select name="filter_type[]" id="input-type" multiple="multiple" class="filter-type form-control">
						<option value="1" <?php if(in_array(1, $filter_type)) echo 'Selected=selected'; ?>>Inhouse Expense(Debit)</option>
						<option value="2" <?php if(in_array(2, $filter_type)) echo 'Selected=selected'; ?>>Boarding Fees(Credit)</option>
						<option value="3" <?php if(in_array(3, $filter_type)) echo 'Selected=selected'; ?>>Website Order(Credit)</option>
						<option value="4" <?php if(in_array(4, $filter_type)) echo 'Selected=selected'; ?>>Grooming Booking(Credit)</option>
						<option value="5" <?php if(in_array(5, $filter_type)) echo 'Selected=selected'; ?>>Food Sale(Credit)</option>
						<option value="6" <?php if(in_array(6, $filter_type)) echo 'Selected=selected'; ?>>Training(Credit)</option>
						<option value="7" <?php if(in_array(7, $filter_type)) echo 'Selected=selected'; ?>>Pool Service(Credit)</option>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label" for="input-type">Payment Status</label>
					<select name="filter_payment[]" id="input-payment" multiple="multiple" class="filter-payment form-control">
						<option value="1" <?php if(in_array(1, $filter_payment)) echo 'Selected=selected'; ?>>Paid</option>
						<option value="0" <?php if(in_array(0, $filter_payment)) echo 'Selected=selected'; ?>>Not Paid</option>
					</select>
				</div>			
            </div>
			<div class="col-sm-3">
				<button type="button" id="button-reset-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_reset_filter; ?></button><button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
			</div>
          </div>
        </div>
        <form action="<?php echo $excel; ?>" method="post" enctype="multipart/form-data" id="form-expense">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
					<td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
					<td class="text-left">Service</td>
					<td class="text-left">Service Type</td>
					<td class="text-left">Service Id</td>
					<td class="text-left">Description</td>
					<td class="text-left"><?php echo $column_amount; ?></td>
					<td class="text-left">Vat Amount</td>
					<td class="text-left">Total Amount</td>
					<td class="text-left">Pay Status</td>
					<td class="text-left">Pay Mode</td>					
					<td class="text-left">Remarks</td>
					<td class="text-left"><?php echo $column_expense_date; ?></td>
					<td class="text-left"><?php echo $column_date_added; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($revenue_expanses) { ?>
                <?php foreach ($revenue_expanses as $revenue_expanse) { ?>
                <tr>
					<td class="text-center"><?php if (in_array($revenue_expanse['expense_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $revenue_expanse['expense_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $revenue_expanse['expense_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $revenue_expanse['reason']; ?></td>
                  <td class="text-left"><?php echo $revenue_expanse['type']; ?></td>
                  <td class="text-left"><a href="<?php echo $revenue_expanse['link'];?>" class="btn-sm btn-primary" target="_blank"><?php echo ($revenue_expanse['entity_id'] !='')?$revenue_expanse['entity_id']:'Old Data'; ?></a></td>
                  <td class="text-left"><?php echo $revenue_expanse['description']; ?></td>
                  <td class="text-left"><?php echo $revenue_expanse['amount']; ?></td>
                  <td class="text-left"><?php echo $revenue_expanse['vat_amount']; ?></td>
                  <td class="text-left"><?php echo $revenue_expanse['total_amount']; ?></td>				  
                  <td class="text-left"><?php echo $revenue_expanse['payment_status']; ?></td>	
                  <td class="text-left"><?php echo $revenue_expanse['payment_mode']; ?></td>			  
                  <td class="text-left"><?php echo $revenue_expanse['payment_comment']; ?></td>
                  <td class="text-left"><?php echo $revenue_expanse['er_date_added']; ?></td>
                  <td class="text-left"><?php echo $revenue_expanse['date_added']; ?></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="12">No Data Found</td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
		<div class="row">
			<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
			<div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript"><!--
$('#button-reset-filter').on('click', function() {
	url = 'index.php?route=report/revenue_expenses&token=<?php echo $token; ?>';
	location = url;
});	
$('#button-filter').on('click', function() {
	url = 'index.php?route=report/revenue_expenses&token=<?php echo $token; ?>';
	
	var filter_expense_head_id = $.trim($('select[name=\'filter_expense_head_id[]\']').val());
	if (filter_expense_head_id) {
		url += '&filter_expense_head_id=' +filter_expense_head_id;
	}
	/* var filter_expense_head_id = $('select[name=\'filter_expense_head_id\']').val();
	
	if (filter_expense_head_id != '*') {
		url += '&filter_expense_head_id=' + encodeURIComponent(filter_expense_head_id);
	} */
	
	var filter_mode = $('select[name=\'filter_mode[]\']').val();
	
	if (filter_mode) {
		url += '&filter_mode=' + filter_mode; 
	}
	
	var filter_type = $('select[name=\'filter_type[]\']').val();
	
	if (filter_type) {
		url += '&filter_type=' + filter_type; 
	}
	
	var filter_payment = $('select[name=\'filter_payment[]\']').val();
	
	if (filter_payment) {
		url += '&filter_payment=' + filter_payment; 
	}
		
	var filter_expense_date_added = $('input[name=\'filter_expense_date_added\']').val();
	
	if (filter_expense_date_added) {
		url += '&filter_expense_date_added=' + encodeURIComponent(filter_expense_date_added);
	}
	var filter_expense_date_ended = $('input[name=\'filter_expense_date_ended\']').val();
	
	if (filter_expense_date_ended) {
		url += '&filter_expense_date_ended=' + encodeURIComponent(filter_expense_date_ended);
	}	
	var filter_date_added = $('input[name=\'filter_date_added\']').val();
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}
	var filter_date_ended = $('input[name=\'filter_date_ended\']').val();
	
	if (filter_date_ended) {
		url += '&filter_date_ended=' + encodeURIComponent(filter_date_ended);
	}	
	location = url;
});
//--></script> 
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script>
<script>
$(document).ready(function() {
	$('.filter-payment').select2({
		width: '90%' // need to override the changed default
	});
	$('.filter-type').select2({
		width: '90%' // need to override the changed default
	});
	$('.filter-mode').select2({
		width: '90%' // need to override the changed default
	});
	$('.filter-expense-head').select2({
		width: '90%' // need to override the changed default
	});
});
</script>
</div>
<?php echo $footer; ?>