<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refer extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		$this->load->model('settings_m');			
		$this->load->model('student_model');			
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
		$data['page']='refer';
		$data['filter_start_date'] = date('Y-m-01');
		$data['filter_end_date'] = date('Y-m-t');
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$output = $this->getlist();
			echo json_encode($output);
		} else {
			$this->load->view('student/refer', $data);
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
			'filter_refer_id'     => $this->session->userdata('id'),
			'filter_start_date'     => $filter_start_date,
			'filter_end_date'       => $filter_end_date,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->student_model->getReferItems($filter_data);
		//print_r($results);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'id' => $result['id'],
				'student_no' => $result['student_no'],
				'student_name' => $result['student_name'],
				'student_phone'           => $result['student_phone'],
				'student_whatsapp'           => '<a target="_blank" href="https://api.whatsapp.com/send?phone='.ltrim($result['student_whatsapp'], '+').'">'.$result['student_whatsapp'].'</a>',
				'student_email'           => $result['student_email'],
				'student_gender'           => $result['student_gender'],
				'student_language'           => $result['student_language'],
				'student_city'           => $result['student_city'],
				'student_country'          => $result['student_country'],
				'created_at'      => date('Y-m-d', strtotime($result['created_at'])),
				'student_status'      => ($result['student_status']==1)?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>',
			);
		}

		$json = array(
			'draw'				=>	(int)$postData['draw'],
			'recordsTotal'		=>	$results['recordsTotal'],
			'recordsFiltered'	=>	$results['recordsFiltered'],
			'data'				=>	$items,
		);
		return $json;
	}
}