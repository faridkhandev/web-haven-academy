<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		//$this->load->model('hotel_m');
		//$this->load->model('testimonial_m');
	}
	public function index(){
		$data['page']='about';
		$this->load->view('front/about', $data); 
	} 
}
?>