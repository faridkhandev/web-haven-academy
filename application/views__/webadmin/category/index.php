       <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
           
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE CONTAINER-->            
            <div class="container-fluid">
                <!-- BEGIN PAGE HEADER-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN STYLE CUSTOMIZER -->
                      
                        <!-- END BEGIN STYLE CUSTOMIZER -->  
                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->           
                        <h3 class="page-title">
                            Manage Category 
                        </h3>
                        <ul class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="<?php  echo base_url("webadmin/dashboard"); ?>">Home</a> 
                                <i class="fa fa-angle-right"></i>
                            </li>
                            
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="<?php  echo base_url("webadmin/category"); ?>">Manage Category</a> 
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Category List</a>                               
                            </li>
                        </ul>
                         <?php echo $this->session->flashdata('msg'); ?>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box portlet box purple">
                            <div class="portlet-title">
                                <h4><i class="fa fa-user"></i>Manage Category</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                   
                                  
                                    <a href="javascript:;" class="remove"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="clearfix">
                                    <div class="btn-group">
                                       <a href="<?php echo base_url(); ?>webadmin/category/add_edit" class="btn green">Add New Category <i class="fa fa-plus"></i></a>
                                      
                                    </div>
                                    
                                </div>
                                <table class="table table-striped table-bordered table-hover" id="sample_3">
                                    <thead>
                                        <tr>
                                            <th style="width:8px;">#</th>
                                            <th>Title</th>
                                            <th>Parent</th>
                                            <th >Image</th>
                                            <th class="hidden-480">Display Order</th>
                                            <th class="hidden-480">Status</th>
                                            <th >Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                        foreach($categories as $category)
                                        {
                                            $c++;

                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $c;?></td>
                                            <td><?php echo $category->title;?></td>

                                            <td>
                                            <?php 
											
											//get_category_name()  this function belong to helperclass
                                              echo get_meta_by_id('categories','title',$category->parent_id);
                                            ?>
                                            </td>
                                            <td>
                                            <?php 
                                               $cat_img=$category->image;
                                                if(empty($cat_img))
                                                {
                                                    $cat_img='no-image.png';
                                                }
                                                
                                              ?>
                                        
                                        <img src="<?php echo base_url(); ?>/uploads/<?php echo $cat_img; ?>"  height="100" width="100"  />
                                           
                                            </td>
                                            <td class="hidden-480">
                                           <?php echo $category->display_order; ?>
										   </td>
                                            <td class="hidden-480">
                                            <?php
                                            if($category->status==1)
                                            {
                                                 echo '<span class="label label-success">Approved</span></td>';
                                            }
                                            else
                                            {

                                                   echo '<span class="label label-warning">Suspended</span>';
                                            }   
                                         
                                          ?>

                                            </td>
                                          
                                         <td align="center">
                                         <?php 
                                          
                                             echo '&nbsp;'.  anchor('webadmin/category/add_edit/'.$category->id, '<i class="fa fa-pencil"></i>Edit', array('class' => 'btn btn-small'));
                                             echo '&nbsp;'.   anchor('webadmin/category/del/'.$category->id, '<i class="fa fa-trash"></i>Delete',array('class' =>'btn btn-small','onclick' => "return confirm('Do you want delete ".$categroy->title." category ?')"));
                                         ?> 
                                         </td>

                                        </tr>
                                       <?php
                                        }
                                       ?> 
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
               
                <!-- END PAGE CONTENT-->
            </div>
            <!-- END PAGE CONTAINER-->
    