<?php $this->load->view('includes/header'); ?>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <!-- BEGIN SIDEBAR -->
        
         <?php $this->load->view('includes/left_menu'); ?>

        <!-- END SIDEBAR -->
        <!-- BEGIN PAGE -->
        <div class="page-content" >

         <?php $this->load->view($main_content); ?>
        
        </div>
        <!-- END PAGE -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
<?php $this->load->view('includes/footer'); ?>