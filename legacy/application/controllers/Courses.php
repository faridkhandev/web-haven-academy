<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		//$this->load->model('hotel_m');
		//$this->load->model('facility_m');
	}
	public function index(){
		
		$query = $this->db->query("SELECT * FROM bh_course WHERE course_delete_status = 0 AND parent_id = 0 AND type_id= 1 AND course_status= 1 ORDER BY sort_order ASC");
		$data['courses']=$query->result_array();
		
		$query = $this->db->query("SELECT * FROM bh_course WHERE course_delete_status = 0 AND type_id= 2 AND course_status= 1 ORDER BY sort_order ASC");
		$data['courses2']=$query->result_array();
		$data['page']    = 'courses';
		$this->load->view('front/courses', $data); 
	} 
	
	public function view(){
		if(isset($_GET['id'])){
			$query = $this->db->query("SELECT * FROM bh_course WHERE course_id='".$_GET['id']."'");
			$data['course']=$query->row_array();
			
			$query = $this->db->query("SELECT * FROM bh_course WHERE parent_id='".$_GET['id']."'");
			$data['childcourses']=$query->result_array();
			
			$data['page']='coursedetails';			
				
			$this->load->view('front/subcourses', $data); 
		}else{
			redirect(base_url('courses'));
		}
	}
}
?>