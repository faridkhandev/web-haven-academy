<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Termsconditions extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		//$this->load->model('hotel_m');
		//$this->load->model('testimonial_m');
	}
	public function index(){
		$data['page']='termsconditions';
		$this->load->view('front/termsconditions', $data); 
	} 
}
?>