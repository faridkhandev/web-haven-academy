			</div>
            <!-- // END header-layout -->
        </div>
        <!-- // END drawer-layout__content -->

        <div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
            <div class="mdk-drawer__content">
                <div class="sidebar sidebar-dark sidebar-left bg-dark-gray" data-perfect-scrollbar>

                    <div class="d-flex align-items-center sidebar-p-a sidebar-account flex-shrink-0">
                        <a href="index.html" class="flex d-flex align-items-center text-underline-0">
							<span class="flex d-flex flex-column">
                                <span class="sidebar-brand">KOS Digital</span>
                                <small>Key of success</small>
                            </span>
                        </a>
                    </div>
                    <div class="sidebar-block p-0">
                        <ul class="sidebar-menu mt-0">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo base_url('student/dashboard');?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">star_half</i>
                                    <span class="sidebar-menu-text">My Profile</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo base_url('student/refer');?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">queue_play_next</i>
                                    <span class="sidebar-menu-text">My Refer</span>
                                </a>
                            </li>
							<?php if($this->session->userdata('student_status') == 1){?>
							<li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo base_url('student/course');?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">queue_play_next</i>
                                    <span class="sidebar-menu-text">Courses</span>
                                </a>
                            </li>
							<li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo base_url('student/withdrawal');?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">queue_play_next</i>
                                    <span class="sidebar-menu-text">My Withdrawal</span>
                                </a>
                            </li>
							<li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo base_url('student/payment');?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">queue_play_next</i>
                                    <span class="sidebar-menu-text">My Payment</span>
                                </a>
                            </li>
							<li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo base_url('student/passbook');?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">queue_play_next</i>
                                    <span class="sidebar-menu-text">My Passbook</span>
                                </a>
                            </li>
							<?php } ?>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo base_url('student/profile');?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">settings</i>
                                    <span class="sidebar-menu-text">Edit Account</span>
                                </a>
                            </li>
							<li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo base_url('student/medium');?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">settings</i>
                                    <span class="sidebar-menu-text">Withdrawal Medium</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo base_url('student/logout');?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">exit_to_app</i>
                                    <span class="sidebar-menu-text">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- // END drawer-layout -->

    <!-- DOM Factory -->
    <script src="<?php echo base_url() ;?>studentassets/vendor/dom-factory.js"></script>
    <!-- MDK -->
    <script src="<?php echo base_url() ;?>studentassets/vendor/material-design-kit.js"></script>
	
	<!-- App -->
    <script src="<?php echo base_url() ;?>studentassets/js/app.js"></script>
	<script>
	/* $(".flatpickrStart, .flatpickrEnd").flatpickr({ 
	   dateFormat: "Y-m-d", //change format also 
	   enableTime: false,
	}); */
	$(document).ready(function(){
		$(".flatpickrStart").datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			onSelect: function(selected) {
			  $(".flatpickrEnd").datepicker("option","minDate", selected)
			}
		});
		$(".flatpickrEnd").datepicker({ 
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			onSelect: function(selected) {
			   $(".flatpickrStart").datepicker("option","maxDate", selected)
			}
		});  
	});
	</script>
</body>
</html>