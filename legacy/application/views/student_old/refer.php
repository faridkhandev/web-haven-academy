<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading border-bottom">
		<div class="container-fluid page__container d-flex align-items-center">
			<h1 class="mb-0">My Refer</h1>
			<?php if($this->session->userdata('student_status')==1){?>
			<a href="https://api.whatsapp.com/send?text=<?php echo $this->session->userdata('refer_link');?>" data-action="share/whatsapp/share" target="_blank" class="btn btn-success ml-auto"><i class="material-icons">send</i>Send New Refer Request</a>
			<?php } ?>
		</div>
	</div>
	
	<div class="container-fluid page__container">
		<div class="card">
			<div class="card-header">
				<form name="form_filter" enctype="multipart/form-data" id="form-filter" class="form-inline">
					<label class="mr-sm-2" for="inlineFormFilterBy">Start Date:</label>

					<label class="sr-only" for="inlineFormRole">Start Date</label>
					<input type="text" class="form-control mb-3 mr-sm-3 mb-sm-0 flatpickrStart" name="filter_start_date" placeholder="YYYY-MM-DD" value="<?php echo $filter_start_date;?>">
					
					<label class="mr-sm-2" for="inlineFormFilterBy">End Date:</label>
					<label class="sr-only" for="inlineFormRole">End Date</label>
					<input type="text" class="form-control mb-3 mr-sm-3 mb-sm-0 flatpickrEnd" placeholder="YYYY-MM-DD" name="filter_end_date" placeholder="YYYY-MM-DD" value="<?php echo $filter_end_date;?>">

					<div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
						<div class="ml-auto"><button type="button" class="btn btn-success" id="button-filter"> Filter</button></div>
					</div>
				</form>
			</div>
			<div class="container-fluid page__container">
				<table class="table table-striped table-bordered nowrap" id="table" width="100%">
					<thead>
						<tr>
							<th class="text-left">ID</th>
							<th class="text-left">Name</th>
							<th class="text-left">Phone</th>
							<th class="text-left">Whatsapp</th>
							<th class="text-left">Gender</th>
							<th class="text-left">Date Added</th>
							<th class="text-left">Status</th>
							<th class="text-left">Action</th>
						</tr>
					</thead>
					<tbody></tbody>
					<tfoot>
						<tr>
							<th class="text-left">ID</th>
							<th class="text-left">Name</th>
							<th class="text-left">Phone</th>
							<th class="text-left">Whatsapp</th>
							<th class="text-left">Gender</th>
							<th class="text-left">Date Added</th>
							<th class="text-left">Status</th>
							<th class="text-left">Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>	
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {	
	var url = '<?php echo base_url('student/refer'); ?>';
	var table = $('#table').DataTable({
		"stateSave": true,
		"scrollY": "100%",
		//"dom": "lftipr",
		"scrollX":true,
		//"dom": '<"top"lip>rt<"bottom"><"clear">',
		//"dom": "Bfrtip",
		"searching": false,
		"order": [],
		"processing": false,
		"serverSide": true,
		"lengthMenu": [[10,20,50,100, 250, 500, 750, 1000,-1], [10,20,50,100, 250, 500, 750, 1000,"All"]],
		"pageLength": 20,
		"ajax": {
			"url": url,
			"type": "POST",
			"data": function (data) {
				var filter_end_date = $.trim($('input[name=\'filter_end_date\']').val());
				if (filter_end_date) {
					data.filter_end_date = filter_end_date;
				}
				
				var filter_start_date = $.trim($('input[name=\'filter_start_date\']').val());
				if (filter_start_date) {
					data.filter_start_date = filter_start_date;
				}
			}
		},
		"columns": [
			{"data": "student_no", "searchable": false},
			{"data": "student_name", "searchable": false},
			{"data": "student_phone", "searchable": false},
			{"data": "student_whatsapp", "searchable": false},
			{"data": "student_gender", "searchable": false},
			{"data": "created_at", "searchable": false},
			{"data": "student_status", "searchable": false},
			{"data": "action", "width":"14%", "orderable": false, "searchable": false, "className": "text-center", "render": function(data, type, full) {
				var html = '';
				if(full.whatsapp_status == 0){
					html += '&nbsp;<a data-toggle="modal" data-target="#confirm-status" data-id=' + data + ' data-student_no=' + full.student_no + ' data-student_name="' + full.student_name + '" class="btn btn-primary btn-xs"><span data-toggle="tooltip" data-placement="top" data-original-title="Update Whatsapp No"><i class="fab fa-whatsapp" style="color:#fff;"></i></span></a>';
					}
					return html;
				}}
		]
	});
	
	$('#button-filter').on('click', function() {
		table.ajax.reload();
	});
});
</script>	
	
<?php $this->load->view('student/footer'); ?>
<div class="modal fade" id="confirm-status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body" style="min-height:140px">
					<div id="section-add">
						<div class="form-group"><label for="dtp_input2" class="control-label">New Whatsapp No(Ex:8801747355):</label><input type="text" name="student_whatsapp" class="form-control" style="margin-bottom:5px;" value="" placeholder="88017789080" /></div>
						<input type="hidden" name="student_id" value="" />
					</div>
					
					<div id="add-msg"></div>
				</div>
				<div class="modal-footer" id="footer-add">
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					<button type="button" id="button-add" data-loading-text="Loading" class="btn btn-danger">Save</button>
				</div>
			</div>
		</div>
	</div>		
<script>
	$('#confirm-status').on('show.bs.modal', function(e) {
		var id = ($(e.relatedTarget).data('id'));
		var student_no = ($(e.relatedTarget).data('student_no'));
		var name = ($(e.relatedTarget).data('student_name'));
		$('#section-add input[name=\'student_id\']').val(id);
		$('#myModalLabel').html('ID:'+student_no+' Name:'+name);
	});
	$('#button-add').click(function(){
		$.ajax({
			url: '<?php echo site_url('student/refer/updatewhatsappp'); ?>',
			type: 'post',
			data: $('#section-add input[type=\'text\'], #section-add input[type=\'hidden\'], #section-add textarea'),
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
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
	</script>	