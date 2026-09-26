        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        
        <div id="portlet-config" class="modal hide">
          <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
            <h3>portlet Settings</h3>
          </div>
          <div class="modal-body">
            <p>Here will be a configuration form</p>
          </div>
        </div>
        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM--> 
        <!-- BEGIN PAGE CONTAINER-->
        <div class="container-fluid"> 
          <!-- BEGIN PAGE HEADER-->
          <div class="row-fluid">
            <div class="span12"> 
              <!-- BEGIN STYLE CUSTOMIZER --> 
              
              <!-- END BEGIN STYLE CUSTOMIZER -->
              <h3 class="page-title"> User  Profile </h3>
              <ul class="breadcrumb">
                <li> <i class="fa fa-home"></i> <a href="<?php echo base_url();?>webadmin/dashboard">Home</a> <span class="fa fa-angle-right"></span> </li>
                <li> User Profile <span class="fa fa-angle-right"></span> </li>
                <li>Profile:: <?php echo  $result->first_name.'&nbsp;'. $result->last_name;?></li>
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
                      <h4><i class="fa fa-reorder"></i> Profile :: <?php echo  $result->first_name.'&nbsp;'. $result->last_name;?> </h4>
                      <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="javascript:;" class="remove"></a> </div>
                    </div>
                    <div class="portlet-body form"> 
                      <!-- BEGIN FORM--> 
                      <?php echo form_open_multipart('','class=horizontal-form'); ?> <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?> <?php echo $this->session->flashdata('msg'); ?>
                      <input type="hidden" name="profile_id" value="<?php echo set_value('profile_id', $result->id);?>" />
                      <h3 class="form-section">Personal Info</h3>
                      <div class="row-fluid">
                        <div class="span6 ">
                          <div class="control-group">
                            <label class="control-label" for="firstName">First Name</label>
                            <div class="controls">
                              <input type="text"  class="m-wrap span12" name="first_name" value="<?php echo set_value('first_name', $result->first_name); ?>">
                            </div>
                          </div>
                        </div>
                        <!--/span-->
                        <div class="span6 ">
                          <div class="control-group ">
                            <label class="control-label" for="lastName">Last Name</label>
                            <div class="controls">
                              <input type="text"  class="m-wrap span12" name="last_name" value="<?php echo set_value('last_name', $result->last_name); ?>">
                            </div>
                          </div>
                        </div>
                        <!--/span--> 
                      </div>
                      <!--/row-->
                      <div class="row-fluid">
                        <div class="span6 ">
                          <div class="control-group">
                            <label class="control-label" >Username</label>
                            <div class="controls">
                              <input type="text"  readonly="readonly" class="m-wrap span12" name="user_name" value="<?php echo set_value('user_name', $result->user_name); ?>" >
                            </div>
                          </div>
                        </div>
                        <!--/span-->
                        <div class="span6 ">
                          <div class="control-group">
                            <label class="control-label" >Email</label>
                            <div class="controls">
                              <input type="text"  class="m-wrap span12" name="email_address" value="<?php echo set_value('email_address', $result->email_address); ?>" autocomplete="off">
                            </div>
                          </div>
                        </div>
                        <!--/span--> 
                      </div>
                      <!--/row-->
                      
                      <div class="row-fluid">
                        <div class="span6 ">
                          <div class="control-group">
                            <label class="control-label">Update Profile Photo:[300 X 300]</label>
                            <input type="hidden"  name="old_img"   value="<?php echo $result->photo; ?>"  />
                            <div class="controls">
                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                  <?php
                                                 $user_img=$result->photo;
                                                 if(empty($user_img)){
                                                     $user_img='user.png';
                                                 }
                                               ?>
                                  <img src="<?php echo  base_url('uploads') ?>/<?php echo $user_img; ?>" alt="" /> </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div> <span class="btn btn-file"><span class="fileupload-new">Select image</span> <span class="fileupload-exists">Change</span>
                                  <input type="file" name="userfile" class="default" />
                                  </span> <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/span-->
                        <div class="span6 "> </div>
                        <!--/span--> 
                      </div>
                      <!--/row-->
                      
                      <div class="form-actions">
                        <button type="submit" class="btn blue"><i class="fa fa-ok"></i> Save</button>
                        <button type="button" class="btn">Cancel</button>
                      </div>
                      <?php
                                echo form_close();
                               ?>
                      <!-- END FORM--> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END PAGE CONTENT--> 
        </div>
        <!-- END PAGE CONTAINER--> 
