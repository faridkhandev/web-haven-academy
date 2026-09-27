<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	<?php if ($success) { ?>
		<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i>Edit your profile</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-customer" class="form-horizontal">
            <div class="row">
                <div class="col-sm-10">
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab-customer">
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-firstname">Firstname</label>
                        <div class="col-sm-10">
                          <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="Firstname" id="input-firstname" class="form-control" />
                          <?php if ($error_firstname) { ?>
                          <div class="text-danger"><?php echo $error_firstname; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-lastname">Lastname</label>
                        <div class="col-sm-10">
                          <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="Lastname" id="input-lastname" class="form-control" />
                          <?php if ($error_lastname) { ?>
                          <div class="text-danger"><?php echo $error_lastname; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-email">Email Address</label>
                        <div class="col-sm-10">
                          <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email Address" id="input-email" class="form-control" />
                          <?php if ($error_email) { ?>
                          <div class="text-danger"><?php echo $error_email; ?></div>
                          <?php  } ?>
                        </div>
                      </div>
					  <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-gender">Gender</label>
                        <div class="col-sm-10">
                          <select name="gender" id="input-gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Male" <?php if($gender == 'Male'){ ?>selected="selected" <?php } ?>>Male</option>
                            <option value="Female" <?php if($gender == 'Female'){ ?>selected="selected" <?php } ?>>Female</option>
                          </select>
						  <?php if ($error_gender) { ?>
                          <div class="text-danger"><?php echo $error_gender; ?></div>
                          <?php  } ?>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-telephone">Phone No</label>
                        <div class="col-sm-10">
                          <input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="Phone No" id="input-telephone" class="form-control" />
                          <?php if ($error_telephone) { ?>
                          <div class="text-danger"><?php echo $error_telephone; ?></div>
                          <?php  } ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-alternate_telephone">Alternate Phone No</label>
                        <div class="col-sm-10">
                          <input type="text" name="alternate_telephone" value="<?php echo $alternate_telephone; ?>" placeholder="Alternate Phone No" id="input-alternate_telephone" class="form-control" />
                        </div>
                      </div>
					  <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-address">Address</label>
                        <div class="col-sm-10">
                          <input type="text" name="address" value="<?php echo $address; ?>" placeholder="Address" id="input-address" class="form-control" />
                          <?php if ($error_address) { ?>
                          <div class="text-danger"><?php echo $error_address; ?></div>
                          <?php  } ?>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-zipcode">Zipcode</label>
                        <div class="col-sm-10">
                          <input type="text" name="zipcode" value="<?php echo $zipcode; ?>" placeholder="Zipcode" id="input-zipcode" class="form-control" />
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-second-owner-name">Second owner name</label>
                        <div class="col-sm-10">
                          <input type="text" name="second_owner_name" value="<?php echo $second_owner_name; ?>" placeholder="Second owner name" id="input-second-owner-name" class="form-control" autocomplete="off" />
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-password">Password</label>
                        <div class="col-sm-10">
                          <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" autocomplete="off" />
                        </div>
                      </div>
                      
                    </div>
                  </div>
				   <div class="form-group">
				    <label class="col-sm-2 control-label"></label>
					<div class="col-sm-10"><div class="checkbox"><label><input type="checkbox" name="agree" value="<?php echo $agree; ?>" id="agree" onclick="setValue();" />&nbsp;<?php echo $text_agree; ?></label></div>
					<?php if ($error_agree) { ?>
					<div class="text-danger"><?php echo $error_agree; ?></div>
					<?php } ?>	
					</div>	
					</div>
				  <button type="submit" form="form-customer" data-toggle="tooltip" title="Save" class="btn btn-primary pull-right"><i class="fa fa-save"></i>&nbsp;Save</button>
                </div>
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
function setValue(){
	if($('#agree').val()==1){
		$('#agree').val('');
	}else{
		$('#agree').val('1');
	}
}
</script>
</div>
<?php echo $footer; ?>