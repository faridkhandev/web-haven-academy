<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
				</div>
				<div class="pull-right">
				</div>
				<div class="pull-right">
					<button class="btn btn-warning btn-xs" id="btn-refresh" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></button>
					<button class="btn btn-primary btn-xs" id="btn-form"><i class="fa fa-filter"></i></button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="well" id="well2">
					<div class="row">
						<div class="col-sm-5">
							<div class="form-group">
								<label class="control-label" for="input-start-date">Created Start Date</label>
								<div class="input-group date">
									<input type="text" name="filter_start_date" value="<?php echo $filter_start_date;?>" id="input-start-date" class="form-control">
									<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
								</div>
							</div>	
						</div>
						
						<div class="col-sm-5">
							<div class="form-group">
								<label class="control-label" for="input-end-date">Created End Date</label>
								<div class="input-group date">
									<input type="text" name="filter_end_date" value="<?php echo $filter_end_date;?>" id="input-end-date" class="form-control">
									<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
								</div>
							</div>	
						</div>
						<div class="col-sm-2">
							<button type="button" id="button-filter" class="btn btn-primary filterBtns pull-right"><i class="fa fa-search"></i> Filter</button>	
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12">Total Inactive Student:<?php echo $recordsFiltered;?></div>
				</div>
			</div>
		</div>
	</div>
</div>	
  <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=module/inactivestudentcount&token=<?php echo $token; ?>';

	var filter_start_date = $('input[name=\'filter_start_date\']').val();

	if (filter_start_date) {
		url += '&filter_start_date=' + encodeURIComponent(filter_start_date);
	}
	
	var filter_end_date = $('input[name=\'filter_end_date\']').val();

	if (filter_end_date) {
		url += '&filter_end_date=' + encodeURIComponent(filter_end_date);
	}

	location = url;
});
//--></script>
<script>
$('.date').datetimepicker({
	pickDate: true,
	pickTime: false,
	format: 'YYYY-MM-DD',
	inline: false,
});
</script>
<?php echo $footer; ?>