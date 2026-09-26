<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Block extends Frontend_Controller {
	public function __construct (){
		parent::__construct();
		/* $this->load->model('settings_m');
		$this->load->model('hotel_m');
		$this->load->model('service_m');
		$this->load->model('block_m'); */
	}

	public function index(){
		if (isset($_GET['student_id'])){
			
			
			
			$data['page']='block';
			$this->load->view('front/block', $data);
		}
	}
}