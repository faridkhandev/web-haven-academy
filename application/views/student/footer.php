            </div>
            <!-- // END header-layout -->
        </div>
        <!-- // END drawer-layout__content -->

        <?php
            $seg2 = $this->uri->segment(2);
            function is_active($val, $seg){
                return ($val === $seg) ? 'active' : '';
            }
        ?>

        <!-- ================= SIDEBAR ================= -->
        <div class="mdk-drawer js-mdk-drawer" id="default-drawer" data-align="start">
            <div class="mdk-drawer__content">
                <div class="sidebar sidebar-dark sidebar-left kos-sidebar" data-perfect-scrollbar>

                    <!-- ===== Sidebar Styles ===== -->
                    <style>
                        .kos-sidebar{
                            background:#0b1220 !important;
                            border-right:3px solid #1154b4;
                            display:flex;
                            flex-direction:column;
                        }

                        /* Brand */
                        .kos-brand{
                            padding:18px 18px 14px;
                            border-bottom:1px solid rgba(255,255,255,.12);
                        }
                        .kos-brand a{
                            text-decoration:none;
                            color:#fff;
                        }
                        .kos-brand .title{
                            font-size:20px;
                            font-weight:800;
                            letter-spacing:.4px;
                        }
                        .kos-brand .subtitle{
                            font-size:12px;
                            color:#cfe0ff;
                        }

                        /* Menu */
                        .sidebar-menu{
                            padding:16px 12px;
                        }
                        .sidebar-menu-item{
                            margin-bottom:10px;
                        }

                        .sidebar-menu-button{
                            display:block;
                            padding:12px 16px;
                            border-radius:14px;
                            border:1px solid rgba(255,255,255,.12);
                            background:rgba(255,255,255,.03);
                            transition:all .25s ease;
                        }

                        .sidebar-menu-text{
                            font-size:14px;
                            font-weight:700;
                            letter-spacing:.3px;
                            color:#eef3ff;
                        }

                        /* Hover */
                        .sidebar-menu-button:hover{
                            background:rgba(17,84,180,.15);
                            border-color:rgba(17,84,180,.55);
                            transform: translateX(3px);
                        }

                        /* Active */
                        .sidebar-menu-item.active .sidebar-menu-button{
                            background:#1154b4;
                            border-color:#1154b4;
                            box-shadow:0 10px 18px rgba(17,84,180,.35);
                        }
                        .sidebar-menu-item.active .sidebar-menu-text{
                            color:#fff;
                        }

                        /* Green highlight (money actions) */
                        .sidebar-menu-item.green .sidebar-menu-button{
                            background:rgba(49,141,93,.14);
                            border-color:rgba(49,141,93,.45);
                        }
                        .sidebar-menu-item.green .sidebar-menu-button:hover{
                            background:rgba(49,141,93,.20);
                            border-color:rgba(49,141,93,.65);
                        }
                        .sidebar-menu-item.green.active .sidebar-menu-button{
                            background:#318d5d;
                            border-color:#318d5d;
                        }

                        /* Footer */
                        .kos-footer{
                            margin-top:auto;
                            padding:14px 18px;
                            font-size:12px;
                            color:#cfe0ff;
                            border-top:1px solid rgba(255,255,255,.12);
                        }
                    </style>

                    <!-- Brand -->
                    <div class="kos-brand">
                        <a href="<?php echo base_url('student/dashboard');?>">
                            <div class="title">Web Haven Media</div>
                            <div class="subtitle">Student Portal</div>
                        </a>
                    </div>

                    <!-- Menu -->
                    <ul class="sidebar-menu">

                        <li class="sidebar-menu-item <?php echo is_active('welcome',$seg2); ?>">
                            <a class="sidebar-menu-button" href="<?php echo base_url('student/welcome');?>">
                                <span class="sidebar-menu-text">Welcome</span>
                            </a>
                        </li>

                        <li class="sidebar-menu-item <?php echo is_active('dashboard',$seg2); ?>">
                            <a class="sidebar-menu-button" href="<?php echo base_url('student/dashboard');?>">
                                <span class="sidebar-menu-text">My Profile</span>
                            </a>
                        </li>

                        <li class="sidebar-menu-item <?php echo is_active('refer',$seg2); ?>">
                            <a class="sidebar-menu-button" href="<?php echo base_url('student/refer');?>">
                                <span class="sidebar-menu-text">My Refer</span>
                            </a>
                        </li>

                        <?php if($this->session->userdata('student_status')==1){ ?>

                        <li class="sidebar-menu-item <?php echo is_active('course',$seg2); ?>">
                            <a class="sidebar-menu-button" href="<?php echo base_url('student/course');?>">
                                <span class="sidebar-menu-text">Courses</span>
                            </a>
                        </li>

                        <li class="sidebar-menu-item green <?php echo is_active('withdrawal',$seg2); ?>">
                            <a class="sidebar-menu-button" href="<?php echo base_url('student/withdrawal');?>">
                                <span class="sidebar-menu-text">My Withdrawal</span>
                            </a>
                        </li>
						
						<li class="sidebar-menu-item <?php echo is_active('joinpoint',$seg2); ?>">
							<a class="sidebar-menu-button" href="<?php echo base_url('student/joinpoint');?>">
								<span class="sidebar-menu-text">Joining Point</span>
							</a>
						</li>
						<?php /* ?>
						<li class="sidebar-menu-item <?php echo is_active('sellpoint',$seg2); ?>">
							<a class="sidebar-menu-button" href="<?php echo base_url('student/sellpoint');?>">
								<span class="sidebar-menu-text">Sell Point</span>
							</a>
						</li>
						
						<li class="sidebar-menu-item <?php echo is_active('sellpointlist',$seg2); ?>">
							<a class="sidebar-menu-button" href="<?php echo base_url('student/sellpointlist');?>">
								<span class="sidebar-menu-text">Sell Point List</span>
							</a>
						</li>
						<?php */ ?>
                        <li class="sidebar-menu-item green <?php echo is_active('payment',$seg2); ?>">
                            <a class="sidebar-menu-button" href="<?php echo base_url('student/payment');?>">
                                <span class="sidebar-menu-text">My Payment</span>
                            </a>
                        </li>
							
						<li class="sidebar-menu-item green <?php echo is_active('passbook',$seg2); ?>">
                            <a class="sidebar-menu-button" href="<?php echo base_url('student/passbook');?>">
                                <span class="sidebar-menu-text">My Passbook</span>
                            </a>
                        </li>	
						
						<li class="sidebar-menu-item <?php echo is_active('medium',$seg2); ?>">
							<a class="sidebar-menu-button" href="<?php echo base_url('student/medium');?>">
								<span class="sidebar-menu-text">Withdrawal Medium</span>
							</a>
						</li>
                        <?php } ?>

                        <li class="sidebar-menu-item <?php echo is_active('profile',$seg2); ?>">
                            <a class="sidebar-menu-button" href="<?php echo base_url('student/profile');?>">
                                <span class="sidebar-menu-text">Edit Account</span>
                            </a>
                        </li>
						
						<li class="sidebar-menu-item">
							<a class="sidebar-menu-button" href="<?php echo base_url('termsconditions');?>">
								<span class="sidebar-menu-text">Terms & Condition</span>
							</a>
						</li>

                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?php echo base_url('student/logout');?>">
                                <span class="sidebar-menu-text">Logout</span>
                            </a>
                        </li>

                    </ul>

                    <div class="kos-footer">
                        © <?php echo date('Y'); ?> Web Haven Media
                    </div>

                </div>
            </div>
        </div>
        <!-- ================= END SIDEBAR ================= -->

    </div>
    <!-- // END drawer-layout -->

    <!-- DOM Factory -->
    <script src="<?php echo base_url(); ?>studentassets/vendor/dom-factory.js"></script>
    <!-- MDK -->
    <script src="<?php echo base_url(); ?>studentassets/vendor/material-design-kit.js"></script>
    <!-- App -->
    <script src="<?php echo base_url(); ?>studentassets/js/app.js"></script>

    <!-- Datepicker -->
    <script>
        $(function(){
            $(".flatpickrStart").datepicker({
                dateFormat:'yy-mm-dd',
                changeMonth:true,
                changeYear:true,
                onSelect:function(d){
                    $(".flatpickrEnd").datepicker("option","minDate",d);
                }
            });
            $(".flatpickrEnd").datepicker({
                dateFormat:'yy-mm-dd',
                changeMonth:true,
                changeYear:true,
                onSelect:function(d){
                    $(".flatpickrStart").datepicker("option","maxDate",d);
                }
            });
        });
    </script>

</body>
</html>
