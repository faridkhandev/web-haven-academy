<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Joinpoint extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		$this->load->model('student_model');	
		$this->load->model('student_m');	
		$this->load->model('settings_m');			
		/*$this->load->model('service_m');	
		$this->load->model('block_m');	
		$this->load->model('category_m'); */
		/* if(!isset($_SESSION['id')){
			redirect(base_url().'login');
		} */
		if(!$this->session->userdata('student')){
			redirect(base_url().'login');
		}
		
		if($this->session->userdata('student_status')==0){
			redirect(base_url('student/dashboard'));
		}
	}
	
	public function index(){
		$data['page']='Joining Point Withdrawal';
		$query = $this->db->query("SELECT * FROM bh_student WHERE id = '" . $this->session->userdata('id') . "' AND joining_point =10000");
		$data['student'] = $query->row_array();
		$this->load->view('student/joinpoint', $data);
	}
	
}