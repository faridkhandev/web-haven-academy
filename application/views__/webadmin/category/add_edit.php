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
      <h3 class="page-title"> Manage Category </h3>
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php  echo base_url("webadmin/dashboard"); ?>">Home</a> <span class="fa fa-angle-right"></span> </li>
        <li> <a href="#">Manage Category</a> <span class="fa fa-angle-right"></span> </li>
        <li><a href="#"><?php echo empty($category->id) ? 'Add New Category' : 'Edit Category : : ' . $category->title; ?></a></li>
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
              <h4><i class="fa fa-reorder"></i> <?php echo empty($category->id) ? 'Add New Category' : 'Edit Category : : ' . $category->title; ?></h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM--> 
              <?php echo form_open_multipart('','class=horizontal-form'); ?>
              <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?>
              <h3 class="form-section">Category</h3>
              <div class="row-fluid">
                <div class="span12 ">
                  <div class="control-group">
                    <label class="control-label" for="Category Title">Category Name</label>
                    <div class="controls">
                      <input type="text"  class="m-wrap span12" name="title" value="<?php echo set_value('title', $category->title); ?>">
                    </div>
                  </div>
                </div>
                <!--/span-->
              </div>
              <!--/row-->
              
              <div class="row-fluid">
                <div class="span6 ">
                  <div class="control-group">
                    <label class="control-label" >Slug</label>
                    <div class="controls">
                      <input type="text"  class="m-wrap span12" name="slug" value="<?php echo set_value('slug', $category->slug); ?>">
                    </div>
                  </div>
                </div>
                <!--/span-->
                <div class="span6 ">
                  <div class="control-group">
                    <label class="control-label" >Display Order</label>
                    <?php echo form_input('display_order', set_value('display_order', $category->display_order) ,'class="m-wrap span12"'); ?> </div>
                </div>
                <!--/span--> 
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
                                         'name'        => 'desc',
                                         'id'          => 'desc',
                                         'value'       => $category->desc,
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
              <!--/row-->
              
              <div class="row-fluid">
                <div class="span6 ">
                  <div class="control-group">
                    <label class="control-label">Image Upload</label>
                    <div class="controls">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                          <input type="hidden"  name="old_img"   value="<?php echo $category->image; ?>"  />
                          <?php
                                         $cat_img=$category->image;
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
                                          echo form_dropdown('status', $options, $category->status, 'class="m m-wrap span12" id=""');
                                       ?>
                    </div>
                  </div>
                </div>
                <!--/span-->
                <div class="span6 ">
                  <div class="control-group"> </div>
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
