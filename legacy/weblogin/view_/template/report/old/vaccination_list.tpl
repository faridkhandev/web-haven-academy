<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
		<button type="button" data-toggle="tooltip" title="Download Excel File" class="btn btn-info excel" onclick="$('#form-vaccination').attr('action', '<?php echo $excel; ?>');confirm('Do you want to download excel file?') ? $('#form-vaccination').submit() : false;"><i class="fa fa-file-excel-o"></i></button>&nbsp;<button type="button" data-toggle="tooltip" title="Download Pdf File" class="btn btn-info pdf" onclick="$('#form-vaccination').attr('action', '<?php echo $pdf; ?>');confirm('Do you want to download pdf file?') ? $('#form-vaccination').submit() : false;"><i class="fa fa-file-pdf-o"></i></button>
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
				<div class="col-sm-2">
					<div class="form-group">
					<label class="control-label" for="input-last-heat-date-start-date"><?php echo $entry_last_heat_date_start_date; ?></label>
					<div class="input-group date">
					  <input type="text" name="filter_last_heat_start_date" value="<?php echo $filter_last_heat_start_date; ?>" placeholder="<?php echo $entry_last_heat_date_start_date; ?>" data-date-format="YYYY-MM-DD" id="input-last-heat-date-start-date" class="form-control" />
					  <span class="input-group-btn">
					  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
					  </span></div>
					</div>
				
					<div class="form-group">
					<label class="control-label" for="input-last-heat-date-end-date"><?php echo $entry_last_heat_date_end_date; ?></label>
					<div class="input-group date">
					  <input type="text" name="filter_last_heat_end_date" value="<?php echo $filter_last_heat_end_date; ?>" placeholder="<?php echo $entry_last_heat_date_end_date; ?>" data-date-format="YYYY-MM-DD" id="input-last-heat-date-end-date" class="form-control" />
					  <span class="input-group-btn">
					  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
					  </span></div>
					</div>				
				</div>
				<div class="col-sm-2">
				  <div class="form-group">
					<label class="control-label" for="input-dhppl-start-date"><?php echo $entry_dhppl_start_date; ?></label>
					<div class="input-group date">
					  <input type="text" name="filter_dhppl_start_date" value="<?php echo $filter_dhppl_start_date; ?>" placeholder="<?php echo $entry_dhppl_start_date; ?>" data-date-format="YYYY-MM-DD" id="input-dhppl-start-date" class="form-control" />
					  <span class="input-group-btn">
					  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
					  </span></div>
					</div>
				
					<div class="form-group">
					<label class="control-label" for="input-dhppl-end-date"><?php echo $entry_dhppl_end_date; ?></label>
					<div class="input-group date">
					  <input type="text" name="filter_dhppl_end_date" value="<?php echo $filter_dhppl_end_date; ?>" placeholder="<?php echo $entry_dhppl_end_date; ?>" data-date-format="YYYY-MM-DD" id="input-dhppl-end-date" class="form-control" />
					  <span class="input-group-btn">
					  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
					  </span></div>
					</div>				  
				</div>
				<div class="col-sm-2">
				  <div class="form-group">
					<label class="control-label" for="input-kennel-cough-start-date"><?php echo $entry_kennel_cough_start_date; ?></label>
					<div class="input-group date">
					  <input type="text" name="filter_kennel_cough_start_date" value="<?php echo $filter_kennel_cough_start_date; ?>" placeholder="<?php echo $entry_kennel_cough_start_date; ?>" data-date-format="YYYY-MM-DD" id="input-kennel-cough-start-date" class="form-control" />
					  <span class="input-group-btn">
					  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
					  </span></div>
					</div>
				
					<div class="form-group">
					<label class="control-label" for="input-kennel-cough-end-date"><?php echo $entry_kennel_cough_end_date; ?></label>
					<div class="input-group date">
					  <input type="text" name="filter_kennel_cough_end_date" value="<?php echo $filter_kennel_cough_end_date; ?>" placeholder="<?php echo $entry_kennel_cough_end_date; ?>" data-date-format="YYYY-MM-DD" id="input-kennel-cough-end-date" class="form-control" />
					  <span class="input-group-btn">
					  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
					  </span></div>
					</div>				  
				</div>
				<div class="col-sm-2">
				  <div class="form-group">
					<label class="control-label" for="input-rabbies-vacination-start-date"><?php echo $entry_rabbies_vacination_start_date; ?></label>
					<div class="input-group date">
					  <input type="text" name="filter_rabbies_vacination_start_date" value="<?php echo $filter_rabbies_vacination_start_date; ?>" placeholder="<?php echo $entry_rabbies_vacination_start_date; ?>" data-date-format="YYYY-MM-DD" id="input-rabbies-vacination-start-date" class="form-control" />
					  <span class="input-group-btn">
					  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
					  </span></div>
					</div>
				
					<div class="form-group">
					<label class="control-label" for="input-rabbies-vacination-end-date"><?php echo $entry_rabbies_vacination_end_date; ?></label>
					<div class="input-group date">
					  <input type="text" name="filter_rabbies_vacination_end_date" value="<?php echo $filter_rabbies_vacination_end_date; ?>" placeholder="<?php echo $entry_rabbies_vacination_end_date; ?>" data-date-format="YYYY-MM-DD" id="input-rabbies-vacination-end-date" class="form-control" />
					  <span class="input-group-btn">
					  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
					  </span></div>
					</div>				  
				</div>
				<div class="col-sm-2">
				  <div class="form-group">
					<label class="control-label" for="input-deworming-start-date"><?php echo $entry_deworming_start_date; ?></label>
					<div class="input-group date">
					  <input type="text" name="filter_deworming_start_date" value="<?php echo $filter_deworming_start_date; ?>" placeholder="<?php echo $entry_deworming_start_date; ?>" data-date-format="YYYY-MM-DD" id="input-deworming-start-date" class="form-control" />
					  <span class="input-group-btn">
					  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
					  </span></div>
					</div>
				
					<div class="form-group">
					<label class="control-label" for="input-deworming-end-date"><?php echo $entry_deworming_end_date; ?></label>
					<div class="input-group date">
					  <input type="text" name="filter_deworming_end_date" value="<?php echo $filter_deworming_end_date; ?>" placeholder="<?php echo $entry_deworming_end_date; ?>" data-date-format="YYYY-MM-DD" id="input-deworming-end-date" class="form-control" />
					  <span class="input-group-btn">
					  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
					  </span></div>
					</div>				  
				</div>
				<div class="col-sm-2">		
				<button type="button" id="button-reset-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_reset_filter; ?></button>
				<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
				</div>
			</div>
        </div>
        <form action="<?php echo $excel; ?>" method="post" enctype="multipart/form-data" id="form-vaccination">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
					<td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
					<td class="text-left"><?php echo $column_name; ?></td>
					<td class="text-left"><?php echo $column_microchip_number; ?></td>
					<td class="text-left"><?php echo $column_size; ?></td>
					<td class="text-left"><?php echo $column_age; ?></td>
					<td class="text-left"><?php echo $column_gender; ?></td>
					<td class="text-left"><?php echo $column_customer; ?></td>
					<td class="text-left"><?php echo $column_last_heat_date; ?></td>
					<td class="text-left"><?php echo $column_dhppl_valid_date; ?></td>
					<td class="text-left"><?php echo $column_kennel_cough_valid_date; ?></td>
					<td class="text-left"><?php echo $column_rabbies_vacination_valid_date; ?></td>
					<td class="text-left"><?php echo $column_deworming_valid_date; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($dogs) { ?>
                <?php foreach ($dogs as $dog) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($dog['dog_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $dog['dog_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $dog['dog_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $dog['dog_name']; ?></td>
                  <td class="text-left"><?php echo $dog['microchip_number']; ?></td>
                  <td class="text-left"><?php echo $dog['size']; ?></td>
                  <td class="text-left"><?php echo $dog['age']; ?></td>
                  <td class="text-left"><?php echo $dog['gender']; ?></td>
                  <td class="text-left"><?php echo $dog['customer_name']; ?></td>
                  <td class="text-left"><?php echo $dog['date_of_last_heat']; ?></td>
                  <td class="text-left"><?php echo $dog['last_dhppl_valid_till']; ?></td>
                  <td class="text-left"><?php echo $dog['last_kennel_cough_valid_till']; ?></td>
                  <td class="text-left"><?php echo $dog['rabbies_vacination_valid_till']; ?></td>
                  <td class="text-left"><?php echo $dog['last_deworming_valid_till']; ?></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="12"><?php echo $text_no_results; ?></td>
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
	url = 'index.php?route=report/vaccination&token=<?php echo $token; ?>';
	location = url;
});	
$('#button-filter').on('click', function() {
	url = 'index.php?route=report/vaccination&token=<?php echo $token; ?>';

	var filter_last_heat_start_date = $('input[name=\'filter_last_heat_start_date\']').val();
	
	if (filter_last_heat_start_date) {
		url += '&filter_last_heat_start_date=' + encodeURIComponent(filter_last_heat_start_date);
	}	
	
	var filter_last_heat_end_date = $('input[name=\'filter_last_heat_end_date\']').val();
	
	if (filter_last_heat_end_date) {
		url += '&filter_last_heat_end_date=' + encodeURIComponent(filter_last_heat_end_date);
	}	
	
	var filter_dhppl_start_date = $('input[name=\'filter_dhppl_start_date\']').val();
	
	if (filter_dhppl_start_date) {
		url += '&filter_dhppl_start_date=' + encodeURIComponent(filter_dhppl_start_date);
	}	
	
	var filter_dhppl_end_date = $('input[name=\'filter_dhppl_end_date\']').val();
	
	if (filter_dhppl_end_date) {
		url += '&filter_dhppl_end_date=' + encodeURIComponent(filter_dhppl_end_date);
	}
	
	var filter_kennel_cough_start_date = $('input[name=\'filter_kennel_cough_start_date\']').val();
	
	if (filter_kennel_cough_start_date) {
		url += '&filter_kennel_cough_start_date=' + encodeURIComponent(filter_kennel_cough_start_date);
	}	
	
	var filter_kennel_cough_end_date = $('input[name=\'filter_kennel_cough_end_date\']').val();
	
	if (filter_kennel_cough_end_date) {
		url += '&filter_kennel_cough_end_date=' + encodeURIComponent(filter_kennel_cough_end_date);
	}
	
	var filter_rabbies_vacination_start_date = $('input[name=\'filter_rabbies_vacination_start_date\']').val();
	
	if (filter_rabbies_vacination_start_date) {
		url += '&filter_rabbies_vacination_start_date=' + encodeURIComponent(filter_rabbies_vacination_start_date);
	}	
	
	var filter_rabbies_vacination_end_date = $('input[name=\'filter_rabbies_vacination_end_date\']').val();
	
	if (filter_rabbies_vacination_end_date) {
		url += '&filter_rabbies_vacination_end_date=' + encodeURIComponent(filter_rabbies_vacination_end_date);
	}
	
	var filter_deworming_start_date = $('input[name=\'filter_deworming_start_date\']').val();
	
	if (filter_deworming_start_date) {
		url += '&filter_deworming_start_date=' + encodeURIComponent(filter_deworming_start_date);
	}	
	
	var filter_deworming_end_date = $('input[name=\'filter_deworming_end_date\']').val();
	
	if (filter_deworming_end_date) {
		url += '&filter_deworming_end_date=' + encodeURIComponent(filter_deworming_end_date);
	}
	location = url;
});
//--></script> 

<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script>
<script type="text/javascript"><!--
$(".excel").click(function() {
    $("#form-vaccination").attr("action", "<?php echo $excel; ?>");     
});
$(".pdf").click(function() {
     $("#form-vaccination").attr("action", "<?php echo $pdf; ?>");       
});

//--></script>

</div>
<?php echo $footer; ?>