<div class="page-sidebar nav-collapse collapse"> 
  <!-- BEGIN SIDEBAR MENU -->
  <ul id="menu">
    <li> 
      <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
      <div class="sidebar-toggler hidden-phone"></div>
      <!-- BEGIN SIDEBAR TOGGLER BUTTON --> 
    </li>
    <li> 
      <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
      <form class="sidebar-search">
        <div class="input-box"> <a href="javascript:;" class="remove"></a>
          <input type="text" placeholder="Search..." />
          <input type="button" class="submit" value=" " />
        </div>
      </form>
      <!-- END RESPONSIVE QUICK SEARCH FORM --> 
    </li>
    
    <?php
	/* $atts = array(
        'width'       => 800,
        'height'      => 600,
        'scrollbars'  => 'yes',
        'status'      => 'yes',
        'resizable'   => 'yes',
        'screenx'     => 0,
        'screeny'     => 0,
        'window_name' => '_blank'
	);

	echo anchor_popup('news/local/123', 'Click Me!', $atts); */
	?>
    <li class="start">
            <a href="<?php echo base_url('webadmin/dashboard');?>">
            <i class="fa fa-home"></i> 
            <span class="title">Dashboard</span>
            </a>
	</li>
                
		<?php
		$current_url=base_url(uri_string());
		$current_2nd=base_url(uri_string(1));
		
		$secondLastKey = count($this->uri->segment_array());
		$last_segment=$this->uri->segment($secondLastKey);
	   
		$query = "SELECT * FROM `admin_menu` where parent_id=0 ORDER BY display_order ASC";
		$query = $this->db->query($query);
		$menuitems = $query->result();
		foreach($menuitems as $menu)
		{
			/* if(in_array($current_url,$menu->page_url))
			{
				$scl='active open';
			}
			else
			{  
				$scl='';
			} */
			$scl='';
		?>
		
		
		<li class="has-sub  <?php echo $scl;?>">
			<a href="javascript:;">
			<i class="<?php echo $menu->menu_class;?>"></i> 
			<span class="title"><?php echo $menu->title; ?></span>
			<span class="selected"></span>
			<span class="arrow open"></span>
			</a>
			<ul class="sub">
			 <?php
				$queryp = "SELECT * FROM `admin_menu`  where parent_id=".$menu->id;
				$queryp = $this->db->query($queryp);
				$childitems = $queryp->result() ;
				foreach($childitems as $child)
				{
					if($current_url=='http://howrahbandanaboutique.in/webadmin/'.$child->page_url)
					{
						$cl='active';
					}
					else
					{ 
						 $cl='';
					}
					
				?><li  class="<?php echo $cl;?>"><a href="<?php echo base_url('webadmin');?>/<?php echo $child->page_url; ?>"><?php echo $child->title; ?></a></li>
		  <?php } ?>
			</ul>
		</li>
		 <?php
		   }
		 ?>
		<li class="start">
            <a href="<?php echo site_url();?>" target="_blank">
            <i class="fa fa-home"></i> 
            <span class="title">Visit  Site</span>
            </a>
		</li>    
  </ul>

  <script>
  $(document).ready(function() {
$('#menu .has-sub li').bind('click', function(e){
        var el   = $(this),
            list = $('#menu').find('li');
        list.removeClass('active');            
        el.addClass('active').parents('li').addClass('open active');
    });

   /*$(function() {
    $("ul > li").click(function() {
        // remove .active from all li descendants
        $("ul > li").not(this).removeClass("active");
        //hide all sub menu except current active
        $("ul > li").not(this).find(".has-sub").hide(400);
        //apply active class on current selected menu
        $(this).addClass("active");

        //check if sub menu exists
        if($(this).find(".has-sub").length>0){
              //show the selected sub menu 
              $(this).find(".has-sub").show(500);
               //apply active class on all sub menu options
              $(this).find(".has-sub li").andSelf().addClass("active");
        } 
    });
	
});*/
  });
  </script>
    

  <!-- END SIDEBAR MENU --> 
</div>
