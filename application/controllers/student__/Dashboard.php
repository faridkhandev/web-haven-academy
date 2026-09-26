<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
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
	}
	
	public function index(){
		$query = $this->db->query("SELECT s.*, ue.user_no, u.firstname, u.lastname FROM bh_student s LEFT JOIN bh_user u ON s.link_user_id=u.user_id LEFT JOIN bh_user_extra ue ON u.user_id = ue.user_id WHERE s.id ='".$this->session->userdata('id')."'");
		$data['student']=$query->row_array();
		$data['page']='dashboard';
	    $this->load->view('student/dashboard', $data);
	}
}