<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i>My <?php echo $text_list; ?></h3>
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
				<div class="well" id="well" style="display: none;">
					<div class="row">
						<form enctype="multipart/form-data" id="form-filter">
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-name">Name</label>
									<input type="text" name="filter_name" value="" id="input-name" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-phone">Phone</label>
									<input type="text" name="filter_phone" value="" id="input-phone" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-email">Email</label>
									<input type="text" name="filter_email" value="" id="input-email" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-user_no">Trainer Id</label>
									<input type="text" name="filter_user_no" value="" id="input-user_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">			
								<div class="form-group">
									<label class="control-label" for="input-status">Status</label>
									<select name="filter_status" id="input-status" class="form-control">
										<option value=""></option>
										<option value="1">Enabled</option>
										<option value="0">Disabled</option>
									</select>
								</div>
							</div>
							<div class="col-sm-3">
								<button type="button" id="button-filter" class="btn btn-primary filterBtns pull-right"><i class="fa fa-search"></i> Filter</button>	
							</div>
						</form>
					</div>
				</div>
				<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-user">
					<div class="table-responsive">
						<table class="table table-striped table-bordered nowrap" id="table" width="100%">
							<thead>
								<tr>
									<th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
									<th class="text-left">No</th>
									<th class="text-left">Name</th>
									<th class="text-left">Email</th>
									<th class="text-left">Phone</th>
									<th class="text-left">Whatsapp</th>
									<th class="text-left">Team Leader</th>
									<th class="text-left">Created At</th>
									<th class="text-left">Status</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th style="width: 1px;" class="text-center"></th>
									<th class="text-left">No</th>
									<th class="text-left">Name</th>
									<th class="text-left">Email</th>
									<th class="text-left">Phone</th>
									<th class="text-left">Whatsapp</th>
									<th class="text-left">Team Leader</th>
									<th class="text-left">Created At</th>
									<th class="text-left">Status</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {	
		var url = 'index.php?route=user/mytrainer&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4,5,6,7,8];
		var table = $('#table').DataTable({
			"searching": false,
			"order": [],
			"processing": false,
			"serverSide": true,
			"pageLength": <?php echo $page_length; ?>,
			"lengthMenu": [[10,20,50,100, 250, 500, 750, 1000], [10,20,50,100, 250, 500, 750, 1000]],
			"ajax": {
				"url": url,
				"type": "POST",
				"data": function (data) {
					var filter_name = $.trim($('input[name=\'filter_name\']').val());
					if (filter_name) {
						data.filter_name = filter_name;
					}
					
					var filter_phone = $.trim($('input[name=\'filter_phone\']').val());
					if (filter_phone) {
						data.filter_phone = filter_phone;
					}
					
					var filter_email = $.trim($('input[name=\'filter_email\']').val());
					if (filter_email) {
						data.filter_email = filter_email;
					}
					
					var filter_user_no = $.trim($('input[name=\'filter_user_no\']').val());
					if (filter_user_no) {
						data.filter_user_no = filter_user_no;
					}
					
					var filter_relation_id = $.trim($('select[name=\'filter_relation_id\']').val());
					if (filter_relation_id) {
						data.filter_relation_id = filter_relation_id;
					}
					
					var filter_status = $.trim($('select[name=\'filter_status\']').val());
					if (filter_status) {
						data.filter_status = filter_status;
					}
				}
			},
			"columns": [
				{"data": "user_id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "user_no", "searchable": false},
				{"data": "name", "searchable": false},
				{"data": "email", "searchable": false},
				{"data": "phone", "searchable": false},
				{"data": "whatsapp", "searchable": false},
				{"data": "reference_user", "searchable": false},
				{"data": "date_added", "searchable": false},
				{"data": "status", "searchable": false, "render": status}
			]
		});
		
		$('#btn-refresh').on('click', function() {
			$('#form-filter')[0].reset();
			table.order([]).ajax.reload();
		});
		
		$('#button-filter').on('click', function() {
			table.ajax.reload();
		});
		
		$('#button-reset-filter').on('click', function() {
			location.reload();
		});
		
		$('#btn-form').on('click', function() {
			$('.well').stop().slideToggle('fast', 'linear');
		});
		
		$('.date').datetimepicker({
			pickTime: false,
			maxDate: moment()
		});
	});
	</script>
	<script type="text/javascript"><!--
	$('.date').datetimepicker({
	pickTime: false
	});
	$('.select2').select2();
	//--></script>
<?php echo $footer; ?> 