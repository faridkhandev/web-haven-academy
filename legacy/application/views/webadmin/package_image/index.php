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

      <h3 class="page-title"> Manage Package Images </h3>

      <ul class="breadcrumb">

        <li> <i class="fa fa-home"></i> <a href="<?php  echo base_url("webadmin/dashboard"); ?>">Home</a> <i class="fa fa-angle-right"></i> </li>

        <li> <i class="fa fa-home"></i> <a href="<?php  echo base_url("webadmin/package_images"); ?>">Manage Package Images</a> <i class="fa fa-angle-right"></i> </li>

        <li> <a href="#">Package Images List</a> </li>

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
          <h4><i class="fa fa-user"></i>Manage Package Images</h4>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="javascript:;" class="remove"></a> </div>
        </div>
        <div class="portlet-body">
          <div class="clearfix">
            <div class="btn-group"> <a href="<?php echo base_url(); ?>webadmin/package_images/add_edit" class="btn green">Add New Package Images <i class="fa fa-plus"></i></a> </div>
          </div>
          <table class="table table-striped table-bordered table-hover" id="sample_3">
            <thead>
              <tr>
                <th style="width:8px;">#</th>
                <th>Package</th>
                <th >Image</th>
                <th >Actions</th>
              </tr>
            </thead>
            <tbody>
            <?php
			$c=0;
			/* print_r($hotels); */
			foreach($packages as $package)
			{
				$c++;
			?>
              <tr class="odd gradeX">
                <td><?php echo $c;?></td>

                <td><?php echo $package['name'];?></td>
                <td><?php 
				   $cat_img=$package['package_image'];
					if(empty($cat_img)){
						$cat_img='no-image.png';
					}
                    ?>
                  <img src="<?php echo base_url(); ?>/uploads/<?php echo $cat_img; ?>"  height="100" width="100"  /></td>
                <td align="center"><?php 
			  echo  anchor('webadmin/package_images/add_edit/'.$package['package_image_id'], '<i class="fa fa-pencil"></i> Edit', array('class' => 'btn btn-small'));
			   echo '&nbsp;'.   anchor('webadmin/package_images/del/'.$package['package_image_id'], '<i class="fa fa-trash"></i> Delete',array('class' =>'btn btn-small','onclick' => "return confirm('Do you want delete image ?')"));
			 ?></td>
              </tr>
              <?php } ?>
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