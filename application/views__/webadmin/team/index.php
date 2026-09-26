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

      <h3 class="page-title"> Manage Team </h3>

      <ul class="breadcrumb">

        <li> <i class="fa fa-home"></i> <a href="<?php  echo base_url("webadmin/dashboard"); ?>">Home</a> <i class="fa fa-angle-right"></i> </li>

        <li> <i class="fa fa-home"></i> <a href="<?php  echo base_url("webadmin/team"); ?>">Manage Team</a> <i class="fa fa-angle-right"></i> </li>

        <li> <a href="#">Team List</a> </li>

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
          <h4><i class="fa fa-user"></i>Manage Team</h4>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="javascript:;" class="remove"></a> </div>
        </div>
        <div class="portlet-body">
          <div class="clerfix">
            <div class="btn-group"> <a href="<?php echo base_url(); ?>webadmin/team/add_edit" class="btn green">Add New Team <i class="fa fa-plus"></i></a> </div>
          </div>
          <table class="table table-striped table-bordered table-hover" id="sample_3">
            <thead>
              <tr>
                <th style="width:8px;">#</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Image</th>
                <th class="hidden-480">Display Order</th>
                <th class="hidden-480">Status</th>
                <th >Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
			  $c=1;
				foreach($teams as $team)
				{
					
				?>
              <tr class="odd gradeX">
                <td><?php echo $c;?></td>
                <td><?php echo $team->name;?></td>
                <td><?php echo $team->designation;?></td>
                <td><?php 
				   $team_img=$team->image;
					if(empty($team_img)){
						$team_img='no-image.png';
					}
                    ?>
                  <img src="<?php echo base_url(); ?>/uploads/<?php echo $team_img; ?>"  height="100" width="100"  /></td>
                <td class="hidden-480"><?php echo $team->display_order; ?></td>
                <td class="hidden-480">
				<?php
				if($team->status==1){
					echo '<span class="label label-success">Approved</span></td>';
				}else{
					echo '<span class="label label-warning">Suspended</span>';                
				}
				?>
				</td>
				<td align="center">
				<?php 
					echo  anchor('webadmin/team/add_edit/'.$team->id, '<i class="fa fa-pencil"></i> Edit', array('class' => 'btn btn-small'));
					echo '&nbsp;'.   anchor('webadmin/team/del/'.$team->id, '<i class="fa fa-trash"></i> Delete',array('class' =>'btn btn-small','onclick' => "return confirm('Do you want delete ".$team->name." hotel ?')"));
				?>
				</td>
              </tr>
              <?php
				$c++;
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