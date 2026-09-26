<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coursedetails extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		//$this->load->model('hotel_m');
		//$this->load->model('testimonial_m');
	}
	public function index(){
		if(isset($_GET['id'])){
		$query = $this->db->query("SELECT * FROM bh_course WHERE course_id='".$_GET['id']."'");
		$data['course']=$query->row_array();
		$data['page']='coursedetails';
		$this->load->view('front/coursedetails', $data); 
		}else{
			redirect(base_url());
		}
	} 
}
?>