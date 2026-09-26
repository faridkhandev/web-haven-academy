<?php
	function get_meta_by_id($table_name, $key,$id=NULL)
	{ 
	   $CI = &get_instance();
	   if($id==0){
		   return 'Parent';
	   }
	   else{
		
		$row = $CI->db->select($key)
                ->where('id', $id)
                ->limit(1) 
                ->get($table_name)->row();
		 // $child= $this->category_m->get($parent_id);
		   return $row->title;
	   }
		
	}
	
	function get_slug_by_id($table_name, $key, $slug=NULL)
	{ 
	   $CI = &get_instance();
	   if($slug==NULL){
		   return 'No data found';
	   }
	   else{
		
		$row = $CI->db->select($key)
                ->where('slug', $slug)
                ->limit(1) 
                ->get($table_name)->row();
		 // $child= $this->category_m->get($parent_id);
		   return $row->id;
	   }
		
	}
	
	function get_slug_by_title($table_name, $key, $slug=NULL)
	{ 
	   $CI = &get_instance();
	   if($slug==NULL){
		   return 'No data found';
	   }
	   else{
		
		$row = $CI->db->select($key)
                ->where('slug', $slug)
                ->limit(1) 
                ->get($table_name)->row();
		 // $child= $this->category_m->get($parent_id);
		   return $row->title;
	   }
		
	}
	
	function get_products_by_category($cat_id)
	{
		  $CI = &get_instance();
		   $row = $CI->db->select('*')
					->where('cat_id', $cat_id)
					->get('products')->result();
			 // $child= $this->category_m->get($parent_id);
			   return $row;
		
	}
?>