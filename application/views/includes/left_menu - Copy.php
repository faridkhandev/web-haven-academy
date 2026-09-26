<div id="mws-sidebar">
   
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul >
                    <li class="active">
                  <!--  <a href="dashboard.html"><i class="fa fa-home"></i> Dashboard</a>-->
                    <?php echo anchor('webadmin/dashboard', '<i class="fa fa-home"></i> Dashboard'); ?>
                    </li>
                    
                    <?php
					
				$query = "select * from admin_menu where parent_id=0";
				$query = $this->db->query($query);
				$result = $query->result_array() ;
				foreach($result as $key=>$value)
				{
				   $query = "select * from admin_menu where parent_id='".$value['id']."' ";
				   $query = $this->db->query($query);
				   $result[$key]['child']=$query->result_array() ;
				}
			//print_r($result);
					 foreach($result as $row)
						{
						   echo " <li><a href=".$row['page_url']."><i class=".$row['menu_class']."></i>".$row['title']."</a>";    
						   if(count($row['child'])>0)
						   {
							echo "<ul class='closed' >";
							foreach($row['child'] as $sub)
							echo " <li><a href=".$sub['page_url'].">".$sub['title']."</a>";    
							echo "</ul>";
						   }
						   else
						   {
							echo "</li>";
						   }
						}
					?>
                    <li><a href="charts.html"><i class="fa fa-graph"></i> Charts</a></li>
                    <li><a href="calendar.html"><i class="fa fa-calendar"></i> Calendar</a></li>
                    <li><a href="files.html"><i class="fa fa-folder-closed"></i> File Manager</a></li>
                    <li><a href="table.html"><i class="fa fa-table"></i> Table</a></li>
                    <li>
                        <a href="#"><i class="fa fa-list"></i> Forms</a>
                        <ul>
                            <li><a href="form_layouts.html">Layouts</a></li>
                            <li><a href="form_elements.html">Elements</a></li>
                            <li><a href="form_wizard.html">Wizard</a></li>
                        </ul>
                    </li>
                    <li><a href="widgets.html"><i class="fa fa-cogs"></i> Widgets</a></li>
                    <li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>
                    <li><a href="grids.html"><i class="fa fa-th"></i> Grids &amp; Panels</a></li>
                    <li><a href="gallery.html"><i class="fa fa-pictures"></i> Gallery</a></li>
                    <li><a href="error.html"><i class="fa fa-warning-sign"></i> Error Page</a></li>
                    <li>
                        <a href="icons.html">
                            <i class="fa fa-pacman"></i> 
                            Icons <span class="mws-nav-tooltip">2000+</span>
                        </a>
                    </li>
                </ul>
            </div>         
        </div>