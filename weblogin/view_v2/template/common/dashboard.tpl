<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">  
	<div class="container-fluid">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12"><p>Welcome to KOS Digital Web Portal</p></div>
				</div>
				<div class="row">
					<?php if($group_id>10){?>
					<div class="col-lg-3 col-md-3 col-sm-6"><?php echo $subadmin; ?></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $footer; ?>