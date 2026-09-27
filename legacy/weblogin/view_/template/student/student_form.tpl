<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">		
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
				</div>
				<div class="pull-right">
					<?php if($student_status == 1){?>
					<button type="submit" form="form-user" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
					<?php } ?>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-username">Name</label>
								<input type="text" name="student_name" value="<?php echo $student_name; ?>" id="input-student_name" class="form-control" />
								<?php if ($error_student_name) { ?>
								<div class="text-danger"><?php echo $error_student_name; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-student_phone">Phone No</label>
								<input type="text" name="student_phone" value="<?php echo $student_phone; ?>" id="input-student_phone" class="form-control" />
								<?php if ($error_student_phone) { ?>
								<div class="text-danger"><?php echo $error_student_phone; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-student_whatsapp">Whatsapp No</label>
								<input type="text" name="student_whatsapp" value="<?php echo $student_whatsapp; ?>" id="input-student_whatsapp" class="form-control" />
								<?php if ($error_student_whatsapp) { ?>
								<div class="text-danger"><?php echo $error_student_whatsapp; ?></div>
								<?php } ?>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-email">Email</label>
								<input type="text" name="student_email" value="<?php echo $student_email; ?>" id="input-email" class="form-control" />
								<?php if ($error_student_email) { ?>
								<div class="text-danger"><?php echo $error_student_email; ?></div>
								<?php } ?>
							</div>
						</div>
						
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-gender">Gender</label>
								<select name="student_gender" id="input-gender" class="form-control">
									<option value="Male" <?php if($student_gender=='Male') { ?> selected="selected" <?php } ?> >Male</option>
									<option value="Female" <?php if($student_gender=='Female') { ?> selected="selected" <?php } ?>>Female</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-city">City</label>
								<input type="text" name="student_city" value="<?php echo $student_city; ?>" id="input-city" class="form-control" />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-language">Language</label>
								<input type="text" name="student_language" value="<?php echo $student_language; ?>" id="input-language" class="form-control" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-country">Country</label>
								<input type="text" name="student_country" value="<?php echo $student_country; ?>" id="input-country" class="form-control" />
							</div>
						</div>
						<?php if($student_status== 1){?>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-status">Status</label>
								<select name="student_status" id="input-status" class="form-control">
								<?php if ($student_status) { ?>
								<option value="0">In Active</option>
								<option value="1" selected="selected">Active</option>
								<?php } else { ?>
								<option value="0" selected="selected">In Active</option>
								<option value="1">Active</option>
								<?php } ?>
								</select>
							</div>
						</div>
						<?php }else{ ?>
						<input type="hidden" name="student_status" value="0" />
						<?php } ?>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-user">Trainer</label>
								<select name="link_user_id" id="input-user" class="form-control select2">
									<option value="">-Select-</option>
									<?php foreach($trainers as $trainer){?>
									<option value="<?php echo $trainer['user_id'];?>" <?php if($link_user_id==$trainer['user_id']) { ?> selected="selected" <?php } ?> ><?php echo $trainer['firstname'].' '.$trainer['lastname'].'-'.$trainer['user_no'];?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
$('.select2').select2();
$('.date').datetimepicker({
	pickDate: true,
	pickTime: false,
	format: 'YYYY-MM-DD',
	inline: false,
});
</script>

 <script type="text/javascript"><!--
var medium_row = <?php echo $medium_row; ?>;

function addMedium() {
	html  = '<tr id="medium-row' + medium_row + '">';
	html += '  <td class="text-right"><input type="text" name="payment_medium[' + medium_row + '][medium_name]" value="" class="form-control" /></td>';
	html += '  <td class="text-right"><input type="text" name="payment_medium[' + medium_row + '][medium_code]" value="" class="form-control" /></td>';
	html += '  <td class="text-right"><select name="payment_medium[' + medium_row + '][medium_status]" class="form-control"><option value="1">Active</option><option value="0">Inactive</option></select></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#medium-row' + medium_row  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#images tbody').append(html);

	medium_row++;
}
//--></script>

<?php echo $footer; ?> 