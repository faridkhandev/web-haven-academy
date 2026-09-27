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
					<h3 class="panel-title"><i class="fa fa-list"></i>Headquarter List</h3>
				</div>
				<div class="pull-right">
					<button class="btn btn-warning btn-xs" id="btn-refresh" data-toggle="tooltip" data-placement="top" title="<?php echo $button_refresh; ?>"><i class="fa fa-refresh"></i></button>
					<a href="<?php echo $add; ?>" data-toggle="tooltip" title="Add Headquarter" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-xs" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-state').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
								<input type="text" name="filter_name" placeholder="Name" id="input-name" class="form-control" />
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
								<label class="control-label" for="input-country">Country</label>
								<select name="filter_country" class="filter-country form-control">
								<option value="*">Select Country</option>
								<?php foreach($countries as $country){?>
								<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
								<?php } ?>
								</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
								<label class="control-label" for="input-state">State</label>
								<select name="filter_zone" class="filter-state form-control">
								</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
								<label class="control-label" for="input-status">Status</label>
								<select name="filter_status" class="filter-status form-control">
								<option value="*">Select Status</option>
								<option value="1">Active</option>
								<option value="0">In Active</option>
								</select>
								</div>
							</div>
							<div class="col-md-3">
								<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
							</div>
						</form>
					</div>
				</div>
				<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-state">
					<table class="table table-striped table-bordered nowrap" id="table" width="100%">
						<thead>
						<tr>
						<th class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></th>
						<th class="text-left">Country</th>
						<th class="text-left">State</th>
						<th class="text-left">District</th>
						<th class="text-left">Status</th>
						<th class="text-center">Action</th>
						</tr>
						</thead>
						<tbody></tbody>
						<tfoot>
						<tr>
						<th class="text-center"></th>
						<th class="text-left">Country</th>
						<th class="text-left">State</th>
						<th class="text-left">District</th>
						<th class="text-left">Status</th>
						<th class="text-center">Action</th>
						</tr>
						</tfoot>
					</table>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {	
		var url = 'index.php?route=localisation/city&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4];
		var table = $('#table').DataTable({
			"dom": "Bfrtip",
			"searching": false,
			"order": [],
			"processing": false,
			"serverSide": true,
			"pageLength": <?php echo $page_length; ?>,
			"lengthMenu": [[10,15,20,50,100, 250, 500, 750, 1000], [10,15,20,50,100, 250, 500, 750, 1000]],
			"ajax": {
				"url": url,
				"type": "POST",
				"data": function (data) {
					var filter_name = $.trim($('input[name=\'filter_name\']').val());
					if (filter_name) {
						data.filter_name = filter_name;
					}
					var filter_country = $.trim($('select[name=\'filter_country\']').val());
					if (filter_country != '*') {
						data.filter_country = filter_country;
					}
					var filter_zone = $.trim($('select[name=\'filter_zone\']').val());
					if (filter_zone != '*') {
						data.filter_zone = filter_zone;
					}
					var filter_status = $.trim($('select[name=\'filter_status\']').val());
					if (filter_status != '*') {
						data.filter_status = filter_status;
					}
				}
			},
			"columns": [
				{"data": "city_id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
				{"data": "country", "searchable": false},
				{"data": "zone", "searchable": false},
				{"data": "name", "searchable": false},
				{"data": "status", "searchable": false, "render": status},
				{"data": null, "orderable": false, "searchable": false, "className": "text-right", "render": function(data, type, row, meta) {
					return '<a href="<?php echo $edit; ?>&city_id=' + data.action + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Edit District"><i class="fa fa-pencil"></i></a>';				
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
	$('select[name=\'filter_country\']').on('change', function() {
		$.ajax({
			url: 'index.php?route=localisation/city/country&token=<?php echo $token; ?>&country_id=' + this.value,
			dataType: 'json',
			beforeSend: function() {
				$('select[name=\'filter_country\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
			},
			complete: function() {
				$('.fa-spin').remove();
			},
			success: function(json) {
				html = '<option value="*"><?php echo '--Please Select--'; ?></option>';
				if (json['zone'] && json['zone'] != '') {
					for (i = 0; i < json['zone'].length; i++) {
						html += '<option value="' + json['zone'][i]['zone_id'] + '"';
						if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
							html += ' selected="selected"';
						}
						html += '>' + json['zone'][i]['name'] + '</option>';
					}
				} else {
					html += '<option value="*" selected="selected"><?php echo '--None--'; ?></option>';
				}
				$('select[name=\'filter_zone\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
	$('select[name=\'country_id\']').trigger('change');
	//--></script>
</div>
<?php echo $footer; ?>