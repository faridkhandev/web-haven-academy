<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<div class="panel panel-default">
			
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-pencil"></i>Weekly Best Performer</h3>
				</div>
				<div class="pull-right">
					<button type="submit" form="form-notifcation" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<?php include 'view/template/common/message.tpl' ; ?>
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-notifcation">
					<div class="table-responsive">
						<table id="images" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
								<td class="text-left">Type</td>
								<td class="text-right">Name</td>
								<td class="text-right">ID</td>
								<td class="text-right">Image</td>
								<td class="text-right">Detail</td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($weeklybest as $item){?>
									<tr>
										<td><b><?php echo strtoupper($item['type']);?></b></td>
										<input type="hidden" name="weeklybest[<?php echo $item['id']; ?>][type]" value="<?php echo $item['type']; ?>" />
										
										<td class="text-right"><input type="text" name="weeklybest[<?php echo $item['id']; ?>][entity_name]" value="<?php echo $item['entity_name']; ?>" class="form-control" /></td>
										<td class="text-right"><input type="text" name="weeklybest[<?php echo $item['id']; ?>][entity_no]" value="<?php echo $item['entity_no']; ?>" class="form-control" /></td>
										
										<td class="text-left"><a href="" id="thumb-image<?php echo $item['id']; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $item['thumb']; ?>"  data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="weeklybest[<?php echo $item['id']; ?>][entity_image]" value="<?php echo $item['entity_image']; ?>" id="input-image<?php echo $item['id']; ?>" /></td>
										
										<td class="text-right"><textarea name="weeklybest[<?php echo $item['id']; ?>][entity_description]" class="form-control"><?php echo $item['entity_description']; ?></textarea></td>
									</tr>
								<?php } ?>	
							</tbody>
						</table>
				</form>
			</div>
			<div class="panel-footer">
				<div class="pull-right">
					<button type="submit" form="form-notifcation" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
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
$("#input-image").on('change', function () {		
	if (typeof (FileReader) != "undefined") {
		var image_holder = $("#file_image-holder");
		image_holder.empty();
		
		var reader = new FileReader();
		reader.onload = function (e) {
			$("<img />", {
				"src": e.target.result,
				"class": "thumb-image",
				"width": "200px",
				"height": "250px"
			}).appendTo(image_holder);
		
		}
		image_holder.show();
		reader.readAsDataURL($(this)[0].files[0]);
	} else {
		alert("This browser does not support FileReader.");
	}
});
//--></script>
<?php echo $footer; ?>