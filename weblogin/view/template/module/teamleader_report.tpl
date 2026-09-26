<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i>Student Activated Report</h3>
				</div>
				<div class="pull-right">
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="well">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
							<label class="control-label" for="input-start">Start Date</label>
							<input type="text" name="filter_start_date" value="<?php echo $filter_start_date; ?>" class="form-control date" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
							<label class="control-label" for="input-end">End Date</label>
							<input type="text" name="filter_end_date" value="<?php echo $filter_end_date; ?>" class="form-control date"  />
							</div>
						</div>
						<div class="col-sm-4">
							<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i>Filter</button>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="tile">
							<div class="tile-heading">Student No</div>
							<div class="tile-body">Total
							<h2 class="pull-right" id="roomresult"><?php echo $total; ?></h2>
							</div>
						</div>
					</div>
				</div>
				<?php if($students){?>
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Sl No</th>
										<th>Name</th>
										<th>Id</th>
										<th>Refer Student</th>
										<th>Refer Id</th>
										<th>Activated On</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1;foreach($students as $s){?>
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $s['student_name'];?></td>
										<td><?php echo $s['student_no'];?></td>
										<td><?php echo $s['refer_student_name'];?></td>
										<td><?php echo $s['refer_student_no'];?></td>
										<td><?php echo $s['added_on'];?></td>
									</tr>
									<?php $i++; } ?>
								</tbody>	
							</table>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
  <script type="text/javascript"><!--
  $('.date').datetimepicker({
		pickDate: true,
		pickTime: false,
		format: 'YYYY-MM-DD',
		inline: false,
	});
$('#button-filter').on('click', function() {
	var url = 'index.php?route=module/teamleaderreport&token=<?php echo $token; ?>';

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
<?php echo $footer; ?> 