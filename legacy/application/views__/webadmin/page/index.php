<!-- BEGIN PAGE CONTAINER-->
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN STYLE CUSTOMIZER --> 
      <!-- END BEGIN STYLE CUSTOMIZER --> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> Manage Page </h3>
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url("webadmin/dashboard");?>">Home</a> <i class="fa fa-angle-right"></i> </li>
        <li><a href="<?php echo base_url("webadmin/page");?>">Manage Page</a>  </li>
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
          <h4><i class="fa fa-user"></i>Manage Page</h4>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="javascript:;" class="remove"></a> </div>
        </div>
        <div class="portlet-body">
          <div class="clearfix">
            <div class="btn-group"> <a href="<?php echo base_url(); ?>webadmin/page/add_edit" class="btn green">Add New Page <i class="fa fa-plus"></i></a> </div>
            
				
          </div>
          
          <table class="table table-striped table-bordered table-hover" id="sample_3">
            <thead>
              <tr>
               <th style="width:8px;">#</th>
                <th>Page Title</th>
                <th>Page Content</th>
                <th>Status</th>
                <th class="sorting_disable">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
				foreach($pages as $page){
				$c++;
			  ?>
              <tr class="odd gradeX">
           
                <td><?php echo $c;?></td>
                <td><?php echo $page->title;?></td>
                <td><?php echo character_limiter($page->body,120);?></td>
                <td>
				<?php
					if($page->status==1){
						 echo '<span class="label label-success">Published</span></td>';
					}
					else{
					   echo '<span class="label label-warning">Pending</span>';
					}
				?>
                </td>
                <td align="center">
				<?php 
              
				 echo  anchor('webadmin/page/add_edit/'.$page->id, '<i class="fa fa-pencil"></i> Edit', array('class' => 'btn btn-small'));
				  echo '&nbsp;'. anchor('webadmin/page/del/'.$page->id, '<i class="fa fa-trash"></i> Delete',array('class' =>'btn btn-small','onclick' => "return confirm('Do you want delete ".$page->title." Page ?')"));
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