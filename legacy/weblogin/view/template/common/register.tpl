<?php echo $header; ?>
<div id="content" >
  <div class="container-fluid"><br />
    <br />
    <div class="row">
      <div class="col-sm-offset-4 col-sm-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="panel-title"><i class="fa fa-lock"></i> <?php echo $text_register; ?></h1>
          </div>
          <div class="panel-body">
            <?php if ($success) { ?>
            <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php } ?>
            <?php if ($error_warning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php } ?>
			<div id="error"></div>
			<p id="message"></p>
            <form id="register-form">
				<div class="form-group" id="firstname">
                <label for="input-firstname">First Name</label>
                <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" name="firstname" value="" placeholder="First Name" id="input-firstname" class="form-control" />
                </div>
              </div>
			  <div class="form-group" id="lastname">
                <label for="input-lastname">Last Name</label>
                <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" name="lastname" value="" placeholder="Last Name" id="input-lastname" class="form-control" />
                </div>
              </div>
              <div class="form-group" id="email">
                <label for="input-email"><?php echo $entry_email; ?></label>
                <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" name="email" value="" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
                </div>
              </div>
			  <div class="form-group" id="telephone">
                <label for="input-phone"><?php echo $entry_phone; ?></label>
                <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" name="telephone" value="" placeholder="<?php echo $entry_phone; ?>" id="input-phone" class="form-control" />
                </div>
              </div>
              <div class="form-group" id="password">
                <label for="input-password"><?php echo $entry_password; ?></label>
                <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" name="password" value="" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
                </div>
              </div>
				<div class="buttons">
					<div class="checkbox"><label><input type="checkbox" name="agree" value="" id="agree" onclick="setValue();" />&nbsp;<?php echo $text_agree; ?></label></div>					
				</div>
				<div class="text-right"><a href="<?php echo $login; ?>" class="btn btn-link pull-left"><?php echo $text_login; ?></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $forgotten; ?>" class="btn btn-link pull-left"><?php echo 'Forgot Password'; ?></a>
					<button id="register-customer" type="button" class="btn btn-primary"><i class="fa fa-key"></i> <?php echo $button_register; ?></button>
				</div>
            </form>
			<form id="otp-form" style="display:none">
				<div class="form-group" id="email_code">
					<label for="input-email-code"><?php echo $entry_email_code; ?></label>
					<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input type="text" name="email_code" value="" placeholder="<?php echo $entry_email_code; ?>" id="input-email-code" class="form-control" maxlength="6" />
					</div>
				</div>
				<div class="form-group" id="phone_code">
					<label for="input-phone-code"><?php echo $entry_phone_code; ?></label>
					<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input type="text" name="phone_code" value="" placeholder="<?php echo $entry_phone_code; ?>" id="input-phone-code" class="form-control" maxlength="6" />
					</div>
				</div>
				<div class="text-right"><button id="complete-register" type="button" class="btn btn-primary"><i class="fa fa-key"></i>Complete Registration</button></div>
			</form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
    $("#register-customer").click(function () {
		$.ajax({
			url: '<?php echo $action_register; ?>',
			type: 'post',
			dataType: 'json',
			data: 'firstname=' + ($('input[name=\'firstname\']').val())+'&lastname=' + ($('input[name=\'lastname\']').val())+'&email=' + ($('input[name=\'email\']').val())+'&telephone=' + ($('input[name=\'telephone\']').val())+'&password=' + ($('input[name=\'password\']').val())+'&agree=' + ($('input[name=\'agree\']').val()),
			beforeSend: function() {
				$('.alert-danger').remove();
				$('#register-customer').attr('disabled', true);
				$('#register-customer').after('<div class="attention"><i class="fa fa-spinner"></i>Wait</div>');
			},
			complete: function() {
				$('#register-customer').attr('disabled', false);
				$('.attention').remove();
			},
			success: function(data) {
				if (data['error']['firstname']) {
					$('#firstname').after('<div class="alert alert-danger warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data['error']['firstname'] + '</div>');
				}
				if (data['error']['lastname']) {
					$('#lastname').after('<div class="alert alert-danger warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data['error']['lastname'] + '</div>');
				}
				if (data['error']['email']) {
					$('#email').after('<div class="alert alert-danger warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data['error']['email'] + '</div>');
				}
				
				if (data['error']['telephone']) {
					$('#telephone').after('<div class="alert alert-danger warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data['error']['telephone'] + '</div>');
				}
				
				if (data['error']['password']) {
					$('#password').after('<div class="alert alert-danger warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data['error']['password'] + '</div>');
				}
				
				if (data['error']['agree']) {
					$('#error').html('<div class="alert alert-danger warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data['error']['agree'] + '</div>');
				}
				
				if (data['error']['warning']) {
					$('#error').html('<div class="alert alert-danger warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data['error']['warning'] + '</div>');
				}
				
				if (data['success']) {
					$('#message').html('<div class="alert alert-success success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data['success'] + '</div>');
					$("#otp-form").toggle();
					$("#register-form").toggle();
				}
			}
		});
    });
	
	$("#complete-register").click(function () {
		$.ajax({
			url: '<?php echo $action_otp; ?>',
			type: 'post',
			dataType: 'json',
			data: 'email_code=' + ($('input[name=\'email_code\']').val())+'&phone_code=' + ($('input[name=\'phone_code\']').val()),
			beforeSend: function() {
				$('.alert-danger').remove();
				$('.success, .warning').remove();
				$('#complete-register').attr('disabled', true);
				$('#complete-register').after('<div class="attention"><i class="fa fa-spinner"></i>Wait</div>');
			},
			complete: function() {
				$('#complete-register').attr('disabled', false);
				$('.attention').remove();
			},
			success: function(data) {
				if (data['error']['email_code']) {
					$('#email_code').after('<div class="alert alert-danger warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data['error']['email_code'] + '</div>');
				}
				
				if (data['error']['phone_code']) {
					$('#phone_code').after('<div class="alert alert-danger warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data['error']['phone_code'] + '</div>');
				}
				
				if (data['invalidsuccess']) {
					$('#error').after('<div class="alert alert-danger warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data['invalidsuccess'] + '</div>');
				}
				
				if (data['success']) {
					$('#message').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + data['success'] + '</div>');
					window.setTimeout(function(){
						window.location.href = data['redirect'];
					}, 5000);
				}
			}
		});
    });
});

function setValue(){
	if($('#agree').val()==1){
		$('#agree').val('');
	}else{
		$('#agree').val('1');
	}
}
</script>
<?php echo $footer; ?>