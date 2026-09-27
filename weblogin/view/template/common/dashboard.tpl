<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">  
	<div class="container-fluid" style="padding-top: 20px;">
		
		<!-- Role based dashboard cards -->
		<div class="row">
			<div class="col-xs-12">
				<h3 style="margin-top:0; margin-bottom:15px;"><?php echo isset($dashboard_title) ? $dashboard_title : 'Dashboard'; ?></h3>
			</div>
			<?php foreach ($dashboard_cards as $card) { ?>
			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="panel panel-<?php echo $card['class']; ?>" style="border-radius:4px; box-shadow:0 1px 3px rgba(0,0,0,0.1);">
					<div class="panel-heading" style="padding:15px;">
						<div class="row">
							<div class="col-xs-3"><i class="fa <?php echo $card['icon']; ?> fa-4x" style="color:rgba(255,255,255,0.8);"></i></div>
							<div class="col-xs-9 text-right">
								<div style="font-size:28px;font-weight:bold;color:#fff;"><?php echo (int)$card['value']; ?></div>
								<div style="color:#ecf0f1;font-size:13px;"><?php echo $card['label']; ?></div>
							</div>
						</div>
					</div>
					<a href="<?php echo $card['link']; ?>" style="color:#333;">
						<div class="panel-footer" style="background:#fff;font-weight:500;">
							<span class="pull-left"><?php echo $card['footer']; ?></span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<?php } ?>
		</div>

		<!-- পূর্বের কন্টেন্ট -->
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<?php if(isset($group_id) && $group_id>10 && $group_id<17){?>
					<div class="col-lg-3 col-md-3 col-sm-6"><?php echo $subadmin; ?></div>
					<?php } ?>
					<?php if(isset($group_id) && $group_id==17){?>
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
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $footer; ?>