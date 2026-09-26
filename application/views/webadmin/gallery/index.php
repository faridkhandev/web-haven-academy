<!-- BEGIN PAGE CONTAINER-->
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN STYLE CUSTOMIZER --> 
      
      <!-- END BEGIN STYLE CUSTOMIZER --> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> Manage Gallery </h3>
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url("webadmin/dashboard");?>">Home</a> <i class="fa fa-angle-right"></i></li>
        <li> <a href="<?php echo base_url("webadmin/gallery");?>">Manage Gallery</a> </li>
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
          <h4><i class="fa fa-user"></i>Manage Gallery</h4>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="javascript:;" class="remove"></a> </div>
        </div>
        <div class="portlet-body">
          <div class="clearfix">
            <div class="btn-group"> <a href="<?php echo base_url(); ?>webadmin/gallery/add_edit" class="btn green">Add New Gallery <i class="fa fa-plus"></i></a> </div>
          </div>
          <table class="table table-striped table-bordered table-hover" id="sample_3">
            <thead>
              <tr>
                <th style="width:8px;">#</th>
                <th>Title</th>
                <th>Image</th>
                <th>Sort Order</th>
                <th>Status</th>
                <th >Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
				foreach($galleries as $gallery){
				$c++;
			?>
              <tr class="odd gradeX">
                <td><?php echo $c;?></td>
                <td><?php echo $gallery->title;?></td>
                <td><?php $image=$gallery->image;
                                                if(empty($image))
                                                {
                                                    $image='no-image.png';
                                                }
                                                
                                              ?>
                  <img src="<?php echo base_url(); ?>uploads/<?php echo $image; ?>"  height="100" width="100"  /></td>
                  <td><?php echo $gallery->sort_order;?></td>
                <td class="hidden-480">
				<?php
				if($gallery->status==1){
					 echo '<span class="label label-success">Approved</span></td>';	}
				else{

					   echo '<span class="label label-warning">Suspended</span>';
				} ?>
                </td>
                <td align="center"><?php 
                 echo '&nbsp;'.  anchor('webadmin/gallery/add_edit/'.$gallery->id, '<i class="fa fa-pencil"></i>Edit', array('class' => 'btn btn-small'));
                                             echo '&nbsp;'.   anchor('webadmin/gallery/del/'.$gallery->id, '<i class="fa fa-trash"></i>Delete'   ,array('class' =>'btn btn-small','onclick' => "return confirm('Do you want delete ".$gallery->title." Gallery ?')"));
                                         ?></td>
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
