<h3><?php //echo empty($user->id) ? 'Add a new user' : 'Edit user ' . $user->name; ?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open();?>
<table class="table">
      <tr>
		<td>username</td>
        <?php //echo form_error('name'); ?>
		<td><?php echo form_input('user_name',set_value('user_name', $user->user_name)); ?></td>
	</tr>
	<tr>
		<td>Name</td>
        <?php //echo form_error('name'); ?>
		<td><?php echo form_input('name', set_value('name', $user->name)); ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo form_input('email', set_value('email', $user->email)); ?></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><?php echo form_password('password'); ?></td>
	</tr>
	<tr>
		<td>Confirm password</td>
		<td><?php echo form_password('password_confirm'); ?></td>
	</tr>

		<tr>
		<td>Sex password</td>
		<td><?php echo form_label('Male', 'male') . form_radio(array("name"=>"sex","id"=>"male","value"=>"M", 'checked'=>set_radio('sex', 'M', FALSE))); ?>&nbsp;<?php echo form_label('Female', 'female') . form_radio(array("name"=>"sex","id"=>"female","value"=>"F", 'checked'=>set_radio('sex', 'F', FALSE))); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close();?>
