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
								<label class="control-label" for="input-course_name">Name</label>
								<input type="text" name="course_name" value="<?php echo $course_name; ?>" id="input-course_name" class="form-control" />	
								<?php if ($error_course_name) { ?>
								<div class="text-danger"><?php echo $error_course_name; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-no_of_classes">No of Classes/Sessions</label>
								<input type="text" name="no_of_classes" value="<?php echo $no_of_classes; ?>" id="input-no_of_classes" class="form-control" />
								<?php if ($error_no_of_classes) { ?>
								<div class="text-danger"><?php echo $error_no_of_classes; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-priority">Priority</label>
								<input type="text" name="priority" value="<?php echo $priority; ?>" id="input-priority" class="form-control" />
								<?php if ($error_priority) { ?>
								<div class="text-danger"><?php echo $error_priority; ?></div>
								<?php } ?>
							</div>
						</div>
					</div>
				
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label class="control-label" for="input-course_status">Status</label>
								<select name="course_status" id="course_status" class="form-control">
									<option value="1" <?php if($course_status == 1) echo 'selected'; ?>>Active</option>
									<option value="0" <?php if($course_status == 0) echo 'selected'; ?>>Inactive</option>
								</select>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="form-group">
								<label class="control-label" for="input-per_session_point">Per Session Point(0 for no point)</label>
								<input type="text" name="per_session_point" value="<?php echo $per_session_point; ?>" id="input-per_session_point" class="form-control" />
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label" for="input-image">Upload Photo</label><br/>
								<a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="course_image" value="<?php echo $course_image; ?>" id="input-image" />
							</div>
						</div>
						
					</div>
					<div class="row">					
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label" for="input-require_validation">Must Complete Previous course For Join This Course</label>
								<select name="require_validation" id="require_validation" class="form-control">
									<option value="1" <?php if($require_validation == 1) echo 'selected'; ?>>Yes</option>
									<option value="2" <?php if($require_validation == 2) echo 'selected'; ?>>No</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="input-course_description">Course Detail</label>
								<textarea name="course_description" rows="6" id="input-course_description" class="form-control"><?php echo $course_description; ?></textarea>	
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
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>  
<script type="text/javascript"><!--
$('#input-course_description').summernote({
	height: 150
});
//--></script>
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