<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<div class="panel panel-default" style="margin-top: 20px;">
			<div class="panel-heading" style="background-color: #0288d1; color: #fff; padding: 10px 15px;">
				<div class="pull-left">
					<h3 class="panel-title" style="color: #fff; font-size: 16px; margin-top: 4px;">
						<i class="fa fa-users"></i> 
						<?php echo ($status == 'active') ? 'Active' : 'Inactive'; ?> Student List (Quick View)
					</h3>
				</div>
				<div class="pull-right">
					<button type="button" class="btn btn-warning btn-sm" onclick="copySelectedStudents()"><i class="fa fa-copy"></i> Copy Selected</button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="row" style="margin-bottom: 15px;">
					<div class="col-sm-4">
						<input type="text" id="quickSearchInput" class="form-control input-sm" placeholder="আইডি, নাম, ফোন বা ইমো দিয়ে খুঁজুন...">
					</div>
					<div class="col-sm-8 text-right">
						<span class="text-muted" style="font-size: 13px;">ক্লিক করলেই কপি হবে: <b>No</b> অথবা <b>Whatsapp</b> এ ক্লিক করুন। একসাথে কপি করতে চেকবক্স সিলেক্ট করে <b>Copy Selected</b> চাপুন।</span>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="quickStudentTable" style="font-size: 12px;">
						<thead>
							<tr style="background: #0288d1; color: #fff;">
								<th width="30" class="text-center"><input type="checkbox" id="checkAll"></th>
								<th>No</th>
								<th>Name</th>
								<th>Whatsapp</th>
								<th>Imo</th>
								<th>Created At</th>
								<th class="text-center">Point</th>
								<th class="text-center">Join Point</th>
								<th>Counsellor</th>
								<th>Activated At</th>
								<th class="text-center" width="<?php echo ($status == 'active') ? '170' : '80'; ?>">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($students)) { ?>
								<?php foreach ($students as $row) { ?>
									<?php 
										$phone = !empty($row['student_whatsapp']) ? $row['student_whatsapp'] : $row['student_phone']; 
										$name = htmlspecialchars($row['student_name']);
										$clean_phone = preg_replace('/[^0-9]/', '', $phone);
										$created_date = !empty($row['created_at']) ? date('Y-m-d h:i A', strtotime($row['created_at'])) : '';
									?>
									<tr>
										<td class="text-center">
											<input type="checkbox" class="student-select" data-id="<?php echo $row['student_no']; ?>" data-name="<?php echo $name; ?>" data-phone="<?php echo $phone; ?>">
										</td>
										<td>
											<span class="quick-copy-badge" onclick="runDirectCopy('<?php echo $row['student_no']; ?>', '<?php echo addslashes($row['student_name']); ?>', '<?php echo $phone; ?>')" title="ক্লিক করলে কপি হবে"><?php echo $row['student_no']; ?></span>
										</td>
										<td><?php echo $row['student_name']; ?></td>
										<td>
											<?php if (!empty($phone)) { ?>
												<span class="quick-copy-badge text-primary" onclick="copySingleText('<?php echo $phone; ?>', 'ফোন নম্বর কপি হয়েছে!')" title="ক্লিক করলেই নম্বর কপি"><?php echo $phone; ?></span>
												<a href="https://api.whatsapp.com/send?phone=<?php echo $clean_phone; ?>" target="_blank" style="margin-left: 5px; color: #25D366;" title="WhatsApp মেসেজ দিন"><i class="fa fa-whatsapp"></i></a>
											<?php } ?>
										</td>
										<td>
											<?php if (!empty($row['student_telegram'])) { ?>
												<span class="quick-copy-badge" onclick="copySingleText('<?php echo $row['student_telegram']; ?>', 'ইমো/টেলিগ্রাম কপি হয়েছে!')"><?php echo $row['student_telegram']; ?></span>
											<?php } ?>
										</td>
										<td><?php echo $created_date; ?></td>
										<td class="text-center"><?php echo (int)$row['student_point']; ?></td>
										<td class="text-center"><?php echo (int)$row['joining_point']; ?></td>
										<td><?php echo !empty(trim($row['counsellor_name'])) ? $row['counsellor_name'] : '-'; ?></td>
										<td><?php echo !empty($row['activated_at_formatted']) ? $row['activated_at_formatted'] : '-'; ?></td>
										<td class="text-center">
											<?php if ($status == 'active') { ?>
												<!-- অ্যাক্টিভ স্টুডেন্টের সব বাটন -->
												<a href="<?php echo $row['edit_link']; ?>" class="btn btn-primary btn-xs action-btn" target="_blank" title="Edit Student"><i class="fa fa-pencil"></i></a>
												<a href="<?php echo $row['passbook_link']; ?>" class="btn btn-info btn-xs action-btn" target="_blank" title="Passbook"><i class="fa fa-book"></i></a>
												<a href="<?php echo $row['refer_link']; ?>" class="btn btn-success btn-xs action-btn" target="_blank" title="Refer History"><i class="fa fa-share-alt"></i></a>
												<a href="<?php echo $row['payment_link']; ?>" class="btn btn-warning btn-xs action-btn" target="_blank" title="Payment"><i class="fa fa-money"></i></a>
												<a href="<?php echo $row['withdrawal_link']; ?>" class="btn btn-default btn-xs action-btn" target="_blank" title="Withdrawal"><i class="fa fa-credit-card"></i></a>
												<button type="button" class="btn btn-danger btn-xs action-btn" onclick="runDirectCopy('<?php echo $row['student_no']; ?>', '<?php echo addslashes($row['student_name']); ?>', '<?php echo $phone; ?>')" title="কপি করুন"><i class="fa fa-copy"></i></button>
											<?php } else { ?>
												<!-- ইনঅ্যাক্টিভ স্টুডেন্টের জন্য শুধু Edit এবং Copy বাটন -->
												<a href="<?php echo $row['edit_link']; ?>" class="btn btn-primary btn-xs action-btn" target="_blank" title="Edit Student"><i class="fa fa-pencil"></i></a>
												<button type="button" class="btn btn-danger btn-xs action-btn" onclick="runDirectCopy('<?php echo $row['student_no']; ?>', '<?php echo addslashes($row['student_name']); ?>', '<?php echo $phone; ?>')" title="কপি করুন"><i class="fa fa-copy"></i></button>
											<?php } ?>
										</td>
									</tr>
								<?php } ?>
							<?php } else { ?>
								<tr>
									<td colspan="11" class="text-center text-danger">কোনো স্টুডেন্ট পাওয়া যায়নি!</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<!-- পেজিনেশন ও রেজাল্ট কাউন্ট -->
				<div class="row" style="margin-top: 15px;">
					<div class="col-sm-6 text-left" style="line-height: 35px;">
						<span class="text-muted"><?php echo isset($results) ? $results : ''; ?></span>
					</div>
					<div class="col-sm-6 text-right">
						<?php echo isset($pagination) ? $pagination : ''; ?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<style>
	.quick-copy-badge {
		cursor: pointer;
		font-weight: 600;
		text-decoration: underline;
		padding: 1px 4px;
		display: inline-block;
	}
	.quick-copy-badge:hover {
		background-color: #e1f5fe;
		border-radius: 3px;
	}
	#quickStudentTable tbody tr:hover {
		background-color: #f9f9f9;
	}
	.pagination {
		margin: 0;
	}
	.action-btn {
		padding: 2px 5px;
		margin: 1px;
	}
</style>

<script type="text/javascript">
	$('#quickSearchInput').on('keyup', function() {
		var val = $(this).val().toLowerCase();
		$('#quickStudentTable tbody tr').filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(val) > -1);
		});
	});

	$('#checkAll').on('click', function() {
		$('.student-select').prop('checked', this.checked);
	});

	function copySingleText(text, successMsg) {
		executeClipboard(text, successMsg);
	}

	function runDirectCopy(id, name, phone) {
		var text = "ID: " + id + "\nName: " + name + "\nWhatsApp: " + phone;
		executeClipboard(text, "তথ্য কপি হয়েছে:\n\n" + text);
	}

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
</script>
<?php echo $footer; ?>
