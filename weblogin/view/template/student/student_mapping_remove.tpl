<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">		
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-pencil"></i>Inactive Student And Remove Mapping & Point</h3>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user">
					<div class="row">
						<div class="col-sm-8">
							<div class="form-group required">
								<label class="control-label" for="input-no">Student No</label>
								<input type="text" name="student_no" value="<?php echo $student_no; ?>" id="input-student_no" class="form-control" />
								<?php if ($error_student_no) { ?>
								<div class="text-danger"><?php echo $error_student_no; ?></div>
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-4">
						<button type="submit" form="form-user" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
						</div>
					</div>
				</form>
			</div>	
		</div>	
	</div>
</div>
<?php echo $footer; ?>	
				