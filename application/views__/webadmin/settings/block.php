        <!-- BEGIN PAGE CONTAINER-->
        <div class="container-fluid"> 
          <!-- BEGIN PAGE HEADER-->
          <div class="row-fluid">
            <div class="span12"> 
      <!-- BEGIN STYLE CUSTOMIZER --> 
      
      <!-- END BEGIN STYLE CUSTOMIZER -->
      <h3 class="page-title"> Manage Block </h3>
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url("webadmin/dashboard");?>">Home</a> <span class="fa fa-angle-right"></span> </li>
        <li> <a href="<?php echo base_url("webadmin/service");?>">Manage   Service</a> </li>
       
      </ul>
    </div>
          </div>
          <!-- END PAGE HEADER--> 
          <!-- Contact Details-->
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PORTLET-->   
                  <div class="portlet box grey">
                     <div class="portlet-title">
                        <h4><i class="fa fa-reorder"></i> Add New Block </h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                         <?php echo form_open_multipart('','class=horizontal-form'); ?>
                         <?php echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); ?> 
						 <?php echo $this->session->flashdata('msg'); ?>
                      <div class="row-fluid">
                       
                        <div class="span6 ">
                          <div class="control-group">
                              <label class="control-label">Block Name </label>
                              <div class="controls">
                                 <div class="input-icon left">
                                    <i class="fa fa-pencil"></i>
                               <input class="m-wrap  span12" name="block_title" type="text" placeholder="Block Name" 
                               value="<?php echo set_value('block_title'); ?>">    
                                 </div>
                              </div>
                           </div>
                        </div>
                      
                      
                        <div class="span6 ">
                          <div class="control-group">
                              <label class="control-label">Shotrcode </label>
                              <div class="controls">
                                 <div class="input-icon left">
                                    <i class="fa fa-copy "></i>
                                    <input  class="m-wrap  span12" name="short_code" type="text" placeholder="Copy the text paste any where"    value="<?php echo set_value('short_code'); ?>">    
                                 </div>
                              </div>
                           </div>
                        </div>
                      
                      
                      </div>
                      
                      <div class="row-fluid">
                        <div class="control-group">
                                       <label class="control-label">Block Content </label>
                                       <div class="controls">
     <textarea class="span12 ckeditor m-wrap" name="content" rows="6"><?php echo set_value('content'); ?></textarea>
                                          <span class="help-inline">Type here about block description</span>
                                       </div>
                                    </div>
                        
                      
                      
                        
                      
                      
                      </div>
                      <div class="form-actions"> 
                        <button type="submit" name="addblock" value="Add Block" class="btn green pull-right"><i class="fa fa-ok"></i> Add Block</button>
                       
                      </div>
                      <?php echo form_close();?>
                       
                     </div>
                  </div>
                  <!-- END PORTLET-->
                  <hr />
                  
                  <?php
				    foreach($blocks  as $block){
				  ?>
                  <div class="portlet box grey">
                     <div class="portlet-title">
                        <h4><i class="fa fa-reorder"></i>Block :: <?php echo $block->block_title;?> </h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                      <?php echo form_open_multipart('','class=horizontal-form'); ?>
                     <?php
                     echo form_error('up_block_title', '<div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>');
					
					
					 echo form_error('up_content', '<div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>');
					
					   ?>
						 
						 
				  <?php echo $this->session->flashdata('updatemsg'.$block->id); ?>
                      <div class="row-fluid">
                       
                        <div class="span6 ">
                          <div class="control-group">
                              <label class="control-label">Block Name </label>
                              <div class="controls">
                                 <div class="input-icon left">
                                    <i class="fa fa-pencil"></i>
                                    <input class="m-wrap  span12" name="block_id" type="hidden"  value="<?php echo set_value('block_id', $block->id); ?>" >    
                                 
                                    <input class="m-wrap  span12" name="up_block_title" type="text"  value="<?php echo set_value('up_block_title', $block->block_title); ?>"  placeholder="Block Name">    
                                 </div>
                              </div>
                           </div>
                        </div>
                      
                      
                        <div class="span6 ">
                          <div class="control-group">
                              <label class="control-label">Shotrcode </label>
                              <div class="controls">
                                 <div class="input-icon left">
                                    <i class="fa fa-copy "></i>
                                    <input readonly="readonly" class="m-wrap  span12" name="up_short_code"  value="<?php echo set_value('up_short_code', $block->short_code); ?>" type="text" placeholder="Copy the text paste any where">    
                                 </div>
                              </div>
                           </div>
                        </div>
                      
                      
                      </div>
                      
                      <div class="row-fluid">
                        <div class="control-group">
                                       <label class="control-label">Block Content </label>
                                       <div class="controls">
     <textarea class="span12 ckeditor m-wrap" name="up_content" rows="2"><?php echo set_value('up_content', $block->content); ?></textarea>
                                          <span class="help-inline">Type here about block description</span>
                                       </div>
                                    </div>
                        
                      
                      
                        
                      
                      
                      </div>
                      <div class="form-actions ">
                      
                       <?php
					    echo  anchor('webadmin/settings/delete_block/'.$block->id, '<i class="fa fa- fa fa-remove"></i> Delete Block',array('class' =>'btn red delete','onclick' => "return confirm('Are you sure you want to delete ".$block->block_title." Block ?')"));
					   ?>
                    <button type="submit"  name="updateblock" value="Update"class="btn green pull-right"><i class="fa fa-ok"></i> Update Block</button>
                      </div>
                      <?php echo form_close();?>
                       
                     </div>
                  </div>
                  <?php
				  }
				  ?>
               </div>
            </div>
            <!-- Contact Details-->
        </div>
        <!-- END PAGE CONTAINER-->
        
       						 <div id="myModal3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true" style="display: none;">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								    <h3 id="myModalLabel3">Are you sure you want to delete this Block?</h3>
									</div>
									<div class="modal-body">
										<p>Body goes here...</p>
									</div>
									<div class="modal-footer">
										<button class="btn" data-dismiss="modal" aria-hidden="true">I do not</button>
										<button data-dismiss="modal" onclik="delete_block();" class="btn blue">Yes, Delete it</button>
									</div>
								</div>
        
<style>
.form-actions {
    padding: 0px;
}
.form .form-actions .delete {
	margin-left:-190px !important;
}
</style> 

<script>
function delete_block()
{
	alert('ok');
}
</script>