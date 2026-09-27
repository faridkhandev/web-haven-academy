<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<div class="panel panel-default">
			
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
				</div>
				<div class="pull-right">
					<button type="submit" form="form-doctor" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<?php include 'view/template/common/message.tpl' ; ?>
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-doctor">
					<div class="row">	
						<div class="col-sm-3">
							<div class="form-group">
								<label class="control-label" for="input-doctor">Select Doctor</label>
								<select name="doctor_id" id="input-doctor" class="form-control select2">
									<option value="">-Select-</option>
									<?php foreach($doctors as $doctor){ ?>
									<option value="<?php echo $doctor['doctor_id']; ?>"><?php echo $doctor['doctor_name'].'('.$doctor['doctor_id'].')'; ?></option>
									<?php } ?>
								</select>
								<?php if ($error_doctor_id) { ?>
								<div class="text-danger"><?php echo $error_doctor_id; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="control-label" for="input-investment_amount">Investment Amount</label>
								<input type="text" name="investment_amount" value="" id="input-investment_amount" class="form-control" />
								<?php if ($error_investment_amount) { ?>
								<div class="text-danger"><?php echo $error_investment_amount; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="control-label" for="input-limit_amount">Limit Amount</label>
								<input type="text" name="limit_amount" value="" id="input-limit_amount" class="form-control" />
								<?php if ($error_limit_amount) { ?>
								<div class="text-danger"><?php echo $error_limit_amount; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="control-label" for="input-date">Added Date</label>
								<div class="input-group date">
									<input type="text" name="date_added" value="" id="input-date" class="form-control">
									<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
								</div>
							</div>	
						</div>
					</div>
					<div class="row">	
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label" for="input-note">Any Note</label>
								<input type="text" name="description" value="<?php echo $description; ?>" id="input-description" class="form-control" />
							</div>
						</div>
						
					</div>
				</form>
			</div>
			<div class="panel-footer">
				<div class="pull-right">
					<button type="submit" form="form-doctor" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickDate: true,
	pickTime: false,
	format: 'YYYY-MM-DD',
	inline: false,
});
$(document).ready(function() {	
	$('.select2').select2();
});
//--></script>
<?php echo $footer; ?>