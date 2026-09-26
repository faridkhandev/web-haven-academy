<div class="container-fluid"> 

  <!-- BEGIN PAGE HEADER-->

  <div class="row-fluid">

    <div class="span12"> 

      <!-- BEGIN STYLE CUSTOMIZER --> 

      

      <!-- END BEGIN STYLE CUSTOMIZER -->

      <h3 class="page-title"> Manage Package </h3>

      <ul class="breadcrumb">

        <li> <i class="fa fa-home"></i> <a href="<?php  echo base_url("webadmin/dashboard"); ?>">Home</a> <span class="fa fa-angle-right"></span> </li>

        <li> <a href="#">Manage Package</a> <span class="fa fa-angle-right"></span> </li>

        <li><a href="#"><?php echo empty($package->id) ? 'Add New Package' : 'Edit Package : : ' . $package->title; ?></a></li>

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

              <h4><i class="fa fa-reorder"></i> <?php echo empty($package->id) ? 'Add New Package' : 'Edit Package : : ' . $package->name; ?></h4>

              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>

            </div>

            <div class="portlet-body form"> 

              <!-- BEGIN FORM--> 

              <?php echo form_open_multipart('','class=horizontal-form'); ?>

              <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?>

              <h3 class="form-section">Package</h3>

				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
						<label class="control-label" for="Package Name">Package Name</label>
						<div class="controls">
						  <input type="text" class="m-wrap span12" name="name" value="<?php echo set_value('name', $package->name); ?>">
						</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
						<label class="control-label" for="Package Places">Places</label>
						<div class="controls">
						  <input type="text" class="m-wrap span12" name="places" value="<?php echo set_value('places', $package->places); ?>">
						</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span4">
						<div class="control-group">
						<label class="control-label" for="Package Duration">Package Duration</label>
						<div class="controls">
						  <input type="text" class="m-wrap span12" name="duration" value="<?php echo set_value('duration', $package->duration); ?>">
						</div>
						</div>
					</div>
					<div class="span4">
						<div class="control-group">
						<label class="control-label" for="Package price">Package Price</label>
						<div class="controls">
						  <input type="text"  class="m-wrap span12" name="price" value="<?php echo set_value('price', $package->price); ?>">
						</div>
						</div>
					</div>
					<div class="span4">
						<div class="control-group">
						<label class="control-label" for="Package Category">Package Category</label>
						<div class="controls">
						<?php
						 $cat_options =$categories;
						 echo form_dropdown('category_id', $cat_options, $package->category_id, 'class="m m-wrap span12" id=""');
					?>
						</div>
						</div>
					</div>
				</div>
				
				<div class="row-fluid">
					<div class="span12">
						<div class="control-group">
						<label class="control-label" for="Package description">Package Description</label>
						<div class="controls">
							<textarea class="m-wrap span12" name="description" id="description"><?php echo set_value('description', $package->description); ?></textarea>
						</div>
						</div>
					</div>
				</div>
                <!--/row-->
				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
						<label class="control-label" for="Package Included">Package Included</label>
						<div class="controls">
							<textarea class="m-wrap span12" name="included" id="included"><?php echo set_value('included', $package->included); ?></textarea>
						</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="Package Excluded">Package Excluded</label>
							<div class="controls">
								<textarea class="m-wrap span12" name="excluded" id="excluded"><?php echo set_value('excluded', $package->excluded); ?></textarea>
							</div>
						</div>
					</div>
				</div>
              <div class="row-fluid">
                <div class="span12 ">
                  <div class="control-group">
                    <label class="control-label">Package Slug</label>
                    <div class="controls">
                      <input type="text"  class="m-wrap span12" name="slug" value="<?php echo set_value('slug', $package->slug); ?>">
                    </div>
                  </div>
                </div>
                <!--/span-->
                <!--/span--> 
              </div>
              <div class="row-fluid">
                <div class="span6 ">
                  <div class="control-group">
                    <label class="control-label">Image Upload</label>
                    <div class="controls">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                          <input type="hidden" name="old_img" value="<?php echo $package->image; ?>"/>
							<?php
								$cat_img=$package->image;
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
                <div class="span6">
                  <div class="control-group">
                    <label class="control-label">Status</label>
                    <div class="controls">
                      <?php
						$options = array('1'=> 'Yes', '0'=> 'No');
						echo form_dropdown('status', $options, $package->status, 'class="m m-wrap span12" id=""');
						?>
                    </div>
                  </div>
                </div>

                <div class="span6">
                  <div class="control-group">
                    <label class="control-label" >Display Ordered</label>
                    <?php echo form_input('display_order', set_value('display_order', $package->display_order) ,'class="m-wrap span12"'); ?> </div>
                </div>
                <!--/span--> 
              </div>
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
var filter_row = <?php echo $filter_row; ?>;

function addFilterRow() {
	html  = '<tr id="filter-row' + filter_row + '">';	
    html += '  <td class="text-left" style="width: 30%;"><input type="hidden" name="itinerary[' + filter_row + '][id]" value="" /><input type="text" class="m-wrap span12" name="itinerary[' + filter_row + '][name]" value=""></td>';
	html += '  <td class="text-right" style="width: 60%;"><textarea rows="6" class="m-wrap span12" name="itinerary[' + filter_row + '][description]"></textarea></td>';
	html += '  <td class="text-left" style="width: 10%;"><button type="button" onclick="$(\'#filter-row' + filter_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';	
	
	$('#filter tbody').append(html);
	
	filter_row++;
}
//--></script>
<script>
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace( 'overview' );
	CKEDITOR.replace( 'highlights' );
	CKEDITOR.replace( 'included' );
	CKEDITOR.replace( 'excluded' );
</script>