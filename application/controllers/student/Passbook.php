<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passbook extends Frontend_Controller {
	
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
		
		$query = $this->db->query("SELECT sum(credit_point) as total_credit_point, sum(debit_point) as total_debit_point FROM bh_student_passbook WHERE student_id = '".$this->session->userdata('id')."'");
		$row = $query->row_array();
		
		$data['total_credit_point'] = isset($row['total_credit_point'])?$row['total_credit_point']:0;
		$data['total_debit_point'] = isset($row['total_debit_point'])?$row['total_debit_point']:0;
		
		$query = $this->db->query("SELECT * FROM bh_student WHERE id = '".$this->session->userdata('id')."'");
		$row = $query->row_array();
		$data['student_point'] = $row['student_point'];
		
		$query = $this->db->query("SELECT sum(amount) as total_amount FROM bh_student_payment_history WHERE student_id = '".$this->session->userdata('id')."'");
		$row = $query->row_array();
		$data['total_amount'] = isset($row['total_amount'])?$row['total_amount']:0;
		
		$query = $this->db->query("SELECT sum(withdrawal_point) as total_request_withdrawal_point FROM bh_student_withdrawal_request WHERE student_id = '".$this->session->userdata('id')."' AND approve_status = 'Pending'");
		$row = $query->row_array();
		$data['total_request_withdrawal_point'] = isset($row['total_request_withdrawal_point'])?$row['total_request_withdrawal_point']:0;
		
		$query = $this->db->query("SELECT sum(withdrawal_point) as total_withdrawal_point FROM bh_student_withdrawal_request WHERE student_id = '".$this->session->userdata('id')."' AND approve_status = 'Paid'");
		$row = $query->row_array();
		$data['total_withdrawal_point'] = isset($row['total_withdrawal_point'])?$row['total_withdrawal_point']:0;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$output = $this->getlist();
			//echo "<pre>";print_r($output);
			echo json_encode($output);
		} else {
			$this->load->view('student/passbook', $data);
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
		
		if (isset($postData['filter_type'])) {
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
				'created_at'			=>	date('Y-m-d g:i A', strtotime($result['created_at']))
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