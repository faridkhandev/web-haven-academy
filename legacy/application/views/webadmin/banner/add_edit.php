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
                     Manage Slider
                    </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url("webadmin/dashboard");?>">Home</a> 
                        <span class=" fa fa-angle-right"></span>
                     </li>
                     <li>
                        <a href="<?php echo base_url("webadmin/banner");?>">Manage Slider</a>
                        <span class="fa fa-angle-right"></span>
                     </li>
                     <li><a href="<?php echo base_url("webadmin/banner/add_edit");?>">Add New Slider</a></li>
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
                        <h4><i class="fa fa-reorder"></i>  
                        <?php echo empty($banner->id) ? 'Add New Banner' : 'Edit Banner : : ' . $banner->title; ?></h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                      <?php echo form_open_multipart('','class=horizontal-form'); ?>
                      <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?>
 
                 
  						<?php echo $this->session->flashdata('msg'); ?>
                           <h3 class="form-section">Slider</h3>
                           <div class="row-fluid">
                              <div class="span6 ">
                                 <div class="control-group">
                                    <label class="control-label" for="Category Title">Slider Title</label>
                                    <div class="controls">
                                   <input type="text"  class="m-wrap span12" name="title" value="<?php echo set_value('title', $banner->title); ?>">    
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
							  <div class="span6 ">
                                 <div class="control-group">
                                    <label class="control-label" for="Category Title">Slider Short Content</label>
                                    <div class="controls">
                                   <textarea class="m-wrap span12" name="short_content"><?php echo set_value('short_content', $banner->short_content); ?></textarea>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
							   </div>
							   <div class="row-fluid">
                              <div class="span6 ">
                                 <div class="control-group ">
                                    <label class="control-label" for="Parent">Slider Button Text</label>
                                    <div class="controls">
									<input type="text"  class="m-wrap span12" name="button_text" value="<?php echo set_value('button_text', $banner->button_text); ?>">
                                     </div>
                                 </div>
                              </div>
							  <div class="span6 ">
                                 <div class="control-group ">
                                    <label class="control-label" for="Parent">Slider Button Link</label>
                                    <div class="controls">
									<input type="text"  class="m-wrap span12" name="button_link" value="<?php echo set_value('button_link', $banner->button_link); ?>">
                                     </div>
                                 </div>
                              </div>
                              <!--/span-->
                           </div>
                           <!--/row-->
                           
                           <div class="row-fluid">
                              <div class="span6 ">
                                
                                    
                             <div class="control-group">
                              <label class="control-label">Banner Image Upload</label>
                              <div class="controls">
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <input type="hidden"  name="old_img"   value="<?php echo $banner->banner_img; ?>"  />
                                       <?php
                                         $banner_img=$banner->banner_img;
                                          if(empty($banner_img))
                                          {
                                            $banner_img='no-image.png';
                                          }
                                          
                                       ?>
                                        <img src="<?php echo base_url(); ?>/uploads/<?php echo $banner_img; ?>"    />
                                   </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                       <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                                       <span class="fileupload-exists">Change</span>
                                       <input type="file" name="userfile" class="default" /></span>
                                       <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                 </div>
                                
                              </div>
                           </div>
                                 
                              </div>
                              <!--/span-->
                              <div class="span6 ">

                              </div>
                              <!--/span-->
                           </div>
                           <!--/row--> 
                          
                            

                           <div class="row-fluid">
                              <div class="span6 ">
                                 <div class="control-group">
                                    <label class="control-label">Status</label>
                                    <div class="controls">
                                        <?php
                                         $options = array('1'=> 'Yes', '0'=> 'No');
                                          echo form_dropdown('status', $options, $banner->status, 'class="m m-wrap span12" id=""');
                                       ?>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                              <div class="span6 ">
                                 <div class="control-group">
                                  <label class="control-label" >Display Order</label>
									<input type="text"  class="m-wrap span12" name="display_order" value="<?php echo set_value('display_order', $banner->display_order); ?>" required>
                                 </div>
                              </div>
                              <!--/span-->
                           </div>


                           <div class="form-actions">
                              <button type="submit" class="btn blue"><i class="fa fa-ok"></i> Save</button>
                              <a href="<?php echo base_url(); ?>webadmin/banner" class="btn">Cancel</a>
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