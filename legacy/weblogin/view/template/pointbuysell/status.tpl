<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i>Status Management</h3>
				</div>
				<div class="pull-right">
					
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-status">
					<div class="row">
						<div class="col-sm-5">
							<div class="form-group required">
								<label class="control-label" for="input-buy">Buy Status</label>
								<select name="buy_status" class="form-control" id="" required="">
									<option value="1" <?php if($info['buy_status']==1) echo 'selected';?>>Yes</option>
									<option value="2" <?php if($info['buy_status']==2) echo 'selected';?>>No</option>
								</select>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="form-group required">
								<label class="control-label" for="input-sell">Sell Status</label>
								<select name="sell_status" class="form-control" id="" required="">
									<option value="1" <?php if($info['sell_status']==1) echo 'selected';?>>Yes</option>
									<option value="2" <?php if($info['sell_status']==2) echo 'selected';?>>No</option>
								</select>
							</div>
						</div>
						<div class="col-sm-2">
							<button type="submit" form="form-status" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
<?php echo $footer; ?> 
			