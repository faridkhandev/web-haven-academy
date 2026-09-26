<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i><?php echo $text_list; ?></h3>
				</div>
				<div class="pull-left">
					
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
				<?php if(is_array($filter) && count($filter)>0){?>
				<div class="well" id="well" style="display: none;">
					<div class="row">
						<form enctype="multipart/form-data" id="form-filter">
							<?php foreach($filter as $key => $input){ ?>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-name"><?php echo $input['placeholder']; ?></label>
									<?php if($input['type']=='text'){?>
									<input type="text" name="<?php echo $input['name']; ?>" value="<?php echo $input['value']; ?>" id="<?php echo $input['id']; ?>" class="form-control" />
									<?php } ?>
									<?php if($input['type']=='select'){?>
									<select name="<?php echo $input['name']; ?>" id="<?php echo $input['id']; ?>" class="form-control">
										<option value=""></option>
										<?php foreach($input['value'] as $key=>$option){?>
										<option value="<?php echo $key; ?>"><?php echo $option; ?></option>
										<?php } ?>
									</select>
									<?php } ?>
								</div>
							</div>
							<?php } ?>
							<div class="col-sm-4">			
								<button type="button" id="button-reset-filter" class="btn btn-info filterBtns pull-right"><i class="fa fa-search"></i> <?php echo $button_reset_filter; ?></button>
								<button type="button" id="button-filter" class="btn btn-primary filterBtns pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>				
							</div>
						</form>
					</div>
				</div>
				<?php } ?>
				<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-type">
					<div class="table-responsive">
						<table class="table table-striped table-bordered nowrap" id="table" width="100%">
							<thead>
								<tr>
									<?php foreach($column as $head){?>
									<th class="text-left"><?php echo $head;?></th>
									<?php } ?>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<?php foreach($column as $head){?>
									<th class="text-left"><?php echo $head;?></th>
									<?php } ?>
								</tr>
							</tfoot>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {	
		var url = 'index.php?route=report/report/view&token=<?php echo $token; ?>&id=<?php echo $id;?>';
		var tableExportColumns = [<?php echo implode(',',$export_column); ?>];
		var table = $('#table').DataTable({
			"scrollY": "100%",		
			"lengthMenu": [[10,20,50,100, 250, 500, 750, 1000], [10,20,50,100, 250, 500, 750, 1000]],
			"scrollX":true,
			"dom": "Bfrtip",
			//"dom": '<"top"lip>rt<"bottom"><"clear">',
			"searching": false,
			"order": [],
			"processing": false,
			"serverSide": true,
			"pageLength": <?php echo $page_length; ?>,
			"ajax": {
				"url": url,
				"type": "POST",
				"data": function (data) {
					<?php $i=1;foreach($filter as $key => $input){ ?>
					var value<?php echo $i;?> = $.trim($('#'+'<?php echo $input['id']; ?>').val());
					if (value<?php echo $i;?>) {
						data.<?php echo $input['name']; ?> = value<?php echo $i;?>;
					}
					<?php $i++;} ?>
				}
			},
			"columns": [
				<?php foreach($fields as $field){ ?>
				{"data": "<?php echo $field;?>", "searchable": false},
				<?php } ?>
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
	<!--script type="text/javascript">
	$('.date').datetimepicker({
	pickTime: false
	});
	</script-->
</div>
<?php echo $footer; ?>