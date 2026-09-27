<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
		<?php include 'view/template/common/message.tpl' ; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h3 class="panel-title"><i class="fa fa-list"></i>Convert From Buy Point To Sell Point</h3>
				</div>
				<div class="pull-right">
					
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="tile">
							<div class="tile-heading">Buy Point in Wallet<div class="pull-right"></div>
							</div>
							<div class="tile-body"><i class="fa fa-adjust"></i>
								<h2 class="pull-right"><?php echo is_null($buy['balance'])?0:$buy['balance'];?></h2>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="tile">
							<div class="tile-heading">Sell Point in Wallet<div class="pull-right"></div>
							</div>
							<div class="tile-body"><i class="fa fa-adjust"></i>
								<h2 class="pull-right" ><?php echo is_null($sell['balance'])?0:$sell['balance'];?></h2>
							</div>
						</div>
					</div>
				</div>
				<form method="post" enctype="multipart/form-data" id="form-pay" style="margin-top:20px;">
					<div class="row">
						<div class="col-sm-5">
							<div class="form-group required">
								<label class="control-label" for="input-buy">How much buy point do you wnat to convert in sell point?</label>
								<br/><br/>
								<input type="text" name="point" class="form-control" id="" required="" />
							</div>
						</div>
						<div class="col-sm-2">
							<button type="button" id="btn-convert" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
	<script>
	$('#btn-convert').click(function(){
		$.ajax({
			url: 'index.php?route=pointbuysell/conversion/point&token=<?php echo $token; ?>',
			type: 'post',
			dataType: 'json',
			data: $("#form-pay").serialize(),
			beforeSend: function() {
				$('#btn-convert').button('loading');
			},
			complete: function() {
				$('#btn-convert').button('reset');
			},
			success: function(json) {
				$('.alert-success, .alert-danger').remove();

				if (json['error']){
					alert(json['error']);
				}

				if (json['success']){
					alert('Point convert successfully');
					location.reload();
				}
			}
		});
	});
	</script>
<?php echo $footer; ?> 
			