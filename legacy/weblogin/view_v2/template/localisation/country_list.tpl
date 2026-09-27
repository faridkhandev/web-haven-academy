<?php echo $header; ?><?php echo $column_left; ?>
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
		  <h3 class="panel-title"><i class="fa fa-list"></i>Country List</h3>
		</div>
		<div class="pull-right">
		  <button class="btn btn-warning btn-xs" id="btn-refresh" data-toggle="tooltip" data-placement="top" title="<?php echo $button_refresh; ?>"><i class="fa fa-refresh"></i></button>
		  <a href="<?php echo $add; ?>" data-toggle="tooltip" title="Add Country" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
          <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-xs" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-country').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
			</form>
          </div>
        </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-country">
            <table class="table table-striped table-bordered nowrap" id="table" width="100%">
			  <thead>
                <tr>
                  <th class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></th>
                  <th class="text-left">Name</th>
                  <th class="text-left">ISO Code 2</th>
                  <th class="text-left">ISO Code 3</th>
                  <th class="text-left">Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody></tbody>
              <tfoot>
                <tr>
                  <th class="text-center"></th>
                  <th class="text-left">Name</th>
                  <th class="text-left">ISO Code 2</th>
                  <th class="text-left">ISO Code 3</th>
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
	var url = 'index.php?route=localisation/country&token=<?php echo $token; ?>';
	var tableExportColumns = [1,2,3,4];
	var table = $('#table').DataTable({
		"dom": "Bfrtip",
		"searching": false,
		"order": [],
		"processing": false,
		"serverSide": true,
		"pageLength": <?php echo $page_length; ?>,
        "ajax": {
            "url": url,
            "type": "POST",
			"data": function (data) {
				var filter_name = $.trim($('input[name=\'filter_name\']').val());
				if (filter_name) {
					data.filter_name = filter_name;
				}
				
				var filter_status = $.trim($('select[name=\'filter_status\']').val());
				if (filter_status != '*') {
					data.filter_status = filter_status;
				}
			}
        },
        "columns": [
			{"data": "country_id", "orderable": false, "searchable": false, "className": "text-center", "render": checkbox},
			{"data": "name", "searchable": false},
			{"data": "iso_code_2", "searchable": false},
			{"data": "iso_code_3", "searchable": false},
			{"data": "status", "orderable": false, "searchable": false},
			{"data": null, "orderable": false, "searchable": false, "className": "text-right", "render": function(data, type, row, meta) {
				return '<a href="<?php echo $edit; ?>&country_id=' + data.action + '" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Edit Country"><i class="fa fa-pencil"></i></a>';				
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
</div>
<?php echo $footer; ?>