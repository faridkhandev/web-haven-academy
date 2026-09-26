<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
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
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i>Monthly Calculation</h3>
				</div>
				<div class="pull-left">
					
				</div>
				<div class="pull-right">
					<button type="button" data-toggle="tooltip" title="Download" class="btn btn-default btn-xs" onclick="alert('Coming Soon');"><i class="fa fa-download"></i></button>
					<?php /* ?>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-xs" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-type').submit() : false;"><i class="fa fa-trash-o"></i></button>
					<?php */ ?>
				</div>
				<div class="pull-right">
					<button class="btn btn-warning btn-xs" id="btn-refresh" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></button>
					<button class="btn btn-primary btn-xs" id="btn-form"><i class="fa fa-filter"></i></button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">				
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group required">
							<label class="control-label" for="input-year">Year</label>
							<select name="year" id="input-year" class="form-control">
								<option value="*"><?php echo '--Please Select--'; ?></option>
								<?php
								$firstYear = (int)date('Y') - 3;
								$lastYear = (int)date('Y');
								for($i=$firstYear;$i<=$lastYear;$i++)
								{
									if($i == date('Y')){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									echo '<option value='.$i.' '.$selected.'>'.$i.'</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group required">
							<label class="control-label" for="input-month">Month</label>
							<select name="month" id="input-month" class="form-control">
								<option value="*"><?php echo '--Please Select--'; ?></option>
								<?php
								for($m=1; $m<=12; ++$m){
									if(date('m', mktime(0, 0, 0, $m, 1)) == date('m')){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									echo '<option value='.date('m', mktime(0, 0, 0, $m, 1)).' '.$selected.'>'.date('F', mktime(0, 0, 0, $m, 1)).'</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<button type="button" id="button-filter" data-toggle="tooltip" title="Search" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Search</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=report/monthlyincome/report&token=<?php echo $token; ?>';
	var year = $('select[name=\'year\']').val();
	if (year != '*') {
		url += '&filter_year=' + encodeURIComponent(year);
	}
	var month = $('select[name=\'month\']').val();
	if (month != '*') {
		url += '&filter_month=' + encodeURIComponent(month);
	}
	window.open(
	  url,
	  '_blank' // <- This is what makes it open in a new window.
	);
});
//--></script>
<?php echo $footer; ?>