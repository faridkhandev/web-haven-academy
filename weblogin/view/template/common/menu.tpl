<div class="content mCustomScrollbar">
<ul class="nav" id="main-nav">
	<li class="nav-item" id="dashboard">
		<a class="nav-link" href="<?php echo $home ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-home"></i><?php if($group_id >10){ ?>Profile<?php } else { ?>Dashboard<?php } ?></span>
		</a>
	</li>

	<	<!-- কুইক স্টুডেন্ট লিস্ট মেনু -->
	<?php if($group_id==0 || $group_id==1){?>
	<li class="nav-item" id="quick_student">
		<a class="nav-link" data-toggle="collapse" href="#itemquickstudent" aria-expanded="false" aria-controls="quick_student">
			<span class="menu-title"><i class="fa fa-bolt text-warning"></i>Quick Student List</span>
			<i class="fas fa-plus sm-right"></i>
		</a>
		<div class="collapse" id="itemquickstudent">
			<ul class="nav flex-column sub-menu">
				<li class="nav-item"> 
					<a class="nav-link" href="index.php?route=student/student/quick_active&token=<?php echo isset($_GET['token']) ? $_GET['token'] : ''; ?>">
						<i class="fa fa-check-circle text-success"></i>Active Student (Quick)
					</a>
				</li>
				<li class="nav-item"> 
					<a class="nav-link" href="index.php?route=student/student/quick_inactive&token=<?php echo isset($_GET['token']) ? $_GET['token'] : ''; ?>">
						<i class="fa fa-times-circle text-danger"></i>Inactive Student (Quick)
					</a>
				</li>
			</ul>
		</div>
	</li>

<?php } ?>
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
				<li class="nav-item"> <a class="nav-link" href="<?php echo $whatsapp ?>"><i class="fa fa-caret-right"></i>Whatsapp Student List</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $seatbooking ?>"><i class="fa fa-caret-right"></i>Seat Booking</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $block ?>"><i class="fa fa-caret-right"></i>Block Student List</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $swithdrawal ?>"><i class="fa fa-caret-right"></i>Withdrawal Request</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $spayment ?>"><i class="fa fa-caret-right"></i>Payment History</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $mappingremove ?>"><i class="fa fa-caret-right"></i>Mapping & Point Remove</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $pointwithdrawal ?>"><i class="fa fa-caret-right"></i>Point Withdrawal</a></li>
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
				<li class="nav-item"> <a class="nav-link" href="<?php echo $sessionstudent; ?>"><i class="fa fa-caret-right"></i>Student Sessions</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $allattendance; ?>"><i class="fa fa-caret-right"></i>All Attendance</a></li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?route=module/teacher_attendance&token=<?php echo isset($_GET['token']) ? $_GET['token'] : ''; ?>">
						<i class="fa fa-caret-right"></i>Teacher Attendance
					</a>
				</li>
			</ul>
		</div>
	</li>
	<?php } ?>
	<?php if($group_id==0 || $group_id==1 || $group_id==13){?>
	<li class="nav-item" id="welcomepage">
		<a class="nav-link" data-toggle="collapse" href="#welcome" aria-expanded="false" aria-controls="seo">
			<span class="menu-title"><i class="fa fa-handshake-o"></i>Welcome Page</span>
			<i class="fas fa-plus sm-right"></i>
		</a>
		<div class="collapse" id="welcome">
			<ul class="nav flex-column sub-menu">
				<li class="nav-item"> <a class="nav-link" href="<?php echo $notification ?>"><i class="fa fa-caret-right"></i>Admin Notification</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $weeklyactivity ?>"><i class="fa fa-caret-right"></i>Weekly Activity</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $helpline; ?>"><i class="fa fa-caret-right"></i>Help line</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $townhall; ?>"><i class="fa fa-caret-right"></i>Town Hall Meeting</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $photo; ?>"><i class="fa fa-caret-right"></i>Photo Zoon</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $motivational; ?>"><i class="fa fa-caret-right"></i>Motivational Speaker</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $weeklybest; ?>"><i class="fa fa-caret-right"></i>Weekly Best Performer</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $dailybest; ?>"><i class="fa fa-caret-right"></i>Daily Best Performer</a></li>
			</ul>
		</div>
	</li>
	<?php } ?>

	<?php if($group_id==11){ ?>
	<li class="nav-item" id="trainerstd">
		<a class="nav-link" href="<?php echo $mystudent ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>My Student</span>
		</a>
	</li>
	<li class="nav-item" id="counsellorrepo">
		<a class="nav-link" href="<?php echo $trainerreport ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-file-pdf-o"></i>My Report</span>
		</a>
	</li>
	<li class="nav-item" id="seatbooking">
		<a class="nav-link" href="<?php echo $tseatbooking ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Seat Booking</span>
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
	<li class="nav-item" id="assignstudent">
		<a class="nav-link" href="<?php echo $assignstudent ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Not Assign Student</span>
		</a>
	</li>
	<li class="nav-item" id="trainerstd">
		<a class="nav-link" href="<?php echo $mystudent ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>My Student</span>
		</a>
	</li>
	<li class="nav-item" id="seatbooking">
		<a class="nav-link" href="<?php echo $tlseatbooking ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Seat Booking</span>
		</a>
	</li>
	<li class="nav-item" id="trainerstd">
		<a class="nav-link" href="<?php echo $mytrainer ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>My Trainer</span>
		</a>
	</li>
	<li class="nav-item" id="counsellorrepo">
		<a class="nav-link" href="<?php echo $teamleaderreport ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-file-pdf-o"></i>My Report</span>
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
	<li class="nav-item" id="stlinactivestudent">
		<a class="nav-link" href="<?php echo $stlinactivestudent ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Inactive Student</span>
		</a>
	</li>
	<li class="nav-item" id="trainerstd">
		<a class="nav-link" href="<?php echo $stlstudent ?>">
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
	<li class="nav-item" id="counsellorrepo">
		<a class="nav-link" href="<?php echo $stlreport ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-file-pdf-o"></i>My Report</span>
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
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Active Student</span>
		</a>
	</li>
	<?php if($user_id == 30){ ?>
	<li class="nav-item" id="teachersfb">
		<a class="nav-link" href="<?php echo $facebook ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-facebook-official"></i>Facebook Student</span>
		</a>
	</li>
	<?php } ?>
	<li class="nav-item" id="courses">
		<a class="nav-link" data-toggle="collapse" href="#course" aria-expanded="false" aria-controls="seo">
			<span class="menu-title"><i class="fa fa-map-marker"></i>Course</span>
			<i class="fas fa-plus sm-right"></i>
		</a>
		<div class="collapse" id="course">
			<ul class="nav flex-column sub-menu">
				<li class="nav-item"> <a class="nav-link" href="<?php echo $course ?>"><i class="fa fa-caret-right"></i>Course List</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $session; ?>"><i class="fa fa-caret-right"></i>Classes/Session</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $sessionstudent; ?>"><i class="fa fa-caret-right"></i>Student Sessions</a></li>
			</ul>
		</div>
	</li>
	<li class="nav-item" id="teacherattendance">
		<a class="nav-link" href="<?php echo $attendance ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Attendance</span>
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
		<a class="nav-link" href="<?php echo $counsellorstudent ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>My Student</span>
		</a>
	</li>
	<li class="nav-item" id="seatbooking">
		<a class="nav-link" href="<?php echo $seatbooking ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>Seat Booking</span>
		</a>
	</li>
	<li class="nav-item" id="counsellorrepo">
		<a class="nav-link" href="<?php echo $counsellorreport ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-file-pdf-o"></i>My Report</span>
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

	<?php if($group_id==16){?>
	
	
	<!-- নতুন যুক্ত করা হলো: কন্ট্রোলারের জন্য Add Meeting Link মেনু -->
	<li class="nav-item" id="addmeetinglink">
		<a class="nav-link" href="<?php echo $addmeeting; ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-video-camera"></i>Add Meeting Link</span>
		</a>
	</li>
	
	<li class="nav-item" id="counsellorstd">
		<a class="nav-link" href="<?php echo $controllerstudent ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-user"></i>My Student</span>
		</a>
	</li>
	<li class="nav-item" id="counsellorrepo">
		<a class="nav-link" href="<?php echo $counsellorreport ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-file-pdf-o"></i>My Report</span>
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

	<?php if($group_id==17){?>
	<li class="nav-item" id="pbswallet">
		<a class="nav-link" href="<?php echo $pointbuysellwallet ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-money"></i>Wallet</span>
		</a>
	</li>
	<li class="nav-item" id="pbsstatus">
		<a class="nav-link" href="<?php echo $statuschange ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-star-o"></i>Status Update</span>
		</a>
	</li>
	<li class="nav-item" id="pbsbuyrequest">
		<a class="nav-link" href="<?php echo $buyrequest ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-telegram"></i>Buy Request</span>
		</a>
	</li>
	<li class="nav-item" id="pbssellpoint">
		<a class="nav-link" href="<?php echo $sellpoint ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-anchor"></i>Sell Point</span>
		</a>
	</li>
	<li class="nav-item" id="pbsconversion">
		<a class="nav-link" href="<?php echo $conversion ?>">
			<span class="menu-title"><i class="fa fa-lg fa-fw fa-money"></i>Point Conversion</span>
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
				<li class="nav-item"> <a class="nav-link" href="<?php echo $controller ?>"><i class="fa fa-user"></i>Controller</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $pointbuysell ?>"><i class="fa fa-user"></i>Point Buy Sell</a></li>
			</ul>
		</div>
	</li>
	
	<li class="nav-item" id="subuserinfo">
		<a class="nav-link" data-toggle="collapse" href="#itemsubuserinfo" aria-expanded="false" aria-controls="seo">
			<span class="menu-title"><i class="fa fa-money"></i>Sub Admin Info</span>
			<i class="fas fa-plus sm-right"></i>
		</a>
		<div class="collapse" id="itemsubuserinfo">
			<ul class="nav flex-column sub-menu">
				<li class="nav-item"> <a class="nav-link" href="<?php echo $user_withdrawal ?>"><i class="fa fa-user"></i>Withdrawal</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $user_payment ?>"><i class="fa fa-user"></i>Payment</a></li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo $allreport ?>"><i class="fa fa-file-pdf-o"></i>Report</a></li>
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
