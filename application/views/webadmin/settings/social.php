<!-- BEGIN PAGE CONTAINER-->
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN STYLE CUSTOMIZER --> 
      
      <!-- END BEGIN STYLE CUSTOMIZER -->
      <h3 class="page-title"> Manage Social </h3>
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url("webadmin/dashboard");?>">Home</a> <span class="fa fa-angle-right"></span> </li>
        <li> <a href="<?php echo base_url("webadmin/settings");?>">Settings</a> <span class="fa fa-angle-right"></span> </li>
        <li><a href="<?php echo base_url("webadmin/settings/social");?>">Social Link</a></li>
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
              <h4><i class="fa fa-reorder"></i> Stay Connected Links </h4>
              <div class="tools"> 
              <a href="javascript:;" class="collapse"></a> 
              <a href="javascript:;" class="remove"></a> </div>
            </div>
       <div class="portlet-body form">
                                 <!-- BEGIN FORM-->
                              
                                  <form action="#"  method="post"   class="form-horizontal form-bordered"  enctype="multipart/form-data">
                                    <?php
									
									$attributes = array('class' => 'email', 'class' => 'myform');
									// echo form_open_multipart('',$attributes); ?> 
                                     
			  <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?>
                                  <?php echo $this->session->flashdata('social_msg'); ?>
                           <div class="control-group">
                                      <label class="control-label"> Facebook Page URL </label>
                                      <div class="controls">
                                         <div class="input-icon left">
                                            <i class="fa fa-facebook"></i>
                                              <input type="text"  class="m-wrap span12" name="facebook_url" value="<?php echo set_value('facebook_url', $facebook_url); ?>" >
                                          <span class="help-inline">eg: https://www.facebook.com/xyz</span>
                                         </div>
                                      </div>
                                   </div>
                                    <div class="control-group">
                                      <label class="control-label"> Twitter Page URL</label>
                                      <div class="controls">
                                         <div class="input-icon left">
                                            <i class="fa fa-twitter"></i>
                                           <input type="text"  class="m-wrap span12" name="twitter_url" value="<?php echo set_value('twitter_url', $twitter_url); ?>" >
                                         </div>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label"> Linkedin Page URL </label>
                                      <div class="controls">
                                         <div class="input-icon left">
                                            <i class="fa fa-linkedin"></i>
                                             <input type="text"  class="m-wrap span12" name="linkedin_url" value="<?php echo set_value('linkedin_url', $linkedin_url); ?>" >
                                         </div>
                                      </div>
                                   </div>
                                     <div class="form-actions">
                                        <button type="submit" class="btn blue" name="social_links" value="Update"><i class="fa fa-ok"></i> Update</button>
                                        <a href="<?php echo base_url(); ?>webadmin/general" class="btn">Cancel</a> 
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>  