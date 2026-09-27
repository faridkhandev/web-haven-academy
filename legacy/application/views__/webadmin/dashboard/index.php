            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE CONTAINER-->
            <div class="container-fluid">
                <!-- BEGIN PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">    
                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->           
                        <h3 class="page-title">Welcome to Sanjbati Marriage House</h3>
                        <ul class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="<?php echo base_url();?>webadmin/dashboard">Home</a> 
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>Dashboard</li>
                            <li class="pull-right no-text-shadow">
                                <div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">
                                    <i class="fa fa-calendar"></i>
                                    <span></span>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </li>
                        </ul>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <div id="dashboard">
                    <!-- BEGIN DASHBOARD STATS -->
                    <div class="row-fluid">
                        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-group"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?=$count_facility?>
                                    </div>
                                    <div class="desc">                                  
                                        Total Facilities
                                    </div>
                                </div>
                                <a class="more" href="<?php echo base_url("webadmin/facility");?>">
                                View more <i class="m-fa fa-swapright m-fa fa-white"></i>
                                </a>                        
                            </div>
                        </div>
						<div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">
                            <div class="dashboard-stat purple">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number"><?=$count_service?></div>
                                    <div class="desc">Total Service</div>
                                </div>
                                <a class="more" href="<?php echo base_url("webadmin/service");?>">
                                View more <i class="m-fa fa-swapright m-fa fa-white"></i>
                                </a>                        
                            </div>
                        </div>
						<div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">
                            <div class="dashboard-stat red">
                                <div class="visual">
                                    <i class="fa fa-bar-chart"></i>
                                </div>
                                <div class="details">
                                    <div class="number"><?=$count_testimonial?></div>
                                    <div class="desc">Total Testimonial</div>
                                </div>
                                <a class="more" href="<?php echo base_url("webadmin/testimonial");?>">
                                View more <i class="m-fa fa-swapright m-fa fa-white"></i>
                                </a>                        
                            </div>
                        </div>
                        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">
                            <div class="dashboard-stat green">
                                <div class="visual">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <div class="details">
                                    <div class="number"><?=$count_page?></div>
                                    <div class="desc">Total Pages</div>
                                </div>
                                <a class="more" href="<?php echo base_url("webadmin/page");?>">
                                View more <i class="m-fa fa-swapright m-fa fa-white"></i>
                                </a>                        
                            </div>
                        </div>
						</div>
                        <div class="row-fluid">
                        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">
                            <div class="dashboard-stat yellow">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number"><?=$count_enquery?></div>
                                    <div class="desc">Total Enquery</div>
                                </div>
                                <a class="more" href="<?php echo base_url("webadmin/enquery");?>">
                                View more <i class="m-fa fa-swapright m-fa fa-white"></i>
                                </a>                        
                            </div>
                        </div>
                    </div>
                    <!-- END DASHBOARD STATS -->
                  
                    <div class="clearfix"></div>
                    
                </div>
            </div>
            <!-- END PAGE CONTAINER-->      