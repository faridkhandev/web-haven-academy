<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ourcourse extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		$this->load->model('student_model');	
		$this->load->model('settings_m');			
		/*$this->load->model('service_m');	
		$this->load->model('block_m');	
		$this->load->model('category_m'); */
		/* if(!isset($_SESSION['id')){
			redirect(base_url().'login');
		} */
		//print_r($_SESSION);
		if(!$this->session->userdata('student')){
			redirect(base_url().'login');
		}
		
		if($this->session->userdata('student_status')==0){
			redirect(base_url('student/dashboard'));
		}
	}
	
	public function index(){
	    $query = $this->db->query("SELECT * FROM bh_course WHERE course_delete_status = 0 AND parent_id = 0 AND course_status= 1 and type_id = 1 ORDER BY sort_order ASC");
		$data['courses']=$query->result_array();
		$query = $this->db->query("SELECT * FROM bh_course WHERE course_delete_status = 0 AND course_status= 1 and type_id = 2 ORDER BY sort_order ASC");
		$data['betacourses']=$query->result_array();
		$data['page']='course';
		$this->load->view('student/ourcourses', $data);
	}
}