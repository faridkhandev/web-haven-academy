<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<div class="panel panel-default">
			
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
				</div>
				<div class="pull-right">
					<button type="submit" form="form-session" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<?php include 'view/template/common/message.tpl'; ?>
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-session">
               
					<div class="row">	
                    	<div class="col-sm-6">
							<div class="form-group required">
								<label class="control-label" for="input-course">Type</label>
								<select name="session_type" id="session_type" class="form-control">
									<option value="Class" selected>Class</option>
                                	<option value="Backup">Backup</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group required">
								<label class="control-label" for="input-course">Select Course</label>
								<select name="course_id" id="input-course" class="form-control">
								<option value="">-Select-</option>
								<?php foreach($courses as $item){?>
								<option value="<?php echo $item['course_id'];?>" data-class="<?php echo $item['no_of_classes'];?>" <?php if($item['course_id'] == $course_id) echo 'selected'; ?>><?php echo $item['course_name'];?></option>
								<?php } ?>
								</select>
								<?php if ($error_course_id) { ?>
								<div class="text-danger"><?php echo $error_course_id; ?></div>
								<?php } ?>
								<input type="hidden" name="no_of_classes" id="no_of_classes" value="<?php echo $item['no_of_classes'];?>" />
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group required">
								<label class="control-label" for="input-session">Select Session</label>
								<select name="session_no[]" id="input-session" class="form-control select2" multiple></select>
								<?php if ($error_session_no) { ?>
								<div class="text-danger"><?php echo $error_session_no; ?></div>
								<?php } ?>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-teacher_name">Teacher Name</label>
								<input type="text" name="teacher_name" value="<?php echo isset($teacher_name) ? $teacher_name : ''; ?>" placeholder="Enter Teacher Name" id="input-teacher_name" class="form-control" required />
							</div>
						</div>

						<?php if($user_group_id != 14){?>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-teacher">Select Teacher</label>
								<select name="session_teacher_id" id="input-teacher" class="form-control">
								<option value="">-Select-</option>
								<?php foreach($teachers as $teacher){?>
								<option value="<?php echo $teacher['user_id'];?>" <?php if($teacher['user_id'] == $session_teacher_id) echo 'selected'; ?>><?php echo $teacher['firstname'].' '.$teacher['lastname'];?></option>
								<?php } ?>
								</select>
								<?php if ($error_session_teacher_id) { ?>
								<div class="text-danger"><?php echo $error_session_teacher_id; ?></div>
								<?php } ?>
							</div>
						</div>
						<?php }else{ ?>
						<input type="hidden" name="session_teacher_id" value="<?php echo $user_id; ?>" />
						<?php } ?>

						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-meeting_link">Meeting Link</label>
								<input type="text" name="meeting_link" value="<?php echo $meeting_link; ?>" id="input-meeting_link" class="form-control" required />
								<?php if ($error_meeting_link) { ?>
								<div class="text-danger"><?php echo $error_meeting_link; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-session_date">Session Date</label>
								<input type="text" name="session_date" value="<?php echo $session_date; ?>" id="input-session_date" class="form-control date" />
								<?php if ($error_session_date) { ?>
								<div class="text-danger"><?php echo $error_session_date; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-session_time">Session Time</label>
								<input type="text" name="session_time" value="<?php echo $session_time; ?>" id="input-session_time" class="form-control time" />
								<?php if ($error_session_time) { ?>
								<div class="text-danger"><?php echo $error_session_time; ?></div>
								<?php } ?>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="panel-footer">
				<div class="pull-right">
					<button type="submit" form="form-session" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
$('.time').datetimepicker({
	pickDate: false,
	pickTime: true,
	format: 'HH:MM',
	inline: false,
});

$('#input-course').on('change', function() {
	var class_no = $(this).find(':selected').data('class');
	html = '<option value="">-Select-</option>';
	for (i = 1; i <= class_no; i++) {
		html += '<option value="' + i + '"';
		if (i == '<?php echo $session_no; ?>') {
			html += ' selected="selected"';
		}

		html += '> Session ' + i + '</option>';
	}
	$('#input-session').html(html);
	$('#no_of_classes').val(class_no);
});

$('#input-course').trigger('change');
$(document).ready(function() {
	$('.select2').select2();
});
//--></script>
<?php echo $footer; ?>
