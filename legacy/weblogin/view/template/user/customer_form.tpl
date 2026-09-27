<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			
			<div class="panel-heading">
				<div class="pull-left w50">
					<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
				</div>
				<div class="pull-right">
					<button type="submit" form="form-customer" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-customer">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
						<?php if($customer_id != 0){?>
						<li><a href="#tab-dog" data-toggle="tab">Dog</a></li>
						<?php } ?>
						<li><a href="#tab-files" data-toggle="tab">Files</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab-general">
							<div class="row">
								<div class="col-sm-10">
										<div class="tab-pane active" id="tab-customer">
											<div class="col-sm-4">
												<div class="form-group required">
													<label class="control-label" for="input-type">Customer Type<br/></label>
													<select class="basic-multiple form-control" name="customer_type" class="form-control">
														<?php foreach($customer_types as $type){ ?>
														<option value="<?php echo $type['id']; ?>" <?php if(in_array($type['id'], $customer_type)) echo 'selected';?>><?php echo $type['name']; ?></option>	
														<?php } ?>	
													</select>
													<?php if ($error_customer_type) { ?>
													<div class="text-danger"><?php echo $error_customer_type; ?></div>
													<?php } ?>
												</div>
											</div>
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
													<label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
													<input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
													<?php if ($error_email) { ?>
													<div class="text-danger"><?php echo $error_email; ?></div>
													<?php  } ?>
												</div>
											</div>
											
											<div class="col-sm-4">
												<div class="form-group">
													<label class="control-label" for="input-gender"><?php echo $entry_gender; ?></label>
													<select name="gender" id="input-gender" class="form-control">
													<?php if ($gender) { ?>
													<option value="Male" selected="selected"><?php echo $text_male; ?></option>
													<option value="Female"><?php echo $text_female; ?></option>
													<?php } else { ?>
													<option value="Male"><?php echo $text_male; ?></option>
													<option value="Female" selected="selected"><?php echo $text_female; ?></option>
													<?php } ?>
													</select>
												</div>
											</div>
											
											<div class="col-sm-4">
												<div class="form-group required">
													<label class="control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
													<input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
													<?php if ($error_telephone) { ?>
													<div class="text-danger"><?php echo $error_telephone; ?></div>
													<?php  } ?>
												</div>
											</div>
											
											<div class="col-sm-4">
												<div class="form-group">
													<label class="control-label" for="input-alternate_telephone"><?php echo $entry_alternate_telephone; ?></label>
													<input type="text" name="alternate_telephone" value="<?php echo $alternate_telephone; ?>" placeholder="<?php echo $entry_alternate_telephone; ?>" id="input-alternate_telephone" class="form-control" />
												</div>
											</div>
											
											<div class="col-sm-4">
												<div class="form-group">
													<label class="control-label" for="input-whatsapp">Whatsapp No</label>
													<input type="text" name="whatsapp_no" value="<?php echo $whatsapp_no; ?>" placeholder="Customer Whatsapp No" id="input-whatsapp" class="form-control" />
												</div>
											</div>
											
											<div class="col-sm-4">
												<div class="form-group required">
													<label class="control-label" for="input-address"><?php echo $entry_address; ?></label>
													<input type="text" name="address" value="<?php echo $address; ?>" placeholder="<?php echo $entry_address; ?>" id="input-address" class="form-control" />
													<?php if ($error_address) { ?>
													<div class="text-danger"><?php echo $error_address; ?></div>
													<?php  } ?>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group required">
													<label class="control-label" for="input-location_id">Location</label>
													<select name="location_id" id="input-location_id" class="form-control">
														<option value="">Select Location</option>
														<?php foreach($locations as $location){ ?>
														<option value="<?php echo $location['location_id'];?>" <?php if($location_id==$location['location_id']) echo 'Selected=selected'; ?>><?php echo $location['name'];?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="control-label" for="input-zipcode"><?php echo $entry_zipcode; ?></label>
													<input type="text" name="zipcode" value="<?php echo $zipcode; ?>" placeholder="<?php echo $entry_zipcode; ?>" id="input-zipcode" class="form-control" />
												</div>
											</div>
											
											<div class="col-sm-4">
												<div class="form-group">
													<label class="control-label" for="input-second-owner-name"><?php echo $entry_second_owner_name; ?></label>
													<input type="text" name="second_owner_name" value="<?php echo $second_owner_name; ?>" placeholder="<?php echo $entry_second_owner_name; ?>" id="input-second-owner-name" class="form-control" autocomplete="off" />
												</div>
											</div>
											
											<div class="col-sm-4">
												<div class="form-group">
													<label class="control-label" for="input-password">Password</label>
													<input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" autocomplete="off" />
												</div>
											</div>
											
											<div class="col-sm-4">
												<div class="form-group">
													<label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
													<select name="status" id="input-status" class="form-control">
													<?php if ($status) { ?>
													<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
													<option value="0"><?php echo $text_disabled; ?></option>
													<?php } else { ?>
													<option value="1"><?php echo $text_enabled; ?></option>
													<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
													<?php } ?>
													</select>
												</div>
											</div>

										</div>
									<button type="submit" form="form-customer" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary pull-right"><i class="fa fa-save"></i>&nbsp;Save</button>
								</div>
							</div>
						</div>
						
						<div class="tab-pane" id="tab-files">
							<div class="row">
								<div class="table-responsive">
									<table id="images" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<td class="text-left">Image</td>
												<td></td>
											</tr>
										</thead>
										<tbody>
											<?php $image_row = 0; ?>
											<?php foreach ($files as $product_image) { ?>
												<tr id="image-row<?php echo $image_row; ?>">
												<td class="text-left"><?php echo $product_image['text']; ?>:<a href="<?php echo $product_image['link']; ?>" target="_blank">View File</a></td>
												<td class="text-left"><button type="button" onclick="confirm('Do you want to delete file?') ? removeFile(<?php echo $image_row; ?>,<?php echo $customer_id; ?>,'<?php echo $product_image['basename']; ?>'):false;" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
												</tr>
												<?php $image_row++; ?>
											<?php } ?>
										</tbody>
										<tfoot>
											<tr>
												<td></td>
												<td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="Add Image" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>	
			
						<?php if($customer_id != 0){?>
						<div class="tab-pane" id="tab-dog">
							<div class="row">
								<?php foreach($dogs as $dog){ ?>
								<div class="col-sm-3">
									<div class="dog_info">
										<a href="<?php echo $editdog.'&dog_id='.$dog['dog_id'];?>" target="_blank" >	
											<div class="dog-image">
												<img src="<?php echo HTTP_IMAGE.$dog['image']; ?>" />
											</div>
											<div class="dog-meta">
												<ul style="list-style: none;">
													<li><strong>Dog:</strong><span><?php echo $dog['name'] ?></span></li>
													<li><strong>Breed:</strong><span><?php echo $dog['breed'] ?></span></li>
													<li><strong>Gender:</strong><span><?php echo $dog['gender'] ?></span></li>
													<li><strong>Size:</strong><span><?php echo (($dog['size']==1)?'Small':(($dog['age']==2)?'Medium':(($dog['age']==3)?'Big':'Other'))) ?></span></li>
													<li><strong>Age:</strong><span><?php echo (($dog['age']==1)?'Puppy':(($dog['age']==2)?'Adult':(($dog['age']==3)?'Old':'Other'))) ?></span></li>
													<li><strong>MCNO:</strong><span><?php echo $dog['microchip_number']; ?></span></li>
													<li><strong class="btn btn-primary">Edit</strong></li>
												</ul>
											</div>
										</a>
									</div>
								</div>
								<?php } ?>
								<div class="col-sm-3">
									<div class="dog_info">
										<div class="dog-image">
											<a href="<?php echo $adddog;?>" class="btn btn-primary">Add New Dog</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>			
					</div>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript"><!--
	$('.date').datetimepicker({
		pickTime: false
	});

	$('.datetime').datetimepicker({
		pickDate: true,
		pickTime: true
	});

	$('.time').datetimepicker({
		pickDate: false
	});	
	
	</script>
	<script type="text/javascript"><!--
$(document).ready(function() {
    $('.basic-multiple').select2();
});
//--></script>
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
	html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-left"><input type="file" name="item_file[]" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#images tbody').append(html);

	image_row++;
}

function removeFile(row,customer_id,file_name) {
	$.ajax({
		type:"POST",
		dataType: "json",
		url: 'index.php?route=user/customer/deletefile&token=<?php echo $token; ?>',
		data: {dog_id: dog_id, file_name: file_name},
		success: function(data) {
			if(data['status']){
				$('#image-row'+ row).remove();
				$.notify('File deleted successfully.', {autoHideDelay: 5000,className: 'success'});
			}else{
				$.notify('Some error occur, try again.', {autoHideDelay: 5000,className: 'error'});
			}
		}
	});
}
//--></script>
</div>
<?php echo $footer; ?>