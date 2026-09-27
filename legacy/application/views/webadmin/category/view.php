<?php
/*
	Author:Nasiruddin Khan
	email:khan.nasiruddin2012@gmail.com
	This Add and edit page for menu 
*/
?>

<h3>
  <?php //echo empty($user->id) ? 'Add a new user' : 'Edit user ' . $user->parent; ?>
</h3>
<?php //echo validation_errors(); ?>
<?php //echo form_open();?>
<!-- Inner Container Start -->
<div class="container">
<!-- Statistics Button Container --> 
<!-- Panels Start -->
<div class="mws-panel grid_8">
	<?php
        //print_r($category);
    ?>
  <div class="mws-panel-header"> <span><i class="fa fa-pencil"></i> 
   <?php echo empty($category->id) ? 'Add a new Category' : 'Category : : ' . $category->title; ?></span>
   </div>
  <div class="mws-panel-body no-padding">
   <?php echo form_open_multipart('','class=mws-form'); ?>
 

    <div class="mws-form-inline">
      <div class="mws-form-row">
        <label class="mws-form-label">Category Title</label>
        <div class="mws-form-item">
          <input type="text"  readonly class="small" name="title" value="<?php echo set_value('title', $category->title); ?>">
          <?php echo form_error('title', '<div class="error">', '</div>');?>  
        </div>
      </div>
      <div class="mws-form-row">
        <label class="mws-form-label">User Photo</label>
        <div class="mws-form-item"  style="width:47%">
 		<input type="hidden"  name="old_img"   value="<?php echo $category->image; ?>"  />
          <?php //echo form_upload('userfile');
		   $cat_img=$category->image;
			if(empty($cat_img))
			{
				$cat_img='no-image.png';
			}
			
          ?>
          <br />
          <img src="<?php echo base_url(); ?>/uploads/<?php echo $cat_img; ?>"  height="100" width="100"  />
        </div>
      </div>
      <div class="mws-form-row">
      
      <?php

	  ?>
        <label class="mws-form-label">Parent</label>
        <div class="mws-form-item">
        
          <?php
					$this->db->select('*');
					$this->db->from('categories');
					//$this->db->where('parent_id', '0');
					$this->db->where_not_in('id', $category->id);
					$this->db->order_by('parent_id');					
					$query = $this->db->get();	
                    //$query = $this->db->query('SELECT  *  FROM admin_menu');
					$r=$query->result_array();
					//print_r($r);
					foreach ($query->result_array() as $row)
					{
						$id= $row['id'];
						$parent_id = $row["parent_id"] === NULL ? "NULL" : $row["parent_id"];
						$data[$id] = $row;
						$index[$parent_id][] = $id;
                    }
                    ?>
         
            <?php
			//echo '<pre>';
		//	print_r($data);
		//	echo '</pre>';
			$CI =&get_instance();
			  $options=$CI->get_options($data);
			  
		     // print_r($options);
			  echo "<select  name='parent_id' >";
			  echo '  <option value="0" >Parent</option>';
			  foreach($options as $key => $val) {
		      if(substr($key,1)==$category->parent_id){
				  
				echo "<option value='".substr($key,1)."' selected='selected'>".$val."</option>";
			  }
			  else
			  {
			      echo "<option value='".substr($key,1)."'>".$val."</option>";
			 	  
			  }
			  
			  }
			  echo "</select>";

?>



        </div>
      </div>
      <div class="mws-form-row">
        <label class="mws-form-label">Description</label>
        <div class="mws-form-item">
          <?php
				   $desc = array(
						  'name'        => 'desc',
						  'id'          => 'desc',
						  'value'       => $category->desc,
						  'rows'        => '5',
						  'cols'        => '10',
						  //'style'       => 'width:50%',
						  'class'		=>'large'
						  
						);
					
					  echo form_textarea($desc);
					?>
        </div>
      </div>
      <div class="mws-form-row">
        <label class="mws-form-label">Sort Order</label>
        <div class="mws-form-item"> <?php echo form_input('display_order', set_value('display_order', $category->display_order) ,'class=small'); ?> 
        </div>
      </div>
      <div class="mws-form-row">
        <label class="mws-form-label">Status</label>
        <div class="mws-form-item">
  			<?php
			   $options = array('1'=> 'Yes', '0'=> 'No');
			   echo form_dropdown('status', $options, $category->status, 'class="options" id=""');
			?>
        </div>
      </div>
      <div class="mws-button-row">
        <a href="<?php echo base_url(); ?>webadmin/category" class="btn btn-danger"> Back To List</a>
      </div>
    </div>
    <?php echo form_close();?> </div>
</div>
