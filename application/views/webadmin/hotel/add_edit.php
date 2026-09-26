<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
     <!-- BEGIN STYLE CUSTOMIZER --> 
      <!-- END BEGIN STYLE CUSTOMIZER -->
      <h3 class="page-title"> Manage Room </h3>
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php  echo base_url("webadmin/dashboard"); ?>">Home</a> <span class="fa fa-angle-right"></span> </li>
        <li> <a href="<?php echo base_url("webadmin/hotel"); ?>">Manage Room</a> <span class="fa fa-angle-right"></span> </li>
        <li><a href="#"><?php echo empty($hotel->id) ? 'Add New Room' : 'Edit Room : : ' . $hotel->title; ?></a></li>
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
              <h4><i class="fa fa-reorder"></i> <?php echo empty($hotel->id) ? 'Add New Room' : 'Edit Room : : ' . $hotel->name; ?></h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM--> 
              <?php echo form_open_multipart('','class=horizontal-form'); ?>
              <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?>
              <h3 class="form-section">Room</h3>

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
						<label class="control-label" for="Room Name">Room Name</label>
						<div class="controls">
						  <input type="text" class="m-wrap span12" name="name" value="<?php echo set_value('name', $hotel->name); ?>">
						</div>
						</div>
					</div>
					<div class="span6 ">
                  <div class="control-group">
                    <label class="control-label">Image Upload</label>
                    <div class="controls">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                          <input type="hidden" name="old_img" value="<?php echo $hotel->image; ?>"/>
							<?php
								$cat_img=$hotel->image;
								if(empty($cat_img))
								{
									$cat_img='no-image.png';
								}
							?>
							<img src="<?php echo base_url(); ?>/uploads/<?php echo $cat_img; ?>"    />
							</div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                        <div> <span class="btn btn-file"><span class="fileupload-new">Select image</span> <span class="fileupload-exists">Change</span>
                          <input type="file" name="userfile" class="default" />
                          </span> <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a> </div>
                      </div>
                    </div>
                  </div>
                </div>
				</div>
              <div class="row-fluid">
                <div class="span6 ">
                  <div class="control-group">
                    <label class="control-label">Room Slug</label>
                    <div class="controls">
                      <input type="text"  class="m-wrap span12" name="slug" value="<?php echo set_value('slug', $hotel->slug); ?>">
                    </div>
                  </div>
                </div>
				<div class="span6 ">
                  <div class="control-group">
                    <label class="control-label">Room Price</label>
                    <div class="controls">
                      <input type="text"  class="m-wrap span12" name="price" value="<?php echo set_value('price', $hotel->price); ?>">
                    </div>
                  </div>
                </div>
                <!--/span-->
                <!--/span--> 
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

                                         'value'       => $hotel->description,

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
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label">Status</label>
                    <div class="controls">
                      <?php
						$options = array('1'=> 'Yes', '0'=> 'No');
						echo form_dropdown('status', $options, $hotel->status, 'class="m m-wrap span12" id=""');
						?>
                    </div>
                  </div>
                </div>

                <div class="span6">
                  <div class="control-group">
                    <label class="control-label" >Display Orderd</label>
                    <?php echo form_input('display_order', set_value('display_order', $hotel->display_order) ,'class="m-wrap span12"'); ?> </div>
                </div>
                <!--/span--> 
              </div>
			  <h3 class="form-section">Room Services</h3>
			  <table id="filterservice" class="table table-striped table-bordered table-hover">
				<thead>
				  <tr>
					<td class="text-left" style="width: 90%;">Title</td>
					<td style="width: 10%;"></td>
				  </tr>
				</thead>
				<tbody>
				  <?php $filter_row1 = 0; ?>
				  <?php foreach ($services as $service) { ?>
				  <tr id="filter-row1<?php echo $filter_row1; ?>">
				    <td class="text-left" style="width: 90%;"><input type="text" name="hotel_images[<?php echo $filter_row; ?>][service]" value="<?php echo $service->service; ?>" class="span12" /></td>
					<td class="left" style="width: 10%;"><button type="button" onclick="$(\'#filter-row1' + filter_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
					</tr>
				<?php $filter_row1++; ?>
				<?php } ?>
				</tbody>
				<tfoot>
				  <tr>
					<td colspan="1"></td>
					<td class="text-left"><a onclick="addFilterRow1();" data-toggle="tooltip" title="Add More" class="btn btn-primary"><i class="fa fa-plus-circle"></i></a></td>
				  </tr>
				</tfoot>
			  </table>
              <div class="form-actions">
                <button type="submit" class="btn blue"><i class="fa fa-ok"></i> Save</button>
                <button type="button" class="btn">Cancel</button>
              </div>
              <?php echo form_close();?>
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
<script type="text/javascript"><!--

var filter_row1 = <?php echo $filter_row1; ?>;

function addFilterRow1() {
	html  = '<tr id="filter-row' + filter_row1 + '">';	
    html += '  <td class="text-left" style="width: 30%;"><input type="text" name="hotel_images[' + filter_row1 + '][service]" value="" class="span12" /></td>';
	html += '  <td class="text-left" style="width: 10%;"><button type="button" onclick="$(\'#filter-row' + filter_row1 + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';	
	
	$('#filterservice tbody').append(html);
	
	filter_row1++;
}
//--></script>
<!-- END PAGE CONTAINER--> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>  