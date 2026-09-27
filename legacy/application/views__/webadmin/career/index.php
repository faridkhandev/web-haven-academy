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

      <h3 class="page-title"> Manage Career </h3>

      <ul class="breadcrumb">

        <li> <i class="fa fa-home"></i> <a href="<?php  echo base_url("webadmin/dashboard"); ?>">Home</a> <i class="fa fa-angle-right"></i> </li>

        <li> <i class="fa fa-home"></i> <a href="<?php  echo base_url("webadmin/career"); ?>">Manage Career</a> <i class="fa fa-angle-right"></i> </li>

        <li> <a href="#">Career List</a> </li>

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

          <h4><i class="fa fa-user"></i>Manage Career</h4>

          <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="javascript:;" class="remove"></a> </div>

        </div>

        <div class="portlet-body">

          <div class="clearfix">

            <div class="btn-group"> <a href="<?php echo base_url(); ?>webadmin/career/add_edit" class="btn green">Add New Career <i class="fa fa-plus"></i></a> </div>

          </div>

          <table class="table table-striped table-bordered table-hover" id="sample_3">

            <thead>
              <tr>
                <th style="width:8px;">#</th>
                <th>Title</th>
                <th>Content</th>
                <th >Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php

					foreach($careers as $career)
					{
						$c++;
					?>

              <tr class="odd gradeX">
                <td><?php echo $c;?></td>
                <td><?php echo $career->title;?></td>
                <td><?php echo $career->description;?></td>

                <td align="center"><?php 

				  echo  anchor('webadmin/career/add_edit/'.$career->id, '<i class="fa fa-pencil"></i> Edit', array('class' => 'btn btn-small'));

				   echo '&nbsp;'.   anchor('webadmin/career/del/'.$career->id, '<i class="fa fa-trash"></i> Delete',array('class' =>'btn btn-small','onclick' => "return confirm('Do you want delete ".$career->title." career ?')"));

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