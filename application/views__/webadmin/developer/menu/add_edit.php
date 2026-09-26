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
                  <h3 class="page-title"> Manage Menu </h3>
                  <ul class="breadcrumb">
                    <li> <i class="fa fa-home"></i> <a href="index.html">Home</a> <span class="fa fa-angle-right"></span> </li>
                    <li> <a href="#">Manage Menu</a> <span class="fa fa-angle-right"></span> </li>
                    <li><a href="#"><?php echo empty($menu->id) ? 'Add New Menu' : 'Edit Menu : : ' . $menu->title; ?></a></li>
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
                          <h4><i class="fa fa-reorder"></i> <?php echo empty($menu->id) ? 'Add New Manu' : 'Edit Manu : : ' .$menu->title; ?></h4>
                          <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                        </div>
                        <div class="portlet-body form"> 
                          <!-- BEGIN FORM--> 
                          <?php echo form_open_multipart('','class=horizontal-form'); ?>
                           <?php
                            echo validation_errors(' <div class="alert alert-error  "><i class="fa fa-exclamation-triangle"></i><button class="close" data-dismiss="alert"></button> &nbsp;', '</div>'); 
                           ?>
                          <h3 class="form-section">Menu</h3>
                          <div class="row-fluid">
                            <div class="span6 ">
                              <div class="control-group">
                                <label class="control-label" for="Manu Title">Manu Title</label>
                                <div class="controls">
                               <input type="text"  class="m-wrap span12" name="title" value="<?php echo set_value('title', $menu->title); ?>">
                                </div>
                              </div>
                            </div>
                            <!--/span-->
                            <div class="span6 ">
                              <div class="control-group ">
                                <label class="control-label" for="Parent">Parent</label>
                                <div class="controls">
                                  <select class="m-wrap span12">
                                    <option value="0">Parent</option>
                                            <?php
                                            $this->db->select('*');
                                            $this->db->from('admin_menu');
                                            $this->db->where('parent_id', '0');
                                            $query = $this->db->get();	
                                            //$query = $this->db->query('SELECT  *  FROM admin_menu');
                                            foreach ($query->result_object() as $row)
                                            {
                                            ?>
                                  
                                                <option value="<?php echo $row->id;?>"><?php echo $row->title;?></option>
                                            <?php
                                            }
                                            ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <!--/span--> 
                          </div>
                          <!--/row-->
                          
                          <div class="row-fluid">
                            <div class="span6 ">
                              <div class="control-group">
                                <label class="control-label" >Page Url</label>
                                <div class="controls">
                                  <input type="text"  class="m-wrap span12" name="slug" value="<?php echo set_value('page_url', $menu->page_url); ?>">
                                </div>
                              </div>
                            </div>
                            <!--/span-->
                            <div class="span6 ">
                              <div class="control-group">
                                <label class="control-label" >Menu Class</label>
                               <input type="text" class="m-wrap span12" value="<?php echo set_value('menu_class', $menu->menu_class); ?>">
        </div>
                            </div>
                            <!--/span--> 
                          </div>
                          <!--/row--> 
                        <div class="row-fluid">
                            <div class="span6 ">
                              <div class="control-group">
                                <label class="control-label" >Display Order</label>
                                <div class="controls">

                                   <input type="text"  class="m-wrap span12" name="display_order" value="<?php echo set_value('display_order', $menu->display_order); ?>">
                                </div>
                              </div>
                            </div>
                            <!--/span-->
                          
                            <div class="span6 ">
                              <div class="control-group">
                                <label class="control-label" >Status</label>
                                <div class="controls">
                                  <?php
                                    $options = array('1'=> 'Yes', '0'=> 'No');
                                    echo form_dropdown('status', $options, $manu->status, 'class="m m-wrap span12" id=""');
                                  ?>
                                </div>
                              </div>
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
