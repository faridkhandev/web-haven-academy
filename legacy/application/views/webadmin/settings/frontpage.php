
        <!-- BEGIN PAGE CONTAINER-->
        <div class="container-fluid"> 
          <!-- BEGIN PAGE HEADER-->
          <div class="row-fluid">
            <div class="span12"> 
              <!-- BEGIN STYLE CUSTOMIZER --> 
              
              <!-- END BEGIN STYLE CUSTOMIZER -->
              <h3 class="page-title">Site Settings </h3>
              <ul class="breadcrumb">
                <li><i class="fa fa-home"></i> <a href="<?php echo base_url('webadmin/dashboard');?>">Home</a> <span class="fa fa-angle-right"></span> </li>
                <li><a href="<?php echo base_url('webadmin/settings/');?>"> Settings<span class="fa fa-angle-right"></span> </a></li>
                <li><a href="<?php echo base_url('webadmin/settings/');?>">General</a> </li>
              </ul>
            </div>
          </div>
          <!-- END PAGE HEADER--> 
        
		<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="well">
					<span class="label label-important">NOTE!</span>
					<span>
					<span class="bold">Nestable List Plugin</span> 
					supported in Firefox, Chrome, Opera, 
					Safari, Internet Explorer 10 and Internet Explorer 9 only.
					Internet Explorer 8 not supported.
					</span>
				</div>
				<div class="row-fluid">
                
                    <form action="#" method="post">
					<div class="span12">
						<div class="margin-bottom-10" id="nestable_list_menu">
							<button type="button" class="btn" data-action="expand-all">Expand All</button>
							<button type="button" class="btn" data-action="collapse-all">Collapse All</button>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<h3>Serialised Output (per list)</h3>
						<textarea id="nestable_list_1_output" name="jid" class="m-wrap span12"></textarea>
						<textarea id="nestable_list_2_output" class="m-wrap span12"></textarea>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="portlet box yellow">
							<div class="portlet-title">
								<h4><i class="fa fa-comments"></i>Nestable List 3</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="dd" id="nestable_list_1">
									
                                    
                                    <ol class="dd-list">
					     <?php
						  $allforntmenus=array('Home', 'About Us', 'Team','Services','Blog','Conatct US');                          foreach($allforntmenus as $k=>$val){
									   ?>
                                    	<li class="dd-item dd3-item" data-id="<?php echo $k; ?>">
											<div class="dd-handle dd3-handle"></div>
											<div class="dd3-content"><?php echo $val;?></div>
										</li>
						<?php
                        }
                        ?>
										
									</ol>
								</div>
							</div>
						</div>
                        
                        <input type="submit" name="save" value="Save" />
                        
					</div>
					<div class="span6">
						<div class="portlet box green">
							<div class="portlet-title">
								<h4><i class="fa fa-comments"></i>Nestable List 2</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="dd" id="nestable_list_2">
									<ol class="dd-list">
										<li class="dd-item" data-id="13">
											<div class="dd-handle">Item 13</div>
										</li>
										<li class="dd-item" data-id="14">
											<div class="dd-handle">Item 14</div>
										</li>
										<li class="dd-item" data-id="15">
											<div class="dd-handle">Item 15</div>
											<ol class="dd-list">
												<li class="dd-item" data-id="16">
													<div class="dd-handle">Item 16</div>
												</li>
												<li class="dd-item" data-id="17">
													<div class="dd-handle">Item 17</div>
												</li>
												<li class="dd-item" data-id="18">
													<div class="dd-handle">Item 18</div>
												</li>
											</ol>
										</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
                    </form>
				</div>
				<div class="row-fluid">
					
				</div>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->	
		</div>
		<!-- END PAGE -->	 	
	</div>
          <!-- END PAGE CONTENT-->
          <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/$-nestable/$.nestable.css" />
         
    
<style>
.form-actions {
    padding: 0px;
}
.btn blue pull-right
</style> 
