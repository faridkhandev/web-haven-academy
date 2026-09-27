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
                <li><a href="<?php echo base_url('webadmin/settings/');?>"> Settings <span class="fa fa-angle-right"></span> </a></li>
                <li><a href="<?php echo base_url('webadmin/settings/');?>"> General</a> </li>
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
                      <h4><i class="fa fa-reorder"></i> General Settings  </h4>
                      <div class="tools"> 
                      <a href="javascript:;" class="collapse"></a>  
                      <a href="javascript:;" class="remove"></a> </div>
                    </div>
                    <div class="portlet-body form"> 
                      <!-- BEGIN FORM--> 
                      <?php
					  echo"<pre>";
					//$jedata=json_encode($sitemeta);
					// $jddata=json_decode($jedata);
				//	print_r($sitemeta);
 echo"</pre>";
                   //  echo  $sitemeta->facebook_url;
					  
				
					 ?>

                       <?php echo form_open_multipart('','class=horizontal-form'); ?> 
					   <?php echo $this->session->flashdata('site_setting_msg'); ?>
                       <?php
                       echo form_error('site_name', '<div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>');
					
					 echo form_error('site_slogan', '<div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>');
					
					 echo form_error('site_url', '<div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>');
					
					   ?>
                      
                      <h3 class="form-section">Site Details</h3>
                      <div class="row-fluid">
                        <div class="span6 ">
                          <div class="control-group">
                            <label class="control-label" for="firstName">Site Title</label>
                            <div class="controls">
                              <input type="text"  class="m-wrap span12" name="site_name" value="<?php echo set_value('site_name', $site_name); ?>">
                            </div>
                          </div>
                        </div>
                        <!--/span-->
                        <div class="span6 ">
                          <div class="control-group ">
                            <label class="control-label" for="lastName">Site Slogan</label>
                            <div class="controls">
                              <input type="text"  class="m-wrap span12" name="site_slogan" value="<?php echo set_value('site_slogan', $site_slogan); ?>">
                            </div>
                          </div>
                        </div>
                        <!--/span--> 
                      </div>
                      <!--/row-->
                      <div class="row-fluid">
                        <div class="span6 ">
                          <div class="control-group">
                            <label class="control-label" >Site Address (URL)</label>
                            <div class="controls">
                              <input type="text"  class="m-wrap span12" name="site_url" value="<?php echo set_value('site_url', $site_url); ?>" >
                            </div>
                          </div>
                        </div>
                        <!--/span-->
                        <div class="span6 ">
                          <div class="control-group">
                                    <label class="control-label">Website Status</label>
                                    <div class="controls">
                                        <?php
                                         $options = array('1'=> 'Online','2'=> 'Offline','3'=>'Maintenance Mode');
                                          echo form_dropdown('site_status', $options, $site_status, 'class="m m-wrap span12" id=""');
                                       ?>
                                    </div>
                                 </div>
                        </div>
                        <!--/span--> 
                      </div>
                    
                      <!--/row-->
                      <div class="form-actions">
                        <button type="submit" class="btn green pull-right" name="site_details" value="Update"><i class="fa fa-ok"></i> Update</button>
                       
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
          <!-- Contact Details-->
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PORTLET-->   
                  <div class="portlet box grey">
                     <div class="portlet-title">
                        <h4><i class="fa fa-reorder"></i>Contact Details</h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                         <?php echo form_open_multipart('','class=horizontal-form'); ?> 
					  <?php
                       echo form_error('admin_email', '<div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>');
					   echo form_error('contact_number', '<div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>');
						 
					    echo form_error('skype_id', '<div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); 
					   
					  ?>	 
				      <?php echo $this->session->flashdata('contact_meta_msg'); ?>
                      <div class="row-fluid">
                       
                        <div class="span6 ">
                          <div class="control-group">
                              <label class="control-label">Admin Email </label>
                              <div class="controls">
                                 <div class="input-icon left">
                                    <i class="fa fa-envelope"></i>
                                     <input type="text"  class="m-wrap span12" name="admin_email" value="<?php echo set_value('admin_email', $admin_email); ?>" >
                                 </div>
                              </div>
                           </div>
                        </div>
                      
                      
                        <div class="span6 ">
                          <div class="control-group">
                              <label class="control-label">Contact Number </label>
                              <div class="controls">
                                 <div class="input-icon left">
                                    <i class="fa fa-phone"></i>
                              <input type="text"  class="m-wrap span12" name="contact_number" value="<?php echo set_value('contact_number', $contact_number); ?>" >
                                   </div>
                              </div>
                           </div>
                        </div>
                      
                      
                      </div>
                      
                      <div class="row-fluid">
                       
                        <div class="span6 ">
                          <div class="control-group ">
                            <label class="control-label" for="lastName">Skype ID</label>
                            <div class="controls">
                                  <input type="text"  class="m-wrap span12" name="skype_id" value="<?php echo set_value('skype_id', $skype_id); ?>" >
                               
                            </div>
                          </div>
                        </div>
                      
                      
                        <div class="span6 ">
                          <div class="control-group ">
                            <label class="control-label" for="lastName">Address</label>
                            <div class="controls">
                                    <input type="text"  class="m-wrap span12" name="office_address" value="<?php echo set_value('office_address', $office_address); ?>" >
                               
                            </div>
                          </div>
                        </div>
                      
                      
                      </div>
                      <div class="form-actions">
                        <button type="submit" class="btn green pull-right" name="contact_meta" value="Update"><i class="fa fa-ok"></i> Update</button>
                       
                      </div>
                      <?php
                                echo form_close();
                     ?>
                       
                     </div>
                  </div>
                  <!-- END PORTLET-->
               </div>
            </div>
            <!-- Contact Details-->
          <!--Logo -->
           <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PORTLET-->   
                  <div class="portlet box red">
                     <div class="portlet-title">
                        <h4><i class="fa fa-reorder"></i>Upload Logo</h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                          <?php echo form_open_multipart('','class=horizontal-form'); ?> <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?> <?php echo $this->session->flashdata('site_logo_msg'); ?>
                           
                           <div class="row-fluid">
                        <div class="span6 ">
                          <div class="control-group">
                            <label class="control-label">Update Logo:[ 300 x 80 ]</label>
                            <input type="hidden"  name="old_img"   value="<?php echo $site_logo; ?>"  />
                            <div class="controls">
                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                  <?php
                                                 $site_logo=$site_logo;
                                                 if(empty($site_logo)){
                                                     $site_logo='site_logo.png';
                                                 }
                                               ?>
                                  <img src="<?php echo base_url(); ?>uploads/<?php echo $site_logo; ?>" alt="Site Logo" /> </div>
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
                       <div class="form-actions">
                        <button type="submit" class="btn green pull-right" name="site_logo_meta" value="Update"><i class="fa fa-ok"></i> Update</button>
                       
                      </div>
                      <?php
                                echo form_close();
                               ?>
                        <!-- END FORM-->  
                     </div>
                  </div>
                  <!-- END PORTLET-->
               </div>
            </div>
            <!--Logo -->
            
        </div>
        <!-- END PAGE CONTAINER-->
        
<style>
.form-actions {
    padding: 0px;
}
.btn blue pull-right
</style> 
