<div class="container-fluid"> 

  <!-- BEGIN PAGE HEADER-->

  <div class="row-fluid">

    <div class="span12"> 

      <!-- BEGIN STYLE CUSTOMIZER --> 

      

      <!-- END BEGIN STYLE CUSTOMIZER -->

      <h3 class="page-title"> Manage Service </h3>

      <ul class="breadcrumb">

        <li> <i class="fa fa-home"></i> <a href="<?php  echo base_url("webadmin/dashboard"); ?>">Home</a> <span class="fa fa-angle-right"></span> </li>

        <li> <a href="<?php  echo base_url("webadmin/service"); ?>">Manage Service</a> <span class="fa fa-angle-right"></span> </li>

        <li><a href="#"><?php echo empty($service->id) ? 'Add New Service' : 'Edit Service : : ' . $service->title; ?></a></li>

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

              <h4><i class="fa fa-reorder"></i> <?php echo empty($service->id) ? 'Add New Service' : 'Edit Service : : ' . $service->title; ?></h4>

              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>

            </div>

            <div class="portlet-body form"> 

              <!-- BEGIN FORM--> 

              <?php echo form_open_multipart('','class=horizontal-form'); ?>

              <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?>

              <h3 class="form-section">Service</h3>

              <div class="row-fluid">

                <div class="span12">

                  <div class="control-group">

                    <label class="control-label" for="Title">Service Title</label>

                    <div class="controls">

                      <input type="text"  class="m-wrap span12" name="title" value="<?php echo set_value('title', $service->title); ?>">

                    </div>

                  </div>

                </div> 
				</div>
				<div class="row-fluid">
				<div class="span6 ">

                  <div class="control-group">

                    <label class="control-label" for="Sub Title">Sub Title</label>

                    <div class="controls">

                      <input type="text"  class="m-wrap span12" name="sub_title" value="<?php echo set_value('sub_title', $service->sub_title); ?>">

                    </div>

                  </div>

                </div>
				
				<div class="span6 ">

                  <div class="control-group">

                    <label class="control-label" for="Sub Title">Slug Url(Last Url Part)</label>

                    <div class="controls">

                      <input type="text"  class="m-wrap span12" name="slug" value="<?php echo set_value('slug', $service->slug); ?>" required >

                    </div>

                  </div>

                </div>	

              </div>

              <!--/row-->

              <!--/row-->

              <div class="row-fluid">

                <div class="span12 ">

                  <div class="control-group">

                    <label class="control-label" >Description</label>

                    <div class="controls">

                      <?php

                                      $desc = array(

                                         'name'        => 'description',

                                         'id'          => 'desc',

                                         'value'       => $service->description,

                                         'rows'        => '5',

                                         'cols'        => '10',

                                         'style'       => 'width:99%',

                                         'class'   =>'large ckeditor'

                                       );

                                     

                                       echo form_textarea($desc);

                                     ?>

                    </div>

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

                          <input type="hidden"  name="old_img"   value="<?php echo $service->image; ?>"  />

                          <?php

                                         $cat_img=$service->image;

                                          if(empty($cat_img))

                                          {

                                            $cat_img='no-image.png';

                                          }

                                          

                                       ?>

                          <img src="<?php echo base_url(); ?>/uploads/<?php echo $cat_img; ?>"    /> </div>

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

              

              <div class="row-fluid">

                <div class="span6 ">

                  <div class="control-group">

                    <label class="control-label" >Status</label>

                    <div class="controls">

                      <?php

                                          $options = array('1'=> 'Yes', '0'=> 'No');

                                          echo form_dropdown('status', $options, $service->status, 'class="m m-wrap span12" id=""');

                                       ?>

                    </div>

                  </div>

                </div>

                <!--/span-->

                <div class="span6 ">

                  <div class="control-group">

                    <label class="control-label" >Display Orderd</label>

                    <?php echo form_input('display_order', set_value('display_order', $service->display_order) ,'class="m-wrap span12"'); ?> </div>

                </div>

                <!--/span--> 

              </div>

              <div class="form-actions">

                <button type="submit" class="btn blue"><i class="fa fa-ok"></i> Save</button>

                <a href="<?php echo base_url(); ?>webadmin/service" class="btn">Cancel</a> 

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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>