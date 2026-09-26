<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><button type="button" data-toggle="tooltip" title="Download Excel File" class="btn btn-info excel" onclick="$('#form-boarding').attr('action', '<?php echo $excel; ?>');confirm('Do you want to download excel file?') ? $('#form-boarding').submit() : false;"><i class="fa fa-file-excel-o"></i></button>&nbsp;<button type="button" data-toggle="tooltip" title="Download Pdf File" class="btn btn-info pdf" onclick="$('#form-boarding').attr('action', '<?php echo $pdf; ?>');confirm('Do you want to download pdf file?') ? $('#form-boarding').submit() : false;"><i class="fa fa-file-pdf-o"></i></button></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-3">
				<div class="form-group">
					<label class="control-label" for="input-dogname"><?php echo $entry_dogname; ?></label>
					<input type="text" name="filter_dog_name" value="<?php echo $filter_dog_name; ?>" placeholder="<?php echo $entry_dogname; ?>" id="input-dogname" class="form-control" />
				</div>
				<div class="form-group">
					<label class="control-label" for="input-microchip_number"><?php echo $entry_microchipno; ?></label>
					<input type="text" name="filter_microchip_number" value="<?php echo $filter_microchip_number; ?>" placeholder="<?php echo $entry_microchipno; ?>" id="input-microchip_number" class="form-control" />
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label class="control-label" for="input-customername"><?php echo $entry_customername; ?></label>
					<input type="text" name="filter_customer_name" value="<?php echo $filter_customer_name; ?>" placeholder="<?php echo $entry_customername; ?>" id="input-customername" class="form-control" />
					<input type="hidden" name="filter_customer_id" value="<?php echo $filter_customer_id; ?>" id="input-customerid" />
				</div>
				<div class="form-group">
                <label class="control-label" for="input-mode"><?php echo $entry_payment_mode; ?></label>
				<select name="filter_payment_mode" id="input-mode" class="form-control">
					<option value="*"></option>
					<option value="1" <?php if($filter_payment_mode==1) echo 'Selected=selected'; ?>>Bank</option>
					<option value="2" <?php if($filter_payment_mode==2) echo 'Selected=selected'; ?>>Card</option>
					<option value="3" <?php if($filter_payment_mode==3) echo 'Selected=selected'; ?>>Cash</option>
					<option value="4" <?php if($filter_payment_mode==4) echo 'Selected=selected'; ?>>Cheque</option>
                </select>
              </div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
                <label class="control-label" for="input-checkin-added"><?php echo $entry_checkin_start_date; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_checkin_start_date" value="<?php echo $filter_checkin_start_date; ?>" placeholder="<?php echo $entry_checkin_start_date; ?>" data-date-format="YYYY-MM-DD" id="input-checkin-added" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
				</div>
				<div class="form-group">
                <label class="control-label" for="input-checkin-ended"><?php echo $entry_checkin_end_date; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_checkin_end_date" value="<?php echo $filter_checkin_end_date; ?>" placeholder="<?php echo $entry_checkin_end_date; ?>" data-date-format="YYYY-MM-DD" id="input-checkin-ended" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
                <label class="control-label" for="input-checkout-added"><?php echo $entry_checkout_start_date; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_checkout_start_date" value="<?php echo $filter_checkout_start_date; ?>" placeholder="<?php echo $entry_checkout_start_date; ?>" data-date-format="YYYY-MM-DD" id="input-checkout-added" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
				</div>
				<div class="form-group">
                <label class="control-label" for="input-checkout-ended"><?php echo $entry_checkout_end_date; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_checkout_end_date" value="<?php echo $filter_checkout_end_date; ?>" placeholder="<?php echo $entry_checkout_end_date; ?>" data-date-format="YYYY-MM-DD" id="input-checkout-ended" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
                <label class="control-label" for="input-date-added"><?php echo $entry_date_added; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
				</div>
				
			</div>
			<div class="col-sm-3">
				<div class="form-group">
                <label class="control-label" for="input-date-ended"><?php echo $entry_date_ended; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_ended" value="<?php echo $filter_date_ended; ?>" placeholder="<?php echo $entry_date_ended; ?>" data-date-format="YYYY-MM-DD" id="input-date-ended" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
				</div>
			</div>
            <div class="col-sm-3">
				<button type="button" id="button-reset-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_reset_filter; ?></button>
				<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>				
            </div>
          </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data" id="form-boarding">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
					<td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
					<td class="text-left"><?php echo $column_checkin_date_time; ?></td>
					<td class="text-left"><?php echo $column_checkout_date_time; ?></td>
					<td class="text-left"><?php echo $column_customer; ?></td>
					<td class="text-left"><?php echo $column_dog; ?></td>
					<td class="text-left"><?php echo $column_date_added; ?></td>
					<td class="text-left"><?php echo $column_status; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($entrys) { ?>
                <?php foreach ($entrys as $entry) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($entry['boarding_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $entry['boarding_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $entry['boarding_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $entry['checkin_date_time']; ?></td>
                  <td class="text-left"><?php echo $entry['checkout_date_time']; ?></td>
                  <td class="text-left"><?php echo $entry['customer_name']; ?></td>
                  <td class="text-left"><?php echo $entry['dog_name']; ?></td>
                  <td class="text-left"><?php echo $entry['date_added']; ?></td>
                  <td class="text-left"><?php echo $entry['status']; ?></td>                  
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
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
	url = 'index.php?route=report/boarding&token=<?php echo $token; ?>';
	location = url;
});	
$('#button-filter').on('click', function() {
	url = 'index.php?route=report/boarding&token=<?php echo $token; ?>';
	
	var filter_dog_name = $('input[name=\'filter_dog_name\']').val();
	
	if (filter_dog_name) {
		url += '&filter_dog_name=' + encodeURIComponent(filter_dog_name);
	}
	
	var filter_microchip_number = $('input[name=\'filter_microchip_number\']').val();
	
	if (filter_microchip_number) {
		url += '&filter_microchip_number=' + encodeURIComponent(filter_microchip_number);
	}
	
	var filter_customer_name = $('input[name=\'filter_customer_name\']').val();
	
	if (filter_customer_name) {
		url += '&filter_customer_name=' + encodeURIComponent(filter_customer_name);
	}
	
	var filter_customer_id = $('input[name=\'filter_customer_id\']').val();
	
	if (filter_customer_id) {
		url += '&filter_customer_id=' + encodeURIComponent(filter_customer_id);
	}
	
	var filter_payment_mode = $('select[name=\'filter_payment_mode\']').val();
	
	if (filter_payment_mode != '*') {
		url += '&filter_payment_mode=' + encodeURIComponent(filter_payment_mode);
	}
		
	var filter_checkin_start_date = $('input[name=\'filter_checkin_start_date\']').val();
	
	if (filter_checkin_start_date) {
		url += '&filter_checkin_start_date=' + encodeURIComponent(filter_checkin_start_date);
	}
	
	var filter_checkin_end_date = $('input[name=\'filter_checkin_end_date\']').val();
	
	if (filter_checkin_end_date) {
		url += '&filter_checkin_end_date=' + encodeURIComponent(filter_checkin_end_date);
	}
	
	var filter_checkout_start_date = $('input[name=\'filter_checkout_start_date\']').val();
	
	if (filter_checkout_start_date) {
		url += '&filter_checkout_start_date=' + encodeURIComponent(filter_checkout_start_date);
	}
	
	var filter_checkout_end_date = $('input[name=\'filter_checkout_end_date\']').val();
	
	if (filter_checkout_end_date) {
		url += '&filter_checkout_end_date=' + encodeURIComponent(filter_checkout_end_date);
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
$('input[name=\'filter_dog_name\']').autocomplete({
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
		$('input[name=\'filter_dog_name\']').val(item['label']);
	}
});

$('input[name=\'filter_customer_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=user/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name']+'('+item['email']+')',
						value: item['customer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_customer_name\']').val(item['label']);
		$('input[name=\'filter_customer_id\']').val(item['value']);
	}	
});
//--></script>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script>
<script>
$('[data-toggle="tooltip"]').tooltip();
</script>
</div>
<?php echo $footer; ?>