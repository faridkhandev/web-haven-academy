<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-pencil"></i> Upload Doctor CSV File (<a href="<?php echo HTTPS_SERVER.'doctor.csv'; ?>" target="_blank">Download Sample File</a>)</h3>
				</div>
				<div class="pull-right">
					<button type="submit" form="form-type" data-toggle="tooltip" title="Upload" class="btn btn-primary btn-xs"><i class="fa fa-save"></i></button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-type">
					<div class="row">
						<div class="col-md-offset-3 col-sm-6">
							<div class="form-group required">
								<label class="control-label" for="input-file">Upload File</label>
								<input type="file" name="file" id="input-file" class="form-control" accept=".csv" />
								<?php if ($error_file ) { ?>
								<div class="text-danger"><?php echo $error_file; ?></div>
								<?php } ?>
							</div>					
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
//
//--></script>
<?php echo $footer; ?>