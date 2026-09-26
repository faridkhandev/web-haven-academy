<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading border-bottom">
		<div class="container-fluid page__container d-flex align-items-center">
			<h1 class="mb-0">Joining Point Withdrawal</h1>
			<?php if ($student['admin_approve'] == 1 && $student['is_point_requested'] == 0){ ?>
			<a onclick="sendJoiningPoint()" class="btn btn-success ml-auto"><i class="material-icons">send</i> Joining Point Withdrawal Request</a>
			<?php } ?>
		</div>
	</div>
	
	<div class="container-fluid page__container">
		<div class="card">
			<div class="card-header">
				<div class="row">
				    <?php if ($student['joining_point'] == 10000){ ?>
				        <?php if ($student['admin_approve'] == 1){ ?>
				            <?php if ($student['is_point_requested'] == 0){ ?>
				            <p>Please click on above button for sending joining point withdrawal request. Your joining point is <?php echo $student['joining_point']; ?></p>
				            <?php } ?>
				            
				            <?php if ($student['is_point_requested'] == 1 && $student['is_point_send'] == 0){ ?>
				                <p>You already requested to withdrawal joining point <?php echo $student['joining_point']; ?>. It is pending from admin approval.</p>
				                <?php }else{ ?>
				                <p>Admin already send your joining point <?php echo $student['joining_point']; ?>. </p>
				                <?php } ?>
				        <?php }else{ ?>
				        <p>Your joining point <?php echo $student['joining_point']; ?> is waiting for admin verification. After admin verify you can send withdrawal request.</p>
				        <?php } ?>
				    <?php }else{ ?>
				    <p>Sorry you are not authorize to view the content</p>
				    <?php } ?>
				</div>    
			</div> 
		</div> 
	</div>
</div>
<script type="text/javascript">
function sendJoiningPoint(){
    $.ajax({
		url: '<?php echo base_url('student/withdrawal/joinrequest'); ?>',
		type: 'post',
		data: 'status=1',
		dataType: 'json',
		success: function(json) {
		    alert('Your request successfully send to admin');
			location.reload();
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}
</script>
<?php $this->load->view('student/footer'); ?>