<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
				</div>
				<div class="pull-right" style="margin-left: 10px;">
					<button type="button" class="btn btn-warning btn-xs" onclick="copySelectedStudents()" data-toggle="tooltip" title="Copy Selected"><i class="fa fa-copy"></i> Copy Selected</button>
				</div>
				<div class="pull-right">
					<button class="btn btn-warning btn-xs" id="btn-refresh" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></button>
					<button class="btn btn-primary btn-xs" id="btn-form"><i class="fa fa-filter"></i></button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="well" id="well" style="display: none;">
					<div class="row">
						<form enctype="multipart/form-data" id="form-filter">
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-name">Name</label>
									<input type="text" name="filter_name" value="" id="input-name" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-phone">Phone</label>
									<input type="text" name="filter_phone" value="" id="input-phone" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-whatsapp">Whatsapp</label>
									<input type="text" name="filter_whatsapp" value="" id="input-whatsapp" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-email">Email</label>
									<input type="text" name="filter_email" value="" id="input-email" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-student_no">Student ID</label>
									<input type="text" name="filter_student_no" value="" id="input-student_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-refer_no">Refer Student ID</label>
									<input type="text" name="filter_refer_no" value="" id="input-refer_no" class="form-control" />
								</div>
							</div>
							<?php if($user_group_id != 14){?>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-start-date">Created Start Date</label>
									<div class="input-group date">
										<input type="text" name="filter_start_date" value="<?php echo $filter_start_date;?>" id="input-start-date" class="form-control">
										<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
									</div>
								</div>	
							</div>
							
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-end-date">Created End Date</label>
									<div class="input-group date">
										<input type="text" name="filter_end_date" value="<?php echo $filter_end_date;?>" id="input-end-date" class="form-control">
										<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
									</div>
								</div>	
							</div>
							<?php } ?>
							<?php if($user_group_id == 12){?>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-user_no">Trainer ID</label>
									<input type="text" name="filter_user_no" value="" id="input-user_no" class="form-control" />
								</div>
							</div>
							<?php } ?>
							
							<?php if($user_group_id == 13){ ?>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-user_no">Trainer ID</label>
									<input type="text" name="filter_user_no" value="" id="input-user_no" class="form-control" />
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-team_leader_no">Team Leader ID</label>
									<input type="text" name="filter_team_leader_no" value="" id="input-team_leader_no" class="form-control" />
								</div>
							</div>
							<?php } ?>
							<?php if($user_group_id == 11 || $user_group_id == 12 || $user_group_id == 13){ ?>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label" for="input-status">Status</label>
									<select name="filter_status" class="form-control">
										<option value="">-Select-</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</div>
							</div>
							<?php } ?>
							<div class="col-sm-3">
								<button type="button" id="button-filter" class="btn btn-primary filterBtns pull-right"><i class="fa fa-search"></i> Filter</button>	
							</div>
						</form>
					</div>
				</div>
				<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-user">
					<div class="table-responsive">
						<table class="table table-striped table-bordered nowrap" id="table" width="100%">
							<thead>
								<tr>
									<th width="30" class="text-center"><input type="checkbox" id="checkAll"></th>
									<th class="text-left">No</th>
									<th class="text-left">Name</th>
									<th class="text-left">Phone</th>
									<th class="text-left">Whatsapp</th>
									<th class="text-left">Created At</th>
									<th class="text-left">Refer</th>
									<th class="text-left">Status</th>
									<th class="text-left">Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th width="30" class="text-center"></th>
									<th class="text-left">No</th>
									<th class="text-left">Name</th>
									<th class="text-left">Phone</th>
									<th class="text-left">Whatsapp</th>
									<th class="text-left">Created At</th>
									<th class="text-left">Refer</th>
									<th class="text-left">Status</th>
									<th class="text-left">Action</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<style>
	.quick-copy-badge {
		cursor: pointer;
		font-weight: 600;
		text-decoration: underline;
		color: #1b6d85;
	}
	.quick-copy-badge:hover {
		background-color: #d9edf7;
		border-radius: 3px;
	}
</style>

<script type="text/javascript">
	$(document).ready(function() {	
		var url = 'index.php?route=module/counsellorstudent&token=<?php echo $token; ?>';
		var tableExportColumns = [1,2,3,4,5,6,7];
		var table = $('#table').DataTable({
			"dom": "Bfrtip",
			"searching": false,
			"order": [],
			"processing": false,
			"serverSide": true,
			"pageLength": <?php echo $page_length; ?>,
			"lengthMenu": [[10,20,50,100, 250, 500, 750, 1000], [10,20,50,100, 250, 500, 750, 1000]],
			"ajax": {
				"url": url,
				"type": "POST",
				"data": function (data) {
					var filter_search = $.trim($('input[name=\'filter_search\']').val());
					if (filter_search) {
						data.filter_search = filter_search;
					}
					
					var filter_name = $.trim($('input[name=\'filter_name\']').val());
					if (filter_name) {
						data.filter_name = filter_name;
					}
					
					var filter_phone = $.trim($('input[name=\'filter_phone\']').val());
					if (filter_phone) {
						data.filter_phone = filter_phone;
					}
					
					var filter_whatsapp = $.trim($('input[name=\'filter_whatsapp\']').val());
					if (filter_whatsapp) {
						data.filter_whatsapp = filter_whatsapp;
					}
					
					var filter_email = $.trim($('input[name=\'filter_email\']').val());
					if (filter_email) {
						data.filter_email = filter_email;
					}
					
					var filter_student_no = $.trim($('input[name=\'filter_student_no\']').val());
					if (filter_student_no) {
						data.filter_student_no = filter_student_no;
					}
					
					var filter_refer_no = $.trim($('input[name=\'filter_refer_no\']').val());
					if (filter_refer_no) {
						data.filter_refer_no = filter_refer_no;
					}
					
					var filter_user_no = $.trim($('input[name=\'filter_user_no\']').val());
					if (filter_user_no) {
						data.filter_user_no = filter_user_no;
					}
					
					var filter_team_leader_no = $.trim($('input[name=\'filter_team_leader_no\']').val());
					if (filter_team_leader_no) {
						data.filter_team_leader_no = filter_team_leader_no;
					}
					
					var filter_status = $.trim($('select[name=\'filter_status\']').val());
					if (filter_status) {
						data.filter_status = filter_status;
					}
					
					var filter_start_date = $.trim($('input[name=\'filter_start_date\']').val());
					if (filter_start_date) {
						data.filter_start_date = filter_start_date;
					}
					
					var filter_end_date = $.trim($('input[name=\'filter_end_date\']').val());
					if (filter_end_date) {
						data.filter_end_date = filter_end_date;
					}
				}
			},
			"columns": [
				{"data": "id", "searchable": false, "orderable": false, "className": "text-center", "render": function(data, type, full) {
					return '<input type="checkbox" class="student-select" data-id="'+full.student_no+'" data-name="'+escapeHtml(full.student_name)+'" data-phone="'+full.student_phone_raw+'">';
				}},
				{"data": "student_no", "searchable": false, "render": function(data, type, full) {
					return '<span class="quick-copy-badge" onclick="runDirectCopy(\''+full.student_no+'\', \''+escapeHtml(full.student_name)+'\', \''+full.student_phone_raw+'\')" title="ক্লিক করলে কপি হবে">'+full.student_no+'</span>';
				}},
				{"data": "student_name", "searchable": false},
				{"data": "student_phone", "searchable": false},
				{"data": "student_whatsapp", "searchable": false},
				{"data": "created_at", "searchable": false},
				{"data": "student_refer_name", "searchable": false, "orderable": false},
				{"data": "student_status", "searchable": false, "orderable": false},
				{"data": "action", "orderable": false, "searchable": false, "className": "text-center", "render": function(data, type, full) {
					var html = '';
					if(full.whatsapp_status == 0){
						html +='<span style="color:red"><b>WA</b></span>';
					}else{
						if(full.message_status == 0){
							html +='<a onclick="confirm(\'Are you sure?\') ? sendMessage('+full.id+') : false;" class="btn btn-primary btn-status btn-xs"><span data-toggle="tooltip" data-placement="top" data-original-title="Message Done"><i class="fa fa-paper-plane"></i></span></a> ';
							html +='<a onclick="confirm(\'Are you sure?\') ? sendWhatsapp('+full.id+') : false;" class="btn btn-primary btn-status btn-xs"><span data-toggle="tooltip" data-placement="top" data-original-title="Whatsapp Wrong"><i class="fa fa-whatsapp"></i></span></a>';
						}else{
							html ='Done';
						}
					}
					return html;
				}}
			],
			buttons: [
				{extend: 'copy', text: '<i class="fa fa-files-o"></i>', titleAttr: 'Copy', exportOptions: {columns: tableExportColumns}},
				{extend: 'print', className: 'btn-info', text: '<i class="fa fa-print"></i>', titleAttr: 'Print', exportOptions: {columns: tableExportColumns}},
				{extend: 'excel', className: 'btn-success', text: '<i class="fa fa-file-excel-o"></i>', titleAttr: 'Excel', exportOptions: {columns: tableExportColumns}},
				{extend: 'pdf', className: 'btn-danger', text: '<i class="fa fa-file-text-o"></i>', titleAttr: 'PDF', exportOptions: {columns: tableExportColumns}},
				{extend: 'pageLength', className: 'btn-primary'},
			]
		});
		
		$('#btn-refresh').on('click', function() {
			$('#form-filter')[0].reset();
			table.order([]).ajax.reload();
		});
		
		$('#button-filter').on('click', function() {
			table.ajax.reload();
		});
		
		$('#btn-form').on('click', function() {
			$('#well').stop().slideToggle('fast', 'linear');
		});
		
		$('.date').datetimepicker({
			pickDate: true,
			pickTime: false,
			format: 'YYYY-MM-DD',
			inline: false,
		});
		
		// Select All Checkbox
		$('#checkAll').on('click', function() {
			$('.student-select').prop('checked', this.checked);
		});
	});
	
	function escapeHtml(text) {
		return text ? text.replace(/'/g, "\\'").replace(/"/g, '&quot;') : '';
	}

	// একক স্টুডেন্ট কপি
	function runDirectCopy(id, name, phone) {
		var text = "ID: " + id + "\nName: " + name + "\nWhatsApp: " + phone;
		executeClipboard(text, "তথ্য কপি হয়েছে:\n\n" + text);
	}

	// সিলেক্ট করা স্টুডেন্টদের ডাটা একসাথে কপি
	function copySelectedStudents() {
		var selected = [];
		$('.student-select:checked').each(function() {
			var id = $(this).data('id');
			var name = $(this).data('name');
			var phone = $(this).data('phone');
			selected.push(id + "\t" + name + "\t" + phone);
		});

		if (selected.length === 0) {
			alert('দয়া করে অন্তত একটি রো নির্বাচন করুন!');
			return;
		}

		var text = selected.join("\n");
		executeClipboard(text, "মোট " + selected.length + " জনের তথ্য কপি হয়েছে!");
	}

	// নিরাপদ ক্লিপবোর্ড কপি
	function executeClipboard(text, successMsg) {
		var textArea = document.createElement("textarea");
		textArea.value = text;
		textArea.style.position = "fixed";
		textArea.style.left = "-9999px";
		textArea.style.top = "0";
		document.body.appendChild(textArea);
		textArea.focus();
		textArea.select();
		textArea.setSelectionRange(0, 99999);

		var success = false;
		try {
			success = document.execCommand('copy');
		} catch (err) {
			success = false;
		}
		document.body.removeChild(textArea);

		if (success) {
			alert(successMsg);
		} else if (navigator.clipboard && window.isSecureContext) {
			navigator.clipboard.writeText(text).then(function() {
				alert(successMsg);
			}).catch(function() {
				prompt("কপি করতে নিচের টেক্সটটি Ctrl+C চাপুন:", text);
			});
		} else {
			prompt("কপি করতে নিচের টেক্সটটি Ctrl+C চাপুন:", text);
		}
	}
	
	function sendMessage(id){
		$.ajax({
			url: 'index.php?route=module/counsellorstudent/message&token=<?php echo $token; ?>',
			type: 'post',
			dataType: 'json',
			data: 'student_id='+id,
			success: function(json) {
				if(json['error']){
					alert(json['error']);
				}
				if (json['success']) {
					alert(json['success']);
					var link = document.querySelector('#btn-refresh');
					if(link) {
						link.click();
					}
				}
			}
		});
	}
	
	function sendWhatsapp(id){
		$.ajax({
			url: 'index.php?route=module/counsellorstudent/whatsapp&token=<?php echo $token; ?>',
			type: 'post',
			dataType: 'json',
			data: 'student_id='+id,
			success: function(json) {
				if(json['error']){
					alert(json['error']);
				}
				if (json['success']) {
					alert(json['success']);
					var link = document.querySelector('#btn-refresh');
					if(link) {
						link.click();
					}
				}
			}
		});
	}
</script>

<script type="text/javascript"><!--
	$(document).ready(function () {
		$('#table').on('click', 'tr', function (){
			$('#table tr').css('background-color', '');
			$(this).css('background-color', '#5bc0de');
		});
	});
	$('.select2').select2();
//--></script>
<?php echo $footer; ?>
