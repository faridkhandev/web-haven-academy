<?php $this->load->view('student/header'); ?>				
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading border-bottom">
		<div class="container-fluid page__container d-flex align-items-center">
			<h1 class="mb-0"><?php echo $course['course_name'];?></h1>
			<div class="ml-auto d-flex align-items-center">
				<a href="<?php echo base_url('student/course/view') ;?>?id=<?php echo $course['course_id'];?>" class="badge badge-dark-gray text-white">Back to Courses</a>
			</div>
		</div>
	</div>
	
	<div class="container-fluid page__container">
		<div class="row">

			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="media align-items-center">
							<div class="media-body">
								<h4 class="card-title m-0">
									SESSION <?php echo isset($_GET['session_no'])?$_GET['session_no']:'';?>
								</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
						<?php if(empty($student_status)){ ?>
						<p>Teacher:<?php echo $session['firstname'].' '.$session['lastname'];?> </p>
						<p>Session Date:<?php echo $session['session_date'];?> </p>
						<p>Session Time:<?php echo $session['session_time'];?> </p>
						<?php if($student_no != '1090690') { ?>
						<?php if(empty($submit_status)){ ?>
						<?php if(!empty($session)){ ?>
						<?php if(strtotime($session['session_date']) == strtotime(date('Y-m-d'))){ ?>
						<?php if(strtotime($session['session_time']) <= strtotime(date('H:i'))){ ?>
						<?php if($course['course_id'] == 2 || $course['course_id'] == 4){?>
						<a data-toggle="modal" data-target="#modal-large" class="btn btn-success ml-auto"><i class="material-icons">add</i> Submit Work</a>
						<?php }elseif($course['course_id'] == 3){ ?>
						<a data-toggle="modal" data-target="#modal-upload" class="btn btn-success ml-auto"><i class="material-icons">add</i> Submit Work</a>
						<?php }else{ ?>
						<a class="btn btn-success ml-auto"><i class="material-icons">add</i> Class Attandance</a>
						<?php } ?>
						<?php } ?>
						<?php }elseif(strtotime($session['session_date']) < strtotime(date('Y-m-d'))){ ?>
						<?php if($course['course_id'] == 2 || $course['course_id'] == 4){ ?>
						<a data-toggle="modal" data-target="#modal-large" class="btn btn-success ml-auto"><i class="material-icons">add</i> Submit Work</a>
						<?php }elseif($course['course_id'] == 3){ ?>
						<a data-toggle="modal" data-target="#modal-upload" class="btn btn-success ml-auto"><i class="material-icons">add</i> Submit Work</a>
						<?php }else{ ?>
						<a class="btn btn-success ml-auto"><i class="material-icons">add</i> Class Attandance</a>
						<?php } ?>
						<?php } ?>
						<?php } ?>
						<?php }else{ ?>
						<p>Great, You already submitted task for this session.</p>
						<?php } ?>
						<?php }else{ ?>
						<a data-toggle="modal" data-target="#modal-large" class="btn btn-success ml-auto"><i class="material-icons">add</i> Submit Work</a>
						<?php } ?>
						<?php }else{ ?>
						<p>Great, You already completed this session</p>
						<?php } ?>
					</div>
					<?php if(empty($student_status)){?>
					<?php if(strtotime($session['session_date']) > strtotime(date('Y-m-d'))){?>
					<div class="card-footer">
						<a href="<?php echo $session['meeting_link'];?>" class="btn btn-success float-right" target="_blank">Join Meeting <i class="material-icons btn__icon--right">arrow_forward</i></a>
					</div>
					<?php }elseif(strtotime($session['session_date']) == strtotime(date('Y-m-d'))){ ?>
					<?php if((strtotime($session['session_time']) + 60*60) >= strtotime(date('H:i'))){?>
					<div class="card-footer">
						<a href="<?php echo $session['meeting_link'];?>" class="btn btn-success float-right" target="_blank">Join Meeting <i class="material-icons btn__icon--right">arrow_forward</i></a>
					</div>
					<?php } ?>
					<?php } ?>
					<?php } ?>
					
				</div>
			</div>
		</div>
	</div>
</div>	
<?php $this->load->view('student/footer'); ?>
<div id="modal-large" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-large-title" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-large-title">Course:<?php echo $course['course_name'];?>||SESSION <?php echo isset($_GET['session_no'])?$_GET['session_no']:'';?></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div> <!-- // END .modal-header -->
			<div class="modal-body">
				<div id="section-add">
					<div class="form-group required"><label for="dtp_input2" class="control-label">Work Link:</label><input type="text" id="work_link" name="work_link" class="form-control" style="margin-bottom:5px;" value="" /></div>
				</div>
				
				<div id="add-msg"></div>
			</div> <!-- // END .modal-body -->
			<div class="modal-footer" id="footer-add">
				<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
				<button type="button" id="button-add" class="btn btn-primary">Send</button>
			</div> <!-- // END .modal-footer -->
		</div> <!-- // END .modal-content -->
	</div> <!-- // END .modal-dialog -->
</div> <!-- // END .modal -->

<div id="modal-upload" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-large-title" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form id="form" action="#" method="post" enctype="multipart/form-data">	
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="modal-large-title">Course:<?php echo $course['course_name'];?>||SESSION <?php echo isset($_GET['session_no'])?$_GET['session_no']:'';?></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div> <!-- // END .modal-header -->
			<div class="modal-body">
				<div id="section-upload">
					<div class="form-group required"><label for="dtp_input2" class="control-label">Screenshot Upload:</label><input type="file" id="work_link" name="screenshot" class="form-control" style="margin-bottom:5px;" value="" /></div>
					<input type="hidden" name="session_id" value="<?php echo $session['session_id'];?>" />
					<input type="hidden" name="course_id" value="<?php echo $course['course_id'];?>" />
				</div>
				
				<div id="upload-msg"></div>
			</div> <!-- // END .modal-body -->
			<div class="modal-footer" id="footer-upload">
				<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
				<button type="button" id="button-upload" class="btn btn-primary">Send</button>
			</div> <!-- // END .modal-footer -->
		</div> <!-- // END .modal-content -->
		</form>
	</div> <!-- // END .modal-dialog -->
</div> <!-- // END .modal -->

<script>
$('#button-add').click(function(){
	if($('#work_link').val() != ''){
		$.ajax({
			url: '<?php echo base_url('student/course/addrequest'); ?>?id=<?php echo $course['course_id'];?>&session_id=<?php echo $session['session_id'];?>',
			type: 'post',
			data: 'course_id=<?php echo $course['course_id'];?>&session_id=<?php echo $session['session_id'];?>&link='+$('#work_link').val(),
			dataType: 'json',
			beforeSend: function() {
				$('#button-add').button('loading');
			},
			complete: function() {
				 $('#button-add').button('reset');
			},
			success: function(json) {
				$('.alert, .text-danger').remove();
				if (json['error']) {
					$('#add-msg').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					$('#footer-add').hide();
					$('#add-msg').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '  <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					
					location.reload();
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}else{
		alert('Please add link');	
	}
});

$('#button-upload').click(function(){
	$.ajax({
		url: '<?php echo base_url('student/course/uploadrequest'); ?>?id=<?php echo $course['course_id'];?>&session_id=<?php echo $session['session_id'];?>',
		type: 'post',
		dataType: 'json',
		data: new FormData($('#form')[0]),
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function() {
			$('#button-upload').button('loading');
		},
		complete: function() {
			 $('#button-upload').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			if (json['error']) {
				$('#upload-msg').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			}
			
			if (json['success']) {
				$('#footer-upload').hide();
				$('#upload-msg').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '  <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				
				location.reload();
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
</script>