<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<div class="panel panel-default">
			
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
				</div>
				<div class="pull-right">
					<button type="submit" form="form-notifcation" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<?php include 'view/template/common/message.tpl' ; ?>
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-notifcation">
					<div class="row">	
						<div class="col-sm-12">
							<div class="form-group required">
								<label class="control-label" for="input-notifcation">Notification</label>
								<input type="text" name="notifcation" value="<?php echo $notifcation; ?>" id="input-notifcation" class="form-control" />	
								<?php if ($error_notifcation) { ?>
								<div class="text-danger"><?php echo $error_notifcation; ?></div>
								<?php } ?>
							</div>
						</div>
					</div>
				
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label class="control-label" for="input-status">Status</label>
								<select name="status" id="status" class="form-control">
									<option value="1" <?php if($status == 1) echo 'selected'; ?>>Active</option>
									<option value="0" <?php if($status == 0) echo 'selected'; ?>>Inactive</option>
								</select>
							</div>
						</div>
						
					</div>
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