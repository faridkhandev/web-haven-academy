<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coursedetails extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		/* $this->load->model('hotel_m');
		$this->load->model('facility_m');
		$this->load->model('gallery_m');*/	
	}
	public function index(){
		$data['page']    = 'Course Detail';
		$data['main_content'] ='front/facility';
		$this->load->view('front/coursedetails', $data); 
	} 
}
?>