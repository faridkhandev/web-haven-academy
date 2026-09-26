<div class="content mCustomScrollbar">
<ul class="nav" id="main-nav">
	<li class="nav-item" id="dashboard">
		<a class="nav-link" href="<?php echo $home ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-home"></i>Dashboard</span>
		</a>
	</li>
	<?php if($group_id==0 || $group_id==1){?>
	<li class="nav-item" id="order">
		<a class="nav-link" data-toggle="collapse" href="#itemorder" aria-expanded="false" aria-controls="seo">
			<span class="menu-title"><i class="fa fa-user-md"></i>Student</span>
			<i class="fas fa-plus sm-right"></i>
		</a>
		<div class="collapse" id="itemorder">
			<ul class="nav flex-column sub-menu">
				<li class="nav-item"> <a class="nav-link" href="<?php echo $student ?>"><i class="fa fa-caret-right"></i>Active Student List</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $instudent ?>"><i class="fa fa-caret-right"></i>Inactive Student List</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $swithdrawal ?>"><i class="fa fa-caret-right"></i>Withdrawal Request</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $spayment ?>"><i class="fa fa-caret-right"></i>Payment History</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $project ?>"><i class="fa fa-caret-right"></i>Project Work</a></li>
			</ul>
		</div>
	</li>
	
	<li class="nav-item" id="courses">
		<a class="nav-link" data-toggle="collapse" href="#course" aria-expanded="false" aria-controls="seo">
			<span class="menu-title"><i class="fa fa-map-marker"></i>Course</span>
			<i class="fas fa-plus sm-right"></i>
		</a>
		<div class="collapse" id="course">
			<ul class="nav flex-column sub-menu">
				<li class="nav-item"> <a class="nav-link" href="<?php echo $course ?>"><i class="fa fa-caret-right"></i>Course List</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $session; ?>"><i class="fa fa-caret-right"></i>Classes/Session</a></li>
			</ul>
		</div>
	</li>
	<?php } ?>
	<?php if($group_id==11){?>
	<li class="nav-item" id="trainerstd">
		<a class="nav-link" href="<?php echo $mystudent ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>My Student</span>
		</a>
	</li>
	<li class="nav-item" id="trainerreport">
		<a class="nav-link" href="<?php echo $student_report ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Monthly Student Report</span>
		</a>
	</li>
	<li class="nav-item" id="trainerpassbook">
		<a class="nav-link" href="<?php echo $passbook ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Passbook</span>
		</a>
	</li>
	
	<li class="nav-item" id="trainerwithdrawal">
		<a class="nav-link" href="<?php echo $withdrawal ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Withdrawal Request</span>
		</a>
	</li>
	
	<li class="nav-item" id="trainerpayment">
		<a class="nav-link" href="<?php echo $payment ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-money"></i>Payment History</span>
		</a>
	</li>
	<?php } ?>
	<?php if($group_id==12){?>
	<li class="nav-item" id="trainerstd">
		<a class="nav-link" href="<?php echo $mystudent ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>My Student</span>
		</a>
	</li>
	<li class="nav-item" id="trainerstd">
		<a class="nav-link" href="<?php echo $mytrainer ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>My Trainer</span>
		</a>
	</li>
	<li class="nav-item" id="trainerreport">
		<a class="nav-link" href="<?php echo $student_report ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Monthly Student Report</span>
		</a>
	</li>
	<li class="nav-item" id="trainerpassbook">
		<a class="nav-link" href="<?php echo $passbook ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Passbook</span>
		</a>
	</li>
	
	<li class="nav-item" id="trainerwithdrawal">
		<a class="nav-link" href="<?php echo $withdrawal ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Withdrawal Request</span>
		</a>
	</li>
	
	<li class="nav-item" id="trainerpayment">
		<a class="nav-link" href="<?php echo $payment ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-money"></i>Payment History</span>
		</a>
	</li>
	<?php } ?>
	<?php if($group_id==13){?>
	<li class="nav-item" id="trainerstd">
		<a class="nav-link" href="<?php echo $mystudent ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>My Student</span>
		</a>
	</li>
	<li class="nav-item" id="trainermy">
		<a class="nav-link" href="<?php echo $mytrainer ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>My Trainer</span>
		</a>
	</li>
	<li class="nav-item" id="trainerleader">
		<a class="nav-link" href="<?php echo $myleader ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>My Leader</span>
		</a>
	</li>
	<li class="nav-item" id="trainerreport">
		<a class="nav-link" href="<?php echo $student_report ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Monthly Student Report</span>
		</a>
	</li>
	<li class="nav-item" id="trainerpassbook">
		<a class="nav-link" href="<?php echo $passbook ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Passbook</span>
		</a>
	</li>
	
	<li class="nav-item" id="trainerwithdrawal">
		<a class="nav-link" href="<?php echo $withdrawal ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Withdrawal Request</span>
		</a>
	</li>
	
	<li class="nav-item" id="trainerpayment">
		<a class="nav-link" href="<?php echo $payment ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-money"></i>Payment History</span>
		</a>
	</li>
	<?php } ?>
	<?php if($group_id==14){?>
	<li class="nav-item" id="teacherstd">
		<a class="nav-link" href="<?php echo $mystudent ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>My Student</span>
		</a>
	</li>
	<li class="nav-item" id="teacherPassbook">
		<a class="nav-link" href="<?php echo $passbook ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Passbook</span>
		</a>
	</li>
	
	<li class="nav-item" id="teacherwithdrawal">
		<a class="nav-link" href="<?php echo $withdrawal ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Withdrawal Request</span>
		</a>
	</li>
	
	<li class="nav-item" id="teacherpayment">
		<a class="nav-link" href="<?php echo $payment ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-money"></i>Payment History</span>
		</a>
	</li>
	<?php } ?>
	<?php if($group_id==15){?>
	<li class="nav-item" id="counsellorstd">
		<a class="nav-link" href="<?php echo $mystudent ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>My Student</span>
		</a>
	</li>
	<li class="nav-item" id="counsellorPassbook">
		<a class="nav-link" href="<?php echo $passbook ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Passbook</span>
		</a>
	</li>
	
	<li class="nav-item" id="counsellorwithdrawal">
		<a class="nav-link" href="<?php echo $withdrawal ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Withdrawal Request</span>
		</a>
	</li>
	
	<li class="nav-item" id="counsellorpayment">
		<a class="nav-link" href="<?php echo $payment ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-money"></i>Payment History</span>
		</a>
	</li>
	<?php } ?>
	
	<?php if($group_id==0 || $group_id==1){?>
	
	<li class="nav-item" id="user">
		<a class="nav-link" data-toggle="collapse" href="#itemuser" aria-expanded="false" aria-controls="seo">
			<span class="menu-title"><i class="fa fa-user"></i>Company/Super Admin</span>
			<i class="fas fa-plus sm-right"></i>
		</a>
		<div class="collapse" id="itemuser">
			<ul class="nav flex-column sub-menu">
				<li class="nav-item"> <a class="nav-link" href="<?php echo $superuser ?>"><i class="fa fa-user"></i><?php echo $text_user; ?></a></li>
				
	
				<li class="nav-item" id="groups"> <a class="nav-link" href="<?php echo $user_group ?>"><span class="menu-title"><i class="fa fa-user"></i><?php echo $text_user_groups; ?></span></a></li>
			</ul>
		</div>
	</li>
	
	<li class="nav-item" id="subuser">
		<a class="nav-link" data-toggle="collapse" href="#itemsubuser" aria-expanded="false" aria-controls="seo">
			<span class="menu-title"><i class="fa fa-user"></i>Sub Admin</span>
			<i class="fas fa-plus sm-right"></i>
		</a>
		<div class="collapse" id="itemsubuser">
			<ul class="nav flex-column sub-menu">
				<li class="nav-item"> <a class="nav-link" href="<?php echo $trainer ?>"><i class="fa fa-user"></i>Trainer</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $team_leader ?>"><i class="fa fa-user"></i>Team Leader</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $senior_team_leader ?>"><i class="fa fa-user"></i>Senior Team Leader</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $teacher ?>"><i class="fa fa-user"></i>Teacher</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $counsellor ?>"><i class="fa fa-user"></i>Counsellor</a></li>
			</ul>
		</div>
	</li>
	
	<li class="nav-item" id="reports">
		<a class="nav-link" data-toggle="collapse" href="#report" aria-expanded="false" aria-controls="seo">
			<span class="menu-title"><i class="fa fa-flag"></i>Reports</span>
			<i class="fas fa-plus sm-right"></i>
		</a>
		<div class="collapse" id="report">
			<ul class="nav flex-column sub-menu">
				<li class="nav-item"> <a class="nav-link" href="<?php echo $student_refer ?>"><span class="menu-title"><i class="fa fa-bar-chart"></i>Student Refer Report</span></a></li>
			</ul>
		</div>
	</li>
	
	<li class="nav-item" id="setting">
		<a class="nav-link" href="<?php echo $setting ?>">
			<span class="menu-title"><i class="fa fa-cog"></i>Settings</span>
		</a>
	</li>
	<?php } ?>
</ul>
</div>