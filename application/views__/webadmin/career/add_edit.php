<!-- BEGIN PAGE CONTAINER-->
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN STYLE CUSTOMIZER --> 
      
      <!-- END BEGIN STYLE CUSTOMIZER -->
      <h3 class="page-title"> Manage Career </h3>
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url("webadmin/dashboard");?>">Home</a> <span class="fa fa-angle-right"></span> </li>
        <li> <a href="<?php echo base_url("webadmin/career");?>">Manage Career</a> <span class="fa fa-angle-right"></span> </li>
        <li><a href="<?php echo base_url("webadmin/career/add_edit");?>">Add New Career</a></li>
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
              <h4><i class="fa fa-reorder"></i> <?php echo empty($career->id) ? 'Add New Career' : 'Edit Career : : ' . $career->title; ?></h4>
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
				   <label class="control-label">Title</label>
				   <div class="controls">
					  <input type="text"  class="m-wrap span12" name="title" value="<?php echo set_value('title', $career->title); ?>">
				   </div>
				</div>
				
				<div class="row-fluid">

                <div class="span12 ">

                  <div class="control-group">

                    <label class="control-label" >Description</label>

                    <div class="controls">

                      <?php

                                      $desc = array(

                                         'name'        => 'description',

                                         'id'          => 'desc',

                                         'value'       => $career->description,

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
				<div class="row-fluid">

                <div class="span6 ">

                  <div class="control-group">

                    <label class="control-label" >Status</label>

                    <div class="controls">

                      <?php

						  $options = array('1'=> 'Yes', '0'=> 'No');

						  echo form_dropdown('status', $options, $career->status, 'class="m m-wrap span12" id=""');

					   ?>

                    </div>

                  </div>

                </div>
                </div>
				<div class="form-actions">
					<button type="submit" class="btn blue"><i class="fa fa-ok"></i> Save</button>
					<a href="<?php echo base_url(); ?>webadmin/career" class="btn">Cancel</a> 
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