<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading">
		<div class="container-fluid page__container">
			<h1 class="mb-0">My Profile</h1>
		</div>
	</div>
	
	<div class="container-fluid page__container">
		
		<div class="row">
			<div class="col-md-12">		
				<div class="row">
					<div class="col avator">
						<?php 
							if($student['student_image'] != ''){
							$src= $student['student_image'];
							}else{
							$src= 'uploads/no-image.jpg';
							}
						?>	
						<img src="<?php echo base_url($src);?>" width="150px;" height="150px;" />
					</div>
				</div>
				<?php if($total_whatsapp_status['total_whatsapp_status']){?>
				<p class="alert alert-danger">You entered wrong whatsapp number, plz update the number from <a href="https://webhavenmedia.com/student/profile">edit profile page</a></p>
				<?php } ?>
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_no">Student ID</label>
							<input id="student_no" name="student_no" type="text" class="form-control" value="<?php echo $student['student_no'];?>" readonly>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_no">Total Point</label>
							<input id="student_point" name="student_point" type="text" class="form-control" value="<?php echo $student['student_point'];?>" readonly>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_no">Link Joining Point</label>
							<input id="student_point" name="joining_point" type="text" class="form-control" value="<?php echo $student['joining_point'];?>" readonly>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="fname">Student Name</label>
							<input id="fname" name="fname" type="text" class="form-control" value="<?php echo $student['student_name'];?>" readonly>
						</div>
					</div>
				</div>
				<div class="row">					
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_email">Student Email</label>
							<input id="student_email" name="student_email" type="text" class="form-control" value="<?php echo $student['student_email'];?>" readonly>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_phone">Student Phone</label>
							<input id="student_phone" name="student_phone" type="text" class="form-control" value="<?php echo $student['student_phone'];?>" readonly>
						</div>
					</div>
						
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_phone">Student Whatsapp</label>
							<input id="student_whatsapp" name="student_whatsapp" type="text" class="form-control" value="<?php echo $student['student_whatsapp'];?>" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_gender">Student Gender</label>
							<input id="student_gender" name="student_gender" type="text" class="form-control" value="<?php echo $student['student_gender'];?>" readonly>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_language">Student Language</label>
							<input id="student_language" name="student_language" type="text" class="form-control" value="<?php echo $student['student_language'];?>" readonly>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_city">Student City</label>
							<input id="student_city" name="student_city" type="text" class="form-control" value="<?php echo $student['student_city'];?>" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_city">Student Country</label>
							<input id="student_country" name="student_country" type="text" class="form-control" value="<?php echo $student['student_country'];?>" readonly>
						</div>
					</div>
					<?php if($this->session->userdata('student_status')==1){?>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_city">Trainer</label>
							<input id="student_country" name="student_country" type="text" class="form-control" value="<?php echo $student['firstname'].' '.$student['lastname'].'-'.$student['user_no'];?>" readonly>
						</div>
					</div>
					<?php } ?>
					<?php if($this->session->userdata('student_status')==0){?>
						<?php if($student['student_point'] >= $activation_point){?>
							<div class="col-12 col-md-4"><div class="form-group" style="margin-top:20px;"><a class="btn btn-success ml-auto" onclick="accountActive(<?php echo $student['student_id'];?>);"><i class="material-icons">send</i> Account Activation Request</a>	
						<?php } ?></div></div>
					<?php } ?>
					<?php if($this->session->userdata('student_status')==1){?> 
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_city">Refer To Other</label>
							<a href="https://api.whatsapp.com/send?text=<?php echo $this->session->userdata('refer_link');?>" data-action="share/whatsapp/share" target="_blank" class="btn btn-success ml-auto"><i class="material-icons">send</i> New Refer Request</a>
							
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_city">Copy Text</label>
							<input type="text" id="copyText" value="<?php echo $this->session->userdata('refer_link');?>" readonly>
							<button id="copyButton">Copy</button>
							
						</div>
					</div>
					<?php } ?>
				</div>
				<?php if($this->session->userdata('student_status')==0){?>
				<div class="row">
					<div class="col-md-6">
                        <div class="single-intro-inner text-center">
                            <div class="details">
                                <h4>Join Telegram Group</h4>
								<?php if($this->session->userdata('id')){ ?>
								<a class="btn btn-primary" onclick="gotolink('<?php echo $this->session->userdata('id') ?>', 'https://t.me/kosdigital2', 'telegram');">Join</a>
								<?php }else{ ?>
								<a class="btn btn-primary" href="https://t.me/kosdigital2" target="_blank">Join</a>
								<?php } ?>
                            </div>
                        </div>
                    </div>
					<div class="col-md-6">
                        <div class="single-intro-inner text-center">
                            <div class="details">
                                <h4>Join Whatsapp Group</h4>
								<?php if($this->session->userdata('id')){ ?>
								<a class="btn btn-primary" onclick="gotolink('<?php echo $this->session->userdata('id') ?>', 'https://whatsapp.com/channel/0029VasnNS4InlqOjLntaf06', 'whatsapp');">Join</a>
								<?php }else{ ?>
								<a class="btn btn-primary" href="https://whatsapp.com/channel/0029VasnNS4InlqOjLntaf06" target="_blank">Join</a>
								<?php } ?>
                            </div>
                        </div>
                    </div>
				</div>
				<?php } ?>
				<?php if($this->session->userdata('student_status')==1){?>
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_city">FB Profile</label>
							<input id="student_fb_link" name="student_fb_link" type="text" class="form-control" value="<?php echo $student['student_fb_link'];?>" readonly>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="student_city">Youtube Profile</label>
							<input id="student_youtube_link" name="student_youtube_link" type="text" class="form-control" value="<?php echo $student['student_youtube_link'];?>" readonly>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php if($this->session->userdata('student_status')==1){?>
		<div class="row" style="margin-top:20px;margin-bottom:60px;"> 
            <div class="text-center col mx-1">
				<h5>Active Student Group</h5>
				<h6>Whatsapp Group</h6>
				<a href="https://chat.whatsapp.com/EHxsJwS8R7jKnP9BAw7pYQ" target="_blank" class="btn btn-sm btn-success">Join Now</a>
			</div>
        </div> 
		<?php } ?>
	</div>
</div>
				
<?php $this->load->view('student/footer'); ?>
<script>
function accountActive(id){
	$.ajax({
		type: "POST",
		url: '<?php echo base_url('student/profile/active'); ?>', 
		data: {student_id: id},
		dataType: "text",  
		cache:false,
		success: 
		function(data){
			alert(data);  //as a debugging message.
			location.reload();
		}
	});// you have missed this bracket
}
</script>
<script>
document.getElementById("copyButton").addEventListener("click", function() {
  const textToCopy = document.getElementById("copyText");
  // Select the text field
  textToCopy.select();
  textToCopy.setSelectionRange(0, 99999); // For mobile devices

  // Copy the text to clipboard
  navigator.clipboard.writeText(textToCopy.value).then(() => {
	alert("Text copied to clipboard: " + textToCopy.value);
  }).catch(err => {
	console.error("Failed to copy text: ", err);
  });
});
</script>
<script>
	function gotolink(id, link, type){
        $.ajax({
            url: 'https://webhavenmedia.com/page/sendlink',
            method: 'POST',
            data: { id: id, type: type },
            success: function(response) {
                if(response == 'success') {
                    location.href = link;
                } else {
                    alert("You have unauthorize access");
                }
            }
        });
    }
	</script>