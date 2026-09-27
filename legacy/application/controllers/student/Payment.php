<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends Frontend_Controller {
	
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
		if(!$this->session->userdata('student')){
			redirect(base_url().'login');
		}
		
		if($this->session->userdata('student_status')==0){
			redirect(base_url('student/dashboard'));
		}
	}
	
	public function index(){
		$data['filter_start_date'] = date('Y-m-01');
		$data['filter_end_date'] = date('Y-m-t');
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$output = $this->getlist();
			echo json_encode($output);
		} else {
			$this->load->view('student/payment', $data);
		}
	}
	
	public function getlist(){
		$postData = $this->input->post();
		if (isset($postData['filter_start_date'])) {
			$filter_start_date = $postData['filter_start_date'];
		} else {
			$filter_start_date = date('m-01-Y');
		}

		if (isset($postData['filter_end_date'])) {
			$filter_end_date = $postData['filter_end_date'];
		} else {
			$filter_end_date = date('m-t-Y');
		}
		
		/* if (isset($postData['filter_type'])) {
			$filter_type = $postData['filter_type'];
		} else {
			$filter_type = null;
		}
		
		if (isset($postData['order'])) {
			$order = $postData['order'];
		} else {
			$order = NULL;
		}

		if (isset($postData['start'])) {
			$start = $postData['start'];
		} else {
			$start = 0;
		}

		if (isset($postData['length'])) {
			$length = $postData['length'];
		} else {
			$length = 20;
		}
		$filter_data = [
			'filter_student_id'     => $this->session->userdata('id'),
			'filter_start_date'     => $filter_start_date,
			'filter_end_date'       => $filter_end_date,
			'filter_type'       => $filter_type,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->student_model->getPassbookItems($filter_data);
		//print_r($results);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'id' => $result['id'],
				'reason' => $result['reason'],
				'description'   => $result['description'],
				'credit_point'   => $result['credit_point'],
				'debit_point'   => $result['debit_point'],
				'balance_point'   => $result['balance_point'],
				'created_at'			=>	date('Y-m-d', strtotime($result['created_at']))
			);
		} */

		$json = array(
			'draw'				=>	1,
			'recordsTotal'		=>	1,
			'recordsFiltered'	=>	1,
			'data'				=>	array(),
		);
		return $json;
	}
}