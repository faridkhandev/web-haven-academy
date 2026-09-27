<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
     <!-- BEGIN STYLE CUSTOMIZER --> 
      <!-- END BEGIN STYLE CUSTOMIZER -->
      <h3 class="page-title"> Manage Team </h3>
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php  echo base_url("webadmin/dashboard"); ?>">Home</a> <span class="fa fa-angle-right"></span> </li>
        <li> <a href="#">Manage Team</a> <span class="fa fa-angle-right"></span> </li>
        <li><a href="#"><?php echo empty($team->id) ? 'Add New Team' : 'Edit Team : : ' . $team->title; ?></a></li>
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
              <h4><i class="fa fa-reorder"></i> <?php echo empty($team->id) ? 'Add New Team' : 'Edit Team : : ' . $team->name; ?></h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM--> 
              <?php echo form_open_multipart('','class=horizontal-form'); ?>
              <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?>
              <h3 class="form-section">Team</h3>

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
						<label class="control-label" for="Team Name">Member Name</label>
						<div class="controls">
						  <input type="text" class="m-wrap span12" name="name" value="<?php echo set_value('name', $team->name); ?>">
						</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
						<label class="control-label" for="Team Designation">Member Designation</label>
						<div class="controls">
						  <input type="text" class="m-wrap span12" name="designation" value="<?php echo set_value('designation', $team->designation); ?>">
						</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">		
					<div class="span6 ">
                  <div class="control-group">
                    <label class="control-label">Image Upload</label>
                    <div class="controls">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                          <input type="hidden" name="old_img" value="<?php echo $team->image; ?>"/>
							<?php
								$cat_img=$team->image;
								if(empty($cat_img))
								{
									$cat_img='no-image.png';
								}
							?>
							<img src="<?php echo base_url(); ?>/uploads/<?php echo $cat_img; ?>"    />
							</div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                        <div> <span class="btn btn-file"><span class="fileupload-new">Select image</span> <span class="fileupload-exists">Change</span>
                          <input type="file" name="userfile" class="default" />
                          </span> <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a> </div>
                      </div>
                    </div>
                  </div>
                </div>
				
				<div class="span6">
					<div class="control-group">
					<label class="control-label" for="Team Facebook">Member FB Url</label>
					<div class="controls">
					  <input type="text" class="m-wrap span12" name="facebook_url" value="<?php echo set_value('facebook_url', $team->facebook_url); ?>">
					</div>
					</div>
				</div>
				
				<div class="span6">
					<div class="control-group">
					<label class="control-label" for="Team Twitter">Member Twitter Url</label>
					<div class="controls">
					  <input type="text" class="m-wrap span12" name="twitter_url" value="<?php echo set_value('twitter_url', $team->twitter_url); ?>">
					</div>
					</div>
				</div>
				
				<div class="span6">
					<div class="control-group">
					<label class="control-label" for="Team Linkedin">Member Linkedin Url</label>
					<div class="controls">
					  <input type="text" class="m-wrap span12" name="linkedin_url" value="<?php echo set_value('linkedin_url', $team->linkedin_url); ?>">
					</div>
					</div>
				</div>
				
				<div class="span12">
					<div class="control-group">
					<label class="control-label" for="Team Googleplus">Member Googleplus Url</label>
					<div class="controls">
					  <input type="text" class="m-wrap span12" name="googleplus_url" value="<?php echo set_value('googleplus_url', $team->googleplus_url); ?>">
					</div>
					</div>
				</div>
					
				</div>

              <div class="row-fluid">
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label">Status</label>
                    <div class="controls">
                      <?php
						$options = array('1'=> 'Yes', '0'=> 'No');
						echo form_dropdown('status', $options, $team->status, 'class="m m-wrap span12" id=""');
						?>
                    </div>
                  </div>
                </div>

                <div class="span6">
                  <div class="control-group">
                    <label class="control-label" >Display Order</label>
                    <?php echo form_input('display_order', set_value('display_order', $team->display_order) ,'class="m-wrap span12"'); ?> </div>
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