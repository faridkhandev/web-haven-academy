
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
                            Manage Admin Users 
                        </h3>
                        <ul class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="index.html">Home</a> 
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Manage Admin Users</a>   
                                <i class="fa fa-angle-right"></i>                            
                            </li>
                            <li>
                                <a href="#"> Admin Users</a>                               
                            </li>
                        </ul>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box portlet box purple">
                            <div class="portlet-title">
                                <h4><i class="fa fa-user"></i>Manage Admin Users</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                    <a href="javascript:;" class="reload"></a>
                                    <a href="javascript:;" class="remove"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="clearfix">
                                    <div class="btn-group">
                                       <a href="<?php echo base_url(); ?>/webadmin/user/add_edit" class="btn green">   Add New <i class="fa fa-plus"></i></a>
                                      
                                    </div>
                                    <div class="btn-group pull-right">
                                        <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Print</a></li>
                                            <li><a href="#">Save as PDF</a></li>
                                            <li><a href="#">Export to Excel</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover" id="sample_3">
                                    <thead>
                                        <tr>
                                            <th style="width:8px;">#</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th class="hidden-480">Email</th>
                                            <th class="hidden-480">User Role</th>
                                            <th class="hidden-480">Status</th>
                                            <th >Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                        foreach($users as $user)
                                        {
                                            $c++;

                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $c;?></td>
                                            <td><?php echo $user->first_name;?> &nbsp;<?php echo $user->last_name;?></td>

                                            <td><?php echo $user->user_name;?></td>
                                            <td class="hidden-480"><a href="mailto:<?php echo $user->email?>"><?php echo $user->email_address?></a>
                                            </td>
                                            <td class="hidden-480"><?php echo $user->user_role; ?></td>
                                            
                                            <td class="hidden-480">
                                            <?php
                                        
                                            if($user->status==1)
                                            {
                                                 echo '<span class="label label-success">Approved</span></td>';
                                            }
                                            else
                                            {

                                                   echo '<span class="label label-warning">Suspended</span>';
                                            }   
                                         
                                          ?>

                                            
                                            <td align="center">
                                         <?php 
                                         echo  anchor('webadmin/user/view/'.$user->id, '<i class="fa fa-search"></i>', array('class' => 'btn btn-small'));
                                         echo "&nbsp;".  anchor('webadmin/user/add_edit/'.$user->id, '<i class="fa fa-pencil"></i>', array('class' => 'btn btn-small'));
                                         echo"&nbsp".  anchor('webadmin/user/del/'.$user->id, '<i class="fa fa-trash"></i>',array('class' =>'btn btn-small','onclick' => "return confirm('Do you want delete ".$user->user_name." Admin User ?')"));
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
    