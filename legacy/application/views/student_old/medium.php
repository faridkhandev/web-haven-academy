<?php $this->load->view('student/header'); ?>
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
	<div class="page__heading border-bottom">
		<div class="container-fluid page__container">
			<h1 class="mb-0">Withdrawal Medium List</h1>
		</div>
	</div>
	<?php
	if($student['student_country']=="India"){
		$payment = array('Gpay', 'Phone Pay', 'Paytm', 'Binance');
	}elseif($student['student_country']=="Bangladesh"){
		$payment = array('Bkash', 'Nagad', 'Rocket', 'Binance');
	}elseif($student['student_country']=="Nepal"){
		$payment = array('eSewa', 'Binance');
	}
	
	?>
	<div class="card">
		<div class="container-fluid page__container">	
			<?php if(empty($payment_medium)){ ?><p><center>No Withdrawal Medium Added, Please add one.</center></p><?php } ?>
			<?php if(!empty($success)){?>
			<div class="alert alert-success alert-dismissible">
			<strong>Success!</strong><?php echo $success;?>
			</div>
			<?php } ?>
			<?php if(!empty($error_payment_medium)){?>
			<div class="alert alert-danger alert-dismissible">
			<strong>Danger!</strong><?php echo $error_payment_medium;?>
			</div>
			<?php } ?>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-medium">
				<div class="table-responsive">
					<table class="table table-striped table-bordered nowrap" id="table" width="100%">
						<thead>
							<tr>
								<th class="text-left">Medium Name(Like PhonePay, GPay, Bkash etc)</th>
								<th class="text-left">Mobile No</th>
								<th class="text-left">Action</th>
							</tr>	
						</thead>	
						<tbody>
							<?php 
							$medium_row = 0;
							if(!empty($payment_medium)){
								foreach($payment_medium as $item){
									?>
									<tr id="medium-row<?php echo $medium_row; ?>">
										<td class="text-right"><select name="payment_medium[<?php echo $medium_row; ?>][medium_name]" class="form-control"><?php foreach($payment as $name){ ?><option value="<?php echo $name; ?>" <?php if($name == $item['medium_name']) echo 'selected';?>><?php echo $name; ?></option><?php } ?></select>
										<?php if (!empty($error_medium[$medium_row]['medium_name'])) { ?>
										<div class="text-danger"><?php echo $error_medium[$medium_row]['medium_name']; ?></div>
										<?php } ?>
										</td>
										<td class="text-right"><input type="text" name="payment_medium[<?php echo $medium_row; ?>][medium_code]" value="<?php echo $item['medium_code']; ?>" class="form-control" />
										<?php if (!empty($error_medium[$medium_row]['medium_code'])) { ?>
										<div class="text-danger"><?php echo $error_medium[$medium_row]['medium_code']; ?></div>
										<?php } ?>
										</td>
										<td class="text-left"><button type="button" onclick="$('#medium-row<?php echo $medium_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
									</tr>
									<?php									
									$medium_row++;
								}
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2"></td>
								<td class="text-left"><button type="button" onclick="addMedium();" data-toggle="tooltip" title="Add" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
							</tr>
						</tfoot>
					</table>	
				</div>	
				<div class="row"><div class="col-md-12 pull-right"><div class="text-right mb-5"><button type="submit" name="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Save</button></button></div></div></div>
			</form>
		</div>	
	</div>	
</div>	
<?php $this->load->view('student/footer'); ?>
<script type="text/javascript"><!--
var medium_row = <?php echo $medium_row; ?>;

function addMedium() {
	html  = '<tr id="medium-row' + medium_row + '">';
	html += '  <td class="text-right"><select name="payment_medium[' + medium_row + '][medium_name]" class="form-control"><?php foreach($payment as $name){ ?><option value="<?php echo $name; ?>"><?php echo $name; ?></option><?php } ?></select></td>';
	html += '  <td class="text-right"><input type="text" name="payment_medium[' + medium_row + '][medium_code]" value="" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#medium-row' + medium_row  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#table tbody').append(html);

	medium_row++;
}
//--></script>