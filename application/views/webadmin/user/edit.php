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
                  <h3 class="page-title">
                     Admin User
                    </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="fa fa-home"></i>
                        <a href="index.html">Home</a> 
                        <span class="fa fa-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Mange Admin Users</a>
                        <span class="fa fa-angle-right"></span>
                     </li>
                     <li><a href="#">Add New Admin User</a></li>
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
                        <h4><i class="fa fa-reorder"></i>  <?php echo empty($user->id) ? 'Add New Admin Member' : 'Edit Admin Member : : ' . $user->first_name.'&nbsp;'.$user->last_name;; ?>
 </h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                      <?php echo form_open_multipart('','class=horizontal-form'); ?>
                      <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?>
 
                     
                           <h3 class="form-section">Person Info</h3>
                           <div class="row-fluid">
                              <div class="span6 ">
                                 <div class="control-group">
                                    <label class="control-label" for="firstName">First Name</label>
                                    <div class="controls">
                                      
                                 <input type="text"  class="m-wrap span12" name="first_name" value="<?php echo set_value('first_name', $user->first_name); ?>">
                                     
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="span6 ">
                                 <div class="control-group ">
                                    <label class="control-label" for="lastName">Last Name</label>
                                    <div class="controls">
                                       <input type="text"  class="m-wrap span12" name="last_name" value="<?php echo set_value('last_name', $user->last_name); ?>">
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
                  <input type="text"  class="m-wrap span12" name="user_name" autocomplete="off" value="<?php echo set_value('user_name', $user->user_name); ?>" >

                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="span6 ">
                                 <div class="control-group">
                                    <label class="control-label" >Password</label>
                                    <div class="controls">
          <input type="password"  class="m-wrap span12" name="pass_word" autocomplete="off" value="<?php echo set_value('email_address', $user->pass_word); ?>">
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                           </div>
                           <!--/row-->  
                           <!--/row-->
                          
                           <div class="row-fluid">
                              <div class="span6 ">
                                 <div class="control-group">
                                    <label class="control-label" >Gender</label>
                                    <div class="controls">
                                       <select  class="m-wrap span12">
                                          <option value="">Male</option>
                                          <option value="">Female</option>
                                       </select>
                                       <span class="help-block">Select your gender.</span>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="span6 ">
                               <label class="control-label" >User Role</label>
                               <div class="controls">
                                    <?php
                                  
                                     $result = array();
                                     foreach ($user_roles as $key => $value) {
                                         $alluser_role[$value->id] = $value->user_role;
                                     }
                                 

                                     $options = $alluser_role;
                                       echo form_dropdown('user_role', $options, $user->user_role, 'class="m-wrap span12"');
                                  
                                    ?>
                                      
                                    </div>
                              </div>
                              <!--/span-->
                           </div>
                           <!--/row-->    

                           <div class="row-fluid">
                              <div class="span6 ">
                                
                                    
                             <div class="control-group">
                              <label class="control-label">Image Upload</label>
                              <div class="controls">
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                       <?php
                                         $user_img=$user->photo;
                                          if(empty($user_img))
                                          {
                                             $user_img='no-image.png';
                                          }
                                       ?>     
                                       <img src="<?php echo $user_img; ?>" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                       <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                                       <span class="fileupload-exists">Change</span>
                                       <input type="file" class="default" /></span>
                                       <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                 </div>
                                 
                              </div>
                           </div>
                                 
                              </div>
                              <!--/span-->
                              <div class="span6 ">

                              <div class="control-group">
                              <label class="control-label">Date of Joining</label>
                              <div class="controls">
                                 <div class="input-append date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input class="m-wrap span12  m-ctrl-medium date-picker" size="20" type="text" value="12-02-2012"><span class="add-on"><i class="fa fa-calendar"></i></span>
                                 </div>
                              </div>
                           </div>
                              </div>
                              <!--/span-->
                           </div>
                           <!--/row--> 
                           <h3 class="form-section">Contact Info</h3>
                            <div class="row-fluid">
                              <div class="span6 ">

                              <div class="control-group">
                              <label class="control-label">Email Address</label>
                              <div class="controls">
                                 <div class="input-icon left">
                                    <i class="fa fa-envelope"></i>
                                    <input type="text"  class="m-wrap span12" name="email_address" value="<?php echo set_value('email_address', $user->email_address); ?>">   
                                 </div>
                              </div>
                              </div>
                                 
                              </div>
                           <div class="span6 ">
                              <div class="control-group">
                              <label class="control-label">Contact No</label>
                              <div class="controls">
                                 <div class="input-icon left">
                                    <i class=" fa fa-phone"></i>
                                    <input type="text"  class="m-wrap span12" name="contact_no" value="<?php echo set_value('contact_no', $user->email_address); ?>">   
                                 </div>
                              </div>
                              </div>
                               
                           </div>
                          
                           <div class="row-fluid">
                              <div class="span12 ">
                                 <div class="control-group">
                                    <label class="control-label" >Street</label>
                                    <div class="controls">
                                       <input type="text" class="m-wrap span12" >
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row-fluid">
                              <div class="span6 ">
                                 <div class="control-group">
                                    <label class="control-label" >City</label>
                                    <div class="controls">
                                       <input type="text"  class="m-wrap span12"> 
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="span6 ">
                                 <div class="control-group">
                                    <label class="control-label" >State</label>
                                    <div class="controls">
                                       <input type="text"  class="m-wrap span12"> 
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                           </div>
                           <!--/row-->           
                           <div class="row-fluid">
                              <div class="span6 ">
                                 <div class="control-group">
                                    <label class="control-label" >Post Code</label>
                                    <div class="controls">
                                       <input type="text" class="m-wrap span12"> 
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="span6 ">
                                 <div class="control-group">
                                    <label class="control-label" >Country</label>
                                    <div class="controls">
                                       <select  class="m-wrap span12"></select>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                           </div>

                           <div class="row-fluid">
                              <div class="span6 ">
                                 <div class="control-group">
                                    <label class="control-label" >Status</label>
                                    <div class="controls">
                                        <?php
                                          $options = array('1'=> 'Yes', '0'=> 'No');
                                          echo form_dropdown('status', $options, $user->status, 'class="m-wrap span12" id=""');
                                       ?>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="span6 ">
                                 <div class="control-group">
                                 
                                 </div>
                              </div>
                              <!--/span-->
                           </div>


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
    </div>