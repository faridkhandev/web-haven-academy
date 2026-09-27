<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<div class="panel panel-default">
			
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
				</div>
				<div class="pull-right">
					<button type="submit" form="form-doctor" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<?php include 'view/template/common/message.tpl' ; ?>
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-doctor">
					<div class="row">	
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-doctor_name">Name</label>
								<input type="text" name="doctor_name" value="<?php echo $doctor_name; ?>" id="input-doctor_name" class="form-control" />	
								<?php if ($error_doctor_name) { ?>
								<div class="text-danger"><?php echo $error_doctor_name; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-doctor_degree">Degree</label>
								<input type="text" name="doctor_degree" value="<?php echo $doctor_degree; ?>" id="input-doctor_degree" class="form-control" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-doctor_address">Address</label>
								<input type="text" name="doctor_address" value="<?php echo $doctor_address; ?>" id="input-doctor_address" class="form-control" />
							</div>
						</div>
					</div>
					<div class="row">	
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-doctor_contact">Contact No</label>
								<input type="text" name="doctor_contact" value="<?php echo $doctor_contact; ?>" id="input-doctor_contact" class="form-control" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-doctor_age">Age</label>
								<input type="text" name="doctor_age" value="<?php echo $doctor_age; ?>" id="input-doctor_age" class="form-control" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-doctor_gender">Gender</label>
								<select name="doctor_gender" class="form-control">
									<option value="Male" <?php if($doctor_gender == 'Male') echo 'selected'; ?>>Male</option>	
									<option value="Female" <?php if($doctor_gender == 'Female') echo 'selected'; ?>>Female</option><option value="Other" <?php if($doctor_gender == 'Other') echo 'selected'; ?>>Other</option>		
								</select>
							</div>
						</div>
					</div>
					
					
					
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-doctor_status">Status</label>
								<select name="doctor_status" id="doctor_status" class="form-control">
									<option value="1" <?php if($doctor_status == 1) echo 'selected'; ?>>Active</option>
									<option value="0" <?php if($doctor_status == 0) echo 'selected'; ?>>Inactive</option>
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="input-image">Upload Photo</label><br/>
								<a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="doctor_image" value="<?php echo $doctor_image; ?>" id="input-image" />
							</div>
						</div>
						
					</div>
				</form>
			</div>
			<div class="panel-footer">
				<div class="pull-right">
					<button type="submit" form="form-doctor" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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