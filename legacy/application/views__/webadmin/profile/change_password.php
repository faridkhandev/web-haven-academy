 <!-- BEGIN PAGE CONTAINER-->
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN STYLE CUSTOMIZER --> 
      <!-- END BEGIN STYLE CUSTOMIZER -->
      <h3 class="page-title"> Change Password </h3>
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url("webadmin/dashboard");?>">Home</a> <span class="fa fa-angle-right"></span> </li>
        <li> <a href="<?php echo base_url("webadmin/profile");?>">Profile</a> <span class="fa fa-angle-right"></span> </li>
        <li><a href="<?php echo base_url("webadmin/profile/change_password");?>">Change Password</a></li>
      </ul>
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  <!-- BEGIN PAGE CONTENT-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN SAMPLE FORM PORTLET-->
      <div class="portlet box  red">
        <div class="portlet-title">
          <h4><i class="fa fa-key"></i> Change Password :: <?php echo  $result[0]->first_name.'&nbsp;'. $result[0]->last_name;?></h4>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
        </div>
        <div class="portlet-body form"> 
          <!-- BEGIN FORM--> 
          <?php echo form_open('','class=form-horizontal'); ?>
          <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?> <?php echo $this->session->flashdata('msg'); ?>
          <input type="hidden" name="profile_id" value="<?php echo set_value('profile_id', $result[0]->id);?>" />
          <input type="hidden" name="db_password" value="<?php echo set_value('db_password', $result[0]->pass_word);?>" />
          <div class="control-group">
            <label class="control-label">Old Password</label>
            <div class="controls">
              <input type="password"   class="span6 m-wrap" name="old_password"  value="<?php echo set_value('old_password', $_POST['old_password']); ?>"  autocomplete="off">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">New Password</label>
            <div class="controls">
              <input type="password"  class="span6 m-wrap"  name="pass_word"  value="" autocomplete="off" >
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Confirm Password</label>
            <div class="controls">
              <input type="password"  class="span6 m-wrap"  name="passconf" value="" autocomplete="off">
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn blue">Change Password</button>
          </div>
          <?php form_close(); ?>
          <!-- END FORM--> 
        </div>
      </div>
      <!-- END SAMPLE FORM PORTLET--> 
    </div>
  </div>
  
  <!-- END EXTRAS PORTLET--> 
</div>
</div>
</div>
