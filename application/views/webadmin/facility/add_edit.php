<!-- BEGIN PAGE CONTAINER-->
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN STYLE CUSTOMIZER --> 
      
      <!-- END BEGIN STYLE CUSTOMIZER -->
      <h3 class="page-title"> Manage Facility </h3>
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url("webadmin/dashboard");?>">Home</a> <span class="fa fa-angle-right"></span> </li>
        <li> <a href="<?php echo base_url("webadmin/facility");?>">Manage Facility</a> <span class="fa fa-angle-right"></span> </li>
        <li><a href="<?php echo base_url("webadmin/facility/add_edit");?>">Add New Facility</a></li>
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
              <h4><i class="fa fa-reorder"></i> <?php echo empty($facility->id) ? 'Add New Facility' : 'Edit Facility : : ' . $Service->title; ?></h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a>  <a href="javascript:;" class="remove"></a> </div>
            </div>
       <div class="portlet-body form">
                                 <!-- BEGIN FORM-->
            <form action="#"  method="post"   class="form-horizontal form-bordered"  enctype="multipart/form-data">
				<?php
				$attributes = array('class' => 'email', 'class' => 'myform');
				// echo form_open_multipart('',$attributes); 
				?>                                     
			  <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?>
				<div class="control-group">
				   <label class="control-label">Facility Title</label>
				   <div class="controls">
					  <input type="text"  class="m-wrap span12" name="title" value="<?php echo set_value('title', $facility->title); ?>">
				   </div>
				</div>
				<div class="control-group">
				   <label class="control-label">Image</label>
				   <div class="controls">
						<div class="fileupload fileupload-new" data-provides="fileupload">
							<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
							<input type="hidden" name="old_img" value="<?php echo $facility->image; ?>"  />
							<?php
							$cat_img=$facility->image;
							if(empty($cat_img))
							{
							$cat_img='no-image.png';
							}

							?>
							<img src="<?php echo base_url(); ?>uploads/<?php echo $cat_img; ?>"    /> </div>
							<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
							<div> <span class="btn btn-file"><span class="fileupload-new">Select image</span> <span class="fileupload-exists">Change</span>
							<input type="file" name="userfile" class="default" />
							</span> <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a> </div>
						</div>
				   </div>
				</div>
				
				<div class="row-fluid">

                <div class="span12 ">

                  <div class="control-group">

                    <label class="control-label" >Description</label>

                    <div class="controls">

                      <?php

                                      $desc = array(

                                         'name'        => 'body',

                                         'id'          => 'desc',

                                         'value'       => $facility->body,

                                         'rows'        => '5',

                                         'cols'        => '10',

                                         'style'       => 'width:99%',

                                         'class'   =>'large'

                                       );

                                     

                                       echo form_textarea($desc);

                                     ?>

                    </div>

                  </div>

                </div>

                <!--/span--> 

              </div>

				<div class="form-actions">
					<button type="submit" class="btn blue"><i class="fa fa-ok"></i> Save</button>
					<a href="<?php echo base_url(); ?>webadmin/facility" class="btn">Cancel</a> 
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