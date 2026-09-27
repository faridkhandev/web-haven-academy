<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<?php /* ?>
	<div class="page-header">
	<div class="container-fluid">
	<div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
	<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button>
	</div>
	<h1><?php echo $heading_title; ?></h1>
	<ul class="breadcrumb">
	<?php foreach ($breadcrumbs as $breadcrumb) { ?>
	<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
	<?php } ?>
	</ul>
	</div>
	</div>
  <?php */ ?>
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
				</div>
				<div class="pull-right">
					<a href="<?php echo $add; ?>" data-toggle="tooltip" title="Add" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-xs" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
									<label class="control-label" for="input-username">Username</label>
									<input type="text" name="filter_username" value="" id="input-username" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">			
								<div class="form-group">
									<label class="control-label" for="input-group">User Group</label>
									<select name="filter_group_id" id="input-group" class="form-control">
										<option value=""></option>
										<?php foreach($user_groups as $group){?>
										<option value="<?php echo $group['user_group_id'];?>"><?php echo $group['name']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-sm-3">			
								<div class="form-group">
									<label class="control-label" for="input-status">Status</label>
									<select name="filter_status" id="input-status" class="form-control">
										<option value=""></option>
										<option value="1"><?php echo $text_enabled; ?></option>
										<option value="0"><?php echo $text_disabled; ?></option>
									</select>
								</div>
							</div>
							<div class="col-sm-3">
								<button type="button" id="button-reset-filter" class="btn btn-info filterBtns pull-right"><i class="fa fa-search"></i>Reset Filter</button>
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
									<th class="text-left">Id</th>
									<th class="text-left"><?php echo $column_username; ?></th>
									<th class="text-left">Group</th>
									<th class="text-left"><?php echo $column_date_added; ?></th>
									<th class="text-left"><?php echo $column_status; ?></th>
									<th class="text-right"><?php echo $column_action; ?></th>
								</tr>
							</thead>
							<tbody>
							<?php /* if ($users) { ?>
							<?php foreach ($users as $user) { ?>
							<tr>
							<td class="text-center"><?php if (in_array($user['user_id'], $selected)) { ?>
							<input type="checkbox" name="selected[]" value="<?php echo $user['user_id']; ?>" checked="checked" />
							<?php } else { ?>
							<input type="checkbox" name="selected[]" value="<?php echo $user['user_id']; ?>" />
							<?php } ?></td>
							<td class="text-left"><?php echo $user['username']; ?></td>
							<td class="text-left"><?php echo $user['status']; ?></td>
							<td class="text-left"><?php echo $user['date_added']; ?></td>
							<td class="text-right"><a href="<?php echo $user['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
							</tr>
							<?php } ?>
							<?php } else { ?>
							<tr>
							<td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
							</tr>
							<?php } */ ?>
							</tbody>
							<tfoot>
								<tr>
									<th style="width: 1px;" class="text-center"></th>
									<th class="text-left">Id</th>
									<th class="text-left"><?php echo $column_username; ?></th>
									<th class="text-left">Group</th>
									<th class="text-left"><?php echo $column_status; ?></th>
									<th class="text-left"><?php echo $column_date_added; ?></th>
									<th class="text-right"><?php echo $column_action; ?></th>
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
		var url = 'index.php?route=user/user&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4,5];
		var table = $('#table').DataTable({
			"dom": "Bfrtip",
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
					var filter_name = $.trim($('input[name=\'filter_username\']').val());
					if (filter_name) {
						data.filter_name = filter_name;
					}
					
					var filter_group_id = $.trim($('select[name=\'filter_group_id\']').val());
					if (filter_group_id) {
						data.filter_group_id = filter_group_id;
					}
					
					var filter_status = $.trim($('select[name=\'filter_status\']').val());
					if (filter_status) {
						data.filter_status = filter_status;
					}
				}
			},
			"columns": [
				{"data": "user_id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "user_id", "searchable": false},
				{"data": "username", "searchable": false},
				{"data": "user_group", "searchable": false},
				{"data": "date_added", "searchable": false},
				{"data": "status", "searchable": false, "render": status},
				{"data": "action", "orderable": false, "searchable": false, "className": "text-center", "render": function(data, type, full) {
					return '<a href="<?php echo $edit;?>&user_id=' + data + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Edit Type"><i class="fa fa-pencil"></i></a>';
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
	//--></script>
<?php echo $footer; ?> 