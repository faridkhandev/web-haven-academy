<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdrawal extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		$this->load->model('student_model');	
		$this->load->model('student_m');	
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
		$data['page']='withdrawal';
		$data['minimum_withdrawal_point'] = $this->settings_m->getSettingValue('config_student_minimum_withdrawal_point');
		$data['money_conversion'] = $this->settings_m->getSettingValue('config_money_conversion');
		$data['total_credit_point'] = $this->student_m->getStudentTotalCreditPoint($this->session->userdata('id'));
		$data['total_debit_point'] = $this->student_m->getStudentTotalDebitPoint($this->session->userdata('id'));
		$data['total_withdrawal_request_point'] = $this->student_m->getStudentTotalWithdrawalRequestPoint($this->session->userdata('id'));
		$data['balance_point'] = $this->student_m->getStudentPoint($this->session->userdata('id'));
		$query = $this->db->query("SELECT * FROM bh_student_payment_medium WHERE student_id = '" . $this->session->userdata('id') . "'");
		$data['payment_medium'] = $query->result_array();
		$data['filter_start_date'] = date('Y-m-01');
		$data['filter_end_date'] = date('Y-m-t');
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$output = $this->getlist();
			echo json_encode($output);
		} else {
			$this->load->view('student/withdrawal', $data);
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
		
		if (isset($postData['filter_approve_status'])) {
			$filter_approve_status = $postData['filter_approve_status'];
		} else {
			$filter_approve_status = null;
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
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->student_model->getWithdrawalItems($filter_data);
		//print_r($results);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'id' => $result['id'],
				'withdrawal_point' => $result['withdrawal_point'],
				'comment' => $result['withdrawal_message'],
				'approve_at'           => is_null($result['approve_at'])?'N/A':date('Y-m-d', strtotime($result['approve_at'])),
				'cancelled_at'           => is_null($result['cancelled_at'])?'N/A':date('Y-m-d', strtotime($result['cancelled_at'])),
				'requested_at'      => date('Y-m-d', strtotime($result['requested_at'])),
				'approve_status'      => ($result['approve_status']=='Pending')? '<span class="badge badge-warning">Pending</span>':(($result['approve_status']=='Paid')? '<span class="badge badge-success">Paid</span>':'<span class="badge badge-danger">Cancel</span>'),
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
	
	public function addrequest(){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$minimum_withdrawal_point = $this->settings_m->getSettingValue('config_student_minimum_withdrawal_point');
			$money_conversion = $this->settings_m->getSettingValue('config_money_conversion');
			
			if(empty($_POST['withdrawal_point'])){
				$json['error'] = 'Please add point';
			}
			
			if(empty($_POST['payment_medium'])){
				$json['error'] = 'Please select payment medium';
			}
			
			if($_POST['withdrawal_point']<$minimum_withdrawal_point){
				$json['error'] = 'Minimum withdrawal point condition not match.';
			}
			
			if (empty($json['error'])) {
				
				$this->db->insert('bh_student_withdrawal_request', array('student_id'=>$this->session->userdata('id'), 'withdrawal_point'=>$_POST['withdrawal_point'], 'requested_at'=>date('Y-m-d H:i:s'), 'approve_status'=>'Pending', 'payment_medium'=>$_POST['payment_medium'], 'withdrawal_message'=>$_POST['withdrawal_message'], 'point_value'=>$money_conversion));
				
				$id = $this->db->insert_id();
				if($id){
					$json['success'] = 'Withdrawal request successfully send to admin.';
				}else{
					$json['error'] = 'Request did not send due to system error. Try again';
				}
			}
			//print_r($json);
		}
		echo json_encode($json);
	}
}