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
                  <h3 class="page-title">
                    Set Permission
                    </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="fa fa-home"></i>
                        <a href="index.html">Home</a> 
                        <span class="fa fa-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Manage User Role</a>
                        <span class="fa fa-angle-right"></span>
                     </li>
                     <li><a href="#">Set Permission</a></li>
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
                        <h4>
                        <i class="fa fa-pencil"></i> Assing Menu To User Role :: <?php ?>
                        </h4>
                        <div class="tools">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                      <?php echo form_open_multipart('','class=horizontal-form'); ?>
                       <?php echo $this->session->flashdata('msg'); ?>
                        <h3 class="form-section">User Role</h3>
                           <div class="row-fluid">
                              <div class="span12">
                              
                              
                               <?php
     
          $this->db->select('*');
          $this->db->from('admin_menu');
          $this->db->where('parent_id', '0');
          $this->db->where('status', '1');
          $this->db->where('status', '1');
          $query = $this->db->get();  
          $result=$query->result_object();
          
        
        
        
                    //$query = $this->db->query('SELECT  *  FROM admin_menu');
          foreach ($result as $k => $row)
          {
               $menu_id=$row->mid;
             $full_url_string = explode('/',uri_string());
             $user_id = end($full_url_string);
             $CI =&get_instance();
             $active_menu= $CI->get_user_menu($user_id,$menu_id);
                
          // print_r($active_menu);
           
          //print_r($user_permission[$k]);
         if($active_menu->view==1)
         {
          $viewchk='checked="checked"';
         }
         else
         {
          $viewchk='';
         }
         
         if($active_menu->add==1)
         {
            $addchk='checked="checked"';
         }
         else
         {
           $addchk='';
         }
         
         if($active_menu->edit==1)
         {
            $editchk='checked="checked"';
         }
         else
         {
            $editchk='';
         }
         if($active_menu->del==1)
         {
            $delchk='checked="checked"';
         }
         else
         {
            $delchk='';
         }
        
          ?>
                    
        <input  type="hidden"   name="allmenu_id[]" value="<?php echo $row->mid;?>" />
        <label class="control-label"><?php echo $row->title;?></label>
        <div class="mws-form-item clearfix">
            <ul class="controls inline">
                <li><input type="checkbox" name="view<?php echo $row->mid;?>" value="1"  <?php echo $viewchk; ?> > <label>View</label></li>
                <li><input type="checkbox" name="add<?php echo  $row->mid;?>" value="1" <?php echo $addchk; ?>> <label>Add</label></li>
                <li><input type="checkbox" name="edit<?php echo $row->mid;?>" value="1" <?php echo $editchk; ?>> <label>Edit</label></li>
                <li><input type="checkbox" name="del<?php echo  $row->mid;?>" value="1" <?php echo $delchk; ?> > <label>Del</label></li>
               
            </ul>
        </div>
        <hr>
        <?php
        }
    ?>
    
    
                              </div>
                           </div>
                           <!--/span-->
                           <div class="row-fluid">
                              <div class="span6">

                             <div class="control-group">
                                    <label class="control-label" >Status</label>
                                    <div class="controls">
                                        <?php
                                          $options = array('1'=> 'Yes', '0'=> 'No');
                                          echo form_dropdown('status', $options, $user_role->status, 'class="m-wrap span12" id=""');
                                       ?>
                                    </div>
                                 </div>
                              </div>
                              <!--/span-->
                           </div>
                           <!--/row-->
                           
                        

                        



                           <div class="form-actions">
                              <button type="submit" class="btn blue"><i class="fa fa-ok"></i> Set Permission </button>
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
    