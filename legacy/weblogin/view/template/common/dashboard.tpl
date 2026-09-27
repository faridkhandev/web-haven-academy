<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">  
	<div class="container-fluid" style="padding-top: 20px;">
		
		<!-- স্ট্যাটাস উইজেট কার্ডস -->
		<div class="row">
			<!-- আজকের লিড -->
			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="panel panel-primary" style="border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
					<div class="panel-heading" style="background-color: #2980b9; border: none; padding: 15px;">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-user-plus fa-4x" style="color: rgba(255,255,255,0.8);"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div style="font-size: 28px; font-weight: bold; color: #fff;"><?php echo isset($today_leads) ? $today_leads : 0; ?></div>
								<div style="color: #ecf0f1; font-size: 13px;">Today's New Leads</div>
							</div>
						</div>
					</div>
					<a href="<?php echo isset($student_link) ? $student_link : '#'; ?>" style="color: #2980b9;">
						<div class="panel-footer" style="background: #fff; font-weight: 500;">
							<span class="pull-left">View Leads</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>

			<!-- মোট একটিভ আইডি -->
			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="panel panel-success" style="border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
					<div class="panel-heading" style="background-color: #27ae60; border: none; padding: 15px;">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-check-circle fa-4x" style="color: rgba(255,255,255,0.8);"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div style="font-size: 28px; font-weight: bold; color: #fff;"><?php echo isset($active_students) ? $active_students : 0; ?></div>
								<div style="color: #ecf0f1; font-size: 13px;">Active IDs</div>
							</div>
						</div>
					</div>
					<a href="<?php echo isset($student_link) ? $student_link : '#'; ?>" style="color: #27ae60;">
						<div class="panel-footer" style="background: #fff; font-weight: 500;">
							<span class="pull-left">View Active List</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>

			<!-- সর্বমোট স্টুডেন্ট -->
			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="panel panel-info" style="border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
					<div class="panel-heading" style="background-color: #8e44ad; border: none; padding: 15px;">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-users fa-4x" style="color: rgba(255,255,255,0.8);"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div style="font-size: 28px; font-weight: bold; color: #fff;"><?php echo isset($total_students) ? $total_students : 0; ?></div>
								<div style="color: #ecf0f1; font-size: 13px;">Total Students</div>
							</div>
						</div>
					</div>
					<a href="<?php echo isset($student_link) ? $student_link : '#'; ?>" style="color: #8e44ad;">
						<div class="panel-footer" style="background: #fff; font-weight: 500;">
							<span class="pull-left">All Students</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>

			<!-- আজকের শিক্ষক উপস্থিতি -->
			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="panel panel-warning" style="border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
					<div class="panel-heading" style="background-color: #d35400; border: none; padding: 15px;">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-clock-o fa-4x" style="color: rgba(255,255,255,0.8);"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div style="font-size: 28px; font-weight: bold; color: #fff;"><?php echo isset($today_attendance) ? $today_attendance : 0; ?></div>
								<div style="color: #ecf0f1; font-size: 13px;">Today's Classes</div>
							</div>
						</div>
					</div>
					<a href="<?php echo isset($attendance_link) ? $attendance_link : '#'; ?>" style="color: #d35400;">
						<div class="panel-footer" style="background: #fff; font-weight: 500;">
							<span class="pull-left">Attendance Summary</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
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