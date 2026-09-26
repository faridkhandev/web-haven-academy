<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i>My Student Count</h3>
				</div>
			</div>
			<div class="panel-body" style="margin-top:20px;">
				<div class="row">	
					<div class="col-sm-3">
						<div class="form-group">
							<label class="control-label" for="input-date-added">Start Date</label>
							<div class="input-group date">
							<input type="text" name="filter_date_added" value="<?php echo $filter_start_date;?>" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control">
							<span class="input-group-btn">
							<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
							</span></div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label class="control-label" for="input-date-added">End Date</label>
							<div class="input-group date">
							<input type="text" name="filter_date_ended" value="<?php echo $filter_end_date;?>" data-date-format="YYYY-MM-DD" id="input-date-ended" class="form-control">
							<span class="input-group-btn">
							<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
							</span></div>
						</div>
					</div>
					<div class="col-sm-3">
						<button type="button" id="button-filter" class="btn btn-primary filterBtns pull-right"><i class="fa fa-search"></i> Filter</button>	
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-6">
						<div class="tile">
							<div class="tile-heading">Total Student</div>
							<div class="tile-body"><i class="fa fa-user-md"></i>
							<h2 class="pull-right" id="roomresult"><?php echo $total_records; ?></h2>
							</div>
							<div class="tile-footer"><a href="<?php echo $link; ?>">View Students</a></div>
						</div>				
					</div>
				</div>
			</div>	
		</div>	
	</div>	
</div>	
<script>
$('.select2').select2();
$('.date').datetimepicker({
	pickDate: true,
	pickTime: false,
	format: 'YYYY-MM-DD',
	inline: false,
});
</script>
<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	url = 'index.php?route=student/student_report&token=<?php echo $token; ?>';
	
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
<?php echo $footer; ?>