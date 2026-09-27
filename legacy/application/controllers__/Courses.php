<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		//$this->load->model('hotel_m');
		//$this->load->model('facility_m');
	}
	public function index(){
		$query = $this->db->query("SELECT * FROM bh_course WHERE course_delete_status = 0 AND course_status= 1 ORDER BY priority ASC");
		$data['courses']=$query->result_array();
		$data['page']    = 'courses';
		$this->load->view('front/courses', $data); 
	} 
}
?>