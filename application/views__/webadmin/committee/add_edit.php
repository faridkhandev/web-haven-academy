<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
     <!-- BEGIN STYLE CUSTOMIZER --> 
      <!-- END BEGIN STYLE CUSTOMIZER -->
      <h3 class="page-title"> Manage Committee </h3>
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php  echo base_url("webadmin/dashboard"); ?>">Home</a> <span class="fa fa-angle-right"></span> </li>
        <li> <a href="#">Manage Committee</a> <span class="fa fa-angle-right"></span> </li>
        <li><a href="#"><?php echo empty($committee->id) ? 'Add New Committee' : 'Edit Committee : : ' . $committee->title; ?></a></li>
      </ul>
    </div>
  </div>

  <!-- END PAGE HEADER--> 

  <!-- BEGIN PAGE CONTENT-->

  <div class="row-fluid">

    <div class="span12">

      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="portlet box blue">
            <div class="portlet-title">
              <h4><i class="fa fa-reorder"></i> <?php echo empty($committee->id) ? 'Add New Committee' : 'Edit Committee : : ' . $committee->name; ?></h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM--> 
              <?php echo form_open_multipart('','class=horizontal-form'); ?>
              <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?>
              <h3 class="form-section">Committee</h3>

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
						<label class="control-label" for="Committee Name">Member Name</label>
						<div class="controls">
						  <input type="text" class="m-wrap span12" name="name" value="<?php echo set_value('name', $committee->name); ?>">
						</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
						<label class="control-label" for="Committee Designation">Member Designation</label>
						<div class="controls">
						  <input type="text" class="m-wrap span12" name="designation" value="<?php echo set_value('designation', $committee->designation); ?>">
						</div>
						</div>
					</div>
				</div>

              <div class="row-fluid">
				

                <div class="span6">
                  <div class="control-group">
                    <label class="control-label" >Phone</label>
                    <?php echo form_input('phone', set_value('phone', $committee->phone) ,'class="m-wrap span12"'); ?> </div>
                </div>
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label">Status</label>
                    <div class="controls">
                      <?php
						$options = array('1'=> 'Yes', '0'=> 'No');
						echo form_dropdown('status', $options, $committee->status, 'class="m m-wrap span12" id=""');
						?>
                    </div>
                  </div>
                </div>
                <!--/span--> 
              </div>
              <div class="form-actions">
                <button type="submit" class="btn blue"><i class="fa fa-ok"></i> Save</button>
                <button type="button" class="btn">Cancel</button>
              </div>
              <?php echo form_close();?>
              <!-- END FORM--> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END PAGE CONTENT--> 
</div>