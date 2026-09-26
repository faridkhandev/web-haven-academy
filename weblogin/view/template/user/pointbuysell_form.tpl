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
					<button type="submit" form="form-user" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-username"><?php echo $entry_username; ?>(Automatically Created. Leave Blank)</label>
								<input type="text" name="username" value="<?php echo $username; ?>" placeholder="<?php echo $entry_username; ?>" id="input-username" class="form-control" readonly />
								<?php if ($error_username) { ?>
								<div class="text-danger"><?php echo $error_username; ?></div>
								<?php } ?>
							</div>
						</div>
						<input type="hidden" name="user_group_id" value="17" />
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-password"><?php echo $entry_password; ?></label>
								<input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" autocomplete="off" />
								<?php if ($error_password) { ?>
								<div class="text-danger"><?php echo $error_password; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-confirm"><?php echo $entry_confirm; ?> Password</label>
								<input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
								<?php if ($error_confirm) { ?>
								<div class="text-danger"><?php echo $error_confirm; ?></div>
								<?php } ?>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-firstname"><?php echo $entry_firstname; ?></label>
								<input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="form-control" />
								<?php if ($error_firstname) { ?>
								<div class="text-danger"><?php echo $error_firstname; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-lastname"><?php echo $entry_lastname; ?></label>
								<input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname" class="form-control" />
								<?php if ($error_lastname) { ?>
								<div class="text-danger"><?php echo $error_lastname; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
								<input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
								<?php if ($error_email) { ?>
								<div class="text-danger"><?php echo $error_email; ?></div>
								<?php } ?>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-phone">Phone No</label>
								<input type="text" name="phone" value="<?php echo $phone; ?>" id="input-phone" class="form-control" />
								<?php if ($error_phone) { ?>
								<div class="text-danger"><?php echo $error_phone; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group required">
								<label class="control-label" for="input-whatsapp">Whatsapp</label>
								<input type="text" name="whatsapp" value="<?php echo $whatsapp; ?>" id="input-whatsapp" class="form-control" />
								<?php if ($error_whatsapp) { ?>
								<div class="text-danger"><?php echo $error_whatsapp; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-gender">Gender</label>
								<select name="gender" id="input-gender" class="form-control">
									<option value="Male" <?php if($gender=='Male') { ?> selected="selected" <?php } ?> >Male</option>
									<option value="Female" <?php if($gender=='Female') { ?> selected="selected" <?php } ?>>Female</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-city">City</label>
								<input type="text" name="city" value="<?php echo $city; ?>" id="input-city" class="form-control" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-country">Country</label>
								<select name="country" id="input-country" class="form-control">
									<option value="India" <?php if($country=='India') { ?> selected="selected" <?php } ?> >India</option>
									<option value="Bangladesh" <?php if($country=='Bangladesh') { ?> selected="selected" <?php } ?>>Bangladesh</option>
									<option value="Nepal" <?php if($country=='Nepal') { ?> selected="selected" <?php } ?>>Nepal</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label" for="input-language">Language</label>
								<input type="text" name="language" value="<?php echo $language; ?>" id="input-language" class="form-control" />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label" for="input-image"><?php echo $entry_image; ?></label>
								<a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
								<input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
								<select name="status" id="input-status" class="form-control">
								<?php if ($status) { ?>
								<option value="0"><?php echo $text_disabled; ?></option>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<?php } else { ?>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<option value="1"><?php echo $text_enabled; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<?php 
					if($country=="India"){
						$payment = array('Gpay', 'Phone Pay', 'Paytm', 'Binance');
					}elseif($country=="Bangladesh"){
						$payment = array('Bkash', 'Nagad', 'Binance');
					}elseif($country=="Nepal"){
						$payment = array('eSewa', 'Binance');
					}
					?>
					<div class="row">
						<div class="col-sm-12">
							<div class="table-responsive">
								<table id="images" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<td class="text-left">Medium Name(Ex:Gpay/PhonePay etc)</td>
											<td class="text-right">Medium Number</td>
											<td>Medium Status</td>
											<td>Action</td>
										</tr>
									</thead>
									<tbody>
										<?php $medium_row = 0; ?>
										<?php foreach ($payment_medium as $medium) { ?>
										<tr id="medium-row<?php echo $medium_row; ?>">
										<td class="text-right"><select name="payment_medium[<?php echo $medium_row; ?>][medium_name]" class="form-control"><?php foreach($payment as $name){ ?><option value="<?php echo $name; ?>" <?php if($name == $item['medium_name']) echo 'selected';?>><?php echo $name; ?></option><?php } ?></select>
										</td>
										<td class="text-right"><input type="text" name="payment_medium[<?php echo $medium_row; ?>][medium_code]" value="<?php echo $medium['medium_code']; ?>" class="form-control" /></td>
										<td class="text-right"><select name="payment_medium[<?php echo $medium_row; ?>][medium_status]" class="form-control"><option value="1" <?php if($medium['medium_status']==1 ) echo 'selected';?>>Active</option><option value="0" <?php if($medium['medium_status']==0 ) echo 'selected';?>>Inactive</option></select></td>
										<td class="text-left"><button type="button" onclick="$('#medium-row<?php echo $medium_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
										</tr>
										<?php $medium_row++; ?>
										<?php } ?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="3"></td>
											<td class="text-left"><button type="button" onclick="addMedium();" data-toggle="tooltip" title="Add" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
										</tr>
									</tfoot>
								</table>
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
	html += '  <td class="text-right"><select name="payment_medium[' + medium_row + '][medium_name]" class="form-control"><?php foreach($payment as $name){ ?><option value="<?php echo $name; ?>"><?php echo $name; ?></option><?php } ?></select></td>';
	html += '  <td class="text-right"><input type="text" name="payment_medium[' + medium_row + '][medium_code]" value="" class="form-control" /></td>';
	html += '  <td class="text-right"><select name="payment_medium[' + medium_row + '][medium_status]" class="form-control"><option value="1">Active</option><option value="0">Inactive</option></select></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#medium-row' + medium_row  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#images tbody').append(html);

	medium_row++;
}
//--></script>

<?php echo $footer; ?> 